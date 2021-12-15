<?php 
include_once 'dbHandler.php';
$rID = $_POST['rID'];

$sql = "DELETE FROM reviews WHERE reviewID = '$rID';"; 
mysqli_query($conn, $sql);

header("Location: ../manageProducts.php?submit=success");
