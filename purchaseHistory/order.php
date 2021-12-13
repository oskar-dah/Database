<?php
	include_once '../includes/dbHandler.php';
    require_once '../includes/functions.inc.php'; //session_start(); is in functions.inc
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

$orderNr = $_POST['orderNr'];

if(isset($_POST['shippingAddr'])){
	$shippingAddr = rawurldecode($_POST['shippingAddr']);
} else {
	$sqlShipAddress = "SELECT shippingAddr FROM shipment WHERE idShipment = $orderNr;";
	$result = mysqli_query($conn, $sqlShipAddress);
	$row = mysqli_fetch_assoc($result);
	$shippingAddr = $row['shippingAddr'];
}

echo $shippingAddr;


$sql = "SELECT * FROM boughtproducts WHERE shipment_idShipment = $orderNr;";
printProducts($sql, $conn);
echo"Shipping Adress: $shippingAddr";

function printProducts($sql, $conn){
    $result = mysqli_query($conn, $sql);
    $checkResult = mysqli_num_rows($result);

    if($checkResult > 0){
        while($row = mysqli_fetch_assoc($result)){

			$idProduct = $row['products_idProduct'];
			$quantity = $row['amount'];
			$price = $row['priceAtPurchase'];
			
			$sqlProd = "SELECT * FROM boughtproducts;";

            echo "<br>" . "Product Number: $idProduct" . "<br>";
			echo "quantity: $quantity" . "<br>";
			echo '<span style="font-size: 19px; color: #000000; font-weight: bold;">Price: ' . $price*$quantity . 'kr<br></span>' ;
            
			
			?>
			<?php
        }
    } else {
		echo "så kan de gå";
	}
	
}
?>


<b>
<p>

</body>
</html>