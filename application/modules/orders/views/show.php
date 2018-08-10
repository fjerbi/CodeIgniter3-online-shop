   <link id="bootstrap-style" href="<?php echo base_url(); ?>adminfiles/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>adminfiles/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="<?php echo base_url(); ?>adminfiles/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo base_url(); ?>adminfiles/css/style-responsive.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>


        <link id="ie-style"  href="<?php echo base_url(); ?>/adminfiles/css/ie.css " rel="stylesheet">

    <![endif]-->

    <!--[if IE 9]>
        <link id="ie9style" href="<?php echo base_url(); ?>adminfiles/css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>adminfiles/img/favicon.ico">
    <!-- end: Favicon -->

<h1>Gérer Les commandes</h1>
<h2><?= $current_order_name ?></h2>
<?php
if(isset($flash)){
  echo $flash;
}

function get_customer_name($nom, $prenom, $societe)
{


  $nom = trim(ucfirst($nom));
  $prenom = trim(ucfirst($prenom));
    $societe = trim(ucfirst($societe));

    $company_length = strlen($societe);
    if($company_length>2){
      $customer_name = $societe;
    }else{
      $customer_name = $nom." ".$prenom;
    }

    return $customer_name;
  }



  $paypal_url="http://www.paypal.com";
  ?>




 <?php
if($num_rows<1){
  echo "<p> Il ny'a aucune commandes dans cette catégorie</p>";
}else{
echo "<p>".$showing_statement.'</p>';
echo $pagination;

?>



<div class="row-fluid sortable">    
        <div class="box span12">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white tag"></i><span class="break"></span>Liste des commandes</h2>
            <div class="box-icon">
              <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
          </div>
          <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                <tr>
                  <th>Libélle commande </th>
                  <th>valeur de la commande(prix) </th>
                  <th>Date de création </th>
                  <th>Nom de l'acheteur</th>
                  <th>Statut de la commande</th>
                  <th>Ouvert</th>
                  <th>Actions</th>
               
                </tr>
              </thead>   
              <tbody>
                <?php
$this->load->module('timedate');
                foreach ($query->result() as $row) { 
           
                $view_order_url = base_url()."orders/view/".$row->id;
                $ouvert = $row->ouvert;
$date_created = $this->timedate->get_date($row->date_creation, 'full');

$nom = $row->nom;
$prenom = $row->prenom;
$societe = $row->societe;
$customer_name = get_customer_name($nom, $prenom, $societe);
if(isset($row->nom_statut)){
  $order_status = $row->nom_statut;
}else{
  $order_status='Commandes Expédiées';//statut_commande= 0
}

                if($ouvert==1){
                  $status_label = "success";
                  $status_desc = "Ouvert";
                }else{
                  $status_label ="important";
                  $status_desc ="Non ouvert";
                }
                ?>
              <tr>
               <td><?= $row->libelle_commande ?></td>
               <td><?= $row->mc_gross ?></td>
                <td><?= $date_created ?></td>
               
                <td class="center"><?= $customer_name?></td>
                <td class="center"><?= $order_status?></td>
               
                <td class="center">
                  <span class="label label-<?= $status_label ?>"><?= $status_desc ?></span>
                </td>
                <td class="center">
                  <a class="btn btn-success" href="<?= $view_order_url ?>">
                    <i class="halflings-icon white zoom-in"></i>  
                  </a>
               
                  
                </td>
              </tr>
              <tr>
                <?php
}
                ?>
                
              </tbody>
            </table>            
          </div>
        </div><!--/span-->
      
      </div><!--/row-->

          <?php


echo $pagination;
}
    ?>



    <script src="<?php echo base_url(); ?>adminfiles/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery-migrate-1.0.0.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.ui.touch-punch.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/modernizr.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.cookie.js"></script>

<script src='<?php echo base_url(); ?>adminfiles/js/fullcalendar.min.js'></script>

<script src='<?php echo base_url(); ?>adminfiles/js/jquery.dataTables.min.js'></script>

<script src="<?php echo base_url(); ?>adminfiles/js/excanvas.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery.flot.stack.js"></script>
<script src="<?php echo base_url(); ?>adminfiles/js/jquery.flot.resize.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.chosen.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.uniform.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.cleditor.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.noty.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.elfinder.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.raty.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.iphone.toggle.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.uploadify-3.1.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.gritter.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.imagesloaded.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.masonry.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.knob.modified.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/jquery.sparkline.min.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/counter.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/retina.js"></script>

<script src="<?php echo base_url(); ?>adminfiles/js/custom.js"></script>
<!-- end: JavaScript-->
<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({

            	message: "Welcome to LaraShop55 Admin."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>