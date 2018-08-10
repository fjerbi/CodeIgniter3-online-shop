<?PHP
    include_once("connection.php");

    $query = "SELECT id, nom_produit, prix_produit, image_produit,description_produit 
    FROM produits ORDER BY id DESC"; 
    
    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
    }

    echo json_encode($data);
?>