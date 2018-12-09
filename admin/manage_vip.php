<?php
# ถ้าไม่ได้ผ่านการล็อกอินเข้ามาให้ย้อนกลับไปหน้าล็อกอินใหม่!
if(!isset($_SESSION['logined'])) {
	?><meta http-equiv="refresh" content="0;url=index.php"><?
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
	<link href="css/calendar-mos.css" type="text/css" rel="stylesheet"/>

    <script language="javascript" src="js/calendar.js"></script>

	<script>
		function stoperror(){
			return true
		}
		window.onerror=stoperror
	</script>
	
	<title>Manager User VIP</title>
</head>
<body>
	<div id="header-bar">
		<div id="header-logoff">User VIP 
			&raquo; 
			<a href="index2.php?option=manage_vip">
				Manager VIP
			</a>
		</div>
    </div>

			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tbody>
			<tr bgcolor="#666666">
				<td width="20%" >
					<div align="center"><strong><span class="style1"><font color='red'><b>UserName</b></font></span></strong></div>
				</td>
			
				<td >
					<div align="center"><strong><span class="style1"><font color='red'><b>ChilliSpot-MAC-Allowed</b></font></span></strong></div>
				</td>
<td></td>
			</tr>
		
			
			<?
if($_REQUEST['del']!=""){
mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM radusergroup WHERE username ='".$_REQUEST['del']."'");
mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM account WHERE username ='".$_REQUEST['del']."'");
mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM radcheck  WHERE username ='".$_REQUEST['del']."'");

	}

			$sql = "SELECT * FROM radcheck,account WHERE radcheck.attribute ='Auth-Type' and account.username=radcheck.username ORDER BY radcheck.username"; 
			$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					$count = 1;
			while($request = mysqli_fetch_object($result)) { 
				($count % 2 == 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
$result_group = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT  * FROM radusergroup WHERE username='$request->username'");
$array_group = mysqli_fetch_array($result_group);
			?>
	
					<tr bgcolor="<?=$bgcolor?>">

					
						<td width="26%" >
							<?=$request->firstname?>
						</td>
							<td width="26%" >
							<div align="center"><?=$request->username?>	</div>
						</td>	
							   
					   <td>
        <a href="index2.php?option=users_vip&Idedit=<?=$request->username?>&group=<?=$array_group[groupname]?>"><img src="images/configure.png" alt="แก้ไข" /></a>
   
        <a href="index2.php?option=manage_vip&del=<?=$request->username?>"><img src="images/delete.png" alt="ลบ" onclick="return confirm ( ' ยืนยันลบ ' ) "/></a> 
		</td>
						</tr>
				

				<?}?>		</tbody>
					</table>
</body>
</html>
