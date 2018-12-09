<?php
include("include/class.testlogin.php");
?>
<?php
	// print_r($_REQUEST);
	$newup = $newdown = 0;
	$newexpire = "0000-00-00";
	if(isset($_REQUEST['action'])) { 
		$sql = "select * from groups where gid = '".$_REQUEST['gid']."'"; 
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$group = mysqli_fetch_object($result);

		switch($_REQUEST['action']) {
/*
			case 'lock' : 
				$sql = "update account set status = '0' where username = '".$_REQUEST['user']."'";
				mysql_query($sql);
				$message = "<font color=green>ล็อกผู้ใช้ที่ต้องการเรียบร้อยแล้ว</font>";
				break;
			case 'unlock' : 
				$sql = "update account set status = '1' where username = '".$_REQUEST['user']."'";
				mysql_query($sql);
				$message = "<font color=green>ปลดล็อกผู้ใช้ที่ต้องการเรียบร้อยแล้ว</font>";
				break;
*/
			case 'delete' : 
			    
				$sql = "DELETE FROM radcheck where username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "DELETE FROM radusergroup  where username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "DELETE FROM account where username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "update account set status = '-1' where username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$message = "<font color=green>ลบผู้ใช้ที่ต้องการออกจากระบบเรียบร้อยแล้ว</font>";
				break;
			case 'move' :
			if($_POST["group"]=="del"){
	
								foreach($_POST["user"] as $username){
								$sql = "DELETE FROM radcheck where username = '".$username."'";
								mysqli_query($GLOBALS["___mysqli_ston"], $sql);
								$sql = "DELETE FROM radusergroup  where username = '".$username."'";
								mysqli_query($GLOBALS["___mysqli_ston"], $sql);
								$sql = "DELETE FROM account where username = '".$username."'";
								mysqli_query($GLOBALS["___mysqli_ston"], $sql);
								$sql = "update account set status = '-1' where username = '".$username."'";
								mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						}
										$message = "<font color=green>ลบข้อมูลเรียบร้อยแล้ว</font>";

					}else{
				if(isset($_GET["user"])){
					$sql = "update radusergroup  set groupname = '".$_GET["group"]."' where username = '".$_REQUEST['user']."'";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				}else{
					foreach($_POST["user"] as $username){
						$sql = "update radusergroup  set groupname = '".$_POST['group']."' where username = '".$username."'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
				}				$message = "<font color=green>ย้ายกลุ่มเรียบร้อยแล้ว</font>";
}
			//	echo $sql;
				break;
			case 'edit' :
				break;
			case 'success' :
				 $message = "<font color=green>บันทึกข้อมูลการแก้ไขเรียบร้อยแล้ว</font>";
				break;
			case 'saveadd' :
				$error = 0;
				$newup = $_REQUEST['newgroupupload'];
				$newdown = $_REQUEST['newgroupdownload'];
				$newexpire = $_REQUEST['newgroupexpire'];
				if(trim($_REQUEST['newgroupdesc']) == '') {
					$error = 1;
					$message = "<span class=\"alert\">กรุณากรอกชื่อกลุ่มด้วย</span>";
				} else {
					$sql = "select * from groups where gdesc = '".trim($_REQUEST['newgroupdesc'])."'";
					if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))) {
						$message = "<span class=\"alert\">ชื่อกลุ่ม '".trim($_REQUEST['newgroupdesc'])."' ซ้ำ กรุณาเปลี่ยนชื่อกลุ่มใหม่</span>";
						$error = 1;
					} else {
						if($newdown != 0) {
//							$down = $newdown * 1024 * 8;
							$down = $newdown * 1024;
							$sql = "insert into radgroupreply values (NULL, 'group".$_REQUEST['newgname']."', 'WISPr-Bandwidth-Max-Down', ':=', '$down')";
							mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						}
						if($newup != 0) {
//							$upload = $newup * 1024 * 8;
							$upload = $newup * 1024;
							$sql = "insert into radgroupreply values (NULL, group'".$_REQUEST['newgname']."', 'WISPr-Bandwidth-Max-Up', ':=', '$upload')";
							mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						}
						$sql = "insert into groups values(NULL,'group".$_REQUEST['newgname']."','".$_REQUEST['newgroupdesc']."', '$newup', '$newdown', '0', '$newexpire', 'clear', '1')";
					//	echo $sql;
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						
							$message = "<font color=green>บันทึกข้อมูลกลุ่มใหม่เรียบร้อยแล้ว</font>";
						}
				}
				break;
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
	<title>-:- Authent!cation -:-</title>
