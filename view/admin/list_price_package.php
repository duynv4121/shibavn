<?php  
	if (isset($_POST['btn_submit'])) {
		
		
		$id_user = $_POST['id_user'];
		mysqli_query($conn,"UPDATE `ns_user` SET `discount`='1' WHERE (`id`='".$id_user."')");
	
	}
	
	if (isset($_POST['btn_delete'])) {
		
		
		$delete = $_POST['delete'];
		mysqli_query($conn,"DELETE FROM `ksn_price_package` WHERE (`id`='$delete')");
	
	}
	
	if(isset($_POST['btn_add']))
	{
		
		mysqli_query($conn,"INSERT INTO `ksn_price_package` (`id_package`, `price_discount`, `uid`, `datetime`) VALUES ('".$_POST['id_package']."', '".$_POST['price_discount']."', '$uid', '$datenow')");	
	
	}
	
	
	
?>
<div class="container-fluid">DANH SÁCH ÁP GIÁ CHO ID PACKAGE<BR>

		<div class="row">
			<div class="col-md-9">
			
				 <table id="example3" class="table table-hover table-bordered table-striped" width=100% data-page-length='50'  style="font-size:14px" data-order='[[0, "desc"]]'>
		            <thead style="">
		               <tr style="background-color:orange;color:white">
		                  <th style="text-align: center;color:#white">ID</th>
		                  <th style="text-align: center;color:#white">ID Package</th>
		                  <th style="text-align: center;color:#white">Price </th>
		                  <th style="text-align: center;color:#white">Company</th>
		                  <th style="text-align: center;color:#white">Accountant user</th>
		                  <th style="text-align: center;color:#white">Date Time</th>
		                  <th style="text-align: center;color:#white"></th>
		                  
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_price_package order by uid DESC");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
						  $laydulieupackage = mysqli_fetch_assoc(mysqli_query($conn,"select uid from ns_package where id_code='".$item['id_package']."'"));

				   
						  $laydulieucongty = mysqli_fetch_assoc(mysqli_query($conn,"select congty from ns_user where id='".$laydulieupackage['uid']."'"));
						  $laydulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"select username from ns_user where id='".$item['uid']."'"));
						
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$item['id_package'].'</td>
		   
		                  <td style="text-align: center; color:green">'.number_format($item['price_discount']).'đ</td>
		                  <td style="text-align: center; color:green">'.$laydulieucongty['congty'].'</td>
		                  <td style="text-align: center; color:blue">'.$laydulieuuser['username'].'</td>
		                  <td style="text-align: center; color:blue">'.($item['datetime']).'</td>
		                  <td style="text-align: center; color:blue"><form action="" method="POST"><input type="hidden" value="'.$item['id'].'" name="delete"><button type="submit" name="btn_delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Chắc chắn muốn xóa ID: '.$item['id_package'].' khỏi danh sách discount  ?\')"><i class="fas fa-trash-alt"></i> Delete</button></form></td>
		                  
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			
			

			<div class="col-md-3">
						<form action="" method="POST" >

			<div class="card card-warning">
			<div class="card-header">
			<h3 class="card-title"><i class="fas fa-user-tag"></i> DANH SÁCH ÁP GIÁ cho ID Package</h3>
			</div>
			<div class="card-body">
			
			
			<div class="form-group" >
					<label for="">Nhập ID Package</label>
					<input type="text"  name="id_package" value="" class="form-control" required placeholder="Nhập mã ID Package">
			</div>
			
			<div class="form-group" >
					<label for="">Nhập số tiền áp giá</label>
					<input type="text"  name="price_discount" value="" class="form-control" required placeholder="Nhập số tiền tính giá">
			</div>
			
			</div>


<div class="card-footer">								<button type="submit" name="btn_add" class="btn btn-primary">Thêm</button>
<div class="card-footer">								
</div>
				</div>
										</form>

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