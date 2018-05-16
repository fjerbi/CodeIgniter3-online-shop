<?php  
 //load_product.php  
 $connect = mysqli_connect("localhost", "root", "", "djerbashop");  
 if(isset($_POST["prix"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM produits WHERE prix <= ".$_POST['prix']." ORDER BY prix desc";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <div class="col-md-4">  
                          <div style="border:1px solid #ccc; padding:12px; margin-bottom:16px; height:375px;" align="center">  
                               <img src="'.$row["image_produit"].'" class="img-responsive" />  
                               <h3>'.$row["nom_produit"].'</h3>  
                               <h4>prix - '.$row["prix"].'</h4>  
                          </div>  
                     </div>  
                ';  
           }  
      }  
      else  
      {  
           $output = "No Product Found";  
      }  
      echo $output;  
 }  
 ?>  