</head>
<body>
<div id="content" style="display:inline-block;">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10"  class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_246.png" alt="" width="48" height="48" /></td>
    <td width="46%"><a href="index2.php?option=manage_user">User Manager</a><br />
<span class="normal">จัดการข้อมูลผู้ใช้งานระบบ</span></td>
    <td width="48%" align="right" valign="bottom">
      <?php $sql = "select * from groups";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$num = mysqli_num_rows($result);
	?>
    
		<span class="normal">        <?php if(!isset($_GET["group"])) { ?>
        กรุณาเลือกกลุ่ม
        <?php } else { ?>
        <?php 
			$sql = "select * from groups where gname = '".$_GET["group"]."'";
			$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$data2 = mysqli_fetch_object($result2);
			echo  "กลุ่ม  " .   $data2->gdesc . "";
		?>
        <?php } ?>
&nbsp;</span><img src="images/b_ar.gif" align="absbottom"  onClick="showhide(1);event.cancelBubble=1" style="cursor:hand" />
		<div onmouseover="showhide(2);" onmouseout="showhide(0)" id="innermenu" style="position:absolute; width:300px; height:<?= $num * 25 ?>px;background-color:white; visibility:hidden; text-align:left; border: 1px #ddd dashed; padding: 10px 10px 10px 10px; font-weight: normal" class="normal">
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
		<?php while($groups = mysqli_fetch_object($result)) { ?>
		gl("กลุ่ม <?= $groups->gdesc ?>","index2.php?option=manage_user&group=<?= $groups->gname ?>")
		<?php } ?>

		//Extend this list as needed
				
		document.onclick=function(){showhide(0)}
		
</script>
</div>
    </td>
  </tr>
