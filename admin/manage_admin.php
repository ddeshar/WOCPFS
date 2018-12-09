<?php
include("include/class.testlogin.php");
?>
<?php
	$message = "";
	foreach($_REQUEST as $key => $value) {
		$$key = $value;
	}
	if(isset($_REQUEST['submit'])) { 
		if(!empty($_REQUEST['pass1'])) {
			$sql = "select * from administrator where username = '".$_SESSION['username']."' and password = '".md5($_REQUEST['pass1'])."'";
			if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))) {
				if(!empty($_REQUEST['pass2'])) {
					if(!empty($_REQUEST['pass3'])) {
						if($_REQUEST['pass3'] == $_REQUEST['pass2']) {
							$sql = "update administrator set password = '".md5($pass2)."' where username = '".$_SESSION['username']."'";
							mysqli_query($GLOBALS["___mysqli_ston"], $sql);
							$message = "<span class=\"info\">ระบบได้บันทึกรหัสผ่านใหม่ของคุณเรียบร้อยแล้ว</span>";
							$pass1 = $pass2 = $pass3 = "";
						} else {
							$message = "<span class=\"alert\">รหัสผ่านใหมไม่ตรงกัน กรุณากรอกรหัสผ่านใหม่</span>";
							$pass2 = "";
							$pass3 = "";
						}
					} else {
						$message = "<span class=\"alert\">กรุณายืนยันรหัสผ่านใหม่ด้วย</span>";
					}
				} else {
					$message = "<span class=\"alert\">กรุณากรอกรหัสผ่านใหม่ด้วย</span>";
				}
			} else {
				$message = "<span class=\"alert\">รหัสผ่านเก่าของคุณไม่ถูกต้อง</span>";
				$pass1 = "";
			}
		} else {
			$message = "<span class=\"alert\">กรุณากรอกรหัสผ่านเก่าด้วย</span>";
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
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_172.png" alt="" width="59" height="60" /></td>
    <td width="94%"><a href="index2.php?option=manage_admin">Administrator </a><br />
<span class="normal">เปลี่ยนรหัสผ่านของผู้ดูแลระบบ</span></td>
    <td width="94%">&nbsp;</td>
  </tr>
</table>
 

<form id="form1" method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td colspan="2"><?php 
	if(isset($message)) { echo $message; } 
?>&nbsp;</td>
    </tr>
  <tr>
    <td width="36%" align="right">รหัสผ่านเดิม :</td>
    <td width="64%">
      <p>
        <input name="pass1" type="password" class="inputbox" id="pass1" value="<?= $pass1 ?>" />
      </p>    </td>
  </tr>
  <tr>
    <td align="right">รหัสผ่านใหม่ :</td>
    <td><input name="pass2" type="password" class="inputbox" id="pass2" value="<?= $pass2 ?>"/></td>
  </tr>
  <tr>
    <td align="right">ยืนยันรหัสผ่านใหม่ :</td>
    <td><input name="pass3" type="password" class="inputbox" id="pass3" value="<?= $pass3 ?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="submit" type="submit" class="button" id="submit" value="บันทึก" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
  </form>

</div>
</body>
</html>
