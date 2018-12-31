<?php
	/*####################################################
	WOCPFS - Wame On Code Pfsense Radius Auth
	Copyright (C) 2018 Mr.Dipendra Deshar
	E-Mail: jedeshar@gmail.com Homepage: http://ddeshar.com.np
  #####################################################*/

	include("include/class.testlogin.php");
	foreach($_REQUEST as $key => $value)  {
		$$key = $value;
	}
	$error = array();
	for($i = 0; $i < 20; $i++) {
		$error[$i] = false;
	}
	if(isset($button)) {
		
		if ( $_FILES['file']['error'] ) { 
        		die("upload error "); 
    		} else{
								/** PHPExcel */
				require_once 'Classes/PHPExcel.php';
				
				/** PHPExcel_IOFactory - Reader */
				include 'Classes/PHPExcel/IOFactory.php';
				
				
				$inputFileName = $_FILES['file']['tmp_name'];  
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
				$objReader->setReadDataOnly(true);  
				$objPHPExcel = $objReader->load($inputFileName);  
				
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
				$highestRow = $objWorksheet->getHighestRow();
				$highestColumn = $objWorksheet->getHighestColumn();
				
				$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
				$headingsArray = $headingsArray[1];
				
				$r = -1;
				$namedDataArray = array();
				for ($row = 2; $row <= $highestRow; ++$row) {
					$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
					if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
						++$r;
						foreach($headingsArray as $columnKey => $columnHeading) {
							$namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
						}
					}
				}
				
				//$objConnect = mysql_connect("localhost","root","123456") or die(mysql_error());
				//$objDB = mysql_select_db("myradius_db");
				//$i = 0;
				foreach ($namedDataArray as $result) {
						$i++;
						$strSQL = "";
						$strSQL .= "INSERT INTO account ";
						$strSQL .= "VALUES ";
						$strSQL .= "('".$result["username"]."','".substr(($result["password"]),0,15)."' ";
						$strSQL .= ",'".$result["firstname"]."','".$result["lastname"]."' ";
						$strSQL .= ",'".$result["mailaddr"]."','".date("Y-m-d H:i:s")."' ";
						$strSQL .= ",'clear','1')";
						//echo $strSQL;
						mysqli_query($GLOBALS["___mysqli_ston"], $strSQL) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
						//echo "Row $i Inserted...<br>";
						$sql = "INSERT INTO radcheck VALUES(NULL,'".$result["username"]."','Cleartext-Password',':=','".substr(($result["password"]),0,15)."')";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						
						$sql = "INSERT INTO radusergroup VALUES " . "('".$result["username"]."','".$_REQUEST['selectG']."','1')";
						mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				}		
			$message ="<div class=\"alert alert-success\"><strong>บันทึกข้อมูลของคุณเรียบร้อยแล้ว </strong>คุณสามารถใช้งานระบบได้ทันทีครับ</div>";
			
			/*	
				
			$sql = "SELECT * FROM configuration where variable = 'default_regis_status'";
			//echo $sql;
			$link->query($sql);
			$conf = $link->getnext();
			//echo $conf->value;
			$sql = "INSERT INTO account VALUES "
			     . "('$username','".substr(md5($password),0,15)."',"
			     . "'$firstname', '$lastname', '$mailaddr',"
			     . "'".date("Y-m-d H:i:s")."', 'md5','".$conf->value."')";
			//echo $sql;
			$link->query($sql);
			
			
	
			$sql = "INSERT INTO radcheck VALUES (NULL, '$username', 'Cleartext-Password', '==', '".substr(md5($password),0,15)."')";
			mysql_query($sql);
			$sql = "INSERT INTO radusergroup VALUES "
				 . "('$username','".$_REQUEST['selectG']."','1')";
			//echo $sql;
			$link->query($sql);
			if($conf->value) {
				$message = "บันทึกข้อมูลของคุณเรียบร้อยแล้ว คุณสามารถใช้งานระบบได้ทันทีครับ";
			} else {
				$message = "บันทึกข้อมูลของคุณเรียบร้อยแล้ว <br>แต่คุณจะสามารถใช้งานได้ก็ต่อเมื่อได้รับอนุญาตจากผู้ดูแลระบบแล้วเท่านั้น";
			}
			*/
	
		}
	}
?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-file-excel-o"></i> เพิ่มผู้ใช้งานรายใหม่เข้าสู่ระบบจากไฟล์ Excel</h1>
        <p>	Generate Users Excel[.xls]</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="index2.php"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="index2.php?option=register_excel">เพิ่มผู้ใช้งานรายใหม่เข้าสู่ระบบจากไฟล์ Excel</a></li>
    </ul>
</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="bs-component">
				<?php 
					if(!empty($message)) { echo "<BR>".$message; }
					if(!empty($message)) {  
				?>
					<input name="" type="button" class="btn btn-secondary" value="หน้าแรก" onclick="window.location='?option=register_excel'" style="cursor:hand" />
				<?php } ?>
			</div>
		</div>

		<?php
			if(empty($message)) {
			if($error[0]) {}
			if($error[1]) {}
			if($error[2]) {}
			if($error[3]) {}
			if($error[4]) {}
			if($error[5]) {}
			if($error[6]) {} 
		?>

			<div class="col-md-6">
				<div class="tile">
					<!-- <h3 class="tile-title">เพิ่มผู้ใช้งานรายใหม่เข้าสู่ระบบจากไฟล์ Excel</h3> -->
					<form action="" method="post" name="regis" enctype="multipart/form-data">
					<div class="tile-body">
						<div class="form-group">
							<label for="exampleSelect1">เลือกกลุ่ม</label>
							<select name="selectG" class="form-control" id="exampleSelect1" required>
								<?php
									$sql1 = "SELECT * FROM groups ORDER BY gdesc"; 
									$result1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
									while($group1 = mysqli_fetch_object($result1)) { 
								?>
								<option value="<?=$group1->gname?>"><?=$group1->gdesc?></option>
								<?php } ?>
							</select>
						</div>

						<?php 
							if($error[7]) {}
							if($error[8]) {}
							if($error[9]) {} 
						?>

						<div class="form-group">
							<label for="exampleInputFile">File Excel</label>
							<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
							<input class="form-control-file" id="exampleInputFile" type="file" aria-describedby="fileHelp" name="file">
							<small class="form-text text-muted" id="fileHelp">ต้องเป็นไฟล์ Excel ที่มีนามสกุล .xls Download ไฟล์ ตัวอย่าง<a href="account.xls" target="_blank"> Excel(xls)</a></small>
						</div>

					</div>
					<div class="tile-footer">
						<button class="btn btn-primary" type="submit" name="button" id="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึกข้อมูล</button>
					</div>
					</form>
				</div>
			</div>
		<?php } ?>
	</div>