<?php  
	include('top.php');
	
	if($roleid == 1 || $roleid == 3)
	{
		
	}
	else
	{
		echo'<script> 
               window.location.href="index.php";
            </script>';
	}
	if (isset($_POST['btn_submit'])) {
		
		
		
		
		
		$username = trim($_POST['username']);
		$password = $_POST['password'];
		$congty = $conn->real_escape_string($_POST['congty']);
		$tenlienhe = $conn->real_escape_string($_POST['tenlienhe']);
		$payment_price_type = $_POST['payment_price_type'];
		$mst = $_POST['mst'];
		$ctyghitat = strtoupper($congty);
		$count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ns_user WHERE username = '$username'"));
		if ($count != 0) {
          echo'<script> 
            alert("Đã có user FWD này!");
           </script>';
		}else{
			
			
			if($roleid == 3)
			{
				$active = 1;
			}else
			{
				$active ='';
			}
			
			
			$nguoigui_phone = $conn->real_escape_string($_POST['nguoigui_phone']);

			$nguoigui_add = $conn->real_escape_string($_POST['nguoigui_add']);
			@$website = $_POST['website'];
			$congno = $_POST['congno'];
			$accountant_key = $_POST['accountant_key'];
			
            mysqli_query($conn,"INSERT INTO `ns_user` (`username`, `password`,`ten`,`congty`,`roleid`,`ctyghitat`,`phone`,`diachi`,`website`,`payment_type`,`mst`,`payment_price_type`,`created_at`,`active`,`accountant_key`)
            VALUES ('$username','$password','$tenlienhe', '$congty', 2, '$ctyghitat','$nguoigui_phone','$nguoigui_add','$website','$congno','$mst','$payment_price_type','$datenow','$active','$accountant_key')") or die(mysqli_error()); 
		
			
			$laysoid = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where username='$username'"));
			mysqli_query($conn,"INSERT INTO `ns_maprole` (`roleid`, `userid`, `subroleid`) VALUES ('2', '".$laysoid['id']."', '3')");
			
			$idusera = $laysoid['id'];
			
			$nguoigui_name = $_POST['congty'];
			$nguoigui_tp = $_POST['nguoigui_tp'];
			@$nguoigui_districtid = $_POST['nguoigui_districtid'];
			@$nguoigui_wardid = $_POST['nguoigui_wardid'];
			$check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * 
FROM ns_customer 
WHERE id=(
    SELECT max(id) FROM ns_customer
    )"));
			
			
				$nguoigui_code = 'SHIB'.($check['id']+1);
				mysqli_query($conn,"INSERT INTO `ns_customer` (`name`,`cus_code`, `province_id`, `district_id`, `ward_id`,`address`,`phone`,`fwd`)
				VALUES ('$nguoigui_name','$nguoigui_code','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone','1')") or die(mysql_error()); 
				mysqli_query($conn,"UPDATE `ns_user` SET `cus_code`='$nguoigui_code' WHERE (`id`='$idusera')");
			
			
			
			### Upload hình
			
			
			
			$target_dir = "../inbill/inbilltw/";
			$target_file = $target_dir .$idusera.'-'. trim(basename($_FILES["imagecongty"]["name"]));
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						
			  $check = getimagesize($_FILES["imagecongty"]["tmp_name"]);
			  if($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			  } else {
				//echo "File is not an image.";
				$uploadOk = 0;
			  }
			

		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.";
		  $uploadOk = 0;
		}

		// Check file size
		if ($_FILES["imagecongty"]["size"] > 5000000) {
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["imagecongty"]["tmp_name"], $target_file)) {
			  
			  			$target_fileb = $idusera.'-'. trim(basename($_FILES["imagecongty"]["name"]));

			echo "The file ". htmlspecialchars( basename( $_FILES["imagecongty"]["name"])). " has been uploaded.";
			mysqli_query($conn,"UPDATE `ns_user` SET `logo`='".$target_fileb."' WHERE (`id`='$idusera')");
		  } else {
			echo "Sorry, there was an error uploading your file.";
		  }
		}
			
	
          echo'<script> 
               alert("Tạo thành công!");
							window.location = "m_admin.php?m=fwd";

              </script>
			  
			  
			  
			  ';
		}
		
		
		
		
	}
