

<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color: red;'>","</p>") ?>


<?php 
if(isset($flash)){
	echo $flash;
}
?>


<?php
echo Modules::run('paypal/_display_info', $id_paypal);
if (is_numeric($update_id)) {?>








<div class="row-fluid sortable">    
        <div class="box span12">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white file"></i><span class="break"></span>STATUT DE LA COMMANDE : <?= $nom_statut?></h2>
            <div class="box-icon">
              <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
          </div>

          <div class="box-content">
          <p>Pour mettre à jour le statut de la commande choisissez l'une des options en dessous </p>
<?php
$form_location=base_url()."orders/save_order_status/".$update_id;

						?>
						<form class="form-horizontal" method="post" action="<?=$form_location?>">
						  <fieldset>

<div class="control-group">
							  <label class="control-label" for="typeahead">Statuts:</label>
							  <div class="controls">
<?php

$additional_dd_code='id="selectError"';

echo form_dropdown('statut_commande', $options,$statut_commande,$additional_dd_code);
?>								

 

								
							  </div>
							</div>


						
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Valider</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">Annuler</button>
							</div>
						  </fieldset>
						</form> 

      </div>
          
</div>
</div>

		<?php
		}
		?>	
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Details du client</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
				
  <p style="text-align: right;"><a href="<?= base_url()?>users/create/<?=$id_acheteur ?>">
  	<button type="button" class="btn btn-danger">Modifier les détails du compte</button>
  </a>
<table class='table table-striped table-bordered'>
	<tr>
		<td class="span3"> Nom </td>
		<td><?=$users_data['nom'] ?></td>
	</tr>
		<tr>
		<td> Prenom </td>
		<td><?=$users_data['prenom'] ?></td>
	</tr>
	<tr>
		<td> Sociéte </td>
		<td><?=$users_data['societe'] ?></td>
	</tr>

	<tr>
		<td> Numéro de télephone </td>
		<td><?=$users_data['num_tel'] ?></td>
	</tr>

	<tr>
		<td> Email </td>
		<td><?=$users_data['email'] ?></td>
	</tr>
	<tr>
		<td> Addresse du client </td>
		<td><?=$customer_address ?></td>
	</tr>

</table>
							

					</div>
				</div><!--/span-->

			</div><!--/row-->


<?php

$user_type='admin';
	echo Modules::run('cart/_cart_contents', $query_c, $user_type);