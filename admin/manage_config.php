<?php
include("include/class.testlogin.php");
?>
<?php
	$message = $url = "";
	foreach($_REQUEST as $key => $value) {
		$$key = $value;
	}
	if(isset($_REQUEST['submit'])) { 
		$sql = "update configuration set value = '$default_regis_status' where variable = 'default_regis_status'";
		mysqli_query($GLOBALS["___mysqli_ston"], $sql);

		if($userurl == "3")
			$sql = "update configuration set value = '$url' where variable = 'redirect'";
		else
			$sql = "update configuration set value = '$userurl' where variable = 'redirect'";
		mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$message = "บันทึกการเปลี่ยนแปลงเรียบร้อยแล้ว";
	}
	$sql = "select * from configuration where variable = 'default_regis_status'";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$data = mysqli_fetch_object($result);
	$default_regis_status = $data->value;
	$sql = "select * from configuration where variable = 'redirect'";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$data = mysqli_fetch_object($result);
	$redirect = $data->value;
	
	$check1 = array("", "");
	$check2 = array("", "", "","");
	$check1[$default_regis_status] = "checked=\"checked\"";
	if($redirect == "1" || $redirect == "2") {
		$check2[$redirect] = "checked=\"checked\"";
		$url = "";
	} else {
		$check2[3] = "checked=\"checked\"";
		$url = $redirect;
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
    <style type="text/css">
<!--
.style1 {color: #c40000}
-->
    </style>
</head>
<body>
<div id="content">
<form id="form1" method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_197.png" alt="" width="59" height="60" /></td>
    <td width="94%"><a href="index2.php?option=manage_config">Global Configuration</a><br />
<span class="normal">แก้ไขค่าคอนฟิคกูเรชั่นของระบบ</span></td>
    <td width="94%" align="right"><input type="submit" name="submit" id="submit" value="บันทึก" class="button" /></td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td height="39" colspan="2" align="center"><span class="style1">
      <?= $message?>
      &nbsp;</span></td>
    </tr>
  <tr>
    <td width="40%" height="25" align="right" valign="top">สมัครสมาชิกแล้วใ้ช้งานได้ทันที :</td>
    <td width="60%" height="25" valign="top">
      <input type="radio" name="default_regis_status" id="default_regis_status" value="1"  <?= $check1[1] ?>/> เปิด 
      <input name="default_regis_status" type="radio" id="default_regis_status" value="0" <?= $check1[0] ?> /> ปิด    </td>
  </tr>
  <!-- <tr>
    <td align="right">รหัสผ่านของผู้ใช้มีการเข้ารหัสผ่านหลายวิธี :</td>
    <td>
      <input type="radio" name="multi_encryption" id="multi_encryption" value="1" /> เปิด 
      <input name="multi_encryption" type="radio" id="multi_encryption" value="0"  /> ปิด    </td>
  </tr>
  -->
  <tr>
    <td height="25" align="right" valign="top">เมื่อผู้ใช้เข้าระบบสำเร็จให้ไปที่ :</td>
    <td height="25" valign="top"><input type="radio" name="userurl" id="userurl" value="1" <?= $check2[1] ?>/> 
      หน้าเดิมก่อนล็อกอิน        
        <input type="radio" name="userurl" id="userurl" value="2" <?= $check2[2] ?> />
หน้าเว็บว่าง</td>
  </tr>
  
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td height="25" valign="top"><input type="radio" name="userurl" id="userurl2" value="3"   <?= $check2[3] ?>/>
      
        <input type="text" name="url" id="url" class="noborder" value="<?= $url ?>"  style="width:250px"/>
  </tr>
   
  <tr>
    <td height="25" align="center" valign="top">&nbsp;</td>
    <td height="25" align="left" valign="top"><div id="urldiv" style="display:inline"></div> </td>
  </tr>
  <tr>
    <td height="25" align="right">&nbsp;</td>
    <td height="25">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
  </form>
</div>

</body>
</html>
