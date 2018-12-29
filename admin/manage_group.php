<?php
  include("include/class.testlogin.php");
  // print_r($_REQUEST);
  $newup = $newdown = 0;
  $newexpire = "0000-00-00";
  if(isset($_REQUEST['action'])) { 
    $sql = "SELECT * FROM groups WHERE gid = '".$_REQUEST['gid']."'"; 
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $group = mysqli_fetch_object($result);

    switch($_REQUEST['action']) {
      case 'lock' : 
        $sql = "UPDATE groups SET gstatus = 0 WHERE gid = '".$_REQUEST['gid']."'";
        mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        $sql = "SELECT * FROM radusergroup WHERE groupname = '$group->gname'";
        // $sql = "UPDATE radgroupcheck SET  value = 'Reject' WHERE groupname = '".$group->gname."' and attribute = 'Auth-Type'"; 
        // mysql_query($sql);
        $sql = "INSERT INTO radgroupcheck VALUES (NULL, '".$group->gname."', 'Auth-Type', ':=', 'Reject')";
        mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        // $sql = "DELETE FROM radgroupcheck WHERE groupname = '".$group->gname."'"; 
        // mysql_query($sql);
        //echo $sql;
        $message ="<div class=\"alert alert-info\"><strong>ล็อกกลุ่มที่ต้องการเรียบร้อยแล้ว</strong></div>";

        break;
      case 'unlock' : 
        $sql = "UPDATE groups SET gstatus = 1 WHERE gid = '".$_REQUEST['gid']."'";
        mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        $sql = "SELECT * FROM radusergroup WHERE groupname = '$group->gname'";
        // $sql = "UPDATE radgroupcheck SET  value = 'Accept'  WHERE groupname = '".$group->gname."' and attribute = 'Auth-Type'"; 
        // mysql_query($sql);
        // $sql = "INSERT INTO radgroupcheck VALUES (NULL, '".$group->gname."', 'Auth-Type', ':=', 'Reject')";
        // mysql_query($sql);
        $sql = "DELETE FROM radgroupcheck WHERE groupname = '".$group->gname."' and attribute = 'Auth-Type'"; 
        mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        //echo $sql;
        $message ="<div class=\"alert alert-info\"><strong>ปลดล็อกกลุ่มที่ต้องการเรียบร้อยแล้ว</strong></div>";

        break;
      case 'delete' : 
        //$sql = "UPDATE groups SET gstatus = 1 WHERE gid = '".$_REQUEST['gid']."'";
        //echo $sql;
        //mysql_query($sql);
        $sql = "SELECT * FROM radusergroup WHERE groupname = '$group->gname'";
        $gcount = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
        if($gcount) {
          $message ="<div class=\"alert alert-danger\"><strong>เกิดข้อผิดพลาด!</strong>ในกลุ่มดังกล่าวยังมีผู้ใช้อยู่</div>";

        } else {
          $sql = "DELETE FROM groups WHERE gid = '".$_REQUEST['gid']."'"; 
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          $sql = "DELETE FROM radgroupcheck WHERE groupname = '".$group->gname."'"; 
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          $sql = "DELETE FROM radgroupreply WHERE groupname = '".$group->gname."'"; 
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          $message ="<div class=\"alert alert-info\"><strong>ลบกลุ่มที่ต้องการออกเรียบร้อยแล้ว</strong></div>";

        }
        break;
      case 'save' :
        $newup  = $_REQUEST['groupupload'];
        $d_time = $_REQUEST['d_time'];
        $s_time = $_REQUEST['s_time'];
        $a_time = $_REQUEST['a_time'];
        $i_time = $_REQUEST['i_time'];
        $start_page = $_REQUEST['start_page'];
        $newdown = $_REQUEST['groupdownload'];
        $newexpire = $_REQUEST['groupexpire'];
        $newexpiretocheck = date("d M Y", strtotime($newexpire));
        $noexpire = "0000-00-00";
        $sql = "UPDATE groups SET gdesc = '".$_REQUEST['groupdesc']."', gupload = '".$_REQUEST['groupupload']."', gdownload ='".$_REQUEST['groupdownload']."', gexpire = '".$_REQUEST['groupexpire']."' WHERE gid = '".$_REQUEST['gid']."'";
        // echo $sql;
        mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        $sql = "DELETE FROM radgroupcheck WHERE groupname =  '".$group->gname."'";
        mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        $sql = "DELETE FROM radgroupreply WHERE groupname =  '".$group->gname."'";
        mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        // $sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'WISPr-Bandwidth-Max-Down', ':=', '$down')";
        // $sql = "INSERT INTO radgroupcheck VALUES (NULL, '".$group->gname."', 'Auth-Type', ':=', 'Accept')";
        // mysql_query($sql);
              
          $sql = "INSERT INTO radgroupcheck VALUES (NULL, '".$group->gname."', 'Simultaneous-Use', ':=', '1')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          if ($newexpire != $noexpire ){
            $sql = "INSERT INTO radgroupcheck VALUES (NULL, '".$group->gname."', 'Expiration', ':=', '$newexpiretocheck')";
            mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          }
          
          $sql = "INSERT INTO radgroupcheck VALUES (NULL, '".$group->gname."', 'Max-Daily-Session', ':=', '$d_time')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          //$sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'Simultaneous-Use', ':=', '1')";
          //mysql_query($sql);
          
          $sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'Service-Type', ':=', 'Login-User')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          $sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'Acct-Interim-Interval', ':=', '$a_time')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          $sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'Idle-Timeout', ':=', '$i_time')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          $sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'Session-Timeout', ':=', '$s_time')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          if($start_page != "") {
          $sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'WISPr-Redirection-URL', ':=', '$start_page')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          }
          if($newdown != 0) {
          $down = $newdown * 1024;
          $sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'WISPr-Bandwidth-Max-Down', ':=', '$down')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          }
          if($newup != 0) {
          $upload = $newup * 1024;
          $sql = "INSERT INTO radgroupreply VALUES (NULL, '".$group->gname."', 'WISPr-Bandwidth-Max-Up', ':=', '$upload')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          }
        $message ="<div class=\"alert alert-info\"><strong>บันทึกข้อมูลการแก้ไขเรียบร้อยแล้ว</strong></div>";

        break;
      case 'edit' :
        $message ="<div class=\"alert alert-info\"><strong>กรุณากรอกข้อมูลในช่องที่ท่านต้องการแก้ไขแล้วคลิกบันทึกด้วย</strong></div>";

        break;
      case 'add' :
        $message ="<div class=\"alert alert-info\"><strong>กรุณากรอกข้อมูลในช่องด้านล่างแล้วคลิกบันทึกเพื่อเพิ่มกลุ่มใหม่</strong></div>";

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
		    	$message ="<div class=\"alert alert-danger\"><strong>กรุณากรอกชื่อกลุ่มด้วย </strong></div>";
        } else {
          $sql = "SELECT * FROM groups WHERE gdesc = '".trim($_REQUEST['newgroupdesc'])."'";
          if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))) {
  		    	$message ="<div class=\"alert alert-danger\"><strong>ชื่อกลุ่ม '".trim($_REQUEST['newgroupdesc'])."'  </strong>ซ้ำ กรุณาเปลี่ยนชื่อกลุ่มใหม่</div>";
            $error = 1;
          } else {
          // $sql = "INSERT INTO radgroupcheck VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Auth-Type', ':=', 'Accept')";
          // mysql_query($sql);						
          $sql = "INSERT INTO radgroupcheck VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Simultaneous-Use', ':=', '1')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          // $sql = "INSERT INTO radgroupreply VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Simultaneous-Use', ':=', '1')";
          // mysql_query($sql);
          if ($newexpire != $noexpire ){
            $sql = "INSERT INTO radgroupcheck VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Expiration', ':=', '$newexpiretocheck')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          }
          
          $sql = "INSERT INTO radgroupcheck VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Max-Daily-Session', ':=', '$d_time')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          $sql = "INSERT INTO radgroupreply VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Service-Type', ':=', 'Login-User')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          $sql = "INSERT INTO radgroupreply VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Acct-Interim-Interval', ':=', '$a_time')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          $sql = "INSERT INTO radgroupreply VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Idle-Timeout', ':=', '$i_time')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          $sql = "INSERT INTO radgroupreply VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'Session-Timeout', ':=', '$s_time')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          
          if($start_page != "") {
          $sql = "INSERT INTO radgroupreply VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'WISPr-Redirection-URL', ':=', '$start_page')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          }
          if($newdown != 0) {
          $down = $newdown * 1024;
          $sql = "INSERT INTO radgroupreply VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'WISPr-Bandwidth-Max-Down', ':=', '$down')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          }
          if($newup != 0) {
          $upload = $newup * 1024;
          $sql = "INSERT INTO radgroupreply VALUES (NULL, 'group-".$_REQUEST['newgname']."', 'WISPr-Bandwidth-Max-Up', ':=', '$upload')";
          mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          }
            $sql = "INSERT INTO groups VALUES(NULL,'group-".$_REQUEST['newgname']."','".$_REQUEST['newgroupdesc']."', '$newup', '$newdown', '$newexpire', '0', '1')";
            // echo $sql;
            mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  		    	  $message ="<div class=\"alert alert-success\"><strong>บันทึกข้อมูลกลุ่มใหม่เรียบร้อยแล้ว</strong></div>";
              // echo"$s_time $1_time  $a_time $d_time";
            }
        }
        break;
    }
  }
