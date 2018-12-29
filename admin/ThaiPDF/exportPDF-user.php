<?php
	require('thaipdfclass.php');
	include("../include/class.mysqldb.php");
	include("../include/config.inc.php");

	function utf8_to_tis620($string) {
	$str = $string;
	$res = "";
	for ($i = 0; $i < strlen($str); $i++) {
		if (ord($str[$i]) == 224) {
		$unicode = ord($str[$i+2]) & 0x3F;
		$unicode |= (ord($str[$i+1]) & 0x3F) << 6;
		$unicode |= (ord($str[$i]) & 0x0F) << 12;
		$res .= chr($unicode-0x0E00+0xA0);
		$i += 2;
		} else {
		$res .= $str[$i];
		}
	} 
	return $res;
	}

	function thaidate($strDate){
		if($str == "0000-00-00") {
			return "NULL";
		}else{
			$date = date_create("$strDate");
			$dateFormated = date_format($date,"Y/m/d");
			return "$dateFormated";
		}
	}

	$footer =  '';
	$header = 'ทดสอบระบบ';

	$pdf=new ThaiPDF();
	$pdf->SetThaiFont();
	$pdf->SetHeader( '', 1, 'R', 1);
	$pdf->SetFooter($footer, 0, 'L', 1);
	$pdf->AddPage();
	$pdf->SetFont('JasmineUPC','B',16); 
	$pdf->SetTextColor(0,0,0);

	foreach($_REQUEST as $key => $value) {
		$$key = $value;
		// $pdf->Ln(10);
		// $pdf->MultiCell(0,7,$key .' => ' . $value,0,'J');
	}
	$end = $numadd;
	$sql = "SELECT * FROM groups WHERE gname = '$group'";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$data = mysqli_fetch_object($result);
	$gdesc = utf8_to_tis620($data->gdesc);

	for($i = 0; $i < $numadd; $i++) {
		if($i % 34 == 0) {
			if($i != 0) { $pdf->AddPage(); }
			$pdf->Cell(0,0,'cat' . $gdesc . ' bat ' . $end . ' Car'   ,0,1,'L');
			$pdf->Ln(7);
			$pdf->SetFont('JasmineUPC','B',14); 
			$pdf->Cell(15,7,'ID',1,0,'C');
			$pdf->Cell(30,7,'Username',1,0,'C');
			$pdf->Cell(30,7,'Password',1,0,'C');
			$pdf->Cell(30,7,'ExpireDate',1,0,'C');
			$pdf->Cell(30,7,'UP DOWNLOAD',1,0,'C');
			$pdf->Cell(0,7,'NOtE',1,0,'C');
			$pdf->Ln(7);	
		}
		$pdf->SetFont('JasmineUPC','',14); 
		$pdf->Cell(15,7,$i+1 . '.',1,0,'C');
		$pdf->Cell(30,7,$username[$i]  ,1,0,'C');
		$pdf->Cell(30,7,$password[$i],1,0,'C');
		$pdf->Cell(30,7,thaidate($data->gexpire) ,1,0,'C');
		$pdf->Cell(30,7,$data->gdownload . '/' . $data->gupload . ' KB' ,1,0,'C');
		$pdf->Cell(0,7,'',1,0,'L');
		$pdf->Ln(7);
	}

	$pdf->Ln(4);
	$pdf->Cell(18,7,'toti: ',0,0,'L');
	$pdf->Cell(0,7,'I am sorry',0,0,'J');
	$pdf->Ln(7);


	if($numadd % 2 != 0) { 
		$numodd = $numadd - 1;
	} else { 
		$numodd = $numadd; 
	}
	$row = 0;
	for($i = 0; $i < $numodd; $i+=2) {
		if($row % 5 == 0) {
			$pdf->AddPage(); 
			$newrow = 0;
		}
		$pdf->Image('001.png',10,20 + $newrow * 50, 92, 50);
		$pdf->SetFont('JasmineUPC','B',16); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',40); 
		$pdf->Text(22,31 + $newrow * 50,'Net Card'); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',30); 
		$pdf->SetXY(20,44 + $newrow * 50);
		$pdf->Cell(50,1, $username[$i] ,0,0,'L');

		$pdf->SetFont('JasmineUPC','',12); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',20); 
		$pdf->SetXY(20,45 + $newrow * 50);
		$pdf->Cell(50,27, thaidate($data->gexpire) ,0,0,'L');
		$pdf->SetFont('JasmineUPC','B',20); 
		$pdf->SetXY(20,45 + $newrow * 50);
		$pdf->Cell(50,14, $password[$i] ,0,0,'L');

		// Next Row

		$pdf->Image('001.png',108,20 + $newrow * 50, 92, 50); 
		$pdf->SetFont('JasmineUPC','B',16); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',40); 
		$pdf->Text(120,31 + $newrow * 50,'Net Card'); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',30); 
		$pdf->SetXY(118,44 + $newrow * 50);
		$pdf->Cell(75,1, $username[$i+1] ,0,0,'L');

		$pdf->SetFont('JasmineUPC','',12); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',20); 
		$pdf->SetXY(118,45 + $newrow * 50);
		$pdf->Cell(75,27, thaidate($data->gexpire) ,0,0,'L');
		$pdf->SetFont('JasmineUPC','B',20); 
		$pdf->SetXY(118,45 + $newrow * 50);
		$pdf->Cell(75,14, $password[$i+1],0,0,'L');

		$row++;
		$newrow++;

	}
	if($numadd % 2 != 0) { 
		if($row % 5 == 0) {
			$pdf->AddPage(); 
			$newrow = 0;
		}
		$pdf->Image('001.png',10,20 + $newrow * 50, 92, 50);
		$pdf->SetFont('JasmineUPC','B',16); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',40); 
		$pdf->Text(22,31 + $newrow * 50,'Net Card'); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',30); 
		$pdf->SetXY(20,44 + $newrow * 50);
		$pdf->Cell(50,1, $username[$i] ,0,0,'L');

		$pdf->SetFont('JasmineUPC','',12); 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('JasmineUPC','B',20); 
		$pdf->SetXY(20,45 + $newrow * 50);
		$pdf->Cell(50,27, thaidate($data->gexpire) ,0,0,'L');
		$pdf->SetFont('JasmineUPC','B',20); 
		$pdf->SetXY(20,45 + $newrow * 50);
		$pdf->Cell(50,14, $password[$i] ,0,0,'L');

	}
	$pdf->Output();
?>
