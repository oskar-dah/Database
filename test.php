<?php
	include_once 'includes/dbHandler.php';
?>

<!DOCTYPE html>
<html>
<body>

<h1>Welcome to Web-shop</h1>


<button type="button" onclick="location.href = 'addProduct.php';">Manage products</button>
<b>
<p>
<?php
	$sql = "SELECT * FROM products;";
//	$sql = "INSERT INTO product VALUES (4, 'Phone', 145, 1)";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
			echo "Name: " . $row['name'] . "<br>";
			echo "Category: " . $row['category'] . "<br>";
			echo "Price: " . $row['price'] . "<br>";
			echo "Stock: " . $row['stock'] . "<br>";
		}
	}  
?>
</p>
</b>
</body>
</html>