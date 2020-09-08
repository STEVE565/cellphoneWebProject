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
<body >
      
        <div id="Header" >
			<div id="Set_Header" > 
			歡迎使用懂你的手機購物網站--使用者
			</div>
			
		</div>
		<div id="Body">
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
					<form method="POST" action="">
					<font color="blue" size="5">進行登出:</font>
					<input type="submit" name="log_out" value="登出" style="width:100px;height:40px;font-size:20px;color:red;border:2px #9999FF dashed;background-color:yellow;" >
					</form>
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
			
		</table>
		</div>
		
		</div>
</body>
</html>



