
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>Bienvenue </title>

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

</head>
<body>

<!-- Header - start -->
<header class="header">

    <!-- Topbar - start -->
    <div class="header_top">
        <div class="container">
            <ul class="contactinfo nav nav-pills">
                <li>
                    <i class='fa fa-phone'></i> +216 71 658 985
                </li>
                <li>
                    <i class="fa fa-envelope"></i> technipack@gmail.com
                </li>
            </ul>
            

            <!-- Social links -->
            <ul class="social-icons nav navbar-nav">
                <li>
                    <a href="http://facebook.com" rel="nofollow" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="http://google.com" rel="nofollow" target="_blank">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li>
                <li>
                    <a href="http://twitter.com" rel="nofollow" target="_blank">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="http://vk.com" rel="nofollow" target="_blank">
                        <i class="fa fa-vk"></i>
                    </a>
                </li>
                <li>
                    <a href="http://instagram.com" rel="nofollow" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>

                </li>
            </ul>       </div>
    </div>

            <?php

$this->load->library('user_agent');

if ($this->agent->is_browser())
{
        $agent = $this->agent->browser().' '.$this->agent->version();
}
elseif ($this->agent->is_robot())
{
        $agent = $this->agent->robot();
}
elseif ($this->agent->is_mobile())
{
        $agent = $this->agent->mobile();
}
else
{
        $agent = 'Unidentified User Agent';
}

echo " <i class='fa fa-globe'></i> Votre navigateur est : "." ".$agent;

echo"<br> Votre systéme d'exploitation est"." ".$this->agent->platform();
echo "<br>votre addresse Ip".$this->input->ip_address();

            ?>


      <div style="float: right;">
  <script type="text/javascript">
var bannersnack_embed = {"hash":"bcmeh0a0p","width":250,"height":250,"t":1529321741,"userId":36499606,"type":"html5"};
</script>
<script type="text/javascript" src="//cdn.bannersnack.com/iframe/embed.js"></script>

</div>

<?php

function api()
{
$endpoint = 'latest';
$access_key = 'b67049a06c7ef4187e5bd0b32ba765b2';

// Initialize CURL:
$ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$exchangeRates = json_decode($json, true);


}
?>

<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);

* {
  padding: 0;
  margin: 0;
  list-style: none;
}

body {
  background: #1a1a1a;
  font-family: 'Arial';
}

h1 {
  color: white;
  margin-top: 20px;
  font-size: 40px;
}

marquee {
  background: #f8fafc;
  margin: 30px auto;
  padding: 0 10px;
  display: block;
  color: #fff;
}

marquee:nth-child(2) {
  background: grey;
}

.ticker-up li {
  margin-bottom: 15px;
  font-size: 18px;
  letter-spacing: 1px;
}

</style>
<center>
 
</center>
<div style="float: right; margin-top: 75px;">
<marquee 
  direction="up" 
  height="40px" 
  width="380px" 
  scrollamount="2"
  onmouseover="this.stop();" 
  onmouseout="this.start();"
>
  <ul class="ticker-up">
     <h1>Taux de change:</h1>
    <li><?= api() ?></li>
    
  </ul>
</marquee>
</div>


    <!-- Logo, Shop-menu - start -->
   <?= Modules::run('templates/_page_top') ?>
    <!-- Logo, Shop-menu - end -->

    <!-- Topmenu - start -->
    <div class="header-bottom">
        <div class="container">
            <nav class="topmenu">

                <!-- Catalog menu - start -->

                <div class="topcatalog">
                    
                    <a class="topcatalog-btn"><span>LES </span>CATEGORIES</a>
                </div>
           
                
                    <style type="text/css">
                        
                    </style>
                    <div class="cats">



                                                                                 <?php
echo Modules::run('categories/_create_top_nav');

?>
</div>
                        </ul>
                    
            
                <!-- Main menu - end -->

                <!-- Search - start -->
               <div class="topsearch">
                    <a id="topsearch-btn" class="topsearch-btn" href="#"><i class="fa fa-search"></i></a>
                    <form class="topsearch-form" action="#">
                        <input type="text" placeholder="Search products" name="search_text" id="search_text" >
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- Search - end -->

            </nav>  

<?php
echo Modules::run('sliders/_attempt_draw_slider');

