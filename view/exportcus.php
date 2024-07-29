<?php
@session_start();
	include("../excel/PHPExcel.php");
	include("../conn/db.php");


$objExcel = new PHPExcel;
$objExcel->setActiveSheetIndex(0);
$sheet = $objExcel->getActiveSheet()->setTitle('Export ');
$rowCount = 12;

$makh = $_GET['selectmakh'];
$cus_price = $_GET['price'];


// $makhvalue = mysql_fetch_assoc(mysql_query("select * from cyl_khachhang where id = '".$makh."'"));

$daystart = $_GET['daystart'];
$dayend = $_GET['dayend'];

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('logo');
$objDrawing->setDescription('logo');
$objDrawing->setPath('logoexport.jpg');
$objDrawing->setCoordinates('A1');                      
	//setOffsetX works properly
$objDrawing->setOffsetX(0); 
$objDrawing->setOffsetY(0);                
	//set width, height
$objDrawing->setWidth(300); 
$objDrawing->setHeight(130); 
$objDrawing->setWorksheet($objExcel->getActiveSheet());

$styleArray = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => '0099FF'),
		'size'  => 13,
		'name'  => 'Verdana'
	));

$objExcel->getActiveSheet()->mergeCells('E1:K1');
$objExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
$sheet->setCellValue('E1','GIA PHU INT CO.,LTD')->getStyle('E1')->applyFromArray($styleArray);

	//
$styleArray1 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => '0099FF'),
		'size'  => 9,
		'name'  => 'Verdana'
	));

$objExcel->getActiveSheet()->mergeCells('E2:I2');
$objExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(15);
$sheet->setCellValue('E2','Adress: 60 Đường số 1 khu dân cư Cityland P.10 Quận Gò Vấp')->getStyle('E2')->applyFromArray($styleArray1);


$styleArray2 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => '0099FF'),
		'size'  => 9,
		'name'  => 'Verdana'
	));


$objExcel->getActiveSheet()->mergeCells('E3:I3');
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
$sheet->setCellValue('E3','MST: 0313498506')->getStyle('E3')->applyFromArray($styleArray2);



$objExcel->getActiveSheet()->mergeCells('E4:I4');
$objExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);
$sheet->setCellValue('E4','Website: http://giaphuexpress.vn')->getStyle('E4')->applyFromArray($styleArray2);

$objExcel->getActiveSheet()->mergeCells('E5:I5');
$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
$sheet->setCellValue('E5','SDT: 0927507777(Mr.Tuyển)')->getStyle('E5')->applyFromArray($styleArray2);

$objExcel->getActiveSheet()->mergeCells('E6:I6');
$objExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(15);
$sheet->setCellValue('E6','Email: accoutant@giaphuexpress.vn')->getStyle('E6')->applyFromArray($styleArray2);


$styleArray3 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
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

$objExcel->getActiveSheet()->mergeCells('E9:I9');	
$objExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(35);
$sheet->setCellValue('E9','PAYMENT NOTIFICATION')->getStyle('E9')->applyFromArray($styleArray3);
$sheet->setCellValue('B10','Customer Name: '.$makh);
$sheet->setCellValue('B11','Date : '.$daystart.'-'.$dayend);



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
		
		
		$sheet->setCellValue('A'.$rowCount,'No.');
		$sheet->setCellValue('B'.$rowCount,'Date');
		$sheet->setCellValue('C'.$rowCount,'AWB No');
		$sheet->setCellValue('D'.$rowCount,'Cnee');
		$sheet->setCellValue('E'.$rowCount,'Country');
		$sheet->setCellValue('F'.$rowCount,'Item details');
		$sheet->setCellValue('G'.$rowCount,'Weight');
		$sheet->setCellValue('H'.$rowCount,'Unit Price');
		$sheet->setCellValue('I'.$rowCount,'Package Price');
		$sheet->setCellValue('J'.$rowCount,'Extra Price');
		$sheet->setCellValue('K'.$rowCount,'Note');

if(isset($_GET['selectmakh']))
{
$result = mysql_query("select * from ns_package where cus_code='".$_GET['selectmakh']."' AND (date BETWEEN '$daystart' AND '$dayend')")or die("Loi");
$customer = mysql_fetch_assoc(mysql_query("select * from ns_customer where cus_code='".$_GET['selectmakh']."'"))or die("Loi 2");
}
$stt = 0;
	$total = 0;
	$totalextra = 0;
	$totalnang = 0;
	$extraprice=0;
