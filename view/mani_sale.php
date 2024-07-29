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
		$id = $_GET['id'];
		$day_start = $_GET['day_start'];
		$day_end = $_GET['day_end'];
		
		echo $id;
		echo $day_start;
		echo $day_end;
		
		$result2 = mysqli_query($conn,"SELECT * FROM ns_package where uid='$id' AND date>='$day_start' AND date<='$day_end'")or die ("Loi");
		
		
		
		$tring1 = ' Sale Export';
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'No');
		$sheet->setCellValue('B'.$rowCount,'Date');
		$sheet->setCellValue('C'.$rowCount,'KG BILL NO');
		$sheet->setCellValue('D'.$rowCount,'TRACKING');
		$sheet->setCellValue('E'.$rowCount,'CONTACT NAME');
		$sheet->setCellValue('F'.$rowCount,'SERVICE');
		$sheet->setCellValue('G'.$rowCount,'Chi nhánh');
		$sheet->setCellValue('H'.$rowCount,'DESTINATION');
		$sheet->setCellValue('I'.$rowCount,'TYPE');
		$sheet->setCellValue('J'.$rowCount,'Số Kiện');
		$sheet->setCellValue('K'.$rowCount,'Weight Tính Khách');
		$sheet->setCellValue('L'.$rowCount,'CHARGEABLE WEIGHT');
		$sheet->setCellValue('M'.$rowCount,'Cước Bay');
		$sheet->setCellValue('N'.$rowCount,'Cước Phụ thu');
		$sheet->setCellValue('O'.$rowCount,'Cước Nội Địa');
		$sheet->setCellValue('P'.$rowCount,'Thu Hộ');
		$sheet->setCellValue('Q'.$rowCount,'VAT ');
		$sheet->setCellValue('R'.$rowCount,'Total VAT');
		$sheet->setCellValue('S'.$rowCount,'Total Khách Thanh Toán');
		$sheet->setCellValue('T'.$rowCount,'Ghi Chú Mặt Hàng');
		$sheet->setCellValue('U'.$rowCount,'Tiền Thùng');
		$sheet->setCellValue('V'.$rowCount,'Cước Gốc');
		$sheet->setCellValue('W'.$rowCount,'Lợi Nhuận');
		$sheet->setCellValue('X'.$rowCount,'Hoa Hồng');
		$sheet->setCellValue('Y'.$rowCount,'BIÊN LAI THANH TOÁN');
		$sheet->setCellValue('Z'.$rowCount,'Trạng Thái');
		
		
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
			
			if($row['vat'] == '1')
		{
			$vat_string = '10%';
			$vat = 10;
			$vat2 =1;
		}
		else
			
			{
			$vat_string = 'No';
			$vat = 0;
			$vat2=0;
			}
			echo 'aaaaaaaaaaa';
			
      $sender = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$row['id_nguoigui']."'"));
      $receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$row['id_nguoinhan']."'"));
	  @$checkdebit = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ksn_debit_sale WHERE id_bill ='".$row['id_code']."' LIMIT 1"));

      $address_nguoinhan = $receiver['address'];
		@$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
		$totalcuoc = sum_package_sale($row['khach_cuocbay'],$row['khach_phuthu'],$row['khach_cuocnoidia'],$row['khach_thuho'],$row['khach_phibaohiem'],$vat2);
		$sotiengoc= sum_package_code($row['kg_dichvu'],$row['charge_weight'],$receiver['city'],$receiver['country_id'],$row['kg_chinhanh'],$conn,$receiver['post_code'],$receiver['state']);

		
			
		$status_payment = '';
		if($checkdebit >= 1)
		{
			@$laydebit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_debit_sale WHERE id_bill ='".$row['id_code']."' LIMIT 1"));
			if(@$laydebit['valid'] != 1)
			{
				$status_payment = 'Chờ duyệt';
			}
			else
			{
				@$laydulieuketoan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id ='".$laydebit['valid_uid']."' LIMIT 1"));

				$status_payment = '[Kế toán Duyệt : '.@$laydulieuketoan['ten'].'] http://GPE.online/upload/'.@$laydebit['bangchungthanhtoan'];

			}
		}
		
			
			$rowCount++;
		$sheet->setCellValue('A'.$rowCount,$count);
		$sheet->setCellValue('B'.$rowCount,$row['date']);
		$sheet->setCellValue('C'.$rowCount,$row['id_code']);
		$sheet->setCellValue('D'.$rowCount,'');
		$sheet->setCellValue('E'.$rowCount,$receiver['name']);
		$sheet->setCellValue('F'.$rowCount,dichvu($conn,$row['kg_dichvu']));
		$sheet->setCellValue('G'.$rowCount,$row['kg_chinhanh']);
		$sheet->setCellValue('H'.$rowCount,$dulieuquocgia['name']);
		$sheet->setCellValue('I'.$rowCount,'SPX');
		$sheet->setCellValue('J'.$rowCount,$row['sokien']);
		$sheet->setCellValue('K'.$rowCount,$row['khach_cannang']);
		$sheet->setCellValue('L'.$rowCount,$row['charge_weight']);
		$sheet->setCellValue('M'.$rowCount,$row['khach_cuocbay']);
		$sheet->setCellValue('N'.$rowCount,$row['khach_phuthu']);
		$sheet->setCellValue('O'.$rowCount,$row['khach_cuocnoidia']);
		$sheet->setCellValue('P'.$rowCount,$row['khach_thuho']);
		$sheet->setCellValue('Q'.$rowCount,$vat_string);
		$sheet->setCellValue('R'.$rowCount,($row['khach_cuocbay']*$vat/100));
		$sheet->setCellValue('S'.$rowCount,''.$totalcuoc);
		$sheet->setCellValue('T'.$rowCount,'',$row['kg_tenhang']);
		$sheet->setCellValue('U'.$rowCount,''.$row['sokien']*50000);
		$sheet->setCellValue('V'.$rowCount,''.$sotiengoc);
		$sheet->setCellValue('W'.$rowCount,''.($row['khach_cuocbay']-($sotiengoc+$row['sokien']*50000)));
		$sheet->setCellValue('X'.$rowCount,'');
		$sheet->setCellValue('Y'.$rowCount,$status_payment);
		$sheet->setCellValue('Z'.$rowCount,Strip_tags(checkthanhtoan($row['checkthanhtoan'])));
			
			$count++;
		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		


		

		
		// giao dien

		$sheet->getStyle('A1:Y1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0099FF') ) ) );
		$sheet->getStyle('A1:Y1')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
		$sheet->getStyle("A1:Y".$rowCount."")->applyFromArray(array(
		            'borders' => array(
		                'allborders' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN
		                )
		            )
		        ));
				

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "SALE ID".$tring1.".xlsx";
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