<h1>CMS</h1>

<?php
if(isset($flash)){
echo $flash;
}

$create_page_url=base_url()."cms_webpages/create";
?><p style="margin-top:30px">
<a href="<?= $create_page_url ?>"><button type="submit" class="btn btn-primary">créer une nouvelle page</button>

</p>

<div class="row-fluid sortable">    
<div class="box span12">
<div class="box-header" data-original-title>
<h2><i class="halflings-icon white file"></i><span class="break"></span>Liste des pages</h2>
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
<th>URL de la page</th>

<th>Titre de la page</th>

<th class="span2">Actions</th>
</tr>
</thead>   
<tbody>
<?php

foreach ($query->result() as $row) { 
$edit_page_url = base_url()."cms_webpages/create/".$row->id;
$view_page_url = base_url().$row->url_page;



?>
<tr>
<td><?= $view_page_url ?></td>

<td class="center"><?= $row->titre_page?></td>


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
</div>
</div><!--/span-->

</div><!--/row-->