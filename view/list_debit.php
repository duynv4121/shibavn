<?php  
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
	
	
	include 'thanhtoan/config.php';
	include 'thanhtoan/lib/nganluong.class.php';
$flag = true;


if(isset($_POST['btn_submitkey']))
{
	$accountant_key = $_POST['accountant_key'];
	$checkkey = mysqli_num_rows(mysqli_query($conn,"select * from ns_user where accountant_key='$accountant_key' AND id='$uid'"));
	if($checkkey >= 1)
	{
		$_SESSION["accountant_key"] = "right";
	}
	else
	{
	 echo'<script> 
               alert("Wrong key for Accountant! Please try agian");
              </script>
			  
			  
			  
			  ';
	}
}


if(isset($_POST['btn_huy']))
{
	if($roleid == 1 || $roleid == 3 )
	{
		$id_debit_huy = $_POST['id_debit_huy'];
		
		$laydulieua = mysqli_query($conn,"select * from ksn_debit_detail where id_debit='$id_debit_huy'")or die("Loi");
		while($laydulieu = mysqli_fetch_array($laydulieua,MYSQLI_ASSOC))
		{
			mysqli_query($conn,"UPDATE `ns_package` SET `khach_cuocbay`='0', `khach_phuthu`='0', `vat`='0',`checkthanhtoan`='0' WHERE (`id_code`='".$laydulieu['id_code']."')") or die("Loiiii");
			
		}
		mysqli_query($conn,"DELETE FROM `ksn_debit` WHERE (`id`='$id_debit_huy')");
		
		 echo'<script> 
               alert("Hủy lệnh thành công");
              </script>
			  
			  
			  
			  ';
	}
}


