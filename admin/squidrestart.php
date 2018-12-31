<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
    #####################################################*/

$squidreload = shell_exec('sudo -u root /etc/init.d/squid3 restart');
echo "<pre>$squidreload</pre>";
echo " Squid is now restarting...   please wait ...";
echo "<meta http-equiv=refresh content ='0;url=index2.php?option=service_manage'>";
?>