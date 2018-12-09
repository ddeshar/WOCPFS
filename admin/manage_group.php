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
			case 'lock' : 
				$sql = "update groups set gstatus = 0 where gid = '".$_REQUEST['gid']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "select * from radusergroup where groupname = '$group->gname'";
//                $sql = "update radgroupcheck set  value = 'Reject' where groupname = '".$group->gname."' and attribute = 'Auth-Type'"; 
//				mysql_query($sql);
				$sql = "insert into radgroupcheck values (NULL, '".$group->gname."', 'Auth-Type', ':=', 'Reject')";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
/*
				$sql = "delete from radgroupcheck where groupname = '".$group->gname."'"; 
				mysql_query($sql);
*/
				//echo $sql;
				$message = "<span class=\"info\">ล็อกกลุ่มที่ต้องการเรียบร้อยแล้ว</span>";
				break;
			case 'unlock' : 
				$sql = "update groups set gstatus = 1 where gid = '".$_REQUEST['gid']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "select * from radusergroup where groupname = '$group->gname'";
//				$sql = "update radgroupcheck set  value = 'Accept'  where groupname = '".$group->gname."' and attribute = 'Auth-Type'"; 
//				mysql_query($sql);
//				$sql = "insert into radgroupcheck values (NULL, '".$group->gname."', 'Auth-Type', ':=', 'Reject')";
//				mysql_query($sql);
				$sql = "delete from radgroupcheck where groupname = '".$group->gname."' and attribute = 'Auth-Type'"; 
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				//echo $sql;
				$message = "<span class=\"info\">ปลดล็อกกลุ่มที่ต้องการเรียบร้อยแล้ว</span>";
				break;
			case 'delete' : 
				//$sql = "update groups set gstatus = 1 where gid = '".$_REQUEST['gid']."'";
				//echo $sql;
				//mysql_query($sql);
				$sql = "select * from radusergroup where groupname = '$group->gname'";
				$gcount = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
				if($gcount) {
					$message = "<span class=\"alert\">เกิดข้อผิดพลาด ในกลุ่มดังกล่าวยังมีผู้ใช้อยู่</span>";
				} else {
					$sql = "delete from groups where gid = '".$_REQUEST['gid']."'"; 
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					$sql = "delete from radgroupcheck where groupname = '".$group->gname."'"; 
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					$sql = "delete from radgroupreply where groupname = '".$group->gname."'"; 
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					$message = "<span class=\"info\">ลบกลุ่มที่ต้องการออกเรียบร้อยแล้ว</span>";
				}
				break;
			case 'save' :
			    $newup = $_REQUEST['groupupload'];
				$d_time = $_REQUEST['d_time'];
				$s_time = $_REQUEST['s_time'];
				$a_time = $_REQUEST['a_time'];
				$i_time = $_REQUEST['i_time'];
				$start_page = $_REQUEST['start_page'];
				$newdown = $_REQUEST['groupdownload'];
				$newexpire = $_REQUEST['groupexpire'];
				$newexpiretocheck = date("d M Y", strtotime($newexpire));
				$noexpire = "0000-00-00";
				$sql = "update groups set gdesc = '".$_REQUEST['groupdesc']."', gupload = '".$_REQUEST['groupupload']."', gdownload ='".$_REQUEST['groupdownload']."', gexpire = '".$_REQUEST['groupexpire']."' where gid = '".$_REQUEST['gid']."'";
			//	echo $sql;
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "delete from radgroupcheck where groupname =  '".$group->gname."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "delete from radgroupreply where groupname =  '".$group->gname."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				//$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'WISPr-Bandwidth-Max-Down', ':=', '$down')";
				   
			//		$sql = "insert into radgroupcheck values (NULL, '".$group->gname."', 'Auth-Type', ':=', 'Accept')";
			//		mysql_query($sql);
							
					$sql = "insert into radgroupcheck values (NULL, '".$group->gname."', 'Simultaneous-Use', ':=', '1')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					 if ($newexpire != $noexpire ){
				    $sql = "insert into radgroupcheck values (NULL, '".$group->gname."', 'Expiration', ':=', '$newexpiretocheck')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
					
					$sql = "insert into radgroupcheck values (NULL, '".$group->gname."', 'Max-Daily-Session', ':=', '$d_time')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					//$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'Simultaneous-Use', ':=', '1')";
					//mysql_query($sql);
					
					$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'Service-Type', ':=', 'Login-User')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'Acct-Interim-Interval', ':=', '$a_time')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'Idle-Timeout', ':=', '$i_time')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'Session-Timeout', ':=', '$s_time')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					if($start_page != "") {
					$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'WISPr-Redirection-URL', ':=', '$start_page')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
					if($newdown != 0) {
					$down = $newdown * 1024;
					$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'WISPr-Bandwidth-Max-Down', ':=', '$down')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
					if($newup != 0) {
					$upload = $newup * 1024;
					$sql = "insert into radgroupreply values (NULL, '".$group->gname."', 'WISPr-Bandwidth-Max-Up', ':=', '$upload')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
				$message = "<span class=\"info\">บันทึกข้อมูลการแก้ไขเรียบร้อยแล้ว</span>";
				break;
			case 'edit' :
				$message = "<span class=\"note\">กรุณากรอกข้อมูลในช่องที่ท่านต้องการแก้ไขแล้วคลิกบันทึกด้วย</span>";
				break;
			case 'add' :
				$message = "<span class=\"note\">กรุณากรอกข้อมูลในช่องด้านล่างแล้วคลิกบันทึกเพื่อเพิ่มกลุ่มใหม่</span>";
				break;
			case 'saveadd' :
				$error = 0;
				$newup = $_REQUEST['newgroupupload'];
				$d_time = $_REQUEST['d_time'];
				$s_time = $_REQUEST['s_time'];
				$a_time = $_REQUEST['a_time'];
				$i_time = $_REQUEST['i_time'];
				$start_page = $_REQUEST['start_page'];
				$newdown = $_REQUEST['newgroupdownload'];
				$newexpire = $_REQUEST['newgroupexpire'];
				$newexpiretocheck = date("d M Y", strtotime($newexpire));
				$noexpire = "0000-00-00";
				if(trim($_REQUEST['newgroupdesc']) == '') {
					$error = 1;
					$message = "<span class=\"alert\">กรุณากรอกชื่อกลุ่มด้วย</span>";
				} else {
					$sql = "select * from groups where gdesc = '".trim($_REQUEST['newgroupdesc'])."'";
					if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))) {
						$message = "<span class=\"alert\">ชื่อกลุ่ม '".trim($_REQUEST['newgroupdesc'])."' ซ้ำ กรุณาเปลี่ยนชื่อกลุ่มใหม่</span>";
						$error = 1;
					} else {
				//	$sql = "insert into radgroupcheck values (NULL, 'group-".$_REQUEST['newgname']."', 'Auth-Type', ':=', 'Accept')";
				//	mysql_query($sql);						
					$sql = "insert into radgroupcheck values (NULL, 'group-".$_REQUEST['newgname']."', 'Simultaneous-Use', ':=', '1')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					//$sql = "insert into radgroupreply values (NULL, 'group-".$_REQUEST['newgname']."', 'Simultaneous-Use', ':=', '1')";
					//mysql_query($sql);
					if ($newexpire != $noexpire ){
				    $sql = "insert into radgroupcheck values (NULL, 'group-".$_REQUEST['newgname']."', 'Expiration', ':=', '$newexpiretocheck')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
					
					$sql = "insert into radgroupcheck values (NULL, 'group-".$_REQUEST['newgname']."', 'Max-Daily-Session', ':=', '$d_time')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					$sql = "insert into radgroupreply values (NULL, 'group-".$_REQUEST['newgname']."', 'Service-Type', ':=', 'Login-User')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					$sql = "insert into radgroupreply values (NULL, 'group-".$_REQUEST['newgname']."', 'Acct-Interim-Interval', ':=', '$a_time')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					$sql = "insert into radgroupreply values (NULL, 'group-".$_REQUEST['newgname']."', 'Idle-Timeout', ':=', '$i_time')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					$sql = "insert into radgroupreply values (NULL, 'group-".$_REQUEST['newgname']."', 'Session-Timeout', ':=', '$s_time')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					
					if($start_page != "") {
					$sql = "insert into radgroupreply values (NULL, 'group-".$_REQUEST['newgname']."', 'WISPr-Redirection-URL', ':=', '$start_page')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
					if($newdown != 0) {
					$down = $newdown * 1024;
					$sql = "insert into radgroupreply values (NULL, 'group-".$_REQUEST['newgname']."', 'WISPr-Bandwidth-Max-Down', ':=', '$down')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
					if($newup != 0) {
					$upload = $newup * 1024;
					$sql = "insert into radgroupreply values (NULL, 'group-".$_REQUEST['newgname']."', 'WISPr-Bandwidth-Max-Up', ':=', '$upload')";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
						$sql = "insert into groups values(NULL,'group-".$_REQUEST['newgname']."','".$_REQUEST['newgroupdesc']."', '$newup', '$newdown', '$newexpire', '0', '1')";
					//	echo $sql;
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						
							$message = "<span class=\"info\">บันทึกข้อมูลกลุ่มใหม่เรียบร้อยแล้ว</span>";
							//echo"$s_time $1_time  $a_time $d_time";
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
<div id="content">

<form action="index2.php?option=manage_group" method="post" id="groupform" name="groupform">
<table width="95%"  align="center" border="0" cellspacing="10" cellpadding="0"  class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_009.png" alt="" width="59" height="60" /></td>
    <td width="94%"><a href="index2.php?option=manage_group">Group Manager</a><br />
<span class="normal">จัดการกลุ่มผู้ใช้งานอินเทอร์เน็ต</span></td>
    <td width="94%"><input type="button" class="button" name="button" id="button" value="เพิ่มกลุ่ม" onclick="window.location='index2.php?option=manage_group&action=add'"/></td>
  </tr>
</table>
 
  <table width="95%" align="center" cellspacing="1" class="admintable">
    <tr>
      <td colspan="6"><?php 
	if(isset($message)) { echo $message; } 
?>
&nbsp;</td>
      </tr>
    <tr>
      <td width="60" align="center" class="key">กลุ่มที่</td>
      <td width="150" align="center" class="key">ชื่อกลุ่ม</td>
      <td width="289" align="center" class="key">ความเร็วเน็ต<br />Down : Up (Kbps)</td>
      <td width="200" align="center" class="key">วันหมดอายุ<br />(ปี ค.ศ.-เดือน-วันที่)</td>
      <td width="56" align="center" class="key">สถานะ</td>
      <td width="122" align="center" class="key">ดำเนินการ</td>
    </tr>
    <?php 
	  	$count = 0;
		$sql = "select * from groups order by gid"; 
	  	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		while($group = mysqli_fetch_object($result)) { 
			$count++;
			($count % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
			$sql = "select * from radusergroup where groupname = '$group->gname'";
			$gcount = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
			$edit = false;
			if(isset($_REQUEST['gid']) && isset($_REQUEST['action'])) {
				if($group->gid == $_REQUEST['gid'] && $_REQUEST['action'] == "edit") {
					$edit = true;
				}
			} 
		?>
    <tr>
      <td width="60" height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $group->gid ?></td>
      <td width="250" height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;
          <?php if(!$edit) { ?>
          <?= $group->gdesc ?>
          <?php } else { ?>
              <input name="groupdesc" type="text" class="noborder" id="groupdesc" value="<?= $group->gdesc ?>"  />
              <input name="action" type="hidden" id="action" value="save" />
              <input name="gid" type="hidden" id="gid" value="<?= $group->gid ?>" />
        <?php } ?>      </td>
  
      <td width="289" height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>">
          <?php if(!$edit) { ?>
          <font color=orange><?= $group->gdownload ?></font> : <font color="green"> <?= $group->gupload ?></font>
      
          <?php } else { ?>
          <input name="groupdownload" type="text" class="noborder3" id="groupdownload" value="<?= $group->gdownload ?>" style="width: 30px; text-align: left; padding-left: 2px;"  /> : 
        <input name="groupupload" type="text" class="noborder3" id="groupupload" value="<?= $group->gupload ?>" style="width: 30px; text-align: right; padding-left: 2px;"  /><?php } ?>       </td>
      <td width="200" height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>">
                    <?php if(!$edit) { ?><?= $group->gexpire ?>
   <?php } else { ?>
      <input name="groupexpire" type="text" class="noborder3" id="groupexpire" value="<?= $group->gexpire ?>" style="width:80px; text-align: center; padding-left: 2px; " />
   <?php } ?>      </td>
      <td width="56" align="center" valign="top" bgcolor="<?= $bgcolor ?>">
      
      	  <?php if($group->gstatus) { ?>
          <a href="index2.php?option=manage_group&gid=<?=$group->gid?>&action=lock"><img src="images/unlocked.png" alt="ล็อก" /></a>
          <?php } else { ?>
          <a href="index2.php?option=manage_group&gid=<?=$group->gid?>&action=unlock"><img src="images/lock.png" alt="ปลดล็อก" /></a>
          <?php } ?>      </td>
      <td width="122" height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>">
                    <?php if(!$edit) { ?>
        <a href="index2.php?option=manage_group&gid=<?=$group->gid?>&action=edit"><img src="images/configure.png" alt="แก้ไข" /></a>
        <?php } else { ?>
        <input name="action" type="image" value="save" src="images/save.png" alt="บันทึก" />
        <?php } ?>
        <a href="index2.php?option=manage_group&gid=<?=$group->gid?>&action=delete"><img src="images/delete.png" alt="ลบ" /></a> </td>
    </tr> 

		<?php if(!$edit) {}else{ 
			$attribute_e[0]='WISPr-Redirection-URL';
			$attribute_e[1]='Session-Timeout';
			$attribute_e[2]='Idle-Timeout';
			$attribute_e[3]='Max-Daily-Session';
			$attribute_e[4]='Acct-Interim-Interval';
			$a=0;
			for($i=0;$i<5;$i++){
				if($i == 3){
				$sql_e = "select * from radgroupcheck where (groupname = '".$group->gname."')and(Attribute = 'Max-Daily-Session')" ;
					} else {
				$sql_e = "select * from radgroupreply where (groupname = '".$group->gname."')and(Attribute = '".$attribute_e[$i]."')";
					}
				$result_e = mysqli_query($GLOBALS["___mysqli_ston"], $sql_e);
				$group_e = mysqli_fetch_object($result_e);
				$attribute_v[$i]= $group_e->value;
				$a++;
			}
		?>
<tr>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"></td>
          <td height="30" align="right" valign="top" bgcolor="#F6F6F6">Login 1 ครั้งเล่นได้นานครั้งละ : </td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"><select name="s_time" id="s_time" >
            <option value="0" <?php if($attribute_v[1]=='0') { echo "selected=\"Selected\""; } ?>>ไม่จำกัด</option>
            <option value="3600" <?php if($attribute_v[1]=='3600'){echo"selected=\"Selected\"";}?>>1 ชั่วโมง</option>
            <option value="7200" <?php if($attribute_v[1]=='7200'){echo"selected=\"Selected\"";}?>>2 ชั่วโมง</option>
            <option value="10800" <?php if($attribute_v[1]=='10800'){echo"selected=\"Selected\"";}?>>3 ชั่วโมง</option>
            <option value="14400" <?php if($attribute_v[1]=='14400'){echo"selected=\"Selected\"";}?>>4 ชั่วโมง</option>
            <option value="18000" <?php if($attribute_v[1]=='18000'){echo"selected=\"Selected\"";}?>>5 ชั่วโมง</option>
            <option value="21600" <?php if($attribute_v[1]=='21600'){echo"selected=\"Selected\"";}?>>6 ชั่วโมง</option>
            <option value="25200" <?php if($attribute_v[1]=='25200'){echo"selected=\"Selected\"";}?>>7 ชั่วโมง</option>
            <option value="28800" <?php if($attribute_v[1]=='28800'){echo"selected=\"Selected\"";}?>>8 ชั่วโมง</option>
            <option value="36000" <?php if($attribute_v[1]=='36000'){echo"selected=\"Selected\"";}?>>10 ชั่วโมง</option>
            <option value="54000" <?php if($attribute_v[1]=='54000'){echo"selected=\"Selected\"";}?>>15 ชั่วโมง</option>
            <option value="72000" <?php if($attribute_v[1]=='72000'){echo"selected=\"Selected\"";}?>>20 ชั่วโมง</option>
                                                  </select></td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"></td>
          <td height="30" align="right" valign="top" bgcolor="<?= $bgcolor ?>">เล่นได้วันละ :</td>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"><select name="d_time" id="d_time">
             <option value="0" <?php if($attribute_v[3]=='0')    {echo "selected=\"Selected\""; } ?>>ไม่จำกัด</option>
            <option value="3600" <?php if($attribute_v[3]=='3600'){echo"selected=\"Selected\"";} ?>>1 ชั่วโมง</option>
            <option value="7200" <?php if($attribute_v[3]=='7200'){echo"selected=\"Selected\"";} ?>>2 ชั่วโมง</option>
            <option value="10800" <?php if($attribute_v[3]=='10800'){echo"selected=\"Selected\"";} ?>>3 ชั่วโมง</option>
            <option value="14400" <?php if($attribute_v[3]=='14400'){echo"selected=\"Selected\"";} ?>>4 ชั่วโมง</option>
            <option value="18000" <?php if($attribute_v[3]=='18000'){echo"selected=\"Selected\"";} ?>>5 ชั่วโมง</option>
            <option value="21600" <?php if($attribute_v[3]=='21600'){echo"selected=\"Selected\"";} ?>>6 ชั่วโมง</option>
            <option value="25200" <?php if($attribute_v[3]=='25200'){echo"selected=\"Selected\"";} ?>>7 ชั่วโมง</option>
            <option value="28800" <?php if($attribute_v[3]=='28800'){echo"selected=\"Selected\"";} ?>>8 ชั่วโมง</option>
            <option value="36000" <?php if($attribute_v[3]=='36000'){echo"selected=\"Selected\"";} ?>>10 ชั่วโมง</option>
            <option value="54000" <?php if($attribute_v[3]=='54000'){echo"selected=\"Selected\"";} ?>>15 ชั่วโมง</option>
            <option value="72000" <?php if($attribute_v[3]=='72000'){echo"selected=\"Selected\"";} ?>>20 ชั่วโมง</option>
            <option value="86400" <?php if($attribute_v[3]=='86400'){echo "selected=\"Selected\""; } ?>>24 ชั่วโมง</option>
          </select></td>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
          <td align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"></td>
          <td height="30" align="right" valign="top" bgcolor="#F6F6F6">&nbsp;ถ้าไม่ใช้งาน จะตัดการเชื่อมต่อ:</td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"><select name="i_time" id="i_time" >
            <option value="300" <?php if($attribute_v[2]=='300'){echo"selected=\"Selected\"";} ?>>5 นาที</option>
            <option value="600" <?php if($attribute_v[2]=='600'){echo"selected=\"Selected\"";} ?>>10 นาที</option>
            <option value="900" <?php if($attribute_v[2]=='900'){echo"selected=\"Selected\"";} ?>>15 นาที</option>
            <option value="1200" <?php if($attribute_v[2]=='1200'){ echo "selected=\"Selected\""; } ?>>20 นาที</option>
            <option value="1800" <?php if($attribute_v[2]=='1800'){ echo "selected=\"Selected\""; } ?>>30 นาที</option>
                              </select></td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"></td>
          <td height="30" align="right" valign="top" bgcolor="<?= $bgcolor ?>">ตรวจสอบสถานะทุก : </td>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"><select name="a_time" id="a_time" >
            <option value="60" <?php if($attribute_v[4]=='60'){echo"selected=\"Selected\"";} ?>>1 นาที</option>
            <option value="120" <?php if($attribute_v[4]=='120'){echo"selected=\"Selected\"";} ?>>2 นาที</option>
            <option value="180" <?php if($attribute_v[4]=='180'){echo"selected=\"Selected\"";} ?>>3 นาที</option>
            <option value="300" <?php if($attribute_v[4]=='300'){ echo "selected=\"Selected\""; } ?>>5 นาที</option>
             <option value="600" <?php if($attribute_v[4]=='600'){ echo "selected=\"Selected\""; } ?>>10 นาที</option>
             <option value="900" <?php if($attribute_v[4]=='900'){ echo "selected=\"Selected\""; } ?>>15 นาที</option>

                              </select></td>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
          <td align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"></td>
          <td height="30" align="right" valign="top" bgcolor="#F6F6F6">เมื่อ Login แล้วให้เปิดเว็บ : </td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"><input name="start_page" type="text" class="" id="start_page"  style="width: 150px;   " size="15" value="<?php echo"$attribute_v[0]"?>" /></td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
        </tr>

 <?php } ?>
    <?php $last = $group->gid + 1;
	} 			
	
	($count % 2 == 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
 ?>
 	<?php if($_REQUEST['action'] == "add" || $error == 1) {
	$bgcolor = "#FFFFFF";
	 ?>
   
        <tr>
      <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"></td>
      <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"><input type="text" name="newgroupdesc" id="newgroupdesc" class="<?php if($error) { echo "noborder4" ;} else { echo "noborder" ; } ?>"  style="width: 200px;   " />
	 <input type="hidden" name="newgname" id="newgname" value="<?= date("YmdHis") ?>" /></td>
      <td height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><input name="newgroupdownload" type="text" class="noborder3" id="newgroupdownload" value="<?= $newup ?>" style="width: 30px; text-align: right; padding-left: 2px;"  />
:
  <input name="newgroupupload" type="text" class="noborder3" id="newgroupupload" value="<?= $newdown ?>" style="width: 30px; text-align: left; padding-left: 2px;"  /></td>
      <td height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><input name="newgroupexpire" type="text" class="noborder3" id="newgroupexpire" value="<?= $newexpire ?>" style="width:80px; text-align: center; padding-left: 2px; " /></td>
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
      <td height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>">        <input name="action" type="hidden" id="action" value="saveadd" /><input name="action" type="image" value="save" src="images/save.png" alt="บันทึก" /></td>
    </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"></td>
          <td height="30" align="right" valign="top" bgcolor="#F6F6F6">login 1ครั้งเล่นได้นานครั้งละ : </td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"><select name="s_time" id="s_time" >
            <option value="0"> ไม่จำกัด</option>
            <option value="3600">1 ชั่วโมง</option>
            <option value="7200">2 ชั่วโมง</option>
            <option value="10800">3 ชั่วโมง</option>
            <option value="14400">4 ชั่วโมง</option>
            <option value="18000">5 ชั่วโมง</option>
            <option value="21600">6 ชั่วโมง</option>
            <option value="25200">7 ชั่วโมง</option>
            <option value="28800">8 ชั่วโมง</option>
            <option value="36000">10 ชั่วโมง</option>
            <option value="54000">15 ชั่วโมง</option>
            <option value="72000">20 ชั่วโมง</option>
                                                  </select></td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"></td>
          <td height="30" align="right" valign="top" bgcolor="<?= $bgcolor ?>">เล่นได้วันละ :</td>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"><select name="d_time" id="d_time">
            <option value="0"> ไม่จำกัด</option>
            <option value="3600">1 ชั่วโมง</option>
            <option value="7200">2 ชั่วโมง</option>
            <option value="10800">3 ชั่วโมง</option>
            <option value="14400">4 ชั่วโมง</option>
            <option value="18000">5 ชั่วโมง</option>
            <option value="21600">6 ชั่วโมง</option>
            <option value="25200">7 ชั่วโมง</option>
            <option value="28800">8 ชั่วโมง</option>
            <option value="36000">10 ชั่วโมง</option>
            <option value="54000">15 ชั่วโมง</option>
            <option value="72000">20 ชั่วโมง</option>
            <option value="86400">24 ชั่วโมง</option>
          </select></td>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
          <td align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"></td>
          <td height="30" align="right" valign="top" bgcolor="#F6F6F6">&nbsp;ถ้าไม่ใช้งาน จะตัดการเชื่อมต่อ :</td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"><select name="i_time" id="i_time" >
             <option value="300">5 นาที</option>
            <option value="600">10 นาที</option>
            <option value="900">15 นาที</option>
            <option value="1200">20 นาที</option>
            <option value="1800" >30 นาที</option>
  
                              </select></td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"></td>
          <td height="30" align="right" valign="top" bgcolor="<?= $bgcolor ?>">ตรวจสอบสถานะทุก  : </td>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>"><select name="a_time" id="a_time" >
            <option value="60">1 นาที</option>
            <option value="120">2 นาที</option>
            <option value="180">3 นาที</option>
             <option value="300" >5 นาที</option>
             <option value="600" >10 นาที</option>
             <option value="900" >15 นาที</option>

                              </select></td>
          <td height="30" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
          <td align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"></td>
          <td height="30" align="right" valign="top" bgcolor="#F6F6F6">เมื่อ Login แล้วให้เปิดเว็บ : </td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6"><input name="start_page" type="text" class="" id="start_page"  style="width: 150px;   " size="15" value="http://www.google.com" /></td>
          <td height="30" align="left" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
          <td height="30" align="center" valign="top" bgcolor="#F6F6F6">&nbsp;</td>
        </tr>

    <?php } ?>
  </table>
</form>
</div>
</body>
</html>
