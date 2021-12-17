<?php
    
	include_once '../includes/dbHandler.php';
    require_once '../includes/functions.inc.php'; //session_start(); is in functions.inc
    include_once '../includes/overlay.php';
	allowAdminOnly();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../design/index.css?v=<?php echo time(); ?>">
</head>
<body>

<?php $shipmentLimit = 50;?>

<h1> Order History </h1>
<h3>showing <?php echo $shipmentLimit?> latest</h3>

<form action = "order.php" method = "POST">
	<input type="number" name="orderNr" placeholder="Order Number" min="0" required><br><br>
	<button class = "button" name = "test" type="submit" value="Submit"> Search </button>
</form>

<?php
//$sql = "SELECT idShipment FROM shipment ORDER BY idShipment DESC LIMIT $shipmentLimit;";
//printer($sql, $conn);

echo "<h3>Recieved orders</h3>";

$sql = "SELECT idShipment FROM shipment WHERE shipStatus='recieved' ORDER BY idShipment LIMIT $shipmentLimit;";
printer($sql, $conn);

echo "<hr>";
echo "<h3>In progress</h3>";

$sql = "SELECT idShipment FROM shipment WHERE shipStatus='inProgress' ORDER BY idShipment LIMIT $shipmentLimit;";
printer($sql, $conn);

echo "<hr>";
echo "<h3>Shipped orders</h3>";

$sql = "SELECT idShipment FROM shipment WHERE shipStatus='shipped' ORDER BY idShipment DESC LIMIT $shipmentLimit;";
printer($sql, $conn);

function printer($sql, $conn){
    $result = mysqli_query($conn, $sql);
    $checkResult = mysqli_num_rows($result);

    if($checkResult > 0){
        while($row = mysqli_fetch_assoc($result)){

			$orderNr = $row['idShipment'];

            echo "<br>" . "Order Number: ";
            ?>

			<form method="post" action="order.php" class="inline">
  			
			<button type="submit" name="orderNr" value=<?php echo $orderNr; ?> class="link-button">
    			<?php echo $orderNr; ?>
  			</button>
			</form>

			<?php
        }
    }
}

?>
<b>
<p>

</body>
</html>