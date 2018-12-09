<?php
$squidreload = shell_exec('sudo -u root /etc/init.d/squid3 reload');
echo "<pre>$squidreload</pre>";
echo " Squid is now reloading...";
echo "<meta http-equiv=refresh content ='0;url=index2.php?option=service_manage'>";
?>