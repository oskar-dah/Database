<?php
include_once 'dbHandler.php';
session_start();
session_destroy();
header("location: ../index.php");