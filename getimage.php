<?php
// ���{���]���ثe�u�Τ@�ӰѼƧY�i���o�Ӥ��A�]�����w���ü{�A�Ы�Ҧp���i�I
require_once("../include/gpsvars.php");
require_once("../include/configure.php");
require_once("../include/db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
$nowPhoneName = $_GET['nowPhoneName'];
$nowPhoneColor = $_GET['nowPhoneColor'];
if (!isset($nowPhoneName)) exit;
$sqlcmd = "SELECT * FROM Picture WHERE PhoneName='$nowPhoneName' AND color='$nowPhoneColor'";
$rs = querydb($sqlcmd, $db_conn);
if (count($rs)>0) {
    $ImageData = $rs[0]['photo'];
    $ImageType = $rs[0]['imagetype'];
    $FType = '.jpg';
    if ($ImageType == 'image/png') $FType = '.png';
    $filename = 'photo' . $nowPhoneName . $FType;
    header("Content-type: $ImageType \n");
    header("Content-Disposition: filename=$filename \n");
    echo $ImageData;
} 
?>