<?php
  include("include/class.testlogin.php");

  function generatePassword ($length = 6){

    // start with a blank password
    $password = "";

    // define possible characters
    $possible = "0123456789abcdefghijklmnopqrstuvwxyz"; 
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
  $error1 = $error2 = $error3 = 0;
  $pass = false;
  if($action == "generate") {
    if(!isset($group)) $error1 = 1;
    if(empty($username)) $error2 = 1;
    if(empty($numadd)) $error3 = 1;
    if($error1 == 0 && $error2 == 0 && $error3 == 0 ) {
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
      $sql = "INSERT INTO account VALUES('".$username[$i]."','".$password[$i]."','".$username[$i]."','".$group."','--','".date("Y-m-d H:i:s")."','clear','1')";
      mysqli_query($GLOBALS["___mysqli_ston"], $sql);
      //echo $sql . "<BR>"; 
      $sql = "INSERT INTO radusergroup VALUES('".$username[$i]."','".$group."','1')";
      mysqli_query($GLOBALS["___mysqli_ston"], $sql);
      //echo $sql . "<BR>"; 
      $sql = "INSERT INTO radcheck VALUES(NULL,'".$username[$i]."','Cleartext-Password',':=','".$password[$i]."')";
      mysqli_query($GLOBALS["___mysqli_ston"], $sql);
      //echo $sql . "<BR>"; 
    }
    $sql = "SELECT * FROM genuser WHERE userprefix = '$prefix'";
    // echo $sql;
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    if(mysqli_num_rows($result) == 0) {
      $sql = "INSERT INTO genuser VALUES ('$prefix', '$last')";
      //echo $sql;
      
    } else {
      $sql = "UPDATE genuser SET userlastno = '$last' WHERE userprefix = '$prefix'";
      //echo $sql;
    }
    mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    
  }
?>

  <div class="app-title">
      <div>
          <h1><i class="fa fa-users"></i> Generate Multi Users</h1>
          <p>Generate Multi Users</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="index2.php?option=add_user">Generate Multi Users</a></li>
      </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <form id="form1" method="post" action="<?php if($pass && $action != "generate") { echo "ThaiPDF/exportPDF-user.php"; } ?>" <?php if($pass && $action != "generate") {  ?> target="_blank"<?php } ?>>

          <div class="tile-title-w-btn">
            <div class="btn-group">
              <?php if(!$pass) { ?>
                <button class="btn btn-primary" type="submit" name="submit" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Process</button>
              <?php } else { ?>
              <?php if($action == "generate") { ?>
                <button class="btn btn-primary" type="submit" name="submit" id="submit"><i class="fa fa-fw fa-lg fa-floppy-o"></i>Save</button>
              <input type="button" name="button2" id="button2" class="btn btn-danger" value="cancel" onclick="window.location='index2.php?option=add_user'" />
              <?php } else { ?>
                <button class="btn btn-primary" type="submit" name="submit" id="submit"><i class="fa fa-fw fa-lg fa-print"></i>Print</button>
              <?php }
              } ?>
            </div>
          </div>

          <div class="tile-body row">

              <?php 
                if(!$pass) {
                  if(isset($message)) { echo $message; }  

                  $sql = "SELECT * FROM groups";
                  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
                  $num = mysqli_num_rows($result);

                  if(!isset($_REQUEST['group'])) {
                    $groups = "กรุณาเลือกกลุ่ม";
                  } else {
                    $sql = "SELECT * FROM groups WHERE gname = '".$_REQUEST['group']."'";
                    $result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
                    $data2 = mysqli_fetch_object($result2);
                    $groups =   "กลุ่ม  " . $data2->gdesc ;
                  } 
              ?>

            <div class="form-group col-md-3">
              <div class="widget-small <?php if($error1) { echo "danger"; }else{ echo "primary"; } ?> "><i class="icon fa fa-users fa-3x"></i>
                  <a class="nav-link dropdown-toggle btn-<?php if($error1) { echo "danger"; }else{ echo "primary"; } ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=$groups ?></a>
                  <div class="dropdown-menu">
                    <?php
                      while($groups = mysqli_fetch_object($result)) {
                    ?>
                      <a class="dropdown-item" href="index2.php?option=add_user&group=<?= $groups->gname ?>&username=<?= $username ?>&numadd=<?= $numadd ?>"><?= $groups->gdesc ?></a>
                    <?php } ?>
                  </div>
              </div>
            </div>

            <div class="form-group col-md-3">
              <label class="control-label">คำขึ้นต้นชื่อผู้ใช้</label>
              <input name="username" type="text" class="form-control <?php if($error2) { echo "is-invalid"; } ?>" id="username" value="<?= $username ?>" />
              <input name="action" type="hidden" id="action" value="generate" /> </td>
              <div class="form-control-feedback"><?php if($error2) { echo "ระบุคำขึ้นต้นชื่อผู้ใช้ด้วยครับ"; } ?></div>
            </div>
            
            <div class="form-group col-md-3">
              <label class="control-label">จำนวนที่ต้องการสร้าง</label>
              <input name="numadd" type="text" class="form-control <?php if($error3) { echo "is-invalid"; } ?>" id="numadd" value="<?= $numadd ?>" /> </td>
              <div class="form-control-feedback"><?php if($error3) { echo "ระบุจำนวนที่ต้องการสร้างด้วยครับ"; } ?></div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>

<?php 
  } else {
  $sql = "SELECT * FROM groups WHERE gname = '$group'";
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $data = mysqli_fetch_object($result);

  if($action == "generate") { 
?>
    <div class="bs-component">
      <div class="alert alert-success">ตารางแสดงรายชื่อสมาชิกที่จะเพิ่มใหม่ในกลุ่ม <b class="text-danger" ><?= $data->gdesc ?></b> ทั้งสิ้น <b class="text-danger"><?= $numadd ?></b> คน</div>
    </div>

    <table class="table table-striped">
      <tr align="center">
        <th>ลำดับที่</th>
        <th>ชื่อผู้ใช้งาน</th>
        <th>รหัสผ่าน</th>
        <th>วันหมดอายุ</th>
        <th>ความเร็วเน็ต<br />(ดาวน์โหลด / อัพโหลด)</th>
      </tr>
        <?php 
          $count = 0;
          for($i=0; $count < $numadd; $i++) { 
            ($i % 2 == 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
              $newuser = sprintf("%s%d", $username, $start + $i);
            $newpass =  generatePassword(6);
            $sql = "SELECT * FROM account WHERE username = '".$newuser."'";
            if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))) {
              continue;
            } else {
              $count++;
            }
        ?>
          <tr align="center" >
            <td><?= $count ?></td>
            <td><input id="username[<?= $count ?>]" name="username[<?= $count ?>]" type="hidden" value="<?= $newuser ?>"  /><?= $newuser ?></td>
            <td><input id="password[<?= $count ?>]" name="password[<?= $count ?>]" type="hidden" value="<?= $newpass ?>" /><?= $newpass ?>             </td>
            <td><?= $data->gexpire ?></td>
            <td><?= $data->gdownload?>/<?= $data->gupload ?> KB</td>
          </tr>
        <?php } ?>
    </table>

    <input name="last" type="hidden" value="<?= $start + $count ?>" />
    <input name="prefix" type="hidden" value="<?= $username ?>" />
    <input name="action" type="hidden" value="save" />
    <input name="numadd" type="hidden" value="<?= $numadd ?>" />
<?php } else { ?>

<div class="col-lg-12">
  <div class="bs-component" align="center">
    <div class="alert alert-success">บันทึกข้อมูลผู้ใช้ใหม่เรียบร้อยแล้ว <br> ตารางแสดงรายชื่อสมาชิกที่จะเพิ่มใหม่ในกลุ่ม <b class="text-danger" ><?= $data->gdesc ?></b> ทั้งสิ้น <b class="text-danger"><?= $numadd ?></b> คน</div>
  </div>
</div>

<table class="table table-striped" >
    <tr align="center">
      <th>ลำดับที่</th>
      <th>ชื่อผู้ใช้งาน</th>
      <th>รหัสผ่าน</th>
      <th>วันหมดอายุ</th>
      <th>ความเร็วเน็ต<br /> (ดาวน์โหลด / อัพโหลด)</th>
    </tr>
    <?php 
      for($i = 1; $i <= $numadd; $i++) {
		?>
    <tr align="center">
      <td><?= $i ?></td>
      <td><input id="username[<?= $i ?>]" name="username[<?= $count ?>]" type="hidden" value="<?= $username[$i] ?>"  /><?= $username[$i] ?></td>
      <td><input id="password[<?= $i ?>]" name="password[<?= $count ?>]" type="hidden" value="<?= $password[$i] ?>" /><?= $password[$i] ?></td>
      <td><?= $data->gexpire ?></td>
      <td><?= $data->gdownload?>/<?= $data->gupload ?> KB</td>
    </tr>
    <?php } ?>
  </table>
    <input name="last" type="hidden" value="<?= $start + $count ?>" />
    <input name="prefix" type="hidden" value="<?= $username ?>" />
    <input name="action" type="hidden" value="print" />
    <input name="group" type="hidden" value="<?= $group ?>" />
    <input name="numadd" type="hidden" value="<?= $numadd ?>" />
    <input name="passC" type="hidden" value="<?= $passC ?>" />

<?php } } ?>
</form>