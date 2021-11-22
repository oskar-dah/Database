<?php
	include_once 'includes/dbHandler.php';
?>

<!DOCTYPE html>
<html>
<body>

<h1>Sign up</h1>

<form action = "includes/signUp.inc.php" method = "POST">
  
  <input type="text" name="uid" placeholder="Username"><br><br>
  
  <input type="password" name="password" placeholder="Password"><br><br>
  
  <input type="text" name="name" placeholder="Name"><br><br>
  
  <input type="text" name="lastName" placeholder="Last name"><br><br>
  
  <input type="text" name="address" placeholder="Address"><br><br>

  <input type="text" name="mail" placeholder="E-mail"><br><br>

  <input type="text" name="phoneNr" placeholder="Phone number"><br><br>

  <button type="submit" value="Submit"> Submit </button>
</form>

<?php
if(isset($_GET["error"])){
    if($_GET["error"] == "empty"){
        echo "<p> Fill in all fields </p>";
    }
    else if($_GET["error"] == "invalidChars"){
        echo "<p> Only a-z A-Z 0-9 in username </p>";
    }
    else if($_GET["error"] == "UsernameOrEmailExists"){
        echo "<p> Username or Email already exists </p>";
    }
    else if($_GET["error"] == "none"){
        echo "<p> You have signed up </p>";
    }
        
    }
?>

</body>
</html>