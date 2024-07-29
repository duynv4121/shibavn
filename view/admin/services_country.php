<?php  
	if (isset($_POST['btn_submit'])) {
		
		
		$id_quocgia = $_POST['id_quocgia'];
		$id_dichvu = $_POST['id_dichvu'];

		mysqli_query($conn,"INSERT INTO `ksn_quocgia_dichvu` (`id_quocgia`, `id_dichvu`) VALUES ('$id_quocgia', '$id_dichvu')") or die(mysqli_error()); 

		echo'<script> 
		 	alert("Thêm liên kết thành công!");
      </script>';
	}
	
	
	
	
	if(isset($_GET['delete']))
	{
		mysqli_query($conn,"DELETE FROM `ksn_quocgia_dichvu` WHERE (`id`='".$_GET['delete']."')");					
		 echo'<script> 
		alert("Xóa liên kết dịch vụ thành công!");
		</script>';
	}
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
			
				<div class="card card-dark">

			
			
			<?php
			
			
			
			echo'<div class="card-header">
<h3 class="card-title">Thêm Liên Kết Dịch Vụ</h3>
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
					<label for="inputPassword3" class="control-label">Chọn Dịch Vụ Liên Kết<font color=red> * </font></label>
					<select class="form-control" id="nguoinhan_countries-dropdown" name="id_dichvu" required>';
						
							$countries = mysqli_query($conn,"SELECT * FROM ksn_dichvu");
							echo '<option value="">Chọn Dịch Vụ</option>';
							while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'">'.$item['dichvu'].'</option>
								';
							}
					echo'</select>
				</div>
				
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-dark">Thêm Liên Kết</button>	

</div></form>
</div>			';

			
			
			?>
			

			
				
				
				
				
				
			</div>
			<div class="col-md-9">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:blue">
		               <tr>
		                  <th style="text-align: center;color:#00a5e4">ID</th>
		                  <th style="text-align: center;color:#00a5e4">Tên Quốc Gia</th>
		                  <th style="text-align: center;color:#00a5e4">Dịch Vụ Sử Dụng</th>
		                  <th style="text-align: center;color:#00a5e4">Chức năng</th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_quocgia_dichvu");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
						  $quocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$item['id_quocgia']."'"));
						  $dichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu from ksn_dichvu where id='".$item['id_dichvu']."'"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$quocgia['name'].'</td>
		                  <td style="text-align: center; color:black">'.$dichvu['dichvu'].'</td>
		                  <td><form method="GET" action="">
						  
						  <input type="hidden" value="'.$item['id'].'" name="delete">
						  <input type="hidden" value="services_country" name="m"><button type="submit"class="btn btn-danger btn-sm"> 
						  
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