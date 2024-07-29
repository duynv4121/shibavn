<?php  
      include('../controller/bill.php');
	if($roleid == 1)
	{
	}
	else
	{
		exit();
	}
    loadModalScanPackage();
    if (isset($_POST['btn_submit'])) {
		
		if($roleid == 1)
		{
       $id_active = $_POST['id_active'];
       
	   mysqli_query($conn,"UPDATE `ns_user` SET `active`='' WHERE (`id`='$id_active')");
	     echo'<script> 
            alert("Active user thành công !");
           </script>';
		}
    }
	
	if (isset($_POST['btn_delete'])) {
		
		if($roleid == 1)
		{
              $id_active = $_POST['id_active'];

	   mysqli_query($conn,"DELETE FROM `ns_user` WHERE (`id`='".$id_active."')");
	     echo'<script> 
            alert("Xóa User khỏi danh sách chờ thành công !");
           </script>';
		}
    }
	

?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   <form action="create_fwduser.php" method="POST">
   
      <div class="row">
	  
	        <div class="col-md-7">

         <!-- <div class="col-xs-3">
            <div class="input-group date mr-2">
               <div class="form-group ">
                  <input placeholder="Tháng" name="datefrom" type="text" class="form-control" id="datepicker1">
               </div>
            </div>
         </div> -->
        
      </div>
      </div>
   </form>
   <br>
   <div class="row">
      <div class="col-md-12">
		<table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:white;background-color:blue">
               <tr>
                  <th style="text-align: center;color:white">Username</th>
                  <th style="text-align: center;color:white">Mã User</th>
                  <th style="text-align: center;color:white">Company Name</th>
                  <th style="text-align: center;color:white">Phone Number</th>
                  <th style="text-align: center;color:white">Type</th>
    
                  <th style="text-align: center;color:white"></th>
                 
               </tr>
            </thead>
            <tbody>

               <?php
                  $data = mysqli_query($conn,"SELECT * FROM ns_user where active='1' order by id DESC");
               
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
				  $layidcus = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_customer where cus_code='".$item['cus_code']."'"));
				  
                  $i++;
                  echo '<tr>
                  <td style="text-align: left; color:black">'.check_active($item['active']).$item['username'].'</td>
                  <td style="text-align: center; color:black"><a href="customer_detail.php?code='.@$layidcus['id'].'">'.$item['cus_code'].'</a></td>
                  <td style="text-align: center; color:black">'.$item['congty'].'</td>
                  <td style="text-align: center; color:black">'.$item['phone'].'</td>
				  <td style="text-align: center; color:black"><span class="badge badge-light">'.chucvu($item['roleid']).'</span>';
				  
				  if($item['roleid'] == 6) {
					echo'[LMT : '.number_format($item['hanmuc']).'đ]';
				  }
				  echo'</td>
		
                
                  <td>
				  <form action="" method="POST">
				  <input type="hidden" value="'.$item['id'].'" name="id_active">
				  <button type="submit" name="btn_submit" class="btn btn-success btn-sm">Active</button>
				  ';
				  if($item['roleid'] == 2)
				  {
				  echo'<a href="m_admin.php?m=edit_fwd&id='.$item['id'].'" class="btn btn-info btn-sm" target="_blank">View Info</a>';
				  }else
				  {
				  echo'<a href="m_admin.php?m=edit_user&id='.$item['id'].'" class="btn btn-info btn-sm" target="_blank">View Info</a> ';  
				  }
				  echo' 				 <button type="submit" name="btn_delete" class="btn btn-danger btn-sm" style="text-align:right"  onclick="return confirm(\'Chắc chắn muốn xóa người dùng: '.$item['username'].' khỏi danh sách chờ ?\')" />Delete</button></form>
					
                  </td>
                  </tr>';
               }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
      </div>
   </div>
</div>

<?php  
?>

<script type="text/javascript">
   $('#modalInScanPackage').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget); 
       var recipient = button.data('whatever');
       var modal = $(this);
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