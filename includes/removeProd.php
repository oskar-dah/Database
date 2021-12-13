<?php
  include_once 'dbHandler.php';
  
  $ID = $_POST['remProductID'];

  $sql = "UPDATE products SET stock = 0 WHERE idProduct = '$ID';";
  mysqli_query($conn, $sql);

  header("Location: ../manageProducts.php?submit=success");
?>