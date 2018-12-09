<?php
$output = shell_exec('sudo -u root /etc/init.d/squid reload');
echo "<pre>$output</pre>";
echo "กรุณารอสักครู่ระบบกำลังอับเดทข้อมูล";
echo "<meta http-equiv=refresh content ='0;url=index2.php'>";
?> 

