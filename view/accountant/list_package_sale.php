<?php 

include("../controller/accountant.php");


if(isset($_POST['btn_submit']))
	{
		
		
		@$checkbox1 = $_POST['chkl'];  
		
		
			$vat_fee = $_POST['vat_fee'] ;  

			$layiddebit = add_debit($uid,'KHACHLE',$vat_fee,$conn);
		

		for ($i=0; $i<sizeof($checkbox1);$i++){
		$id_baga = $checkbox1[$i];
		mysqli_query($conn,"INSERT INTO `ksn_debit_detail` (`id_debit`, `id_code`) VALUES ('$layiddebit', '$id_baga')")or die("Loi");
		mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='6',`khach_cuocbay`=(`charge_weight`*$vat_fee) WHERE (`id_code`='$id_baga')")or die("Loi");
		}
			echo '
			<script>
				alert("Thêm Debit thành công !");
			</script>
			<script> location.href="list_debit.php"</script>
		';
		
	}


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
		 

		 ?>			<div class="row" >

		 <div class="col-sm-8" style="background-color:#DDDDDD;padding-top:20px">
		 		 <form method="GET" action="">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="<?php echo @$day_start;?>">
<label for="aa">To Date:</label>
<input type="date" id="aa" name="day_end"  value="<?php echo @$day_end;?>">
	<input type="hidden" id="aa" name="ac"  value="list_package_sale">
							<input hidden id="aa" name="id"  value="<?php echo @$_GET['id'];?>">
							
							
<label for="aa">Status:</label>

							<select name="check_payment"> 
							<option value="" >Tất cả</option>
							<option value="2" <?php if(@$_GET['check_payment'] == 2){echo'selected';}?>>Đã thanh toán</option>
							<option value="0" <?php if(@$_GET['check_payment'] == '0'){echo'selected';}?>>Chưa thanh toán</option>
							</select>
							
							
							
							<label for="aa">Method:</label>

							<select name="method_payment"> 
							<option value="" >Tất cả</option>
							<option value="debit" <?php if(@$_GET['method_payment'] == 'debit'){echo'selected';}?>>THANH TOÁN NỢ</option>
							<option value="after" <?php if(@$_GET['method_payment'] == 'after'){echo'selected';}?>>THANH TOÁN SAU</option>
							</select>
							<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	
							</form>

							</div>											
			


</div>

