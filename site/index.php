<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include 'header.html';
	?>
	<title>EXERCISE</title>
</head>

<body>
	<?php 
		include 'nav.html';
		include 'include.php';
	?>
	
	<div class="container">

		<br>
		<h3>Exercise</h3>
		<hr>	
	
		<?php

			$file = '../exercise.txt';
			print_file($file, $header_mark);

		?>	

		<hr>	
	</div>
</body>
</html>