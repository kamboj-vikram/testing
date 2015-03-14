<?php
	include_once("config.php");
	session_start();
	$id = $_POST['id'];
	$sql = mysql_query('SELECT * FROM users WHERE id = '.$id);
	$row = mysql_fetch_array($sql);
	$getStatus = $row['activated'];
	echo $getStatus; 
	
	if($getStatus == 1){
	$result = 0;
	}elseif($getStatus == 0){
	$result = 1;
	}
	$query = "UPDATE users SET activated = $result WHERE id = $id";
	$updateDb = mysql_query($query);
	if( mysql_query($query)){
	echo json_encode(array('message' => 'success','result' => $result));
	}else{
	echo json_encode(array('message' => 'fail'));
	}
	exit;
?>