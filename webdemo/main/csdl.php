<?php 
function ketnoi()
{
$conn = mysqli_connect('localhost','root','','webdemo') or die("không thể kết nối tới database");
mysqli_query($conn,"SET NAMES 'UTF8'");
return $conn;
}
//
function menudanhmuc()
{
	$conn=ketnoi();
	$sql="select * from danhmuc";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$chuoi="";
		while($row=mysqli_fetch_array($kq))
		{
			$chuoi.="<li><a href='danhmuc.php?iddm=$row[0]'>$row[1]</a></li>";
		}
		echo $chuoi;
	}
	mysqli_close($conn);
}
//
function tailieumoi()
{
	$conn=ketnoi();
	$sql="select idtl,tentl,danhmuc.path from tailieu inner join danhmuc on tailieu.iddm=danhmuc.iddm order by idtl desc limit 4";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$tlm="<div class='tieude' style='margin-top:36px;'>
		<div class='icontieude'><img src='images/icon_dichvu.png'></div>
		<p>Tài liệu mới</p></div>";
		$chuoi="<div class='boc'>";
		while($row=mysqli_fetch_array($kq))
		{
			$chuoi.="<div class='tailieumoi' title='$row[1]'><a href='hienthi.php?idtl=$row[0]'> <img style ='width:230px;height:245px;' src='$row[2]'><p>$row[1]</p></a><br></div >";
		}
		echo $tlm;
		echo $chuoi;
		$chuoi.="</div >";
	}
	mysqli_close($conn);
}
//
function tailieunoibat()
{
	$conn=ketnoi();
	$sql="select tailieu.idtl,tentl,danhmuc.path,AVG(rate) from (tailieu inner join danhmuc on tailieu.iddm=danhmuc.iddm) left join star on tailieu.idtl=star.idtl group by tailieu.idtl order by AVG(rate) desc limit 4";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$tlnb="<div class='tieude' style='margin-top:80px;'>
		<div class='icontieude'><img src='images/icon_dichvu.png'></div>
		<p>Tài liệu nổi bật</p></div>";
		$chuoi="<div class='boc'>";
		while($row=mysqli_fetch_array($kq))
		{
			$chuoi.="<div class='tailieumoi' title='$row[1]'><a href='hienthi.php?idtl=$row[0]'><img style ='width:230px;height:245px;' src='$row[2]'><p>$row[1]</p></a><br></div >";
		}
		echo $tlnb;

		$chuoi.="</div >";
				echo $chuoi;
	}
	mysqli_close($conn);
}
//
function selectdanhmuc()
{
	$conn=ketnoi();
	$sql="select * from danhmuc";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$chuoi="";
		while($row=mysqli_fetch_array($kq))
		{
			$chuoi.="<option value='$row[0]'>$row[1]</option>";
		}
		echo $chuoi;
	}
	mysqli_close($conn);
}
//
function selecttailieu($idtl)
{
	$conn=ketnoi();
	$sql="update tailieu set luotxemtl=luotxemtl+1 where idtl=$idtl";
	mysqli_query($conn,$sql);
	$sql="select idtl,username,tailieu.iddm,tentl,tailieu.path,soluotdl,luotxemtl,danhmuc.tendm,danhmuc.path from tailieu inner join danhmuc on tailieu.iddm=danhmuc.iddm where tailieu.idtl='$idtl'";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$chuoi="<h1>";
		while($row=mysqli_fetch_array($kq))
		{
			$tenfile=substr($row[4],8);
			$chuoi.="$row[3]</h1><div class='borderanh'><img src='$row[8]' id='anhdaidien' title='$row[3]'></div>
			<br>Người đăng: $row[1]<br>Danh mục: $row[7]<br>Số lượt xem: $row[6]<br>Số lượt download: $row[5]<br>
			<a title='Download tài liệu' href='download.php?idtl=$row[0]&path=$row[4]'><img src='images/download.jpg' id='anhdown'><p id='tenfile'>Download</p></a>";
		}
		echo $chuoi;
	}
	mysqli_close($conn);
}
//
function timkiem()
{
	$tttk=$_GET['s'];
			$tttk = strip_tags($tttk);
		$tttk = addslashes($tttk);
	if($tttk=="")
	{	
		echo "<div class='danhmuc'><img id='icondanhmuc' src='images/icon_btv.png'>Kết quả tìm kiếm cho: $tttk<br></div>";
		echo "<div id='kocotailieu'>Bạn phải điền thông tin tìm kiếm</div>";
		echo "<style>
		.danhmuckhac{
			  margin-top: 0px;
		}
		.quangcao{
			 margin-top: 0px;
		}
		</style>";
	}
	else
	{
	echo "<div class='danhmuc'><img id='icondanhmuc' src='images/icon_btv.png'>Kết quả tìm kiếm cho: $tttk<br></div>";
	$conn=ketnoi();
	$sql="select tentl,danhmuc.path,idtl,username,DATE_FORMAT(ngayupload,'%d-%m-%Y') from tailieu inner join danhmuc on tailieu.iddm=danhmuc.iddm where tentl like '%$tttk%'";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$_chuoi="<div class='boc1'>";
		while($row=mysqli_fetch_array($kq))
		{
			$chuoi.= "<div class='motfiledanhmuc'><hr><a  style='font-size: 30px;' href='hienthi.php?idtl=$row[2]'><div class='anhdanhmuc'>
			<img title='$row[0]' src='$row[1]'></div><div id='ten'>$row[0]</a><br><p style='font-size: 18px;'>Người đăng: $row[3]<br>Ngày đăng: $row[4]</p></div>";
			$chuoi.="</div>";
		}
		$chuoi.="</div>";
		echo $chuoi;
	}
	else
	{
		echo "<div id='kocotailieu'>Tài liệu đang được cập nhật...</div>";
		echo "<style>
		.danhmuckhac{
			  margin-top: 0px;
		}
		.quangcao{
			 margin-top: 0px;
		}
		</style>";

}
	mysqli_close($conn);
	}
}
//

		// while($row=mysqli_fetch_array($kq))
		// {
			// $chuoi.= "<div class='motfiledanhmuc'><hr><a href='hienthi.php?idtl=$row[0]'>
			// <div class='anhdanhmuc'><img src='$row[2]'></div><div class='ngaydang'><div id='ten'>$row[1]</div></a><br>
			// <p>Ngày đăng:$row[3]<br>Người đăng: $row[4]</p><br></div></div>";
		// }