// si l'utulisateur est connecté
if($customer_id>0){
include('user_panel_top.php');
}

    if(isset($contenu_page)){
        echo nl2br($contenu_page);
if(!isset($url_page)){
$url_page = 'homepage';
}

require_once('content_homepage.php');
if ($url_page="contactus") {
  echo Modules::run('contactus/_draw_form');
}

/*if($page_url==""){
  require_once('content_homepage.php');

}elseif ($page_url="contactus") {
  echo Modules::run('contactus/_draw_form');
}
*/

    }elseif (isset($view_file)) {
        $this->load->view($view_module.'/'.$view_file);
    }

 ?>

                </div>

  
    </div>
<br><br>
    <!-- Topmenu - end -->

</header>

<!-- Header - end -->
 <!-- Testimonials -->
        <div class="reviews-wrap">
            <div class="reviewscar-wrap">
                <div class="swiper-container reviewscar">
                    <div class="swiper-wrapper">
                      
                        </div>
                      
                    </div>
                </div>
            
                <div class="swiper-container reviewscar-thumbs">
             
                </div>



    <div class="banners-wrap">
            <div class="banners-list">
                <div class="banner-i style_11">
                    <span class="banner-i-bg" style="background: url(<?php echo base_url();?>mojs/ship.jpg);"></span>
                    <div class="banner-i-cont">
               
                        <h3 class="banner-i-ttl">PAYER EN LIGNE</h3>
                       
                    </div>
                </div>
                <div class="banner-i style_22">
                    <span class="banner-i-bg" style="background: url(<?php echo base_url();?>mojs/livraison.jpg); height: 300px; width: 250px"></span>
                    <div class="banner-i-cont">
                       
                        <br><br><br><br><br><br>
                        <h3 class="banner-i-ttl">PAYER<br>A LA LIVRAISON </h3>
                       
                    </div>
                </div>
               
                
                
                <div class="banner-i style_12">
                    <span class="banner-i-bg" style="background: url(<?php echo base_url();?>mojs/commerce.png);"></span>
                    <div class="banner-i-cont">
                       
                        <p class="banner-i-link"><a href="section.html">VOIR PLUS </a></p>
                    </div>
                </div>
            </div>
        </div>



            </div>
        </div>

        <!-- Subscribe Form -->
        <div class="newsletter">
            <h3>Abonnez-vous à notre NEWSLETTER</h3>
            <p>Entrer votre E-mail pour rcevoir tous nos nouveaux produits</p>
            <form action="#">
                <input placeholder="Votre e-mail" type="text">
                <input name="OK" value="Subscribe" type="submit">
            </form>
        </div>


<!-- Main Content - start -->

<!-- Main Content - end -->


<!-- Footer - start -->


<footer class="footer-wrap">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="companyinfo" >
                   <div style="float: right;">
  <script type="text/javascript">
var bannersnack_embed = {"hash":"bx95euhu6","width":250,"height":250,"t":1529322105,"userId":36499606,"type":"html5"};
</script>
<script type="text/javascript" src="//cdn.bannersnack.com/iframe/embed.js"></script>


