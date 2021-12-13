<?php
    session_start();
	include_once '../includes/dbHandler.php';
    //Starta session på samma sätt som de gjort i andra sidor
    //Hämta conn....

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
?>
<h1> Purchase history </h1>
<b>
<p>
<?php
    function printer($sql, $conn){//Modifiera denna till boughtproducts samt hämta namn på prod från prodID
		$result = mysqli_query($conn, $sql);
		$checkResult = mysqli_num_rows($result);

        $totalPrice = 0;
		$shipnum = 0;
		if($checkResult > 0){
			while($row = mysqli_fetch_assoc($result)){
                $prodID = $row['products_idProduct'];
                $prod = "SELECT p_name FROM products WHERE idProduct = '$prodID';";
                $prodResult = mysqli_query($conn, $prod);
                $name = mysqli_fetch_assoc($prodResult);

				if(mysqli_num_rows($prodResult) > 0){
					if($shipnum != $row['shipment_idShipment']){
						echo "<h2> Shipping ID: " . $row['shipment_idShipment'] . "</h2>";
					}
					echo "Name: " . $name['p_name'] . "<br>";
					echo "Price: " . $row['priceAtPurchase'] . "<br>";
					echo "Amount: " . $row['amount'] . "<br><br>";

					$shipnum = $row['shipment_idShipment'];
					$totalPrice += $row['priceAtPurchase'] * $row['amount'];
				}
			}
			echo "<h2> Total price for order " . $shipnum .": " . $totalPrice ."</h2><br>";
		}else{
			echo $sql . "Error in boughtproducts";
		}
	}

    //SELECT idShipment FROM shipment WHERE customer_idCustomer = $ID;
    //mysqli_query();
	if(isset($_SESSION["idCustomer"])){
		$ID = $_SESSION["idCustomer"];

		$user = "SELECT * FROM customer WHERE idCustomer = '$ID';";
		$uRes = mysqli_query($conn, $user);

		if(mysqli_num_rows($uRes) > 0){
			while($uFet = mysqli_fetch_assoc($uRes)){
				echo "<h2><br>" . "Name: " . $uFet['forname'] . " " .$uFet['lastname'];
				echo "<br>" . "Phone number " . $uFet['phoneNr'] . "</h2>";
			}

		}


		$sql = "SELECT idShipment FROM shipment WHERE customer_idCustomer = '$ID';";
		$sqlResult = mysqli_query($conn, $sql);
		//$checkRes = mysqli_num_rows($sqlResult);

		//while resultat finns från select statement
		if(mysqli_num_rows($sqlResult) > 0){
			while($row = mysqli_fetch_assoc($sqlResult)){
				$tmp = $row['idShipment'];
				$quer = "SELECT * FROM boughtproducts WHERE shipment_idShipment = '$tmp';";
				printer($quer, $conn);
			}
		}
	}
    
    
    //SELECT * FROM boughtproducts WHERE shipment_idShipment = resultat
    //mysqli_query();
    //printer();
?>


</body>
</html>