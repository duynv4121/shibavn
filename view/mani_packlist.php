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
				$string_code_bag = '';
			}
			else
			{

				$string_code_bag = '';
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
		$sheet->setCellValue('E'.$rowCount,'BOX NO');
		$sheet->setCellValue('F'.$rowCount,'Weight');
		$sheet->setCellValue('G'.$rowCount,'Length');
		$sheet->setCellValue('H'.$rowCount,'Width');
		$sheet->setCellValue('I'.$rowCount,'Height');
		
		
		
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
			
			
			$rowCount++;
			$sheet->setCellValue('A'.$rowCount,$count);
			$sheet->setCellValue('B'.$rowCount,$package['id_code']);
			$sheet->setCellValue('C'.$rowCount,$idhoadon);
			$sheet->setCellValue('D'.$rowCount,$listhoadonad['billketnoi']);
			$sheet->setCellValue('E'.$rowCount,$string_code_bag.$row['box_no']);
			$sheet->setCellValue('F'.$rowCount,$listhoadonad['cannang']);
			$sheet->setCellValue('G'.$rowCount,$listhoadonad['length']);
			$sheet->setCellValue('H'.$rowCount,$listhoadonad['width']);
			$sheet->setCellValue('I'.$rowCount,$listhoadonad['height']);
			
			$count++;
		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		

		
		

		
		// giao dien

		$sheet->getStyle('A1:I1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0099FF') ) ) );
		$sheet->getStyle('A1:I1')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		$sheet->getStyle("A1:I".$rowCount."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));
				

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "PACKAGE LIST".$tring1.".xlsx";
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