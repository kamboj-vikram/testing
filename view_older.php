<?php
	include_once("config.php");
	include_once("coman.php");
	session_start();
?>
<div class="users well index">
	<h2><?php echo __('Users'); ?></h2>
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
			<th class="actions well"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($users as $user): ?>
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
					    <td><a href ='map.php?address="<?php echo $row['address'];?>"'>click here</a></td>
					    <td><?php echo isset($row['phone'])? $row['phone'] :''?></td>
					    <?php 
						 if (strpos($row['image'],'.pdf') !== false) {
					    		echo "<td><a href ='downloadPdf.php?name=".$row['image']."'><img src='upload/download.jpg"." ' width='77' height='65' /></a></td>";
							}else{
								echo "<td><img src='upload/".(isset($row['image']) ? $row['image'] : '')."' width='77' height='65' /></td>";
							}
							$frts = explode(',',$row['fruts']);
							$role = explode(',',$row['role']);
							?>   
					   	<td> 
					   		<div class="form-group">
							  	<input type="checkbox" name="fruts[]" <?php if(in_array('apple',$frts)){?> checked = "checked" <?php }?> value="apple" class ='checkboxall' disabled="disabled"> Apple<br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('banana',$frts)){?> checked = "checked" <?php }?>value="banana" class ='checkboxall' disabled="disabled"> Banana</br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('graps',$frts)){?> checked = "checked" <?php }?>value="graps" class ='checkboxall' disabled="disabled"> graps<br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('orange',$frts)){?> checked = "checked" <?php }?>value="orange" class ='checkboxall' disabled="disabled"> orange</br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('mango',$frts)){?> checked = "checked" <?php }?>value="mango" class ='checkboxall' disabled="disabled"> mango<br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('suger candy',$frts)){?> checked = "checked" <?php }?> value="sugar candy" class ='checkboxall' disabled="disabled"> sugar candy</br>
					  		</div>
					  	</td>	
					  	<td><?php echo isset($row['role'])? $row['role'] :''?></td>
					   <td>
						   <?php 
					        	if($row['activated'] == 1) {?>
									<a href =""  id = <?php echo $row['id'];?> class="act"> Decline </a>
							<?php } else {?>
									<a href =""  id = <?php echo $row['id'];?> class="act"> Approve </a>
								<?php }
					        ?> 
					    <td>
					    	<a href ="update.php?id=<?php echo $userData['id']?>">Update</a> 
					    	<a href ="delete.php?id=<?php echo $userData['id']?>">Delete</a>
						</td>    
			    </tr>
			   <?php }?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	
	
	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions well">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
</div>




<?php
	$num_rec_per_page = 3;
	if (isset($_GET["page"])) {
		$page  = $_GET["page"]; 
	 } else { 
		$page=1; 
	 }; 
	$start_from = ($page-1) * $num_rec_per_page; 
	echo $start_from;
	$sql = "SELECT * FROM users LIMIT $start_from, $num_rec_per_page";
	$result = mysql_query($sql);
	if(!$result){
  		die('Could not get data: ' . mysql_error());
	}
?>
		<div class="container well">
			<div class="page-labels page-header">
		 		<h3><?php echo "User Details"?></h3>
			</div>
			<table class="table table-bordered">
			    <tr>
			    	<th>
			    		<?php echo "id" ?>
			    	</th>
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
			    		<?php echo "Address on Map" ?>
			    	</th>
			    	<th>
			    		<?php echo "Phone" ?>
			    	</th>
			    	<th>
			    		<?php 
			    		echo "Profile picture" ?>
			    	</th>
			    	<th>
			    		<?php 
			    		echo "Fruits" ?>
			    	</th>
			    	
			    	<th>
			    		<?php 
			    		echo "Role" ?>
			    	</th>
			    	<th>
			    		<?php echo "Status" ?>
			    	</th>
	
			    	<th>
			    		<?php echo "Action" ?>
			    	</th> 
			    </tr>
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
					    <td><a href ='map.php?address="<?php echo $row['address'];?>"'>click here</a></td>
					    <td><?php echo isset($row['phone'])? $row['phone'] :''?></td>
					    <?php 
						 if (strpos($row['image'],'.pdf') !== false) {
					    		echo "<td><a href ='downloadPdf.php?name=".$row['image']."'><img src='upload/download.jpg"." ' width='77' height='65' /></a></td>";
							}else{
								echo "<td><img src='upload/".(isset($row['image']) ? $row['image'] : '')."' width='77' height='65' /></td>";
							}
							$frts = explode(',',$row['fruts']);
							$role = explode(',',$row['role']);
							?>   
					   	<td> 
					   		<div class="form-group">
							  	<input type="checkbox" name="fruts[]" <?php if(in_array('apple',$frts)){?> checked = "checked" <?php }?> value="apple" class ='checkboxall' disabled="disabled"> Apple<br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('banana',$frts)){?> checked = "checked" <?php }?>value="banana" class ='checkboxall' disabled="disabled"> Banana</br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('graps',$frts)){?> checked = "checked" <?php }?>value="graps" class ='checkboxall' disabled="disabled"> graps<br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('orange',$frts)){?> checked = "checked" <?php }?>value="orange" class ='checkboxall' disabled="disabled"> orange</br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('mango',$frts)){?> checked = "checked" <?php }?>value="mango" class ='checkboxall' disabled="disabled"> mango<br>
								<input type="checkbox" name="fruts[]" <?php if(in_array('suger candy',$frts)){?> checked = "checked" <?php }?> value="sugar candy" class ='checkboxall' disabled="disabled"> sugar candy</br>
					  		</div>
					  	</td>	
					  	<td><?php echo isset($row['role'])? $row['role'] :''?></td>
					   <td>
						   <?php 
					        	if($row['activated'] == 1) {?>
									<a href =""  id = <?php echo $row['id'];?> class="act"> Decline </a>
							<?php } else {?>
									<a href =""  id = <?php echo $row['id'];?> class="act"> Approve </a>
								<?php }
					        ?> 
					    <td>
					    	<a href ="update.php?id=<?php echo $userData['id']?>">Update</a> 
					    	<a href ="delete.php?id=<?php echo $userData['id']?>">Delete</a>
						</td>    
			    </tr>
			    <?php }
			    ?>	
			</table>
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