<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
	#####################################################*/

	$message = "";
	$username = $firstname = $lastname = $mailaddr = $password = $password2 = $opassword = "";
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
	}
	$error = array();
	for($i = 0; $i < 20; $i++) {
		$error[$i] = false;
	}
	if(isset($button)) {
		# check firstname
		# check username
		if(empty($username)) {
			$error[3] = true;
		}
		if(empty($opassword)) {
			$error[1] = true;
		}
			
			
		$sql = "SELECT * FROM radacct WHERE radacct.acctstoptime IS NULL AND radacct.username ='$username'";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$totals = mysqli_num_rows($result);
		if($totals==0){
			$error[6] = true;
			echo $totals;
		}	
			
			# check username duplicate
			$sql = "SELECT * FROM account WHERE username = '$username'";
			$link1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$data = mysqli_fetch_object($link1);
			if($data->password != $opassword) {
				$error[4] = true;
			}else $pass = true;
		
			# check password

			# check password2
			# check password and confirm password
	
		$pass = true;
		for($i = 0; $i <= 9; $i++) {
			if($error[$i]) {
				$pass = false;
			}
		}
		if($pass) {
		// $shell_command='sudo /bin/echo "User-Name=x1" | /usr/bin/radclient -x 10.0.101.1:3779 disconnect 	sittichai';
		$shell_command='sudo /bin/ "User-Name='.$username.'" | /usr/local/bin/radclient -x 10.0.101.1:3779 disconnect radius_secret';
		// $shell_command='sudo /bin/echo "User-Name='.$_REQUEST['user'].'" | /usr/bin/radclient -x 10.0.101.1:3779 disconnect 	radius_secret';
		$output = shell_exec($shell_command);
		$updateSQL = sprintf("UPDATE radacct SET acctterminatecause='%s', acctstoptime=NOW() WHERE username='%s' and acctstoptime IS NULL","Admin-Reset", $kill_users->username);
		mysqli_query($GLOBALS["___mysqli_ston"], $updateSQL);
		// echo $output;
		// $sql="DELETE FROM radacct WHERE radacct.AcctStopTime = '0000-00-00 00:00:00' and radacct.UserName ='$username'";
		// $link1 = mysql_query($sql);
		// $data = mysql_fetch_object($link1);
				$message = "เตะของคุณเรียบร้อยแล้ว กรุณากลับไปล็อกอินใหม่";
				$username = $firstname = $lastname = $mailaddr = $opassword = $password2 = "";
		}
	}
?>

<div class="app-title">
	<div>
		<h1><i class="fa fa-user-secret"></i> Kick Users</h1>
		<p>Kick User</p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
		<li class="breadcrumb-item"><a href="index2.php?option=user_kick"> Kick Users</a></li>
	</ul>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">กรุณากรอกข้อมูล</h3>
			<div class="tile-body">
				<form method="post" name="regis">
					<?php
							$messageh ='<div class="bs-component">
							<div class="card mb-3 border-primary">
								<div class="card-body">
									<blockquote class="card-blockquote">';
							$messaged ='</blockquote>
										</div>
									</div>
								</div>';

						if(!empty($message)) { echo $messageh; echo "<p>".$message."</p>"; echo $messaged;} 
						if(!empty($message)) {echo $messageh;
					?>
						<input name="" type="button" class="btn btn-primary" value="ล๊อกอิน" onclick="window.location='http://<?= $_SERVER['SERVER_ADDR'] ?>:3990/logoff'"/>
						<?php echo $messaged; }

					if(empty($message)) {
						$message1 ='<div class="bs-component">
										<div class="card mb-3 border-danger">
											<div class="card-body">
												<blockquote class="card-blockquote">';
						$message2 ='</blockquote>
									</div>
								</div>
							</div>';

						if($error[0]) {
							echo $message1;
							echo "กรุณากรอกชื่อของคุณด้วยครับ";
							echo $message2;

							for($i = 0; $i < 20; $i++) {
								$error[$i] = false;	
							}   
						}
						
						if($error[3]) {
							echo $message1;
							echo "กรุณากรอกชื่อผู้ใช้ที่คุณต้องการด้วยครับ";								
							echo $message2;

							for($i = 0; $i < 20; $i++) {
								$error[$i] = false;
							}
						}
						
						if($error[1]) {
							echo $message1;
							echo "กรุณากรอกรหัสผ่านด้วยครับ";								
							echo $message2;

							for($i = 0; $i < 20; $i++) {
								$error[$i] = false;
							}   
						}
						
						if($error[4]) {
							echo $message1;
							echo "ชื่อหรือรหัสผิดครับ";								
							echo $message2;
							
							for($i = 0; $i < 20; $i++) {
								$error[$i] = false;
							}   
		
							// $username = $opassword ="";
						}
						
						if($error[6]) { 
							echo $message1;
							echo "<strong>ชื่อนี้ไม่ค้างในระบบ ! </strong>";
							echo "ท่านควรกลับไปหน้าล็อกอินใหม่";								
							?>
							<input name="" type="button" class="btn btn-primary" value="ล๊อกอินใหม่" onclick="window.location='http://<?= $_SERVER['SERVER_ADDR'] ?>:3990/logoff'" style="cursor:hand" />
									
							<?php
							echo $message2;

							for($i = 0; $i < 20; $i++) {
								$error[$i] = false;
							}   
				
						} 
					?>

				<div class="row">
					<div class="form-group col-md-3">
						<label class="control-label">ชื่อผู้ใช้</label>
						<input name="username" type="text" class="form-control <?php if($error[3] || $error[4]) { echo "is-invalid"; } ?>" id="username" value="<?= $username ?> ">
						<!-- <input class="form-control" type="text" placeholder="Enter your name"> -->
					</div>
					<div class="form-group col-md-3">
						<label class="control-label">ใช้ชื่อของท่าน รหัสผ่าน</label>
						<!-- <input class="form-control" type="text" placeholder="Enter your email"> -->
						<input name="opassword" type="password" class="form-control <?php if($error[10] || $error[4]) { echo "is-invalid"; } ?>" id="opassword" value="<?= $opassword ?>">
						<?php
							if($error[5]) {
								echo "กรุณากรอกรหัสผ่านด้วยครับ";
								echo "รหัสผ่านของท่าน";
							}
							
							if($error[6]) {
								echo "ความยาวของรหัสผ่านต้องยาวอย่างน้อย 8 อักขระครับ";
							}
							if($error[8]) {
								echo "ความยาวของรหัสผ่านต้องยาวอย่างน้อย 8 อักขระครับ";
							}

							if($error[10]) {
								echo "รหัสผ่านไม่ถูกต้องครับ 55";
							}
						?>
					</div>
					<div class="form-group col-md-4 align-self-end">
						<button class="btn btn-primary" type="submit" name="button" id="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>kick out</button>
					</div>
				</div>
				<?php } ?>
				</form>
			</div>
		</div>
	</div>
</div>