<?php 

include("../controller/accountant.php");
include("../controller/bill.php");

$idsale = $_GET['id'];

if (isset($_POST['btn_add'])) {
		
		$id_salemember = $_POST['idkhachhang'];
		mysqli_query($conn,"INSERT INTO `ksn_sale_leader_detail` (`id_saleleader`, `id_member`,`datetime`) VALUES ('".$_GET['id']."', '".$id_salemember."','$datenow')");
		
		echo'<script> 
			alert("Thêm Sale Member thành công!");						window.location = "m_admin.php?m=sale_detail&id='.$_GET['id'].'";

        </script>';
				exit();

		
	}
if (isset($_POST['btn_add2'])){
		
		$id_salemember = $_POST['idkhachhang'];
		mysqli_query($conn,"INSERT INTO `ksn_sale_leader_detail_add` (`id_saleleader`, `id_member`,`datetime`) VALUES ('".$_GET['id']."', '".$id_salemember."','$datenow')");
		
		echo'<script> 
			alert("Thêm Sale Member thành công, vui lòng đợi Admin xác nhận!");						window.location = "m_admin.php?m=sale_detail&id='.$_GET['id'].'";

        </script>';
				exit();

	}
	
	
	
if (isset($_POST['btn_addprivatekpi'])) {
		
		$kpi_name = $_POST['kpi_name'];
		$muc_luong = $_POST['muc_luong'];
		$hoahong = $_POST['hoahong'];
		mysqli_query($conn,"INSERT INTO `ksn_kpi_private` (`name`, `muc_luong`, `hoahong`, `id_sale`) VALUES ('$kpi_name', '$muc_luong', '$hoahong', '$idsale')");
		
		echo'<script> 
			alert("Thêm Áp giá KPI riêng thành công!");						window.location = "m_admin.php?m=sale_detail&id='.$_GET['id'].'";

        </script>';
		
	}
	
	
	if(isset($_POST['btn_delete_leader']))	
	{
		$id_saleleadera = $_POST['idsale_leader_delete'];
		
		mysqli_query($conn,"DELETE FROM `ksn_sale_leader_detail` WHERE (`id_member`='$id_saleleadera')");
		echo'<script> 
			alert("Xóa thành công Member!");					

        </script>';

	}
	
	if(isset($_POST['btn_deletekpiprivate']))	
	{
		$delete_idkpiprivate = $_POST['delete_idkpiprivate'];
		
		mysqli_query($conn,"DELETE FROM `ksn_kpi_private` WHERE (`id`='$delete_idkpiprivate')");
		echo'<script> 
			alert("Xóa mức áp giá KPI cho Sale thành công!");					

        </script>';

	}
	
	if(isset($_POST['btn_editcodeprice']))	
	{
		$id_edit = $_POST['id_edit'];
		$cuoc_goc = $_POST['cuoc_goc'];
		$khach_cuocnoidia = $_POST['khach_cuocnoidia'];
		$khach_phibaohiem = $_POST['khach_phibaohiem'];
		$khach_phuthu = $_POST['khach_phuthu'];
		$khach_thuho = $_POST['khach_thuho'];
		$vat = $_POST['vat'];
		
		mysqli_query($conn,"UPDATE `ns_package` SET `cuoc_goc`='$cuoc_goc',`khach_cuocnoidia`='$khach_cuocnoidia',`khach_phibaohiem`='$khach_phibaohiem',`khach_phuthu`='$khach_phuthu',`khach_thuho`='$khach_thuho',`vat`='$vat' WHERE (`id_code`='$id_edit')");
		echo'<script> 
			alert("Cập nhật chỉnh sước giá cước  mới thành công cho bill:'.$id_edit.'");					

        </script>';

	}
	
