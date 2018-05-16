

<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color: red;'>","</p>") ?>


<?php 
if(isset($flash)){
	echo $flash;
}
if (is_numeric($update_id)) {?>


<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Options des comptes</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">



  <a href="<?= base_url() ?>users/update_pword/<?= $update_id ?>"><button type="button" class="btn btn-primary">Mettre à jour le mot de passe</button></a>
   <a href="<?= base_url() ?>users/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Supprimer le compte</button></a>
					</div>
				</div><!--/span-->

			</div><!--/row-->

			<?php
		}
		?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Details de l'utilisateur</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php
$form_location=base_url()."users/create/".$update_id;

						?>
						<form class="form-horizontal" method="post" action="<?=$form_location?>">
						  <fieldset>
					

					<div class="control-group"> <label class="control-label" for="typeahead">Nom de l'utilisateur/Pseudo</label> <div class="controls"> <input type="text" class="span6" name="pseudo" value="<?= $pseudo?>"> </div> </div>		
				<div class="control-group"> <label class="control-label" for="typeahead">Nom</label> <div class="controls"> <input type="text" class="span6" name="nom" value="<?= $nom?>"> </div> </div>

<div class="control-group"> <label class="control-label" for="typeahead">Prénom</label> <div class="controls"> <input type="text" class="span6" name="prenom" value="<?= $prenom?>"> </div> </div>
<div class="control-group"> <label class="control-label" for="typeahead">societe</label> <div class="controls"> <input type="text" class="span6" name="societe" value="<?= $societe?>"> </div> </div>
<div class="control-group"> <label class="control-label" for="typeahead">Address1</label> <div class="controls"> <input type="text" class="span6" name="address1" value="<?= $address1?>"> </div> </div>
<div class="control-group"> <label class="control-label" for="typeahead">Address2</label> <div class="controls"> <input type="text" class="span6" name="address2" value="<?= $address2?>"> </div> </div>
<div class="control-group"> <label class="control-label" for="typeahead">Ville</label> <div class="controls"> <input type="text" class="span6" name="ville" value="<?= $ville?>"> </div> </div>
<div class="control-group"> <label class="control-label" for="typeahead">Pays</label> <div class="controls"> <input type="text" class="span6" name="pays" value="<?= $pays?>"> </div> </div>
<div class="control-group"> <label class="control-label" for="typeahead">Code postal</label> <div class="controls"> <input type="text" class="span6" name="code_postal" value="<?= $code_postal?>"> </div> </div>
<div class="control-group"> <label class="control-label" for="typeahead">Numéro de téléphone</label> <div class="controls"> <input type="text" class="span6" name="num_tel" value="<?= $num_tel?>"> </div> </div>
<div class="control-group"> <label class="control-label" for="typeahead">Email</label> <div class="controls"> <input type="text" class="span6" name="email" value="<?= $email?>"> </div> </div>


							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Valider</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">Annuler</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
