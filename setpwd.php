<?php
require_once("../include/gpsvars.php");
require_once("../include/configure.php");
require_once("../include/db_func.php");
require_once("../include/xss.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
if (!isset($ReqID) || !isset($vCode) || !is_numeric($vCode)) {
    //header ("Location:index.php");
    //exit();
}
/*$eMail = $_SESSION['eMail'];
$SeqNo = $_SESSION['SeqNo'];*/

$ReqID = addslashes($ReqID);
$ReqID = xsspurify($ReqID);

if (empty($ReqID)) {
    //header ("Location:index.php");
    //exit();
}
$sqlcmd = "SELECT * FROM phone_user WHERE reqid='$ReqID' "
    . "AND vcode='$vCode' ";
$rs = querydb($sqlcmd, $db_conn);
//echo $sqlcmd;
/*echo "ReqID: ".$ReqID."</br>";
echo "vCode: ".$vCode."</br>";*/
if (count($rs) <= 0) 
    die('重設密碼連結已失效，可能是密碼已重設或是已再次申請重設');
$ID = $rs[0]['user_email'];
$uDate = date('Y-m-d');
if (!isset($PWD01)) $PWD01 = '';
if (!isset($PWD02)) $PWD02 = '';
$ErrMsg = '';
if (isset($Confirm)) {
    if (strlen($PWD01)<8 || strlen($PWD01)>20 || $PWD01<>$PWD02){
		//$ErrMsg .= '密碼長度少於8或超過20，或是兩個密碼不相同\n';
		$ErrMsg = '<font color="Red">'
				. '密碼長度少於8或超過20，或是兩個密碼不相同！</font>';
	}
        
    if (empty($ErrMsg)) {   // 資料驗證無誤
        $NewvCode = rand(10000,99999);
        //$PWD = password_hash($PWD01, PASSWORD_BCRYPT);  origin
		$PWD = sha1($PWD01);
		//echo "加密".$PWD;
        $sqlcmd = "UPDATE phone_user SET user_password='$PWD',vcode='$NewvCode' "
            . "WHERE reqid='$ReqID' AND vcode='$vCode' ";
        $result = updatedb($sqlcmd, $db_conn);
        header ("Location:login.php");
        exit();
    }
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
<script type="text/javascript">
function setFocus() {
    document.LoginForm.PWD01.focus();
}
</script>
<html><!-- -->
<head>
        <title>懂你的手機購物網站--密碼重置頁面</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
</head>
<body onload="setFocus()">


<div style="width:100%">
<!--<img src="../images/opendatalogo06.png" style="width:100%">-->
</div>
  <div id="Header" >
			<div id="Set_Header" > 
			歡迎使用懂你的手機購物網站--密碼重置
			</div>
	</div>		
	<div id="Body">
  
  <form method="POST" name="LoginForm" action="">
  <input type="hidden" name="ReqID" value="<?php echo $ReqID;?>">
  <input type="hidden" name="vCode" value="<?php echo $vCode;?>">
 
  <font color="yellow" size="15" face="標楷體">登入email：<?php echo $ID; ?></font></br>
 
  
    <font color="yellow" size="15" face="標楷體">登入密碼：<input type="password" id='PWD01' name="PWD01" size="20" maxlength="20">
    &nbsp;&nbsp;(8~20個英數字或符號)</font></br>
 
  
    <font color="yellow" size="15" face="標楷體">密碼驗證：<input type="password" name="PWD02" size="20" maxlength="20">&nbsp;&nbsp;(需與登入密碼相同)</font></br>
 

  <input type="submit" name="Confirm" value="更新密碼" style="width:100px;height:40px;font-size:20px;color:red;border:2px #9999FF dashed;background-color:yellow;"></br>

  
  <font color="yellow" size="15" face="標楷體">請於上方欄位輸入登入密碼及密碼驗證碼後，點選『更新密碼』按鈕即可重新設定密碼。</font>
 
  </form>
 <?php if (!empty($ErrMsg)) echo $ErrMsg; ?>
</div>
</body>
</html>
