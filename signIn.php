<?php
	include_once 'includes/dbHandler.php';
    session_start();
	include_once 'includes/overlay.php';
?>

<!DOCTYPE html>
<html>
<head> <link rel="stylesheet" href="design/index.css?v=<?php echo time(); ?>"> </head>
<body>

<h1>Sign in</h1>

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
	else if($_GET["error"] == "banned"){
        echo "<p> You have been banned, contact Admin. </p>";

    }
}
?>
</body>
</html>