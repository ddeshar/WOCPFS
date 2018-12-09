<?php
include("include/class.testlogin.php");
?>
<?

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
	$message = "บันทึกข้อมูลของคุณเรียบร้อยแล้ว <br>และคุณจะสามารถใช้ในการล็อกอินเข้าอินเทอร์เน็ตได้ทันที";
			
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Burapha Linux Laboratory" />
	<meta name="keywords" content="authentication system" />
	<meta name="description" content="Burapha Linux Authentication Project" />	
    <link href="css/main.css" type=text/css rel=stylesheet>
    <link href="css/calendar-mos.css" type=text/css rel=stylesheet>
    <script language="javascript" src="js/calendar.js"></script>
<script>
function stoperror(){
return true
}
window.onerror=stoperror
</script>
	<title>-:- Registrat!on -:-</title>
</head>
<body>
    <div id="content">
    	<a href="register_excel.php">    	</a>
    	<table width="95%" border="0" cellpadding="0" cellspacing="10" class="header">
          <tr>
            <td align="center"><img src="images/BlackNeonAgua_224.png" alt="" width="59" height="60" /></td>
            <td width="94%"><a href="index2.php?option=register_excel">Generate <span class="gray">Users Excel[</span><span class="headrow">.xls</span><span class="gray">]</span></a><br />
            <span class="normal">เพิ่มผู้ใช้งานรายใหม่เข้าสู่ระบบจากไฟล์ Excel </span></td>
            <td align="right">&nbsp;</td>
          </tr>
        </table>
   	    <form action="" method="post" name="regis" enctype="multipart/form-data">
 
    	  <table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td colspan="2" align="center"><?php 
	if(!empty($message)) { echo "<BR>".$message; } 
?>&nbsp;</td>
      </tr>
            
          <?php if(!empty($message)) {  ?>
              <tr>
                <td colspan="2" align="center"><BR /><input name="" type="button" class="button" value="หน้าแรก" onclick="window.location='?option=register_excel'" style="cursor:hand" /></td>
              </tr>
            <?php } ?>
	<?php if(empty($message)) { ?>

            <?php if($error[0]) { ?>
            <?php } ?>
            <?php if($error[1]) { ?>
            <?php } ?>
            <?php if($error[2]) { ?>
            <?php } ?>
            <?php if($error[3]) { ?>
            <?php } ?>
            <?php if($error[4]) { ?>
            <?php } ?>
            <?php if($error[5]) { ?>
	<?php } ?>
              
           <?php if($error[6]) { ?>
 			<?php } ?>
 
               <tr>
                <td align="right">เลือกกลุ่ม : &nbsp;</td>
                <td><select name="selectG" class="inputbox-normal">
				<?
				$sql1 = "select * from groups  order by gdesc"; 
	  			$result1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
				while($group1 = mysqli_fetch_object($result1)) { 
				?>
                  <option value="<?=$group1->gname?>"><?=$group1->gdesc?></option>
				  <?
				  }
				?>
                </select>
                <span class="black">
                *ระบุกลุ่มให้ถูกต้อง  </span></td>
              </tr>
               <tr>
                <td width="21%" align="right">File Excel :</td>
                <td width="79%"><label>
                  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                  <input name="file" type="file" />
                  <span class="red">*</span></label></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td class="comment">ต้องเป็นไฟล์ Excel ที่มีนามสกุล .xls Download ไฟล์ ตัวอย่าง<a href="account.xls" target="_blank"> Excel(xls)</a></td>
            </tr>
           <?php if($error[7]) { ?>
            <?php } ?>
           <?php if($error[8]) { ?>
            <?php } ?>
           <?php if($error[9]) { ?>
            <?php } ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td><label>
                  <input type="submit" name="button" id="button" class="button" value="บันทึกข้อมูล">
                </label></td>
              </tr>
             <?php } ?>
              <tr>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>   
	</form>
    <div id="footer">
            
    </div>

    </div>
</body>
</html>
