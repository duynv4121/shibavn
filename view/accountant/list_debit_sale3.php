<?php 

include("../controller/accountant.php");

?>
<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 

       
		 <?php
		 if(isset($_GET['day_start']))
		 {
			 $day_start = $_GET['day_start'];
			 $day_end = $_GET['day_end'];
		 }
		 else
		 {
			 $day_start = date('Y-m-d', strtotime("-30 days"));;
			 $day_end = date('Y-m-d');
		 }
		 
if(isset($_POST['valid_button']))
{
	$totalcuoc = $_POST['totalcuoc'];
	$id_bill = $_POST['id_bill'];
	$id_debit = $_POST['id_debit'];
	$user_id = $_POST['user_id'];
	$note = $_POST['note'];
	if($_POST['payment_type'] == 'debit')
	{
		$datenowa = date("Y-m-d");
		mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='2',date='$datenowa' WHERE (`id_code`='".$id_bill."')");
		//mysqli_query($conn,"UPDATE `ns_user` SET `hanmuc`=`hanmuc`+$totalcuoc WHERE (`id`='$user_id')");
		mysqli_query($conn,"UPDATE `ksn_debit_sale` SET `valid`='1', `valid_uid`='$uid', `final_price`='$totalcuoc', `valid_time`='$datenow', `note`='$note' WHERE (`id`='$id_debit')");
	}
	else
	{
		$datenowa = date("Y-m-d");
		mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='2',date='$datenowa' WHERE (`id_code`='".$id_bill."')");
		mysqli_query($conn,"UPDATE `ksn_debit_sale` SET `valid`='1', `valid_uid`='$uid', `final_price`='$totalcuoc', `valid_time`='$datenow', `note`='$note'  WHERE (`id`='$id_debit')");
	}
	
}if(isset($_POST['delete']))
{
	$totalcuoc = $_POST['totalcuoc'];
	$id_bill = $_POST['id_bill'];
	$id_debit = $_POST['id_debit'];
	$user_id = $_POST['user_id'];
	mysqli_query($conn,"DELETE FROM `ksn_debit_sale` WHERE (`id`='$id_debit')");
}

		 ?>			<h3>List  Sale Payment</h3>
   
   <hr>
   
   <div class="row">

      <div class="col-md-12">
			
		

			
			
			
		<table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:blue">
               <tr style="background-color:blue">
                  <th style="text-align: center;color:white">Date Payment</th>
                  <th style="text-align: center;color:white">ID BILL</th>
                  <th style="text-align: center;color:white">Sales Name</th>
                  <th style="text-align: center;color:white">Total</th>
                  <th style="text-align: center;color:white">Cước Gốc</th>
                  <th style="text-align: center;color:white">Method</th>
                  <th style="text-align: center;color:white">Type</th>
                  <th style="text-align: center;color:white">Upload IMG</th>
                  <th style="text-align: center;color:white"></th>
             
					

               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5) {
				   
				   if(isset($_POST['search']))
				   {                  
					$data = mysqli_query($conn,"SELECT * FROM ns_package where id_bill='".$_POST['id_bill']."' ");

				   }
				   else
				   {
					$data = mysqli_query($conn,"SELECT * FROM ksn_debit_sale where `valid` <> '1' OR `valid` is NULL ");

				   }
			   
			   }else{
                  //$data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap");					

               }
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
		   
				  //$laydulieukien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$item['id_listhoadon']."'"))or die(mysql_error());
                  $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id_code ='".$item['id_bill']."'"))or die ("loi11");
                  $cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"))or die ("loi");
                  $sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
				  @$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
				  @$dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select ten from ns_user where id='".$package['uid']."'"));
				  
				  $totalcuoc = sum_package_sale($package['khach_cuocbay'],$package['khach_phuthu'],$package['khach_cuocnoidia'],$package['khach_thuho'],$package['khach_phibaohiem'],$package['vat']);
				  $sotiengoc= sum_package_code($package['kg_dichvu'],$package['charge_weight'],$rName['city'],$rName['country_id'],$package['kg_chinhanh'],$conn,$rName['post_code'],$rName['state'],$package['id_code']);

                  echo '<tr> <form action="" method="POST">
				 <input type="hidden" name="id_debit" value="'.$item['id'].'">
				 <input type="hidden" name="id_bill" value="'.$item['id_bill'].'">
				 <input type="hidden" name="payment_type" value="'.$package['payment_type'].'">
				 <input type="hidden" name="totalcuoc" value="'.$package['khach_cuocbay'].'">
				 <input type="hidden" name="user_id" value="'.$package['id_sale'].'">
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['timethanhtoan'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;"><a href="package_fn.php?id='.$package['id'].'" target="_blank">'.$item['id_bill'].'</a></td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$package['cus_code'].'('.$dulieunhanvien['ten'].')</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.number_format($package['khach_cuocbay']).'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.number_format($sotiengoc).'</td>
                  <td style="text-align: center; color:black;font-size:14px;">';
				  if($package['payment_type'] == 'after')
				  {
					  echo'Thanh toán sau';
				  } else
				  {
					  echo'Thanh toán nợ';
				  }
				  echo'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$item['payment_method'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;"><a href="../upload/'.$item['bangchungthanhtoan'].'" target="_blank"><i class="fas fa-images"></i></a></td>
               

                 <td  style="font-size:14px;">
				
				 <input type="text" name="note" value="" placeholder="Nhập ghi chú">

				 <input type="submit" value="Duyệt Lệnh" class="btn btn-warning btn-sm" name="valid_button">
				 <input type="submit" value="Hủy Lệnh" class="btn btn-danger btn-sm" name="delete"  onclick="return confirm(\'Xác nhận hủy lệnh thanh toán?\')">
				 
				 
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
			
			
			
			
				
		 		 <form method="GET" action="mani_sale.php">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="<?php echo @$day_start;?>">
<label for="aa">To Date:</label>
<input type="date" id="aa" name="day_end"  value="<?php echo @$day_end;?>"><br>
<label for="aa">Select Sales Name:</label>

							<select name="id"> 
							<?php
							$laydulieusaleadd = mysqli_query($conn,"select * from ns_user where  roleid='6'");
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