<?php 
include_once 'dbHandler.php';
$userID = $_POST['userID'];

$sql = "DELETE FROM customer WHERE idCustomer = '$userID';"; 
mysqli_query($conn, $sql);

header("Location: ../manageUsers.php?submit=success");
