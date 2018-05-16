
<h1>Gérer les Catégories</h1>

<?php
if(isset($flash)){
  echo $flash;
}

  $create_item_url=base_url()."categories/create";
  ?><p style="margin-top:30px">
		<a href="<?= $create_item_url ?>"><button type="submit" class="btn btn-primary">Gerer vos Catégories</button>

    </p>

<div class="row-fluid sortable">    
        <div class="box span12">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Liste des Catégories</h2>
            <div class="box-icon">
              <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
          </div>
          <div class="box-content">

            <?php
           
echo Modules::run('categories/_create_sortable_list', $id_categorie_parent);

            ?>
            </div><!--/span-->
      
      </div><!--/row-->
