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
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Iportation avec réussit</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
  
<div class="alert alert-success">Your file was successfully uploaded!</div>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p>
	<?php
$edit_item_url = base_url()."blog/create/".$update_id;
	?>
<a href ="<?= $edit_item_url ?>"><button type="button" class="btn btn-primary" >Retourner vers le Blog</button></p>
</a>

					</div>
				</div><!--/span-->

			</div><!--/row-->
