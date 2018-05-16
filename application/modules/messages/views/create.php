

<?php
$form_location = current_url();
?>

<div class="row">
  <div class="col-md-8">

<h1><?= $headline ?></h1>

<h4>Si votre méssage est Urgent !!  cocher la case "Urgent".</h4>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Composer un méssage</title>
  
  
  
      <link rel="stylesheet" href="<?php echo base_url();?>mojs/messages/css/style.css">

  
</head>

<body>

  <head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"></head>
<br />
<div class="inner contact">
                <!-- Form Area -->
                <div class="contact-form">
                    <!-- Form -->
                    <form id="contact-us" method="post" action="<?= $form_location?>">
<?php
if($code=="") { ?>

                        <!-- Left Inputs -->
                        <div class="col-xs-6 wow animated slideInLeft" data-wow-delay=".5s">
                           <br><br><br>
                            <!-- Email -->
                            <input type="text" name="sujet" id="mail" required="required" value="<?= $sujet ?>" class="form" placeholder="Sujet" />
                           
                        </div><!-- End Left Inputs -->
                        <?php
                    }else{
echo form_hidden('sujet', $sujet);
}
?>

                        <!-- Right Inputs -->
                        <div class="col-xs-6 wow animated slideInRight" data-wow-delay=".5s">
                            <!-- Message -->
                            <textarea name="message" id="message" class="form textarea"  placeholder="Taper votre message"><?= $message ?></textarea>
                        </div><!-- End Right Inputs -->
                        <!-- Bottom Submit -->
                        <div class="relative fullwidth col-xs-12">
                            <!-- Send Button -->
                            <input type="checkbox" name="urgent" value="1" <?php
if($urgent==1){
	echo "Vérifié";
}


                            ?>> Urgent
                            <button type="submit" value="Submit" id="submit" name="submit" class="form-btn semibold">Envoyer le message</button> 
<br>
                            <button type="submit" value="Cancel"  id="submit" name="submit" class="form-btn semibold">Annuler</button> 
                        </div><!-- End Bottom Submit -->
                        <!-- Clear -->
                        <div class="clear"></div>
                        <?php
echo form_hidden('token', $token);
                        ?>
                    </form>
</div>
</div>
                    <!-- Your Mail Message -->
                    <div class="mail-message-area">
                        <!-- Message -->
                        <div class="alert gray-bg mail-message not-visible-message">
                            
                        </div>
                    </div>

                </div><!-- End Contact Form Area -->
            </div><!-- End Inner -->
  
  

</body>

</html>
