<?php
$squidreload = shell_exec('sudo -u root /etc/init.d/squid restart');
echo "<pre>$squidreload</pre>";
echo " Squid is now restarting...   please wait ...";
echo "<meta http-equiv=refresh content ='0;url=index2.php'>";
?>