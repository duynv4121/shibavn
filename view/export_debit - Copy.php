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
$result = mysqli_query($conn,"select * from ksn_debit_detail where id_debit='".$iddebit."'")or die("Loi");
}
$dulieudebit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_debit WHERE id ='".$iddebit."'")) or die("Loi 44");
echo $dulieudebit['idkhachhang'];
$dulieunguoitao = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id='".$dulieudebit['uid']."'")) or die(mysqli_error());
$dulieukhachhang = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE cus_code='".$dulieudebit['idkhachhang']."'")) or die(mysqli_error());


// $makhvalue = mysql_fetch_assoc(mysql_query("select * from cyl_khachhang where id = '".$makh."'"));

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('logo');
$objDrawing->setDescription('logo');
$objDrawing->setPath('logo-export.png');
$objDrawing->setCoordinates('A1');                      
	//setOffsetX works properly
$objDrawing->setOffsetX(50); 
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

$objExcel->getActiveSheet()->mergeCells('E1:O1');
$objExcel->getActiveSheet()->mergeCells('A1:D6');
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

$objExcel->getActiveSheet()->mergeCells('E2:O2');
$objExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(15);
$sheet->setCellValue('E2','09 Tran Van Du Street, Ward 13, Tan Binh District, Ho Chi Minh City, Vietnam')->getStyle('E2')->applyFromArray($styleArray1);


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
		'bold'  => true,
		'color' => array('rgb' => '000080'),
		'size'  => 9,
		'name'  => 'Verdana'
	));


$objExcel->getActiveSheet()->mergeCells('E3:O3');
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
$sheet->setCellValue('E3','TEL: 1900 9475 - Phone: 0921.44.1111')->getStyle('E3')->applyFromArray($styleArray1);



$objExcel->getActiveSheet()->mergeCells('E4:O4');
$objExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);
$sheet->setCellValue('E4','Email:'.$dulieunguoitao['username'])->getStyle('E4')->applyFromArray($styleArray1);

$objExcel->getActiveSheet()->mergeCells('E5:O5');
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
$sheet->setCellValue('E5','WEB: https://GPEexp.com/')->getStyle('E5')->applyFromArray($styleArray1);

$objExcel->getActiveSheet()->mergeCells('E6:O6');
$objExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(15);
$sheet->setCellValue('E6','Prepared by '.$dulieunguoitao['ten'])->getStyle('E6')->applyFromArray($styleArray2);


