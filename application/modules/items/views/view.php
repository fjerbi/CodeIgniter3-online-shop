<?php
$form_location= base_url().'comments/submit';
?>
<h1 class="main-ttl"><span><?= $nom_produit ?></span></h1>
    <!-- Single Product - start -->
    <div class="prod-wrap">

      <!-- Product Images -->
      <div class="prod-slider-wrap">
        <div class="prod-slider">
          <ul class="prod-slider-car">
            <li>
              <a data-fancybox-group="product" class="fancy-img" href="">
                <img src="<?= base_url() ?>hd_pics/<?= $image_produit ?>" alt="">
              </a>
            </li>
            <li>
              <a data-fancybox-group="product" class="fancy-img" href="<?= base_url() ?>hd_pics/<?= $image_produit ?>">
                <img src="<?= base_url() ?>hd_pics/<?= $image_produit ?>" alt="">
              </a>
            </li>
            
          </ul>
        </div>
        <div class="prod-thumbs">
          <ul class="prod-thumbs-car">
            <li>
              <a data-slide-index="0" href="#">
                <img src="<?= base_url() ?>hd_pics/<?= $image_produit ?>" alt="">
              </a>
            </li>
            <li>
              <a data-slide-index="1" href="#">
                <img src="<?= base_url() ?>hd_pics/<?= $image_produit ?>" alt="">
              </a>
            </li>
           
          </ul>
        </div>
      </div>

      <!-- Product Description/Info -->

      <div class="prod-cont">
        <div class="prod-cont-txt">
         <h1 class="main-ttl"><span>Disponibilité: EN STOCK</span></h1>
        </div>
       
        
       <?= Modules:: run('cart/_add_to_cart',$id_produit)?>
        <ul class="prod-i-props">
         
          <li>
            <b>Prix du produit</b> <?= $prix_produit?> DT
          </li>
          <li>
            <b>Disponiblité</b> EN STOCK
          </li>
          
          <li><a href="#" class="prod-showprops">Caractéristiques</a></li>
        </ul>
      </div>

      <!-- Product Tabs -->
      <div class="prod-tabs-wrap" >
        <ul class="prod-tabs">
          <li><a data-prodtab-num="1" class="active" href="#" data-prodtab="#prod-tab-1">Déscription</a></li>
          <li><a data-prodtab-num="2" id="prod-props" href="#" data-prodtab="#prod-tab-2">Caractéristiques</a></li>
          <li><a data-prodtab-num="3" href="#" data-prodtab="#prod-tab-3">Video</a></li>
          
          <li><a data-prodtab-num="5" href="#" data-prodtab="#prod-tab-5">Commentaires</a></li>
        </ul>
        <div class="prod-tab-cont">

          <p data-prodtab-num="1" class="prod-tab-mob active" data-prodtab="#prod-tab-1">Description</p>
          <div class="prod-tab stylization" id="prod-tab-1">
            <p><?= $description_produit?></p>
          </div>
          <p data-prodtab-num="2" class="prod-tab-mob" data-prodtab="#prod-tab-2">Features</p>
          <div class="prod-tab prod-props" id="prod-tab-2">
            <table>
              <tbody>
              <tr>
                <td>Nom du Produit</td>
                <td><?= $nom_produit?></td>
              </tr>
             
              <tr>
                <td>Diponibilité</td>
                <td>En stock</td>
              </tr>
            
             
              </tbody>
            </table>
          </div>
          <p data-prodtab-num="3" class="prod-tab-mob" data-prodtab="#prod-tab-3">Vidéo</p>
          <div class="prod-tab prod-tab-video" id="prod-tab-3">
            <iframe width="853" height="480" src="https://www.youtube.com/embed/kaOVHSkDoPY?rel=0&amp;showinfo=0" allowfullscreen></iframe>
          </div>
          <p data-prodtab-num="4" class="prod-tab-mob" data-prodtab="#prod-tab-4">Articles (6)</p>
          <div class="prod-tab prod-tab-articles" id="prod-tab-4">
            <div class="flexslider post-rel-wrap" id="post-rel-car">
              <ul class="slides">
                <li class="posts-i">
                  <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/354x236)"></span></a>
                  <time class="posts-i-date" datetime="2017-01-01 08:18"><span>09</span> Feb</time>
                  <div class="posts-i-info">
                    <a class="posts-i-ctg" href="blog.html">Articles</a>
                    <h3 class="posts-i-ttl"><a href="post.html">Adipisci corporis velit</a></h3>
                  </div>
                </li>
                <li class="posts-i">
                  <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/360x203)"></span></a>
                  <time class="posts-i-date" datetime="2017-01-01 08:18"><span>05</span> Jan</time>
                  <div class="posts-i-info">
                    <a class="posts-i-ctg" href="blog.html">Reviews</a>
                    <h3 class="posts-i-ttl"><a href="post.html">Excepturi ducimus recusandae</a></h3>
                  </div>
                </li>
                <li class="posts-i">
                  <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/360x224)"></span></a>
                  <time class="posts-i-date" datetime="2017-01-01 08:18"><span>17</span> Apr</time>
                  <div class="posts-i-info">
                    <a class="posts-i-ctg" href="blog.html">Reviews</a>
                    <h3 class="posts-i-ttl"><a href="post.html">Consequuntur minus numquam</a></h3>
                  </div>
                </li>
                <li class="posts-i">
                  <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/314x236)"></span></a>
                  <time class="posts-i-date" datetime="2017-01-01 08:18"><span>21</span> May</time>
                  <div class="posts-i-info">
                    <a class="posts-i-ctg" href="blog.html">Articles</a>
                    <h3 class="posts-i-ttl"><a href="post.html">Non ex sapiente excepturi</a></h3>
                  </div>
                </li>
                <li class="posts-i">
                  <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/318x236)"></span></a>
                  <time class="posts-i-date" datetime="2017-01-01 08:18"><span>24</span> Jan</time>
                  <div class="posts-i-info">
                    <a class="posts-i-ctg" href="blog.html">Articles</a>
                    <h3 class="posts-i-ttl"><a href="post.html">Veritatis officiis</a></h3>
                  </div>
                </li>
                <li class="posts-i">
                  <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/354x236)"></span></a>
                  <time class="posts-i-date" datetime="2017-01-01 08:18"><span>08</span> Sep</time>
                  <div class="posts-i-info">
                    <a class="posts-i-ctg" href="blog.html">Reviews</a>
                    <h3 class="posts-i-ttl"><a href="post.html">Ratione magni laudantium</a></h3>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <p data-prodtab-num="5" class="prod-tab-mob" data-prodtab="#prod-tab-5">Reviews (3)</p>
          <div class="prod-tab" id="prod-tab-5">
            <ul class="reviews-list">
              <li class="reviews-i existimg">
                
                <div class="reviews-i-cont">
                

  <div class="prod-comment-form">
              <h3>Ajouter un commentaire</h3>

