<?php
	include("include/class.mysqldb.php");
	include("include/config.inc.php");
	
	$message = "";
	$username = $firstname = $lastname = $mailaddr = $password = $password2 = $opassword = "";
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
	}
	$error = array();
	for($i = 0; $i < 20; $i++) {
		$error[$i] = false;
	}
	
	if(isset($button)) {
		# check firstname
		# check username
		if(empty($username)) {
			$error[3] = true;
		}
		if(empty($opassword)) {
			$error[1] = true;
		}
		
		# check username duplicate
		$sql = "select * from account where username = '$username'";
		$link1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$data = mysqli_fetch_object($link1);
		if ($data->encryption=='clear'){
		   $p1=$data->password;
		   $p2=$opassword;
		} else {
		   $p1=$data->password;
		   $p2=$opassword;
		}
		if ($p1 != $p2) {
		   $error[4] = true;
		}
		
		# check password
		if(empty($password)) {
			$error[5] = true;
		}
		if(!$error[5]) {
			if(strlen($password) < 4) {
				$error[6] = true;
			}
		}
		
		# check password2
		if(empty($password2)) {
			$error[7] = true;
		}
		
		if(!$error[7]) {
			if(strlen($password2) < 4) {
				$error[8] = true;
			}
		}

		# check password and confirm password
		if(!$error[5] && !$error[6] && !$error[7] && !$error[8]) {
			if($password != $password2) {
				$error[9] = true;
			}
		}
		$pass = true;
		for($i = 0; $i <= 9; $i++) {
			if($error[$i]) {
				$pass = false;
			}
		}
		if($pass) {
			$newpass = $password;
			$sql = "SELECT * FROM account where username = '$username'";
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$sql = "update account set password = '$newpass' where username = '$username'";
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$sql = "update radcheck set value = '$newpass' where username = '$username' and attribute = 'Cleartext-Password'";
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$message = "บันทึกข้อมูลของคุณเรียบร้อยแล้ว";
	        $username = $firstname = $lastname = $mailaddr = $password = $password2 = "";
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
    <link href="css/calendar-mos.css" type=text/css rel=stylesheet>
    <script language="javascript" src="js/calendar.js"></script>
<script>
function stoperror(){
return true
}
window.onerror=stoperror
</script>
<title>-:- ChangePassword -:-</title>
</head>
<body>
	<div id="header-bar">
		<div id="header-logoff"><a href="../">หน้าหลัก</a> &raquo; เปลี่ยนรหัสผ่าน</div>
    </div>
    <div id="body">
    	<a href="password.php">
    	<h3>Change<span class="gray"> Password</span></h3>
    	</a>
            <div id="slogan"><span class="style1">กรุณากรอกข้อมูล</span></div>
            
	<form action="" method="post" name="regis">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td colspan="2" align="center"><?php if(!empty($message)) { echo "<BR>".$message; } ?>&nbsp;</td>
              </tr>
            
            <?php if(!empty($message)) {  ?>
              <tr>
                <td colspan="2" align="center"><BR /><input name="" type="button" class="button" value="เข้าสู่ระบบ" onclick="window.location='http://<?php echo $_SERVER['SERVER_ADDR'] ?>:8002/index.html'" style="cursor:hand" /></td>
              </tr>
            <?php } ?>
	        <?php if(empty($message)) { ?>
			<?php if($error[4]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ชื่อผู้ใช้กับรหัสผ่านเดิม : ไม่ตรงกัน</td>
              </tr>
            <?php } ?>
			  <?php if($error[3]) { ?>
              <tr>
                <td width="21%" align="right">&nbsp;</td>
                <td width="79%" class="red">กรุณากรอกชื่อผู้ใช้ของคุณด้วยครับ</td>
              </tr>
            <?php } ?>
              <tr>
                <td align="right">ชื่อผู้ใช้ :</td>
                <td><label>
                  <input name="username" type="text" class="inputbox-normal" id="username" style="background: <?php if($error[3] || $error[4]) echo "#FFF0F0"; ?>" value="<?php echo $username ?>">
                 <span class="red">*</span></label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><span class="comment">กรอกเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น</span></td>
              </tr>
            <?php if($error[1]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกรหัสผ่านเดิมด้วยครับ</td>
              </tr>
	        <?php } ?>
			   <td align="right">รหัสผ่านเดิม :</td>
                <td><label>
                  <input name="opassword" type="password" class="inputbox-normal" id="opassword"  style="background: <?php if($error[10] || $error[4]) echo "#FFF0F0"; ?>" value="<?php echo $opassword ?>">
                 <span class="red">*</span></label></td>
              </tr>
            <?php if($error[5]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกรหัสผ่านใหม่ด้วยครับ</td>
              </tr>
			<?php } ?>
			 <tr>	
               <tr>
                <td align="right">รหัสผ่านใหม่ :</td>
                <td><label>
                  <input name="password" type="password" class="inputbox-normal" id="password"  style="background: <?php if($error[5] || $error[6] || $error[9]) echo "#FFF0F0"; ?>" value="<?php echo $password ?>">
                 <span class="red">*</span></label></td>
              </tr>
           <?php if($error[6]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ความยาวของรหัสผ่านต้องมียาวอย่างน้อย 4 อักขระครับ</td>
              </tr>
 			<?php } ?>
			    <tr>
                <td align="right">&nbsp;</td>
                <td class="comment">ความยาวอย่างน้อย 4 อักขระ</td>
              </tr>
            <?php if($error[7]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณายืนยันรหัสผ่านด้วยครับ</td>
              </tr>
            <?php } ?>
            <?php if($error[8]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ความยาวของรหัสผ่านต้องยาวอย่างน้อย 4 อักขระครับ</td>
              </tr>
            <?php } ?>
            <?php if($error[9]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">รหัสผ่านทั้งสองไม่ตรงกัน</td>
              </tr>
            <?php } ?>
              <tr>
                <td align="right">ยืนยันรหัสผ่าน :</td>
                <td><label>
                  <input name="password2" type="password" class="inputbox-normal" id="password2"  style="background: <?php if($error[7] || $error[8] || $error[9]) echo "#FFF0F0"; ?>" value="<?php echo $password2 ?>">
                <span class="red">*</span> </label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><label>
                  <input type="submit" name="button" id="button" class="button" value="ส่งข้อมูล">
                </label></td>
              </tr>
            <?php } ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
	</form>
    </div>
</body>
</html>
