<?php
	// print_r($_REQUEST);
	$newup = $newdown = 0;
	$newexpire = "0000-00-00";
	
//	$_POST["user"]$_POST['group']
?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-address-card"></i> พิมพ์บัตรผู้ใช้งานระบบ</h1>
        <p>User Manager</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=print_user">พิมพ์บัตรผู้ใช้งานระบบ</a></li>
    </ul>
</div>

<?php
	$sql = "select * from groups";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$num = mysqli_num_rows($result);

	if(!isset($_GET["group"])) {
		$selectgroup = "กรุณาเลือกกลุ่ม";
	} else { 
			
	$sql = "select * from groups where gname = '".$_GET["group"]."'";
	$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$data2 = mysqli_fetch_object($result2);
	$selectgroup =  "กลุ่ม " .   $data2->gdesc . "";
	} 
?>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<a class="btn btn-primary icon-btn" href="#" onClick="showhide(1);event.cancelBubble=1"><i class="fa fa-plus"></i><?=$selectgroup?></a>
				<div onmouseover="showhide(2);" onmouseout="showhide(0)" id="innermenu" style="position:absolute; background-color:white; visibility:hidden; z-index: 10;">
					<script>
						function gl(linkname,dest){
							document.write('<a class="dropdown-item"   href="'+dest+'">'+linkname+'</a>')
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
						<? while($groups = mysqli_fetch_object($result)) { ?>
						gl("กลุ่ม<?= $groups->gdesc ?>","index2.php?option=print_user&group=<?= $groups->gname ?>")
						<? } ?>

						//Extend this list as needed
						
						document.onclick=function(){showhide(0)}
					</script>
				</div>

				<script>
					function autoChecked(frmObj,chkObj){
						for(i=0; i<frmObj.length; i++){
							if(chkObj.checked)
								frmObj[i].checked=true;
							else
								frmObj[i].checked=false;
						}
					}
					function isChecked(frmObj){
						var _return = false;
						for(i=0; i<frmObj.length; i++){
							if(frmObj[i].checked)
							_return = true;
						}
						return _return;
					}

					function confirm2Move(frmObj){
						if(!isChecked(frmObj)){
							alert("กรุณาเลือกผู้ใช้งาน!");
							return false;
						}else if(frmObj.group.options[frmObj.group.selectedIndex].value == ""){
							alert("กรุณาเลือก!");
							return false;
						}
					}
				</script>

				<form id="myfrm" name="myfrm" method="post" action="ThaiPDF/exportPDF-user.php"  target="_blank" onsubmit="return confirm2Move(this);">
				<input type="hidden" id="group" name="group" value="<?=$_REQUEST['group']?>" />
				<br>
				<?php
					if(isset($_REQUEST['group'])) {
						echo "<div class=\"bs-component\"><div class=\"alert alert-info\" align=\"center\">";
						echo "จำนวนสมาชิกในกลุ่ม <b class=\"text-danger\"> ".$data2->gdesc ."</b> มีทั้งสิ้น <b class=\"text-danger\">";
						$sql = "select * from radusergroup  where GroupName = '".$_REQUEST['group']."'";
						echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql)); 
						echo "</b> คน";
						echo "</div>";
					} 

					if(isset($message)) {
						echo $message;
					} 
					
					if($_GET["group"]!=""){
				?> 
					<div class="row">
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="001.png"/><img src="ThaiPDF/001.png" width="100%" height="120" /> 
						</div>
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="002.png"/><img src="ThaiPDF/001.png" width="100%" height="120" /> 
						</div>
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="003.png"/><img src="ThaiPDF/001.png" width="100%" height="120" />
						</div>
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="004.png"/><img src="ThaiPDF/001.png" width="100%" height="120" /> 
						</div>
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="005.png"/><img src="ThaiPDF/001.png" width="100%" height="120" /> 
						</div>
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="006.png"/><img src="ThaiPDF/001.png" width="100%" height="120" />
						</div>
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="007.png"/><img src="ThaiPDF/001.png" width="100%" height="120" /> 
						</div>
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="008.png"/><img src="ThaiPDF/001.png" width="100%" height="120" /> 
						</div>
						<div class="col-md-3">
							<input type="radio" name="piccard" id="piccard" value="009.png"/><img src="ThaiPDF/001.png" width="100%" height="120" />
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="clearix"></div>

	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th>ลำดับที่</th>
							<th>ชื่อ - นามสกุล</th>
							<th>ชื่อผู้ใช้งาน</th>
							<th><input type="checkbox" onclick="javascript:autoChecked(this.form,this);"></th>
						</tr>
					</thead>
						<?php
							$send = "option=" . $_GET['option'] . "&group=" . $_GET['group'];
							$sql = "select * from radusergroup , account where radusergroup .GroupName = '".$_GET["group"]."' and radusergroup .UserName = account.username and account.status != '-1' order by account.username"; 
							$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
							$count = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
							while($users = mysqli_fetch_object($result)) { 
								echo"<input id=\"firstname[$a]\" name=\"firstname[$a]\" type=\"hidden\" value=\"$users->firstname\" />";
								echo"<input id=\"password[$a]\"name=\"password[$a]\" type=\"hidden\" value=\"$users->password\" />";
								echo"<input id=\"username[$a]\"name=\"username[$a]\" type=\"hidden\" value=\"$users->username\" />"; 
						?>
					<tbody>
						<tr>
							<td></td>
							<td><?= $users->firstname ?><?//= $users->lastname ?></td>
							<td><?= $users->username ?> : <?= $users->password ?></td>
							<td><input type="checkbox" id="user[]" name="user[]" value="<?= $users->username?>" /></td>
						</tr>
					</tbody>
						<?php
							$a++;}
						?>
				</table>
			</div>
		</div>
	</div>


		<input name="last" type="hidden" value="<?= $start + $count ?>" />
		<input name="prefix" type="hidden" value="<?= $username ?>" />
		<input name="group" type="hidden" value="<?= $group ?>" />
		<input name="numadd" type="hidden" value="<?=$count?>" />
	<?php
		if(isset($_GET["group"])){
			echo "<div style=\"width:95%;\">";
			// echo "<div id=\"pagination\"><ol>" . pagination($page, $limit, $count, $send) . "</ol></div>";
			echo "<div style=\"float:right;display:inline-block;padding-top:2px;\">";
			echo " <input type=\"submit\" value=\"พิมพ์\" class=\"button\" /> ";
			echo "</div>";
			echo "</div>";
		}
	?>
</form>

