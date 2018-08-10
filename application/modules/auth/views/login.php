
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
  <title>Connexion Tableau de bord</title>

  <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>mojs/register/assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>mojs/register/assets/css/styles.css" />
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
  <section class="container login-form">
    <section>

        <img src="<?php echo base_url();?>technipack_pictures/technipacklogo.png" style="width: 150px; height: 150px;margin-left: 150px; margin-top: 200px;" alt="" class="img-responsive" />



  <section class="container login-form">
    <section>
      <div id="infoMessage"><?php echo $message;?></div>
      <form method="post" action="" role="login">
        <?php echo form_open("auth/login");?>
        <img src="assets/images/logo.png" alt="" class="img-responsive" />
      
        <div class="form-group">
         <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
        </div>
        
        <div class="form-group">
          <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
        </div>
        
         <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>
         <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
        
      <?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
      </form>
    </section>
  </section>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="<?php echo base_url();?>mojs/register/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


<!--
  Author: W3layouts
  Author URL: http://w3layouts.com
  License: Creative Commons Attribution 3.0 Unported
  License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Smart Login Form Responsive Widget Template:: W3layouts</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smart Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="<?php echo base_url();?>mojs/registerv2/css/style.css" rel="stylesheet" type="text/css" media="all">
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900iSlabo+27px&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!--//online-fonts -->
