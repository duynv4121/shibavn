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
	function exportKetoan($datefrom, $dateto){
		$tring1 = 'Dữ liệu hàng air từ ngày '.$datefrom.' đến '.$dateto;
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('Kế toán AIR');


		$sheet->setCellValue('A1',$tring1);
		$objExcel->getActiveSheet()->mergeCells('A1:E1');

		$rowCount = 2;
		$sheet->setCellValue('A'.$rowCount,'ID');
		$sheet->setCellValue('B'.$rowCount,'Người gửi');
		$sheet->setCellValue('C'.$rowCount,'Người nhận');
		$sheet->setCellValue('D'.$rowCount,'Kiện nhỏ');
		$sheet->setCellValue('E'.$rowCount,'Cân nặng');
		$sheet->setCellValue('F'.$rowCount,'Chi hộ');
		$sheet->setCellValue('G'.$rowCount,'Total');
		$sheet->setCellValue('H'.$rowCount,'Tiền mặt');
		$sheet->setCellValue('I'.$rowCount,'Chuyển khoản');
		$sheet->setCellValue('J'.$rowCount,'Nợ');
		
		$result = mysql_query("SELECT * FROM ns_package  WHERE `date` between '$datefrom' and '$dateto'");
		
		$count = 1;
		$sokien = 0;
		$sumtienmat = 0;
		$sumchuyenkhoan = 0;
		$sumno = 0;
		$sumtotal = 0;
		while($row  = mysql_fetch_array($result))
		{
			$idhoadon = $row['id'];
			
      	$sender = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id ='".$row['id_nguoigui']."'"));
      	$receiver = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id ='".$row['id_nguoinhan']."'"));
      
			$sub = mysql_query("SELECT * FROM ns_listhoadon WHERE id_package = '".$row['id']."'"); 
			$str = "";
			$cannang = 0;
			$temp = "\n";
	      while ($s = mysql_fetch_array($sub)) {
	         $str .= '- ID: '.$s['id'].' | Cân nặng: '.$s['cannang'].$temp;
	         $cannang += $s['cannang'];
	      }
			$payment = mysql_query("SELECT * FROM ns_payment WHERE id_package = '".$row['id']."'");
			$tienmat = 0;
			$chuyenkhoan = 0;
			$no = 0;
			if (mysql_num_rows($payment) == 0) {
				$no = $row['total'];
			}else{
				while ($p = mysql_fetch_array($payment)) {
					$tienmat += $p['tienmat'];
					$chuyenkhoan += $p['chuyenkhoan'];
				}
				$no = $row['total'] - ($tienmat + $chuyenkhoan);
			}
			$sumtienmat += $tienmat;
			$sumchuyenkhoan += $chuyenkhoan;
			$sumno += $no;
			$sumtotal += $row['total'];
			$rowCount++;
			$sheet->setCellValue('A'.$rowCount,$row['id']);
			$sheet->setCellValue('B'.$rowCount,$sender['name']);
			$sheet->setCellValue('C'.$rowCount,$receiver['name']);
			$sheet->setCellValue('D'.$rowCount,$str);
			$sheet->getStyle('D'.$rowCount)->getAlignment()->setWrapText(true);
			$sheet->setCellValue('E'.$rowCount,$cannang);
			$sheet->setCellValue('F'.$rowCount,$row['chiho']);
			$sheet->setCellValue('G'.$rowCount,$row['total']);
			$sheet->setCellValue('H'.$rowCount,$tienmat);
			$sheet->setCellValue('I'.$rowCount,$chuyenkhoan);
			$sheet->setCellValue('J'.$rowCount,$no);

			
			$count++;
		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
		$sheet->setCellValue('G'.$linemoi,$sumtotal);
		$sheet->setCellValue('H'.$linemoi,$sumtienmat);
		$sheet->setCellValue('I'.$linemoi,$sumchuyenkhoan);
		$sheet->setCellValue('J'.$linemoi,$sumno);

		$sheet->setCellValue('G'.$linemoi2,"TOTAL");
		$sheet->setCellValue('H'.$linemoi2,"Tiền mặt");
		$sheet->setCellValue('I'.$linemoi2,"Chuyển khoản");
		$sheet->setCellValue('J'.$linemoi2,"Nợ");


		$sheet->getStyle('G'.$linemoi2.':J'.$linemoi2)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '#000000') ) ) );
		$sheet->getStyle('G'.$linemoi2.':J'.$linemoi2)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');

		// xuất tổng kết 

		cellColor('G'.($linemoi2+1).':J'.($linemoi2+1), '66CCFF', $objExcel);


		// giao dien

		$sheet->getStyle('A2:J2')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '#000000') ) ) );
		$sheet->getStyle('A2:J2')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		$sheet->getStyle("A1:J".$rowCount."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));





		///////
		$objExcel->createSheet();
		$objExcel->setActiveSheetIndex(1);
		$sheet_sea = $objExcel->getActiveSheet()->setTitle('Kế toán SEA');
		$tring_sea = 'Dữ liệu hàng sea từ ngày '.$datefrom.' đến '.$dateto;

		$sheet_sea->setCellValue('A1',$tring_sea);
		$objExcel->getActiveSheet()->mergeCells('A1:E1');

		$rowCount_sea = 2;
		$sheet_sea->setCellValue('A'.$rowCount_sea,'ID');
		$sheet_sea->setCellValue('B'.$rowCount_sea,'Người gửi');
		$sheet_sea->setCellValue('C'.$rowCount_sea,'Người nhận');
		$sheet_sea->setCellValue('D'.$rowCount_sea,'Kiện nhỏ');
		$sheet_sea->setCellValue('E'.$rowCount_sea,'Cân nặng');
		$sheet_sea->setCellValue('F'.$rowCount_sea,'Chi hộ');
		$sheet_sea->setCellValue('G'.$rowCount_sea,'Total');
		$sheet_sea->setCellValue('H'.$rowCount_sea,'Tiền mặt');
		$sheet_sea->setCellValue('I'.$rowCount_sea,'Chuyển khoản');
		$sheet_sea->setCellValue('J'.$rowCount_sea,'Nợ');
		
		$result_sea = mysql_query("SELECT * FROM ns_package_sea  WHERE `date` between '$datefrom' and '$dateto'") or die(mysql_error());
		
		$count_sea = 1;
		$sokien_sea = 0;
		$sumtienmat_sea = 0;
		$sumchuyenkhoan_sea = 0;
		$sumno_sea = 0;
		$sumtotal_sea = 0;
		while($row  = mysql_fetch_array($result_sea))
		{
			$idhoadon = $row['id'];
			
	      	$sender = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id ='".$row['id_nguoigui']."'"));
	      	$receiver = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id ='".$row['id_nguoinhan']."'"));
      
			$sub = mysql_query("SELECT * FROM ns_listhoadon_sea WHERE id_package = '".$row['id']."'"); 
			$str = "";
			$cannang_sea = 0;
			$temp = "\n";
		    while ($s = mysql_fetch_array($sub)) {
		        $str .= '- ID: '.$s['id'].' | Cân nặng: '.$s['cannang'].$temp;
		        $cannang_sea += $s['cannang'];
		    }
			$payment = mysql_query("SELECT * FROM ns_payment WHERE id_package = '".$row['id']."'");
			$tienmat_sea = 0;
			$chuyenkhoan_sea = 0;
			$no_sea = 0;
			if (mysql_num_rows($payment) == 0) {
				$no_sea = $row['total'];
			}else{
				while ($p = mysql_fetch_array($payment)) {
					$tienmat_sea += $p['tienmat'];
					$chuyenkhoan_sea += $p['chuyenkhoan'];
				}
				$no_sea = $row['total'] - ($tienmat_sea + $chuyenkhoan_sea);
			}
			$sumtienmat_sea += $tienmat_sea;
			$sumchuyenkhoan_sea += $chuyenkhoan_sea;
			$sumno_sea += $no_sea;
			$sumtotal_sea += $row['total'];
			$rowCount_sea++;
			$sheet_sea->setCellValue('A'.$rowCount_sea,$row['id']);
			$sheet_sea->setCellValue('B'.$rowCount_sea,$sender['name']);
			$sheet_sea->setCellValue('C'.$rowCount_sea,$receiver['name']);
			$sheet_sea->setCellValue('D'.$rowCount_sea,$str);
			$sheet_sea->getStyle('D'.$rowCount_sea)->getAlignment()->setWrapText(true);
			$sheet_sea->setCellValue('E'.$rowCount_sea,$cannang_sea);
			$sheet_sea->setCellValue('F'.$rowCount_sea,$row['chiho']);
			$sheet_sea->setCellValue('G'.$rowCount_sea,$row['total']);
			$sheet_sea->setCellValue('H'.$rowCount_sea,$tienmat_sea);
			$sheet_sea->setCellValue('I'.$rowCount_sea,$chuyenkhoan_sea);
			$sheet_sea->setCellValue('J'.$rowCount_sea,$no_sea);

			
			$count++;
		}
		$linemoi_sea = $rowCount_sea + 2;
		$linemoi2_sea = $rowCount_sea + 1;
		$sheet_sea->setCellValue('G'.$linemoi_sea,$sumtotal_sea);
		$sheet_sea->setCellValue('H'.$linemoi_sea,$sumtienmat_sea);
		$sheet_sea->setCellValue('I'.$linemoi_sea,$sumchuyenkhoan_sea);
		$sheet_sea->setCellValue('J'.$linemoi_sea,$sumno_sea);

		$sheet_sea->setCellValue('G'.$linemoi2_sea,"TOTAL");
		$sheet_sea->setCellValue('H'.$linemoi2_sea,"Tiền mặt");
		$sheet_sea->setCellValue('I'.$linemoi2_sea,"Chuyển khoản");
		$sheet_sea->setCellValue('J'.$linemoi2_sea,"Nợ");


		$sheet_sea->getStyle('G'.$linemoi2_sea.':J'.$linemoi2_sea)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '#000000') ) ) );
		$sheet_sea->getStyle('G'.$linemoi2_sea.':J'.$linemoi2_sea)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');

		// xuất tổng kết 

		cellColor('G'.($linemoi2_sea+1).':J'.($linemoi2_sea+1), '66CCFF', $objExcel);


		// giao dien

		$sheet_sea->getStyle('A2:J2')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '#000000') ) ) );
		$sheet_sea->getStyle('A2:J2')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet_sea->getHighestDataColumn()) as $col) {
		        $sheet_sea->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		$sheet_sea->getStyle("A1:J".$rowCount_sea."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));
				


		$objExcel->createSheet();
		$objExcel->setActiveSheetIndex(2);

		$linemoi4 = 1;
		$tring3 = 'Dữ liệu chi từ ngày '.$datefrom.' đến '.$dateto;
		$sheet2 = $objExcel->getActiveSheet()->setTitle('Kế toán chi');
		$sheet2->setCellValue('A'.$linemoi4,$tring3);
		$objExcel->getActiveSheet()->mergeCells('A'.$linemoi4.':D'.$linemoi4);


		$linemoi4++;

		$sheet2->setCellValue('A'.$linemoi4,"STT");
		$sheet2->setCellValue('B'.$linemoi4,"Ngày");
		$sheet2->setCellValue('C'.$linemoi4,"Số tiền");
		$sheet2->setCellValue('D'.$linemoi4,"Nội dung");
		$count3 = 1;
		$rowCount3 = $linemoi4;
		$thungoaidon = mysql_query("SELECT * FROM ns_payment_chi WHERE DATE(`date`) between '$datefrom' and '$dateto'");
		while ($row = mysql_fetch_array($thungoaidon)) {
			$rowCount3++;
			$sheet2->setCellValue('A'.$rowCount3,$count3);
			$sheet2->setCellValue('B'.$rowCount3,$row['date']);
			$sheet2->setCellValue('C'.$rowCount3,$row['money']);
			$sheet2->setCellValue('D'.$rowCount3,$row['content']);
			$count3++;
		}


		$sheet2->getStyle('A2:D2')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '#000000') ) ) );
		$sheet2->getStyle('A2:D2')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet2->getHighestDataColumn()) as $col) {
		        $sheet2->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		$sheet2->getStyle("A2:D".$rowCount3."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));
				


		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "Ke toan ".$datefrom." den ".$dateto.".xlsx";
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

	if (isset($_POST['btn_loc'])) {
		$datefrom = $_POST['datefrom'];
		$dateto = $_POST['dateto'];
		exportKetoan($datefrom, $dateto);
	}
?>