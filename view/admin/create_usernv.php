<?php  
	

	if(isset($_POST['btn_submit'])) {
		
		
		
		
		
		$username =  $conn->real_escape_string(trim($_POST['username']));
		$password =  $conn->real_escape_string($_POST['password']);
		@$congty =  $conn->real_escape_string($_POST['congty']);
		$kg_chinhanh =  $conn->real_escape_string($_POST['kg_chinhanh']);
		$tenlienhe =  $conn->real_escape_string($_POST['tenlienhe']);
		$payment_price_type = '3';
		@$mst = $_POST['mst'];
		$ctyghitat = strtoupper($congty);
		$count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ns_user WHERE username = '$username'"));
		if ($count != 0) {
          echo'<script> 
            alert("Đã có user nhân viên này!");
           </script>';
		}else{
			
			
	
				if($roleid == 3)
			{
				$active = 1;
			}else
			{
				$active ='';
			}
			
			
			
			$nguoigui_phone = $_POST['nguoigui_phone'];

			$nguoigui_add = $_POST['nguoigui_add'];
			@$website = $_POST['website'];
			$congno = $_POST['congno'];
			$roleid = $_POST['roleid'];
			@$img_sign = $_POST['img_sign'];

            mysqli_query($conn,"INSERT INTO `ns_user` (`username`, `password`,`ten`,`congty`,`roleid`,`ctyghitat`,`phone`,`diachi`,`img_sign`,`created_at`,`kg_chinhanh`,`active`)
            VALUES ('$username','$password','$tenlienhe', 'SHIBA EXPRESS', $roleid, 'SHIBA EXPRESS','$nguoigui_phone','$nguoigui_add','$img_sign','$datenow','$kg_chinhanh','$active')") or die(mysqli_error()); 
			
			
			
			
			$laysoid = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where username='$username'"));
			
			if($laysoid['roleid'] == 6)
			{
				mysqli_query($conn,"UPDATE `ns_user` SET `hanmuc`='20000000' WHERE (`username`='$username')");
			}

			
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
				VALUES ('$nguoigui_name','$nguoigui_code','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone','0')") or die(mysqli_error()); 
				mysqli_query($conn,"UPDATE `ns_user` SET `cus_code`='$nguoigui_code' WHERE (`id`='$idusera')");
			
			
			
			### Upload hình
			
			
			
	
          echo'<script> 
               alert("Tạo tài khoản nhân viên thành công!");
							window.location = "m_admin.php?m=user";

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
					<label for="">CHỨC VỤ</label>
					<select class="form-control" name="roleid" required>
					<option value="">Chọn chức vụ nhân viên</option>
					<option value="3">Accountant</option>
					<option value="4">Document Staff</option>
					<option value="5">OPS & PICKUP</option>
					<option value="6">Salesman</option>
					</select>
				</div>
				<?php
				echo'
				<div class="form-group">

				<label for="" class="control-label">Chọn chi nhánh</label>
					<select required class="form-control" name="kg_chinhanh" id="">';
					
							echo '<option value="HCM" selected>HCM</option>';
							echo '<option value="HN">HN</option>';
							echo '<option value="DAD">DAD</option>';
			
					echo'</select>
				</div>';
				?>
				<div class="form-group" >
					<label for="">Tên Liên Hệ (Contact Name)</label>
					<input type="text"  name="tenlienhe" id="tenlienhe" value="" class="form-control" required placeholder="Tên liên hệ">
				</div>
				
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoigui_phone" class="form-control" placeholder="Nhập SĐT" required >
				</div>
				
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="form-control"  placeholder="Nhập địa chỉ" >
				</div>
				
				</div>
				</div>
			
			</div>

			<div id="wrapper1">
					<p>Ký tên bên dưới</p><hr>
			<div id="canvas">
				Trình duyệt không hỗ trợ
			</div>
		
			<script>
				zkSignature.capture();
			</script>
            <br>
			<button type="button"  class="btn btn-danger btn-sm" onclick="zkSignature.clear()">
				Ký Lại
			</button>
			
			<button type="button" class="btn btn-danger btn-sm" onclick="zkSignature.save()">
				Tạo Chữ Ký
			</button>
			
				<hr>			<center>
	<button type="submit" name="btn_submit" onclick="zkSignature.send()" class="btn btn-primary" >Tạo Tài Khoản </button></center>
<br>

<font color=red>Lưu ý *: Nhập Tên Liên Hệ trước sau đó ấn 'Tạo chữ ký' để hoàn thành bước tạo chữ ký 
			</div>
			<div class="col-md-4">
				
					<div id="aaaa" style="">
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