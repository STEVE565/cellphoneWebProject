<?php 
header("Content-Type: text/html; charset=utf8");
/*if(!isset($_POST['submit'])){
exit("錯誤執行");
}//判斷是否有submit操作*/
require_once('../include/db_func.php');
require_once('../include/configure.php');
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
$user_name=$_POST['user_name'];//post獲取表單裡的name
$user_password=$_POST['user_password'];//post獲取表單裡的password
$user_birthday=$_POST['user_birthday'];//post獲取表單裡的birthday
$user_phone=$_POST['user_phone'];//post獲取表單裡的user_phone
$user_email=$_POST['user_email'];//post獲取表單裡的user_email
$user_address=$_POST['user_address'];//post獲取表單裡的user_address
//echo $user_phone; 
/*echo "funny";
$encode_password = sha1($user_password);
echo "加密前:".$user_password."</br>";
echo "加密後:".$encode_password;*/
/*if(isset($user_name)&&isset($user_password)&&isset($user_birthday)&& !empty($user_name)&& !empty($user_password)&& !empty($user_birthday)){*/


$judge_phone2=0;   //手機格式判斷
$size_num = strlen($user_phone);
if($size_num!=10) $judge_phone2=1; //小於10位數
//if($size_num>10) $judge_phone2=1; 
//echo $Phone."長度".$size_num."</br>"; 
$fdb=preg_split('//', $user_phone, -1, PREG_SPLIT_NO_EMPTY);

