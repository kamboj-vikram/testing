<?php
session_start();
include_once("../config.php");
include_once("../coman.php");
if (!isset($_SESSION['sess_id']) || empty($_SESSION['sess_id'])){
    	header('Location:login.php');
}else{
?>
<div class="users well index">
	<h2><?php echo 'Users'; ?></h2>
	<table cellpadding="0" cellspacing="0" class ="table table-striped table-bordered table_header">
		<tr>
			<th><?php echo "id" ?></th>
	    	<th>
	    		<?php echo "First Name" ?>
	    	</th>
	    	<th>
	    		<?php echo "Last Name" ?>
	    	</th>
	    	<th>
	    		<?php echo "Email" ?>
	    	</th>
	    	<th>
	    		<?php echo "Username" ?>
	    	</th>
	    	<th>
	    		<?php echo "Address" ?>
	    	</th>
	    	<th>
	    		<?php echo "Phone" ?>
	    	</th>
	    	
	    	<th>
	    		<?php echo "Action" ?>
	    	</th> 
		</tr>
	<?php
		$num_rec_per_page = 3;
		if (isset($_GET["page"])) {
			$page  = $_GET["page"]; 
		 } else { 
			$page=1; 
		 } 
		$start_from = ($page-1) * $num_rec_per_page; 
		$sql = "SELECT * FROM students LIMIT $start_from, $num_rec_per_page";
		$result = mysql_query($sql);
		if(!$result){
	  		die('Could not get data: ' . mysql_error());
		}
	?>
		<tr>
			<?php 
				while($row = mysql_fetch_array($result)) {
				     ?>
				     	<td><?php echo $row['id'] ?></td>
					    <td><?php echo isset($row['first_name']) ? $row['first_name'] :''?></td>
					    <td><?php echo isset($row['last_name']) ? $row['last_name'] : '' ?></td>
					    <td><?php echo isset($row['email']) ? $row['email'] : '' ?></td>
					    <td><?php echo isset($row['username']) ? $row['username'] : ''?></td>
					    <td><?php echo isset($row['address']) ? $row['address'] :''?></td>
					    <td><?php echo isset($row['phone'])? $row['phone'] :''?></td>
					    <?php /*
					   <td>
						   <?php 
					        	if($row['activated'] == 1) {?>
									<a href =""  id = <?php echo $row['id'];?> class="act"> Decline </a>
							<?php } else {?>
									<a href =""  id = <?php echo $row['id'];?> class="act"> Approve </a>
								<?php }
					        ?> 
					    </td>
					    */ ?>
					    <td>
					    	<a href ="update.php?id=<?php echo $row['id']?>">Update</a> 
					    	<a href ="delete.php?id=<?php echo $row['id']?>">Delete</a>
						</td>    
			    </tr>
			   <?php }?>
			   
	</table>

	<div class="paging">
		<?php 
			$sql = "SELECT * FROM students"; 
			$rs_result = mysql_query($sql); //run the query
			$total_records = mysql_num_rows($rs_result);  //count number of records
			$total_pages = ceil($total_records / $num_rec_per_page); 
			echo "<a href='view.php?page=1'>".'|<'."</a> "; // Goto 1st page  
			for ($i=1; $i<=$total_pages; $i++) { 
				echo "<a href='view.php?page=".$i."'>".$i."</a> "; 
			}; 
			echo "<a href='view.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
			?>
	<?php }?>
	</div>
</div>
<div class="actions well">
	<?php include_once('../sidebar.php')?>
