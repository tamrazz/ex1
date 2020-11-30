	
<?php 
	$admin	= fopen('../admin.txt', "r");
	$_user	= explode("=", fgets($admin));
	$_pass	= explode("=", fgets($admin));
	$_email	= explode("=", fgets($admin));   
	fclose($admin);

	$serv 	= "localhost";
	$user 	= (strcmp("user", trim($_user[0]))) ? "": trim($_user[1]);
	$pass 	= (strcmp("password", trim($_pass[0]))) ? "" : trim($_pass[1]);
	$aemail	= (strcmp("email", trim($_email[0]))) ? "user@example.com" : trim($_email[1]);
	$name	= "feedback";
	$table 	= "messages";
	$fields = array('fname', 'lname', 'vocative', 'email', 'country', 'city', 'addr', 'msgtxt', 'file');

	require 'db_crud.php';
	echo '<pre class="mb-0" style="white-space: pre-wrap;">';
		require('db_connect.php');
	echo '</pre>';

?>
