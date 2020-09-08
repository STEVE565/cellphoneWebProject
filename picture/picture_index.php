<?php
	session_start();
	/*$w_name = $_SESSION['worker_name'];
	$w_password =  $_SESSION['worker_password'];
	if(($w_name==NULL)||($w_password==NULL)){
		echo "<script>window.location.href='../login.php';</script>";
	}*/
?>
<style type="text/css">
*{margin:0px; padding:0px;}
        #Header {
				 background-color:#52BE80 ;
			     background-image:url('../../images/main/background_1.jfif'); 
				 background-size: cover;
				 width: 100%, height: 10px;
        }
        #body {
                width: 100%;
                height: 75%;
				float: left;
				background-color:#2980B9;
				background-image:url('../../images/main/background_5.jpeg'); 
				background-size: cover;
				
        }
        #Footer {
                width:  100%;
                height: 15%;
				background-color:#7DCEA0;
				background-image:url('../../images/main/background_6.jpeg');  
				background-size: cover;
		}
		#Set_Header{
			text-align:center;
			font-size:25px;
			color:#F9E79F ;
			<!-- padding-top:3%;-->
			font-family: Times New Roman;
			text-shadow: 0 0 0.2em #9B59B6   , 0 0 0.2em #9B59B6  ,0 0 0.1em #9B59B6  ;
		}
		#Set_body_initial{
			font-size:20px;
			color:brown;
		    font-family: Times New Roman;
		}
		#body_process{
			border:2px gold solid; 
			padding:20px; 
			max-height:400px;
			max-width:1460px;  			
			overflow:scroll;
			margin-left: 20px;
		}
		#Set_body_process2{
			text-align:left;
			font-size:30px;
			color:brown;
			font-weight:bold;
		    font-family: Times New Roman;
			position:absolute; left:600px; top: 630px;
		}
		#Set_body_process2-1{
			text-align:left;
			font-size:30px;
			color:brown;
			font-weight:bold;
		    font-family: Times New Roman;
			position:absolute; left:600px; top: 570px;
		}
		#Set_body_process4{
			text-align:center;
			font-size:30px;
		    font-family: 標楷體;
			position:absolute; left:1180px; top: 570px;
		}
		#Set_footer_initial{
			font-size:40px;
			color:purple;
		    font-family: Times New Roman;
		    position:absolute; left:20px; top: 600px;
		}
</style>
<?php
    //1. 引入程式檔
    //include("userconnMySQL.php");
    /*require_once('db_func.php');
	require_once('configure.php');
	$conn=connect2db($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
    //2. 加入sql 語法，白話文：從 members 的資料表中選擇所有欄位，並依照 cID 遞增排序
    $sql_query = "SELECT * FROM user ORDER BY id ASC";

    //3. 使用 mysqli_query() 函式可以在 MySQL 中執行 sql 指令後會回傳一個資源識別碼，否則回傳 False。
    //$result = mysqli_query($db_link,$sql_query);
    $result = querydb($sql_query, $conn);
    //4. 使用 mysqli_num_rows() 函式來取得資料筆數
    $total_records = mysqli_num_rows($result);*/
?>

<?php
    //include("../include/userconnMySQL.php");
	require_once('../../include/db_func.php');
	require_once('../../include/configure.php');
	//$conn=connect2db($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $sql_query = "SELECT * FROM Picture ORDER BY cid ASC";
    //$result = mysqli_query($db_link,$sql_query);
	$result = querydb($sql_query, $db_conn);
	$counnt=0;
	foreach($result as $know){
		/*$array_keep[$counnt]=$know["user_id"];
	
		$array_credits[$counnt]=$know["credits"];*/
		
		$counnt++;
	}
    //$total_records = mysqli_num_rows($result);
	
	/*$sql_credits = "SELECT * FROM user_credits"; //抓所有點數
	$query_credits = querydb($sql_credits, $conn);
	$coun=0; $counnt=0; $coco=0; 
	//$array_credits[0]; $array_keep[0]; $array_use[0]; 改
	foreach($query_credits as $know){
		$array_keep[$counnt]=$know["user_id"];
		//echo "userid:".$array_keep[$counnt];
		$array_credits[$counnt]=$know["credits"];
		//echo "的點數為:".$array_credits[$counnt]."</br>";
		$counnt++;
	}*/
	//echo "總共使用者資料數量".$counnt."</br>";
	
	
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>懂你的手機購物網站--手機圖片管理</title>
</head>
<body>
        <div id="Header" >
			<div id="Set_Header" > 
			歡迎使用懂你的手機購物網站--後台管理
			</div>
