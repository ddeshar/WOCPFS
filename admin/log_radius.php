<?php
	include("include/class.mysqldb.php");
	include("include/config.inc.php");
?>
<?
$day=date("Y-m-d");
$strFileName = "/home/logserver/$day/radius/$day-radacct-mysql.log";
$objFopen = fopen($strFileName, 'w');

//INSERT INTO `radacct` (`radacctid`, `acctsessionid`, `acctuniqueid`, `username`, `groupname`, `realm`, `nasipaddress`, `nasportid`, `nasporttype`, `acctstarttime`, `acctstoptime`, `acctsessiontime`, `acctauthentic`, `connectinfo_start`, `connectinfo_stop`, `acctinputoctets`, `acctoutputoctets`, `calledstationid`, `callingstationid`, `acctterminatecause`, `servicetype`, `framedprotocol`, `framedipaddress`, `acctstartdelay`, `acctstopdelay`, `xascendsessionsvrkey`) VALUES
$count = 0;
$sql = "select * from radacct  where acctstarttime like '$day%' order by radacctid"; 
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
while($group = mysqli_fetch_object($result)) { 
	$count++;
	$strText1 ="radacctid:=".$group->radacctid."\r\n\t".
	"acctsessionid:=".$group->acctsessionid."\r\n\t".
	"acctuniqueid:=".$group->acctuniqueid."\r\n\t".
	"username:=".$group->username."\r\n\t".
	"groupname:=".$group->groupname."\r\n\t".
	"realm:=".$group->realm."\r\n\t".
	"nasipaddress:=".$group->nasipaddress."\r\n\t".
	"nasportid:=".$group->nasportid."\r\n\t".
	"nasporttype:=".$group->nasporttype."\r\n\t".
	"acctstarttime:=".$group->acctstarttime."\r\n\t".
	"acctstoptime:=".$group->acctstoptime."\r\n\t".
	"acctsessiontime:=".$group->acctsessiontime."\r\n\t".
	"acctauthentic:=".$group->acctauthentic."\r\n\t".
	"connectinfo_start:=".$group->connectinfo_start."\r\n\t".
	"connectinfo_stop:=".$group->connectinfo_stop."\r\n\t".
	"acctinputoctets:=".$group->acctinputoctets."\r\n\t".
	"acctoutputoctets:=".$group->acctoutputoctets."\r\n\t".
	"calledstationid:=".$group->calledstationid."\r\n\t".
	"callingstationid:=".$group->callingstationid."\r\n\t".
	"acctterminatecause:=".$group->acctterminatecause."\r\n\t".
	"servicetype:=".$group->servicetype."\r\n\t".
	"framedprotocol:=".$group->framedprotocol."\r\n\t".
	"framedipaddress:=".$group->framedipaddress."\r\n\t".
	"acctstartdelay:=".$group->acctstartdelay."\r\n\t".
	"acctstopdelay:=".$group->acctstopdelay."\r\n\t".
	"xascendsessionsvrkey:=".$group->xascendsessionsvrkey."\r\n";
	fwrite($objFopen, $strText1);	
} 
fclose($objFopen);
?>
