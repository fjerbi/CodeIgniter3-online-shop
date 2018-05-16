<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends MX_Controller
{
    function __construct() {
        parent::__construct();
        
        // Load facebook library
        $this->load->library('facebook');
        
        //Load user model
        $this->load->model('user');
    }
    
    public function index(){
        $userData = array();
        
        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $fbUserProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,locale,cover,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $fbUserProfile['id'];
            $userData['first_name'] = $fbUserProfile['first_name'];
            $userData['last_name'] = $fbUserProfile['last_name'];
            $userData['email'] = $fbUserProfile['email'];
            $userData['gender'] = $fbUserProfile['gender'];
            $userData['locale'] = $fbUserProfile['locale'];
            $userData['cover'] = $fbUserProfile['cover']['source'];
            $userData['picture'] = $fbUserProfile['picture']['data']['url'];
            $userData['link'] = $fbUserProfile['link'];
            
            // Insert or update user data
            $userID = $this->user->checkUser($userData);
            
            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            }else{
               $data['userData'] = array();
            }
            
            // Get logout URL
            $data['logoutURL'] = $this->facebook->logout_url();
        }else{
            // Get login URL
            $data['authURL'] =  $this->facebook->login_url();
        }
        
        // Load login & profile view
        $this->load->view('user_authentication/index',$data);
    }

    public function logout() {
        // Remove local Facebook session
        $this->facebook->destroy_session();
        // Remove user data from session
        $this->session->unset_userdata('userData');
        // Redirect to login page
        redirect('/user_authentication');
    }
}