?>
<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> -->

		<?php
		
		
		if(isset($_GET['select_month']) AND $_GET['select_month'] != "")
		{
			$month=$_GET['select_month'];
		}else
		{
			$month =  date('Y-m');
		}
		
		$new_month = substr($month, -2);
		$year = substr($month,0, 4);
		
		
		echo'
		<form action="" method="GET">
		Thống kê theo tháng 
		
		<input type="hidden" id="select_month" name="id" value="'.$_GET['id'].'">
		<input type="hidden" id="select_month" name="m" value="'.$_GET['m'].'">
		<input type="month" id="select_month" name="select_month" value="'.$month.'">
		<button type="submit" class="btn btn-warning btn-sm">Lọc theo tháng</button>
		</form>
		';
		?>
       
		 <?php
		 
		 
		 $thongtinsale = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$idsale."'"));
		$dulieuformonth =  saleformonth($idsale,$new_month,$conn);
		$cal_quy = 0;
		$cal_nam = 0;
		$checkkpiquy_khachle = 0;
		$checkkpinam_khachle = 0;
		if($new_month == 3 || $new_month == 6 || $new_month == 9 || $new_month == 12)
		{
			$cal_quy = 1;
			$dulieuforquarter =  saleforquarter($idsale,$new_month,$conn);
			$checkkpiquy_khachle =  checkkpithuong_quy($idsale,$dulieuforquarter['loinhuanthucte'],$conn);

		}
		if( $new_month == 12 )
		{
			$cal_nam = 1;
			$dulieuforyear =  saleforyear($idsale,$year,$conn);
			$checkkpinam_khachle =  checkkpithuong_year($idsale,$dulieuforyear['loinhuanthucte'],$conn);

		}
		
		$checkkpia =  checkkpi($idsale,$dulieuformonth['loinhuanthucte'],$conn);
		$checkkpib =  checkkpithuong($idsale,$dulieuformonth['loinhuanthucte'],$conn);

		 ?>			<div class="row" >
		<div class="col-md-4">

			<div class="card card-primary">
		<div class="card-header " style="background-color:blue;color:white">
		Saleman
		</div>
		<div class="card-body pt-0">
		<div class="row">
		<div class="col-7">
		<h2 class="lead"><b><?php echo $thongtinsale['ten'];?></b></h2>
		<p class="text-muted text-sm"><b>Username: <?php echo $thongtinsale['cus_code'].'('.$thongtinsale['username'].')';?></b>  </p>
		<ul class="ml-4 mb-0 fa-ul text-muted">
		<li class="small"><span class="fa-li"><i class="fas fa-clock"></i></span> Created at: <?php echo $thongtinsale['created_at'];?></li>
		<li class="small"><span class="fa-li"><i class="fas fa-phone-square"></i></span> Phone #: <?php echo $thongtinsale['phone'];?></li>
		</ul>
		</div>
		<div class="col-5 text-center">
		</div>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		<?php
				//echo'<a href="mani_sale2.php?month='.$month.'&id='.$_GET['id'].'" class="btn btn-sm btn-danger"><i class="fas fa-download"></i> Xuất báo cáo tháng '.$new_month.'</a>';

		?>
		</div>
		</div>
		</div>
		
		
		
		
<?php 
$checkteamleadera = mysqli_query($conn,"select * from ksn_sale_leader where id_saleleader='$idsale'");
$checkteamleader = mysqli_num_rows($checkteamleadera);
		$checkteamleadera = mysqli_query($conn,"select * from ksn_sale_master where id_saleleader='$idsale'");
		$zcheckmaster = mysqli_num_rows($checkteamleadera);
		
		

$add_hoahongleader = 0;

 if($zcheckmaster >= 1)
	 
	 {
		 
		 
		 $totalloinhuan2 = 0;

		 $check_teammembera = mysqli_query($conn,"select * from ksn_sale_master_detail where id_saleleader='$idsale'");
	$sothanhvien = mysqli_num_rows($check_teammembera);
	echo'<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><i class="fas fa-users"></i> Team Member ('.$sothanhvien.' thành viên)</h3>
</div>
<div class="card-body"><table class="table table-hover text-nowrap" style="font-size:14px">
		<tr>
		<th>Tên thành viên nhóm</th><th>Doanh thu</th><th>H.H đơn công ty</th><th>H.H đơn tự tìm</th><th></th></tr>';

$totalloinhuanmember = 0;

$totalloinhuan_quy = 0;
$totalloinhuan_nam = 0;
$add_fwdmembercost = 0;

while($check_teammember = mysqli_fetch_array($check_teammembera))
{
	
	$loinhuancanhan = saleformonth($check_teammember['id_member'],$new_month,$conn)['doanhthu'];
	$loinhuanmembercongty = saleformonth($check_teammember['id_member'],$new_month,$conn)['loinhuanthuctecongty'];
	$loinhuanmembertutim = saleformonth($check_teammember['id_member'],$new_month,$conn)['loinhuanthuctetutim'];
	if($cal_quy == 1)
	{
	$loinhuancanhan_quy = saleforquarter($check_teammember['id_member'],$new_month,$conn)['loinhuanthucte'];
	$totalloinhuan_quy+= $loinhuancanhan_quy;
	}if($cal_nam == 1)
	{
	$loinhuancanhan_nam = saleforyear($check_teammember['id_member'],$year,$conn)['loinhuanthucte'];
	$totalloinhuan_nam+= $loinhuancanhan_nam;
	}
	

	$laydulieumember = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$check_teammember['id_member']."'"));
	
	### Lấy dữ liệu cost FWD
	$fwd_membera = mysqli_query($conn,"select * from ns_user where idsale_service='".$laydulieumember['id']."'");
	while(@$fwd_membera = mysqli_fetch_array($fwd_membera))
	{
		$checkkpifwd = checkkpifwd($fwd_membera['id'],$new_month,$conn);
		 $add_fwdmembercost += $checkkpifwd['sotienchiphi_leadermember'];
	}
	$totalloinhuanmember+= $loinhuanmembercongty*20/100*6/100 + $loinhuanmembertutim*50/100*6/100;
	$totalloinhuan2+= $loinhuancanhan*1+0;

	
	###
	
	echo'	<tr>
		<td><a href="m_document.php?id='.$check_teammember['id_member'].'&m=sale_detail" target="_blank">'.$laydulieumember['ten'].'</a></td>
		<td  style="color:green;font-weight:bold">'.number_format($loinhuancanhan).' đ</td>
		<td  style="color:green;font-weight:bold">'.number_format($loinhuanmembercongty*20/100*6/100).' đ</td>
		<td  style="color:green;font-weight:bold">'.number_format($loinhuanmembertutim*50/100*6/100).' đ</td>

		
		
		
		</tr>';
		
}
//$hoahongleader = checkkpileader($totalloinhuan,$conn)['kpi_hoahong'];
echo'
</table><p style="float:right;color:orange; 
"><br>';

