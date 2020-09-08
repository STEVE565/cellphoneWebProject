<style type="text/css">
*{margin:0px; padding:0px;}

		#Set_initial{
			text-align:center;
			font-size:50px;
			color:#FFFF00;
			<!-- padding-top:3%;-->
			font-family: Times New Roman;
			text-shadow: 0 0 0.2em #9B59B6   , 0 0 0.2em #9B59B6  ,0 0 0.1em #9B59B6  ;
		}
        #body {
                width: 100%;
                height: 90%;
				float: left;
				background-color:#2980B9;
				background-image:url('../../images/main/background_4.jpg'); 
				background-size: cover;
				
        }
		#Set_start{
			text-align:center;
			font-size:25px;
			color:#F9E79F ;
			<!-- padding-top:3%;-->
			font-family: Times New Roman;
			text-shadow: 0 0 0.2em #9B59B6   , 0 0 0.2em #9B59B6  ,0 0 0.1em #9B59B6  ;
		}
		#Set_body_process{
			text-align:left;
			font-size:30px;
			color:green;
			font-weight:bold;
		    font-family: Times New Roman;
			position:absolute; left:300px; top: 100px;
		}
		
</style>
<?php
	require_once('../../include/db_func.php');
	require_once('../../include/configure.php');
	$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);


 $Seqno = $_GET['Seqno'];
 
 //請注意，這邊因為 $userID 本身是 integer，所以可以不用加 ''
 $sql_getDataQuery = "SELECT * FROM Phone WHERE Seqno = $Seqno";

 //$result = mysqli_query($db_link, $sql_getDataQuery);
 $result = querydb($sql_getDataQuery, $db_conn);
 
 //$row_result = @mysqli_fetch_assoc($result);
 //$row_result = updatedb($result, $conn);
 foreach($result as $row_result){
	$Seqno = $row_result['Seqno'];   //抓出已知Seqno
	$Brand = $row_result["Brand"];
	$PhoneName = $row_result['PhoneName'];
	$Ram = $row_result['Ram'];
	$Rom = $row_result['Rom'];
	$Price = $row_result["Price"];
	$Screen = $row_result['Screen'];
	$OS = $row_result['OS'];
	$CPU = $row_result['CPU'];
	$Pixel = $row_result["Pixel"];
	$FrontQuality = $row_result['FrontQuality'];
	$BackQuality = $row_result['BackQuality'];
	$Battery = $row_result['Battery'];
	$Description = $row_result['Description'];
 }

 
?>
<?php
(isset($_POST['Brand']))?$select_check = $_POST['Brand']:$select_check = $Brand;  //輔助查詢下拉式保留(品牌)

?>
<?php
 if (isset($_POST["action"]) && $_POST["action"] == 'update') {

    $newBrand = $_POST['Brand'];
	$newPhoneName = $_POST['PhoneName'];
    $newRam = $_POST['Ram'];
    $newRom = $_POST['Rom'];
	$newPrice = $_POST['Price'];
	$newScreen = $_POST['Screen'];
	$newOS = $_POST['OS'];
    $newCPU = $_POST['CPU'];
    $newPixel = $_POST['Pixel'];
	$newFrontQuality = $_POST['FrontQuality'];
	$newBackQuality = $_POST['BackQuality'];
	$newBattery = $_POST['Battery'];
	$newDescription = $_POST['Description'];

	
	 
	 
     
	if(isset($newBrand)&&isset($newPhoneName)&&isset($newRam)&&isset($newRom)&&isset($newPrice)&&isset($newScreen)&&isset($newOS)&&isset($newCPU)&&isset($newPixel)&&isset($newFrontQuality)&&isset($newBackQuality)&&isset($newBattery)&&isset($newDescription)&& !empty($newBrand)&& !empty($newPhoneName)&& !empty($newRam)&& !empty($newRom)&& !empty($newPrice)&& !empty($newScreen)&& !empty($newOS)&& !empty($newCPU)&& !empty($newPixel)&& !empty($newFrontQuality)&& !empty($newBackQuality)&& !empty($newBattery)&& !empty($newDescription)){	 
		$sql_query = "UPDATE Phone SET Brand = '$newBrand', PhoneName = '$newPhoneName', Ram = '$newRam', Rom = '$newRom' , Price = '$newPrice', Screen = '$newScreen', OS = '$newOS', CPU = '$newCPU', Pixel = '$newPixel', FrontQuality = '$newFrontQuality', BackQuality = '$newBackQuality', Battery = '$newBattery', Description = '$newDescription' WHERE Seqno = $Seqno";
		
		$resulttt = querydb($sql_query, $db_conn);
		header('Location: phone_index.php');
		
	}
	else{
		if(empty($newBrand)){
			 echo "<script type='text/javascript'>alert('品牌不可空白!!');</script>";
		}
		if(empty($newPhoneName)){
			 echo "<script type='text/javascript'>alert('手機名稱不可空白!!');</script>";
		}
		if(empty($newRam)){
			 echo "<script type='text/javascript'>alert('快取記憶體不可空白!!');</script>";
		}
		if(empty($newRom)){
			 echo "<script type='text/javascript'>alert('記憶體不可空白!!');</script>";
		}
		if(empty($newPrice)){
			 echo "<script type='text/javascript'>alert('價格不可空白!!');</script>";
		}
		if(empty($newScreen)){
			 echo "<script type='text/javascript'>alert('螢幕不可空白!!');</script>";
		}
		if(empty($newOS)){
			 echo "<script type='text/javascript'>alert('OS不可空白!!');</script>";
		}
		if(empty($newCPU)){
			 echo "<script type='text/javascript'>alert('CPU不可空白!!');</script>";
		}
		if(empty($newPixel)){
			 echo "<script type='text/javascript'>alert('畫質不可空白!!');</script>";
		}
		if(empty($newFrontQuality)){
			 echo "<script type='text/javascript'>alert('前鏡頭不可空白!!');</script>";
		}
		if(empty($newBackQuality)){
			 echo "<script type='text/javascript'>alert('後鏡頭不可空白!!');</script>";
		}
		if(empty($newBattery)){
			 echo "<script type='text/javascript'>alert('電池不可空白!!');</script>";
		}
		if(empty($newDescription)){
			 echo "<script type='text/javascript'>alert('敘述不可空白!!');</script>";
		}
	}
     
 }
 ?>
 <html>

 <head>
     <meta charset="UTF-8" />
     <title>懂你的手機購物網站--修改手機資料</title>
 </head>
 <body>
 
 <div id="Body">
 			<div id="Set_initial" > 
			歡迎使用懂你的手機購物網站--修改手機資料
			</div>
	 <div class="", id="Set_body_process">
	 <form action="" method="post" name="formAdd" id="formAdd">
