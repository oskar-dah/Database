<?php
	session_start();
	include_once 'includes/dbHandler.php';
	include_once 'includes/overlay.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="design/index.css?v=<?php echo time(); ?>">
</head>
<body>
	
<div class="search">
	<h1> Here we do some searching </h1>	
	<form action = "index.php" method = "POST">
		<input type="text" name="cat" placeholder="Category"><br><br>
		<div class="dropdown">
  		<div class="dropbtn">Sort by</div>
			<div class="dropdown-content">
				<form action = "index.php" method = "POST">
					<button class = "dropperB" name = "btnCat" type="submit" value="Submit"> Submit (no filter) </button> 
					<button class = "dropperB" name = "pLf" type="submit" value="Submit"> Price (lowest first) </button>
					<button class = "dropperB" name = "pHf" type="submit" value="Submit"> Price (highest first) </button>
					<button class = "dropperB" name = "nAz" type="submit" value="Submit"> Name (A-Z) </button>
					<button class = "dropperB" name = "nZa" type="submit" value="Submit"> Name (Z-A) </button>
				</form>
			</div>
		</div>
		
	</form>
</div>
<b>
<p>

<?php
	function addToCart($idProduct, $conn, $idCust){
		$query = "SELECT * FROM shopping_cart WHERE customer_idCustomer = '$idCust' AND product_idProduct = '$idProduct';";
		$queryResult = mysqli_query($conn, $query);

		$row = mysqli_fetch_assoc($queryResult);
	
		if(mysqli_num_rows($queryResult)>0){
			$add = "UPDATE shopping_cart SET amount = amount + 1 WHERE customer_idCustomer = '$idCust' AND product_idProduct = '$idProduct';";
		}else{
			$add = "INSERT INTO shopping_cart VALUES (null, '$idCust', '$idProduct', 1);";
		}
		
		mysqli_query($conn, $add);
	}
	
	function printer($sql, $sql2, $conn){
		$result = mysqli_query($conn, $sql);
		$result2 = mysqli_query($conn, $sql2);
		$checkResult = mysqli_num_rows($result);
		$checkResult2 = mysqli_num_rows($result2);
		if($checkResult > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['stock'] > 0){
					echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
					echo "Name: " . $row['p_name'] . "<br>";
					echo "Category: " . $row['category'] . "<br>";
					echo "Price: " . $row['price'] . "<br>";
					echo "Stock: " . $row['stock'] . "<br>";
					echo "<form action='index.php' method='post'>";
					echo '<button name = "add" class = "button" type="submit" value ='. $row['idProduct'] .'>Add to cart</button>';
					echo "</form>";
					echo "<form action = 'index.php' method = 'POST'>";
					echo '<button onclick = "openmodal('.$row['idProduct'].')" type="button" class = "myBtn button"  > View Reviews</button>';
					echo '<div id = "m'.$row['idProduct'].'" class = "myModal modal">';
					echo '<div class="modal-content">';
					echo '<span onclick = "closemodal('.$row['idProduct'].')" class="close">&times;</span>';
					  while($row2 = mysqli_fetch_assoc($result2)){
						  if($row2["product_idProduct"] == $row['idProduct']){
							echo "<div class = 'commentSec'>";
							echo "uid: " . $row2['customer_idCustomer'] . "<br>";
							echo "Rating: " . $row2['rating'] . "<br>";
							echo "Comment:" .$row2['comment'] . "<br>";
							echo "ProdID:" .$row2['product_idProduct'];
							echo "</div>";
						  } 
					  }
					  mysqli_data_seek($result2,0);
					echo '</form>';
					echo '</div>';
					echo '</div>';
				}
			}
			if(isset($_POST["add"])){
				if(isset($_SESSION["idCustomer"])){
					//echo "Produkten" . $_POST["add"];
					$id = $_POST["add"];
					addToCart($id, $conn, $_SESSION["idCustomer"]);
				}else{
					echo '<meta http-equiv="refresh" content="0; url=signUp.php" />';
				}
			}
		}
	}

	$sql = "SELECT * FROM products";
	if(!empty($_POST["cat"])){
		$cat = $_POST["cat"];
		$sql = $sql . " WHERE category = '$cat'";
	}

	if(isset($_POST["btnCat"])){
		//$sql ="SELECT * FROM products WHERE category = '$cat';";
		if(!empty($_POST["cat"])){
			echo "<h1> Viewing all " . $cat . "</h1>";
		}else{
			echo "<h1> All products </h1>";
		}
		//printer($sql, $conn);
	}elseif(isset($_POST["pLf"])){
		echo "<h1> Viewing products lowest to highest </h1>";
		$sql = $sql .  " ORDER BY price ASC";
		//printer($sql, $conn);
	}elseif(isset($_POST["pHf"])){
		echo "<h1> Viewing products highest to lowest </h1>";
		$sql = $sql .  " ORDER BY price DESC";
		//printer($sql, $conn);
	}elseif(isset($_POST["nAz"])){
		echo "<h1> Viewing products A-Z </h1>";
		$sql = $sql .  " ORDER BY p_name ASC";
		//printer($sql, $conn);
	}elseif(isset($_POST["nZa"])){
		echo "<h1> Viewing products Z-A </h1>";
		$sql = $sql . " ORDER BY p_name DESC";
		//printer($sql, $conn);
	}else{
		echo "<h1> All products </h1>";
		$sql = $sql . ";";
	}
	$sql2 = "SELECT * FROM reviews;";
	printer($sql, $sql2, $conn);
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

<b>
<p>

</body>
</html>