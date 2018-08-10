<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
<ol class="carousel-indicators">
    <?php 
    $count=0;
    foreach($query_slides->result() as $row_slides){
        if($count==0){
            $css_stylish= 'class="active"';
        }else{
            $css_stylish='';
        }
        ?>
<li data-target="#carousel-example-generic" data-slide-to="<?= $count ?>" <?= $css_stylish?>></li>
<?php
$count++;
}
?>
</ol>

<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
    <?php 
    $count=0;
    foreach($query_slides->result() as $row_slides){
        
$target_url= $row_slides->target_url;
$alt_text= $row_slides->alt_text;
$pic_path = base_url().'slider_img/'.$row_slides->picture;
        ?>
<div class="item active">
    <a href="<?= $target_url ?>"></a>
<img src="<?= $pic_path?>" alt="<?= $alt_text ?>">

</a>
</div>
<?php
$count++;
}
?>

</div>

<!-- Controls -->
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>