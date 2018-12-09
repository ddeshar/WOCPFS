<?php
$reboot = shell_exec('sudo -u root /sbin/shutdown -r now');
echo "<pre>$reboot</pre>";
echo "System is now reboot";
echo "<meta http-equiv=refresh content ='0;url=index2.php'>";
?> 
