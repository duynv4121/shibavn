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

		$tring1 = ' MAWB('.$shipment['awb'].')';
		
		$awb_exp =  explode("-", $shipment['awb']);
	
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'Consignment Number');
		$sheet->setCellValue('B'.$rowCount,'Reference');
		$sheet->setCellValue('C'.$rowCount,'Barcodes');
		$sheet->setCellValue('D'.$rowCount,'Internal Account Number');
		$sheet->setCellValue('E'.$rowCount,'Shipper');
		$sheet->setCellValue('F'.$rowCount,'Shipper Address 1');
		$sheet->setCellValue('G'.$rowCount,'Shipper Address 2');
		$sheet->setCellValue('H'.$rowCount,'Shipper Address 3');
		$sheet->setCellValue('I'.$rowCount,'Shipper City');
		$sheet->setCellValue('J'.$rowCount,'Shipper County/State');
		$sheet->setCellValue('K'.$rowCount,'Shipper Zip');
		$sheet->setCellValue('L'.$rowCount,'Shipper Country Code');
		$sheet->setCellValue('M'.$rowCount,'Consignee');
		$sheet->setCellValue('N'.$rowCount,'Address1');
		$sheet->setCellValue('O'.$rowCount,'Address2');
		$sheet->setCellValue('P'.$rowCount,'Address3');
		$sheet->setCellValue('Q'.$rowCount,'City');
		$sheet->setCellValue('R'.$rowCount,'Province');
		$sheet->setCellValue('S'.$rowCount,'Province code');
		$sheet->setCellValue('T'.$rowCount,'ZIP');
		$sheet->setCellValue('U'.$rowCount,'Country Code');
		$sheet->setCellValue('V'.$rowCount,'Email');
		$sheet->setCellValue('W'.$rowCount,'Phone');
		$sheet->setCellValue('X'.$rowCount,'Pieces');
		$sheet->setCellValue('Y'.$rowCount,'Total Weight');
		$sheet->setCellValue('Z'.$rowCount,'Weight UOM');
		$sheet->setCellValue('AA'.$rowCount,'Total Value');
		$sheet->setCellValue('AB'.$rowCount,'Currency');
		$sheet->setCellValue('AC'.$rowCount,'Incoterms');
		$sheet->setCellValue('AD'.$rowCount,'Item Description');
		$sheet->setCellValue('AE'.$rowCount,'Item HS Code');
		$sheet->setCellValue('AF'.$rowCount,'Item Quantity');
		$sheet->setCellValue('AG'.$rowCount,'Item Value');
		$sheet->setCellValue('AH'.$rowCount,'Country Of Origin');
		
		
		
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
			$sheet->setCellValue('A'.$rowCount,"".$listhoadonad['billketnoi']);
			$sheet->setCellValue('B'.$rowCount,'');
			$sheet->setCellValue('C'.$rowCount,$listhoadonad['id_code']);
			$sheet->setCellValue('D'.$rowCount,'');
			$sheet->setCellValue('E'.$rowCount,$sender['company_name']);
			$sheet->setCellValue('F'.$rowCount,$sender['address'].' '.$ward['name'].' '.$district['name']);
			$sheet->setCellValue('G'.$rowCount,'');
			$sheet->setCellValue('H'.$rowCount,'');
			$sheet->setCellValue('I'.$rowCount,location_chinhanh($package['kg_chinhanh']));
			$sheet->setCellValue('J'.$rowCount,location_chinhanh($package['kg_chinhanh']));
			$sheet->setCellValue('K'.$rowCount,vn_portalcode($package['kg_chinhanh']));
			$sheet->setCellValue('L'.$rowCount,'VN');
			$sheet->setCellValue('M'.$rowCount,$receiver['name']);
			$sheet->setCellValue('N'.$rowCount,$receiver['address']);
			$sheet->setCellValue('O'.$rowCount,'');
			$sheet->setCellValue('P'.$rowCount,'');
			$sheet->setCellValue('Q'.$rowCount,$dulieuthanhpho['name']);
			$sheet->setCellValue('R'.$rowCount,$receiver['state']);
			$sheet->setCellValue('S'.$rowCount,$receiver['state']);
			$sheet->setCellValue('T'.$rowCount,$receiver['post_code']);
			$sheet->setCellValue('U'.$rowCount,'CA');
			$sheet->setCellValue('V'.$rowCount,'');
			$sheet->setCellValue('W'.$rowCount,$receiver['phone']);
			$sheet->setCellValue('X'.$rowCount,'1');
			$sheet->setCellValue('Y'.$rowCount,$listhoadonad['cannang']);
			$sheet->setCellValue('Z'.$rowCount,'KGS');
			$sheet->setCellValue('AA'.$rowCount,$package['kg_valueinvoice']);
			$sheet->setCellValue('AB'.$rowCount,'CAD');
			$sheet->setCellValue('AC'.$rowCount,'DDP');
			$sheet->setCellValue('AD'.$rowCount,$package['kg_tenhang']);
			$sheet->setCellValue('AE'.$rowCount,'');
			$sheet->setCellValue('AF'.$rowCount,'');
			$sheet->setCellValue('AG'.$rowCount,'');
			$sheet->setCellValue('AH'.$rowCount,'VN');
			
			$count++;
		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		
		$sheet->getStyle("A1:AG".$rowCount."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));
		
		
		
		
		// giao dien

		$sheet->getStyle('A1:AG1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0099FF') ) ) );
		$sheet->getStyle('A1:AG1')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		foreach(range('A','L') as $columnID)
{
    $objExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}		

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "".$tring1."_.csv";
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