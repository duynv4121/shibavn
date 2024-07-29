<?php
@session_start();
	include("../excel/PHPExcel.php");
	include("../conn/db.php");
	include("../controller/bill.php");


$objExcel = new PHPExcel;
$objExcel->setActiveSheetIndex(0);
$sheet = $objExcel->getActiveSheet()->setTitle('Export ');
$rowCount = 16;

$iddebit = $_GET['id'];



if(isset($_GET['id']))
{
$result = mysqli_query($conn,"select * from ksn_debit_detail where id_debit='".$iddebit."'")or die("Loi 1");
}
$dulieudebit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_debit WHERE id ='".$iddebit."'")) or die("Loi 44");
echo $dulieudebit['idkhachhang'];
$dulieunguoitao = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id='".$dulieudebit['uid']."'")) or die(mysqli_error());
$dulieukhachhang = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE cus_code='".$dulieudebit['idkhachhang']."'")) or die(mysqli_error());

$nguoigui = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_customer WHERE cus_code='".$dulieukhachhang['cus_code']."'"));
$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$nguoigui['ward_id']."'"));
$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$nguoigui['province_id']."'"));
$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$nguoigui['district_id']."'"));
	


function string_mod($string_mod,$conn)
{
$string_moda = mysqli_fetch_assoc(mysqli_query($conn,"SELECT string_ksn FROM ksn_string_mod where string_mod='$string_mod'"))or die("Loi 2");
return $string_moda['string_ksn'];
}

// $makhvalue = mysql_fetch_assoc(mysql_query("select * from cyl_khachhang where id = '".$makh."'"));

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('logo');
$objDrawing->setDescription('logo');
$objDrawing->setPath('logo-export.png');
$objDrawing->setCoordinates('A1');                      
	//setOffsetX works properly
$objDrawing->setOffsetX(80); 
$objDrawing->setOffsetY(60);                
	//set width, height
$objDrawing->setWidth(200); 
$objDrawing->setHeight(65); 
$objDrawing->setWorksheet($objExcel->getActiveSheet());

				
$styleArray = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => 'FF0000'),
		'size'  => 13,
		'name'  => 'Verdana'
	));

$objExcel->getActiveSheet()->mergeCells('E1:L1');
$objExcel->getActiveSheet()->mergeCells('A1:D6');
$objExcel->getActiveSheet()->mergeCells('M1:R6');
$objExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
$sheet->setCellValue('E1','GPE LOG TRANS CO.,LTD')->getStyle('E1')->applyFromArray($styleArray);

	//
$styleArray1 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => '000000'),
		'size'  => 9,
		'name'  => 'Verdana'
	));

$objExcel->getActiveSheet()->mergeCells('E2:L2');
$objExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(15);
$sheet->setCellValue('E2',string_mod('debit_string_1',$conn))->getStyle('E2')->applyFromArray($styleArray1);


$styleArray2 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => '000000'),
		'size'  => 9,
		'name'  => 'Verdana'
	));

$styletotal = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => '000000'),
		'size'  => 9,
		'name'  => 'Verdana'
	));


$styletotalz = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => '000000'),
		'size'  => 9,
		'name'  => 'Verdana'
	));


$objExcel->getActiveSheet()->mergeCells('E3:L3');
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
$sheet->setCellValue('E3',string_mod('debit_string_2',$conn))->getStyle('E3')->applyFromArray($styleArray1);



$objExcel->getActiveSheet()->mergeCells('E4:L4');
$objExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);
$sheet->setCellValue('E4',string_mod('debit_string_3',$conn))->getStyle('E4')->applyFromArray($styleArray1);

$objExcel->getActiveSheet()->mergeCells('E5:L5');
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
$sheet->setCellValue('E5',string_mod('debit_string_4',$conn))->getStyle('E5')->applyFromArray($styleArray1);

$objExcel->getActiveSheet()->mergeCells('E6:L6');
$objExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(15);
$sheet->setCellValue('E6','Prepared by '.$dulieunguoitao['ten'])->getStyle('E6')->applyFromArray($styleArray2);


$styleArray3 = array(
	'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER

	),
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => '000000'),
		'size'  => 15,
		'name'  => 'Verdana'
	));
$styleArraytotal = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => 'FF0000'),
		'size'  => 11,
		'name'  => 'Verdana'
	));
	
	

