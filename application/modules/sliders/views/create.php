

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
<h2><i class="halflings-icon white edit"></i><span class="break"></span>Options</h2>
<div class="box-icon">

<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
</div>
</div>
<div class="box-content">

<a href="<?= base_url() ?>sliders/manage"><button type="button" class="btn btn-success">Retourner</button></a>

<a href="<?= base_url() ?>slides/update_group/<?= $update_id ?>"><button type="button" class="btn btn-primary">Ajouter vos images </button></a>
<a href="<?= base_url() ?>sliders/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Supprimer l'image</button></a>
</div>
</div><!--/span-->

</div><!--/row-->

<?php
}


?>
<div class="row-fluid sortable">
<div class="box span12">
<div class="box-header" data-original-title>
<h2><i class="halflings-icon white edit"></i><span class="break"></span>Details de l'image</h2>
<div class="box-icon">

<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
</div>
</div>

<div class="box-content">

<?php
$form_location=base_url()."sliders/create/".$update_id;

?>
<form class="form-horizontal" method="post" action="<?=$form_location?>">
<fieldset>




<div class="control-group">
<label class="control-label" for="typeahead">Nom du block de l'image</label>
<div class="controls">
<input type="text" class="span6" name="titre_slider" value="<?= $titre_slider ?>">

</div>
</div>

<div class="control-group">
<label class="control-label" for="typeahead">URL cible</label>
<div class="controls">
<input type="text" class="span6" name="target_url" value="<?= $target_url ?>">

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
