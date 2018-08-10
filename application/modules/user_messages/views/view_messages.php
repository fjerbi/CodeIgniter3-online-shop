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



<h1>Votre <?= $folder_type?></h1>

<?php
if(isset($flash)){
  echo $flash;
}

  $create_message_url=base_url()."user_messages/create";
  ?><p style="margin-top:30px">
		<a href="<?= $create_message_url ?>"><button type="submit" class="btn btn-primary">Composer un nouveau message</button>

    </p>

<style type="text/css">
  
.urgent{
  color: red;
  
}

</style>
<div class="row-fluid sortable">    
        <div class="box span12">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white envelope"></i><span class="break"></span><?= $folder_type ?></h2>
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
                   <th>&nbsp;</th>
                  <th>Date d'envoi</th>
                  <th>envoyé  par</th>
                  <th>Sujet</th>
               
                  <th>Actions</th>
                </tr>
              </thead>   
              <tbody>
                <?php
                $this->load->module('users');
$this->load->module('timedate');
                foreach ($query->result() as $row) { 

$view_url = base_url()."user_messages/view/".$row->id;


                  $customer_data['nom'] = $row->nom;
                  $customer_data['prenom'] = $row->prenom;
                  $customer_data['societe'] = $row->societe;
                  $ouvert = $row->ouvert;
                  $urgent = $row->urgent;
                  if($ouvert ==1){
                    $icon = '<i class="icon-envelope"></i>';
                  }else{
                    $icon = '<i class="icon-envelope-alt" style="color: orange;"></i>';
                  }
                  $date_sent = $this->timedate->get_date($row->date_creation,'datepicker');
              

              if($row->envoye_par ==0){
                $envoye_par ="Administrateur";
              }else{
$envoye_par =$this->users->_get_customer_name($row->envoye_par, $customer_data);
           
              }
                ?>
               <tr <?php

if($urgent==1){
  echo 'class="urgent"';
}

               ?>>
                   <td class="span1"><?= $icon?></td>
                  <td><?= $date_sent ?></td>
                  <td><?= $envoye_par ?></td>
                  <td><?= $row->sujet ?></td>
                 
                  <td class="span1">
                    <a class="btn btn-info" href="<?= $view_url ?>">
                    <i class="halflings-icon white edit"></i>  
                  </a>
                  </td>
                </tr>
              
                <?php
}
                ?>
                
              </tbody>
            </table>            
          </div>
        </div><!--/span-->
      
      </div><!--/row-->  