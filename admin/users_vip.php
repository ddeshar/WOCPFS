<?php
# ถ้าไม่ได้ผ่านการล็อกอินเข้ามาให้ย้อนกลับไปหน้าล็อกอินใหม่!
if(!isset($_SESSION['logined'])) {
	?><meta http-equiv="refresh" content="0;url=index.php"><?
} 
$group = $_REQUEST['group'];
$cclmac = $_POST['cclmac'];
$users = $_POST['users'];
$Idedit= $_REQUEST['Idedit'];
if($cclmac!=""){	
	if($Idedit!=""){
mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `radcheck` SET `username` = '$cclmac' WHERE username ='$Idedit'");
mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE account SET username = '$cclmac',firstname= '$users' WHERE username ='$Idedit'");

$sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT* FROM`radusergroup` WHERE username ='$Idedit'");
$num=mysqli_num_rows($sql);
if($num<0){
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `radusergroup` (`username` , `groupname` , `priority` ) VALUES ( '$cclmac','$group','1');");
			}else{

			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `radusergroup` SET `username`='$cclmac', `groupname`='$group' WHERE username ='$Idedit'");
			}


	}else{
$sql = "SELECT max(id) as id FROM radcheck"; 
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
$request = mysqli_fetch_array($result);
$num=$request[id];
$num=$num+1;
//mysql_query("INSERT INTO `radusergroup`  (`username` ,`groupname` ,`priority`) values ('$cclmac','$group','1');");
mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `radusergroup` (`username` , `groupname` , `priority` ) VALUES ( '$cclmac','$group','1');");

mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `radcheck` ( `id` , `username` , `attribute` , `op` , `value` ) VALUES ('$num' , '$cclmac', 'Auth-Type', ':=', 'Accept');");
mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `account` (`username` ,`password` ,`firstname` ,`lastname` ,`mailaddr` ,`dateregis` ,`encryption` ,`status` ) VALUES ('$cclmac', '', '$users', '', '', '', '', '1');");
}
	echo "<META http-equiv='refresh' CONTENT='0; URL=index2.php?option=manage_vip'>";	
}

if($Idedit!=""){
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT  * FROM radcheck,account WHERE account.username=radcheck.username and radcheck.username='$Idedit'");
$array = mysqli_fetch_array($result);



}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/calendar-mos.css" type="text/css" rel="stylesheet"/>
   
	<script language="javascript" src="js/calendar.js"></script>
	<script>
		function stoperror() {
			return true
		}
		window.onerror = stoperror
	</script>
	
	<title>Users VIP allow-Mac-authent!cation</title>
</head>
<body>
	<table width="95%" align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
	<tr>
		<td width="6%" align="center"><img src="images/users.png" alt="" width="48" height="48" /></td>
		<td width="38%">
			<a href="index2.php?option=users_vip">
				Add Users VIP Allowed Mac Address
			</a>
		</td>
	</tr>
	</table>
    <SCRIPT>
function validator3(lang)
{
if(document.frm2.users.value==""){ if (lang=="e") { alert("Please "); } else { alert("กรุณาระบุ ชื่อ - นามสกุล"); }document.frm2.users.focus();return false;}
if(document.frm2.cclmac.value==""){ if (lang=="e") { alert("Please "); } else { alert("กรุณาระบุ MAC-Allowed"); }document.frm2.cclmac.focus();return false;}
}
</SCRIPT>
	<div id="slogan"><span class="style1">กรุณากรอกข้อมูลเพื่อใช้ในการสมัครขอใช้บริการอินเตอร์เน็ต</span></div>

	<form method="post" name="frm2" action="index2.php?option=users_vip"onSubmit="return validator3('t')">
		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
		<tbody>
		<tr><td colspan="1">เพิ่มผู้ใช้แบบไม่จำกัด Unlimit Users VIP</td></tr>
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
		gl("กลุ่ม<?= $groups->gdesc ?>","index2.php?option=users_vip&group=<?= $groups->gname ?>&username=<?= $username ?>&numadd=<?= $numadd ?>&Idedit=<?= $Idedit ?>")
		<? } ?>

		//Extend this list as needed
		
		
		document.onclick=function(){showhide(0)}
		
</script>
</div></td>
    <td><span class="red"><? if($error1) { echo "&laquo; เลือกกลุ่มด้วยครับ"; } ?> </span>&nbsp;</td>
  </tr>
				<tr>
			<td align="right">ชื่อ - นามสกุล :</td>
			<td>
			<input name="Idedit" type="hidden"  value="<?= $Idedit?>">
			<input name="group" type="hidden"  value="<?= $group?>">
				<input name="users" type="text" class="inputbox" id="users" value="<?= $array[firstname]?>">
			</td>
		</tr>
		<tr>
			<td align="right">VIP-MAC-Allowed :</td>
			<td>
				<input name="cclmac" type="text" maxlength="17" class="inputbox" id="cclmac" value="<?= $array[username] ?>">
				<font color = 'red'>*รูปแบบ 00-1A-92-D0-61-2E</font>
			</td>
		</tr>		      			
		<tr>
			<td>&nbsp;</td>
			<td>
	
					<input  type="submit" class="button" id="btnsave" value="บันทึก"/>
					&nbsp;
					<input  type="submit" class="button" id="btnclose" value="ยกเลิก" onclick="<meta http-equiv='refresh'content='0;url=index2.php?option=addhous'>"/>
		
			</td>
		</tr>
		</tbody>
		</table>
	</form>
</body>
</html>
