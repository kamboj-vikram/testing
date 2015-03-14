<?php 
include_once('config.php');
include_once("coman.php");
?>
<?php
	include_once("config.php");
	$key = $_GET['key'];
	$query = mysql_query("SELECT * FROM teachers WHERE confirm_key='$key'")or die(mysql_error());
	$count = mysql_num_rows($query);
	$row = mysql_fetch_assoc($query);
	$id = isset($row['id']) ? $row['id']: '';
	if($count > 0){
		$query = mysql_query("UPDATE teachers SET confirm_key = '' WHERE id = '$id'")or die(mysql_error());
		$msg = "<div class='users well form'><p class='alert alert-success erro'> Email verified now you will be redirected to login page </p></div>";
	}else{
		$msg = "<div class='users well form'><p class='alert alert-danger erro'> Email not verified</p></div>";
	}
?>

<script>
	setTimeout("window.location = 'student/login.php'",5000);
 </script>
<div class="container well">
	<div id ="success">
		<?php echo isset($msg)? $msg : '';?>
	</div>
</div>
