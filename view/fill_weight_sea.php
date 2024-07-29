<?php  
	include('top.php');
	include('../controller/bill.php');
	$id = $_GET['id'];
	// $data = getBillData($id);
	if (isset($_POST['btn_submit'])) {
		$cannang_thuong = $_POST['cannang_thuong'];
		$cannang_mp = $_POST['cannang_mp'];
		$cannang_tp = $_POST['cannang_tp'];
	   	if ($cannang_thuong + $cannang_mp + $cannang_tp <= 0) {
	   		echo '
				<script>
					alert("Chưa nhập cân nặng cho từng loại hàng!");
				</script>
			';
	   	}else{
	   		mysql_query("UPDATE `ns_package_sea` SET `cannang_thuong`='$cannang_thuong', `cannang_mp`='$cannang_mp', `cannang_tp`='$cannang_tp' WHERE id = '$id'") or die(mysql_error());
	   		echo '
				<script>
					window.location = "create_sub_package_sea.php?id='.$id.'";
				</script>
			';
	   	}
	}
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<h5>Nhập cân nặng từng loại hàng (SEA)</h5>
				<hr>
				<table>
					<tr>
						<td width="100%">
							<div class="form-group">
								<label for="" >Cân nặng hàng thường</label>
								<input type="number" name="cannang_thuong" step="0.01" class="form-control myclass" id="cannang" placeholder="Nhập cân hàng thường nặng" >
							</div>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<div class="form-group">
								<label for="" >Cân nặng mỹ phẩm</label>
								<input type="number" name="cannang_mp" step="0.01" class="form-control myclass" id="cannang" placeholder="Nhập cân nặng mỹ phẩm" >
							</div>
						</td>
					</tr>
					<tr>
						<td width="100%">
							<div class="form-group">
								<label for="" >Cân nặng thực phẩm</label>
								<input type="number" name="cannang_tp" step="0.01" class="form-control myclass" id="cannang" placeholder="Nhập cân nặng thực phẩm" >
							</div>
						</td>
					</tr>
				</table>
				
				<button type="submit" name="btn_submit" class="btn btn-success">Lưu</button>
			</div>
			<div class="col-md-3"></div>
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

	// $(".myclass").on("change", function(){
	// 	var value1 = document.getElementById('cannang').value;
	// 	var value2 = document.getElementById('giadongia').value;
	// 	var value4 = document.getElementById('giabaohiem').value;
		// var sum = (parseFloat(value1) * parseFloat(value2)) + parseFloat(value3)  + parseFloat(value4) + parseFloat(value6) -  parseFloat(value5) ;
		// var sum = (parseFloat(value1) * parseFloat(value2)) +  parseFloat(value4);
		// $('#giatong').val(parseFloat(sum).toLocaleString('vi', {style : 'currency', currency : 'VND'}));
	// 	$('#giatong').val(parseFloat(sum));


	// });

</script>