<?php
$conn = mysqli_connect('localhost','root','','webdemo') or die("không thể kết nối tới database");
$idtl=$_REQUEST['idtl'];
$sql="update tailieu set soluotdl=soluotdl+1 where idtl='$idtl'";
mysqli_query($conn,$sql);
mysqli_close($conn);
$fpath = $_REQUEST['path'];
$fopen = fopen($fpath,"rb");
header("Content-Type:application/octet-stream");
header("Content-Length:".filesize($fpath));
header("Content-Disposition:attachment; filename=".$fpath);
$fread = fpassthru($fopen);
fclose($fopen);
?>
