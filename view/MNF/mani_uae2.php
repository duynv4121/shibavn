<?php  
@session_start();
	include("../../excel/PHPExcel.php");
	include("../../conn/db.php");
	include("../../controller/bill.php");

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
		
		$awb_exp =  explode("-", $shipment['awb']);
	
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'No');
		$sheet->setCellValue('B'.$rowCount,'Connote');
		$sheet->setCellValue('C'.$rowCount,'Quantity');
		$sheet->setCellValue('D'.$rowCount,'HAWB Weight (KG)');
		$sheet->setCellValue('E'.$rowCount,'Description');
		$sheet->setCellValue('F'.$rowCount,'Cust. Value (USD)');
		$sheet->setCellValue('G'.$rowCount,'Sender Company');
		$sheet->setCellValue('H'.$rowCount,'Shipper');
		$sheet->setCellValue('I'.$rowCount,'Receiver Company');
		$sheet->setCellValue('J'.$rowCount,'Consignee');
		$sheet->setCellValue('K'.$rowCount,'Phone (Tel / Mobile)');
		$sheet->setCellValue('L'.$rowCount,'Delivery Ad');
		$sheet->setCellValue('M'.$rowCount,'Bag No ');
		$sheet->setCellValue('N'.$rowCount,'-');

		
		
		
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
		$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
		$dulieuthanhpho = mysqli_fetch_assoc(mysqli_query($conn,"select name,state_code from cities where id='".$receiver['city']."'"));
			
			
			
	$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$sender['ward_id']."'"));
	$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$sender['province_id']."'"));
	$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$sender['district_id']."'"));
	
	
	
			$rowCount++;
			$sheet->setCellValue('A'.$rowCount,$count);
			$sheet->setCellValue('B'.$rowCount,'');
			$sheet->setCellValue('C'.$rowCount,'');
			$sheet->setCellValue('D'.$rowCount,$package['gross_weight']);
			$sheet->setCellValue('E'.$rowCount,$package['kg_tenhang']);
			$sheet->setCellValue('F'.$rowCount,$package['kg_valueinvoice']);
			$sheet->setCellValue('G'.$rowCount,$sender['company_name']);
			$sheet->setCellValue('H'.$rowCount,$sender['sender']);
			$sheet->setCellValue('I'.$rowCount,'');
			$sheet->setCellValue('J'.$rowCount,$receiver['name']);
			$sheet->setCellValue('K'.$rowCount,$receiver['phone']);
			$sheet->setCellValue('L'.$rowCount,$receiver['address'].$dulieuthanhpho['name'].$receiver['state']);
			$sheet->setCellValue('M'.$rowCount,$row['box_no']);
			$sheet->setCellValue('N'.$rowCount,'NON-GARMENT');
			/*
			$sheet->setCellValue('A'.$rowCount,'');
			$sheet->setCellValue('B'.$rowCount,$shipment['awb']);
			$sheet->setCellValue('C'.$rowCount,airport_chinhanh($package['kg_chinhanh']));
			$sheet->setCellValue('D'.$rowCount,'JFK');
			$sheet->setCellValue('E'.$rowCount,'JFK');
			$sheet->setCellValue('F'.$rowCount,'CX');
			$sheet->setCellValue('G'.$rowCount,'');
			$sheet->setCellValue('H'.$rowCount,'');
			$sheet->setCellValue('I'.$rowCount,'');
			$sheet->setCellValue('J'.$rowCount,$listhoadonad['billketnoi']);
			$sheet->setCellValue('K'.$rowCount,$package['kg_tenhang']);
			$sheet->setCellValue('L'.$rowCount,'');
			$sheet->setCellValue('M'.$rowCount,$listhoadonad['charge_weight']);
			$sheet->setCellValue('N'.$rowCount,'K');
			$sheet->setCellValue('O'.$rowCount,'1');
			$sheet->setCellValue('P'.$rowCount,$package['kg_valueinvoice']);
			$sheet->setCellValue('Q'.$rowCount,$sender['name']);
			$sheet->setCellValue('R'.$rowCount,$sender['address'].' '.$ward['name'].' '.$district['name']);
			$sheet->setCellValue('S'.$rowCount,'');
			$sheet->setCellValue('T'.$rowCount,$province['name']);
			$sheet->setCellValue('U'.$rowCount,$province['name']);
			$sheet->setCellValue('V'.$rowCount,vn_portalcode($package['kg_chinhanh']));
			$sheet->setCellValue('W'.$rowCount,'VN');
			$sheet->setCellValue('X'.$rowCount,$receiver['name']);
			$sheet->setCellValue('Y'.$rowCount,$receiver['address']);
			$sheet->setCellValue('Z'.$rowCount,'');
			$sheet->setCellValue('AA'.$rowCount,$dulieuthanhpho['name']);
			$sheet->setCellValue('AB'.$rowCount,$receiver['state']);
			$sheet->setCellValue('AC'.$rowCount,$receiver['post_code']);
			$sheet->setCellValue('AD'.$rowCount,'US');
			$sheet->setCellValue('AE'.$rowCount,$listhoadonad['id_code']);
			$sheet->setCellValue('AF'.$rowCount,$string_code_bag.$row['box_no']);
			*/
	
			$count++;
		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		
		$sheet->getStyle("A1:N".$rowCount."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));
		
		
		
		
		// giao dien

		$sheet->getStyle('A1:N1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '95b3d7') ) ) );
		$sheet->getStyle('A1:N1')->getFont()->setBold(true)->getColor()->setRGB('14191e');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		foreach(range('A','W') as $columnID)
{
    $objExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}		

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "MANI DUBAI ".$tring1.".xlsx";
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