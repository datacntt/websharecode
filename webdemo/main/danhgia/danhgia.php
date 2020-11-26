<!DOCTYPE html5>
<html>
<head>
<link type="text/css" rel="stylesheet" href="danhgia/stylerate.css">
 <script type="text/javascript" src="danhgia/jquery.min.js"></script>
</head>

<body>
<?php  
	include('config.php');
    $post_id = $_GET['idtl'];; // yor page ID or Article ID
	$username=$_SESSION['username'];
?>

	<div class="rate">
		<div id="1" class="btn-1 rate-btn" onclick="camon(id)"></div>
        <div id="2" class="btn-2 rate-btn" onclick="camon(id)"></div>
        <div id="3" class="btn-3 rate-btn" onclick="camon(id)"></div>
        <div id="4" class="btn-4 rate-btn" onclick="camon(id)"></div>
        <div id="5" class="btn-5 rate-btn" onclick="camon(id)"></div>
	</div>
	<div ></div>
<br>
    <div class="box-result">
    	<?php
		$conn=ketnoi();
		$sql="select * from star";
        	$query = mysqli_query($conn,$sql); 
            	while($data = mysqli_fetch_assoc($query)){
                    $rate_db[] = $data;
                    $sum_rates[] = $data['rate'];
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
        ?>
    
        <h6 style="margin:-20px 0px;width:355px ;font-size:16px; text-align:center;visibility:hidden; padding-left: 212px;margin-left: -33px;" id='sosao'></h6>
    </div>

<script>
function camon(a)
{
	// alert("Cảm ơn bạn đã dánh giá tài liệu này");
	// document.getElementById('camon').style.visibility='visible';
	 document.getElementById('sosao').style.visibility='visible';
	 a="Bạn đã đánh giá "+a+" sao cho tài liệu này";
	 document.getElementById('sosao').innerHTML=a;
}
$(function(){ 
   $('.rate-btn').hover(function(){
   $('.rate-btn').removeClass('rate-btn-hover');
      var therate = $(this).attr('id');
      for (var i = therate; i >= 0; i--) {
   $('.btn-'+i).addClass('rate-btn-hover');
       };
     });
                           
   $('.rate-btn').click(function(){    
      var therate = $(this).attr('id');
      var dataRate = 'act=rate&post_id=<?php echo $post_id; ?>&rate='+therate+'&username=<?php echo $username;?>'; //
   $('.rate-btn').removeClass('rate-btn-active');
      for (var i = therate; i >= 0; i--) {
   $('.btn-'+i).addClass('rate-btn-active');
      };
   $.ajax({
      type : "POST",
      url : "danhgia/ajax.php",
      data: dataRate,
      success:function(){}
    });
  });
});
</script>
</body>
</html>