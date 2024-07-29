<?php  
	if (isset($_POST['btn_submit'])) {
		$tenmathang = $_POST['tenmathang'];
		$type = $_POST['type'];
		$price = $_POST['price'];

		mysqli_query($conn,"INSERT INTO `ksn_listphuthu` (`tenmathang`, `type`, `price`) VALUES ('$tenmathang', '$type', '$price')") or die(mysql_error()); 

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
<h3 class="card-title">Thêm Tên Hàng Hóa</h3>
</div>
<div class="card-body">
<div class="form-group" >
					<label for="">Tên mặt hàng </label>
					<input  required type="text" name="tenmathang" required class="form-control" placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Type(Pcs,Kg,...) </label>
					<input  required type="text" name="type" class="form-control" required placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Giá phụ thu </label>
					<input  required type="number" name="price" class="form-control" placeholder="">
				</div></div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-dark">Thêm Hàng Phụ Thu</button>
</div>
';	
				
				
			}

?>



</div>
			
			
			
				<h5></h5>
				<hr>
			
	         
				
				
			</div>
			<div class="col-md-9">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:blue">
		               <tr>
		                  <th style="text-align: center;color:#00a5e4">ID</th>
		                  <th style="text-align: center;color:#00a5e4">Tên mặt hàng</th>
		                  <th style="text-align: center;color:#00a5e4">Type</th>
		                  <th style="text-align: center;color:#00a5e4">Giá Phụ Thu</th>
		                  <th style="text-align: center;color:#00a5e4">Chức năng</th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_listphuthu");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                 
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$item['tenmathang'].'</td>
		                  <td style="text-align: center; color:black">'.$item['type'].'</td>
		                  <td style="text-align: center; color:black">'.number_format($item['price']).'/'.$item['type'].'</td>
		                  <td><a href="m_admin.php?m=item&edit='.$item['id'].'"><i class="fas fa-edit"></i> Edit</a></td>
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
<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>