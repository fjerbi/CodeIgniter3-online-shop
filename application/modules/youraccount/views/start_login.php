
<?php 
$form_location = base_url().'youraccount/register';
echo validation_errors("<p style='color:red ;'>","</p>");
?>


<main>
    <section class="container stylization maincont">


        <ul class="b-crumbs">
            <li>
                <a href="<?= base_url();?>">
                    Acceuil
                </a>
            </li>
            <li>
                <span>INSCRIPTION</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>INSCRIPTION</span></h1>
        <div class="auth-wrap">
            <div class="auth-col">
                
                <form method="post" action="<?= $form_location ?>" class="login">
                    <p>
                        <label for="username">Pseudo <span class="required">*</span></label><input type="text" id="username" name="pseudo" autofocus="autofocus">
                    </p>


  <p>
                        <label for="nom">Nom <span class="required">*</span></label><input type="text" id="nom" name="nom" autofocus="autofocus">
                    </p>

                      <p>
                        <label for="prenom">Prenom <span class="required">*</span></label><input type="text" id="prenom" name="prenom" autofocus="autofocus">
                    </p>










                    <p>
                        <label for="email">E-mail <span class="required">*</span></label><input type="email" name="email"
value="<?= $email ?>">
                    </p>


  <p>
                        <label for="address1">Addresse1 <span class="required">*</span></label><input type="text" name="address1"
value="<?= $address1 ?>">
                    </p>



 <p>
                        <label for="address2">Addresse2 <span class="required">*</span></label><input type="text" name="address2"
value="<?= $address2 ?>">
                    </p>

          <p>




          <p>
                   

                        <label for="ville">Ville <span class="required">*</span></label><input type="text" name="ville"
value="<?= $ville ?>">
                    </p>
                              <p>
                        <label for="pays">Pays <span class="required">*</span></label><input type="text" name="pays"
value="<?= $pays ?>">
                    </p>
                              <p>
                        <label for="societe">Societe <span class="required">*</span></label><input type="text" name="societe"
value="<?= $societe ?>">
                    </p>
                    
                              <p>
                        <label for="code_postal">Code Postal <span class="required">*</span></label><input type="text" name="code_postal"
value="<?= $code_postal ?>">
                    </p>











                    <p>
                        <label for="password">Mot de passe <span class="required">*</span></label><input type="password" id="password" name="mot_de_passe"
value="<?=$mot_de_passe?>">
                    </p>

                    <p>
                        <label for="password">Répeter votre mot de passe <span class="required">*</span></label><input type="password" id="password" name="repeat_pword"
value="<?= $repeat_pword?>">
                    </p>

                    <p class="auth-submit">
                        <input type="submit" name="submit" value ="Submit">
                     
                      
                    </p>
                 
                </form>
            </div>
            
        </div>



    </section>
</main>