</table>
<?php if(isset($_REQUEST['action']) && ($_REQUEST['action'] == "edit" || $_REQUEST['action'] == "save" )) { 
				 $message = "กรุณากรอกข้อมูลในช่องที่ท่านต้องการแก้ไขแล้วคลิกบันทึก<BR>";
	$sql = "SELECT * FROM account where username = '".$_REQUEST['user']."'";
			//echo $sql;
	$link->query($sql);
	$users = $link->getnext();
	
		foreach($_REQUEST as $key => $value) {
			$$key = $value;
			//echo $key . " => " . $value . "<BR>";
		}
	if($_REQUEST['action'] == "save") {
		$error = array();
		for($i = 0; $i < 20; $i++) {
			$error[$i] = false;
		}
		# check firstname
		if(empty($firstname)) {
			$error[0] = true;
		} 
		# check lastname
		if(empty($lastname)) {
			$error[1] = true;
		}
		# check mailaddr
		if(empty($mailaddr)) {
			$error[2] = true;
		}
		# check username
		if(empty($username)) {
			$error[3] = true;
		}
		
		if(!$error[3]) {
			# check username duplicate
			if($user != $username) {
				$sql = "select * from account where username = '$username'";
				// echo $sql;
				$link->query($sql);
				if($link->num_rows() > 0) {
					$error[4] = true;
				}
			}
		}
		
		# check password

		# check password and confirm password
			if($password != $password2) {
				$error[9] = true;
			}
		$pass = true;
		for($i = 0; $i <= 9; $i++) {
			if($error[$i]) {
				$pass = false;
			}
		}
		if($pass) {
			if(!empty($password)) {
				switch($users->encryption) {
					case 'md5' : $newpass = substr(md5($password),0,15); break;
					case 'crypt' : $newpass = crypt($password,"BL"); break;
					default : $newpass = $password; break;
				}
				$sql = "update account set username = '$username', password = '$newpass', firstname = '$firstname', lastname = '$lastname', mailaddr = '$mailaddr' where username = '$users->username'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "update radcheck set username = '$username', Value = '$newpass' where username = '$users->username'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			} else {
				$sql = "update account set username = '$username', firstname = '$firstname', lastname = '$lastname', mailaddr = '$mailaddr' where username = '$users->username'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "update radcheck set username = '$username' where username = '$users->username'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			}
			$sql = "update radusergroup  set username = '$username' where username = '$users->username'";
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$sql = "update radacct set username = '$username' where username = '$users->username'";
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			 echo "<script>window.location='index2.php?option=manage_user&action=success&group=".$_REQUEST['group']."';</script>";
		}
	} else {
		$firstname = $users->firstname;
		$lastname = $users->lastname;
		$mailaddr = $users->mailaddr;
		$username = $users->username;
		
	}
	?>
<form action="" method="post" id="groupform" name="groupform">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td colspan="2" align="center"><?php 
	if(!empty($message)) { echo "<BR>".$message; } 
?>&nbsp;</td>
      </tr>
            
        

            <?php if($error[0]) { ?>
              <tr>
                <td width="32%" align="right">&nbsp;</td>
                <td width="68%" class="red">กรุณากรอกชื่อของคุณด้วยครับ</td>
      </tr>
            <?php } ?>
              <tr>
                <td width="32%" align="right">&#3594;&#3639;&#3656;&#3629; :</td>
          <td width="68%"><label>
                  <input name="firstname" type="text" class="inputbox-normal" id="firstname" style="background: <?php if($error[0]) echo "#FFF0F0"; ?>" value="<?= $firstname ?>">
                <span class="red">* 
                <input name="action" type="hidden" id="action" value="save" />
                </span></label></td>
      </tr>
            <?php if($error[1]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกนามสกุลของคุณด้วยครับ</td>
              </tr>
            <?php } ?>
              <tr>
                <td align="right">&#3609;&#3634;&#3617;&#3626;&#3585;&#3640;&#3621; :</td>
                <td><label>
                  <input name="lastname" type="text" class="inputbox-normal" id="lastname"  style="background: <?php if($error[1]) echo "#FFF0F0"; ?>" value="<?= $lastname ?>">
                 <span class="red">*</span></label></td>
              </tr>
            <?php if($error[2]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกอีเมล์ของคุณด้วยครับ</td>
              </tr>
            <?php } ?>
              <tr>
                <td align="right">&#3629;&#3637;&#3648;&#3617;&#3621;&#3660; :</td>
                <td>
           <input name="mailaddr" type="text" class="inputbox-normal" id="mailaddr" style="width:250px;background:<?php if($error[2]) echo "#FFF0F0"; ?>" value="<?= $mailaddr ?>">
                 <span class="red">*</span></td>
              </tr>
            <?php if($error[3]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกชื่อผู้ใช้ที่คุณต้องการด้วยครับ</td>
              </tr>
            <?php } ?>
            <?php if($error[4]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ชื่อผู้ใช้ที่คุณต้องการมีผู้อื่นใช้แล้ว กรุณากรอกใหม่ด้วยครับ</td>
              </tr>
            <?php } ?>
              <tr>
                <td align="right">&#3594;&#3639;&#3656;&#3629;&#3612;&#3641;&#3657;&#3651;&#3594;&#3657; :</td>
                <td><label>
                  <input name="username" type="text" class="inputbox-normal" id="username" style="background: <?php if($error[3] || $error[4]) echo "#FFF0F0"; ?>" value="<?= $username ?>">
                 <span class="red">*</span></label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><span class="comment">กรอกเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น</span></td>
              </tr>
            <?php if($error[5]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">กรุณากรอกรหัสผ่านด้วยครับ</td>
              </tr>
	<?php } ?>
              
           <?php if($error[6]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">ความยาวของรหัสผ่านต้องยาวอย่างน้อย 8 อักขระครับ</td>
              </tr>
 			<?php } ?>
 
               <tr>
                <td align="right">&#3619;&#3627;&#3633;&#3626;&#3612;&#3656;&#3634;&#3609; :</td>
                <td><label>
                  <input name="password" type="password" class="inputbox-normal" id="password"  style="background: <?php if($error[5] || $error[6] || $error[9]) echo "#FFF0F0"; ?>" value="<?= $password ?>">
                 <span class="red">*</span></label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="comment">ความยาวอย่างน้อย 5 อักขระ</td>
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
                <td class="red">ความยาวของรหัสผ่านต้องยาวอย่างน้อย 5 อักขระครับ</td>
              </tr>
            <?php } ?>
           <?php if($error[9]) { ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="red">รหัสผ่านทั้งสองไม่ตรงกัน</td>
              </tr>
            <?php } ?>
              <tr>
                <td align="right">&#3618;&#3639;&#3609;&#3618;&#3633;&#3609;&#3619;&#3627;&#3633;&#3626;&#3612;&#3656;&#3656;&#3634;&#3609; :</td>
                <td><label>
                  <input name="password2" type="password" class="inputbox-normal" id="password2"  style="background: <?php if($error[7] || $error[8] || $error[9]) echo "#FFF0F0"; ?>" value="<?= $password2 ?>">
                <span class="red">*</span> </label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><label>
                  <input type="submit" name="button" id="button" class="button" value="บันทึก">
                  <input type="button" name="button2" id="button2" class="button" value="ยกเลิก" onclick="window.location='index2.php?option=manage_user&group=<?= $_REQUEST['group'] ?>'" />
                </label></td>
              </tr>
         
              <tr>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>   
