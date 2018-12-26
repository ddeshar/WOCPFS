<?php
	include("include/class.mysqldb.php");
	include("include/config.inc.php");
	
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
			# check username duplicate
			$sql = "SELECT * FROM account WHERE username = '$username'";
			$link1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$data = mysqli_fetch_object($link1);
			if($data->encryption=='clear'){
			 	$p1=$data->password;
				$p2=$opassword;
			} else {
				$p1=$data->password;
				$p2=substr(md5($opassword),0,15);
			}
			if($p1 != $p2) {
				$error[4] = true;
			}
		
		# check password
		if(empty($password)) {
			$error[5] = true;
		}
		if(!$error[5]) {
			if(strlen($password) < 6) {
				$error[6] = true;
			}
		}
		# check password2
		if(empty($password2)) {
			$error[7] = true;
		}
		if(!$error[7]) {
			if(strlen($password2) < 6) {
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
			switch($data->encryption) {
				case 'md5' : $newpass = substr(md5($password),0,15); break;
				case 'crypt' : $newpass = crypt($password,"BL"); break;
				default : $newpass = $password; break;
			}
			$sql = "SELECT * FROM account where username = '$username'";
			//echo $sql;
			$link->query($sql);
			$conf = $link->getnext();
			//echo $conf->value;
			$sql = "UPDATE account SET password = '$newpass' WHERE username = '$username'";
			//echo $sql;
			$link->query($sql);
			
			$sql = "UPDATE radcheck SET value = '$newpass' WHERE username = '$username'";
			mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			//$sql = "INSERT INTO radcheck VALUES ('', '$username', 'Cleartext-Password', '==', '$password'";
			//mysql_query($sql);
			
			$message = "บันทึกข้อมูลของคุณเรียบร้อยแล้ว";

	$username = $firstname = $lastname = $mailaddr = $password = $password2 = "";
		}
	}