?>
<div class="container-fluid">
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-3">
			
				<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-unlock-alt"></i>Thông tin Tài khoản</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#EEE9E9">
				
				
					
				
				
				<div class="form-group" >
					<label for="">Username</label>
					<input type="text"  name="username" value="" class="form-control" required placeholder="Username">
				</div>
				<div class="form-group" >
					<label for="">Password</label>
					<input type="text"  name="password" value="" class="form-control" required placeholder="Password">
				</div>
				<div class="form-group" >
					<label for="">Key for Accountant</label>
					<input type="text"  name="accountant_key" value="" class="form-control" required placeholder="Key for Accountant">
				</div>
				<div class="form-group" >
					<label for="">CÔNG NỢ</label>
					<select class="form-control" name="congno" required>
					<option value="">Chọn loại công nợ</option>
					<option value="1">Công nợ theo ngày</option>
					<option value="2">Công nợ theo tuần</option>
					<option value="4">Công nợ theo 2 tuần</option>
					<option value="3">Công nợ theo tháng</option>
					</select>
				</div>
				<div class="form-group" >
					<label for="">CHỌN BẢNG GIÁ</label>
					<select class="form-control" name="payment_price_type" required>
					<option value="">Chọn bảng giá áp dụng</option>
					<option value="0">ÁP DỤNG BẢNG GIÁ F0</option>
					<option value="1">ÁP DỤNG BẢNG GIÁ F1</option>
					
					</select>
				</div>
				<div class="form-group">
					<label  for="">Upload Logo Công ty </label>
					<?php
					if($uid == 1)
					{
						echo'<input type="file" required class="form-control  custom-file-upload" name="imagecongty" id = "imagecongty">';
					}
					else
					{
						echo'<input type="file" class="form-control  custom-file-upload" name="imagecongty" id = "imagecongty">';
					}
					?>
					
				</div>
				
				
				</div>
				</div>
			
			</div>
			
			
			<div class="col-md-4">
				
				
				
				
					<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i> Thông tin chi tiết công ty</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#EEE9E9">
				
				
				
				
				
				<div class="form-group" >
					<label for="">Tên Công Ty (Company Name)</label>
					<input type="text"  name="congty" value="" class="form-control" required placeholder="Tên công ty">
				</div>
				<div class="form-group" >
					<label for="">Tên Liên Hệ (Contact Name)</label>
					<input type="text"  name="tenlienhe" value="" class="form-control" required placeholder="Tên liên hệ">
				</div>
				<div class="form-group" >
					<label for="">Mã Số Thuế</label>
					<input type="text"  name="mst" value="" class="form-control" required placeholder="Nhập Mã số thuế">
				</div>
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoigui_phone" class="form-control" placeholder="Nhập SĐT" required >
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<select class="form-control" id="nguoigui_tp-dropdown" name="nguoigui_tp">
						<?php 
							$provinces = mysqli_query($conn,"SELECT * FROM yn_province order by id asc");
							echo '<option value="">Chọn tỉnh/thành phố</option>';
							while ($item = mysqli_fetch_array($provinces,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'">'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Quận/Huyện</label>
					<select  class="form-control" name="nguoigui_districtid" id="nguoigui_district-dropdown">
						
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Phường/Xã</label>
					<select  class="form-control" name="nguoigui_wardid" id="nguoigui_ward-dropdown">
						
					</select>
				</div>
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="form-control"  placeholder="Nhập địa chỉ" >
				</div>
				<button type="submit" name="btn_submit" class="btn btn-primary">Tạo Tài Khoản </button>
				</div>
				
				</div>
				
				
			</div>
		</div>
	</form>
	
</div>

<?php  
    include('footer.php');
?>
<script type="text/javascript">
	$('#nguoigui_tp-dropdown').on('change', function(){
		var province_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				province_id: province_id,
				action: "filterDistrict"
			},
			cache: false,
			success: function(result){
				$("#nguoigui_district-dropdown").html(result);
				$("#nguoigui_ward-dropdown").html('<option value=""></option>');
			}
		});
	});

	$('#nguoigui_district-dropdown').on('change', function(){
		var district_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				district_id: district_id,
				action: "filterWard"
			},
			cache: false,
			success: function(result){
				$("#nguoigui_ward-dropdown").html(result);
			}
		});
	});

</script>