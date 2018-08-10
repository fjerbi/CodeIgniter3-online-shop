<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name: flexi auth Config
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
* Released: 13/09/2012
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DATABASE NAMES / ALIASES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * If required, it is possible to set your own name for each database table and column.
	 * Note: Only change the name in the apostrophes (after the '=' sign), and not the $config array names.
	 * Example: Change $config['database']['user_acc']['columns']['id'] = 'uacc_id' to $config['database']['user_acc']['columns']['id'] = 'new_column_name'
	 *
	 * Quick Reference Guide on array structuring
	 * ['table'] = table name, ['primary_key'] = primary key of table used in joins,  ['join'] = column used to join table, ['columns']['xxx'] = specific column name
	*/ 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Primary User Account Table
	 * The primary user account table contains all of the columns required for different functions within the flexi auth library.
	 *
	 * All columns are required.
	*/ 
	$config['database']['user_acc']['table'] = 'user_accounts';
	$config['database']['user_acc']['join'] = 'user_accounts.uacc_id';
	$config['database']['user_acc']['columns']['id'] = 'uacc_id';
	$config['database']['user_acc']['columns']['group_id'] = 'uacc_group_fk';
	$config['database']['user_acc']['columns']['email'] = 'uacc_email';
	$config['database']['user_acc']['columns']['username'] = 'uacc_username'; 
	$config['database']['user_acc']['columns']['password'] = 'uacc_password';
	$config['database']['user_acc']['columns']['ip_address'] = 'uacc_ip_address';
	$config['database']['user_acc']['columns']['salt'] = 'uacc_salt';
	$config['database']['user_acc']['columns']['activation_token'] = 'uacc_activation_token';
	$config['database']['user_acc']['columns']['forgot_password_token'] = 'uacc_forgotten_password_token';
	$config['database']['user_acc']['columns']['forgot_password_expire'] = 'uacc_forgotten_password_expire';
	$config['database']['user_acc']['columns']['update_email_token'] = 'uacc_update_email_token';
	$config['database']['user_acc']['columns']['update_email'] = 'uacc_update_email';
	$config['database']['user_acc']['columns']['active'] = 'uacc_active';
	$config['database']['user_acc']['columns']['suspend'] = 'uacc_suspend';
	$config['database']['user_acc']['columns']['failed_logins'] = 'uacc_fail_login_attempts';
	$config['database']['user_acc']['columns']['failed_login_ip'] = 'uacc_fail_login_ip_address';
	$config['database']['user_acc']['columns']['failed_login_ban_date'] = 'uacc_date_fail_login_ban';
	$config['database']['user_acc']['columns']['last_login_date'] = 'uacc_date_last_login';
	$config['database']['user_acc']['columns']['date_added'] = 'uacc_date_added';
	
	// Custom columns can be added to the main user account table to enable library functions to handle additional custom data stored within the table.
	$config['database']['user_acc']['custom_columns'] = array(
		### Example : 'date_modified', 'modified_user_id' etc.
	); 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * User Group Table
	 * The user group table is used to allocate a group classification to users, typically this is used to group users as either admins or public users.
	 * The grouped users can then be delivered content specific to their group, or restricted access to set areas - i.e. an admin only area.
	 * 
	 * All columns are required.
	*/ 
	$config['database']['user_group']['table'] = 'user_groups';
	$config['database']['user_group']['join'] = 'user_groups.ugrp_id';
	$config['database']['user_group']['columns']['id'] = 'ugrp_id';
	$config['database']['user_group']['columns']['name'] = 'ugrp_name';
	$config['database']['user_group']['columns']['description'] = 'ugrp_desc';
	$config['database']['user_group']['columns']['admin'] = 'ugrp_admin';
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * User Privilege Table
	 * The user privilege table is used to allocate role privileges to users.
	 * Whilst very similar to user groups, multiple privileges can be assigned to a user, the users privilege (and group if desired) can then be 
	 *  looked up to verify if a user has permission to perform an action or access specific data.
	 * For example, 2 users could be in an 'Moderator' group, 1 of the users could be allowed to update data, whilst the other could only view the data. 
	 * 
	 * All columns are required.
	*/ 
	$config['database']['user_privileges']['table'] = 'user_privileges';
	$config['database']['user_privileges']['columns']['id'] = 'upriv_id';
	$config['database']['user_privileges']['columns']['name'] = 'upriv_name';
	$config['database']['user_privileges']['columns']['description'] = 'upriv_desc';
	
	/**
	 * User Privilege Users Table
	 * The user privilege user table is used to assign privileges to users. Multiple privileges can be assigned to a user.
	 * 
	 * All columns are required.
	*/ 
	$config['database']['user_privilege_users']['table'] = 'user_privilege_users';
	$config['database']['user_privilege_users']['columns']['id'] = 'upriv_users_id';
	$config['database']['user_privilege_users']['columns']['user_id'] = 'upriv_users_uacc_fk';
	$config['database']['user_privilege_users']['columns']['privilege_id'] = 'upriv_users_upriv_fk';

	/**
	 * User Privilege Groups Table
	 * The user privilege group table is used to assign privileges to user groups. Multiple privileges can be assigned to a user group.
	 * 
	 * All columns are required.
	*/ 
	$config['database']['user_privilege_groups']['table'] = 'user_privilege_groups';
	$config['database']['user_privilege_groups']['columns']['id'] = 'upriv_groups_id';
	$config['database']['user_privilege_groups']['columns']['group_id'] = 'upriv_groups_ugrp_fk';
	$config['database']['user_privilege_groups']['columns']['privilege_id'] = 'upriv_groups_upriv_fk';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * User Login Session Table
	 * The user login session table is used to validate user login credentials. For security purposes, if a users credentitals do not match those  
	 * stored within the table, the user is automatically logged out.
	 *
	 * All columns are required.
	*/ 
	$config['database']['user_sess']['table'] = 'user_login_sessions';
	$config['database']['user_sess']['join'] = 'user_login_sessions.usess_uacc_fk';
	$config['database']['user_sess']['columns']['user_id'] = 'usess_uacc_fk';
	$config['database']['user_sess']['columns']['series'] = 'usess_series';
	$config['database']['user_sess']['columns']['token'] = 'usess_token';
	$config['database']['user_sess']['columns']['date'] = 'usess_login_date';
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	// Custom User Related Tables
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Additional custom tables that are directly related to the user account table can be included in flexi auth CRUD functions by 
	 * setting their database structure via the the $config['database'] array. 
	 * 
	 * Typically, such examples of a custom table you may wish to link to the user account table would be a user profile table listing the 
	 * users name and contact details etc. 
	 * 
	 * You are not limited to the number of different custom tables you can define.
	 * 
	 * ### Example Custom Table Template ###
	 * $config['database']['custom']['#Array Alias#']['table'] = '#Actual table name#';
	 * $config['database']['custom']['#Array Alias#']['primary_key'] = '#Table primary key#';
	 * $config['database']['custom']['#Array Alias#']['foreign_key'] = '#Table foreign key (Usually the table join column)#';
	 * $config['database']['custom']['#Array Alias#']['join'] = '#Actual table name#.#Foreign key column to main user table "user_acc"#';
	 * $config['database']['custom']['#Array Alias#']['custom_columns'] = array('#Column1#','#Column2#');
	 *
	 * Note: No custom tables are required to use flexi auth and the custom 'User Profile' and 'User Address' tables below are set only as examples.
	*/
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Custom User Profile Table
	 * Example table used to hold profile data on each user.
	 *
	 * Note: This table and all included fields can be expanded upon or removed completely.
	*/ 
	$config['database']['custom']['user_profile']['table'] = 'demo_user_profiles';
	$config['database']['custom']['user_profile']['primary_key'] = 'upro_id';
	$config['database']['custom']['user_profile']['foreign_key'] = 'upro_uacc_fk';
	$config['database']['custom']['user_profile']['join'] = 'demo_user_profiles.upro_uacc_fk';
	$config['database']['custom']['user_profile']['custom_columns'] = array(
		'upro_first_name','upro_last_name','upro_phone','upro_newsletter'
	);

	###+++++++++++++++++++++++++++###
	
	/**
	 * Custom User Address Table
	 * Example table used to hold address data on each user.
	 * By holding this data in a separate table from the profile data table above, a user can save multiple addresses.
	 *
	 * Note: This table and all included fields can be expanded upon or removed completely.
	*/ 
	$config['database']['custom']['user_address']['table'] = 'demo_user_address';
	$config['database']['custom']['user_address']['primary_key'] = 'uadd_id';
	$config['database']['custom']['user_address']['foreign_key'] = 'uadd_uacc_fk';
	$config['database']['custom']['user_address']['join'] = 'demo_user_address.uadd_uacc_fk';
	$config['database']['custom']['user_address']['custom_columns'] = array(
		'uadd_alias','uadd_recipient','uadd_phone','uadd_company','uadd_address_01','uadd_address_02','uadd_city','uadd_county',
		'uadd_post_code','uadd_country'
	);
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DATABASE SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * flexi auth Database Settings
	 * If required, it is possible to set your own column names and data types for some database settings.
	 * 
	 * Note: Only change the value after the '=' sign, and not the $config array names.
	 * Example: Change $config['database']['settings']['example'] = 'example_value_1' to $config['database']['settings']['example'] = 'example_value_2'
	*/ 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Primary User Identity Column
	 * Set the column to be used to primarily identify users.
	 *
	 * Note: The column MUST be either the ['email'] or ['username'] columns from the main user account table, and must contain a unique column name.
	*/ 
	$config['database']['settings']['primary_identity_col'] = 'uacc_email';  
	
	/**
	 * User Identity Columns
	 * Set whether the users email address, username or both are to be used to identify users from data submitted via a login form.
	 * This MUST include the ['primary_identity_col'] column set above (Default 'uacc_email').
	 * If both the email address and username are used, then users will be able to login by submitting either value.
	 * 
	 * Note: The only valid columns are the users email address (Default column name 'uacc_email') or username (Default column name'uacc_username').
	*/ 
	$config['database']['settings']['identity_cols'] = array('uacc_email', 'uacc_username');
	
	/**
	 * User Search Query Columns
	 * Set the table columns that are looked-up by the libraries search_users() function to match users against submitted search query terms.
	 * 
	 * Note: Any column within the user main account, custom or group tables can be added to array
	*/ 
	$config['database']['settings']['search_user_cols'] = array('uacc_email', 'upro_first_name', 'upro_last_name');
	
	/**
	 * Database Date / Time Format
	 * Set a native PHP function to format the date and time correctly to be stored within the user tables. 
	 * Typically this will either be either DATETIME or TIMESTAMP.
	 *
	 * MySQL DATETIME = date('Y-m-d H:i:s');
	 * Unix TIMESTAMP = time();
	 * 
	 * Note: Ensure you consistently use the same data type in all defined flexi auth tables for date and time data.
	*/ 
	$config['database']['settings']['date_time'] = date('Y-m-d H:i:s'); 
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SESSION NAMES / ALIASES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * flexi auth Session
	 * flexi auth uses CI sessions to store and serve authentication data between pages loads.
	 * All flexi auth session data is stored together within one session array, this helps maintain a tidy session structure.
	 * 
	 * If required, it is possible to set your own name for each session variable.
	 * Note: Only change the name in the apostrophes (after the '=' sign), and not the $config array names.
	 * Example: Change $config['sessions']['user_id'] = 'user_id' to $config['sessions']['user_id'] = 'new_session_name'
	*/ 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Auth Session Name
	 * Set the root auth session name saved as an array in the CI session, all other flexi auth session data is then stored within this array.
	*/ 
	$config['sessions']['name'] = 'flexi_auth';
		
	/**
	 * Primary User Indentifier Session
	 * Contains the $config['database']['settings']['primary_identity_col'] column value (Defined above).
	 * This value is then used to internally identify the user when performing CRUD functions.
	*/
	$config['sessions']['user_identifier'] = 'user_identifier';
	
	/**
	 * User Account Data Sessions
	 * Used for performing various CRUD functions.
	*/
	$config['sessions']['user_id'] = 'user_id';
	$config['sessions']['is_admin'] = 'admin';
	$config['sessions']['group'] = 'group';
	$config['sessions']['privileges'] = 'privileges';

	/**
	 * Login Via Password
	 * Indicate whether the user logged in via entering a password or was logged in automatically via the 'Remember me' function.
	*/
	$config['sessions']['logged_in_via_password'] = 'logged_in_via_password';

	/**
	 * Login Session Token
	 * The login session token is used to help validate a users login credentials against a stored database token.
	 * 
	 * Note: Only used when $config['security']['validate_login_onload'] = TRUE (Defined Below)
	*/
	$config['sessions']['login_session_token'] = 'login_session_token'; 
	
	/**
	 * Math Captcha Flash Session
	 * Used to store the answer of a math captcha question, this data is stored only in a CI flash session and so will only be available on the next page and is then deleted.
	*/
	$config['sessions']['math_captcha'] = 'math_captcha';
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// COOKIE NAMES / ALIASES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * flexi auth Cookies
	 * flexi auth uses cookies to store and serve authentication data for the next time a user visits the website.  
	 * 
	 * If required, it is possible to set your own name for each cookie variable.
	 * Note: Only change the name in the apostrophes (after the '=' sign), and not the $config array names.
	 * Example: Change $config['cookies']['user_id'] = 'user_id' to $config['cookies']['user_id'] = 'new_session_name'
	*/ 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
	/**
	 * 'Remember me' Cookies
	 * Used to store 'Remember me' data to automatically log a user in next time they visit the website.
	*/
	$config['cookies']['user_id'] = 'user_id';
	$config['cookies']['remember_series'] = 'remember_series';
	$config['cookies']['remember_token'] = 'remember_token';
	
	/**
	 * Login Session Cookie
	 * The cookie login session token is used to invalidate a users login session when they close their browser by deleting itself.
	 * 
	 * Note: Only used when $config['security']['validate_login_onload'] = TRUE and $config['security']['logout_user_onclose'] = TRUE (Defined Below)
	*/
	$config['cookies']['login_session_token'] = 'login_session_token';
	
	/**
	 * Login Via Password Cookie
	 * The login via password cookie token is used to invalidate a users 'logged in via password' status when they close their browser by deleting itself.
	 * 
	 * Note: Only used when $config['security']['logout_user_onclose'] = FALSE (Defined Below)
	*/
	$config['cookies']['login_via_password_token'] = 'login_via_password_token';

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SECURITY CONFIGURATIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * flexi auth Security Configurations
	 * Many of flexi auths security features are customisable and can even be turned on and off to suit different websites.
	 *
	 * Note: Only change the value after the '=' sign, and not the $config array names.
	 * Example: Change $config['security']['example'] = TRUE to $config['security']['example'] = FALSE
	*/

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	// LOGIN COOKIE AND SESSION SETTINGS 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Set whether login details are validated on every page load.
	 * @param bool
	 *
	 * TRUE = Login credentials are validated against the database everytime a page is loaded, invalid users are logged out automatically.
	 * FALSE = Login credentials are validated only once at time of login and will not expire until CI sessions expire (Defined via CI config file).
	*/
	$config['security']['validate_login_onload'] = TRUE;
	
	/**
	 * Set the lifetime of a user login session in seconds.
	 * @param int
	 *
	 * Example: 60*30 = 30 minutes, 60*60*24 = 1 day, 86400 = 1 day, 0 = Unlimited
	 * Setting the value as '0' would mean the session would not expire until CIs own session value (config['sess_expiration'] in CI config file) expired.
	 *
	 * Note: Only used when $config['security']['validate_login_onload'] = TRUE
	 * !IMPORTANT: 
	 *   If the CI config setting '$config['sess_expiration']' is lower, it will cause the session to expire prior to the 'login_session_expire' value.  
	 *   If 'Remember me' cookies are used, and a users login session expires, they will remain logged in via the 'Remember me' cookie.
	 *   There are then functions within the library to check whether a user is logged in via entering a password, or via a cookie - typically sensitive data should 
	 *   only be available to users logged in via a password, and less sensitive data to users logged in via 'Remember me' cookies.
	*/
	$config['security']['login_session_expire'] = 60*60*3;
	
	/**
	 * Set whether a users login time is extended when their session token is validated (On every page load).
	 * @param bool
	 *
	 * Note: Only used when $config['security']['validate_login_onload'] = TRUE
	*/
	$config['security']['extend_login_session'] = TRUE;
	
	/**
	 * Set whether a user is logged out as soon as the browser is closed.
	 * Creates a cookie with a 0 lifetime that is deleted when the browser is closed.
	 * This invalidates the users session the next time they visit the website as there is no longer a matching cookie.
	 * @param bool
	 *
	 * Note: Only used when $config['security']['validate_login_onload'] = TRUE
	 * !IMPORTANT: 'logout_user_onclose' will also void any 'Remember me' cookies and so both features should not be used together.
	*/
	$config['security']['logout_user_onclose'] = TRUE;

	/**
	 * Set whether a user has their 'logged in via password' status removed as soon as the browser is closed.
	 * If the user enabled the 'Remember me' feature on login, and their session is still valid, they will have a 'logged in via "Remember me"' status on their next visit.
	 * If the user did not enable the 'Remember me' feature on login, they will be logged out on their next visit.
	 *
	 * If this setting is not enabled, a user who has logged in via password will have the same login status if they close the browser and revisit the
	 * site before the login session expires ('login_session_expire').
 	 *
	 * The feature works by creating a cookie with a 0 lifetime that is deleted when the browser is closed.
	 * This invalidates the users session the next time they visit the website as there is no longer a matching cookie.
	 * @param bool
	 *
	 * Note: Only used when $config['security']['logout_user_onclose'] = FALSE
	*/
	$config['security']['unset_password_status_onclose'] = TRUE;
	
	/**
	 * Set the lifetime of a users login cookies in seconds, this includes the 'Remember me' cookies.
	 * @param int
	 *
	 * Example: 60*60*24 = 24 hours, 60*60*24*14 = 14 days, 86400 = 1 day
	*/
	$config['security']['user_cookie_expire'] = 60*60*24*14;
	
	/**
	 * Set whether a users 'Remember me' login cookies have their lifetime extended when their session token is validated.
	 * @param bool
	*/
	$config['security']['extend_cookies_on_login'] = TRUE;

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	// PASSWORD SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Set the minimum required characters for the users password.
	 * @param int
	*/
	$config['security']['min_password_length'] = 8;
	
	/**
	 * Set which characters are valid for user passwords.
	 * Default allows alpha-numeric, dashes, underscores, periods and commas ('\.\,\-_ a-z0-9').
	 * Note this is a regular expression.
	*/ 
	$config['security']['valid_password_chars'] = '\.\,\-_ a-z0-9';

	/**
	 * Set the static (non-database stored) salt used for password and hash token generation.
	 * @param string
	 *
	 * !IMPORTANT: 
	 *	Do NOT change this salt once users have started registering accounts as their passwords will not work without the original salt.
	 *	CHANGE THE DEFAULT STATIC SALT SET BELOW TO YOUR OWN RANDOM SET OF CHARACTERS.
	*/
	$config['security']['static_salt'] = 'change-me!';
	
	/**
	 * Set whether a salt is stored in the database and then used for password and hash token generation.
	 * @param bool
	*/
	$config['security']['store_database_salt'] = TRUE;

	/**
	 * Set the length of a stored database salt (See above).
	 * @param int
	 *
 	 * Note: Only used if $config['security']['store_database_salt'] = TRUE
	*/
	$config['security']['database_salt_length'] = 10;
	
	/**
	 * Set the expiry time of unused 'Forgotten Password' tokens.
	 * Users will be required to request a new 'Forgotten Password' token once expired.
	 * @param int
	 *
	 * Example: Time set in minutes, 0 = unlimited, 60*24 = 24 hours, 1440 = 24 hours.
	*/
	$config['security']['expire_forgotten_password'] = 15;

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	// FAILED LOGIN ATTEMPT SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Set a limit to the number of failed login attempts.
	 * Once limit is passed, user is blocked from another attempt until time ban passes (Defined by $config['security']['login_attempt_time_ban'] below).
	 * Additionally/alternatively, a captcha can be set to show once this limit is reached by using the 'ip_login_attempts_exceeded()' library function.
	 * @param int
	 *
	 * Note: If a user exceeds 3 times the limit set, the resulting time ban is doubled to further slow down attempts.
 	 * Example: 0 = unlimited attempts, 3 = 3 attempts.
	*/
	$config['security']['login_attempt_limit'] = 3;
	
	/**
	 * If a user has exceeded the failed login attempt limit, set the length of time they must wait before they can attempt to login again.
	 * @param int
	 * 
	 * Note: The time ban is doubled if the failed attempts are 3 times higher than the limit defined via $config['security']['login_attempt_limit'].
	 * Example: If 'login_attempt_limit' = 3 and 'login_attempt_time_ban' = 10, after 3 failed attempts, the user must wait 10 seconds between each next attempt, 
	 * after 9 consecutive failed attempts, the user must wait 20 seconds between each next attempt. Attempts within the time ban are ignored and not even checked as being valid.
	 * !IMPORTANT: It is NOT recommended that this time ban is set for a long period of time (> 5 mins).
	 * Long time bans could be abused by attackers to deny legitimate users access, it is designed to SLOW DOWN brute force attackers, not outright ban them. 
	 * 
	 * Example: Time in seconds, 0 = no time ban, 10 = 10 seconds, 60*3 = 3 minutes.
	*/
	$config['security']['login_attempt_time_ban'] = 10;

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	// Google reCAPTCHA SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * flexi auth Google reCAPTCHA Settings.
	 * Google reCAPTCHA can be used to help slow down brute force login attempts, requiring the user to complete the CAPTCHA before their login details will be submitted.
	 *
	 * Note: Only change the value after the '=' sign, and not the $config array names.
	 * Example: Change $config['security']['example'] = 'example_value_1' to $config['security']['example'] = 'example_value_2'
	*/

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * reCAPTCHA Keys
	 * Set your unique reCAPTCHA api keys.
	 * !IMPORTANT: Obtain YOUR OWN reCAPTCHA keys from http://www.google.com/recaptcha.
	*/
	$config['security']['recaptcha_public_key']	= 'ENTER_RECAPTCHA_PUBLIC_KEY_HERE';
	$config['security']['recaptcha_private_key'] = 'ENTER_RECAPTCHA_PRIVATE_KEY_HERE'; 

	/**
	 * Set the theme of the reCAPTCHA. For custom theming, see https://developers.google.com/recaptcha/docs/customization
	 * Predefined themes: 'red', 'white', 'blackglass', 'clean'. Set 'custom' for custom themes.
	*/
	$config['security']['recaptcha_theme'] = 'white';

	/**
	 * Set the language of the reCAPTCHA.
	 * Supported languages: English 'en',  Dutch 'nl',  French 'fr',  German 'de', Portuguese 'pt', Russian 'ru', Spanish 'es', Turkish 'tr'.
	*/
	$config['security']['recaptcha_language'] = 'en';

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// GENERAL CONFIGURATION SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * General flexi auth Settings
	 * Many of flexi auths automatic functions are customisable and can even be turned on and off to suit different websites.
	 *
	 * Note: Only change the value after the '=' sign, and not the $config array names.
	 * Example: Change $config['settings']['example'] = TRUE to $config['settings']['example'] = FALSE
	*/

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Set whether an incremented number is added to the end of an unavailable username.
	 * Example: If username 'flexi' is already in use, the next user to use 'flexi' as their username will be automatically updated to 'flexi1'.
	 * @param: bool
	 *
	 * Note: This only applies if the username is not set as the primary identity column ($config['database']['settings']['primary_identity_col'])
	*/
	$config['settings']['auto_increment_username'] = FALSE;
	
	/**
	 * Set whether accounts are suspended by default on registration / inserting user.
	 * This option allows admins to verify account details before enabling users.
	 * @param: bool
	*/
	$config['settings']['suspend_new_accounts'] = FALSE;

	/**
	 * Set a time limit to grant users instant login access, once expired, they are locked out until they activate their account via an activation email sent to them.
	 * @param: int
	 *
 	 * Example: Time in minutes, 0 = unlimited, 60*24 = 24 hours, 1440 = 24 hours
	*/
	$config['settings']['account_activation_time_limit'] = 0;

	/**
	 * Set the id of the default group that new users will be added to unless otherwise specified.
	 * @param: int
	*/
	$config['settings']['default_group_id'] = 1;

    /**
     * Set whether user privileges should be determined by individual privileges assigned per user, or via privileges assigned to a users user group.
     * @param array
     * 
     * Options: array('user','group'), array('user'), array('group')
     */
    $config['settings']['privilege_sources'] = array('user','group');

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// EMAIL CONFIGURATION SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * flexi auth Email Settings
	 * Some of the functions in flexi auth need to send emails to the user (i.e. 'Account Activation', 'Forgot Password' etc).
	 * If required, the title, reply address, email type and the content of these emails can be configured to suit different website needs.
	 *
	 * Note: Only change the value after the '=' sign, and not the $config array names.
	 * Example: Change $config['email']['example'] = 'example_value_1' to $config['email']['example'] = 'example_value_2'
	*/
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	// Site title shown as 'from' header on emails.
	$config['email']['site_title'] = "flexi auth";
	
	// Reply email shown as 'from' header on emails.
	$config['email']['reply_email'] = "info@website.com";
	
	/**
	 * Type of email to send, options: 'html', 'text'.
	 * Note: If using 'text', the default code within the flexi auth templates use HTML which will be emailed as plain text.
	*/
	$config['email']['email_type'] = 'html';
	
	/**
	 * Directory where email templates are stored.
	 * Default: 'includes/email/'
	*/
	$config['email']['email_template_directory'] = 'includes/email/';
	
	/**
	 * 'Activate Account' email template.
	 * Default: 'activate_account.tpl.php'
	*/
	$config['email']['email_template_activate'] = 'activate_account.tpl.php';
	
	/**
	 * 'Forgot Password' email template.
	 * Default: 'forgot_password.tpl.php'
	*/
	$config['email']['email_template_forgot_password'] = 'forgot_password.tpl.php';

	/**
	 * 'Forgot Password Complete' email template.
	 * Default: 'new_password.tpl.php'
	*/
	$config['email']['email_template_forgot_password_complete'] = 'new_password.tpl.php';

	/**
	 * 'Update Email' email template.
	 * Default: 'update_email_address.tpl.php'
	*/
	$config['email']['email_template_update_email'] = 'update_email_address.tpl.php';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MESSAGE SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * Message Delimiter Settings
	 * Define status and error message delimiters to style auth messages.
	 * @param: string
	 *
	 * Example: ['status_prefix'] = '<p class="status_msg">', ['status_suffix'] = '</p>'
	*/

	// Message Start Delimiter
	$config['messages']['delimiters']['status_prefix'] = '<p class="status_msg">';
	
	// Message End Delimiter
	$config['messages']['delimiters']['status_suffix'] = '</p>';
	
	// Error Start Delimiter
	$config['messages']['delimiters']['error_prefix'] = '<p class="error_msg">';
	
	// Error End Delimiter
	$config['messages']['delimiters']['error_suffix'] = '</p>';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Message Visibility
	 * Define which status and error messages are returned as public or admin messages, or which messages are not returned at all.
	 * Public messages are intended to be displayed to public and admin users, whilst admin messages are intended for admin users only.
	 *
	 * Example:
	 * Public and Admin message = $config['messages']['target_user']['account_creation_successful'] = 'public';
	 * Admin Only message = $config['messages']['target_user']['account_creation_successful'] = 'admin';
	 * Do NOT set public or admin message = $config['messages']['target_user']['account_creation_successful'] = FALSE;
	 */ 
	 
	// Account Creation
	$config['messages']['target_user']['account_creation_successful'] = 'public';
	$config['messages']['target_user']['account_creation_unsuccessful'] = 'public';
	$config['messages']['target_user']['account_creation_duplicate_email'] = 'public';
	$config['messages']['target_user']['account_creation_duplicate_username'] = 'public';
	$config['messages']['target_user']['account_creation_duplicate_identity'] = 'public';
	$config['messages']['target_user']['account_creation_insufficient_data'] = 'public';

	// Password
	$config['messages']['target_user']['password_invalid'] = 'public';
	$config['messages']['target_user']['password_change_successful'] = 'public';
	$config['messages']['target_user']['password_change_unsuccessful'] = 'public';
	$config['messages']['target_user']['password_token_invalid'] = 'public';
	$config['messages']['target_user']['email_new_password_successful'] = 'public';
	$config['messages']['target_user']['email_forgot_password_successful'] = 'public';
	$config['messages']['target_user']['email_forgot_password_unsuccessful'] = 'public';
	
	// Activation
	$config['messages']['target_user']['activate_successful'] = 'public';
	$config['messages']['target_user']['activate_unsuccessful'] = 'public';
	$config['messages']['target_user']['deactivate_successful'] = 'public';
	$config['messages']['target_user']['deactivate_unsuccessful'] = 'public';
	$config['messages']['target_user']['activation_email_successful'] = 'public';
	$config['messages']['target_user']['activation_email_unsuccessful'] = 'public';
	$config['messages']['target_user']['account_requires_activation'] = 'public';
	$config['messages']['target_user']['account_already_activated'] = 'public';
	$config['messages']['target_user']['email_activation_email_successful'] = 'public';
	$config['messages']['target_user']['email_activation_email_unsuccessful'] = 'public';

	// Login / Logout
	$config['messages']['target_user']['login_successful'] = 'public';
	$config['messages']['target_user']['login_unsuccessful'] = 'public';
	$config['messages']['target_user']['logout_successful'] = 'public';
	$config['messages']['target_user']['login_details_invalid'] = 'public';
	$config['messages']['target_user']['captcha_answer_invalid'] = 'public';
	$config['messages']['target_user']['login_attempts_exceeded'] = 'public';
	$config['messages']['target_user']['login_session_expired'] = 'public';
	$config['messages']['target_user']['account_suspended'] = 'public';

	// Account Changes
	$config['messages']['target_user']['update_successful'] = 'public';
	$config['messages']['target_user']['update_unsuccessful'] = 'public';
	$config['messages']['target_user']['delete_successful'] = 'public';
	$config['messages']['target_user']['delete_unsuccessful'] = 'public';

	// Form Validation
	$config['messages']['target_user']['form_validation_duplicate_identity'] = 'public';
	$config['messages']['target_user']['form_validation_duplicate_email'] = 'public';
	$config['messages']['target_user']['form_validation_duplicate_username'] = 'public';

/* End of file flexi_auth.php */
/* Location: ./system/application/config/flexi_auth.php */