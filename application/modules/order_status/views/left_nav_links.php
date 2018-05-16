<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Gérer les commandes </span></a>
							<ul>

								<?php
$target_url=base_url().'orders/show/status0';
	echo '<li><a class="submenu" href="'.$target_url.'">';

	echo'<i class="icon-file-alt"></i><span class="hidden-tablet">';
	echo 'Commandes envoyées</span></a></li>';

foreach($query_s->result() as $row){
	$target_url=base_url().'orders/show/status'.$row->id;
	echo '<li><a class="submenu" href="'.$target_url.'">';

	echo'<i class="icon-file-alt"></i><span class="hidden-tablet">';
	echo ' '.$row->nom_statut.'</span></a></li>';
}

								?>
							
							</ul>	
						</li>