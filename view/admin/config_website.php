<?php  
	
	if(isset($_POST['submit']))
	{
		
		if($_POST['checka'] == 'on')
		{
			mysqli_query($conn,"UPDATE `ksn_system` SET `status`='2' WHERE (`string_code`='accountant_edit') LIMIT 1");
		}
		else
		{
			mysqli_query($conn,"UPDATE `ksn_system` SET `status`='1' WHERE (`string_code`='accountant_edit') LIMIT 1");

		}
		
		
		
		if($_POST['checkb'] == 'on')
		{
			mysqli_query($conn,"UPDATE `ksn_system` SET `status`='2' WHERE (`string_code`='f2a_code') LIMIT 1");
		}
		else
		{
			mysqli_query($conn,"UPDATE `ksn_system` SET `status`='1' WHERE (`string_code`='f2a_code') LIMIT 1");

		}
		echo '
			<script>
				alert("Update successfull !");

			</script>
		';
	}
		
	
		
		
		
	
	
	
	
	
	$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_system where string_code='accountant_edit'"));
	$laydulieu2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_system where string_code='f2a_code'"));
?>
<div class="container-fluid">
	<form action="" method="POST"  enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-3">
			
				<div class="card card-dark" style="padding:10px;">
<center>Config System</center><br>
			
			<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
<input type="checkbox" class="custom-control-input" id="customSwitch3" name="checka" <?php if($laydulieu['status']=='2'){echo'checked';} ?>>
<label class="custom-control-label" for="customSwitch3">Bật/Tắt chỉnh sửa bảng giá và dịch vụ cho kế toán</label>


</div><div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
<input type="checkbox" class="custom-control-input" id="customSwitch4" name="checkb" <?php if($laydulieu2['status']=='2'){echo'checked';} ?>>
<label class="custom-control-label" for="customSwitch4">Bật/Tắt hệ thống gửi 2FA CODE cho tất cả user</label>
</div>

<br><br>
						<input type="submit" name="submit" class="btn btn-danger" value="SUBMIT">

				</div>
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
<script src="gd/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
