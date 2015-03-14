<?php 
include_once('config.php');
include_once('users.php');
include_once("coman.php");
?>
<?php 

	if(isset($_POST['register'])){
		$user = new Users;
		$user->register($_POST);
	}
?>
<div class="container well">
	<div id ="success">
		<?php
			if(isset($_SESSION['regis_erro'])){ 
				echo "<p class='alert alert-danger erro'>".$_SESSION['regis_erro']."</p>";
				$_SESSION['regis_erro']=false;
			}
			
			if(isset($_SESSION['File_size'])){ 
				echo "<p class='alert alert-danger erro'>".$_SESSION['File_size']."</p>";
				$_SESSION['File_size']=false;
			}
			if(isset($_SESSION['File_type'])){ 
				echo "<p class='alert alert-danger erro'>".$_SESSION['File_type']."</p>";
				$_SESSION['File_type']=false;
			}
		?>
	</div>
	<div class="page-labels page-header">
 		<h3><?php echo "User Registration"?></h3>
	</div>
	<?php /* span classes are used for adding text icon */ ?>
	<form role="form" method="post" ENCTYPE="multipart/form-data">
		<span class="ui-corner-all ui-icon ui-icon-person" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
		<div class="form-group">
	    	<input type="text" class="form-control" id="exampleInputEmail1" name="first_name" placeholder="First Name" value="<?php echo isset($fname) ? $fname : ''?>">
	    	<p class ="message"><?php echo isset($err_fname)? $err_fname : ''; ?></p>
	  	</div>
	  	
	  	<span class="ui-corner-all ui-icon ui-icon-person" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
	  	<div class="form-group">
	    	<input type="text" class="form-control" id="exampleInputEmail1" name="last_name" placeholder="Last Name" value="<?php echo isset($lname) ? $lname : ''?>">
	     		<p class = "message"><?php echo isset($err_lname)? $err_lname : ''; ?></p>
	  	</div>
	  	
	  	<span class="ui-corner-all ui-icon ui-icon-mail-closed" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
	  	<div class="form-group">
	    	<input type="email" class="form-control" id="exampleInputEmail1" name="email"  placeholder="Enter email" value="<?php echo isset($email) ? $email : ''?>">
	     	<p class = "message"><?php echo isset($err_email)? $err_email : ''; ?></p>
	  	</div>
	  	<span class="ui-corner-all ui-icon ui-icon-person" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
	  	<div class="form-group">
	   		<input type="username" class="form-control" id="exampleInputEmail1" name="username" placeholder="username" value="<?php echo isset($uname) ? $uname : ''?>">
	    	<p class = "message"><?php echo isset($err_name)? $err_name : ''; ?></p>
	  	</div>
	  	<span class="ui-corner-all ui-icon ui-icon-locked" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
	  	<div class="form-group">
	    	<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" value="<?php echo isset($pwd) ? $pwd : ''?>">
	     	<p class = "message"><?php echo isset($err_password) ? $err_password : ''; ?></p>
	  	</div>
	  		
	  	<span class="ui-corner-all ui-icon ui-icon-home" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
	  	<div class="form-group">
	    	<input type="text" class="form-control" id="exampleInputEmail1" name="address" placeholder="Address" value="<?php echo isset($address) ? $address : ''?>">
	     	<p class = "message"><?php echo isset($err_address)? $err_address : ''; ?></p>
	  	</div>
	  	<label for ="sex"> Gender</label>
		  	<div class="form-group">
			  	<input type="radio" name="sex" value="male"> Male<br>
				<input type="radio" name="sex" value="female"> Female
		  	</div>
		  <label for ="sex">Fruits you like </label></br>
		  <input type="checkbox" name="fruts[]" id ='selecctall'> Select All</br></br>
		  	<div class="form-group">
			  	<input type="checkbox" name="fruts[]" value="apple" class ='checkboxall'> Apple<br>
				<input type="checkbox" name="fruts[]" value="banana" class ='checkboxall'> Banana</br>
				<input type="checkbox" name="fruts[]" value="graps" class ='checkboxall'> graps<br>
				<input type="checkbox" name="fruts[]" value="orange" class ='checkboxall'> orange</br>
				<input type="checkbox" name="fruts[]" value="mango" class ='checkboxall'> mango<br>
				<input type="checkbox" name="fruts[]" value="sugar candy" class ='checkboxall'> sugar candy</br>
		  	</div>	
		  	<label>Select Department</label></br>
		  <select multiple name = "role[]"> 
			  <option value='admin'>Admin</option>
			  <option value='staff'>Staff</option>
			  <option value='hod'>HOD</option>
			  <option value='accounts'>Accounts</option>
			  <option value='gateStaff'>GateStaff</option>
			  <option value='student Rep'>Student Represntative</option>
		  </select>	
		  </br>
		   </br>
		    </br>
	  	<span class="ui-corner-all ui-icon ui-icon-contact" style="display:inline-block; display: inline-block;position: absolute;margin-top: 10px; margin-left: 4px;"></span>
	  	<div class="form-group">
	    	<input type="text" class="form-control" id="exampleInputEmail1" name="phone" placeholder="Phone Number" value="<?php echo isset($phone) ? $phone : ''?>">
	    	<p class = "message"><?php echo isset($err_phone)? $err_phone : ''; ?></p>
	  	</div>
	  	<div class="form-group">
	    	<label for="exampleInputFile">Profile Picture</label>
	     	<p class = "message"><?php echo isset($err_file)? $err_file : ''; ?></p>
	    	<input type="file" id="exampleInputFile" name="image" value="<?php echo isset($_FILES['file']['name']) ? $_FILES['file']['name'] : ''?>">
	  	</div>
  		<button type="submit" class="btn btn-primary" name="register">Submit</button>
	</form>
</div>
<script>

$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkboxall').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkboxall"               
            });
        }else{
            $('.checkboxall').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkboxall"                       
            });         
        }
    });
    
});

</script>