</form>
<?php } else { ?>
<script type="text/javascript">
function autoChecked(frmObj,chkObj){
	for(i=0; i<frmObj.length; i++){
		if(chkObj.checked)
			frmObj[i].checked=true;
		else
			frmObj[i].checked=false;
	}
}
function isChecked(frmObj){
var _return = false;
	for(i=0; i<frmObj.length; i++){
		if(frmObj[i].checked)
		_return = true;
	}
	return _return;
}

function confirm2Move(frmObj){
	if(!isChecked(frmObj)){
		alert("กรุณาเลือกรายการที่จะดำเนินการ ..!");
		return false;
	}else if(frmObj.group.options[frmObj.group.selectedIndex].value == ""){
		alert("กรุณาเลือกวิธีการดำเนินการ ..!");
		return false;
	}else{
		return confirm("ยืนยันการลบ / การย้ายกลุ่มที่ถูกเลือก ?");
	}
}
</script>
<form id="myfrm" name="myfrm" method="post" action="?option=manage_user&action=move&group=<?=$_GET["group"]?>" onsubmit="return confirm2Move(this);">
  <table width="95%" border="0" align="center" cellspacing="1" class="admintable">
    <tr>
      <td height="35" colspan="3" align="left"><?php if(isset($_REQUEST['group'])) { ?>   จำนวนสมาชิกในกลุ่ม <b> <?= $data2->gdesc ?></b> มีทั้งสิ้น <b class="red">
      <?php $sql = "select * from radusergroup  where groupname = '".$_REQUEST['group']."'";
	     echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql)); ?>
    </b>  คน<?php } ?></td>
      <td height="35" colspan="3" align="right"> <?php 
	if(isset($message)) {  ?><?= $message  ?><?php }    ?>
       </td>
      </tr>    
    <tr>
      <td width="68" align="center" class="key">ลำดับที่</td>
      <td width="364" align="center" class="key">ชื่อ - นามสกุล</td>
      <td width="247" align="center" class="key">ชื่อผู้ใช้งาน</td>
      <td width="130" align="center" class="key">วันที่สมัคร</td>
