<?
ob_start();
   include("include/class.mysqldb.php");
   include("include/config.inc.php");

$sql = "select * from radacct  where radacct.AcctStopTime = '0000-00-00 00:00:00' order by radacct.acctStartTime ";
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

while($data = mysqli_fetch_object($result)) {
$user = $data->UserName;
shell_exec("sudo /bin/echo 'User-Name = $user' | /usr/local/bin/radclient -x 127.0.0.1:3779 disconnect radius_secret");
$sql2 = "DELETE from radacct where ((acctStopTime = '0000-00-00 00:00:00') and (UserName='$user'))";
$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
}

?>
