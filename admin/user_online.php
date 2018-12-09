<?php
	if(!isset($_SESSION['logined'])) {
		?><meta http-equiv="refresh" content="0;url=index.php"><?
	} 
?>
<?
if($_REQUEST['user']){
	$shell_command='sudo /bin/echo "User-Name='.$_REQUEST['user'].'" | /usr/local/bin/radclient -x 127.0.0.1:3779 disconnect radius_secret';

	$output = shell_exec($shell_command);}
	//echo "Disconnect User " .$_POST["txtusername"]." completed.";
?>
				
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Burapha Linux Laboratory" />
	<meta name="keywords" content="authentication system" />
	<meta name="description" content="Burapha Linux Authentication Project" />	
    <link href="css/main.css" type=text/css rel=stylesheet>
	<title>-:- Authent!cation -:-</title>
</head>
<body>
<div id="content">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_033.png" alt="" width="59" height="60" /></td>
    <td width="94%"><a href="index2.php?option=user_online">User Online</a><br />
<span class="normal">รายชื่อผู้ที่กำลังใช้งานอยู่</span></td>
    <td width="94%">&nbsp;</td>
  </tr>
</table>
 
<?php 
		$sql = "select * from radacct,account where radacct.acctstoptime IS NULL and radacct.username = account.username order by radacct.acctstarttime ";
		//$sql = "select * from radacct.account where radacct.acctstoptime IS NULL";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$totals = mysqli_num_rows($result);
		?>
<table width="100%" align="center" cellspacing="1" class="admintable">
  <tr>
    <td height="30" colspan="4" align="left" > จำนวนผู้ใช้งานในช่วงเวลานี้ มีทั้งสิ้น <b class="red">
      <?= $totals ?>
    </b> คน</td>
  </tr>
  <tr>
    <td width="40" height="24" align="center" class="key">ลำดับที่</td>
    <td width="79" height="24" align="center" class="key">ชื่อผู้ใช้</td>
	<td width="135" height="24" align="center" class="key">ชื่อ-สกุล</td>
    <td width="120" height="24" align="center" class="key"><strong>MAC</strong></td>
    <td width="95" height="24" align="center" class="key">เลขไอพี</td>
    <td width="150" height="24" align="center" class="key">เริ่มต้นใช้งาน</td>
<!--	<td width="73" height="24" align="center" class="key">Down </td>  -->
<!--    <td width="72" align="center" class="key">Up</td>  -->
<!--    <td width="29" align="center" class="key">เตะ</td>  -->
  </tr>
  <?
		$count = 0;
		while($data = mysqli_fetch_object($result)) {
			$count++;
			($count % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
		?>
  <tr>
    <td width="40" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $count  ?></td>
    <td width="79" align="left" valign="top" bgcolor="<?= $bgcolor ?>"><div align="center"><span class="small small">
      <?= $data->username ?>
	<td width="135" height="21" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;
        <?= $data->firstname ?>
        <?= $data->lastname ?></td>
    </span></div></td>
    <td width="120"  align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $data->calledstationid ?></td>
    <td width="95"  align="right" valign="top" bgcolor="<?= $bgcolor ?>"><div align="center">
      <?= $data->framedipaddress ?>
    </div></td>
	 <td width="150"  align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $data->acctstarttime ?></td>
<!--    <td width="80"  align="right" valign="top" bgcolor="<?= $bgcolor ?>"><div align="center"><span class="small small">
      <?
     $hours = floor($data->acctsessiontime/60.0/60.0);
	  $mins = floor(($data->acctsessiontime - $hours * 60.0 * 60.0)/60.0);
	  $secs = $data->acctsessiontime - ($hours * 60.0 * 60.0) - ($mins * 60.0);
	  printf("%d:%02d:%02d", $hours, $mins, $secs);
	  ?>
    </span></div></td>
    <td width="73" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><span class="Arial-text">
      <?= Round(((int)$data->acctinputoctets/1000000),2) ?> </span>
    M
    <td width="72" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><span class="Arial-text">
      <?= Round(((int)$data->acctoutputoctets/1000000),2) ?>
      </span>
    M -->
<!--    <td width="29" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><a href="index2.php?option=user_online&user=<?=$data->username?>"><img src="images/delete.png" alt="kick" width="15" height="15" /></a>   -->
  </tr>
  <?

		}
?>
</table>
<BR />
  <BR />
</div>
</body>
</html>
