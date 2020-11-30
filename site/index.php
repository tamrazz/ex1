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
		require_once 'start.php';
	?>
	
	<div class="container">

		<br>
		<h3>Exercise</h3>
		<hr>	
	
		<?php

			$file = fopen('../exercise.txt', "r");
			$head = fgets($file);
		    echo '<h5 class = "mb-2">';
			    	echo $head;
			echo '</h5>';

			while (!feof($file)) {
			    $txt .= fgets($file);	    
			}

		    fclose($file);

		    echo '<pre class="my-0" style="white-space: pre-wrap;">';
			   	echo $txt;
			echo '</pre>';

		?>			
			

	
		<hr>
		
	</div>


	<script src="../bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>