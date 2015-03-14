<?php
include_once("../config.php");
include_once("users.php");
include_once("../coman.php");
?>

<?php if(isset($_POST['password'])){
		$user=  new Users;
		$user->forgotPassword($_POST);
	}
?>
	<div class="container well">
	<div class="page-labels page-header">
	 <h3><?php echo "Password Reset"?></h3>
	 </div>
		<form role="form" method="post">
		  <div class="form-group">
		    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="email">
		  </div>
  			<button type="submit" class="btn btn-primary" name="password">Submit</button>
		</form>
	</div>
	</body>
</html>
