<br><br><br><br><br>
<center><h1>Votre Panier</h1></center>

<?php
if($num_rows<1){
	echo"<p>Vous n'avez aucun produit dans votre Panier .</p>";
}else{
	echo "<p>".$showing_statement."</p>";
	$user_type='public';
	echo Modules::run('cart/_cart_contents', $query, $user_type);

	echo Modules::run('cart/_create_checkout_btn', $query);
}