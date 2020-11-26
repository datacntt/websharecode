<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
 <meta charset="utf-8" />
    <title>Kho tài liệu trực tuyến-www.tailieutructuyen.vn</title>
    <meta name="author" content="Trần Đông" />
    <meta name="description" content="Học làm web đơn giản" />
    <meta name="keyword" content="Hoc html, huong dan html, html co ban" />
		<link href="images/icon.png" rel="shortcut icon">
	<link type="text/css" href="style.css" rel="stylesheet">
	    <script src="js\jssor.slider.min.js" type="text/javascript"></script>
		
</head>
<body>
<div id="lienhe">
 <img src="images\icon_phone_header.png" />
 <p>Hotline: 1234567890</p>
 <img src="images\icon_fb.png" />
 <img src="images\icon_skype.png" />
 <img src="images\icon_gg.png" />
</div>
<div class="header"> 
<div id="logo">
<a href='index.php'><img src="images\logo.png" /></a>
</div>
<div id="banner">
<img src='images/Capture.png' style='margin-top:-3px;'>
</div>
</div>
<div id="menu">
<ul class="aaa">
<li><a href="index.php">Trang chủ</a></li>
<li><a href="#">Danh Mục</a>
<ul class="sub">
<?php
	include "csdl.php";
	menudanhmuc();
?>
</ul>
</li>
<li><a href="gioithieu.php">Giới Thiệu</a></li>
<li><a href="upload.php" onclick="<?php if($_SESSION['username']=="")
{echo "alert('Bạn chưa đăng nhập hệ thống')";} ?>">Upload</a></li>
<li><a href="thongke.php">Thống kê</a></li>
<?php
if($_SESSION['username']=="")
{echo "<li><a href='http://localhost/webdemo/login/login.php'>Đăng nhập</a></li>";}
else
{
if($_SESSION['role']==1)
{echo "<li><a href='quantri.php'>Quản trị</a></li><li><a href='logout.php' onclick=' return logout()'>Đăng xuất</a></li>";}
else
{echo "<li><a href='logout.php' onclick=' return logout()'>Đăng xuất</a></li>";}
}
?>
</ul>
<script>
function logout()
{return confirm('Bạn có muốn đăng xuất không?')}
</script>
<div class="search-form">

        <form id="searchform" method="get" action="timkiem.php">
  <div class="searchform-wrapper"><input type="text" value="" name="s" id="s" placeholder="Tìm kiếm..." />
  <input type="submit" class="send" name="searchsubmit"  /></div>
</form>      
</div>
<?php 
if($_SESSION['username']!="")
{echo "<div class='xinchao'>Xin chào,".$_SESSION['username']."!</div>";} ?>
</div>



<div class="slider">
<div class="leftqc">
<img src="images\bannerfpt.jpg" />
</div>
<script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:500,$Delay:30,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2049,$Easing:$Jease$.$OutQuad},
              {$Duration:500,$Delay:80,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Easing:$Jease$.$OutQuad},
              {$Duration:1000,x:-0.2,$Delay:40,$Cols:12,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5}},
              {$Duration:2000,y:-1,$Delay:60,$Cols:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:$Jease$.$OutJump,$Round:{$Top:1.5}},
              {$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <style>
        /* jssor slider loading skin spin css */
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        .jssorb053 .i {position:absolute;cursor:pointer;}
        .jssorb053 .i .b {fill:#fff;fill-opacity:0.5;}
        .jssorb053 .i:hover .b {fill-opacity:.7;}
        .jssorb053 .iav .b {fill-opacity: 1;}
        .jssorb053 .i.idn {opacity:.3;}

        .jssora093 {display:block;position:absolute;cursor:pointer;}
        .jssora093 .c {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
        .jssora093 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
        .jssora093:hover {opacity:.8;}
        .jssora093.jssora093dn {opacity:.6;}
        .jssora093.jssora093ds {opacity:.3;pointer-events:none;}
    </style>
	<!-- style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:480px;overflow:hidden;visibility:hidden;z-index:20;" -->
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:520px;overflow:hidden;visibility:hidden;z-index:20;float:left;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left: 0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/loading/static-svg/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:520px;overflow:hidden;">
           <div>
                <img data-u="image" src="images/slider1.jpg" />
            </div>
            <div>
                <img data-u="image" src="images\slider2.jpg" />
            </div>
            <div>
                <img data-u="image" src="images\slider3.jpg" />
            </div>
            <div>
                <img data-u="image" src="images\slider4.jpg" />
            </div>
            <div>
                <img data-u="image" src="images\tailieuonline.jpg" />
            </div>
            <div>
                <img data-u="image" src="images\tai-lieu-online.jpg" />
            </div>
			<div>
                <img data-u="image" src="images\download-banner.jpg" />
            </div>

        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <path class="b" d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"></path>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
            </svg>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>
	<br>
	<div class="rightqc">
<img src="images\4dduOT57856_r_2.gif" />
</div>
	</div>
<br>
<br>
<br>
<br>
	<div class="main"  style='background: url(anh/cc.png) no-repeat;'>

	<table id='formthongke'>
		<form name="thongke" method="post">
		<tr><td>
		Thống kê theo: 
		</td>
		<td style="width:300px;">
		<select name='mucthongke' class='select'>
			<option value="1" >Danh mục</option>
			<option value="2">Số lượt download</option>
			<option value="3">Số lượt xem</option>
			<option value="4">Mức độ đánh giá</option>
			</td>
		</select> 
		<tr><td>
		Sắp xếp theo:
		</td>
		<td>
		<select name='sapxep' class='select'>
			<option value="asc">Tăng dần</option>
			<option value="desc">Giảm dần</option>
		</select><br>
		</td>
		</tr>
		<tr><td colspan=2>
		<input type="submit" name='btnthongke' value='Thống kê' style='background-color:#3889ec; margin-left: 16px; 
		margin-top: 20px; height: 29px; width: 81px; cursor: pointer;  border: 2px solid #8eb2de;'>
		</td>
		</tr>
		</form>
		</table>
		<?php 
	if(isset($_POST['btnthongke']))
	{
		$sx=$_POST['sapxep'];
		if($_POST['mucthongke']=='1')
		{thongkedanhmuc($sx);}
		if($_POST['mucthongke']=='2')
		{thongkesoluotdownload($sx);}
		if($_POST['mucthongke']=='3')
		{thongkesoluotxem($sx);}
		if($_POST['mucthongke']=='4')
		{thongkemucdodanhgia($sx);}
	}
?>
	</div>
	<br>
	<div class="footer">
	<div class="leftft">
	<h2 style="color:yellow;">NHÓM XÂY DỰNG WEBSITE:</h2>
	<hr style='width: 330px;'>
	<br>
	<h3>Hồ Mạnh Cường</h3>
	<h3>Trần Văn Đông</h3>
	<h3>Nguyễn Vũ Công Quyền</h3>
	</div>
	<div class="rightft"> 
		<h3>Địa chỉ: Thị Trấn Hồ, huyện Thuận Thành, tỉnh Bắc Ninh</h3>
	<h3>Số ĐT:1234567890</h3>
	<h3>Email:b1d5t36@gmail.com</h3>
	</div>
	</div>
</body>

</html>