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
//先檢查請求來源是否是我們上面創建的 form
	if (isset($_POST["action"])&&($_POST["action"] == "add")) {

		//引入檔，負責連結資料庫
		//include("userconnMySQL.php");  old way to connect the database
		require_once('../../include/db_func.php');
		require_once('../../include/configure.php');
		$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
		//取得請求過來的資料
		$Brand = $_POST["Brand"];
		$PhoneName = $_POST['PhoneName'];
		$Ram = $_POST['Ram'];
		$Rom = $_POST['Rom'];
		$Price = $_POST["Price"];
		$Screen = $_POST['Screen'];
		$OS = $_POST['OS'];
		$CPU = $_POST['CPU'];
		$Pixel = $_POST["Pixel"];
		$FrontQuality = $_POST['FrontQuality'];
		$BackQuality = $_POST['BackQuality'];
		$Battery = $_POST['Battery'];
		$Description = $_POST['Description'];


		
		
		
	if(isset($Brand)&&isset($PhoneName)&&isset($Ram)&&isset($Rom)&&isset($Price)&&isset($Screen)&&isset($OS)&&isset($CPU)&&isset($Pixel)&&isset($FrontQuality)&&isset($BackQuality)&&isset($Description)&&isset($Battery)&&isset($Ram)&& !empty($Brand)&& !empty($PhoneName)&& !empty($Ram)&& !empty($Rom)&& !empty($Price)&& !empty($Screen)&& !empty($OS)&& !empty($CPU)&& !empty($Pixel)&& !empty($FrontQuality)&& !empty($BackQuality)&& !empty($Description)&& !empty($Battery)){
	
		
			
			//資料表查訪指令，請注意 "" , '' 的位置
			//INSERT INTO 就是新建一筆資料進哪個表的哪個欄位
			$sql_query = "INSERT INTO Phone (Seqno,Brand, PhoneName, Ram, Rom,Price, Screen, OS, CPU,Pixel, FrontQuality, BackQuality, Description, Battery) VALUES (null,'$Brand', '$PhoneName','$Ram','$Rom','$Price', '$Screen','$OS','$CPU','$Pixel', '$FrontQuality','$BackQuality','$Description','$Battery')";
				 
			//對資料庫執行查訪的動作
			//mysqli_query($db_link,$sql_query);  old way to connect the database
			$query = querydb($sql_query, $db_conn);
			
			//echo $sql_query;
			
			
			//導航回首頁
			header("Location: phone_index.php");
		
	} 
	else{
		if(empty($Brand)){
			 echo "<script type='text/javascript'>alert('品牌不可空白!!');</script>";
		}
		if(empty($PhoneName)){
			 echo "<script type='text/javascript'>alert('手機名稱不可空白!!');</script>";
		}
		if(empty($Ram)){
			 echo "<script type='text/javascript'>alert('快取記憶體不可空白!!');</script>";
		}
		if(empty($Rom)){
			 echo "<script type='text/javascript'>alert('記憶體不可空白!!');</script>";
		}
		if(empty($Price)){
			 echo "<script type='text/javascript'>alert('價格不可空白!!');</script>";
		}
		if(empty($Screen)){
			 echo "<script type='text/javascript'>alert('螢幕不可空白!!');</script>";
		}
		if(empty($OS)){
			 echo "<script type='text/javascript'>alert('OS不可空白!!');</script>";
		}
		if(empty($CPU)){
			 echo "<script type='text/javascript'>alert('CPU不可空白!!');</script>";
		}
		if(empty($Pixel)){
			 echo "<script type='text/javascript'>alert('畫質不可空白!!');</script>";
		}
		if(empty($FrontQuality)){
			 echo "<script type='text/javascript'>alert('前鏡頭不可空白!!');</script>";
		}
		if(empty($BackQuality)){
			 echo "<script type='text/javascript'>alert('後鏡頭不可空白!!');</script>";
		}
		if(empty($Description)){
			 echo "<script type='text/javascript'>alert('敘述不可空白!!');</script>";
		}
		if(empty($Battery)){
			 echo "<script type='text/javascript'>alert('電池不可空白!!');</script>";
		}
		

		  //header("refresh:0;url=usercreate.php");
	}
}
?>
<?php
(isset($_POST['Brand']))?$select_check = $_POST['Brand']:$select_check = 0;  //輔助查詢下拉式保留(品牌)

?>
<html>

<head>
    <meta charset="UTF-8" />
    <title>懂你的手機購物網站--新增手機資料</title>
</head>
<body>


 <div id="Body">
         
			<div id="Set_initial" > 
			歡迎使用懂你的手機購物網站--新增手機資料
			</div>
		
     <div class="", id="Set_body_process">
     <form action="" method="post" name="formAdd" id="formAdd">
<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-->
	請輸入品牌：
	 <select name="Brand" style= "width:200px;height:40px; font-size:20px">
				<option value="0" <?php if($select_check == 0) echo 'selected';?>>Select one</option>
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
	
	
	
	
	<input type="hidden" name="action" value="add">
	<input type="submit" name="button" value="新增資料" style="width:120px;height:50px;font-size:20px;color:blue; position:relative; left:90px; top: 50px;">
	<!--<input type="reset" name="button2" value="重新填寫" style="width:120px;height:50px;font-size:20px;color:blue;position:relative; left:-160px; top: 50px;">-->
	</form>
	</div>
</div>
</body>
</html>

