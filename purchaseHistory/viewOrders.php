<?php
    session_start();
	include_once '../includes/dbHandler.php';
    require_once '../includes/functions.inc.php'; 
    allowAdminOnly();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../design/index.css?v=<?php echo time(); ?>">
</head>
<body>

<?php
if(isset($_SESSION["idCustomer"])){
	if($_SESSION["user_type"] == "A"){
		echo "<ul class=\"navbar\">";
		echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
		echo "<li><a href = '../shopCart/shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = '../manageProducts.php'> Manage products </a> </li>";
		echo "<li><a href = '../manageUsers.php'> Manage users </a> </li>";
		echo "<li><a href = 'viewOrders.php'> Order History </a> </li>";
		echo "<li><a href = '../includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";
	}
	else if($_SESSION["user_type"] == "U"){
		echo '<ul class="navbar">';
		echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
		echo "<li><a href = '../shopCart/shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = '../includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";	
	}
}
else{
	echo '<ul class="navbar">';
	echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
	echo "<li><a href = '../signIn.php'> Sign in </a> </li>";
	echo "<li><a href = '../signUp.php'> Sign up </a> </li>";
	echo "<li><a href = '../shopCart/shoppingCart.php'> Shopping cart </a> </li>";
	echo "</ul>";
}

$shipmentLimit = 100;

?>
<h1> Order History </h1>
<h3>showing: <?php echo $shipmentLimit?> latest</h3>
<?php

$sql = "SELECT * FROM shipment ORDER BY idShipment DESC LIMIT $shipmentLimit;";
printer($sql, $conn);


function printer($sql, $conn){
    $result = mysqli_query($conn, $sql);
    $checkResult = mysqli_num_rows($result);

    if($checkResult > 0){
        while($row = mysqli_fetch_assoc($result)){

			$orderNr = $row['idShipment'];

            echo "<br>" . "Order Number: ";
            ?>

			<form method="post" action="order.php" class="inline">

  			<input type="hidden" name="extra_submit_param" value="extra_submit_value">
  			
			<button type="submit" name="orderNr" value=<?php echo $orderNr; ?> class="link-button">
    			<?php echo $orderNr; ?>
  			</button>
			</form>

			<?php
        }
    }
}

?>
<b>
<p>

</body>
</html>