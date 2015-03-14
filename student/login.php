<?php 
//error_reporting(E_ALL);
include_once("../config.php");
include_once("users.php");
include_once("../coman.php");
?>
<?php
	if(isset($_POST['register'])){
		$user = new Users;
		$user->login($_POST);
	}
?>

		<div id ="success">
			<?php 
				if(isset($_SESSION['profile_delete_succ'])){
					if(!empty($_SESSION['login_succ_msg'] )){
						echo "<p class='alert alert-success erro'> ".$_SESSION['login_succ_msg']."</p>";
						$_SESSION['profile_delete_fail']=false;
					}
				}
				if(isset($_SESSION['pass_reset'])){
					if(!empty($_SESSION['pass_reset'])){
						echo "<p class='alert alert-success erro'> ".$_SESSION['pass_reset']."</p>";
						$_SESSION['pass_reset']=false;
					}
				}
				
				if(isset($_SESSION['regis_sucess'])){
					if(!empty($_SESSION['regis_sucess'] )){
						echo "<p class='alert alert-success erro'> ".$_SESSION['regis_sucess']."</p>";
						$_SESSION['regis_sucess']=false;
					}
				}
			?>
			<?php 
				if (isset($_SESSION['check'])) {
					if(!empty($_SESSION['check'])){
						echo "<p class='alert alert-danger'>" .$_SESSION['check']. "</p>" ;
						$_SESSION['check']= false;
					}
				}
				if(isset($_SESSION['vefiry'])){
					if(!empty($_SESSION['vefiry'])){
						echo "<p class='alert alert-danger'>" .$_SESSION['vefiry']. "</p>" ;
						$_SESSION['vefiry']= false;
					}
				}
				?>
			</div>
<div class="container-narrow">
      <hr>
      <div class="row-fluid marketing">
        <div class="span99">
        <h3 class="form-signin-heading">Please sign in</h3>
			<form role="form" method="post" ENCTYPE="multipart/form-data">
				<div class="form-group">
			 		<input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Username">
			  	</div>
			  	<div class="form-group">
			    	<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
			  	</div>
	  			<button type="submit" class="btn btn-primary mybutton" name="register">Submit</button>
	  			<div class ="regis">
			    	<a href ="registration.php" class="regis">Register</a>
			    </div>
			    <a href ="fogotPassword.php">Forgot Password?</a>
			</form>
		 </div>
      </div>

      <hr>
    </div>
<style>
	body{
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}
</style>




