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
?>
	<div class="app-title">
		<div>
			<h1><i class="fa fa-user-secret"></i> Manager VIP</h1>
			<p>Manager VIP</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item"><a href="index2.php?option=manage_vip"> Manager VIP</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
				<?php 
					if($_REQUEST['del']!=""){
						mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM radusergroup WHERE username ='".$_REQUEST['del']."'");
						mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM account WHERE username ='".$_REQUEST['del']."'");
						mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM radcheck  WHERE username ='".$_REQUEST['del']."'");
					}

					$sql = "SELECT * FROM radcheck,account WHERE radcheck.attribute ='Auth-Type' and account.username=radcheck.username ORDER BY radcheck.username"; 
					$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					if (mysqli_num_rows($result) > 0) {
				?>
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
					<tr>
						<th>#</th>
						<th>UserName</th>
						<th>ChilliSpot-MAC-Allowed</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
						<?php
							$countOnlineList = 0;
							while($request = mysqli_fetch_object($result)) { 
								$result_group = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT  * FROM radusergroup WHERE username='$request->username'");
								$array_group = mysqli_fetch_array($result_group);
								$countOnlineList++;
						?>
					<tr>
						<td><?= $countOnlineList  ?></td>
						<td><?=$request->firstname?></td>
						<td><?=$request->username?></td>
						<td>
							<div class="btn-group">
								<a class="btn btn-primary" href="index2.php?option=users_vip&Idedit=<?=$request->username?>&group=<?=$array_group[groupname]?>"><i class="fa fa-lg fa-edit"></i></a>
								<a class="btn btn-primary" href="index2.php?option=manage_vip&del=<?=$request->username?>"><i class="fa fa-lg fa-trash" onclick="return confirm('Are you sure want to delete?')"></i></a>
							</div>
						</td>
					</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php }else{ ?>
					<div class="bs-component">
						<div class="alert alert-danger">
							<strong>Sorry!</strong> No data Available right now.
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
