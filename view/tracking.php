<?php  
	include('top.php');
	if (isset($_POST['btn_submit'])) {
		$awb = $_POST['awb'];
		$date = $_POST['date'];;
		$address = $_POST['address'];
		$status = $_POST['status'];

		mysql_query("INSERT INTO `ns_tracking_shipment` (`awb`, `date`, `address`,`status`)
		VALUES ('$awb','$date', '$address','$status')") or die(mysql_error()); 

		echo'<script> 
			alert("Thêm tracking thành công!");
        </script>';
	}
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-3">
				<h5>Thêm tracking cho Shipment</h5>
				<hr>
				<div class="input-group date">
	               <div class="form-group ">
	               	  <label for="">Chọn ngày tháng năm </label>
	                  <input required placeholder="yyyy-mm-dd" name="date" type="text" class="form-control" id="datepicker2">
	               </div>
	            </div>
	            <div class="form-group" >
					<label for="">Địa chỉ </label>
					<input required type="text" name="address" class="form-control" placeholder="Trạng thái">
				</div>
				<div class="form-group" >
					<label for="">Trạng thái </label>
					<input  required type="text" name="status" class="form-control" placeholder="Trạng thái">
				</div>
				
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Shipment</label>
					<select required class="form-control" name="awb" id="partner-dropdown">
						<option value="">Chọn shipment</option>
						<?php 
							$shipment = mysql_query("SELECT * FROM ns_shipment order by id asc");
							while ($item = mysql_fetch_array($shipment)) {
								echo '
								<option value="'.$item['id'].'">'.$item['awb'].'</option>
								';
							}
						?>
					</select>
				</div>
				<button type="submit" name="btn_submit" class="btn btn-success">Thêm</button>
			</div>
			<div class="col-md-9">
				 <table id="example2" class="table table-hover table-bordered table-striped" data-page-length='50'  data-order='[[0, "desc"]]'>
		            <thead style="color:blue">
		               <tr>
		                  <th style="text-align: center;color:#00a5e4">STT</th>
		                  <th style="text-align: center;color:#00a5e4">AWB</th>
		                  <th style="text-align: center;color:#00a5e4">Date</th>
		                  <th style="text-align: center;color:#00a5e4">Address</th>
		                  <th style="text-align: center;color:#00a5e4">Status</th>
		                  <th style="text-align: center;color:#00a5e4"></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysql_query("SELECT * FROM ns_tracking_shipment");
		               
		               
		               $i = 0;
		               while($item = mysql_fetch_array($data))
		               {  
		                  $getAWB = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_shipment WHERE id='".$item['awb']."'"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$i.'</td>
		                  <td style="text-align: center; color:black">'.$getAWB['awb'].'</td>
		                  <td style="text-align: center; color:black">'.$item['date'].'</td>
		                  <td style="text-align: center; color:black">'.$item['address'].'</td>
		                  <td style="text-align: center; color:black">'.$item['status'].'</td>
		                  <td>
		                  </td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
		</div>
	</form>
	
</div>

<?php  
    include('footer.php');
?>
<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>