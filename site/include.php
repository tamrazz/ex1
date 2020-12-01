<?php

	// Variables

	$admin	= fopen('../admin.txt', "r");
	$_user	= explode("=", fgets($admin));
	$_pass	= explode("=", fgets($admin));
	$_email	= explode("=", fgets($admin));  
	fclose($admin);

	$serv 	= "localhost";
	$user 	= (strcmp("user", trim($_user[0]))) ? "": trim($_user[1]);
	$pass 	= (strcmp("password", trim($_pass[0]))) ? "" : trim($_pass[1]);
	$aemail	= (strcmp("email", trim($_email[0]))) ? "user@example.com" : trim($_email[1]);	

	$dbname	= "feedback_db";
	$tbname = "feedbacks";
	$fields = array('id' => 'ID', 'fname' => 'First Name', 'lname' => 'Last Name', 'vocative' => 'Vocative', 
		'email' => 'E-mail', 'country' => 'Country', 'city' => 'City', 'addr' => 'Address', 'msgtxt' => 'Messge', 'file' => 'File');
	$f_keys = array_keys($fields);
	$countrys = array('Not selected', 'Russia', 'USA', 'Germany', 'Norway');

	$header_mark = '#';

	// Functions

	function print_file($file_, $header_mark_) {

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

		$file = fopen($file_, "r");

		$txt = "";
		while (!feof($file)) {
			$string = fgets($file);
			if (strncmp($string, $header_mark_, 1)) {
				$txt .= $string;
			}
			else {
				print_txt($txt);
				$txt = "\n";
				print_head($string, $header_mark_);	
			}
				
		}
		print_txt($txt);
    	fclose($file_);
    }

?>