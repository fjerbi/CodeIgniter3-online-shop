<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Youraccount extends MX_Controller
{

function __construct() {
parent::__construct();
$this->load->model('users_model');
$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->library('session');



}

public function index(){
$this->load->view('start_login', $this->data);
}

function logout() {

// create the data object
$this->load->module('web_cookies');
$this->web_cookies->_destroy_cookie();
$data = new stdClass();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

// remove session datas
foreach ($_SESSION as $key => $value) {
unset($_SESSION[$key]);
}

// user logout ok
redirect(base_url());

} else {

// there user was not logged in, we cannot logged him out,
// redirect him to site root
redirect(base_url());

}

}

function profile()
{
$this->load->module('securite');
$this->securite->_check_logged_in();

$data['flash'] = $this->session->flashdata('item');

$data['view_file']="profile";
$this->load->module('templates');
$this->templates->main_page($data);

}
function welcome()
{
$this->load->module('securite');
$this->securite->_check_logged_in();
$data = $this->fetch_post();
$data['flash'] = $this->session->flashdata('item');

$data['view_file']="welcome";
$this->load->module('templates');
$this->templates->main_page($data);

}


function confirmemail()
{

$this->load->view('youraccount/confirmemail');
}

function get_id()
{

$this->load->module('users');

$this->load->module('securite');
$id_acheteur = $this->securite->_get_user_id();
//si il est connecté
if(is_numeric($id_acheteur)){

echo $id_acheteur;

}

}
function login(){
$this->load->module('users');

$this->load->module('securite');
$id_acheteur = $this->securite->_get_user_id();
//si il est connecté
if(!is_numeric($id_acheteur)){
$data['pseudo']=$this->input->post('pseudo',TRUE);
$this->load->module('templates');
$this->templates->login($data);
}else{

redirect(base_url());
}
}



/*function submit_login()
{


$submit = $this->input->post('submit', TRUE);
if($submit=="Connexion"){


$this->load->library('form_validation');
$this->form_validation->set_rules('pseudo','Username','required|min_length[5]|max_length[60]|callback_username_check');

$this->form_validation->set_rules('mot_de_passe','Password','required|min_length[7]|max_length[35]');


if($this->form_validation->run($this) == TRUE){

//recuperer lid de l'utilsateur
$col1 = 'pseudo';
$value1 = $this->input->post('pseudo', TRUE);
$col2 ='email';
$value2 = $this->input->post('pseudo', TRUE);;
$query = $this->users->get_with_double_condition($col1, $value1, $col2, $value2);
$num_rows = $query->num_rows();
foreach($query->result() as $row)
{
$user_id= $row->id;
}
$remember = $this->input->post('remember',TRUE);
if($remember=="remember-me"){
$login_type="long_period";
}else{
$login_type="short_period";
}

$data['derniere_connexion'] = time();
$this->users->_update($user_id, $data);


//l'envoi vers a page privé
$this->_connection($user_id, $login_type);


}else{
echo validation_errors();
}

}


}

*/


function user_pseudo()
{


$data['flash'] = $this->session->flashdata('item');
$this->load->view('profile',$data);
}


public function submit_login() {


$data = new stdClass();
$is_active=$this->users_model->is_active_user();

$this->load->helper('form');
$this->load->library('form_validation');

// set validation rules
$this->form_validation->set_rules('pseudo', 'Username', 'required|alpha_numeric');
$this->form_validation->set_rules('mot_de_passe', 'Password', 'required');

if ($this->form_validation->run() == false) {

// validation not ok, send validation errors to the view
redirect('youraccount/login');
} else {

// set variables from the form
$pseudo = $this->input->post('pseudo');
$mot_de_passe = $this->input->post('mot_de_passe');

if ($this->users_model->resolve_user_login($pseudo, $mot_de_passe)  && count($is_active)>0) {

$user_id = $this->users_model->get_user_id_from_username($pseudo);
$user= $this->users_model->get_user($user_id);

// set session user datas
$_SESSION['user_id']      = (int)$user->id;
$_SESSION['pseudo']     = (string)$user->pseudo;
 $_SESSION['nom']     = (string)$user->nom;
$_SESSION['logged_in']    = (bool)true;

$_SESSION['active'] = (bool)$user->active;
if($logintype=="long_period"){
//ajouter une cookie
$this->load->module('web_cookies');
$this->web_cookies->_set_cookie($user_id);
}else{
//ajouter une variable de session
$this->session->set_userdata('user_id', $user_id);
}

//METTRE A JOUR les commandes(cart)
$this->_save_cart_data($user_id);


// user login ok
redirect('youraccount/welcome');

} else {

// login failed
$data->error = 'Wrong username or password.';

// send error to the view
redirect('youraccount/login');

}

}

}
function _connection($user_id, $login_type)
{
//NB: logintype peut etre a long term ou shortterm

if($logintype=="long_period"){
//ajouter une cookie
$this->load->module('web_cookies');
$this->web_cookies->_set_cookie($user_id);
}else{
//ajouter une variable de session
$this->session->set_userdata('user_id', $user_id);
}

//METTRE A JOUR les commandes(cart)
$this->_save_cart_data($user_id);

//envoyer l utilisateur vers la page correspondante
redirect('youraccount/welcome');
}







