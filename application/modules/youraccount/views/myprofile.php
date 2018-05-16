
<?php 
$form_location = base_url().'youraccount/createprofile';
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
                <span>Profil</span>
            </li>
        </ul>


        <h1 class="main-ttl"><span>Votre profil</span></h1>
        <div class="auth-wrap">
            <div class="auth-col">
                
                <form method="post" action="<?= $form_location ?>" class="login">
                    <p>
                        <label for="username">Pseudo <span class="required">*</span></label><input type="text" id="username" name="pseudo" autofocus="autofocus">
                    </p>
                    <p>
                        <label for="email">E-mail <span class="required">*</span></label><input type="email" name="email"
value="<?= $email ?>"> 
                    </p>

                    <p>
   

                    <p class="auth-submit">
                        <input type="submit" name="submit" value ="Submit">
                     
                      
                    </p>
                 
                </form>
            </div>
            
        </div>



    </section>
</main>


