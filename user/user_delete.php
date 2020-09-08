<?php

    $id = $_GET['id'];
	
	require_once('../../include/db_func.php');
	require_once('../../include/configure.php');
	$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

	
	$sql_query = "DELETE FROM phone_user WHERE id = $id";

    $result = querydb($sql_query, $db_conn);


    header("Location: user_index.php");
?>