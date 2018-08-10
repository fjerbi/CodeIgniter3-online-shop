<style type="text/css">
.sort {
list-style: none;
border: 1px #0db0dd solid;
color: #1c2b36;
padding: 15px;
margin-bottom: 10px;
}
</style>
<ul id="sortlist">
	<?php
$this->module('categories');
 foreach ($query->result() as $row) { 
$num_sub_cats = $this->categories->_count_sub_cats($row->id);

                 $edit_item_url = base_url()."categories/create/".$row->id;
                $view_item_url = base_url()."categories/view".$row->id;
                if($row->id_categorie_parent==0)
                {
                  $parent_nom_categorie="&nbsp;";
                }else{
                $parent_nom_categorie = $this->categories->_get_nom_categorie($row->id_categorie_parent);
              }
                ?>


	<li class="sort" id="<?= $row->id ?>" ><i class="icon-sort"></i><?= $row->nom_categorie ?>

<?= $parent_nom_categorie ?>

 <?php
if($num_sub_cats<1){
  echo"&nbsp;";
}else{

if($num_sub_cats==1)
{
  $entity ="Categorie";
}else{
  $entity="Categories";
}


$sub_url_categorie = base_url()."categories/manage/".$row->id;
?>

<a class="btn btn-default" href="<?= $sub_url_categorie ?>">
<i class="halflings-icon white eye-open"></i><?php
echo $num_sub_cats."Sous".$entity;
?>

                  </a>

                  <a class="btn btn-info" href="<?= $edit_item_url ?>">
                    <i class="halflings-icon white edit"></i>  
                  </a>
<?php




  }
        ?>



	</li>

	<?php
}

?>
</ul>