if (isset($_POST['submit'])) {
	// Lấy các tham số để chuyển sang Ngânlượng thanh toán:

 //$ten= $_POST["txt_test"];
    $receiver=RECEIVER;
	//Mã đơn hàng 
	$order_code=$_POST['iddebit']; 
	//Khai báo url trả về 
	$return_url= $_SERVER['HTTP_REFERER']. "success.php";
	// Link nut hủy đơn hàng
	$cancel_url= $_SERVER['HTTP_REFERER'];	
	$notify_url = $_SERVER['HTTP_REFERER']. "success.php";
	//Giá của cả giỏ hàng 
	$txh_name =$_POST['makhachhang']; 	
	$txt_email =$_POST['txt_email']; 	
	$txt_phone =$_POST['txt_phone'];
	if (strlen($txh_name) > 50 || strlen($txt_email) > 50 || strlen($txt_phone) > 20){
	    $flag = false;
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $txh_name))
    {
        $flag = false;
    }
	if ($flag) {
        $price =(int)$_POST['txt_gia'];
        //Thông tin giao dịch
        $transaction_info="Thong tin giao dich";
        $currency= "vnd";
        $quantity=1;
        $tax=0;
        $discount=0;
        $fee_cal=0;
        $fee_shipping=0;
        $order_description="DỊCH VỤ: KANGO EXPRESS
		Bạn đang thanh toán hệ thống tự động 
		Mã: ".$order_code;
        $buyer_info=$txh_name."*|*".$txt_email."*|*".$txt_phone;
        $affiliate_code="";
        //Khai báo đối tượng của lớp NL_Checkout
        $nl= new NL_Checkout();
        $nl->nganluong_url = NGANLUONG_URL;
        $nl->merchant_site_code = MERCHANT_ID;
        $nl->secure_pass = MERCHANT_PASS;
        //Tạo link thanh toán đến nganluong.vn
        $url= $nl->buildCheckoutUrlExpand($return_url, $receiver, $transaction_info, $order_code, $price, $currency, $quantity, $tax, $discount , $fee_cal,    $fee_shipping, $order_description, $buyer_info , $affiliate_code);
        //$url= $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price);


        //echo $url; die;
        if ($order_code != "") {
            //một số tham số lưu ý
            //&cancel_url=http://yourdomain.com --> Link bấm nút hủy giao dịch
            //&option_payment=bank_online --> Mặc định forcus vào phương thức Ngân Hàng
            $url .='&cancel_url='. $cancel_url . '&notify_url='.$notify_url;
            //$url .='&option_payment=bank_online';

            echo '<meta http-equiv="refresh" content="0; url='.$url.'" >';
            //&lang=en --> Ngôn ngữ hiển thị google translate
        }
    }

}
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
 
   
   
   <div class="row">
   <div class="col-md-12">

 <?php
		 if(isset($_GET['day_start']))
		 {
			 $day_start = $_GET['day_start'];
			 $day_end = $_GET['day_end'];
		 }
		 else
		 {
			
			 $day_start = date('Y-m-d', strtotime("-10 days"));
			 
			 $day_end = date('Y-m-d');
		 }
		 
		 if(isset($_GET['listquahan']))
		 {
			 $day_quahan_end = date('Y-m-d', strtotime("-7 days"));
		 }

		 ?>
		 
		
		<?php
         if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5 ) {
				if(@$_GET['check'] == 1)
				{
					$fill_check = "AND (`totaltien`<>`final_price`) AND `final_price`<>'0'";
				}
				else
				{
					$fill_check = "";
				}
				if(isset($_GET['status']))
						{						
							if($_GET['status'] == '1')
							{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where (`checkthanhtoan`='' OR `checkthanhtoan` is NULL) AND datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check."");
							}else if($_GET['status'] == '2')
							{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where  `checkthanhtoan`='2'  AND datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check."");
							}else if($_GET['status'] == '5')
							{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where  `checkthanhtoan`='5' AND datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check."");
							}
							else
							{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check."");
							}
						}
						else
						{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check."");

						}
				 if(isset($_GET['s_type']))
				   {              
						if($_GET['s_type'] == "id")
						{
							$data = mysqli_query($conn,"SELECT * FROM ksn_debit where  debitno like '%".trim($_GET['s_value'])."%' ");
						}
						else if($_GET['s_type'] == "company")
						{
							$data = mysqli_query($conn,"SELECT * FROM ksn_debit INNER JOIN ns_user ON ksn_debit.idkhachhang = ns_user.cus_code where  ns_user.congty like '%".trim($_GET['s_value'])."%' ");

						}else if($_GET['s_type'] == "customerid")	
						{
							$data = mysqli_query($conn,"SELECT * FROM ksn_debit where  idkhachhang like '%".trim($_GET['s_value'])."%' ");

						}

				   }
				   
								  $totalprice = 0;
								  $fn_price = 0;
								  $tamung = 0;
								  $totalchuathanhtoan =0;
								  $total_bank =0;
								  $total_cash =0;
				                  while($item2 = mysqli_fetch_array($data,MYSQLI_ASSOC))
								  {
									  if($item2['checkthanhtoan'] != '2')
									  {
									    $totalchuathanhtoan+=($item2['totaltien']-$item2['tamung']);
									  }
									  if($item2['payment_method'] == 'cash')
									  {
										$total_cash+=$item2['final_price'];
									  }
									  else
									  {
										$total_bank+=$item2['final_price'];
									  }
									  
									    $totalprice+=$item2['totaltien'];
									    $fn_price+=$item2['final_price'];
									    $tamung+=$item2['tamung'];
										
										
								  }

										
			 
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

									Status <select name="status"> 
										<option>All</option>
										<option value="1" <?php if(@$_GET['status'] == 1){echo'selected';}?>>Chưa thanh toán</option>
										<option value="2" <?php if(@$_GET['status'] == 2){echo'selected';}?>>Đã thanh toán</option>
										<option value="5" <?php if(@$_GET['status'] == 5){echo'selected';}?>>Duyệt tạm ứng</option>
									
										</select>
										Method <select name="method"> 
										<option>All</option>
										<option value="banking" <?php if(@$_GET['method'] == 'banking'){echo'selected';}?>>Banking</option>
										<option value="cash" <?php if(@$_GET['method'] == 'cash'){echo'selected';}?>>Cash</option>
									
										</select>
										
										
										<select name="congno"> 
										<option>Công Nợ</option>
										<option value="1" <?php if(@$_GET['congno'] == 1){echo'selected';}?>>DAY</option>
										<option value="2" <?php if(@$_GET['congno'] == 2){echo'selected';}?>>WEEK</option>
										<option value="4" <?php if(@$_GET['congno'] == 4){echo'selected';}?>>2 WEEK</option>
										<option value="3" <?php if(@$_GET['congno'] == 3){echo'selected';}?>>MONTH</option>
										</select>
										<?php
										echo'
										<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	