$objExcel->getActiveSheet()->mergeCells('B10:I10');	
$objExcel->getActiveSheet()->mergeCells('B11:I11');	
$objExcel->getActiveSheet()->mergeCells('B12:I12');	
$objExcel->getActiveSheet()->mergeCells('B13:I13');	
$objExcel->getActiveSheet()->mergeCells('B14:I14');	
//$objExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(35);
$sheet->setCellValue('M1','PAYMENT NOTIFICATION')->getStyle('M1')->applyFromArray($styleArray3);
$sheet->setCellValue('B9','Bill To ')->getStyle('B9')->applyFromArray($styleArray2);;
$sheet->setCellValue('B10','Customer: '.$dulieukhachhang['congty']);
$sheet->setCellValue('B11','Adress: '.$dulieukhachhang['diachi'].','.$ward['name'].','.$district['name'].','.$province['name']);
$sheet->setCellValue('B12','VAT/CODE: '.$dulieukhachhang['mst']);
$sheet->setCellValue('B13','Tel/Fax No: '.$dulieukhachhang['phone']);
$sheet->setCellValue('B14','Contact Name: '.$dulieukhachhang['ten']);





$objExcel->getActiveSheet()->mergeCells('M10:P10');	
$objExcel->getActiveSheet()->mergeCells('M11:P11');	
$sheet->setCellValue('M10','NO: '.$dulieudebit['debitno']);
$sheet->setCellValue('M11','DATE TIME: '.$dulieudebit['datetime']);
$sheet->setCellValue('M12','CREDIT TERM: '.congnoa($dulieukhachhang['payment_type']));
$sheet->setCellValue('M13','CURRENCY: VND');

$objExcel->getActiveSheet()->setShowGridlines(False);

// $styleArray4 = array(
// 	'alignment' => array(
// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
// 	),
// 	'font'  => array(
// 		'bold'  => false,
// 		'color' => array('rgb' => '000000'),
// 		'size'  => 8,
// 		'name'  => 'Verdana'
// 	));

// $objExcel->getActiveSheet()->mergeCells('H9:M9');
// $objExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(15);
// $sheet->setCellValue('H10','Từ ngày '.$trip_startmakh.' đến ngày '.$trip_endmakh)->getStyle('H10')->applyFromArray($styleArray4);


// $styleArray5 = array(
// 	'alignment' => array(
// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
// 	),
// 	'font'  => array(
// 		'bold'  => true,
// 		'color' => array('rgb' => '000000'),
// 		'size'  => 10,
// 		'name'  => 'Verdana'
// 	));



// $objExcel->getActiveSheet()->mergeCells('J10:L10');
// $objExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(15);
// $sheet->setCellValue('J10','Mã Khách Hàng: '.$makhvalue['ma_kh'])->getStyle('J10')->applyFromArray($styleArray5);
		
		
		$sheet->setCellValue('A'.$rowCount,'DATE');
		$sheet->setCellValue('B'.$rowCount,'KG BILL NO');
		$sheet->setCellValue('C'.$rowCount,'TRACKING');
		$sheet->setCellValue('D'.$rowCount,'COMPANY NAME');
		$sheet->setCellValue('E'.$rowCount,'CONTACT NAME');
		$sheet->setCellValue('F'.$rowCount,'SERVICE');
		$sheet->setCellValue('G'.$rowCount,'BRAND');
		$sheet->setCellValue('H'.$rowCount,'STATE');
		$sheet->setCellValue('I'.$rowCount,'DESTINATION');
		$sheet->setCellValue('J'.$rowCount,'Q\'TY PACKAGES');
		$sheet->setCellValue('K'.$rowCount,'HAWB#');
		$sheet->setCellValue('L'.$rowCount,'TYPE');
		$sheet->setCellValue('M'.$rowCount,'CHARGEABLE WEIGHT');
		$sheet->setCellValue('N'.$rowCount,'TOTAL VALUE');
		$sheet->setCellValue('O'.$rowCount,'SUR CHANGE');
		$sheet->setCellValue('P'.$rowCount,'VAT');
		$sheet->setCellValue('Q'.$rowCount,'TOTAL PRICE');
		$sheet->setCellValue('P'.$rowCount,'VAT');
		$sheet->setCellValue('R'.$rowCount,'DESCRIPTION OF GOODS');

