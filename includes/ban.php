<?php 
include_once 'dbHandler.php';
$userID = $_POST['userID'];

$sql = "UPDATE customer SET user_type = 'B' WHERE idCustomer = '$userID';"; 
mysqli_query($conn, $sql);

header("Location: ../manageUsers.php?submit=success");
