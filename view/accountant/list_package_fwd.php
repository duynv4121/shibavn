<?php 

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
			 $day_start = date('Y-m-d', strtotime("-10 days"));;
			 $day_end = date('Y-m-d');
		 }
		 

		 ?>			<div class="row" >

		 <div class="col-sm-9" style="background-color:#DDDDDD;padding-top:20px">
		 		 <form method="GET" action="">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="<?php echo @$day_start;?>">
<label for="aa">To Date:</label>
<input type="date" id="aa" name="day_end"  value="<?php echo @$day_end;?>">
	<input type="hidden" id="aa" name="ac"  value="list_package_fwd">
							<input hidden id="aa" name="id"  value="<?php echo @$_GET['id'];?>">
							
							
<label for="aa">Status:</label>

							<select name="check_payment"> 
							<option value="" >All</option>
							<option value="2" <?php if(@$_GET['check_payment'] == 2){echo'selected';}?>>Đã thanh toán</option>
							<option value="0" <?php if(@$_GET['check_payment'] == '0'){echo'selected';}?>>Chưa thanh toán</option>
							<option value="5" <?php if(@$_GET['check_payment'] == '5'){echo'selected';}?>>Duyệt tạm ứng</option>
							</select>
							<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	
							</form>

							</div>											
			


</div>

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
</form>

						</div>
   
   <hr>
   
   <div class="row">

      <div class="col-md-12">
			
		

			
			
			
		<table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:blue">
               <tr style="background-color:blue">
                  <th style="text-align: center;color:white">Date</th>
                  <th style="text-align: center;color:white">ID BILL</th>
                  <th style="text-align: center;color:white">Account Code</th>
                  <th style="text-align: center;color:white">Sender Company</th>
                  <th style="text-align: center;color:white">Receiver Name</th>
                  <th style="text-align: center;color:white">Quốc gia</th>
                  <th style="text-align: center;color:white">Dịch Vụ</th>
                  <th style="text-align: center;color:white">Số kiện</th>
                  <th style="text-align: center;color:white">Cân nặng</th>
                  <th style="text-align: center;color:white">Status</th>
                 

               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5) {
				   
				   if(isset($_POST['search']))
				   {                  
					$data = mysqli_query($conn,"SELECT * FROM ns_package where id_code='".$_POST['id_bill']."' AND sokien <> 0  ");

				   }
				   else
				   {
						if(isset($_GET['check_payment']))
						{						
							if($_GET['check_payment'] == '2')
							{
								$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` = '0' AND `checkthanhtoan` = '2'  AND sokien <> 0  AND date >= '$day_start' AND date <= '$day_end' order by id DESC ");
							}else if($_GET['check_payment'] == '0')
							{
								$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` = '0' AND `checkthanhtoan` is NULL  AND sokien <> 0  AND  date >= '$day_start' AND date <= '$day_end' order by id DESC ");
							}else if($_GET['check_payment'] == '5')
							{
								$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` = '0' AND `checkthanhtoan` = '5'  AND sokien <> 0  AND  date >= '$day_start' AND date <= '$day_end' order by id DESC ");
							}
							else
							{
								$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` = '0' AND sokien <> 0  AND date >= '$day_start' AND date <= '$day_end' order by id DESC ");

							}
						}
						else
						{
							$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` = '0' AND sokien <> 0  AND date >= '$day_start' AND date <= '$day_end' order by id DESC ");

						}
				   }
			   
			   }else{
                  //$data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap");
               }
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
				  //$laydulieukien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$item['id_listhoadon']."'"))or die(mysql_error());
                  $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id ='".$item['id']."'"));
                  $cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"));
                  $sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
				  @$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
				  @$dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select ten from ns_user where id='".$package['uid']."'"));
				  
				  $totalcuoc = $item['khach_cuocbay']+$item['khach_phuthu']+$item['khach_cuocnoidia']+$item['khach_thuho'];

                  echo '<tr>
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['date'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['id_code'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;"><a href="customer_detail.php?code='.$cuscode['id'].'">'.$package['cus_code'].'</a></td>
                  <td style="text-align: left; color:black;font-size:14px;">'.@$sName['company_name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.@$rName['name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.@$dulieuquocgia['name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.@dichvu($conn,$package['kg_dichvu']).'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$item['sokien'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$item['charge_weight'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.checkthanhtoan($item['checkthanhtoan']).'</td>

				
                  </tr>';
               }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
      </div>
   </div>
</div>


