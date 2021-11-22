<?php
include_once 'dbHandler.php';
require_once 'functions.inc.php';

$uid = $_POST["uid"];
$pwd = $_POST["password"];


if(emptySignIn($uid, $pwd) !== false){
    header("location: ../signIn.php?error=empty");
    exit();
}
signIn($conn, $uid, $pwd);

