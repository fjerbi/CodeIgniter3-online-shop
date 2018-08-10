<!-- Catalog Topbar - end -->
            <div class="prod-items section-items prod-tb">
             <center> <h1>VOTRE <?= $folder_type?></h1></center>

<?php
if(isset($flash)){
  echo $flash;
}

  $create_message_url=base_url()."messages/create";
  ?>
 <div class='cart-submit' style="margin-right: 900px;">
               
           

  <p style="margin-top:30px">
    <a href="<?= $create_message_url ?>"><button type="submit" class="cart-submit-btn">Composer un nouveau message</button>
    </div>
 </div>


    </p>
    <br><br><br>
    <?php
                $this->module('parametre_web');
                $this->load->module('users');
$this->load->module('timedate');
$support_name = $this->parametre_web->_get_support_team_name();
                foreach ($query->result() as $row) { 

$view_url = base_url()."messages/view/".$row->code;


                  $customer_data['nom'] = $row->nom;
                  $customer_data['prenom'] = $row->prenom;
                  $customer_data['societe'] = $row->societe;
                  $ouvert = $row->ouvert;
                  if($ouvert ==1){
                    $icon = '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>';
                  }else{
                    $icon = '<span style="color: orange;" class="glyphicon glyphicon-envelope" aria-hidden="true"></span>';
                  }
                  $date_sent = $this->timedate->get_date($row->date_creation,'datepicker');
              

              if($row->envoye_par ==0){
                $envoye_par =$support_name;
              }else{
$envoye_par =$this->users->_get_customer_name($row->envoye_par, $customer_data);
           
              }
                ?>
                <div class="prodtb-i">
                    <div class="prodtb-i-top">
                        <button class="prodtb-i-toggle" type="button"><?= $icon?></button>
                        <h3 class="prodtb-i-ttl"><a href="<?= $view_url ?>"><?= $date_sent ?></a></h3>
                        <div class="prodtb-i-info">
                        <span class="prodtb-i-price">
                            <b><?= $envoye_par ?></b>
                                                    </span>
                            <p class="prodtb-i-qnt">
                               
                               ss
                            </p>
                        </div>
                        <p class="prodtb-i-action">
                          <?= $row->sujet ?>
                        </p>

<p class="prodtb-i-action">
                          <?= $row->sujet ?>
                        </p>

                    </div>
                                 <?php
}
                ?>


<script src="<?php echo base_url();?>styles/template/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/jquery.bxslider.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/fancybox/fancybox.js"></script>
<script src="<?php echo base_url();?>styles/template/js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script src="<?php echo base_url();?>styles/template/js/jquery.flexslider-min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/swiper.jquery.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/progressbar.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/jQuery.Brazzers-Carousel.js"></script>
<script src="<?php echo base_url();?>styles/template/js/plugins.js"></script>
<script src="<?php echo base_url();?>styles/template/js/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhAYvx0GmLyN5hlf6Uv_e9pPvUT3YpozE"></script>
<script src="<?php echo base_url();?>styles/template/js/gmap.js"></script>
<!-- jQuery plugins/scripts - end -->
<?php
/*

    <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">

 <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">
 <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/ion.rangeSlider.skinFlat.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/flexslider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/swiper.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/swiper.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>styles/template/css/media.css">


<!-- Header - start -->







<h1>Votre <?= $folder_type?></h1>

<?php
if(isset($flash)){
  echo $flash;
}

  $create_message_url=base_url()."messages/create";
  ?><p style="margin-top:30px">
		<a href="<?= $create_message_url ?>"><button type="submit" class="btn btn-primary">Composer un nouveau message</button>

    </p>

<div class="row-fluid sortable">    
        <div class="box span12">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white envelope"></i><span class="break"></span></h2>
            <div class="box-icon">
              <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
          </div>
          <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                <tr style="background-color: #3b62a0; color:white;">
                   <th>&nbsp;</th>
                  <th>Date d'envoi</th>
                  <th>envoyé  par</th>
                  <th>Sujet</th>
               
                  <th>Actions</th>
                </tr>
              </thead>   
              <tbody>
                <?php
                $this->module('parametre_web');
                $this->load->module('users');
$this->load->module('timedate');
$support_name = $this->parametre_web->_get_support_team_name();
                foreach ($query->result() as $row) { 

$view_url = base_url()."messages/view/".$row->code;


                  $customer_data['nom'] = $row->nom;
                  $customer_data['prenom'] = $row->prenom;
                  $customer_data['company'] = $row->company;
                  $opened = $row->opened;
                  if($opened ==1){
                    $icon = '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>';
                  }else{
                    $icon = '<span style="color: orange;" class="glyphicon glyphicon-envelope" aria-hidden="true"></span>';
                  }
                  $date_sent = $this->timedate->get_date($row->date_creation,'cool');
              

              if($row->envoye_par ==0){
                $envoye_par =$support_name;
              }else{
$envoye_par =$this->users->_get_customer_name($row->envoye_par, $customer_data);
           
              }
                ?>
               <tr>
                   <td class="span1"><?= $icon?></td>
                  <td><?= $date_sent ?></td>
                  <td><?= $envoye_par ?></td>
                  <td><?= $row->sujet ?></td>
                 
                  <td class="span1">
                    <a class="btn btn-warning" href="<?= $view_url ?>">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> view 
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
<!-- jQuery plugins/scripts - start -->
<script src="<?php echo base_url();?>styles/template/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/jquery.bxslider.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/fancybox/fancybox.js"></script>
<script src="<?php echo base_url();?>styles/template/js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script src="<?php echo base_url();?>styles/template/js/jquery.flexslider-min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/swiper.jquery.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/progressbar.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>styles/template/js/jQuery.Brazzers-Carousel.js"></script>
<script src="<?php echo base_url();?>styles/template/js/plugins.js"></script>
<script src="<?php echo base_url();?>styles/template/js/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhAYvx0GmLyN5hlf6Uv_e9pPvUT3YpozE"></script>
<script src="<?php echo base_url();?>styles/template/js/gmap.js"></script>

*/
?>