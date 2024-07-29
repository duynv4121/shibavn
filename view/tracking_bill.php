<?php  
	include('top.php');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	
	
	if (isset($_POST['btn_update'])) {
		$id_tracking = $_POST['id_tracking'];
		
		if($id_tracking == 0)
			
			{
			mysqli_query($conn,"UPDATE `ns_listhoadon` SET `billketnoi`='', `hangketnoi`='' WHERE (`id_code`='$id')");

			}
			else
			{
		$url = 'http://GPE.online/view/tracking/test.php?id='.$id_tracking;
		$jsona =file_get_contents($url);
		
		$jsonb = trim($jsona,"1");
		
		$arr = json_decode($jsonb, true);
		
		foreach($arr['data'] as $result) {
		
		
		$status = 'On forward for delivery';
		
		
		
				$tenhang = $result['name'];
				$tencode = $result['code'];
				if($result['code'] == 'yunda')
				{
					$tenhang = 'TOLL Global';
					$tencode = 'toll';
				}
		$address = 'Connect with '.$tenhang;
		mysqli_query($conn,"INSERT INTO `ns_tracking_bill` (`id_hoadon`, `date`, `address`,`status`)VALUES ('$id','$datenow', '$address','$status')") or die(mysql_error());
		mysqli_query($conn,"UPDATE `ns_listhoadon` SET `billketnoi`='$id_tracking', `hangketnoi`='$tencode' WHERE (`id_code`='$id')");
		
		
		
		
		$url = 'https://api.tracktry.com/v1/trackings/post';

		// Create a new cURL resource
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// Setup request to send json via POST
		$dataa = array(
			"tracking_number" => $id_tracking,
			"carrier_code"=> $tencode
		);
		$payload = json_encode($dataa);





		// Attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

		// Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		'Tracktry-Api-Key: 85b48be2-80ea-4262-be38-5112c844715e'));


		// Return response instead of outputting

		// Execute the POST request
		$resultc = curl_exec($ch);

		// Close cURL resource
		curl_close($ch);
		
		
		
		break;
		}
		

			}
		
		
	}

	if (isset($_POST['btn_submit'])) {
		$id_hoadon = $_POST['idbill'];
		$date = $_POST['date'];
		$address = $_POST['address'];
		$status = $_POST['status'];

		mysqli_query($conn,"INSERT INTO `ns_tracking_bill` (`id_hoadon`, `date`, `address`,`status`,`check`)
		VALUES ('$id_hoadon','$date', '$address','$status','1')") or die(mysql_error()); 



		echo'<script> 
			alert("Tracking added successfully!");
        </script>';
	}	
	
	if (isset($_POST['btn_edittrack'])) {
		$id_hoadon = $_POST['idbill'];
		$date = $_POST['date'];
		$address = $_POST['address'];
		$status = $_POST['status'];

		mysqli_query($conn,"UPDATE `ns_tracking_bill` SET `address`='$address', `status`='$status', `date`='$date' WHERE (`id`='".trim($_GET['edit'])."')") or die(mysql_error()); 



		echo'<script> 
			alert("Chỉnh sửa thành công!");
        </script>';
	}	
	
	
	$laythongtinkien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$_GET['id']."'"));

?>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
			
			
			
			
				<div class="card card-dark">
<div class="card-header">
<h3 class="card-title">Add tracking cho Kiện Hàng</h3>
</div><?php
					
