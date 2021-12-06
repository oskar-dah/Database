<?php 
include_once 'dbHandler.php';
$userID = $_POST['userID'];

$sql = "UPDATE customer SET user_type = 'U' WHERE idCustomer = '$userID';"; 
mysqli_query($conn, $sql);

header("Location: ../manageUsers.php?submit=success");
