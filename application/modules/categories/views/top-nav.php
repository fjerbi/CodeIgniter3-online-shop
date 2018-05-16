 <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">
 <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/ion.rangeSlider.skinFlat.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/flexslider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/swiper.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/swiper.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>mojs/template/css/media.css">

<div class="cats">
<ul class="nav navbar-nav">
        <?php
        $this->load->module('categories');
          foreach ($parent_categories as $key => $value) {
            $id_categorie_parent = $key;
            $parent_nom_categorie = $value;

          ?>
          <style type="text/css">
            .dropdown{
              position: relative;
    display: inline-block;
    margin-bottom: 20px;
            }
            .dropdown-menu {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
}
.dropdown:hover .dropdown-menu {
    display: block;
}
          </style>
        <li class="dropdown">
        
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
          <?= $parent_nom_categorie?>  <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
            $query = $this->categories->get_where_custom('id_categorie_parent',$id_categorie_parent);
            foreach ($query->result() as $row) {
              $url_categorie = $row->url_categorie;
              echo'<li><a href="'.$target_url_start.$url_categorie.'">'.$row->nom_categorie.'</a></li>';
            }
            ?>
            
     
          </ul>
        </li>
     <?php
   }
   ?>
      </ul>


<script src="<?php echo base_url();?>mojs/template/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/jquery.bxslider.min.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/fancybox/fancybox.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/jquery.flexslider-min.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/swiper.jquery.min.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/progressbar.min.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/jQuery.Brazzers-Carousel.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/plugins.js"></script>
<script src="<?php echo base_url();?>mojs/template/js/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhAYvx0GmLyN5hlf6Uv_e9pPvUT3YpozE"></script>
<script src="<?php echo base_url();?>mojs/template/js/gmap.js"></script>