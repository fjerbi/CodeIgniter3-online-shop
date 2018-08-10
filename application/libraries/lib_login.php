<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name: Facebook Login Library
*
* Author: appleboy
*
*/

require 'vendor/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;

class Lib_login
{
    /**
     * CodeIgniter global
     *
     * @var string
     **/
    protected $ci;

    /**
     * __construct
     *
     * @return void
     * @author Ben
     **/
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('session');
        $this->ci->config->load('facebook');

        if (! isset($_SESSION)) {
            session_start();
        }
    }

    public function facebook()
    {
        $facebook_default_scope = explode(',', $this->ci->config->item("facebook_default_scope"));
        $facebook_app_id = $this->ci->config->item("facebook_app_id");
        $facebook_api_secret = $this->ci->config->item("facebook_api_secret");

        // init app with app id and secret
        FacebookSession::setDefaultApplication($facebook_app_id, $facebook_api_secret);

        // login helper with redirect_uri
        $helper = new FacebookRedirectLoginHelper(site_url('login/facebook'));
        // see if a existing session exists
        if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
            // create new session from saved access_token
            $session = new FacebookSession($_SESSION['fb_token']);

            // validate the access_token to make sure it's still valid
            try {
                if (!$session->validate()) {
                    $session = null;
                }
            } catch (Exception $e) {
                // catch any exceptions
                $session = null;
            }
        }

        if (!isset($session) || $session === null) {
            // no session exists

            try {
                $session = $helper->getSessionFromRedirect();
            } catch(FacebookRequestException $ex) {
                // When Facebook returns an error
                // handle this better in production code
                print_r($ex);
            } catch(Exception $ex) {
                // When validation fails or other local issues
                // handle this better in production code
                print_r($ex);
            }
        }

        // see if we have a session
        if (isset($session)) {
            // save the session
            $_SESSION['fb_token'] = $session->getToken();
            // create a session using saved token or the new one we generated at login
            $session = new FacebookSession($session->getToken());

            // graph api request for user data
            $request = new FacebookRequest($session, 'GET', '/me');
            $response = $request->execute();
            // get response
            $graphObject = $response->getGraphObject()->asArray();
            $fb_data = array(
                'me' => $graphObject,
                'loginUrl' => $helper->getLoginUrl($facebook_default_scope)
           );
            $this->ci->session->set_userdata('fb_data', $fb_data);

        } else {
            $fb_data = array(
                'me' => null,
                'loginUrl' => $helper->getLoginUrl($facebook_default_scope)
           );
            $this->ci->session->set_userdata('fb_data', $fb_data);
        }

        return $fb_data;
    }
}
