<?php  
	@session_start();
	include("../../excel/PHPExcel.php");
	include("../../conn/db.php");
	include("../../controller/accountant.php");
	include("../../controller/bill.php");

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
	function exportMNF($id,$conn){
		$tring1 = 'Shipment:  '.$id;
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'No');
		$sheet->setCellValue('B'.$rowCount,'Bag No');
		$sheet->setCellValue('C'.$rowCount,'AWB No');
		$sheet->setCellValue('D'.$rowCount,'查看單號');
		$sheet->setCellValue('E'.$rowCount,'Item details');
		$sheet->setCellValue('F'.$rowCount,'Weight');
		$sheet->setCellValue('G'.$rowCount,'Shipper');
		$sheet->setCellValue('H'.$rowCount,'Cnee');
		$sheet->setCellValue('I'.$rowCount,'ID No');
		$sheet->setCellValue('J'.$rowCount,'Address');
		$sheet->setCellValue('K'.$rowCount,'Phone No');
		foreach(range('A','I') as $columnID) {
		$objExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		
		$result = mysqli_query($conn,"SELECT * FROM ksn_shipment_details WHERE awb = '$id'")or die(mysqli_error($conn));
	
		$count = 1;
		$cannang = 0;
		$sokien = 0;
		while($row  = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			
			
			$idhoadon = $row['id_listhoadon'];
			$listhoadonad = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id_code='".$row['id_listhoadon']."'"));
			$package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id='".$listhoadonad['id_package']."'"));
			$sender = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
			$receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
			$address_nguoinhan = $receiver['address'];
			if($sender['company_name'] != "GIA PHU EXPRESS" && $sender['company_name'] != "GPExpress")
			{
				$shipper = $sender['company_name'];
			}
			else
			{	
				$shipper = $sender['name'];
			}
			
			
			$listcatalog = mysqli_query($conn,"SELECT * FROM ns_mapcatalog WHERE id_bill = '".$listhoadonad['id']."'");
			
              $arr = [];
              while ($item = mysqli_fetch_array($listcatalog)) {
                $type = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_catalog WHERE id = '".$item['id_catalog']."'"));
				
				if($type['type_en'] == "ICE")
				{
					$sheet->getStyle('A'.($rowCount+1).':K'.($rowCount+1).'')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '6699FF') ) ) );
				}
                array_push($arr, $type['type_en']);
            }
			            $str = join(',',$arr);

			
			$rowCount++;
			$sheet->setCellValue('A'.$rowCount,$count);
			$sheet->setCellValue('B'.$rowCount,$row['box_no']);
			$sheet->setCellValue('C'.$rowCount,$idhoadon);
			$sheet->setCellValue('D'.$rowCount,$listhoadonad['code_kerry'].''.$listhoadonad['code_tcat']);
			$sheet->setCellValue('E'.$rowCount,$str);
			$sheet->setCellValue('F'.$rowCount,$listhoadonad['charge_weight']);
			$sheet->setCellValue('G'.$rowCount,$shipper);
			$sheet->setCellValue('H'.$rowCount,$receiver['name']);
			$sheet->setCellValue('I'.$rowCount,$receiver['id_no']);
			$sheet->setCellValue('J'.$rowCount,$address_nguoinhan);
			$sheet->setCellValue('K'.$rowCount,$receiver['phone']);
			$count++;
		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	
		// giao dien

		$sheet->getStyle('A1:K1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0099FF') ) ) );
		$sheet->getStyle('A1:K1')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		$sheet->getStyle("A1:K".$rowCount."")->applyFromArray(array(
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
		 
		$layidship = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment where id='".$_GET['id']."'"));
		exportMNF($layidship['id'],$conn);
	}
?>