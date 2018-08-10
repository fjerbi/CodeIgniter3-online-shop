<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color: red;'>","</p>") ?>


<?php 
if(isset($flash)){
	echo $flash;
}
?>
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
<p>Veuillez choisir la catégorie du produit</p>
<?php
$form_location = base_url()."store_cat_assign/submit/".$id_produit;
?>
<form class="form-horizontal" method="post" action="<?=$form_location?>">
						  <fieldset>
							<div class="control-group">
							<label class="control-label" for="typehead">Nouvelle option</label>
							<div class="controls">
								<?php

$additional_dd_code='id="selectError"';

echo form_dropdown('id_cat', $options,$id_cat,$additional_dd_code);
?>	
<br><br><br>
							</div>
						</div>
						<div class="form-actions">
							 <button type="submit" class="btn btn-primary" name="submit" value="Submit">OK</button>
							  <button type="submit" class="btn" name="submit" value="Finished">Annuler</button>
							</div>
						  </fieldset>
						</form>  
						</div>
					</div>
<?php
if($num_rows>0){ ?>


	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Liste des Produit avec les catégories</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
						<tr>	
							<th>count</th>
							<th>Nom de la Catégorie</th>
							<th>actions</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$count=0;
						$this->load->module('categories');
						foreach($query->result() as $row)
						{
							$count++;
							$delete_url = base_url()."store_cat_assign/delete/".$row->id;
							$parent_nom_categorie = $this->categories->_get_parent_nom_categorie($row->id_cat);
							$nom_categorie = $this->categories->_get_nom_categorie($row->id_cat);
							$full_nom_categorie= $parent_nom_categorie.">".$nom_categorie;
							?>
							<tr>
								<td><?= $count ?></td>
								<td class="center"><?= $full_nom_categorie ?></td>
<td class="center">
	<a class="btn btn-danger" href="<?= $delete_url ?>">
		<i class="halflings-icon white trash"></i>Supprimer de la catégorie
	</a>

</td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
</div>


<?php
}
?>
						