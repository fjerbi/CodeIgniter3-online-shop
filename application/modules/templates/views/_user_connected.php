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
<?php


$this->load->module('users');
$this->load->module('youraccount');
$this->load->module('securite');

              
?>

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


<body>
 <div class="header-middle">
        <div class="container header-middle-cont">
            <div class="toplogo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url();?>technipack_pictures/technipacklogo.png" alt="Technipack - Technique de packaging" style="margin-left: 500px;">

<?php


echo Modules::run('youraccount/user_pseudo');
?>
                </a>
            </div>

            <div class="shop-menu">
                <ul>
            <br>  <br>  <br>
                    <li class="topauth">



                        <a href="<?= base_url() ?>youraccount/logout">
                            <i class="fa fa-unlock"></i>
                            <span class="shop-menu-ttl">DECONNEXION</span>
                        </a>
                        
                    </li>
                    
                        <a href="<?= base_url() ?>youraccount/welcome">
                            <i class="fa fa-envelope"></i>
                            <span class="shop-menu-ttl"> MES MESSAGES</span>
                        </a>
                
                      


                    <li>
                        <div class="h-cart">
                            <a href="<?= base_url() ?>cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="shop-menu-ttl">MON PANIER</span>
                               
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="h-cart">
                            <a href="<?= base_url() ?>myorders/show">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="shop-menu-ttl">MES COMMANDES</span>
                               
                            </a>
                        </div>
                    </li>

          

                     <li>
                        <div class="h-cart">
                            <a href="<?= base_url() ?>blog/articles">
                              <i class="fa fa-globe"></i>
                                <span class="shop-menu-ttl">ACTUAITES ET NOUVEAUTES</span>
                               
                            </a>
                        </div>
                    </li>


 <li>
                        <div class="h-cart">
                            <a href="<?php echo base_url()?>chatroom/chatroom.php">
                              <i class="fa fa-comments-o"></i>
                                <span class="shop-menu-ttl">NOTRE CHATROOM</span>
                               
                            </a>
                        </div>
                    </li>
 

                </ul>
            </div>
        </div>
    </div>


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

