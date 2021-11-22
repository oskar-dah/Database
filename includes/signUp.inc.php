<?php
	include_once 'dbHandler.php';
    require_once 'functions.inc.php';
   
    $uid = $_POST["uid"];
    $pwd = $_POST["password"];
    $name = $_POST["name"];
    $lastName = $_POST["lastName"];
    $address = $_POST["address"];
    $mail = $_POST["mail"];
    $phoneNr = $_POST["phoneNr"];

    if(emptySignUp($uid, $pwd, $name, $lastName, $mail, $phoneNr, $address) !== false){
        header("location: ../signUp.php?error=empty");
        exit();
    }

    if(invalidUid($uid !== false)){
        header("location: ../signUp.php?error=invalidChars");
        exit();
        }
        
    if(uidExists($conn, $uid, $mail) !== false){
        header("location: ../signUp.php?error=UsernameOrEmailExists");
        exit();
    }

    createUser($conn, $uid, $pwd, $name, $lastName, $mail, $phoneNr, $address);
 