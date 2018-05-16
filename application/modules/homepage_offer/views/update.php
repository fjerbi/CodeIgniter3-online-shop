

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
$form_location=base_url()."homepage_offer/submit/".$update_id;

						?>
                <div class="row-fluid"> 
        <div class="box span12">
          
          <div class="box-header">
            <h2><i class="halflings-icon white white bullhorn"></i><span class="break"></span>Info</h2>
            <div class="box-icon">
              <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
          </div>
          <div class="box-content alerts">
            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Notez Bien:</strong> Tapez dans le champs ci-dessous L'ID du produit que vous voulez l'afficher dans l'offre.
            </div>
           
          </div>
          
        </div><!--/span-->
      </div><!--/row-->
						<form class="form-horizontal" method="post" action="<?=$form_location?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Nouvelle offre</label>
							  <div class="controls">
						
							<input type="text" class="span6" name="id_produit" placeholder="Veuillez taper L'id du produit que vous voulez appliquer à cette offre">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Valider</button>
							  <button type="submit" class="btn" name="submit" value="Finished">Annuler</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

<?php
if($num_rows>0) {

?>


		<div class="row-fluid sortable">    
        <div class="box span12">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white tag"></i><span class="break"></span>Liste des produits</h2>
            <div class="box-icon">
              <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
          </div>
          <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                <tr>
                  <th>Numéro</th>
                 <th>Offre</th>
                  <th>Actions</th>
                </tr>
              </thead>   
              <tbody>
                <?php
                $count = 0;
                foreach ($query->result() as $row) {
                	$count++;

                	$delete_url = base_url()."homepage_offer/delete/".$row->id;
                ?>
              <tr>
                <td><?= $count ?></td>
                
                <td class="center">ID du produit : <?= $row->id_produit?></td>
               
                
                <td class="center">
                  <a class="btn btn-success" href="<?= $delete_url ?>">
                    <i class="halflings-icon white trash"></i>  
                  </a>
                 
                  
                </td>
              </tr>
              <tr>
                <?php
}
                ?>
                
              </tbody>
            </table>            
          </div>
        </div><!--/span-->
      
      </div><!--/row-->
      <?php

  }

  ?>