$styleArray3 = array(
	'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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
	
	

$objExcel->getActiveSheet()->mergeCells('A9:O9');	
$objExcel->getActiveSheet()->mergeCells('B10:D10');	
$objExcel->getActiveSheet()->mergeCells('B11:D11');	
$objExcel->getActiveSheet()->mergeCells('B12:D12');	
$objExcel->getActiveSheet()->mergeCells('B13:D13');	
$objExcel->getActiveSheet()->mergeCells('B14:D14');	
$objExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(35);
$sheet->setCellValue('A9','DEBIT NOTE')->getStyle('A9')->applyFromArray($styleArray3);
$sheet->setCellValue('B10','Customer: '.$dulieukhachhang['congty']);
$sheet->setCellValue('B11','Adress: '.$dulieukhachhang['diachi']);
$sheet->setCellValue('B12','VAT/CODE: ');
$sheet->setCellValue('B13','Tel/Fax No: '.$dulieukhachhang['phone']);
$sheet->setCellValue('B14','Contact Name: '.$dulieukhachhang['ten']);





$objExcel->getActiveSheet()->mergeCells('K10:O10');	
$objExcel->getActiveSheet()->mergeCells('K11:O11');	
$sheet->setCellValue('K10','DEBIT NO: '.$dulieudebit['debitno']);
$sheet->setCellValue('K11','DEBIT NO: '.$dulieudebit['datetime']);
$sheet->setCellValue('K12','CREDIT TERM: '.congnoa($dulieukhachhang['payment_type']));
$sheet->setCellValue('K13','CURRENCY: VND');

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
		$sheet->setCellValue('G'.$rowCount,'DESTINATION');
		$sheet->setCellValue('H'.$rowCount,'PACKAGES');
		$sheet->setCellValue('I'.$rowCount,'TYPE');
		$sheet->setCellValue('J'.$rowCount,'CHARGEABLE WEIGHT');
		$sheet->setCellValue('K'.$rowCount,'VALUE');
		$sheet->setCellValue('L'.$rowCount,'SUR CHANGE');
		$sheet->setCellValue('M'.$rowCount,'VAT');
		$sheet->setCellValue('N'.$rowCount,'TOTAL PRICE');
		$sheet->setCellValue('O'.$rowCount,'DESCRIPTION OF GOODS');

$stt = 0;
	$total = 0;
	$totalextra = 0;
	$totalnang = 0;
	$extraprice=0;		
	$totalprice = 0;
	$sokienlon = 0;
	$sokiennho = 0;
while($row  = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$sokienlon +=1;
	$result2 = mysqli_query($conn,"select * from ns_package where id_code='".$row['id_code']."'")or die("Loi");
	$result2a = mysqli_fetch_assoc($result2);
	$rowCount++;

	echo $result2a['id_nguoigui'];


	$totalkien = 0;
	$note ='';
	
	$layhoadonadd = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$result2a['id']."' and status != '0'")or die("Loi 3");
	$sender = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$result2a['id_nguoigui']."'")) ;
    $receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$result2a['id_nguoinhan']."'")) ;
	$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
	
	
	

	$sheet->setCellValue('A'.$rowCount,$result2a['date']);
	$sheet->setCellValue('B'.$rowCount,$result2a['id_code']);
	$sheet->setCellValue('D'.$rowCount,$receiver['company_name']);
	$sheet->setCellValue('E'.$rowCount,$receiver['name']);
	$sheet->setCellValue('F'.$rowCount,dichvu($conn,$result2a['kg_dichvu']));
	$sheet->setCellValue('G'.$rowCount,$dulieuquocgia['name']);
	$total_weight = 0;
	
	$checksokien = mysqli_num_rows($layhoadonadd);
	if($checksokien < 1)
	{
		
		$laydulieu = mysqli_fetch_assoc($layhoadonadd);
		$sheet->setCellValue('H'.$rowCount,'ID:'.$laydulieu['id_code']);
		$sheet->setCellValue('I'.$rowCount,$laydulieu['type']);
		$sheet->setCellValue('J'.$rowCount,$laydulieu['charge_weight']);	
		if($laydulieu['charge_weight'] < 21)
		{
		$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select name from ksn_giadichvu where id='".$result2a['kg_dichvu']."'"));
		
		}
	}
	else
	{
	$sokiennho +=1;
	$phuthukien = 0;
	while($laydulieu = mysqli_fetch_array($layhoadonadd,MYSQLI_ASSOC))
	{
	$sheet->setCellValue('H'.$rowCount,'ID:'.$laydulieu['id_code']);
	$sheet->setCellValue('I'.$rowCount,$laydulieu['type']);
	$sheet->setCellValue('J'.$rowCount,$laydulieu['charge_weight']);
	
	$phuthu = 0;
	
	/****** LIST phụ thu */
	$stringphuthu = '';
	$listhoadonphuthua = mysqli_query($conn,"select * from kns_listhoadonphuthu where id_code='".$laydulieu['id_code']."'");
	while($listhoadonphuthu = mysqli_fetch_array($listhoadonphuthua))
	{
	$stringphuthu.= $listhoadonphuthu['tenphuthu'].'['.$listhoadonphuthu['soluong'].'] ';
	$phuthu+=$listhoadonphuthu['soluong']*$listhoadonphuthu['price'];
	}
	$sheet->setCellValue('L'.$rowCount,$phuthu);

	$sheet->setCellValue('O'.$rowCount,$stringphuthu);

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
	$sheet->getStyle('J'.($rowCount).':N'.($rowCount))->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'C0C0C0') ) ) );
	
	
	// Lọc theo chi nhanh và user_error
	if($dulieukhachhang['payment_price_type'] == 1)
	{
		if($result2a['kg_chinhanh'] == "HCM")
		{
			$bang_gia = 'price_hcm_f1'; 
		}
		else if($result2a['kg_chinhanh'] == "HN")
		{
			$bang_gia = 'price_hn_f1'; 

		}else if($result2a['kg_chinhanh'] == "DAD")
		{
			$bang_gia = 'price_dn_f1'; 

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
	
	
	
	//* Tinh Gia DICH VU KSN-AU , KSN-AU 2, KSN-AU EXPRESS
	if($result2a['kg_dichvu'] == 1 || $result2a['kg_dichvu'] == 2 || $result2a['kg_dichvu'] == 24)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));
		$laydulieuremote = mysqli_query($conn,"select * from ksn_au_remote where name='".$dulieucity['name']."'");			

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
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight' AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price'];
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}
		
	}
	
	//* Tinh Gia DICH VU KSN-NZD
	else if($result2a['kg_dichvu'] == 4)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));

		if($dulieucity['name'] == "Auckland")
		{
			$note = 'Auckland';

		}
		else
		{
			$note = 'other';

		}

		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight' AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price'];
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}
		
	}
	
	//* Tinh Gia DICH VU KSN-CANADA,KSN-UK,ksn-US,KSN-US NDA,KSN-SIN,KSN-AUE
	else if($result2a['kg_dichvu'] == 13 || $result2a['kg_dichvu'] == 14 || $result2a['kg_dichvu'] == 7|| $result2a['kg_dichvu'] == 9|| $result2a['kg_dichvu'] == 10|| $result2a['kg_dichvu'] == 11)
	{
		
		$dulieucity = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));

		
	

		if($total_weight < 21)
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price'];
		}
		else if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100' "));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300' "));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
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
		}else if($dulieuquocgia['name'] == 'Span' || $dulieuquocgia['name'] == 'Portugal' || $dulieuquocgia['name'] == 'Austria' || $dulieuquocgia['name'] == 'North Ireland'|| $dulieuquocgia['name'] == 'Italy' )
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
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='$total_weight' AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price'];
		}
		else if($total_weight >= 21 && $total_weight < 50 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;

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
		
		if($total_weight >= 21 && $total_weight < 45 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='21'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;

		}else if($total_weight >= 45 && $total_weight < 100 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='45'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}else if($total_weight >= 100 && $total_weight < 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='100'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}else if($total_weight > 300 )
		{
			$dulieugiadichvu = mysqli_fetch_assoc(mysqli_query($conn,"select price from ksn_giadichvu where id_dichvu='".$result2a['kg_dichvu']."' AND m_price='300'  AND note='$note'"));
			$sheet->setCellValue('N'.$rowCount,number_format($dulieugiadichvu['price']*$total_weight+$phuthukien,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);
			$totalprice += $dulieugiadichvu['price']*$total_weight;
		}
		
		
	}
	
	
	}

		$sheet->setCellValue('J'.$rowCount,$total_weight);
		$sheet->setCellValue('L'.$rowCount,$phuthukien);
		
	

	
	
	
	
}
	
		$rowCount++;
			$sheet->setCellValue('N'.$rowCount,number_format($totalprice,0,',','.'))->getStyle('N'.$rowCount)->applyFromArray($styletotal);;
			$sheet->setCellValue('L'.$rowCount,'Total')->getStyle('L'.$rowCount)->applyFromArray($styletotal);;
		
		mysqli_query($conn,"UPDATE `ksn_debit` SET `totalkiennho`='$sokiennho', `totalkienlon`='$sokienlon', `totaltien`='$totalprice' WHERE (`id`='$iddebit')");
