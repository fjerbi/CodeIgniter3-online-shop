<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name: flexi auth Lite
*
* Author: 
* Rob Hussey
* flexiauth@haseydesign.com
* haseydesign.com/flexi-auth
*
* Copyright 2012 Rob Hussey
* 
* Previous Authors / Contributors:
* Ben Edmunds, benedmunds.com
* Phil Sturgeon, philsturgeon.co.uk
* Mathew Davies
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
* 
* http://www.apache.org/licenses/LICENSE-2.0
* 
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*
* Description: A full login authorisation and user management library for CodeIgniter based on Ion Auth (By Ben Edmunds) which itself was based on Redux Auth 2 (Mathew Davies)
* This library file is the 'Lite' version and contains only the most commonly used authentication functions such as checking a users login status.
* For functions that are used less commonly, i.e. the actual login function, they are within the 'flexi auth' library file.
*
* Released: 13/09/2012
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

class Flexi_auth_lite
{
	public function __construct()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->model('flexi_auth_lite_model');
		
		###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		// CHECK LOGIN CREDENTIALS ON LOAD
		###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
		// Validate login credentials on every page load if set via config file.
		if ($this->is_logged_in() && $this->CI->auth->auth_security['validate_login_onload'] && !isset($this->CI->flexi_auth_lite_model->auth_verified))
		{
			$this->CI->flexi_auth_lite_model->validate_database_login_session();
		}
		// Auto log in the user if they have 'Remember me' cookies.
		else if (!$this->is_logged_in() && get_cookie($this->CI->auth->cookie_name['user_id']) && 
			get_cookie($this->CI->auth->cookie_name['remember_series']) && get_cookie($this->CI->auth->cookie_name['remember_token']))
		{
			$this->CI->load->model('flexi_auth_model');
			$this->CI->flexi_auth_model->login_remembered_user();
		}
	}
	
	public function __call($method, $arguments) 
	{
		$extension_types = array('_num_rows', '_row_array', '_array', '_result', '_row');
		$method_substr = str_replace(array_values($extension_types), FALSE, $method);		
		$method_substr_query = $method_substr.'_query';
		$method_substr_extension = str_replace($method_substr, FALSE, $method);
	
		// Get flexi auth class name.
		$libraries = array('flexi_auth', 'flexi_auth_lite');
		foreach($libraries as $library)
		{
			if (isset($this->CI->$library))
			{
				if (method_exists($this->CI->$library, $method_substr_query))
				{
					$target_library = $library;
					break;
				}
			}
		}

		if (isset($target_library))
		{
			// Pass the first 5 submitted arguments to the function (Usually the SQL SELECT and WHERE statements).
			// Note: The search_users() function requires the 4th and 5th arguments.
			$argument_1 = (isset($arguments[0])) ? $arguments[0] : FALSE; // Usually $sql_select
			$argument_2 = (isset($arguments[1])) ? $arguments[1] : FALSE; // Usually $sql_where
			$argument_3 = (isset($arguments[2])) ? $arguments[2] : FALSE; // Other
			$argument_4 = (isset($arguments[3])) ? $arguments[3] : FALSE; // Other
			$argument_5 = (isset($arguments[4])) ? $arguments[4] : FALSE; // Other
			$data = $this->CI->$target_library->$method_substr_query($argument_1, $argument_2, $argument_3, $argument_4, $argument_5);
			
			if (! empty($data))
			{
				if ($method_substr_extension == '_result')
				{
					return $data->result();
				}
				else if ($method_substr_extension == '_row')
				{
					return $data->row();
				}
				else if ($method_substr_extension == '_array')
				{
					return $data->result_array();
				}
				else if ($method_substr_extension == '_row_array')
				{
					return $data->row_array();
				}
				else if ($method_substr_extension == '_num_rows')
				{
					return $data->num_rows();
				}
				else // '_query'
				{
					return $data;
				}
			}
		}
		
		echo 'Call to an unknown method : "'.$method.'"';
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOGOUT FUNCTION
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * logout
	 * Logs a user out of their account. 
	 * Note: The $all_sessions variable allows you to define whether to delete all database sessions or just the current session.
	 * When set to FALSE, this can be used to logout a user off of one computer (Internet Cafe) but not another (Home).
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function logout($all_sessions = TRUE)
	{
		$this->CI->flexi_auth_lite_model->logout($all_sessions);
	
		$this->CI->flexi_auth_lite_model->set_status_message('logout_successful', 'config');
		
		return TRUE;
	}

	/**
	 * logout_specific_user
	 * Logs a specific user out of all of their logged in sessions. 
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function logout_specific_user($user_id = FALSE)
	{
		$this->CI->flexi_auth_lite_model->logout_specific_user($user_id);
	
		$this->CI->flexi_auth_lite_model->set_status_message('logout_successful', 'config');#!#
		
		return TRUE;
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOGIN STATUS FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * is_logged_in
	 * Verifies a user is logged in either via entering a valid password or using the 'Remember me' feature.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function is_logged_in()
	{
		return (bool) $this->CI->auth->session_data[$this->CI->auth->session_name['user_identifier']];
	}

	/**
	 * is_logged_in_via_password
	 * Verifies a user has logged in via entering a valid password rather than using the 'Remember me' feature (Login by password is more secure).
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function is_logged_in_via_password()
	{
		return (bool) $this->CI->auth->session_data[$this->CI->auth->session_name['logged_in_via_password']];
	}

	/**
	 * is_admin
	 * Verifies a user belongs to a user group with admin permissions.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function is_admin()
	{
		return (bool) $this->CI->auth->session_data[$this->CI->auth->session_name['is_admin']];
	}

	/**
	 * in_group
	 * Verifies whether a user is assigned to a particular user group, by comparing by either the group id or name.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function in_group($groups = FALSE)
	{
		// Get users group and convert group name to lowercase for comparison.
		$user_group = array();
		if (! empty($this->CI->auth->session_data[$this->CI->auth->session_name['group']]))
		{
			$session_group = $this->CI->auth->session_data[$this->CI->auth->session_name['group']];
			$user_group[key($session_group)] = strtolower(current($session_group));
		}
		
		// If multiple groups submitted as an array, loop through each.
		if (is_array($groups))
		{
			foreach($groups as $group)
			{
				if ((is_numeric($group) && $group == key($user_group)) || strtolower($group) == strtolower(current($user_group)))
				{
					return TRUE;
				}
			}
			return FALSE;
		}

		return ((is_numeric($groups) && $groups == key($user_group)) || strtolower($groups) == strtolower(current($user_group)));
	}

	/**
	 * is_privileged
	 * Verifies whether a user has a specific privilege, by comparing by either privilege id or name.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function is_privileged($privileges = FALSE)
	{
		// Get users privileges and convert names to lowercase for comparison.
		$user_privileges = array();
		if (! empty($this->CI->auth->session_data[$this->CI->auth->session_name['privileges']]))
		{
			foreach($this->CI->auth->session_data[$this->CI->auth->session_name['privileges']] as $id => $name)
			{
				$user_privileges[$id] = strtolower($name);
			}
		}

		// If multiple groups submitted as an array, loop through each.
		if (is_array($privileges))
		{
			foreach($privileges as $privilege)
			{
				if ((is_numeric($privilege) && array_key_exists($privilege, $user_privileges)) || in_array(strtolower($privilege), $user_privileges))
				{
					return TRUE;
				}
			}
			return FALSE;
		}

		return ((is_numeric($privileges) && array_key_exists($privileges, $user_privileges)) || in_array(strtolower($privileges), $user_privileges));
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// GET USER FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_user_id
	 * Get the users id from the session.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function get_user_id()
	{
		return ($this->CI->auth->session_data[$this->CI->auth->session_name['user_id']] !== FALSE) ? 
			$this->CI->auth->session_data[$this->CI->auth->session_name['user_id']] : FALSE;
	}
	
	/**
	 * get_user_identity
	 * Get the users primary identity from the session.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function get_user_identity()
	{			
		return ($this->CI->auth->session_data[$this->CI->auth->session_name['user_identifier']] !== FALSE) ? 
			$this->CI->auth->session_data[$this->CI->auth->session_name['user_identifier']] : FALSE;
	}
	
	/**
	 * get_user_group_id
	 * Get the users group id from the session.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function get_user_group_id()
	{
		return ($this->CI->auth->session_data[$this->CI->auth->session_name['group']] !== FALSE) ? 
			key($this->CI->auth->session_data[$this->CI->auth->session_name['group']]) : FALSE;
	}
	
	/**
	 * get_user_group
	 * Get the users user group name from the session.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function get_user_group()
	{
		return ($this->CI->auth->session_data[$this->CI->auth->session_name['group']] !== FALSE) ? 
			current($this->CI->auth->session_data[$this->CI->auth->session_name['group']]) : FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
	/**
	 * get_user_by_id_query
	 * Gets data from the user account table and any custom tables that have been related to it by submitting the users id.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_user_by_id_query($user_id = FALSE, $sql_select = FALSE)
	{
		if (!is_numeric($user_id))
		{
			$user_id = ($this->get_user_id()) ? $this->get_user_id() : NULL;
		}

		$sql_where = array($this->CI->auth->tbl_col_user_account['id'] => $user_id);
		
		return $this->CI->flexi_auth_lite_model->get_users($sql_select, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_user_by_identity_query
	 * Gets data from the user account table and any custom tables that have been related to it by submitting the users identity.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_user_by_identity_query($identity = FALSE, $sql_select = FALSE)
	{
		if (!$identity)
		{
			$identity = ($this->get_user_identity()) ? $this->get_user_identity() : NULL;
		}

		$sql_where = array($this->CI->auth->primary_identity_col => $identity);
		
		return $this->CI->flexi_auth_lite_model->get_users($sql_select, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_users_query
	 * Gets data from the user account table and any custom tables that have been related to it. 
	 * Note: Query results will automatically be grouped by the user id (SQL GROUP BY).
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_users_query($sql_select = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_auth_lite_model->get_users($sql_select, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_custom_user_data_query
	 * Gets data from the user account table and any custom tables that have been related to it. 
	 * Note: This function is nearly identical to 'get_users_query()' with the exception that the SQL GROUP BY statement can be defined.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_custom_user_data_query($sql_select = FALSE, $sql_where = FALSE, $sql_group_by = FALSE)
	{
		return $this->CI->flexi_auth_lite_model->get_users($sql_select, $sql_where, $sql_group_by);
	}


	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REFERENCE DATABASE TABLE / COLUMN NAMES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * db_table
	 * Returns a tables actual name by referencing the tables alias name defined via the config file.
	 *
	 * @return string
	 */
	function db_table($table = FALSE)
	{
		// Check the table exists in the config file and that a table name is set.
		if (! isset($this->CI->auth->database_config[$table]['table']) || ! $this->CI->auth->database_config[$table]['table'])
		{
			return FALSE;
		}
		
		return $this->CI->auth->database_config[$table]['table'];
	}
	
	/**
	 * db_column
	 * Returns a table columns actual name by referencing the columns alias name defined via the config file.
	 *
	 * @return string
	 */
	function db_column($table = FALSE, $column = FALSE)
	{
		// Check the table and column exist in the config file and that a table/column name is set.
		if (! isset($this->CI->auth->database_config[$table]['columns'][$column]) || ! $this->CI->auth->database_config[$table]['columns'][$column])
		{
			return FALSE;
		}
		
		return $this->CI->auth->database_config[$table]['columns'][$column];
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ACTIVE RECORD FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * The following functions set SQL statements using active record.
	 * The purpose of the functions is allow developers to create custom SELECT, JOIN, WHERE, ORDER BY, GROUP BY and LIMIT statements that are then
	 *  applied in addition to the default statements set by functions within flexi auth.
	 *
	 * The functions should be called prior to calling any functions that get user or group data, or prior to using the login() function.
	 * Data can be submitted into each of the functions in the same manner as CI's AR functions (That share the same clause type).
	 *
	 * @author Rob Hussey
	 */

	public function sql_select($columns = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('select', $columns, FALSE, FALSE, $overwrite_existing);
	}
	
	public function sql_where($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('where', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_or_where($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('or_where', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_where_in($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('where_in', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_or_where_in($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('or_where_in', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_where_not_in($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('where_not_in', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_or_where_not_in($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('or_where_not_in', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_like($column = FALSE, $value = FALSE, $wildcard_position = FALSE, $overwrite_existing = FALSE)
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('like', $column, $value, $wildcard_position, $overwrite_existing);
	}
	
	public function sql_or_like($column = FALSE, $value = FALSE, $wildcard_position = FALSE, $overwrite_existing = FALSE)
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('or_like', $column, $value, $wildcard_position, $overwrite_existing);
	}
	
	public function sql_not_like($column = FALSE, $value = FALSE, $wildcard_position = FALSE, $overwrite_existing = FALSE)
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('not_like', $column, $value, $wildcard_position, $overwrite_existing);
	}
	
	public function sql_or_not_like($column = FALSE, $value = FALSE, $wildcard_position = FALSE, $overwrite_existing = FALSE)
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('or_not_like', $column, $value, $wildcard_position, $overwrite_existing);
	}
	
	public function sql_join($column = FALSE, $join_on = FALSE, $join_type = FALSE, $overwrite_existing = FALSE)
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('join', $column, $join_on, $join_type, $overwrite_existing);
	}
	
	public function sql_order_by($column = FALSE, $sort_direction = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('order_by', $column, $sort_direction, FALSE, $overwrite_existing);
	}
	
	public function sql_group_by($columns = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('group_by', $columns, FALSE, FALSE, $overwrite_existing);
	}
	
	public function sql_limit($limit = FALSE, $offset = FALSE) 
	{
		$this->CI->flexi_auth_lite_model->set_sql_to_var('limit', $limit, $offset);
	}
	
	/**
	 * sql_clear
	 * Clears all current data stored in flexi auths SQL statements.
	 */	
	public function sql_clear() 
	{
		$this->CI->flexi_auth_lite_model->clear_arg_sql();
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MESSAGES AND ERRORS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_status_message
	 * Set a status message to be displayed to user.
	 *
	 * @return void
	 * @author Rob Hussey
	 */	
	public function set_status_message($status_message = FALSE, $target_user = 'public', $overwrite_existing = FALSE)
	{
		return $this->CI->flexi_auth_lite_model->set_status_message($status_message, $target_user, $overwrite_existing);
	}
	
	/**
	 * clear_status_messages
	 * Clears all status messages.
	 * Get any status message(s) that may have been set by recently run functions. 
	 *
	 * @return void
	 * @author Rob Hussey
	 */	
	public function clear_status_messages()
	{
		$this->CI->auth->status_messages = array('public' => array(), 'admin' => array());
		return TRUE;
	}

	/**
	 * status_messages
	 * Get any status message(s) that may have been set by recently run functions. 
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function status_messages($target_user = 'admin', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		return $this->CI->flexi_auth_lite_model->status_messages($target_user, $prefix_delimiter, $suffix_delimiter);
	}

	/**
	 * set_error_message
	 * Set an error message to be displayed to user.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function set_error_message($error_message, $target_user = 'admin', $overwrite_existing = FALSE)
	{
		// If $target_user exactly equals TRUE, set the target user as public.
		$target_user = ($target_user === TRUE) ? 'public' : $target_user;
		
		return $this->CI->flexi_auth_lite_model->set_error_message($error_message, $target_user, $overwrite_existing);
	}
	
	/**
	 * clear_error_messages
	 * Clears all error messages.
	 *
	 * @return void
	 * @author Rob Hussey
	 */	
	public function clear_error_messages()
	{
		$this->CI->auth->error_messages = array('public' => array(), 'admin' => array());
		return TRUE;
	}

	/**
	 * error_messages
	 * Get any error message(s) that may have been set by recently run functions. 
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function error_messages($target_user = 'admin', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		return $this->CI->flexi_auth_lite_model->error_messages($target_user, $prefix_delimiter, $suffix_delimiter);
	}
	
	/**
	 * clear_messages
	 * Clears all status and error messages.
	 *
	 * @return void
	 * @author Rob Hussey
	 */	
	public function clear_messages()
	{
		$this->CI->auth->status_messages = array('public' => array(), 'admin' => array());
		$this->CI->auth->error_messages = array('public' => array(), 'admin' => array());
		return TRUE;
	}	
	
	/**
	 * get_messages_array
	 * Get any operational function messages and groups them into a status and error array.
	 * An additional array key named 'type' is also returned to clearly indicate what message types are returned.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function get_messages_array($target_user = 'admin', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		$messages['status'] = $this->CI->flexi_auth_lite_model->status_messages($target_user, $prefix_delimiter, $suffix_delimiter);
		$messages['errors'] = $this->CI->flexi_auth_lite_model->error_messages($target_user, $prefix_delimiter, $suffix_delimiter);
		
		// Set a message type identifier to state whether they are either status, error or mixed messages.
		if (! empty($messages['status']) && empty($messages['errors']))
		{
			$messages['type'] = 'status';
		}
		else if (empty($messages['status']) && ! empty($messages['errors']))
		{
			$messages['type'] = 'error';
		}
		else if (! empty($messages['status']) && ! empty($messages['errors']))
		{
			$messages['type'] = 'mixed';
		}
		else
		{
			$messages['type'] = FALSE;
		}
		
		// If message type is FALSE, no messages are set, so return FALSE.
		return ($messages['type']) ? $messages : FALSE;
	}

	/**
	 * get_messages
	 * Get any operational function messages whether of status or error type and format their output with delimiters.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function get_messages($target_user = 'admin', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		$messages = $this->get_messages_array($target_user, $prefix_delimiter, $suffix_delimiter);
		
		return ($messages) ? $messages['status'].$messages['errors'] : FALSE;
	}	
}

/* End of file flexi_auth_lite.php */
/* Location: ./application/controllers/flexi_auth_lite.php */