

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
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Details du produit</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>

					<div class="box-content">
						<?php
$form_location=base_url()."categories/create/".$update_id;

						?>
						<form class="form-horizontal" method="post" action="<?=$form_location?>">
						  <fieldset>
<?php 
if($num_dropdown_options>1){
?>
<div class="control-group">
							  <label class="control-label" for="typeahead">Catégorie Parent</label>
							  <div class="controls">
<?php

$additional_dd_code='id="selectError"';

echo form_dropdown('id_categorie_parent', $options,$id_categorie_parent,$additional_dd_code);
?>								

 

								
							  </div>
							</div><?php
}else{
	echo form_hidden('id_categorie_parent',0);
}
?>



							<div class="control-group">
								   <div class="box-content alerts">
            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Notez Bien:</strong>Si vous voulez Créer une nouvelle catégories, Tapez juste le nom de la catégorie que vous voulez la créer, sinon , si vous voulez créer une sous catégories, chosissez la catégorie parent aprés taper le nom de la sous catégorie.
            </div>
           
          </div>
							  <label class="control-label" for="typeahead">Nom de la Catégorie/sous catégorie</label>
							  <div class="controls">
								<input type="text" class="span6" name="nom_categorie" value="<?= $nom_categorie ?>">
							
							  </div>
							</div>
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Valider</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">Annuler</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
