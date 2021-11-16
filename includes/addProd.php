<?php
  include_once 'dbHandler.php';
  
  $name = $_POST['products'];
  $price = $_POST['price'];
  $Amount = $_POST['amount'];
  $category = $_POST['category'];

  $sql = "INSERT INTO products VALUES (null, '$name', '$price', '$Amount', '$category');";

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  mysqli_query($conn, $sql);



  header("Location: ../test.php?submit=success");
?>