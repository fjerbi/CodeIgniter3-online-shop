<h1>VOS COMMANDES </h1>
<?php

if($num_rows<1){
	echo "<p> Vous n'avez passer aucune commande.</p>";
}else{?>
<?= $showing_statement ?>
<?= $pagination ?>


<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
<tr>
  <th>Libélle commande </th>
  <th>valeur de la commande(prix) </th>
  <th>Date de création </th>
  
  <th>Statut de la commande</th>
  
  <th>Actions</th>

</tr>
</thead>   
<tbody>
<?php
$this->load->module('timedate');
foreach ($query->result() as $row) { 

$view_order_url = base_url()."myorders/view/".$row->libelle_commande;

$date_created = $this->timedate->get_date($row->date_creation, 'datepicker');


$order_status=$row->statut_commande;
$order_status_title = $order_status_options[$order_status];

?>
<tr>
<td><?= $row->libelle_commande ?></td>
<td><?= $row->mc_gross ?></td>
<td><?= $date_created ?></td>
<td class="center"><?= $order_status_title?></td>

<td class="center">
  <a class="btn btn-default" href="<?= $view_order_url ?>">
    <span class="glyphicon glyphicon-info" aria-hiden="true">Afficher</span> 
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

<?= $pagination ?>

<?php
}

?>