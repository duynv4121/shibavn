<?php  
	$type = $_GET['type'];
	
	
		
	if($type == "f1-hcm")
	{
			$bang_gia = 'price_hcm_f1'; 
			$string_edit = 'Cập nhật bảng giá bằng file .CSV cho F1 HCM';
	}
	else if($type == "f1-hn")
	{
			$bang_gia = 'price_hn_f1'; 
			$string_edit = 'Cập nhật bảng giá bằng file .CSV cho F1 Hà Nội';


	}
	else if($type == "f0-hn")
	{
		$bang_gia = 'price_hn_f0'; 
		$string_edit = 'Cập nhật bảng giá bằng file .CSV cho F0 Hà Nội';


	}else if($type == "f1-dad")
	{
		$bang_gia = 'price_dn_f1'; 
		$string_edit = 'Cập nhật bảng giá bằng file .CSV cho F1 Đà Nẵng';
			

	}
	else if($type == "f0-dad")
	{
		$bang_gia = 'price_dn_f0'; 
		$string_edit = 'Cập nhật bảng giá bằng file .CSV cho F0 Đà Nẵng';
		

	}else if($type == "code-dad")
	{
		$bang_gia = 'price_dn_code'; 
		$string_edit = 'Cập nhật bảng giá bằng file .CSV cho Giá CODE ĐÀ NẴNG';


	}else if($type == "code-hcm")
	{
		$bang_gia = 'price_hcm_code'; 
		$string_edit = 'Cập nhật bảng giá bằng file .CSV cho Giá CODE Hồ Chí Minh';


	}else if($type == "code-hn")
	{
		$bang_gia = 'price_hn_code'; 
		$string_edit = 'Cập nhật bảng giá bằng file .CSV cho Giá CODE Hà Nội';

	}
	else
	{
		$bang_gia = 'price';
		$string_edit = 'Cập nhật bảng giá bằng file .CSV cho Giá F0 Hồ Chí Minh';

	}
	
?>
<div class="container-fluid">
	<?php 

	
$laydulieubangia2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu2'"));
echo $string_title.'( Áp dụng '.$laydulieubangia2['date_start'].' đến '.$laydulieubangia2['date_end'].')';

