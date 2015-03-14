<?php 
include_once("config.php");
include_once("users.php");
include_once("coman.php");
?>
<?php
	if(isset($_POST['register'])){
		$user = new Users;
		$user->login($_POST);
	}
?>

	<div class="container well">
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
			<div class="page-labels page-header">
		 		<h3><?php echo "Login"?></h3>
		 	</div>
			<form role="form" method="post" ENCTYPE="multipart/form-data">
				<div class="form-group">
			  		<span class="ui-corner-all ui-icon ui-icon-person" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
			 		<input type="text" class="form-control" id="exampleInputEmail1" name="email" placeholder="Username">
			  	</div>
			  	<span class="ui-corner-all ui-icon ui-icon-locked" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
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

<script type="text/javascript">

$(document).ready(function(){
	var counter = 2;

	$("#addButton").click(function () {

		if(counter>10){
		        alert("Only 10 textboxes allow");
		        return false;
		}   
	
		var newTextBoxDiv = $(document.createElement('div'))
		     .attr("id", 'TextBoxDiv' + counter);
		
		newTextBoxDiv.after().html('<label>Textbox #'+ counter + ' : </label>' +
		      '<input type="text" name="textbox' + counter + 
		      '" id="textbox' + counter + '" value="" >');
		
		newTextBoxDiv.appendTo("#TextBoxesGroup");
		
		
		counter++;
	});

 	$("#removeButton").click(function () {
		if(counter==1){
		      alert("No more textbox to remove");
		      return false;
		   }   
		
		counter--;
		
	    $("#TextBoxDiv" + counter).remove();
	
	});

 $("#getButtonValue").click(function () {

var msg = '';
for(i=1; i<counter; i++){
  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
}
      alert(msg);
 });
  });
</script>
<div id='TextBoxesGroup'>
<div id="TextBoxDiv1">
    <label>Textbox #1 : </label><input type='textbox' id='textbox1' >
</div>
</div>
<input type='button' value='Add Button' id='addButton'>
<input type='button' value='Remove Button' id='removeButton'>
<input type='button' value='Get TextBox Value' id='getButtonValue'>
