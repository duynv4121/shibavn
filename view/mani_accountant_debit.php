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
		
		$result2 = mysqli_query($conn,"SELECT * FROM ksn_debit where DATE(datetime) >= '$day_start' ".$filldichvu." AND DATE(datetime) <='$day_end'")or die ("Loi");
		

		$tring1 = ' ';
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'STT');
		$sheet->setCellValue('B'.$rowCount,'DEBIT NO');
		$sheet->setCellValue('C'.$rowCount,'SENDER NAME');
		$sheet->setCellValue('D'.$rowCount,'KẾ TOÁN TẠO');
		$sheet->setCellValue('E'.$rowCount,'ACCOUNT NO');
		$sheet->setCellValue('F'.$rowCount,'TẠM ỨNG');
		$sheet->setCellValue('G'.$rowCount,'TOTAL');
		$sheet->setCellValue('H'.$rowCount,'FINAL TOTAL');
		$sheet->setCellValue('I'.$rowCount,'TRẠNG THÁI');
		$sheet->setCellValue('J'.$rowCount,'CÔNG NỢ');
		$sheet->setCellValue('K'.$rowCount,'NOTE TẠM ỨNG');
		$sheet->setCellValue('L'.$rowCount,'GHI CHÚ THÊM');
	

		
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

					$dulieukhachhang = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where cus_code='".$row['idkhachhang']."'"));
					$dulieunguoitao = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$row['uid']."'"));
					$ghichuthemdebit = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit_note where id_debit='".$row['id']."'"));
					
					
					
		
					$sheet->setCellValue('A'.$rowCount,$count);
					$sheet->setCellValue('B'.$rowCount,$row['debitno']);
					$sheet->setCellValue('C'.$rowCount,($dulieukhachhang['congty']));
					$sheet->setCellValue('D'.$rowCount,$dulieunguoitao['ten']);
					$sheet->setCellValue('E'.$rowCount,$row['idkhachhang']);
					$sheet->setCellValue('F'.$rowCount,$row['tamung']);
					$sheet->setCellValue('H'.$rowCount,$row['final_price']);
					$sheet->setCellValue('I'.$rowCount,strip_tags(checkthanhtoan($row['checkthanhtoan'])));
					$sheet->setCellValue('J'.$rowCount,strip_tags(congno($dulieukhachhang['payment_type'])));
					$sheet->setCellValue('K'.$rowCount,$row['tamung_note']);
					$sheet->setCellValue('L'.$rowCount,@$ghichuthemdebit['ghichu']);
				
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

			$count++;		

		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		


		
		foreach(range('A','K') as $columnID) {
			$objExcel->getActiveSheet()->getColumnDimension($columnID)
				->setAutoSize(true);
		}		
		$sheet->getStyle('A1:'.'K'.$rowCount)->applyFromArray(array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			));
		// giao dien

		$sheet->getStyle('A1:K1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'FFFF00') ) ) );
		$sheet->getStyle('A1:K1')->getFont()->setBold(true)->getColor()->setRGB('000000');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
	

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "REPORT DEBIT ".$tring1.".xlsx";
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