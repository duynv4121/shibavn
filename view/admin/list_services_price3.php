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

	
$laydulieubangia2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu3'"));
echo $string_title.'( Áp dụng '.$laydulieubangia2['date_start'].' đến '.$laydulieubangia2['date_end'].')';

?>
<div class="card card-primary card-tabs">
<div class="card-header p-0 pt-1">
<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="background-color:gray">
<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=f0-hcm" class="nav-link <?php echo $type1;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F0-HCM</a>
</li>
<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=f1-hcm" class="nav-link <?php echo $type2;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F1-HCM</a>
</li>
<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=f0-hn" class="nav-link <?php echo $type3;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F0,F1-Hà Nội</a>
</li>
<!--
<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=f1-hn" class="nav-link <?php echo $type4;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F1-Hà Nội</a>
</li>-->
<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=f0-dad" class="nav-link <?php echo $type5;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F0,F1-Đà Nẵng</a>
</li>
<!--
<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=f1-dad" class="nav-link <?php echo $type6;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ F1-Đà Nẵng</a>
</li>
-->

<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=code-hcm" class="nav-link <?php echo $type8;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ CODE-HCM</a>
</li>
<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=code-hn" class="nav-link <?php echo $type9;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ CODE-Hà Nội</a>
</li>
<li class="nav-item">
<a href="m_admin.php?m=services_price3&type=code-dad" class="nav-link <?php echo $type7;?>" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">GIÁ CODE-Đà Nẵng</a>
</li>


</ul>

</div>
</div>




<center></center>
		<div class="row">
		
			<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='1'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Metro <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=1&note=metro"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">Remote <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=1&note=remote"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='1' AND note='metro'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
						  $dulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='1' AND note='remote' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu[$bang_gia]).'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='2'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Metro <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=2&note=metro"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">Remote <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=2&note=remote"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='2' AND note='metro'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $dulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='2' AND note='remote' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu[$bang_gia]).'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='24'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Metro <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=24&note=metro"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">Remote <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=24&note=remote"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='24' AND note='metro'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $dulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='24' AND note='remote' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu[$bang_gia]).'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='4'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">AUCKLAND <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=4&note=AUCKLAND"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">Other <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=4&note=other"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='4' AND note='AUCKLAND'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $dulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='4' AND note='other' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu[$bang_gia]).'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='13'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=13&note=UK"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='13'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='14'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=14&note=canada"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='14'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
		</div>
		<hr>
		<div class="row">
			<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;">  <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='11'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=11&note=KSNUAE"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='11'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='7'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=7&note=KSNUS"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='7'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;">  <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='9'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=9&note=KSNUS NDA"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='9'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;">  <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='10'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=10&note=KSNUSF"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='10'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;">  <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='3'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Metro <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=3&note=metro"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">Remote <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=3&note=remote"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='3' AND note='metro'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
						  $dulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='3' AND note='remote' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
				 <br>
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='26'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=26&note=dubaisea"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='26' AND note='dubaisea'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
				 
				 <br>
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;">  <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='8'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">California <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=8&note=California"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">Other<a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=8&note=other"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='8' AND note='California'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
						  $dulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='8' AND note='other' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>				
					
					
					
					

			
		</div>
		
		<br>
		
		<div class="row">
		<div class="col-md-6">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="8" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='12'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">EU1 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=12&note=KSNEU1"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">EU2 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=12&note=KSNEU2"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">EU3 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=12&note=KSNEU3"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">EU4 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=12&note=KSNEU4"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">EU5 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=12&note=KSNEU5"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">EU6 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=12&note=KSNEU6"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">EU7 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=12&note=KSNEU7"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='12' AND note='KSNEU1' ");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $dulieu2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='12' AND note='KSNEU2' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $dulieu3 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='12' AND note='KSNEU3' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $dulieu4 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='12' AND note='KSNEU4' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $dulieu5 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='12' AND note='KSNEU5' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $dulieu6 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='12' AND note='KSNEU6' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $dulieu7 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='12' AND note='KSNEU7' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu2[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu3[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu4[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu5[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu6[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu7[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
				 </div>
				 		<div class="col-md-4">

				 
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="8" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='27'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Zone 1 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=27&note=KSNPH1"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">Zone 2 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=27&note=KSNPH2"><i class="fas fa-edit"></i></a></th>
		                  <th style="text-align: center;color:white">Zone 3 <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=27&note=KSNPH3"><i class="fas fa-edit"></i></a></th>
		                  
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='27' AND note='KSNPH1' ");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $dulieu2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='27' AND note='KSNPH2' AND m_price='".$item['m_price']."' LIMIT 1"));
		                  $dulieu3 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='27' AND note='KSNPH3' AND m_price='".$item['m_price']."' LIMIT 1"));
		               
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu2[$bang_gia]).'</td>
		                  <td style="text-align: center; color:blue">'.number_format($dulieu3[$bang_gia]).'</td>
	
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
				 </div>
			</div>
			<br><br>
			<div class="row">
		
		<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='28'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=28&note=USKM"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='28'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;">  <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='30'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=30&note=USFKM"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='30'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='31'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=31&note=KSNUS3"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='31'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;">  <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='32'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=32&note=KSN-USCX-KOBH"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='32'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='33'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=33&note=KSN-USDL"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='33'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
		</div>
		
		<!--- KSN CAD F -->
		<div class="col-md-2">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='34'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=34&note=KSN-CAD-F"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='34'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"> <?php 
							  $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='29'"));

							  echo @$dulieudichvu['dichvu'];
							  ?></th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Giá <a href="m_admin.php?m=e_service_price3&type=<?php echo @$_GET['type']?>&id=29&note=US2KM"><i class="fas fa-edit"></i></a></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='29'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
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