//enregistrer les donnees ( produits) mquand l utilisateur se connecte pour éviter de perdre ces derniers
function _save_cart_data($user_id)
{
$this->load->module('basket');
$user_session_id = $this->session->session_id;

$col1='session_id';
$value1=$user_session_id;
$col2='id_acheteur';
$value2= 0;

$query = $this->basket->get_with_double_condition($col1, $value1, $col2, $value2);
$num_rows= $query->num_rows();
if($num_rows>0){

$mysql_query="update panier set id_acheteur=$user_id where session_id='$user_session_id'";
$query = $this->basket->_custom_query($mysql_query);
redirect('cart');
}
}

//inscription
function submit()
{


$submit = $this->input->post('submit', TRUE);
if($submit=="Submit"){
$this->load->library('form_validation');

$this->form_validation->set_rules('pseudo','Username','required|min_length[8]|max_length[55]|is_unique[utilisateurs.pseudo]');
$this->form_validation->set_rules('nom','Nom','required|max_length[55]');
$this->form_validation->set_rules('prenom','Prenom','required|max_length[55]');
$this->form_validation->set_rules('pays','Pays','required');
$this->form_validation->set_rules('address1','Addresse 1','required');
$this->form_validation->set_rules('address2','Addresse 2','required');
$this->form_validation->set_rules('ville','Ville','required');
$this->form_validation->set_rules('code_postal','code postal','required');
$this->form_validation->set_rules('societe','sociéte','required');
$this->form_validation->set_rules('mot_de_passe','Mot de passe','required|min_length[8]|max_length[55]');
$this->form_validation->set_rules('repeat_pword','Repeter mot de passe','required|matches[mot_de_passe]');
$this->form_validation->set_rules('email','Email','required|valid_email|max_length[120]|is_unique[utilisateurs.email]');

if($this->form_validation->run($this) == TRUE){


$this->_create_account();

redirect('youraccount/login');




}else{
$this->createaccount();
}

}


}

function _create_account()
{
$this->load->module('users');
$data = $this->fetch_post();
unset($data['repeat_pword']);


$mot_de_passe= $data['mot_de_passe'];
$this->load->module('securite');
$data['mot_de_passe']= $this->securite->_hash_string($mot_de_passe);
$this->users->_insert($data);
}



function createaccount()
{
$data = $this->fetch_post();
$data['flash'] = $this->session->flashdata('item');

$data['view_file']="start_login";
$this->load->module('templates');
$this->templates->main_page($data);

}


public function get_product_by_group($id='')
//write this way so that you can call the url like
//localhost/norwin/list_group/get_product_by_group
{

if($id)//no need to check uri->segment
{
        $this->load->database();
        $data['user_data'] = $this->users_model->namebyid($id);
        $this->load->view('youraccount/welcome', $data);

}

print_r($user_data);
}

