<?php
	$check=($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "mysql"));
	mysqli_select_db($GLOBALS["___mysqli_ston"], radius3);

	$fileup = $_FILES['fileup']['tmp_name'];
	if(!empty($fileup)){
		$tables = '*';
		if($tables == '*') {
			$tables = array();
			$result = mysqli_query($GLOBALS["___mysqli_ston"], 'SHOW TABLES');
			while($row = mysqli_fetch_row($result)) {
				$tables[] = $row[0];
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}	

		foreach($tables as $table) {
		$sql=mysqli_query($GLOBALS["___mysqli_ston"], "DROP TABLE ".$table.";");
		}

		$sql_filename =$fileup;
		$sql_contents = file_get_contents($path.$sql_filename);
		$sql_contents = explode(";", $sql_contents);
		//$connection = mysql_connect($server, $username, $password) or die(mysql_error());
		// mysql_select_db($name, $connection) or die(mysql_error());

		foreach($sql_contents as $query){
			$result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
		}
		echo'<div class="bs-component">';
		echo'	<div class="alert alert-danger">';
		echo'		<p align="center">Restore  Database  เรียบร้อย <br> <a class="alert-link" href="index2.php"> กลับหน้าหลัก</a>.</p>';
		echo'	</div>';
		echo'</div>';
	}else{
?>
	<div class="row">
		<div class="col-md-6">
			<div class="tile">
				<h3 class="tile-title">restore</h3>
				<form name="frm2" method="post" action="index2.php?option=restore" enctype="multipart/form-data" >
					<div class="tile-body">
						<div class="form-group">
							<label class="control-label">file Database   *.sql  :</label>
							<input class="form-control" type="file" name="fileup">
						</div>
					</div>
					<div class="tile-footer">
						<input class="btn btn-primary" type="submit" value=" uploadFile " name="send">
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>