<div class="form-check" style="text-align:left">
<input class="form-check-input" type="checkbox" value="1" name="check" '; if(@$_GET['check'] == 1) { echo 'checked';}echo'>
<label class="form-check-label">Chỉ hiển thị DEBIT lệch giá</label><br>
<input class="form-check-input" type="checkbox" value="1" name="listquahan" '; if(@$_GET['check'] == 1) { echo 'checked';}echo'>
<label class="form-check-label">Lọc danh sách quá hạn 7 ngày</label>
</div>
										</div>							

			</form>			<button name="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-file-excel"></i> Export Report</button>
	<br><br>';
	echo'
				
			</div>
			
			
			';
			
			
			
			if($roleid == 1 || $roleid == 3 || $roleid == 4)
			{
			echo'
			
			<div class="col-sm-5" style="">
			<div class="row">
			<div class="col-sm-4" style="">
			<form action="" method="GET">
				<div class="form-group">
				<select class="form-control" name="s_type">
				<option value="id" '; if(@$_GET['s_type'] == 'hawb'){echo'selected';}echo'>Search by ID DEBIT</option>
				<option value="company" '; if(@$_GET['s_type'] == 'company'){echo'selected';}echo'>Search by Company name</option>
				<option value="customerid" '; if(@$_GET['s_type'] == 'customerid'){echo'selected';}echo'>Search by Customer ID</option>
				<option value="idbill" '; if(@$_GET['s_type'] == 'idbill'){echo'selected';}echo'>Search by ID BILL</option>
				<option value="idhawb" '; if(@$_GET['s_type'] == 'idhawb'){echo'selected';}echo'>Search by ID HAWB</option>

				</select>
				</div>
				<div class="form-group">
				<input type="text" class="form-control" name="s_value" value="'.@$_GET['s_value'].'" placeholder="Search..." required>
				</div>
				<div class="form-group">
				<input type="submit" class="btn btn-danger" name="search" value="Search" >
				</div>
			</div>
			
			<div class="col-sm-8" style="">

			';
			
			echo'<table class="table table-bordered table-hover" style="background-color:white">
			<tr><td>Total Bank<td style="color:green">'.number_format($total_bank).' </td><td>Total Cash<td style="color:green">'.number_format($total_cash).' </td></tr>
			<tr></tr>
			<tr><td>Total<td style="color:green">'.number_format($totalprice).' </td><td>Final Total<td style="color:green">'.number_format($fn_price).' </td></tr>
			<tr></tr>
			<tr><td>Tạm Ứng<td style="color:orange">'.number_format($tamung).' </td><td>Chưa thanh toán<td style="color:red">'.number_format($totalchuathanhtoan).' </td></tr>
			<tr></tr>
			
			
			</table>
			';
			echo'
			</div>
			<div class="col-sm-6" style="">
			';
			
			
			echo'
			
			</div>
			
			</div>
			
			</div>
			';
			}
			
			echo'
			
			</form>				</div>   
			
			';
			
			
			echo'<hr>

	';
			}
			
			if($roleid == 6)
			{
				echo'<button name="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-file-excel"></i>Export Report</button><br>';
			}
			?>

   
   <?php 
			if($roleid == 2){
			}
			?>

