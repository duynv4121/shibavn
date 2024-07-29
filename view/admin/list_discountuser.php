<?php  
	if (isset($_POST['btn_submit'])) {
		
		
		$id_user = $_POST['id_user'];
		mysqli_query($conn,"UPDATE `ns_user` SET `discount`='1' WHERE (`id`='".$id_user."')");
	
	}
	
	if (isset($_POST['btn_delete'])) {
		
		
		$delete = $_POST['delete'];
		mysqli_query($conn,"UPDATE `ns_user` SET `discount`='0' WHERE (`id`='".$delete."')");
	
	}
	
	
	
	
	
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
			
				<div class="card card-dark">

			
			
			<?php
			
			
			
			echo'<div class="card-header">
<h3 class="card-title">Thêm User Sử Dụng Dịch Vụ KM</h3>
</div>	<form action="" method="POST">

	         <div class="card-body">

			
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Chọn User<font color=red> * </font></label>
					<select class="form-control select2bs4" id="nguoinhan_countries-dropdown" name="id_user" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where roleid='6' OR roleid='2'");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['username'].' ['.$item['congty'].']</option>
								';
							}
					echo'</select>
				</div>
				
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-danger">Thêm User dùng Khuyến Mãi</button>	

</div></form>
</div>			';

			
			
			?>
			

			
				
				
			
				DỊCH VỤ KHUYẾN MÃI
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:blue">
		               <tr style="background-color:gray;color:white">
		                  <th style="text-align: center;color:#white">ID</th>
		                  <th style="text-align: center;color:#white">MÃ DỊCH VỤ</th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_dichvu where discount='1'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$item['dichvu'].'</td>
		                  
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
				
				
			</div>
			<div class="col-md-6">
			
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:blue">
		               <tr style="background-color:blue;color:white">
		                  <th style="text-align: center;color:#white">ID</th>
		                  <th style="text-align: center;color:#white">Username</th>
		                  <th style="text-align: center;color:#white">Company</th>
		                  <th style="text-align: center;color:#white">Chức năng</th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ns_user where discount='1'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$item['username'].'</td>
		                  <td style="text-align: center; color:black">'.$item['congty'].'</td>
		                  <td><form method="POST" action="">
						  
						  <input type="hidden" value="'.$item['id'].'" name="delete">
						  <input type="hidden" value="services_country" name="m"><button type="submit" name="btn_delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Xóa khỏi danh sách khuyến mãi?\')"> 
						  
						  <i class="fas fa-trash-alt"></i> Delete</button></form></td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			
			
			
		</div>
	
</div>

<?php  
?>


<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
   
  
</script>