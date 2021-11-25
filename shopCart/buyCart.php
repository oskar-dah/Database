<?php

session_start();
include_once '../includes/dbHandler.php';
?>
<html>
<head> <link rel="stylesheet" href="../design/index.css?v=<?php echo time(); ?>"> 
</head>
</html>

<?php
if(isset($_SESSION["idCustomer"])){
	if($_SESSION["user_type"] == "A"){
		echo "<ul class=\"navbar\">";
		echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
		echo "<li><a href = 'shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = '../manageProducts.php'> Manage products </a> </li>";
		echo "<li><a href = '../includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";
	}
	else if($_SESSION["user_type"] == "U"){
		echo '<ul class="navbar">';
		echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
		echo "<li><a href = 'shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = '../includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";	
	}
}
else{
	echo '<ul class="navbar">';
	echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
	echo "<li><a href = '../signIn.php'> Sign in </a> </li>";
	echo "<li><a href = '../signUp.php'> Sign up </a> </li>";
	echo "<li><a href = 'shoppingCart.php'> Shopping cart </a> </li>";
	echo "</ul>";
}

$shopper = $_SESSION['idCustomer'];
$sql = "SELECT * FROM shopping_cart WHERE customer_idCustomer=$shopper;";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$result = mysqli_query($conn, $sql);
$checkResult = mysqli_num_rows($result);

if($checkResult > 0){
    $allowPurchase = true;
    $deniedProducts = array();

    while($productNr = mysqli_fetch_assoc($result)){
        $stock = "SELECT stock, p_name FROM products WHERE idProduct=$productNr[product_idProduct];";

        $stockRes = mysqli_query($conn, $stock);

        $rowStock = mysqli_fetch_assoc($stockRes);
        
        if($productNr['amount'] > $rowStock['stock']){

            array_push($deniedProducts, $rowStock['p_name']);
            $allowPurchase = false;
        }
    }

    if($allowPurchase){
        echo "HATA LÖVEN";
        echo $sql;

        $result = mysqli_query($conn, $sql);

        while($amount = mysqli_fetch_assoc($result)){
            $a = $amount['amount'];
            $sqlUpdate = "UPDATE products SET stock = stock - $a WHERE idProduct = $amount[product_idProduct];";
            mysqli_query($conn, $sqlUpdate);

            //KOM IHÅG ATT RENSA SHOPPING CART
        }
        $sql = "DELETE FROM shopping_cart WHERE customer_idCustomer = '$shopper';";
  	    mysqli_query($conn, $sql);
          
        header("Location: ../index.php?submit=success");

    } else {
        echo "error: dessa produkter finns inte i önskad mängd: <br>";

        for ($i = 0; $i < count($deniedProducts); $i++) {
            echo $deniedProducts[$i] . "<br>";
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
}  
?>