echo'
Tổng doanh thu team: <font color=blue>'.number_format($totalloinhuan2).'đ</font><br>

Tổng cộng Hoa Hồng Trưởng Phòng: <font color=blue> '.number_format($totalloinhuanmember).'đ</font><br>
</p><br>
<p style="float:right;color:orange"></p>
</div>
<div class="card-footer">';


				  echo'
</div>
</div>

';
	 }
	
else if($checkteamleader >= 1)
{
	$check_teammembera = mysqli_query($conn,"select * from ksn_sale_leader_detail where id_saleleader='$idsale'");
	$sothanhvien = mysqli_num_rows($check_teammembera);
	echo'<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><i class="fas fa-users"></i> Team Member ('.$sothanhvien.' thành viên)</h3>
</div>
<div class="card-body"><table class="table table-hover text-nowrap" style="font-size:14px">
		<tr>
		<th>Tên thành viên nhóm</th><th>Doanh thu</th><th>H.H đơn công ty</th><th>H.H đơn tự tìm</th><th></th></tr>';

$totalloinhuan = 0;
$totalloinhuanmember = 0;

$totalloinhuan_quy = 0;
$totalloinhuan_nam = 0;
$add_fwdmembercost = 0;

while($check_teammember = mysqli_fetch_array($check_teammembera))
{
	
	$loinhuancanhan = saleformonth($check_teammember['id_member'],$new_month,$conn)['doanhthu'];
	$loinhuanmembercongty = saleformonth($check_teammember['id_member'],$new_month,$conn)['loinhuanthuctecongty'];
	$loinhuanmembertutim = saleformonth($check_teammember['id_member'],$new_month,$conn)['loinhuanthuctetutim'];
	
	if($cal_quy == 1)
	{
	$loinhuancanhan_quy = saleforquarter($check_teammember['id_member'],$new_month,$conn)['loinhuanthucte'];
	$totalloinhuan_quy+= $loinhuancanhan_quy;
	}if($cal_nam == 1)
	{
	$loinhuancanhan_nam = saleforyear($check_teammember['id_member'],$year,$conn)['loinhuanthucte'];
	$totalloinhuan_nam+= $loinhuancanhan_nam;
	}
	
	$totalloinhuan+=$loinhuancanhan;
	$laydulieumember = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$check_teammember['id_member']."'"));
	
	### Lấy dữ liệu cost FWD
	$fwd_membera = mysqli_query($conn,"select * from ns_user where idsale_service='".$laydulieumember['id']."'");
	while(@$fwd_membera = mysqli_fetch_array($fwd_membera))
	{
		$checkkpifwd = checkkpifwd($fwd_membera['id'],$new_month,$conn);
		 $add_fwdmembercost += $checkkpifwd['sotienchiphi_leadermember'];
	}
	$totalloinhuanmember+= $loinhuanmembercongty*20/100*9/100 + $loinhuanmembertutim*50/100*9/100;
	
	
	###
	
	echo'	<tr>
		<td><a href="m_document.php?id='.$check_teammember['id_member'].'&m=sale_detail" target="_blank">'.$laydulieumember['ten'].'</a></td>
		<td  style="color:green;font-weight:bold">'.number_format($totalloinhuan).' đ</td>
		<td  style="color:green;font-weight:bold">'.number_format($loinhuanmembercongty*20/100*9/100).' đ</td>
		<td  style="color:green;font-weight:bold">'.number_format($loinhuanmembertutim*50/100*9/100).' đ</td>

		
		<td><form action="" method="POST">
						 <input type="hidden" value="'.$laydulieumember['id'].'" name="idsale_leader_delete">';
						  if($roleid != 6)
				  {
				
						 echo'
                          <button type="submit" name="btn_delete_leader" class="btn btn-danger btn-sm" onclick="return confirm(\'Xóa khỏi danh sách member?\')">
                              <i class="fas fa-trash">
                              </i>
                              
				  </button>';}
						  echo'
						  </form>
		</td>
		
		</tr>';
		
		
}
$hoahongleader = checkkpileader($totalloinhuan,$conn)['kpi_hoahong'];
echo'
</table><p style="float:right;color:orange; 
"><br>';

echo'
Tổng doanh thu team: <font color=blue>'.number_format($totalloinhuan).'đ</font><br>
Tổng cộng Hoa Hồng Leader: <font color=blue> '.number_format($totalloinhuanmember).'đ</font><br>
</p><br>
<p style="float:right;color:orange"></p>
</div>
<div class="card-footer">';

 if($roleid != 6)
				  {
				
						 echo'<button name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-addmember"><i class="fas fa-plus-circle"></i> Add Member</button>';

				  }
				  else
				  {
					  echo'<button name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-addmember2"><i class="fas fa-plus-circle"></i> Add Member</button>';
				  }
				  echo'