</div>	
      <div class="col-md-12">
			
		

			
			<?php
			if ($roleid == 1 || $roleid == 3) {
				
				$fill_congno = '';
				if(isset($_GET['congno']))
				{
					if($_GET['congno'] == '1')
					{
					$fill_congno = "AND idkhachhang IN (SELECT cus_code FROM ns_user WHERE payment_type = '1')";
					}
					else if($_GET['congno'] == '2')
					{
					$fill_congno = "AND idkhachhang IN (SELECT cus_code FROM ns_user WHERE payment_type = '2')";
					}else if($_GET['congno'] == '3')
					{
					$fill_congno = "AND idkhachhang IN (SELECT cus_code FROM ns_user WHERE payment_type = '3')";
					}else if($_GET['congno'] == '4')
					{
					$fill_congno = "AND idkhachhang IN (SELECT cus_code FROM ns_user WHERE payment_type = '4')";
					}
					
				}

				
				$fill_method = '';
				if(isset($_GET['method']))
				{
					if($_GET['method'] == 'banking')
					{
						$fill_method = "AND `payment_method`='banking'";

					}
					else if($_GET['method'] == 'cash')
					{
						$fill_method = "AND `payment_method`='cash'";
					}
				}
				
				if(@$_GET['check'] == 1)
				{
					$fill_check = "AND `totaltien`<>`final_price` AND `final_price`<>'0'";
				}
				else
				{
					$fill_check = "";
				}
				if(isset($_GET['status']))
						{						
							if($_GET['status'] == '1')
							{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where (`checkthanhtoan`='' OR `checkthanhtoan` is NULL) AND datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check." ".$fill_method." ".$fill_congno." ");
							}else if($_GET['status'] == '2')
							{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where  `checkthanhtoan`='2'  AND datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check." ".$fill_method." ".$fill_congno."");
							}else if($_GET['status'] == '5')
							{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where  `checkthanhtoan`='5' AND datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check." ".$fill_method." ".$fill_congno."");
							}
							else
							{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check." ".$fill_method." ".$fill_congno."");
							}
						}
						else
						{
						$data = mysqli_query($conn,"SELECT * FROM ksn_debit where datetime >= '$day_start' AND DATE(datetime) <= '$day_end' ".$fill_check." ".$fill_method." ".$fill_congno."");

						}
				 if(isset($_GET['s_type']))
				   {              
						if($_GET['s_type'] == "id")
						{
							$data = mysqli_query($conn,"SELECT * FROM ksn_debit where  debitno like '%".trim($_GET['s_value'])."%' ");
						}
						else if($_GET['s_type'] == "company")
						{
							$data = mysqli_query($conn,"SELECT *,ksn_debit.id AS idsearch FROM ksn_debit INNER JOIN ns_user ON ksn_debit.idkhachhang = ns_user.cus_code where  ns_user.congty like '%".trim($_GET['s_value'])."%' ");

						}else if($_GET['s_type'] == "idbill")
						{
							$data = mysqli_query($conn,"SELECT *,ksn_debit.id AS idsearch FROM ksn_debit INNER JOIN ksn_debit_detail ON ksn_debit.id = ksn_debit_detail.id_debit where  ksn_debit_detail.id_code like '%".trim($_GET['s_value'])."%' ");

						}else if($_GET['s_type'] == "idhawb")
						{
							$data = mysqli_query($conn,"SELECT *,ksn_debit.id AS idsearch FROM ksn_debit INNER JOIN ksn_debit_detail ON ksn_debit.id = ksn_debit_detail.id_debit INNER JOIN ns_package ON ksn_debit_detail.id_code = ns_package.id_code INNER JOIN ns_listhoadon ON ns_package.id = ns_listhoadon.id_package  where  ns_listhoadon.id_code like '%".trim($_GET['s_value'])."%' ");

						}else if($_GET['s_type'] == "customerid")	
						{
							$data = mysqli_query($conn,"SELECT * FROM ksn_debit where  idkhachhang like '%".trim($_GET['s_value'])."%' ");

						}

				   }
				  
				  if(isset($_GET['listquahan']))
				  {
					  $data = mysqli_query($conn,"SELECT * FROM ksn_debit where  (`checkthanhtoan`='' OR `checkthanhtoan` is NULL) AND DATE(datetime)<='$day_quahan_end'");

				  }
				  
				
               
			echo'
			
		<table id="example" class="display nowrap cell-border" style="width:100%">
            <thead style="color:blue">
               <tr>
                  <th style="text-align: center;color:#9f7d48"></th>
				  <th style="text-align: center;color:#9f7d48">Date Time</th>

                  <th style="text-align: center;color:#9f7d48">Debit No</th>
                  <th style="text-align: center;color:#9f7d48">Company</th>
                  <th style="text-align: center;color:#9f7d48">Người tạo</th>
                  <th style="text-align: center;color:#9f7d48">Mã khách hàng</th>
                  <th style="text-align: center;color:#9f7d48">VAT</th>

                  <th style="text-align: center;color:#9f7d48">Total</th>
                  <th style="text-align: center;color:#9f7d48">Tạm Ứng</th>
                  <th style="text-align: center;color:#9f7d48">Final Total</th>
                  <th style="text-align: center;color:#9f7d48">Trạng thái</th>
                  <th style="text-align: center;color:#9f7d48">Note</th>
                  

                  <th style="text-align: center;color:#9f7d48"></th>
               </tr>
            </thead>
            <tbody>';
               
            
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
					$laydulieuusera = mysqli_fetch_assoc(mysqli_query($conn,"select congty,payment_price_type,payment_type from ns_user where cus_code='".$item['idkhachhang']."'"));

				  
				  
                  echo '<tr>
				  <td style="text-align: center; color:black;font-size:14px;"></td>
				  <td style="text-align: left; color:black;font-size:14px;">'.$item['datetime'].'</td>
				  <td style="text-align: left; color:black;font-size:14px;">
				  ';
				  
				  if(@$_GET['s_type'] == "company" || @$_GET['s_type'] == "idbill" || @$_GET['s_type'] == "idhawb" )
				  {
				echo'
				  <a href="list_debit_dt.php?id='.$item['idsearch'].'">'.$item['debitno'].'</a> 
				  <a href="export_debit.php?id='.$item['idsearch'].'"><i class="fas fa-download"></i> </a>';
				  }
				  else
				  {
				  echo'
				  <a href="list_debit_dt.php?id='.$item['id'].'">'.$item['debitno'].'</a> 
				  <a href="export_debit.php?id='.$item['id'].'"><i class="fas fa-download"></i> </a>';
				  }
				  
				 echo' </td>
				  <td style="text-align: left; color:black;font-size:14px;">'.$laydulieuusera['congty'].'</td>
				
                  <td style="text-align: center; color:black;font-size:14px;">'.getNamebyUser($item['uid'],$conn).'</td>
                  <td style="text-align: center; color:black;font-size:14px;"><a href="customer_detail.php?code='.preg_replace('/[^0-9]/', '', $item['idkhachhang']).'">'.$item['idkhachhang'].'<span class="badge badge-light">'.get_price_type($laydulieuusera['payment_price_type']).'<span></a> ('.congno($laydulieuusera['payment_type']).')</td>
             <td style="text-align: center; color:black;font-size:14px;">';
				  
				  if($item['vat'] == 1)
				  {
					  echo'<i class="fas fa-check" style="color:red"></i>';
				  }
				  
				  echo'</td>
                  <td style="text-align: center; color:green;font-size:14px;">'.number_format($item['totaltien']).'</td>
                  <td style="text-align: center; color:red;font-size:14px;">'.number_format($item['tamung']).'</td>
                  <td style="text-align: center; color:green;font-size:14px;">'.number_format($item['final_price']).'</td>
                  <td style="text-align: center; color:black;font-size:14px;">'.checkthanhtoan($item['checkthanhtoan']).'</td>
                  <td style="text-align: center; color:black;font-size:14px;">';
				  if(strpos($item['note_edit'], "Thuộc statement") !== false){
						$statement = preg_replace("/[^0-9]/", '',  $item['note_edit']);
						echo'Statement : <a href="list_statement_dt.php?id='.$statement.'" target="_blank">'.$statement.'</a>';
					}
					else
					{
						echo $item['note_edit'];
					}
				  
				  
				  echo'</td>
            
                 <td  style="font-size:14px;">';
				 
				if($item['checkthanhtoan'] == 2) {
					
					
					if($item['payment_method'] == 'cash')
						{
							echo'<i class="fas fa-money-bill-alt" style="color:blue"></i>';
						}
						else
						{
						$myArray = explode(',', $item['bangchungthanhtoan']);

						foreach ( $myArray as $a){
						echo' <a href="../upload/'.$a.'" target="_blank"><i class="fas fa-images"></i></a>';
						}
						}
					
					
						
				
				echo'
				<a href="list_debit_dt.php?id='.$item['id'].'&m=edit"><i class="fas fa-edit"></i></a>
				
				
				
				';
					if($roleid == 1)
					{
						echo'<form action="" method="POST">
				<input type="hidden" name="id_debit_huy" value="'.$item['id'].'">
				<button type="submit" name="btn_huy" class="btn btn-danger btn-sm" onclick="return confirm(\'Chắc chắn hủy lệnh debit của '.$laydulieuusera['congty'].' ?\');"><i class="fas fa-times-circle"></i> Hủy Lệnh</button>
				</form>';
					}
				}
				else if( $item['checkthanhtoan'] == 5)
				{
					if($item['tamung_img'] != '')
					{
						echo'';
					}
					echo'<form action="" method="POST">
				<input type="hidden" name="id_debit_huy" value="'.$item['id'].'">
				<button type="submit" name="btn_huy" class="btn btn-danger btn-sm" onclick="return confirm(\'Chắc chắn hủy lệnh debit của '.$laydulieuusera['congty'].' ?\');"><i class="fas fa-times-circle"></i> Hủy Lệnh</button>
				</form>';
				}
				else
				{
					echo'<form action="" method="POST">
				<input type="hidden" name="id_debit_huy" value="'.$item['id'].'">
				<button type="submit" name="btn_huy" class="btn btn-danger btn-sm" onclick="return confirm(\'Chắc chắn hủy lệnh debit của '.$laydulieuusera['congty'].' ?\');"><i class="fas fa-times-circle"></i> Hủy Lệnh</button>
				</form>';
				}
		echo'</td>
               
				
                  </tr>';
				  
				}
               }
			   
			   
			   
			   else if($roleid == 2)
			   {
				  $laydulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='$uid'"));
                  $data = mysqli_query($conn,"SELECT * FROM ksn_debit where idkhachhang='".$laydulieuuser['cus_code']."'");
					
					
					if(isset($_SESSION['accountant_key']))
					{
				echo'
				
			<table id="example" class="display nowrap cell-border" style="width:100%">
				<thead style="color:blue">
				   <tr>
					  <th style="text-align: center;color:#9f7d48"></th>
					  <th style="text-align: center;color:#9f7d48">Date Time</th>

					  <th style="text-align: center;color:#9f7d48">Debit No</th>
					
					  <th style="text-align: center;color:#9f7d48">Tổng Tiền</th>
					  <th style="text-align: center;color:#9f7d48">Trạng thái</th>
					  

					  <th style="text-align: center;color:#9f7d48"></th>
				   </tr>
				</thead>
				<tbody>';
				   
				
				   $i = 0;
				   while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
				   {  
					
					  
					  
					  echo '<tr>
					  <td style="text-align: center; color:black;font-size:14px;"></td>
					  <td style="text-align: left; color:black;font-size:14px;">'.$item['datetime'].'</td>
				  <td style="text-align: left; color:black;font-size:14px;"><a href="list_debit_dt.php?id='.$item['id'].'">'.$item['debitno'].'</a> <a href="export_debit.php?id='.$item['id'].'"><i class="fas fa-download"></i> </a></td>
			   
					  <td style="text-align: center; color:green;font-size:14px;">'.number_format($item['totaltien']).'</td>
					  <td style="text-align: center; color:black;font-size:14px;">'.checkthanhtoan($item['checkthanhtoan']).'</td>
				
					 <td  style="font-size:14px;">';

					if($item['checkthanhtoan'] == 2) {
						
						if($item['payment_method'] == 'cash')
						{
							echo'CASH';
						}
						else
						{
						$myArray = explode(',', $item['bangchungthanhtoan']);

						foreach ( $myArray as $a){
						echo' <a href="../upload/'.$a.'" target="_blank"><i class="fas fa-images"></i></a>';
						}
						}
						
						
						}
					else
					{
						echo'<form action="" method=POST>
						
						<input type="hidden" name="iddebit" value="'.$item['debitno'].'">
						<input type="hidden" name="makhachhang" value="'.$laydulieuuser['cus_code'].'">
						<input type="hidden" name="txt_email" value="'.$laydulieuuser['username'].'">
						<input type="hidden" name="txt_phone" value="'.$laydulieuuser['phone'].'">
						<input type="hidden" name="txt_gia" value="'.$item['totaltien'].'">
						<a href="list_debit_dt.php?id='.$item['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-money-check-alt"></i> Thanh Toán</a>
						</form>
						</>
						';
					}
			echo'</td>
				   
					
					  </tr>';
					  
					}
					}
					else
					{
						echo'
						<div class="card card-primary" width=50%>
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-unlock-alt"></i> Xác nhận bảo mật</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#EEE9E9">
				
				<form action="" method="POST">
					<div class="form-group" >
					<label for="">Please input key to show debit:</label>
					<input type="password"  name="accountant_key" >
					</div>
				<input type="submit" name="btn_submitkey" value="Submit" class="btn btn-danger">
				</form>
				
				
				</div>
				</div>
						
						
						<br>';
					}
			   }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
      </div>
   </div>