for($i=0 ;$i< $size_num; $i++){    //判斷電話是否為09xxxxxxxx
	if($i==0){
	  if($fdb[0]!=0){
		  //echo "答錯了0"."</br>";
		  $judge_phone2=1;
	  }		
	}
	if($i==1){
	   if($fdb[1]!=9){
		  //echo "答錯了9"."</br>";
	      $judge_phone2=1;
	   }		
	}
	if($i>1){
		$pattern2 = "[\d]";
		$judge_phone = preg_match($pattern2, $fdb[$i], $matches);
		if($judge_phone==false){
			//echo $i."不一樣!!"."</br>";
		  $judge_phone2=1; 
		}
	}
}
$judge_name=0; $judge_password=0; $judge_phone3=0; $judge_email=0; $judge_address=0;//帳號 密碼 生日 手機 email 地址判斷 
$long_name=strlen($user_name);  //名字超過20長度
if($long_name>20){
	$user_name=mb_substr($user_name, 0, 20);
	$judge_name=1;
	//echo "名字長度超過，以協助截短，請確認";
}
$long_phone=strlen($user_phone);  //電話超過10長度
if($long_phone>10){
	$user_phone=mb_substr($user_phone, 0, 10);
	$judge_phone3=1;
	//echo "電話長度超過，以協助截短，請確認";
}
$long_password=strlen($user_password);  //密碼超過20長度
if($long_password>20){
	$user_password=mb_substr($user_password, 0, 20);
	$judge_password=1;
	//echo "密碼長度超過，以協助截短，請確認";
}
$long_email=strlen($user_email);  //email超過50長度
if($long_email>50){
	$user_email=mb_substr($user_email, 0, 50);
	$judge_email=1;
	
}
$long_address=strlen($user_address);  //地址超過100長度
if($long_address>100){
	$user_address=mb_substr($user_address, 0, 100);
	$judge_address=1;
	
}
$via_email=0;
if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
{
//echo("E-mail is not valid");
$via_email=1;
 //echo $via_email; 
}
if(isset($user_name)&&isset($user_password)&&isset($user_birthday)&&isset($user_phone)&&isset($user_email)&&isset($user_address)&& !empty($user_name)&& !empty($user_password)&& !empty($user_birthday)&& !empty($user_phone)&& !empty($user_email)&& !empty($user_address)){
	//$pattern = '/[^x00-x80]/';
	//$pattern ="/[x7f-xff]/";
	$pattern = '/[\x80-\xff]./';

	/*$user_name = trim($user_name);    空格限制
	$user_name = preg_replace('/\s/', '', $user_name);
	$user_password = trim($user_password);
	$user_password = preg_replace('/\s/', '', $user_password);*/
	 
	/*$user_test="refewjprgnergepgnpergnq egrnepgnp3";
	if(preg_match($pattern,$user_test)){
		   echo   $user_test."</br>是中文";
		   
	} 
	else{
		echo   $user_test."</br>不是中文";
	} */
	 
	 
	$token = strtok($user_birthday, "-");
	$stand = [0,0,0,0,0,0];
	$i = 0; 
	while ($token !== false)
	{
	$stand[$i] = $token;
	//echo "$stand[$i]"."</br>";
	$token = strtok("-");
	$i++;
	}
	$differ_y = date('Y')-$stand[0];
	$differ_m = date('m')-$stand[1];
	$differ_d = date('j')-$stand[2];
    //echo "年差".$differ_y."月差".$differ_m."日差".$differ_d;
	 //echo "使用者名稱".$user_name;
	 //echo "沒進判斷";
	//if((preg_match($pattern,$user_name))||(preg_match($pattern,$user_password))||($differ_y<0)||($differ_m<0)||($differ_d<0)){
	if((preg_match($pattern,$user_name))||(preg_match($pattern,$user_password))||($differ_y<0)||(($differ_y==0)&&($differ_m<0))||(($differ_y==0)&&($differ_m==0)&&($differ_d<0))||($judge_name==1)||($judge_password==1)||($judge_phone3==1)||($judge_phone2==1)||($judge_email==1)||($via_email==1)||($judge_address==1)){
	//if(($differ_y<0)||($differ_m<0)||($differ_d<0)){
	//echo "有進判斷1";
	
		if(preg_match($pattern,$user_name)){
		   echo "<script type='text/javascript'>alert('使用者名稱不可有中文字!!');</script>";
		   //header("refresh:0;url=signup.html");
		   //echo "使用者名稱不可有中文字".$user_name;
		}
        if(preg_match($pattern,$user_password)){
			echo "<script type='text/javascript'>alert('密碼不可有中文字!!');</script>";
			//header("refresh:0;url=signup.html");
		}
		
		if(($differ_y<0)||(($differ_y==0)&&($differ_m<0))||(($differ_y==0)&&($differ_m==0)&&($differ_d<0))){
			//if(($differ_y>0)||($differ_m<0)||($differ_d<0)){
		    echo "<script type='text/javascript'>alert('生日不可在未來!!');</script>";
				   //echo "未來幹";
				   //header("refresh:0;url=create.php");	
		} 
		if($judge_name==1){
			echo "<script type='text/javascript'>alert('名字長度超過20，已協助截短，請確認!!');</script>";
		}
		if($judge_password==1){
			echo "<script type='text/javascript'>alert('密碼長度超過20，已協助截短，請確認!!');</script>";
		}
		if($judge_phone3==1){
			echo "<script type='text/javascript'>alert('電話長度超過10，已協助截短，請確認!!');</script>";
		}
		if($judge_phone2==1){
			echo "<script type='text/javascript'>alert('電話格式錯誤，請更改!!');</script>";
		}
		if($judge_email==1){
			echo "<script type='text/javascript'>alert('Email長度超過50，已協助截短，請確認!!');</script>";
		}
		if($via_email==1){
			echo "<script type='text/javascript'>alert('Email格式錯誤，請更改!!');</script>";
		}
		if($judge_address==1){
			echo "<script type='text/javascript'>alert('地址長度超過100，已協助截短，請確認!!');</script>";
		}
	}
	
    else{
		//echo "有進判斷2"; 把加密後的密碼加在這裡
		$encode_password = sha1($user_password);
		$q="insert into phone_user(id,user_name,user_password,user_birthday,user_phone,user_email,user_address) values (null,'$user_name','$encode_password','$user_birthday','$user_phone','$user_email','$user_address')";//向資料庫插入表單傳來的值的sql
	     //$reslut=mysqli_query($con1,$q);//執行sql
		$reslut= querydb($q,$db_conn); 

	
		echo "<script type='text/javascript'>alert('註冊成功，跳轉登入頁面!!');</script>";
		header("refresh:0;url=login.php");  
		//header("refresh:0;url=signup.php");
	}
	
	
 
}
else{  //使用者名稱或是密碼或是生日有空
	if(isset($_POST['submit'])){
		if(empty($user_name)){
			 echo "<script type='text/javascript'>alert('使用者名稱不可空白!!');</script>";
		}
		if(empty($user_password)){
			 echo "<script type='text/javascript'>alert('密碼不可空白!!');</script>";
		}
		if(empty($user_birthday)){
			 echo "<script type='text/javascript'>alert('生日不可空白!!');</script>";
		}
		if(empty($user_phone)){
			 echo "<script type='text/javascript'>alert('手機不可空白!!');</script>";
		}
		if(empty($user_email)){
			 echo "<script type='text/javascript'>alert('Email不可空白!!');</script>";
		}
		if(empty($user_address)){
			 echo "<script type='text/javascript'>alert('地址不可空白!!');</script>";
		}
		 //header("refresh:0;url=signup.html");
         //header("refresh:0;url=signup.php");
   }
}

