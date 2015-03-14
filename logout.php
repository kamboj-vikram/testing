<?php
	session_start();
	if (isset($_SESSION['sess_id'])) {
   		session_destroy();
	} 
	header("Location:student/login.php");
?>