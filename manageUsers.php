<?php
	include_once 'includes/dbHandler.php';
	session_start();
	include_once 'includes/overlay.php';
?>

<!DOCTYPE html>
<html>
<head> <link rel="stylesheet" href="design/index.css?v=<?php echo time(); ?>"> </head>
<body>

<div class = "menu1">
<h1>Delete users</h1>

<form action = "includes/deleteUsers.php" method = "POST">
  
  <input type="text" name="userID" placeholder="userID"><br><br>

  <button class = "button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu2">
<h1> Ban user</h1>

<form action = "includes/ban.php" method = "POST">
  
  <input type="text" name="userID" placeholder="userID"><br><br>

  <button name = "removeB" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu3">
<h1>Unban user </h1>

<form action = "includes/unban.php" method = "POST">
  
  <input type="text" name="userID" placeholder="userID"><br><br>

  <button name = "removeB" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "printout">
<b>
<p>
<?php
	$sql = "SELECT * FROM customer;";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo "<br>" . "User ID: " . $row['idCustomer'] . "<br>";
			echo "Name: " . $row['username'] . "<br>";
			echo "Password: " . $row['password'] . "<br>";
            echo "Role: " . $row['user_type'] . "<br>";
		}
	}  
?>
</p>
</b>
</div>
</body>
</html>