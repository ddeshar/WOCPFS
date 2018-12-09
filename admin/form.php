<?php
//	include("include/class.mysqldb.php");
//	include("include/config.inc.php");
	if(!isset($_SESSION['logined'])) {
		?><meta http-equiv="refresh" content="0;url=index.php"><?
	} 
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<style type="text/css">
<!--
.style1 {color: #c40000}
-->
</style>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Burapha Linux Laboratory" />
	<meta name="keywords" content="authentication system" />
	<meta name="description" content="Burapha Linux Authentication Project" />	
    <link href="css/main.css" type=text/css rel=stylesheet>
	<title>-:- Authent!cation -:-</title>
</head>
<body>
<form action="processscript.php" method="post">
  <div id="content">
    <table width="95%" border="0" cellpadding="0" cellspacing="10" class="header">
      <tr>
        <td align="center"><img src="images/BlackNeonAgua_147.png" alt="" width="59" height="60" /></td>
        <td><a href="index2.php?option=manage_interface">Block Web Squid</a><br />
            <span class="normal">บล็อคเว็บผ่าน squid</span></td>
        <td align="right"><span class="style1">
        <input type="submit" class="button" value="บันทึก" />
        </span></td>
      </tr>
    </table>
    <table width="95%" border="0" cellpadding="0" cellspacing="5" class="admintable">
      <tr>
        <td align="center" class="key">Block เว็บ</td>
        <td align="center" class="key">Block ดาวน์โหลดไฟล์</td>
      </tr>
      <tr>
        <td height="39" align="center"><span class="style1">
          <textarea rows="20" cols="35" name="content">
<?
$fn = "/etc/squid3/key.txt";
print htmlspecialchars(implode("",file($fn)));
?> 
      </textarea>
          &nbsp;</span></td>
        <td align="center"><span class="style1">
          <textarea rows="20" cols="20" name="content2">
<?
$fn = "/etc/squid3/download.txt";
print htmlspecialchars(implode("",file($fn)));
?> 
      </textarea>
        </span></td>
      </tr>
      <!-- <tr>
    <td align="right">รหัสผ่านของผู้ใช้มีการเข้ารหัสผ่านหลายวิธี :</td>
    <td>
      <input type="radio" name="multi_encryption" id="multi_encryption" value="1" /> เปิด 
      <input name="multi_encryption" type="radio" id="multi_encryption" value="0"  /> ปิด    </td>
  </tr>
  -->
    </table>
    <br />
    <br />
  </div>
  </form>