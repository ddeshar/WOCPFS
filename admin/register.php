<?php
  include("include/class.testlogin.php");

	$message = "";
	$username = $firstname = $lastname = $mailaddr = $password = $password2 = "";
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
	}
	$error = array();
	for($i = 0; $i < 20; $i++) {
		$error[$i] = false;
	}
	if(isset($button)) {
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
			$sql = "SELECT * FROM account WHERE username = '$username'";
			// echo $sql;
			$link->query($sql);
			if($link->num_rows() > 0) {
				$error[4] = true;
			}
		
		}
		
		# check password
		if(empty($password)) {
			$error[5] = true;
    }
    
		if(!$error[5]) {
			if(strlen($password) < 4) {
				$error[6] = true;
			}
    }
    
		# check password2
		if(empty($password2)) {
			$error[7] = true;
    }
    
		if(!$error[7]) {
			if(strlen($password2) < 4) {
				$error[8] = true;
			}
		}

		# check password and confirm password
		if(!$error[5] && !$error[6] && !$error[7] && !$error[8]) {
			if($password != $password2) {
				$error[9] = true;
			}
    }
    
		$pass = true;
		for($i = 0; $i <= 9; $i++) {
			if($error[$i]) {
				$pass = false;
			}
    }
    
		if($pass) {
			$sql = "SELECT * FROM configuration WHERE variable = 'default_regis_status'";
			//echo $sql;
			$link->query($sql);
			$conf = $link->getnext();
			//echo $conf->value;
			$sql = "INSERT INTO account VALUES " . "('$username','".$password."'," . "'$firstname','$lastname','$mailaddr'," . "'".date("Y-m-d H:i:s")."','clear','".$conf->value."1')";
			//echo $sql;
			$link->query($sql);
	
			$sql = "INSERT INTO radcheck VALUES (NULL,'$username','Cleartext-Password',':=','".$password."')";
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$sql = "INSERT INTO radusergroup VALUES " . "('$username','".$_REQUEST['selectG']."','1')";
			//echo $sql;
			$link->query($sql);
			if($conf->value) {
				$message ="<div class=\"alert alert-success\"><strong>บันทึกข้อมูลของคุณเรียบร้อยแล้ว </strong>คุณสามารถใช้งานระบบได้ทันทีครับ</div>";
			} else {
				$message ="<div class=\"alert alert-danger\"><strong>บันทึกข้อมูลของคุณเรียบร้อยแล้ว </strong>แต่คุณจะสามารถใช้งานได้ก็ต่อเมื่อได้รับอนุญาตจากผู้ดูแลระบบแล้วเท่านั้น</div>";
			}

	    $username = $firstname = $lastname = $mailaddr = $password = $password2 = "";
		}
		
	}