</div>



<?php
if($roleid == 1 || $roleid == 4 || $roleid == 3)
	{
		echo'<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Export Debit Package</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			
			
			
			
				
		 	<form method="GET" action="mani_accountant.php">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="">
<label for="aa">To Date:</label>
<input type="date" id="aa" name="day_end"  value=""><br>
							
				';
				echo'<div class="form-group">

				<label for="" class="control-label">Dịch vụ vận chuyển (Services) *</label>
					<select multiple class="select2bs4" name="kg_dichvu[]" id="" width=100%>';
					
						$dichvushipa = mysqli_query($conn,"SELECT * FROM ksn_dichvu where status='2' order by id asc");
							while ($dichvuship = mysqli_fetch_array($dichvushipa,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$dichvuship['id'].'">'.$dichvuship['dichvu'].'</option>';
							}
			
					echo'</select>
					</div>';
				echo'
				
				
            </div>
              <button type="submit" name="" class="btn btn-danger btn-sm" value=""><i class="fas fa-download"></i> Export Report Package</button>	
			</form>

           <hr>
		  <h4 class="modal-title">Export Report Debit</h4>
		   
		   	<form method="GET" action="mani_accountant_debit.php">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="">
<label for="aa">To Date:</label>
<input type="date" id="aa" name="day_end"  value=""><br>
							
				';
		
				echo'
				
				
            </div>
              <button type="submit" name="" class="btn btn-danger btn-sm" value=""><i class="fas fa-download"></i> Export Report Debit</button>
			</form>

           <hr>
		   
		   
		   
		   
           <hr>
		  <h4 class="modal-title">Export Report Debit Package Day</h4>
		   
		   	<form method="GET" action="mani_accountant_day.php">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="">
							
				';
		
				echo'
				
				
            </div>
              <button type="submit" name="" class="btn btn-danger btn-sm" value=""><i class="fas fa-download"></i> Export Report Debit Day</button>
			</form>

           <hr>
		   
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
	}
?>



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
    $('#example').DataTable( {
		  "pageLength": 50
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


<script>	$('#wrongpass').ready(function() {

      $(document).Toasts('create', {
		class: 'bg-success',
        title: 'Kango Express',
        autohide: true,
        delay: 5000,
        body: 'Create bill successful! Thank you for supporting our service'
      })} );
</script>