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
$worker_name = $_POST['worker_name'];//post獲得工作者名稱錶單值
$worker_password = $_POST['worker_password'];//post獲得工作者密碼單值
/*echo $worker_name;
echo "</br>".$worker_passowrd."</br>";*/
$user_name = $_POST['user_name'];//post獲得使用者名稱錶單值
$user_password = $_POST['user_password'];//post獲得使用者密碼單值
$vCode = $_POST['vCode'];//post獲得使用者驗證碼單值
$vCode2 = $_POST['vCode2'];//post獲得工作者驗證碼單值
$test1=0; $test2=0;
if (isset($_POST['submit'])||isset($_POST['worker_submit'])) {
	$VerifyCode = $_SESSION['VerifyCode'];
	$VerifyCode2 = $_SESSION['VerifyCode2'];
	
	if (($vCode<>$VerifyCode)||empty($vCode)||!isset($vCode)) {
		$test1=1;
		if(isset($_POST['submit'])){
			$ErrMsg = '<font color="Red">'
				. '驗證碼錯誤！</font>';
		}					
		 
			
	}
	if (($vCode2<>$VerifyCode2)||empty($vCode2)||!isset($vCode2)) {
		$test2=1;
		if(isset($_POST['worker_submit'])){
			$ErrMsg2 = '<font color="Red">'
				. '驗證碼錯誤！</font>';
		}
		
	}
	if($test1==0||$test2==0){	
	
		if(($user_name && $user_password)||($worker_name && $worker_password)){  //使用者及工作者的帳號及密碼都不為空
				if(isset($worker_name)&&isset($worker_password)){
					$encode_w_password = sha1($worker_password);
					//echo $encode_w_password;
					$sql2 = "select * from phone_worker where worker_name = '$worker_name' and worker_password='$encode_w_password'";//檢測資料庫是否有對應的workername和password的sql
					$rs = querydb($sql2, $db_conn);
					
					if($rs){//0 false 1 true
						$_SESSION['worker_name'] = $worker_name;
						$_SESSION['worker_password'] = $encode_w_password;
						$w_name = $_SESSION['worker_name'];
						$w_password =  $_SESSION['worker_password'];
						//echo "success";
						header("refresh:0;url=user/user_index.php");//如果成功跳轉至welcome.html頁面
						exit;
					}
					else{

						echo "<script type='text/javascript'>alert('工作者名稱或密碼錯誤，跳轉回登入頁面!!');</script>";
						//header("refresh:0;url=login.php");
					
					}
				
				}
				if(isset($user_name)&&isset($user_password)){
					$encode_password = sha1($user_password);
					//echo "加密".$encode_password;
					$sql1 = "select * from phone_user where user_name = '$user_name' and user_password='$encode_password'";//檢測資料庫是否有對應的username和password的sql
					$result = querydb($sql1, $db_conn);
					
					if($result){//0 false 1 true
						$_SESSION['user_name'] = $user_name;
						$_SESSION['user_password'] = $encode_password;
						$u_name = $_SESSION['user_name'];
						$u_password =  $_SESSION['user_password'];
						//echo "success";
						header("refresh:0;url=phonecheck.php");//如果成功跳轉至welcome.html頁面
						exit;
					}
					else{

						echo "<script type='text/javascript'>alert('使用者名稱或密碼錯誤，跳轉回登入頁面!!');</script>";
						//header("refresh:0;url=login.php");
					
					}
				}
			
		}
		else{                    //如果使用者及工作者的名稱或密碼有空
				echo "<script type='text/javascript'>alert('名稱或密碼填寫不完整，跳轉回登入頁面!!');</script>";
				header("refresh:0;url=login.php");	
		}
	}
	
}



$vCode = mt_rand(1000,9999);
$_SESSION['VerifyCode'] = $vCode;
$vCode2 = mt_rand(1000,9999);
$_SESSION['VerifyCode2'] = $vCode2;
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
				background-color:#2980B9;
				background-image:url('../images/register/background_9.jpg'); 
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
			text-align:left;
			font-size:30px;
			color:pink;
		    font-family: 標楷體;
			position:absolute; right:20px; top: 400px;
		}
		#Set_body_process2{
			text-align:left;
			font-size:32px;
			color:pink;
		    font-family: 標楷體;
			position:absolute; left:250px; top: 100px;
		}
</style>

<!DOCTYPE HTML>
<html><!-- -->
<head>
        <title>懂你的手機購物網站--登入頁面</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
