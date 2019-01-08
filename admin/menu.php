<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

	include("include/class.testlogin.php");
	// print_r($_REQUEST);
	if(isset($_REQUEST['action'])) { 
		$sql = "SELECT * FROM menu WHERE id = '".$_REQUEST['id']."'"; 
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$group = mysqli_fetch_object($result);

		switch($_REQUEST['action']) {
			case 'delete' : 
				$sql = "DELETE FROM menu WHERE id = '".$_REQUEST['menuId']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$message = "<font color=green>Your menu has been deleted</font>";
			break;
			case 'addmenu' :
				$sql1 = "INSERT INTO menu VALUES (NULL, '".$_REQUEST['label']."', '".$_REQUEST['link']."', '".$_REQUEST['parent']."', '".$_REQUEST['sort']."', '".$_REQUEST['icon']."', '".$_REQUEST['type']."', '".$_REQUEST['status']."')";
				mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
				$message = "<font color=green>Your data has been saved</font>";
			break;
			case 'editMenu' :
				$update = "UPDATE menu SET `label` = '".$_REQUEST['label']."', `link` = '".$_REQUEST['link']."', `parent` = '".$_REQUEST['parent']."', `sort` = '".$_REQUEST['sort']."', `icon` = '".$_REQUEST['icon']."', `type` = '".$_REQUEST['type']."', `status` = '".$_REQUEST['status']."' WHERE `menu`.`id` = '".$_REQUEST['menuId']."'";
				mysqli_query($GLOBALS["___mysqli_ston"], $update);
				echo "<script>window.location='index2.php?option=menu&action=success';</script>";
			break;
		}
	}
		if(isset($_REQUEST['action']) && ($_REQUEST['action'] == "edit" )) { 
			$message = "fill all input";

			$sql = "SELECT * FROM menu WHERE id = '".$_REQUEST['menuId']."'";
			$link->query($sql);
			$menu = $link->getnext();

			$id = $menu->id;
			$label = $menu->label;
			$links = $menu->link;
			$parent = $menu->parent;
			$sort = $menu->sort;
			$icon = $menu->icon;
			$type = $menu->type;
			$status = $menu->status;

			if($menu->parent > 0){
				// $last = $mysqli->query("SELECT label FROM menu WHERE id = $menu->parent")->fetch_object()->last;
				
				$parSql = "SELECT label FROM menu WHERE id = $menu->parent";
				$result = mysqli_query($GLOBALS["___mysqli_ston"], $parSql);
				while ($row = mysqli_fetch_object($result)) {
					$parentName = $row->label;
				}
	  
			}
	?>
		<div class="app-title">
			<div>
				<h1><i class="fa fa-bars"></i> Edit Menu <?= $label?></h1>
				<p>Menu <?=$row->label?></p>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
				<li class="breadcrumb-item"><a href="index2.php?option=menu"> Menu Manager</a></li>
			</ul>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="tile">

					<form action="" method="post" id="editMenu" name="editMenu">

					<?php if(!empty($message)) { ?>
						<div class="bs-component">
							<div class="alert alert-info" align="center"><h6> <?=$message ?></h6></div>
						</div>
					<?php } ?>

						<div class="tile-body">
							<div class="form-group">
								<label class="control-label">label</label>
								<input name="label" type="text" class="form-control" value="<?= $label ?>">
								<input name="action" type="hidden" id="action" value="editMenu" />
							</div>

							<div class="form-group">
								<label class="control-label">link </label>
								<input name="link" type="text" class="form-control" value="<?= $links ?>">
							</div>

							<div class="form-group">
								<label class="control-label">parent</label>
								<select name="parent" id="" class="form-control">
									<option value="<?=$id?>"><?=$parentName?></option>
									<option value="0">None</option>
									<?php 
										$select_menu = "SELECT * FROM menu";
										$result_menu = mysqli_query($GLOBALS["___mysqli_ston"], $select_menu);
										while($row = mysqli_fetch_object($result_menu)) {
										?>
											<option value="<?= $row->id ?>"><?= $row->label ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">sort</label>
								<input name="sort" type="text" class="form-control" value="<?= $sort ?>">
							</div>

							<div class="form-group">
								<label class="control-label">icon</label>
								<input name="icon" type="text" class="form-control" value="<?= $icon ?>">
							</div>

							<div class="form-group">
								<label class="control-label">type</label>
								<select name="type" id="" class="form-control">
									<?php 
										if($type == 1){
											$typeName = "Request";
										}else if($type == 2){
											$typeName = "Internal";
										}else if($type == 3){
											$typeName = "Server Ip";
										}
									?>
									<option value="<?=$type?>"><?=$typeName?></option>
									<option value="1">Request</option>
									<option value="2">Internal</option>
									<option value="3">Server Ip</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">status</label>
								<select name="status" id="" class="form-control">
									<?php 
										if($status == 0){
											$statusName = "show";
										}else if($status == 1){
											$statusName = "hide";
										}
									?>
									<option value="<?=$status?>"><?=$statusName?></option>
									<option value="0">show</option>
									<option value="1">hide</option>
								</select>
							</div>
						</div>
						<div class="tile-footer">
							<button class="btn btn-primary" type="submit" name="button" id="button"><i class="fa fa-fw fa-lg fa-floppy-o"></i>Save</button>&nbsp;&nbsp;&nbsp;
							<a class="btn btn-secondary" href="#" name="button2" id="button2" onclick="window.location='index2.php?option=menu'"><i class="fa fa-fw fa-lg fa-times"></i>Cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>

	<?php } else if(isset($_REQUEST['action']) && ($_REQUEST['action'] == "add" || $_REQUEST['action'] == "saveAdd" )) { ?>

		<div class="app-title">
			<div>
				<h1><i class="fa fa-bars"></i>Add Menu</h1>
				<p>Menu</p>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
				<li class="breadcrumb-item"><a href="index2.php?option=menu"> Menu Manager</a></li>
			</ul>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="tile">

					<form action="" method="post" id="addmenu" name="addmenu">

					<?php if(!empty($message)) { ?>
						<div class="bs-component">
							<div class="alert alert-info" align="center"><h6> <?=$message ?></h6></div>
						</div>
					<?php } ?>

					<div class="tile-body">
							<div class="form-group">
								<label class="control-label">label</label>
								<input name="label" type="text" class="form-control" value="<?= $label ?>">
								<input name="action" type="hidden" id="action" value="addmenu" />
							</div>

							<div class="form-group">
								<label class="control-label">link </label>
								<input name="link" type="text" class="form-control" >
							</div>

							<div class="form-group">
								<label class="control-label">parent</label>
								<select name="parent" id="" class="form-control">
									<option value="">Select Parent</option>
									<?php 
										$select_menu = "SELECT * FROM menu";
										$result_menu = mysqli_query($GLOBALS["___mysqli_ston"], $select_menu);
										while($row = mysqli_fetch_object($result_menu)) {
									?>
										<option value="<?= $row->id ?>"><?= $row->label ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">sort</label>
								<input name="sort" type="text" class="form-control">
							</div>

							<div class="form-group">
								<label class="control-label">icon</label>
								<input name="icon" type="text" class="form-control">
							</div>

							<div class="form-group">
								<label class="control-label">type</label>
								<select name="type" id="" class="form-control">
									<option value="1">Request</option>
									<option value="2">Internal</option>
									<option value="3">Server Ip</option>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">status</label>
								<select name="status" id="" class="form-control">
									<option value="0">show</option>
									<option value="1">hide</option>
								</select>
							</div>

						</div>
						<div class="tile-footer">
							<button class="btn btn-primary" type="submit" name="button" id="button"><i class="fa fa-fw fa-lg fa-floppy-o"></i>Save</button>&nbsp;&nbsp;&nbsp;
							<a class="btn btn-secondary" href="#" name="button2" id="button2" onclick="window.location='index2.php?option=menu'"><i class="fa fa-fw fa-lg fa-times"></i>Cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>

	<?php } else { ?>

		<div class="app-title">
			<div>
				<h1><i class="fa fa-bars"></i> Menu Manager</h1>
				<p>Menu</p>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
				<li class="breadcrumb-item"><a href="index2.php?option=menu"> Menu Manager</a></li>
			</ul>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="tile">

					<div class="tile-title-w-btn">
						<h3 class="title">Menu</h3>
						<p><a class="btn btn-primary icon-btn" href="index2.php?option=menu&action=add"><i class="fa fa-plus"></i>Add menus</a></p>
					</div>

					<?php if(!empty($message)) { ?>
						<div class="bs-component">
							<div class="alert alert-info" align="center"><h6> <?=$message ?></h6></div>
						</div>
					<?php } ?>

					<div class="tile-body">
						<?php
							$sql = "SELECT * FROM menu"; 
							$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
							if (mysqli_num_rows($result) > 0) {
						?>

						<table class="table table-hover table-bordered" id="sampleTable">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>Path</th>
									<th>Parent</th>
									<th>type</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$counter = 0;
									while($menus = mysqli_fetch_object($result)) { 
									$counter++;
								?>
								<tr>

									<td><?=$counter?></td>
									<td><?= $menus->label ?></td>
									<td><?= $menus->link ?></td>
									<td><?= $menus->parent ?></td>
									<td>
										<?php 
											if($menus->type == 1){
												echo "Request";
											}else if($menus->type == 2){
												echo "Internal";
											}else if($menus->type == 3){
												echo "Server Ip";
											}
										?>
									</td>
									<td>
										<div class="btn-group">
											<a class="btn btn-primary" href="index2.php?option=menu&menuId=<?=$menus->id?>&action=edit"><i class="fa fa-pencil"></i>Edit</a>
											<a class="btn btn-danger" href="index2.php?option=menu&menuId=<?=$menus->id?>&action=delete"><i class="fa fa-trash"></i>Delete</a>
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
						<?php }	?>
					</div>
				</div>
			</div>
		</div>

	<?php }?>