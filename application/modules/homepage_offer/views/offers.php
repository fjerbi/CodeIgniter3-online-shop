

<?php

foreach($query->result() as $row){

$ancien_prix= $row->ancien_prix;
    $prix_produit= $row->prix_produit;
    $ancien_prix= $row->ancien_prix;
$nom_produit= $row->nom_produit;
$description_produit = $row->description_produit;
    $image_mini= $row->image_mini;
    $image_mini_path= base_url()."nohd_pics/".$image_mini;
    $item_page = base_url().$item_segments.$row->url_produit;
$prix_produit = number_format($row->prix_produit, 0);
$prix_produit = str_replace('.00', '', $prix_produit);


?>

<div class="prod-items section-items">

        <div class="prod-i">
          <div class="prod-i-top">
            <div class="prod-sticker">
              <p class="prod-sticker-1">Nouveau</p>
              <br><p class="prod-sticker-2">EN PROMOTION</p>
            </div>

            <a href="<?=$item_page?>" class="prod-i-img"><!-- NO SPACE --><img src="<?=$image_mini_path?>" alt="Adipisci aperiam commodi"><!-- NO SPACE --></a>
            <p class="prod-i-info">
              <a href="#" class="prod-i-favorites"><span>Wishlist</span><i class="fa fa-heart"></i></a>
              <a href="<?=$item_page?>" class="qview-btn prod-i-qview"><span>Voir le produit</span><i class="fa fa-search"></i></a>
              <a class="prod-i-compare" href="#"><span>Comparer</span><i class="fa fa-bar-chart"></i></a>
            </p>
            <a href="<?=$item_page?>" class="prod-i-buy">Ajouter au panier</a>
            <p class="prod-i-properties-label"><i class="fa fa-info"></i></p>

            <div class="prod-i-properties">
              <dl>
                <dt>Déscription</dt>
                <dd><?=$description_produit?><br></dd>
             
              </dl>
            </div>
          </div>
          <h3>
            <a href="product.html"><?=$nom_produit?></a>
          </h3>
          <p class="prod-i-price">
            <?php
if($ancien_prix>0){ ?>
<b style="color: green;"></b><span style="font-weight:normal, color: #999; text-decoration:line-through"><?= $ancien_prix ?> TND
</span>
<?php
}
?>
<br>
            <b><?= $prix_produit?> TND</b>


          </p>
          <div class="prod-i-skuwrapcolor">
            <ul class="prod-i-skucolor">
             
              <li class="bx_active"><img src="<?php echo base_url();?>mojs/template/img/color/blue.jpg" alt="Blue"></li>
            </ul>
          </div>
        </div>



<?php
}

?>