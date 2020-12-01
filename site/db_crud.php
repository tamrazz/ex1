<?php 
	function db_connect($servername_, $user_, $pass_) {
		$link_ = new mysqli($servername_, $user_, $pass_);
		if ($link_->connect_error) {
			die("Connection failed: " . $link_->connect_error);
		}
		return $link_;
	}

	function db_create($link_, $name_) {
		$sql_ = "CREATE DATABASE IF NOT EXISTS " . $name_;
		if ($link_->query($sql_) === FALSE) {
			die("Error creating database: " . $link_->error);
		}
	}

	function table_create($link_, $db_name_, $table_, $fields_) {
		$sql_ = "USE " . $db_name_ . ";";
		if ($link_->query($sql_) === FALSE) {
			die("Error selecting database: " . $link_->error);
		}

		$sql_	 = 	"CREATE TABLE IF NOT EXISTS " . $table_;
		$sql_	.=	" (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";			// id
		$sql_	.=	$fields_[0] . " VARCHAR(30) NOT NULL, "	;						// fname	
		$sql_	.=	$fields_[1] . " VARCHAR(30) NOT NULL, "	;						// lname
		$sql_	.=	$fields_[2] . " VARCHAR(4), "			;						// vocative
		$sql_	.=	$fields_[3] . " VARCHAR(50) NOT NULL, "	;						// email
		$sql_	.=	$fields_[4] . " VARCHAR(10), "			;						// country
		$sql_	.=	$fields_[5] . " VARCHAR(30), "			;						// city
		$sql_	.=	$fields_[6] . " VARCHAR(50), "			;						// addr
		$sql_	.=	$fields_[7] . " MEDIUMTEXT, "			;						// msgtxt
		$sql_	.=	$fields_[8] . " VARCHAR(100))"			;						// file

		if ($link_->query($sql_) === FALSE) {
			die("Error creating table: " . $link_->error);
		}
	}

	function db_add($link_, $table_, $fields_, $values_) {
		function a2sql($array__, $q__) {
			$tmp__ = "(";
			foreach ($array__ as $val) {
				$tmp__ .= $q__ . $val . $q__ . ", ";
			}
			$tmp__ = substr($tmp__, 0, -2);
			$tmp__ .= ")";
			return $tmp__;
		}

		$sql_ = "INSERT INTO " . $table_ . " " . a2sql($fields_, "") . " VALUES " . a2sql($values_, "'") ;
		$res_ = ($link_->query($sql_) === TRUE);

		return $res_;
	}

	function db_read($link_, $table_, $start_, $num_)	{
		$sql_ 	= "SELECT * FROM " . $table_ . " LIMIT " . $start_ . ', ' . $num_;

		if (!($res_ = $link_->query($sql_))) {
			echo "Wrong request or database is empty!";
		}

		return $res_;
	}

	function db_count($link_, $table_)	{
		$sql_ 	= "SELECT id FROM " . $table_;
		
		if ($res_ = $link_->query($sql_)) {
			$rows_ = $res_->num_rows;
			$res_->close();
		}

		return $rows_;	
	}


?>