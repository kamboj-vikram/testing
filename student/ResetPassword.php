<?php
include_once("../config.php");
include_once("users.php");
include_once("../coman.php");
 ?>
 <?php
 	 if(isset($_POST['Resetpassword'])){
		$user=  new Users;
		$user->resetPassword($_POST);
	}
?>
<div class="container well">
	<div class="page-labels page-header">
		<h3><?php echo "Change Password"?></h3>
	 </div>
	<form role="form" method="post">
	<span class="ui-corner-all ui-icon ui-icon-locked" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
		<div class="form-group">
	    	<input type="password" class="form-control" id="exampleInputEmail1" name="newpassword" placeholder="Password">
	  	</div>
	  	<span class="ui-corner-all ui-icon ui-icon-locked" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
	  	<div class="form-group">
	    	<input type="password" class="form-control" id="exampleInputEmail1" name="confirmpassword" placeholder="Confirm password">
	  	</div>
	  	<button type="submit" class="btn btn-primary" name="Resetpassword">Submit</button>
	</form>
</div>