<!--        <td width="81" align="center" class="key">สถานะ</td> -->
      <td width="110" align="center" class="key">ดำเนินการ</td>
      <td width="25" align="center" class="key"><input type="checkbox" onclick="javascript:autoChecked(this.form,this);"></td>
    </tr>
    <?php 		
		$page = (isset($_GET['page']))? intval($_GET['page']) : 1;
		$limit = 30;
		$start = ($page-1)*$limit;
		$send = "option=" . $_GET['option'] . "&group=" . $_GET['group'];
		$sql = "select * from radusergroup , account where radusergroup .groupname = '".$_GET["group"]."' and radusergroup .username = account.username and account.status != '-1' order by account.username"; 
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql . " limit " . $start. "," . $limit) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$count = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
		//echo $sql;
		$i=$i+$start;
		while($users = mysqli_fetch_object($result)) { 
			$i++;
			($i % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
		?>
    <tr>
      <td width="68" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $i ?></td>
      <td width="364" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;
          <?= $users->firstname ?>
          <?= $users->lastname ?>     </td>
      <td align="left" valign="top" bgcolor="<?= $bgcolor ?>">
         &nbsp; <?= $users->username ?>  <!-- : <?= $users->password ?> -->
             </td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>">
          <?= substr($users->dateregis,0,10) ?>
             </td>
<!--      <td width="81" align="center" valign="top" bgcolor="<?= $bgcolor ?>">      
          <?php if($users->status) { ?>
          <a href="index2.php?option=manage_user&group=<?= $_GET["group"] ?>&user=<?=$users->username?>&&action=lock"><img src="images/unlocked.png" alt="ล็อก" /></a>
          <?php } else { ?>
          <a href="index2.php?option=manage_user&group=<?= $_GET["group"] ?>&user=<?=$users->username?>&action=unlock"><img src="images/lock.png" alt="ปลดล็อก" /></a>
          <?php } ?></td>
-->
      <td width="115" align="center" valign="top" bgcolor="<?= $bgcolor ?>">
          <a href="index2.php?option=manage_user&group=<?= $_GET["group"] ?>&user=<?=$users->username?>&action=edit"><img src="images/configure.png" alt=" แก้ไข " /></a>
        
        <a href="index2.php?option=manage_user&group=<?= $_GET["group"] ?>&user=<?=$users->username?>&action=delete"><img src="images/delete.png" alt=" ลบ " /></a>
        
        
        
     <?php $sql = "select * from groups";
		$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$num = mysqli_num_rows($result2);
	?>

		<img src="images/go.png" alt="ย้ายกลุ่ม" onClick="showhide<?= $users->username?>(1);event.cancelBubble=1" style="cursor:hand" />
		<div  onmouseover="showhide<?= $users->username?>(2);" onmouseout="showhide<?= $users->username?>(0)" id="innermenu<?= $users->username?>" style="position:absolute; width:300px; height:<?= $num * 25 ?>px;background-color:white; visibility:hidden; text-align:left; border: 1px #ddd dashed; padding: 10px 10px 10px 10px; line-height:25px; font-weight: normal" class="normal">
        <script language="JavaScript1.2">
		
		
		function gl<?= $users->username?>(linkname,dest){
		document.write('<li><a href="'+dest+'">'+linkname+'</a></li>')
		}
		
		function showhide<?= $users->username?>(state){
		var cacheobj=document.getElementById("innermenu<?= $users->username?>").style
		if (state==0)
		cacheobj.visibility="hidden"
		else if(state==2)
		cacheobj.visibility="visible"
		else
		cacheobj.visibility=cacheobj.visibility=="hidden"? "visible" : "hidden"
		}
		
		//Specify your links here- gl(Item text, Item URL)
		<?php while($groups = mysqli_fetch_object($result2)) { ?>
		gl<?= $users->username?>("ย้ายไปกลุ่ม  <?= $groups->gdesc ?>","index2.php?option=manage_user&action=move&user=<?= $users->username?>&group=<?= $groups->gname ?>")
		<?php } ?>

		//Extend this list as needed
		
		
		document.onclick=function(){showhide<?= $user->username?>(0)}
		
</script>
</div>

        
         </td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>"><input type="checkbox" id="user[]" name="user[]" value="<?= $users->username?>" /></td>
    </tr>
    <?php } 			($count % 2 == 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
 ?>
  </table>
<?
	if(isset($_GET["group"])){
	echo "<div style=\"width:95%;\">";
	echo "<div id=\"pagination\"><ol> " . pagination($page, $limit, $count, $send) . "</ol></div>";
	echo "<div style=\"float:right;display:inline-block;padding-top:2px;\">";
	echo "<select id=\"group\" name=\"group\">";
	$sql3 = "select * from groups";
	$result3 = mysqli_query($GLOBALS["___mysqli_ston"], $sql3);
	echo "<option value=\"\">จัดการกับข้อมูลที่เลือก</option>";
	echo "<option value=\"del\">ลบข้อมูล</option>";
	while($objgroup = mysqli_fetch_object($result3)) {
	echo "<option value=\"" . $objgroup->gname . "\">ย้ายไปกลุ่ม " . $objgroup->gdesc . "</option>";
	}
	echo "</select>";
	echo " <input type=\"submit\" value=\"ลงมือ\" class=\"button\" /> ";
	echo "</div>";
	echo "</div>";
	}
}
?>
</form>
</div>
</body>
</html>