<div id="Body">
	<div id="Set_body_initial">
	<h1 align = "center">手機圖片總表</h1>
	<p align= "center">目前資料筆數：<?php echo $counnt;?></p>
	</div>

	<div id="body_process">
		<table style= "border=3 yellow groove;"align = "right" width="1450" border="5">
			<tr>
			<th width="200"> <div align="center"><font color="purple" size="5px">手機名稱 </font></div></th>
			<th width="100"> <div align="center"><font color="purple" size="5px">記憶體</font></div></th>
			<th width="150"> <div align="center"><font color="purple" size="5px">顏色</font></div></th>
			<th width="150"> <div align="center"><font color="purple" size="5px">照片類型</font></div></th>
			<th width="150"> <div align="center"><font color="purple" size="5px">照片</font></div></th>
			</tr>
			
	<?php

	
	foreach($result as $row_result){
		echo "<tr>";
		echo "<td><font color='green' size='5px'>".$row_result['PhoneName']."</td>";
		echo "<td><font color='green' size='5px'>".$row_result['Rom']."</td>";
		echo "<td><font color='green' size='5px'>".$row_result['color']."</td>";
		echo "<td><font color='green' size='5px'>".$row_result['imagetype']."</td>";
		/*echo "<td><font color='green' size='5px'>".$row_result['photo']."</td>";*/
		
		echo "<td><div align='center'><font color='green' size='5px'><a href='picture_upload.php?cid=".$row_result['cid']."'>上傳</a>"."</br>";
		echo "<font color='green' size='5px'><a href='picture_delete.php?cid=".$row_result['cid']."'>刪除</a></td>";
		echo "</tr>";
		
		
	}
	?>
	</table>
	</div>
	 
	  <div id="Set_body_process2">
		<form method="POST" action="">
			&emsp;進行登出:
			<input type="submit" name="log_out" value="登出" style="width:120px;height:50px;font-size:20px;color:red;border:2px #9999FF dashed;background-color:yellow;" >
		</form>
	
		<?php 
			if(isset($_POST['log_out'])){
				//header("refresh:0;url=../login.html");
			   /*$_SESSION['worker_name']= NULL;    //把帳號清空，禁止未登入跳轉
			   $_SESSION['worker_passowrd']= NULL;*/
			   echo "<script>window.location.href='../login.php';</script>";
			}
		?>
	 </div> 
	  <div id="Set_body_process2-1">
		回手機資料管理: <input type="button" value="返回" style="width:100px;height:50px;font-size:20px;color:blue;" onclick=window.location.href='../worker/index.php'>
	 </div> 
	</div>

	<div class="", id="Set_body_process4">  
	 <table style="border:8px #FFD382 groove;" width="300" height="150" border="5" >
		<tr>
				<td><font color="blue"  size="5">工作者:&emsp;
				</br>&emsp;&emsp;&emsp;&emsp;&emsp;歡迎光臨！!</font></td>
		</tr>

	</table>
	</div>
</div>
<div style="clear:both;"></div>
<div id="footer">
	<div id="Set_footer_initial">
	<!--&emsp;手機資料管理頁面: <input type="button" value="進入" style="width:120px;height:50px;font-size:20px;color:blue;" onclick=window.location.href='../phone/phone_index.php'> -->
	回使用者管理: <input type="button" value="返回" style="width:100px;height:50px;font-size:20px;color:blue;" onclick=window.location.href='../worker/index.php'>
	</div>
</div>





</body>
</html>