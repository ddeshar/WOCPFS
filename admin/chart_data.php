<?php
	include("include/class.mysqldb.php"); 
	include("include/config.inc.php");
?>
&title=&
&x_axis_steps=1&
&x_axis_3d=12&
&y_legend=&
&y_ticks=5,10,5&
&bg_colour=#FFFFFF&
&x_labels=มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม&
&x_axis_colour=#909090&
&x_grid_colour=#ADB5C7&
&y_axis_colour=#909090&
&y_grid_colour=#ADB5C7&
&line_dot=3,#c40000,,10,5&
&y_min=0&
&y_max=
<?
	$sql = "SELECT * FROM radacct WHERE AcctStartTime";
	if(round(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql)),-2) > 100) {
		echo round(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql)),-2) . "&";
	} else {
		echo "100&";
	}
?>
&values=
<? 
	for($i = 1; $i <= 12; $i++) {
		$month = sprintf("%02d", $i);
		$sql = "SELECT * FROM radacct WHERE AcctStartTime LIKE '".date("Y")."-".$month."-%'";
		if($i < 12) {
			echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql)) . ",";
		} else {
			echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql)) . "&";
		}
	}
?>