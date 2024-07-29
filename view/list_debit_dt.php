<?php   ini_set('memory_limit', '-1');
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
	
		function compressImage($source, $destination, $quality) {
	    $info = getimagesize($source);

	    if ($info['mime'] == 'image/jpeg') 
	        $image = imagecreatefromjpeg($source);

	    elseif ($info['mime'] == 'image/gif') 
	        $image = imagecreatefromgif($source);

	    elseif ($info['mime'] == 'image/png') 
	        $image = imagecreatefrompng($source);

	    imagejpeg($image, $destination, $quality);

	    return $destination;
	}
	$iddebit = $_GET['id'];
	$laydulieudebit = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit where id='$iddebit'"));
	 if ($roleid == 1 || $roleid == 3) {
					$result = mysqli_query($conn,"select * from ksn_debit_detail where id_debit='".$iddebit."'")or die("Loi");
               }else{
					if($laydulieudebit['idkhachhang'] != $datauser['cus_code'])
					{
						exit();
					}
					$result = mysqli_query($conn,"select * from ksn_debit_detail where id_debit='".$iddebit."'")or die("Loi");
					
					



               }
	/*if($uid != 1)
	{
		echo'<script> 
               window.location.href="list_packfwd.php";
            </script>';
	}
	*/
	
	
	if($roleid == 1 || $roleid == 3)
	{
		if(isset($_POST['btn_edit']))
		
		{
			
				$date = date('Y-m-d');
			$datenow2 = date('Y-m-d H:i:s');
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];
	
		$excute = $_GET['id'];
			
			
			
			
			
			if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
			$final_price = $_POST['final_price'];

	      	$ganthoigian = date("H_i_s");
			$newFileName = 'debit_them_'.$excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	        $filename = $_FILES["photo"]["name"];
	        $filetype = $_FILES["photo"]["type"];
	        $filesize = $_FILES["photo"]["size"];

	        // Xác minh phần mở rộng tệp
	        $ext = pathinfo($filename, PATHINFO_EXTENSION);
	        if(!array_key_exists($ext, $allowed)) die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");

	        // Xác minh kích thước tệp - tối đa 5MB
	        $maxsize = 20 * 1024 * 1024;
	        if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
	        
	        // Xác minh loại MIME của tệp
	        if(in_array($filetype, $allowed)){
	            if(file_exists("../upload/" . $filename)){
	                echo $filename . " đã tồn tại.";
	            } else{
	                $location = "../upload/" . $newFileName;
	                $compressedImage = compressImage($_FILES["photo"]["tmp_name"],$location,60);

					if($compressedImage){ // có thể có lỗi
					
						
						
						if($roleid == 1 || $roleid == 3)
						{	   
							$final_price = $_POST['final_price'];
							$note_edit = $laydulieudebit['note_edit'];
							$final_price_old = $laydulieudebit['final_price'];
							$ghichu = $_POST['ghichu'];
							mysqli_query($conn,"INSERT INTO `ksn_debit_note` (`id_debit`, `sotien`, `ghichu`, `img`,`datetime`) VALUES ('$iddebit', '$final_price', '$ghichu', '$newFileName','$datenow2')");

							if($final_price != $final_price_old)
							{

							$note_edit.='<br>Edit Final Price from <b>'.number_format($final_price_old).' </b>to <b>'.number_format($final_price).' </b>('.$datauser['username'].')</b>';
							
							mysqli_query($conn,"UPDATE `ksn_debit` SET `final_price`='$final_price',`note_edit`='$note_edit' WHERE (`id`='".$_GET['id']."')") or die(mysqli_error());
							}
						
						}
						
		else
		{
		
		}
					}else{
						echo "Lỗi: không thể di chuyển tệp đến upload/";
					}
	            } 
	        } else{
	            echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
	        }
	    } else{
	        //echo "Error: " . $_FILES["photo"]["error"];
	    }
		
			
		
		
		
		
		
		
		
			
			
			
			
			
			
			
			
			
			
			
			
		}
		
		
		if(isset($_POST['btn_accept']))
		
		{
			$final_price = $_POST['final_price'];
			
					
			mysqli_query($conn,"UPDATE `ksn_debit` SET `final_price`='$final_price',`checkthanhtoan`='2',`valid`='1',`valid_uid`='$uid' WHERE (`id`='".$_GET['id']."')") or die(mysqli_error());
			while($item = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='2' WHERE (`id_code`='".$item['id_code']."')");					   
			}
		}
	}
	
	
	
	if(isset($_POST['btn_update']))
	{
		
		
		$payment_method = $_POST['payment_method'];
		$final_price = $_POST['final_price'];

		$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];

		$excute = $_GET['id'];
		
		$numberOfFilesUploaded = count($_FILES['photo']['name']);
		
		$string_urlimg = "";
		for ($i = 0; $i <= $numberOfFilesUploaded; $i++) 
		{
					
		if(isset($_FILES["photo"]['name'][$i]) AND $_FILES["photo"]['name'][$i] != "")
		{

	      	$ganthoigian = date("H_i_s");
			$newFileName = 'debit_'.$excute.'_'.$i.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"][$i] ,PATHINFO_EXTENSION); 

	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	        $filename = $_FILES["photo"]["name"][$i];
	        $filetype = $_FILES["photo"]["type"][$i];
	        $filesize = $_FILES["photo"]["size"][$i];

	        // Xác minh phần mở rộng tệp
	        $ext = pathinfo($filename, PATHINFO_EXTENSION);
	        if(!array_key_exists($ext, $allowed)) die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");

	        // Xác minh kích thước tệp - tối đa 5MB
	        $maxsize = 20 * 1024 * 1024;
	        if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
	        
	        // Xác minh loại MIME của tệp
	        if(in_array($filetype, $allowed)){
	            if(file_exists("../upload/" . $filename)){
	                echo $filename . " đã tồn tại.";
	            } else{
	                $location = "../upload/" . $newFileName;
	                $compressedImage = compressImage($_FILES["photo"]["tmp_name"][$i],$location,60);

					if($compressedImage){ // có thể có lỗi
					
						
						
						
						if($roleid == 1 || $roleid == 3)
						{	   			
								$note_edit = $_POST['note'];

								mysqli_query($conn,"UPDATE `ksn_debit` SET `bangchungthanhtoan`='$newFileName',`final_price`='$final_price',`note_edit`='$note_edit',`checkthanhtoan`='2',`timethanhtoan`='$datenow',`valid`='1',`valid_uid`='$uid',`payment_method`='$payment_method' WHERE (`id`='$excute')") or die(mysqli_error($conn));


							   while($item = mysqli_fetch_array($result,MYSQLI_ASSOC))
							   {
								   mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='2' WHERE (`id_code`='".$item['id_code']."')");
								   
							   }
						
						}
						if($roleid == 2)
						{
							if($laydulieudebit['checkthanhtoan'] != '2')
							{
								mysqli_query($conn,"UPDATE `ksn_debit` SET `bangchungthanhtoan`='$newFileName',`checkthanhtoan`='3',`timethanhtoan`='$datenow',`valid`='0' WHERE (`id`='$excute')") or die(mysqli_error());
							}
						}
						$string_urlimg .= $newFileName;
						if(($i+1) < $numberOfFilesUploaded)
						{
						$string_urlimg .= ',';
						}

						
						
		else
		{
		
		}
					}else{
						echo "Lỗi: không thể di chuyển tệp đến upload/";
					}
	            } 
	        } else{
	            echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
	        }
	    } else{
	        //echo "Error: " . $_FILES["photo"]["error"];
	    }

		
		}
		if($payment_method  == 'cash')
		{
			$note_edit = $_POST['note'];

								mysqli_query($conn,"UPDATE `ksn_debit` SET `bangchungthanhtoan`='',`final_price`='$final_price',`note_edit`='$note_edit',`checkthanhtoan`='2',`timethanhtoan`='$datenow',`valid`='1',`valid_uid`='$uid',`payment_method`='cash' WHERE (`id`='$excute')") or die(mysqli_error());


							   while($item = mysqli_fetch_array($result,MYSQLI_ASSOC))
							   {
								   mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='2' WHERE (`id_code`='".$item['id_code']."')");
								   
							   }
		}
		else
		{
		mysqli_query($conn,"UPDATE `ksn_debit` SET `bangchungthanhtoan`='$string_urlimg' WHERE (`id`='$excute')") or die(mysqli_error());
		}
	}
	
	
	
	
	
	
	
	
	
	
	if(isset($_POST['btn_tamduyet']))
	{
		
		
		
				$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];

		$excute = $_GET['id'];

		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
			$final_price = $_POST['final_price'];
			$tamung_note = $_POST['final_price'];

	      	$ganthoigian = date("H_i_s");
			$newFileName = 'debit_tamung_'.$excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	        $filename = $_FILES["photo"]["name"];
	        $filetype = $_FILES["photo"]["type"];
	        $filesize = $_FILES["photo"]["size"];

	        // Xác minh phần mở rộng tệp
	        $ext = pathinfo($filename, PATHINFO_EXTENSION);
	        if(!array_key_exists($ext, $allowed)) die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");

	        // Xác minh kích thước tệp - tối đa 5MB
	        $maxsize = 20 * 1024 * 1024;
	        if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
	        
	        // Xác minh loại MIME của tệp
	        if(in_array($filetype, $allowed)){
	            if(file_exists("../upload/" . $filename)){
	                echo $filename . " đã tồn tại.";
	            } else{
	                $location = "../upload/" . $newFileName;
	                $compressedImage = compressImage($_FILES["photo"]["tmp_name"],$location,60);

					if($compressedImage){ // có thể có lỗi
					
						
						
						echo'Cập nhật thành công';
						if($roleid == 1 || $roleid == 3)
						{	   
								mysqli_query($conn,"UPDATE `ksn_debit` SET `tamung_img`='$newFileName',`tamung`='$final_price',`tamung_note`='$tamung_note',`checkthanhtoan`='5',`tamung_time`='$datenow' WHERE (`id`='$excute')") or die(mysqli_error());


							   while($item = mysqli_fetch_array($result,MYSQLI_ASSOC))
							   {
								   mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='5' WHERE (`id_code`='".$item['id_code']."')");
								   
							   }
						
						}
						
						
		else
		{
		
		}
					}else{
						echo "Lỗi: không thể di chuyển tệp đến upload/";
					}
	            } 
	        } else{
	            echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
	        }
	    } else{
	        //echo "Error: " . $_FILES["photo"]["error"];
	    }

		
	
	}
	
	
	
	
	
	
	
	
	
	
	
	 if ($roleid == 1 || $roleid == 3) {
					$result = mysqli_query($conn,"select * from ksn_debit_detail where id_debit='".$iddebit."'")or die("Loi");
               }else{
					if($laydulieudebit['idkhachhang'] != $datauser['cus_code'])
					{
						exit();
					}
					$result = mysqli_query($conn,"select * from ksn_debit_detail where id_debit='".$iddebit."'")or die("Loi");
					
					



               }

