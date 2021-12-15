<?php
include_once 'dbHandler.php';

$ID = $_POST['amProductID'];
$Amount = $_POST['newAmount'];

//$sql = "INSERT INTO product VALUES (0,'$name', '$price', '$Amount', '$category');";
if($Amount > 0 && $ID){
    $sql = "UPDATE products SET stock = '$Amount' WHERE idProduct = '$ID';";
    mysqli_query($conn, $sql);

    header("Location: ../manageProducts.php?submit=success");
}else{?>
    <html>
    <h2>Input error! Negative value for price and amount is not allowed</h2>
    <form action="../manageProducts.php" method = "POST">
		<input type="submit" 
		  value="Ok">
	  </form>
    </html>
    <?php
}

?>