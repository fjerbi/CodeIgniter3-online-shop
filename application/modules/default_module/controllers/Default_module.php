<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Default_module extends MX_Controller
{


//c'est le module qui charge par default
function __construct() {
parent::__construct();
}

function index(){

//charger le contenu de depuis la cms_webpages
	$first_bit = trim($this->uri->segment(1));


$this->load->module('cms_webpages');
$query = $this->cms_webpages->get_where_custom('url_page',$first_bit);
$num_rows = $query->num_rows();
//echo $num_rows;

if($num_rows>0){
	//page trouvé !!
foreach ($query->result() as $row) {
	$data['titre_page'] = $row->titre_page;
    $data['url_page'] = $row->url_page;
    $data['motcle_page'] = $row->motcle_page;
    $data['description_page'] = $row->description_page;
    $data['contenu_page'] = $row->contenu_page;
}
   

}else {
	//page non trouvé
	$this->load->module('parametre_web');
	$data['contenu_page'] = $this->parametre_web->_get_page_not_found_msg();
}

 $this->load->module('templates');
   $this->templates->main_page($data);
}
}
