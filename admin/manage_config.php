<?php
  include("include/class.testlogin.php");

	$message = $url = "";
	foreach($_REQUEST as $key => $value) {
		$$key = $value;
	}
	if(isset($_REQUEST['submit'])) { 
		$sql = "UPDATE configuration SET VALUE = '$default_regis_status' WHERE variable = 'default_regis_status'";
		mysqli_query($GLOBALS["___mysqli_ston"], $sql);

		if($userurl == "3")
			$sql = "UPDATE configuration SET VALUE = '$url' WHERE variable = 'redirect'";
		else
			$sql = "UPDATE configuration SET VALUE = '$userurl' WHERE variable = 'redirect'";
		mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $message ="<div class=\"alert alert-success\"><strong>บันทึกการเปลี่ยนแปลงเรียบร้อยแล้ว</strong></div>";
    
	}
	$sql = "SELECT * FROM configuration WHERE variable = 'default_regis_status'";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$data = mysqli_fetch_object($result);
	$default_regis_status = $data->value;
	$sql = "SELECT * FROM configuration WHERE variable = 'redirect'";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$data = mysqli_fetch_object($result);
	$redirect = $data->value;
	
	$check1 = array("", "");
	$check2 = array("", "", "","");
	$check1[$default_regis_status] = "checked=\"checked\"";
	if($redirect == "1" || $redirect == "2") {
		$check2[$redirect] = "checked=\"checked\"";
		$url = "";
	} else {
		$check2[3] = "checked=\"checked\"";
		$url = $redirect;
	}	
	
?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-pencil"></i> แก้ไขค่าคอนฟิคกูเรชั่นของระบบ</h1>
        <p>Global Configuration</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=manage_config">แก้ไขค่าคอนฟิคกูเรชั่นของระบบ</a></li>
    </ul>
</div>

<div class="row">

  	<div class="col-lg-12">
			<div class="bs-component">
        <?php if(isset($message)) { echo $message; } ?>
			</div>
		</div>


  <div class="col-md-6">
    <div class="tile">
      <form id="form1" method="post" action="">

        <div class="tile-title-w-btn">
          <!-- <h3 class="title">แก้ไขค่าคอนฟิคกูเรชั่นของระบบ</h3> -->
          <div class="btn-group">
            <input type="submit" name="submit" class="btn btn-primary" id="submit" value="บันทึก" class="button" /></td>
          </div>
        </div>

        <div class="tile-body">
          
            <div class="form-group row">
              <label class="control-label col-md-5">สมัครสมาชิกแล้วใ้ช้งานได้ทันที</label>
              <div class="col-md-7">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="default_regis_status" id="default_regis_status" value="1"  <?= $check1[1] ?>/> เปิด 
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input name="default_regis_status" class="form-check-input" type="radio" id="default_regis_status" value="0" <?= $check1[0] ?> /> ปิด 
                  </label>
                </div>
              </div>
            </div>
                      
            <div class="form-group row">
              <label class="control-label col-md-5">เมื่อผู้ใช้เข้าระบบสำเร็จให้ไปที่</label>
              <div class="col-md-7">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" name="userurl" class="form-check-input" id="userurl" value="1" <?= $check2[1] ?>/>หน้าเดิมก่อนล็อกอิน        
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" name="userurl" id="userurl" class="form-check-input" value="2" <?= $check2[2] ?> />หน้าเว็บว่าง
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" name="userurl" id="userurl2" class="form-check-input" value="3"   <?= $check2[3] ?>/><input type="text" name="url" id="url" class="form-control" value="<?= $url ?>" />
                  </label>
                </div>
              </div>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

