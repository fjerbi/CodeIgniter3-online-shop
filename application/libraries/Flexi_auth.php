<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name: flexi auth
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
* Filou Tschiemer (User Group Privileges)
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
* Released: 13/09/2012
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

// Load the flexi auth Lite library to allow it to be extended.
load_class('Flexi_auth_lite', 'libraries', FALSE);

class Flexi_auth extends Flexi_auth_lite
{
	public function __construct()
	{
		parent::__construct();
		
		$this->CI->load->model('flexi_auth_model');
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOGIN / VALIDATION FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * login
	 * Verifies a users identity and password, if valid, they are logged in.
	 *
	 * @return void
	 * @author Mathew Davies
	 */
	public function login($identity = FALSE, $password = FALSE, $remember_user = FALSE) 
	{
		if ($this->CI->flexi_auth_model->login($identity, $password, $remember_user))
		{
			$this->CI->flexi_auth_model->set_status_message('login_successful', 'config');
			return TRUE;
		}

		// If no specific error message has been set, set a generic error.
		if (! $this->CI->flexi_auth_model->error_messages())
		{
			$this->CI->flexi_auth_model->set_error_message('login_unsuccessful', 'config');
		}
		
		return FALSE;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * ip_login_attempts_exceeded
	 * Validates whether the number of failed login attempts from a unique IP address has exceeded a defined limit.
	 * The function can be used in conjunction with showing a Captcha for users repeatedly failing login attempts.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function ip_login_attempts_exceeded()
	{
		return $this->CI->flexi_auth_model->ip_login_attempts_exceeded();
	}
	
	/**
	 * recaptcha
	 * Generates the html for Google reCAPTCHA.
	 * Note: If the reCAPTCHA is located on an SSL secured page (https), set $ssl = TRUE.
	 *
	 * @return string
	 * @author Rob Hussey
	 */
	public function recaptcha($ssl = FALSE)
	{
		return $this->CI->flexi_auth_model->recaptcha($ssl);
	}
	
	/**
	 * validate_recaptcha
	 * Validates if a Google reCAPTCHA answer submitted via http POST data is correct.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function validate_recaptcha()
	{
		return $this->CI->flexi_auth_model->validate_recaptcha();
	}
	
	/**
	 * math_captcha
	 * Generates a math captcha question and answer.
	 * The question is returned as a string, whilst the answer is set as a CI flash session. 
	 * Use the 'validate_math_captcha()' function to validate the users submitted answer.
	 *
	 * @return string
	 * @author Rob Hussey
	 */
	public function math_captcha()
	{
		$captcha = $this->CI->flexi_auth_model->math_captcha();
		
		$this->CI->session->set_flashdata($this->CI->auth->session_name['math_captcha'], $captcha['answer']);
		
		return $captcha['equation'];
	}
	
	/**
	 * validate_math_captcha
	 * Validates if a submitted math captcha answer is correct.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function validate_math_captcha($answer = FALSE)
	{
		return ($answer == $this->CI->session->flashdata($this->CI->auth->session_name['math_captcha']));
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * min_password_length
	 * Gets the minimum valid password character length.
	 *
	 * @return int
	 * @author Rob Hussey
	 */
	public function min_password_length()
	{
		return $this->CI->auth->auth_security['min_password_length'];
	}
	
	/**
	 * valid_password_chars
	 * Validate whether the submitted password only contains valid characters defined by the config file.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function valid_password_chars($password = FALSE)
	{
		return (bool) preg_match("/^[".$this->CI->auth->auth_security['valid_password_chars']."]+$/i", $password);
	}
	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// USER TASK FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * activate_user
	 * Activates a users account allowing them to login to their account. 
	 * If $verify_token = TRUE, a valid $activation_token must also be submitted.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function activate_user($user_id, $activation_token = FALSE, $verify_token = TRUE)
	{
		if ($this->CI->flexi_auth_model->activate_user($user_id, $activation_token, $verify_token))
		{
			$this->CI->flexi_auth_model->set_status_message('activate_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('activate_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * deactivate_user
	 * Deactivates a users account, preventing them from logging in.
	 *
	 * @return void
	 * @author Mathew Davies
	 */
	public function deactivate_user($user_id)
	{
		if ($this->CI->flexi_auth_model->deactivate_user($user_id))
		{
			$this->CI->flexi_auth_model->set_status_message('deactivate_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('deactivate_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * resend_activation_token
	 * Resends user a new activation token incase they have lost the previous one.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function resend_activation_token($identity) 
	{
		// Get primary identity.
		$identity = $this->CI->flexi_auth_model->get_primary_identity($identity);
		
		if (empty($identity))
		{
			$this->CI->flexi_auth_model->set_error_message('activation_email_unsuccessful', 'config');
			return FALSE;
		}
		
		// Get user information.
		$sql_select = array(
			$this->CI->auth->tbl_col_user_account['id'],
			$this->CI->auth->tbl_col_user_account['active']
		);
		
		$sql_where[$this->CI->auth->primary_identity_col] = $identity;
		
		$user = $this->CI->flexi_auth_model->get_users($sql_select, $sql_where)->row();

		$user_id = $user->{$this->CI->auth->database_config['user_acc']['columns']['id']};
		$active_status = $user->{$this->CI->auth->database_config['user_acc']['columns']['active']};		
		
		// If account is already activated.
		if ($active_status == 1)
		{
			$this->CI->flexi_auth_model->set_status_message('account_already_activated', 'config');
			return TRUE;
		}
		// Else, run the deactivate_user() function to reset the users activation token.
		else if ($this->CI->flexi_auth_model->deactivate_user($user_id))
		{
			// Get user information.
			$sql_select = array(
				$this->CI->auth->primary_identity_col,
				$this->CI->auth->tbl_col_user_account['activation_token'],
				$this->CI->auth->tbl_col_user_account['email']
			);
			$sql_where[$this->CI->auth->primary_identity_col] = $identity;
			$user = $this->CI->flexi_auth_model->get_users($sql_select, $sql_where)->row();
			
			$email = $user->{$this->CI->auth->database_config['user_acc']['columns']['email']}; 
			$activation_token = $user->{$this->CI->auth->database_config['user_acc']['columns']['activation_token']};
			
			// Set email data.
			$email_to = $email;
			$email_title = ' - Account Activation';
		
			$user_data = array(
				'user_id' => $user_id,
				'identity' => $identity,
				'activation_token' => $activation_token
			);
			$template = $this->CI->auth->email_settings['email_template_directory'].$this->CI->auth->email_settings['email_template_activate'];

			if ($this->CI->flexi_auth_model->send_email($email_to, $email_title, $user_data, $template))
			{
				$this->CI->flexi_auth_model->set_status_message('activation_email_successful', 'config');
				return TRUE;
			}
		}
		
		$this->CI->flexi_auth_model->set_error_message('activation_email_unsuccessful', 'config');
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * validate_current_password
	 * Validates a submitted 'Current' password against the database for a specific user. 
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function validate_current_password($current_password, $identity)
	{
		return ($this->CI->flexi_auth_model->verify_password($identity, $current_password));
	}	
	
	/**
	 * change_password
	 * Validates a submitted 'Current' password against the database, if valid, the database is updated with the 'New' password. 
	 *
	 * @return bool
	 * @author Mathew Davies
	 */
	public function change_password($identity, $current_password, $new_password)
	{
		if ($this->CI->flexi_auth_model->change_password($identity, $current_password, $new_password))
		{
			$this->CI->flexi_auth_model->set_status_message('password_change_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('password_change_unsuccessful', 'config');
		return FALSE;
	}	
	
	/**
	 * forgotten_password
	 * Sends the user an email containing a link the user must click to verify they have requested to change their forgotten password.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function forgotten_password($identifier) 
	{
		// Get users primary identity.
		if (!$identity = $this->CI->flexi_auth_model->get_primary_identity($identifier))
		{
			$this->CI->flexi_auth_model->set_error_message('email_forgot_password_unsuccessful', 'config');
			return FALSE;
		}
	
		if ($this->CI->flexi_auth_model->forgotten_password($identity))
		{
			// Get user information.
			$sql_select = array(
				$this->CI->auth->tbl_col_user_account['id'],
				$this->CI->auth->tbl_col_user_account['email'],
				$this->CI->auth->tbl_col_user_account['forgot_password_token']
			);			
			$sql_where[$this->CI->auth->primary_identity_col] = $identity;
			
			$user = $this->CI->flexi_auth_model->get_users($sql_select, $sql_where)->row();
			$user_id = $user->{$this->CI->auth->database_config['user_acc']['columns']['id']};
			$forgotten_password_token = $user->{$this->CI->auth->database_config['user_acc']['columns']['forgot_password_token']}; 

			// Set email data.
			$email_to = $user->{$this->CI->auth->database_config['user_acc']['columns']['email']};
			$email_title = ' - Forgotten Password Verification';
			
			$user_data = array(
				'user_id' => $user_id,
				'identity' => $identity,
				'forgotten_password_token' => $forgotten_password_token
			);
			$template = $this->CI->auth->email_settings['email_template_directory'].$this->CI->auth->email_settings['email_template_forgot_password'];
			
			if ($this->CI->flexi_auth_model->send_email($email_to, $email_title, $user_data, $template))
			{
				$this->CI->flexi_auth_model->set_status_message('email_forgot_password_successful', 'config');
				return TRUE;
			}
		}
		
		$this->CI->flexi_auth_model->set_error_message('email_forgot_password_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * validate_forgotten_password
	 * Validates a forgotten password token that was passed by clicking a link from a 'forgotten_password()' function email.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function validate_forgotten_password($user_id, $token)
	{
		return $this->CI->flexi_auth_model->validate_forgotten_password_token($user_id, $token);
	}

	/**
	 * forgotten_password_complete
	 * This function is similar to the above 'validate_forgotten_password()' function, however, if validated the function also updates the database
	 * with a new password, then if defined via $send_email, an email will be sent to the user containing the new password.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function forgotten_password_complete($user_id, $forgot_password_token, $new_password = FALSE, $send_email = FALSE)
	{
		if ($this->CI->flexi_auth_model->validate_forgotten_password_token($user_id, $forgot_password_token))
		{
			$sql_select = array(
				$this->CI->auth->primary_identity_col,
				$this->CI->auth->tbl_col_user_account['salt'],
				$this->CI->auth->tbl_col_user_account['email']
			);
			
			$sql_where[$this->CI->auth->tbl_col_user_account['id']] = $user_id;
			
			$user = $this->CI->flexi_auth_model->get_users($sql_select, $sql_where)->row();

			if (!is_object($user))
			{
				$this->CI->flexi_auth_model->set_error_message('password_change_unsuccessful', 'config');
				return FALSE;
			}

			$identity = $user->{$this->CI->auth->db_settings['primary_identity_col']};
			$database_salt = $user->{$this->CI->auth->database_config['user_acc']['columns']['salt']};

			// If no new password is set via $new_password, the function will generate a new one.
			$new_password = $this->CI->flexi_auth_model->change_forgotten_password($user_id, $forgot_password_token, $new_password, $database_salt);
			
			// Send user email with new password if function variable $send_email = TRUE.
			if ($send_email)
			{
				// Set email data
				$email_to = $user->{$this->CI->auth->database_config['user_acc']['columns']['email']};
				$email_title = ' - New Password';
			
				$user_data = array(
					'identity' => $identity,
					'new_password' => $new_password
				);
				$template = $this->CI->auth->email_settings['email_template_directory'].
					$this->CI->auth->email_settings['email_template_forgot_password_complete'];

				if ($this->CI->flexi_auth_model->send_email($email_to, $email_title, $user_data, $template))
				{
					$this->CI->flexi_auth_model->set_status_message('email_new_password_successful', 'config');
					return TRUE;
				}
			}
			// If new password is not set to be emailed, but has been successfully changed.
			else if ($new_password)
			{
				$this->CI->flexi_auth_model->set_status_message('password_change_successful', 'config');
				return TRUE;
			}
		}
		
		$this->CI->flexi_auth_model->set_error_message('password_token_invalid', 'config');
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * update_email_via_verification
	 * Sends the user a verification email to their new email address, the user must then click a link within the email to update their accounts email address.
	 * This will help prevent a user accidentally locking themselves out of their account if they forget their password, as they can request a new password
	 * to be sent to their 'verified' email address rather than a misspelt email address.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function update_email_via_verification($user_id, $new_email) 
	{
		if ($this->CI->flexi_auth_model->set_update_email_token($user_id, $new_email))
		{
			// Get user information.
			$sql_select = array(
				$this->CI->auth->tbl_col_user_account['email'],
				$this->CI->auth->tbl_col_user_account['update_email_token']
			);
			$sql_where[$this->CI->auth->tbl_col_user_account['id']] = $user_id;
			
			$user = $this->CI->flexi_auth_model->get_users($sql_select, $sql_where)->row();

			if (!is_object($user))
			{
				$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
				return FALSE;
			}
			
			$current_email = $user->{$this->CI->auth->database_config['user_acc']['columns']['email']};
			$update_email_token = $user->{$this->CI->auth->database_config['user_acc']['columns']['update_email_token']};
			
			// Send email activation email.
			$email_to = $new_email;
			$email_title = ' - Email Change Verification';
		
			$user_data = array(
				'user_id' => $user_id,
				'current_email' => $current_email,
				'new_email' => $new_email,
				'update_email_token' => $update_email_token
			);
			
			$template = $this->CI->auth->email_settings['email_template_directory'].$this->CI->auth->email_settings['email_template_update_email'];
			
			if ($this->CI->flexi_auth_model->send_email($email_to, $email_title, $user_data, $template))
			{
				$this->CI->flexi_auth_model->set_status_message('email_activation_email_successful', 'config');
				return TRUE;
			}
			else
			{
				$this->CI->flexi_auth_model->set_error_message('email_activation_email_unsuccessful', 'config');
				return FALSE;
			}
		}
		
		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * verify_updated_email
	 * Verifies a submitted $update_email_token and updates their account with the new email address.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function verify_updated_email($user_id, $update_email_token)
	{
		if ($this->CI->flexi_auth_model->verify_updated_email($user_id, $update_email_token))
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return TRUE;
		}
		
		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// USER MANAGEMENT / CRUD FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * insert_user
	 * Inserts user account and profile data, returning the users new id.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function insert_user($email, $username = FALSE, $password, $user_data, $group_id = FALSE, $activate = FALSE) 
	{
		$user_id = $this->CI->flexi_auth_model->insert_user($email, $username, $password, $user_data, $group_id);

		if ($user_id)
		{
			// Check whether to auto activate the user.
			if ($activate)
			{
				// If an account activation time limit is set by the config file, retain activation token.
				$clear_token = ($this->CI->auth->auth_settings['account_activation_time_limit'] > 0) ? FALSE : TRUE;
				
				$this->CI->flexi_auth_model->activate_user($user_id, FALSE, FALSE, $clear_token);		
			}
			
			$sql_select = array(
				$this->CI->auth->primary_identity_col,
				$this->CI->auth->tbl_col_user_account['activation_token']
			);
			
			$sql_where[$this->CI->auth->tbl_col_user_account['id']] = $user_id;
			
			$user = $this->CI->flexi_auth_model->get_users($sql_select, $sql_where)->row(); 

			if (!is_object($user))
			{
				$this->CI->flexi_auth_model->set_error_message('account_creation_unsuccessful', 'config');
				return FALSE;
			}
			
			$identity = $user->{$this->CI->auth->db_settings['primary_identity_col']};
			$activation_token = $user->{$this->CI->auth->database_config['user_acc']['columns']['activation_token']};
			
			// Prepare account activation email.
			// If the $activation_token is not empty, the account must be activated via email before the user can login.
			if (!empty($activation_token))
			{
				// Set email data.
				$email_to = $email;
				$email_title = ' - Account Activation';
			
				$user_data = array(
					'user_id' => $user_id,
					'identity' => $identity,
					'activation_token' => $activation_token
				);
				$template = $this->CI->auth->email_settings['email_template_directory'].$this->CI->auth->email_settings['email_template_activate'];

				if ($this->CI->flexi_auth_model->send_email($email_to, $email_title, $user_data, $template))
				{
					$this->CI->flexi_auth_model->set_status_message('activation_email_successful', 'config');
					return $user_id;
				}

				$this->CI->flexi_auth_model->set_error_message('activation_email_unsuccessful', 'config');
				return FALSE;
			}
			
			$this->CI->flexi_auth_model->set_status_message('account_creation_successful', 'config');
			return $user_id;
		}
		else
		{
			$this->CI->flexi_auth_model->set_error_message('account_creation_unsuccessful', 'config');
			return FALSE;
		}
	}
	
	/**
	 * update_user
	 * Updates the main user account table and any linked custom user tables with the submitted data.
	 *
	 * @return void
	 * @author Phil Sturgeon
	 */
	public function update_user($user_id, $user_data)
	{
		if ($this->CI->flexi_auth_model->update_user($user_id, $user_data))
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * delete_user
	 * Deletes a user account and all linked custom user tables from the database.
	 *
	 * @return void
	 * @author Phil Sturgeon
	 */
	public function delete_user($user_id)
	{
		if ($this->CI->flexi_auth_model->delete_user($user_id))
		{
			$this->CI->flexi_auth_model->set_status_message('delete_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('delete_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * delete_unactivated_users
	 * Delete users that have not activated their account within a set time period.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function delete_unactivated_users($inactive_days = 28, $sql_where = FALSE)
	{
		$users = $this->CI->flexi_auth_model
			->get_unactivated_users($inactive_days, $this->CI->auth->tbl_col_user_account['id'], $sql_where);
				
		if ($users->num_rows() > 0)
		{
			$users = $users->result_array();
		
			foreach ($users as $user)
			{
				$user_id = $user[$this->CI->auth->database_config['user_acc']['columns']['id']];
				$this->CI->flexi_auth_model->delete_user($user_id);
			}
			$this->CI->flexi_auth_model->set_status_message('delete_successful', 'config');
			return TRUE;
		}
		
		$this->CI->flexi_auth_model->set_error_message('delete_unsuccessful', 'config');
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * insert_custom_user_data
	 * Inserts data into a custom user table and returns the table name and row id of each record inserted.
	 *
	 * @return array/void
	 * @author Rob Hussey
	 */
	public function insert_custom_user_data($user_id = FALSE, $custom_data = FALSE)
	{
		if ($row_data = $this->CI->flexi_auth_model->insert_custom_user_data($user_id, $custom_data))
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return $row_data;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * update_custom_user_data
	 * Updates a custom user table with any submitted data.
	 * To identify which row to update, a table name and row id can be submitted, alternatively, data can be updated by submitting custom data
	 * that contains an array key and value of the primary key column and row id from any of the custom tables set via the config file.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function update_custom_user_data($table = FALSE, $row_id = FALSE, $custom_data = FALSE)
	{
		if ($this->CI->flexi_auth_model->update_custom_user_data($table, $row_id, $custom_data))
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * delete_custom_user_data
	 * Deletes a data row from a custom user table.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function delete_custom_user_data($table = FALSE, $row_id = FALSE)
	{
		if ($this->CI->flexi_auth_model->delete_custom_user_data($table, $row_id))
		{
			$this->CI->flexi_auth_model->set_status_message('delete_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('delete_unsuccessful', 'config');
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * insert_group
	 * Inserts a new user group to the database. If the group has admin privileges this can be set using $is_admin = TRUE.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function insert_group($name, $description = NULL, $is_admin = FALSE, $custom_data = array())
	{
		if ($group_id = $this->CI->flexi_auth_model->insert_group($name, $description, $is_admin, $custom_data));
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful','config');
			return $group_id;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * update_group
	 * Updates a user group with any submitted data.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function update_group($group_id, $group_data)
	{
		if ($this->CI->flexi_auth_model->update_group($group_id, $group_data))
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * delete_group
	 * Deletes a group from the user group table.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function delete_group($sql_where)
	{
		if ($this->CI->flexi_auth_model->delete_group($sql_where))
		{
			$this->CI->flexi_auth_model->set_status_message('delete_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('delete_unsuccessful', 'config');
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * insert_privilege
	 * Inserts a new user privilege to the database.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function insert_privilege($name, $description = NULL, $custom_data = array())
	{
		if ($privilege_id = $this->CI->flexi_auth_model->insert_privilege($name, $description, $custom_data));
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return $privilege_id;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * update_privilege
	 * Updates a user privilege with any submitted data.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function update_privilege($privilege_id, $privilege_data)
	{
		if ($this->CI->flexi_auth_model->update_privilege($privilege_id, $privilege_data))
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * delete_privilege
	 * Deletes a privilege from the user privilege table.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function delete_privilege($sql_where)
	{
		if ($this->CI->flexi_auth_model->delete_privilege($sql_where))
		{
			$this->CI->flexi_auth_model->set_status_message('delete_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('delete_unsuccessful', 'config');
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * insert_privilege_user
	 * Inserts a new user privilege user to the database.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function insert_privilege_user($user_id, $privilege_id)
	{
		if ($privilege_id = $this->CI->flexi_auth_model->insert_privilege_user($user_id, $privilege_id));
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return $privilege_id;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * delete_privilege_user
	 * Deletes a user from the user privilege user table.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function delete_privilege_user($sql_where)
	{
		if ($this->CI->flexi_auth_model->delete_privilege_user($sql_where))
		{
			$this->CI->flexi_auth_model->set_status_message('delete_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('delete_unsuccessful', 'config');
		return FALSE;
	}
        
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
        
	/**
	 * insert_user_group_privilege
	 * Inserts a new user group privilege to the database.
	 *
	 * @return void
	 * @author Rob Hussey / Filou Tschiemer
	 */
	public function insert_user_group_privilege($group_id, $privilege_id)
	{
		if ($privilege_id = $this->CI->flexi_auth_model->insert_user_group_privilege($group_id, $privilege_id));
		{
			$this->CI->flexi_auth_model->set_status_message('update_successful', 'config');
			return $privilege_id;
		}

		$this->CI->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
		return FALSE;
	}
       
	/**
	 * delete_user_group_privilege
	 * Deletes a user group privilege from the user privilege group table.
	 *
	 * @return bool
	 * @author Rob Hussey / Filou Tschiemer
	 */
	public function delete_user_group_privilege($sql_where)
	{
		if ($this->CI->flexi_auth_model->delete_user_group_privilege($sql_where))
		{
			$this->CI->flexi_auth_model->set_status_message('delete_successful', 'config');
			return TRUE;
		}

		$this->CI->flexi_auth_model->set_error_message('delete_unsuccessful', 'config');
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * identity_available
	 * Returns whether a user identity is available in the database. 
	 * The identity columns are defined via the $config['database']['settings']['identity_cols'] variable in the config file.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function identity_available($identity = FALSE, $user_id = FALSE)
	{
		return $this->CI->flexi_auth_model->identity_available($identity, $user_id);
	}
	
	/**
	 * email_available
	 * Returns whether an email address is available in the database. 
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function email_available($email = FALSE, $user_id = FALSE)
	{
		return $this->CI->flexi_auth_model->email_available($email, $user_id);
	}
	
	/**
	 * username_available
	 * Returns whether a username is available in the database. 
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function username_available($username = FALSE, $user_id = FALSE)
	{
		return $this->CI->flexi_auth_model->username_available($username, $user_id);
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// GET USER / GROUP / PRIVILEGE FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * search_users_query
	 * Search user table using SQL WHERE 'x' LIKE '%y%' statement
	 * Note: Additional WHERE statements can be passed using the $sql_where parameter.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function search_users_query($search_query = FALSE, $exact_match = FALSE, $sql_select = FALSE, $sql_where = FALSE, $sql_group_by = TRUE)
	{
		return $this->CI->flexi_auth_model->search_users($search_query, $exact_match, $sql_select, $sql_where, $sql_group_by);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_users_group_query
	 * Gets records from the user group table typically for a filtered set of users. 
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_users_group_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$sql_select = ($sql_select) ? $sql_select : $this->CI->auth->tbl_user_group.'.*';

		if (! $sql_where)
		{
			$sql_where = array($this->CI->auth->tbl_col_user_account['id'] => $this->CI->auth->session_data[$this->CI->auth->session_name['user_id']]);
		}
	
		return $this->CI->flexi_auth_model->get_users($sql_select, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_unactivated_users_query
	 * Get users that have not activated their account within a set time period.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function get_unactivated_users_query($inactive_days = 28, $sql_select = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_auth_model->get_unactivated_users($inactive_days, $sql_select, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
	/**
	 * get_groups_query
	 * Returns a list of user groups matching the $sql_where condition.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_groups_query($sql_select = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_auth_model->get_groups($sql_select, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
	/**
	 * get_privileges_query
	 * Returns a list of user privileges matching the $sql_where condition.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_privileges_query($sql_select = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_auth_model->get_privileges($sql_select, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_user_privileges_query
	 * Returns a users privileges using their session user_id by default.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_user_privileges_query($sql_select = FALSE, $sql_where = FALSE)
	{
		if (! $sql_where)
		{
			$sql_where = array($this->CI->auth->tbl_col_user_privilege_users['user_id'] => 
				$this->CI->auth->session_data[$this->CI->auth->session_name['user_id']]);
		}
	
		return $this->CI->flexi_auth_model->get_user_privileges($sql_select, $sql_where);
	}
        
        
	/**
	 * get_user_group_privileges_query
	 * Returns a user groups privileges using a users session group_id by default.
	 *
	 * @return object
	 * @author Rob Hussey / Filou Tschiemer
	 */
	public function get_user_group_privileges_query($sql_select = FALSE, $sql_where = FALSE)
	{
		if (! $sql_where)
		{
			$sql_where = array($this->CI->auth->tbl_col_user_privilege_groups['group_id'] => 
				key($this->CI->auth->session_data[$this->CI->auth->session_name['group']]));
		}
	
		return $this->CI->flexi_auth_model->get_user_group_privileges($sql_select, $sql_where);
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// EMAIL FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * send_email
	 * Emails a user a predefined email template.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function send_email($email_to = FALSE, $email_title = FALSE, $template = FALSE, $email_data = array())
	{
		if (!$email_to || !$template || empty($email_data))
		{
			return FALSE;
		}
	
		$template = $this->CI->auth->email_settings['email_template_directory'].$template;

		return $this->CI->flexi_auth_model->send_email($email_to, $email_title, $email_data, $template);
	}
	
	/**
	 * template_data
	 * flexi auth sends emails for a number of functions, this function can set additional data variables that can then be used by the template files.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function template_data($template, $template_data)
	{
		if (empty($template) && empty($template_data))
		{
			return FALSE;
		}

		// Set template data placeholder.
		$data = $this->CI->auth->template_data;

		// Change default template if set
		if (!empty($template))
		{
			$data['template'] = $template;
		}

		// Add additional template data if set
		if (!empty($template_data))
		{
			$data['template_data'] = $template_data;
		}
		
		$this->CI->auth->template_data = $data;
	}
}

/* End of file flexi_auth.php */
/* Location: ./application/controllers/flexi_auth.php */