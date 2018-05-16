<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Facebook PHP SDK for CodeIgniter 3
 *
 * Library wrapper for Facebook PHP SDK. Check user login status, publish to feed
 * and more with easy to use CodeIgniter syntax.
 *
 * This library requires the Facebook PHP SDK to be installed with Composer, and that CodeIgniter
 * config is set to autoload the vendor folder. More information in the CodeIgniter user guide at
 * http://www.codeigniter.com/userguide3/general/autoloader.html?highlight=composer
 *
 * It also requires CodeIgniter session library to be correctly configured.
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      Mattias Hedman
 * @license     MIT
 * @link        https://github.com/darkwhispering/facebook-sdk-codeigniter
 * @version     3.0.0
 */

use Facebook\Facebook as FB;
use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\FacebookBatchResponse;
use Facebook\Helpers\FacebookCanvasHelper;
use Facebook\Helpers\FacebookJavaScriptHelper;
use Facebook\Helpers\FacebookPageTabHelper;
use Facebook\Helpers\FacebookRedirectLoginHelper;

Class Facebook
{
    const UPLOAD_TYPE_VIDEO = 'video';
    const UPLOAD_TYPE_IMAGE = 'image';

    /**
     * @var FB
     */
    private $fb;

    /**
     * @var FacebookRedirectLoginHelper|FacebookCanvasHelper|FacebookJavaScriptHelper|FacebookPageTabHelper
     */
    private $helper;

    /**
     * @var array
     */
    private $batch_request_pool = [];

    /**
     * Facebook constructor.
     */
    public function __construct()
    {
        // Load config
        $this->load->config('facebook');

        // Load required libraries and helpers
        $this->load->library('session');
        $this->load->helper('url');

        if (!isset($this->fb))
        {
            $this->fb = new FB([
                'app_id'                => $this->config->item('facebook_app_id'),
                'app_secret'            => $this->config->item('facebook_app_secret'),
                'default_graph_version' => $this->config->item('facebook_graph_version')
            ]);
        }

        // Load correct helper depending on login type
        // set in the config file
        switch ($this->config->item('facebook_login_type'))
        {
            case 'js':
                $this->helper = $this->fb->getJavaScriptHelper();
                break;

            case 'canvas':
                $this->helper = $this->fb->getCanvasHelper();
                break;

            case 'page_tab':
                $this->helper = $this->fb->getPageTabHelper();
                break;

            case 'web':
                $this->helper = $this->fb->getRedirectLoginHelper();
                break;
        }

        if ($this->config->item('facebook_auth_on_load') === TRUE)
        {
            // Try and authenticate the user right away (aka, get valid access token)
            $this->authenticate();
        }
    }

    /**
     * @return FB
     */
    public function object()
    {
        return $this->fb;
    }

    /**
     * Check if user are logged in by checking if we have a Facebook
     * session active.
     *
     * @return mixed|boolean
     */
    public function is_authenticated()
    {
        $access_token = $this->authenticate();

        if (isset($access_token))
        {
            return $access_token;
        }

        return false;
    }

    /**
     * Do Graph request
     *
     * @param       $method
     * @param       $endpoint
     * @param array $params
     * @param null  $access_token
     *
     * @return array
     */
    public function request($method, $endpoint, $params = [], $access_token = null)
    {
        try
        {
            $response = $this->fb->{strtolower($method)}($endpoint, $params, $access_token);
            return $response->getDecodedBody();
        }
        catch(FacebookResponseException $e)
        {
            return $this->logError($e->getCode(), $e->getMessage());
        }
        catch (FacebookSDKException $e)
        {
            return $this->logError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Upload image or video to user profile
     *
     * @param        $path_to_file
     * @param array  $params
     * @param string $type
     * @param null   $access_token
     *
     * @return array
     */
    public function user_upload_request($path_to_file, $params = [], $type = self::UPLOAD_TYPE_IMAGE, $access_token = null)
    {
        if ($type === self::UPLOAD_TYPE_IMAGE)
        {
            $data = ['source' => $this->fb->fileToUpload($path_to_file)] + $params;
            $endpoint = '/me/photos';
        }
        elseif ($type === self::UPLOAD_TYPE_VIDEO)
        {
            $data = ['source' => $this->fb->videoToUpload($path_to_file)] + $params;
            $endpoint = '/me/videos';
        }
        else
        {
            return $this->logError(400, 'Invalid upload type');
        }

        try
        {
            $response = $this->fb->post($endpoint, $data, $access_token);
            return $response->getDecodedBody();
        }
        catch(FacebookSDKException $e)
        {
            return $this->logError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Add request to batch
     *
     * @param       $key
     * @param       $method
     * @param       $endpoint
     * @param array $params
     * @param null  $access_token
     */
    public function add_to_batch_pool($key, $method, $endpoint, $params = [], $access_token = null)
    {
        $this->batch_request_pool = array_merge(
            $this->batch_request_pool,
            [$key => $this->fb->request($method, $endpoint, $params, $access_token)]
        );
    }

    /**
     * Remove request from batch
     *
     * @param $key
     */
    public function remove_from_batch_pool($key)
    {
        if (isset($this->batch_request_pool[$key]))
        {
            unset($this->batch_request_pool[$key]);
        }
    }

    /**
     * Send all request in the batch pool
     *
     * @return array|FacebookBatchResponse
     */
    public function send_batch_pool()
    {
        try
        {
            $responses = $this->fb->sendBatchRequest($this->batch_request_pool);
            $this->batch_request_pool = [];

            $data = [];
            foreach ($responses as $key => $response)
            {
                $data[$key] = $response->getDecodedBody();
            }

            return $data;
        }
        catch(FacebookResponseException $e)
        {
            return $this->logError($e->getCode(), $e->getMessage());
        }
        catch(FacebookSDKException $e)
        {
            return $this->logError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Generate Facebook login url for Facebook Redirect Login (web)
     *
     * @return  string
     */
    public function login_url()
    {
        // Login type must be web, else return empty string
        if ($this->config->item('facebook_login_type') != 'web')
        {
            return '';
        }

        return $this->helper->getLoginUrl(
            base_url() . $this->config->item('facebook_login_redirect_url'),
            $this->config->item('facebook_permissions')
        );
    }

    /**
     * Generate Facebook login url for Facebook Redirect Login (web)
     *
     * @return string
     * @throws FacebookSDKException
     */
    public function logout_url()
    {
        // Login type must be web, else return empty string
        if ($this->config->item('facebook_login_type') != 'web')
        {
            return '';
        }

        // Create logout url
        return $this->helper->getLogoutUrl(
            $this->get_access_token(),
            base_url() . $this->config->item('facebook_logout_redirect_url')
        );
    }

    /**
     * Destroy our local Facebook session
     */
    public function destroy_session()
    {
        $this->session->unset_userdata('fb_access_token');
    }

    /**
     * Get a new access token from Facebook
     *
     * @return array|AccessToken|null|object|void
     */
    private function authenticate()
    {
        $access_token = $this->get_access_token();

        if ($access_token && $this->get_expire_time() > (time() + 30) || $access_token && !$this->get_expire_time())
        {
            $this->fb->setDefaultAccessToken($access_token);
            return $access_token;
        }

        // If we did not have a stored access token or if it has expired, try get a new access token
        if (!$access_token)
        {
            try
            {
                $access_token = $this->helper->getAccessToken();
            }
            catch (FacebookSDKException $e)
            {
                $this->logError($e->getCode(), $e->getMessage());
                return null;
            }

            // If we got a session we need to exchange it for a long lived session.
            if (isset($access_token))
            {
                $access_token = $this->long_lived_token($access_token);

                $this->set_expire_time($access_token->getExpiresAt());
                $this->set_access_token($access_token);
                $this->fb->setDefaultAccessToken($access_token);

                return $access_token;
            }
        }

        // Collect errors if any when using web redirect based login
        if ($this->config->item('facebook_login_type') === 'web')
        {
            if ($this->helper->getError())
            {
                // Collect error data
                $error = array(
                    'error'             => $this->helper->getError(),
                    'error_code'        => $this->helper->getErrorCode(),
                    'error_reason'      => $this->helper->getErrorReason(),
                    'error_description' => $this->helper->getErrorDescription()
                );

                return $error;
            }
        }

        return $access_token;
    }

    /**
     * Exchange short lived token for a long lived token
     *
     * @param AccessToken $access_token
     *
     * @return AccessToken|null
     */
    private function long_lived_token(AccessToken $access_token)
    {
        if (!$access_token->isLongLived())
        {
            $oauth2_client = $this->fb->getOAuth2Client();

            try
            {
                return $oauth2_client->getLongLivedAccessToken($access_token);
            }
            catch (FacebookSDKException $e)
            {
                $this->logError($e->getCode(), $e->getMessage());
                return null;
            }
        }

        return $access_token;
    }

    /**
     * Get stored access token
     *
     * @return mixed
     */
    private function get_access_token()
    {
        return $this->session->userdata('fb_access_token');
    }

    /**
     * Store access token
     *
     * @param AccessToken $access_token
     */
    private function set_access_token(AccessToken $access_token)
    {
        $this->session->set_userdata('fb_access_token', $access_token->getValue());
    }

    /**
     * @return mixed
     */
    private function get_expire_time()
    {
        return $this->session->userdata('fb_expire');
    }

    /**
     * @param DateTime $time
     */
    private function set_expire_time(DateTime $time = null)
    {
        if ($time) {
            $this->session->set_userdata('fb_expire', $time->getTimestamp());
        }
    }

    /**
     * @param $code
     * @param $message
     *
     * @return array
     */
    private function logError($code, $message)
    {
        log_message('error', '[FACEBOOK PHP SDK] code: ' . $code.' | message: '.$message);
        return ['error' => $code, 'message' => $message];
    }

    /**
     * Enables the use of CI super-global without having to define an extra variable.
     * I can't remember where I first saw this, so thank you if you are the original author.
     *
     * Borrowed from the Ion Auth library (http://benedmunds.com/ion_auth/)
     *
     * @param $var
     *
     * @return mixed
     */
    public function __get($var)
    {
        return get_instance()->$var;
    }


}
