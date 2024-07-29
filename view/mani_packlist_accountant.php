<?php  
@session_start();
	include("../excel/PHPExcel.php");
	include("../conn/db.php");
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
		$id = $_GET['id'];
		$result2 = mysqli_query($conn,"SELECT * FROM ksn_shipment_details where awb='$id'")or die ("Loi");
		$shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_shipment WHERE id = '$id' "));




			$datenowa =  strtotime("2023-08-27 01:01:01");
			if(strtotime($shipment['date_time']) >= $datenowa)
			{
				$string_code_bag = 'KSN';
			}
			else
			{

				$string_code_bag = 'BKG';
			}



		$tring1 = ' MAWB('.$shipment['awb'].')';
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'No');
		$sheet->setCellValue('B'.$rowCount,'AWB');
		$sheet->setCellValue('C'.$rowCount,'HAWB');
		$sheet->setCellValue('D'.$rowCount,'TRACKING #');
		$sheet->setCellValue('E'.$rowCount,'Weight');
		$sheet->setCellValue('F'.$rowCount,'Length');
		$sheet->setCellValue('G'.$rowCount,'Width');
		$sheet->setCellValue('H'.$rowCount,'Height');
		$sheet->setCellValue('I'.$rowCount,'C.W');
		$sheet->setCellValue('J'.$rowCount,'Mặt hàng phụ thu');
		$sheet->setCellValue('K'.$rowCount,'HÌNH ẢNH MẶT HÀNG');
		$sheet->setCellValue('L'.$rowCount,'SENDER COMPANY');
		$sheet->setCellValue('M'.$rowCount,'RECEIVER NAME');
		
		
		
		/*
		foreach(range('A','I') as $columnID) {
    $objExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}		
		*/


		
		
		echo $id;
		
		$count = 1;
		$cannang = 0;
		$sokien = 0;
		while($row  = mysqli_fetch_array($result2,MYSQLI_ASSOC))
		{
			
			
			
			
			
			$idhoadon = $row['id_listhoadon'];
			$listhoadonad = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id_code='".$row['id_listhoadon']."'"));
			$package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id='".$listhoadonad['id_package']."'"));
			  $sender = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
			  $receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
			  $address_nguoinhan = $receiver['address'];
			
			
			
			
		
			$stringphuthu = '';
		
			$listhoadonphuthua = mysqli_query($conn,"select * from kns_listhoadonphuthu where id_code='".$row['id_listhoadon']."'")or die("Loii");
			while($listhoadonphuthu = mysqli_fetch_array($listhoadonphuthua))
			{
			$stringphuthu.= $listhoadonphuthu['tenphuthu'].'['.$listhoadonphuthu['soluong'].'] ';
			}	
		
			
			
			
			$rowCount++;
			$sheet->setCellValue('A'.$rowCount,$count);
			$sheet->setCellValue('B'.$rowCount,$package['id_code']);
			$sheet->setCellValue('C'.$rowCount,$idhoadon);
			$sheet->setCellValue('D'.$rowCount,$listhoadonad['billketnoi']);
			$sheet->setCellValue('E'.$rowCount,$listhoadonad['cannang']);
			$sheet->setCellValue('F'.$rowCount,$listhoadonad['length']);
			$sheet->setCellValue('G'.$rowCount,$listhoadonad['width']);
			$sheet->setCellValue('H'.$rowCount,$listhoadonad['height']);
			$sheet->setCellValue('I'.$rowCount,$listhoadonad['charge_weight']);
			$sheet->setCellValue('J'.$rowCount,$stringphuthu);
			
				$myArray = explode(',', $listhoadonad['img_xuat']);
							$stringthem = '';
							$somang = count($myArray);
							$i = 1;
							foreach ($myArray as $a){
								$stringthem .= 'https://GPE-post.com/upload/'.$a.'';
								if($i < $somang)
								{
									$stringthem .= ''.PHP_EOL;
								}
								$i++;
							}
			$sheet->setCellValue('K'.$rowCount,$stringthem);

			$objExcel->getActiveSheet()->getStyle('K'.$rowCount)->getAlignment()->setWrapText(true);

			$sheet->setCellValue('L'.$rowCount,$sender['company_name']);
			$sheet->setCellValue('M'.$rowCount,$receiver['name']);
			$objExcel->getActiveSheet()->getCell('K'.$rowCount)->getHyperlink()->setUrl(strip_tags('https://GPE-post.com/upload/'.$listhoadonad['img_xuat']));

			$count++;
		}
		
		$objExcel->getActiveSheet()->getStyle('H5')->getAlignment()->setWrapText(true);
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		

		
		

		
		// giao dien

		$sheet->getStyle('A1:M1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0099FF') ) ) );
		$sheet->getStyle('A1:M1')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		$sheet->getStyle("A1:M".$rowCount."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));
				

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "REPORT ".$tring1.".xlsx";
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