//mysqli_close($con1);//關閉資料庫 old ways
?>

<!-- 以下為美化過後頁面-->
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


<!DOCTYPE HTML>
<html><!-- -->
<head>
        <title>懂你的手機購物網站--使用者註冊頁面</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
</head>
<body >
      
        <div id="Header" >
			<div id="Set_Header" > 
			歡迎使用懂你的手機購物網站--使用者註冊
			</div>
			
		</div>
		
        <div id="Body">
			<form action="" method="post">
			<p><font color="yellow" size="20" face="標楷體">使用者註冊</font></p>
			<p><FONT SIZE="6"COLOR="orange"FACE="標楷體">使用者名稱:<input type="text" style="font-size:25px" value="<?php echo $user_name; ?>" name="user_name">(不可為中文，至多長度20位)</FONT></p>
			<p><FONT SIZE="6"COLOR="orange"FACE="標楷體">密碼: <input type="text" style="font-size:25px" value="<?php echo $user_password; ?>" name="user_password">(至多長度20位)</FONT></p>
			<p><FONT SIZE="6"COLOR="orange"FACE="標楷體">手機: </FONT><input type="text" style="font-size:25px" value="<?php echo $user_phone; ?>" name="user_phone"><FONT SIZE="6"COLOR="orange"FACE="標楷體">(例:0912345678)</FONT></p>
			<p><FONT SIZE="6"COLOR="orange"FACE="標楷體">生日: </FONT><input type="date" style="font-size:25px" value="<?php echo $user_birthday; ?>" name="user_birthday"></p>
			<p><FONT SIZE="6"COLOR="orange"FACE="標楷體">Email: <input type="text" style="font-size:25px" value="<?php echo $user_email; ?>" name="user_email">(abc@de.com，至多長度50位)</FONT></p>
			<p><FONT SIZE="6"COLOR="orange"FACE="標楷體">地址: <input type="text" style="font-size:25px" value="<?php echo $user_address; ?>" name="user_address" size="40">(至多長度100位)</FONT></p>
			
			<p><input type="submit" name="submit" value="註冊" style="width:120px;height:40px;font-size:25px;color:blue; margin-left:600px;margin-top:30px"></p>
			</form>
			<input type="button" value="回登入頁面" style="width:200px;height:40px;font-size:25px;color:blue;margin-left:600px;margin-top:35px" onclick=window.location.href='login.php'>
			<img src="photo/image/register/topic_1.jpg" width="600" height="600" style="margin-left:900px;margin-top:-400px"></a>
		
		</div>	

</body>
</html>