</div>
                </div>
                <div class="f-block-list">
                    <div class="f-block-wrap">
                        <div class="f-block">
                            <a href="#" class="f-block-btn" data-id="#f-block-modal-1">
                                <div class="iframe-img">
                                    <img src="<?php echo base_url();?>technipack_pictures/A_propos1.jpg" alt="à propos">
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-info-circle"></i>
                                </div>
                            </a>
                            <p class="f-info-ttl">à propos</p>
                            <p>Informations sur le payement et la livraison.</p>
                        </div>
                    </div>
                    <div class="f-block-wrap">
                        <div class="f-block">
                            <a href="#" class="f-block-btn" data-id="#f-block-modal-2">
                                <div class="iframe-img">
                                    <img src="<?php echo base_url();?>technipack_pictures/question.jpg" alt="Ask questions">
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </a>
                            <p class="f-info-ttl">Posez vos  questions</p>
                            <p>Nous vous appelons en 20 minutes au maximum.</p>
                        </div>
                    </div>
                    <div class="f-block-wrap">
                        <div class="f-block">
                            <a href="#" class="f-block-btn" data-id="#f-block-modal-3" data-content="<iframe width='853' height='480' src='https://www.youtube.com/embed/kaOVHSkDoPY?rel=0&amp;showinfo=0' allowfullscreen></iframe>">
                                <div class="iframe-img">
                                    <img src="<?php echo base_url();?>technipack_pictures/youtube.png" alt="Video (2 min)">
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle"></i>
                                </div>
                            </a>
                            <p class="f-info-ttl">Video (2 min)</p>
                            <p>Pour plus d'information à propos de notre sociéte, veuillez regarder la vidéo</p>
                        </div>
                    </div>

                    <div class="f-block-wrap">
                        <div class="f-block">
                            <a href="#" class="f-block-btn" data-id="#f-block-modal-4">
                                <div class="iframe-img">
                                    <img src="<?php echo base_url();?>technipack_pictures/addresse.jpg" alt="Our address">
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                            </a>
                            <p class="f-info-ttl">Notre addresse</p>
                            <p>Tunis, Ariana, 2073</p>
                        </div>
                    </div>

               
                </div>

                <div class="stylization f-block-modal f-block-modal-content" id="f-block-modal-1">
                    <img class="f-block-modal-img" src="<?php echo base_url();?>technipack_pictures/paypal.jpg" alt="About us">
                   Pour le payement, c'est à vous de choisir, que ce soit en ligne, via "Paypal" ou à la livraison.
                   Le payement est trés sécurisé, pour chaque achat et payement de l'un de nos produits
                    vous recevrez un E-maail contenant votre facture de payement.
                   Notez Bien : le statut de votre commande changera,dés que votre produit est livré, un message de confirmation sera envoyé 
                   dans votre boite de réception.
                   En cas de soucis, n'hésitez pas de nous contacter, par e-mail ou par meéssage.

                </div>

                
                <div class="stylization f-block-modal f-block-modal-callback" id="f-block-modal-2">
                    <div class="modalform">
                        <form action="#" method="POST" class="form-validate">
                            <p class="modalform-ttl">Questions</p>
                            <input type="text" placeholder="Votre nom" data-required="text" name="name">
                            <input type="text" placeholder="Votre Numéro" data-required="text" name="phone">
                            <button type="submit"><i class="fa fa-paper-plane"></i> Envoyer</button>
                        </form>
                    </div>
                </div>
                <div class="stylization f-block-modal f-block-modal-video" id="f-block-modal-3">

                </div>
                <div class="stylization f-block-modal f-block-modal-map" id="f-block-modal-4">
                    <div class="allstore-gmap">
                        <div class="marker" data-zoom="15" data-lat="35.00656815903028" data-lng="9.29474835928113" data-marker="img/marker.png">2073, Ariana, Cité Hedi Nouira,  Tunis</div>
                    </div>
                </div>
                   <div class="f-delivery">
                    <img src="<?php echo base_url();?>technipack_pictures/map.png" alt="">
                    <h4>Livraison gratuite en grand Tunis</h4>
                    <p>Le produit sera livré en maximum 48h.</p>
                </div>

            </div>
        </div>
    </div>
  
    <div class="container f-menu-list">
        <div class="row">
            <div class="f-menu">
                <h3>
                     à propos
                </h3>

                <ul class="nav nav-pills nav-stacked">

                    <li class="active"><a href="<?= base_url() ?>">Accueil</a></li>
                    <li><a href="catalog-list.html">Catégories</a></li>
                    <li><a href="elements.html">Elements</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="<?= base_url() ?>contactus">Contacts</a></li>
                </ul>
            </div>
           
 <img src="<?= base_url();?>mojs/carte_credit.png" style="float: right; margin-left: 100px; width: 300px;  "> 
            <div class="f-subscribe">
                <h3>Abonnez-vous</h3>
                <form class="f-subscribe-form" action="#">
                    <input placeholder="Your e-mail" type="text">
                    <button type="submit"><i class="fa fa-paper-plane"></i></button>
                </form>
                <p>Entrer votre E-mail si vous voulez recevoir nos nouveaux produits</p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <ul class="social-icons nav navbar-nav">
                    <li>
                        <a href="http://facebook.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://google.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://twitter.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://vk.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-vk"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://instagram.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>

                <div class="footer-copyright">
                     
                    <i><a href="https://themeforest.net/user/real-web?ref=real-web">Technipack</a></i> © Copyright 2018
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- Footer - end -->


<!-- jQuery plugins/scripts - start -->
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
<!-- jQuery plugins/scripts - end -->

</body>
</html>


<?php

