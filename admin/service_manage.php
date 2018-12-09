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
    <style type="text/css">
<!--
.style2 {color: #FFFFFF}
-->
    </style>
</head>
<body>
<div id="content">

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center"><img src="images/service_mng.png" alt="" width="48" height="48" /></td>
    <td width="94%"><a href="index2.php?option=service_manage">Service Management</a><br />
<span class="normal">จัดการเซอร์วิส</span></td>
    <td width="94%">&nbsp;</td>
  </tr>
</table>
 <?php
//	include("include/class.mysqldb.php");
//	include("include/config.inc.php");
	if(!isset($_SESSION['logined'])) {
		?><meta http-equiv="refresh" content="0;url=index.php"><?
	} 
	
?>
<table width="629" border="0" align="center">
  <tr>
    <td width="81">&nbsp;</td>
    <td width="221">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="167">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#666666"><span class="style2">&nbsp;&nbsp;&nbsp;ปิดระบบ หรือ เริ่มระบบไหม่ </span></td>
    <td></td>
    <td><form action="reboot.php" method="post">
        <input type="submit" class="button" value="reboot" />
    </form></td>
    <td><form action="shutdown.php" method="post">
      <input name="submit" type="submit" class="button" value="shutdown" />
    </form></td>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#666666"><span class="style2"> &nbsp;&nbsp;&nbsp;จัดการ Squid Proxy </span></td>
    <td></td>
    <td><form action="squidreload.php" method="post">
        <input type="submit" class="button" value="reload" />
    </form></td>
    <td><form action="squidrestart.php" method="post">
        <input type="submit" class="button" value="restart" />
    </form></td>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#666666">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#666666">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#666666">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#666666">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
</body>
</html>