<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-->
	請輸入品牌：
	 <select name="Brand" style= "width:200px;height:40px; font-size:20px">
				<!--<option value="0" <?php if($select_check == 0) echo 'selected';?>>Select one</option>-->
				<option value="Apple" <?php if($select_check == "Apple") echo 'selected';?> style="font-size:20px">  Apple </option>
				<option value="ASUS" <?php if($select_check == "ASUS") echo 'selected';?> style="font-size:20px"> ASUS  </option>
				<option value="SAMSUNG" <?php if($select_check == "SAMSUNG") echo 'selected';?> style="font-size:20px">  SAMSUNG </option>
				<option value="SONY" <?php if($select_check == "SONY") echo 'selected';?> style="font-size:20px">  SONY </option>
	</select>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	請輸入手機名稱：<input type="text" name="PhoneName" id="PhoneName" value="<?php echo $PhoneName; ?>" style="width:200px;height:50px;font-size:20px;"><br/>
	請輸入快取記憶體：<input type="text" name="Ram" id="Ram" value="<?php echo $Ram; ?>" style="width:200px;height:50px;font-size:20px;">&emsp;&emsp;&emsp;&emsp;
	請輸入記憶體：<input type="text" name="Rom" id="Rom" value="<?php echo $Rom; ?>" style="width:200px;height:50px;font-size:20px;"><br/>
	請輸入價格：<input type="text" name="Price" id="Price" value="<?php echo $Price; ?>" style="width:200px;height:50px;font-size:20px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	請輸入螢幕：<input type="text" name="Screen" id="Screen" value="<?php echo $Screen; ?>" style="width:200px;height:50px;font-size:20px;"><br/>
	請輸入OS：<input type="text" name="OS" id="OS" value="<?php echo $OS; ?>" style="width:200px;height:50px;font-size:20px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	請輸入CPU：<input type="text" name="CPU" id="CPU" value="<?php echo $CPU; ?>" style="width:200px;height:50px;font-size:20px;"><br/>
	請輸入畫質：<input type="text" name="Pixel" id="Pixel" value="<?php echo $Pixel; ?>" style="width:200px;height:50px;font-size:20px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	請輸入前鏡頭：<input type="text" name="FrontQuality" id="FrontQuality" value="<?php echo $FrontQuality; ?>" style="width:200px;height:50px;font-size:20px;"><br/>
	請輸入後鏡頭：<input type="text" name="BackQuality" id="BackQuality" value="<?php echo $BackQuality; ?>" style="width:200px;height:50px;font-size:20px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	請輸入敘述：<input type="text" name="Description" id="Description" value="<?php echo $Description; ?>" style="width:200px;height:50px;font-size:20px;"><br/>
	請輸入電池：<input type="text" name="Battery" id="Battery" value="<?php echo $Battery; ?>" style="width:200px;height:50px;font-size:20px;"><br/>		 
		 
		 
		 
		 <input type="hidden" name="action" value="update">
		 <input type="submit" name="button" value="修改資料" style="width:120px;height:50px;font-size:20px;color:blue; position:relative; left:100px; top: 50px;">
	 </form>
	  </div>
 </div>
 </body>
 </html>