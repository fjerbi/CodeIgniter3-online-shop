<?php
$connect = mysqli_connect("localhost", "root", "", "djerbashop");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM produits 
	WHERE nom_produit LIKE '%".$search."%'
	OR quantite_produit LIKE '%".$search."%' 
	OR status LIKE '%".$search."%' 
	OR ancien_prix LIKE '%".$search."%' 
	OR quantite_produit LIKE '%".$search."%'
	OR image_produit LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM produits ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Nom du produit</th>
							<th>quantite_produit</th>
							<th>status</th>
							<th>Postal Code</th>
							<th>quantite_produit</th>
							<th>image produit</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["nom_produit"].'</td>
				<td>'.$row["quantite_produit"].'</td>
				<td>'.$row["status"].'</td>
				<td>'.$row["ancien_prix"].'</td>
				<td>'.$row["quantite_produit"].'</td>
					<td>'.$row["image_produit"].'</td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>