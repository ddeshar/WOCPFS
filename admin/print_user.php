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
	$sql = "SELECT * FROM groups";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$num = mysqli_num_rows($result);

	if(!isset($_GET["group"])) {
		$selectgroup = "Please Select Group";
	} else { 
		$sql = "SELECT * FROM groups WHERE gname = '".$_GET["group"]."'";
		$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$data2 = mysqli_fetch_object($result2);
		$selectgroup =  "Group " .   $data2->gdesc . "";
	} 
?>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">

				<div class="bs-component">
					<ul class="nav nav-pills">
						<li class="nav-item dropdown"><a class="nav-link dropdown-toggle btn-primary" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=$selectgroup?></a>
							<div class="dropdown-menu">
							<?php
								while($groups = mysqli_fetch_object($result)) { ?>
								<a class="dropdown-item" href="index2.php?option=print_user&group=<?= $groups->gname ?>"><?= $groups->gdesc ?></a>
							<?php } ?>
							</div>
						</li>
					</ul>
				</div>
					<br>
				<?php
					if(isset($_REQUEST['group'])) {
						echo "<div class=\"bs-component\"><div class=\"alert alert-info\" align=\"center\">";
						echo "จำนวนสมาชิกในกลุ่ม <b class=\"text-danger\"> ".$data2->gdesc ."</b> มีทั้งสิ้น <b class=\"text-danger\">";
						$sql = "SELECT * FROM radusergroup WHERE GroupName = '".$_REQUEST['group']."'";
						echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql)); 
						echo "</b> คน";
						echo "</div>";
					} 
				?>

			</div>
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
		<div class="col-md-12">
			<form id="myfrm" name="myfrm" method="post" action="ThaiPDF/exportPDF-user.php"  target="_blank" onsubmit="return confirm2Move(this);">
				<input type="hidden" id="group" name="group" value="<?=$_REQUEST['group']?>" />
				<div class="tile">
					<?php
						if(isset($_GET["group"])){
							echo "<div class=\"tile-title-w-btn\">";
							echo "<h3 class=\"title\"></h3>";
							echo "<input type=\"submit\" value=\"Print\" class=\"btn btn-primary icon-btn\" /> ";
							echo "</div>";
						}
					?>
					
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
							<tbody>
								<?php
									$send = "option=" . $_GET['option'] . "&group=" . $_GET['group'];
									$sql = "SELECT * FROM radusergroup , account WHERE radusergroup .GroupName = '".$_GET["group"]."' AND radusergroup .UserName = account.username AND account.status != '-1' ORDER BY account.username"; 
									$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
									$count = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], $sql));
									$no = 1;
									while($users = mysqli_fetch_object($result)) { 
									echo"<input id=\"firstname[$a]\" name=\"firstname[$a]\" type=\"hidden\" value=\"$users->firstname\" />";
									echo"<input id=\"password[$a]\"name=\"password[$a]\" type=\"hidden\" value=\"$users->password\" />";
									echo"<input id=\"username[$a]\"name=\"username[$a]\" type=\"hidden\" value=\"$users->username\" />";
								?>
								<tr>
									<td><?=$no?></td>
									<td><?= $users->firstname ?><?//= $users->lastname ?></td>
									<td><?= $users->username ?> : <?= $users->password ?></td>
									<td><input type="checkbox" id="user[]" name="user[]" value="<?= $users->username?>" /></td>
								</tr>
							</tbody>
								<?php
									$a++; $no++;}
								?>
						</table>

						<input name="last" type="hidden" value="<?= $start + $count ?>" />
						<input name="prefix" type="hidden" value="<?= $username ?>" />
						<input name="group" type="hidden" value="<?= $group ?>" />
						<input name="numadd" type="hidden" value="<?=$count?>" />

					</div>
				</div>
			</form>
		</div>
	</div>

