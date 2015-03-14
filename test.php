<?php 
//error_reporting(E_ALL ^ E_DEPRECATED);
  include_once("config.php");
		$name = $_POST['name'];
		$Cmt = $_POST['cmt_id'];
		$comment = isset($_POST['comment'])? $_POST['comment']: '';
		$reply_Comment = isset($_POST['reply_to_comment']) ? $_POST['reply_to_comment'] : '';
		if(isset($Cmt) && !empty($Cmt)){
			$qry = "UPDATE comments SET reply_to_comment = '$reply_Comment' ,rpl_name = '$name' WHERE id = '$Cmt'";		
			$process = mysql_query($qry);
			echo json_encode(array('message' => 'sucess'));
		}else{
			$date = date('Y/m/d H:i:s');
			$qry = "INSERT INTO comments(name,comment,dated)VALUES('$name','$comment','$date')";
			$result = mysql_query($qry);
			echo json_encode(array('message' => 'sucess'));
		}
//		if($result){
			//echo json_encode(array('message' => $commt));
//		}else{
//			echo json_encode(array('data' =>'fail'));
//		}










?>