?>
<!DOCTYPE html>
<html lang="th">
<head>
	<title>P$T Authentication</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<!--===============================================================================================-->	
		<link rel="stylesheet" type="text/css" href="_assets/font-awesome-4.7.0/css/font-awesome.css">
	<!--===============================================================================================-->
		<style>
			*{margin:0;padding:0;box-sizing:border-box}body,html{height:100%;font-family:Kanit,sans-serif}input{outline:0;border:none}input:focus::-webkit-input-placeholder{color:transparent}input:focus:-moz-placeholder{color:transparent}input:focus::-moz-placeholder{color:transparent}input:focus:-ms-input-placeholder{color:transparent}textarea:focus::-webkit-input-placeholder{color:transparent}textarea:focus:-moz-placeholder{color:transparent}textarea:focus::-moz-placeholder{color:transparent}textarea:focus:-ms-input-placeholder{color:transparent}input::-webkit-input-placeholder{color:#999}input:-moz-placeholder{color:#999}input::-moz-placeholder{color:#999}input:-ms-input-placeholder{color:#999}textarea::-webkit-input-placeholder{color:#999}textarea:-moz-placeholder{color:#999}textarea::-moz-placeholder{color:#999}textarea:-ms-input-placeholder{color:#999}button{outline:0!important;border:none;background:0 0}button:hover{cursor:pointer}iframe{border:none!important}.limiter{width:100%;margin:0 auto}.container-login100{width:100%;min-height:100vh;display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;flex-wrap:wrap;justify-content:center;align-items:center;padding:15px;background-repeat:no-repeat;background-position:center;background-size:cover;position:relative;z-index:1}.container-login100::before{content:"";display:block;position:absolute;z-index:-1;width:100%;height:100%;top:0;left:0;background-color:rgba(175,184,199,.9)}.wrap-login100{width:960px;background:#fff;border-radius:10px;overflow:hidden;display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;flex-wrap:wrap;justify-content:space-between;padding:60px 130px 60px 95px}.login100-pic{width:316px}.login100-pic img{max-width:100%}.login100-form{width:290px}.login100-form-title{font-family:Kanit;font-size:24px;color:#333;line-height:1.2;text-align:center;width:100%;display:block;padding-bottom:54px}.input100,.login100-form-btn{font-family:Kanit;font-size:15px;line-height:1.5}.wrap-input100{position:relative;width:100%;z-index:1;margin-bottom:10px}.input100{color:#666;display:block;width:100%;background:#e6e6e6;height:50px;border-radius:25px;padding:0 30px 0 68px}.focus-input100,.symbol-input100{position:absolute;bottom:0;left:0;height:100%;border-radius:25px}.focus-input100{display:block;z-index:-1;width:100%;box-shadow:0 0;color:rgba(87,184,70,.8)}.container-login100-form-btn,.symbol-input100{display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;width:100%}.input100:focus+.focus-input100{-webkit-animation:anim-shadow .5s ease-in-out forwards;animation:anim-shadow .5s ease-in-out forwards}@-webkit-keyframes anim-shadow{to{box-shadow:0 0 70px 25px;opacity:0}}@keyframes anim-shadow{to{box-shadow:0 0 70px 25px;opacity:0}}.symbol-input100{font-size:15px;display:flex;align-items:center;padding-left:35px;pointer-events:none;color:#666;-webkit-transition:all .4s;-o-transition:all .4s;-moz-transition:all .4s;transition:all .4s}.input100:focus+.focus-input100+.symbol-input100{color:#57b846;padding-left:28px}.container-login100-form-btn{display:flex;flex-wrap:wrap;justify-content:center;padding-top:20px}.login100-form-btn{color:#fff;text-transform:uppercase;width:100%;height:50px;border-radius:25px;background:#57b846;display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;justify-content:center;align-items:center;padding:0 25px;-webkit-transition:all .4s;-o-transition:all .4s;-moz-transition:all .4s;transition:all .4s}.login100-form-btn:hover{background:#333}@media (max-width:992px){.wrap-login100{padding:177px 90px 33px 85px}.login100-pic{width:35%}.login100-form{width:50%}}@media (max-width:768px){.wrap-login100{padding:100px 80px 33px}.login100-pic{display:none}.login100-form{width:100%}}@media (max-width:576px){.wrap-login100{padding:100px 15px 33px}}#footer{text-align:left;padding:10px}#footer-box{background-color:#fff;padding:10px;width:auto;max-width:813px}

			/* thai */
			@font-face{font-family:Kanit;font-style:normal;font-weight:400;src:local('Kanit Regular'),local('Kanit-Regular'),url(_assets/captiveportal-Kanit-Regular.ttf) format('woff2');unicode-range:U+0E01-0E5B,U+200C-200D,U+25CC}*{margin:0;padding:0;box-sizing:border-box}body,html{height:100%;font-family:Kanit,sans-serif}input{outline:0;border:none}input:focus::-webkit-input-placeholder{color:transparent}input:focus:-moz-placeholder{color:transparent}input:focus::-moz-placeholder{color:transparent}input:focus:-ms-input-placeholder{color:transparent}textarea:focus::-webkit-input-placeholder{color:transparent}textarea:focus:-moz-placeholder{color:transparent}textarea:focus::-moz-placeholder{color:transparent}textarea:focus:-ms-input-placeholder{color:transparent}input::-webkit-input-placeholder{color:#999}input:-moz-placeholder{color:#999}input::-moz-placeholder{color:#999}input:-ms-input-placeholder{color:#999}textarea::-webkit-input-placeholder{color:#999}textarea:-moz-placeholder{color:#999}textarea::-moz-placeholder{color:#999}textarea:-ms-input-placeholder{color:#999}button{outline:0!important;border:none;background:0 0}button:hover{cursor:pointer}iframe{border:none!important}.limiter{width:100%;margin:0 auto}.container-login100{width:100%;min-height:100vh;display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;flex-wrap:wrap;justify-content:center;align-items:center;padding:15px;background-repeat:no-repeat;background-position:center;background-size:cover;position:relative;z-index:1}.container-login100::before{content:"";display:block;position:absolute;z-index:-1;width:100%;height:100%;top:0;left:0;background-color:rgba(175,184,199,.9)}.wrap-login100{width:960px;background:#fff;border-radius:10px;overflow:hidden;display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;flex-wrap:wrap;justify-content:space-between;padding:60px 130px 60px 95px}.login100-pic{width:316px}.login100-pic img{max-width:100%}.login100-form{width:290px}.login100-form-title{font-family:Kanit;font-size:24px;color:#333;line-height:1.2;text-align:center;width:100%;display:block;padding-bottom:54px}.input100,.login100-form-btn{font-family:Kanit;font-size:15px;line-height:1.5}.wrap-input100{position:relative;width:100%;z-index:1;margin-bottom:10px}.input100{color:#666;display:block;width:100%;background:#e6e6e6;height:50px;border-radius:25px;padding:0 30px 0 68px}.focus-input100,.symbol-input100{position:absolute;bottom:0;left:0;height:100%;border-radius:25px}.focus-input100{display:block;z-index:-1;width:100%;box-shadow:0 0;color:rgba(87,184,70,.8)}.container-login100-form-btn,.symbol-input100{display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;width:100%}.input100:focus+.focus-input100{-webkit-animation:anim-shadow .5s ease-in-out forwards;animation:anim-shadow .5s ease-in-out forwards}@-webkit-keyframes anim-shadow{to{box-shadow:0 0 70px 25px;opacity:0}}@keyframes anim-shadow{to{box-shadow:0 0 70px 25px;opacity:0}}.symbol-input100{font-size:15px;display:flex;align-items:center;padding-left:35px;pointer-events:none;color:#666;-webkit-transition:all .4s;-o-transition:all .4s;-moz-transition:all .4s;transition:all .4s}.input100:focus+.focus-input100+.symbol-input100{color:#57b846;padding-left:28px}.container-login100-form-btn{display:flex;flex-wrap:wrap;justify-content:center;padding-top:20px}.login100-form-btn{color:#fff;text-transform:uppercase;width:100%;height:50px;border-radius:25px;background:#57b846;display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;justify-content:center;align-items:center;padding:0 25px;-webkit-transition:all .4s;-o-transition:all .4s;-moz-transition:all .4s;transition:all .4s}.login100-form-btn:hover{background:#333}@media (max-width:992px){.wrap-login100{padding:177px 90px 33px 85px}.login100-pic{width:35%}.login100-form{width:50%}}@media (max-width:768px){.wrap-login100{padding:100px 80px 33px}.login100-pic{display:none}.login100-form{width:100%}}@media (max-width:576px){.wrap-login100{padding:100px 15px 33px}}#footer{text-align:left;padding:10px}#footer-box{background-color:#fff;padding:10px;width:auto;max-width:813px}.error-notice{margin:5px}.oaerror{width:90%;background-color:#FFF;padding:20px;border:1px solid #eee;border-left-width:5px;border-radius:5px 25px;margin:0 auto;font-family:Kanit,sans-serif;font-size:16px}.danger{border-left-color:#d9534f;background-color:rgba(217,83,79,.1)}.danger strong{color:#d9534f}
		
.text-muted, .app-notification__meta {
	color: #ff0000 !important;
}
.form-text {
	display: block;
	margin-top: 0.25rem;
	padding-left: 15px;
}
small, .small {
	font-size: 80%;
	font-weight: 400;
}

small {
	font-size: 80%;
}
		</style>

		<script>
			setTimeout(function (){
				document.getElementById("error").remove();
			}, 9000);
		</script>
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('_assets/img/captiveportal-bg-01.jpg');">
		<!-- <div class="container-login100"> -->
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="_assets/img/captiveportal-img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" name="regis" method="post" action="">
					<span class="login100-form-title">
						ระบบพิสูจน์ตัวตน <br> โรงเรียนพระปริยัติธรรม <br>วัดโสธรวราราม
					</span>

						<?php
							$alertMsgH ='<div class="error-notice" id="error"><div class="oaerror danger">';
							$alertMsgF ='</div></div>';

							if(!empty($message)) { echo $alertMsgH . $message . $alertMsgF; } 

							if(!empty($message)) {  ?>
							<input name="" type="button" class="login100-form-btn" value="ล๊อกอิน" onclick="window.location='http://<?= $_SERVER['SERVER_ADDR'] ?>:3990/prelogin'" style="cursor:hand" />
							<? } 
								if(empty($message)) { 
									if($error[4]) {
										echo $alertMsgH . "ชื่อผู้ใช้กับรหัสผ่านเดิม : ไม่ตรงกัน".$alertMsgF;
									} 
									if($error[3]) {
										echo $alertMsgH . "กรุณากรอกชื่อผู้ใช้ของคุณด้วยครับ".$alertMsgF;
									}
									if($error[6]) {
										echo $alertMsgH . "ความยาวของรหัสผ่านต้องมียาวอย่างน้อย 6 อักขระครับ".$alertMsgF;
									}
									if($error[7]) {
										echo $alertMsgH . "กรุณายืนยันรหัสผ่านด้วยครับ".$alertMsgF;
									} 
									if($error[8]) {
										echo $alertMsgH . "ความยาวของรหัสผ่านต้องยาวอย่างน้อย 6 อักขระครับ".$alertMsgF;
									}
									if($error[9]) {
										echo $alertMsgH . "รหัสผ่านทั้งสองไม่ตรงกัน".$alertMsgF;
									}
									if($error[1]) {
										echo $alertMsgH . "กรุณากรอกรหัสผ่านเดิมด้วยครับ".$alertMsgF;
									}
									if($error[5]) {
										echo $alertMsgH . "กรุณากรอกรหัสผ่านใหม่ด้วยครับ".$alertMsgF;
									}
						?>

					<div class="wrap-input100 validate-input">
						<input name="username" type="text" class="input100" id="username" placeholder="username"  style="background: <? if($error[3] || $error[4]) echo "#FFF0F0"; ?>" value="<?= $username ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						<small class="form-text text-muted">กรอกเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น</small>
					</div>

					<div class="wrap-input100 validate-input">
						<input name="opassword" type="password" class="input100" id="opassword"  placeholder="รหัสผ่านเดิม" style="background: <? if($error[10] || $error[4]) echo "#FFF0F0"; ?>" value="<?= $opassword ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input name="password" type="password" class="input100" id="password"  placeholder="รหัสผ่านใหม่" style="background: <? if($error[5] || $error[6] || $error[9]) echo "#FFF0F0"; ?>" value="<?= $password ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						<small class="form-text text-muted">ความยาวอย่างน้อย 6 อักขระ</small>
					</div>

					<div class="wrap-input100 validate-input">
						<input name="password2" type="password" class="input100" id="password2"  placeholder="ยืนยันรหัสผ่าน" style="background: <? if($error[7] || $error[8] || $error[9]) echo "#FFF0F0"; ?>" value="<?= $password2 ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
				
					<div class="container-login100-form-btn">
						<input type="submit" name="button" id="button" class="login100-form-btn" value="ส่งข้อมูล">
					</div>
					<? } ?>
				</form>
				
			</div>
		</div>
	</div>
		
		<!--===============================================================================================-->	
			<script src="_assets/js/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script >
			"use strict";var _typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"===("undefined"==typeof module?"undefined":_typeof(module))&&module.exports?module.exports=function(i,s){return void 0===s&&(s="undefined"!=typeof window?require("jquery"):require("jquery")(i)),t(s),s}:t(jQuery)}(function(t){return t.fn.tilt=function(i){var s=function(){this.ticking||(requestAnimationFrame(g.bind(this)),this.ticking=!0)},e=function(){var i=this;t(this).on("mousemove",o),t(this).on("mouseenter",a),this.settings.reset&&t(this).on("mouseleave",l),this.settings.glare&&t(window).on("resize",d.bind(i))},n=function(){var i=this;void 0!==this.timeout&&clearTimeout(this.timeout),t(this).css({transition:this.settings.speed+"ms "+this.settings.easing}),this.settings.glare&&this.glareElement.css({transition:"opacity "+this.settings.speed+"ms "+this.settings.easing}),this.timeout=setTimeout(function(){t(i).css({transition:""}),i.settings.glare&&i.glareElement.css({transition:""})},this.settings.speed)},a=function(i){this.ticking=!1,t(this).css({"will-change":"transform"}),n.call(this),t(this).trigger("tilt.mouseEnter")},r=function(i){return"undefined"==typeof i&&(i={pageX:t(this).offset().left+t(this).outerWidth()/2,pageY:t(this).offset().top+t(this).outerHeight()/2}),{x:i.pageX,y:i.pageY}},o=function(t){this.mousePositions=r(t),s.call(this)},l=function(){n.call(this),this.reset=!0,s.call(this),t(this).trigger("tilt.mouseLeave")},h=function(){var i=t(this).outerWidth(),s=t(this).outerHeight(),e=t(this).offset().left,n=t(this).offset().top,a=(this.mousePositions.x-e)/i,r=(this.mousePositions.y-n)/s,o=(this.settings.maxTilt/2-a*this.settings.maxTilt).toFixed(2),l=(r*this.settings.maxTilt-this.settings.maxTilt/2).toFixed(2),h=Math.atan2(this.mousePositions.x-(e+i/2),-(this.mousePositions.y-(n+s/2)))*(180/Math.PI);return{tiltX:o,tiltY:l,percentageX:100*a,percentageY:100*r,angle:h}},g=function(){return this.transforms=h.call(this),this.reset?(this.reset=!1,t(this).css("transform","perspective("+this.settings.perspective+"px) rotateX(0deg) rotateY(0deg)"),void(this.settings.glare&&(this.glareElement.css("transform","rotate(180deg) translate(-50%, -50%)"),this.glareElement.css("opacity","0")))):(t(this).css("transform","perspective("+this.settings.perspective+"px) rotateX("+("x"===this.settings.disableAxis?0:this.transforms.tiltY)+"deg) rotateY("+("y"===this.settings.disableAxis?0:this.transforms.tiltX)+"deg) scale3d("+this.settings.scale+","+this.settings.scale+","+this.settings.scale+")"),this.settings.glare&&(this.glareElement.css("transform","rotate("+this.transforms.angle+"deg) translate(-50%, -50%)"),this.glareElement.css("opacity",""+this.transforms.percentageY*this.settings.maxGlare/100)),t(this).trigger("change",[this.transforms]),void(this.ticking=!1))},c=function(){var i=this.settings.glarePrerender;if(i||t(this).append('<div class="js-tilt-glare"><div class="js-tilt-glare-inner"></div></div>'),this.glareElementWrapper=t(this).find(".js-tilt-glare"),this.glareElement=t(this).find(".js-tilt-glare-inner"),!i){var s={position:"absolute",top:"0",left:"0",width:"100%",height:"100%"};this.glareElementWrapper.css(s).css({overflow:"hidden","pointer-events":"none"}),this.glareElement.css({position:"absolute",top:"50%",left:"50%","background-image":"linear-gradient(0deg, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%)",width:""+2*t(this).outerWidth(),height:""+2*t(this).outerWidth(),transform:"rotate(180deg) translate(-50%, -50%)","transform-origin":"0% 0%",opacity:"0"})}},d=function(){this.glareElement.css({width:""+2*t(this).outerWidth(),height:""+2*t(this).outerWidth()})};return t.fn.tilt.destroy=function(){t(this).each(function(){t(this).find(".js-tilt-glare").remove(),t(this).css({"will-change":"",transform:""}),t(this).off("mousemove mouseenter mouseleave")})},t.fn.tilt.getValues=function(){var i=[];return t(this).each(function(){this.mousePositions=r.call(this),i.push(h.call(this))}),i},t.fn.tilt.reset=function(){t(this).each(function(){var i=this;this.mousePositions=r.call(this),this.settings=t(this).data("settings"),l.call(this),setTimeout(function(){i.reset=!1},this.settings.transition)})},this.each(function(){var s=this;this.settings=t.extend({maxTilt:t(this).is("[data-tilt-max]")?t(this).data("tilt-max"):20,perspective:t(this).is("[data-tilt-perspective]")?t(this).data("tilt-perspective"):300,easing:t(this).is("[data-tilt-easing]")?t(this).data("tilt-easing"):"cubic-bezier(.03,.98,.52,.99)",scale:t(this).is("[data-tilt-scale]")?t(this).data("tilt-scale"):"1",speed:t(this).is("[data-tilt-speed]")?t(this).data("tilt-speed"):"400",transition:!t(this).is("[data-tilt-transition]")||t(this).data("tilt-transition"),disableAxis:t(this).is("[data-tilt-disable-axis]")?t(this).data("tilt-disable-axis"):null,axis:t(this).is("[data-tilt-axis]")?t(this).data("tilt-axis"):null,reset:!t(this).is("[data-tilt-reset]")||t(this).data("tilt-reset"),glare:!!t(this).is("[data-tilt-glare]")&&t(this).data("tilt-glare"),maxGlare:t(this).is("[data-tilt-maxglare]")?t(this).data("tilt-maxglare"):1},i),null!==this.settings.axis&&(console.warn("Tilt.js: the axis setting has been renamed to disableAxis. See https://github.com/gijsroge/tilt.js/pull/26 for more information"),this.settings.disableAxis=this.settings.axis),this.init=function(){t(s).data("settings",s.settings),s.settings.glare&&c.call(s),e.call(s)},this.init()})},t("[data-tilt]").tilt(),!0});
	
			$('.js-tilt').tilt({
				scale: 1.1
			})
		</script>
	</body>
	</html>