<?php  
    include('top.php');
    include('../controller/bill.php');
	
	
	if (isset($_POST['btn_hide'])) {
		

              $id_active = $_POST['id_active'];

	   mysqli_query($conn,"UPDATE `ksn_shipment` SET `hide`='1' WHERE (`id`='$id_active')");
	     echo'<script> 
           </script>';
		
    }
	if (isset($_POST['btn_show'])) {
		
	
              $id_active = $_POST['id_active'];

	   mysqli_query($conn,"UPDATE `ksn_shipment` SET `hide`='0' WHERE (`id`='$id_active')");
	     echo'<script> 
           </script>';
		
    }
	
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> -->
   <!-- <form action="" method="POST">
      <div class="row">
         <div class="col-xs-3">
            <div class="input-group date mr-2">
               <div class="form-group ">
                  <input placeholder="Tháng" name="datefrom" type="text" class="form-control" id="datepicker1">
               </div>
            </div>
         </div>
         <div class="col-xs-3">
            <button type="submit" name="btn_loc" class="btn btn-info"><i class="fas fa-filter"></i> Lọc</button>
         </div>
      </div>
      
   </form> -->

   
<div class="row">      <div class="col-md-12">

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
		 

		 ?>
		 
		
		<?php
         if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5 ) {
		 echo'		<div class="row"style="background-color:#EEEEEE;padding-top:20px;border: 1px solid black;border-style: outset;" >
<div class="col-sm-7" >
		 		 <form method="GET" action="">

			<div class="form-group">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start" value="'.@$day_start.'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end"  value="'.@$day_end.'">
				<input type="hidden" id="aa" name="ac"  value="list_package_sale">
										<input hidden id="aa" name="id"  value="'.@$_GET['id'].'">
										
										
			';
			
			?>

									
										
										<?php
										echo'
										<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	
										
										</div>							

			</form>
				
			</div>
			
			
			';
			if($roleid == 1 || $roleid == 3 || $roleid == 4|| $roleid == 5)
			{
			echo'
			<div class="col-sm-2" style=""><div class="form-group"><form action="" method="GET">
			<select class="form-control" name="s_type">
			<option value="hawb" '; if(@$_GET['s_type'] == 'hawb'){echo'selected';}echo'>Search by HAWb</option>
			<option value="mawb" '; if(@$_GET['s_type'] == 'hawb'){echo'selected';}echo'>Search by MAWB</option>

			</select></div></div>
			
			<div class="col-sm-2" style="">

			<div class="form-group">
			<input type="text" class="form-control" name="s_value" value="'.@$_GET['s_value'].'" placeholder="Search..." required>
			</div>
			</div>
			<div class="col-sm-1" style="">
			<div class="form-group">
			<input type="submit" class="btn btn-danger" name="search" value="Search" >
			</div>
			</div>';
			}
			
			echo'
			
			</form>				</div>   
			
			';
			
			if(isset($_GET['s_type']))
			{
				if($_GET['s_type'] == 'hawb')
				{						
					echo'<b>Kết quả tìm kiếm</b><br>';

					$data_ss = mysqli_query($conn,"SELECT * FROM ksn_shipment_details where id_listhoadon like '%".trim($_GET['s_value'])."%' order by id DESC ");
					while($data_s = mysqli_fetch_array($data_ss,MYSQLI_ASSOC))
					{
						$shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_shipment where id = '".$data_s['awb']."'"));

						echo '<b>'.$data_s['id_listhoadon'].'</b> thuộc Shipment<b> <a href="viewbillinshipment.php?id='.$data_s['awb'].'">'.$shipment['awb'].'</a></b> [BOX NO: '.$data_s['box_no'].'] [<a href="tracking_bill.php?id='.$data_s['id_listhoadon'].'">Cập nhật tracking</a>]<br>' ;
					}

					echo'';
				}
			}
			echo'<hr>

	';
			}
			
		
			?>

   
   <?php 
		
			?>

</div>	