$styleArray5 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => '808000'),
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


$sheet->getStyle("A16:O".($rowCount-1)."")->applyFromArray(array(
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
);$sheet->getStyle("E1:O6")->applyFromArray(
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

$rowCount+=1;
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':O'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"1/ Quý khách vui lòng kiểm tra và xác nhận đề nghị thanh toán (Debit note) trong vòng 1-3 ngày làm việc kể từ ngày nhận được debit, nếu sau 3 ngày 
chúng tôi chưa nhận được phản hồi của Quý khách hệ thống của chúng tôi sẽ xem như là Debit đúng và tự động phát hành hóa đơn. ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':O'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"  Dựa trên Đề nghị thanh toán (Debit note) đã phát hành. Và mọi sai sót liên quan Quý khách hàng sẽ không có quyền khiếu nại. ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':O'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"2/ Quý khách vui lòng thanh toán debit trong vòng 7 ngày kể từ khi nhận được debit , Nếu thanh toán tài khoản cá nhân quý khách ghi đúng nội dung \" NOP TIEN MAT\"  và gửi kèm lệnh UNC của ngân hàng về cho chúng tôi để tiện theo dõi.  ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':O'.($rowCount));
$sheet->setCellValue('A'.($rowCount),"3/ Nếu quá 7 ngày chúng tôi vẫn chưa nhận được thanh toán, GPE sẽ phát hành khoản phí thanh toán muộn là 2% cho tổng giá trị hóa đơn, và khoản phí này sẽ được charge vào tài khoản của quý khách hàng. ")->getStyle('A'.($rowCount))->applyFromArray($styleArray1);
$rowCount+=1;

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+2).':I'.($rowCount+2));
$sheet->setCellValue('A'.($rowCount+2),"* Thông Tin Tài Khoản Công Ty")->getStyle('A'.($rowCount+2))->applyFromArray($styleArray10);
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+3).':I'.($rowCount+3));
$sheet->setCellValue('A'.($rowCount+3),"- Tên Ngân Hàng/Bank Name: Ngân hàng TMCP Kỹ Thương Việt Nam (TECHCOMBANK)")->getStyle('A'.($rowCount+3))->applyFromArray($styleArray5);

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+4).':I'.($rowCount+4));
$sheet->setCellValue('A'.($rowCount+4),"- Số tài khoản/Account ID Number : 4757678888")->getStyle('A'.($rowCount+4))->applyFromArray($styleArray5);
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+5).':I'.($rowCount+5));
$sheet->setCellValue('A'.($rowCount+5),"- Tên đơn vị thụ hưởng(Beneficiary Name): PHẠM THỊ THU HẬU")->getStyle('A'.($rowCount+5))->applyFromArray($styleArray5);




$sheet->getStyle('A16:O16')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CC9933') ) ) );
$sheet->getStyle('A16:O16')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
	$sheet->getColumnDimension($col)
	->setAutoSize(true);



} 


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