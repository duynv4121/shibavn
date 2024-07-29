<?php  
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
	
	
	/*if($uid != 1)
	{
		echo'<script> 
               window.location.href="list_packfwd.php";
            </script>';
	}
	*/
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   <form action="" method="POST">

      
   </form>
   	<div class="row" >

		 <div class="col-sm-9" style="background-color:#DDDDDD;padding-top:20px">
		 		 <form method="GET" action="">

<div class="form-group">
 <?php
		 if(isset($_GET['day_start']))
		 {
			 $day_start = $_GET['day_start'];
			 $day_end = $_GET['day_end'];
		 }
		 else
		 {
			 if($roleid == 2 || $roleid == 6)
			 {
			 $day_start = date('Y-m-d', strtotime("-15 days"));;

			 }
			 else
			 {
			 $day_start = date('Y-m-d', strtotime("-1 days"));;
			 }
			 $day_end = date('Y-m-d');
		 }
		 

		 ?>
	<input type="hidden" id="aa" name="ac"  value="list_package_sale">
							<input hidden id="aa" name="id"  value="<?php echo @$_GET['id'];?>">
							
	<?php 
	echo '						
<label for="aa">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start" value="'.@$day_start.'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end"  value="'.@$day_end.'">';
	?>
			
			
			Công nợ:</label>
			
							<select name="check_payment"> 
							<option value="1" <?php if(@$_GET['check_payment'] == 1){echo'selected';}?>>Day</option>
							<option value="2" <?php if(@$_GET['check_payment'] == '2'){echo'selected';}?>>Week</option>
							<option value="4" <?php if(@$_GET['check_payment'] == '4'){echo'selected';}?>>2 Week</option>
							<option value="3" <?php if(@$_GET['check_payment'] == '3'){echo'selected';}?>>Month</option>
							</select>
							<select name="payment_status"> 
							<option value="0" <?php if(@$_GET['payment_status'] == '0'){echo'selected';}?>>Chưa thanh toán</option>
							<option value="2" <?php if(@$_GET['payment_status'] == '2'){echo'selected';}?>>Đã thanh toán</option>
							<option value="5" <?php if(@$_GET['payment_status'] == '5'){echo'selected';}?>>Tạm thanh toán</option>
							<option value="1" <?php if(@$_GET['payment_status'] == '1'){echo'selected';}?>>Chờ thanh toán</option>
							</select>
							<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	
							</form>
<br><h4><i class="fas fa-list-alt"></i>List Xuất Debit</h4>
							</div>											
			


</div>

<div class="col-sm-2" style="background-color:#DDDDDD;padding-top:20px">
<?php 
echo'		<form action="" method="GET">	<select class="form-control" name="s_type">
<option value="id" '; if(@$_GET['s_type'] == 'id'){echo'selected';}echo'>Search by ID Bill</option>
			<option value="hawb" '; if(@$_GET['s_type'] == 'hawb'){echo'selected';}echo'>Search by HAWb</option>
			<!--<option value="company" '; if(@$_GET['s_type'] == 'company'){echo'selected';}echo'>Search by Company name</option>-->
			</select> 
			
			';

