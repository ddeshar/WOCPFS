<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

	include("include/class.testlogin.php");
	// print_r($_REQUEST);
	$newup = $newdown = 0;
	$newexpire = "0000-00-00";
	if(isset($_REQUEST['action'])) { 
		$sql = "SELECT * FROM groups WHERE gid = '".$_REQUEST['gid']."'"; 
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$group = mysqli_fetch_object($result);

		switch($_REQUEST['action']) {
			case 'lock' : 
				$sql = "UPDATE account SET status = '0' WHERE username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$message = "<font color=green>ล็อกผู้ใช้ที่ต้องการเรียบร้อยแล้ว</font>";
				break;
			case 'unlock' : 
				$sql = "UPDATE account SET status = '1' WHERE username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$message = "<font color=green>ปลดล็อกผู้ใช้ที่ต้องการเรียบร้อยแล้ว</font>";
				break;

			case 'delete' : 
					
				$sql = "DELETE FROM radcheck WHERE username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "DELETE FROM radusergroup  WHERE username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "DELETE FROM account WHERE username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql = "UPDATE account SET status = '-1' WHERE username = '".$_REQUEST['user']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$message = "<font color=green>ลบผู้ใช้ที่ต้องการออกจากระบบเรียบร้อยแล้ว</font>";
				break;
			case 'move' :
				if($_POST["group"]=="del"){
					foreach($_POST["user"] as $username){
						$sql = "DELETE FROM radcheck WHERE username = '".$username."'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$sql = "DELETE FROM radusergroup  WHERE username = '".$username."'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$sql = "DELETE FROM account WHERE username = '".$username."'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$sql = "UPDATE account SET status = '-1' WHERE username = '".$username."'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
					
					$message = "<font color=green>ลบข้อมูลเรียบร้อยแล้ว</font>";

				}else{
					if(isset($_GET["user"])){
						$sql = "UPDATE radusergroup  SET groupname = '".$_GET["group"]."' WHERE username = '".$_REQUEST['user']."'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}else{
						foreach($_POST["user"] as $username){
							$sql = "UPDATE radusergroup  SET groupname = '".$_POST['group']."' WHERE username = '".$username."'";
							mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						}
					}
					
					$message = "<font color=green>ย้ายกลุ่มเรียบร้อยแล้ว</font>";

				}
				// echo $sql;
				break;
			case 'edit' :
				break;
			case 'success' :
				$message = "<font color=green>บันทึกข้อมูลการแก้ไขเรียบร้อยแล้ว</font>";
				break;
			case 'saveadd' :
				$error = 0;
				$newup = $_REQUEST['newgroupupload'];
				$newdown = $_REQUEST['newgroupdownload'];
				$newexpire = $_REQUEST['newgroupexpire'];
				if(trim($_REQUEST['newgroupdesc']) == '') {
					$error = 1;
					$message = "<span class=\"alert\">กรุณากรอกชื่อกลุ่มด้วย</span>";
				} else {
					$sql = "SELECT * FROM groups WHERE gdesc = '".trim($_REQUEST['newgroupdesc'])."'";
					if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))) {
						$message = "<span class=\"alert\">ชื่อกลุ่ม '".trim($_REQUEST['newgroupdesc'])."' ซ้ำ กรุณาเปลี่ยนชื่อกลุ่มใหม่</span>";
						$error = 1;
					} else {
						if($newdown != 0) {
							// $down = $newdown * 1024 * 8;
							$down = $newdown * 1024;
							$sql = "INSERT INTO radgroupreply VALUES (NULL, 'group".$_REQUEST['newgname']."', 'WISPr-Bandwidth-Max-Down', ':=', '$down')";
							mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						}
						if($newup != 0) {
							// $upload = $newup * 1024 * 8;
							$upload = $newup * 1024;
							$sql = "INSERT INTO radgroupreply VALUES (NULL, group'".$_REQUEST['newgname']."', 'WISPr-Bandwidth-Max-Up', ':=', '$upload')";
							mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						}
						$sql = "INSERT INTO groups VALUES(NULL,'group".$_REQUEST['newgname']."','".$_REQUEST['newgroupdesc']."', '$newup', '$newdown', '0', '$newexpire', 'clear', '1')";
						// echo $sql;
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						
							$message = "<font color=green>บันทึกข้อมูลกลุ่มใหม่เรียบร้อยแล้ว</font>";
						}
				}
				break;
		}
	}
	
	$sql = "SELECT * FROM groups";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$num = mysqli_num_rows($result);

		if(!isset($_GET["group"])) { 
			$selectgroup = "Select Group";
		} else { 				
			$sql = "SELECT * FROM groups WHERE gname = '".$_GET["group"]."'";
			$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$data2 = mysqli_fetch_object($result2);
			$selectgroup = "Group " .   $data2->gdesc . "";
		} 
