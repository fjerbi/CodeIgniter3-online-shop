<?php
$first_segment= $this->uri->segment(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>VOTRE PANIER</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">

 
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
    <?php
    $dernier_total = 0;
    foreach ($query->result() as $row) {

    $total = $row->prix*$row->quantite_produit;
    $total_desc = number_format($total, 0);
    $dernier_total = $dernier_total + $total ;
    $dernier_total_desc= number_format($dernier_total, 0);
?>
<!-- Header - start -->

<!-- Header - end -->


<!-- Main Content - start -->
<main>
    <section class="container stylization maincont">


  
       
        <form action="#">

            <div class="cart-items-wrap">
                <table class="cart-items">
                    <thead>
                    <tr>
                        <td class="cart-image">IMAGE DU PRODUIT</td>
                        <td class="cart-ttl">PRODUIT</td>
                        <td class="cart-price">PRIX</td>
                        <td class="cart-quantity">QUANTITE</td>
                        <td class="cart-summ">TOTAL</td>
                        <td class="cart-del">&nbsp;</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="cart-image">
                            <a href="product.html">
                                <?php

if($row->image_mini!=''){?>
            <img src="<?= base_url(); ?>nohd_pics/<?= $row->image_mini ?>">
            <?php
}else{
    echo"Pas d'images disponible pour ce produit ";
}
?>
                            </a>
                        </td>
                        <td class="cart-ttl">
                            <a href="product.html"><?= $row->nom_produit ?></a>
                            <p>Disponibilité: EN STOCK</p>
                            
                        </td>
                        <td class="cart-price">
                            <b><?= $row->prix ?> TND</b>
                        </td>
                        <td class="cart-quantity">
                            <p class="cart-qnt">
                                <?= $row->quantite_produit ?>
                                
                            </p>
                        </td>
                        <td class="cart-summ">
                            <b><?= $total_desc   ?> TND</b>
                          
                        </td>
                        <td class="cart-del">
                          
<?php
if($first_segment!='myorders'){
     echo anchor('basket/remove/'.$row->id, 'Supprimer');
}
                          
?>
                        </td>
                    </tr>
                                                        <?php
}
?>
                    <tr>
                        
                    </tr>
                   
                    </tbody>
                </table>
            </div>

            <ul class="cart-total">
                <li class="cart-summ">Livraison: <b><?= $shipping ?> Millimes</b></li>

            </ul>
             <ul class="cart-total">
                <li class="cart-summ">GRAND TOTAL: <b><?php


 echo $dernier_total+ $shipping ?> TND</b></li>
                
            </ul>
            
        </form>
        <!-- Cart Items - end -->

    </section>
</main>
<!-- Main Content - end -->


<!-- Footer - start -->

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
