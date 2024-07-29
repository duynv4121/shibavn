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
		
		$result2 = mysqli_query($conn,"SELECT * FROM ns_package where date >= '$day_start'  ".$filldichvu."  AND date <='$day_end' AND sokien<>'0'")or die ("Loi");
		
		

		$tring1 = ' ';
		$objExcel = new PHPExcel;
		
		$objExcel->setActiveSheetIndex(0);
		$sheet = $objExcel->getActiveSheet()->setTitle('MNF ');


		//$objExcel->getActiveSheet()->mergeCells('A3:E3');

		$rowCount = 1;
		$sheet->setCellValue('A'.$rowCount,'SHIPPER COMPANY');
		$sheet->setCellValue('B'.$rowCount,'SHIPPER NAME');
		$sheet->setCellValue('C'.$rowCount,'SHIPPER PHONE');
		$sheet->setCellValue('D'.$rowCount,'SHIPPER EMAIL');
		$sheet->setCellValue('E'.$rowCount,'SHIPPER ADDRESS 1');
		$sheet->setCellValue('F'.$rowCount,'SHIPPER ADDRESS 2');
		$sheet->setCellValue('G'.$rowCount,'SHIPPER CITY');
		$sheet->setCellValue('H'.$rowCount,'SHIPPER COUNTRY');
		$sheet->setCellValue('I'.$rowCount,'AWB');
		$sheet->setCellValue('J'.$rowCount,'HAWB');
		$sheet->setCellValue('K'.$rowCount,'TRACKING NUMBER');
		$sheet->setCellValue('L'.$rowCount,'SERVICE');
		$sheet->setCellValue('M'.$rowCount,'DATE');
		$sheet->setCellValue('N'.$rowCount,'COMPANY');
		$sheet->setCellValue('O'.$rowCount,'CONTACT');
		$sheet->setCellValue('P'.$rowCount,'ADDRESS 1');
		$sheet->setCellValue('Q'.$rowCount,'ADDRESS 2 ');
		$sheet->setCellValue('R'.$rowCount,'ADDRESS 3');
		$sheet->setCellValue('S'.$rowCount,'CITY');
		$sheet->setCellValue('T'.$rowCount,'STATE/PROVINCE');
		$sheet->setCellValue('U'.$rowCount,'COUNTRY');
		$sheet->setCellValue('V'.$rowCount,'POSTAL CODE');
		$sheet->setCellValue('W'.$rowCount,'TELEPHONE');
		$sheet->setCellValue('X'.$rowCount,'Q TY');
		$sheet->setCellValue('Y'.$rowCount,'G.W');
		$sheet->setCellValue('Z'.$rowCount,'C.W');
		$sheet->setCellValue('AA'.$rowCount,'LENGTH');
		$sheet->setCellValue('AB'.$rowCount,'WIDTH');
		$sheet->setCellValue('AC'.$rowCount,'HEIGHT');
		$sheet->setCellValue('AD'.$rowCount,'TYPE');
		$sheet->setCellValue('AE'.$rowCount,'DESCRIPTION OF GOODS');
		$sheet->setCellValue('AF'.$rowCount,'VALUE');
		$sheet->setCellValue('AG'.$rowCount,'UNIT');
		
		
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

	
			
		$sender = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$row['id_nguoigui']."'"));
			$receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$row['id_nguoinhan']."'"));
	
		$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$sender['ward_id']."'"));
		$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$sender['province_id']."'"));
		$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$sender['district_id']."'"));
    
		$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
		
		$citynhan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM cities WHERE id = '".$receiver['city']."'"));

		$dulieunguoitao = mysqli_fetch_assoc(mysqli_query($conn,"select username from ns_user where id='".$row['uid']."'"));

		/*	
		
		
		
		
			
		$sheet->setCellValue('A'.$rowCount,$sender['company_name']);
		$sheet->setCellValue('B'.$rowCount,$sender['name']);
		$sheet->setCellValue('C'.$rowCount,$sender['phone']);
		$sheet->setCellValue('D'.$rowCount,@$dulieunguoitao['username']);
		$sheet->setCellValue('E'.$rowCount,$sender['address'].' '.$ward['name'].' '.$district['name']);
		$sheet->setCellValue('F'.$rowCount,'');
		$sheet->setCellValue('G'.$rowCount,$province['name']);
		$sheet->setCellValue('H'.$rowCount,'VN');
		$sheet->setCellValue('I'.$rowCount,$row['id_code']);
	
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

						echo 'aaaaaaaaaaa';
		$laydulieukiencona = mysqli_query($conn,"select id_code,billketnoi from ns_listhoadon where id_package='".$row['id']."'");

		while($laydulieukiencon = mysqli_fetch_array($laydulieukiencona))
		{
			$sheet->setCellValue('J'.$rowCount,$laydulieukiencon['id_code']);
			$sheet->setCellValue('K'.$rowCount,$laydulieukiencon['billketnoi']);
			$rowCount++;
		}	
		*/
					$sheet->setCellValue('A'.$rowCount,($sender['company_name']));
					$sheet->setCellValue('B'.$rowCount,($sender['name']));
						$sheet->setCellValue('D'.$rowCount,($dulieunguoitao['username']));
					$sheet->setCellValue('E'.$rowCount,$sender['address'].' '.$ward['name'].' '.$district['name']);
					$sheet->setCellValue('F'.$rowCount,'');
					$sheet->setCellValue('G'.$rowCount,$province['name']);
					$sheet->setCellValue('H'.$rowCount,'VN');
					$sheet->setCellValue('I'.$rowCount,$row['id_code']);
					
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
					$laydulieukiencona = mysqli_query($conn,"select id_code,billketnoi,length,width,height,cannang,charge_weight from ns_listhoadon where id_package='".$row['id']."'");
		
		
		$demkien = 1;
		while($laydulieukiencon = mysqli_fetch_array($laydulieukiencona))
		{
			
			$sheet->setCellValue('J'.$rowCount,$laydulieukiencon['id_code']);
			$sheet->setCellValue('K'.$rowCount,$laydulieukiencon['billketnoi']);
			$sheet->setCellValue('AA'.$rowCount,$laydulieukiencon['length']);
			$sheet->setCellValue('AB'.$rowCount,$laydulieukiencon['width']);
			$sheet->setCellValue('AC'.$rowCount,$laydulieukiencon['height']);
			$sheet->setCellValue('Y'.$rowCount,$laydulieukiencon['cannang']);
			$sheet->setCellValue('Z'.$rowCount,$laydulieukiencon['charge_weight']);
			$sheet->setCellValue('AD'.$rowCount,'SPX');
			if($demkien < $row['sokien'])
			{
				$rowCount++;
			}
			$demkien++;
		}	
			$count++;		

		}
		$linemoi = $rowCount + 2;
		$linemoi2 = $rowCount + 1;
	

		


		
		foreach(range('A','X') as $columnID) {
			$objExcel->getActiveSheet()->getColumnDimension($columnID)
				->setAutoSize(true);
		}		
		
		// giao dien

		$sheet->getStyle('A1:AG1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'FFFF00') ) ) );
		$sheet->getStyle('A1:AG1')->getFont()->setBold(true)->getColor()->setRGB('000000');
		foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		        $sheet->getColumnDimension($col)
		                ->setAutoSize(true);
		    } 
			
	

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$file = "REPORT PACKAGE MANAGER".$tring1.".xlsx";
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