<?php
require_once ("db.php");
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$commentSenderName = isset($_POST['name']) ? $_POST['name'] : "";
$date = date('Y-m-d H:i:s');
$idtl = isset($_POST['idtl']) ? $_POST['idtl'] : "";

$sql = "INSERT INTO tbl_comment VALUES ('','" . $commentId . "',N'" . $comment . "','" . $commentSenderName . "','" . $date . "',$idtl)";

$result = mysqli_query($conn, $sql);

if (! $result) {
    $result = mysqli_error($conn);
}
echo $result;
?>
