
<h1>Gérer les images défilantes</h1>

<?php
if(isset($flash)){
echo $flash;
}

$create_item_url=base_url()."sliders/create";
?><p style="margin-top:30px">
<a href="<?= $create_item_url ?>"><button type="submit" class="btn btn-primary">Gerer vos images</button>

</p>
<?php
if($num_rows<1){
echo "<p> Vous n'avez aucun slider dans le site web.</p>";
}else{
  ?>
<div class="row-fluid sortable">    
<div class="box span12">
<div class="box-header" data-original-title>
<h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Liste des images</h2>
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
<th>Titre du slider</th>
<th>URL cible</th>



<th class="span2">Actions</th>
</tr>
</thead>   
<tbody>
<?php

foreach ($query->result() as $row) { 
$edit_page_url = base_url()."sliders/create/".$row->id;
$view_page_url = base_url()."slides/view/".$row->id;



?>
<tr>
<td class="center"><?= $row->titre_slider?></td>
<td><?= $view_page_url ?></td>




<td class="center">
<a class="btn btn-success" href="<?= $view_page_url ?>">
<i class="halflings-icon white zoom-in"></i>  
</a>
<a class="btn btn-info" href="<?= $edit_page_url ?>">
<i class="halflings-icon white edit"></i>  
</a>

</td>
</tr>
<tr>
<?php
}
?>

</tbody>
</table>            

</div><!--/span-->

</div><!--/row-->
<?php

} 
?>