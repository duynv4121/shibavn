<?php  
		
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
	
	
	
	
	
	if(isset($_POST['btn_updatelogo']))
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
			$newFileName = 'logo_'.$excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

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
	            if(file_exists("../inbill/inbilltw/" . $filename)){
	                echo $filename . " đã tồn tại.";
	            } else{
	                $location = "../inbill/inbilltw/" . $newFileName;
	                $compressedImage = compressImage($_FILES["photo"]["tmp_name"],$location,60);

					if($compressedImage){ // có thể có lỗi
					
						
					mysqli_query($conn,"UPDATE `ns_user` SET `logo`='".$newFileName."' WHERE (`id`='".$_GET['id']."')");

						
						
						
		
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
	
	
	
	
	
	
	if (isset($_POST['btn_update'])) {
		
		
		
		
		$username = trim($_POST['username']);
		
	
		
		$password = $_POST['password'];
		@$congty = $conn->real_escape_string($_POST['congty']);
		$tenlienhe = $conn->real_escape_string($_POST['tenlienhe']);
		$payment_price_type = $_POST['payment_price_type'];
		$payment_price_type_c = $_POST['payment_price_type_c'];
		$payment_price_type_date = $_POST['payment_price_type_date'];
		@$mst = $_POST['mst'];
		$ctyghitat = strtoupper($congty);
	
			
			$nguoigui_phone = $conn->real_escape_string($_POST['nguoigui_phone']);

			$nguoigui_add = $conn->real_escape_string($_POST['nguoigui_add']);
			@$website = $conn->real_escape_string($_POST['website']);
			$congno = $conn->real_escape_string($_POST['congno']);
			@$img_sign = $_POST['img_sign'];
			@$d_m_21 = $_POST['d_m_21'];
			@$d_m_50 = $_POST['d_m_50'];
			@$d_m_100 = $_POST['d_m_100'];

			$cus_code = substr($_POST['cus_code'],2);
			
			$nguoigui_name = $conn->real_escape_string($_POST['congty']);
			$accountant_key = $conn->real_escape_string($_POST['accountant_key']);
			$nguoigui_tp = $_POST['nguoigui_tp'];
			@$nguoigui_districtid = $_POST['nguoigui_districtid'];
			@$nguoigui_wardid = $_POST['nguoigui_wardid'];
			
			mysqli_query($conn,"UPDATE `ns_user` SET `password`='$password',`username`='$username', `ten`='$tenlienhe', `congty`='$congty', `diachi`='$nguoigui_add', `phone`='$nguoigui_phone', `payment_price_type`='$payment_price_type', `payment_price_type_c`='$payment_price_type_c', `payment_price_type_date`='$payment_price_type_date', `accountant_key`='$accountant_key',
			`payment_type`='$congno', `mst`='$mst', `d_m_21`='$d_m_21', `d_m_50`='$d_m_50', `d_m_100`='$d_m_100' WHERE (`id`='".$_GET['id']."')");
			
			
			
			
			mysqli_query($conn,"UPDATE `ns_customer` SET `name`='$nguoigui_name', `province_id`='$nguoigui_tp', `district_id`='$nguoigui_districtid', `ward_id`='$nguoigui_wardid', `address`='$nguoigui_add', `phone`='$nguoigui_phone' WHERE (`id`='$cus_code')");
			### Upload hình
			
			
			
	
          echo'<script> 
               alert("Cập nhật thông tin thành công!");

              </script>
			  
			  
			  
			  ';
		}
	if(isset($_POST['btn_add']))
	{
		$date_start = $_POST['date_start'];
		$date_end = $_POST['date_end'];
		mysqli_query($conn,"INSERT INTO `ksn_discount` (`uid`, `id_dichvu`, `d_m_21`, `d_m_45`, `d_m_100`,`date_start`,`date_end`) VALUES ('".$_GET['id']."', '".$_POST['id_dichvua']."', '".$_POST['d_m_21']."', '".$_POST['d_m_45']."', '".$_POST['d_m_100']."','$date_start','$date_end')");
		
	}
		if(isset($_GET['del']))
	{
		mysqli_query($conn,"DELETE FROM `ksn_discount` WHERE (`id`='".$_GET['del']."')");
	}
		
		
		
		
	@$laydulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$_GET['id']."'"));
	@$sender = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_customer where cus_code='".$laydulieuuser['cus_code']."'"));
?>

<div class="container-fluid">
		<div class="row">	
			<div class="col-md-3">
			
			<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Logo công ty </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#EEE9E9">
			<div class="form-group">
					
					<center><img src="<?php echo '../inbill/inbilltw/'.$laydulieuuser['logo']?>" style="width:280px;height:90px; border:1px solid black; object-fit: contain;background-color:white"></center>
				
				<form action="" method="POST"  enctype="multipart/form-data">
				Cập nhật lại logo
				<input type="file"  class="form-control  custom-file-upload" name="photo" id = "fileSelect">
									<br><button type="submit" name="btn_updatelogo" class="btn btn-danger form-control">Cập nhật logo mới</button>

				</form>
				</div>
				
				</div>
			</div>
			
			<form action="" method="POST" enctype="multipart/form-data">

				<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-unlock-alt"></i> Mã User: <?php echo $laydulieuuser['cus_code'];?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#EEE9E9">
				
				
					
				
				
				<div class="form-group" >
					<label for="">Username</label>
					<input type="text"  name="username" value="<?php echo $laydulieuuser['username']?>" class="form-control" required placeholder="Username" >
					<input type="hidden"  name="cus_code" value="<?php echo $laydulieuuser['cus_code'];?>" class="form-control" required placeholder="Username" readonly>
				</div>
				
				
				<div class="form-group" >
					<label for="">Password</label>
					<input type="<?php if($roleid == 1){ echo'text';} else {echo'password';}?>"  name="password" value="<?php echo $laydulieuuser['password']?>" class="form-control" required placeholder="Password">
				</div>
				
				
				<div class="form-group" >
					<label for="">Key for Accountant</label>
					<input type="text"  name="accountant_key" value="<?php echo $laydulieuuser['accountant_key']?>" class="form-control" required placeholder="Key for Accountant">
				</div>
				
				<div class="form-group" >
					<label for="">CÔNG NỢ</label>
					<select class="form-control" name="congno" required>
					<option value="">Chọn loại công nợ</option>
					<option value="1"<?php if($laydulieuuser['payment_type'] == '1'){ echo'selected';}?>>Công nợ theo ngày</option>
					<option value="2"<?php if($laydulieuuser['payment_type'] == '2'){ echo'selected';}?>>Công nợ theo tuần</option>
					<option value="4"<?php if($laydulieuuser['payment_type'] == '3'){ echo'selected';}?>>Công nợ theo 2 tuần</option>
					<option value="3"<?php if($laydulieuuser['payment_type'] == '3'){ echo'selected';}?>>Công nợ theo tháng</option>
					</select>
				</div>
				<div class="form-group" >
					<label for="">CHỌN BẢNG GIÁ</label>
					<select class="form-control" name="payment_price_type" required>
					<option value="">Chọn bảng giá áp dụng</option>
					<option value="0"<?php if($laydulieuuser['payment_price_type'] != '1'){ echo'selected';}?>>ÁP DỤNG BẢNG GIÁ F0</option>
					<option value="1"<?php if($laydulieuuser['payment_price_type'] == '1'){ echo'selected';}?>>ÁP DỤNG BẢNG GIÁ F1</option>
					
					</select>
				</div>
				
				
				
				<div class="form-group" style="border:5px solid gray; padding:5px;">
					<label for="">SET LỊCH ĐỔI BẢNG GIÁ</label>
					<select class="form-control" name="payment_price_type_c" >
					<option value="">Chọn bảng giá áp dụng</option>
					<option value="0"<?php if($laydulieuuser['payment_price_type_c'] == '0'){ echo'selected';}?>>ÁP DỤNG BẢNG GIÁ F0</option>
					<option value="1"<?php if($laydulieuuser['payment_price_type_c'] == '1'){ echo'selected';}?>>ÁP DỤNG BẢNG GIÁ F1</option>
					Chọn ngày đổi <br><input class="form-control" type="date" id="aa" name="payment_price_type_date" value="<?php echo $laydulieuuser['payment_price_type_date'];?>">
					</select>
				</div>
				
				
				
				
				<!--
				<div class="form-group">
					<label  for="">Upload Logo Công ty </label>
					
					<input type="file" required class="form-control  custom-file-upload" name="imagecongty" id = "imagecongty">
					
				</div>
				-->
				
				
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
					<input type="text"  name="congty" value="<?php echo $laydulieuuser['congty']?>" class="form-control" required placeholder="Tên công ty">
				</div>
				<div class="form-group" >
					<label for="">Tên Liên Hệ (Contact Name)</label>
					<input type="text"  name="tenlienhe" value="<?php echo $laydulieuuser['ten']?>" class="form-control" required placeholder="Tên liên hệ">
				</div>
				<div class="form-group" >
					<label for="">Mã Số Thuế</label>
					<input type="text"  name="mst" value="<?php echo $laydulieuuser['mst']?>" class="form-control" required placeholder="Nhập Mã số thuế">
				</div>
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoigui_phone" value="<?php echo $laydulieuuser['phone']?>" class="form-control" placeholder="Nhập SĐT" required >
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<select class="form-control" id="nguoigui_tp-dropdown" name="nguoigui_tp">
						<option value="">Chọn Tỉnh</option>
						<?php 
							$provinces = mysqli_query($conn,"SELECT * FROM yn_province order by id asc");
							echo '<option value="">Chọn tỉnh/thành phố</option>';
							while ($item = mysqli_fetch_array($provinces,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'"';
								if ($sender['province_id'] == $item['id']) {
									echo ' selected';
								}
								echo '>'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Quận/Huyện</label>
					<select required class="form-control" name="nguoigui_districtid" id="nguoigui_district-dropdown">
						<?php 
							$districts = mysqli_query($conn,"SELECT * FROM yn_district order by id asc");
							echo '<option value="">Chọn quận/huyện</option>';
							while ($item = mysqli_fetch_array($districts,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'"';
								if ($sender['district_id'] == $item['id']) {
									echo ' selected';
								}
								echo '>'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Phường/Xã</label>
					<select required class="form-control" name="nguoigui_wardid" id="nguoigui_ward-dropdown">
						<?php 
							$wards = mysqli_query($conn,"SELECT * FROM yn_ward order by id asc");
							echo '<option value="">Chọn phường/xã</option>';
							while ($item = mysqli_fetch_array($wards,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'"';
								if ($sender['ward_id'] == $item['id']) {
									echo ' selected';
								}
								echo '>'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="form-control" value="<?php  echo $sender['address'];?>" placeholder="Nhập địa chỉ" required>
				</div>
				</div>
				<div class="card-footer">								<button type="submit" name="btn_update" class="btn btn-primary">Cập nhật thông tin</button>
</div>
				</div>
				
				
			</div>
			
			</form>
			
			
			<div class="col-md-4">
			<form action="" method="POST" enctype="multipart/form-data">

			<div class="card card-danger">
			<div class="card-header">
			<h3 class="card-title"><i class="fas fa-user-tag"></i> DISCOUNT cho FWD</h3>
			</div>
			<div class="card-body">
			<?php
			echo'
			<div class="form-group">
					<label for="inputPassword3" class="control-label">Chọn Dịch Vụ Discount<font color=red> * </font></label>
					<select class="form-control" id="nguoinhan_countries-dropdown" name="id_dichvua" required>';
						
							$countries = mysqli_query($conn,"SELECT * FROM ksn_dichvu");
							echo '<option value="">Chọn Dịch Vụ</option>';
							while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'">'.$item['dichvu'].'</option>
								';
							}
					echo'</select>
				</div>';
			?>
			
			<div class="form-group" >
					<label for="">Mức > 21 kg</label>
					<input type="text"  name="d_m_21" value="" class="form-control" required placeholder="số tiền - mức > 21 kg">
			</div>
			
			<div class="form-group" >
					<label for="">Mức > 45kg</label>
					<input type="text"  name="d_m_45" value="" class="form-control" required placeholder="số tiền - mức > 45 kg">
			</div>
			
			<div class="form-group" >
					<label for="">Mức > 100 kg</label>
					<input type="text"  name="d_m_100" value="" class="form-control" required placeholder="số tiền - mức > 100 kg">
			</div>
			<div class="form-group" >
					<label for="">Ngày bắt đầu</label>
					<input type="date" id="aa" name="date_start" required >			
			</div>
			<div class="form-group" >
					<label for="">Ngày kết thúc</label>
					<input type="date" id="aa" name="date_end" required>			
			</div>
			
			
			</div>


<div class="card-footer">								<button type="submit" name="btn_add" class="btn btn-danger">Thêm Discount</button>
</div>
				</div>
				
				
				
				
				
				
				
				
				
			<div class="card card-danger">
			<div class="card-header">
			<h3 class="card-title"><i class="fas fa-user-tag"></i> BẢNG DISCOUNT CHO FWD</h3>
			</div>
			<div class="card-body">
			
			<table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:blue">
		               <tr>
		                  <th style="text-align: center;color:#00a5e4">Dịch Vụ</th>
		                  <th style="text-align: center;color:#00a5e4"> > 21kg</th>
		                  <th style="text-align: center;color:#00a5e4"> > 45kg</th>
		                  <th style="text-align: center;color:#00a5e4"> > 100kg</th>
		                  <th style="text-align: center;color:#00a5e4">Date</th>
		                  <th style="text-align: center;color:#00a5e4"></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_discount where uid='".$_GET['id']."'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
						  	@$dichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='".$item['id_dichvu']."'"));

		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.@$dichvu['dichvu'].'</td>
		                  <td style="text-align: center; color:black">'.$item['d_m_21'].'</td>
		                  <td style="text-align: center; color:black">'.$item['d_m_45'].'</td>
		                  <td style="text-align: center; color:black">'.$item['d_m_100'].'</td>
		                  <td style="text-align: center; color:black">'.$item['date_start'].' - '.$item['date_end'].'</td>
		                  <td><a href="m_admin.php?m=edit_fwd&id='.$_GET['id'].'&del='.@$item['id'].'" style="btn btn-danger btn-sm" onclick="return confirm(\'Xác nhận xóa discount người dùng?\')"><i class="fas fa-trash-alt"></i> </button></form></td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>


				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			</div>

			</div>
			
			
			</form>
		</div>
	</form>
	
</div>
<?php  
?>

<script>
function test(){

var canvas  = document.getElementById("canvas");
var dataURL = canvas.toDataURL();
$.ajax({
			url: "upload_sign.php",
			type: "POST",
			data: {
				imgBase64: dataURL,
			},
			cache: false,
			success: function(result){
				$("#aaaa").html('1234');
			}
		});

}
</script>
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