
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
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
    <title>VOTRE PANIER</title>


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
                <table class="table table-bordered">
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



<!-- jQuery plugins/scripts - end -->

</body>
</html>
