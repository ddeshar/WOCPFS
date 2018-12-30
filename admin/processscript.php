<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

?>
<script>
	function stoperror(){
		return true
	}
	window.onerror=stoperror
</script>

<h2><strong>บันทึกเรียบร้อย</strong></h2>
<?php
	$fn = "/etc/squid3/key.txt";
	$fn1 = "/etc/squid3/download.txt";
	$content = stripslashes($_POST['content']);
	$content1 = stripslashes($_POST['content2']);
	$fp = fopen($fn,"w") or die ("Error opening file in write mode!");
	fputs($fp,$content);
	fclose($fp) or die ("Error closing file!");
	$fp1 = fopen($fn1,"w") or die ("Error opening file in write mode!");
	fputs($fp1,$content1);
	fclose($fp1) or die ("Error closing file!");
	shell_exec('sudo /usr/sbin/squid3 -k reconfigure');
	echo "<meta http-equiv=\"refresh\" content=\"2; url=index2.php?option=form\" />\n";
?>
