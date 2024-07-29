<?php  
	include('top.php');
	
	if (isset($_GET['codesea'])) {
		$code = $_GET['codesea'];
	}
	if (isset($_GET['codeair'])) {
		$code = $_GET['codeair'];
	}
	if (isset($_POST['btn_submit'])) {
		$nguoigui_name = $_POST['nguoigui_name'];
		$nguoigui_phone = $_POST['nguoigui_phone'];
		$nguoigui_tp = $_POST['nguoigui_tp'];
		$nguoigui_districtid = $_POST['nguoigui_districtid'];
		$nguoigui_wardid = $_POST['nguoigui_wardid'];
		$nguoigui_add = $_POST['nguoigui_add'];
		$nguoigui_code = $_POST['nguoigui_code'];
		$check = mysql_num_rows(mysql_query("SELECT * FROM ns_customer WHERE cus_code ='$nguoigui_code'"));
		if ($check != 0) {
			echo 'Đã có khách hàng này rồi!';
		}else{
			mysql_query("INSERT INTO `ns_customer` (`name`,`cus_code`, `province_id`, `district_id`, `ward_id`,`address`,`phone`)
			VALUES ('$nguoigui_name','$nguoigui_code','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone')") or die(mysql_error()); 
			if (isset($_GET['codesea'])) {
				echo'<script> 
					alert("Tạo khách hàng thành công!");
	                window.location.href="create_package_sea.php?code='.$code.'";
	            </script>';
			}
			if (isset($_GET['codeair'])) {
				echo'<script> 
					alert("Tạo khách hàng thành công!");
	                window.location.href="create_package.php?code='.$code.'";
	            </script>';
			}
			
		}
	}
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-4">
				<h5>Thông tin khách hàng</h5>
				<hr>
				<div class="form-group" >
					<label for="">Mã khách hàng </label>
					<input type="text" readonly name="nguoigui_code" hidden class="form-control" value="<?php  echo $code;?>" placeholder="Mã khách hàng">
				</div>
				<div class="form-group" >
					<label for="">Tên </label>
					<input type="text"  name="nguoigui_name" value="<?php  echo $_GET['codeair'];?>" class="form-control" required placeholder="Tên khách hàng" readonly>
				</div>
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoigui_phone" class="form-control" placeholder="Nhập SĐT" >
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<select class="form-control" id="nguoigui_tp-dropdown" name="nguoigui_tp">
						<?php 
							$provinces = mysql_query("SELECT * FROM yn_province order by id asc");
							echo '<option value="">Chọn tỉnh/thành phố</option>';
							while ($item = mysql_fetch_array($provinces)) {
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
				<button type="submit" name="btn_submit" class="btn btn-danger">Tạo</button>
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