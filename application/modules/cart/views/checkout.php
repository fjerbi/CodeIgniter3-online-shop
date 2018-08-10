<h1>Veuillez créer votre compte</h1>
<br><br>
<div class="register-req">
				<p>En cliquant sur Oui, vous allez etre rediriger vers la page de création de votre compte, sinon, vous pouvez continuer à visiter notre site !</p>
			</div><!--/register-req-->
<div class="col-md-10" >
	<?php
	echo form_open('cart/choice_submit'); ?>
	<button class="btn btn-info" name="submit" value="Oui, Je veux Créer mon compte" type="submit">
		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
		Oui, Je veux Créer mon compte
		

	</button>

<button class="btn btn-danger" style="margin-left: 24px;"  name="submit" value="Non Continuer ma visite" type="submit">
		<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
		Non, Continuer ma visite
		

	</button>
<a href="<?= base_url() ?>youraccount/login">
	<button class="btn btn-primay" style="margin-left: 24px;" name="submit"  type="button">
		<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
		J'ai déja un compte
		

	</button></a>

	<?php
echo form_hidden('checkout_token', $checkout_token);
	 echo form_close(); ?>
</div>





