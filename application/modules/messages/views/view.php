

<div class="row">
	<div class="col-md-8">


<p style="margin-top: 24px;">Message envoyé en <?= $date_creation ?></p>

<a href="<?= base_url() ?>messages/create/<?= $code ?>">
<button class="btn btn-default">Répondre au méssage</button></a>
<h4 style="margin-top: 48px;"><?= $sujet ?></h4>
<p><?= $message ?></p>

</div>
</div>