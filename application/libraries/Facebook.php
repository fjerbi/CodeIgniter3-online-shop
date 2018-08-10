<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');
	require 'application/vendor/autoload.php';
    /**
     * author: Ahsan Shabbir
     * Email: iamahsanshabbir@gmail.com
     * Github: https://github.com/ahsan044/
     *
     *
     * This library can be used to communicate with facebook using sdk5. 
     * to make it fully functional, you may need to get your app approve from facebook first. 
     * As some functions require extended permssions However most of them are granted by facebook by default.
     * Details about what permissions are required are given before function name.
     *
     *
     * @installation
     *  Composer is required..
     *  creater composer.json file in application directory. and add following code.
     *  {
     *  "require" : {
     *          "facebook/php-sdk-v4" : "~5.0"
     *        }
     *       }
     *
     * it will add facebook sdkv5 
     *
     * 
     * You need to edit your application/config.php file  and change $config['composer_autoload'];
     * to TRUE
     *
     * $config['composer_autoload'] = TRUE;
     *
     * You need to edit autoload.config file and in $autoload['libraries'] = array('');
     * add 'facebook' . 
     * 
     * eg.. $autoload['libraries'] = array('facebook');
     * 
     *  
     * 
     *
     *
     *
     *
     *
     *
     * 
     */
   
    Class Facebook {


    	protected $ins;
        public $fb;
        public $permissions;
        public $helper;
        //protected $helper;

    	public function __construct(){
            $this->ins =& get_instance();
            $this->ins->load->config('facebook');
            $this->redirectUrl = $this->ins->config->item('redirect_url');
            $this->permissions = $this->ins->config->item('permissions');
            
            
            if(! isset($_SESSION)){
            session_start();
        	}
    	}
        // Check if user is logged in 
        
        public function logged_in(){
            if(isset($_SESSION['accessToken'])){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        //return Facebook Class Object
        public function getFb(){
            $fb = new Facebook\Facebook([

                 'app_id' => $this->ins->config->item('api_id'),
                 'app_secret' => $this->ins->config->item('api_secret'),
                 'default_graph_version' => 'v2.5',
                
                ]);
            return $fb;
        }


        //Getting Login URL
    	public function loginUrl(){
                $fb = $this->getFb();
                $this->helper = $fb->getRedirectLoginHelper();
				$loginUrl = $this->helper->getLoginUrl($this->redirectUrl, $this->permissions);
                return $loginUrl;

           
    	}

        //setting new session
        //
    
        public function setSession(){
            //checking if user is loged in
            
            $fb = $this->getFb();
            $helper = $fb->getRedirectLoginHelper();

            try {
              $accessToken = $helper->getAccessToken();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              //echo 'Graph returned an error: ' . $e->getMessage();
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              //echo 'Facebook SDK returned an error: ' . $e->getMessage();
            }

            if (isset($accessToken)) {
              // Logged in!
              $_SESSION['accessToken'] = (string) $accessToken;
            } elseif ($helper->getError()) {

                //user did not accept login. 
            
            return FALSE;
            }

            return TRUE;
        }


        //getting user profile data

        public function getProfile(){
            $fb = $this->getFb();
            try {
          // Returns a `Facebook\FacebookResponse` object
          $response = $fb->get('/me?fields=id,name,email,gender,timezone,verified,first_name,last_name,link',$_SESSION['accessToken']);
             } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
            }

        $user = $response->getGraphUser();
        return $user;

        }
        /**
         * 
         * This funcion return user posts but it require "user_post" permissions first.
         * 
         * @return [array] [user posts]
         */
        public function getPosts(){
            $fb = $this->getFb();
            try {
          // Returns a `Facebook\FacebookResponse` object
          $response = $fb->get('/me/feed',$_SESSION['accessToken']);
             } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
            }

        $posts = $response->getGraphEdge();
        return $posts;

        }

        /**
         *  Getting user friends. It require user_friends permissions
         *  It will only show friends who use this app.
         *  if no friend use this app, it will only return count of friends.
         *
         */

        public function getFriends(){
             $fb = $this->getFb();
             try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->get('/me/friends?fields=id,name',$_SESSION['accessToken']);
                 } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;}
             catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
                }

        $friends =  $response->getGraphEdge();
        return $friends;

        }

        /**
         *  @getting profile picture. 
         *  
         */
        public function getDp(){
             $fb = $this->getFb();
             try {
                $uid = $this->getUserId();
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->get('/me/picture?type=large&redirect=false',$_SESSION['accessToken']);
                 } catch(Facebook\Exceptions\FacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;}
                catch(Facebook\Exceptions\FacebookSDKException $e) {
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                     exit;
                }

                $picture =  $response->getGraphObject();
                $src = $picture['url'];
                return $src;

        }
        /**
         *  Updating status on user's wall.
         *  this function require 'publish_actions' permissions.
         *  usage: $this->facebook->updateStatus($message);
         *  author: Ahsan Shabbir (@ahsan044)
         */
        public function updateStatus($message){
            $fb = $this->getFb();
            $response = $fb->post( '/me/feed', array(
            'message' => $message
            ),$_SESSION['accessToken']);


          }
          /**
         *  Updating Images on user's wall.
         *  this function require 'publish_actions' permissions.
         *  usage: $this->facebook->uploadImage($message, $imagePath);
         *  example : $this->facebook->uploadImage('Uploading test Image', '/home/projects/Google.jpg');
         *  author: Ahsan Shabbir (@ahsan044)
         */

        public function uploadImage($message,$imagePath){
          $fb = $this->getFb(); 

          $data = [
                    'source' => $fb->fileToUpload($imagePath),
                    'message' => $message
                    ];
         
          $response = $fb->post('/me/photos', $data, $_SESSION['accessToken']);
          if($response){
            return TRUE;
          }else{
            return FALSE;
                  }

        }

        /**
         *   Video Upload Function
         *   usage : $this->facebook->uploadVideo($title, $descripion, $path_to_video);
         *   example: $this->facebook->uploadVideo('A Sample Video', 'Check this sample videoooo', '/home/user/video.mp4');
         *   user require publish_actions to upload this video.
         *
         */
        public function uploadVideo($title, $description,$videoPath){
          $fb = $this->getFb(); 
          $data = [
                    'source' => $fb->fileToUpload($videoePath),
                    'title' => $title,
                    'description' => $description
                    ];
         
          $response = $fb->post('/me/videos', $data, $_SESSION['accessToken']);
          if($response){
            return TRUE;
          }else{
            return FALSE;
               }

        }

        
        public function logoutUrl(){
            return $this->ins->config->item('logout_url');

        }

        //logout user
        public function logout(){
            if($this->logged_in()){
                unset($_SESSION['accessToken']);
                redirect($this->logoutUrl());
            }else{
                redirect($this->logoutUrl());
            }
            
        }
        
        //getting userId of logged in user
        public function getUserId(){
            $data = $this->getProfile();
            return $data['id'];

        }
    }