<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

$shutdown = shell_exec('sudo -u root /sbin/shutdown -h now');
echo "<pre>$shutdown</pre>";
echo "System is now shuttingdown.";
echo "<meta http-equiv=refresh content ='0;url=index2.php?option=service_manage'>";
?> 
