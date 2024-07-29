<?php  
    include('../controller/bill.php');
    loadModalScanPackage();
    if (isset($_POST['btn_create'])) {
       $code = mb_strtoupper($_POST['code']);
       $count = mysql_num_rows(mysql_query("SELECT * FROM ns_customer WHERE UPPER(name) = '$code'"));
       if ($count == 0) {
         echo'<script> 
               alert("Khách hàng mới! Bạn cần tạo khách hàng trước!");
               window.location.href="cus_create.php?codeair='.$code.'";
            </script>';
       }else{
         echo'<script> 
               window.location.href="create_package.php?code='.$code.'";
            </script>';
       }

    }
	
	if(isset($_POST['btn_active']))
	{
		$idactive = $_POST['idactive'];
		mysqli_query($conn,"UPDATE `ns_user` SET `active`='' WHERE (`id`='$idactive')");

	}
	
	
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   
      <div class="row">
	  
	        <div class="col-md-7">

         <!-- <div class="col-xs-3">
            <div class="input-group date mr-2">
               <div class="form-group ">
                  <input placeholder="Tháng" name="datefrom" type="text" class="form-control" id="datepicker1">
               </div>
            </div>
         </div> -->
        <a href="m_admin.php?m=create_user" class="btn btn-primary ">
               <i class="fas fa-plus"></i>Create New User</a>
            </a>
      </div>
      </div>
   <br>
   <div class="row">
      <div class="col-md-12">
		<table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:white;background-color:blue">
               <tr>
                  <th style="text-align: center;color:white">Username</th>
                  <th style="text-align: center;color:white">Mã User</th>
                  <th style="text-align: center;color:white">Tên Nhân Viên</th>
                  <th style="text-align: center;color:white">Phone Number</th>
                  <th style="text-align: center;color:white">CHỨC VỤ</th>
                  <th style="text-align: center;color:white"></th>
                 
               </tr>
            </thead>
            <tbody>

               <?php
                  $data = mysqli_query($conn,"SELECT * FROM ns_user where roleid <> '2' AND roleid <> '1'  order by id DESC");
               
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
				  $layidcus = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_customer where cus_code='".$item['cus_code']."'"));
				  
                  $i++;
                  echo '<tr>
                  <td style="text-align: left; color:black">'.check_active($item['active']).$item['username'].'</td>
                  <td style="text-align: center; color:black"><a href="customer_detail.php?code='.@$layidcus['id'].'">'.$item['cus_code'].'</a></td>
                  <td style="text-align: center; color:black">'.$item['ten'].'</td>
                  <td style="text-align: center; color:black">'.$item['phone'].'</td>
				  <td style="text-align: center; color:black"><span class="badge badge-light">'.chucvu($item['roleid']).'</span></td>
<form action="" method=POST>
				  
                  <td>';
				  if($item['active'] == 2)
				  {                   
					echo'<input type="hidden" value="'.$item['id'].'" name="idactive"><button type="submit" name="btn_active" class="btn btn-success btn-sm" onclick="return confirm(\'Xác nhận bỏ chặn người dùng này:'.$item['username'].' ?\')" >Active</button>';

				  }
					else
					{
				  echo
                   '<a href="update_user_status.php?id='.$item['id'].'"  class="btn btn-danger btn-sm" onclick="return confirm(\'Xác nhận chặn người dùng này:'.$item['username'].' ?\')" >Disable</a>';
				   
					}
				   echo'</form>
                   <a href="m_admin.php?m=edit_user&id='.$item['id'].'"  class="btn btn-warning btn-sm" >Edit</a>
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