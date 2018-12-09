<?php
	// print_r($_REQUEST);
	$newup = $newdown = 0;
	$newexpire = "0000-00-00";
	
//	$_POST["user"]$_POST['group']
?>				
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Burapha Linux Laboratory" />
	<meta name="keywords" content="authentication system" />
	<meta name="description" content="Burapha Linux Authentication Project" />	
    <link href="css/main.css" type=text/css rel=stylesheet>
	<title>-:- Authent!cation -:-</title>
</head>
<body>
<div id="content" style="display:inline-block;">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="10"  class="header">
  <tr>
    <td width="6%" align="center"><img src="images/user.png" alt="" width="48" height="48" /></td>
    <td width="46%"><a href="index2.php?option=print_user">User Manager</a><br />
<span class="normal">พิมพ์บัตรผู้ใช้งานระบบ</span></td>
    <td width="48%" align="right" valign="bottom">
      <? $sql = "select * from groups";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$num = mysqli_num_rows($result);
	?>
    
		<span class="normal">        <? if(!isset($_GET["group"])) { ?>
        กรุณาเลือกกลุ่ม
        <? } else { ?>
        <? 
			$sql = "select * from groups where gname = '".$_GET["group"]."'";
			$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$data2 = mysqli_fetch_object($result2);
			echo  "กลุ่ม" .   $data2->gdesc . "";
		?>
        <? } ?>
&nbsp;</span><img src="images/b_ar.gif" align="absbottom"  onClick="showhide(1);event.cancelBubble=1" style="cursor:hand" />
		<div onmouseover="showhide(2);" onmouseout="showhide(0)" id="innermenu" style="position:absolute; width:300px; height:<?= $num * 25 ?>px;background-color:white; visibility:hidden; text-align:left; border: 1px #ddd dashed; padding: 10px 10px 10px 10px; font-weight: normal" class="normal">
        <script language="JavaScript1.2">
		
		
		function gl(linkname,dest){
		document.write('<li><a href="'+dest+'">'+linkname+'</a></li>')
		}
		
		function showhide(state){
		var cacheobj=document.getElementById("innermenu").style
		if (state==0)
		cacheobj.visibility="hidden"
		else if(state==2) 
		cacheobj.visibility="visible"
		else
		cacheobj.visibility=cacheobj.visibility=="hidden"? "visible" : "hidden"
		}
		
		//Specify your links here- gl(Item text, Item URL)
		<? while($groups = mysqli_fetch_object($result)) { ?>
		gl("กลุ่ม<?= $groups->gdesc ?>","index2.php?option=print_user&group=<?= $groups->gname ?>")
		<? } ?>

		//Extend this list as needed
		
		
		document.onclick=function(){showhide(0)}
		
</script>
</div>
    </td>
  </tr>
</table>



<script type="text/javascript">
function autoChecked(frmObj,chkObj){
	for(i=0; i<frmObj.length; i++){
		if(chkObj.checked)
			frmObj[i].checked=true;
		else
			frmObj[i].checked=false;
	}
}
function isChecked(frmObj){
var _return = false;
	for(i=0; i<frmObj.length; i++){
		if(frmObj[i].checked)
		_return = true;
	}
	return _return;
}

function confirm2Move(frmObj){
	if(!isChecked(frmObj)){
		alert("กรุณาเลือกผู้ใช้งาน!");
		return false;
	}else if(frmObj.group.options[frmObj.group.selectedIndex].value == ""){
		alert("กรุณาเลือก!");
		return false;
	}
}
</script>
<form id="myfrm" name="myfrm" method="post" action="ThaiPDF/exportPDF-user.php"  target="_blank" onsubmit="return confirm2Move(this);">
<input type="hidden" id="group" name="group" value="<?=$_REQUEST['group']?>" />
  <table width="95%" border="0" align="center" cellspacing="1" class="admintable">
    <tr>
      <td height="35" colspan="3" align="left"><? if(isset($_REQUEST['group'])) { ?>   จำนวนสมาชิกในกลุ่ม<?= $data2->gdesc ?> มีทั้งสิ้น <b class="red">
      <? $sql = "select * from radusergroup  where GroupName = '".$_REQUEST['group']."'";
	     echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql)); ?>
    </b>  คน<? } ?></td>
      <td height="35" colspan="3" align="right"> <?php 
	if(isset($message)) {  ?><?= $message  ?><? } 
