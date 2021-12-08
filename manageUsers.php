<?php
	include_once 'includes/dbHandler.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head> <link rel="stylesheet" href="design/index.css?v=<?php echo time(); ?>"> </head>
<body>

<?php
if(isset($_SESSION["idCustomer"])){
	if($_SESSION["user_type"] == "A"){
		echo "<ul class=\"navbar\">";
		echo "<li> <a href = 'index.php'> Web-shoppen </a></li>";
		echo "<li><a href = 'shopCart/shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = 'manageProducts.php'> Manage products </a> </li>";
        echo "<li><a href = 'manageUsers.php'> Manage users </a> </li>";
		echo "<li><a href = 'includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";
	}
	else if($_SESSION["user_type"] == "U"){
		echo '<ul class="navbar">';
		echo "<li> <a href = 'index.php'> Web-shoppen </a></li>";
		echo "<li><a href = 'shopCart/shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = 'includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";	
	}
}
else{
	echo '<ul class="navbar">';
	echo "<li> <a href = 'index.php'> Web-shoppen </a></li>";
	echo "<li><a href = 'signIn.php'> Sign in </a> </li>";
	echo "<li><a href = 'signUp.php'> Sign up </a> </li>";
	echo "<li><a href = 'shopCart/shoppingCart.php'> Shopping cart </a> </li>";
	echo "</ul>";
}
?>
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