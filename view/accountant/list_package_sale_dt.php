<?php 
include("../controller/accountant.php");



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
	
	
	##checkrole
	 if ($roleid == 1 || $roleid == 3) {
               }else{
			echo'<script> 
               window.location.href="index.php";
            </script>';
               }
	/*if($uid != 1)
	{
		
	}
	*/
	
	if(isset($_POST['btn_update']))
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
	      	$ganthoigian = date("H_i_s");
			$newFileName = 'salepayment_'.$excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

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
					
					
							if($uid == 1 || $roleid == 3)
							{
								
								
							$totalcuoc = $_POST['totalcuoc'];	
							$user_id = $_POST['user_id'];	
							$payment_method = $_POST['payment_method'];	
								if($_POST['payment_type'] == 'debit')
								{
								mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='2' WHERE (`id_code`='".$_GET['id']."')");
								mysqli_query($conn,"UPDATE `ns_user` SET `hanmuc`=`hanmuc`+$totalcuoc WHERE (`id`='$user_id')");
								mysqli_query($conn,"INSERT INTO `ksn_debit_sale` (`id_bill`, `timethanhtoan`, `bangchungthanhtoan`,`final_price`,`valid`,`valid_uid`,`valid_time`,`payment_method`) VALUES ('$excute', '".$datenow2."', '".$newFileName."','$totalcuoc','1','$uid','$datenow','$payment_method')") or die(mysqli_error());
								}
								else
								{
								mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='2' WHERE (`id_code`='".$_GET['id']."')");
								mysqli_query($conn,"INSERT INTO `ksn_debit_sale` (`id_bill`, `timethanhtoan`, `bangchungthanhtoan`,`final_price`,`valid`,`valid_uid`,`valid_time`,`payment_method`) VALUES ('$excute', '".$datenow2."', '".$newFileName."','$totalcuoc','1','$uid','$datenow','$payment_method')") or die(mysqli_error());
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
?>
<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   <form action="" method="POST" enctype="multipart/form-data">

      
   
   
   <div class="row">
   
	   <div class="col-md-4">

	   <div class="card card-danger">
					  <div class="card-header">
						<h3 class="card-title">	Cập nhật thông tin thanh toán</h3>
					  </div>
					  <div class="card-body" style=" background-color:#EEE9E9">
						<div id="interactive" class="viewport"></div>
						<?php
						
							$package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package where id_code= ".$_GET['id'].""));
							$cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id,name FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"))or die ("loi");
							$sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
							$rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
							@$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
							@$dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select ten,id from ns_user where id='".$package['uid']."'"));
							$sotiengoc= sum_package_code($package['kg_dichvu'],$package['charge_weight'],$rName['city'],$rName['country_id'],$package['kg_chinhanh'],$conn,$rName['post_code'],$rName['state']);

							$totalcuoc = sum_package_sale($package['khach_cuocbay'],$package['khach_phuthu'],$package['khach_cuocnoidia'],$package['khach_thuho'],$package['khach_phibaohiem'],$package['vat']);
							if($package['id_sale'] == 0)
							{
								
							}
							else
							{
						

						echo'<label  for="">Thông tin thanh toán</label><br>
							- Mã account:<b> '.$package['cus_code'].'</b><br>
							- Tên Sales:<b> '.$dulieunhanvien['ten'].'</b><br><hr>
							';
							
						echo'<label  for="">Thông tin kiện hàng</label><br>
							- Mã kiện:<b> <a href="package_fn.php?id='.$package['id'].'">'.$package['id_code'].'</b></a><br>
							- Dịch Vụ:<b> '.dichvu($conn,$package['kg_dichvu']).'</b><br>
							- Chi Nhánh: <b>'.$package['kg_chinhanh'].'</b><br>
							- Số kiện nhỏ:<b>'.$package['sokien'].'</b><br>
							- Trọng lượng tính khách: <b>'.$package['charge_weight'].'</b><br><hr>
							';
							
						echo'<label  for="">Thông tin thanh toán</label><br>
							<font color="#000080">- Cước bay:<b> '.number_format($package['khach_cuocbay']).'đ</b><br>
							- Cước nội địa:<b> '.number_format($package['khach_cuocnoidia']).'đ</b><br>
							- Cước phụ thu:<b> '.number_format($package['khach_phuthu']).'đ</b><br>
							- Cước thu hộ:<b> '.number_format($package['khach_thuho']).'đ</b><br>
							';
							if($package['vat'] == 1)
							{
								echo'- Gồm VAT 10 %: <b>'.number_format($package['khach_cuocbay']*10/100).'đ</b><br>';
							}
							echo'- Total payment :<b> '.number_format($totalcuoc).'đ</b><br><hr>
							- Payment Code Price :  '.number_format($sotiengoc).'đ
							<br>

							';
							
							
							
							if($package['checkthanhtoan'] == 2)
							{
							
								
								$laydulieuthanhtoan = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit_sale where id_bill='".$_GET['id']."' LIMIT 1"));
								echo'<div class="alert alert-success alert-dismissible">
                  <h5><i class="icon fas fa-check"></i> Đã thanh toán!</h5>
                  Thời gian thanh toán: '.$laydulieuthanhtoan['timethanhtoan'].' <a href="../upload/'.$laydulieuthanhtoan['bangchungthanhtoan'].'" target="_blank"> <i class="fas fa-images"></i></a>
                </div>';
							}
							else
							{
							echo'<hr>
							<div class="form-group">
								<label  for="">Tải lên bằng chứng thanh toán </label>';
								if($uid == 1 || $roleid == 3 )
								{
									echo'<input type="file" required class="form-control  custom-file-upload" name="photo" id = "fileSelect">';
								}
								else
								{
								}
								
						echo'	</div>
						<input type="hidden" name="user_id" value="'.$dulieunhanvien['id'].'">
						<input type="hidden" name="totalcuoc" value="'.$totalcuoc.'">
						<input type="hidden" name="payment_type" value="'.$package['payment_type'].'">
								<div class="form-group">
								<label  for="">Phương thức thanh toán </label>

								<div class="form-check">
								<input class="form-check-input" type="radio" value="cash" name="payment_method">
								<label class="form-check-label">Tiền mặt</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio"  value="banking"  name="payment_method" checked="">
								<label class="form-check-label">Ngân Hàng</label>
								</div>
								</div>
								
						<button type="submit" name="btn_update" class="btn btn-primary form-control">Cập nhật thanh toán</button>
						';
							}
							
							}
						?>
					
						<!-- <a type="button" class="btn btn-success form-control" onclick="CreateByBarcode()" href="#">Tạo</a> --><br>
					  </div>
					  <!-- /.card-body -->
					</div>
					
	   </div>
   </div>
      </form>

   <div class="row">

      <div class="col-md-12">
			
		

			
		
			
		
      </div>
   </div>
</div>