</div>
</div>

';
}
?>

		
		
		
		
		
		
		
		</div>
		
		<div class="col-md-4">

		
		
		<?php 
		$checkmastera = mysqli_query($conn,"select * from ksn_sale_master where id_saleleader='$idsale'");
		$checkmaster = mysqli_num_rows($checkteamleadera);
		
		 if($checkmaster >= 1)
		{
					echo'<div class="card bg-light d-flex flex-fill">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		BẢNG HOA HỒNG CHỨC VỤ TRƯỞNG PHÒNG SALE <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<p>HOA HỒNG ĐƠN HÀNG CÔNG TY </p>
<p style="color:green">		- Hoa hồng =  Lợi nhuận thực tế *20%*15% </p>
		<p>	 HOA HỒNG ĐƠN HÀNG TỰ TÌM KIẾM</p>
		
	<p style="color:green">		 - Hoa hồng = Lợi nhuận thực tế*50%*15%  </p>
		
		<p>	 HOA HỒNG ĐƠN HÀNG CHO TRƯỞNG PHÒNG THÀNH VIÊN ĐƠN CÔNG TY</p>
		
	<p style="color:green">		 - Hoa hồng = Lợi nhuận thực tế member *20%*6%  </p>
		<p>	 HOA HỒNG ĐƠN HÀNG CHO TRƯỞNG PHÒNG THÀNH VIÊN ĐƠN TỰ TÌM</p>
		
	<p style="color:green">		 - Hoa hồng = Lợi nhuận thực tế member *50%*6%  </p>
		
		
		</div>
		<div class="card-footer">
		
		</div>
		</div>';
		}
		
		else if($checkteamleader >= 1){
			echo'<div class="card bg-light d-flex flex-fill">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		BẢNG HOA HỒNG CHỨC VỤ SALE LEADER<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<p>HOA HỒNG ĐƠN HÀNG CÔNG TY </p>
<p style="color:green">		- Hoa hồng =  Lợi nhuận thực tế *20%*15% </p>
		<p>	 HOA HỒNG ĐƠN HÀNG TỰ TÌM KIẾM</p>
		
	<p style="color:green">		 - Hoa hồng = Lợi nhuận thực tế*50%*15%  </p>
		
			
		<p>	 HOA HỒNG ĐƠN HÀNG CHO LEADER THÀNH VIÊN ĐƠN CÔNG TY</p>
		
	<p style="color:green">		 - Hoa hồng = Lợi nhuận thực tế member *20%*9%  </p>
		<p>	 HOA HỒNG ĐƠN HÀNG CHO LEADER THÀNH VIÊN ĐƠN TỰ TÌM</p>
		
	<p style="color:green">		 - Hoa hồng = Lợi nhuận thực tế member *50%*9%  </p>
		
		</div>
		<div class="card-footer">
		
		</div>
		</div>';
			
			/*
		echo'
			<div class="card bg-light d-flex flex-fill">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		BẢNG KPI SALE F0 <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Hoa hồng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f2_hoahong'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								
								
								$laydulieuap = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_kpi_private where name='".$item['name']."' AND id_sale='$idsale'"));
								if(@$laydulieuap['name'] != "")
								{
									
								
								echo'<tr style="color:red">
		<td>'.$item['name'].' (Áp riêng)</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.number_format($laydulieuap['muc_luong']).'</td><td>'.$laydulieuap['hoahong'].'%</td>
		</tr>';
								}
								else
								{
								
								
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.number_format($item['muc_luong']).'</td><td>'.$item['hoahong'].'%</td>
								
		</tr>';}
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">';
		
		 if($roleid != 6)
				  {
				
						 echo'
		<button name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-addprivatekpi"><i class="fas fa-plus-circle"></i> Áp giá KPI riêng</button>';
				  }
		echo'

		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		
		
		*/
		
		/*
		### HOA HỒNG LEADER THÁNG
		echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		HOA HỒNG DÀNH CHO LEADER - THÁNG<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Hoa hồng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f1_leader_hoahong'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								
								
								
								echo'<tr>
								<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.$item['hoahong'].'%</td>		</tr>';
								
		
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		
		### THƯỞNG TEAM LEADER THÁNG
		echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		THƯỞNG TEAM LEADER - THÁNG<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f1_leader_thang'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.$item['muc_luong'].'</td>		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
			
		### THƯỞNG TEAM LEADER -  QUÝ
		echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		THƯỞNG TEAM LEADER -  QUÝ<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f1_leader_quy'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.$item['muc_luong'].'</td>		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
			
		### THƯỞNG TEAM LEADER -  NĂM
		echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		THƯỞNG TEAM LEADER -  NĂM<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f1_leader_nam'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.$item['muc_luong'].'</td>		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		
		
		
		### KPI tháng
		echo'
			<div class="card bg-light d-flex flex-fill  collapsed-card">
		<div class="card-header text-muted border-bottom-0 "  style="background-color:#DDDDDD">
		THƯỞNG KPI THÁNG - KHÁCH LẺ<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f1_thang'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.number_format($item['muc_luong']).'</td>
		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		### KPI quý
		echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		THƯỞNG KPI QUÝ - KHÁCH LẺ<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f1_quy'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.number_format($item['muc_luong']).'</td>
		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		
		### KPI năm
		echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		THƯỞNG KPI Năm - KHÁCH LẺ<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f1_nam'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.number_format($item['muc_luong']).'</td>
		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		
		*/
		
		
		
		}
		
		
		
		
		
		
		
		
		##### F2
		
		else
		{	echo'<div class="card bg-light d-flex flex-fill">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		BẢNG HOA HỒNG CHỨC VỤ SALE <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<p>HOA HỒNG ĐƠN HÀNG CÔNG TY </p>
<p style="color:green">		- Hoa hồng =  Lợi nhuận thực tế *20%*15% </p>
		<p>	 HOA HỒNG ĐƠN HÀNG TỰ TÌM KIẾM</p>
		
	<p style="color:green">		 - Hoa hồng = Lợi nhuận thực tế*50%*15%  </p>
		
		
		</div>
		<div class="card-footer">
		
		</div>
		</div>';
			
			/*
			echo'
			<div class="card bg-light d-flex flex-fill">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		BẢNG KPI SALE
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Hoa hồng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f1_hoahong'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
							$laydulieuap = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_kpi_private where name='".$item['name']."' AND id_sale='$idsale'"));
								if(@$laydulieuap['name'] != "")
								{
									
								
								echo'<tr style="color:red">
		<td>'.$item['name'].' (Áp riêng)</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.$laydulieuap['hoahong'].'%</td>
		</tr>';
								}
								else
								{
								
								
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.$item['hoahong'].'%</td>
								
		</tr>';}
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<button name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-addprivatekpi"><i class="fas fa-plus-circle"></i> Áp giá KPI riêng</button>

		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		
		
		
		/*
		### KPI tháng
		echo'
			<div class="card bg-light d-flex flex-fill  collapsed-card">
		<div class="card-header text-muted border-bottom-0 "  style="background-color:#DDDDDD">
		THƯỞNG KPI THÁNG - KHÁCH LẺ<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f2_thang'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.number_format($item['muc_luong']).'</td>
		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		### KPI quý
		echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		THƯỞNG KPI QUÝ - KHÁCH LẺ<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f2_quy'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.number_format($item['muc_luong']).'</td>
		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		
		### KPI năm
		echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		THƯỞNG KPI Năm - KHÁCH LẺ<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Mức lợi nhuận thực tế</th><th>Mức thưởng</th>
		</tr>';
		
			$laydulieukpia = mysqli_query($conn,"SELECT * FROM ksn_kpi where type='f2_nam'")or die("Loi");
							while ($item = mysqli_fetch_array($laydulieukpia,MYSQLI_ASSOC)) {
								echo'<tr>
		<td>'.$item['name'].'</td><td style="color:blue">'.number_format($item['muc_min']).'-'.number_format($item['muc_max']).'</td><td>'.number_format($item['muc_luong']).'</td>
		</tr>';
							}
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		
		*/
		
		}
		
		/*
			echo'
			<div class="card bg-light d-flex flex-fill   collapsed-card">
		<div class="card-header text-muted border-bottom-0"  style="background-color:#DDDDDD">
		THƯỞNG KPI THÁNG - SALE CHÍNH THỨC KHÁCH LẺ<div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Loại</th><th>Thành Tích</th><th>Mức thưởng</th>
		
		<tr><td>CÁ NHÂN XUẤT SẮC THÁNG ĐẦU</td><td>BẬC 7</td><td>1.000.000 đ</td></tr>
		<tr><td>CÁ NHÂN XUẤT SẮC THÁNG THỨ 2</td><td>BẬC 7</td><td>2.000.000 đ</td></tr>
		<tr><td>CÁ NHÂN XUẤT SẮC THÁNG THỨ 3</td><td>BẬC 7</td><td>3.000.000 đ</td></tr>
		';
							
							
							echo'	</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>';
		*/
		?>
		
	
		</div>
		
		<div class="col-md-4">

			<div class="card bg-light d-flex flex-fill">
		<div class="card-header text-muted border-bottom-0" style="background-color:#DDDDDD">
		THỐNG KÊ THÁNG <?php echo $new_month;?>
		</div>
		<div class="card-body pt-0">
		<div class="row">
		
		<table class="table table-hover text-nowrap">
		<tr>
		<th>Tổng số đơn hàng: <?php echo $dulieuformonth['sodonhang'];?></th>

		</tr>
		<tr>
		<th>Tổng số C.W: <?php echo $dulieuformonth['tongcannang'];?></th>
		</tr>
		<tr>
		<th>Doanh thu: <?php echo '<font color=orange>'.number_format($dulieuformonth['doanhthu']).' đ </font>';?></th>
		</tr>
		<tr>
		<th>Hoa hồng đơn công ty: <?php echo '<font color=green>'.number_format($dulieuformonth['loinhuanthuctecongty']*20/100*15/100).' đ </font>';?></th>
		</tr><tr>
		<th>Hoa hồng đơn tự tìm : <?php echo '<font color=green>'.number_format($dulieuformonth['loinhuanthuctetutim']*50/100*15/100).' đ </font>';?></th>
		</tr>

		<tr>
		
		</tr>
	
	
		
		</table>
		
		</div>
		</div>
		<div class="card-footer">
		<div class="text-right">
		<!--
		<a href="#" class="btn btn-sm bg-teal">
		<i class="fas fa-comments"></i>
		</a>
		<a href="#" class="btn btn-sm btn-primary">
		<i class="fas fa-user"></i> View Profile
		</a>
		-->
		
		</div>
		</div>
		</div>
		</div>
