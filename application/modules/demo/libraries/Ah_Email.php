<?php
/**
 * Email library
 *
 * @author    Aziz S. Hussain <azizsaleh@gmail.com>
 * @copyright GPL license 
 * @license   http://www.gnu.org/copyleft/gpl.html 
 * @link      http://www.AzizSaleh.com
 * @using     Codeigniter 3.1.2
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Email Handler
 * 
 * Uses configs email.php
 *
 * @author    Aziz S. Hussain <azizsaleh@gmail.com>
 * @copyright GPL license 
 * @license   http://www.gnu.org/copyleft/gpl.html 
 * @link      http://www.AzizSaleh.com
 * @extends   CI_Controller
 */
class Ah_Email extends CI_Controller 
{
    /**
     * Configs
     *
     * @var array
     */
    public $configs;

    /**
     * Email library
     *
     * @var object
     */
    public $email;

    /**
     * Constructor
     */
    public function __construct()
    {
        $CI =& get_instance();
        $CI->load->config('email', true);
        $this->configs = $CI->config->config['email'];

        $CI->load->library('email');
        $this->email = $CI->email;
    }

    /**
     * Send email
     *
     * @param string $email_to
     * @param string $template
     * @param array $template_vars
     * @param array $settings
     *        Ex: array(
     *              array('protocol' => 'smtp')
     *              array('mailtype' => 'html')
     *              ....
     *        )
     *
     * @return boolean
     */
    public function send($email_to, $template, $template_vars = array(), $settings = array())
    {
        if (!isset($this->configs['templates'][$template])) {
            echo 'INVALID REQUEST';
            return false;
        }

        // Get settings in order (first system, can be over ridden by template, then by this call)
        $settings = array_merge(
            $this->configs['settings'],
            $this->configs['templates'][$template],
            $settings
        );

        $this->email->initialize($settings);

        $this->email->from($settings['from_email'], $settings['from_name']);
        if (isset($settings['send_email']) && $settings['send_email']) {
            $this->email->to($email_to);
        }

        if (isset($settings['bcc_admin']) && $settings['bcc_admin']) {
            $this->email->bcc($settings['from_email']); 
        }

        $CI =& get_instance();

        $this->email->subject($settings['subject']);
        $this->email->message($CI->load->view('emails/' . $template, $template_vars, true));

        $res = $this->email->send();
        //echo $this->email->print_debugger();
        return $res;
    }
}