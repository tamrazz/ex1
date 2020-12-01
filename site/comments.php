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
		require_once 'start.php';
	?>
	
	<div class="container">

		<br>
		<h3>Comments</h3>
		<hr>	
	
		<?php

			function print_head($head_) {
				echo '<h5 class = "mb-2">';
			   		echo ltrim($head_, ">");
				echo '</h5>';
			}

			function print_txt($txt_) {
			    echo '<pre class="my-0" style="white-space: pre-wrap;">';
				   	echo $txt_;
				echo '</pre>';
			}

			$file = fopen('../comments.txt', "r");

			while (!feof($file)) {
				$string = fgets($file);
				if ($string[0] == ">") {
					print_txt($txt);
					$txt = "\n";
					print_head($string);			
				}

				else
					$txt .= $string;
			}
			print_txt($txt);

		    fclose($file);

		?>	
						
		<hr>	
	</div>
</body>
</html>