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
		
		$result2 = mysqli_query($conn,"SELECT * FROM ksn_ketoanchi where DATE(datetime) >= '$day_start' ".$filldichvu." AND DATE(datetime) <='$day_end' order by id desc")or die ("Loi");
		

		$tring1 = ' ';
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'DATE');
		$sheet->setCellValue('B'.$rowCount,'KẾ TOÁN');
		$sheet->setCellValue('C'.$rowCount,'CHI NHÁNH');
		$sheet->setCellValue('D'.$rowCount,'TIỀN CHI(CASH)');
		$sheet->setCellValue('E'.$rowCount,'TIỀN NHẬN(CASH)');
		$sheet->setCellValue('F'.$rowCount,'TIỀN CHI(BANK)');
		$sheet->setCellValue('G'.$rowCount,'ĐỐI TÁC ');
		$sheet->setCellValue('H'.$rowCount,'CHI LƯƠNG');
		$sheet->setCellValue('I'.$rowCount,'TOTAL CHI');
		$sheet->setCellValue('J'.$rowCount,'QUỸ TIỀN MẶT CÒN LẠI');
		$sheet->setCellValue('K'.$rowCount,'NỘI DUNG CHI');
		$sheet->setCellValue('L'.$rowCount,'BIÊN LAI');
	

		
		/*
		foreach(range('A','I') as $columnID) {
    $objExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}		
		*/


		
		
		
		$count = 1;
		$cannang = 0;
		$sokien = 0;
		$cash = 0;
		$banking =0;
		$quytienmat = 0;
		while($row  = mysqli_fetch_array($result2,MYSQLI_ASSOC))
		{
					$rowCount++;

					//$dulieukhachhang = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where cus_code='".$row['idkhachhang']."'"));
					$dulieunguoitao = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$row['uid']."'"));
					//$ghichuthemdebit = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit_note where id_debit='".$row['id']."'"));
					
						$sheet->setCellValue('A'.$rowCount,$row['datetime']);
						$sheet->setCellValue('B'.$rowCount,$dulieunguoitao['ten']);
						$sheet->setCellValue('C'.$rowCount,$row['kg_chinhanh']);
						
						if($row['check_thu'] == '1')
						{
						$sheet->setCellValue('E'.$rowCount,$row['payment_price']);
						$sheet->setCellValue('I'.$rowCount,'0');
						$quytienmat+=$row['payment_price'];
						}
						else
						{
							if($row['payment_method'] == 'cash')
							{
								$sheet->setCellValue('D'.$rowCount,$row['payment_price']);
								$cash+=$row['payment_price'];
							}
							if($row['payment_method'] == 'banking')
							{
								$sheet->setCellValue('F'.$rowCount,$row['payment_price']);
								$banking+=$row['payment_price'];
							}
						
						$sheet->setCellValue('I'.$rowCount,$row['payment_price']);

						}
						if($row['check_luong'] == '1')
						{
						$sheet->setCellValue('H'.$rowCount,$row['noidung']);
						$sheet->setCellValue('K'.$rowCount,'Chi Lương');

						}
						else
						{
						$sheet->setCellValue('K'.$rowCount,$row['noidung']);

						}
						$sheet->setCellValue('G'.$rowCount,$row['doitac']);
						
						
						$myArray = explode(',', $row['img']);
							$stringthem = '';
							$somang = count($myArray);
							$i = 1;
							foreach ($myArray as $a){
								$stringthem .= 'https://GPE-post.com/upload/'.$a.'';
								if($i < $somang)
								{
									$stringthem .= ' '.PHP_EOL;
								}
								$i++;
							}
												$sheet->setCellValue('L'.$rowCount,$stringthem);


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
		$rowCount++;

		$sheet->setCellValue('D'.$rowCount,$cash);
		$sheet->setCellValue('E'.$rowCount,$quytienmat);
		$sheet->setCellValue('F'.$rowCount,$banking);
		$sheet->setCellValue('J'.$rowCount,$quytienmat-$cash);

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