<br><br><br><br><br>
<?php
$this->load->module('timedate');
foreach($query->result() as $row){
  $article_preview = $row->contenu_page;

$image = $row->image;
$thumbnail_name = str_replace('.','_thumb.',$image);
$thumbnail_path = base_url().'blog_pics/'.$thumbnail_name;
  $date_publication = $this->timedate->get_date($row->date_publication,'datepicker_us');
     $blog_url = base_url().'blog/article/'.$row->url_page;          

  ?>


                    <h1 class="main-ttl"><span>CONSULTER LA MÉTEO</span></h1>
<li>
                       <a href="<?= base_url() ?>weather/forecast"><button class="btn btn-info"> Méteo </button></a><img src="<?php echo base_url();?>mojs/meteo.png" style="width: 90px; height: 90px; margin-left: 50px; margin-top: 50px;" >
                    </li>

                         



<h1 class="main-ttl"><span><?= $row->titre_page ?></span></h1>
        <!-- Blog Post - start -->
        <div class="post-wrap stylization">
           

            <!-- Slider -->
            <div class="flexslider post-slider" id="post-slider-car">
                <ul class="slides">
                    <li>
                        <a data-fancybox-group="fancy-img" class="fancy-img" href=""><img src="<?= $thumbnail_path?>" alt=""></a>
                    </li>
                 
                </ul>
            </div>

            <p><?= $article_preview?></p>

            <!-- Share Links -->
            <div class="post-share-wrap">
                <ul class="post-share">
                    <li>
                        <a onclick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[url]=http://allstore-html.real-web.pro','sharer', 'toolbar=0,status=0,width=620,height=280');" data-toggle="tooltip" title="Share on Facebook" href="javascript:">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a onclick="popUp=window.open('http://twitter.com/home?status=Post with Shortcodes http://allstore-html.real-web.pro','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" data-toggle="tooltip" title="Share on Twitter" href="javascript:;">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a onclick="popUp=window.open('http://vk.com/share.php?url=http://allstore-html.real-web.pro','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" data-toggle="tooltip" title="Share on VK" href="javascript:;">
                            <i class="fa fa-vk"></i>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" title="Share on Pinterest" onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=http://allstore-html.real-web.pro&amp;description=AllStore HTML Template&amp;media=http://discover.real-web.pro/wp-content/uploads/2016/09/insect-1130497_1920.jpg','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                            <i class="fa fa-pinterest"></i>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" title="Share on Google +1" href="javascript:;" onclick="popUp=window.open('https://plus.google.com/share?url=http://allstore-html.real-web.pro','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" title="Share on Linkedin" onclick="popUp=window.open('http://linkedin.com/shareArticle?mini=true&amp;url=http://allstore-html.real-web.pro&amp;title=AllStore HTML Template','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" title="Share on Tumblr" onclick="popUp=window.open('http://www.tumblr.com/share/link?url=http://allstore-html.real-web.pro&amp;name=AllStore HTML Template&amp;description=Aliquam%2C+consequuntur+laboriosam+minima+neque+nesciunt+quod+repudiandae+rerum+sint.+Accusantium+adipisci+aliquid+architecto+blanditiis+dolorum+excepturi+harum+ipsa%2C+ipsam%2C...','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                            <i class="fa fa-tumblr"></i>
                        </a>
                    </li>
                </ul>
                <ul class="post-info">
                    <li>Date de publication <?=$date_publication?></li>
                    <li >Publié par : <?= $row->auteur ?> </li>
                    <li>Comments: <a href="#">3</a></li>
                </ul>
            </div>

<?php
}
?>


<?php
/*
$this->load->module('timedate');
foreach($query->result() as $row){
  $article_preview = word_limiter($row->contenu_page,20);

$image = $row->image;
$thumbnail_name = str_replace('.','_thumb.',$image);
$thumbnail_path = base_url().'blog_pics/'.$thumbnail_name;
  $date_publication = $this->timedate->get_date($row->date_publication,'datepicker_us');
     $blog_url = base_url().'blog/article/'.$row->url_page;          

  ?>

<main>
  
                <h1 class="main-ttl"><span>LE BLOG</span></h1>
            </li>
        </ul>
  



        <h1 class="main-ttl"><span><a href="<?= $blog_url ?>"><?= $row->titre_page ?></a></span></h1>
        <!-- Blog Post - start -->
        <div class="post-wrap stylization">
          <img src="<?= $thumbnail_path?>" class="post-img" style="width: 6500px;" >
            
            <p><?= $article_preview?></p>

            <p style="font-size: 0.9em;">
Publié par : <?= $row->auteur ?>-
<span style="color: #999">CC
</p>

  <?php
}
*/
?>

