<?php
$conn = mysqli_connect('localhost','root','','webdemo') or die("không thể kết nối tới database");
mysqli_query($conn,"SET NAMES 'UTF8'");
return $conn;
?>