</head>
<body >
      
        <div id="Header" >
			<div id="Set_Header" > 
			歡迎使用懂你的手機購物網站--登入
			</div>
			
		</div>
		
        <div id="Body">
		<div class="", id="Set_body_topic"> 
		<table style="border:8px #FFD382 groove;" width="700" height="150" border="5" >	
			<tr><td>	
			<form name="login" action="login.php" method="post">
			<font color="purple" size="6" face="標楷體">使用者登入</font></br>
			<font color="gray" size="6" face="標楷體">使用者名稱:<input type=text style="font-size:25px" name="user_name" value="<?php echo $user_name; ?>"></font></br>
			<font color="gray" size="6" face="標楷體">密碼: <input type=password style="font-size:25px" name="user_password" value="<?php echo $user_password; ?>"></font></br>
			<font color="gray" size="6" face="標楷體">驗證數碼:
			<input type="text" name="vCode" size="4" maxlength="4" 
             placeholder="4個數字" style="font-size:25px"></font>&nbsp;&nbsp;
			<img src="photo/image/chapcha.php" style="vertical-align:text-bottom;">
			<input type="submit" name="ReGen" value="重新產生" style="width:90px;height:30px;font-size:15px;color:blue;"/>
			</br></br><input type="submit" name="submit" value="登入" style="width:90px;height:40px;font-size:25px;color:blue;">
			<input type="button" name="register" value="沒帳號請註冊" style="width:150px;height:40px;font-size:23px;color:blue;" onclick=window.location.href='announcement.php'>
			<input type="button" name="register_pwd" value="忘記密碼" style="width:150px;height:40px;font-size:23px;color:blue;" onclick=window.location.href='resetpwd.php'>
			<input type="button" value="返回首頁" style="width:150px;height:40px;font-size:23px;color:blue;" onclick=window.location.href='index.php'>
			
			<!--
			<p><input type="button" name="register" value="註冊" onclick="redirect()" style="width:120px;height:40px;font-size:25px;color:blue; margin-left:600px;margin-top:30px"></p>
			-->
			</form>
			</td></tr>
		   </table>
		   <?php if (!empty($ErrMsg)) echo $ErrMsg; ?>
		</div> 
		 <img src="photo/image/register/topic_4.jpg" width="300" height="300" style="margin-left:1000px;margin-top: 20px">
		
		<div class="", id="Set_body_process"> 
		<table style="border:8px #FFD382 groove;" width="700" height="150" border="5" >	
			<tr><td>
			<form name="login" action="login.php" method="post">
			<font color="purple" size="6" face="標楷體">後台登入</font></br>
			<FONT SIZE="6"COLOR="gray"FACE="標楷體">工作者名稱: </FONT><input type=text style="font-size:25px" name="worker_name" value="<?php echo $worker_name; ?>"></br>
			<FONT SIZE="6"COLOR="gray"FACE="標楷體">密碼: </FONT><input type=password style="font-size:25px" name="worker_password" value="<?php echo $worker_password; ?>"></br>
			<font color="gray" size="6" face="標楷體">驗證數碼:
			<input type="text" name="vCode2" size="4" maxlength="4" 
             placeholder="4個數字" style="font-size:25px"></font>&nbsp;&nbsp;
			<img src="photo/image/chapcha2.php" style="vertical-align:text-bottom;">
			<input type="submit" name="ReGen" value="重新產生" style="width:90px;height:30px;font-size:15px;color:blue;"/>
			</br></br><input type="submit" name="worker_submit" value="登入" style="width:90px;height:40px;font-size:25px;color:blue;">
			<input type="button" name="register" value="沒帳號請註冊" style="width:150px;height:40px;font-size:23px;color:blue;" onclick="enter()">
			<!--<input type="button" name="register_pwd" value="忘記密碼" style="width:150px;height:40px;font-size:23px;color:blue;" onclick=window.location.href='adminresetpwd.php'>-->
			</form>
			
			</td></tr>
		   </table>
		<?php if (!empty($ErrMsg2)) echo $ErrMsg2; ?>		   
        </div>
		<script>
		function enter() {
			var password = prompt("請輸入通行碼","");
		    if (password=="123abc++"){
		        alert('恭喜成功進入註冊階段!');
				//alert('"'+pol+'"');
				location.href='worker_signup.php';
		    }
			else{
			   alert('錯誤，請再輸入一次通行碼');
			   location.href='login.php';
			}
		}
		</script>
		<img src="photo/image/register/topic_5.png" width="300" height="300" style="position:absolute; left:300px; top:350px;">
		
		</div>
		
		
</body>
</html>



	