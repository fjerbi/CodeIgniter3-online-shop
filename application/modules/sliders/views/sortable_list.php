<style type="text/css">
.sort {
list-style: none;
border: 1px #aaa solid;
color: #333;
padding: 10px;
margin-bottom: 4px;
}
</style>
<ul id="sortlist">
	<?php
$this->module('sliders');
$this->module('homepage_offer');

 foreach ($query->result() as $row) { 


$edit_item_url = base_url()."sliders/create/".$row->id;
                $view_item_url = base_url()."sliders/view".$row->id;
              $titre_slider = $row->titre_slider;
                ?>


	<li class="sort" id="<?= $row->id ?>" ><i class="icon-sort"></i><?= $row->titre_slider ?>

<?= $titre_slider ?>

 <?php
 $num_items = $this->homepage_offer->count_where('block_id', $row->id);


if($num_items==1)
{
  $entity ="Image";
}else{
  $entity="images";
}


$sub_url_categorie = base_url()."sliders/manage/".$row->id;
?>

<a class="btn btn-default" href="<?= base_url()?>">
<i class="halflings-icon white eye-open"></i>

                  </a>

                  <a class="btn btn-info" href="<?= $edit_item_url ?>">
                    <i class="halflings-icon white edit"></i>  
                  </a>




	</li>

	<?php
}

?>
</ul>
