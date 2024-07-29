<?php  
@session_start();
	include("../excel/PHPExcel.php");
	include("../conn/db.php");
	include("../controller/accountant.php");

	include("../controller/bill.php");


	// include('../controller/customer.php');
	// include('../controller/product.php');
	// include('../controller/otherexport.php');
	function cellColor($cells,$color, $objExcel){
	    // global $objExcel;
	    // $objExcel = new PHPExcel;
	    $objExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
	        'type' => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array(
	             'rgb' => $color
	        )
	    ));
	}		
		$day_start = $_GET['day_start'];
		$day_end = $_GET['day_end'];
		  $filldichvu = "";

		if(isset($_GET['kg_dichvu']))
					{
						if($_GET['kg_dichvu'] == "")
						{
							
						}
						else
						{
							
						$filldichvu = "AND (";
							foreach ($_GET['kg_dichvu'] as $a){
								$filldichvu .= "kg_dichvu='".$a."' OR ";
							}
							$filldichvu = substr($filldichvu,0,-3);
							$filldichvu.=")";
						}
					}
		
		$result2 = mysqli_query($conn,"SELECT * FROM ns_package where date >= '$day_start' ".$filldichvu." AND date <='$day_end' AND (`checkthanhtoan` is not NULL) ")or die ("Loi");
		
		

		$tring1 = ' ';
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'STT');
		$sheet->setCellValue('B'.$rowCount,'DATE');
		$sheet->setCellValue('C'.$rowCount,'ACCOUNT NUMBER');
		$sheet->setCellValue('D'.$rowCount,'SENDER NAME');
		$sheet->setCellValue('E'.$rowCount,'DỊCH VỤ');
		$sheet->setCellValue('F'.$rowCount,'AWB');
		$sheet->setCellValue('G'.$rowCount,'HAWB#');
		$sheet->setCellValue('H'.$rowCount,'TRACKING NUMBER');
		$sheet->setCellValue('I'.$rowCount,'CNEE NAME');
		$sheet->setCellValue('J'.$rowCount,'DEST');
		$sheet->setCellValue('K'.$rowCount,'TYPE');
		$sheet->setCellValue('L'.$rowCount,'PCS');
		$sheet->setCellValue('M'.$rowCount,'CW');
		$sheet->setCellValue('N'.$rowCount,'TOTAL VALUE');
		$sheet->setCellValue('O'.$rowCount,'SUR CHARGE');
		$sheet->setCellValue('P'.$rowCount,'VAT 8%');
		$sheet->setCellValue('Q'.$rowCount,'TOTAL PRICE');
		$sheet->setCellValue('R'.$rowCount,'DESCRIPTION OF GOODS');
		$sheet->setCellValue('S'.$rowCount,'Gross Weight');
		$sheet->setCellValue('T'.$rowCount,'DEBIT NO');
		$sheet->setCellValue('U'.$rowCount,'Công Nợ');
		$sheet->setCellValue('V'.$rowCount,'Status Pay');
		$sheet->setCellValue('W'.$rowCount,'MAWB');

		
		/*
		foreach(range('A','I') as $columnID) {
    $objExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}		
		*/


		
		
		
		$count = 1;
		$cannang = 0;
		$sokien = 0;
		while($row  = mysqli_fetch_array($result2,MYSQLI_ASSOC))
		{
					$rowCount++;

	
			
		$sender = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$row['id_nguoigui']."'"));
			$receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$row['id_nguoinhan']."'"));
	
		$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$sender['ward_id']."'"));
		$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$sender['province_id']."'"));
		$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$sender['district_id']."'"));
    
		$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
		
		$citynhan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM cities WHERE id = '".$receiver['city']."'"));

		$dulieunguoitao = mysqli_fetch_assoc(mysqli_query($conn,"select payment_type,username,cus_code from ns_user where id='".$row['uid']."'"));

		/*	
		
		
		
		
			
		$sheet->setCellValue('A'.$rowCount,$sender['company_name']);
		$sheet->setCellValue('B'.$rowCount,$sender['name']);
		$sheet->setCellValue('C'.$rowCount,$sender['phone']);
		$sheet->setCellValue('D'.$rowCount,@$dulieunguoitao['username']);
		$sheet->setCellValue('E'.$rowCount,$sender['address'].' '.$ward['name'].' '.$district['name']);
		$sheet->setCellValue('F'.$rowCount,'');
		$sheet->setCellValue('G'.$rowCount,$province['name']);
		$sheet->setCellValue('H'.$rowCount,'VN');
		$sheet->setCellValue('I'.$rowCount,$row['id_code']);
	
		$sheet->setCellValue('L'.$rowCount,dichvu($conn,$row['kg_dichvu']));
		$sheet->setCellValue('M'.$rowCount,$row['date']);
		$sheet->setCellValue('N'.$rowCount,$receiver['company_name']);
		$sheet->setCellValue('O'.$rowCount,$receiver['name']);
		$sheet->setCellValue('P'.$rowCount,$receiver['address']);
		$sheet->setCellValue('Q'.$rowCount,$receiver['address2']);
		$sheet->setCellValue('R'.$rowCount,$receiver['address3']);
		$sheet->setCellValue('S'.$rowCount,$citynhan['name']);
		$sheet->setCellValue('T'.$rowCount,$receiver['state']);
		$sheet->setCellValue('U'.$rowCount,$dulieuquocgia['name']);
		$sheet->setCellValue('V'.$rowCount,$receiver['post_code']);
		$sheet->setCellValue('W'.$rowCount,$receiver['phone']);
		$sheet->setCellValue('X'.$rowCount,$row['sokien']);
		$sheet->setCellValue('Y'.$rowCount,$row['gross_weight']);
		$sheet->setCellValue('Z'.$rowCount,$row['charge_weight']);
		$sheet->setCellValue('AD'.$rowCount,'SPX');
		$sheet->setCellValue('AF'.$rowCount,$row['kg_valueinvoice']);
		$sheet->setCellValue('AG'.$rowCount,'USD');

						echo 'aaaaaaaaaaa';
		$laydulieukiencona = mysqli_query($conn,"select id_code,billketnoi from ns_listhoadon where id_package='".$row['id']."'");

		while($laydulieukiencon = mysqli_fetch_array($laydulieukiencona))
		{
			$sheet->setCellValue('J'.$rowCount,$laydulieukiencon['id_code']);
			$sheet->setCellValue('K'.$rowCount,$laydulieukiencon['billketnoi']);
			$rowCount++;
		}	
		*/
					$sheet->setCellValue('A'.$rowCount,$count);
					$sheet->setCellValue('B'.$rowCount,$row['date']);
						$sheet->setCellValue('C'.$rowCount,($dulieunguoitao['cus_code']));
