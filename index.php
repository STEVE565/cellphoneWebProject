<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
	<!-- Place somewhere in the <head> of your document -->
	<link rel="stylesheet" href="flexSlider/flexslider.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="flexSlider/jquery.flexslider.js"></script>
	<!-- Place in the <head>, after the three links -->
	<script type="text/javascript" charset="utf-8">
	  $(window).load(function() {
		$('.flexslider').flexslider();
	  });
	</script>
	<title>finalproject</title>
</head>
<style type="flexSlider/flexslider.css"></style>
<style type="text/css">
#container{
    width:1440px;
    margin:0 auto;
}
#headbox{
    width:1440px;
    height:60px;
	background-color:#ACD6FF;
    margin:0 auto;
}
#footer{
    width:1440px;
    height:60px;
	background-color:#ACD6FF;
}
</style>
<?php //require_once("csscontainer.php"); ?>
<script>
$(function() {
    $(".flexslider").flexslider({
        slideshowSpeed: 5000, //展示时间间隔ms
        animationSpeed: 500, //滚动时间ms
        touch: true //是否支持触屏滑动
    });
}); 
<body onload="setFocus()">
</script>
<div id="container" style="text-align:center;">
<div id="headbox">
	<div style="margin-top:10px;">
		<h3>懂你的手機購物網站</h3>
	</div>
</div>
<div class="flexslider" style="text-align:center;width:350px; margin-left:550px;">
	最新手機<br>
    <ul class="slides">
        <li><img src="photo/newphone/galaxys20-Gray.jpg" alt="" width="400" height="250"></li>
        <li><img src="photo/newphone/iphoneSEWhite.jpg" alt="" width="400" height="250"></li>
        <li><img src="photo/newphone/xperia1II.jpg" alt="" width="400" height="250"></li>
		<li><img src="photo/newphone/zenfone6.jpg" alt="" width="400" height="250"></li>
    </ul>
</div>
<div style="text-align:center;margin-top:30px;">
		<table width="400" align="center">
		<tr>
			<td bgcolor="#FFCC33" height="35">
				<a href="phonecheck.php?brand=ASUS&nowPhoneName=ROG Phone II">
				<img src="photo/homepagephoto/rogphone2intr.PNG" width="710px" height="700px"></a>
			<td bgcolor="#FFFFCC" height="35">
				<a href="phonecheck.php?brand=Apple&nowPhoneName=iPhone 11 Pro Max">
				<img src="photo/homepagephoto/iphone11pro.gif" width="710px" height="700px"></a>			
			</td>
		</tr>
		<tr>
			<td bgcolor="#FFCC33" height="35">
				<a href="phonecheck.php?brand=SAMSUNG&nowPhoneName=Galaxy S20 Ultra">
				<img src="photo/homepagephoto/s20.png" width="710px" height="700px"></a>
			</td>
			<td bgcolor="#FFCC33" height="35">
				<a href="phonecheck.php?brand=SONY&nowPhoneName=xperia1 II">
				<img src="photo/homepagephoto/sony.png" width="710px" height="700px"></a>
			</td>
		</tr>
		</table>
</div>
<div id="footer">Design by TTU-CSE-I4010</div>
</div>
</body>
</html>