<div class="col-sm-4" style="background-color:#DDDDDD;padding-top:20px">
<?php
$datasale = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` <> '0' AND date >= '$day_start' AND date <= '$day_end' order by id DESC ");
$totalprice = 0;
$totaldathanhtoan = 0;
$totaldaguidebit = 0;
$totalchuathanhtoan = 0;
while($datasalea = mysqli_fetch_array($datasale))
{
	$totalprice +=  sum_package_sale($datasalea['khach_cuocbay'],$datasalea['khach_phuthu'],$datasalea['khach_cuocnoidia'],$datasalea['khach_thuho'],$datasalea['khach_phibaohiem'],$datasalea['vat']);
	if($datasalea['checkthanhtoan'] == 2)
	{
		$totaldathanhtoan += sum_package_sale($datasalea['khach_cuocbay'],$datasalea['khach_phuthu'],$datasalea['khach_cuocnoidia'],$datasalea['khach_thuho'],$datasalea['khach_phibaohiem'],$datasalea['vat']);
	}	
	if($datasalea['checkthanhtoan'] == 6)
	{
		$totaldaguidebit += sum_package_sale($datasalea['khach_cuocbay'],$datasalea['khach_phuthu'],$datasalea['khach_cuocnoidia'],$datasalea['khach_thuho'],$datasalea['khach_phibaohiem'],$datasalea['vat']);
	}		
}
echo'<table class="table table-bordered table-hover" style="background-color:white">
			<tr><td>Total<td style="color:green">'.number_format($totalprice).' VND</td></tr>
			<tr><td>Đã thanh toán<td style="color:green">'.number_format($totaldathanhtoan).' VND</td></tr>
			<tr><td>Đã gửi Debit<td style="color:orange">'.number_format($totaldaguidebit).' VND</td></tr>
			<tr><td>Chưa thanh toán<td style="color:red">'.number_format($totalprice-$totaldathanhtoan).' VND</td></tr>
			
			
			</table>';

?>

</div><!--
</div>
<div class="col-sm-1" style="background-color:#DDDDDD;padding-top:20px">
<div class="form-group">
<input type="submit" class="btn btn-danger" name="search" value="Search" >
</div>
</div>
</form>-->
<button name="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">Export</button>

						</div>
   
   <hr>
   
   <div class="row">

      <div class="col-md-12">
			
		

			<form action="" method="POST">			Nhập giá tiền

			<input type="text" id="css" name="vat_fee" value="" placeholder="Nhập giá tiền lấy khách">
			<button type="submit" name="btn_submit" class="btn-info" style="text-align:right"  onclick="return confirm(\'Chắc chắn xác nhận tạo debit những bill đã chọn?\');"/>Tạo Debit </button>
				  <hr>
			
			
		<table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:blue">
               <tr style="background-color:blue">
                  <th style="text-align: center;color:white">Date</th>
                  <th style="text-align: center;color:white">ID BILL</th>
                  <th style="text-align: center;color:white">Sales Name</th>
                  <th style="text-align: center;color:white">Contact Name</th>
                  <th style="text-align: center;color:white">Quốc gia</th>
                  <th style="text-align: center;color:white">Dịch Vụ</th>
                  <th style="text-align: center;color:white">Số kiện</th>
                  <th style="text-align: center;color:white">Cân nặng</th>
                  <th style="text-align: center;color:white">Cước thu khách</th>
                  <th style="text-align: center;color:white">Status</th>
                  <th style="text-align: center;color:white">Thanh toán</th>
                  <th style="text-align: center;color:white"></th>
                 

               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5) {
				   
				   if(isset($_POST['search']))
				   {                  
					$data = mysqli_query($conn,"SELECT * FROM ns_package where id_code='".$_POST['id_bill']."' ");

				   }
				   else
				   {
					   
					      if(@$_GET['method_payment'] == 'debit')
					  {
						  $fill_checkthanhtoan = " AND payment_type='debit'";
					  }else if(@$_GET['method_payment'] == 'after')
					  {
						  $fill_checkthanhtoan = " AND payment_type='after'";
					  }
					  else
					  {
						  $fill_checkthanhtoan = " ";
					  }
					  
					   
						if(isset($_GET['check_payment']))
						{						
							if($_GET['check_payment'] == '2')
							{
								$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` <> '0' AND `checkthanhtoan` = '2' ".$fill_checkthanhtoan." AND date >= '$day_start' AND date <= '$day_end' order by id DESC ");
							}else if($_GET['check_payment'] == '0')
							{
								$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` <> '0' AND (`checkthanhtoan` is NULL OR `checkthanhtoan` = '0') ".$fill_checkthanhtoan."  AND  date >= '$day_start' AND date <= '$day_end' order by id DESC ");
							}
							else
							{
								$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` <> '0' ".$fill_checkthanhtoan." AND date >= '$day_start' AND date <= '$day_end' order by id DESC ");

							}
						}
						else
						{
							$data = mysqli_query($conn,"SELECT * FROM ns_package where `id_sale` <> '0' AND date >= '$day_start' AND date <= '$day_end' order by id DESC ");

						}
				   }
			   
			   }else{
                  //$data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap");
               }
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
				  //$laydulieukien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$item['id_listhoadon']."'"))or die(mysql_error());
                  $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id ='".$item['id']."'"))or die ("loi 1");
                  $cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"));
                  $sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
				  @$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
				  @$dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select ten from ns_user where id='".$package['uid']."'"));
				  
				  $totalcuoc = sum_package_sale($item['khach_cuocbay'],$item['khach_phuthu'],$item['khach_cuocnoidia'],$item['khach_thuho'],$item['khach_phibaohiem'],$item['vat']);
				  $sotiengoc= sum_package_code($package['kg_dichvu'],$package['charge_weight'],$rName['city'],$rName['country_id'],$package['kg_chinhanh'],$conn,$rName['post_code'],$rName['state']);

                  echo '<tr>
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['date'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;">
				  ';
				  if($item['checkthanhtoan'] == 2)
				  {
				  } else if($item['checkthanhtoan'] == 6)
				  {
				  }
				  else
				  {
					echo' <input type="checkbox" name="chkl[]" id="form1" class="" value="'.$item['id_code'].'" ">';
				  }
				  echo'
				  <a href="package_fn.php?id='.$package['id'].'">'.$item['id_code'].'</a> <a href="edit_package.php?id='.$package['id'].'" target="_blank"><i class="fas fa-edit"></i></a></td>
                  <td style="text-align: center; color:black;font-size:14px;">'.@$package['cus_code'].'('.@$dulieunhanvien['ten'].')</td>

                  <td style="text-align: center; color:black;font-size:14px;">'.@$sName['name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.@$dulieuquocgia['name'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.dichvu($conn,@$package['kg_dichvu']).'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.@$item['sokien'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.@$item['charge_weight'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.number_format(@$totalcuoc).' VNĐ</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.statusbill(@$package['status']).'</td>
				 

                  <td style="text-align: center; color:black;font-size:14px;">'.checkthanhtoan(@$item['checkthanhtoan']).'</td>

                 <td  style="font-size:14px;"><a href="m_accountant.php?ac=list_package_sale_dt&id='.$item['id_code'].'">Update</a></td>
				
                  </tr>';
               }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
      </div>
   </div>
   </form>
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
	  </div>