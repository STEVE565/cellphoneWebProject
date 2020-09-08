<?php
	session_start();			// 
    /*$_SESSION['user_name'] = $user_name;
	$_SESSION['user_passowrd'] = $user_passowrd ;
    */
?>
<?php
header("Content-Type: text/html; charset=utf8");

require_once('../include/db_func.php');     //連接函式庫
require_once('../include/configure.php');   //連接資料庫
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
$u_name = $_SESSION['user_name'];
$u_password =  $_SESSION['user_password'];
if(($u_name==NULL)||($u_password==NULL)){
	echo "<script>window.location.href='login.php';</script>";
}
//刪除商品
if(isset($_POST['delete']) ){
	$sqlcmd = "SELECT * FROM phone_user WHERE user_name='$u_name'";
	$rs = querydb($sqlcmd, $db_conn);
	if (count($rs)>0) {
			$buyUserID = $rs[0]['id'];
	}
	$cartnumber = $_POST['cartnumber'];
	$sqlcmd = "UPDATE shoppingcart SET valid='0' WHERE cartno='$cartnumber'";
	$result = updatedb($sqlcmd, $db_conn);
}
?>
<style type="text/css">

*{margin:0px; padding:0px;}
        #Header {
				 background-color:#52BE80 ;
			     background-image:url('../images/register/background_1.jfif');
				 background-size: cover;
				 width: 100%, height: 10%;
        }
        #body {
                width: 100%;
                height: 90%;
				float: left;
				color:yellow;
				background-color:#2980B9;
				background-image:url('../images/main/background_8.jpg'); 
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
		#Set_Body{
	
			font-size:25px;
			color:#F9E79F ;
			font-family: Times New Roman;
		}
		#Set_body_topic{
			text-align:left;
			font-size:30px;
			color:orange;
		    font-family: 標楷體;
			position:absolute; left:20px; top: 40px;
		}
		#Set_body_process{
			text-align:center;
			font-size:30px;
		    font-family: 標楷體;
			position:absolute; left:1210px; top: 30px;
		}
</style>

<!DOCTYPE HTML>
<html><!-- -->
<head>
        <title>懂你的手機購物網站--使用者頁面</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
</head>
<body>  
	<form method="POST" action="">
	<div id="Header" >
		<div id="Set_Header" > 
		歡迎使用懂你的手機購物網站--使用者
		</div>
	</div>
	<div id="Body">
		<div style="margin-top:100px;margin-left:300px;">
			<table border="1" cellpadding="5" style="text-align:center;font-size:20px;">
				<tr style="margin-top:2px;margin-left:2px;margin-right:2px;margin-buttom:2px;">
					<?php echo '會員 : '.$u_name; ?>-當前購物車內容
				</tr>
				<tr>
					<td>單子編號</td>
					<td>手機名字</td>
					<td>手機顏色</td>
					<td>手機容量</td>
					<td>手機價錢</td>
					<td>刪除商品</td>
				</tr>
				<?php
					$buyUserName = $_SESSION['user_name'];
					$sqlcmd = "SELECT * FROM phone_user WHERE user_name='$buyUserName'";
					$rs = querydb($sqlcmd, $db_conn);
					if (count($rs)>0) {
							$buyUserID = $rs[0]['id'];
					}
					$sqlcmd = "SELECT * FROM shoppingcart WHERE userid='$buyUserID' AND valid=1";
					$rs = querydb($sqlcmd, $db_conn);
					if (count($rs)>0) {
						foreach ($rs as $item){
							$seqno = $item['cartno'];
							echo '<input type="hidden" name="cartnumber" value="'.$seqno.'">';
							echo '<tr>';
							echo '<td>'.$seqno.'</td>';
							echo '<td>'.$item['buyname'].'</td>';
							echo '<td>'.$item['buycolor'].'</td>';
							echo '<td>'.$item['buystorage'].'</td>';
							echo '<td>'.$item['buyprice'].'</td>';
							echo '<td><input type="submit" name="delete" value="刪除商品" style="border:2px #ccc solid;font-size:18px;'.
							'border-radius:5px;width:80px;height:40px;background-color:#DCB5FF;"></td>';
							echo '</tr>';
						}	
					}
				?>
			</table>
		</div>
		<div class="", id="Set_body_process">  
		 <table style="border:8px #FFD382 groove;" width="300" height="150" border="5" >
			<tr>
				<td><font color="blue"  size="5">會員:
				<?php 
				   if($_SESSION['user_name']) echo  $_SESSION['user_name'];
				   else echo "無帳號";
				?>
				</br>歡迎光臨！</font></td>
			</tr>
			<tr>
				<td>
				<font color="blue" size="5">進行登出:</font>
				<input type="submit" name="log_out" value="登出" style="width:100px;height:40px;font-size:20px;color:red;border:2px #9999FF dashed;background-color:yellow;" >
				<?php 
				if(isset($_POST['log_out'])){
					//header("refresh:0;url=../login.html");
				   $_SESSION['user_name']= NULL;    //把帳號清空，禁止未登入跳轉
				   $_SESSION['user_password']= NULL;
				   echo "<script>window.location.href='login.php';</script>";
				}
				?>
				</td>
			</tr>
			<tr style="text-align:center;font-size:20px;">
				<td>
				<a href="phonecheck.php"><input type="button" value="回購買頁面" style="border:2px #ccc solid;font-size:18px;
					border-radius:5px;width:200px;height:40px;background-color:#DCB5FF;">
				</a></td>
			</tr>
		</table>
		</div>
	</div>
</form>
</body>
</html>



