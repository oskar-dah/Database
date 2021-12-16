<?php
  include_once 'dbHandler.php';

  $name = $_POST['products'];
  $price = $_POST['price'];
  $Amount = $_POST['amount'];
  $category = $_POST['category'];

/*  $sql = "INSERT INTO products VALUES (0, '$name', $price, $Amount, '$category');";
  mysqli_query($conn, $sql);

  header("Location: ../index.php?submit=success");*/

  
  $query = "SELECT * FROM products WHERE p_name = '$name' AND price = '$price';";
  $queryResult = mysqli_query($conn, $query);

  $row = mysqli_fetch_assoc($queryResult);
  
  if($price > 0 && $Amount > 0 && $name && $category){
    if(mysqli_num_rows($queryResult)>0){
      $idValue = $row['idProduct'];
      $sql = "UPDATE products SET stock = stock + $Amount WHERE idProduct = '$idValue';";
    }else{
      $sql = "INSERT INTO products VALUES (null, '$name', '$price', '$Amount', '$category');";
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    mysqli_query($conn, $sql);
    header("Location: ../manageProducts.php?submit=success");
  }elseif($price < 1 || $Amount < 1){?>
    <html>
    <h2>Input error! Negative value for price and amount is not allowed</h2>
    <form action="../manageProducts.php" method = "POST">
		<input type="submit" 
		  value="Ok">
	  </form>
    </html>
    <?php
  }else{
    ?>
    <html>
    <h2>Input error! Fill in all fields</h2>
    <form action="../manageProducts.php" method = "POST">
		<input type="submit" 
		  value="Ok">
	  </form>
    </html>
    <?php
  }
  
 
  
  
?>