<!--
<div class="col-sm-2" style="background-color:#DDDDDD;padding-top:20px"><form action="" method="POST">

<div class="form-group">
<input type="text" class="form-control" name="id_bill" placeholder=" ID BILL" required>
</div>
</div>
<div class="col-sm-1" style="background-color:#DDDDDD;padding-top:20px">
<div class="form-group">
<input type="submit" class="btn btn-danger" name="search" value="Search" >
</div>
</div>
</form>-->

						</div>
   
   <hr>
   
   <div class="row">

      <div class="col-md-12">
	 
		
			
			
			
		<table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:blue">
               <tr style="background-color:#CCCC66;font-size:11px">
                  <th style="text-align: center;color:white">Date</th>
                  <th style="text-align: center;color:white">ID BILL</th>
                  <th style="text-align: center;color:white">Chi nhánh</th>
                  <th style="text-align: center;color:white">Dịch Vụ</th>
                  <th style="text-align: center;color:white">Người nhận</th>
                  <th style="text-align: center;color:white">Số kiện</th>
                  <th style="text-align: center;color:white">Charge weight</th>
                  <th style="text-align: center;color:white">$ Total</th>
                  <th style="text-align: center;color:white">$ Phụ thu</th>
                  <th style="text-align: center;color:white">$ Nội địa</th>
                  <th style="text-align: center;color:white">$ Thu hộ</th>
			
                  <th style="text-align: center;color:white">$ Bảo hiểm</th>
				  <th style="text-align: center;color:white">$ VAT</th>
                  <th style="text-align: center;color:white">$ CPVH</th>
                  <th style="text-align: center;color:white">$ Cước gốc
				  <?php
				if($roleid != 6)
				  {
				
						 echo'<a href="m_admin.php?m=sale_detail&id='.$_GET['id'].'&select_month='.@$_GET['select_month'].'&edit=code_price" style="color:blue" class="btn btn-sm"><i class="fas fa-edit"></i></a>';
				  }
					?></th>
                  <th style="text-align: center;color:white">Payment</th>           
                  <th style="text-align: center;color:white">Status</th>           
				  <th style="text-align: center;color:white">Lợi nhuận</th>
				  <th style="text-align: center;color:white">Nguồn</th>
				  <th style="text-align: center;color:white">Hoa Hồng</th>

                 

               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5|| $roleid == 6) {
							$data = mysqli_query($conn,"SELECT * FROM ns_package where  `delete` IS NULL  AND `id_sale`='$idsale' AND (`sokien`>0) AND month(date)='$new_month' order by id DESC ");
				}
			   
				else{
                  //$data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap");
               }
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
				  //$laydulieukien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$item['id_listhoadon']."'"))or die(mysql_error());
                  $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id ='".$item['id']."'"))or die ("loi");
                  $cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"))or die ("loi");
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
				  @$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
				  @$dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select ten,hanmuc from ns_user where id='".$package['uid']."'"));
				  
				  $totalcuoc = sum_package_sale($item['khach_cuocbay'],$item['khach_phuthu'],$item['khach_cuocnoidia'],$item['khach_thuho'],$item['khach_phibaohiem'],$item['vat']);
				  $sotiengoc= sum_package_code($package['kg_dichvu'],$package['charge_weight'],$rName['city'],$rName['country_id'],$package['kg_chinhanh'],$conn,$rName['post_code'],$rName['state'],$package['id_code']);

					$laydulieuchiphia = mysqli_query($conn,"select * from kns_listhoadonchiphi where id_code='".$item['id_code']."'");
					@$sotienchiphi = 0;
					while(@$laydulieuchiphi = mysqli_fetch_array($laydulieuchiphia,MYSQLI_ASSOC))
									{
										
									$sotienchiphi+=$laydulieuchiphi['price']*$laydulieuchiphi['soluong'];
									}
									
									
					$loinhuanbill = loinhuanbill($item['khach_cuocbay'],$item['khach_phuthu'],$item['khach_cuocnoidia'],$item['khach_thuho'],$item['khach_phibaohiem'],$item['vat'],$sotienchiphi,$item['cuoc_goc']);				
			
				
                  echo '<tr>
				  <td style="text-align: center; color:black;font-size:12px;">'.$item['date'].''; 
				  
				  if($roleid == 3 || $roleid == 1) {echo'<a href="m_admin.php?m=editdatetime&id='.$item['id_code'].'" target="_blank"> <i class="fas fa-user-edit"></i></a>';}
				  
				  echo'</td>
				  <td style="text-align: center; color:black;font-size:12px;"><a href="package_fn.php?id='.$package['id'].'">'.$item['id_code'].'</a> </td>
				                    <td style="text-align: center; color:black;font-size:12px;">'.$package['kg_chinhanh'].'</td>

                  <td style="text-align: center; color:black;font-size:12px;">'.dichvu($conn,$package['kg_dichvu']).'</td>
                  <td style="text-align: center; color:black;font-size:12px;">'.$rName['name'].'</td>
                  <td style="text-align: center; color:black;font-size:12px;">'.$item['sokien'].'</td>
                  <td style="text-align: center; color:black;font-size:12px;">'.$item['charge_weight'].'</td>
                  <td style="text-align: right; color:blue;font-size:12px;">'.number_format(@$item['khach_cuocbay']).' </td>
                  
				  
				  
				  
				  
				  ';
				  
				  if(isset($_GET['edit'])&& $_GET['edit'] == 'code_price')
				  {
				  if($roleid == 3 || $roleid == 1)
				  {
					  echo'
					  <form action="" method="POST">
					  <input type="hidden" value="'.$item['id_code'].'" name="id_edit">

					  <td style="text-align: right; color:#880000;font-size:12px;"><input type="text" value="'.$item['khach_phuthu'].'" name="khach_phuthu"></td>
					  <td style="text-align: right; color:#880000;font-size:12px;"><input type="text" value="'.$item['khach_cuocnoidia'].'" name="khach_cuocnoidia"></td>
					  <td style="text-align: right; color:#880000;font-size:12px;"><input type="text" value="'.$item['khach_thuho'].'" name="khach_thuho"></td>
					  <td style="text-align: right; color:#880000;font-size:12px;"><input type="text" value="'.$item['khach_phibaohiem'].'" name="khach_phibaohiem"></td>
					  <td style="text-align: right; color:#880000;font-size:12px;"><input type="text" value="'.$item['vat'].'" name="vat"></td>
					  					<td style="text-align: center; color:orange;font-size:12px;">'.number_format(@$sotienchiphi).' </td>
	
					  <td style="text-align: right; color:#880000;font-size:12px;"><input type="text" value="'.$item['cuoc_goc'].'" name="cuoc_goc">
					  <button type="submit" name="btn_editcodeprice">Edit</button></td>
					  
					  </form>
					  ';
  
				  }
				  }
				  else
				  {
					  echo'
					  <td style="text-align: center; color:orange;font-size:12px;">'.number_format(@$item['khach_phuthu']).' </td>
					<td style="text-align: center; color:orange;font-size:12px;">'.number_format(@$item['khach_cuocnoidia']).' </td>
					<td style="text-align: center; color:orange;font-size:12px;">'.number_format(@$item['khach_thuho']).' </td>
					<td style="text-align: center; color:orange;font-size:12px;">'.number_format(@$item['khach_phibaohiem']).' </td>
					<td style="text-align: center; color:orange;font-size:12px;">'.number_format(@$item['vat']).' </td>
					<td style="text-align: center; color:orange;font-size:12px;">'.number_format(@$sotienchiphi).' </td>
					  <td style="text-align: right; color:#880000;font-size:12px;">'.number_format(@$item['cuoc_goc']).'</td>
					  ';
				  }
				 
				 echo'

                  <td style="text-align: center; color:black;font-size:12px;">'.checkthanhtoan($item['checkthanhtoan']).'</td>
                  <td style="text-align: center; color:black;font-size:12px;"></td>
                  <td style="text-align: right; color:green;font-size:12px;">';
				  
				  if($item['check_hold'] == 1 || $item['checkthanhtoan'] != '2' || ($item['status'] != '2' AND $item['status'] != '1')   || $item['cuoc_goc'] == '0')
				  {
					  echo'<font color=red  style="cursor: pointer;"  title="Chưa đủ điều kiện để tính lợi nhuận">0đ <i class="fas fa-info-circle" ></i></font>';
				  }
				  else
				  {
				  echo number_format(@$loinhuanbill).'đ';
				  }
				  echo'</td>
				  
				    <td style="text-align: left; color:green;font-size:12px;">';
				  
				  if($item['chiho'] == '0')
				  {
					  echo'<a href="edit_cpvhz.php?id='.$item['id'].'" target="_blank"><i class="fas fa-edit"></i></a>Công ty';
				  }
				  else
				  {
				   echo'<a href="edit_cpvhz.php?id='.$item['id'].'" target="_blank"><i class="fas fa-edit"></i></a>Tự tìm';
				  }
				  echo'</td>
				  
				  
					 <td style="text-align: right; color:green;font-size:12px;">';
				   if($item['check_hold'] == 1 || $item['checkthanhtoan'] != '2' || ($item['status'] != '2' AND $item['status'] != '1')   || $item['cuoc_goc'] == '0')
				  {
					  echo'<font color=red  style="cursor: pointer;"  title="Chưa đủ điều kiện để tính lợi nhuận">0đ <i class="fas fa-info-circle" ></i></font>';
				  }
				  else
				  {

				  if($item['chiho'] == '0')
				  {
				  echo number_format(@$loinhuanbill*20/100*15/100).'đ';
				  }
				  else
				  {
				  echo number_format(@$loinhuanbill*50/100*15/100).'đ';
				  }				  }
				  echo'</td>
				
                  </tr>';
               }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
      </div>
   </div>
