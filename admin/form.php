<?php
//	include("include/class.mysqldb.php");
//	include("include/config.inc.php");
  if(!isset($_SESSION['logined'])) {
    ?><meta http-equiv="refresh" content="0;url=index.php"><?
  } 
	
?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-ban"></i> บล็อคเว็บผ่าน squid</h1>
        <p>Block Web Squid</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=form">บล็อคเว็บผ่าน squid</a></li>
    </ul>
</div>

<form action="processscript.php" method="post">
  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Block เว็บ</h3>
        <div class="tile-body">
          <div class="form-group">
            <!-- <label class="control-label">Address</label> -->
            <textarea class="form-control" rows="14" name="content">
              <?php
                $fn = "/etc/squid3/key.txt";
                print htmlspecialchars(implode("",file($fn)));
              ?> 
            </textarea>
          </div>
        </div>

      </div>
    </div>
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Block ดาวน์โหลดไฟล์</h3>
        <div class="tile-body">
          <div class="form-group">
            <!-- <label class="control-label">Address</label> -->
            <textarea class="form-control" rows="14" name="content2">
              <?php
                $fn = "/etc/squid3/download.txt";
                print htmlspecialchars(implode("",file($fn)));
              ?> 
            </textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="tile-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก</button>
      </div>
    </div>
  </div>
</form>