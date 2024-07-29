<?php  
	include('top.php');
	include('../controller/bill.php');
	$id = $_GET['id'];
 
	$data = getBillData($id);
	// $sender = getSender($data['id_nguoigui']);
	// $receiver = getReceiver($data['id_nguoinhan']);
	if (isset($_POST['btn_edit'])) {
		// $hiddenSId = $_POST['hiddenSId'];
		// $nguoigui_name = $_POST['nguoigui_name'];
		// $nguoigui_phone = $_POST['nguoigui_phone'];
		// $nguoigui_tp = $_POST['nguoigui_tp'];
		// $nguoigui_districtid = $_POST['nguoigui_districtid'];
		// $nguoigui_wardid = $_POST['nguoigui_wardid'];
		// $nguoigui_add = $_POST['nguoigui_add'];

		// updateSender($hiddenSId,$nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone);

		// $hiddenRId = $_POST['hiddenRId'];
		// $nguoinhan_name = $_POST['nguoinhan_name'];
		// $nguoinhan_phone = $_POST['nguoinhan_phone'];
		// $nguoinhan_countries = $_POST['nguoinhan_countries'];
		// $nguoinhan_city = $_POST['nguoinhan_city'];
		// $nguoinhan_add = $_POST['nguoinhan_add'];

		// updateReceiver($hiddenRId,$nguoinhan_name,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add);

		// $date = date('Y-m-d');
		// $datenow2 = date('Y-m-d H:i:s');
		// $tenhang = $_POST['tenhang'];
		$cannang = $_POST['cannang'];
		$sokien = $_POST['sokien'];
		$giakhaibao = $_POST['giakhaibao'];
		$unitprice = $_POST['giadongia'];
		$giabaohiem = $_POST['giabaohiem'];
		$total = $_POST['gia'];
		$partner = $_POST['partner'];
		//$status = 1;
		$checkboxes = $_POST['catalog'];
	    deletecataloglist($data['id']);
	    foreach ($checkboxes as $chk){
	      updatecataloglist($data['id'], $chk);
	    }
		updateBill($id,$cannang,$unitprice,$giakhaibao,$giabaohiem,$total,$partner);
		echo'<script> 
				alert("Cập nhật bill thành công!");
				window.location.href="index_bill.php";
            </script>';
        

	}
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<h5>Thông tin kiện hàng</h5>
				<hr>
				<div class="form-group">
					<label for="">Khai hàng</label>
					<!-- <textarea name="tenhang" class="form-control"  rows="3" ><?php echo $data['tenhang'] ?></textarea> -->
					<div class="checkbox">
						<?php  
							$catalogs = mysql_query("SELECT * FROM ns_catalog "); 
			                while ($item = mysql_fetch_array($catalogs)) {
			                  $map = mysql_query("SELECT * FROM ns_mapcatalog WHERE id_bill = '".$data['id']."'");
			                  echo '<label><input name="catalog[ ]" value="'.$item['id'].'" type="checkbox" class="c" ';
			                  while ($t = mysql_fetch_array($map)) {
				                  	if ($t['id_catalog'] == $item['id']) {
				                  	echo ' checked';
				                  }
			                  }
			                  
			                  echo '> '.$item['type'].'</label>&nbsp&nbsp&nbsp';
			                }
						?>
					</div>
				</div>
				<table>
					<td width="50%">
						<div class="form-group" id="kiennho" style="margin-left:20px;white-space:nowrap;">

						</div>
					</td>
				</table>
				<table>
					<tr>
						<td width="50%">
							<div class="form-group">
								<label for="" >Cân nặng</label>
								<input type="number" name="cannang" step="0.01" class="form-control myclass" id="cannang" value="<?php echo $data['cannang'] ?>" placeholder="Nhập cân nặng" required>
							</div>
						</td>
						<!-- <td width="33%">
							<div class="form-group">
								<label for="">Số kiện</label>
								<input type="text" name="sokien" class="form-control" id="sokien" value="<?php echo $data['sokien'] ?>" placeholder="Nhập số kiện">
							</div>
						</td> -->
						<td width="50%">
							<div class="form-group">
								<label for="" >Giá trị hàng</label>
								<input type="number" name="giakhaibao" step="0.01" class="form-control myclass" id="giakhaibao" value="<?php echo $data['giakhaibao'] ?>" placeholder="" required>
							</div>
						</td>
					</tr>
				</table>
				<table >
					<tr>
						<td width="50%">
							<div class="form-group">
								<label for="" >Đơn giá </label>
								<input type="number" step="0.01" name="giadongia" class="form-control myclass" id="giadongia" value="<?php echo $data['unitprice'] ?>" placeholder="" >
							</div>
						</td>
						<td width=50%>
							<div class="form-group">
								<label for="" >Phí bảo hiểm</label>
								<input type="number" step="0.01"  name="giabaohiem" class="form-control myclass" id="giabaohiem" value="<?php echo $data['giabaohiem'] ?>" placeholder="" >
							</div>
						</td>
					</tr>
				</table>
				<div class="form-group">
					<label for="">Tổng</label>
					<input type="number" step=".01" style= "color:red" name="gia" class="form-control " id="giatong" class="form-control currency" value="<?php echo $data['total'] ?>" placeholder="" readonly>
				</div>

				<div class="form-group">
					<label  for="">Ghi chú </label>
					<input type="text" name="note" class="form-control" id="" <?php echo $data['note'] ?> placeholder="Nhập ghi chú">
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Đối tác</label>
					<select required class="form-control" name="partner" id="partner-dropdown">
						<option value="">Chọn đối tác</option>
						<?php 
							$partners = mysql_query("SELECT * FROM ns_user WHERE roleid=4 order by id asc");
							while ($item = mysql_fetch_array($partners)) {
								echo '
								<option value="'.$item['id'].'"';
								if ($data['id_partner'] == $item['id']) {
									echo ' selected';
								}
								echo '>'.$item['ctyghitat'].'</option>
								';
							}
						?>
					</select>
				</div>
				<button type="submit" name="btn_edit" class="btn btn-warning">Sửa</button>
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