</div>
<div class="users well index">
<?php 
		$id = mysql_insert_id();
		if(isset($id) && !empty($id)){
		$query = "SELECT id ,name,comment FROM comments WHERE id = '$id'";
	}else{
		$query = "SELECT * FROM comments LIMIT 10";
	}
	$val = mysql_query($query)or die(mysql_error());
	 $atradinghours = array();
	while($data = mysql_fetch_assoc($val)){?>
	<div class="textCommt" style="width:100%;height:90px;background:white;margin-bottom:15px;">
		<p style ="margin-left:10px;"><?php echo $data['comment'];?></p>
		<div class ="comment">
			<a href="#" id ="reply" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" comment_id = <?php echo $data['id']?> name="reply-to"  style="margin-top:36px; margin-left: 10px;float: left;">
				Reply-to</a>
		</div>
	</div>
	<?php
	}
	 
	?>
 <h3 class="form-signin-heading">Leave the Comment</h3>
			<form role="form" method="post" ENCTYPE="multipart/form-data" class ="reply-to">
				<input type ="hidden" class="hdnId" name="cmt_id"></input>
				<div class="form-group">
			 		<input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Name">
			  	</div>
			  	<div class="form-group">
			  	<textarea rows="6" cols="50" class="form-control" id="exampleInputComment" name="comment" placeholder="Comment"></textarea>
			  	</div>
	  			<button type="submit" class="btn btn-primary mybutton" name="register">Submit</button>
			</form>
		 </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      <form role="form" method="post"  ENCTYPE="multipart/form-data" class ="reply-to-comment">
				<input type ="hidden" class="hdnId" name="cmt_id"></input>
				<div class="form-group">
			 		<input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Name">
			  	</div>
			  	<div class="form-group">
			  	<textarea rows="6" cols="50" class="form-control" id="exampleInputComment" name="reply_to_comment" placeholder="Comment"></textarea>
			  	</div>
			  	
	  			<button type="submit" class="btn btn-primary mybuttonCOM" name="register" data-toggle="modal" data-target="#reply-to">Submit</button>
			</form>
      </div>
    </div>
  </div>
</div>
</div>

<style text ="text/css">
a.stu_info{
color:blue;
margin-left:-25px;

}
.logout{
	float:right;
	margin-top:-39px;
	margin-right: 95px;
}
a.log{
 color:white;
 text-decoration:none;
}
a.log :hover{
 color:white;
}
#blogs{
margin-left:30px;

}
</style>
<?php $replyToComment = "reply_to_comment";?>
<script>
    $(document).ready(function(){
        
    	$('a#reply').click(function(){
    		//commt = '<?php echo $replyToComment;?>';
    		var cmtId = $(this).attr('comment_id');
    		alert(cmtId);
//    		var reply = $(this).attr('name');
//    		if(reply != undefined){
//				$('#exampleInputComment').attr('name' ,commt);
				$('.hdnId').attr('value' ,cmtId);
//    		}			
    	});	


    	$('.mybutton').click(function(){
			var data = $('.reply-to').serialize();
			$.ajax({
				type :"POST",
				url: "../test.php", 
				 data: data,
				 dataType :'JSON',
			      success: function(data){
					alert(data);
			      	if(data.message == "sucess"){
						window.location.reload(true);
			      	}
				},
			  });
			  return false;
		});

    	$('.mybuttonCOM').click(function(){
			var data = $('.reply-to-comment').serialize();
			$.ajax({
				type :"POST",
				url: "../test.php", 
				 data: data,
				 dataType :'JSON',
			      success: function(data){
			      	if(data.message == "sucess"){
			      		$('#myModal').modal('hide');
			      	}
				},
			  });
			  return false;
		});
			
        
    	$( "#accordion").accordion();
    	$('#success').delay(3000).fadeOut('slow');
		$('.act').click(function(){
			var temp = $(this);
			var uid = $(this).attr("id");
			$.ajax({
				type :"POST",
				url: "changeStatus.php",
                data : {'id':uid}, 
                success: function(data){
                	var response = JSON.parse(data);
    				if(response['message'] == "SUCCESS") {
    					if(response['status'] == 0){
    						temp.text("Approve");
    					} else {
    						temp.text("Decline");
    					}
    				} else {
    					alert("Some Unexpected Error occur");
    				}
				},       
			});			

		});
    	
    });
</script>
