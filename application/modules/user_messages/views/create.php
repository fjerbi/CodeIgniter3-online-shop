

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
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Details du message</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php
$form_location=base_url()."user_messages/create/".$update_id;

						?>
						<form class="form-horizontal" method="post" action="<?=$form_location?>">

<?php

if(!isset($envoye_par)){
	?>
<div class="control-group">
							  <label class="control-label" for="typeahead">Destinataire </label>
							  <div class="controls">

					  <?php
	 $additional_dd_code='class="form-control span4"';
						  echo form_dropdown('envoye_a', $options, $envoye_a,$additional_dd_code);

?>
								
							
							  </div>
							</div>
									

<?php
}

?>
	


							<div class="control-group">
							  <label class="control-label" for="typeahead">Sujet </label>
							  <div class="controls">
								<input type="text" class="span6" name="sujet" value="<?= $sujet ?>">
							
							  </div>
							</div>
									


					<div class="control-group hidden-phone">
							  <label class="control-label" >Message</label>
							  <div class="controls">
							  	<textarea class="span6" rows="9" id="textarea2"  name="message"><?php echo $message;

								?></textarea>

								
							  </div>
							</div>

							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Valider</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">Annuler</button>
							</div>
						  </fieldset>
						  <?php
if(isset($envoye_par)){
	echo form_hidden('envoye_a', $envoye_par);
}
						  ?>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->