</div>



		<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Export Excel for Sales</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			
			
			
			
				
		 		 <form method="GET" action="mani_sale2.php">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="<?php echo @$day_start;?>">
<label for="aa">To Date:</label>
<input type="date" id="aa" name="day_end"  value="<?php echo @$day_end;?>"><br>
<label for="aa">Sales Name:</label>

							<select name="id"> 
							<?php
							$laydulieusaleadd = mysqli_query($conn,"select * from ns_user where  roleid='6' AND id='".$_GET['id']."'");
							while($laydulieusale = mysqli_fetch_array($laydulieusaleadd,MYSQLI_ASSOC))
							{
								echo'<option value="'.$laydulieusale['id'].'">('.$laydulieusale['cus_code'].')'.$laydulieusale['ten'].'</option>';
							}
							?>
							</select>
				
				
				
            </div>
            <div class="modal-footer justify-content-between">
              <input type="submit" name="" class="btn btn-danger btn-sm" value="Export">	
							</form>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>
	  
	  
	  <?php
	  
	  if($roleid == 1 || $roleid == 4 || $roleid == 3)
	{
		echo'<div class="modal fade" id="modal-default-addmember">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Member for Leader</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="" method="POST">
			';
			
			
			echo'					<label for="inputPassword3" class="control-label">Chọn Sale Add Member </font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown" name="idkhachhang" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='6' AND id NOT IN (select id_member from ksn_sale_leader_detail)AND id NOT IN (select id_saleleader from ksn_sale_leader)")or die("Loi");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['ten'].' ['.$item['username'].']</option>
								';
							}
					echo'</select>';
			
				
			echo'
			<br><button type="submit" name="btn_add" class="btn btn-danger">Thêm Member</button>
			</form>
           <hr>
		   
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
	}
	
	
	  if($roleid == 6)
	{
		echo'<div class="modal fade" id="modal-default-addmember2">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Member for Leader</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="" method="POST">
			';
			
			
			echo'					<label for="inputPassword3" class="control-label">Chọn Sale Add Member </font></label>
					<select  class="form-control select2bs4" id="nguoinhan_countries-dropdown" name="idkhachhang" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='6' AND id NOT IN (select id_member from ksn_sale_leader_detail)AND id NOT IN (select id_saleleader from ksn_sale_leader)")or die("Loi");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['ten'].' ['.$item['username'].']</option>
								';
							}
					echo'</select>';
			
				
			echo'
			<br><button type="submit" name="btn_add2" class="btn btn-danger">Thêm Member</button>
			</form>
           <hr>
		   
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
	}
	  ?>
	  
	  
	  
	  <?php
	  
	  if($roleid == 1 || $roleid == 4 || $roleid == 3)
	{
		echo'<div class="modal fade" id="modal-default-addprivatekpi">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Áp giá KPI cho riêng cá nhân</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="" method="POST">
			';
			
			
			echo'				

			<label for="inputPassword3" class="control-label">Mã KPI (<font color=red>KPI-01,KPI-02,...</font>)</font></label>
			<input type="text" class="form-control" value="KPI-01" name="kpi_name">
			
			<label for="inputPassword3" class="control-label">Hoa hồng</font></label>
			<input type="text" class="form-control" value="" name="hoahong">
			
			
					';
					
			
				
			echo'
			<br><button type="submit" name="btn_addprivatekpi" class="btn btn-primary">Thêm Áp giá KPI</button>
			</form>
           <hr>
			<table class="table table-hover text-nowrap">
			
		   <tr style="font-weight:bold">
		   <td>Tên KPI</td><td>Hoa hồng</td><td></td>
		   </tr>
		   
		   ';
		   $apkpirienga = mysqli_query($conn,"select * from ksn_kpi_private where id_sale='$idsale'");
		   while($apkpirieng = mysqli_fetch_array($apkpirienga))
		   {
			   echo'<tr>
		   <td>'.$apkpirieng['name'].'</td><td>'.$apkpirieng['hoahong'].'%</td>
		   <td>
		   <form action="" method="POST">
		   <input type="hidden" value="'.$apkpirieng['id'].'" name="delete_idkpiprivate">
		   <button type="submit" name="btn_deletekpiprivate" class="btn btn-danger btn-sm" onclick="return confirm(\'Xác nhận xóa mức KPI áp riêng?\')"> 
						  
						  <i class="fas fa-trash-alt"></i> Delete</button>
		   </form>
		   </td>
		   
		   </tr>';
		   }
		   
		   echo'
		   </table>
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
	}
	  ?>