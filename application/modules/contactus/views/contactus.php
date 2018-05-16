<main>
    <section class="container stylization maincont">


        <ul class="b-crumbs">
            <li>
                <a href="<?= base_url();?>">
                    Accueil
                </a>
            </li>
            <li>
                <span>Contactez-nous !</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Contact</span></h1>
        <!-- Contacts - start -->
        <br>
        <div class="iconbox-wrap">
            <div class="row iconbox-list">
                <div class="cf-xs-6 cf-sm-4 cf-lg-4 col-xs-6 col-sm-4 iconbox-i">
                    <p class="iconbox-i-img"><!-- NO SPACE --><img src="http://www.bestpawntucson.com/pics/phone.svg" alt=""><!-- NO SPACE --></p>
                    <h3 class="iconbox-i-ttl"><?= $telnum?></h3>
                    Contactez-nous<br>
                    par téléphone
                    <span class="iconbox-i-margin"></span>
                </div>
                <div class="cf-xs-6 cf-sm-4 cf-lg-4 col-xs-6 col-sm-4 iconbox-i">
                    <p class="iconbox-i-img"><!-- NO SPACE --><img src="http://www.savvyinstantoffices.com/wp-content/uploads/2017/03/business-address.png" alt=""><!-- NO SPACE --></p>
                    <h3 class="iconbox-i-ttl">Notre addresse</h3>
                    <?=$address?><br>
                
                    <span class="iconbox-i-margin"></span>
                </div>
                <div class="cf-xs-6 cf-sm-4 cf-lg-4 col-xs-6 col-sm-4 iconbox-i">
                    <p class="iconbox-i-img"><!-- NO SPACE --><img src="http://pharmaciedescalins.fr/wp-content/uploads/2014/10/Logo-horaire.png" alt=""><!-- NO SPACE --></p>
                    <h3 class="iconbox-i-ttl">Ouverture</h3>
                    Lun-Sam 07:00-22:00<br>
                    -Dim Fermé
                    <span class="iconbox-i-margin"></span>
                </div>
            </div>
        </div>

        <!-- Contacts Info - end -->
        <div class="social-wrap">
            <div class="social-list">
                <div class="social-i">
                    <a rel="nofollow" target="_blank" href="http://facebook.com/">
                        <p class="social-i-img">
                            <i class="fa fa-facebook"></i>
                        </p>
                        <p class="social-i-ttl">Facebook</p>
                    </a>
                </div>
                <div class="social-i">
                    <a rel="nofollow" target="_blank" href="http://google.com/">
                        <p class="social-i-img">
                            <i class="fa fa-google-plus"></i>
                        </p>
                        <p class="social-i-ttl">Google +</p>
                    </a>
                </div>
                <div class="social-i">
                    <a rel="nofollow" target="_blank" href="http://twitter.com/">
                        <p class="social-i-img">
                            <i class="fa fa-twitter"></i>
                        </p>
                        <p class="social-i-ttl">Twitter</p>
                    </a>
                </div>
                <div class="social-i">
                    <a rel="nofollow" target="_blank" href="http://vk.com/">
                        <p class="social-i-img">
                            <i class="fa fa-vk"></i>
                        </p>
                        <p class="social-i-ttl">Vkontakte</p>
                    </a>
                </div>
                <div class="social-i">
                    <a rel="nofollow" target="_blank" href="http://instagram.com/">
                        <p class="social-i-img">
                            <i class="fa fa-instagram"></i>
                        </p>
                        <p class="social-i-ttl">Instagram</p>
                    </a>
                </div>
                <div class="social-i">
                    <a rel="nofollow" target="_blank" href="http://youtube.com/">
                        <p class="social-i-img">
                            <i class="fa fa-youtube"></i>
                        </p>
                        <p class="social-i-ttl">Youtube</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contactform-wrap">
            <form action="#" class="form-validate">
                <h3 class="component-ttl component-ttl-ct component-ttl-hasdesc"><span>Feedback</span></h3>
                <p class="component-desc component-desc-ct">Taper vos informations pour nous contacter !</p>
                <p class="contactform-field contactform-text">
                    <label class="contactform-label">Nom</label><!-- NO SPACE --><span class="contactform-input"><input placeholder="Name" type="text" name="name" data-required="text"></span>
                </p>
                <p class="contactform-field contactform-email">
                    <label class="contactform-label">E-mail</label><!-- NO SPACE --><span class="contactform-input"><input placeholder="Your E-mail" type="text" name="email" data-required="text" data-required-email="email"></span>
                </p>
                <p class="contactform-field contactform-textarea">
                    <label class="contactform-label">Message</label><!-- NO SPACE --><span class="contactform-input"><textarea placeholder="Your message" name="mess" data-required="text"></textarea></span>
                </p>
                <p class="contactform-submit">
                    <input value="Send" type="submit">
                </p>
            </form>
        </div>
        <br>
        <br>
        <!-- Google Maps -->
        
            <?=$map_code?>
       
        <!-- Contacts - end -->

    </section>
</main>
<!-- Main Content - end -->


