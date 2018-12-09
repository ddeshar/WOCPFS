<?php
$message = "";
if($_REQUEST['ip']){
   $sql = "delete from ap where ipaddr = '".$_REQUEST['ip']."'";
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
		$sql = "insert into ap values('".$_REQUEST[apname]."','".$_REQUEST[ipaddr]."')";
		 mysqli_query($GLOBALS["___mysqli_ston"], $sql);
      $message = "เพิ่มข้อมูลเรียบร้อยแล้วครับ";
                     
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
    <script language="javascript" src="js/show.js"></script>
	<title>-:- Authent!cation -:-</title>
</head>
<body>
<div id="content">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
  <tr>
    <td width="6%" align="center"><img src="images/BlackNeonAgua_111.png" alt="" width="59" height="60" /></td>
    <td width="94%"><a href="index2.php?option=check_accp">Access Point Status</a><br />
<span class="normal">สถานะ Access Point</span></td>
    <td width="94%">&nbsp;</td>
  </tr>
</table>
   <table width="95%" align="center" cellspacing="1" class="admintable">
   <tr>
    <td colspan="4" align="center" class="red" ><?php 
         echo $message; ?></td>
    <tr>
      <td width="30" align="center" class="key">ตัวที่</td>
      <td width="200" align="center" class="key">ชื่อ AP</td>
      <td width="200" align="center" class="key">IP Address</td>
      <td width="120" align="center" class="key">สถานะ</td>
     <td width="120" align="center" class="key">ดำเนินการ</td>
     
      </tr>
    <?php 
   $sql = "select * from ap";
   $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
   $c = mysqli_num_rows($result);
   for( $i = 0 ; $data = mysqli_fetch_object($result) ; $i++ )
   {
               $name[$i] = $data->apname;
               $ipad[$i] = $data->ipaddr;
   }
   
   function ping($ip){
   $cmd=shell_exec("sudo -u root ping -c 1 -w 1 $ip");

   $dati_mount=explode(",",$cmd);
  if (eregi ("0", $dati_mount[1], $out)) {$connesso="off";}
  if (eregi ("1", $dati_mount[1], $out)) {$connesso="on";}
  $esito=$connesso;

   return $esito;
   }
   $count = 0;
   for($i=0;$i<$c;$i++)
   {   
      $esito=ping($ipad[$i]);
      ($count % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
      $count++;
      
  if($esito=='on'){
   $image = "images/aponline.png";
   }else{
   $image = "images/apoffline.png";
   }
      
      ?>
    <tr>
      <td width="30" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= ($i+1) ?></td>
      <td width="200" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $name[$i] ?></td>
      <td width="200" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $ipad[$i] ?></td>
     <td width="120" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><img src="status.php?link=<?= $ipad[$i] ?>" width="35" height="35"></td>
      <td width="120" align="center" valign="top" bgcolor="<?= $bgcolor ?>">
        <a href="index2.php?option=check_accp&do=1&ip=<?=$ipad[$i]?>"><img src="images/delete.png" alt="ลบ" /></a></td>
     </tr>

       
    <?          ($count % 2 == 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";}
 ?>
</table>
<form action="index2.php?option=check_accp" method="post" name="regis">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
            <tr>
                <td><strong class="normal">ชื่อ Access Point</strong></td>
                <td><strong class="normal">IP Access Point</strong></td>
             <td>&nbsp;</td>
              </tr>
              <tr>
           <td><input name="apname" type="text" class="inputbox-normal" id="apname" /></td>
                <td><input name="ipaddr" type="text" class="inputbox-normal" id="ipaddr"  /></td>
            <td><input type="submit" name="button" id="button" class="button" value="เพิ่ม" /></td>
              </tr>             
            </table> 
         
</form>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10" class="header">
              <tr>
           <td colspan="4"><strong class="normal">หมายเหตุ !<img src="images/aponline.png" width="35" height="35" />ใช้การปกติ&nbsp;,&nbsp; <img src="images/apoffline.png" width="35" height="35" />ไม่สามารถใช้งานได้</strong></td>
              </tr>             
            </table> 
  <BR /><BR />
</div>
</body>
</html>