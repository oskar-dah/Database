<?php
    include_once 'dbHandler.php';
  
    $ID = $_POST['pProductID'];
    $price = $_POST['newPrice'];
    
    //$sql = "INSERT INTO product VALUES (0,'$name', '$price', '$Amount', '$category');";
    if($price > 0 && $ID){
        $sql = "UPDATE products SET price = $price WHERE idProduct = '$ID';";
        mysqli_query($conn, $sql);
      
        header("Location: ../manageProducts.php?submit=success");
    }else{?>
        <html>
        <h2>Input error! Negative value for price is not allowed</h2>
        <form action="../manageProducts.php" method = "POST">
            <input type="submit" 
              value="Ok">
          </form>
        </html>
        <?php
    }
   
?>
