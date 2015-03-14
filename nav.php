<?php //session_start();?>
<div class="navbar navbar-inverse logoAbove">
	<div class="navbar-inner">
		<div class="container">
			<img src ='/img/smc.jpg' class = "imageIcon"></img>
			<?php if (isset($_SESSION['sess_id']) || !empty($_SESSION['sess_id'])){
				?>
				<ul class="nav navLinksTop">
					<li class="active"><a href = "">Users</a></li>
					<li class="active"><a href = "../teacher/index.php">Teachers</a></li>
					<li class="active"><a href = "">Staff</a></li>
					<li class="active"><a href = "">Reports</a></li>
					<li class="active"><a href = "../logout.php">logout</a></li>
				</ul>
				<?php }?>
		</div>
	</div>
</div>

