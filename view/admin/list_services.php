<?php  
	if (isset($_POST['btn_submit'])) {
		$dichvu = $_POST['dichvu'];
		$thetich = $_POST['thetich'];
		
		$price = $_POST['price'];

		mysqli_query($conn,"INSERT INTO `ksn_dichvu` (`dichvu`, `thetich`) VALUES ('$dichvu', '$thetich')") or die(mysql_error()); 

		// echo'<script> 
		// 	alert("Thu tiền ngoài bill thành công!");
  //       </script>';
	}
	if (isset($_POST['btn_update'])) {
		$dichvu = $_POST['update_dichvu'];
		$thetich = $_POST['update_thetich'];
$api_connect = $_POST['api_connect'];
		$api_dichvu = $_POST['api_dichvu'];
		mysqli_query($conn,"UPDATE `ksn_dichvu` SET `thetich`='$thetich',`dichvu`='$dichvu',`api_connect`='$api_connect',`api_dichvu`='$api_dichvu' WHERE (`id`='".$_GET['edit']."')") or die(mysql_error()); 

		// echo'<script> 
		// 	alert("Thu tiền ngoài bill thành công!");
  //       </script>';
	}
	
	
	if (isset($_POST['btn_hide'])) {
		

              $id_active = $_POST['id_active'];

	   mysqli_query($conn,"UPDATE `ksn_dichvu` SET `status`='1' WHERE (`id`='$id_active')");
	     echo'<script> 
           </script>';
		
    }
	if (isset($_POST['btn_show'])) {
		
	
              $id_active = $_POST['id_active'];

	   mysqli_query($conn,"UPDATE `ksn_dichvu` SET `status`='2' WHERE (`id`='$id_active')");
	     echo'<script> 
           </script>';
		
    }
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
			
				<div class="card card-dark">

			
			
			<?php
			
			
			if(isset($_GET['edit']))
			{
				$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='".$_GET['edit']."'"));
				echo'	<form action="" method="POST">
<div class="card-header">
<h3 class="card-title">Sửa Dịch Vụ SHIBA EXPRESS</h3>
</div><div class="card-body">
<div class="form-group" >
					<label for="">Tên Dịch Vụ</label>
					<input  required type="text" name="update_dichvu"  required class="form-control" value="'.$laydulieu['dichvu'].'" placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Tỉ lệ khối lượng thể tích (DW)</label>
					<input  required type="text" name="update_thetich" class="form-control"  value="'.$laydulieu['thetich'].'" required placeholder="">
				</div>
				<div class="form-group" >
					<label for="">API Đối Tác</label>
					<input   type="text" name="api_connect" class="form-control"  value="'.$laydulieu['api_connect'].'"  placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Mã Dịch Vụ Đối Tác</label>
					<input   type="text" name="api_dichvu" class="form-control"  value="'.$laydulieu['api_dichvu'].'"  placeholder="">
				</div>
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_update" class="btn btn-warning">Sửa Thông Tin Dịch Vụ</button>
</div>
</div>	</form>		';

			}else if(isset($_GET['newprice']))
			{
				$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='".$_GET['newprice']."'"));
				echo'	<form action="add_price.php" method="GET">
<div class="card-header">
<h3 class="card-title">Thêm bảng giá cho dịch vụ</h3>
</div><div class="card-body">
<div class="form-group" >
					<label for="">Tên Dịch Vụ</label>
				<b> <font color=red>	'.$laydulieu['dichvu'].'</font> </b>
				</div>
				Chọn loại bảng giá
				<input type="hidden" value="'.$laydulieu['id'].'" name="id_dichvu">
			<div class="custom-control custom-radio">
<input class="custom-control-input" type="radio" id="customRadio1" name="type" value="1" checked>
<label for="customRadio1" class="custom-control-label">Bảng giá loại 1</label>
</div>

<div class="custom-control custom-radio">
<input class="custom-control-input" type="radio" id="customRadio2" name="type" value="2">
<label for="customRadio2" class="custom-control-label">Bảng giá loại 2</label>
</div><div class="custom-control custom-radio">
<input class="custom-control-input" type="radio" id="customRadio3" name="type" value="3">
<label for="customRadio3" class="custom-control-label">Bảng giá loại 3</label>
</div><div class="custom-control custom-radio">
<input class="custom-control-input" type="radio" id="customRadio4" name="type" value="4">
<label for="customRadio4" class="custom-control-label">Bảng giá loại 4</label>
</div>

Lưu ý:
<br>
<b>Bảng giá loại 1</b>:  ✅ Bảng giá trên 21kg( trong bảng giá này sẽ có sẵn cột: 21+ , 45+, 71+, 100+,300+)<br>
<b>Bảng giá loại 2</b>:	✅ Bảng giá trên 30kg (trong bảng giá này sẽ có sẵn cột: 31+ , 45+, 71+, 100+, 300+)<br>
<b>Bảng giá loại 3</b>:	✅ Bảng giá sỉ trên 21kg (trong bảng giá này sẽ có sẵn cột: 21+ , 45+, 71+, 100+, 300+)<br>
<b>Bảng giá loại 4</b>:	✅ Bảng giá sỉ trên 31kg (trong bảng giá này sẽ có sẵn cột: 31+ , 45+, 71+, 100+, 300+)
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_addnewprice" class="btn btn-danger">Cập nhật thêm bảng giá</button>
</div>
</div>			<form>';

			}
			else
				
			{
			echo'<form action="" method="POST"><div class="card-header">
<h3 class="card-title">Thêm Dịch Vụ SHIBA EXPRESS</h3>
</div>
	         <div class="card-body">

				<div class="form-group" >
					<label for="">Tên Dịch Vụ</label>
					<input  required type="text" name="dichvu" required class="form-control" placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Tỉ lệ khối lượng thể tích (DW)</label>
					<input  required type="text" name="thetich" class="form-control" required placeholder="">
				</div></div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-dark">Thêm Dịch Vụ</button>
</div>
</div>			</form>';

			}
			
			?>
			

			
					
				
				
				
				
			</div>	

			<div class="col-md-9">
				 <table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;background-color:#0099FF">
		               <tr>
		                  <th style="text-align: center;color:#FFFFFF">ID</th>
		                  <th style="text-align: center;color:#FFFFFF">Tên Dịch Vụ</th>
		                  <th style="text-align: center;color:#FFFFFF">Status</th>
		                  <th style="text-align: center;color:#FFFFFF">Khối lượng thể tích (DW)</th>
						                 <th style="text-align: center;color:#FFFFFF">API Đối Tác</th>
		                  <th style="text-align: center;color:#FFFFFF">Mã Dịch Vụ Đối Tác</th>
		                  <th style="text-align: center;color:#FFFFFF">Chức năng</th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_dichvu");
		               
		               
					   function status_dichvu($status){
						   if($status == 1){
							   $status = '<span class="badge bg-danger">Disnable</span>';
						   }
						   else
						   {
							   $status = '<span class="badge bg-success">Enable</span>';
						   }
						   return $status;
					   }
					  
					   
					   
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
						  $checktontai = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$item['id']."'"));
						  
					
		                  $i++;
		                  echo '<tr><form action="" method="POST">
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$item['dichvu'].'</td>
		                  <td style="text-align: center; color:black">'.status_dichvu($item['status']).'</td>
		                  <td style="text-align: center; color:black">'.$item['thetich'].'</td>
		                  <td style="text-align: center; color:black">'.$item['api_connect'].'</td>
		                  <td style="text-align: center; color:black">'.$item['api_dichvu'].'</td>
		                  <td>
						  
						  <a href="m_admin.php?m=services&edit='.$item['id'].'"  class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>  
						  <input type="hidden" value="'.$item['id'].'" name="id_active">
							';
							
							if($item['status'] == 2)
							{
						  echo'<button type="submit" name="btn_hide" class="btn btn-danger btn-sm" style="text-align:right"  onclick="return confirm(\'Chắc chắn muốn tắt dịch vụ: '.$item['dichvu'].'  ?\')" />OFF</button>';
							}
							else
							{
						  echo'<button type="submit" name="btn_show" class="btn btn-success btn-sm" style="text-align:right"  onclick="return confirm(\'Chắc chắn muốn mở lại dịch vụ: '.$item['dichvu'].'  ?\')" />ON</button>';

							}
						  
						 echo'
';
						  
						  if(@$checktontai['id_dichvu'] == "")
						  {
							echo'<a href="m_admin.php?m=services&newprice='.$item['id'].'"  class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i> Thêm bảng giá</a> ';
						  }
						  echo'
						 </form></td>
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