?>
<div class="card-body">
								<!--
								<form action="" method="POST">
								
	         <div class="row">
			 <div style="col-md-10"><div class="form-group" >
					<input type="text"  name="id_tracking" class="form-control" value="<?php echo $laythongtinkien['billketnoi']?>" placeholder="Nhập mã tracking">
				</div>
			</div>
			<div style="col-md-2">&nbsp;
			<button type="submit" name="btn_update" class="btn btn-dark" >Update</button>
			</form>
			</div>			

			 </div>-->
									<form action="" method="POST">

				<hr>
				
				<?php 
				if(isset($_GET['edit']))
				{
					$laythongtinrow = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_tracking_bill where id='".$_GET['edit']."'"));
					echo'<font color=red>Chỉnh sửa thông tin tracking</font>';
					echo'
				<div class="input-group date">
	               <div class="form-group ">
	               	  <label for="">Select date time</label>
						<input type="datetime-local" name="date" value="'.$laythongtinrow['date'].'" required="" class="form-control ">
	               </div>
	            </div>
				<div class="form-group" >
					<label for="">ID kiện hàng </label>';
						if (isset($_GET['id'])) {
							echo '<input type="text" name="idbill" readonly class="form-control" value="'.$id.'" placeholder="ID BILL">';
						}else{
							echo '<input type="text" required name="idbill" class="form-control" value="" placeholder="ID BILL">';
						}
					echo'
					
				</div>
				<div class="form-group" >
					<label for="">Address </label>
					<input type="text" required name="address"  value="'.$laythongtinrow['address'].'" class="form-control" placeholder="Address">
				</div>
				<div class="form-group" >
					<label for="">Status </label>
					<input type="text" required name="status"  value="'.$laythongtinrow['status'].'" class="form-control" placeholder="Status">
				</div>
				
				
								
								</div>
				<div class="card-footer">
								<button type="submit" name="btn_edittrack" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button>
				</div>
				</div>
				';
				echo'			</div>';
			
				}
				else
				{
				echo'
				<div class="input-group date">
	               <div class="form-group ">
	               	  <label for="">Select date time</label>
						<input type="datetime-local" name="date" required="" class="form-control ">
	               </div>
	            </div>
				<div class="form-group" >
					<label for="">ID kiện hàng </label>';
						if (isset($_GET['id'])) {
							echo '<input type="text" name="idbill" readonly class="form-control" value="'.$id.'" placeholder="ID BILL">';
						}else{
							echo '<input type="text" required name="idbill" class="form-control" value="" placeholder="ID BILL">';
						}
					echo'
					
				</div>
				<div class="form-group" >
					<label for="">Address </label>
					<input type="text" required name="address" class="form-control" placeholder="Address">
				</div>
				<div class="form-group" >
					<label for="">Status </label>
					<input type="text" required name="status" class="form-control" placeholder="Status">
				</div>
				
				
								
								</div>
				<div class="card-footer">
								<button type="submit" name="btn_submit" class="btn btn-dark">Thêm Trạng Thái Tracking</button>
				</div>
				</div>
				';
				echo'			</div>';
			
			
				}
				?>
			
				
				
				
				
				
				
				
				
				
				
				
				
				
			<div class="col-md-9">
				 <table id="example2" class="table  table-bordered"  style="font-size:15px" data-page-length='50'  data-order='[[0, "desc"]]' width=100%>
		            <thead style="color:blue">
		               <tr>
		                  <th style="text-align: center;color:#00a5e4">NO</th>
		                  <th style="text-align: center;color:#00a5e4">ID</th>
		                  <th style="text-align: center;color:#00a5e4">Date</th>
		                  <th style="text-align: center;color:#00a5e4">Address</th>
		                  <th style="text-align: center;color:#00a5e4">Status</th>
		                  <th style="text-align: center;color:#00a5e4"></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ns_tracking_bill where id_hoadon='$id' order by date desc");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  // $getAWB = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_shipment WHERE id='".$item['awb']."'"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$i.'</td>
		                  <td style="text-align: center; color:black"><a href="https://tscpost.com/?id='.$item['id_hoadon'].'">'.$item['id_hoadon'].'</td>
		                  <td style="text-align: center; color:black">'.$item['date'].'</td>
		                  <td style="text-align: center; color:black">'.$item['address'].'</td>
		                  <td style="text-align: center; color:black">'.$item['status'].'</td>
		                  <td>
		                  <a href="delete_tracking_bill.php?id='.$item['id'].'" type="button"  onclick="return confirm(\'Bạn có chắc chắn xóa dòng tracking này ?\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
		                  <a href="tracking_bill.php?id='.$item['id_hoadon'].'&edit='.$item['id'].'" type="button"  class="btn btn-warning"><i class="fas fa-edit"></i> </a>
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
	  search:false;
      "aaSorting": [],
	  
   })
</script>