<?php



function get_theme($count)
{
switch ($count) {
    case '1':
        $theme = 'default';
        break;
        case '2':
        $theme = 'danger';
        break;
    
    case '3':
        $theme = 'warning';
        break;
    
    case '4':
        $theme = 'success';
        break;
        default:
        $theme = 'primary';
        break;
    
}
return $theme;
}

?>
<style type="text/css">

.shape{ 
    border-style: solid; border-width: 0 70px 40px 0; float:right; height: 0px; width: 0px;
    -ms-transform:rotate(360deg); /* IE 9 */
    -o-transform: rotate(360deg);  /* Opera 10.5 */
    -webkit-transform:rotate(360deg); /* Safari and Chrome */
    transform:rotate(360deg);
}
.offer{
    background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); margin: 15px 0; overflow:hidden;
}
.offer-radius{
    border-radius:7px;
}
.offer-danger { border-color: #d9534f; }
.offer-danger .shape{
    border-color: transparent #d9534f transparent transparent;
    border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-success {    border-color: #5cb85c; }
.offer-success .shape{
    border-color: transparent #5cb85c transparent transparent;
    border-color: rgba(255,255,255,0) #5cb85c rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-default {    border-color: #999999; }
.offer-default .shape{
    border-color: transparent #999999 transparent transparent;
    border-color: rgba(255,255,255,0) #999999 rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-primary {    border-color: #428bca; }
.offer-primary .shape{
    border-color: transparent #428bca transparent transparent;
    border-color: rgba(255,255,255,0) #428bca rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-info {   border-color: #5bc0de; }
.offer-info .shape{
    border-color: transparent #5bc0de transparent transparent;
    border-color: rgba(255,255,255,0) #5bc0de rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-warning {    border-color: #f0ad4e; }
.offer-warning .shape{
    border-color: transparent #f0ad4e transparent transparent;
    border-color: rgba(255,255,255,0) #f0ad4e rgba(255,255,255,0) rgba(255,255,255,0);
}

.shape-text{
    color:#fff; font-size:12px; font-weight:bold; position:relative; right:-40px; top:2px; white-space: nowrap;
    -ms-transform:rotate(30deg); /* IE 9 */
    -o-transform: rotate(360deg);  /* Opera 10.5 */
    -webkit-transform:rotate(30deg); /* Safari and Chrome */
    transform:rotate(30deg);
}   
.offer-content{
    padding:0 20px 10px;
}



</style>

<?php
$count = 0;

$this->load->module('homepage_offer');
$this->load->module('parametre_web');
$items_segments = $this->parametre_web->_get_item_segments();
foreach ($query->result() as $row) {
    $count++;

$block_id = $row->id;
$num_items_per_block = $this->homepage_offer->count_where('block_id', $block_id);
if($num_items_per_block>0){
    if($count>4){
        $count = 1;
    }
    $theme = get_theme($count);
?>
<div class="fr-pop-wrap">

            <h3 class="component-ttl"><span><?= $row->titre_block?></span></h3>
</h3> 
     </div> <div class=panel-body>  

        
           <?php
//$block_id, $theme, $items_segments
           $block_data['block_id'] = $block_id;
           $block_data['theme'] = $theme;
           $block_data['item_segments'] = $items_segments;
$this->homepage_offer->_draw_offers($block_data);
           ?> 
                  
            

        


 </div> 


<?php

}
}

?>