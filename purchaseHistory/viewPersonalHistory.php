<?php
    session_start();
	include_once '../includes/dbHandler.php';
    //Starta session på samma sätt som de gjort i andra sidor
    //Hämta conn....
	include_once '../includes/overlay.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../design/index.css?v=<?php echo time(); ?>">
</head>
<body>

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
					///////////////////
				
				} 
				echo "<form action = 'viewPersonalHistory.php' method = 'POST'>";
				echo '<button onclick = "openmodal('.$row['products_idProduct'].')" type="button" class = "myBtn button"  >Review Item  </button>';
				echo '<div id = "m'.$row['products_idProduct'].'" class = "myModal modal">';
				echo '<div class="modal-content">';
				echo '<span onclick = "closemodal('.$row['products_idProduct'].')" class="close">&times;</span>';
				echo "<div class = 'reviewSec'>";
				echo '<p>Review product</p>';
				echo '<input type="text" name="rate" placeholder="Rating 1-5"><br><br>';
				echo '<input type="text" name="comment" placeholder="Comment"><br><br>';
				echo '<button class = "button2" name = "review" type="submit" value ="Submit" > Leave review </button>';
				echo '<input type="hidden" name="prodID" value ='. $row['products_idProduct'] .'>';
				echo "</div>";	 
				echo '</form>';
				echo '</div>';
				echo '</div>';		
			}
			echo "<h2> Total price for order " . $shipnum .": " . $totalPrice ."</h2><br>";
		
		}else{
			echo $sql . "Error in boughtproducts";
		}

	}
	if(isset($_POST["review"])){
		$id = $_POST["prodID"];
		$rating = $_POST["rate"];
		$comment = $_POST["comment"];
		echo "gt" . $_POST["prodID"];
		reviewProd($conn, $id, $rating, $comment, $_SESSION["idCustomer"]);
		echo "AAA";
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
	function reviewProd($conn, $id, $rating, $comment, $idCust){
		$select = "SELECT * from reviews where product_idProduct = '$id' and customer_idCustomer = '$idCust';";
		$result = mysqli_query($conn, $select);
	
		if(mysqli_num_rows($result) > 0){
			echo "Du har redan lämnat en review";
		}elseif($rating > 5 || $rating 	< 0){
			echo "Rating måste vara mellan 1 - 5";
		}
		else{
			$sql = "INSERT INTO reviews(customer_idCustomer, product_idProduct, comment, rating) VALUES ('$idCust', '$id', '$comment', '$rating');";
			mysqli_query($conn, $sql);
		}

	
	}
?>

<script>
console.log("loaded");
function openmodal(id){
	console.log(id);
	var modal = document.getElementById("m" + id);
	console.log(modal);
	modal.style.display = "block";
	window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
}
function closemodal(id){
	console.log(id);
	var modal = document.getElementById("m" + id);
	console.log(modal);
	modal.style.display = "none";
}
</script>
</body>
</html>