?>
<div class="form-group">
<input type="text" class="form-control" name="s_value" placeholder="Search..." required>
</div>
</div>
<div class="col-sm-1" style="background-color:#DDDDDD;padding-top:20px">
<div class="form-group">
<input type="submit" class="btn btn-danger" name="search" value="Search" >
</div>
</div>
</form>

						</div>
   
   
   <div class="row">

      <div class="col-md-12">
			
		

			
			
			
		<table id="example3" class="table table-hover table-bordered table-striped" style="width:100%;font-size:12px;">
            <thead style="color:blue">
               <tr>
                  <th style="text-align: center;color:#9f7d48"></th>
				  <th style="text-align: center;color:#9f7d48">Import Scan Time</th>

                  <th style="text-align: center;color:#9f7d48">ID BILL</th>
                  <th style="text-align: center;color:#9f7d48">N.V SCAN</th>
                  <th style="text-align: center;color:#9f7d48">Account Tạo</th>
                  <th style="text-align: center;color:#9f7d48">Company name sender</th>
                  <th style="text-align: center;color:#9f7d48">Quốc gia</th>
                  <th style="text-align: center;color:#9f7d48">Dịch Vụ</th>
                  <th style="text-align: center;color:#9f7d48">Kích thước</th>
                  <th style="text-align: center;color:#9f7d48">Cân nặng</th>
                  <!--<th style="text-align: center;color:#9f7d48">Mặt hàng phụ thu</th>-->
                  <th style="text-align: center;color:#9f7d48">Công nợ</th>
				  <th style="text-align: center;color:#9f7d48">Status</th>
				  <th style="text-align: center;color:#9f7d48"></th>

               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5) {
				   
				   
				   
				   if(isset($_GET['check_payment']))
				   {
					   
					   
					   ////lay thong tin check thanh toan
					  if($_GET['payment_status'] == '0')
					  {
						  $fill_checkthanhtoan = " AND (ns_package.checkthanhtoan='0' OR ns_package.checkthanhtoan is NULL OR ns_package.checkthanhtoan = '1')";
					  }else if($_GET['payment_status'] == '2')
					  {
						  $fill_checkthanhtoan = " AND ns_package.checkthanhtoan='2'";
					  }else if($_GET['payment_status'] == '5')
					  {
						  $fill_checkthanhtoan = " AND ns_package.checkthanhtoan='5'";
					  }
					  else if($_GET['payment_status'] == '1')
					  {
						  $fill_checkthanhtoan = " AND ns_package.checkthanhtoan='1'";
					  }
					  
					  
					  
					 if($_GET['check_payment'] == 1)
					 {
						$data = mysqli_query($conn,"SELECT *,ksn_scan_nhap.uid AS idnhanvien,ksn_scan_nhap.datetime AS thoigianscan,ns_listhoadon.id,ROUND(sum(ns_listhoadon.cannang),2) as sum_hoadon FROM ns_package INNER JOIN ns_listhoadon ON ns_listhoadon.id_package = ns_package.id INNER JOIN ksn_scan_nhap ON ns_listhoadon.id_code= ksn_scan_nhap.id_listhoadon where ns_package.congno='1'	 AND  (ns_listhoadon.status='1' OR ns_listhoadon.status='2')  ".$fill_checkthanhtoan." AND DATE(ksn_scan_nhap.date) >= '$day_start' AND DATE(ksn_scan_nhap.date) <= '$day_end'	GROUP BY ns_package.uid");
					 }else if($_GET['check_payment'] == 2)
					 {
						$data = mysqli_query($conn,"SELECT *,ksn_scan_nhap.uid AS idnhanvien,ksn_scan_nhap.datetime AS thoigianscan,ns_listhoadon.id,ROUND(sum(ns_listhoadon.cannang),2) as sum_hoadon FROM ns_package INNER JOIN ns_listhoadon ON ns_listhoadon.id_package = ns_package.id INNER JOIN ksn_scan_nhap ON ns_listhoadon.id_code= ksn_scan_nhap.id_listhoadon where ns_package.congno='2'	AND  (ns_listhoadon.status='1' OR ns_listhoadon.status='2') ".$fill_checkthanhtoan." AND DATE(ksn_scan_nhap.date) >= '$day_start' AND DATE(ksn_scan_nhap.date) <= '$day_end'	GROUP BY ns_package.uid");
					 }else if($_GET['check_payment'] == 3)
					 {
						$data = mysqli_query($conn,"SELECT *,ksn_scan_nhap.uid AS idnhanvien,ksn_scan_nhap.datetime AS thoigianscan,ns_listhoadon.id,ROUND(sum(ns_listhoadon.cannang),2) as sum_hoadon FROM ns_package INNER JOIN ns_listhoadon ON ns_listhoadon.id_package = ns_package.id INNER JOIN ksn_scan_nhap ON ns_listhoadon.id_code= ksn_scan_nhap.id_listhoadon where ns_package.congno='3'	AND  (ns_listhoadon.status='1' OR ns_listhoadon.status='2') ".$fill_checkthanhtoan." AND DATE(ksn_scan_nhap.date) >= '$day_start' AND DATE(ksn_scan_nhap.date) <= '$day_end'	GROUP BY ns_package.uid");
					 }else if($_GET['check_payment'] == 4)
					 {
						$data = mysqli_query($conn,"SELECT *,ksn_scan_nhap.uid AS idnhanvien,ksn_scan_nhap.datetime AS thoigianscan,ns_listhoadon.id,ROUND(sum(ns_listhoadon.cannang),2) as sum_hoadon FROM ns_package INNER JOIN ns_listhoadon ON ns_listhoadon.id_package = ns_package.id INNER JOIN ksn_scan_nhap ON ns_listhoadon.id_code= ksn_scan_nhap.id_listhoadon where ns_package.congno='4'	AND  (ns_listhoadon.status='1' OR ns_listhoadon.status='2') ".$fill_checkthanhtoan." AND DATE(ksn_scan_nhap.date) >= '$day_start' AND DATE(ksn_scan_nhap.date) <= '$day_end'	GROUP BY ns_package.uid");
					 }
					 else
					 {
						$data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap INNER JOIN ns_listhoadon ON ksn_scan_nhap.id_listhoadon=ns_listhoadon.id_code where (ns_listhoadon.status='1' OR ns_listhoadon.status='2') AND DATE(ksn_scan_nhap.date) >= '$day_start' ".$fill_checkthanhtoan." AND DATE(ksn_scan_nhap.date) <= '$day_end'");

					 }
				   
				   }
				   
				    else if(isset($_GET['s_type']))
				   {              
						if($_GET['s_type'] == "id")
						{
						$data = mysqli_query($conn,"SELECT *,ksn_scan_nhap.uid AS idnhanvien,ksn_scan_nhap.datetime AS thoigianscan,ns_listhoadon.id,ROUND(sum(ns_listhoadon.cannang),2) as sum_hoadon FROM ns_package INNER JOIN ns_listhoadon ON ns_listhoadon.id_package = ns_package.id INNER JOIN ksn_scan_nhap ON ns_listhoadon.id_code= ksn_scan_nhap.id_listhoadon where ns_package.id_code like '%".trim($_GET['s_value'])."%' AND  (ns_listhoadon.status='1' OR ns_listhoadon.status='2') ");
						}
						else if($_GET['s_type'] == "hawb")
						{
						$data = mysqli_query($conn,"SELECT *,ksn_scan_nhap.uid AS idnhanvien,ksn_scan_nhap.datetime AS thoigianscan,ns_listhoadon.id,ROUND(sum(ns_listhoadon.cannang),2) as sum_hoadon FROM ns_package INNER JOIN ns_listhoadon ON ns_listhoadon.id_package = ns_package.id INNER JOIN ksn_scan_nhap ON ns_listhoadon.id_code= ksn_scan_nhap.id_listhoadon where ns_listhoadon.id_code like '%".trim($_GET['s_value'])."%' AND  (ns_listhoadon.status='1' OR ns_listhoadon.status='2') 	");
	
						}/*else if($_GET['s_type'] == "company")
						{
						$data = mysqli_query($conn,"SELECT *,ksn_scan_nhap.uid AS idnhanvien,ksn_scan_nhap.datetime AS thoigianscan,ns_listhoadon.id,ROUND(sum(ns_listhoadon.cannang),2) as sum_hoadon FROM ns_package 
						INNER JOIN ns_listhoadon ON ns_listhoadon.id_package = ns_package.id 
						INNER JOIN ksn_scan_nhap ON ns_listhoadon.id_code= ksn_scan_nhap.id_listhoadon 
						INNER JOIN ns_nguoigui ON ns_package.id_nguoigui = ns_nguoigui.id  where ns_nguoigui.company_name like '%".trim($_GET['s_value'])."%' AND  (ns_listhoadon.status='1' OR ns_listhoadon.status='2') 	");

						}*/

				   }
				   else
				   {					   
					$data = mysqli_query($conn,"SELECT *,ksn_scan_nhap.uid AS idnhanvien,ksn_scan_nhap.datetime AS thoigianscan FROM ksn_scan_nhap INNER JOIN ns_listhoadon ON ksn_scan_nhap.id_listhoadon=ns_listhoadon.id_code where (ns_listhoadon.status='1' OR ns_listhoadon.status='2')  AND DATE(ksn_scan_nhap.date) >= '$day_start'  AND DATE(ksn_scan_nhap.date) <= '$day_end' ");
				   }
               }else{
                  //$data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap");
               }
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
				  $laydulieukien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$item['id_listhoadon']."'"))or die(mysql_error());
                  $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT cus_code,kg_dichvu,congno,checkthanhtoan,id_nguoigui,id_nguoinhan FROM ns_package WHERE id ='".$laydulieukien['id_package']."'"))or die ("loi");
                  $cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id,fwd FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"))or die ("loi");
                  $sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT company_name FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT country_id FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
				  @$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
				  @$dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select ten from ns_user where id='".$item['idnhanvien']."'"));
				  
                  echo '<tr>
				  <td style="text-align: center; color:black;font-size:14px;"></td>
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['thoigianscan'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['id_code'].'
				  ';
				  
				  if($roleid == 3 || $roleid == 1)
				  {
				  echo'<a href="edit_extraprice.php?id='.$item['id_code'].'">  <i class="fas fa-edit"></i></a>';
				  }
				  echo'
				  
				  </td>
				  <td style="text-align: center; color:black;font-size:14px;">'.@$dulieunhanvien['ten'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">';
				  
				  if($cuscode['fwd'] == 1)
				  {
				  echo'<a href="customer_detail.php?code='.$cuscode['id'].'">'.$package['cus_code'].'</a> <small class="badge badge-warning"> FWD</small>';
				  }else if($cuscode['fwd'] == 0)
				  {
				  echo''.$package['cus_code'].' <small class="badge badge-info"> Sales</small>';
				  }
				  
				  echo'</td>
                  <td style="text-align: left; color:black;font-size:14px;">'.$sName['company_name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$dulieuquocgia['name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.dichvu($conn,$package['kg_dichvu']).'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$laydulieukien['length'].'x'.$laydulieukien['width'].'x'.$laydulieukien['height'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.$laydulieukien['cannang'].' kg</td>';
				  
				  /**
				  echo'
                 <td  style="font-size:14px;">';
				  $laydulieuphuthua = mysqli_query($conn,"select * from kns_listhoadonphuthu where id_code='".$laydulieukien['id_code']."'");
				  while($laydulieuphuthu = mysqli_fetch_array($laydulieuphuthua,MYSQLI_ASSOC))
				  {
					  echo $laydulieuphuthu['tenphuthu'].'|';
				  }
				  
                  echo'</td>';**/
				  
				  echo'
                  <td style="text-align: center; color:black">'.congno($package['congno']).'</td> <td style="text-align: center; color:black">'.checkthanhtoan($package['checkthanhtoan']).'</td>
                  <td style="text-align: center; color:black"><a href="../upload/'.$laydulieukien['img'].'" target="_blank"><i class="fas fa-images"></i></a></td>
				
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
    include('footer.php');
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

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

  
   
	$(document).ready(function() {
    $('#example').DataTable( {"pageLength": 100
,
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'desc' ]
    } );
} );

</script>