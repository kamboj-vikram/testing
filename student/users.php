<?php
error_reporting(E_ALL);
include_once("config.php");
include_once("../maleconfig.php");
session_start();
class Users{
	
	public function random(){
		$length = 15;
		$password = "";
		$i = 0;
		$possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		while ($i < $length){
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			if (!strstr($password, $char)) {
				$password .= $char;
				$i++;
			}
		}
		return $password;
	}
	function register(){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$firstN = $_POST['first_name'];
			$lastN = $_POST['last_name'];
			$email = $_POST['email'];
			$uname = $_POST['username'];
			$pwd = $_POST['password'];
			$dob = $_POST['dob'];
			$add = $_POST['address'];
			//$sex = $_POST['sex'];
			$phone = $_POST['phone'];
			$fname = $_POST['father_name'];
			$mname = $_POST['mother_name'];
			$femail = $_POST['femail'];
			$occup = $_POST['occupation'];
			$fphone = $_POST['fphone'];
			$confirm = $this->random();
			$_POST['confirm_key'] = $confirm;
			$setcode = $_POST['confirm_key'];
			$file = isset($_FILES['image']['name']) ? $_FILES['image']['name']:"";
			$fileType = isset($_FILES['image']['type']) ?  $_FILES['image']['type']: "";
			$fileTemp = isset($_FILES['image']['tmp_name'])? $_FILES['image']['tmp_name'] : "";
			isset($_FILES['image']['error']);
			$file_upload="true";
			$file_up_size= isset($_FILES['image']['size']) ? $_FILES['image']['size'] : "";
			$password = md5($pwd);
		 	if (isset($_FILES['image']['size']) >250000){
				$_SESSION['File_size'] = "Your uploaded file size is more than 250KB
	 						so please reduce the file size and then upload.<br>";
				$file_upload = "false";
			}
	
			$file_name= isset($_FILES['image']['name'])? $_FILES['image']['name']:"";
			$addFile="../upload/$file_name"; 
			$file = isset($_FILES['image']['name'])? $_FILES['image']['name'] :"";
			if(move_uploaded_file($fileTemp, $addFile)){
				$query = "INSERT INTO students(first_name,last_name,address, username ,email, phone, password ,dob ,father_name , mother_name , femail ,occupation ,fphone ,confirm_key)VALUES('$firstN','$lastN','$add','$uname','$email','$phone','$password','$dob','$fname','$mname','$femail','$occup','$fphone','$setcode')";
				if(mysql_query($query)){
					$lastId = mysql_insert_id();
					$imageQuery = "INSERT INTO images(stu_id,image) VALUES('$lastId', '$file')";
					mysql_query($imageQuery);
					$tagLine = "Registration notification";
					$message  = 'Hi' ." ". " " .$uname.' <br> Thanks for creating an account with us. Click below to confirm your email address:<br>';
					$message .= '<a href = "localhost/confirmation.php?key='.$setcode.'"> localhost/confirmation.php?key='.$setcode.'</a><br>';
					$message .= 'in case, if link is not working then please copy and paste the link in your browser'.'<br>'; 
					$message .= 'Thanks';
						if(sendMale($email, '', '' ,$tagLine, $message)){
							$_SESSION['regis_sucess'] = "Registration sucessfull, please go to your email account and return our website by clicking confirmation link, without email confirmation you will unable to log in";
								header("Location:login.php");
						}else{
							echo 'mail not send';
						}
				}else{
					echo "data not saved";
				}
			}
		}
	}
	
	function login(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$umail = $_POST['username'];
			$pwd = $_POST['password'];
			$password = md5($pwd);
			$sql = "SELECT * FROM students WHERE username = '$umail' and password = '$password'";
			$result = mysql_query($sql) or die ( mysql_error() );
			$result = mysql_query($sql);
			$userData = mysql_fetch_assoc($result);
			if(mysql_num_rows($result) == 0){
					$_SESSION['check'] = "Wrong username password";
				}else if($userData['confirm_key'] !=""){
					 $_SESSION['vefiry'] = "You haven't verify you email address. please verify your email address for login";
				}else{
					$_SESSION['sess_id'] = $userData['id'];
					$_SESSION['sess_username'] = $userData['username'];
					session_write_close();
					header('Location:view.php');
				}	
		}	
	}
	
public function forgotPassword(){
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$email = $_POST['email'];
			if($email == ""){
				$_SESSION['email']= "Please enter valid email";	
			}else{
				$confirm = $this->random(); 
				//$_POST['verifycode'] = $confirm;
				//$setcode = $_POST['verifycode'];
				$email = $_POST['email'];
				$sql="SELECT * FROM students WHERE email='$email'";
				$result=mysql_query($sql);
				$userData = mysql_fetch_assoc($result);
				$id = $userData['id'];
				if(mysql_num_rows($result) == 0){
					$_SESSION['email_not'] = "Email id does not belongs to any account";
				}else{
					$query = ("UPDATE students SET passkey = '$confirm' WHERE id = '$id'");
					$result = mysql_query($query) or die(mysql_error());
//					$mail->Subject = 'Password Reset';
					$tagLine = "Registration notification";
					$message = 'Click below to reset your password <br>';
					$message .= '<a href = "localhost/student/ResetPassword.php?key='.$confirm.'&email='.$email.'"> localhost/student/ResetPassword.php?key='.$confirm.'&email='.$email.'</a><br>';
					$message .= 'Thanks';
						if(sendMale($email, '', '' ,$tagLine, $message)){
							$_SESSION['pass_reset'] = "Password reset link has been sent to your email id, please click on link to reset your password";
							header("Location:login.php");
						}	
					}
			
				} 
			}
		}
		
		public function resetPassword(){
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
				$newpwd =   mysql_real_escape_string($_POST['newpassword']);
				$confirmpwd =   mysql_real_escape_string($_POST['confirmpassword']);
				if($newpwd == "" && $confirmpwd ==""){
					$_SESSION['Pass_confirmPass'] = "Please enter password";
				}elseif($newpwd != $confirmpwd){
					$_SESSION['check'] = "Password / Confirm password doesn't match";
				}else{
					$email = $_GET['email'];
					$passkey = $_GET['key'];
					$_POST['password'] = $newpwd;
					$password = md5($_POST['password']);
					$sql = "SELECT * FROM students WHERE email='$email'";
					$result = mysql_query($sql) or die(mysql_error());
					if(mysql_num_rows($result) > 0){
						$query = ("UPDATE students SET password = '$password' , passkey = '' WHERE email='$email'");
						$result = mysql_query($query);
						header("Location:login.php");
					}
				}
			}
		}
	
	
	
	
	
	
	
		
}