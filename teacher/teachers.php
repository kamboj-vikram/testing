<?php
error_reporting(E_ALL);
include_once("config.php");
include_once("../maleconfig.php");
session_start();
class Teachers{
	
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
			$add = $_POST['address'];
			$age = $_POST['age'];
			$sex = $_POST['sex'];
			$phone = $_POST['phone'];
			$qualification = $_POST['qualification'];
			echo $qualification;
			$confirm = $this->random();
			$_POST['confirm_key'] = $confirm;
			$setcode = $_POST['confirm_key'];
			$query = "INSERT INTO teachers(first_name,last_name,age,address,email,sex,phone,qualification,confirm_key)VALUES('$firstN','$lastN','$age','$add','$email','$sex','$phone','$qualification','$setcode')";
			if(mysql_query($query)){
				$tagLine = "Registration notification";
				$message  = 'Hi' ." ". " " .$uname.' <br> Thanks for creating an account with us. Click below to confirm your email address:<br>';
				$message .= '<a href = "localhost/confirmation.php?key='.$setcode.'"> localhost/confirmation.php?key='.$setcode.'</a><br>';
				$message .= 'in case, if link is not working then please copy and paste the link in your browser'.'<br>'; 
				$message .= 'Thanks';
					if(sendMale($email, '', '' ,$tagLine, $message)){
						$_SESSION['regis_sucess'] = "Registration sucessfull, please go to your email account and return our website by clicking confirmation link, without email confirmation you will unable to log in";
							header("Location:../student/login.php");
					}else{
						echo 'mail not send';
					}
			}else{
				echo "data not saved";
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
	
	
	public function allotedSubject($data){
		
		$t_id = $data['teacher_id'];
		$s_id = $data['sub_id'];
		$c_id = $data['class_id'];
		$sql = "INSERT INTO teacher_subjects(teacher_id,sub_id,class_id)VALUES('$t_id', '$s_id', '$c_id')";
		if(mysql_query($sql)or die(mysql_error())){
			echo json_encode(array("message"=> 'sucess'));
		}else{
			echo json_encode(array('message'=> 'fail'));
		}
		exit;
	} 
		
}