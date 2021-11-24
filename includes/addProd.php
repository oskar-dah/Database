<?php
  include_once 'dbHandler.php';

  $name = $_POST['products'];
  $price = $_POST['price'];
  $Amount = $_POST['amount'];
  $category = $_POST['category'];
  $sql = "INSERT INTO products VALUES (0, '$name', $price, $Amount, '$category');";
  mysqli_query($conn, $sql);

  header("Location: ../index.php?submit=success");

  
  $query = "SELECT * FROM products WHERE p_name = '$name' AND price = '$price';";
  $queryResult = mysqli_query($conn, $query);

  $row = mysqli_fetch_assoc($queryResult);
  $idValue = $row['idProduct'];

  if(mysqli_num_rows($queryResult)>0){
    $sql = "UPDATE products SET stock = stock + $Amount WHERE idProduct = '$idValue';";
  }else{
    $sql = "INSERT INTO products VALUES (null, '$name', '$price', '$Amount');";
  }
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  mysqli_query($conn, $sql);
  
  header("Location: ../index.php?submit=success");
  //Källor
  //https://stackoverflow.com/questions/18733545/selected-value-get-from-db-into-dropdown-select-box-option-using-php-mysql-error
?>