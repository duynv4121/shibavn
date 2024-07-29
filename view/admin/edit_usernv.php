<?php  
	

	if (isset($_POST['btn_submit'])) {
		
		
		
		
		
		$username = trim($_POST['username']);
		$password = $_POST['password'];
		@$congty = $_POST['congty'];
		$tenlienhe = $_POST['tenlienhe'];
		$kg_chinhanh = $_POST['kg_chinhanh'];
		@$mst = $_POST['mst'];
		$ctyghitat = strtoupper($congty);
		
			$nguoigui_phone = $_POST['nguoigui_phone'];

			$nguoigui_add = $_POST['nguoigui_add'];
			@$website = $_POST['website'];
			@$img_sign = $_POST['img_sign'];

           
			
			@$idusera = $laysoid['id'];
			
			@$nguoigui_name = $_POST['congty'];
			@$nguoigui_tp = $_POST['nguoigui_tp'];
			@$nguoigui_districtid = $_POST['nguoigui_districtid'];
			@$nguoigui_wardid = $_POST['nguoigui_wardid'];
			@$roleid = $_POST['roleid'];
			@$hanmuc = $_POST['hanmuc'];
			
			
			mysqli_query($conn,"UPDATE `ns_user` SET `username`='$username', `password`='$password', `hanmuc`=`hanmuc`+'$hanmuc', `roleid`='$roleid', `ten`='$tenlienhe', `diachi`='$nguoigui_add', `phone`='$nguoigui_phone', `img_sign`='$img_sign' , `kg_chinhanh`='$kg_chinhanh' WHERE (`id`='".$_GET['id']."')");
			### Upload hình
			
			
			
	
          echo'<script> 
               alert("Cập nhật thông tin thành công!");

              </script>
			  
			  
			  
			  ';
		}
		
		
		
		
	
	@$laydulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$_GET['id']."'"));
	@$sender = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_customer where cus_code='".$laydulieuuser['cus_code']."'"));
	
	
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
					<input type="text"  name="username" value="<?php echo $laydulieuuser['username'];?>" class="form-control"  required placeholder="Username">
					<input type="hidden"  name="img_sign" value="<?php echo $laydulieuuser['img_sign'];?>" class="form-control" readonly required placeholder="Username">
				</div>
				<div class="form-group" >
					<label for="">Password</label>
					<input type="<?php if($roleid == 1){ echo'text';} else {echo 'password';}?>"  name="password" value="<?php echo $laydulieuuser['password'];?>" class="form-control" required placeholder="Password">
				</div>
				
				<div class="form-group" >
					<label for="">CHỨC VỤ</label>
					<select class="form-control" name="roleid" required>
					<option value="">Chọn chức vụ nhân viên</option>
					<option value="3" <?php if($laydulieuuser['roleid'] == '3'){ echo'selected';}?>>Accountant</option>
					<option value="4" <?php if($laydulieuuser['roleid'] == '4'){ echo'selected';}?>>Document Staff</option>
					<option value="5" <?php if($laydulieuuser['roleid'] == '5'){ echo'selected';}?>>OPS & PICKUP</option>
					<option value="6" <?php if($laydulieuuser['roleid'] == '6'){ echo'selected';}?>>Salesman</option>
					</select>
				</div>
				<?php
				if($laydulieuuser['roleid'] == '6'){ echo'<div class="form-group" >
				- Hạn mức còn lại : '.number_format($laydulieuuser['hanmuc']).' đ
					<label for="">Nhập số tiền hạn mức + thêm cho Sales</label>
					<input type="text"  name="hanmuc" id="tezznlienhe" value="0" class="form-control" required placeholder="Nhập số tiền hạn mức + thêm">
				</div>';}
				else
				{
					echo'<input type="hidden"  name="hanmuc" id="zzz" value="0" class="form-control" value= "0"required placeholder="">';
				}
				?>				
				<div class="form-group">

				<label for="" class="control-label">Chọn chi nhánh</label>
					<select required class="form-control" name="kg_chinhanh" id="">';
					
							<option value="HCM" <?php if($laydulieuuser['kg_chinhanh'] == 'HCM'){ echo'selected';}?>>HCM</option>
							<option value="HN" <?php if($laydulieuuser['kg_chinhanh'] == 'HN'){ echo'selected';}?>>HN</option>
							<option value="DAD" <?php if($laydulieuuser['kg_chinhanh'] == 'DAD'){ echo'selected';}?>>DAD</option>
			
				</select>
				</div>
			
				<div class="form-group" >
					<label for="">Tên Liên Hệ (Contact Name)</label>
					<input type="text"  name="tenlienhe" id="tenlienhe" value="<?php echo $laydulieuuser['ten'];?>" class="form-control" required placeholder="Tên liên hệ">
				</div>
				
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoigui_phone" class="form-control" value="<?php echo $laydulieuuser['phone'];?>"  placeholder="Nhập SĐT" required >
				</div>
				
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="form-control" value="<?php echo $laydulieuuser['diachi'];?>"   placeholder="Nhập địa chỉ" >
				</div>
				
				</div>
				</div>
			
			</div>
			
			
			
			<div class="col-md-4">
				
				
				
				
					<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i>MẪU CHỮ KÝ NHÂN VIÊN</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#EEE9E9">
				
				
				<img src="<?php echo $laydulieuuser['img_sign'];?>">

			
				</div>
				                

				</div>
				
				
			</div>
			
			
			
			
			
			
			<div class="col-md-4">
				
				
				
				
					<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i>Sửa mẫu chữ ký cho nhân viên</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#EEE9E9">
				
				
				
				
				
				<!--<div class="form-group" >
					<label for="">Tên Công Ty (Company Name)</label>
					<input type="text"  name="hidden" value="GPE EXPRESS" class="form-control" required placeholder="Tên công ty">
				</div>
				-->
				
				
				
				
				<p>Ký tên bên dưới</p>
			<div id="canvas">
				Trình duyệt không hỗ trợ
			</div>
		
			<script>
				zkSignature.capture();
			</script>

			<button type="button"  class="btn btn-danger btn-sm" onclick="zkSignature.clear()">
				Ký Lại
			</button>
			
			<button type="button" class="btn btn-danger btn-sm" onclick="zkSignature.save()">
				Tạo Chữ Ký
			</button>
			
			<div id="aaaa">
			</div>

			
				</div>
				                <div class="card-footer" >				<button type="submit" name="btn_submit" onclick="zkSignature.send()" class="btn btn-primary" >Cập nhật thông tin</button>

								</div>

				</div>
				
				
			</div>
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