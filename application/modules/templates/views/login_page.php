
<?php 
$first_bit =$this->uri->segment(1);
$form_location = base_url().$first_bit.'/submit_login';
?>


<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Veuillez vous connecter</title>
  
  
  
      <link rel="stylesheet" href="<?php echo base_url();?>mojs/login/css/style.css">

  
</head>

<body>

  <html>

<head>
  <meta charset="UTF-8">
  <title>Veuillez vous connecter</title>


  <link rel="stylesheet" href="<?php echo base_url();?>mojs/login/css/style.css">


</head>

<body>

  <html lang="en">

  <head>
    <title>Veuillez vous connecter</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>mojs/login/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
  </head>

  <body>
    <div id="container">
      <div id="logo_bar">
        <img id="logo" src="<?php echo base_url();?>technipack_pictures/technipacklogo.png" alt="logo"> <span>TECHNIPACK</span>
      </div>
      <div id="form_box">
      <form method="post" action="<?= $form_location ?>" role="login">
          <p id="form_heading">CONNECTEZ-VOUS !</p>
          <input type="text" placeholder="Entrer votre nom d'utilisateur" autofocus="autofocus" name="pseudo" value="<?= $pseudo ?>"><br />
          <input type="password" placeholder="Entrer votre mot de passe " name="mot_de_passe"><br />
          <?php
if($first_bit=="youraccount"){?>
          <input type="checkbox" id="checkbox" value="remember-me" name="remember"><label for="checkbox" style="color:white; font-size:15px;">SE SOUVENIR</label><br />

<?php

}
?>
          <input type="submit" value="Connexion" name="submit"><br />
          <a id="font_20">mot de passe oublié ?</a><br /><br />
        </form>
      </div>
    </div>
    <div id="credits_box">
      Continuer vers <a href="<?php echo base_url()?>" target="_blank">la page d'accueil</a>
    </div>
  </body>

  </html>


</body>

</html>
  
  

</body>

</html>





