?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   <form action="" method="POST" enctype="multipart/form-data">

      
   
   
   <div class="row">
   <div class="col-md-8">

	   <div class="card card-danger">
					  <div class="card-header">
						<h3 class="card-title">	Thông tin thanh toán hóa đơn của bạn </h3>
					  </div>
					  <div class="card-body" style=" background-color:#EEE9E9">
							VUI LÒNG KIỂM TRA THÔNG TIN STK GIAO DỊCH CỦA SHIBA EXPRESS BÊN DƯỚI :<br>
+ NẾU KHÁCH HÀNG KHÔNG LẤY HÓA ĐƠN VAT VUI LÒNG THANH TOÁN VÀO TÀI KHOẢN GIAO DỊCH CÁ NHÂN BÊN DƯỚI VÀ NỘI DUNG TT BẮT BUỘC NHƯ SAU: <br>
*** SỐ DEBIT +  NOP TIEN MAT ***<br>
+ NẾU KHÁCH HÀNG LẤY HÓA ĐƠN CỦA SHIBA EXPRESS VUI LÒNG THANH TOÁN VÀO TÀI KHOẢN CÔNG TY CỦA SHIBA EXPRESS BÊN DƯỚI VÀ NỘI DUNG TT VUI LÒNG YÊU CẦU GHI RÕ SỐ HÓA ĐƠN MÀ SHIBA EXPRESS PHÁT HÀNH.<br>
+ SAU KHI THANH TOÁN QUÝ KHÁCH HÀNG VUI LÒNG UPDATE BIÊN LAI VÀO HỆ THỐNG SHIBA EXPRESS HOẶC GỬI THÔNG TIN VỀ GROUP ZALO LÀM VIỆC GIỮA SHIBA EXPRESS VÀ QUÝ KHÁCH , KẾ TOÁN SHIBA EXPRESS SẼ KIỂM TRA VÀ XÁC NHẬN TRÊN HỆ THỐNG.<br><hr>
<b>1. THÔNG TIN TÀI KHOẢN CÁ NHÂN: 	 <br>	 	 	 
<?php echo string_mod('debit_string_5',$conn);?><br> 	 
<?php echo string_mod('debit_string_6',$conn);?>	 	 	<br> 
<?php echo string_mod('debit_string_7',$conn);?> 	 	 	 <br>
<?php echo string_mod('debit_string_7a',$conn);?><br> 	 	 
 	 	 	 	<hr>