$stt = 0;
	$total = 0;
	$totalextra = 0;
	$totalnang = 0;
	$extraprice=0;		
	$totalprice = 0;
	$sokienlon = 0;
	$sokiennho = 0;
	
	$totalvat = 0;
	$total_discount = 0;
while($row  = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$sokienlon +=1;
	$result2 = mysqli_query($conn,"select * from ns_package where id_code='".$row['id_code']."'")or die("Loi");
	$result2a = mysqli_fetch_assoc($result2);
	$rowCount++;

	echo $result2a['id_nguoigui'];


	$totalkien = 0;
	$note ='';
	echo $result2a['date'];

	$laydulieuaz = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where (DATE(date_start) <='".$result2a['date']."') AND (DATE(date_end) >='".$result2a['date']."')"))or die(mysqli_error($conn));;
	$banggiaapdung = $laydulieuaz['bang_gia'];
	
	
	$layhoadonadd = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$result2a['id']."' and status <> '0'")or die("Loi 3");
	$sender = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$result2a['id_nguoigui']."'")) ;
    $receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$result2a['id_nguoinhan']."'")) ;
	$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name,iso2 from ns_countries where id='".$receiver['country_id']."'"));
	
	@$dulieudiscount = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_discount WHERE id_dichvu='".$result2a['kg_dichvu']."' AND uid='".$dulieukhachhang['id']."' AND (DATE(date_start) <='".$result2a['date']."') AND (DATE(date_end) >='".$result2a['date']."') LIMIT 1"));

	

	$sheet->setCellValue('A'.$rowCount,$result2a['date']);
	$sheet->setCellValue('B'.$rowCount,$result2a['id_code']);
	$sheet->setCellValue('D'.$rowCount,$receiver['company_name']);
	$sheet->setCellValue('E'.$rowCount,$receiver['name']);
	$sheet->setCellValue('F'.$rowCount,dichvu($conn,$result2a['kg_dichvu']));
	$sheet->setCellValue('G'.$rowCount,$result2a['kg_chinhanh']);
	$sheet->setCellValue('H'.$rowCount,$receiver['state']);
	$sheet->setCellValue('I'.$rowCount,$dulieuquocgia['name'].'-'.$dulieuquocgia['iso2']);
	$total_weight = 0;
	
	$checksokien = mysqli_num_rows($layhoadonadd);
	if($checksokien < 1)
	{
		
		$laydulieu = mysqli_fetch_assoc($layhoadonadd);
		$sheet->setCellValue('K'.$rowCount,'ID:'.$laydulieu['id_code']);
		$sheet->setCellValue('J'.$rowCount,mysqli_num_rows($layhoadonadd));
		$sheet->setCellValue('L'.$rowCount,'SPX');
		$sheet->setCellValue('M'.$rowCount,$laydulieu['charge_weight']);	
		if($laydulieu['charge_weight'] < 21)
		{
		$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select name from ".$banggiaapdung." where id='".$result2a['kg_dichvu']."'"));
		
		}
	}
	else
	{
	$phuthukien = 0;
	$countkien = 0;
	while($laydulieu = mysqli_fetch_array($layhoadonadd,MYSQLI_ASSOC))
	{	
	$sokiennho +=1;
	$countkien +=1;
	
	if($countkien == 1)
	{		$sheet->setCellValue('J'.$rowCount,mysqli_num_rows($layhoadonadd));

	}
	$sheet->setCellValue('K'.$rowCount,'ID:'.$laydulieu['id_code']);
	
	$sheet->setCellValue('L'.$rowCount,'SPX');
	$sheet->setCellValue('M'.$rowCount,$laydulieu['charge_weight']);
	
	$phuthu = 0;
	
	/****** LIST phụ thu */
	$stringphuthu = '';
	$listhoadonphuthua = mysqli_query($conn,"select * from kns_listhoadonphuthu where id_code='".$laydulieu['id_code']."'");
	while($listhoadonphuthu = mysqli_fetch_array($listhoadonphuthua))
	{
	$stringphuthu.= $listhoadonphuthu['tenphuthu'].'['.$listhoadonphuthu['soluong'].'] ';
	$phuthu+=$listhoadonphuthu['soluong']*$listhoadonphuthu['price'];
	}
	$sheet->setCellValue('O'.$rowCount,$phuthu);

	$sheet->setCellValue('R'.$rowCount,$stringphuthu);

	$total_weight = ($total_weight+$laydulieu['charge_weight']);

	$phuthukien+=$phuthu;
	if($checksokien == 1)
	{
		
	}
	else
	{
	$rowCount++;

	}
	}
	
	$totalprice+=$phuthukien;
	$sheet->getStyle('M'.($rowCount).':Q'.($rowCount))->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'FFFF00') ) ) );
	
	
	// Lọc theo chi nhanh và user_error
	if($dulieukhachhang['payment_price_type'] == 1)
	{
		if($result2a['kg_chinhanh'] == "HCM")
		{
			$bang_gia = 'price_hcm_f1'; 
		}
		else if($result2a['kg_chinhanh'] == "HN")
		{
			$bang_gia = 'price_hn_f0'; 

		}else if($result2a['kg_chinhanh'] == "DAD")
		{
			$bang_gia = 'price_dn_f0'; 

		}
	}
	else
	{
		if($result2a['kg_chinhanh'] == "HCM")
		{
			$bang_gia = 'price'; 
		}
		else if($result2a['kg_chinhanh'] == "HN")
		{
			$bang_gia = 'price_hn_f0'; 

		}else if($result2a['kg_chinhanh'] == "DAD")
		{
			$bang_gia = 'price_dn_f0'; 

		}
	}
	
	// Tính VAT theo từng kiện tổng 
	
	// lamf tron total weight neu lon hon 21
	
	if($total_weight > 20.5)
				{
						$total_weight = ceil($total_weight);
				}
	
	//* Tinh Gia DICH VU KSN-AU , KSN-AU 2, KSN-AU EXPRESS
	if($result2a['kg_dichvu'] == 1 || $result2a['kg_dichvu'] == 2 || $result2a['kg_dichvu'] == 24)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));
		$laydulieuremote = mysqli_query($conn,"select * from ksn_au_remote where post_code='".trim($receiver['post_code'])."'");			

		if(mysqli_num_rows($laydulieuremote) >= 1)
		{
			$note = 'remote';

		}
		else
		{
			$note = 'metro';

		}

		if($total_weight < 21)
		{
		
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight' AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			
		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;

		}
		
	}
	
	//* Tinh Gia DICH VU KSN-NZD
	else if($result2a['kg_dichvu'] == 4)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));
		$note = 'other';
		if($dulieucity['name'] == "Auckland")
		{
			$note = 'Auckland';

		}
		else
		{
			$note = 'other';

		}
		if (strstr(strtoupper($receiver['address']), 'AUCKLAND')) {
			$note = 'Auckland';
		}
		if (strstr(strtoupper($receiver['state']), 'AUCKLAND')) {
			$note = 'Auckland';
		}if (strstr(strtoupper($receiver['state']), 'AUK')) {
			$note = 'Auckland';
		}
		if (strstr(strtoupper($receiver['address2']), 'AUCKLAND')) {
			$note = 'Auckland';
		}
		if (strstr(strtoupper($receiver['address3']), 'AUCKLAND')) {
			$note = 'Auckland';
		}
		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight' AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
			
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	
	//* Tinh Gia DICH VU KSN-CANADA,KSN-UK,ksn-US,KSN-US NDA,KSN-SIN,KSN-AUE  |||| US-KM,USF-KM,KSN-US3
	else if($result2a['kg_dichvu'] == 13 || $result2a['kg_dichvu'] == 14 || $result2a['kg_dichvu'] == 7|| $result2a['kg_dichvu'] == 9|| $result2a['kg_dichvu'] == 10 || $result2a['kg_dichvu'] == 11 || $result2a['kg_dichvu'] == 28 || $result2a['kg_dichvu'] == 30 || $result2a['kg_dichvu'] == 31|| $result2a['kg_dichvu'] == 32|| $result2a['kg_dichvu'] == 33)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));

		
	

		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia];
						$check_price = 1;

		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100' "));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300' "));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	//* Tinh Gia DICH VU KSN-EU
	else if($result2a['kg_dichvu'] == 12)
	{
		
		
		if($dulieuquocgia['name'] == 'Netherlands')
		{
			$note='KSNEU1';
		}
		else if($dulieuquocgia['name'] == 'Luxembourg' || $dulieuquocgia['name'] == 'Germany'|| $dulieuquocgia['name'] == 'Belgium')
		{
			$note='KSNEU2';
		}else if($dulieuquocgia['name'] == 'France' )
		{
			$note='KSNEU3';
		}else if($dulieuquocgia['name'] == 'Spain' || $dulieuquocgia['name'] == 'Portugal' || $dulieuquocgia['name'] == 'Austria' || $dulieuquocgia['name'] == 'North Ireland'|| $dulieuquocgia['name'] == 'Italy' )
		{
			$note='KSNEU4';
		}else if($dulieuquocgia['name'] == 'Finland'|| $dulieuquocgia['name'] == 'Denmark'  || $dulieuquocgia['name'] == 'Sweden'   || $dulieuquocgia['name'] == 'Scotland'  || $dulieuquocgia['name'] == 'Wales'   )
		{
			$note='KSNEU5';
		}else if($dulieuquocgia['name'] == 'Croatia'|| $dulieuquocgia['name'] == 'Estonia'  || $dulieuquocgia['name'] == 'Greece'   || $dulieuquocgia['name'] == 'Hungary'  
		|| $dulieuquocgia['name'] == 'Ireland'  || $dulieuquocgia['name'] == 'Latvia' || $dulieuquocgia['name'] == 'Lithuania' || $dulieuquocgia['name'] == 'Poland' || $dulieuquocgia['name'] == 'Romania' 
		|| $dulieuquocgia['name'] == 'Slovakia' || $dulieuquocgia['name'] == 'Slovenia' || $dulieuquocgia['name'] == 'Czech Republic'  || $dulieuquocgia['name'] == 'Bulgaria'   )
		{
			$note='KSNEU6';
		}
		else if($dulieuquocgia['name'] == 'Norway' ||  $dulieuquocgia['name'] == 'Andorra' ||  $dulieuquocgia['name'] == 'Jersey' ||  $dulieuquocgia['name'] == 'Guernsey'||  $dulieuquocgia['name'] == 'Liechtenstein'
		||  $dulieuquocgia['name'] == 'San Marino'||  $dulieuquocgia['name'] == 'Switzerland')
		{
			$note='KSNEU7';
		}
		
		


		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight' AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia];
						$check_price = 1;

		}
		else if($total_weight >= 21 && $total_weight < 50 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}
		
	}
	
	//KSN-US2
	else if($result2a['kg_dichvu'] == 8)
	{
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));

		if($dulieucity['name'] == "California" || $dulieucity['name'] == "New California"|| $dulieucity['name'] == "California City")
		{
			$note = 'California';

		}
		else
		{
			$note = 'other';

		}
		
		if (strstr(strtoupper($receiver['state']), 'CA')) {
			$note = 'California';
		}
		if (strstr(strtoupper($receiver['address']), 'CALIFORNIA')) {
			$note = 'California';
		}
		if (strstr(strtoupper($receiver['address2']), 'CALIFORNIA')) {
			$note = 'California';
		}
		if (strstr(strtoupper($receiver['address3']), 'CALIFORNIA')) {
			$note = 'California';
		}
		
		
		if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
		
	}
	
	
	//US2-KM
	else if($result2a['kg_dichvu'] == 29)
	{
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));

		if($dulieucity['name'] == "California" || $dulieucity['name'] == "New California"|| $dulieucity['name'] == "California City")
		{
			$note = 'US2KM';

		}
		else
		{
			$note = 'US2KM';

		}
		
		
		if (strstr(strtoupper($receiver['state']), 'CA')) {
			$note = 'US2KM';
		}
		if (strstr(strtoupper($receiver['address']), 'CALIFORNIA')) {
			$note = 'US2KM';
		}
		if (strstr(strtoupper($receiver['address2']), 'CALIFORNIA')) {
			$note = 'US2KM';
		}
		if (strstr(strtoupper($receiver['address3']), 'CALIFORNIA')) {
			$note = 'US2KM';
		}
		
		if($total_weight >= 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;
		}
		
		
	}
	
	//KSN-AU-SEA

	else if($result2a['kg_dichvu'] == 3)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));
		$laydulieuremote = mysqli_query($conn,"select * from ksn_au_remote where post_code='".trim($receiver['post_code'])."'");			

		if(mysqli_num_rows($laydulieuremote) >= 1)
		{
			$note = 'remote';

		}
		else
		{
			$note = 'metro';

		}
		
		
		 if($total_weight >= 21 && $total_weight < 50 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 50 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )

		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 300)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}
		
	}
	
	
	//KSN-DUBAI-SEA

	else if($result2a['kg_dichvu'] == 26)
	{
		
		$note = 'dubaisea';

		
		 if($total_weight >= 21 && $total_weight < 50 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;


		}else if($total_weight >= 50 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )

		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight >= 300)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
									$check_price = 2;

		}
		
	}
	
	
	
	//* Tinh Gia DICH VU KSN-PH
	else if($result2a['kg_dichvu'] == 27)
	{
		
		@$dulieustate = mysqli_fetch_assoc(mysqli_query($conn,"select name,note from zone_ph where name='".$receiver['state']."'"));

		if(@$dulieustate['note'] != "")
		{
			$note = trim(@$dulieustate['note']);
		}
		else
		{
			$note = 'KSNPH3';
		}

		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight' AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia];
			$check_price = 1;
			
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
			$check_price = 2;
			

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;

						$check_price = 2;

		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$banggiaapdung." where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300'  AND note='$note'"));
			$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu[$bang_gia]*$total_weight;
						$check_price = 2;

		}
		
	}
	
	
	
	
	
	
	
	}
			
			
			//Discount
			if($total_weight >= 21 and $total_weight < 50)
			{
				$discount = @$dulieudiscount['d_m_21']*$total_weight ;
				$total_discount += $discount;
				if($discount > 0)
				{
				$sheet->setCellValue('R'.$rowCount,'Discount: -'.$discount);
				}
			}
			else if($total_weight >= 50 && $total_weight < 100)
			{
				$discount = @$dulieudiscount['d_m_45']*$total_weight ;
				$total_discount += $discount;
				if($discount > 0)
				{
				$sheet->setCellValue('R'.$rowCount,'Discount: -'.$discount);
				}

			}else if($total_weight >= 100)
			{
				$discount = @$dulieudiscount['d_m_100']*$total_weight ;
				$total_discount += $discount;
				if($discount > 0)
				{
				$sheet->setCellValue('R'.$rowCount,'Discount: -'.$discount);
				}
				

			}
			
			
			@$dulieudiscount_id = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_discount_package where id_package='".$result2a['id_code']."'"));
			if(@$dulieudiscount_id['price_discount'] > 0)
			{
				$total_discount += @$dulieudiscount_id['price_discount'];
				$sheet->setCellValue('S'.$rowCount,'Discount: -'.number_format(@$dulieudiscount_id['price_discount']).' đ');

			}
		
			
			
			
			$totalvat_kien = 0;
			//Check VAT
			if($dulieudebit['vat'] == 1)
			{
				
				
				if($check_price == 1)
				{
					$totalvat_kien = ($dulieugiadichvu[$bang_gia])*8/100;
					$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]+$phuthukien+$totalvat_kien));
					
					$sheet->setCellValue('N'.$rowCount,($totalvat_kien));


				}else if($check_price == 2)
				{
					$totalvat_kien = ($dulieugiadichvu[$bang_gia]*$total_weight)*8/100;
					$sheet->setCellValue('Q'.$rowCount,number_format($dulieugiadichvu[$bang_gia]*$total_weight+$phuthukien+$totalvat_kien));
					$sheet->setCellValue('N'.$rowCount,($totalvat_kien));

				}
				
				$totalvat += $totalvat_kien;

			}
			else
			{
				
			}
		
			if($check_price == 1)
			{
				$giakienhang = $dulieugiadichvu[$bang_gia];
			}
			else if($check_price == 2)
			{
				$giakienhang = $dulieugiadichvu[$bang_gia]*$total_weight;
			}
			$sheet->setCellValue('M'.$rowCount,$total_weight);
			$sheet->setCellValue('N'.$rowCount,number_format($giakienhang));
			$sheet->setCellValue('O'.$rowCount,$phuthukien);
		
			
			mysqli_query($conn,"UPDATE `ns_package` SET `khach_cuocbay`='$giakienhang', `khach_phuthu`='$phuthukien', `vat`='$totalvat_kien' WHERE (`id`='".$result2a['id']."')");
			
			
			
			### thêm giá vô package
			
	
	
	
	
}
	
		$rowCount++;
		
		
			
			//$sheet->setCellValue('N'.$rowCount,number_format($totalvat))->getStyle('O'.$rowCount)->applyFromArray($styletotal);;
			$sheet->setCellValue('Q'.$rowCount,number_format($totalprice+$totalvat))->getStyle('Q'.$rowCount)->applyFromArray($styletotal);
			$sheet->setCellValue('A'.$rowCount,'Total')->getStyle('A'.$rowCount)->applyFromArray($styleArray3);
			$objExcel->getActiveSheet()->mergeCells('A'.$rowCount.':'.'P'.$rowCount);
			$sheet->getStyle('A'.$rowCount.':'.'P'.$rowCount)->applyFromArray(array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			));$sheet->getStyle('Q'.$rowCount.':'.'Q'.$rowCount)->applyFromArray(array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			));
				

			if($total_discount > 0 )
			{		
				$rowCount++;

				$sheet->setCellValue('Q'.$rowCount,number_format($total_discount))->getStyle('O'.$rowCount)->applyFromArray($styletotal);
				$sheet->setCellValue('A'.$rowCount,'Discount')->getStyle('A'.$rowCount)->applyFromArray($styleArray3);
				$objExcel->getActiveSheet()->mergeCells('A'.$rowCount.':'.'P'.$rowCount);
				$rowCount++;
		
		
			
				//$sheet->setCellValue('N'.$rowCount,number_format($totalvat))->getStyle('O'.$rowCount)->applyFromArray($styletotal);;
				$sheet->setCellValue('Q'.$rowCount,number_format(($totalprice+$totalvat)-$total_discount))->getStyle('O'.$rowCount)->applyFromArray($styletotal);;
			
			}
			
			
			
		if($dulieudebit['checkthanhtoan'] != 2)
		{
		$total_insert = $totalprice+$totalvat-$total_discount;
		mysqli_query($conn,"UPDATE `ksn_debit` SET `totalkiennho`='$sokiennho', `totalkienlon`='$sokienlon', `totaltien`='$total_insert' WHERE (`id`='$iddebit')");
		}
