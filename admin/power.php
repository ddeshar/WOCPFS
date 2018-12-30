<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

	include("include/class.testlogin.php");
	$message1 = "<h4>Shutdown</h4>";
	$message2 = "<h4>Reboot</h4>";
	if(isset($_REQUEST['action'])) { 
		switch($_REQUEST['action']) {
			case 'shutdown' :
				$actions1 = "<input name=\"action\" type=\"button\" class=\"btn btn-danger mr-2 mb-2\" id=\"button\" value=\"Yes\" onclick=\"window.location='index2.php?option=power&action=down'\"/>";
				$actions2 = "<input name=\"action\" type=\"button\" class=\"btn btn-warning mr-2 mb-2\" id=\"button\" value=\"No\" onclick=\"window.location='index2.php?option=power'\"/>";
				$message1 = "<h4 class=\"text-danger\">Do you want to shut down the system...?</h4>";
				$alertS = "danger";
				break;
			case 'reboot' :
				$actionr1 = "<input name=\"action\" type=\"button\" class=\"btn btn-danger mr-2 mb-2\" id=\"button\" value=\"Yes\" onclick=\"window.location='index2.php?option=power&action=restart'\"/>";
				$actionr2 = "<input name=\"action\" type=\"button\" class=\"btn btn-warning mr-2 mb-2\" id=\"button\" value=\"No\" onclick=\"window.location='index2.php?option=power'\"/>";
				$message2 = "<h4 class=\"text-danger\">Do you want to restart the system...?</h4>";
				$alertR = "danger";
				break;
			case 'down' :
				$message1 = "<h4 class=\"text-danger\">Shutting down the system...</h4>";
				$alertS = "danger";
 				#exec("sudo shutdown -h now");
				shell_exec("sudo /sbin/shutdown -h now");
				break;
			case 'restart' :
				$message2 = "<h4 class=\"text-danger\">System restarting...</h4>";
				$alertR = "danger";
				#exec("sudo shutdown -r now");
				shell_exec("sudo /sbin/shutdown -r now");
				break;
		}
	}
?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-cog"></i> Shutdown &amp; Reboot</h1>
        <p>Shutdown &amp; Reboot</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-cogs fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=power"> Shutdown &amp; Reboot</a></li>
    </ul>
</div>

<form class="row" action="index2.php?option=power" method="post" id="powerform" name="powerform">
	
	<div class="col-md-6 col-lg-3">
		<div class="widget-small <?php if(isset($alertS)) { echo $alertS; }else{ echo "primary";} ?> coloured-icon"><i class="icon fa fa-terminal fa-3x"></i>
			<div class="info">
				<a href="index2.php?option=power&amp;action=shutdown" style="text-decoration : none;"><?php if(isset($message1)) { echo $message1; } ?></a>
			</div>
		</div>
		<p class="mt-4 mb-4">
			<?php 
				if(isset($actions1)) { echo $actions1; }
				if(isset($actions2)) { echo $actions2; } 
			?>
		</p>
	</div>

	<div class="col-md-6 col-lg-3">
		<div class="widget-small <?php if(isset($alertR)) { echo $alertR; }else{ echo "primary";} ?> coloured-icon"><i class="icon fa fa-terminal fa-3x"></i>
			<div class="info">
				<a href="index2.php?option=power&amp;action=reboot" style="text-decoration : none;"><?php if(isset($message2)) { echo $message2; } ?></a>
			</div>
		</div>
		<p class="mt-4 mb-4">
			<?php 
				if(isset($actionr1)) { echo $actionr1; }
				if(isset($actionr2)) { echo $actionr2; } 
			?>
		</p>
	</div>

</form>