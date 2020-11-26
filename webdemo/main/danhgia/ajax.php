<?php
	$conn = mysqli_connect('localhost','root','12345678','webdemo') or die("không thể kết nối tới database");
    if($_POST['act'] == 'rate'){
    	$ip = $_POST["username"];
    	$therate = $_POST['rate'];
    	$thepost = $_POST['post_id'];

    	$query = mysqli_query($conn,"SELECT * FROM star where username= '$ip' and idtl='$thepost'  "); 
    	// while($data = mysqli_fetch_assoc($query)){
    		// $rate_db[] = $data;
    	// }

    	if(mysqli_num_rows($query) == 0 ){
    		mysqli_query($conn,"INSERT INTO star (idtl, username, rate)VALUES('$thepost', '$ip', '$therate')");
    	}else{
    		mysqli_query($conn,"UPDATE star SET rate= '$therate' WHERE username = '$ip' and idtl='$thepost'");
    	}
    } 

?>