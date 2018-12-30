<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

	include("include/class.mysqldb.php");
	include("include/config.inc.php");
	$username = "";
	$password = "";
	if(!isset($_SESSION['logined'])) {
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$message = "<div class=\"alert alert-warning\" role=\"alert\">ท่านผู้ดูแลระบบสามารถล็อกอินได้ที่นี่</div>";
		if(isset($_REQUEST['action'])) {
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			if(empty($_REQUEST['username']) && empty($_REQUEST['password'])) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
									<span aria-hidden=\"true\">&times;</span>
								</button>
								<strong>กรุณา!</strong> กรอกชื่อผู้ใช้และรหัสผ่านของท่านด้วย
							</div>";
			} else if(empty($_REQUEST['username']) && !empty($_REQUEST['password'])) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
									<span aria-hidden=\"true\">&times;</span>
								</button>
								<strong>กรุณา!</strong> กรอกชื่อผู้ใช้ของท่านด้วย
							</div>";
			} else if(!empty($_REQUEST['username']) && empty($_REQUEST['password'])) {
				$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
									<span aria-hidden=\"true\">&times;</span>
								</button>
								<strong>กรุณา!</strong> กรอกรหัสผ่านของท่านด้วย
							</div>";
			} else {
				$sql = "SELECT * FROM administrator WHERE username = '".$_REQUEST['username']."' AND password = '".md5($_REQUEST['password'])."'";
				$result = $link->query($sql);
				if($link->num_rows() == 0) {
					$message = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
										<span aria-hidden=\"true\">&times;</span>
									</button>
									<strong>ข้อมูลของท่านไม่ถูกต้อง!</strong> กรุณาตรวจสอบข้อมูลด้วย
								</div>";
				} else {
					$data = mysqli_fetch_object($result);
					$_SESSION['logined'] = true;
					$_SESSION['username'] = $_REQUEST['username'];
					$_SESSION['name'] = $data->name;
					$sql = "UPDATE administrator SET lastlogin = '".date("Y-m-d H:i:s")."' WHERE username = '".$_REQUEST['username']."'";
					$link->query($sql);
					?><meta http-equiv="refresh" content="0;url=index2.php"><?
					exit(0);
				}
			}
		} 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Dipendra Deshar" />
		<meta name="keywords" content="authentication system" />
		<meta name="description" content="PFSENSE Authentication Project" />	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Main CSS-->
		<link rel="stylesheet" type="text/css" href="_assets/css/main.css">
		<!-- Font-icon css-->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>-:- Authent!cation -:-</title>
	</head>
<body>
		<section class="material-half-bg">
			<div class="cover"></div>
		</section>
		<section class="login-content">
			<div class="logo">
				<h1>Authent!cation For Admin</h1>
			</div>
			<?php echo $message; ?>
			<div class="login-box">
				<form name="login" id="login" class="login-form" method="post" action="">
					<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>เข้าสู่ระบบ</h3>
					<div class="form-group">
						<label class="control-label">ชื่อผู้ใช้ :</label>
						<input type="text" name="username" id="username" class="form-control <?php echo $classbox[0]; ?>"  value="<?php echo $username; ?>"  onclick="this.value=''" autofocus>
					</div>
					<div class="form-group">
						<label class="control-label">รหัสผ่าน : </label>
						<input type="password" name="password" id="password" class="form-control <?php echo $classbox[1]; ?>"  value="<?php echo $password; ?>"  onclick="this.value=''" /><br />
					</div>

					<input type="hidden" name="action" id="action" value="login"> 

					<!-- <div class="form-group">
						<div class="utility">
						<div class="animated-checkbox">
							<label>
							<input type="checkbox"><span class="label-text">Stay Signed in</span>
							</label>
						</div>
						<p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
						</div>
					</div> -->
					<div class="form-group btn-container">
						<button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>เข้าสู่ระบบ</button>
						<input name="button2" type="button" class="btn btn-danger btn-block" id="button2" value="ยกเลิก" onClick="window.location='index.php'" />
					</div>
				</form>

				<!-- For password forget Function -->
				<!-- <form class="forget-form" action="index.html">
					<h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
					<div class="form-group">
						<label class="control-label">EMAIL</label>
						<input class="form-control" type="text" placeholder="Email">
					</div>
					<div class="form-group btn-container">
						<button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
					</div>
					<div class="form-group mt-3">
						<p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
					</div>
				</form> -->
			</div>
		</section>
		<!-- Essential javascripts for application to work-->
		<script src="_assets/js/jquery-3.2.1.min.js"></script>
		<script src="_assets/js/popper.min.js"></script>
		<script src="_assets/js/bootstrap.min.js"></script>
		<script src="_assets/js/main.js"></script>
		<!-- The javascript plugin to display page loading on top-->
		<script src="_assets/js/plugins/pace.min.js"></script>
		<!-- Page specific javascripts-->
		<script type="text/javascript" src="_assets/js/plugins/bootstrap-notify.min.js"></script>
		<script type="text/javascript">
		// Login Page Flipbox control
		$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
			return false;
		});
		</script>
	</body>
	</html>
<?php
	} else {
		?><meta http-equiv="refresh" content="0;url=index2.php"><?
	}
?>