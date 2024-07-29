<?php  
    include('top.php');
    include('modals.php');
    loadModalScanPackage();
   
	
	
	
	
	
	
	if($roleid == 1 || $roleid == 3 ||$roleid == 6 )
	{
		
	}
	else
	{
		echo'<script> 
               window.location.href="index.php";
            </script>';
	}
?>

<?php
	function checkedit($roleid,$conn){
		$laydulieucheck = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_system where string_code='accountant_edit'"));

		if($roleid == 3)
		{
			if($laydulieucheck['status'] == 1)
			{
				 echo'<script> 
               alert("Chức năng tạm khóa, liên hệ ADMIN để mở khóa chỉnh sửa!");
							window.location = "m_admin.php";

              </script>';
			  exit();
			}
		}
	}
	
if(@$_GET['m'] == "config")
{
include('admin/config_website.php');	
}

else if(@$_GET['m'] == "item")
{
	checkedit($roleid,$conn);
include('admin/list_item.php');	
}
else if(@$_GET['m'] == "remote_list")
{	
	checkedit($roleid,$conn);
include('admin/list_remote.php');	
}
else if(@$_GET['m'] == "services")
{	
	checkedit($roleid,$conn);
include('admin/list_services.php');	
}


###Bang gia 1
else if(@$_GET['m'] == "services_price")
{
	checkedit($roleid,$conn);
include('admin/list_services_price.php');	
}else if(@$_GET['m'] == "e_service_price")
{
	checkedit($roleid,$conn);
include('admin/edit_services_price.php');	
}else if(@$_GET['m'] == "e_service_price_csv")
{
	checkedit($roleid,$conn);
include('admin/edit_services_price_csv.php');	
}

###Bang gia 2
else if(@$_GET['m'] == "services_price2")
{
	checkedit($roleid,$conn);
include('admin/list_services_price2.php');	
}else if(@$_GET['m'] == "e_service_price2")
{
	checkedit($roleid,$conn);
include('admin/edit_services_price2.php');	
}else if(@$_GET['m'] == "e_service_price_csv2")
{
	checkedit($roleid,$conn);
include('admin/edit_services_price_csv2.php');	
}

###Bang gia 3
else if(@$_GET['m'] == "services_price3")
{
	checkedit($roleid,$conn);
include('admin/list_services_price3.php');	
}else if(@$_GET['m'] == "e_service_price3")
{
	checkedit($roleid,$conn);
include('admin/edit_services_price3.php');	
}else if(@$_GET['m'] == "e_service_price_csv3")
{
	checkedit($roleid,$conn);
include('admin/edit_services_price_csv3.php');	
}



else if(@$_GET['m'] == "e_service_price_date")
{
	checkedit($roleid,$conn);
include('admin/edit_services_price_date.php');	
}



