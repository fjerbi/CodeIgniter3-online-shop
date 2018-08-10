
 <?php


 echo form_open($form_location);
echo form_hidden('upload', '1');
echo form_hidden('cmd', '_cart');
echo form_hidden('business', $paypal_email);
echo form_hidden('currency', $currency_code);
echo form_hidden('custom', $custom);
echo form_hidden('return',$return);
echo form_hidden('cancel_return',$cancel_return);
$count =0;

foreach($query->result() as $row)
{
	$count++;
	$nom_produit= $row->nom_produit;
	$prix = $row->prix;
	$quantite_produit = $row->quantite_produit;
	
//chaque produit qui sera achete faut avoir un nom prix et quantité
	echo form_hidden('item_name_'.$count, $nom_produit);
	echo form_hidden('amount_'.$count, $prix);
	echo form_hidden('item_qty_'.$count, $quantite_produit);

}

echo form_hidden('shipping_'.$count, $shipping);
?>
   <div class='cart-submit'>
                <div class='cart-coupon'>
                
                   
                </div>
                
                <button value="Submit" type="submit" name="submit" class="cart-submit-btn">PAYER</button>
            </div>


           

<?php


echo form_close();
 


if($test_paypal==TRUE){

	echo "<div style='clear: both; text-align: center; margin-top: 24px;'>";
	echo form_open('paypal/submit_test');
	echo "Entrer un nombre de commande à simuler :";
	echo form_input('num_orders');
	echo form_submit('submit', 'Submit');
	echo form_hidden('custom', $custom);
	echo form_close();
	echo "</div>";
}