$styleArray5 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => '003333'),
		'size'  => 9,
		'name'  => 'Verdana'
	));
	
	
$styleArray5a = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => '000000'),
		'size'  => 9,
		'name'  => 'Verdana'
	));

$styleArray10 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => 'FF0000'),
		'size'  => 9,
		'name'  => 'Verdana'
	));

$styleArray6 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => '000000'),
		'size'  => 10,
		'name'  => 'Verdana'
	));


$sheet->getStyle("A16:R".($rowCount-1)."")->applyFromArray(array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
));


$sheet->getStyle("A1:D6")->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => 'DDDDDD')
            )
        )
    )
);








$rowCount+=2;
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':O'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"* Ghi Chú")->getStyle('A'.($rowCount))->applyFromArray($styleArray10);



if($dulieukhachhang['payment_type'] == 1)
{

$rowCount+=1;
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':R'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"1/ Quý khách vui lòng kiểm tra và xác nhận đề nghị thanh toán (Debit note) ngay khi quý đại lí nhận được và gửi lại biên lai cho GPE trong ngày.")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':R'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"   Bởi vì quý đại lí thuộc công nợ ngày của GPE, vì vậy vui lòng kiểm tra và xác nhận debit thanh toán càng sớm càng tốt trong ngày, để tránh chậm trễ tiến độ xuất hàng trong ngày. ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':R'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"2/ Quý khách vui lòng thanh toán debit cùng ngày kể từ khi nhận được debit , Nếu thanh toán tài khoản cá nhân quý khách ghi đúng nội dung 'NOP TIEN MAT'  và gửi kèm lệnh UNC của ngân hàng về cho chúng tôi để tiện theo dõi.  ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;


}
else
{
$rowCount+=1;
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':R'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"1/ Quý khách vui lòng kiểm tra và xác nhận đề nghị thanh toán (Debit note) trong vòng 1-3 ngày làm việc kể từ ngày nhận được debit, nếu sau 3 ngày 
chúng tôi chưa nhận được phản hồi của Quý khách hệ thống của chúng tôi sẽ xem như là Debit đúng và tự động phát hành hóa đơn. ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':R'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"  Dựa trên Đề nghị thanh toán (Debit note) đã phát hành. Và mọi sai sót liên quan Quý khách hàng sẽ không có quyền khiếu nại. ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':R'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"2/ Quý khách vui lòng thanh toán debit trong vòng 7 ngày kể từ khi nhận được debit , Nếu thanh toán tài khoản cá nhân quý khách ghi đúng nội dung \" NOP TIEN MAT\"  và gửi kèm lệnh UNC của ngân hàng về cho chúng tôi để tiện theo dõi.  ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':R'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"3/ Nếu quá 7 ngày chúng tôi vẫn chưa nhận được thanh toán, GPE sẽ phát hành khoản phí thanh toán muộn là 2% cho tổng giá trị hóa đơn, và khoản phí này sẽ được charge vào tài khoản của quý khách hàng. ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;
}






