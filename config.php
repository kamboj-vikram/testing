<?php
		$dbname = "test" ;
		$host = "localhost";
		$username = "root";
		$password = "";
		$conn = mysql_connect($host,$username,$password) or die ('Error Connecting to mysql');
         mysql_select_db($dbname);
		//$con = mysqli_con( , $dbname , $username,);
?>
		