<div class="prod-items section-items">
<center><h1><?= $nom_categorie ?></h1></center>
<p><?= $showing_statement ?></p>
<?= $pagination ?>




<div class="row">

<?php
foreach($query->result() as $row)
{

$ancien_prix= $row->ancien_prix;
	$prix_produit= $row->prix_produit;
$nom_produit= $row->nom_produit;
	$image_mini= $row->image_mini;
	$image_mini_path= base_url()."nohd_pics/".$image_mini;
	$item_page = base_url().$item_segments.$row->url_produit;

	
?>
				<div class="prod-i">
					<div class="prod-i-top">
						<a href="<?=$item_page?>" class="prod-i-img"><!-- NO SPACE --><img src="<?= $image_mini_path ?>  "  title="<?= $nom_produit ?>" alt="<?= $nom_produit ?>"><!-- NO SPACE --></a>
						
						<a href="<?=$item_page?>" class="prod-i-buy">Ajouter au panier</a>
						

					
					</div>
					<h3>
						<a href="<?=$item_page ?>" ><?= $nom_produit ?></a>
					</h3>
<?php
if($ancien_prix>0){ ?>

					<p class="prod-i-price">
						
						<center><p style="color: green;"><b  style="font-weight:normal, color: red; text-decoration:line-through" ><?= $ancien_prix ?> TND</b></p></center>
					<p class="prod-i-price">

						<b><?=$prix_produit ?></b>

					</p>
					<?php
}
?>
					<div class="prod-i-skuwrapcolor">

						<ul class="prod-i-skucolor">
							
							<li class="bx_active"><img src="<?php echo base_url();?>mojs/template/img/color/blue.jpg" alt="Blue"></li>
						</ul>
					</div>

				</div>
				

<?php
}
?>



<?php

/*
<h1><?= $nom_categorie ?></h1>
<p><?= $showing_statement ?></p>
<?= $pagination ?>




<div class="row">

<?php
foreach($query->result() as $row)
{
$ancien_prix= $row->ancien_prix;
	$prix_produit= $row->prix_produit;
$nom_produit= $row->nom_produit;
	$image_mini= $row->image_mini;
	$image_mini_path= base_url()."nohd_pics/".$image_mini;
	$item_page = base_url().$item_segments.$row->item_url;

	
?>
<div class ="col-md-2 img-thumbnail" style="margin :6px; height: 340px">
<a href="<?= $item_page ?>"><img src="<?= $image_mini_path ?>" title="<?= $nom_produit ?>" class="img-responsive" ></a>
<br>
<h5><?= $nom_produit ?></h5>
<div style="clear: both; color: red; font-weight: bold;"><?= number_format($prix_produit) ?> TND

</div>
<?php
if($ancien_prix>0){ ?>
<p style="color: green;">Ancien Prix :</p><span style="font-weight:normal, color: #999; text-decoration:line-through"><?= $ancien_prix ?> TND
</span>
<?php
}
?>
</div>
</span>

<?php
}
?>
</div>
<?= $pagination ?>

*/
?>