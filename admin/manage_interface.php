<?php
include("include/class.testlogin.php");
?>
<?
$message = "";
if(isset($_POST['submit'])) { 
	foreach($_POST as $key => $value) {
		$sql = "update interface set value = '".$value."' where variable = '".$key."'";
		//echo $sql . "<hr>";
		mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	}
	$message = "บันทึกการแก้ไขเรียบร้อยแล้ว";
}
include("include/class.interface.php");
$inf = new interfaces($link);

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
<form id="form1" method="post" action="">

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_160.png" alt="" width="59" height="60" /></td>
    <td width="94%"><a href="index2.php?option=manage_interface">Interface Manager</a><br />
<span class="normal">ปรับแต่งหน้าจอล็อกอิน</span></td>
    <td width="94%" align="right"><input type="submit" name="submit" id="submit" value="บันทึก" class="button" /></td>
  </tr>
</table>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td height="39" colspan="2" align="center"><span class="red">
      <?= $message?>
      &nbsp;</span></td>
    </tr>
  <tr>
    <td height="25" align="right" valign="top">ไตเิติ้ลบาร์ :</td>
    <td height="25" valign="top"><input type="text" name="title" id="title" class="noborder" value="<?= $inf->getTitle() ?>"  style="width:250px"/></td>
  </tr>
  <tr>
    <td width="40%" height="25" align="right" valign="top">ข้อความต้อนรับหน้าแรก :</td>
    <td width="60%" height="25" valign="top"><input type="text" name="please_login" id="please_login" class="noborder" value="<?= $inf->getTextPleaseLogin() ?>"  style="width:250px"/></td>
  </tr>
  <!-- <tr>
    <td align="right">รหัสผ่านของผู้ใช้มีการเข้ารหัสผ่านหลายวิธี :</td>
    <td>
      <input type="radio" name="multi_encryption" id="multi_encryption" value="1" /> เปิด 
      <input name="multi_encryption" type="radio" id="multi_encryption" value="0"  /> ปิด    </td>
  </tr>
  -->
  
  <tr>
    <td align="right" valign="top">ข้อความเมื่อพบว่าเข้าสู่ระบบไม่สำเร็จ :</td>
    <td height="25" valign="top"><input type="text" name="fail_login" id="fail_login" class="noborder" value="<?= $inf->getTextFailLogin() ?>"  style="width:250px"/></tr>
   
  <tr>
    <td height="25" align="right" valign="top">ข้อความอธิบายการใช้งานด้านล่าง :</td>
    <td height="25" align="left" valign="top"><div id="urldiv" style="display:inline">
      <textarea name="footer" rows="5" class="inputbox-normal" id="footer" style="width:300px; border: 1px solid #ddd; margin-top:  0px"><?= $inf->getFooter() ?>
      </textarea>
    </div></td>
  </tr>
  <tr>
    <td height="25" align="right" valign="top">ข้อความอธิบายการใช้งานด้านล่าง (ป๊อบอัพ):</td>
    <td height="25" align="left" valign="top"><div id="urldiv" style="display:inline">
      <textarea name="footer_popup" rows="5" class="inputbox-normal" id="footer_popup" style="width:300px"><?= $inf->getFooterPopUp() ?>
      </textarea>
    </div></td>
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
