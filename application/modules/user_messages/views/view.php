


<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color: red;'>","</p>") ?>


<?php 
if(isset($flash)){
	echo $flash;
}
?>

<p style="margin-top:30px">
<a href="<?= base_url() ?>user_messages/create/<?= $update_id ?> ">
	<button type="submit" class="btn btn-primary">Réponde au  message</button>
</a>
   </p>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Détails du message</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">


<table class="table table-striped table-bordered bootstrap-datatable datatable">
            <tbody>
                <?php
                $this->load->module('users');
$this->load->module('timedate');
                foreach ($query->result() as $row) { 

$view_url = base_url()."user_messages/view/".$row->id;


                  $ouvert = $row->ouvert;
                  if($ouvert ==1){
                    $icon = '<i class="icon-envelope"></i>';
                  }else{
                    $icon = '<i class="icon-envelope-alt" style="color: orange;"></i>';
                  }
                  $date_sent = $this->timedate->get_date($row->date_creation,'datepicker');
              

              if($row->envoye_par ==0){
                $envoye_par ="Administrateur";
              }else{
$envoye_par =$this->users->_get_customer_name($row->envoye_par);
              }

              $sujet = $row->sujet;
              $message = $row->message;
                ?>


<tr>
	<td style="font-weight: bold;">Date d'envoi</td><td><?= $date_sent ?></td>
</tr>
<tr>
	<td style="font-weight: bold;">Envoyé par</td><td><?= $envoye_par ?></td>
	</tr>
	<td style="font-weight: bold;">Sujet</td><td><?= $sujet ?></td>
	<tr>
	<td style="font-weight: bold; vertical-align: top;">Message</td>
	
	<td style="vertical-align: top;"><?= nl2br($message)?></td>
</tr>


            
              
                <?php
}
                ?>
                
              </tbody>
            </table> 

					</div>
				</div>
			</div>