if($row['id_sale'] != 0)
					{	
					@$laydulieuthanhtoan = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit_sale where id_bill='".$row['id_code']."'"));
					$sheet->setCellValue('D'.$rowCount,'SALE: '.$sender['name']);
					$sheet->setCellValue('T'.$rowCount,'https://GPE-post.com/upload/'.@$laydulieuthanhtoan['bangchungthanhtoan']);

					}
					else
					{
					$sheet->setCellValue('D'.$rowCount,$sender['company_name']);
					@$layiddebita = @mysqli_fetch_assoc(mysqli_query($conn,"select id_debit from ksn_debit_detail where id_code='".$row['id_code']."' order by id DESC"));
					@$layiddebitb = @mysqli_fetch_assoc(mysqli_query($conn,"select debitno from ksn_debit where id='".$layiddebita['id_debit']."'"));
					$sheet->setCellValue('T'.$rowCount,@$layiddebitb['debitno']);

					}					$sheet->setCellValue('E'.$rowCount,dichvu($conn,$row['kg_dichvu']));
					$sheet->setCellValue('F'.$rowCount,$row['id_code']);
					$sheet->setCellValue('I'.$rowCount,$receiver['name']);
					$sheet->setCellValue('J'.$rowCount,$dulieuquocgia['name']);
					$sheet->setCellValue('K'.$rowCount,'SPX');
					$sheet->setCellValue('L'.$rowCount,$row['sokien']);
					$sheet->setCellValue('M'.$rowCount,$row['charge_weight']);
					$sheet->setCellValue('N'.$rowCount,$row['khach_cuocbay']);
					$sheet->setCellValue('O'.$rowCount,$row['khach_phuthu']);
					$sheet->setCellValue('P'.$rowCount,$row['vat']);
					$sheet->setCellValue('Q'.$rowCount,$row['khach_cuocbay']+$row['khach_phuthu']+$row['vat']);
					$sheet->setCellValue('S'.$rowCount,$row['gross_weight']);
					
					@$layiddebita = @mysqli_fetch_assoc(mysqli_query($conn,"select id_debit from ksn_debit_detail where id_code='".$row['id_code']."' order by id DESC"));
					@$layiddebitb = @mysqli_fetch_assoc(mysqli_query($conn,"select debitno from ksn_debit where id='".$layiddebita['id_debit']."'"));
					$sheet->setCellValue('T'.$rowCount,@$layiddebitb['debitno']);
					$sheet->setCellValue('U'.$rowCount,congnoa(@$dulieunguoitao['payment_type']));
					$sheet->setCellValue('V'.$rowCount,strip_tags(checkthanhtoan($row['checkthanhtoan'])));
					
					/*
					$sheet->setCellValue('L'.$rowCount,dichvu($conn,$row['kg_dichvu']));
		$sheet->setCellValue('M'.$rowCount,$row['date']);
		$sheet->setCellValue('N'.$rowCount,$receiver['company_name']);
		$sheet->setCellValue('O'.$rowCount,$receiver['name']);
		$sheet->setCellValue('P'.$rowCount,$receiver['address']);
		$sheet->setCellValue('Q'.$rowCount,$receiver['address2']);
		$sheet->setCellValue('R'.$rowCount,$receiver['address3']);
		$sheet->setCellValue('S'.$rowCount,$citynhan['name']);
		$sheet->setCellValue('T'.$rowCount,$receiver['state']);
		$sheet->setCellValue('U'.$rowCount,$dulieuquocgia['name']);
		$sheet->setCellValue('V'.$rowCount,$receiver['post_code']);
		$sheet->setCellValue('W'.$rowCount,$receiver['phone']);
		$sheet->setCellValue('X'.$rowCount,$row['sokien']);
		$sheet->setCellValue('Y'.$rowCount,$row['gross_weight']);
		$sheet->setCellValue('Z'.$rowCount,$row['charge_weight']);
		$sheet->setCellValue('AD'.$rowCount,'SPX');
		$sheet->setCellValue('AF'.$rowCount,$row['kg_valueinvoice']);
		$sheet->setCellValue('AG'.$rowCount,'USD');
		*/
		$laydulieukiencona = mysqli_query($conn,"select id_code,billketnoi,length,width,height from ns_listhoadon where id_package='".$row['id']."'");
		
		
		$demkien = 1;
		$stringkiencon = '';
		$stringtracking = '';		
		$stringphuthu = '';
		
		while($laydulieukiencon = mysqli_fetch_array($laydulieukiencona))
		{
			$stringkiencon .= $laydulieukiencon['id_code'];
			$stringtracking .= $laydulieukiencon['billketnoi'];
				
			$idkiencon1 =  $laydulieukiencon['id_code'];
			if($demkien < $row['sokien'])
			{
				$stringkiencon .= ''.PHP_EOL;
				$stringtracking .= ''.PHP_EOL;
			}
			$demkien++;
			
			$listhoadonphuthua = mysqli_query($conn,"select * from kns_listhoadonphuthu where id_code='".$laydulieukiencon['id_code']."'")or die("Loii");
			while($listhoadonphuthu = mysqli_fetch_array($listhoadonphuthua))
			{
			$stringphuthu.= $listhoadonphuthu['tenphuthu'].'['.$listhoadonphuthu['soluong'].'] ';
			}	
			
		}	
		
			@$laymawb1 = @mysqli_fetch_assoc(mysqli_query($conn,"select awb from ksn_shipment_details where id_listhoadon='".$idkiencon1."'"));
			@$laymawb2 = @mysqli_fetch_assoc(mysqli_query($conn,"select awb from ksn_shipment where id='".$laymawb1['awb']."'"));
			$sheet->setCellValue('G'.$rowCount,$stringkiencon);
			$sheet->setCellValue('H'.$rowCount,$stringtracking);
			$sheet->setCellValue('R'.$rowCount,$stringphuthu);
			$sheet->setCellValue('W'.$rowCount,@$laymawb2['awb']);
			$objExcel->getActiveSheet()->getStyle('G'.$rowCount)->getAlignment()->setWrapText(true);
			$objExcel->getActiveSheet()->getStyle('H'.$rowCount)->getAlignment()->setWrapText(true);

			$count++;		

		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		


		
		foreach(range('A','Q') as $columnID) {
			$objExcel->getActiveSheet()->getColumnDimension($columnID)
				->setAutoSize(true);
		}		
		$sheet->getStyle('A1:'.'W'.$rowCount)->applyFromArray(array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			));
		// giao dien

		$sheet->getStyle('A1:AW1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'FFFF00') ) ) );
		$sheet->getStyle('A1:AW1')->getFont()->setBold(true)->getColor()->setRGB('000000');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
	

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "REPORT PACKAGE MANAGER".$tring1.".xlsx";
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