//
function tailieulienquan()
{
	echo "<p>TÀI LIỆU LIÊN QUAN</p><BR>";
	$idtl=$_GET['idtl'];
			$idtl = strip_tags($idtl);
		$idtl = addslashes($idtl);
	$conn=ketnoi();
	$sql="select iddm from tailieu where idtl='$idtl'";
	$kq=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($kq))
	{
		$iddm=$row[0];
		break;
	}
	$sql="select tailieu.idtl,tentl,danhmuc.path,AVG(rate) from (tailieu inner join danhmuc on tailieu.iddm=danhmuc.iddm) left join star on tailieu.idtl=star.idtl where danhmuc.iddm='$iddm' and tailieu.idtl!='$idtl' group by tailieu.idtl order by AVG(rate) desc limit 3";
	$kq=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($kq))
	{
		echo "<div class='motfilelienquan' title='$row[1]'><a href='hienthi.php?idtl=$row[0]'><img src='$row[2]'><p id='tenfilelienquan'>$row[1]</p></a></div><hr id='hrlienquan'><br>";
	}
	mysqli_close($conn);
}
//
//ham moi
function danhmuc()
{
	$iddm=$_GET['iddm'];
		$iddm = strip_tags($iddm);
		$iddm = addslashes($iddm);
	$conn=ketnoi();
	$sql="select * from danhmuc where iddm='$iddm'";
	$kq=mysqli_query($conn,$sql);
	while($danhmuc=mysqli_fetch_array($kq))
	{$tendm=$danhmuc[1];
	break;}
	echo "<div class='danhmuc'><img id='icondanhmuc' src='images/icon_btv.png'>Danh mục >> $tendm<br></div>";
	$sql="select idtl,tentl,danhmuc.path,DATE_FORMAT(ngayupload,'%d-%m-%Y'),username from tailieu inner join danhmuc on tailieu.iddm=danhmuc.iddm where tailieu.iddm='$iddm'";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)==0)
	{echo "<div id='kocotailieu'>Tài liệu đang được cập nhật...</div>";
	
echo "<style>
		.danhmuckhac{
			  margin-top: 0px;
		}
		.quangcao{
			 margin-top: 0px;
		}
		</style>";}
	else
	{
		$chuoi="<div class='boc1'>";
		while($row=mysqli_fetch_array($kq))
		{
			$chuoi.= "<div class='motfiledanhmuc'><hr><a href='hienthi.php?idtl=$row[0]'>
			<div class='anhdanhmuc'><img title='$row[1]' src='$row[2]'></div><div class='ngaydang'><div id='ten'>$row[1]</div></a><br>
			<p>Ngày đăng:$row[3]<br>Người đăng: $row[4]</p><br></div></div>";
		}
		$chuoi.="</div>";
		echo $chuoi;
	}
	
	mysqli_close($conn);
}

