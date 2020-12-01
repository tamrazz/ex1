	
<?php 
	require 'db_crud.php';

	$admin	= fopen('../admin.txt', "r");
	$_user	= explode("=", fgets($admin));
	$_pass	= explode("=", fgets($admin));
	$_email	= explode("=", fgets($admin));   
	fclose($admin);

	$serv 	= "localhost";
	$user 	= (strcmp("user", trim($_user[0]))) ? "": trim($_user[1]);
	$pass 	= (strcmp("password", trim($_pass[0]))) ? "" : trim($_pass[1]);
	$aemail	= (strcmp("email", trim($_email[0]))) ? "user@example.com" : trim($_email[1]);
	$dbname	= "feedback";
	$table 	= "messages";
	$fields = array('fname' => 'First Name', 'lname' => 'Last Name', 'vocative' => 'Vocative', 'email' => 'E-mail',	
		'country' => 'Country', 'city' => 'City', 'addr' => 'Address', 'msgtxt' => 'Messge', 'file' => 'File');

	echo '<pre class="mb-0" style="white-space: pre-wrap;">';
		$link = db_connect($serv, $user, $pass);
		db_create($link, $dbname);
		table_create($link, $dbname, $table, $fields);
	echo '</pre>';
?>
