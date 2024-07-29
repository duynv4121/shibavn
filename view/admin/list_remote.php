<?php  
	if (isset($_POST['btn_submit'])) {
		$name = $_POST['name'];
		$state_code = $_POST['state_code'];

		mysqli_query($conn,"INSERT INTO `ksn_au_remote` (`post_code`, `state_code`, `note`) VALUES ('$name', '$state_code', 'remote')") or die(mysql_error()); 

		// echo'<script> 
		// 	alert("Thu tiền ngoài bill thành công!");
  //       </script>';
	}
	if (isset($_POST['btn_update'])) {
		$tenmathang = $_POST['update_tenmathang'];
		$type = $_POST['update_type'];
		$price = $_POST['update_price'];

		mysqli_query($conn,"UPDATE `ksn_listphuthu` SET `tenmathang`='$tenmathang', `type`='$type', `price`='$price' WHERE (`id`='".$_GET['edit']."')") or die(mysql_error()); 

		// echo'<script> 
		// 	alert("Thu tiền ngoài bill thành công!");
  //       </script>';
	}
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-3">
			
				<div class="card card-dark">
	


<?php
if(isset($_GET['edit']))
			{
				
			$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_listphuthu where id='".$_GET['edit']."'"));
	
			echo'	
			<div class="card-header">
			<h3 class="card-title">Sửa thông tin hàng hóa</h3>
			</div>
			<div class="card-body">
			<div class="form-group" >
							
							<label for="">Tên mặt hàng </label>
								<input  required type="text" name="update_tenmathang" value="'.$laydulieu['tenmathang'].'" required class="form-control" placeholder="">
							</div>
							<div class="form-group" >
								<label for="">Type(Pcs,Kg,...) </label>
								<input  required type="text" name="update_type" value="'.$laydulieu['type'].'" class="form-control" required placeholder="">
							</div>
							<div class="form-group" >
								<label for="">Giá phụ thu </label>
								<input  required type="number" name="update_price" value="'.$laydulieu['price'].'" class="form-control" placeholder="">
							</div></div>
			<div class="card-footer">
							<button type="submit" name="btn_update" class="btn btn-dark">Sửa thông tin</button>
			</div>
			';
			}else
			{
			echo'	
<div class="card-header">
<h3 class="card-title">THÊM KHU VỰC REMOTE</h3>
</div>
<div class="card-body">
<div class="form-group" >
					<label for="">POST CODE</label>
					<input  required type="text" name="name" required class="form-control" placeholder="">
				</div>
				<div class="form-group" >
					<label for="">STATE CODE</label>
					<input  required type="text" name="state_code" class="form-control" required placeholder="">
				</div>
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-dark">Thêm REMOTE</button>
</div>
';	
				
				
			}

?>



</div>
			
			
			
				<h5></h5>
				<hr>
			
	         
				
				
			</div>
			<div class="col-md-9">
         <table id="example3" class="table table-hover table-bordered table-striped" data-page-length='50'  data-order='[[0, "asc"]]' width=100%>
		            <thead style="color:blue">
		               <tr>
		                  <th style="text-align: center;color:#00a5e4">ID</th>
		                  <th style="text-align: center;color:#00a5e4">POST CODE</th>
		                  <th style="text-align: center;color:#00a5e4">STATE CODE</th>
		                  <th style="text-align: center;color:#00a5e4">Details</th>
		                  <th style="text-align: center;color:#00a5e4">Chức năng</th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_au_remote");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                 
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$item['post_code'].'</td>
		                  <td style="text-align: center; color:black">'.$item['state_code'].'</td>
		                  <td style="text-align: center; color:black">remote</td>
		                  <td>
						  
						 <!-- <a href="m_admin.php?m=item&edit='.$item['id'].'"><i class="fas fa-edit"></i> Edit</a>-->
						  
						  
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
?>


