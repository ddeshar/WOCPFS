<?php
include("include/class.testlogin.php");
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
<div class="header">
<table width="100%" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td width="6%" align="center"><img src="images/objects.png" alt="" width="48" height="48" /></td>
    <td width="94%"><a href="index2.php?option=import_data">Connect Database</a><br />
<span class="normal">เชื่อมโยงข้อมูลผู้ใช้จากระบบสารบัญเข้าสู่ระบบ</span></td>
    <td width="94%">&nbsp;</td>
  </tr>
</table>
 
</div>

<form id="form1" method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td colspan="2"><?php 
	if(isset($message)) { echo $message; } else { ?>
<? } ?></td>
    </tr>
  <tr>
    <td width="36%" align="right">ชื่อเครื่องฐานข้อมูล :</td>
    <td width="64%">
      <p>
        <input name="pass1" type="text" class="inputbox" id="pass1" value="" />
      </p>    </td>
  </tr>
  <tr>
    <td align="right">ชื่อผู้ใช้ :</td>
    <td><input name="pass2" type="text" class="inputbox" id="pass2"/></td>
  </tr>
  <tr>
    <td align="right">รหัสผ่าน :</td>
    <td><input name="pass3" type="password" class="inputbox" id="pass3"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="submit" type="submit" class="button" id="submit" value="เชื่อมโยง" /></td>
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