while($row1  = mysql_fetch_array($result))
{
	$totalkien = 0;
	$note ='';
	
	$layhoadonadd = mysql_query("select * from ns_listhoadon where id_package='".$row1['id']."' AND status='3'")or die("Loi 3");;
	$sender = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id ='".$row1['id_nguoigui']."'")) or die("Loi 4");;
    $receiver = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id ='".$row1['id_nguoinhan']."'")) or die("Loi 5");;
	echo 'aaa';
	
	while($layhoadon = mysql_fetch_array($layhoadonadd))
	{
		
			echo $layhoadon['id'];
		
			$listcatalog = mysql_query("SELECT * FROM ns_mapcatalog WHERE id_bill = '".$layhoadon['id']."'") or die("Loi 6");;
            $arr = [];
            while ($item = mysql_fetch_array($listcatalog)) {
                $type = @mysql_fetch_assoc(mysql_query("SELECT * FROM ns_catalog WHERE id = '".$item['id_catalog']."'"));
				
				if($type['type_en'] == "ICE")
				{
					$extraprice += 150000;
					$note .= ' Đông lạnh';
				}
                array_push($arr, $type['type_en']);
            }
            @$str = join(',',$arr);
			
			if($receiver['country_id'] == 0 || $receiver['country_id'] == "")
			{
				$maquocgia = 208;
			}
			else
			{
				$maquocgia = $receiver['country_id'];
			}
			
			echo $str;
			@$layquocgia = mysql_fetch_assoc(mysql_query("select * from ns_countries where id='".$maquocgia."'"))or die(mysql_error());
			
			
			echo '123';
			$rowCount++;
			$stt++;
			$sheet->setCellValue('A'.$rowCount,$stt);
			$sheet->setCellValue('B'.$rowCount,$row1['date']);
			$sheet->setCellValue('C'.$rowCount,$layhoadon['id']);
			$sheet->setCellValue('D'.$rowCount,$receiver['name']);
			$sheet->setCellValue('E'.$rowCount,$layquocgia['name']);
			$sheet->setCellValue('F'.$rowCount,@$str);
			$sheet->setCellValue('G'.$rowCount,$layhoadon['cannang']);
			$sheet->setCellValue('H'.$rowCount,number_format($cus_price));
			$sheet->setCellValue('I'.$rowCount,number_format($layhoadon['cannang']*$cus_price));

			$total+=$layhoadon['cannang']*$cus_price;
			$totalnang+=$layhoadon['cannang'];
			$totalkien+=$layhoadon['cannang'];
	}
	
	if($totalkien < 5)
	{
			$extraprice +=100000;
			$note .= ' Phụ thu dưới 5kg';
	}
	
	$sheet->setCellValue('J'.$rowCount,number_format($extraprice));
	$sheet->setCellValue('K'.$rowCount,$note);

	$totalextra+=$extraprice;
	$extraprice = 0;
	echo'123';
}
	
$rowCount++;
			$sheet->setCellValue('G'.$rowCount,$totalnang);
			$sheet->setCellValue('H'.$rowCount,'Total');
			$sheet->setCellValue('I'.$rowCount,number_format($total));
			$sheet->setCellValue('J'.$rowCount,number_format($totalextra));
			$sheet->setCellValue('K'.$rowCount,number_format($totalextra+$total))->getStyle('K'.$rowCount)->applyFromArray($styleArraytotal);;

$styleArray5 = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	),
	'font'  => array(
		'bold'  => false,
		'color' => array('rgb' => '6633FF'),
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



$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+2).':I'.($rowCount+2));
$sheet->setCellValue('A'.($rowCount+2),"* Lưu ý : Giá chưa bao gồm giá trị gia tăng (VAT). Nếu quý khách xuất hóa đơn +10%")->getStyle('A'.($rowCount+2))->applyFromArray($styleArray10);
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+3).':I'.($rowCount+3));
$sheet->setCellValue('A'.($rowCount+3),"Khách hàng có thể thanh toán bằng tiền mặt hoặc bằng chuyển khoản theo số tài khoản sau.")->getStyle('A'.($rowCount+3))->applyFromArray($styleArray5);

$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+4).':I'.($rowCount+4));
$sheet->setCellValue('A'.($rowCount+4),"Số tài khoản cá nhân STK : 38781168 Nguyễn Văn Tuyển Ngân Hàng : Á Châu ACB ( chi nhánh Phan Xích Long )")->getStyle('A'.($rowCount+4))->applyFromArray($styleArray5);
$objExcel->getActiveSheet()->mergeCells('A'.($rowCount+5).':I'.($rowCount+5));
$sheet->setCellValue('A'.($rowCount+5),"Mọi thắc mắc xin liên hệ phòng kế toán công ty!")->getStyle('A'.($rowCount+5))->applyFromArray($styleArray5);




$sheet->getStyle('A12:K12')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '045FB4') ) ) );
$sheet->getStyle('A12:K12')->getFont()->setBold(true)->getColor()->setRGB('FE9A2E');
foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
	$sheet->getColumnDimension($col)
	->setAutoSize(true);



} 

$sheet->getStyle("A12:K".($rowCount-1)."")->applyFromArray(array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
));




$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
$file = "KH-".$makh.".xlsx";
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