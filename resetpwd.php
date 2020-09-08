<?php
if (isset($_POST['Login']) && !empty($_POST['Login'])) {
    header ("Location:login.php");
    exit;
}
session_start();
require_once ("../include/gpsvars.php");
require_once ("../include/configure.php");
require_once ("../include/db_func.php");
require_once ("../include/xss.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
$ErrMsg = '';
if (isset($_POST['Submit']) && !empty($_POST['Submit'])  
    && isset($eMail) && isset($vCode)) {
    $VerifyCode = $_SESSION['VerifyCode'];
    if ($vCode<>$VerifyCode) {
        $ErrMsg = '驗證碼錯誤！';
    }
    if (!isset($eMail)) $eMail = '';
    $eMail = xsspurify($eMail);
    if (!isset($Name)) $Name = '';
    $Name = xsspurify($Name);
    if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
        $ErrMsg .= '電子郵件格式錯誤\n';
    }
    if (!isset($Name) || empty($Name)) $ErrMsg .= '姓名資料錯誤！';
    if (empty($ErrMsg)) {
        $sqlcmd = "SELECT * FROM phone_user WHERE user_name='$Name' AND "
            . "user_email='$eMail'";
        $rs = querydb($sqlcmd, $db_conn);
        if (count($rs)<=0) {
            $ErrMsg = '資料庫中查無您所輸入之電子郵件地址與姓名組合，請確認輸入資料是否正確';
        } else {
            $SeqNo = $rs[0]['id'];
            //echo $sqlcmd;
			$_SESSION['eMail'] = $eMail;
			$_SESSION['SeqNo'] = $SeqNo;
			echo "email: ".$_SESSION['eMail']."</br>";
			echo "no: ".$_SESSION['SeqNo']."</br>";
			header ("Location:send_reset.php?eMail=$eMail&SeqNo=$SeqNo");
            exit;
        }
    }
}
$vCode = mt_rand(1000,9999);
$_SESSION['VerifyCode'] = $vCode;
if (!isset($Name)) {
    $Name = $eMail = $vCode = '';
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
				background-color:#2980B9;
				background-image:url('../images/register/background_3.jpg'); 
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
		#Set_body_topic{
			text-align:left;
			font-size:30px;
			color:orange;
		    font-family: 標楷體;
			position:absolute; left:400px; top: 140px;
		}
</style>
<script type="text/javascript">
<!--
function setFocus()
{
    document.LoginForm.ID.focus();
}
//-->
</script>


<!DOCTYPE HTML>
<html><!-- -->
<head>
        <title>懂你的手機購物網站--密碼重設頁面</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
</head>
<body onload="setFocus()">

		<div id="Header" >
			<div id="Set_Header" > 
			歡迎使用懂你的手機購物網站--密碼重設
			</div>
			
		</div>

	<div id="Body">
	  <div class="", id="Set_body_topic"> 
	  <form method="POST" name="LoginForm" action="">
	  <table style="border:8px #FFD382 groove;" width="700" height="150" border="5" >	
	   <tr><td>
	  <font color="pink" size="6" face="標楷體">電子郵件：</font><input type="text" name="eMail" value="<?php echo $eMail; ?>" size="20" maxlength="50" style="font-size:25px"></br>
	   <font color="pink" size="6" face="標楷體">用戶姓名：</font><input type="text" name="Name" value="<?php echo $Name; ?>" size="20" maxlength="50" style="font-size:25px"></br>
		<font color="pink" size="6" face="標楷體">驗證數碼：</font><input type="text" name="vCode" size="4" maxlength="4" placeholder="4個數字" style="font-size:25px">&nbsp;&nbsp;
		<img src="photo/image/chapcha.php" style="vertical-align:text-bottom;">
		<input type="submit" name="ReGen" value="重新產生" style="width:90px;height:30px;font-size:15px;color:blue;"/></br></br>

	   <input type="submit" name="Submit" value="發出重置密碼函" style="width:250px;height:40px;font-size:25px;color:red;border:2px #9999FF dashed;background-color:yellow;">&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="submit" name="Login" value="返回登入頁面" style="width:170px;height:40px;font-size:25px;color:blue;"><br /><br />
	  
		<font color="purple" size="6" face="標楷體">
		  請於上方欄位輸入所提示資料<br />點選按鈕後，系統會寄出密碼重置郵件。</font>
		  </td></tr>
		</table>
	  
	
	  </form>
	
	  <?php if (!empty($ErrMsg)) 
		     echo $ErrMsg; 
	  
	  ?>
    </div>
	</div>
</body>
</html>
