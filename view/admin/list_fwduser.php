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
	
	if (isset($_POST['btn_submit'])) {
		
		if($roleid == 1)
		{
       $check_export = $_POST['check_export'];
       
	   mysqli_query($conn,"UPDATE `ns_user` SET `check_export`='1' WHERE (`id`='$check_export')");
	     echo'<script> 
            alert("Lock export user thành công !");
           </script>';
		}
    }
	if (isset($_POST['btn_submit_unlock'])) {
		
		if($roleid == 1)
		{
       $check_export = $_POST['check_export'];
       
	   mysqli_query($conn,"UPDATE `ns_user` SET `check_export`='0' WHERE (`id`='$check_export')");
	     echo'<script> 
            alert("Lock export user thành công !");
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
   </form>
      <div class="row">
	  
	        <div class="col-md-5">

         <!-- <div class="col-xs-3">
            <div class="input-group date mr-2">
               <div class="form-group ">
                  <input placeholder="Tháng" name="datefrom" type="text" class="form-control" id="datepicker1">
               </div>
            </div>
         </div> -->
		 <?php
		 if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 6|| $roleid == 2 ) {
		 echo'		<div class="row"style="background-color:#EEEEEE;padding-top:20px;border: 1px solid black;border-style: outset;" >
<div class="col-sm-9" >';

echo'
		 		 <form method="GET" action="">

			<div class="form-group">
		
										
										
			<label for="aa">CÔNG NỢ</label>';
			
			?>

										<select name="status"> 
										<option>Tất cả</option>
										<option value="1" <?php if(@$_GET['status'] == 1){echo'selected';}?>>DAY</option>
										<option value="2" <?php if(@$_GET['status'] == 2){echo'selected';}?>>WEEK</option>
										<option value="4" <?php if(@$_GET['status'] == 4){echo'selected';}?>>2 WEEK</option>
										<option value="3" <?php if(@$_GET['status'] == 3){echo'selected';}?>>MONTH</option>
										</select>
										
										<?php
										echo'
										<input type="hidden" name="m" class="btn btn-danger btn-sm" value="fwd">	
										<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	
										
										</div>							

			</form>
				
			</div>
			
	
			<div class="col-sm-3" style="">

			 <form action="create_fwduser.php" method="POST">  <button type="submit" name="" class="btn btn-warning ">
              <i class="fas fa-users"></i> Create New FWD</a>
            </button>
   </form></div>
      </div>
		';

	
echo'			<hr>

	';
			}
			?>
		 
		 
      
      </div>
      </div>
   <br>
   <div class="row">
      <div class="col-md-12">
		<table id="example3" class="display nowrap cell-border" style="width:100%;font-size:13px">
            <thead style="color:white;background-color:blue">
               <tr>
                  <th style="text-align: center;color:white">Username</th>
                  <th style="text-align: center;color:white">Mã Khách Hàng</th>
                  <th style="text-align: center;color:white">Company Name</th>
                  <th style="text-align: center;color:white">Phone Number</th>
                  <th style="text-align: center;color:white">Công Nợ</th>
                  <th style="text-align: center;color:white">BẢNG GIÁ</th>
                  <th style="text-align: center;color:white">Logo Công Ty</th>
                  <th style="text-align: center;color:white">NOTE NGÀY LÊN DEBIT</th>
                  <th style="text-align: center;color:white"></th>
                 
               </tr>
            </thead>
            <tbody>

               <?php
			   
			    if(isset($_GET['status']))
						{						
							if($_GET['status'] == '1')
							{
                  $data = mysqli_query($conn,"SELECT * FROM ns_user where roleid='2' AND payment_type='1' order by id DESC");
							}else if($_GET['status'] == '2')
							{
                  $data = mysqli_query($conn,"SELECT * FROM ns_user where roleid='2' AND payment_type='2' order by id DESC");
							}else if($_GET['status'] == '3')
							{
                  $data = mysqli_query($conn,"SELECT * FROM ns_user where roleid='2' AND payment_type='3' order by id DESC");
							}else if($_GET['status'] == '4')
							{
                  $data = mysqli_query($conn,"SELECT * FROM ns_user where roleid='2' AND payment_type='4' order by id DESC");
							}
							else
							{
                  $data = mysqli_query($conn,"SELECT * FROM ns_user where roleid='2' order by id DESC");
							}
						}
			   
					else
					{
                  $data = mysqli_query($conn,"SELECT * FROM ns_user where roleid='2' order by id DESC");
					}
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
				  $layidcus = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_customer where cus_code='".$item['cus_code']."'"));
				  $layngaydebit = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit where idkhachhang='".$item['cus_code']."' ORDER BY id DESC"));
				  if($layngaydebit['datetime'] != 0)
				  {
				  if($item['payment_type'] == 2)
				  {
					  
					  $ngaytaodebit = date('d/m/Y', strtotime($layngaydebit['datetime'].' +7 day'));
				  }
				  }
                  $i++;
                  echo '<tr>
                  <td style="text-align: left; color:black">'.check_active($item['active']).$item['username'].'</td>
                  <td style="text-align: center; color:black"><a href="customer_detail.php?code='.@$layidcus['id'].'">'.$item['cus_code'].'</a></td>
                  <td style="text-align: center; color:black">'.$item['congty'].'</td>
                  <td style="text-align: center; color:black">'.$item['phone'].'</td>
				  <td style="text-align: center; color:black"><u>'.congno($item['payment_type']).'</u></td>
				  <td style="text-align: center; color:black"><span class="badge badge-light">'.get_price_type($item['payment_price_type']).'</span></td>

                  <td style="text-align: center; color:black"><a href="../inbill/inbilltw/'.$item['logo'].'" target="_blank"><i class="fas fa-image"></i></a></td>
                				  <td style="text-align: center; color:red">'.($ngaytaodebit).'</td>

                  <td style="white-space:nowrap;">				    <form action="" method="POST">		';
				  
				  $ngaytaodebit = "";
				  
				  
				  if($item['check_export'] == 0)
				  {
 					echo'<input type="hidden" value="'.$item['id'].'" name="check_export">
					<button type="submit" name="btn_submit" class="btn btn-danger btn-sm"><i class="fas fa-plane-departure"></i> Lock Export</button>';
				  }
				  else
				  {
					echo'<input type="hidden" value="'.$item['id'].'" name="check_export">
					<button type="submit" name="btn_submit_unlock" class="btn btn-warning btn-sm"><i class="fas fa-plane-departure"></i>UnLock Export</button>';
				  }




echo'					<a href="update_user_status.php?id='.$item['id'].'"  class="btn btn-danger btn-sm" onclick="return confirm(\'Xác nhận chặn người dùng này:'.$item['username'].' ?\')" >Disable</a>
                   <a href="m_admin.php?m=edit_fwd&id='.$item['id'].'"  class="btn btn-warning btn-sm" >Edit</a>
				  </form>
				   
				   
				   
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