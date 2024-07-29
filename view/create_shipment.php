<?php  
	include('top.php');
	if (isset($_POST['btn_submit'])) {
		$awb = $_POST['awb'];
		$datenow = date('Y-m-d H:i:s');;
		$partner1 = $_POST['partner1'];
		$kg_dichvua = $_POST['kg_dichvu'];
		$kg_chinhanh = $_POST['kg_chinhanh'];
		$hangbay = $_POST['hangbay'];
		$dest = $_POST['dest'];
		$hawb_no = $_POST['hawb_no'];
		
		$check = mysqli_num_rows(mysqli_query($conn,"SELECT awb FROM ksn_shipment WHERE awb ='$awb'"));
		if ($check != 0) {
			echo 'Đã có MAWB này rồi!';
		}else{
			
			foreach ($kg_dichvua as $a){
				$kg_dichvu .= $a.',';
			}
			
			
			mysqli_query($conn,"INSERT INTO `ksn_shipment` (`awb`, `date_time`, `id_doitac`,`doitac`,`kg_dichvu`,`kg_chinhanh`,`hangbay`,`dest`,`hawb_no`)
			VALUES ('$awb','$datenow', '','$partner1','$kg_dichvu','$kg_chinhanh','$hangbay','$dest','$hawb_no')") or die(mysql_error()); 

			echo'<script> 
				alert("Tạo MAWB thành công!");
                window.location.href="shipments.php";
            </script>';
		}
	}
	
	
	if (isset($_POST['btn_update'])) {
		$awb = $_POST['awb'];
		$datenow = date('Y-m-d H:i:s');;
		$partner1 = $_POST['partner1'];
		$kg_dichvua = $_POST['kg_dichvu'];
		$kg_chinhanh = $_POST['kg_chinhanh'];
		$hangbay = $_POST['hangbay'];
		$dest = $_POST['dest'];
		$hawb_no = $_POST['hawb_no'];
		
			foreach ($kg_dichvua as $a){
				$kg_dichvu .= $a.',';
			}
			
		
			
			
			mysqli_query($conn,"UPDATE `ksn_shipment` SET `awb`='".$awb."', `doitac`='".$partner1."', `kg_dichvu`='".$kg_dichvu."', `kg_chinhanh`='".$kg_chinhanh."', `hangbay`='".$hangbay."', `dest`='".$dest."', `hawb_no`='".$hawb_no."' WHERE (`id`='".$_GET['edit']."')") or die(mysql_error()); 

			echo'<script> 
				alert("Chỉnh sửa thành  công");
            </script>';
		
	}
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
		
			
			
			<?php
			if(isset($_GET['edit']))
			{
				$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment where id='".$_GET['edit']."'"));
				 $myArray = explode(',', $laydulieu['kg_dichvu']);

				echo'
			<div class="col-md-3">
			
				<div class="card card-info">
<div class="card-header">

<h3 class="card-title">				Thông tin Shipment
</h3>
</div>
<div class="card-body">
<div class="form-group" >
					<label for="">Mã MAWB </label>
					<input type="text" name="awb" class="form-control" value="'.$laydulieu['awb'].'" placeholder="Nhập mã MAWB">
				</div>
				
				<div class="form-group" >
					<label for="">Hawb No</label>
					<input type="text" name="hawb_no" class="form-control" placeholder="Hawb"  value="'.$laydulieu['hawb_no'].'" >
				</div>
				
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Đối tác</label>
										<input type="text" name="partner1" class="form-control"  value="'.$laydulieu['doitac'].'"  placeholder="Đối Tác">

				</div>
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Hãng Bay</label>
										<input type="text" name="hangbay" class="form-control"  value="'.$laydulieu['hangbay'].'"  placeholder="Hãng Bay">

				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Final DEST</label>
										<input type="text" name="dest" class="form-control"  value="'.$laydulieu['dest'].'"  placeholder="Nhập Final DEST">

				</div>
					';
			
					echo'<div class="form-group">

				<label for="" class="control-label">Dịch vụ vận chuyển (Services) *</label>
					<select multiple required class="select2bs4" name="kg_dichvu[]" id="" width=100%>';
					
						$dichvushipa = mysqli_query($conn,"SELECT * FROM ksn_dichvu where status='2' order by id asc");
							while ($dichvuship = mysqli_fetch_array($dichvushipa,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$dichvuship['id'].'" ';
								if($myArray[0] == $dichvuship['id'])
								{
									echo'selected';
								}
								if(@$myArray[1] == $dichvuship['id'])
								{
									echo'selected';
								}
								if(@$myArray[2] == $dichvuship['id'])
								{
									echo'selected';
								}
								if(@$myArray[3] == $dichvuship['id'])
								{
									echo'selected';
								}
								if(@$myArray[4] == $dichvuship['id'])
								{
									echo'selected';
								}if(@$myArray[5] == $dichvuship['id'])
								{
									echo'selected';
								}
								
								echo'>'.$dichvuship['dichvu'].'</option>';
							}
			
					echo'</select>
					</div>';
					
				echo'<div class="form-group">

				<label for="" class="control-label">Chọn chi nhánh</label>
					<select required class="form-control" name="kg_chinhanh" id="">';
					
							echo '<option value="SGN"';if($laydulieu['kg_chinhanh'] == 'SGN'){echo'selected';}echo'>SGN</option>';
							echo '<option value="HAN"';if($laydulieu['kg_chinhanh'] == 'HAN'){echo'selected';}echo'>HAN</option>';
							echo '<option value="DAD"';if($laydulieu['kg_chinhanh'] == 'DAD'){echo'selected';}echo'>DAD</option>';
			
					echo'</select>
				</div>';
				echo'</div>
<div class="card-footer">
				<button type="submit" name="btn_update" class="btn btn-primary">Chỉnh sửa thông tin</button>
</div>



</div>
		
			</div>
			';
				
			}
			else
			{
				echo'
			<div class="col-md-3">
			
				<div class="card card-info">
<div class="card-header">

<h3 class="card-title">				Thông tin Shipment
</h3>
</div>
<div class="card-body">
<div class="form-group" >
					<label for="">Mã MAWB </label>
					<input type="text" name="awb" class="form-control" placeholder="Nhập mã MAWB">
				</div>
				
				<div class="form-group" >
					<label for="">Hawb No</label>
					<input type="text" name="hawb_no" class="form-control" placeholder="Hawb">
				</div>
				
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Đối tác</label>
										<input type="text" name="partner1" class="form-control" placeholder="Đối Tác">

				</div>
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Hãng Bay</label>
										<input type="text" name="hangbay" class="form-control" placeholder="Hãng Bay">

				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Final DEST</label>
										<input type="text" name="dest" class="form-control" placeholder="Nhập Final DEST">

				</div>
					';
			
					echo'<div class="form-group">

				<label for="" class="control-label">Dịch vụ vận chuyển (Services) *</label>
					<select multiple required class="select2bs4" name="kg_dichvu[]" id="" width=100%>';
					
						$dichvushipa = mysqli_query($conn,"SELECT * FROM ksn_dichvu where status='2' order by id asc");
							while ($dichvuship = mysqli_fetch_array($dichvushipa,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$dichvuship['id'].'">'.$dichvuship['dichvu'].'</option>';
							}
			
					echo'</select>
					</div>';
					
				echo'<div class="form-group">

				<label for="" class="control-label">Chọn chi nhánh</label>
					<select required class="form-control" name="kg_chinhanh" id="">';
					
							echo '<option value="SGN" selected>SGN</option>';
							echo '<option value="HAN">HAN</option>';
							echo '<option value="DAD">DAD</option>';
			
					echo'</select>
				</div>';
				echo'</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-primary">Tạo MAWB Mới</button>
</div>



</div>
		
			</div>
			';
			}
			?>
			
			
			
			
			
			
			
			
			
			
			
			
		</div>
	</form>
	
</div>

<?php  
    include('footer.php');
?>
<script type="text/javascript">
	

</script>