<div class="row-fluid">
<div class="span12 statbox white" style="height: 550px;" >
<div class="span4">
	<img src="<?= base_url()?>mojs/paypal.png" style="width: 200px;">


</div>

<div class="span8">
<h2>FEEDBACK DE PAYPAL</h2>
<p>
	
Date De Transmission: <?= $date_created ?></p>
<b>Statut De Payement:</b> <?=$payment_status ?><br>


<b>ID De Transaction:</b><?=$txn_id?><br>
<b>Paiement Brut:</b><?= $mc_gross?><br>
<b>ID de l'acheteur</b><?= $payer_id ?><br>
<b>E-mail de l'acheteur</b> <?=$payer_email?><br>
<b>Statut de l'acheteur: </b><?= $payer_status?><br>
<b>Date de Paiement</b><?= $payment_date ?><br>


<b>Nom de l'acheteur</b><?= $first_name.' '.$last_name ?><br>
<b>Adresse 1 </b> <?= $address_name ?></br>
<b>Adresse 1 </b> <?= $address_street ?></br>
<b>Ville </b> <?= $address_state ?></br>
<b>Pays </b> <?= $address_country ?></br>
</p>

</div>

<div class="footer">
	<a href="http://www.paypal.com" > Vister Paypal pour d'autre informations</a>
</div>
</div>
</div>