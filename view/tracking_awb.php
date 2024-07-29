<?php  
	include('top.php');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	
	
	$laydulieumawb = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_shipment where id='$id' "));


	

	if (isset($_POST['btn_submit'])) {
		$date = $_POST['date'];
		$address = $_POST['address'];
		$status = $_POST['status'];

		mysqli_query($conn,"INSERT INTO `ns_tracking_shipment` (`id_awb`, `date`, `address`, `status`) VALUES ('$id','$date', '$address', '$status')") or die(mysql_error()); 
		
		$laydulieukiena = mysqli_query($conn,"select * from ksn_shipment_details where awb='$id'");
		while($laydulieukien = mysqli_fetch_array($laydulieukiena))
		{
			mysqli_query($conn,"INSERT INTO `ns_tracking_bill` (`id_hoadon`, `address`, `status`, `date`)
			VALUES ('".$laydulieukien['id_listhoadon']."', '$address', '$status', '$date')");
		}

		

		echo'<script> 
			alert("Tracking added successfully!");
        </script>';
	}
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
			
			
			
			
				<div class="card card-dark">
<div class="card-header">
<h3 class="card-title">Add tracking cho Mã MAWB: <?php echo $laydulieumawb['awb']?></h3>
</div><?php
					
?>
<div class="card-body">
								<form action="" method="POST">

	        
				<div class="input-group date">
	               <div class="form-group ">
	               	  <label for="">Select date time</label>
						<input type="datetime-local" name="date" required="" class="form-control ">
	               </div>
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
			
			
			
			
			
				
				
				
				
				
				
				
				
				
				
				
				
				
			</div>
			<div class="col-md-9">
				 <table id="example2" class="table  table-bordered"  style="font-size:15px" data-page-length='50'  data-order='[[0, "desc"]]' width=100%>
		            <thead style="color:blue">
		               <tr>
		                  <th style="text-align: center;color:#00a5e4">NO</th>
		                  <th style="text-align: center;color:#00a5e4">Date</th>
		                  <th style="text-align: center;color:#00a5e4">Address</th>
		                  <th style="text-align: center;color:#00a5e4">Status</th>
		                  <th style="text-align: center;color:#00a5e4"></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ns_tracking_shipment where id_awb='$id' order by date desc");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  // $getAWB = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_shipment WHERE id='".$item['awb']."'"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$i.'</td>
		                  <td style="text-align: center; color:black">'.$item['date'].'</td>
		                  <td style="text-align: center; color:black">'.$item['address'].'</td>
		                  <td style="text-align: center; color:black">'.$item['status'].'</td>
		                  <td>
		                  <a href="delete_tracking_awb.php?id='.$item['id'].'" type="button"  onclick="return confirm(\'Bạn có chắc chắn xóa dòng tracking này ?\')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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