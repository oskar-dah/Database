<?php

session_start();
include_once '../includes/dbHandler.php';
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
        //$sql = "UPDATE products SET stock = stock - $productNr['amount'] WHERE idProduct = $productNr[product_idProduct];";

    }
    if($allowPurchase){
        echo "HATA LÖVEN";
    } else {
        echo "DIGIMON";//neka köp, printa varor som nekades och ta bort dessa från korgen
    }
}  
?>