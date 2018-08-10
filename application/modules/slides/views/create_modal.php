<a href="<?= base_url()?>sliders/create/<?= $parent_id?>"><button type="button" class="btn btn-success">Retourner</button></a>
<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal"> Créer Un Nouveau Slider</a>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Paramétres</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?= $form_location?>" method="post">
        	<p>
        	<label>URL cible</label>
        	<input type="text" class="span6" name="target_url" placeholder="(OPTIONNEL)">
</p>

<label>Alt-Text</label>
        	<input type="text" class="span6" name="alt_text" placeholder="(OPTIONNEL)">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit" value="Submit">Valider</button>
      </div>
    </div>
  </div>
</div>
<?php
echo form_hidden('parent_id', $parent_id);
?>