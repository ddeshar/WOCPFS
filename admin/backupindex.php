<?
if($filebackup!=""){

chmod('backup/'.$filebackup,0777);

@unlink('backup/'.$filebackup) or die("Database backup finished");

}
?><BR><BR><BR><BR>
<table width="80%" align=center cellSpacing=3 cellPadding=2 border=0 >
<tr>
<!--<td align="center"><a href="index2.php?option=restore"><img src="images/data.png" border="0"><br>Restore</a></td>-->
<td align="center"><a href="index2.php?option=backupdb"><img src="images/data.png" border="0"><br>Backup</a></td>
</tr>
</table>
