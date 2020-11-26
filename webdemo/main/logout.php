<?php
session_start();
$_SESSION['username'] ="";
$_SESSION['role']="";
header("Location: index.php");
?>