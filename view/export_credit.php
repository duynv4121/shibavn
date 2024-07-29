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
$result = mysqli_query($conn,"select * from ksn_credit_detail where id_credit='".$iddebit."'")or die("Loi 1");
}
$dulieudebit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_credit WHERE id ='".$iddebit."'")) or die("Loi 44");
echo $dulieudebit['idkhachhang'];
$dulieunguoitao = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id='".$dulieudebit['uid']."'")) or die(mysqli_error());
$dulieukhachhang = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id='".$dulieudebit['idkhachhang']."'")) or die(mysqli_error());

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
$objExcel->getActiveSheet()->mergeCells('M1:Q6');
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
	
	

$objExcel->getActiveSheet()->mergeCells('B10:D10');	
$objExcel->getActiveSheet()->mergeCells('B11:D11');	
$objExcel->getActiveSheet()->mergeCells('B12:D12');	
$objExcel->getActiveSheet()->mergeCells('B13:D13');	
$objExcel->getActiveSheet()->mergeCells('B14:D14');	
//$objExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(35);
$sheet->setCellValue('M1','CREDIT NOTE')->getStyle('M1')->applyFromArray($styleArray3);
$sheet->setCellValue('B9','Bill To ')->getStyle('B9')->applyFromArray($styleArray2);;
$sheet->setCellValue('B10','Customer: '.$dulieukhachhang['congty']);
$sheet->setCellValue('B11','Adress: '.$dulieukhachhang['diachi']);
$sheet->setCellValue('B12','VAT/CODE: '.$dulieukhachhang['mst']);
$sheet->setCellValue('B13','Tel/Fax No: '.$dulieukhachhang['phone']);
$sheet->setCellValue('B14','Contact Name: '.$dulieukhachhang['ten']);





$objExcel->getActiveSheet()->mergeCells('M10:P10');	
$objExcel->getActiveSheet()->mergeCells('M11:P11');	
$sheet->setCellValue('M10','CREDIT NO: '.$dulieudebit['id']);
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
		$sheet->setCellValue('O'.$rowCount,'GOODS COMPENSATION');
		$sheet->setCellValue('P'.$rowCount,'TOTAL');
		$sheet->setCellValue('Q'.$rowCount,'NOTE');
	

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
	
	$totalboithuong = 0;
while($row  = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$laydulieusubpackage = mysqli_fetch_assoc(mysqli_query($conn,"Select * from ns_listhoadon where id_code='".$row['id_hawb']."'"));
	$laydulieupackage = mysqli_fetch_assoc(mysqli_query($conn,"Select * from ns_package where id='".$laydulieusubpackage['id_package']."'"));
	$receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$laydulieupackage['id_nguoinhan']."'")) ;
	$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name,iso2 from ns_countries where id='".$receiver['country_id']."'"));

	$rowCount++;
	
	$sheet->setCellValue('A'.$rowCount,$laydulieupackage['date']);
	$sheet->setCellValue('B'.$rowCount,$laydulieupackage['id_code']);
	$sheet->setCellValue('C'.$rowCount,$mysqli_fetch_assoc['billketnoi']);
	$sheet->setCellValue('D'.$rowCount,$receiver['company_name']);
	$sheet->setCellValue('E'.$rowCount,$receiver['name']);
	$sheet->setCellValue('F'.$rowCount,dichvu($conn,$laydulieupackage['kg_dichvu']));
	$sheet->setCellValue('G'.$rowCount,$laydulieupackage['kg_chinhanh']);
	$sheet->setCellValue('H'.$rowCount,$receiver['state']);
	$sheet->setCellValue('I'.$rowCount,$dulieuquocgia['name']);
	$sheet->setCellValue('J'.$rowCount,'1');
	$sheet->setCellValue('K'.$rowCount,$laydulieusubpackage['id_code']);
	$sheet->setCellValue('L'.$rowCount,'SPX');
	$sheet->setCellValue('M'.$rowCount,$laydulieusubpackage['charge_weight']);
	$sheet->setCellValue('N'.$rowCount,$row['price_hawb']);
	$sheet->setCellValue('O'.$rowCount,$row['price_boithuong']);
	$sheet->setCellValue('P'.$rowCount,$row['price_boithuong']+$row['price_hawb']);
	$sheet->setCellValue('Q'.$rowCount,$row['note']);
	$totalboithuong += $row['price_boithuong']+$row['price_hawb'];
}

	$rowCount++;		
	$sheet->setCellValue('A'.$rowCount,'Total')->getStyle('A'.$rowCount)->applyFromArray($styleArray3);
	$objExcel->getActiveSheet()->mergeCells('A'.$rowCount.':'.'O'.$rowCount);
	$sheet->setCellValue('P'.$rowCount,number_format($totalboithuong));
	
	mysqli_query($conn,"UPDATE `ksn_credit` SET `total`='$totalboithuong' WHERE (`id`='$iddebit')");

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


$sheet->getStyle("A16:Q".($rowCount)."")->applyFromArray(array(
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









$sheet->getStyle('A16:Q16')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CC9933') ) ) );
$sheet->getStyle('A16:Q16')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
	$sheet->getColumnDimension($col)
	->setAutoSize(true);




$sheet->getStyle("A1:Q6")->applyFromArray(array(
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

$file = "CREDIT-".$dulieudebit['id'].".xlsx";
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