<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include 'header.html';
	?>
	<title>READ ME</title>
</head>

<body>
	<?php 
		include 'nav.html';
		include 'include.php';
	?>
	
	<div class="container">

		<br>
		<h3>Read me</h3>
		<hr>

		<?php

			$file = '../readme.md';
			print_file($file, $header_mark);

		?>			

		<hr>			
	</div>
</body>
</html>