2. THÔNG TIN TÀI KHOẢN CÔNG TY: 	 <br>	 	 	 
<?php echo string_mod('debit_string_8',$conn);?>	 <br>	 	 	 
<?php echo string_mod('debit_string_9',$conn);?>	 	<br> 	 
<?php echo string_mod('debit_string_10',$conn);?>	 	 	 <br>	 
<?php echo string_mod('debit_string_11',$conn);?>	 	 	 	<br> 
<?php echo string_mod('debit_string_12',$conn);?>		 	 <br>	 	 
<?php echo string_mod('debit_string_13',$conn);?>	<br> </b>
						<!-- <a type="button" class="btn btn-success form-control" onclick="CreateByBarcode()" href="#">Tạo</a> --><br>
					  </div>
					  <!-- /.card-body -->
					</div>
					
	   </div>
	   <div class="col-md-4">

	   <div class="card card-danger">
					  <div class="card-header">
						<h3 class="card-title">	DEBIT NO: <?php echo $laydulieudebit['debitno'];?></h3>
					  </div>
					  <div class="card-body" style=" background-color:#EEE9E9">
						<div id="interactive" class="viewport"></div>
						<?php
							$laydulieudebit = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit where id='$iddebit'"));

						echo'<label  for="">Thông tin thanh toán</label><br>
							- Mã khách hàng:<b> '.$laydulieudebit['idkhachhang'].'</b><br>
							- Total Package: <span id="totalkien"> '.$laydulieudebit['totalkienlon'].'</span><br>
							- Total Sub Package: <span id="totalsub">'.$laydulieudebit['totalkiennho'].'</span> <br>
							- Total Payment: <b>'.number_format($laydulieudebit['totaltien']).'đ </b><br>';
							
							
							
							if($laydulieudebit['checkthanhtoan'] == 2)
							{
												echo'<div class="alert alert-success alert-dismissible" style="margin-top:10px">
								  <h5><i class="icon fas fa-check"></i> Đã thanh toán!</h5>
								  Time payment: '.$laydulieudebit['timethanhtoan'].'<br>
								  Final price: '.number_format($laydulieudebit['final_price']).' đ
								</div>';
				
							
								$laydulieunote = mysqli_query($conn,"select * from ksn_debit_note where id_debit='$iddebit'");
								$i=0;
								
								if($roleid != 2)
										{
										echo'<table class="table table-striped" style="width:100%;border: 1px solid black;"><tr>
										<td>STT</td>
										<td>Nội dung ghi chú</td>
										<td>Hình ảnh</td>
										<td>Date time</td>
										</tr>
										
										';
										while($laydulieunotea = mysqli_fetch_array($laydulieunote,MYSQLI_ASSOC))
										{
											$i++;
											echo'<tr>';
											echo '<td>'.$i.'</td>';
											echo '<td>'.$laydulieunotea['ghichu'].'</td>';
											echo '<td><a href="../upload/'.$laydulieunotea['img'].'">Hình ảnh</a></td>';
											echo '<td>'.$laydulieunotea['datetime'].'</td></tr>';
											
										}
										echo'</table>';

										echo '<div class="color:red;margin-top:5px;">'.$laydulieudebit['note_edit'].'</div>';
									if($roleid == 3 || $roleid == 1)
									{
										if(@$_GET['m'] == 'edit')
										{
										echo'<hr>';
										echo'<label>Final Price</label>
										<input type="number" class="form-control" name="final_price" placeholder="" value="'.$laydulieudebit['final_price'].'" required>			<br>	
										Upload biên lai thanh toán
										<input type="file" required class="form-control  custom-file-upload" name="photo" id = "fileSelect">
										<label>Ghi chú nội dung cần chỉnh</label>
										<input type="text" class="form-control" name="ghichu" placeholder="Ghi chú" value="" required><br>
										<button type="submit" name="btn_edit" class="btn btn-warning form-control"><i class="fas fa-edit"></i> Edit Final Price</button>
		<hr>
										';
										
										$laydulieunote = mysqli_query($conn,"select * from ksn_debit_note where id_debit='$iddebit'");
										$i=0;
										echo'<table class="table" style="width:100%;border: 1px solid black;"><tr>
										<td>STT</td>
										<td>Nội dung ghi chú</td>
										<td>Hình ảnh</td>
										<td>Date time</td>
										</tr>
										
										';
										while($laydulieunotea = mysqli_fetch_array($laydulieunote,MYSQLI_ASSOC))
										{
											$i++;
											echo'<tr>';
											echo '<td>'.$i.'</td>';
											echo '<td>'.$laydulieunotea['ghichu'].'</td>';
											echo '<td><a href="../upload/'.$laydulieunotea['img'].'">Hình ảnh</a></td>';
											echo '<td>'.$laydulieunotea['datetime'].'</td></tr>';
											
										}
										echo'</table>';

										echo '<div class="color:red;margin-top:5px;">'.$laydulieudebit['note_edit'].'</div>
										
										';
										}

									}
							

							}

							}
							else if($laydulieudebit['checkthanhtoan'] == 3)
							{
								if($roleid == 2 || $roleid == 3 || $roleid == 1)
								{
								echo'<div class="alert alert-warning alert-dismissible" style="margin-top:10px">
								  <h5><i class="icon fas fa-check"></i> Đã gửi bằng chứng thanh toán chờ duyệt lệnh! </h5>
								  Time payment: '.$laydulieudebit['timethanhtoan'].'  
								  ';
								  
						$myArray = explode(',', $laydulieudebit['bangchungthanhtoan']);

						foreach ( $myArray as $a){
						echo' <a href="../upload/'.$a.'" target="_blank"><i class="fas fa-images"></i></a>';
						}								
								
								echo'</div>';
								}
								if($roleid == 3 || $roleid == 1)
								{
									
								echo'<hr>';
								echo'<label>Final Price</label>
								<input type="number" class="form-control" name="final_price" placeholder="" value="'.$laydulieudebit['totaltien'].'" required>			<br>			
								<button type="submit" name="btn_accept" class="btn btn-primary form-control"><i class="fas fa-check-circle"></i> Duyệt Lệnh Thanh Toán</button>
								
								';
								}
							}

							else
							{
							echo'<hr>
							<div class="form-group">
							<div class="form-group">
							
							';
							
							if($roleid == 2)
							{
							echo'<input type="hidden" class="form-control" name="final_price" placeholder="" value="'.$laydulieudebit['totaltien'].'" required>';
							}
							else
							{
							echo'							<label>Final Price</label>
<input type="number" class="form-control" name="final_price" placeholder="" value="'.$laydulieudebit['totaltien'].'" required>

<label>Ghi chú</label>
								<input type="text" class="form-control" name="note" placeholder="Nhập ghi chú" value="" required>		

<div class="form-group">
					<label for="">Hình Thức</label>
					
					
				
				
				<div class="form-check">
				<input class="form-check-input" type="radio" value="cash" name="payment_method">
				<label class="form-check-label"><i class="fas fa-dollar-sign"></i> Cash</label>
				</div>
				
				<div class="form-check">
				<input class="form-check-input" type="radio" value="banking" name="payment_method" checked="">
				<label class="form-check-label"><i class="fas fa-dollar-sign"></i> Banking</label>
				</div>
				
				</div>
';
							
							}
							
							echo'</div>
								<div  id="uphinh">
								<label  for="">Tải lên bằng chứng thanh toán </label>';
								
									echo'<div id="themhinhanh"><input type="file" required class="form-control  custom-file-upload" name="photo[]" id = "fileSelect" multiple></div>';
									
								
								
								echo'			<br>	<span class="btn-danger add2" style="padding:5px;  cursor:pointer;"><i class="fa fa-plus" aria-hidden="true" ></i> Thêm hình ảnh</span> </div>
';
						echo'	</div><button type="submit" name="btn_update" class="btn btn-primary form-control">Cập nhật thanh toán</button>
						
						      </form>
							
						
							

						';
							}
						?>
					
						<!-- <a type="button" class="btn btn-success form-control" onclick="CreateByBarcode()" href="#">Tạo</a> --><br>
					  </div>
					  <!-- /.card-body -->
					</div>
					
					
					<?php 
					
					if($laydulieudebit['checkthanhtoan'] != 2 && ($roleid == 1 OR $roleid == 3))
					{
					echo'
					 <div class="card card-warning">
					  <div class="card-header">
						<h3 class="card-title">DUYỆT FOWARDER TẠM ỨNG</h3>
					  </div>
					  <form action="" method="POST"  enctype="multipart/form-data">
					  <div class="card-body" style=" background-color:#EEE9E9">
					  ';
								
								if($laydulieudebit['tamung_time'] != "")
								{
									if($roleid == 1 || $roleid == 3)
									{
									echo'- TẠM ỨNG: '.number_format($laydulieudebit['tamung']).'<br>';
									echo'- THỜI GIAN: '.$laydulieudebit['tamung_time'].'<br>';
									echo'- HÌNH ẢNH THANH TOÁN TẠM ỨNG (NẾU CÓ):<a href="../upload/'.$laydulieudebit['tamung_img'].'"> <i class="fas fa-images"></i></a><br>';
									echo'- GHI CHÚ: '.$laydulieudebit['tamung_note'].'<br>';
									echo'- KHÁCH HÀNG TẠM ỨNG CÓ THỂ ĐƯỢC QUÉT EXPORT';
									}
								}
								else
								{
									echo'<label>Số tiền tạm ứng </label>
									<input type="number" class="form-control" name="final_price" placeholder="" value="0" required>
									<label>Ghi chú </label>
									<input type="text" class="form-control" name="tamung_note" placeholder="ghi chú" value=""">

									
									<label  for="">Tải lên bằng chứng thanh toán </label>';
									if($uid == 1)
									{
										echo'<input type="file"  class="form-control  custom-file-upload" name="photo" id = "fileSelect">';
									}
									else
									{
										echo'<input type="file"  class="form-control  custom-file-upload" name="photo" id = "fileSelect">';
									}
									
									
									
									echo'<br><button type="submit" name="btn_tamduyet" class="btn btn-warning form-control">Tạm duyệt lệnh</button>
									
									';
								}
								
					}
					else
					{
						if($laydulieudebit['tamung_time'] != "")
								{
									echo'- TẠM ỨNG: '.$laydulieudebit['tamung'].'<br>';
									echo'- THỜI GIAN: '.$laydulieudebit['tamung_time'].'<br>';
									echo'- HÌNH ẢNH THANH TOÁN TẠM ỨNG (NẾU CÓ):<a href="../upload/'.$laydulieudebit['tamung_img'].'/"> <i class="fas fa-images"></i></a><br>';
									echo'- GHI CHÚ: '.$laydulieudebit['tamung_note'].'<br>';

								}
					}
								
								echo'
					  </div>
					  </form>
					 </div>';
					 
					 ?>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
	   </div>


	   
	   
	   
	   
	   
   </div>

   <div class="row">

      <div class="col-md-12">
			
		

			
		
			
		<table id="example3" class="display nowrap cell-border" style="width:100%">
            <thead style="color:3399FF">
               <tr>
                  <th style="text-align: center;color:#9f7d48"></th>
                    <th style="text-align: center;color:#9f7d48">Date</th>
                    <th style="text-align: center;color:#9f7d48">KG BILL NO</th>
                  <th style="text-align: center;color:#9f7d48">TRACKING</th>
                  <th style="text-align: center;color:#9f7d48">SERVICE</th>
                  <th style="text-align: center;color:#9f7d48">DESTINATION</th>
                  <th style="text-align: center;color:#9f7d48">TYPE</th>
                  <th style="text-align: center;color:#9f7d48">PACKAGES</th>
                  <th style="text-align: center;color:#9f7d48">DESCRIPTION OF GOODS</th>
                  <th style="text-align: center;color:#9f7d48">Freight Price </th>
                  <th style="text-align: center;color:#9f7d48">Extra Price</th>
                  <th style="text-align: center;color:#9f7d48">VAT</th>
                  <th style="text-align: center;color:#9f7d48">Total</th>
                  

               </tr>
            </thead>
            <tbody>

               <?php
              
			  
			
               
               $i = 0;
			   
			   $totalkien = 0;
               while($item = mysqli_fetch_array($result,MYSQLI_ASSOC))
               {  
					$result2 = mysqli_query($conn,"select * from ns_package where id_code='".$item['id_code']."'")or die("Loi");
					$result2a = mysqli_fetch_assoc($result2);



					$totalkien+= 1;
					$note ='';
					
					$layhoadonadd = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$result2a['id']."'  and status <> '0' and status <> '5' ")or die("Loi 3");
					@$sender = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$result2a['id_nguoigui']."'")) ;
					@$receiver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$result2a['id_nguoinhan']."'")) ;
					@$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
								  
				  
                  echo '<tr>
				  <td style="text-align: center; color:black;font-size:14px;"></td>
				  <td style="text-align: left; color:3399FF;font-size:14px;">'.$result2a['date'].'</td>
				  <td style="text-align: left; color:3399FF;font-size:14px;">'.$result2a['id_code'].'</td>
				  <td style="text-align: left; color:black;font-size:14px;"></td>
				  <td style="text-align: left; color:black;font-size:14px;">'.dichvu($conn,$result2a['kg_dichvu']).'</td>
				  <td style="text-align: left; color:black;font-size:14px;">'.@$dulieuquocgia['name'].'</td>
				  <td style="text-align: left; color:black;font-size:14px;">PACK</td>
				  <td style="text-align: left; color:3399FF;font-size:14px;">
				  ';
				  while($dulieusubpack = mysqli_fetch_array($layhoadonadd,MYSQLI_ASSOC))
					  
				  {
					  echo''.$dulieusubpack['id_code'].' - '.$dulieusubpack['cannang'] .' kg<br>';
				  }
				  echo'</td>
				  <td style="text-align: left; color:black;font-size:14px;"></td>
				  <td style="text-align: left; color:black;font-size:14px;">'.number_format($result2a['khach_cuocbay']).'</td>
				  <td style="text-align: left; color:black;font-size:14px;">'.number_format($result2a['khach_phuthu']).'</td>
				  <td style="text-align: left; color:;font-size:14px;">'.number_format($result2a['vat']).'</td>
				  <td style="text-align: left; color:blue;font-size:14px;">'.number_format($result2a['khach_cuocbay']+$result2a['khach_phuthu']+$result2a['vat']).'</td>

            
				
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


<script>
$(document).ready(function() {
	 $('input:radio[name="payment_method"]').change(function () {

        if($(this).val() =='banking') {
            document.getElementById('uphinh').hidden = false;
			document.getElementById("fileSelect").required = true;

        } else {
            document.getElementById('uphinh').hidden = true;
			document.getElementById("fileSelect").required = false;

        }
    });	


	$('.add2').click(function() {
		$("#themhinhanh").append("<input type='file'  class='form-control  custom-file-upload' name='photo[]' id = 'fileSelect' multiple></div>");
	});
		
	});
</script>

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