else if(@$_GET['m'] == "services_country")
{
	checkedit($roleid,$conn);
include('admin/services_country.php');	
}
else if(@$_GET['m'] == "fwd")
{
include('admin/list_fwduser.php');	
}
else if(@$_GET['m'] == "user")
{
include('admin/list_user.php');	
}else if(@$_GET['m'] == "create_user")
{
include('admin/create_usernv.php');	
}else if(@$_GET['m'] == "edit_fwd")
{
include('admin/edit_fwd.php');	
}else if(@$_GET['m'] == "edit_user")
{
include('admin/edit_usernv.php');	
}
else if(@$_GET['m'] == "cash_manager")
{
include('admin/list_chitieu.php');	
}else if(@$_GET['m'] == "edit_dieukhoan")
{
include('admin/edit_dieukhoan.php');	
}else if(@$_GET['m'] == "edit_debit")
{
include('admin/edit_debit.php');	
}else if(@$_GET['m'] == "dashboard")
{
include('admin/dashboard.php');	
}else if(@$_GET['m'] == "wait_active")
{
include('admin/list_wait_active.php');	
}else if(@$_GET['m'] == "list_discountuser")
{
include('admin/list_discountuser.php');	
}else if(@$_GET['m'] == "list_discountuser_date")
{
include('admin/list_discountuser_date.php');	
}else if(@$_GET['m'] == "list_discount_package")
{
include('admin/list_discount_package.php');	
}else if(@$_GET['m'] == "list_price_package")
{
include('admin/list_price_package.php');	
}
else if(@$_GET['m'] == "sale_detail")
{
include('admin/list_sale_packageforid.php');	
}
else
{
	
$laydulieubangia1 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu'"));
$laydulieubangia2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu2'"));
$laydulieubangia3 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu3'"));
$laydulieubangia4 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_apdunggia where bang_gia='ksn_giadichvu4'"));
echo'

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   <form action="create_fwduser.php" method="POST">
   
   
   </form>
   <br>
   <div class="row">
      
	  <div class="col-md-3">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-wrench"></i> Quản lý Dịch vụ và Phụ Thu</h3>
              </div>
              <div class="card-body">
                <a href="m_admin.php?m=item"><i class="fas fa-list-alt"></i> Danh sách hàng hóa phụ thu</a><hr>
                <a href="m_admin.php?m=services"><i class="fas fa-list-alt"></i> Danh sách Dịch vụ</a><hr>
                <!--<a href="m_admin.php?m=remote_list"><i class="fas fa-list-alt"></i> Danh sách Remote (AU)</a><hr>-->
                <a href="m_admin.php?m=services_country"><i class="fas fa-list-alt"></i> Liên Kết Quốc Gia - Dịch Vụ</a><hr>
                <a href="m_document.php?m=add_cities"><i class="fas fa-list-alt"></i> Thêm Thành Phố Vào Hệ Thống</a><hr>
                <a href="m_admin.php?m=list_discountuser"><i class="fas fa-list-alt"></i> List Dịch Vụ Khuyến Mãi</a><hr>
                <a href="m_admin.php?m=list_discountuser_date"><i class="fas fa-list-alt"></i> List Danh Sách Discount Tài Khoản</a><hr>
                <a href="m_admin.php?m=list_discount_package"><i class="fas fa-list-alt"></i> List Danh Sách Discount ID Package</a><hr>
                <a href="m_admin.php?m=list_price_package"><i class="fas fa-list-alt"></i> List Danh Sách Price ID Package</a><hr>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --><div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-wrench"></i>QUẢN LÝ DANH SÁCH BẢNG GIÁ</h3>
              </div>
              <div class="card-body">
       
                <a href="m_admin.php?m=services_price&banggia=1" style="color:#336600"><i class="fas fa-list-alt"></i> Bảng Giá 1 ('.$laydulieubangia1['date_start'].' đến '.$laydulieubangia1['date_end'].')</a><hr>
                <a href="m_admin.php?m=e_service_price_csv&banggia=1"  style="color:#336600"><i class="fas fa-list-alt"></i> UPLOAD BẢNG GIÁ 1.CSV</a> <hr>
				
				<a href="m_admin.php?m=services_price&banggia=2"  style="color:#CD2626"><i class="fas fa-list-alt"></i> Bảng Giá 2 ('.$laydulieubangia2['date_start'].' đến '.$laydulieubangia2['date_end'].')</a><hr>
                <a href="m_admin.php?m=e_service_price_csv&banggia=2"  style="color:#CD2626"><i class="fas fa-list-alt"></i> UPLOAD BẢNG GIÁ 2.CSV</a><hr>
				
				<a href="m_admin.php?m=services_price&banggia=3"  style="color:#A0522D"><i class="fas fa-list-alt"></i> Bảng Giá 3 ('.$laydulieubangia3['date_start'].' đến '.$laydulieubangia3['date_end'].')</a><hr>
                <a href="m_admin.php?m=e_service_price_csv&banggia=3"  style="color:#A0522D"><i class="fas fa-list-alt"></i> UPLOAD BẢNG GIÁ 3.CSV</a><hr>
				
				<a href="m_admin.php?m=services_price&banggia=4"  style="color:#CDBE70"><i class="fas fa-list-alt"></i> Bảng Giá 4 ('.$laydulieubangia4['date_start'].' đến '.$laydulieubangia4['date_end'].')</a><hr>
                <a href="m_admin.php?m=e_service_price_csv&banggia=4"  style="color:#CDBE70"><i class="fas fa-list-alt"></i> UPLOAD BẢNG GIÁ 4.CSV</a><hr>
				
				
				
				
                <a href="m_admin.php?m=e_service_price_date"><i class="fas fa-list-alt"></i> UPDATE THỜI GIAN BẢNG GIÁ</a>
				
				
				
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       </div>
	   
	   <div class="col-md-3">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-wrench"></i> Quản lý Account SHIBA</h3>
              </div>
              <div class="card-body">
                <a href="m_admin.php?m=fwd"><i class="fas fa-users-cog"></i> Danh sách Account FWD</a><hr>
                <a href="m_admin.php?m=user"><i class="fas fa-users-cog"></i> Danh sách Account Công Ty</a><hr>';
				
				
				if($roleid == 1)
				{
				$count = mysqli_num_rows(mysqli_query($conn,"select * from ns_user where active='1'"));
                echo'<a href="m_admin.php?m=wait_active"><i class="fas fa-users-cog"></i> Danh sách Chờ Duyệt (<b>'.$count.'</b>)</a><hr>';
                }
				
              echo'</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       </div>
	   
	   <div class="col-md-3">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-wrench"></i> Quản lý KẾ TOÁN</h3>
              </div>
              <div class="card-body">
			  
                <a href="m_accountant.php?ac=list_package_sale"><i class="fas fa-clipboard-list"></i> List Package Sale</a><hr>
                <a href="m_accountant.php?ac=list_debit_sale"><i class="fas fa-clipboard-list"></i> List Chờ Duyệt Thanh Toán Sale</a><hr>
                <a href="m_accountant.php?ac=list_package_fwd"><i class="fas fa-clipboard-list"></i> List Package FWD</a><hr>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       </div>
	   
	   <div class="col-md-3">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-wrench"></i> Quản lý Khác</h3>
              </div>
              <div class="card-body">
                <a href="m_admin.php?m=edit_dieukhoan"><i class="fas fa-edit"></i> Chỉnh sửa Điều Khoản</a><hr>
                <a href="m_admin.php?m=edit_debit"><i class="fas fa-edit"></i> Chỉnh sửa Xuất Debit</a><hr>
';
				
				
				
				
              echo'                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       </div>
	   
	   
	   
   </div>
</div>

';
}
?>

<?php  
    include('footer.php');
?>
<script>
$(document).ready(function() {

	$('.add2').click(function() {
		$("#themhinhanh").append("<input type='file'  class='form-control  custom-file-upload' name='photo[]' id = 'fileSelect' multiple></div>");
	});
		
	});
</script>

<script type="text/javascript">
   <script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>


