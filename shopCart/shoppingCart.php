<?php
	include_once '../includes/dbHandler.php';
?>

<!DOCTYPE html>
<html>
<body>

<h1>Your shopping cart (WIP)</h1>

<b>
<p>
<?php
	$sql = "SELECT * FROM shopping_cart;";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
    //this loop needs to be changed to correct values
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
			echo "Name: " . $row['p_name'] . "<br>";
			echo "Price: " . $row['price'] . "<br>";
			echo "Stock: " . $row['stock'] . "<br>";
		}
	}  
?>
</p>
</b>
</body>
</html>