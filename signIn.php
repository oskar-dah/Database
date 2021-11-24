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
<h1>Sign up</h1>

<form action = "includes/signIn.inc.php" method = "POST">
  
  <input type="text" name="uid" placeholder="Username"><br><br>
  
  <input type="password" name="password" placeholder="Password"><br><br>

  <button type="submit" value="Submit"> Submit </button>
</form>
<?php
if(isset($_GET["error"])){
    if($_GET["error"] == "empty"){
        echo "<p> Fill in all fields </p>";
    }
    else if($_GET["error"] == "signedIn"){
        echo "<p> You are logged in </p>";
    }
    else if($_GET["error"] == "falselogin"){
        echo "<p> Wrong information </p>";
    }


        
    }
?>
</body>
</html>