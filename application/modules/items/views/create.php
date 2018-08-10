

<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color: red;'>","</p>") ?>


<?php 
if(isset($flash)){
	echo $flash;
}
if (is_numeric($id_produit)) {?>


<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Options du produit</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">

<?php
if($image_produit =="") {?>

  <a href="<?= base_url() ?>items/upload_image/<?= $id_produit ?>"><button type="button" class="btn btn-primary">importer l'image du produit</button></a>
 <?php

}else {
?>
<a href="<?= base_url() ?>items/delete_image/<?= $id_produit ?>"><button type="button" class="btn btn-danger">Supprimer l'image du produit</button></a>
<?php

}
?>

  <a href="<?= base_url() ?>store_cat_assign/update/<?= $id_produit ?>"><button type="button" class="btn btn-primary">Mettre à jour la catégorie du produit</button></a>
  <a href="<?= base_url() ?>items/deleteconf/<?= $id_produit ?>"><button type="button" class="btn btn-danger">Supprimer le  produit</button></a>

					</div>
				</div><!--/span-->

			</div><!--/row-->

			<?php
		}
		?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Details du produit</h2>
						<div class="box-icon">
							 <a href="#" id="toggle-fullscreen" class="hidden-phone hidden-tablet"><i class="halflings-icon white fullscreen"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php
$form_location=base_url()."items/create/".$id_produit;

						?>
						<form class="form-horizontal" method="post" action="<?=$form_location?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Nom du produit</label>
							  <div class="controls">
								<input type="text" class="span6" name="nom_produit" value="<?= $nom_produit ?>">
							
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Prix du produit</label>
							  <div class="controls">
								<input type="text" class="span1" name="prix_produit" value="<?= $prix_produit ?>">
							
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Ancien prix(optionnel)</label>
							  <div class="controls">
								<input type="text" class="span1" name="ancien_prix" value="<?= $ancien_prix ?>">
							
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Quantité du produit</label>
							  <div class="controls">
								<input type="text" class="span1" name="quantite_produit" value="<?= $quantite_produit ?>">
								<div class="control-group">
							  <label class="control-label" for="typeahead">frais de livraison du produit</label>
							  <div class="controls">
								<input type="text" class="span1" name="shipping" value="<?= $shipping ?>">
							
							  </div>
							  <br>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Statut</label>
							  <div class="controls">

<?php

$additional_dd_code='id="selectError3"';
$options = array(
	'' => 'Veuillez Choisir une option',
        '1'         => 'Actif',
        '0'           => 'Inactif',
   
);


echo form_dropdown('status', $options,$status,$additional_dd_code);
?>								

 

								
							  </div>
							</div>
						<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Description du produit</label>
							  <div class="controls">
							  	<textarea class="form-control" rows="9" id="textarea2"  name="description_produit"><?php echo $description_produit;

								?></textarea>






							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">OK</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">ANNULER</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
<?php
if($image_produit !="") {?>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>L'image du produit</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
  <img src="<?= base_url() ?>hd_pics/<?= $image_produit ?> " >
				</div><!--/span-->

			</div><!--/row-->

			<?php
		}
		?>