$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+2).':I'.($rowCount+2));
$sheet->setCellValue('A'.($rowCount+2),"* Thông Tin Tài Khoản Cá Nhân")->getStyle('A'.($rowCount+2))->applyFromArray($styleArray10);
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+3).':I'.($rowCount+3));
$sheet->setCellValue('A'.($rowCount+3),string_mod('debit_string_5',$conn))->getStyle('A'.($rowCount+3))->applyFromArray($styleArray5a);

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+4).':I'.($rowCount+4));
$sheet->setCellValue('A'.($rowCount+4),string_mod('debit_string_6',$conn))->getStyle('A'.($rowCount+4))->applyFromArray($styleArray5);
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+5).':I'.($rowCount+5));
$sheet->setCellValue('A'.($rowCount+5),string_mod('debit_string_7',$conn))->getStyle('A'.($rowCount+5))->applyFromArray($styleArray5a);

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+6).':I'.($rowCount+6));
$sheet->setCellValue('A'.($rowCount+6),string_mod('debit_string_7a',$conn))->getStyle('A'.($rowCount+6))->applyFromArray($styleArray5);
$rowCount+=6;


$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+2).':I'.($rowCount+2));
$sheet->setCellValue('A'.($rowCount+2),"* Thông Tin Tài Khoản Công Ty")->getStyle('A'.($rowCount+2))->applyFromArray($styleArray10);
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+3).':I'.($rowCount+3));
$sheet->setCellValue('A'.($rowCount+3),string_mod('debit_string_8',$conn))->getStyle('A'.($rowCount+3))->applyFromArray($styleArray5a);

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+4).':I'.($rowCount+4));
$sheet->setCellValue('A'.($rowCount+4),string_mod('debit_string_9',$conn))->getStyle('A'.($rowCount+4))->applyFromArray($styleArray5);
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+5).':I'.($rowCount+5));
$sheet->setCellValue('A'.($rowCount+5),string_mod('debit_string_10',$conn))->getStyle('A'.($rowCount+5))->applyFromArray($styleArray5a);

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+6).':I'.($rowCount+6));
$sheet->setCellValue('A'.($rowCount+6),string_mod('debit_string_11',$conn))->getStyle('A'.($rowCount+6))->applyFromArray($styleArray5a);

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+7).':I'.($rowCount+7));
$sheet->setCellValue('A'.($rowCount+7),string_mod('debit_string_12',$conn))->getStyle('A'.($rowCount+7))->applyFromArray($styleArray5a);


$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+8).':I'.($rowCount+8));
$sheet->setCellValue('A'.($rowCount+8),string_mod('debit_string_13',$conn))->getStyle('A'.($rowCount+8))->applyFromArray($styleArray5a);




$sheet->getStyle('A16:R16')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CC9933') ) ) );
$sheet->getStyle('A16:R16')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
	$sheet->getColumnDimension($col)
	->setAutoSize(true);




$sheet->getStyle("A1:R6")->applyFromArray(array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
));
} 
$sheet->getStyle('A7:D7')->applyFromArray(array(
				'borders' => array(
					'top' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			));

$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
$makh=preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($makh));

$file = "DEBIT-".$dulieudebit['debitno'].".xlsx";
$objWriter->save($file);
header('Content-disposition: attachment; filename='.$file);
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($file));
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
ob_clean();
flush(); 
readfile($file);



?>