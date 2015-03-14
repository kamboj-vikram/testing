<?php 
include_once('../config.php');
include_once('teachers.php');
include_once("../coman.php");
?>
<?php 

	if(isset($_POST['register'])){
		$user = new Teachers;
		$user->register($_POST);
	}
?>
<div class="users well form">
	<fieldset>
		<legend>
 			<h3><?php echo "Teacher Registration"?></h3>
		</legend>
		<form method="post" id="contact-form" ENCTYPE="multipart/form-data">
			<div class ="leftSide">
				<div class="form-group">
			    	<input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo isset($fname) ? $fname : ''?>">
			  	</div>
			  	
			  	<div class="form-group">
			    	<input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo isset($lname) ? $lname : ''?>">
			  	</div>
			  	
			  	<div class="form-group">
			    	<input type="email" class="form-control"  name="email"  placeholder="Enter email" value="<?php echo isset($email) ? $email : ''?>">
			  	</div>
			  	<div class="form-group">
			    	<input type="text" class="form-control" name="age" placeholder="age" value="<?php echo isset($pwd) ? $pwd : ''?>">
			  	</div>
			</div>
			<div class ="leftSide">
				
				<div class="form-group">
				    <select id="qua" name ="qualification"> 
				    <option selected="selected">Please select Qualification</option>
				    <option value="BCA">BCA</option>
				    <option value="MCA">MCA</option>
				    <option value="MA">MA</option>
				    <option value="BA">BA</option>
				    <option value="Other">Other</option>
				    </select>
				    <div id="Other" class="showother" style="display:none"><input name="qualification" placeholder="Qualification" id="textbox" type="text"></div>
	            </div>
				  	<div class="form-group">
				    	<input type="text" class="form-control"  name="address" placeholder="Address" value="<?php echo isset($address) ? $address : ''?>">
				  	</div>
				  	<div>Sex</div>
					<div class="radio" style ="margin-top: -20px;padding-left: 69px;">
						<input id="male" type="radio" name="sex" value="male">
						<label for="male">Male</label>
						<input id="female" type="radio" name="sex" value="female">
						<label for="female">Female</label>
				 	</div>
	
				  	<div class="form-group">
				    	<input type="text" class="form-control"  name="phone" placeholder="Phone Number" value="<?php echo isset($phone) ? $phone : ''?>">
				  	</div>
				 <button type="submit" class="btn btn-primary regis" name="register">Submit</button> 	
			</div>
		</form> 
	</fieldset>
</div>	
<style>
/*
label {
	display: inline-block;
	cursor: pointer;
	position: relative;
	padding-left: 25px;
	margin-right: 15px;
	font-size: 13px;
}
.wrapper {
	width: 500px;
	margin: 50px auto;
}
input[type=radio],
input[type=checkbox] {
	display: none;
}
label:before {
	content: "";
	display: inline-block;
	width: 16px;
	height: 16px;
	margin-right: 10px;
	position: absolute;
	left: 0;
	bottom: 1px;
	background-color: #aaa;
	box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
}

.radio label:before {
	border-radius: 8px;
}
input[type=radio]:checked + label:before {
    content: "\2022";
    color: #f3f3f3;
    font-size: 30px;
    text-align: center;
    line-height: 18px;
}
*/
.error{
 color:red;

}
</style>	
<script>
$(document).ready(function() {

	$('#qua').change(function(){ 
		que = $('#qua option:selected').text();
			if(que == 'Other'){
				$('.showother').show();
		    }else {
		      $('.showother').hide();
		    }
	  });
		
		
	$( "#contact-form" ).validate({
		rules: {
		'first_name' : {
			required:true,
		},
		'last_name' : {
			required:true,
		},
		'email' : {
			required:true,
		},
		'username' : {
			required:true,
		},
		'dob' : {
			required:true,
		},
		'phone' : {
			required:true,
		},
		'image' : {
			required:true,
		},
		'father_name' : {
			required:true,
		},
		'mother_name' : {
			required:true,
		}
	}
	});
	
 $(".form_datetime").datetimepicker({
	        format: "dd MM yyyy",
	        autoclose: true,
	        todayBtn: true
	 });
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
/*
	$('.regis').click(function(){
		var msg = "This is a required field."
 	    $(".error").each(function(){
				var inputs = $(this).val();
//				alert(inputs.length);
             	if(inputs == ""){
                 	$(this).addclass('errors')
                 	$(this).next().html("ASS");
             	}
 	    });
 	   	return false;
 	});
	$('.error').blur(function () {
        		$(this).next().html("This is a required field.").hide();
	});*/      
});

</script>