?>
	<div class="app-title">
		<div>
			<h1><i class="fa fa-user"></i> เพิ่มผู้ใช้รายคน</h1>
			<h1>Add Single User</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item"><a href="index2.php?option=register2">เพิ่มผู้ใช้รายคน</a></li>
		</ul>
	</div>

	<div class="row">

			<div class="col-lg-12">
				<div class="bs-component">
					<?php 
						if(!empty($message)) { echo "<BR>".$message; }
						if(!empty($message)) {  
					?>
							<input name="" type="button" class="btn btn-secondary" value="หน้าแรก" onclick="window.location='?option=register2'" style="cursor:hand" />
					<?php } ?>
				</div>
			</div>

		<?php
			if(empty($message)) {
				if($error[0]) {
					echo "กรุณากรอกชื่อของคุณด้วยครับ";
				} 
		?>
			<div class="col-md-12">
				<div class="tile">
					<!-- <h3 class="tile-title">เพิ่มผู้ใช้รายคน</h3> -->
					<form action="" method="post" name="regis">
						<div class="tile-body">
								<div class="form-group">
									<label for="exampleSelect1">เลือกกลุ่ม</label>
									<select name="selectG" class="form-control <?php if($error[1]) echo "is-invalid"; ?>" id="exampleSelect1">
										<?php
											$sql1 = "SELECT * FROM groups ORDER BY gdesc"; 
											$result1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
											while($group1 = mysqli_fetch_object($result1)) { 
										?>
										<option value="<?=$group1->gname?>"><?=$group1->gdesc?></option>
										<?php } ?>
									</select>
									<small class="form-text text-danger">ระบุกลุ่มให้ถูกต้อง</small>
								</div>

								<div class="form-group">
									<label class="control-label">ชื่อ</label>
									<input name="firstname" type="text" class="form-control <?php if($error[0]) echo "is-invalid"; ?>" id="firstname" value="<?= $firstname ?>" placeholder="นายทองต่อ">
								</div>
								
								
								<div class="form-group">
									<label class="control-label">นามสกุล</label>
									<input name="lastname" type="text" class="form-control <?php if($error[1]) echo "is-invalid"; ?>" id="lastname" value="<?= $lastname ?>" placeholder="ศรีสวัสดิ์">
									<small class="form-text text-danger" ><?php if($error[1]) { echo "กรุณากรอกนามสกุลของคุณด้วยครับ"; } ?></small>
								</div>
								
								<div class="form-group">
									<label class="control-label">อีเมล์</label>
									<input name="mailaddr" type="text" class="form-control <?php if($error[2]) echo "is-invalid"; ?>" id="mailaddr" value="<?= $mailaddr ?>" placeholder="tongtoh@hotmail.com">
									<small class="form-text text-danger"><?php if($error[2]) { echo "กรุณากรอกอีเมล์ของคุณด้วยครับ"; } ?></small>
								</div>
								
								<div class="form-group">
									<label class="control-label">ชื่อผู้ใช้ หรือรหัสเลขประชาชน 13 หลัก</label>
									<input name="username" type="text" class="form-control <?php if($error[3]) echo "is-invalid"; ?>" id="username" value="<?= $username ?>" placeholder="กรอกเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น">
									<small class="form-text text-danger" ><?php if($error[3]) {echo "กรุณากรอกชื่อผู้ใช้ที่คุณต้องการด้วยครับ"; } if($error[4]) {echo "ชื่อผู้ใช้ที่คุณต้องการมีผู้อื่นใช้แล้ว กรุณากรอกใหม่ด้วยครับ"; } ?></small>
								</div>
								
								<div class="form-group">
									<label class="control-label">รหัสผ่าน</label>
									<input name="password" type="password" class="form-control <?php if($error[5] || $error[6] || $error[9]) echo "is-invalid"; ?>" id="password" value="<?= $password ?>" placeholder="xxxx">
									<small class="form-text text-info">ความยาวอย่างน้อย 4 อักขระ</small>
									<small class="form-text text-danger"><?php if($error[5]) { echo "กรุณากรอกรหัสผ่านด้วยครับ"; } if($error[6]) { echo "ความยาวของรหัสผ่านต้องยาวอย่างน้อย 4 อักขระครับ"; } ?></small>
								</div>
								
								<div class="form-group">
									<label class="control-label">ยืนยันรหัสผ่าน</label>
									<input name="password2" type="password" class="form-control <?php if($error[7] || $error[8] || $error[9]) echo "is-invalid"; ?>" id="password2" value="<?= $password2 ?>" placeholder="xxxx">
									<small class="form-text text-danger" ><?php if($error[7]) { echo "กรุณายืนยันรหัสผ่านด้วยครับ"; } if($error[8]) { echo "ความยาวของรหัสผ่านต้องยาวอย่างน้อย 4 อักขระครับ"; } if($error[9]) { echo "รหัสผ่านทั้งสองไม่ตรงกัน"; } ?></small>
								</div>

						</div>
						<div class="tile-footer">
							<button class="btn btn-primary" type="submit" name="button" id="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึกข้อมูล</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php } ?>
	</div>