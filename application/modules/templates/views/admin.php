<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->

    <meta charset="utf-8">
    <title>Tableau de bord</title>
    <meta name="description" content="Bootstrap Metro Dashboard">
    <meta name="author" content="Dennis Ji">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->

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




</head>

 
<body>

    <?php
    if(isset($sort_categ)){
        require_once('sorting_code.php');
    }
    ?>


<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

                                
                <!-- start: Header Menu -->
                <div class="nav-no-collapse header-nav">
                   
                </div>
            <a class="brand" href="<?= base_url() ?>"><span>Tableau de bord</span></a>

            <!-- start: Header Menu -->
            
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    
                   
                    <li><a href="<?= base_url() ?>dashboard/home"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Accueil</span></a></li>
                    <li><a href="<?= base_url()?>order_status/manage"><i class="icon-file"></i><span class="hidden-tablet">États commandes</span></a></li>


<?php
echo Modules::run('order_status/_left_nav_links');
?>
                     <li><a href="<?= base_url() ?>items/manage"><i class="icon-tag"></i><span class="hidden-tablet"> Gérer les produits</span></a></li>

                      <li><a href="<?= base_url() ?>categories/manage"><i class="icon-sitemap"></i><span class="hidden-tablet"> Gérer les catégories</span></a></li>
                      <li><a href="<?= base_url() ?>home_offers/manage"><i class="icon-gift"></i><span class="hidden-tablet"> Gérer les offres </span></a></li>
                     <li><a href="<?= base_url() ?>users/manage"><i class="icon-briefcase"></i><span class="hidden-tablet"> Gérer les comptes</span></a></li>
                     <li><a href="<?= base_url() ?>cms_webpages/manage"><i class="icon-file"></i><span class="hidden-tablet"> Gérer les pages </span></a></li>
                     <li><a href="<?= base_url() ?>blog/manage"><i class="icon-file-alt"></i><span class="hidden-tablet">Gérer le Blog </span></a></li>
                    <li><a href="<?= base_url()?>user_messages/inbox"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
                    <li><a href="<?= base_url()?>sliders/manage"><i class="icon-picture"></i><span class="hidden-tablet"> Gérer les images défilantes</span></a></li>
                    <li><a href="<?= base_url()?>auth/index"><i class="icon-user"></i><span class="hidden-tablet"> Controle utilisateurs</span></a></li>

     <li><a href="<?= base_url()?>backup/backup_bdd"><i class="halflings-icon refresh"></i><span class="hidden-tablet"> Réstoration BASE DE DONNEES</span></a></li>
                     <li><a href="<?= base_url()?>auth/logout"><i class=" halflings-icon off"></i><span class="hidden-tablet"> Déconnexion</span></a></li>

                   
                </ul>
            </div>
        </div>
        <!-- end: Main Menu -->

        <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

        <!-- start: Content -->
        <div id="content" class="span10">


<?php
if (isset($view_file)){
$this->load->view($view_module.'/'.$view_file);
}
 ?>


        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->



<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <ul class="list-inline item-details">
            
        </ul>
    </div>
</div>

<div class="clearfix"></div>



<!-- start: JavaScript-->

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
</body>
</html>
