<?php
	include_once 'includes/dbHandler.php';
?>

<!DOCTYPE html>
<html>
<body>

<h1>Add new product</h1>

<form action = "includes/addProd.php" method = "POST">
  
  <input type="text" name="product" placeholder="Product"><br><br>
  
  <input type="text" name="price" placeholder="Price"><br><br>
  
  <input type="text" name="amount" placeholder="Amount"><br><br>

  <input type="text" name="category" placeholder="Category"><br><br>

  <button type="submit" value="Submit"> Submit </button>
</form>

<h1>Remove product</h1>

<form action = "includes/removeProd.php" method = "POST">
  
  <input type="text" name="productID" placeholder="ProductID"><br><br>

  <button type="submit" value="Submit"> Submit </button>
</form>

<b>
<p>
<?php
	$sql = "SELECT * FROM products;";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
			echo "Name: " . $row['p_name'] . "<br>";
			echo "Category: " . $row['category'] . "<br>";
			echo "Price: " . $row['price'] . "<br>";
			echo "Stock: " . $row['stock'] . "<br>";
		}
	}  

	$sql = "SELECT * FROM customer;";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo "<br>" . "ID: " . $row['username'] . "<br>";
			echo "Name: " . $row['password'] . "<br>";
		}
	}  

?>
</p>
</b>

</body>
</html>