

<h1><?= $titre_block ?></h1>
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