/*
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico">

    <title>Bienvenue</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
  
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="<?php echo base_url();?>styles/socialbutton/css/style.css">

</head>
<script type="text/javascript">
    $(document).ready(function(){
      $('body').append('<div id="toTop" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-up"></span> Back to Top</div>');
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        }); 
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});

</script>
<style type="text/css">
    #toTop{
    position: fixed;
    bottom: 10px;
    right: 10px;
    cursor: pointer;
    display: none;
}
</style>
<style type="text/css">

    .social{
      float: left;
    }

    @import url(https://fonts.googleapis.com/css?family=Lato);
@import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css);
body {
    font-family: 'Lato', sans-serif;
    color: #FFF;
    background: #322f30;
    -webkit-font-smoothing: antialiased;
}
a {
    text-decoration: none;
    color: #fff;
}
p > a:hover{
    color: #d9d9d9;
    text-decoration:  underline;
}
h1,
h2,
h3,
h4,
h5,
h6 {
    margin:  1% 0 1% 0;
}
._12 {
    font-size: 1.2em;
}
._14 {
    font-size: 1.4em;
}
ul {
    padding:0;
    list-style: none;
}
.footer-social-icons {
    width: 200px;
    display:block;
    margin: 0 auto;
}
.social-icon {
    color: #fff;
}
ul.social-icons {
    margin-top: 10px;
}
.social-icons li {
    vertical-align: top;
    display: inline;
    height: 100px;
}
.social-icons a {
    color: #fff;
    text-decoration: none;
}
.fa-facebook {
    padding:10px 14px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.fa-facebook:hover {
    background-color: #3d5b99;
}
.fa-twitter {
    padding:10px 12px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.fa-twitter:hover {
    background-color: #00aced;
}
.fa-rss {
    padding:10px 14px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.fa-rss:hover {
    background-color: #eb8231;
}
.fa-youtube {
    padding:10px 14px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.fa-youtube:hover {
    background-color: #e64a41;
}
.fa-linkedin {
    padding:10px 14px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.fa-linkedin:hover {
    background-color: #0073a4;
}
.fa-google-plus {
    padding:10px 9px;
    -o-transition:.5s;
    -ms-transition:.5s;
    -moz-transition:.5s;
    -webkit-transition:.5s;
    transition: .5s;
    background-color: #322f30;
}
.fa-google-plus:hover {
    background-color: #e25714;
}

</style>
<style type="text/css">


</style>
<body>

    
<div class="container-fluid fjtop" style=" height: 90px; background-color: #322f30;">
  <div class="row">
/<?= Modules::run('templates_page_top') ?>
<br><br>
<div class="social">
 <div class="footer-social-icons">
  
    <ul class="social-icons">
        <li><a href="" class="social-icon"> <i class="fa fa-facebook"></i></a></li>
       
        
        
        <li><a href="" class="social-icon"> <i class="fa fa-linkedin"></i></a></li>
        <li><a href="" class="social-icon"> <i class="fa fa-google-plus"></i></a></li>
    </ul>
</div>
  </div>
<style type="text/css">
    
    .connexion{
        float: right;
    }
</style>
<div class="connexion">
    


</div>

  </div>
</div>

 
<nav class="navbar navbar-default " style="background-color: white;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>



           <a class="navbar-brand" href="<?php echo base_url(); ?>">Shopping en ligne</a><img src="<?php echo base_url();?>styles/shop.png" width="45" height="45" class="img-responsive"> 
        </div>




        <div id="navbar" class="navbar-collapse collapse">
            <?php
echo Modules::run('categories/_create_top_nav');

?>



 </div><!--/.navbar-collapse -->

    </div>

</nav>


<div class="container" style ="min-height:650px;">
    <?php
// si l'utulisateur est connecté
if($customer_id>0){
include('user_panel_top.php');
}

    if(isset($page_content)){
        echo nl2br($page_content);
if(!isset($page_url)){
$page_url = 'homepage';
}

if($page_url==""){
  require_once('content_homepage.php');

}elseif ($page_url="contactus") {
  echo Modules::run('contactus/_draw_form');
}


    }elseif (isset($view_file)) {
        $this->load->view($view_module.'/'.$view_file);
    }

 ?>


</div>
   
<div class="container">


  
    <footer>
        <?php
  echo Modules::run('templates/_draw_sub');

?>
         
       
    </footer>
</div> <!-- /container -->

<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCqYoE3L-sqirxn6Sn7KX200tuhmG-w4B0",
    authDomain: "test-12bf6.firebaseapp.com",
    databaseURL: "https://test-12bf6.firebaseio.com",
    projectId: "test-12bf6",
    storageBucket: "test-12bf6.appspot.com",
    messagingSenderId: "380196415202"
  };
  firebase.initializeApp(config);
</script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url(); ?>css/ie10-viewport-bug-workaround.css"></script>
</body>
</html>
*/
?>