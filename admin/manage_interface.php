<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

  include("include/class.testlogin.php");

  $message = "";
  if(isset($_POST['submit'])) { 
    foreach($_POST as $key => $value) {
      $sql = "UPDATE interface SET VALUE = '".$value."' WHERE variable = '".$key."'";
      //echo $sql . "<hr>";
      mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    }
    $message = "<div class=\"alert alert-success\">บันทึกการแก้ไขเรียบร้อยแล้ว</div>";
  }
  include("include/class.interface.php");
  $inf = new interfaces($link);
?>				
<div class="app-title">
    <div>
        <h1><i class="fa fa-sign-in"></i> ปรับแต่งหน้าจอล็อกอิน</h1>
        <p>Interface Manager</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=manage_interface">ปรับแต่งหน้าจอล็อกอิน</a></li>
    </ul>
</div>

<a href="index2.php?option="></a>


<div class="row">
  <div class="col-md-12">
    <div align="center" class="bs-component">
        <?= $message?>
    </div>
    <div class="tile">
      <!-- <h3 class="tile-title">ปรับแต่งหน้าจอล็อกอิน</h3> -->
      <form class="form-horizontal" id="form1" method="post" action="">
        <div class="tile-body">
            <div class="form-group row">
              <label class="control-label col-md-3">ไตเิติ้ลบาร์</label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="title" id="title" value="<?= $inf->getTitle() ?>">
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3">ข้อความต้อนรับหน้าแรก </label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="please_login" id="please_login" value="<?= $inf->getTextPleaseLogin() ?>">
              </div>
            </div>

            <!-- <div class="form-group row">
              <label class="control-label col-md-3">รหัสผ่านของผู้ใช้มีการเข้ารหัสผ่านหลายวิธี</label>
              <div class="col-md-8">
                <div class="animated-radio-button">
                  <label>
                    <input type="radio" name="multi_encryption" id="multi_encryption" value="1"> <span class="label-text">เปิด</span> 
                  </label>
                </div>
                <div class="animated-radio-button">
                  <label>
                    <input type="radio" name="multi_encryption" id="multi_encryption" value="0"> <span class="label-text">ปิด</span> 
                  </label>
                </div>
              </div>
            </div> -->

            <div class="form-group row">
              <label class="control-label col-md-3">ข้อความเมื่อพบว่าเข้าสู่ระบบไม่สำเร็จ</label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="fail_login" id="fail_login" value="<?= $inf->getTextFailLogin() ?>" >
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3">ข้อความอธิบายการใช้งานด้านล่าง</label>
              <div class="col-md-8">
              <textarea name="footer" rows="10" class="form-control" id="footer"><?= $inf->getFooter() ?></textarea>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3">ข้อความอธิบายการใช้งานด้านล่าง (ป๊อบอัพ)</label>
              <div class="col-md-8">
              <textarea name="footer_popup" rows="10" class="form-control" id="footer_popup"><?= $inf->getFooterPopUp() ?></textarea>
              </div>
            </div>
        </div>
        <div class="tile-footer">
          <div class="row">
            <div class="col-md-8 col-md-offset-3">
              <button class="btn btn-primary" type="submit" name="submit" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</form>
 