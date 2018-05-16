<h1>Commande: <?= $libelle_commande ?></h1>
<p style="font-weight: bold;">Date création:  <?=$date_creation?></p>
<p style="font-weight: bold;">Statut de la commande:  <?=$order_status_title?></p>


<?php

$user_type='public';
	echo Modules::run('cart/_cart_contents', $query_c, $user_type);