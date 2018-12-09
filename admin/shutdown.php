<?php
$shutdown = shell_exec('sudo -u root /sbin/shutdown -h now');
echo "<pre>$shutdown</pre>";
echo "System is now shuttingdown.";
echo "<meta http-equiv=refresh content ='0;url=index2.php?option=service_manage'>";
?> 
