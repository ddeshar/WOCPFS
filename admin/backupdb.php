<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

    include("include/class.testlogin.php");

    ini_set('memory_limit','16M');
/*=====================================================================================*/
/* SCRIPT CONFIGURATION */
/*=====================================================================================*/

$mysql['host'] ='localhost';                        // ussually localhost
$mysql['user'] ='mysql_USER';                       // mysql username
$mysql['pass'] ='mysql_PASSWORD';                   // mysql password
$mysql['name'] ='mysql_DB';			                    // mysql database name

//if(ISO=='utf-8'){
//$mysql['charset'] = "utf8";                       // connection charset
//} else {
//$mysql['charset'] = "tis620";                     // connection charset
//}
//$file = 'backup/'.date('Y-m-d').'-db_backup.zip'; // will produce file like 2009-05-19-db_backup.zip

/*=====================================================================================*/
/* DONOT EDIT BEYOND THIS LINE */
/*=====================================================================================*/
 
// show all error
error_reporting(E_ALL);
 
 
// you may need this
//ini_set('max_execution_time',0);
//ini_set('memory_limit','100M');
 
// file name of sql file , will be deleted when backup finished
$sql_file = 'backup/db_backup.sql';
 
// try to create file
if ( ! $fp = @fopen($sql_file,'w'))
{
 die('Cannot create file db_backup.sql please check file permission');
}

// connect to mysql
$mysql_link = ($GLOBALS["___mysqli_ston"] = mysqli_connect($mysql['host'], $mysql['user'], $mysql['pass'])) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
//mysql_select_db($mysql['name'],$mysql_link) or die(mysql_error($mysql_link));
//mysql_query("SET character_set_results={$mysql['charset']}",$mysql_link); 
//mysql_query("SET character_set_client={$mysql['charset']}",$mysql_link);
//mysql_query("SET character_set_connection={$mysql['charset']}",$mysql_link);
//mysql_query("SET NAMES 'utf8'",$mysql_link);

mysqli_query($mysql_link, "SET NAMES utf8");
mysqli_query($mysql_link, "SET character_set_results=utf8");
mysqli_query($mysql_link, "SET character_set_client=utf8");
mysqli_query($mysql_link, "SET character_set_connection=utf8");

// close mysql on exit
register_shutdown_function(create_function('$link','if (is_resource($link)) mysql_close($link);'),$mysql_link);
 
// list all tables
$tables = array();
$result = mysqli_query($mysql_link, "SHOW TABLES FROM `{$mysql['name']}`");
while (($row = mysqli_fetch_array($result, MYSQLI_NUM)) !== FALSE){
 $tables[] = $row[0];
}
((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);
 
 
// check if have no table
if (count($tables) === 0)
{
 die('No tables in database');
}
  
function format_insert_value($value)
{
 global $mysql_link;
 return ($value === '') ? "''" : "'".mysqli_real_escape_string($mysql_link, $value)."'" ;
}
 
// export each table
foreach ($tables as $table)
{
 $result = mysqli_query($mysql_link, "SHOW CREATE TABLE `{$table}`");
 $row = mysqli_fetch_array($result, MYSQLI_NUM);
 ((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);
 
 if ( ! $row)
 {
  echo 'Cannot create table structure for table "'.$table.'"';
  continue;
 }
 
 $structure = "DROP TABLE IF EXISTS `{$table}`;\n";
 $structure .= $row[1].";\n";
 
 // write sql table structure to file
 fwrite($fp,$structure);
 
 // get data from table
 $result = mysqli_query($mysql_link, "SELECT * FROM `{$table}`");
 while (($row = mysqli_fetch_assoc($result)) !== FALSE)
 {
  $row = array_map('format_insert_value',$row);
  $sql = "INSERT INTO `{$table}` VALUES (".implode(',',$row).");\n";
  fwrite($fp,$sql);
 }
 ((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);
}
 
fclose($fp);
 
 
// zipfile
//require_once 'dZip.inc.php'; // change this if you put dZip.inc.php on other place
//$zip = new dZip($file);
//$zip->addFile("backup/db_backup.sql");
//$zip->save();

//	$ZipName = "MyFiles/MyZip.zip";
//	require_once("dZip.inc.php"); // include Class
//	$zip = new dZip($ZipName); // New Class
//	$zip->addFile("thaicreate1.txt", "thaicreate1.txt"); // Source,Destination
//	$zip->addFile("thaicreate2.txt", "thaicreate2.txt");
//	$zip->addDir("MySub"); // Add Folder
//	$zip->addFile("thaicreate3.txt", "MySub/thaicreate3.txt"); // Add file to Sub
//	$zip->addFile("thaicreate4.txt", "MySub/thaicreate4.txt");
//	$zip->save();
//	echo "Zip Successful Click <a href=$ZipName>here</a> to Download";


//@unlink($sql_file) or die("Database backup finished");

?>
<BR><BR><BR><BR>
 <?
$files=substr($sql_file,7,24);
echo "<center><h4>ดาว์นโหลด <a href=\"backup/$files\" target=\"_blank\">&nbsp;&nbsp;$files</a></h4><br>";
?>
<h4><a href="index2.php?option=backupindex&filebackup=<?=$files?>" >เมื่อคุณดาว์นโหลดแล้วกรุณาลบ FileBackUp</a></h4>

</td>
</tr>
</table>
				</TD>
				</TR>
			</TABLE>
