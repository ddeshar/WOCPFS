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
			
			 
		$sql = "select * from radacct where radacct.acctstoptime = '0000-00-00 00:00:00'and radacct.userName ='$username'";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$totals = mysqli_num_rows($result);
		if($totals==0){
		  $error[6] = true;
		  echo $totals;
		}	
			
			# check username duplicate
			$sql = "select * from account where username = '$username'";
			$link1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$data = mysqli_fetch_object($link1);
			if($data->password != $opassword) {
				$error[4] = true;
			}else $pass = true;
		
		# check password

		# check password2
			# check password and confirm password
	
		$pass = true;
		for($i = 0; $i <= 9; $i++) {
			if($error[$i]) {
				$pass = false;
			}
		}
		if($pass) {
/*	$shell_command='sudo /bin/echo "User-Name=x1" | /usr/bin/radclient -x 127.0.0.1:3779 disconnect 	sittichai';
		$shell_command= 'echo "User-Name='.$username.'" | radclient -x 127.0.0.1:3779 disconnect namo;
*/
        $shell_command=' /bin/echo "User-Name='.$_REQUEST['user'].'" | /usr/local/bin/radclient -x 127.0.0.1:3779 disconnect  radius_secret';
        $output = shell_exec($shell_command);}
	echo $output;
	$sql="DELETE FROM radacct WHERE radacct.acctstoptime = '0000-00-00 00:00:00' and radacct.username ='$username'";
	$link1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
/*	$data = mysql_fetch_object($link1);*/
				$message = "Clear User  เรียบร้อยแล้วครับ  กรุณากลับไป Login ใหม่";
	
				$username = $firstname = $lastname = $mailaddr = $opassword = $password2 = "";
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
	<title>-:- KicK User -:-</title>
</head>
<body>
	<div id="header-bar">
		<div id="header-logoff">ยินดีต้อนรับ 
        &raquo; ระบบ Clear USER เอง<a href="user_kick.php"></a></div>
    </div>
    <div id="body">
    	<a href="user_kick.php">
    	<h3>KicK<span class="gray">User</span></h3>
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
                <td colspan="2" align="center"><BR /><input name="" type="button" class="button" value="เข้าสู่ระบบ" onclick="window.location='http://<?php echo $_SERVER['SERVER_ADDR'] ?>:8000/index.html'" style="cursor:hand" /></td>
              </tr>
            <? } ?>
	<? if(empty($message)) { ?>

            <? if($error[0]) { ?>
              <tr>
                <td width="21%" align="right">&nbsp;</td>
                <td width="79%" class="red">กรุณากรอกชื่อของคุณด้วยครับ</td>
				<?
					for($i = 0; $i < 20; $i++) {
					$error[$i] = false;	}   
					?>
				</tr>
            <? } ?>
             
                   
            <? if($error[3]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกชื่อผู้ใช้ที่คุณต้องการด้วยครับ</td>
				<?
					for($i = 0; $i < 20; $i++) {
					$error[$i] = false;	}   
					?>
				</tr>

            <? } ?>
                   
				   <? if($error[1]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกรหัสผ่านด้วยครับ</td>
				<?
					for($i = 0; $i < 20; $i++) {
					$error[$i] = false;	}   
					?>
				</tr>

            <? } ?>
				   		   


				   <? if($error[4]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ชื่อหรือรหัสผิดครับ</td>

					<?
					for($i = 0; $i < 20; $i++) {
					$error[$i] = false;	}   
					?>
				</tr>

			<? 
				//	$username = $opassword ="";
			?>
             
            <? } ?>


									   <? if($error[6]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ชื่อนี้ไม่ค้างในระบบ</td>
			  </tr> 
			  <tr>
                <td colspan="2" align="center"><BR /><font color=blue>ท่านควรกลับไปหน้าเข้าสู่ระบบ &nbsp;&nbsp;</font><input name="" type="button" class="button" value="เข้าสู่ระบบใหม่" onclick="window.location='http://<?php echo $_SERVER['SERVER_ADDR'] ?>:8000/index.html'" style="cursor:hand" /></td>
           
				 <?
					for($i = 0; $i < 20; $i++) {
					$error[$i] = false;	}   
					?>
				</tr>

            <? } ?>

              <tr>
                <td align="right">ชื่อผู้ใช้ :</td>
                <td><label>
                  <input name="username" type="text" class="inputbox-normal" id="username" style="background: 
				  <? if($error[3] || $error[4]) echo "#FFF0F0"; ?>" value="<?= $username ?>">
                 <span class="red">*</span></label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><span class="comment">ใช้ชื่อของท่าน</span></td>
              </tr>
            <? if($error[5]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกรหัสผ่านด้วยครับ</td>
              </tr>
			  <tr>
                <td align="right">&nbsp;</td>
                <td><span class="comment">รหัสผ่านของท่าน</span></td>
              </tr>
	<? } ?>
              
           <? if($error[6]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ความยาวของรหัสผ่านต้องยาวอย่างน้อย 8 อักขระครับ</td>
              </tr>
 			<? } ?>
			 <tr>
                <td align="right">รหัสผ่าน :</td>
                <td><label>
                  <input name="opassword" type="password" class="inputbox-normal" id="opassword"  style="background: <? if($error[10] || $error[4]) echo "#FFF0F0"; ?>" value="<?= $opassword ?>">
                 <span class="red">*</span></label></td>
              </tr>
 

           <? if($error[8]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ความยาวของรหัสผ่านต้องยาวอย่างน้อย 8 อักขระครับ</td>
              </tr>
            <? } ?>
         	<? if($error[10]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">รหัสผ่านไม่ถูกต้องครับ</td>
              </tr>
            <? } ?>
                          <tr>
                <td align="right">&nbsp;</td>
                <td><label>
                  <input type="submit" name="button" id="button" class="button" value="clear user">
                </label></td>
              </tr>
             <? } ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>   
	</form>

    </div>
</body>
</html>