<?php
include("include/class.mysqldb.php");
include("include/config.inc.php");
//kill users on Textmode Command line.
//$sql = "SELECT * FROM radacct WHERE acctstoptime = '0000-00-00 00:00:00'";
$sql = "SELECT * FROM radacct WHERE acctstoptime IS NULL";
$link->query($sql);
while($kill_users = $link->getnext()) {
	$command = '/bin/echo User-Name='.$kill_users->username.'| /usr/local/bin/radclient -x 127.0.0.1:3779 disconnect radius_secret';
	$output = shell_exec($command);

	$updateSQL = sprintf("UPDATE radacct SET acctterminatecause='%s', acctstoptime=NOW() WHERE username='%s' and acctstoptime IS NULL","Admin-Reset", $kill_users->username);
	mysqli_query($GLOBALS["___mysqli_ston"], $updateSQL);
}
?>