?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-user-times"></i> จัดการข้อมูลผู้ใช้งานระบบ</h1>
        <p>	User Manager</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=manage_user">จัดการข้อมูลผู้ใช้งานระบบ</a></li>
    </ul>
</div>

	<div class="row">
		<div class="col-md-12">
			<div class="tile">

			<a class="nav-link dropdown-toggle btn-primary" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-plus"></i> <?=$selectgroup?></a>
				<div class="dropdown-menu">
					<?php while($groups = mysqli_fetch_object($result)) { ?>
						<a class="dropdown-item" href="index2.php?option=manage_user&group=<?= $groups->gname ?>">Group <?= $groups->gdesc ?></a>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>
	<?php 
		if(isset($_REQUEST['action']) && ($_REQUEST['action'] == "edit" || $_REQUEST['action'] == "save" )) { 
			$message = "กรุณากรอกข้อมูลในช่องที่ท่านต้องการแก้ไขแล้วคลิกบันทึก<BR>";
			$sql = "SELECT * FROM account where username = '".$_REQUEST['user']."'";
			//echo $sql;
			$link->query($sql);
			$users = $link->getnext();

			foreach($_REQUEST as $key => $value) {
				$$key = $value;
				//echo $key . " => " . $value . "<BR>";
			}
			if($_REQUEST['action'] == "save") {
				$error = array();
				for($i = 0; $i < 20; $i++) {
					$error[$i] = false;
				}
				# check firstname
				if(empty($firstname)) {
					$error[0] = true;
				} 
				# check lastname
				if(empty($lastname)) {
					$error[1] = true;
				}
				# check mailaddr
				if(empty($mailaddr)) {
					$error[2] = true;
				}
				# check username
				if(empty($username)) {
					$error[3] = true;
				}
				
				if(!$error[3]) {
					# check username duplicate
					if($user != $username) {
						$sql = "SELECT * FROM account WHERE username = '$username'";
						// echo $sql;
						$link->query($sql);
						if($link->num_rows() > 0) {
							$error[4] = true;
						}
					}
				}
				
				# check password

				# check password and confirm password
					if($password != $password2) {
						$error[9] = true;
					}
				$pass = true;
				for($i = 0; $i <= 9; $i++) {
					if($error[$i]) {
						$pass = false;
					}
				}
				if($pass) {
					if(!empty($password)) {
						switch($users->encryption) {
							case 'md5' : $newpass = substr(md5($password),0,15); break;
							case 'crypt' : $newpass = crypt($password,"BL"); break;
							default : $newpass = $password; break;
						}
						$sql = "UPDATE account SET username = '$username', password = '$newpass', firstname = '$firstname', lastname = '$lastname', mailaddr = '$mailaddr' WHERE username = '$users->username'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$sql = "UPDATE radcheck SET username = '$username', Value = '$newpass' WHERE username = '$users->username'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					} else {
						$sql = "UPDATE account SET username = '$username', firstname = '$firstname', lastname = '$lastname', mailaddr = '$mailaddr' WHERE username = '$users->username'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$sql = "UPDATE radcheck SET username = '$username' WHERE username = '$users->username'";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					}
					$sql = "UPDATE radusergroup  SET username = '$username' WHERE username = '$users->username'";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					$sql = "UPDATE radacct SET username = '$username' WHERE username = '$users->username'";
					mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					echo "<script>window.location='index2.php?option=manage_user&action=success&group=".$_REQUEST['group']."';</script>";
				}
			} else {
				$firstname = $users->firstname;
				$lastname = $users->lastname;
				$mailaddr = $users->mailaddr;
				$username = $users->username;
			}
	?>

		<div class="row">
			<div class="col-md-12">
				<div class="tile">

						<form action="" method="post" id="groupform" name="groupform">
							<div class="bs-component">
								<div class="alert alert-info" align="center"><h6><?php if(!empty($message)) { echo $message; }?></h6></div>
							</div>

							<div class="tile-body">
								<div class="form-group">
									<label class="control-label">Name</label>
									<input name="firstname" type="text" class="form-control <?php if($error[0]) echo "is-invalid"; ?>" id="firstname" value="<?= $firstname ?>">
									<input name="action" type="hidden" id="action" value="save" />
									<small class="form-text text-danger"><?php if($error[0]) { echo "กรุณากรอกชื่อของคุณด้วยครับ"; } ?></small>
								</div>

								<div class="form-group">
									<label class="control-label">นามสกุล </label>
									<input name="lastname" type="text" class="form-control <?php if($error[1]) echo "is-invalid"; ?>" id="lastname" value="<?= $lastname ?>">
									<small class="form-text text-danger"><?php if($error[1]) { echo "กรุณากรอกนามสกุลของคุณด้วยครับ";}?></small>
								</div>

								<div class="form-group">
									<label class="control-label">อีเมล์</label>
									<input name="mailaddr" type="text" class="form-control <?php if($error[2]) echo "is-invalid"; ?>" id="mailaddr" value="<?= $mailaddr ?>">
									<small class="form-text text-danger"><?php if($error[2]) {echo "กรุณากรอกอีเมล์ของคุณด้วยครับ";}?></small>
								</div>

								<div class="form-group">
									<label class="control-label">username "กรอกเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น"</label>
									<input name="username" type="text" class="form-control <?php if($error[3] || $error[4]) echo "is-invalid"; ?>" id="username" value="<?= $username ?>">
									<small class="form-text text-danger"><?php if($error[3]) {echo "กรุณากรอกชื่อผู้ใช้ที่คุณต้องการด้วยครับ";} if($error[4]) {echo "ชื่อผู้ใช้ที่คุณต้องการมีผู้อื่นใช้แล้ว กรุณากรอกใหม่ด้วยครับ";}?></small>
								</div>

								<div class="form-group">
									<label class="control-label">password "ความยาวอย่างน้อย 5 อักขระ"</label>
									<input name="password" type="password" class="form-control <?php if($error[5] || $error[6] || $error[9]) echo "is-invalid"; ?>" id="password" value="<?= $password ?>">
									<small class="form-text text-info"><?php if($error[5]) {echo "กรุณากรอกรหัสผ่านด้วยครับ";}if($error[6]) {echo "ความยาวของรหัสผ่านต้องยาวอย่างน้อย 8 อักขระครับ";}?></small>
								</div>

								<div class="form-group">
									<label class="control-label">password</label>
									<input name="password2" type="password" class="form-control <?php if($error[7] || $error[8] || $error[9]) echo "is-invalid"; ?>" id="password2" value="<?= $password2 ?>">
									<small class="form-text text-info"><?php if($error[7]) {echo "กรุณายืนยันรหัสผ่านด้วยครับ";}if($error[8]) {echo "ความยาวของรหัสผ่านต้องยาวอย่างน้อย 5 อักขระครับ";}if($error[9]) {echo "รหัสผ่านทั้งสองไม่ตรงกัน";}?></small>
								</div>
							</div>
							<div class="tile-footer">
								<button class="btn btn-primary" type="submit" name="button" id="button"><i class="fa fa-fw fa-lg fa-floppy-o"></i>Save</button>&nbsp;&nbsp;&nbsp;
								<a class="btn btn-secondary" href="#" name="button2" id="button2" onclick="window.location='index2.php?option=manage_user&group=<?= $_REQUEST['group'] ?>'"><i class="fa fa-fw fa-lg fa-times"></i>Cancel</a>
							</div>
						</form>
				</div>
			</div>
		</div>

	<?php } else { 
		include("_required/js/_manageUser2.js");
	?>

		<form id="myfrm" name="myfrm" method="post" action="?option=manage_user&action=move&group=<?=$_GET["group"]?>" onsubmit="return confirm2Move(this);">

			<?php 
				if(isset($_REQUEST['group'])) { 
					echo "<div class=\"bs-component\"> <div class=\"alert alert-danger\"> จำนวนสมาชิกในกลุ่ม <b class=\"text-danger\">" .$data2->gdesc . " </b> มีทั้งสิ้น ";
					$sql = "SELECT * FROM radusergroup  WHERE groupname = '".$_REQUEST['group']."'";
						echo "<b class=\"text-danger\">".mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))."</b>";
						echo " คน</div> </div>";
				}
				if(isset($message)) {
			?>
				<div class="bs-component">
					<div class="alert alert-dismissible alert-danger">
						<button class="close" type="button" data-dismiss="alert">×</button><?= $message;?> </a>.
					</div>
				</div>

			<?php } ?>

			<div class="row">
				<div class="col-md-12">
					<div class="tile">
						<div class="tile-body">
							<?php
								$send = "option=" . $_GET['option'] . "&group=" . $_GET['group'];
								$sql = "SELECT * FROM radusergroup , account WHERE radusergroup .groupname = '".$_GET["group"]."' and radusergroup .username = account.username and account.status != '-1' order by account.username"; 
								$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
								// $count = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
								if (mysqli_num_rows($result) > 0) {

							?>
  
							<table class="table table-hover table-bordered" id="sampleTable">
								<thead>
									<tr>
										<th><input type="checkbox" onclick="javascript:autoChecked(this.form,this);"></th>
										<th>No</th>
										<th>Name lastname</th>
										<th>Username</th>
										<th>Register date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$counter = 0;
										while($users = mysqli_fetch_object($result)) { 
										$counter++;
									?>
									<tr>
										<td><input type="checkbox" id="user[]" name="user[]" value="<?= $users->username?>" /></td>
										<td><?=$counter?></td>
										<td><?= $users->firstname ?><?= $users->lastname ?></td>
										<td><?= $users->username ?>  <!-- : <?= $users->password ?> --></td>
										<td>
											<?php $date=date_create("$users->dateregis");?>
											<?= date_format($date, 'Y-m-d') ?>
										</td>
										<td>      
											<?php if($users->status) { ?>
											<a href="index2.php?option=manage_user&group=<?= $_GET["group"] ?>&user=<?=$users->username?>&&action=lock"><i class="fa fa-lg fa-unlock"></i></a>
											<?php } else { ?>
											<a href="index2.php?option=manage_user&group=<?= $_GET["group"] ?>&user=<?=$users->username?>&action=unlock"><i class="fa fa-lg fa-lock"></i></a>
											<?php } ?>
										</td>
										<td>
											<div class="btn-group">
												<a class="btn btn-primary" href="index2.php?option=manage_user&group=<?= $_GET["group"] ?>&user=<?=$users->username?>&action=edit"><i class="fa fa-pencil"></i>Edit</a>
												<a class="btn btn-danger" href="index2.php?option=manage_user&group=<?= $_GET["group"] ?>&user=<?=$users->username?>&action=delete"><i class="fa fa-trash"></i>Delete</a>
												<?php 
													$sql = "SELECT * FROM groups";
													$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
													$num = mysqli_num_rows($result2);
												?>

												<a class="nav-link dropdown-toggle btn-warning" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-plus"></i> Move to</a>
													<div class="dropdown-menu">
														<?php while($groups = mysqli_fetch_object($result2)) { ?>
														<a class="dropdown-item" href="index2.php?option=manage_user&action=move&user=<?= $users->username?>&group=<?= $groups->gname ?>">Move to -> <?= $groups->gdesc ?></a>
														<?php } ?>
													</div>

											</div>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>

							<?php } else{ ?>
								<div class="bs-component">
									<div class="alert alert-danger">
										<strong>Sorry!</strong> No data Available Please select Group first.
									</div>
								</div>
							<?php }								
								if(isset($_GET["group"])){
									echo "<div class=\"row\">";
										echo "<div class=\"form-group col-md-3\">";
											echo "<select id=\"group\" name=\"group\" class=\"form-control\">";
											$sql3 = "SELECT * FROM groups";
											$result3 = mysqli_query($GLOBALS["___mysqli_ston"], $sql3);
											echo "<option value=\"\">Manage selected data</option>";
											echo "<option value=\"del\">Delete</option>";
											while($objgroup = mysqli_fetch_object($result3)) {
												echo "<option value=\"" . $objgroup->gname . "\">Move to -> " . $objgroup->gdesc . "</option>";
											}
											echo "</select>";
										echo "</div>";

										echo "<div class=\"form-group col-md-4 align-self-end\">";
											echo " <input type=\"submit\" class=\"btn btn-warning\" value=\"Process\" /> ";
										echo "</div>";
									echo "</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>

		</form>
	<?php }?>