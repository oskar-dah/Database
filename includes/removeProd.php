<?php
  include_once 'dbHandler.php';
  
  $ID = $_POST['productID'];
  
  //$sql = "INSERT INTO product VALUES (0,'$name', '$price', '$Amount', '$category');";
  $sql = "UPDATE products SET stock = 0 WHERE idProduct = '$ID';";
  mysqli_query($conn, $sql);

  header("Location: ../index.php?submit=success");
?>