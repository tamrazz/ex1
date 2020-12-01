<?php

	include 'include.php';

	$link = db_connect($serv, $user, $pass, $dbname);

	function a2sql($array_, $q_) {
		$sql_ = "(";
		foreach ($array_ as $val_) {
			$sql_ .= $q_ . $val_ . $q_ . ", ";
		}
		$sql_ = substr($sql_, 0, -2);
		$sql_ .= ")";
		return $sql_;
	}

	function db_connect($servername_, $user_, $pass_, $db_) {
		$link_ = new mysqli($servername_, $user_, $pass_, $db_);
		if ($link_->connect_errno == 1049)
			$link_ = new mysqli($servername_, $user_, $pass_);
		if ($link_->connect_error) {
			echo '<pre class="mb-0" style="white-space: pre-wrap;">';
			die("Connection failed: " . $link_->connect_error);
			echo '</pre>';
		}
		return $link_;
	}


	function is_exist($db_, $table_) {
		global $link;

		$db_ex_ = false;
		$tb_ex_ = false;

		$sql_ = "SHOW DATABASES LIKE '" . $db_ . "'";
		if (($res_ = $link->query($sql_)) !== false)
			$db_ex_ = ($res_->num_rows > 0);

		$sql_ = "SHOW TABLES LIKE '" . $table_ . "'";
		if (($res_ = $link->query($sql_)) !== false)
			$tb_ex_ = ($res_->num_rows > 0);

		$ex_ = $db_ex_ && $tb_ex_;

		return $ex_;
	}



	function db_create($name_) {
		global $link;
		$sql_ = "CREATE DATABASE IF NOT EXISTS " . $name_;
		if ($link->query($sql_) === FALSE) {
			echo '<pre class="mb-0" style="white-space: pre-wrap;">';
			die("Error creating database: " . $link->error);
			echo '</pre>';
		}
	}

	function table_create($db_, $name_, $keys_) {
		global $link, $countrys;
		$sql_ = "USE " . $db_ . ";";
		if ($link->query($sql_) === FALSE) {
			echo '<pre class="mb-0" style="white-space: pre-wrap;">';
			die("Error selecting database: " . $link->error);
			echo '</pre>';
		}

		$sql_	 = 	"CREATE TABLE IF NOT EXISTS " . $name_ . " (";

		$sql_ .= $keys_[0] . " INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";	// id
		$sql_ .= $keys_[1] . " VARCHAR(30) NOT NULL, "						;	// fname	
		$sql_ .= $keys_[2] . " VARCHAR(30) NOT NULL, "						;	// lname
		$sql_ .= $keys_[3] . " VARCHAR(4), "								;	// vocative
		$sql_ .= $keys_[4] . " VARCHAR(50) NOT NULL, "						;	// email
		$sql_ .= $keys_[5] . " ENUM" . a2sql($countrys, '"') . ", "			;	// country
		$sql_ .= $keys_[6] . " VARCHAR(30), "								;	// city
		$sql_ .= $keys_[7] . " VARCHAR(50), "								;	// addr
		$sql_ .= $keys_[8] . " MEDIUMTEXT, "								;	// msgtxt
		$sql_ .= $keys_[9] . " VARCHAR(100))"								;	// file

		if ($link->query($sql_) === FALSE) {
			echo '<pre class="mb-0" style="white-space: pre-wrap;">';
			die("Error creating table: " . $link->error);
			echo '</pre>';
		}
	}

	function db_add($values_) {
		global $dbname, $tbname, $f_keys, $link;
		static $first_try_ = true;
		static $res_ = false;

		$sql_ = "INSERT INTO " . $tbname . " " . a2sql(array_slice($f_keys, 1), "") . " VALUES " . a2sql($values_, "'") ;
		$res_ = ($link->query($sql_) === true);

		if (!$res_ and $first_try_) {
			$first_try_ = false;
			db_create($dbname);
			table_create($dbname, $tbname, $f_keys);
			db_add($values_);
			return $res_;
		}

		$first_try_ = true;
		return $res_;
	}

	function db_read($start_, $num_) {
		global $link, $dbname, $tbname;

		$sql_ = "SELECT * FROM " . $tbname . " LIMIT " . $start_ . ', ' . $num_;
		$res_ = false;

		if (is_exist($dbname, $tbname))
			$res_ = $link->query($sql_);

		if ($res_ === false or $res_->num_rows == 0)
			echo "Database is empty! ";

		return $res_;
	}

	function db_count() {
		global $tbname, $link;
		$sql_	= "SELECT id FROM " . $tbname;
		$rows_	= 0;
		
		if ($res_ = $link->query($sql_))
			$rows_ = $res_->num_rows;

		return $rows_;	
	}

?>