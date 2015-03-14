<?php
session_start();
include_once('../config.php');
include_once('../coman.php');
	$sql = "SELECT id, first_name FROM teachers";
	$result = mysql_query($sql);
	
	$sql = "SELECT id, sub_name FROM subjects";
	$sub = mysql_query($sql);
	
	$sql = "SELECT id,class_name FROM classes";
	$class = mysql_query($sql);
	?>
<?php 
if (!isset($_SESSION['sess_id']) || empty($_SESSION['sess_id'])){
    	header('Location:/student/login.php');
}else{
?>	
<div class="users well index">
	<h3><?php echo 'Alloted subjects details';?></h3>
	<table cellpadding="0" cellspacing="0" class ="table table-striped table-bordered table_header">
		<tr>
			<th><?php echo "id" ?></th>
	    	<th>
	    		<?php echo "Teacher Name" ?>
	    	</th>
	    	<th>
	    		<?php echo "Subject Allocated" ?>
	    	</th>
	    	<th>
	    		<?php echo "class" ?>
	    	</th>
		</tr>
		<tr>
<?php 
	$num_rec_per_page = 5;
	if (isset($_GET["page"])) {
		$page  = $_GET["page"]; 
	 } else { 
		$page=1; 
	 } 
	$start_from = ($page-1) * $num_rec_per_page; 
	$sql = "SELECT * FROM teacher_subjects LIMIT $start_from, $num_rec_per_page";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {

		$t_id = $row['teacher_id'];
		$s_id = $row['sub_id'];
		$c_id = $row['class_id'];
		
		$sql = "SELECT first_name FROM teachers WHERE id IN('$t_id')";
			$res = mysql_query($sql);
			$rt = mysql_fetch_assoc($res);
			
			
			$sqls = "SELECT sub_name FROM subjects WHERE id IN('$s_id')";
			$ress = mysql_query($sqls);
			$rows= mysql_fetch_assoc($ress);
			//$row['sub_name'];
			
			$sql = "SELECT class_name FROM classes WHERE id IN('$c_id')";
			$res = mysql_query($sql);
			$cname = mysql_fetch_assoc($res);
			
			?>
				<td><?php echo $row['id'] ?></td>
			    <td><?php echo isset($rt['first_name']) ? $rt['first_name'] :''?></td>
			    <td><?php echo isset($rows['sub_name']) ? $rows['sub_name'] : '' ?></td>
			    <td><?php echo isset($cname['class_name']) ? $cname['class_name'] : '' ?></td>
			    </tr>
		<?php }?>
	
	</table>
	<div class="paging">
		<?php 
			$sql = "SELECT * FROM teacher_subjects"; 
			$rs_result = mysql_query($sql); //run the query
			$total_records = mysql_num_rows($rs_result);  //count number of records
			$total_pages = ceil($total_records / $num_rec_per_page); 
			echo "<a href='AllotedsubjectDetails.php?page=1'>".'< Prev >'."</a> "; // Goto 1st page  
			for ($i=1; $i<=$total_pages; $i++) { 
				echo "<a href='AllotedsubjectDetails.php?page=".$i."'>".'<span>'.$i.'</span>'."</a> "; 
			}; 
			echo "<a href='AllotedsubjectDetails.php?page=$total_pages'>".'< Next >'."</a> "; // Goto last page
			?>
	</div>
</div>
<?php }?>


