<?php 
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

		$res = ($link_->query($sql_) === TRUE);

		return $res;
	}

	function db_read($link_, $table_, $fields_, $start_, $num_)	{
		$sql_ 	= "SELECT * FROM " . $table_ . " LIMIT " . $start_ . ', ' . $num_;
		$res_ 	= $link_->query($sql_);
		$cols_	= count($fields_);

		if ($res_->num_rows > 0) {
			
			while($row = $res_->fetch_assoc()) {
				echo '<tr>'	;
					for($i = 0; $i < $cols_; $i++) {
						echo '<th class="font-weight-normal">';
							echo $row[$fields_[$i]];
						echo '</th>';
					}
				echo '</tr>';
			}
			$res_->close();
		} 
		else {
			echo "Wrong request or database is empty!";
		}	

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