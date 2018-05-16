<h1><?=$headline ?></h1>



<?php 
if(isset($flash)){
	echo $flash;
}
?>


<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white icon-trash"></i><span class="break"></span>Confirmer la suppression</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
  


<p>Etes-vous sure de vouloir supprimer cette page ? .</p>

<?php
$attributes = array('class' => 'form-horizontal');
 echo form_open('cms_webpages/delete/'.$update_id, $attributes);
?>

 

						  <fieldset>							

							<div class="control-group ">

								<button type="submit" name ="submit" value ="Oui" class="btn btn-danger">Oui</button>
			 <button type="submit" name ="submit" value ="Cancel" class="btn">Non</button>

								
							 
							  </div>
							</div>          
							
							
						  </fieldset>
						</form>   


					</div>
				</div><!--/span-->

			</div><!--/row-->
