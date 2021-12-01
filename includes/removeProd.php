<?php
  include_once 'dbHandler.php';
  
  $ID = $_POST['remProductID'];

  //Removing products has to delete all the product from both products table and shipping_cart table. Bought product should store all purchases and should 
  //not be affected by change for current products. Problems arrise in the bought product table since it store a product id as foreign key, which prevents us from
  //removing that product in the product table. The product has to be removed in bought product before products table but should NOT be removed from bought products in the first place.

  //Current implementation of "removeProd" is to set stock to 0 and prevent customer from seeing the item in the store.

  $sql = "UPDATE products SET stock = 0 WHERE idProduct = '$ID';";
  mysqli_query($conn, $sql);

  header("Location: ../manageProducts.php?submit=success");
?>