function thongkedanhmuc($sx)
{
	$conn=ketnoi();
	$sql="select danhmuc.iddm,tendm,count(tailieu.idtl) from danhmuc left join tailieu on danhmuc.iddm=tailieu.iddm group by tendm order by count(tailieu.idtl)".$sx;
	$kq=mysqli_query($conn,$sql);
	$chuoi="<table id='gtthongke'><tr><th>Danh mục</th><th>Số tài liệu</th></tr>";
	while($row=mysqli_fetch_array($kq))
	{
	$chuoi.="<tr><td class='td'><a class='aqt set' href='danhmuc.php?iddm=$row[0]'>$row[1]</a></td><td class='td'>$row[2]</td></tr>";}
	$chuoi.="</table>";
	mysqli_close($conn);
	echo $chuoi;
}

function thongkesoluotdownload($sx)
 {
	 $conn=ketnoi();
	 $sql="select idtl,tentl,tendm,username,tailieu.path,soluotdl,danhmuc.iddm,tailieu.path from danhmuc inner join tailieu on danhmuc.iddm=tailieu.iddm order by soluotdl ".$sx;
	 $kq=mysqli_query($conn,$sql);
	 $chuoi="<table id='gtthongke1'><tr><th>Tên tài liệu</th><th>Danh mục</th><th>Người đăng</th><th>File nguồn</th><th>Số lượt download</th></tr>";
	 while($row=mysqli_fetch_array($kq))
		{
			$tenfile=substr($row[4],8);
			$chuoi.="<tr><td class='td'><a class='aqt set' href='hienthi.php?idtl=$row[0]'>$row[1]</a></td><td class='td'>
			<a class='aqt set' href='danhmuc.php?iddm=$row[6]'>$row[2]</a></td><td class='td'>$row[3]</td><td class='td'>
			<a class='aqt set' href='download.php?idtl=$row[0]&path=$row[4]'>$tenfile</a></td><td class='td'>$row[5]</td></tr>";
		}
	 $chuoi.="</table>";
	 mysqli_close($conn);
	 echo $chuoi;
 }
 
 function thongkesoluotxem($sx)
 {
	$conn=ketnoi();
	 $sql="select idtl,tentl,tendm,username,tailieu.path,luotxemtl,danhmuc.iddm,tailieu.path from danhmuc inner join tailieu on danhmuc.iddm=tailieu.iddm order by luotxemtl ".$sx;
	 $kq=mysqli_query($conn,$sql);
	 $chuoi="<table id='gtthongke1'><tr><th>Tên tài liệu</th><th>Danh mục</th><th>Người đăng</th><th>File nguồn</th><th>Số lượt xem</th></tr>";
	 while($row=mysqli_fetch_array($kq))
	 {$tenfile=substr($row[4],8);
	 $chuoi.="<tr><td class='td'><a class='aqt set' href='hienthi.php?idtl=$row[0]'>$row[1]</a></td><td class='td'><a class='aqt set' href='danhmuc.php?iddm=$row[6]'>$row[2]</a>
	 </td><td class='td'>$row[3]</td><td class='td'><a class='aqt set' href='download.php?idtl=$row[0]&path=$row[4]'>$tenfile</a></td><td class='td'>$row[5]</td></tr>";}
	 $chuoi.="</table>";
	 mysqli_close($conn);
	 echo $chuoi;
 }
 
 function thongkemucdodanhgia($sx)
 {
	$conn=ketnoi();
	 $sql="select tailieu.idtl,tentl,tendm,tailieu.username,tailieu.path,avg(rate),danhmuc.iddm,tailieu.path from (danhmuc inner join tailieu on danhmuc.iddm=tailieu.iddm) left join star on tailieu.idtl=star.idtl group by tailieu.idtl order by avg(rate) ".$sx;
	 $kq=mysqli_query($conn,$sql);
	 $chuoi="<table id='gtthongke1'><tr><th>Tên tài liệu</th><th>Danh mục</th><th>Người đăng</th><th>File nguồn</th><th>Chất lượng</th></tr>";
	 while($row=mysqli_fetch_array($kq))
	 {$tenfile=substr($row[4],8);
	 $chuoi.="<tr><td class='td'><a class='aqt set'href='hienthi.php?idtl=$row[0]'>$row[1]</a></td><td class='td'><a class='aqt set' href='danhmuc.php?iddm=$row[6]'>$row[2]</a></td>
	 <td class='td'>$row[3]</td><td class='td'><a class='aqt set' href='download.php?idtl=$row[0]&path=$row[4]'>$tenfile</a></td><td class='td'>$row[5]</td></tr>";}
	 $chuoi.="</table>";
	 mysqli_close($conn);
	 echo $chuoi;
 }
 
 function xoatailieu($idtl)
 {
	$conn=ketnoi();
	$sql="delete from star where idtl='$idtl'";
	mysqli_query($conn,$sql);
	$sql="delete from tbl_comment where idtl='$idtl'";
	mysqli_query($conn,$sql);
	$sql="delete from tailieu where idtl='$idtl'";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
 }
 
 function xoadanhmuc($iddm)
 {
	$conn=ketnoi();
	$sql="select idtl from tailieu where iddm='$iddm'";
	$kq=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($kq))
	{
		xoatailieu($row[0]);
	}
	$sql="delete from danhmuc where iddm='$iddm'";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
 }
 
 function xoanguoidung($username)
 {
	$conn=ketnoi();
	$sql="select idtl from tailieu where username='$username'";
	$kq=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($kq))
	{
		xoatailieu($row[0]);
	}
	$sql="delete from star where username='$username'";
	mysqli_query($conn,$sql);
	$sql="delete from tbl_comment where username='$username'";
	mysqli_query($conn,$sql);
	$sql="delete from users where username='$username'";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
 }
 
 function capnhatnguoidung($username,$name,$email,$role)
 {
	$conn=ketnoi();
	$sql="update users set name='$name',email='$email',role='$role' where username='$username'";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
 }
 
 function capnhattailieu($idtl,$tentl,$iddm,$username)
 {
	$conn=ketnoi();
	$sql="update tailieu set tentl='$tentl',iddm='$iddm',username='$username' where idtl='$idtl'";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
 }
 
 function capnhatdanhmuc($iddm,$tendm,$path)
 {
	$conn=ketnoi();
	$sql="update danhmuc set tendm='$tendm',path='$path' where iddm='$iddm'";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
 }
 
 function themdanhmuc($tendm,$path)
 {
	$conn=ketnoi();
	$sql="insert into danhmuc(tendm,path) values ('$tendm','$path')";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
 }
 
 function quantritailieu()
 {
	$conn=ketnoi();
	 $sql="select idtl,tentl,tendm,username,tailieu.path,danhmuc.iddm from danhmuc inner join tailieu on danhmuc.iddm=tailieu.iddm";
	 $kq=mysqli_query($conn,$sql);
	 $chuoi="";
	 while($row=mysqli_fetch_array($kq))
	 {$tenfile=substr($row[4],8);
	 $chuoi.="<tr><td class='td'><a class='aqt' href='hienthi.php?idtl=$row[0]'>$row[1]</a></td><td class='td'>$row[2]</td><td class='td'>$row[3]</td>
	 <td class='td'><a class='aqt set' title='Click để download' href='download.php?idtl=$row[0]&path=$row[4]'>$tenfile</a></td><td class='td' style='width:130px;'>
	 <a class='aqt set' title='Cập Nhật Tài Liệu' href='capnhattailieu.php?idtl=$row[0]&tentl=$row[1]&iddm=$row[5]&path=$row[4]&username=$row[3]'>Cập nhật </a>|
	 <a class='aqt xoa' title='Xóa Tài Liệu' href='xoatailieu.php?idtl=$row[0]' onclick='return xoatl()'> Xóa</a></td></tr>";}
	 mysqli_close($conn);
	 echo $chuoi;
 }
 
 function selectdanhmuc1($iddm)
{
	$conn=ketnoi();
	$sql="select * from danhmuc";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$chuoi="";
		while($row=mysqli_fetch_array($kq))
		{
			if($row[0]==$iddm)
			{$chuoi.="<option value='$row[0]' selected >$row[1]</option>";}
			else
			{$chuoi.="<option value='$row[0]' >$row[1]</option>";}
		}
		echo $chuoi;
	}
	mysqli_close($conn);
}

