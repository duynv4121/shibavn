<?php  
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
   
	
	
	
	
	
	
	if($roleid == 4 || $roleid == 1 || $roleid == 2 || $roleid == 3 || $roleid == 6)
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
if(@$_GET['m'] == "dashboard")
{
include('admin/dashboard.php');	
}
else if(@$_GET['m'] == "add_cities")
{
include('admin/add_cities.php');	
}else if(@$_GET['m'] == "dashboardsale")
{
include('admin/dashboardsale.php');	
}else if(@$_GET['m'] == "dashboardfwd")
{
include('admin/dashboardfwd.php');	
}
else if(@$_GET['m'] == "add_cities")
{
include('admin/add_cities.php');	
}else if(@$_GET['m'] == "list_discountuser")
{
include('admin/list_discountuser.php');	
}else if(@$_GET['m'] == "update_label_bill")
{
include('accountant/update_label_bill.php');	
}else if(@$_GET['m'] == "update_label_auposte")
{
include('accountant/update_label_auposte.php');	
}else if(@$_GET['m'] == "sale_detail")
{
include('admin/list_sale_packageforid.php');	
}else if(@$_GET['m'] == "sale_detailfwd")
{
include('admin/list_sale_packageforfwd.php');	
}

else
{
	if($roleid == 4)
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
                <h3 class="card-title"><i class="fas fa-wrench"></i> Quản Lý Dành Cho Chứng Từ</h3>
              </div>
              <div class="card-body">
                <a href="m_document.php?m=dashboard"><i class="fas fa-list-alt"></i> Dashboard</a><hr>
                <a href="m_document.php?m=add_cities"><i class="fas fa-list-alt"></i> Thêm Thành Phố</a><hr>
                <a href="m_document.php?m=list_discountuser"><i class="fas fa-list-alt"></i> List Danh Sách Khuyến Mãi</a><hr>
                <a href="list_package_delete.php"><i class="fas fa-list-alt"></i> List kiện hàng ẩn</a>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       </div>
	   
	
	   
	   
	   
   </div>
</div>

';
	}
	else
	{
			echo'<script> 
               window.location.href="welcome.php";
            </script>';
	}
}
?>

<?php  
    include('footer.php');
?>

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