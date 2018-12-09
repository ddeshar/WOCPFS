<?php
include("include/class.testlogin.php");
?>
<?
function generatePassword ($length = 8)
{

  // start with a blank password
  $password = "";

  // define possible characters
  $possible = "0123456789"; 
    
  // set up a counter
  $i = 0; 
    
  // add random characters to $password until $length is reached
  while ($i < $length) { 

    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
    // we don't want this character if it's already in the password
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  // done!
  return $password;

}

		foreach($_REQUEST as $key => $value) {
			$$key = $value;
			//echo $key . " => " . $value . "<BR>";
		}
		$error1 = $error2 = $error3 = $error4 =0;
		$pass = false;
		if($action == "generate") {
			if(!isset($group)) $error1 = 1;
			if(empty($username)) $error2 = 1;
			if(empty($numadd)) $error3 = 1;
			if(empty($passC)) $error4 = 1;
			if($error1 == 0 && $error2 == 0 && $error3 == 0 && $error4 == 0) {
				$pass = true;
				$sql = "select * from genuser where userprefix = '$username'";
				// echo $sql;
				$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				if(mysqli_num_rows($result) == 0) {
					$start = 1;
				} else {
					$data = mysqli_fetch_object($result);
					$start =  $data->userlastno + 1;
				}
				// echo $start;
			}
		} else if($action == "save") {
			$pass = true;
			//print_r($username);
			//print_r($password);
			for($i = 1; $i <= $numadd; $i++) {
				$sql = "insert into account values('".$username[$i]."','".$passC."','".$username[$i]."','".$group."','--','".date("Y-m-d H:i:s")."','clear','1')";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				//echo $sql . "<BR>"; 
				$sql = "insert into radusergroup values('".$username[$i]."','".$group."','1')";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				//echo $sql . "<BR>"; 
				$sql = "INSERT INTO radcheck values(NULL,'".$username[$i]."','Cleartext-Password',':=','".$passC."')";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				//echo $sql . "<BR>"; 
			}
			$sql = "select * from genuser where userprefix = '$prefix'";
			// echo $sql;
			$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			if(mysqli_num_rows($result) == 0) {
				$sql = "insert into genuser values ('$prefix', '$last')";
				//echo $sql;
				
			} else {
				$sql = "update genuser set userlastno = '$last' where userprefix = '$prefix'";
				//echo $sql;
			}
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
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
    <script language="javascript" src="js/show.js"></script>
	<title>-:- Authent!cation -:-</title>
</head>
<body>
<div id="content">
<form id="form1" method="post" action="<? if($pass && $action != "generate") { echo "ThaiPDF/exportPDF.php"; } ?>" <? if($pass && $action != "generate") {  ?> target="_blank"<? } ?>>
<table width="95%" align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
  <tr>
    <td width="6%" align="center"><img src="images/add.png" alt="" width="59" height="60" /></td>
    <td width="38%"><a href="index2.php?option=add_user">Generate Users Excel[.xlsx]</a><br />
<span class="normal">เพิ่มผู้ใช้งานรายใหม่เข้าสู่ระบบจากไฟล์ Excel 2007-&gt;</span></td>
    <td width="56%" align="right">
	<? if(!$pass) { ?>
     <input name="submit" type="submit" class="button" id="submit" value="ประมวลผล" />
	 <? } else { ?>
     <? if($action == "generate") { ?>
     <input name="submit" type="submit" class="button" id="submit" value="บันทึก" />
      <input type="button" name="button2" id="button2" class="button" value="ยกเลิก" onclick="window.location='index2.php?option=add_user'" />
      <? } else { ?>
      <input name="submit2" type="submit" class="button" id="submit2" value="พิมพ์" />
      <? } ?>
      <? } ?>
      </td>
  </tr>
</table>

<? if(!$pass) { ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td colspan="3"><?php 
	if(isset($message)) { echo $message; } 
?>&nbsp;</td>
    </tr>
  <tr>
    <td height="32" align="right">กลุ่มผู้ใช้ :</td>
    <td>      <? $sql = "select * from groups";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$num = mysqli_num_rows($result);
	?>
    
		<span class="normal">
        <? if(!isset($_REQUEST['group'])) { ?>
        กรุณาเลือกกลุ่ม
        <? } else { ?>
        <? 
			$sql = "select * from groups where gname = '".$_REQUEST['group']."'";
			$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$data2 = mysqli_fetch_object($result2);
			echo  "กลุ่ม" . $data2->gdesc ;
		?>
        <? } ?>
        </span><img src="images/b_ar.gif" align="absmiddle" style="cursor:hand"  onClick="showhide(1);event.cancelBubble=1" />
		<div onmouseover="showhide(2);" onmouseout="showhide(0)" id="innermenu" style="position:absolute; width:300px; height:<?= $num * 25 ?>px;background-color:white; visibility:hidden; text-align:left; border: 1px #ddd dashed; padding: 10px 10px 10px 10px; font-weight: normal; line-height: 25px" class="normal">
        <script language="JavaScript1.2">
		
		
		function gl(linkname,dest){
		document.write('<li><a href="'+dest+'">'+linkname+'</a></li>')
		}
		
		function showhide(state){
		var cacheobj=document.getElementById("innermenu").style
		if (state==0)
		cacheobj.visibility="hidden"
		else if(state==2) 
		cacheobj.visibility="visible"
		else
		cacheobj.visibility=cacheobj.visibility=="hidden"? "visible" : "hidden"
		}
		
		//Specify your links here- gl(Item text, Item URL)
		<? while($groups = mysqli_fetch_object($result)) { ?>
		gl("กลุ่ม<?= $groups->gdesc ?>","index2.php?option=add_user&group=<?= $groups->gname ?>&username=<?= $username ?>&numadd=<?= $numadd ?>")
		<? } ?>

		//Extend this list as needed
		
		
		document.onclick=function(){showhide(0)}
		
</script>
</div></td>
    <td><span class="red"><? if($error1) { echo "&laquo; เลือกกลุ่มด้วยครับ"; } ?> </span>&nbsp;</td>
  </tr>
  
  <tr>
    <td width="32%" align="right">คำขึ้นต้นชื่อผู้ใช้ :</td>
    <td width="33%"><input name="username" type="text" class="noborder2" id="username" value="" />
      <input name="action" type="hidden" id="action" value="generate" /> </td>
    <td width="35%"><span class="red"><? if($error2) { echo "&laquo; ระบุคำขึ้นต้นชื่อผู้ใช้ด้วยครับ"; } ?> </span>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">จำนวนที่ต้องการสร้าง :</td>
    <td><input name="numadd" type="text" class="noborder2" id="numadd" value="<?= $numadd ?>" /> </td>
    <td><span class="red"><? if($error3) { echo "&laquo; ระบุจำนวนที่ต้องการสร้างด้วยครับ"; } ?> </span>&nbsp;</td>
  </tr>
   <tr>
    <td align="right">Password เริ่มต้นของทุก User :</td>
    <td><input name="passC" type="text" class="noborder2" id="passC" value="" /> </td>
    <td><span class="red"><? if($error4) { echo "&laquo; กำหนด Password เริ่มต้นด้วยครับ"; } ?> </span>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? } else { ?>
<?	$sql = "select * from groups where gname = '$group'";
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$data = mysqli_fetch_object($result);
?>
<? if($action == "generate") { ?>
<table width="95%" align="center" cellspacing="1" class="admintable">

 
    <tr>
      <td height="35" colspan="5" align="left"> ตารางแสดงรายชื่อสมาชิกที่จะเพิ่มใหม่ในกลุ่ม<?= $data->gdesc ?> ทั้งสิ้น <b class="red">
      
    <?= $numadd ?></b>  คน</td>
      </tr>
    
    <tr>
      <td width="94" align="center" class="key">ลำดับที่</td>
      <td width="172" align="center" class="key">ชื่อผู้ใช้งาน</td>
      <td width="188" align="center" class="key">รหัสผ่าน</td>
      <td width="162" align="center" class="key">วันหมดอายุ</td>
      <td width="276" align="center" class="key">ความเร็วเน็ต<br /> 
        (ดาวน์โหลด / อัพโหลด)</td>
      </tr>
    <?php 
		$count = 0;
		for($i=0; $count < $numadd; $i++) { 
			($i % 2 == 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
				$newuser = sprintf("%s%d", $username, $start + $i);
			$newpass =  generatePassword(8);
			//$passC = $newpass ;
			$sql = "select * from account where username = '".$newuser."'";
			if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))) {
				continue;
			} else {
				$count++;
			}
		?>
    <tr>
      <td width="94" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $count ?></td>
      <td width="172" align="center" valign="top" bgcolor="<?= $bgcolor ?>">
          <input id="username[<?= $count ?>]" name="username[<?= $count ?>]" type="hidden" value="<?= $newuser ?>"  /><?= $newuser ?>            </td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>">
      
        <input id="password[<?= $count ?>]" name="password[<?= $count ?>]" type="hidden" value="<?= $passC ?>" /><?=$passC ?>             </td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $data->gexpire ?></td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $data->gdownload?>/<?= $data->gupload ?> KB    </td>
      </tr>
    <? } 		
 ?>
  </table>
  <input name="last" type="hidden" value="<?= $start + $count ?>" />
  <input name="prefix" type="hidden" value="<?= $username ?>" />
  <input name="action" type="hidden" value="save" />
  <input name="numadd" type="hidden" value="<?= $numadd ?>" />
  <input name="passC" type="hidden" value="<?= $passC ?>" />
  
<? } else { ?>
<table width="95%" align="center" cellspacing="1" class="admintable">

 
    <tr>
      <td height="43" colspan="5" align="center"><font color="#009900">บันทึกข้อมูลผู้ใช้ใหม่เรียบร้อยแล้ว</font></td>
    </tr>
    <tr>
      <td height="35" colspan="5" align="left"> ตารางแสดงรายชื่อสมาชิกที่จะเพิ่มใหม่ในกลุ่ม<?= $data->gdesc ?> ทั้งสิ้น <b class="red">
      
    <?= $numadd ?></b>  คน</td>
      </tr>
    
    <tr>
      <td width="94" align="center" class="key">ลำดับที่</td>
      <td width="172" align="center" class="key">ชื่อผู้ใช้งาน</td>
      <td width="188" align="center" class="key">รหัสผ่าน</td>
      <td width="162" align="center" class="key">วันหมดอายุ</td>
      <td width="276" align="center" class="key">ความเร็วเน็ต<br />
        (ดาวน์โหลด / อัพโหลด)</td>
      </tr>
    <?php 
			for($i = 1; $i <= $numadd; $i++) {
		
		?>
    <tr>
      <td width="94" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $i ?></td>
      <td width="172" align="center" valign="top" bgcolor="<?= $bgcolor ?>">
          <input id="username[<?= $i ?>]" name="username[<?= $count ?>]" type="hidden" value="<?= $username[$i] ?>"  /><?= $username[$i] ?>            </td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>">
      
        <input id="password[<?= $i ?>]" name="password[<?= $count ?>]" type="hidden" value="<?= $passC ?>" /><?= $passC ?>             </td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $data->gexpire ?></td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $data->gdownload?>/<?= $data->gupload ?> KB    </td>
      </tr>
    <? } 		
 ?>
  </table>
    <input name="last" type="hidden" value="<?= $start + $count ?>" />
  <input name="prefix" type="hidden" value="<?= $username ?>" />
  <input name="action" type="hidden" value="print" />
  <input name="group" type="hidden" value="<?= $group ?>" />
  <input name="numadd" type="hidden" value="<?= $numadd ?>" />
  <input name="passC" type="hidden" value="<?= $passC ?>" />

<? } ?>
<? } ?>
</form>

</div>
</body>
</html>
