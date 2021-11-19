<?php
  include_once 'dbHandler.php';

  $name = $_POST['products'];
  $price = $_POST['price'];
  $Amount = $_POST['amount'];
  $category = $_POST['category'];

  /*function checkIfExist(){
    $query = "SELECT * FROM products WHERE p_name = '$name' AND stock = '$Amount' AND price = '$price';";
    $select = "SELECT idProduct FROM products WHERE p_name = '$name' AND stock = '$Amount' AND price = '$price';";
    $queryResult = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($queryResult);
    $idValue = $row['idProduct'];

    if(mysqli_num_rows($result)>0){
      $sql = "UPDATE products SET stock = stock + $price WHERE idProduct = '$idValue';"
    }else{
      $sql = "INSERT INTO products VALUES (null, '$name', '$price', '$Amount');";
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    mysqli_query($conn, $sql);
  }*/
  
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

/*
  $row = mysqli_fetch_assoc($result);
  $id = $row['idProduct'];
  $insert = "INSERT INTO category VALUES (null, '$id', '$category');";

  mysqli_query($conn, $insert);

<<<<<<< HEAD
 */
  
  
  //Källor
  //https://stackoverflow.com/questions/18733545/selected-value-get-from-db-into-dropdown-select-box-option-using-php-mysql-error
=======
  header("Location: ../index.php?submit=success");
>>>>>>> 40495a13339e12ae7728f5afde606efba877aaf6
?>