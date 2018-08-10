<?php
/**
 * Emailer Demo
 *
 * @author    Aziz S. Hussain <azizsaleh@gmail.com>
 * @copyright GPL license 
 * @license   http://www.gnu.org/copyleft/gpl.html 
 * @link      http://www.AzizSaleh.com
 * @using     Codeigniter 3.1.2
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Demo
 * 
 * Emailer Demo class
 *
 * @author    Aziz S. Hussain <azizsaleh@gmail.com>
 * @copyright GPL license 
 * @license   http://www.gnu.org/copyleft/gpl.html 
 * @link      http://www.AzizSaleh.com
 * @extends   CI_Controller
 */
class Demo extends MX_Controller 
{
    /**
     * Demo Email
     *
     * @access    /index.php/demo/email
     */
    public function email()
    {
        // Call interface
        $this->load->library('ah_email', 'ah_email');

        // Send email out, using demo template with following variables
        $this->ah_email->send('to.firasjerbiv3@gmail.com', 'demo', array(
            'username'  => 'Demo Handler',
            'message'   => 'Hello World',
            'mailtype'  => 'text',
        ));
    }
}