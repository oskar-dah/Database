<?php
    include_once 'dbHandler.php';
  
    $ID = $_POST['pProductID'];
    $price = $_POST['newPrice'];
    
    //$sql = "INSERT INTO product VALUES (0,'$name', '$price', '$Amount', '$category');";
    $sql = "UPDATE products SET price = $price WHERE idProduct = '$ID';";
    mysqli_query($conn, $sql);
  
    header("Location: ../manageProducts.php?submit=success");
?>
