<?php  
	include('top.php');
	include('../controller/bill.php');
	if (isset($_POST['btn_submit'])) {
		$nguoigui_name = $_POST['nguoigui_name'];
		$nguoigui_phone = $_POST['nguoigui_phone'];
		$nguoigui_tp = $_POST['nguoigui_tp'];
		$nguoigui_districtid = $_POST['nguoigui_districtid'];
		$nguoigui_wardid = $_POST['nguoigui_wardid'];
		$nguoigui_add = $_POST['nguoigui_add'];

		$id_nguoigui = createSender($nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone);

		$nguoinhan_name = $_POST['nguoinhan_name'];
		$nguoinhan_phone = $_POST['nguoinhan_phone'];
		$nguoinhan_countries = $_POST['nguoinhan_countries'];
		$nguoinhan_city = $_POST['nguoinhan_city'];
		$nguoinhan_add = $_POST['nguoinhan_add'];

		$id_nguoinhan = createReceiver($nguoinhan_name,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add);

		$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		$tenhang = $_POST['tenhang'];
		$cannang = $_POST['cannang'];
		$sokien = $_POST['sokien'];
		$giakhaibao = $_POST['giakhaibao'];
		$unitprice = $_POST['giadongia'];
		$giabaohiem = $_POST['giabaohiem'];
		$total = $_POST['gia'];
		$partner = $_POST['partner'];
		$note = $_POST['note'];
		$status = 1;

		createBill($id_nguoigui,$id_nguoinhan,$uid,$date,$datenow2,$tenhang,$cannang,$sokien,$giakhaibao,$unitprice,$giabaohiem,$total,$partner,$status,$note);
		echo'<script> 
				alert("Tạo bill thành công!");
                window.location.href="index_bill.php";
            </script>';

	}
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-3">
				<h5>Thông tin người gửi</h5>
				<hr>
				<div class="form-group" >
					<label for="">Tên </label>
					<input type="text" name="nguoigui_name" class="form-control" placeholder="Tên người gửi">
				</div>
				
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoigui_phone" class="form-control"  placeholder="Nhập SĐT" required>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<select class="form-control" id="nguoigui_tp-dropdown" name="nguoigui_tp">
						<option value="">Chọn Tỉnh</option>
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
					<select required class="form-control" name="nguoigui_districtid" id="nguoigui_district-dropdown">
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Phường/Xã</label>
					<select required class="form-control" name="nguoigui_wardid" id="nguoigui_ward-dropdown">
					</select>
				</div>
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="form-control"  placeholder="Nhập địa chỉ" required>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Đối tác</label>
					<select required class="form-control" name="partner" id="partner-dropdown">
						<option value="">Chọn đối tác</option>
						<?php 
							$partners = mysql_query("SELECT * FROM ns_user WHERE type=10 order by id asc");
							while ($item = mysql_fetch_array($partners)) {
								echo '
								<option value="'.$item['id'].'">'.$item['ctyghitat'].'</option>
								';
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<h5>Thông tin người nhận</h5>
				<hr>
				<div class="form-group" >
					<label for="">Tên </label>
					<input type="text" name="nguoinhan_name" class="form-control" placeholder="Tên người nhận">
				</div>
				
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoinhan_phone" class="form-control"  placeholder="Nhập SĐT" required>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Quốc gia</label>
					<select class="form-control" id="nguoinhan_countries-dropdown" name="nguoinhan_countries">
						<?php 
							$countries = mysql_query("SELECT * FROM ns_countries order by id asc");
							echo '<option value="">Chọn quốc gia</option>';
							while ($item = mysql_fetch_array($countries)) {
								echo '
								<option value="'.$item['id'].'">'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<input type="text" name="nguoinhan_city" class="form-control"  placeholder="Nhập thành phố" required>
					<!-- <select required class="form-control" name="nguoinhan_city" id="nguoinhan_city-dropdown"> -->
					</select>
				</div>
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoinhan_add" class="form-control"  placeholder="Nhập địa chỉ" required>
				</div>
			</div>
			<div class="col-md-6">
				<h5>Thông tin kiện hàng</h5>
				<hr>
				<div class="form-group">
					<label for="">Khai hàng</label>
					<textarea name="tenhang" class="form-control"  rows="3" ></textarea>
				</div>
				<table>
					<td width="50%">
						<div class="form-group" id="kiennho" style="margin-left:20px;white-space:nowrap;">

						</div>
					</td>
				</table>
				<table>
					<tr>
						<td width="33%">
							<div class="form-group">
								<label for="" >Cân nặng</label>
								<input type="number" name="cannang" step="0.01" class="form-control myclass" id="cannang" placeholder="Nhập cân nặng" required>
							</div>
						</td>
						<td width="33%">
							<div class="form-group">
								<label for="">Số kiện</label>
								<input type="text" name="sokien" class="form-control" id="sokien" value="1" placeholder="Nhập số kiện">
							</div>
						</td>
						<td width="33%">
							<div class="form-group">
								<label for="" >Giá trị hàng</label>
								<input type="number" name="giakhaibao" step="0.01" class="form-control myclass" id="giakhaibao" value="0" placeholder="" required>
							</div>
						</td>
					</tr>
				</table>
				<table >
					<tr>
						<td width="50%">
							<div class="form-group">
								<label for="" >Đơn giá </label>
								<input type="number" step="0.01" name="giadongia" class="form-control myclass" id="giadongia" value="0" placeholder="" >
							</div>
						</td>
						<td width=50%>
							<div class="form-group">
								<label for="" >Phí bảo hiểm</label>
								<input type="number" step="0.01"  name="giabaohiem" class="form-control myclass" id="giabaohiem" value="0" placeholder="" >
							</div>
						</td>
					</tr>
				</table>
				<div class="form-group">
					<label for="">Tổng</label>
					<input type="number" step=".01" style= "color:red" name="gia" class="form-control " id="giatong" class="form-control currency" placeholder="" readonly>
				</div>

				<div class="form-group">
					<label  for="">Ghi chú </label>
					<input type="text" name="note" class="form-control" id="" placeholder="Nhập ghi chú">
				</div>
				<button type="submit" name="btn_submit" class="btn btn-success">Tạo</button>
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

	$(".myclass").on("change", function(){
		var value1 = document.getElementById('cannang').value;
		var value2 = document.getElementById('giadongia').value;
		var value4 = document.getElementById('giabaohiem').value;
		// var sum = (parseFloat(value1) * parseFloat(value2)) + parseFloat(value3)  + parseFloat(value4) + parseFloat(value6) -  parseFloat(value5) ;
		var sum = (parseFloat(value1) * parseFloat(value2)) +  parseFloat(value4);
		// $('#giatong').val(parseFloat(sum).toLocaleString('vi', {style : 'currency', currency : 'VND'}));
		$('#giatong').val(parseFloat(sum));


	});

</script>