<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include 'header.html';
	?>
	<title>COMMENTS</title>
</head>

<body>
	<?php 
		include 'nav.html';
		include 'include.php';
	?>
	
	<div class="container">

		<br>
		<h3>Comments</h3>
		<hr>	
	
		<?php

			$file = '../comments.txt';
			print_file($file, $header_mark);

		?>	
						
		<hr>	
	</div>
</body>
</html>