<?php
session_start();
//require_once ("../include/gpsvars.php");
require_once ("../include/configure.php");
require_once ("../include/db_func.php");
require_once ("../include/xss.php");
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
$ErrMsg = '';
$eMail = $_SESSION['eMail'];
$SeqNo = $_SESSION['SeqNo'];
if (!isset($eMail) || !isset($SeqNo) || !is_numeric($SeqNo)) {
	//echo "fuckyou"."</br>";
	echo "email: ".$_SESSION['eMail']."</br>no: ".$_SESSION['SeqNo']."</br>";
    die('Check point 1');
    header ("Location: login.php");
    exit();
}
$eMail = xsspurify($eMail);
if (empty($eMail)) {
    die('Check point 2');
    header ("Location: login.php");
    exit();
}
$sqlcmd = "SELECT * FROM phone_user WHERE user_email='$eMail' AND id='$SeqNo'";
$rs = querydb($sqlcmd, $db_conn);
if (count($rs)<=0) {
    die('Check point 3');
    header ("Location: login.php");
    exit();
}
//echo "email:".$eMail."</br>";
$eMail = $rs[0]['user_email'];
//echo "email:".$eMail."</br>";
$vCode = $_SESSION['VerifyCode'];
//echo "email:".$_SESSION['eMail'];
if (empty($ErrMsg)) {
    $ReqID = sha1($eMail . date('His'));
    $sqlcmd = "UPDATE phone_user SET reqid='$ReqID',vcode='$vCode' "
        . "WHERE user_email='$eMail' ";
    $result = updatedb($sqlcmd, $db_conn);
    /*$Link = 'https://opendata.ttu.edu.tw/admin/adminsetpwd.php?ReqID=' 
    . $ReqID . '&vCode=' . $vCode;*/
	$Link = 'https://p9058.isrcttu.net/fpro/setpwd.php?ReqID=' 
    . $ReqID . '&vCode=' . $vCode;
    // Notify user about the account and password
    //echo $sqlcmd;	
    $From = "Mail Master <mailmaster@gm.ttu.edu.tw>";
    $To = $eMail;
    $Subject = '開放資料管理系統 管理者密碼重置通知';
    $Recipient = $eMail;
    $Message = "\n有用戶透過重設密碼功能申請開放資料管理系統管理者密碼重置，"
        . "如果不是您所申請，則可不予理會\n\n"
        . "請點選下列連結進入系統設定新密碼：\n\n"
        . $Link . "\n\n"
        . "This is an automactically generated response email. "
        . "If you do not expect to receive it, then someone might regist your "
        . "email address in our Opendata management system. "
        . "If this is the case, please accept our apology.";
    $_SESSION['VerifyCode'] = mt_rand(1000,9999);
    //require_once('sendmail_inc.php');
	$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->IsSMTP();
		//$mail->SMTPDebug = 2;                                        
		$mail->SMTPAuth = false;
		$mail->Host = "smtp.ttu.edu.tw";
		$mail->Port = 25;
		$mail->CharSet = "utf-8";
		$mail->Encoding = "base64";
		$mail->WordWrap = 500;
		/*$mail->Username = "u10506203@ms.ttu.edu.tw";
		$mail->SetFrom('u10506203@ms.ttu.edu.tw', '作業八-密碼重設');*/
		$mail->Username = "u10506203@ms.ttu.edu.tw";
		$mail->SetFrom('u10506203@ms.ttu.edu.tw', '懂你的手機購物網站-密碼重設作業');
		$mail->Subject = $Subject;
		$mail->AddAddress($Recipient, $Recipient);
		$Notice = $Recipient . " 您好\n\n" . $Message . "\n\n此信件為系統自動發出請勿回覆，謝謝！\n";
		$mail->Body = $Notice;
		$mail->Send();
		$mail->ClearAllRecipients();
	
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
</style>
<html><!-- -->
<head>
        <title>懂你的手機購物網站--密碼重置頁面</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
</head>
<body>
       <div id="Header" >
			<div id="Set_Header" > 
			歡迎使用懂你的手機購物網站--密碼重置
			</div>
			
		</div>
<div class="Container" style="text-align:center;">
<div style="width:100%">
<!--<img src="../images/opendatalogo06.png" style="width:100%">-->
</div>
<div style="font-weight:bold;">
  懂你的手機網站--密碼重置
</div>
<?php if (empty($ErrMsg)) { ?>
  <div style="text-align:center;">
  密碼重置郵件已寄到您的電子郵件信箱，請依指示重設您的密碼。
  </div>
<?php } else { ?>
  <div style="text-align:center;">
  資料有錯誤，請回上一頁重新輸入。
  </div>
<?php } ?>
<div style="text-align:center;">
<a href="login.php">返回登入頁面</a>
</div>

</div>
</body>
</html>
