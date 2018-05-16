<?php
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
<span style="color: #999"><?= $date_publication?>
</p>

  <?php
}

?>

