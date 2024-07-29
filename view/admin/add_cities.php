<?php  
	if (isset($_POST['btn_submit'])) {
		
		
		$id_quocgia = $_POST['id_quocgia'];
		$name = $_POST['name'];
		$state_code = $_POST['state_code'];

		mysqli_query($conn,"INSERT INTO `cities` (`name`, `state_id`, `state_code`, `country_id`, `country_code`, `flag`) VALUES ('$name', '60199', '$state_code', '$id_quocgia', 'code', '$uid')") or die(mysqli_error()); 

		echo'<script> 
		 	alert("Thêm thành phố thành công!");
      </script>';
	}
	
	
	
	
	if(isset($_GET['delete']))
	{
		/*mysqli_query($conn,"DELETE FROM `ksn_quocgia_dichvu` WHERE (`id`='".$_GET['delete']."')");					
		 echo'<script> 
		alert("Xóa liên kết dịch vụ thành công!");
		</script>';*/
	}
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
			
				<div class="card card-dark">

			
			
			<?php
			
			
			
			echo'<div class="card-header">
<h3 class="card-title">Add Cities for Country</h3>
</div>	<form action="" method="POST">

	         <div class="card-body">

				<div class="form-group">
					<label for="inputPassword3" class="control-label">Quốc gia (Country) <font color=red> * </font></label>
					<select class="form-control" id="nguoinhan_countries-dropdown" name="id_quocgia" required>';
						
							$countries = mysqli_query($conn,"SELECT * FROM ns_countries order by id asc");
							echo '<option value="">Chọn quốc gia</option>';
							while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'">'.$item['name'].' - '.$item['iso2'].'</option>
								';
							}
					echo'</select>
				</div>
				<div class="form-group">
					<label for="">Nhập tên thành phố cần thêm</label>
					<input type="text"  name="name" value="" class="form-control" required placeholder="Cities name" >

				</div>
				<div class="form-group">
					<label for="">State Code</label>
					<input type="text"  name="state_code" value="" class="form-control" required placeholder="State code" >

				</div>
				
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-dark">Add New Cities</button>	

</div></form>
</div>			';

			
			
			?>
			

			
				
				
				
				
				
			</div>
			<div class="col-md-9">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:blue">
		               <tr>
		                  <th style="text-align: center;color:#00a5e4">ID</th>
		                  <th style="text-align: center;color:#00a5e4">Tên thành phố thêm</th>
		                  <th style="text-align: center;color:#00a5e4">Quốc Gia</th>
		                  <th style="text-align: center;color:#00a5e4"></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM cities where `state_id`='60199'")or die(mysqli_error($conn));
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
						  $quocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$item['country_id']."'"));
						  $dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['flag']."'"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$item['name'].'</td>
		                  <td style="text-align: center; color:black">'.$quocgia['name'].'</td>
		                  <td><form method="GET" action="">
						  
						  <input type="hidden" value="'.$item['id'].'" name="delete">
						  <input type="hidden" value="services_country" name="m">
						  <!--<button type="submit"class="btn btn-danger btn-sm"> 
						  
						  <i class="fas fa-trash-alt"></i> Delete</button>--></form></td>
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