?>
		<div class="row">
			<div class="col-md-4">
		
			
			<?php
			if(isset($_GET['type']))
			{
			echo'<a href="m_admin.php?m=e_service_price_csv2" class="btn btn-primary btn-sm"><i class="fas fa-step-backward"></i> CHỌN CHI NHÁNH  BẢNG GIÁ </a><br><br>
			<div class="card card-primary">
<div class="card-header">
<h3 class="card-title" style="font-weight:bold">'.$string_edit.'</h3>
</div>
<div class="card-body">
			
	         
				   <center> <div class="col-md-12" id="importFrm" >
		<a href="./labelau/update price sample csv.zip">CSV IMPORT SAMPLE </a>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="Cập nhật giá">
        </form>
    </div> </center>
				
				</div>
<div class="card-footer">
</div>
</div>';		
			}
			else
			{
				echo'<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"> Chọn chi nhánh cần upload bảng giá csv</h3>
              </div>
              <div class="card-body">
                <a href="m_admin.php?m=e_service_price_csv2&type=F0-hcm"><i class="fas fa-list-alt"></i> BẢNG GIÁ F0 HCM</a><hr>
                <a href="m_admin.php?m=e_service_price_csv2&type=f1-hcm"><i class="fas fa-list-alt"></i> BẢNG GIÁ F1 HCM</a><hr>
                <a href="m_admin.php?m=e_service_price_csv2&type=f0-hn"><i class="fas fa-list-alt"></i> BẢNG GIÁ F0 Hà Nội</a><hr>
                <a href="m_admin.php?m=e_service_price_csv2&type=f1-hn"><i class="fas fa-list-alt"></i> BẢNG GIÁ F1 Hà Nội</a><hr>
                <a href="m_admin.php?m=e_service_price_csv2&type=f0-dad"><i class="fas fa-list-alt"></i> BẢNG GIÁ F0 Đà Nẵng</a><hr>
                <a href="m_admin.php?m=e_service_price_csv2&type=f1-dad"><i class="fas fa-list-alt"></i> BẢNG GIÁ F1 Đà Nẵng</a><hr>
                <a href="m_admin.php?m=e_service_price_csv2&type=code-hcm"><i class="fas fa-list-alt"></i> BẢNG GIÁ CODE HCM</a><hr>
                <a href="m_admin.php?m=e_service_price_csv2&type=code-hn"><i class="fas fa-list-alt"></i> BẢNG GIÁ CODE Hà Nội </a><hr>
                <a href="m_admin.php?m=e_service_price_csv2&type=code-dad"><i class="fas fa-list-alt"></i> BẢNG GIÁ CODE Đà Nẵng</a><hr>
                
              </div>
              <!-- /.card-body -->
            </div>';
			}

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
                $ksn_AUEXPRESS_metro   = preg_replace('/[^0-9]/', '', $line[28]);
                $ksn_AUEXPRESS_remote   = preg_replace('/[^0-9]/', '', $line[29]);
                $ksn_USKM   = preg_replace('/[^0-9]/', '', $line[30]);
                $ksn_USFKM   = preg_replace('/[^0-9]/', '', $line[31]);
                $ksn_KSNUS3   = preg_replace('/[^0-9]/', '', $line[32]);
                $ksn_US2KM   = preg_replace('/[^0-9]/', '', $line[33]);
				$ksn_USCX_KOBH   = preg_replace('/[^0-9]/', '', $line[34]);
                $ksn_USDL   = preg_replace('/[^0-9]/', '', $line[35]);
                $KSN_CAD_F   = preg_replace('/[^0-9]/', '', $line[36]);
  
				
				echo'';
				
				### ksn_au_metro 1
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_au_metro' WHERE (`id_dichvu`='1') AND note='metro' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_au_metro).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN AU METRO]</font><br>';
				### ksn_au_remote 2
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_au_remote' WHERE (`id_dichvu`='1') AND note='remote' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_au_remote).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN AU REMOTE]</font><br>';
				### ksn_au2_remote 3
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_au2_metro' WHERE (`id_dichvu`='2') AND note='metro' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_au2_metro).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN AU2 METRO]</font><br>';
				### ksn_au2_remote 4 
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_au2_remote' WHERE (`id_dichvu`='2') AND note='remote' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_au2_remote).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN AU2 REMOTE]</font><br>';
				### ksn_sea_au_metro 5
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_sea_au_metro' WHERE (`id_dichvu`='3') AND note='metro' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_sea_au_metro).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN SEA AU METRO]</font><br>';
				### ksn_sea_au_remote 6
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_sea_au_remote' WHERE (`id_dichvu`='3') AND note='remote' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_sea_au_remote).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN SEA AU REMOTE]</font><br>';
				### ksn_nzd_AUCKLAND 7
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_nzd_AUCKLAND' WHERE (`id_dichvu`='4') AND note='AUCKLAND' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_nzd_AUCKLAND).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_nzd_AUCKLAND]</font><br>';
				### ksn_nzd_other 8
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_nzd_other' WHERE (`id_dichvu`='4') AND note='other' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_nzd_other).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_nzd_other]</font><br>';
				### ksn_canada 9
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_canada' WHERE (`id_dichvu`='14') AND note='canada' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_canada).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_canada]</font><br>';
				### ksn_uk 10
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_uk' WHERE (`id_dichvu`='13') AND note='UK' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_uk).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_uk]</font><br>';
				### ksn_us2_cali 11
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_us2_cali' WHERE (`id_dichvu`='8') AND note='California' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_us2_cali).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_us2_cali]</font><br>';
				### ksn_us2_other 12
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_us2_other' WHERE (`id_dichvu`='8') AND note='other' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_us2_other).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_us2_other]</font><br>';
				### ksn_us 13
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_us' WHERE (`id_dichvu`='7') AND note='KSNUS' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_us).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_us]</font><br>';
				### ksn_us_nda 14
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_us_nda' WHERE (`id_dichvu`='9') AND note='KSNUS NDA' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_us_nda).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_us_nda]</font><br>';
				### ksn_usf 15
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_usf' WHERE (`id_dichvu`='10') AND note='KSNUSF' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_usf).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_usf]</font><br>';
				### ksn_dubai 16
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_dubai' WHERE (`id_dichvu`='11') AND note='KSNUAE' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_dubai).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_dubai]</font><br>';
				### ksn_dubai 17
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_sea_dubai' WHERE (`id_dichvu`='26') AND note='dubaisea' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_sea_dubai).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_sea_dubai]</font><br>';
				### ksn_dubai 18
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_ph1' WHERE (`id_dichvu`='27') AND note='KSNPH1' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_ph1).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_ph1]</font><br>';
				### ksn_ph2 19
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_ph2' WHERE (`id_dichvu`='27') AND note='KSNPH2' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_ph2).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_ph2]</font><br>';
				### ksn_ph3 20
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_ph3' WHERE (`id_dichvu`='27') AND note='KSNPH3' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_ph3).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_ph3]</font><br>';
				### ksn_EU1 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_EU1' WHERE (`id_dichvu`='12') AND note='KSNEU1' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU1).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU1]</font><br>';
				### ksn_EU2 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_EU2' WHERE (`id_dichvu`='12') AND note='KSNEU2' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU2).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU2]</font><br>';
				### ksn_EU3 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_EU3' WHERE (`id_dichvu`='12') AND note='KSNEU3' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU3).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU3]</font><br>';
				### ksn_EU4 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_EU4' WHERE (`id_dichvu`='12') AND note='KSNEU4' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU4).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU4]</font><br>';
				### ksn_EU5 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_EU5' WHERE (`id_dichvu`='12') AND note='KSNEU5' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU5).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU5]</font><br>';
				### ksn_EU6 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_EU6' WHERE (`id_dichvu`='12') AND note='KSNEU6' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU6).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU6]</font><br>';
				### ksn_EU7 21
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_EU7' WHERE (`id_dichvu`='12') AND note='KSNEU7' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_EU7).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_EU7]</font><br>';
				### ksn_AUEXPRESS_metro 28
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_AUEXPRESS_metro' WHERE (`id_dichvu`='24') AND note='metro' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_AUEXPRESS_metro).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_AUEXPRESS_metro]</font><br>';
				### ksn_AUEXPRESS_remote 29
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_AUEXPRESS_remote' WHERE (`id_dichvu`='24') AND note='remote' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_AUEXPRESS_remote).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_AUEXPRESS_remote]</font><br>';
				### ksn_USKM 30
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_USKM' WHERE (`id_dichvu`='28') AND note='USKM' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_USKM).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_USKM]</font><br>';
				### ksn_USFKM 31
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_USFKM' WHERE (`id_dichvu`='30') AND note='USFKM' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_USFKM).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_USFKM]</font><br>';
				### ksn_KSNUS3 32
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_KSNUS3' WHERE (`id_dichvu`='31') AND note='KSNUS3' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_KSNUS3).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_KSNUS3]</font><br>';
				### ksn_US2KM 33
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_US2KM' WHERE (`id_dichvu`='29') AND note='US2KM' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_US2KM).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_US2KM]</font><br>';
				### ksn_USCX_KOBH 34
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_USCX_KOBH' WHERE (`id_dichvu`='32') AND note='KSN-USCX-KOBH' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_USCX_KOBH).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_USCX_KOBH]</font><br>';
				### ksn_USDL 35
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$ksn_USDL' WHERE (`id_dichvu`='33') AND note='KSN-USDL' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($ksn_USDL).' cho mức <b>'.$mucgia.'kg </b><font color=red>[ksn_USDL]</font><br>';
				### KSN_CAD_F 35
				mysqli_query($conn,"UPDATE `ksn_giadichvu2` SET `".$bang_gia."`='$KSN_CAD_F' WHERE (`id_dichvu`='34') AND note='KSN-CAD-F' AND m_price='$mucgia'");
				echo'Cập nhật thành công giá : '.@number_format($KSN_CAD_F).' cho mức <b>'.$mucgia.'kg </b><font color=red>[KSN_CAD_F]</font><br>';
				
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