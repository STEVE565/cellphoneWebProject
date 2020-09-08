<?php

    $Seqno = $_GET['Seqno'];
	
	require_once('../../include/db_func.php');
	require_once('../../include/configure.php');
	$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

	
	$sql_query = "DELETE FROM Phone WHERE Seqno = $Seqno";

    $result = querydb($sql_query, $db_conn);


    header("Location: phone_index.php");
?>