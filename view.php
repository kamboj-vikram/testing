<?php
	include_once("config.php");
	include_once("coman.php");
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
	    		<?php echo "Status" ?>
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
		$sql = "SELECT * FROM users LIMIT $start_from, $num_rec_per_page";
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
					   <td>
						   <?php 
					        	if($row['activated'] == 1) {?>
									<a href =""  id = <?php echo $row['id'];?> class="act"> Decline </a>
							<?php } else {?>
									<a href =""  id = <?php echo $row['id'];?> class="act"> Approve </a>
								<?php }
					        ?> 
					    </td>
					    <td>
					    	<a href ="update.php?id=<?php echo $userData['id']?>">Update</a> 
					    	<a href ="delete.php?id=<?php echo $userData['id']?>">Delete</a>
						</td>    
			    </tr>
			   <?php }?>
	</table>

	<div class="paging">
		<?php 
			$sql = "SELECT * FROM users"; 
			$rs_result = mysql_query($sql); //run the query
			$total_records = mysql_num_rows($rs_result);  //count number of records
			$total_pages = ceil($total_records / $num_rec_per_page); 
			echo "<a href='view.php?page=1'>".'|<'."</a> "; // Goto 1st page  
			for ($i=1; $i<=$total_pages; $i++) { 
				echo "<a href='view.php?page=".$i."'>".$i."</a> "; 
			}; 
			echo "<a href='view.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
			?>
	
	</div>
</div>
<div class="actions well">
	<h3><?php echo 'Actions'; ?></h3>
	<ul>
		<li><a href ="users.php/register">New User</a></li>
		<li><a href ="users.php/register">Student details</a> </li>
		<li><a href ="users.php/register">Student Reports</a></li>
		<li><a href ="users.php/register">Student Attendence</a></li>
	</ul>
</div>
<style text ="text/css">
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
<script>
    $(document).ready(function(){
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