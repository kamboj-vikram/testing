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

<div class="users well form">
<div id="results" ><p class='alert alert-success' style=" visibility: hidden;"></p></div>
	<fieldset>
		<legend>
 			<h3><?php echo "Allocate subject"?></h3>
		</legend>
		<form method="post" id="contact-form">
			<div class ="leftSide">
				<div class="form-group">
			    	<select id="qua" name ="teacher_id">
			    	<option value=''>Please Select teacher</option>
						<?php 	
							while($row = mysql_fetch_assoc($result)) {?>
								<option value="<?php echo $row['id']?>"><?php echo $row['first_name']?></option>
						<?php }?>
						</select>	
			  	</div>
			</div>
			<div class ="leftSide">
				<div class="form-group">
				    <select id="qua" name ="sub_id">
			    	<option value=''>Please Select subject</option>
						<?php 	
							while($row = mysql_fetch_assoc($sub)) {?>
								<option value="<?php echo $row['id']?>"><?php echo $row['sub_name']?></option>
						<?php }?>
						</select>	
	            </div>
			</div>
			<div class ="leftSide">
				<div class="form-group">
				    <select id="qua" name ="class_id">
			    	<option value=''>Please Select class</option>
						<?php 	
							while($row = mysql_fetch_assoc($class)) {?>
								<option value="<?php echo $row['id']?>"><?php echo $row['class_name']?></option>
						<?php }?>
						</select>	
	            </div>
				 <button type="submit" class="btn btn-primary regis" name="register">Submit</button> 	
			</div>
		</form> 
	</fieldset>
</div>
<div class="actions well">
	<?php include_once('../sidebar.php')?>
</div>	
<div class="users well index">
	<h3><?php echo 'Allocated subjects details'; ?></h3>
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
			echo "<a href='allotedSubject.php?page=1'>".'< Prev >'."</a> "; // Goto 1st page  
			for ($i=1; $i<=$total_pages; $i++) { 
				echo "<a href='allotedSubject.php?page=".$i."'>".'<span>'.$i.'</span>'."</a> "; 
			}; 
			echo "<a href='allotedSubject.php?page=$total_pages'>".'< Next >'."</a> "; // Goto last page
			?>
	</div>
</div>
<?php }?>
<style>
.error{
 color:red;
}
a.stu_info{
color:blue;
margin-left:-25px;

}
</style>	
<script>
$(document).ready(function() {
	$( "#accordion").accordion();
	/* ajax call is used to save allocated subjects*/
	$(".regis").click(function(e){
		e.preventDefault();
	   	data = $('#contact-form').serialize();
	    $.ajax({
	      type: "POST",
	      data: data,
	      dataType :'JSON',
	      url: "../allotedsub.php", 
	      success: function(response){
		      if(response.message == "sucess"){
			      $('p.alert-success').text('Allocated subject has been saved');
			      $('p.alert-success').css('visibility','visible');
			      $('#results').delay(5000).fadeOut('slow');
			       window.setTimeout(function(){location.reload()},5000)
		      }else{
			      $('p.alert-success').text('Allocated subject not saved');
			      $('p.alert-success').css('visibility','visible');
			      $('#results').delay(5000).fadeOut('slow');
		     }
	     },
	  });
	    return false;
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
});

</script>