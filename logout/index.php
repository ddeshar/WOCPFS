<?php
header("Expires: 0");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Connection: close");
//
include("captiveportal-configsite.php"); 
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>Authent!cation Logout</title>
<script language="JavaScript" type="text/javascript">
 /* 
 window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    return "คุณต้องการปิดหน้าต่างนี้ ใช่ไหม";
  }
  */
</script>
<!-- Stylesheets -->
<link rel="stylesheet" href="captiveportal-style.css" type="text/css" media="all">

<!-- Optimize for mobile devices -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
</head>
<body>

<!-- login-intro -->
<div id="header">
	<div id="login-intro">
    	<img src="captiveportal-logo.png" align="middle" alt="<? echo "$school_name";?>"/>
		<h1><?=$site_nameTh;?></h1><br>
        <h2><?=$site_nameEn;?></h2>

    </div> 
</div>

<!-- logout-box -->
<div id="login-box">
<div id="login" class="login">
<h1>
<?php
$clientip = $_SERVER['REMOTE_ADDR'];
$db = new SQLite3("/var/db/captiveportalbuwifi.db"); // ให้เปลี่ยนชื่อ captiveportal ในที่นี้้ คือ captiveportalbuwifi.db
$results = $db->query("SELECT * FROM captiveportal WHERE ip='$clientip'");
while ($row = $results->fetchArray()) {
$sessionid=$row['sessionid'];
$username=$row['username'];
$macaddress=$row['mac'];
}
if($sessionid=="") {
	echo "<p><b>หมายเลขไอพี  : <font color=blue> $clientip </font></p>
	<p>ไม่มีผู้ใช้งานค้างอยู่ในระบบ</p>
	<p><font color=blue>กรุณาคลิกปุ่มข้างล่าง  เพื่อเข้าสู่ระบบ</font></b><p>
	<p><a href='http://LAN_IP:8002/index.php?zone=buwifi'><input type='button' value='เข้าสู่หน้าล๊อกอิน' class='button button-primary ic-right-arrow'></a></p><br/>
	<p>หรือคลิกปุ่มข้างล่าง  เพื่อเปลี่ยนรหัสผ่าน</p>
	<p><a href='http://LAN_IP/admin/pass.php'><input type='button' value=' เปลี่ยนรหัสผ่าน ' class='button2 button-primary2 ic-right-arrow'></a></p>
	";
//ให้เปลี่ยนไอพีเซอร์เวอร์ ในที่นี้คือ LAN_IP และชื่อ zone captiveportal ในที่นี้้ คือ buwifi
$db->close();

}
else{
echo "<p><span class='text'><b><font color=red>กรุณา...อย่าปิด X หน้าต่างนี้...! </font></b></p>
<p>สวัสดี  :  <font color=blue> $username </font></p> 
<p>หมายเลขไอพี  คือ  <font color=blue> $clientip </font></p>
<p>Mac Address คือ  <font color=blue> $macaddress </font></p>
<p><font color=blue>กดปุ่มด้านล่าง  เมื่อต้องการเข้าสู่ระบบอินเทอร์เน็ต</font></p>
<!--<p><a href='http://www.google.co.th' target='_blank'> Go to<br/>Internet</a></p> -->
<p><a href='http://www.phoubon.in.th' target='_blank'><input type='button' value=' เข้าสู่อินเทอร์เน็ต ' class='button button-primary ic-right-arrow'></a></p>
<p><span class='text'>เลิกใช้งานให้คลิกที่ปุ่ม <b><font color=red>Logout </font></b>เพื่อออกจากระบบ</p>
	<form method='POST' action='http://LAN_IP:8002/'>
	<input name='logout_id' type='hidden' value='$sessionid'>
	<input name='zone' type='hidden' value='buwifi'> 
    <input name='logout' type='submit' value='  <<< Logout >>>  ' class='button2 button-primary2 ic-right-arrow' />
</form>
";
//ให้เปลี่ยนไอพีเซอร์เวอร์ ในที่นี้คือ LAN_IP และชื่อ zone captiveportal ในที่นี้้ คือ buwifi

$db->close();
}

?>

</h1>
</div>
</div>

<div class="footer-address">
<p><?=$site_address;?></p>
</div>

</body>
</html>