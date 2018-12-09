<?php
	include("include/class.mysqldb.php");
	include("include/config.inc.php");
	
?>
<?
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
			if($data->encryption=='clear'){
			 	$p1=$data->password;
				$p2=$opassword;
			} else {
				$p1=$data->password;
				$p2=substr(md5($opassword),0,15);
			}
			if($p1 != $p2) {
				$error[4] = true;
			}
		
		# check password
		if(empty($password)) {
			$error[5] = true;
		}
		if(!$error[5]) {
			if(strlen($password) < 6) {
				$error[6] = true;
			}
		}
		# check password2
		if(empty($password2)) {
			$error[7] = true;
		}
		if(!$error[7]) {
			if(strlen($password2) < 6) {
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
			switch($data->encryption) {
				case 'md5' : $newpass = substr(md5($password),0,15); break;
				case 'crypt' : $newpass = crypt($password,"BL"); break;
				default : $newpass = $password; break;
			}
			$sql = "SELECT * FROM account where username = '$username'";
			//echo $sql;
			$link->query($sql);
			$conf = $link->getnext();
			//echo $conf->value;
			$sql = "update account set password = '$newpass' where username = '$username'";
			//echo $sql;
			$link->query($sql);
			
			$sql = "update radcheck set value = '$newpass' where username = '$username'";
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			//$sql = "INSERT INTO radcheck VALUES ('', '$username', 'Cleartext-Password', '==', '$password'";
			//mysql_query($sql);
			
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
		<div id="header-logoff">ยินดีต้อนรับ 
        &raquo; เปลี่ยนพาสเวิร์ด<a href="changepass.php"></a></div>
    </div>
    <div id="body">
    	<a href="changepass.php">
    	<h3>Change<span class="gray">Password</span></h3>
    	</a>
            <div id="slogan"><span class="style1">กรุณากรอกข้อมูล</span></div>
            
	<form action="" method="post" name="regis">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td colspan="2" align="center"><?php 
	if(!empty($message)) { echo "<BR>".$message; } 
?>&nbsp;</td>
      </tr>
            
          <? if(!empty($message)) {  ?>
              <tr>
                <td colspan="2" align="center"><BR /><input name="" type="button" class="button" value="ล๊อกอิน" onclick="window.location='http://<?= $_SERVER['SERVER_ADDR'] ?>:3990/prelogin'" style="cursor:hand" /></td>
              </tr>
            <? } ?>
	<? if(empty($message)) { ?>
			 <? if($error[4]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ชื่อผู้ใช้กับรหัสผ่านเดิม : ไม่ตรงกัน</td>
              </tr>
            <? } ?>
			  <? if($error[3]) { ?>
              <tr>
                <td width="21%" align="right">&nbsp;</td>
                <td width="79%" class="red">กรุณากรอกชื่อผู้ใช้ของคุณด้วยครับ</td>
              </tr>
            <? } ?>
              <tr>
                <td align="right">&#3594;&#3639;&#3656;&#3629;&#3612;&#3641;&#3657;&#3651;&#3594;&#3657; :</td>
                <td><label>
                  <input name="username" type="text" class="inputbox-normal" id="username" style="background: <? if($error[3] || $error[4]) echo "#FFF0F0"; ?>" value="<?= $username ?>">
                 <span class="red">*</span></label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><span class="comment">กรอกเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น</span></td>
              </tr>
            <? if($error[1]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกรหัสผ่านเดิมด้วยครับ</td>
              </tr>
	<? } ?>
			   <td align="right">รหัสผ่านเดิม :</td>
                <td><label>
                  <input name="opassword" type="password" class="inputbox-normal" id="opassword"  style="background: <? if($error[10] || $error[4]) echo "#FFF0F0"; ?>" value="<?= $opassword ?>">
                 <span class="red">*</span></label></td>
              </tr>
            <? if($error[5]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกรหัสผ่านใหม่ด้วยครับ</td>
              </tr>
			<? } ?>
			 <tr>	
               <tr>
                <td align="right">&#3619;&#3627;&#3633;&#3626;&#3612;&#3656;&#3634;&#3609;ใหม่ :</td>
                <td><label>
                  <input name="password" type="password" class="inputbox-normal" id="password"  style="background: <? if($error[5] || $error[6] || $error[9]) echo "#FFF0F0"; ?>" value="<?= $password ?>">
                 <span class="red">*</span></label></td>
              </tr>
           <? if($error[6]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ความยาวของรหัสผ่านต้องมียาวอย่างน้อย 6 อักขระครับ</td>
              </tr>
 			<? } ?>
			    <tr>
                <td align="right">&nbsp;</td>
                <td class="comment">ความยาวอย่างน้อย 6 อักขระ</td>
              </tr>
           <? if($error[7]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณายืนยันรหัสผ่านด้วยครับ</td>
              </tr>
            <? } ?>
           <? if($error[8]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ความยาวของรหัสผ่านต้องยาวอย่างน้อย 5 อักขระครับ</td>
              </tr>
            <? } ?>
           <? if($error[9]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">รหัสผ่านทั้งสองไม่ตรงกัน</td>
              </tr>
            <? } ?>
              <tr>
                <td align="right">&#3618;&#3639;&#3609;&#3618;&#3633;&#3609;&#3619;&#3627;&#3633;&#3626;&#3612;&#3656;&#3656;&#3634;&#3609; :</td>
                <td><label>
                  <input name="password2" type="password" class="inputbox-normal" id="password2"  style="background: <? if($error[7] || $error[8] || $error[9]) echo "#FFF0F0"; ?>" value="<?= $password2 ?>">
                <span class="red">*</span> </label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><label>
                  <input type="submit" name="button" id="button" class="button" value="ส่งข้อมูล">
                </label></td>
              </tr>
             <? } ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
	</form>
<div id="footer">
    </div>

<div style="line-height: 18px">
            <br />
        ปรับปรุงเพิ่มเติม: <a href="http://www.tansumhospital.go.th" target="_blank">ศูนย์เทคโนโลยีสารสนเทศโรงพยาบาลตาลสุม</a> จังหวัดอุบลราชธานี<br />
			ออกแบบและพัฒนาระบบ: <a href="http://bls.buu.ac.th/" target="_blank">ห้องปฏิบัติการวิจัยลีนุกซ์</a>
		</div>
    </div>
</body>
</html>
