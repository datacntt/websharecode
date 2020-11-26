<html>

<head>
	<title>trần đông - Form đăng ký thành viên</title>
	<meta charset="utf-8">

	<style type="text/css">
		/*CSS File For Sign-In webpage*/
		#body-color {
			background-color: #BFBAE5;
		}

		#Sign-In {
			margin-top: 50px;
			margin-bottom: 150px;
			margin-right: 150px;
			margin-left: 450px;
			border: 3px solid #a1a1a1;
			padding: 9px 35px;
			background: #0C7FB4;
			width: 400px;
			border-radius: 20px;
			box-shadow: 7px 7px 6px;
		}

		#button {
			border-radius: 10px;
			width: 100px;
			height: 40px;
			background: #1f568b;
			font-weight: bold;
			font-size: 15px;
			color: #f1f1f1;
		}

		#button:hover {
			height: 40px;
			background: #f1f1f1;
			color: #333;
		}

		#button1 {
			border-radius: 10px;
			width: 200px;
			height: 40px;
			background: #1f568b;
			color: #f1f1f1;
			font-weight: bold;
			font-size: 15px;
			margin-left: 100px;
		}

		#button1:hover {
			height: 40px;
			background: #f1f1f1;
			color: #333;
		}
	</style>
</head>

<body>
	<?php
	require_once("connection.php");
	if (isset($_POST["btn_submit"])) {
		//lấy thông tin từ các form bằng phương thức POST
		$username = $_POST["username"];
		$password = md5($_POST["pass"]);
		$passwordnl = md5($_POST["passnl"]);
		$name = $_POST["name"];
		$email = $_POST["email"];
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		$passwordn1 = strip_tags($passwordn1);
		$passwordn1 = addslashes($passwordn1);
		$name = strip_tags($name);
		$name = addslashes($name);
		$email = strip_tags($email);
		$email = addslashes($email);
		//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
		if ($username == "" || $_POST['pass'] == "" || $_POST['passnl'] == "" || $name == "" || $email == "") {
			$chuoi = "<script>";
			$chuoi = $chuoi . "alert('bạn vui lòng nhập đầy đủ thông tin')" . "</script>";
			echo "$chuoi";
		} else {
			// Kiểm tra tài khoản đã tồn tại chưa
			$sql = "select * from users where username='$username'";
			$kt = mysqli_query($conn, $sql);

			if (mysqli_num_rows($kt)  > 0) {

				$chuoi = "<script>";
				$chuoi = $chuoi . "alert('Tài khoản đã tồn tại')" . "</script>";
				echo "$chuoi";
			} else {
				//thực hiện việc lưu trữ dữ liệu vào db
				if ($password == $passwordnl) {
					$sql = "INSERT INTO users(
	    					username,
	    					password,
	    					name,
						    email,
							role
	    					) VALUES (
	    					'$username',
	    					'$password',
						    '$name',
	    					'$email',
							2
	    					)";
					// thực thi câu $sql với biến conn lấy từ file connection.php
					mysqli_query($conn, $sql);
					$chuoi = "<script>";
					$chuoi = $chuoi . "alert('chúc mừng bạn đã đăng ký thành công')" . "</script>";
					echo "$chuoi";
				} else {
					$chuoi = "<script>";
					$chuoi = $chuoi . "alert('mật khẩu không trùng nhau')" . "</script>";
					echo "$chuoi";
				}
			}
		}
	}
	?>
</body>

<body id="body-color">
	<div id="Sign-In">
		<form action="register.php" method="post">
			<fieldset>
				<legend style="font-weight:bold; font-size:15px">Form đăng ký</legend>
				<table>
					<tr>
						<td>Username :</td>
						<td><input type="text" id="username" name="username" size="30"></td>
					</tr>
					<tr>
						<td>Password :</td>
						<td><input type="password" id="pass" name="pass" size="30"></td>
					</tr>
					<tr>
						<td>Nhập lại Password :</td>
						<td><input type="password" id="passnl" name="passnl" size="30"></td>
					</tr>
					<tr>
						<td>Họ tên :</td>
						<td><input type="text" id="name" name="name" size="30"></td>
					</tr>
					<tr>
						<td>Email :</td>
						<td><input type="text" id="email" name="email" size="30"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input id="button" type="submit" name="btn_submit" value="Đăng ký"></td>
					</tr>

				</table>
			</fieldset>
		</form>
		<a href="login.php"><button id="button1">Quay lại đăng nhập</button></a>
	</div>
</body>

</html>