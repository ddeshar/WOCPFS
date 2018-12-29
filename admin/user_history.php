<?php
  include("include/class.testlogin.php");

  $start = $end = date("Y-m-d");
	if(isset($_REQUEST['submit'])) {
		$start = $_REQUEST['start'];
		$end = $_REQUEST['end'];
	}
?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-history"></i> ประวัติการใช้งานอินเทอร์เน็ต</h1>
        <p>	History</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=user_history">ประวัติการใช้งานอินเทอร์เน็ต</a></li>
    </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <!-- <h3 class="tile-title">ประวัติการใช้งานอินเทอร์เน็ต</h3> -->
      <div class="tile-body">
        <form id="form1" method="post" action="" class="row">
          <div class="form-group col-md-3">
            <label class="control-label">วันที่เริ่มต้น :</label>
            <input name="start" type="date" class="form-control" id="start" name="start"  value="<?= $start ?>"> 
          </div>
          <div class="form-group col-md-3">
            <label class="control-label">วันที่สิ้นสุด :</label>
            <input name="end" type="date" class="form-control" id="end" value="<?= $end ?>">
          </div>
          <div class="form-group col-md-4 align-self-end">
            <button class="btn btn-primary" type="submit" name="submit" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>แสดงข้อมูล</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="page-header">
        <h2 class="mb-3 line-head" >ประวัติการใช้งานอินเทอร์เน็ต</h2>
      </div>

      <?php 
        if(isset($_REQUEST['submit'])) {
            $sql = "SELECT * FROM radacct,account WHERE radacct.acctstarttime >= '".$_REQUEST['start']." 00:00:00' AND radacct.acctstarttime <= '".$_REQUEST['end']." 23:59:59' AND radacct.username = account.username AND radacct.acctstoptime IS NOT NULL ORDER BY radacct.acctstarttime ";
            $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
            $totals = mysqli_num_rows($result);		
          } else {
            $sql = "SELECT * from radacct,account where radacct.acctstarttime >= '".date("Y-m-d")." 00:00:00' and radacct.acctstarttime <= '".date("Y-m-d")." 23:59:59' and radacct.username = account.username and radacct.acctstoptime IS NOT NULL order by radacct.acctstarttime ";
            $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
            $totals = mysqli_num_rows($result);
          }
      ?>

      <div class="bs-component">
        <div class="alert alert-success">จำนวนผู้ใช้งานในช่วงเวลานี้ มีทั้งสิ้น<strong> <?= $totals ?> </strong>  คน </div>
      </div>
      <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <td>ลำดับ</td>
              <td>ชื่อผู้ใช้</td>
              <td>ชื่อ - นามสกุล</td>
              <td>เริ่มต้น-สิ้นสุดใช้งาน</td>
              <td>หมายเลขไอพี</td>
              <td>เป็นเวลา</td>
              <td>Upload </td>
              <td>Download</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $count = 0;
              while($data = mysqli_fetch_object($result)) {
                $count++;
                ($count % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
            ?>
            <tr>
              <td><?= $count  ?></td>
              <td><?= $data->username ?></td>
              <td><?= $data->firstname ?> <?= $data->lastname ?></td>
              <td>
                <?php 
                  $stime = $data->acctstarttime;
                  $sdd = substr($stime,8,2);
                  $smm = substr($stime,5,2);
                  $syy = substr($stime,0,4);
                  $sby = (int)$syy + 543;
                  $shr = substr($stime,11,2);
                  $smn = substr($stime,14,2);
                  $ssc = substr($stime,17,2);

                  echo "$sdd-$smm-$sby $shr:$smn:$ssc<br />";

                  $etime = $data->acctstoptime;
                  $edd = substr($etime,8,2);
                  $emm = substr($etime,5,2);
                  $eyy = substr($etime,0,4);
                  $eby = (int)$eyy + 543;
                  $ehr = substr($etime,11,2);
                  $emn = substr($etime,14,2);
                  $esc = substr($etime,17,2);

                  if ($data->acctstoptime) {
                    echo "$edd-$emm-$eby $ehr:$emn:$esc";
                  } else {
                    echo "ยังใช้งานอยู่ตอนนี้";
                  }
                ?>
              </td>
              <td><?= $data->framedipaddress ?></td>
              <td>
                <?php
                  $hours = floor($data->acctsessiontime/60.0/60.0);
                  $mins = floor(($data->acctsessiontime - $hours * 60.0 * 60.0)/60.0);
                  $secs = $data->acctsessiontime - ($hours * 60.0 * 60.0) - ($mins * 60.0);
                  printf("%d:%02d:%02d", $hours, $mins, $secs);
                ?>
              </td>      
              <td><?= Round(((int)$data->acctinputoctets/1000000),2) ?> MB.</td>
              <td><?= Round(((int)$data->acctoutputoctets/1000000),2) ?> MB.</td>
            </tr>
            <?php } ?> 
          </tbody>
        <div class="tile-body">
        </div>
    </div>
  </div>
</div>