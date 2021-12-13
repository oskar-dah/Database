<?php
	include_once '../includes/dbHandler.php';
    require_once '../includes/functions.inc.php'; //session_start(); is in functions.inc
	include_once '../includes/overlay.php';
    allowAdminOnly();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../design/index.css?v=<?php echo time(); ?>">
</head>
<body>

<?php 
$orderNr = $_POST['orderNr'];

$sqlShipAddress = "SELECT shippingAddr, customer_idCustomer FROM shipment WHERE idShipment = $orderNr;";
$result = mysqli_query($conn, $sqlShipAddress);
$row = mysqli_fetch_assoc($result);
$shippingAddr = $row['shippingAddr'];
$idCustomer = $row['customer_idCustomer'];

if(isset($idCustomer)){
	?> <h2> <?php echo "Order: " . $orderNr; ?> </h2> <?php

	$sqlCust = "SELECT * FROM customer WHERE idCustomer = $idCustomer";
	printCustomer($sqlCust, $conn);
	echo "<b>Shipping Adress: $shippingAddr <b><br>";
}

$sql = "SELECT * FROM boughtproducts WHERE shipment_idShipment = $orderNr;";
printProducts($sql, $conn);

function printCustomer($sql, $conn){
	$result = mysqli_query($conn, $sql);
    $checkResult = mysqli_num_rows($result);

    if($checkResult > 0){
        while($row = mysqli_fetch_assoc($result)){
			$forname = $row['forname'];
			$lastname = $row['lastname'];
			$phoneNr = $row['phoneNr'];
			$email = $row['email'];

			echo "Customer: ". $forname . " " . $lastname . "<br>";
			echo "Phone number: " . $phoneNr . "<br>";
			echo "email: ". $email . "<br>";
        }
		

    } else {
		?> <h2> Sorry, could not find customer </h2> <?php
	}
}

function printProducts($sql, $conn){

    $result = mysqli_query($conn, $sql);
    $checkResult = mysqli_num_rows($result);

    if($checkResult > 0){
        while($row = mysqli_fetch_assoc($result)){

			$idProduct = $row['products_idProduct'];
			$quantity = $row['amount'];
			$price = $row['priceAtPurchase'];
			
			$sqlProd = "SELECT p_name FROM products WHERE idProduct = $idProduct;";
			$resultProd = mysqli_query($conn, $sqlProd);
			
			$rowProd = mysqli_fetch_assoc($resultProd);

			echo '<span style="font-size: 25px; color: #000000; font-weight: bold;"> <br>' . $rowProd['p_name'] .'<br></span>';
            echo "Product Number: $idProduct" . "<br>";
			echo "quantity: $quantity" . "<br>";
			echo '<span style="font-size: 19px; color: #000000; font-weight: bold;">Price: ' . $price*$quantity . 'kr<br></span>' ;
            
			
			?>
			<?php
        }
		

    } else {
		?> <h2> Sorry, could not find order <?php echo $_POST['orderNr']?> </h2> <?php
	}
	
}
?>


<b>
<p>

</body>
</html>