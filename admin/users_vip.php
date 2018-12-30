<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
	#####################################################*/

	# ถ้าไม่ได้ผ่านการล็อกอินเข้ามาให้ย้อนกลับไปหน้าล็อกอินใหม่!
	if(!isset($_SESSION['logined'])) {
		?><meta http-equiv="refresh" content="0;url=index.php"><?
	}

	$group = $_REQUEST['group'];
	$cclmac = $_POST['cclmac'];
	$users = $_POST['users'];
	$Idedit= $_REQUEST['Idedit'];

	if($cclmac!=""){	
		if($Idedit!=""){
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `radcheck` SET `username` = '$cclmac' WHERE username ='$Idedit'");
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE account SET username = '$cclmac',firstname= '$users' WHERE username ='$Idedit'");

			$sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT* FROM`radusergroup` WHERE username ='$Idedit'");
			$num=mysqli_num_rows($sql);

			if($num<0){
				mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `radusergroup` (`username` , `groupname` , `priority` ) VALUES ( '$cclmac','$group','1');");
			}else{
				mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `radusergroup` SET `username`='$cclmac', `groupname`='$group' WHERE username ='$Idedit'");
			}

		}else{
			$sql = "SELECT max(id) as id FROM radcheck"; 
			$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$request = mysqli_fetch_array($result);
			$num=$request[id];
			$num=$num+1;
			//mysql_query("INSERT INTO `radusergroup`  (`username` ,`groupname` ,`priority`) values ('$cclmac','$group','1');");
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `radusergroup` (`username` , `groupname` , `priority` ) VALUES ( '$cclmac','$group','1');");

			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `radcheck` ( `id` , `username` , `attribute` , `op` , `value` ) VALUES ('$num' , '$cclmac', 'Auth-Type', ':=', 'Accept');");

			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `account`(`username`, `password`, `firstname`, `lastname`, `mailaddr`, `dateregis`, `encryption`, `status`) VALUES ('$cclmac', '', '$users', '', '' , NOW() ,  '', '1');");
		}
		echo "<META http-equiv='refresh' CONTENT='0; URL=index2.php?option=manage_vip'>";	
	}

	if($Idedit!=""){
		$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT  * FROM radcheck,account WHERE account.username=radcheck.username and radcheck.username='$Idedit'");
		$array = mysqli_fetch_array($result);
	}
?>
	<div class="app-title">
		<div>
			<h1><i class="fa fa-user-secret"></i> Vip Users</h1>
			<p>Add Users VIP Allowed Mac Address</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item"><a href="index2.php?option=users_vip"> Vip Users</a></li>
		</ul>
	</div>

	<script>
		function validator3(lang){
			if(document.frm2.users.value==""){ if (lang=="e") { alert("Please "); } else { alert("กรุณาระบุ ชื่อ - นามสกุล"); }document.frm2.users.focus();return false;}
			if(document.frm2.cclmac.value==""){ if (lang=="e") { alert("Please "); } else { alert("กรุณาระบุ MAC-Allowed"); }document.frm2.cclmac.focus();return false;}
		}
	</script>

	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<form id="form1" method="post" action="index2.php?option=users_vip"onSubmit="return validator3('t')">
					<div class="tile-title-w-btn">
						<div class="btn-group">
							<button class="btn btn-primary" type="submit" name="submit" id="btnsave"><i class="fa fa-fw fa-lg fa-check-circle"></i>submit</button>
						</div>
					</div>
					
					<div class="tile-body row">

						<?php 
							$sql = "SELECT * FROM groups";
							$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
							$num = mysqli_num_rows($result);
							
							if(!isset($_REQUEST['group'])) { 
								$dataGroup = "Please Select Group";
							} else {
								$sql = "SELECT * FROM groups WHERE gname = '".$_REQUEST['group']."'";
								$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
								$data2 = mysqli_fetch_object($result2);
								$dataGroup = "Group " . $data2->gdesc ;
							} 
						?>
						<?// if($error1) { echo "&laquo; เลือกกลุ่มด้วยครับ"; } ?> 

						<div class="form-group col-md-3" onClick="showhide(1);event.cancelBubble=1">
							<div class="widget-small <?php if($error1) { echo "danger"; }else{ echo "primary"; } ?> "><i class="icon fa fa-users fa-3x"></i>
								<div class="info">
								<h4>User Group :</h4>
								<p><b><?=$dataGroup ?></b></p>
								</div>
							</div>
							<div onmouseover="showhide(2);" onmouseout="showhide(0)" id="innermenu" style="position:absolute; background-color:white; visibility:hidden; x-index: -1;">
								<script>
									function gl(linkname,dest){
										document.write('<a class="dropdown-item" href="'+dest+'">'+linkname+'</a>')
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
									<?php while($groups = mysqli_fetch_object($result)) { ?>
									gl("Group <?= $groups->gdesc ?>","index2.php?option=users_vip&group=<?= $groups->gname ?>&username=<?= $username ?>&numadd=<?= $numadd ?>&Idedit=<?= $Idedit ?>")
									<?php } ?>

									//Extend this list as needed
									document.onclick=function(){showhide(0)}
									
								</script>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label class="control-label">First and last Name</label>
							<input name="Idedit" type="hidden"  value="<?= $Idedit?>">
							<input name="group" type="hidden"  value="<?= $group?>">
							<input name="users" type="text" class="form-control" id="users" value="<?= $array[firstname]?>">
						</div>
						<div class="form-group col-md-3">
							<label class="control-label">VIP-MAC-Allowed</label>
							<input type="text" name="cclmac" id="MACADDRESS" class="form-control" maxlength="17" value="<?= $array[username] ?>">
							<div class="form-control-feedback">*Format 00-1A-92-D0-61-2E</div>
						</div>

					</div>

				</form>
			</div>
		</div>
	</div>