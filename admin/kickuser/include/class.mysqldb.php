<?php
	class mysqldb {
			var $link;
			var $result;
		function connect($config) {
			$this->link = ($GLOBALS["___mysqli_ston"] = mysqli_connect($config['hostname'],  $config['username'],  $config['password']));
			if($this->link) {
				mysqli_query($GLOBALS["___mysqli_ston"], "SET NAMES 'utf-8'");
				return true;
			}
			$this->show_error(mysqli_error($this->link), "connect()");
			return false;
		}
		function selectdb($database) {
			if($this->link) {
				mysqli_select_db( $this->link, $database);
				return true;
			}
			$this->show_error("Not connect the database before", "selectdb($database)");
			return false;
		}
		function query($sql) {
			$this->result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			return $this->result;
		}
		function getnext() {
			return mysqli_fetch_object($this->result);
		}
		function num_rows() {
			return mysqli_num_rows($this->result); 
		}
		function show_error($errmsg, $func) {
			echo "<b><font color=red>" . $func . "</font></b> : " . $errmsg . "<BR>\n";
			exit(1);
		} 
	}

?>
