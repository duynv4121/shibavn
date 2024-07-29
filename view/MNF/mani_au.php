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
		$sheet->setCellValue('A'.$rowCount,'国家 country');
		$sheet->setCellValue('B'.$rowCount,'运输方式 method');
		$sheet->setCellValue('C'.$rowCount,'原单号 Original order number');
		$sheet->setCellValue('D'.$rowCount,'转单号 Transfer order number');
		$sheet->setCellValue('E'.$rowCount,'收件人名 Recipient name');
		$sheet->setCellValue('F'.$rowCount,'收件人地址 receiver address');
		$sheet->setCellValue('G'.$rowCount,'省 state');
		$sheet->setCellValue('H'.$rowCount,'市 city');
		$sheet->setCellValue('I'.$rowCount,'电话 phone');
		$sheet->setCellValue('J'.$rowCount,'手机号码 phone');
		$sheet->setCellValue('K'.$rowCount,'邮编 post code');
		$sheet->setCellValue('L'.$rowCount,'重量 weight');
		$sheet->setCellValue('M'.$rowCount,'英文品名 English product name');
		$sheet->setCellValue('N'.$rowCount,'中文品名 Chinese product name');
		$sheet->setCellValue('O'.$rowCount,'申报价值1 Declared value 1');
		$sheet->setCellValue('P'.$rowCount,'申报品数量1 Number of declared items 1');
		$sheet->setCellValue('Q'.$rowCount,'COD币种');
		$sheet->setCellValue('R'.$rowCount,'COD金额');
		$sheet->setCellValue('S'.$rowCount,'备注 note');

		
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
			$sheet->setCellValue('A'.$rowCount,'AU');
			$sheet->setCellValue('B'.$rowCount,'AU111');
			$sheet->setCellValue('C'.$rowCount,$listhoadonad['id_code']);
			$sheet->setCellValue('D'.$rowCount,'');
			$sheet->setCellValue('E'.$rowCount,$receiver['name']);
			$sheet->setCellValue('F'.$rowCount,$receiver['address']);
			$sheet->setCellValue('G'.$rowCount,$receiver['state']);
			$sheet->setCellValue('H'.$rowCount,$dulieuthanhpho['name']);
			$sheet->setCellValue('I'.$rowCount,$receiver['phone']);
			$sheet->setCellValue('J'.$rowCount,'');
			$sheet->setCellValue('K'.$rowCount,$receiver['post_code']);
			$sheet->setCellValue('L'.$rowCount,$listhoadonad['cannang']);
			$sheet->setCellValue('M'.$rowCount,$package['kg_tenhang']);
			$sheet->setCellValue('N'.$rowCount,'');
			$sheet->setCellValue('O'.$rowCount,$package['kg_valueinvoice']);
			$sheet->setCellValue('P'.$rowCount,'');
			
			
			/*
			$sheet->setCellValue('A'.$rowCount,'AU');
			$sheet->setCellValue('B'.$rowCount,'AU111');
			$sheet->setCellValue('C'.$rowCount,$listhoadonad['id_code']);
			$sheet->setCellValue('D'.$rowCount,'');
			$sheet->setCellValue('E'.$rowCount,$receiver['name']);
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
			$sheet->setCellValue('W'.$rowCount,$receiver['post_code']);
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
			*/
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
		$file = "FB-CANADA ".$tring1.".xlsx";
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