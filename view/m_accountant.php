<?php  
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
   
	
	
	
	
	
	
	if($roleid == 1 || $roleid == 3)
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
if(@$_GET['m'] == "item")
{
include('admin/list_item.php');	
}
else if(@$_GET['m'] == "fwd")
{
include('admin/list_fwduser.php');	
}else if(@$_GET['m'] == "services")
{
include('admin/list_services.php');	
}else if(@$_GET['m'] == "services_price")
{
include('admin/list_services_price.php');	
}else if(@$_GET['m'] == "e_service_price")
{
include('admin/edit_services_price.php');	
}else if(@$_GET['m'] == "user")
{
include('admin/list_user.php');	
}else if(@$_GET['m'] == "create_user")
{
include('admin/create_usernv.php');	
}else if(@$_GET['m'] == "remote_list")
{
include('admin/list_remote.php');	
}else if(@$_GET['m'] == "services_country")
{
include('admin/services_country.php');	
}else if(@$_GET['m'] == "edit_fwd")
{
include('admin/edit_fwd.php');	
}else if(@$_GET['m'] == "edit_user")
{
include('admin/edit_usernv.php');	
}else if(@$_GET['m'] == "cash_manager")
{
include('admin/list_chitieu.php');	



}
### Ke toan

else if(@$_GET['ac'] == "list_scan_nhap")
{
include('accountant/list_scan_nhap.php');	
}
else if(@$_GET['ac'] == "list_package_sale")
{
include('accountant/list_package_sale.php');	
}else if(@$_GET['ac'] == "list_package_sale")
{
include('accountant/list_package_sale.php');	
}else if(@$_GET['ac'] == "list_debit_sale")
{
include('accountant/list_debit_sale.php');	
}



###fwd

else if(@$_GET['ac'] == "list_package_fwd")
{
include('accountant/list_package_fwd.php');	
}else if(@$_GET['ac'] == "list_package_sale_dt")
{
include('accountant/list_package_sale_dt.php');	
}
else
{
	
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
                <a href="m_admin.php?m=services_price"><i class="fas fa-list-alt"></i> Danh sách Bảng Giá</a><hr>
                <a href="m_admin.php?m=remote_list"><i class="fas fa-list-alt"></i> Danh sách Remote (AU)</a><hr>
                <a href="m_admin.php?m=services_country"><i class="fas fa-list-alt"></i> Liên Kết Quốc Gia - Dịch Vụ</a>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       </div>
	   
	   <div class="col-md-3">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-wrench"></i> Quản lý Account GPE</h3>
              </div>
              <div class="card-body">
                <a href="m_admin.php?m=fwd"><i class="fas fa-users-cog"></i> Danh sách Account FWD</a><hr>
                <a href="m_admin.php?m=user"><i class="fas fa-users-cog"></i> Danh sách Account Công Ty</a>
                
              </div>
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
   $('#modalInScanPackage').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget); 
       var recipient = button.data('whatever');
ư       var modal = $(this);
       $('#exampleModalLabelFake').val(recipient);
       modal.find('.modal-body input').val(recipient)
       $('#myFramed').attr('src', '../inbill/inscanpackage/inscanpakage.php?id=' + recipient );

   })
   $(function() {
      // customercode-dropdown
      $.ajax({
        url: '../controller/ajax.php',
        type: 'POST',
        data: {
          action: 'getCustomerName'
        },
        cache: false,
        success: function(result){
          $("#customercode-dropdown").html(result);
        }
      })
   });

   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })


</script>