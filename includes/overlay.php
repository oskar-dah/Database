<?php
if(isset($_SESSION["idCustomer"])){
	if($_SESSION["user_type"] == "A"){
		echo "<ul class=\"navbar\">";
		echo "<li> <a href = '/Database/index.php'> Web-shoppen </a></li>";
		echo "<li><a href = '/Database/shopCart/shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = '/Database/manageProducts.php'> Manage products </a> </li>";
		echo "<li><a href = '/Database/manageUsers.php'> Manage users </a> </li>";
		echo "<li><a href = '/Database/purchaseHistory/viewOrders.php'> Order History </a> </li>";
		echo "<li><a href = '/Database/includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";
	}
	else if($_SESSION["user_type"] == "U"){
		echo '<ul class="navbar">';
		echo "<li> <a href = '/Database/index.php'> Web-shoppen </a></li>";
		echo "<li><a href = '/Database/shopCart/shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = '/Database/purchaseHistory/viewPersonalHistory.php'> Purchase history </a> </li>";
		echo "<li><a href = '/Database/includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";	
	}
}
else{
	echo '<ul class="navbar">';
	echo "<li> <a href = '/Database/index.php'> Web-shoppen </a></li>";
	echo "<li><a href = '/Database/signIn.php'> Sign in </a> </li>";
	echo "<li><a href = '/Database/signUp.php'> Sign up </a> </li>";
	echo "<li><a href = '/Database/shopCart/shoppingCart.php'> Shopping cart </a> </li>";
	echo "</ul>";
}
?>