<?php 

	// Create connection
	$link = new mysqli($servername, $user, $pass);
	// Check connection
	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE IF NOT EXISTS " . $name;
	if ($link->query($sql) === FALSE) {
		die("Error creating database: " . $link->error);
	}

	// Select database
	$sql = "USE " . $name . ";";
	if ($link->query($sql) === FALSE) {
		die("Error selecting database: " . $link->error);
	}

	// Create table
	$sql	 = 	"CREATE TABLE IF NOT EXISTS " . $table;
	$sql	.=	" (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
	$sql	.=	$fields[0] . " VARCHAR(30) NOT NULL, "	;						// fname	
	$sql	.=	$fields[1] . " VARCHAR(30) NOT NULL, "	;						// lname
	$sql	.=	$fields[2] . " VARCHAR(4), "			;						// vocative
	$sql	.=	$fields[3] . " VARCHAR(50) NOT NULL, "	;						// email
	$sql	.=	$fields[4] . " VARCHAR(10), "			;						// country
	$sql	.=	$fields[5] . " VARCHAR(30), "			;						// city
	$sql	.=	$fields[6] . " VARCHAR(50), "			;						// addr
	$sql	.=	$fields[7] . " MEDIUMTEXT, "			;						// msgtxt
	$sql	.=	$fields[8] . " VARCHAR(50))"			;						// file

	if ($link->query($sql) === FALSE) {
		die("Error creating table: " . $link->error);
	}
?>