function register(){

$this->load->module('securite');
$this->form_validation->set_rules('email','Email','required|valid_email|max_length[120]|is_unique[utilisateurs.email]');
$this->form_validation->set_rules('pseudo','Pseudo','max_length[120]|is_unique[utilisateurs.pseudo]');
$this->form_validation->set_rules('mot_de_passe','Mot de passe','required|min_length[8]|max_length[55]');
$this->form_validation->set_rules('repeat_pword','Repeter mot de passe','required|matches[mot_de_passe]');

if ($this->form_validation->run() == FALSE) {
  $this->load->view('start_login', $this->data);
}
else{
//get user inputs
$email = $this->input->post('email');
$pseudo = $this->input->post('pseudo');
$pays = $this->input->post('pays');
$ville = $this->input->post('ville');
$address1 = $this->input->post('address1');
$address2 = $this->input->post('address2');

$mot_de_passe = $this->input->post('mot_de_passe');


//generate simple random code
$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$code = substr(str_shuffle($set), 0, 12);

//insert user to users table and get id
$user['pseudo'] = $pseudo;
$user['email'] = $email;
$user['pays'] = $pays;
$user['ville'] = $ville;
$user['address1'] = $address1;
$user['address2'] = $address2;

$user['date_creation'] = time();
$user['mot_de_passe'] = $mot_de_passe;
$user['mot_de_passe']= $this->securite->_hash_string($mot_de_passe);
$user['code'] = $code;
$user['active'] = false;
$id = $this->users_model->insert($user);

//set up email
$config = array(
'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => '', // change it to yours
  'smtp_pass' => '', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);

$message =  "
    <html>
    <head>
      <title>Code de vérification</title>
    </head>
    <body>
      <h2>Merci pour l'inscription dans notre site web.</h2>
      <p>Votre compte:</p>
      <p>Email: ".$email."</p>
      <p>Nom d'utilisateur: ".$pseudo."</p>
      <p>Mot de passe: ".$mot_de_passe."</p>
      <p>Veuillz cliquer sur ce lien pour activer votre compte.</p>
      <h4><a href='".base_url()."youraccount/activate/".$id."/".$code."'>Activer mon compte</a></h4>
    </body>
    </html>
    ";

$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->from($config['smtp_user']);
$this->email->to($email);
$this->email->subject('Activation du compte');
$this->email->message($message);

//sending email
if($this->email->send()){
  $this->session->set_flashdata('message','Activation code sent to email');
}
else{
  $this->session->set_flashdata('message', $this->email->print_debugger());

}

  redirect('start_login');
}

}

public function activate(){
$id =  $this->uri->segment(3);
$code = $this->uri->segment(4);

//fetch user details
$user = $this->users_model->getUser($id);

//if code matches
if($user['code'] == $code){
//update user active status
$data['active'] = true;
$query = $this->users_model->activate($data, $id);

if($query){
$this->session->set_flashdata('message', 'User activated successfully');
}
else{
$this->session->set_flashdata('message', 'Something went wrong in activating account');
}
}
else{
$this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
}

redirect('youraccount/confirmemail');

}

function fetch_post()
{
$data['pseudo'] = $this->input->post('pseudo',TRUE);
$data['email'] = $this->input->post('email');
$data['mot_de_passe'] = $this->input->post('mot_de_passe');
$data['repeat_pword'] = $this->input->post('repeat_pword');

$data['ville'] = $this->input->post('ville');

$data['pays'] = $this->input->post('pays');
$data['nom'] = $this->input->post('nom');

$data['prenom'] = $this->input->post('prenom');


$data['address1'] = $this->input->post('address1');

$data['code_postal'] = $this->input->post('code_postal');

$data['societe'] = $this->input->post('societe');
$data['address2'] = $this->input->post('address2');
return $data;
}


function username_check($str){


$this->load->module('users');
$this->load->module('securite');
$error_msg = "Vous avez saisi un nom d'utilisateur ou un mot de passe incorrecte";
$col1 = 'pseudo';
$value1 = $str;
$col2 ='email';
$value2 = $str;


$query = $this->users->get_with_double_condition($col1, $value1, $col2, $value2);
$num_rows = $query->num_rows();

if($num_rows<1){

$this->form_validation->set_message('username_check', $error_msg);
return FALSE;
}

foreach($query->result() as $row)
{
$pword_on_table= $row->mot_de_passe;
}
$mot_de_passe = $this->input->post('mot_de_passe', TRUE);
$result = $this->securite->_verify_hash($mot_de_passe, $pword_on_table);
if ($result == TRUE)
{
return TRUE;
}else{
$this->form_validation->set_message('username_check', $error_msg);
return FALSE;
}



}


}
