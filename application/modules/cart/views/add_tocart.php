 <?php 
  echo form_open('basket/add_to_basket');
  ?>
 <div class="prod-info">
          <p class="prod-price">
            <b class="item_current_price">ID DU PRODUIT: <?=$id_produit ?></b>
          </p>
          <p class="prod-qnt">
            <input value="1" type="text" name="quantite_produit">
            <a href="#" class="prod-plus"><i class="fa fa-angle-up"></i></a>
            <a href="#" class="prod-minus"><i class="fa fa-angle-down"></i></a>
          </p>
          <p class="prod-addwrap">
             <div class='cart-submit'>
              
                
                <button value="Submit" type="submit" name="submit" class="cart-submit-btn">Commander</button>
            </div>
          </p>
            <?php 

      echo form_hidden('id_produit', $id_produit);
      echo form_close();
      ?>
        </div>


