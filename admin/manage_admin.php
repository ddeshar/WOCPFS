<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

include("include/class.testlogin.php");
?>
<?php
	$message = "";
	foreach($_REQUEST as $key => $value) {
		$$key = $value;
	}
	if(isset($_REQUEST['submit'])) { 
		if(!empty($_REQUEST['pass1'])) {
			$sql = "SELECT * FROM administrator WHERE username = '".$_SESSION['username']."' AND password = '".md5($_REQUEST['pass1'])."'";
			if(mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql))) {
				if(!empty($_REQUEST['pass2'])) {
					if(!empty($_REQUEST['pass3'])) {
						if($_REQUEST['pass3'] == $_REQUEST['pass2']) {
							$sql = "UPDATE administrator SET password = '".md5($pass2)."' WHERE username = '".$_SESSION['username']."'";
							mysqli_query($GLOBALS["___mysqli_ston"], $sql);
							$message = "<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">
														<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
															<span aria-hidden=\"true\">&times;</span>
														</button>
														ระบบได้บันทึกรหัสผ่านใหม่ของคุณเรียบร้อยแล้ว
													</div>";
							$pass1 = $pass2 = $pass3 = "";
						} else {
							$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
														<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
															<span aria-hidden=\"true\">&times;</span>
														</button>
														<strong>รหัสผ่านใหมไม่ตรงกัน!</strong> กรุณากรอกรหัสผ่านใหม่
													</div>";
							$pass2 = "";
							$pass3 = "";
						}
					} else {
						$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
													<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
														<span aria-hidden=\"true\">&times;</span>
													</button>
													<strong>กรุณา!</strong> ยืนยันรหัสผ่านใหม่ด้วย
												</div>";
					}
				} else {
					$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
												<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
													<span aria-hidden=\"true\">&times;</span>
												</button>
												<strong>กรุณา!</strong> กรอกรหัสผ่านใหม่ด้วย
											</div>";
				}
			} else {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
											<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
												<span aria-hidden=\"true\">&times;</span>
											</button>
											รหัสผ่านเก่าของคุณไม่ถูกต้อง
										</div>";
				$pass1 = "";
			}
		} else {
			$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
										<span aria-hidden=\"true\">&times;</span>
									</button>
									<strong>กรุณา!</strong> กรอกรหัสผ่านเก่าด้วย
								</div>";
		}
	}
?>
<div class="col-md-12">
<?php if(isset($message)) { echo $message; } ?>
	<div class="tile">
		<h3 class="tile-title">เปลี่ยนรหัสผ่านของผู้ดูแลระบบ</h3>
		<form id="form1" method="post" action="">
			<div class="tile-body">
					<div class="form-group">
						<label class="control-label">รหัสผ่านเดิม</label>
						<input name="pass1" type="password" class="form-control" id="pass1" value="<?= $pass1 ?>" />
					</div>
					<div class="form-group">
						<label class="control-label">รหัสผ่านใหม่</label>
						<input name="pass2" type="password" class="form-control" id="pass2" value="<?= $pass2 ?>"/>
					</div>
					<div class="form-group">
						<label class="control-label">ยืนยันรหัสผ่านใหม่</label>
						<input name="pass3" type="password" class="form-control" id="pass3" value="<?= $pass3 ?>"/>
					</div>
			</div>
			<div class="tile-footer">
				<input name="submit" type="submit" class="btn btn-primary" id="submit" value="บันทึก" />
			</div>
		</form>
	</div>
</div>