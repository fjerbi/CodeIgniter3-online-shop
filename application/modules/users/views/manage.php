<h1>Gérer Les Utilisateurs</h1>

<?php
if(isset($flash)){
  echo $flash;
}

  $create_account_url=base_url()."users/create";
  ?><p style="margin-top:30px">
		<a href="<?= $create_account_url ?>"><button type="submit" class="btn btn-primary">Gerer vos utilisateurs</button>

    </p>

<div class="row-fluid sortable">    
        <div class="box span12">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white briefcase"></i><span class="break"></span>Liste des utilisateurs</h2>
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
                   <th>Nom de l'utilisateur/Pseudo</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Societé</th>
                  <th>Date de création</th>
                  <th>Actions</th>
                </tr>
              </thead>   
              <tbody>
                <?php
$this->load->module('timedate');
                foreach ($query->result() as $row) { 
                 $edit_account_url = base_url()."users/create/".$row->id;
                $view_account_url  =  base_url()."users/view/".$row->id;
               $date_creation = $this->timedate->get_date($row->date_creation,'cool');
                ?>
              <tr>
                <td><?= $row->pseudo?></td>
                <td><?= $row->nom?></td>
                              <td class="center"><?= $row->prenom?></td>
                <td class="center"><?= $row->societe?></td>
                <td class="center">
                 <?= $date_creation  ?>
                </td>
                <td class="center">
                  <a class="btn btn-success" href="#">
                    <i class="halflings-icon white zoom-in"></i>  
                  </a>
                  <a class="btn btn-info" href="<?= $edit_account_url ?>">
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