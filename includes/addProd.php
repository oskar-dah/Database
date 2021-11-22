<?php
  include_once 'dbHandler.php';

  $name = $_POST['products'];
  $price = $_POST['price'];
  $Amount = $_POST['amount'];
  $category = $_POST['category'];
  $sql = "INSERT INTO products VALUES (0, '$name', $price, $Amount, '$category');";
  mysqli_query($conn, $sql);

  header("Location: ../index.php?submit=success");
?>