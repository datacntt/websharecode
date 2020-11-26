<?php
session_start();
	include 'csdl.php';
	xoanguoidung($_GET['username']);
	$_SESSION['username']="";
	$_SESSION['role']="";
	header("Location: quantriuser.php");
?>