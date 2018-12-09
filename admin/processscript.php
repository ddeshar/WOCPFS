<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Burapha Linux Laboratory" />
	<meta name="keywords" content="authentication system" />
	<meta name="description" content="Burapha Linux Authentication Project" />	
    <link href="css/main.css" type=text/css rel=stylesheet>
    <link href="css/calendar-mos.css" type=text/css rel=stylesheet>
    <script language="javascript" src="js/calendar.js"></script>
    <script>
function stoperror(){
return true
}
window.onerror=stoperror
</script>
	<title>-:- save -:-</title>
</head>
<body class="red">
<h2><strong>บันทึกเรียบร้อย</strong></h2>
</body>
</html>
<?
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
