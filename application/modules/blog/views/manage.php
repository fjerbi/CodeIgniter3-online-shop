

<?php
if(isset($flash)){
  echo $flash;
}

  $create_url_page=base_url()."blog/create";
  ?><p style="margin-top:30px">
		<a href="<?= $create_url_page ?>"><button type="submit" class="btn btn-primary">créer un nouveau article</button>

    </p>

<div class="row-fluid sortable">    
        <div class="box span12">
          <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white file"></i><span class="break"></span>Liste des articles</h2>
            <div class="box-icon">
              <a href="#" id="toggle-fullscreen" class="hidden-phone hidden-tablet"><i class="halflings-icon white fullscreen"></i></a>
              <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
          </div>
          <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                <tr>
                  <th>Image de l'article</th>
                  <th>Date de publication</th>
                  <th>Auteur</th>
                  <th>URL de  article</th>
                  
                  <th>Titre de l'article</th>
                
                  <th class="span2">Actions</th>
                </tr>
              </thead>   
              <tbody>
                <?php
$this->load->module('timedate');
                foreach ($query->result() as $row) { 
                 $edit_url_page = base_url()."blog/create/".$row->id;
                $view_url_page = base_url().$row->url_page;
               $date_publication = $this->timedate->get_date($row->date_publication,'datepicker_us');
$image = $row->image;
$thumbnail_name = str_replace('.','_thumb.',$image);
$thumbnail_path = base_url().'blog_pics/'.$thumbnail_name;
               
                ?>
              <tr>
                <td><img src="<?=$thumbnail_path?>"></td>
                <td><?= $date_publication ?> </td>
                <td><?= $row->auteur ?></td>
                <td><?= $view_url_page ?></td>
               
                <td class="center"><?= $row->titre_page?></td>
                
               
                <td class="center">
                  <a class="btn btn-success" href="<?= $view_url_page ?>">
                    <i class="halflings-icon white zoom-in"></i>  
                  </a>
                  <a class="btn btn-info" href="<?= $edit_url_page ?>">
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