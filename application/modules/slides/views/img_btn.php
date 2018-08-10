<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white picture"></i><span class="break"></span>Options des images</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<p><?= $btn_info ?></p>

<?php
if($dispo_pic==False){ ?>
<a href="<?= base_url()?>slides/upload_image/<?= $update_id?>"><button type="button" class="btn btn-info">Importer l'image du produit</button></a>
<?php
}else{
	echo "<img src='".$pic_path."'>";
}
?>

  <a href="<?= base_url()?>slides/deleteconf/<?= $update_id?>"><button type="button" class="btn btn-danger"><?=$btn_style?>Supprimer le  produit</button></a>

					</div>
				</div><!--/span-->

			</div><!--/row-->