?></td>
      </tr>

  <?if($_GET["group"]!=""){?> 
   	  <tr>
      <td height="35" colspan="5" align="center">
      <input type="radio" name="piccard" id="piccard" value="001.png"  /><img src="ThaiPDF/001.png" width="130" height="72" /> 
      <input type="radio" name="piccard" id="piccard" value="002.png" /><img src="ThaiPDF/002.png" width="130" height="72" /> 
      <input type="radio" name="piccard" id="piccard" value="003.png"/><img src="ThaiPDF/003.png" width="130" height="72" />&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <input type="radio" name="piccard" id="piccard" value="004.png" /><img src="ThaiPDF/004.png" width="130" height="72" /> 
      <input type="radio" name="piccard" id="piccard" value="005.png"/><img src="ThaiPDF/005.png" width="130" height="72" /> 
      <input type="radio" name="piccard" id="piccard" value="006.png" /><img src="ThaiPDF/006.png" width="130" height="72" />&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <input type="radio" name="piccard" id="piccard" value="007.png"  /><img src="ThaiPDF/007.png" width="130" height="72" /> 
      <input type="radio" name="piccard" id="piccard" value="008.png" /><img src="ThaiPDF/008.png" width="130" height="72" /> 
      <input type="radio" name="piccard" id="piccard" value="009.png" /><img src="ThaiPDF/009.png" width="130" height="72" />&nbsp;&nbsp;&nbsp;&nbsp;<br><br></td>
    </tr>
	<?}?>
	<tr>
      <td width="68" align="center" class="key">ลำดับที่</td>
      <td width="300" align="center" class="key">ชื่อ - นามสกุล</td>
      <td width="247" align="center" class="key">ชื่อผู้ใช้งาน</td>

      <td width="25" align="center" class="key"><input type="checkbox" onclick="javascript:autoChecked(this.form,this);"></td>
    </tr>


    <?		
		$page = (isset($_GET['page']))? intval($_GET['page']) : 1;
		$limit = 50;
		$start = ($page-1)*$limit;
		$send = "option=" . $_GET['option'] . "&group=" . $_GET['group'];
		$sql = "select * from radusergroup , account where radusergroup .GroupName = '".$_GET["group"]."' and radusergroup .UserName = account.username and account.status != '-1' order by account.username"; 
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql . " limit " . $start. "," . $limit) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$count = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
		//echo $sql;
		$i=$i+$start;$a=0;
		while($users = mysqli_fetch_object($result)) { 
			$i++;
			($i % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
					echo"<input id=\"firstname[$a]\" name=\"firstname[$a]\" type=\"hidden\" value=\"$users->firstname\" />";
					echo"<input id=\"password[$a]\"name=\"password[$a]\" type=\"hidden\" value=\"$users->password\" />";
					echo"<input id=\"username[$a]\"name=\"username[$a]\" type=\"hidden\" value=\"$users->username\" />"; 


		?>
    <tr>
      <td width="68" align="center" valign="top" bgcolor="<?= $bgcolor ?>"><?= $i ?></td>
      <td width="364" align="left" valign="top" bgcolor="<?= $bgcolor ?>">&nbsp;
          <?= $users->firstname ?>
          <?//= $users->lastname ?>     </td>
      <td align="left" valign="top" bgcolor="<?= $bgcolor ?>">
         &nbsp; <?= $users->username ?> : <?= $users->password ?> 
             </td>
 
      
      <td align="center" valign="top" bgcolor="<?= $bgcolor ?>"><input type="checkbox" id="user[]" name="user[]" value="<?= $users->username?>" /></td>
    </tr>
    <? $a++;} 			($count % 2 == 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";
 ?>

  </table>
    <input name="last" type="hidden" value="<?= $start + $count ?>" />
  <input name="prefix" type="hidden" value="<?= $username ?>" />
  <input name="group" type="hidden" value="<?= $group ?>" />
  <input name="numadd" type="hidden" value="<?=$count?>" />
<?
	if(isset($_GET["group"])){
	echo "<div style=\"width:95%;\">";
	echo "<div id=\"pagination\"><ol>" . pagination($page, $limit, $count, $send) . "</ol></div>";
	echo "<div style=\"float:right;display:inline-block;padding-top:2px;\">";
	echo " <input type=\"submit\" value=\"พิมพ์\" class=\"button\" /> ";
	echo "</div>";
	echo "</div>";
	}

?>
</form>
</div>
</body>
</html>
