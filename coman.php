<?php 

//session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<link rel="stylesheet"  href="/css/bootstrap.css"/>
		<link rel="stylesheet"  href="/css/style.css"/>
		<link rel="stylesheet"  href="/css/jquery-ui.css"/>
		<link rel="stylesheet"  href="/css/bootstrap-datetimepicker.css"/>
		<script src="/js/jquery-1.9.1.js" language="javascript"></script>
		<script src="/js/jquery-ui-1.10.3.custom.js" language="javascript"></script>
		<script src="/js/bootstrap-datetimepicker.js" language="javascript"></script>
		<script src="/js/jquery.validate.js" language="javascript"></script>
		<script src="/js/bootstrap.js" language="javascript"></script>
		
		<script>
			$(document).ready(function(){
	         	$('div#success').delay(7000).fadeOut('slow');
	         	
	    	})
		</script>
		<style type="text/css" >
			.errorMsg{border:1px solid red; }
			.message{color: red; font-size:17px;}
			.regis{padding-top:10px;}
			.logoAbove{
				margin:5px 0px;
			}
			.navLinksTop{
				float:right !important;
				margin-top: 30px !important;
			}
		</style>
		
</head>
	<body>
	<div class="container">
	<?php 
		include_once('/nav.php');
	?>
		<div id="content">
			<div>
				<div id ="success">
				<?php 
					if(isset($_SESSION['regis_erro'])){ 
						echo "<p class='alert alert-danger erro'>".$_SESSION['regis_erro']."</p>";
						$_SESSION['regis_erro']=false;
					}
					if(isset($_SESSION['regis_sucess'])){ 
						echo "<p class='alert alert-success erro'>" .$_SESSION['regis_sucess']. "</p>" ;
						$_SESSION['regis_sucess']=false;
					}
					
					if(isset($_SESSION['File_size'])){ 
						echo "<p class='alert alert-danger erro'>".$_SESSION['File_size']."</p>";
						$_SESSION['File_size']=false;
					}
					if(isset($_SESSION['File_type'])){ 
						echo "<p class='alert alert-danger erro'>".$_SESSION['File_type']."</p>";
						$_SESSION['File_type']=false;
					}	
					if (isset($_SESSION['check'])) {
						if(!empty($_SESSION['check'])){
							echo "<p class='alert alert-success erro'>" .$_SESSION['check']. "</p>" ;
							$_SESSION['check'] = false;
						}
					}
					if(isset($_SESSION['Pass_confirmPass'])){
						if(!empty($_SESSION['Pass_confirmPass'])){
							echo "<p class='alert alert-success erro'>" .$_SESSION['Pass_confirmPass']. "</p>" ;
							$_SESSION['Pass_confirmPass'] = false;
						}
					}
				if(isset($_SESSION['profile_updated'])){ 
					if(!empty($_SESSION['profile_updated'])){
						echo "<p class='alert alert-success erro'>".$_SESSION['profile_updated']."</p>";
						$_SESSION['profile_updated'] = false;
					}
				}
				if(isset($_SESSION['regis_sucess'])){
					if(!empty($_SESSION['regis_sucess'] )){
						echo "<p class='alert alert-success erro'> ".$_SESSION['regis_sucess']."</p>";
						$_SESSION['regis_sucess']=false;
					}
				}
				if(isset($_SESSION['email'])){
				if(!empty($_SESSION['email'])){
					echo "<p class='alert alert-danger erro'> ".$_SESSION['email']."</p>";
					$_SESSION['email'] = false;
				}
			}
			
			if(isset($_SESSION['email_not'])){
				if(!empty($_SESSION['email_not'])){
					echo "<p class='alert alert-danger erro'> ".$_SESSION['email_not']."</p>";
					$_SESSION['email_not'] = false;
				}
			}
			if(isset($_Session['pass_reset'])){
				if(!empty($_SESSION['pass_reset'])){
					echo "<p class='alert alert-success erro'> ".$_Session['pass_reset']."</p>";
					$_Session['pass_reset']= false;
				}
			}
			?>
			</div>
			</div>
		</div>
</body>
<div id="footer">
</div>
</html>