<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

$reboot = shell_exec('sudo -u root /sbin/shutdown -r now');
echo "<pre>$reboot</pre>";
echo "System is now rebootting";
echo "<meta http-equiv=refresh content ='0;url=index2.php?option=service_manage'>";
?> 