?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-users"></i> จัดการกลุ่มผู้ใช้งานอินเทอร์เน็ต</h1>
        <p>Group Manager</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=manage_group">จัดการกลุ่มผู้ใช้งานอินเทอร์เน็ต</a></li>
    </ul>
</div>

<form action="index2.php?option=manage_group" method="post" id="groupform" name="groupform">
  <div class="row">

  	<div class="col-lg-12">
			<div class="bs-component">
        <?php if(isset($message)) { echo $message; } ?>
			</div>
		</div>

    <div class="col-md-12">
      <div class="tile">

        <div class="tile-title-w-btn">
          <!-- <h3 class="title">จัดการกลุ่มผู้ใช้งานอินเทอร์เน็ต</h3> -->
          <div class="btn-group">
            <a class="btn btn-primary" href="#" onclick="window.location='index2.php?option=manage_group&action=add'"><i class="fa fa-lg fa-plus"></i></a>
          </div>
        </div>

        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr align="center">
                <th>กลุ่มที่</th>
                <th>ชื่อกลุ่ม</th>
                <th>ความเร็วเน็ต<br/>Down : Up (Kbps)</th>
                <th>วันหมดอายุ<br/>(ปี ค.ศ.-เดือน-วันที่)</th>
                <th>สถานะ</th>
                <th>ดำเนินการ</th>
              </tr>
            </thead>
            <?php 
              $count = 0;
              $sql = "SELECT * FROM groups order by gid"; 
              $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
              while($group = mysqli_fetch_object($result)) { 
                $count++;
                ($count % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
                $sql = "SELECT * FROM radusergroup WHERE groupname = '$group->gname'";
                $gcount = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
                $edit = false;
                
                if(isset($_REQUEST['gid']) && isset($_REQUEST['action'])) {
                  if($group->gid == $_REQUEST['gid'] && $_REQUEST['action'] == "edit") {
                    $edit = true;
                  }
                }
            ?>
            <tbody>
              <tr align="center">
                <td><?= $group->gid ?></td>
                <td>
                  <?php 
                    if(!$edit) {
                      echo $group->gdesc;
                    } else { 
                  ?>
                      <input name="groupdesc" type="text" class="form-control" id="groupdesc" value="<?= $group->gdesc ?>"  />
                      <input name="action" type="hidden" id="action" value="save" />
                      <input name="gid" type="hidden" id="gid" value="<?= $group->gid ?>" />
                  <?php } ?>
                </td>
                <td>
                  <?php if(!$edit) { ?>
                  <font color=orange><?= $group->gdownload ?></font> : <font color="green"> <?= $group->gupload ?></font>
                  <?php } else { ?>
                  <input name="groupdownload" type="text" class="noborder3" id="groupdownload" value="<?= $group->gdownload ?>"/> : 
                  <input name="groupupload" type="text" class="noborder3" id="groupupload" value="<?= $group->gupload ?>"/>
                  <?php } ?>
                </td>
                <td>
                  <?php
                    if(!$edit) {
                      echo $group->gexpire;
                    } else {
                  ?>
                  <input name="groupexpire" type="date" class="form-control" id="groupexpire" value="<?= $group->gexpire ?>"/>
                  <?php } ?>
                </td>
                <td>      
                  <?php if($group->gstatus) { ?>
                    <a href="index2.php?option=manage_group&gid=<?=$group->gid?>&action=lock"><i class="fa fa-lg fa-lock"></i></a>
                    <?php } else { ?>
                    <a href="index2.php?option=manage_group&gid=<?=$group->gid?>&action=unlock"><i class="fa fa-lg fa-unlock"></i></a>
                    <?php } ?>
                </td>
                <td>

                  <?php if(!$edit) { ?>
                    <a href="index2.php?option=manage_group&gid=<?=$group->gid?>&action=edit" ><i class="fa fa-lg fa-edit"></i></a>
                  <?php } else { ?>
                    <button class="btn btn-primary" name="action" type="submit" value="save"><i class="fa fa-lg fa-floppy-o"></i></button>
                  <?php } ?>
                    <a href="index2.php?option=manage_group&gid=<?=$group->gid?>&action=delete"><i class="fa fa-lg fa-trash"></i></a>
                </td>
              </tr>

                <?php
                  if(!$edit) {

                  }else{
                    $attribute_e[0]='WISPr-Redirection-URL';
                    $attribute_e[1]='Session-Timeout';
                    $attribute_e[2]='Idle-Timeout';
                    $attribute_e[3]='Max-Daily-Session';
                    $attribute_e[4]='Acct-Interim-Interval';
                    $a=0;

                    for($i=0;$i<5;$i++){
                      if($i == 3){
                        $sql_e = "SELECT * FROM radgroupcheck WHERE (groupname = '".$group->gname."')and(Attribute = 'Max-Daily-Session')" ;
                      } else {
                        $sql_e = "SELECT * FROM radgroupreply WHERE (groupname = '".$group->gname."')and(Attribute = '".$attribute_e[$i]."')";
                      }
                        $result_e = mysqli_query($GLOBALS["___mysqli_ston"], $sql_e);
                        $group_e = mysqli_fetch_object($result_e);
                        $attribute_v[$i]= $group_e->value;
                        $a++;
                    }
                ?>
             
              <tr>
                <td align="right"  colspan="2">Login 1 ครั้งเล่นได้นานครั้งละ : </td>
                <td colspan="4">
                  <select class="form-control" name="s_time" id="s_time" >
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
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right"  colspan="2">เล่นได้วันละ : </td>
                <td colspan="4">
                  <select class="form-control" name="d_time" id="d_time">
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
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right"  colspan="2">ถ้าไม่ใช้งาน จะตัดการเชื่อมต่อ : </td>
                <td colspan="4">
                  <select class="form-control" name="i_time" id="i_time" >
                    <option value="300" <?php if($attribute_v[2]=='300'){echo"selected=\"Selected\"";} ?>>5 นาที</option>
                    <option value="600" <?php if($attribute_v[2]=='600'){echo"selected=\"Selected\"";} ?>>10 นาที</option>
                    <option value="900" <?php if($attribute_v[2]=='900'){echo"selected=\"Selected\"";} ?>>15 นาที</option>
                    <option value="1200" <?php if($attribute_v[2]=='1200'){ echo "selected=\"Selected\""; } ?>>20 นาที</option>
                    <option value="1800" <?php if($attribute_v[2]=='1800'){ echo "selected=\"Selected\""; } ?>>30 นาที</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right"  colspan="2">ตรวจสอบสถานะทุก : </td>
                <td colspan="4">
                  <select class="form-control" name="a_time" id="a_time" >
                    <option value="60" <?php if($attribute_v[4]=='60'){echo"selected=\"Selected\"";} ?>>1 นาที</option>
                    <option value="120" <?php if($attribute_v[4]=='120'){echo"selected=\"Selected\"";} ?>>2 นาที</option>
                    <option value="180" <?php if($attribute_v[4]=='180'){echo"selected=\"Selected\"";} ?>>3 นาที</option>
                    <option value="300" <?php if($attribute_v[4]=='300'){ echo "selected=\"Selected\""; } ?>>5 นาที</option>
                    <option value="600" <?php if($attribute_v[4]=='600'){ echo "selected=\"Selected\""; } ?>>10 นาที</option>
                    <option value="900" <?php if($attribute_v[4]=='900'){ echo "selected=\"Selected\""; } ?>>15 นาที</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right"  colspan="2">เมื่อ Login แล้วให้เปิดเว็บ : </td>
                <td colspan="4">
                  <input name="start_page" type="text" class="form-control" id="start_page" value="<?php echo"$attribute_v[0]"?>" />
                </td>
              </tr>

                <?php 
                  } 
                    echo $last = $group->gid + 1;
                  } 			

                  ($count % 2 == 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";

                  if($_REQUEST['action'] == "add" || $error == 1) {
                    $bgcolor = "#FFFFFF";
                ?>
  
              <tr>
                <td align="left" colspan="2">
                  <input type="text" name="newgroupdesc" class="form-control" id="newgroupdesc" class="<?php if($error) { echo "noborder4" ;} else { echo "noborder" ; } ?>"/>
                  <input type="hidden" name="newgname" id="newgname" value="<?= date("YmdHis") ?>" /></td>
                <td>
                  <input name="newgroupdownload" type="text" class="noborder3" id="newgroupdownload" value="<?= $newup ?>"/>
                  :
                  <input name="newgroupupload" type="text" class="noborder3" id="newgroupupload" value="<?= $newdown ?>"/>
                </td>
                <td colspan="2">
                  <input name="newgroupexpire" type="date" class="form-control" id="newgroupexpire" value="<?= $newexpire ?>"/>
                </td>
                <td>
                  <input name="action" type="hidden" id="action" value="saveadd" />
                  <input name="action" type="image" value="save" class=" btn btn-primary fa fa-lg fa-floppy-o"  />
                </td>
              </tr>
              <tr>
                <td align="right" colspan="2">login 1 ครั้งเล่นได้นานครั้งละ : </td>
                <td colspan="4">
                  <select class="form-control" name="s_time" id="s_time" >
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
                  </select>
                </td>
              </tr>
              <tr>
              <td align="right" colspan="2">เล่นได้วันละ :</td>
                <td colspan="4">
                  <select class="form-control" name="d_time" id="d_time">
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
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right" colspan="2"> ถ้าไม่ใช้งาน จะตัดการเชื่อมต่อ :</td>
                <td colspan="4">
                  <select class="form-control" name="i_time" id="i_time" >
                    <option value="300">5 นาที</option>
                    <option value="600">10 นาที</option>
                    <option value="900">15 นาที</option>
                    <option value="1200">20 นาที</option>
                    <option value="1800" >30 นาที</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right" colspan="2">ตรวจสอบสถานะทุก  : </td>
                <td colspan="4">
                  <select class="form-control" name="a_time" id="a_time" >
                    <option value="60">1 นาที</option>
                    <option value="120">2 นาที</option>
                    <option value="180">3 นาที</option>
                    <option value="300" >5 นาที</option>
                    <option value="600" >10 นาที</option>
                    <option value="900" >15 นาที</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right"  colspan="2">เมื่อ Login แล้วให้เปิดเว็บ : </td>
                <td colspan="4">
                  <input name="start_page" type="text" class="form-control" id="start_page" value="http://www.google.com" />
                </td>
              </tr>

              <?php } ?>

            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>
</form>