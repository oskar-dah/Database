<?php
  include_once 'dbHandler.php';
  
  $name = $_POST['product'];
  $price = $_POST['price'];
  $Amount = $_POST['amount'];
  $category = $_POST['category'];
  $sql = "INSERT INTO product VALUES (0,'$name', '$price', '$Amount', '$category');";
  mysqli_query($conn, $sql);

  header("Location: ../test.php?submit=success");
?>