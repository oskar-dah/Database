<?php
include_once 'dbHandler.php';

$ID = $_POST['amProductID'];
$Amount = $_POST['newAmount'];

//$sql = "INSERT INTO product VALUES (0,'$name', '$price', '$Amount', '$category');";
$sql = "UPDATE products SET stock = '$Amount' WHERE idProduct = '$ID';";
mysqli_query($conn, $sql);

header("Location: ../manageProducts.php?submit=success");
?>