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
	?>
	
	<div class="container">

		<br>
		<h3>Comments</h3>
		<hr>	
	
		<?php

			$header_mark = '#';

			function print_head($head_, $mark_) {
				echo '<h5 class = "mb-2">';
			   		echo ltrim($head_, $mark_);
				echo '</h5>';
			}

			function print_txt($txt_) {
			    echo '<pre class="my-0" style="white-space: pre-wrap;">';
				   	echo $txt_;
				echo '</pre>';
			}

			$file = fopen('../comments.txt', "r");

			$txt = "";
			while (!feof($file)) {
				$string = fgets($file);
				if (strncmp($string, $header_mark, 1)) {
					$txt .= $string;
				}
				else {
					print_txt($txt);
					$txt = "\n";
					print_head($string, $header_mark);	
				}
					
			}
			print_txt($txt);

		    fclose($file);

		?>	
						
		<hr>	
	</div>
</body>
</html>