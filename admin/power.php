<?php
include("include/class.testlogin.php");
?>
<?php
$message1 = "<span class=\"header\">ปิดระบบ</span>";
$message2 = "<span class=\"header\">รีสตาร์ทระบบ</span>";
	if(isset($_REQUEST['action'])) { 
		switch($_REQUEST['action']) {
			case 'shutdown' :
				$actions1 = "<input name=\"action\" type=\"button\" class=\"button\" id=\"button\" value=\"ตกลง\" onclick=\"window.location='index2.php?option=power&action=down'\"/>";
				$actions2 = "<input name=\"action\" type=\"button\" class=\"button\" id=\"button\" value=\"ยกเลิก\" onclick=\"window.location='index2.php?option=power'\"/>";
				$message1 = "<span class=\"alert\">คุณต้องการที่จะปิดระบบใช่ไหม...?</span>";
				break;
			case 'reboot' :
				$actionr1 = "<input name=\"action\" type=\"button\" class=\"button\" id=\"button\" value=\"ตกลง\" onclick=\"window.location='index2.php?option=power&action=restart'\"/>";
				$actionr2 = "<input name=\"action\" type=\"button\" class=\"button\" id=\"button\" value=\"ยกเลิก\" onclick=\"window.location='index2.php?option=power'\"/>";
				$message2 = "<span class=\"alert\">คุณต้องการที่จะรีสตาร์ทระบบใช่ไหม...?</span>";
				break;
			case 'down' :
				$message1 = "<span class=\"info\">กำลังดำเนินการปิดระบบ...</span>";
 				#exec("sudo shutdown -h now");
				shell_exec("sudo /sbin/shutdown -h now");
				break;
			case 'restart' :
				$message2 = "<span class=\"info\">กำลังดำเนินการรีสตาร์ทระบบ...</span>";
				#exec("sudo shutdown -r now");
				shell_exec("sudo /sbin/shutdown -r now");
				break;
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
<form action="index2.php?option=power" method="post" id="powerform" name="powerform">
<table width="95%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_194.png" alt="" width="59" height="60" /></td>
    <td><a href="index2.php?option=power">Shutdown &amp; Reboot</a><br />
<span class="normal">ปิดระบบ และ รีสตาร์ทระบบ</span></td>
    </tr>
</table>
<br>
<table width="95%" align="center" border="0" cellspacing="1" class="admintable">
    <tr>
    <td width="344" height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>" class="red">
    <br><?php if(isset($message1)) { echo $message1; } ?><br>
    <br><a href="index2.php?option=power&amp;action=shutdown"><img src="images/delete_computer.png" alt="ปิดระบบ" width="128" height="128" /></a><br>
	<br><?php if(isset($actions1)) { echo $actions1; } ?>&nbsp;&nbsp;&nbsp;<?php if(isset($actions2)) { echo $actions2; } ?><br><br></td>
    <td width="344" height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>" class="red">
	<br><?php if(isset($message2)) { echo $message2; } ?><br>
    <br><a href="index2.php?option=power&amp;action=reboot"><img src="images/computer_accept.png" alt="รีสตาร์ทระบบ" width="128" height="128" /></a><br>
    <br><?php if(isset($actionr1)) { echo $actionr1; } ?>&nbsp;&nbsp;&nbsp;<?php if(isset($actionr2)) { echo $actionr2; } ?><br><br></td>
    </tr>
  </table>
</form>
</div>
</body>
</html>
