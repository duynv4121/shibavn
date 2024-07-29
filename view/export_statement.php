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

$date_start = $_GET['date_start'];
$date_end = $_GET['date_end'];
$dulieudebit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_statement WHERE id ='".$iddebit."'")) or die("Loi 44");
echo $dulieudebit['idkhachhang'];
$dulieunguoitao = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id='".$dulieudebit['uid']."'")) or die(mysqli_error());
$dulieukhachhang = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id='".$dulieudebit['idkhachhang']."'")) or die(mysqli_error());

$nguoigui = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_customer WHERE cus_code='".$dulieukhachhang['cus_code']."'"));
$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$nguoigui['ward_id']."'"));
$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$nguoigui['province_id']."'"));
$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$nguoigui['district_id']."'"));
	

if(isset($_GET['id']))
{
$result = mysqli_query($conn,"select * from ksn_debit where DATE(datetime)>='$date_start' AND DATE(datetime)<='$date_end' AND idkhachhang='".$dulieukhachhang['cus_code']."'")or die("Loi 1");
$result2 = mysqli_query($conn,"select * from ksn_credit where DATE(datetime)>='$date_start' AND DATE(datetime)<='$date_end' AND idkhachhang='".$dulieukhachhang['id']."' AND checkthanhtoan is NULL")or die("Loi 1");
}


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
$objDrawing->setOffsetX(20); 
$objDrawing->setOffsetY(60);                
	//set width, height
$objDrawing->setWidth(140); 
$objDrawing->setHeight(50); 
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

$objExcel->getActiveSheet()->mergeCells('E1:M1');
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

$objExcel->getActiveSheet()->mergeCells('E2:M2');
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

$styleArray3 = array(
	'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER

	),
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => 'FF0000'),
		'size'  => 12,
		'name'  => 'Verdana'
	));
$styleArray_payment = array(
	'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER

	),
	'font'  => array(
		'bold'  => true,
		'size'  => 10,
		'name'  => 'Verdana'
	));
$styleArray_dathanhtoan = array(
	'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER

	),
	'font'  => array(
		'color' => array('rgb' => '33CC00'),


	));
$styleArray_chuathanhtoan = array(
	'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER

	),
	'font'  => array(
		'color' => array('rgb' => '770000'),

	));
$styleArray_tamduyetlenh = array(
	'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER

	),
	'font'  => array(
		'color' => array('rgb' => 'FF9900'),

	));
$objExcel->getActiveSheet()->mergeCells('E3:M3');
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
$sheet->setCellValue('E3',string_mod('debit_string_2',$conn))->getStyle('E3')->applyFromArray($styleArray1);



$objExcel->getActiveSheet()->mergeCells('E4:M4');
$objExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);
$sheet->setCellValue('E4',string_mod('debit_string_3',$conn))->getStyle('E4')->applyFromArray($styleArray1);

$objExcel->getActiveSheet()->mergeCells('E5:M5');
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
$sheet->setCellValue('E5',string_mod('debit_string_4',$conn))->getStyle('E5')->applyFromArray($styleArray1);

$objExcel->getActiveSheet()->mergeCells('E6:M6');
$objExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(15);
$sheet->setCellValue('E6','Prepared by '.$dulieunguoitao['ten'])->getStyle('E6')->applyFromArray($styleArray2);
$sheet->setCellValue('A7','STATEMENT')->getStyle('A7')->applyFromArray($styleArray3);
$objExcel->getActiveSheet()->mergeCells('A7:M7');



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
$sheet->setCellValue('B9','Bill To ')->getStyle('B9')->applyFromArray($styleArray2);;
$sheet->setCellValue('B10','Customer: '.$dulieukhachhang['congty']);
$sheet->setCellValue('B11','Adress: '.$dulieukhachhang['diachi'].','.$ward['name'].','.$district['name'].','.$province['name']);
$sheet->setCellValue('B12','VAT/CODE: '.$dulieukhachhang['mst']);
$sheet->setCellValue('B13','Tel/Fax No: '.$dulieukhachhang['phone']);
$sheet->setCellValue('B14','Contact Name: '.$dulieukhachhang['ten']);





