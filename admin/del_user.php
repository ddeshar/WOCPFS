<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

   ob_start();
      include("include/class.mysqldb.php");
      include("include/config.inc.php");

   $sql = "SELECT * FROM radacct  WHERE radacct.AcctStopTime = '0000-00-00 00:00:00' ORDER BY radacct.acctStartTime ";
   $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

   while($data = mysqli_fetch_object($result)) {
      $user = $data->UserName;
      shell_exec("sudo /bin/echo 'User-Name = $user' | /usr/local/bin/radclient -x LAN_IP:3779 disconnect radius_secret");
      $sql2 = "DELETE FROM radacct WHERE ((acctStopTime = '0000-00-00 00:00:00') AND (UserName='$user'))";
      $result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
   }
?>
