<?php
    session_start();
    include_once '../includes/dbHandler.php';
    include_once '../includes/overlay.php';
?>
<html>
<head> <link rel="stylesheet" href="../design/index.css?v=<?php echo time(); ?>"> 
</head>
</html>

<?php
$shopper = $_SESSION['idCustomer'];
$shippingAddr = $_POST['shippingAddr'];

$sql = "SELECT * FROM shopping_cart WHERE customer_idCustomer=$shopper;";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$shoppersCart = mysqli_query($conn, $sql);
$checkResult = mysqli_num_rows($shoppersCart);

if($checkResult > 0){
    $allowPurchase = true;
    $deniedProducts = array();
    
    $mutex = "START TRANSACTION;";
    mysqli_query($conn, $mutex);

    while($productNr = mysqli_fetch_assoc($shoppersCart)){
        $stock = "SELECT stock, p_name FROM products WHERE idProduct=$productNr[product_idProduct];";

        $stockRes = mysqli_query($conn, $stock);

        $rowStock = mysqli_fetch_assoc($stockRes);
        
        if($productNr['amount'] > $rowStock['stock']){

            array_push($deniedProducts, $rowStock['p_name']);
            $allowPurchase = false;
        }
    }

    if($allowPurchase){

        $sqlInsert = "INSERT INTO shipment (idShipment, customer_idCustomer, shippingAddr) VALUES (null, '$shopper', '$shippingAddr');";
        mysqli_query($conn, $sqlInsert);

        $sqlShipID = "SELECT idShipment FROM shipment ORDER BY idShipment DESC LIMIT 1;";
        $currShipmentID = mysqli_query($conn, $sqlShipID);
        $currShipID = mysqli_fetch_assoc($currShipmentID);
        //echo $currShipID['idShipment'];

        $sql = "SELECT * FROM shopping_cart WHERE customer_idCustomer=$shopper;";
        $shoppersCart = mysqli_query($conn, $sql);

        

        while($prodInCart = mysqli_fetch_assoc($shoppersCart)){
            $a = $prodInCart['amount'];
            $idCurrProduct = $prodInCart['product_idProduct'];

            $sqlPrice = "SELECT price FROM products WHERE idProduct=$idCurrProduct;";
  	        $priceProd = mysqli_query($conn, $sqlPrice);
            $priceAtPurchase = mysqli_fetch_assoc($priceProd); 

            $sqlUpdate = "UPDATE products SET stock = stock - $a WHERE idProduct = $idCurrProduct;";
            mysqli_query($conn, $sqlUpdate);

            $sqlIns = "INSERT INTO boughtproducts (idBoughtProducts, products_idProduct, shipment_idShipment, priceAtPurchase, amount) VALUES (null, '$idCurrProduct', '$currShipID[idShipment]', '$priceAtPurchase[price]', $a);";
            mysqli_query($conn, $sqlIns);
        }

        $sqlDel = "DELETE FROM shopping_cart WHERE customer_idCustomer = '$shopper';";
  	    mysqli_query($conn, $sqlDel);
        
        $mutex = "COMMIT;";
        mysqli_query($conn, $mutex);

        header("Location: ../index.php?submit=success");

    } else {

        $mutex = "COMMIT;";
        mysqli_query($conn, $mutex);

        echo "error: these products is not available in specified quantity: <br>";

        for ($i = 0; $i < count($deniedProducts); $i++) {
            echo " - " . $deniedProducts[$i] . "<br>";
        }

        ?>
        <html>
        <form action="shoppingCart.php" method = "POST">
		    <input type="submit" 
			value="Ok">
		</form>
        </html>

        <?php
    }
}  else {
    ?>
    <html>
    <h2>Your cart is empty!</h2>
    <form action="shoppingCart.php" method = "POST">
		<input type="submit" 
		value="Ok">
	</form>
    </html>

    <?php
}
?>