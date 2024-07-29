<?php  
	if (isset($_POST['btn_submit'])) {
		$tenmathang = $_POST['tenmathang'];
		$type = $_POST['type'];
		$price = $_POST['price'];

		mysqli_query($conn,"INSERT INTO `ksn_listphuthu` (`tenmathang`, `type`, `price`) VALUES ('$tenmathang', '$type', '$price')") or die(mysql_error()); 
		
		
		// echo'<script> 
		// 	alert("Thu tiền ngoài bill thành công!");
  //       </script>';
	}
?>
<div class="container-fluid">
	<form action="" method="POST">
	<div class="row" style="text-align:center">
				<div class="col-md-12">



<?php


if(@$_GET['type'] == 'f0-hcm')
{
	$bang_gia = 'price';
	$type1 ='active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ F0-HCM';
}
else if(@$_GET['type'] == 'f1-hcm')
{
	$bang_gia = 'price_hcm_f1';
	$type2 = 'active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ F1-HCM';

}
else if(@$_GET['type'] == 'f0-hn')
{
	$bang_gia = 'price_hn_f0';
	$type3 = 'active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ F0-HÀ NỘI';

}else if(@$_GET['type'] == 'f1-hn')
{
	$bang_gia = 'price_hn_f1';
	$type4 = 'active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ F1-HÀ NỘI';

}else if(@$_GET['type'] == 'f0-dad')
{
	$bang_gia = 'price_dn_f0';
	$type5 = 'active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ F1-HÀ NỘI';
	
}else if(@$_GET['type'] == 'f1-dad')
{
	$bang_gia = 'price_dn_f1';
	$type6 = 'active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ F0-ĐÀ NẴNG';

}

## Giá code
else if(@$_GET['type'] == 'code-dad')
{
	$bang_gia = 'price_dn_code';
	$type7 = 'active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ CODE-ĐÀ NẴNG';

}else if(@$_GET['type'] == 'code-hcm')
{
	$bang_gia = 'price_hcm_code';
	$type8 = 'active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ CODE-HCM';

}else if(@$_GET['type'] == 'code-hn')
{
	$bang_gia = 'price_hn_code';
	$type9 = 'active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ CODE-HÀ NỘI';

}
else
{
	$bang_gia = 'price';

	$type1 ='active';
	$string_title = 'BẢNG GIÁ DỊCH VỤ F1-ĐÀ NẴNG';

}

?>
<?php 

	
$laydulieubangia2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu2'"));
echo $string_title.'( Áp dụng '.$laydulieubangia2['date_start'].' đến '.$laydulieubangia2['date_end'].')';

?>
<div class="card card-primary card-tabs">
<div class="card-header p-0 pt-1">
<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="background-color:gray">
<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=f0-hcm" class="nav-link <?php echo $type1;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F0-HCM</a>
</li>
<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=f1-hcm" class="nav-link <?php echo $type2;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F1-HCM</a>
</li>
<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=f0-hn" class="nav-link <?php echo $type3;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F0,F1-Hà Nội</a>
</li>
<!--
<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=f1-hn" class="nav-link <?php echo $type4;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F1-Hà Nội</a>
</li>-->
<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=f0-dad" class="nav-link <?php echo $type5;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F0,F1-Đà Nẵng</a>
</li>
<!--
<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=f1-dad" class="nav-link <?php echo $type6;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F1-Đà Nẵng</a>
</li>
-->

<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=code-hcm" class="nav-link <?php echo $type8;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ CODE-HCM</a>
</li>
<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=code-hn" class="nav-link <?php echo $type9;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ CODE-Hà Nội</a>
</li>
<li class="nav-item">
<a href="m_admin.php?m=services_price2&type=code-dad" class="nav-link <?php echo $type7;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ CODE-Đà Nẵng</a>
</li>


</ul>

</div>
</div>




<center></center>
		
		<hr>
	
		
		<br>
		
		
		<div class="row">
		
			<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#33CCFF;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='1'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price2&type=<?php echo @$_GET['type']?>&id=1&note=GPE-TW"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu2 where id_dichvu='1' AND note='GPE-TW'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
						  $dulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu2 where id_dichvu='1' AND note='GPE-TW' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black;background-color:#FFFFFF">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#33CCFF;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='2'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price2&type=<?php echo @$_GET['type']?>&id=2&note=GPE-CN"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu2 where id_dichvu='2' AND note='GPE-CN'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black;background-color:#FFFFFF">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#33CCFF;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='3'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price2&type=<?php echo @$_GET['type']?>&id=3&note=GPE-KR"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu2 where id_dichvu='3' AND note='GPE-KR'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black;background-color:#FFFFFF">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#33CCFF;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='4'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price2&type=<?php echo @$_GET['type']?>&id=4&note=GPE-MY"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu2 where id_dichvu='4' AND note='GPE-MY'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black;background-color:#FFFFFF">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			
				<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#33CCFF;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='6'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price2&type=<?php echo @$_GET['type']?>&id=6&note=GPE-AE"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu2 where id_dichvu='6' AND note='GPE-AE'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black;background-color:#FFFFFF">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>	
			<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#33CCFF;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='8'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price2&type=<?php echo @$_GET['type']?>&id=8&note=GPE-PH"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu2 where id_dichvu='8' AND note='GPE-PH'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black;background-color:#FFFFFF">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			
			
			
			
		</div>
		
			</div>
			
		</div>
		
		
		
		
		
		
		
		
		
		
		
		</div>
		</div>
		<br><br>
	
		
	</form>
	
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