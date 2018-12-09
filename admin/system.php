<?php
        include("include/config.inc.php");
        if(!isset($_SESSION['logined'])) {
                ?><meta http-equiv="refresh" content="0;url=index.php"><?
        }

?>

 <?php   
 
 $init=$_POST[init];
 $Submit=$_POST[Submit];
 /*
 แก้ไข   /usr/local/etc/sudoers  เพิ่ม
www ALL=NOPASSWD: /bin/echo, /usr/bin/radclient
www ALL=NOPASSWD: /usr/local/etc/rc.d/squid
www ALL=NOPASSWD: /usr/local/sbin/squid
www ALL=NOPASSWD: /sbin/init
www ALL=NOPASSWD: /sbin/reboot
 
 */
 
 
if($init==3 and $Submit=="Submit") { 
 
 echo '<pre>';
 $last_line = system('/usr/local/bin/sudo  /sbin/reboot', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
print "<h1><br> Run   Restart  Now</h1><br> $retval";
			   }
			   
			   
			   
if($init==0  and $Submit=="Submit" ){

 
 echo '<pre>';
 $last_line = system('/usr/local/bin/sudo /sbin/init 0', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
print "<h1><br> Run Shutdown Now</h1> <br> $retval";
########################################
			 
			  }
			  
if($init==2  and $Submit=="Submit") { 
              
##########################################
 echo '<pre>';
 $last_line = system('/usr/local/bin/sudo  /usr/local/sbin/squid -k reconfig ', $retval);
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
########################################
 print "<h1><br> Run Proxy Restart </h1><br> $retval";
 exit();
}
?>  

<html>
<head>
<title>.:: control FreeBSD server เปิด - ปิด Serverice  โดยคุณ Yim .::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php print $init; ?>
<form name="form1" method="post" action="index2.php?option=system">
  <table width="366" border="0" align="center">
    <tr bgcolor="#66FFFF"> 
      <td colspan="2" width="360"><div align="center"><b><font color="blue">Control 
                    &nbsp;&nbsp;System &nbsp;&nbsp;By :: คุณธนกร &nbsp;เปี่ยมสินธุ์ 
                    ::</font></b></div></td>
    </tr>
    <tr> 
      <td width="53%" bgcolor="#FFFFCC"><input type="radio" name="init" value="3">
        Reboot</td>
      <td width="45%" bgcolor="#FFFFCC">รีบูตระบบ</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFCC" width="193" height="21"><input type="radio" name="init" value="0">
        Shutdown </td>
      <td bgcolor="#FFFFCC" width="163" height="21">ปิดเครื่อง</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFCC" width="193"><input type="radio" name="init" value="2">
      Restart &nbsp;Squid &nbsp;Proxy </td>
      <td bgcolor="#FFFFCC" width="163">squid -k reconfig</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFCC" width="360">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" width="360"><div align="center">
          <input type="submit" name="Submit" value="Submit">
        </div></td>
    </tr>
    <tr bgcolor="#66FFFF"> 
      <td colspan="2" width="360"> <div align="center"> </div></td>
    </tr>
  </table>
</form>
</body>
</html>
