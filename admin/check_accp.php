<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

   $message = "";
   if($_REQUEST['ip']){
      $sql = "DELETE FROM ap WHERE ipaddr = '".$_REQUEST['ip']."'";
      mysqli_query($GLOBALS["___mysqli_ston"], $sql);
      $message = "ลบเรียบร้อยแล้ว";
   }
   
   $pass = 0;
   foreach($_REQUEST as $key => $value)  {
      $$key = $value;
   }
   if(isset($button)) {
      if($ipaddr=="") {
         $message = "กรอกข้อมูลให้ครบด้วยครับ";
         $pass = 1;
      }
      if($apname == "") {
         $message = "กรอกข้อมูลให้ครบด้วยครับ";
         $pass = 1;
      }
      if($pass==0){
         $sql = "INSERT INTO ap VALUES('".$_REQUEST[apname]."','".$_REQUEST[ipaddr]."')";
         mysqli_query($GLOBALS["___mysqli_ston"], $sql);
         $message = "เพิ่มข้อมูลเรียบร้อยแล้วครับ";
      }         
   }      

?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-signal"></i> สถานะ Access Point</h1>
        <p>Access Point Status</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=check_accp">สถานะ Access Point</a></li>
    </ul>
</div>



<div class="row">
   <div class="col-md-12">
      <div class="tile">
         <!-- <h3>สถานะ Access Point</h3> -->
         <div class="tile-body">
            <table class="table table-hover table-bordered" id="sampleTable">
               <thead>
                  <tr>
                     <th>ตัวที่</th>
                     <th>ชื่อ AP</th>
                     <th>IP Address</th>
                     <th>สถานะ</th>
                     <th>ดำเนินการ</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $sql = "SELECT * FROM ap";
                     $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
                     $c = mysqli_num_rows($result);
                     for( $i = 0 ; $data = mysqli_fetch_object($result) ; $i++ ){
                        $name[$i] = $data->apname;
                        $ipad[$i] = $data->ipaddr;
                     }
                     
                     function ping($ip){
                        $cmd=shell_exec("sudo -u root ping -c 1 -w 1 $ip");

                        $dati_mount=explode(",",$cmd);
                           if (preg_match ("/0/i", $dati_mount[1], $out)) {$connesso="off";}
                           if (preg_match ("/1/i", $dati_mount[1], $out)) {$connesso="on";}
                        $esito=$connesso;

                        return $esito;
                     }

                     $count = 0;
                     for($i=0;$i<$c;$i++){
                        $esito=ping($ipad[$i]);
                        $count++;
                        
                        if($esito=='on'){
                           $image = "ON";
                        }else{
                           $image = "OFF";
                        }
                  ?>
                  <tr>
                     <td><?= ($i+1) ?></td>
                     <td><?= $name[$i] ?></td>
                     <td><?= $ipad[$i] ?></td>
                     <td><img src="status.php?link=<?= $ipad[$i] ?>"></td>
                     <td>
                        <a href="index2.php?option=check_accp&do=1&ip=<?=$ipad[$i]?>"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <div class="col-md-12">
      <div class="tile">
         <h3 class="tile-title">เพิ่ม Access Point</h3>
         <div class="tile-body">
            <form action="index2.php?option=check_accp" method="post" name="regis" class="row">
               <div class="form-group col-md-3">
                  <label class="control-label">ชื่อ Access Point</label>
                  <input name="apname" type="text" class="form-control" id="apname" />
               </div>
               <div class="form-group col-md-3">
                  <label class="control-label">IP Access Point</label>
                  <input name="ipaddr" type="text" class="form-control" id="ipaddr"  />
               </div>
               <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit" name="button" id="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>เพิ่ม</button>
               </div>
            </form>
         </div>
      </div>
   </div>

</div>

<div class="card col-md-12 border-danger">
   <div class="card-body">
   <blockquote class="card-blockquote">
      <p><strong class="normal">หมายเหตุ !<img src="images/aponline.png" width="35" height="35" />ใช้การปกติ <img src="images/apoffline.png" width="35" height="35" />ไม่สามารถใช้งานได้</strong></p>
   </blockquote>
   </div>
</div>

<!-- <i class="text-primary fa fa-wifi"></i>
<i class="text-danger fa fa-wifi"></i> -->