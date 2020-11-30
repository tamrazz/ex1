<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include 'header.html';
	?>
	<title>DASHBOARD</title>
</head>

<body>
	<?php 
		include 'nav.html';
		require_once 'start.php';
	?>
	
	<div class="container">

		<br>
		<h3>Dashboard</h3>
		<hr>

		<?php 
			$print_fields = array('id', $fields[0], $fields[1], $fields[3], $fields[7]);
		//	$cols = count($print_fields);
		//	echo $cols;
			$cols = count($print_fields);
			$rows = 6;

		?>

		<table class="table table-hover">

			<thead class="thead-dark" align="center">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Message</th>
				</tr>
			</thead>

			<?php 
			//	require 'pagin.php';	
				db_read($link, $table, $print_fields, $rows)
			?>
		</table>

		<div class="container-fluid">
			<nav aria-label="...">
				<ul class="pagination justify-content-center">
					<li class="page-item disabled">
						<a class="page-link" href="#" tabindex="-1"> << </a>
					</li>

					<li class="page-item disabled">
						<a class="page-link" href=""> 1 / 2 </a>
					</li>

					<li class="page-item">
						<a class="page-link" href="#"> >> </a>
					</li>
				</ul>
			</nav>
		</div>

		<hr>
		
	</div>


	<script src="../bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>