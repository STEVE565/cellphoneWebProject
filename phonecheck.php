<?php
	header('Content-type: text/html; charset=utf-8');
	session_start();
	$_SESSION['LoginID'] = 'i4010';
	if (!isset($_SESSION['LoginID']) || empty($_SESSION['LoginID'])) {
		die('您未登入');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
	<title>懂你的手機購物網站</title>

<?php
	require_once("csscontainer.php");
	echo '</head>';
	// Authentication 認證
	//require_once("../include/auth.php");
	// 變數及函式處理，請注意其順序
	require_once("../include/gpsvars.php");
	require_once("../include/configure.php");
	require_once("../include/db_func.php");
	require_once("../include/xss.php");
	//login mysql
	//$LoginID = 'i4010';
	$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
	$sqlcmd = "SELECT * FROM user WHERE loginid='$LoginID' AND valid='Y'";
	$rs = querydb($sqlcmd, $db_conn);
	if (count($rs) <= 0) die ('Unknown or invalid user!');
	//default page show
	if(isset($_POST['asus']) ){
		$brand = 'ASUS';
		$nowPhoneName = 'ROG Phone II';
	}
	else if(isset($_POST['apple']) ){
		$brand = 'Apple';
		$nowPhoneName = 'iPhone 11 Pro Max';
	}
	else if(isset($_POST['samsung']) ){
		$brand = 'SAMSUNG';
		$nowPhoneName = 'Galaxy S20 Ultra';
	}
	else if(isset($_POST['sony']) ){
		$brand = 'SONY';
		$nowPhoneName = 'xperia1 II';
	}
	//quick same brand phone button click
	//asus
	else if(isset($_POST['ROGPhone']) ){
		$brand = 'ASUS';
		$nowPhoneName = 'ROG Phone';
	}
	else if(isset($_POST['ROGPhoneII']) ){
		$brand = 'ASUS';
		$nowPhoneName = 'ROG Phone II';
	}	
	else if(isset($_POST['ZenFone6']) ){
		$brand = 'ASUS';
		$nowPhoneName = 'ZenFone 6';
	}
	else if(isset($_POST['ZenFone5z']) ){
		$brand = 'ASUS';
		$nowPhoneName = 'ZenFone 5z';
	}
	else if(isset($_POST['ZenFoneMaxM2']) ){
		$brand = 'ASUS';
		$nowPhoneName = 'ZenFone Max M2';
	}
	else if(isset($_POST['ZenFoneMaxProM2']) ){
		$brand = 'ASUS';
		$nowPhoneName = 'ZenFone Max Pro M2';
	}
	//apple
	else if(isset($_POST['iPhone11']) ){
		$brand = 'Apple';
		$nowPhoneName = 'iPhone11';
	}
	else if(isset($_POST['iPhone11Pro']) ){
		$brand = 'Apple';
		$nowPhoneName = 'iPhone 11 Pro';
	}
	else if(isset($_POST['iPhone11ProMax']) ){
		$brand = 'Apple';
		$nowPhoneName = 'iPhone 11 Pro Max';
	}
	else if(isset($_POST['iPhoneSE']) ){
		$brand = 'Apple';
		$nowPhoneName = 'iPhone SE';	
	}
	//samsung
	else if(isset($_POST['GalaxyS20']) ){
		$brand = 'SAMSUNG';
		$nowPhoneName = 'Galaxy S20';
	}
	else if(isset($_POST['GalaxyS20plus']) ){
		$brand = 'SAMSUNG';
		$nowPhoneName = 'Galaxy S20 plus';
	}
	else if(isset($_POST['GalaxyS20Ultra']) ){
		$brand = 'SAMSUNG';
		$nowPhoneName = 'Galaxy S20 Ultra';
	}
	//sony
	else if(isset($_POST['xperia1II']) ){
		$brand = 'SONY';
		$nowPhoneName = 'xperia1 II';	
	}
	//first open this page show apple 
	else if(empty($_SESSION['brandname']) && empty($_SESSION['phonename']) ){
		$brand = 'Apple';
		$nowPhoneName = 'iPhone 11 Pro Max';
	}
	else{
		if(empty($brand) && empty($nowPhoneName) ){
			$brand = $_SESSION['brandname'];
			$nowPhoneName = $_SESSION['phonename'];
		}
	}
	//phone name
	$sqlcmd = "SELECT * FROM Phone WHERE Brand='$brand'";
	$rs = querydb($sqlcmd, $db_conn);
	if(count($rs)<=0) die('No Brand could be found!');
	$phoneName = array();
	$phoneButtonName = array();
	$i=0;
	foreach ($rs as $item){
		if($i>0){
			if($item['PhoneName']!=$phoneName[$i-1]){
				$phoneName[$i] = $item['PhoneName'];
				$str = (string)$phoneName[$i];
				$phoneButtonName[$i] = preg_replace('/\s(?=)/', '', $str);
				$i++;
			}
		}
		else{
			$phoneName[$i] = $item['PhoneName'];
			$str = (string)$phoneName[$i];
			$phoneButtonName[$i] = preg_replace('/\s(?=)/', '', $str);
			$i++;
		}
	}
	//phone storage price discribe
	$phoneColor = array();
	$phoneStorage = array();
	$phonePrice = array();
	$phoneDiscribe = array();
	$tmpDisc;
	$sqlcmd = "SELECT * FROM Phone WHERE Brand='$brand' AND PhoneName='$nowPhoneName'";
	$rs = querydb($sqlcmd, $db_conn);
	if(count($rs)<=0) die('No storage could be found!');
	$i=0;
	foreach ($rs as $item){
		$phoneStorage[$i] = $item['Ram'].'/'.$item['Rom'];
		$phonePrice[$i] = $item['Price'];
		if(empty($tmpDisc) )
			$tmpDisc = $item['Description'];
		$i++;
	}
	$phoneDiscribe = explode("。",(string)$tmpDisc);
	//phone photo
	$sqlcmd = "SELECT * FROM Picture WHERE PhoneName='$nowPhoneName'";
	$rs = querydb($sqlcmd, $db_conn);
	if (count($rs)>0) {
		$i = 0;
		foreach ($rs as $item){
			if($i==0)
				$nowPhoneColor = $item['color'];
			$phoneColor[$i] = $item['color'];
			$i++;
		}	
	}
	//加入購物車
	if(isset($_POST['buy']) ){
		$buyName = $nowPhoneName;
		$buyColor = $_POST['color'];
		$buyStorage = $_POST['storage'];
		for($i=0;$i<count($phoneStorage);$i++){
			if($buyStorage==$phoneStorage[$i]){
				$buyPrice = $phonePrice[$i];
				break;
			}
		}
		$buyUserName = $_SESSION['user_name'];
		$sqlcmd = "SELECT * FROM phone_user WHERE user_name='$buyUserName'";
		$rs = querydb($sqlcmd, $db_conn);
		if (count($rs)>0) {
				$buyUserID = $rs[0]['id'];
		}
		//echo $buyName.' '.$buyColor.' '.$buyStorage.' '.$buyPrice.' '.$buyUserName.' '.$buyUserID.'<br>';
		$sqlcmd = 'INSERT INTO shoppingcart(userid,buyname,buycolor,buystorage,buyprice) VALUES('.
		"'$buyUserID','$buyName','$buyColor','$buyStorage','$buyPrice'".')';
		$result = updatedb($sqlcmd, $db_conn);
		if(!$result){
			die('Could not enter data: ');
		}
		else{
			echo '<script language="javascript">';
			echo 'alert("加入購物車成功!")';
			echo '</script>';
		}
	}
?>
<body>
<form method="post" action="">
<div id="container" style="font-family:sans-serif;text-align:center;">
    <div id="headbox">懂你的手機購物網站</div>
    <div id="sidebar_left">
		<div>自家手機快速瀏覽</div>
		<table cellpadding="5">
		<?php
			for($i=0;$i<count($phoneName);$i++){
				echo '<tr><td><input type="submit" style="border:2px #ccc solid;font-size:18px;border-radius:10px;'.
					'width:180px;height:60px;background-color:#DCB5FF;" name="'.
					$phoneButtonName[$i].'" value="'.$phoneName[$i].'"></td></tr>';//trim notrim
			}
		?>
		</table>
	</div>
    <div id="sidebody">
		品牌快速點選
		<table cellpadding="5" align="center">
			<tr>
				<td>
					<input type="submit"
					style="border:2px #ccc solid;font-size:30px;border-radius:10px;
					width:200px;height:60px;background-color:#DCB5FF;" name="asus" value="ASUS">
				</td>
				<td><input type="submit" style="border:2px #ccc solid;font-size:30px;border-radius:10px;
					width:200px;height:60px;background-color:#DCB5FF;" name="apple" value="APPLE">
				</td>
				<td><input type="submit" style="border:2px #ccc solid;font-size:30px;border-radius:10px;
					width:200px;height:60px;background-color:#DCB5FF;" name="samsung" value="SAMSUNG">
				</td>
				<td><input type="submit" style="border:2px #ccc solid;font-size:30px;border-radius:10px;
					width:200px;height:60px;background-color:#DCB5FF;" name="sony" value="SONY">
				</td>
			</tr>
		</table>
		<hr/>
		<div id="phonePage" style="text-align:center;">
			<div id="leftPhoto">Photo<br>
			<img id="phoneimg" src="getimage.php?nowPhoneName=<?php echo $nowPhoneName ?>&nowPhoneColor=
			<?php echo $nowPhoneColor ?>" border="0" width="400px" height="400px" align="absmiddle">
			</div>
			<div id="rightName" style="font-size:30px;">
				<?php
					echo '<div id="phonename" style="margin: 0 auto;"><b style="text-align:center;">'.$nowPhoneName.'</b></div>';
				?>
			</div>
			<div id="rightColor">Color<br>
				 <div class="col-xl-10 pb-5">
				<?php
					for($i=0;$i<count($phoneColor);$i++){
						if($i%2==0 && $i!=0)
							echo '<br>';
						echo '<input class="checkbox-budget" type="radio" name="color" value="'.$phoneColor[$i].'" id="color-'.$i;
						if($phoneColor[$i]=='Black'){
							echo '" onclick="onradiocolor(\'Black\')">';// required="required
						}
						else if($phoneColor[$i]=='Purple'){
							echo '" onclick="onradiocolor(\'Purple\')">';
						}
						else if($phoneColor[$i]=='Red'){
							echo '" onclick="onradiocolor(\'Red\')">';
						}
						else if($phoneColor[$i]=='White'){
							echo '" onclick="onradiocolor(\'White\')">';
						}
						else if($phoneColor[$i]=='Yellow'){
							echo '" onclick="onradiocolor(\'Yellow\')">';
						}
						else if($phoneColor[$i]=='Blue'){
							echo '" onclick="onradiocolor(\'Blue\')">';
						}
						else if($phoneColor[$i]=='Pink'){
							echo '" onclick="onradiocolor(\'Pink\')" >';
						}
						else if($phoneColor[$i]=='Green'){
							echo '" onclick="onradiocolor(\'Green\')">';
						}
						else if($phoneColor[$i]=='Gray'){
							echo '" onclick="onradiocolor(\'Gray\')">';
						}
						else if($phoneColor[$i]=='Silver'){
							echo '" onclick="onradiocolor(\'Silver\')">';
						}
						else if($phoneColor[$i]=='Golden'){
							echo '" onclick="onradiocolor(\'Golden\')">';
						}
						echo '<label class="for-checkbox-budget" for="color-'.$i.'">'.
						'<span data-hover="'.$phoneColor[$i].'">'.$phoneColor[$i].'</span></label>';
					}
				?>
				</div>
			</div>
			<div id="rightStorage">Storage(RAM/ROM)<br>
				<div class="col-xl-10 pb-5">
					<?php
					$r = array();
					for($i=0;$i<count($phoneStorage);$i++){
						$r[$i] = (string)$phonePrice[$i];
						echo '<input class="checkbox-budget" type="radio" name="storage" id="budget-'.$i.
						'" onclick="onradiochange'.(int)$i.'()" value="'.$phoneStorage[$i].'">'.
						'<label class="for-checkbox-budget" for="budget-'.$i.'">'.
						'<span data-hover="'.$phoneStorage[$i].'">'.
						$phoneStorage[$i].'</span></label>';
					}
					if(empty($r[1]) )
						$r[1] = 0;
					if(empty($r[2]) )
						$r[2] = 0;
					?>
				</div>
			</div>
			<div id="rightPrice">price<br>
				<div id="showPrice" style="text-align:cemter;font-size:30px;font-weight:bold;">
					<?php
						echo '<script type="text/javascript">';
						echo 'function onradiochange0(){';
						echo 'document.getElementById("showPrice").innerHTML = '.$r[0];
						echo '}';
						echo 'function onradiochange1(){';
						echo 'if('.$r[1].'!=0)';
						echo '	document.getElementById("showPrice").innerHTML = '.$r[1];
						echo '}';
						echo 'function onradiochange2(){';
						echo 'if('.$r[2].'!=0)';
						echo '	document.getElementById("showPrice").innerHTML = '.$r[2];
						echo '}';
						echo '</script>';
					?>
				</div>
			</div>
			<div id="rightBuy">Buy<br>
				<?php
					$u_name = $_SESSION['user_name'];
					$u_password =  $_SESSION['user_password'];
					$_SESSION['brandname'] = $brand;
					$_SESSION['phonename'] = $nowPhoneName;
					if(($u_name==NULL)||($u_password==NULL)){
						echo '<h3>請先進行登入再購買!</h3>';
					}
					else{ ?>
				<input type="submit" style="border:2px #ccc solid;border-radius:10px;
					width:100px;height:60px;background-color:#DCB5FF;" name="buy" value="加入購物車">
					<?php } ?>
			</div>	
			<div id="buttomDiscribe" style="text-align:left;"><p style="text-align:center;">Description</p>
				<?php
					for($i=0;$i<count($phoneDiscribe)-1;$i++)
						echo '&diams;&nbsp;'.$phoneDiscribe[$i].'<br>';
				?>
			</div>
		</div>
	</div>
    <div id="sidebar_right">快捷按鈕<br>
	<?php
		$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
		$u_name = $_SESSION['user_name'];
		$u_password =  $_SESSION['user_password'];
		if(($u_name==NULL)||($u_password==NULL)){
			//echo "<script>window.location.href='login.php';</script>";
			echo '<a href="login.php"><input type="button" value="登入" style="border:2px #ccc solid;font-size:30px;'.
			'border-radius:10px;width:120px;height:60px;'.
			'background-color:#DCB5FF;margin-top:30px;margin-button:30px;"></a>';
		}
		else{ ?>
			<table style="border:3px #FFD382 groove;" width="180" height="150" border="3" align="center">
			<tr>
				<td><font color="blue"  size="5">會員:<br>
				<?php 
				   if($_SESSION['user_name']) echo  $_SESSION['user_name'];
				   else echo "無帳號";
				?>
				<br>歡迎光臨！</font></td>
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
		</table>
		<br>
		<a href="shoppingcart.php"><input type="button" value="購物車" style="border:2px #ccc solid;font-size:30px;
		border-radius:10px;width:120px;height:60px;
		background-color:#DCB5FF;margin-top:30px;margin-button:30px;">
		</a>
		<?php } ?>	
	</div>
    <div id="clear"></div>
    <div id="footer">Design by TTU-CSE-I4010</div>
	</form>
</div>
</body>
<script type="text/javascript">
	var obj = document.getElementById("phoneimg");
	var imgSrc = obj.getAttribute("src");
	var jsphonename = document.getElementById("phonename").innerText;
	var newSrc = "getimage.php?nowPhoneName=";
	function onradiocolor(jscolor){
		if(jscolor=="Black")
			newSrc = newSrc + jsphonename + "&nowPhoneColor=Black";
		else if(jscolor=="Purple")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Purple";
		else if(jscolor=="Red")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Red";
		else if(jscolor=="White")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=White";
		else if(jscolor=="Yellow")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Yellow";
		else if(jscolor=="Blue")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Blue";
		else if(jscolor=="Pink")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Pink";
		else if(jscolor=="Green")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Green";
		else if(jscolor=="Gray")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Gray";
		else if(jscolor=="Silver")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Silver";
		else if(jscolor=="Golden")
			newSrc = "getimage.php?nowPhoneName="+jsphonename+"&nowPhoneColor=Golden";
		var newimgSrc = obj.setAttribute("src", newSrc);
	}
	
</script>
</html>