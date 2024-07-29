<?php  
	if(isset($_POST['btn_submit']))
	{
		$day_start = $_POST['day_start'];
		$day_end = $_POST['day_end'];
		mysqli_query($conn,"UPDATE `ksn_apdunggia` SET `date_start`='$day_start', `date_end`='$day_end' WHERE (`id`='1')");
		
		$day_start2 = $_POST['day_start2'];
		$day_end2 = $_POST['day_end2'];
		mysqli_query($conn,"UPDATE `ksn_apdunggia` SET `date_start`='$day_start2', `date_end`='$day_end2' WHERE (`id`='2')");
		
		$day_start3 = $_POST['day_start3'];
		$day_end3 = $_POST['day_end3'];
		mysqli_query($conn,"UPDATE `ksn_apdunggia` SET `date_start`='$day_start3', `date_end`='$day_end3' WHERE (`id`='3')");
		
			$day_start3 = $_POST['day_start4'];
		$day_end3 = $_POST['day_end4'];
		mysqli_query($conn,"UPDATE `ksn_apdunggia` SET `date_start`='$day_start3', `date_end`='$day_end3' WHERE (`id`='4')");
		
			echo'<script> 
					alert("Cập nhật thành công !");
			</script>';
	}
	
?>
<div class="container-fluid">

		<div class="row">
			<div class="col-md-4">
			<?php
		$laydulieubangia = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu'"))or die("Loi");
		$laydulieubangia2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu2'"));
		$laydulieubangia3 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu3'"));
		$laydulieubangia4 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu4'"));

				echo'<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Cập nhật thời gian cho bảng giá</h3>
              </div>
              <div class="card-body">
                <form method="POST" action="">
			CHỌN THỜI GIAN ÁP DỤNG BẢNG GIÁ 1
			<div class="form-group">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start" value="'.@$laydulieubangia['date_start'].'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end"  value="'.@$laydulieubangia['date_end'].'">
				<input type="hidden" id="aa" name="ac"  value="list_package_sale">
										<br><br>
			CHỌN THỜI GIAN ÁP DỤNG BẢNG GIÁ 2
			<div class="form-group">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start2" value="'.@$laydulieubangia2['date_start'].'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end2"  value="'.@$laydulieubangia2['date_end'].'">
				<input type="hidden" id="aa" name="ac"  value="list_package_sale">
										
										<br>
			<br>CHỌN THỜI GIAN ÁP DỤNG BẢNG GIÁ 3
			<div class="form-group">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start3" value="'.@$laydulieubangia3['date_start'].'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end3"  value="'.@$laydulieubangia3['date_end'].'">
				<input type="hidden" id="aa" name="ac"  value="list_package_sale">
										
										<br><br>
										CHỌN THỜI GIAN ÁP DỤNG BẢNG GIÁ 4
			<div class="form-group">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start4" value="'.@$laydulieubangia4['date_start'].'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end4"  value="'.@$laydulieubangia4['date_end'].'">
				<input type="hidden" id="aa" name="ac"  value="list_package_sale">
										
										<br>
			<br>
												<br>
			<br>	<center><input type="submit" name="btn_submit" class="btn btn-danger" value="Cập nhật">	
										</center>
										</div>							

			</form>
				
			</div>
			
               
                
              </div>
              <!-- /.card-body -->
            </div>';
			

