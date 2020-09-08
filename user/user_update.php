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
				background-color:#2980B9;
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
	require_once('../../include/db_func.php');
	require_once('../../include/configure.php');
	$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);


 $id = $_GET['id'];
 
 //請注意，這邊因為 $userID 本身是 integer，所以可以不用加 ''
 $sql_getDataQuery = "SELECT * FROM phone_user WHERE id = $id";

 //$result = mysqli_query($db_link, $sql_getDataQuery);
 $result = querydb($sql_getDataQuery, $db_conn);
 
 //$row_result = @mysqli_fetch_assoc($result);
 //$row_result = updatedb($result, $conn);
 foreach($result as $row_result){
	$user_name = $row_result['user_name'];   //抓出已知Seqno
	$user_password = $row_result["user_password"];
	$user_birthday = $row_result['user_birthday'];
	$user_phone = $row_result['user_phone'];
	$user_email = $row_result['user_email'];
	$user_address = $row_result["user_address"];
	
 }

 
?>
<?php
(isset($_POST['Brand']))?$select_check = $_POST['Brand']:$select_check = $Brand;  //輔助查詢下拉式保留(品牌)

?>
<?php
 if (isset($_POST["action"]) && $_POST["action"] == 'update') {

    $new_user_name = $_POST['user_name'];
	$new_user_password = $_POST['user_password'];
    $new_user_birthday = $_POST['user_birthday'];
    $new_user_phone = $_POST['user_phone'];
	$new_user_email = $_POST['user_email'];
	$new_user_address = $_POST['user_address'];
	
	$judge_phone2=0;   //手機格式判斷
	 $size_num = strlen($new_user_phone);
	 if($size_num!=10) $judge_phone2=1; //小於10位數
	//if($size_num>10) $judge_phone2=1; 
	//echo $Phone."長度".$size_num."</br>"; 
	 $fdb=preg_split('//', $new_user_phone, -1, PREG_SPLIT_NO_EMPTY);

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
	$long_name=strlen($new_user_name);  //名字超過20長度
	if($long_name>20){
		$new_user_name=mb_substr($new_user_name, 0, 20);
		$judge_name=1;
		//echo "名字長度超過，以協助截短，請確認";
	}
	$long_phone=strlen($new_user_phone);  //電話超過10長度
	if($long_phone>10){
		$new_user_phone=mb_substr($new_user_phone, 0, 10);
		$judge_phone3=1;
		//echo "電話長度超過，以協助截短，請確認";
	}
	$long_password=strlen($new_user_password);  //密碼超過20長度
	if($long_password>20){
		$new_user_password=mb_substr($new_user_password, 0, 20);
		$judge_password=1;
		//echo "密碼長度超過，以協助截短，請確認";
	}
	$long_email=strlen($new_user_email);  //email超過50長度
	if($long_email>50){
		$new_user_email=mb_substr($new_user_email, 0, 50);
		$judge_email=1;
		
	}
	$long_address=strlen($new_user_address);  //地址超過100長度
	if($long_address>100){
		$new_user_address=mb_substr($new_user_address, 0, 100);
		$judge_address=1;
		
	}
	$via_email=0;
	if(!filter_var($new_user_email, FILTER_VALIDATE_EMAIL))
	{
	//echo("E-mail is not valid");
	$via_email=1;
	 //echo $via_email; 
	}
	
	if(isset($new_user_name)&&isset($new_user_password)&&isset($new_user_birthday)&&isset($new_user_phone)&&isset($new_user_email)&&isset($new_user_address)&& !empty($new_user_name)&& !empty($new_user_password)&& !empty($new_user_birthday)&& !empty($new_user_phone)&& !empty($new_user_email)&& !empty($new_user_address)){

		$pattern = '/[\x80-\xff]./';
		 
		$token = strtok($new_user_birthday, "-");
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
		if((preg_match($pattern,$new_user_name))||(preg_match($pattern,$new_user_password))||($differ_y<0)||(($differ_y==0)&&($differ_m<0))||(($differ_y==0)&&($differ_m==0)&&($differ_d<0))||($judge_name==1)||($judge_password==1)||($judge_phone3==1)||($judge_phone2==1)||($judge_email==1)||($via_email==1)||($judge_address==1)){
		//if(($differ_y<0)||($differ_m<0)||($differ_d<0)){
		//echo "有進判斷1";
		
			if(preg_match($pattern,$new_user_name)){
			   echo "<script type='text/javascript'>alert('使用者名稱不可有中文字!!');</script>";
			   //header("refresh:0;url=signup.html");
			   //echo "使用者名稱不可有中文字".$user_name;
			}
			if(preg_match($pattern,$new_user_password)){
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
			$encode_password = sha1($new_user_password);
			$q="insert into phone_user(id,user_name,new_user_password,user_birthday,user_phone,user_email,user_address) values (null,'$new_user_name','$encode_password','$new_user_birthday','$new_user_phone','$new_user_email','$new_user_address')";//向資料庫插入表單傳來的值的sql
			 //$reslut=mysqli_query($con1,$q);//執行sql
			$reslut= querydb($q,$db_conn); 

			header('Location: user_index.php');
		}
		
		
	 
	}
	
     

	else{
		if(empty($new_user_name)){
			 echo "<script type='text/javascript'>alert('使用者名稱不可空白!!');</script>";
		}
		if(empty($new_user_password)){
			 echo "<script type='text/javascript'>alert('密碼不可空白!!');</script>";
		}
		if(empty($new_user_birthday)){
			 echo "<script type='text/javascript'>alert('生日不可空白!!');</script>";
		}
		if(empty($new_user_phone)){
			 echo "<script type='text/javascript'>alert('手機不可空白!!');</script>";
		}
		if(empty($new_user_email)){
			 echo "<script type='text/javascript'>alert('Email不可空白!!');</script>";
		}
		if(empty($new_user_email)){
			 echo "<script type='text/javascript'>alert('地址不可空白!!');</script>";
		}
	}
     
 }
 ?>
 <html>

 <head>
     <meta charset="UTF-8" />
     <title>懂你的手機購物網站--修改使用者資料</title>
 </head>
 <body>
 
 <div id="Body">
 			<div id="Set_initial" > 
			歡迎使用懂你的手機購物網站--修改使用者資料
			</div>
	 <div class="", id="Set_body_process">
	 <form action="" method="post" name="formAdd" id="formAdd">
<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-->
		<p><FONT SIZE="6"COLOR="green"FACE="標楷體">使用者名稱:<input type="text" style="font-size:25px" value="<?php echo $user_name; ?>" name="user_name">(不可為中文，至多長度20位)</FONT></p>
		<p><FONT SIZE="6"COLOR="green"FACE="標楷體">密碼: <input type="text" style="font-size:25px"  name="user_password">(至多長度20位，須重設定)</FONT></p>
		<p><FONT SIZE="6"COLOR="green"FACE="標楷體">手機: </FONT><input type="text" style="font-size:25px" value="<?php echo $user_phone; ?>" name="user_phone"><FONT SIZE="6"COLOR="green"FACE="標楷體">(例:0912345678)</FONT></p>
		<p><FONT SIZE="6"COLOR="green"FACE="標楷體">生日: </FONT><input type="date" style="font-size:25px" value="<?php echo $user_birthday; ?>" name="user_birthday"></p>
		<p><FONT SIZE="6"COLOR="green"FACE="標楷體">Email: <input type="text" style="font-size:25px" value="<?php echo $user_email; ?>" name="user_email">(abc@de.com，至多長度50位)</FONT></p>
		<p><FONT SIZE="6"COLOR="green"FACE="標楷體">地址: <input type="text" style="font-size:25px" value="<?php echo $user_address; ?>" name="user_address" size="40">(至多長度100位)</FONT></p>	 
		 
		 
		 
		 <input type="hidden" name="action" value="update">
		 <input type="submit" name="button" value="修改資料" style="width:120px;height:50px;font-size:20px;color:blue; position:relative; left:100px; top: 50px;">
	 </form>
	  </div>
 </div>
 </body>
 </html>