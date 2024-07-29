<?php  
	@session_start();
	include("../excel/PHPExcel.php");
	include("../conn/db.php");
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
	function exportMNF($id){
		$tring1 = 'Shipment:  '.$id;
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');
		
		
		
		
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
		$result = mysql_query("SELECT * FROM gpe_shipment_malay_details WHERE awb = '$id'")or die(mysql_error());
		
		$tinhtotalkien = mysql_num_rows($result);

		$objExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(15);
		$sheet->setCellValue('A1','Destination :')->getStyle('A1')->applyFromArray($styleArray2);
		$sheet->setCellValue('A2','Flight No :'.$id)->getStyle('A2')->applyFromArray($styleArray2);
		$sheet->setCellValue('C2','Total Package :')->getStyle('C2')->applyFromArray($styleArray2);
		$sheet->setCellValue('D2',$tinhtotalkien)->getStyle('D2')->applyFromArray($styleArray2);

		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 3;
		$sheet->setCellValue('A'.$rowCount,'AWB No');
		$sheet->setCellValue('B'.$rowCount,'Item details');
		$sheet->setCellValue('C'.$rowCount,'Weight');
		$sheet->setCellValue('D'.$rowCount,'Shipper');
		$sheet->setCellValue('E'.$rowCount,'Cnee');
		$sheet->setCellValue('F'.$rowCount,'Address');
		$sheet->setCellValue('G'.$rowCount,'Phone No');

		foreach(range('A','I') as $columnID) {
    $objExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}

		
	
		$count = 1;
		$cannang = 0;
		$sokien = 0;
		while($row  = mysql_fetch_array($result))
		{
			
			$idhoadon = $row['id_listhoadon'];
			$listhoadonad = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_listhoadon WHERE id='".$row['id_listhoadon']."'"))or die(mysql_error());
			$package = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package WHERE id='".$listhoadonad['id_package']."'"));
      $sender = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
      $receiver = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
      $address_nguoinhan = $receiver['address'];
			$listcatalog = mysql_query("SELECT * FROM ns_mapcatalog WHERE id_bill = '".$row['id_listhoadon']."'");
              $arr = [];
              while ($item = mysql_fetch_array($listcatalog)) {
                $type = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_catalog WHERE id = '".$item['id_catalog']."'"));
				
				
                array_push($arr, $type['type_en']);
            }
            $str = join(',',$arr);
			//$cannang += $row['cannang'];
			//$sokien += $row['sokien'];
			
			$rowCount++;
			$sheet->setCellValue('A'.$rowCount,$row['id_listhoadon']);
			$sheet->setCellValue('B'.$rowCount,$str);
			$sheet->setCellValue('C'.$rowCount,$listhoadonad['cannang']);
			$sheet->setCellValue('D'.$rowCount,$sender['name']);
			$sheet->setCellValue('E'.$rowCount,$receiver['name']);
			$sheet->setCellValue('F'.$rowCount,$receiver['address']);
			$sheet->setCellValue('G'.$rowCount,$receiver['phone']);
			
			
			$count++;
		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		

		
		

		
		// giao dien

		$sheet->getStyle('A3:G3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0099FF') ) ) );
		$sheet->getStyle('A3:G3')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		$sheet->getStyle("A3:G".$rowCount."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));
				

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "MNF_AIR.xlsx";
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

	}

	if (isset($_GET['id'])) {
		 
		$layidship = mysql_fetch_assoc(mysql_query("select * from gpe_shipment_malay where id='".$_GET['id']."'"));
		exportMNF($layidship['awb']);
	}
?>