<?php


$id_acheteur = $this->securite->_get_user_id();
//si il est connecté
  if(!is_numeric($id_acheteur)){


?>



                 <h4>vous devez etre connecté pour pouvoir saisir votre commentaire, sinon vous allez etre rediriger vers la page de connexion</h4>
             <?php


}else{
  echo"<h4>Vous etes connecté, vous pouvez publier votre commentaire ! .";

}

             ?>  



              <form method="POST" action="<?= $form_location?>">
               
                <textarea placeholder="Your review" name="commentaire"></textarea>
                <div class="prod-comment-submit">
                  <input type="submit" value="Submit">
                  <div class="prod-rating">
                    <i class="fa fa-star-o" title="5"></i><i class="fa fa-star-o" title="4"></i><i class="fa fa-star-o" title="3"></i><i class="fa fa-star-o" title="2"></i><i class="fa fa-star-o" title="1"></i>
                  </div>
                </div>
                
                 <h3>Les commentaires</h3>






                <?php
echo Modules::run('comments/_make_comments', $id_produit);
echo form_hidden('id_produit', $id_produit);
                ?>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>


                  <span class="reviews-i-margin"></span>
             
                 
                </div>
                <div class="reviews-i-answer">
                 
                  <span class="reviews-i-margin"></span>
                </div>
              </li>
             </ul>

                </div>
              </form>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- Single Product - end -->



<?php
/*
echo Modules::run('templates/_draw_breadcrumbs', $breadcrumbs_data);
if(isset($flash)){
  echo $flash;
}

?>
<div class="row">
	<div class="col-md-4">

<style type="text/css">
	

body {
  font-family: 'open sans';
  overflow-x: hidden; }

img {
  max-width: 50%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 40%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 50px;
  background: white;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }



</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Détails du produit</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

  </head>

  <body>
	
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-4">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="<?= base_url() ?>hd_pics/<?= $product_image ?>" class="img-responsive" alt="<?= $nom_produit ?>" /></div>
						 
						</div>
					
						
					</div>
					<div class="details col-md-4">
						<h3 class="product-title"><?= $nom_produit ?></h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<p class="product-description"><?= $description_produit?>.</p>
						<h4 class="price">Notre prix : <span><?= $prix_produit ?> DT</span></h4>
						<h4 class="price">Ancien prix : <span><?= $ancien_prix ?> DT</span></h4>
						<p class="vote"><strong>91%</strong> de Client on acheté ce produit! <strong>(87 votes)</strong></p>
						
							
						
						</h5>
						
						<div class="action">
							
							<button class="like btn btn-default" type="button"><span class="fa fa-heart">J'aime le produit</span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>


</div>

<div class="col-md-5">
	
</div>
<div class="col-md-3">

<?= Modules:: run('cart/_add_to_cart',$id_produit)?>

</div>
</div>


*/
?>