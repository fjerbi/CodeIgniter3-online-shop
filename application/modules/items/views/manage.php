<h1>Gérer Produits</h1>

<?php
if(isset($flash)){
  echo $flash;
}

  $create_item_url=base_url()."items/create";
  ?><p style="margin-top:30px">
		<a href="<?= $create_item_url ?>"><button type="submit" class="btn btn-primary">AJOUTER UN PRODUIT</button>

    </p>

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
                  <th>ID du produit </th>
                  <th>Nom du produit</th>
                  <th>Image du produit</th>
                  <th>Prix</th>
                  <th>Ancien prix</th>
                  <th>Quantite produit</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>   
              <tbody>
                <?php

                foreach ($query->result() as $row) { 
                 $edit_item_url = base_url()."items/create/".$row->id;
                $view_item_url = base_url()."items/view".$row->id;
                $status = $row->status;

                if($status==1){
                  $status_label = "success";
                  $status_desc = "Actif";
                }else{
                  $status_label ="warning";
                  $status_desc ="Inactif";
                }
                ?>
              <tr>
                <td><?= $row->id?></td>
                <td><?= $row->nom_produit?></td>
                <td class="center"><img src="<?php echo base_url('hd_pics/'.$row->image_produit)?>" style="width: 50px; height: 50px;"></td>
                <td class="center"><?= $row->prix_produit?></td>
                <td class="center"><?= $row->ancien_prix?></td>
                <td class="center"><?= $row->quantite_produit?></td>
                <td class="center">
                  <span class="label label-<?= $status_label ?>"><?= $status_desc ?></span>
                </td>
                <td class="center">
                  <a class="btn btn-success" href="#">
                    <i class="halflings-icon white zoom-in"></i>  
                  </a>
                  <a class="btn btn-info" href="<?= $edit_item_url ?>">
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