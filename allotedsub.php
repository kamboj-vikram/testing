<?php
	include_once("config.php");
	include_once("teacher/teachers.php");
   $data = $_POST; // print_r( $_POST ); to check the data
   $obj = new Teachers();
   $result = $obj->allotedSubject($data);
	echo $result;
?>