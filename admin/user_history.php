<?php
include("include/class.testlogin.php");
?>
<?
	$start = $end = date("Y-m-d");
	if(isset($_REQUEST['submit'])) {
		$start = $_REQUEST['start'];
		$end = $_REQUEST['end'];
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
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_013.png" alt="" width="59" height="60" /></td>
    <td width="94%"><a href="index2.php?option=user_history">History</a><br />
<span class="normal">ประวัติการใช้งานอินเทอร์เน็ต</span></td>
    <td width="94%">&nbsp;</td>
  </tr>
</table>
<form id="form1" method="post" action="">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  
  <tr>
    <td width="35%" align="right">&nbsp;</td>
    <td width="65%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">วันที่เริ่มต้น :
      <input name="start" type="text" class="inputbox" id="start" value="<?= $start ?>" style="width: 100px; text-align:center; padding-left:2px" /> 
      วันที่สิ้นสุด :
      <input name="end" type="text" class="inputbox" id="end" value="<?= $end ?>" style="width: 100px; text-align:center; padding-left: 2px"   />
      <input name="submit" type="submit" class="button" id="submit" value="แสดงข้อมูล" /></td>
    </tr>
</table>
</form>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="1" class="header">
  <tr>
    <td align="center" height="5"></td>
  </tr>
</table>
<?php 
	if(isset($_REQUEST['submit'])) {
		$sql = "select * from radacct,account where radacct.acctstarttime >= '".$_REQUEST['start']." 00:00:00' and radacct.acctstarttime <= '".$_REQUEST['end']." 23:59:59' and radacct.username = account.username and radacct.acctstoptime IS NOT NULL order by radacct.acctstarttime ";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$totals = mysqli_num_rows($result);
		
    } else {
		$sql = "select * from radacct,account where radacct.acctstarttime >= '".date("Y-m-d")." 00:00:00' and radacct.acctstarttime <= '".date("Y-m-d")." 23:59:59' and radacct.username = account.username and radacct.acctstoptime IS NOT NULL order by radacct.acctstarttime ";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$totals = mysqli_num_rows($result);
    }
?>
       
  <table width="95%" align="center" cellspacing="1" class="admintable">
    <tr>
    <td height="30" colspan="5" align="left" >    จำนวนการใช้งานภายในช่วงเวลาดังกล่าว มีทั้งสิ้น
   <b class="red">   <?= $totals ?>
    </b> ครั้ง</td>
    </tr>
    <tr>
      <td width="30" height="24" align="center" class="key">ลำดับ</td>
	  <td width="59" height="24" align="center" class="key">ชื่อผู้ใช้</td>
      <td width="170" height="24" align="center" class="key">ชื่อ - นามสกุล</td>
      <td width="160" height="24" align="center" class="key">เริ่มต้น-สิ้นสุดใช้งาน</td>
      <td width="100" height="24" align="center" class="key">หมายเลขไอพี</td>
      <td width="50" height="24" align="center" class="key">เป็นเวลา</td>
	  <td width="80" height="24" align="center" class="key">Upload </td>
      <td width="80" height="24" align="center" class="key">Download</td>
    </tr>
        <?
		$count = 0;
		while($data = mysqli_fetch_object($result)) {
			$count++;
			($count % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
		?>
	  <tr>
      <td width="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $count  ?></td>
	  <td width="59" align="left" valign="top" bgcolor="<?= $bgcolor ?>"><div align="center"><span class="small small">
      <?= $data->username ?></td>
      <td width="170" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;<?= $data->firstname ?> <?= $data->lastname ?></td>
      <td width="160"  align="center" valign="top" bgcolor="<?php echo $bgcolor ?>"><?php 
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
		  } ?></td>
      <td width="100"  align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $data->framedipaddress ?>&nbsp;</td>
      <td width="50"  align="right" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;<?
	  $hours = floor($data->acctsessiontime/60.0/60.0);
	  $mins = floor(($data->acctsessiontime - $hours * 60.0 * 60.0)/60.0);
	  $secs = $data->acctsessiontime - ($hours * 60.0 * 60.0) - ($mins * 60.0);
	  printf("%d:%02d:%02d", $hours, $mins, $secs);
	  
	  ?>&nbsp;&nbsp;</td>
</span></div></td>
    <td width="80" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><span class="Arial-text">
      <?= Round(((int)$data->acctinputoctets/1000000),2) ?> </span>
    MB.
    <td width="80" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><span class="Arial-text">
      <?= Round(((int)$data->acctoutputoctets/1000000),2) ?>
      </span>
    MB.

    </tr>
<?

		}
?> 
</table>
  <BR /><BR />
</div>
</body>
</html>