</div>

   <div class="row">
      <?php  
         if ($roleid == 1 || $roleid == 3|| $roleid == 4|| $roleid == 5) {
            echo '
               <div class="col-xs-3 mb-3 mr-2">
                  <a href="create_shipment.php" class="btn btn-primary ">
                     <i class="fas fa-plus"></i> Tạo MAWB Mới
                  </a>
               </div>
           
            ';
         }
      ?>
      
	  
	  
	  
	  
      <div class="col-md-12">
         <h3 style="text-align:center;">Quản lý MAWB</h3>
         <table id="example2" class="table table-hover table-bordered table-striped" data-page-length='50'  data-order='[[0, "desc"]]' width=100%>
            <thead>
               <tr style="background-color:#999900;color:white;font-size:12px;">
                  <th style="text-align: center;color:#FFFFFF">STT</th>
                  <th style="text-align: center;color:#FFFFFF">Date</th>
                  <th style="text-align: center;color:#FFFFFF">AWB</th>
                  <th style="text-align: center;color:#FFFFFF">Hãng Bay</th>
                  <th style="text-align: center;color:#FFFFFF">Partner</th>
                  <th style="text-align: center;color:#FFFFFF">Dịch Vụ</th>
                  <th style="text-align: center;color:#FFFFFF">Chi Nhánh</th>
                  <th style="text-align: center;color:#FFFFFF">DEST</th>
                  <th style="text-align: center;color:#FFFFFF">No. Package</th>
                  <th style="text-align: center;color:#FFFFFF">No. Bag</th>
                  <th style="text-align: center;color:#FFFFFF">Gross Weight</th>
                  <th style="text-align: center;color:#FFFFFF">Charge Weight</th>
                  <th style="text-align: center;color:#FFFFFF"></th>
               </tr>
            </thead>
            <tbody>

               <?php
               
			   if(@$_GET['s_type'] == 'mawb')
			   {
				$data = mysqli_query($conn,"SELECT * FROM ksn_shipment where awb LIKE '%".$_GET['s_value']."%'") or die("loi ");

			   }
			   else
			   {
               $data = mysqli_query($conn,"SELECT * FROM ksn_shipment where DATE(date_time) >= '$day_start' AND  DATE(date_time) <= '$day_end'") or die("loi ");
			   }
			   
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
                  $i++;
				  
				  $laytongsokien = mysqli_query($conn,"select * from ksn_shipment_details where awb='".$item['id']."'");
				  $laytongsobag = mysqli_num_rows(mysqli_query($conn,"select distinct(box_no) from  ksn_shipment_details where awb='".$item['id']."'"));
				  $tongsokien = mysqli_num_rows($laytongsokien);
				  $cannang = 0;
				  $cannang2 = 0;
				  while($laydulieua = mysqli_fetch_array($laytongsokien,MYSQLI_ASSOC))
				  {
					  @$laycannang = mysqli_fetch_assoc(mysqli_query($conn,"select cannang,charge_weight from ns_listhoadon where id_code='".$laydulieua['id_listhoadon']."'"));
					  @$cannang += $laycannang['cannang'];
					  @$cannang2 += $laycannang['charge_weight'];
				  }
				  
				  $myArray = explode(',', $item['kg_dichvu']);
					
                  echo '<tr style="font-size:12px">
                  <td style="text-align: center; color:black">'.$i.'</td>
                  <td style="text-align: center; color:black">'.$item['date_time'].'</td>
                  <td style="text-align: left; ;font-weight:bold">'.$item['awb'].'
				  
				  ';
				  
				  if(@mysqli_num_rows(mysqli_query($conn,"select * from ns_tracking_shipment where id_awb='".$item['id']."' AND status='Destination Customs Released' LIMIT 1")) >= 1)
				  {
				  echo'<small class="badge badge-success"><i class="far fa-clock"></i> Release</small>';
				  }
				  echo'</td>
                  <td style="text-align: center; color:black">'.$item['hangbay'].'</td>
                  <td style="text-align: center; color:black">'.$item['doitac'].'</td>
                  <td style="text-align: center; font-weight:bold">';
				  
				  
				  foreach ( $myArray as $a){
					 @$layten =  mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='$a'"));
					 if(@$layten['dichvu'] != "")
					 {
						echo  @$layten['dichvu'].'<br> ';
					 }
					}
			
				  
				  echo'</td><form action="" method="POST">
                  <td style="text-align: center; font-weight:bold">'.$item['kg_chinhanh'].'</td>
                  <td style="text-align: center; font-weight:bold">'.$item['dest'].'</td>
                  <td style="text-align: center; color:black">'.$tongsokien.'</td>
                  <td style="text-align: center; color:black">'.$laytongsobag.'</td>
                  <td style="text-align: center; color:black;font-weight:bold">'.$cannang.'  kg</td>
                  <td style="text-align: center; color:black;font-weight:bold">'.$cannang2.' kg</td>
                  <td>';
                    
                  echo '';
                  //echo'  <a href="edit_shipment.php?id='.$item['id'].'" type="button" class="btn btn-warning"><i class="far fa-edit"></i></a> ';
                    
                     
                     echo'
					 <a href="inlabel/talon.php?id='.$item['id'].'&print=auto" type="button" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i></a>
					';
					if($roleid == 1 || $roleid == 3|| $roleid == 5 )
					{
					echo'
                     <a href="mani_packlist_accountant.php?id='.$item['id'].'" type="button" class="btn btn-primary btn-sm"><i class="fa fa-download"></i>R.P</a>';	
					}
					if($roleid == 1 || $roleid == 4|| $roleid == 5|| $roleid == 3)
					{
					echo'
                     <a href="mani_packlist.php?id='.$item['id'].'" type="button" class="btn btn-primary btn-sm"><i class="fa fa-download"></i>P.Kg</a>
                     <!--<a href="mani.php?id='.$item['id'].'" type="button" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download MNF</a>-->
                     <a href="tracking_awb.php?id='.$item['id'].'" type="button" class="btn btn-primary btn-sm" target="_blank">Tracking</a>
                     <a href="viewbillinshipment.php?id='.$item['id'].'" type="button" class="btn btn-info btn-sm" target="_blank"><i class="far fa-eye"></i></a> 
					 					<a href="create_shipment.php?edit='.$item['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

					 						  <input type="hidden" value="'.$item['id'].'" name="id_active">

					 ';
					}
					
															

					
										if($roleid == 1 || $roleid == 5|| $roleid == 4)
										{					
							
							if($item['hide'] == '0')
							{
						  echo'<button type="submit" name="btn_hide" class="btn btn-danger btn-sm" style="text-align:right"  onclick="return confirm(\'Chắc chắn muốn ẩn shipment: '.$item['awb'].'  ?\')" />Ẩn</button>';
							}
							else
							{
						  echo'<button type="submit" name="btn_show" class="btn btn-success btn-sm" style="text-align:right"  onclick="return confirm(\'Chắc chắn muốn hiện lại dịch vụ: '.$item['awb'].'  ?\')" />Hiện</button>';

							}
					}
					 echo'</form>
                  </td>
                  </tr>';
               }
               ?>

            </tbody>
         </table>
      </div>
   </div>
</div>

<?php  
    include('footer.php');
?>

<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>