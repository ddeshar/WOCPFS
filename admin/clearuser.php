<?php
include("include/class.testlogin.php");
?>
<?
	if(!isset($_SESSION['logined'])) {
		?><meta http-equiv="refresh" content="0;url=index.php"><?
	}
$message = "<span class=\"header\"><br>การเคลียผู้ใช้ที่ยังค้างอยู่ในระบบ อาจใช้เวลานาน กรุณารอซักครู่.... <br>
    		<br>การดำเนินการดังกล่าว จะไม่ส่งผลกระทบต่อเวลาของ บัตรรายชั่วโมง และ บัตรรายวัน<br></span>";
			
if($_REQUEST["do"]=="1")
{
	shell_exec("sudo /bin/bash /var/www/www/admin/clearuser.sh");
  
ob_start();
$sql = "select * from radacct  where radacct.AcctStopTime = '0000-00-00 00:00:00' order by radacct.AcctStartTime ";
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

while($data = mysqli_fetch_object($result)) {
$user = $data->UserName;
shell_exec("sudo /bin/echo 'User-Name = $user' | /usr/local/bin/radclient -x localhost:3799 disconnect radius_secret");
$sql2 = "DELETE from radacct where ((AcctStopTime = '0000-00-00 00:00:00') and (UserName='$user'))";
$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
$message = "<font color=green>ได้ทำการลบผู้ใช้งานที่ค้างอยู่ในระบบเรียบร้อยแล้ว..</font>";
}
}
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
<form action="index2.php?option=clearuser&do=1" method="post" name="clear" id="clear" >
<table width="95%" align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
  <tr>
    <td width="6%" align="center"><img src="images/clearuser.png" alt="" width="58" height="58" /></td>
    <td width="94%"><a href="index2.php?option=clearuser">Clear User</a><br />
<span class="normal">ลบผู้ใช้งานที่ค้างอยู่ในระบบ</span></td>
    <td width="94%"></td>
  </tr>
</table>
	<br>
<table width="95%" align="center" border="1" cellspacing="1" class="admintable">
    <tr>
    <td width="188" height="30" align="center" valign="middle" bgcolor="<?= $bgcolor ?>">
    <img src="images/clearuser.png" />
	<br><input name="clear" type="submit" class="button" id="clear" value="ดำเนินการลบ" /></td>
    <td width="500" height="30" align="center" valign="middle" bgcolor="<?= $bgcolor ?>">
		<?if(isset($message)) { echo $message; }?><br>
	</td>
    </tr>
  </table>         
</form>
</div>
</body>
</html>
