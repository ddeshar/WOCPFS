<?
$check=($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "1234567890@x"));
mysqli_select_db($GLOBALS["___mysqli_ston"], radius);

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
 echo' <BR><BR><BR><CENTER><FONT SIZE="2" COLOR="#FF0066">Restore  Database  เรียบร้อย</FONT></CENTER>';
 echo' <BR><CENTER><FONT SIZE="2" COLOR="#FF0066"><A HREF="index2.php">กลับหน้าหลัก</A></FONT></CENTER>';
}else{
echo'<BR><BR><BR><form name="frm2"  method="post" action="index2.php?option=restore" enctype="multipart/form-data" >';
echo'file Database   *.sql  : <input type="file" name="fileup" size="20">';
echo'<input type="submit" value=" uploadFile " name="send"></form>';
}
?>
