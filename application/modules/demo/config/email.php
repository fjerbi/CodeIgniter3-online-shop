<?php
/**
 * This config handles email functionality
 *
 * @author    Aziz S. Hussain <azizsaleh@gmail.com>
 * @copyright GPL license
 * @license   http://www.gnu.org/copyleft/gpl.html
 * @link      http://www.AzizSaleh.com
 * @using     Codeigniter 3.1.2
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/*
|-----------------------------
| General Settings
|-----------------------------
|
| 'settings'   => General settings
|               Can be overriden with the template settings
|               or when calling the send() method
|
| Following configs tested working on gmail account
*/
$config['settings'] = array(

    'from_email'    => '',
    'smtp_user'     => '',
    'smtp_pass'     => 'your pass',
    'from_name'     => 'Site Name',
    'smtp_host'     => 'smtp.googlemail.com',
    'smtp_port'     => 465,

    'protocol'      => 'smtp',
    'smtp_crypto'   => 'ssl',

    'mailtype'      => 'html',
    'charset'       => 'utf-8',
    'newline'       => "\r\n",
);

/*
|-----------------------------
| Templates location
|-----------------------------
|
| 'templates' = Folder located @ application/views/{}
|
| Each template created must have a config in templates
*/

$config['templates'] = 'emails';

/*
|-----------------------------
| Email Templates
|-----------------------------
|
| 'mailtype'    = Mail type, if not set will use general type
| 'charset'     = Charset, if not set will use general charset
| 'from_email'  = From email, if not set will use general email
| 'from_name'   = From name, if not set will use general name
| 'subject'     = Email Subject
| 'send_email'  = If false, it will send the email to site owner instead of actual user
| 'bcc_admin'   = Add the site admin as a BCC to the email
*/

$config['templates'] = array(
    // Demo
    'demo'   => array(
        'subject'    => 'Test Demo',
        'send_email' => true,
        'bcc_admin'  => false,
    ),
);
