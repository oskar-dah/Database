<!DOCTYPE html>
<html>
<body>
<?php 

function emptySignUp($uid, $pwd, $name, $lastName, $mail, $phoneNr, $address){
    $result;
    if(empty($uid) || empty($pwd) || empty($name) || empty($lastName) || empty($mail) || empty($phoneNr) || empty($address)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emptySignIn($uid, $pwd){
    $result;
    if(empty($uid) || empty($pwd)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($uid){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $uid)){
        $result = true;
    }
    else {
        $result = false;
    }
}

function uidExists($conn, $uid, $mail){
$sql = "SELECT * FROM customer WHERE username = ? or email = ?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signUp.php?error=sqlinjection");
    exit();
}

mysqli_stmt_bind_param($stmt, "ss", $uid, $mail);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    return $row;
}
else{
    $result = false;
    return $result;
}
mysqli_stmt_close();
}

function createUser($conn, $uid, $pwd, $name, $lastName, $mail, $phoneNr, $address){
$sql = "INSERT INTO customer (username, password, forname, lastname, phoneNr, address, email, user_type) VALUES (? , ? , ? , ? , ?, ?, ?, 'U');";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signUp.php?error=sqlinjection");
    exit();
}

mysqli_stmt_bind_param($stmt, "sssssss", $uid, $pwd, $name, $lastName, $phoneNr, $address, $mail);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("location: ../signUp.php?error=none");
}

function signIn($conn, $uid, $pwd){
    $uidExists = uidExists($conn, $uid, $uid);
    if($uidExists === false){
        header("location: ../signIn.php?error=falselogin");
        exit();
    }
    $databasePWD = $uidExists['password'];
    $checkPwd = password_verify($pwd, $databasePWD);
    
    if($databasePWD ==! $pwd){
        header("location: ../signIn.php?error=falselogin");
        exit();
    }
    if($databasePWD === $pwd){
        if($uidExists['user_type'] == "B"){
            header("location: ../signIn.php?error=banned");
            exit();
        }
        session_start();
        $_SESSION['idCustomer'] = $uidExists['idCustomer'];
        $_SESSION['username'] = $uidExists['username'];
        $_SESSION['user_type'] = $uidExists['user_type'];
        header("location: ../index.php");
        exit();
    }
}

function allowAdminOnly(){
    if(isset($_SESSION["idCustomer"])){
        if($_SESSION["user_type"] !== "A"){
            ?> 
            <html><meta http-equiv="refresh" content="0; url=../index.php" /> </html>
            <?php
        }
    } else {
         ?>
        <html><meta http-equiv="refresh" content="0; url=../index.php" /> </html>
        <?php
    }
}

?>
</body>
</html>