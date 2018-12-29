<?php
	if(!isset($_SESSION['logined'])) {
    ?>
      <meta http-equiv="refresh" content="0;url=index.php">
    <?php 
	} 

  if($_REQUEST['user']){
    $shell_command='sudo /bin/echo "User-Name='.$_REQUEST['user'].'" | /usr/local/bin/radclient -x 127.0.0.1:3779 disconnect radius_secret';

    $output = shell_exec($shell_command);
  }
  //echo "Disconnect User " .$_POST["txtusername"]." completed.";
?>


<div class="app-title">
    <div>
        <h1><i class="fa fa-list"></i> รายชื่อผู้ที่กำลังใช้งานอยู่</h1>
        <p>	User Online</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=user_online">รายชื่อผู้ที่กำลังใช้งานอยู่</a></li>
    </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="page-header">
        <!-- <h2 class="mb-3 line-head" >รายชื่อผู้ที่กำลังใช้งานอยู่</h2> -->
      </div>
      <div class="bs-component">
        <div class="alert alert-success">จำนวนผู้ใช้งานในช่วงเวลานี้ มีทั้งสิ้น<strong> <?= $totals ?> </strong>  คน </div>
      </div>

      <div class="tile-body">
        <?php 
          $sql = "SELECT * FROM radacct,account WHERE radacct.acctstoptime IS NULL AND radacct.username = account.username ORDER BY radacct.acctstarttime ";
          //$sql = "select * from radacct.account where radacct.acctstoptime IS NULL";
          $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
          $totals = mysqli_num_rows($result);
        ?>
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <td>ลำดับที่</td>
              <td>ชื่อผู้ใช้</td>
              <td>ชื่อ-สกุล</td>
              <td><strong>MAC</strong></td>
              <td>เลขไอพี</td>
              <td>เริ่มต้นใช้งาน</td>
              <!-- <td>Down </td> 
              <td>Up</td> 
              <td>เตะ</td>  -->
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
              <td><?= $data->username ?> </td>
              <td><?= $data->firstname ?> <?= $data->lastname ?> </td>
              <td><?= $data->calledstationid ?></td>
              <td><?= $data->framedipaddress ?></td>
              <td><?= $data->acctstarttime ?></td>
              <!--    <td>
                <?php
                  $hours = floor($data->acctsessiontime/60.0/60.0);
                  $mins = floor(($data->acctsessiontime - $hours * 60.0 * 60.0)/60.0);
                  $secs = $data->acctsessiontime - ($hours * 60.0 * 60.0) - ($mins * 60.0);
                  printf("%d:%02d:%02d", $hours, $mins, $secs);
                ?>
              </td>
              <td>
                <?= Round(((int)$data->acctinputoctets/1000000),2) ?>
              M
              <td>
              <?= Round(((int)$data->acctoutputoctets/1000000),2) ?>
              M -->
              <!-- <td><a href="index2.php?option=user_online&user=<?=$data->username?>"><img src="images/delete.png" alt="kick" width="15" height="15" /></a>   -->
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>