$objExcel->getActiveSheet()->mergeCells('K10:M10');	
$objExcel->getActiveSheet()->mergeCells('K11:M11');	
$objExcel->getActiveSheet()->mergeCells('K12:M12');	
$objExcel->getActiveSheet()->mergeCells('K13:M13');	
$sheet->setCellValue('K10','STATEMENT DATE: '.$date_start.' to '.$date_end);
$sheet->setCellValue('K11','DATE TIME: '.$dulieudebit['datetime']);
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
		
		
		$sheet->setCellValue('A'.$rowCount,'STT');
		$sheet->setCellValue('C'.$rowCount,'TRANSACTION');
		$sheet->setCellValue('E'.$rowCount,'DATE');
		$sheet->setCellValue('H'.$rowCount,'DESCRIPTION');
		$sheet->setCellValue('K'.$rowCount,'AMOUNT');
		$sheet->setCellValue('L'.$rowCount,'TOTAL');
		$sheet->setCellValue('M'.$rowCount,'STATUS');

		$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':B'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('C'.($rowCount).':D'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('E'.($rowCount).':G'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('H'.($rowCount).':J'.($rowCount));



$stt = 0;
	$total = 0;
	$count = 1;
	
	$totalboithuong = 0;
	$totaldebit=0;
while($row  = mysqli_fetch_array($result,MYSQLI_ASSOC))
{

	$rowCount++;
	
	$sheet->setCellValue('A'.$rowCount,$count);
	$sheet->setCellValue('C'.$rowCount,'DEBIT');
	$sheet->setCellValue('E'.$rowCount,$row['datetime']);
	$sheet->setCellValue('H'.$rowCount,$row['debitno']);
	$sheet->setCellValue('K'.$rowCount,$row['totaltien']);
	$sheet->setCellValue('L'.$rowCount,$row['totaltien']);
	
	if($row['checkthanhtoan'] == 2)
	{
	$sheet->setCellValue('M'.$rowCount,'ĐÃ THANH TOÁN')->getStyle('M'.$rowCount)->applyFromArray($styleArray_dathanhtoan);
	}
	else if($row['checkthanhtoan'] == 5)
	{
	$totaldebit +=$row['totaltien']-$row['tamung'];
	$sheet->setCellValue('M'.$rowCount,'DUYỆT TẠM ỨNG')->getStyle('M'.$rowCount)->applyFromArray($styleArray_tamduyetlenh);
	$sheet->setCellValue('N'.$rowCount,'Tạm ứng:'.$row['tamung']);
	}else
	{
	$totaldebit +=$row['totaltien'];

	$sheet->setCellValue('M'.$rowCount,'CHƯA THANH TOÁN')->getStyle('M'.$rowCount)->applyFromArray($styleArray_chuathanhtoan);
	}
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':B'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('C'.($rowCount).':D'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('E'.($rowCount).':G'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('H'.($rowCount).':J'.($rowCount));
	$count++;
	
}

while($row  = mysqli_fetch_array($result2,MYSQLI_ASSOC))
{

	$rowCount++;
	
	$sheet->setCellValue('A'.$rowCount,$count);
	$sheet->setCellValue('C'.$rowCount,'CREDIT');
	$sheet->setCellValue('E'.$rowCount,$row['datetime']);
	$sheet->setCellValue('H'.$rowCount,$row['id']);
	$sheet->setCellValue('K'.$rowCount,$row['total']);
	$sheet->setCellValue('L'.$rowCount,'-'.$row['total']);
	

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount).':B'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('C'.($rowCount).':D'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('E'.($rowCount).':G'.($rowCount));
		$objExcel->getActiveSheet()->mergeCells('H'.($rowCount).':J'.($rowCount));
	$count++;
		$totalboithuong +=$row['total'];

}

	$rowCount++;		
	$sheet->setCellValue('A'.$rowCount,'PAYMENT REQUESTED')->getStyle('A'.$rowCount)->applyFromArray($styleArray_payment);
	$objExcel->getActiveSheet()->mergeCells('A'.$rowCount.':'.'K'.$rowCount);
	$sheet->setCellValue('L'.$rowCount,number_format($totaldebit-$totalboithuong));
	
	$totalupdate = $totaldebit-$totalboithuong;
	
	
	if($dulieudebit['checkthanhtoan'] != 2)
	{
	mysqli_query($conn,"UPDATE `ksn_statement` SET `total`='$totalupdate' WHERE (`id`='$iddebit')");
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


$sheet->getStyle("A16:M".($rowCount)."")->applyFromArray(array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
));

$sheet->getStyle("A7:M7")->applyFromArray(array(
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
$sheet->setCellValue('A'.($rowCount),"* Vui lòng hỗ trợ thanh toán Statement này trong vòng 3 ngày kể từ ngày nhận được theo thông tin thanh toán bên dưới.")->getStyle('A'.($rowCount))->applyFromArray($styleArray10);







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








$sheet->getStyle('A16:M16')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CC9933') ) ) );
$sheet->getStyle('A16:M16')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
	$sheet->getColumnDimension($col)
	->setAutoSize(true);




$sheet->getStyle("A1:M6")->applyFromArray(array(
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



$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth("50");


$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
$makh=preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($makh));

$file = "REPORT STATEMENT-".$dulieudebit['id'].".xlsx";
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