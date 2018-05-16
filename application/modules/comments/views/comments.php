<?php 
	$this->load->module('timedate');
	$this->load->module('comments');
$name=$this->comments->get_name_comment();

foreach ($query->result() as  $row) {
$date_creation = $this->timedate->get_date($row->date_creation, 'datepicker');
	?>
<ul class="reviews-list">
            <li class="reviews-i existimg">
                <div class="reviews-i-img">
                    <img src="http://placehold.it/120x120" alt="Jeni Margie">
                    <div class="reviews-i-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>

                  
                </div>
                <div class="reviews-i-cont">
                    <p><?php echo nl2br($row->commentaire); ?></p>
                     Publié le:<time datetime="2017-12-21 12:19:46" class="reviews-i-date"><?= $date_creation ?></time>
                    <span class="reviews-i-margin"></span>
                    <h3 class="reviews-i-ttl"><?= $name ?></h3>
                </div>
            </li>


<?php

}

?>