?>
			
			
			
			
			
			
			
				<h5></h5>
				
				
			</div>
			<div class="col-md-4">
			<?php
			if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
			
			function roundUp($number, $nearest){
			return ceil($number/0.5)*0.5;;
			}
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            $date = date('Y-m-d');
			$datenow2 = date('Y-m-d H:i:s');
			$status = 1;
			$note = 1;
			$pcs = 1;
			$checkrow = 1;
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
				
				
				$checkrow++;
                // Get row data
                $mucgia   = $conn->real_escape_string($line[0]);
                $ksn_au_metro   = preg_replace('/[^0-9]/', '', $line[1]);
                $ksn_au_remote   = preg_replace('/[^0-9]/', '', $line[2]);
                $ksn_au2_metro   = preg_replace('/[^0-9]/', '', $line[3]);
                $ksn_au2_remote   = preg_replace('/[^0-9]/', '', $line[4]);
                $ksn_sea_au_metro   = preg_replace('/[^0-9]/', '', $line[5]);
                $ksn_sea_au_remote   = preg_replace('/[^0-9]/', '', $line[6]);
                $ksn_nzd_AUCKLAND   = preg_replace('/[^0-9]/', '', $line[7]);
                $ksn_nzd_other   = preg_replace('/[^0-9]/', '', $line[8]);
                $ksn_canada   = preg_replace('/[^0-9]/', '', $line[9]);
                $ksn_uk   = preg_replace('/[^0-9]/', '', $line[10]);
                $ksn_us2_cali   = preg_replace('/[^0-9]/', '', $line[11]);
                $ksn_us2_other   = preg_replace('/[^0-9]/', '', $line[12]);
                $ksn_us   = preg_replace('/[^0-9]/', '', $line[13]);
                $ksn_us_nda   = preg_replace('/[^0-9]/', '', $line[14]);
                $ksn_usf   = preg_replace('/[^0-9]/', '', $line[15]);
                $ksn_dubai   = preg_replace('/[^0-9]/', '', $line[16]);
                $ksn_sea_dubai   = preg_replace('/[^0-9]/', '', $line[17]);
                $ksn_ph1   = preg_replace('/[^0-9]/', '', $line[18]);
                $ksn_ph2   = preg_replace('/[^0-9]/', '', $line[19]);
                $ksn_ph3   = preg_replace('/[^0-9]/', '', $line[20]);
                $ksn_EU1   = preg_replace('/[^0-9]/', '', $line[21]);
                $ksn_EU2   = preg_replace('/[^0-9]/', '', $line[22]);
                $ksn_EU3   = preg_replace('/[^0-9]/', '', $line[23]);
                $ksn_EU4   = preg_replace('/[^0-9]/', '', $line[24]);
                $ksn_EU5   = preg_replace('/[^0-9]/', '', $line[25]);
                $ksn_EU6   = preg_replace('/[^0-9]/', '', $line[26]);
                $ksn_EU7   = preg_replace('/[^0-9]/', '', $line[27]);
                
				echo'';
				
				### ksn_au_metro 1
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_au_metro' WHERE (`id_dichvu`='1') AND note='metro' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_au_metro).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN AU METRO]</font><br>';
				### ksn_au_remote 2
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_au_remote' WHERE (`id_dichvu`='1') AND note='remote' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_au_remote).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN AU REMOTE]</font><br>';
				### ksn_au2_remote 3
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_au2_metro' WHERE (`id_dichvu`='2') AND note='metro' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_au2_metro).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN AU2 METRO]</font><br>';
				### ksn_au2_remote 4 
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_au2_remote' WHERE (`id_dichvu`='2') AND note='remote' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_au2_remote).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN AU2 REMOTE]</font><br>';
				### ksn_sea_au_metro 5
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_sea_au_metro' WHERE (`id_dichvu`='3') AND note='metro' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_sea_au_metro).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN SEA AU METRO]</font><br>';
				### ksn_sea_au_remote 6
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_sea_au_remote' WHERE (`id_dichvu`='3') AND note='remote' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_sea_au_remote).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN SEA AU REMOTE]</font><br>';
				### ksn_nzd_AUCKLAND 7
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_nzd_AUCKLAND' WHERE (`id_dichvu`='4') AND note='AUCKLAND' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_nzd_AUCKLAND).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_nzd_AUCKLAND]</font><br>';
				### ksn_nzd_other 8
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_nzd_other' WHERE (`id_dichvu`='4') AND note='other' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_nzd_other).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_nzd_other]</font><br>';
				### ksn_canada 9
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_canada' WHERE (`id_dichvu`='14') AND note='canada' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_canada).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_canada]</font><br>';
				### ksn_uk 10
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_uk' WHERE (`id_dichvu`='13') AND note='UK' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_uk).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_uk]</font><br>';
				### ksn_us2_cali 11
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_us2_cali' WHERE (`id_dichvu`='8') AND note='California' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_us2_cali).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_us2_cali]</font><br>';
				### ksn_us2_other 12
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_us2_other' WHERE (`id_dichvu`='8') AND note='other' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_us2_other).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_us2_other]</font><br>';
				### ksn_us 13
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_us' WHERE (`id_dichvu`='7') AND note='KSNUS' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_us).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_us]</font><br>';
				### ksn_us_nda 14
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_us_nda' WHERE (`id_dichvu`='9') AND note='KSNUS NDA' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_us_nda).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_us_nda]</font><br>';
				### ksn_usf 15
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_usf' WHERE (`id_dichvu`='10') AND note='KSNUSF' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_usf).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_usf]</font><br>';
				### ksn_dubai 16
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_dubai' WHERE (`id_dichvu`='11') AND note='KSNUAE' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_dubai).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_dubai]</font><br>';
				### ksn_dubai 17
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_sea_dubai' WHERE (`id_dichvu`='26') AND note='dubaisea' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_sea_dubai).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_sea_dubai]</font><br>';
				### ksn_dubai 18
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_ph1' WHERE (`id_dichvu`='27') AND note='KSNPH1' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_ph1).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_ph1]</font><br>';
				### ksn_ph2 19
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_ph2' WHERE (`id_dichvu`='27') AND note='KSNPH2' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_ph2).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_ph2]</font><br>';
				### ksn_ph3 20
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_ph3' WHERE (`id_dichvu`='27') AND note='KSNPH3' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_ph3).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_ph3]</font><br>';
				### ksn_EU1 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_EU1' WHERE (`id_dichvu`='12') AND note='KSNEU1' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU1).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU1]</font><br>';
				### ksn_EU2 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_EU2' WHERE (`id_dichvu`='12') AND note='KSNEU2' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU2).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU2]</font><br>';
				### ksn_EU3 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_EU3' WHERE (`id_dichvu`='12') AND note='KSNEU3' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU3).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU3]</font><br>';
				### ksn_EU4 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_EU4' WHERE (`id_dichvu`='12') AND note='KSNEU4' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU4).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU4]</font><br>';
				### ksn_EU5 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_EU5' WHERE (`id_dichvu`='12') AND note='KSNEU5' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU5).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU5]</font><br>';
				### ksn_EU6 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_EU6' WHERE (`id_dichvu`='12') AND note='KSNEU6' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU6).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU6]</font><br>';
				### ksn_EU7 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `".$bang_gia."`='$ksn_EU7' WHERE (`id_dichvu`='12') AND note='KSNEU7' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU7).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU7]</font><br>';
				
            }

            // Close opened CSV file
					fclose($csvFile);
            
						echo'<script> 
					alert("Cập nhật thành công !");
					  </script>';
					exit();        
					}else{
            echo'abc';;
        }
    }else{
            echo'abcd';;
    }
}
			?>
			</div>
		</div>
		
		
	
</div>

<?php  
?>
<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>