function selectusername1($username)
{
	$conn=ketnoi();
	$sql="select * from users";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$chuoi="";
		while($row=mysqli_fetch_array($kq))
		{
			if($row[0]==$username)
			{$chuoi.="<option value='$row[0]' selected >$row[0]</option>";}
			else
			{$chuoi.="<option value='$row[0]' >$row[0]</option>";}
		}
		echo $chuoi;
	}
	mysqli_close($conn);
}

function quantriuser()
{
	$conn=ketnoi();
	 $sql="select * from users";
	 $kq=mysqli_query($conn,$sql);
	 $chuoi="";
	 while($row=mysqli_fetch_array($kq))
	 {$tenfile=substr($row[4],8);
	 $chuoi.="<tr><td class='td'>$row[0]</td><td class='td'>$row[2]</td><td class='td'>$row[3]</td><td class='td'>$row[4]</td>
	 <td class='td'><a class='aqt set' title='Cập Nhật User' href='capnhatuser.php?username=$row[0]&ten=$row[2]&email=$row[3]&role=$row[4]'>Cập nhật </a>|
	 <a class='aqt xoa' title='Xóa User' href='xoauser.php?username=$row[0]' onclick='return xoauser()'> Xóa</a></td></tr>";}
	 mysqli_close($conn);
	 echo $chuoi;
}

function quantridanhmuc()
{
	$conn=ketnoi();
	 $sql="select * from danhmuc";
	 $kq=mysqli_query($conn,$sql);
	 $chuoi="";
	 while($row=mysqli_fetch_array($kq))
	 {
	 $chuoi.="<tr><td class='td'>$row[1]</td><td class='td'><img src='$row[2]' style='width=50px;height:36px;'></td><td class='td'><a class='aqt xoa' title='xóa danh mục'href='xoadanhmuc.php?iddm=$row[0]' onclick='return xoadanhmuc()'> Xóa</a></td></tr>";}
	 mysqli_close($conn);
	 echo $chuoi;
}

function selectquyen($role)
{
	$conn=ketnoi();
	$sql="select DISTINCT role from users";
	$kq=mysqli_query($conn,$sql);
	if(mysqli_num_rows($kq)>0)
	{
		$chuoi="";
		while($row=mysqli_fetch_array($kq))
		{
			if($row[0]==$role)
			{$chuoi.="<option value='$row[0]' selected >$row[0]</option>";}
			else
			{$chuoi.="<option value='$row[0]' >$row[0]</option>";}
		}
		echo $chuoi;
	}
	mysqli_close($conn);
}

function danhmuckhac($iddm)
{
	$conn=ketnoi();
	$sql="select danhmuc.iddm,tendm,count(idtl) from danhmuc left join tailieu on danhmuc.iddm=tailieu.iddm where danhmuc.iddm!='$iddm' group by tendm";
	$kq=mysqli_query($conn,$sql);
	$chuoi="<div class='dmkhac'>CÁC DANH MỤC KHÁC</div><br>";
	while ($row=mysqli_fetch_array($kq))
	{
		$chuoi.="<div id='cacdanhmuc'><a href='danhmuc.php?iddm=$row[0]'>$row[1] ($row[2])</a><br></div>";
		
	}
	echo $chuoi;
	mysqli_close($conn);
}

function danhmuckhac1()
{
	$conn=ketnoi();
	$sql="select danhmuc.iddm,tendm,count(idtl) from danhmuc left join tailieu on danhmuc.iddm=tailieu.iddm group by tendm";
	$kq=mysqli_query($conn,$sql);
	$chuoi="<div class='dmkhac'>CÁC DANH MỤC</div><br>";
	while ($row=mysqli_fetch_array($kq))
	{
		$chuoi.="<div id='cacdanhmuc'><a href='danhmuc.php?iddm=$row[0]'>$row[1] ($row[2])</a><br></div>";
		
	}
	echo $chuoi;
	mysqli_close($conn);
}
?>