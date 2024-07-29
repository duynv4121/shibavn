<?php  
	if (isset($_POST['btn_submit'])) {
		
		
		$id_user = $_POST['id_user'];
		mysqli_query($conn,"UPDATE `ns_user` SET `discount`='1' WHERE (`id`='".$id_user."')");
	
	}
	
	if (isset($_POST['btn_delete'])) {
		
		
		$delete = $_POST['delete'];
		mysqli_query($conn,"UPDATE `ns_user` SET `discount`='0' WHERE (`id`='".$delete."')");
	
	}
	
	if(isset($_POST['btn_add']))
	{
		
		foreach($_POST['id_user'] as $key) {
			$date_start = $_POST['date_start'];
			$date_end = $_POST['date_end'];
			mysqli_query($conn,"INSERT INTO `ksn_discount` (`uid`, `id_dichvu`, `d_m_21`, `d_m_45`, `d_m_100`,`date_start`,`date_end`) VALUES ('".$key."', '".$_POST['id_dichvua']."', '".$_POST['d_m_21']."', '".$_POST['d_m_45']."', '".$_POST['d_m_100']."','$date_start','$date_end')");
			
		}   
		
	}
	
	
	
?>
<div class="container-fluid">DANH SÁCH USER SỬ DỤNG DISCOUNT<BR>

		<div class="row">
			<div class="col-md-9">
			
				 <table id="example3" class="table table-hover table-bordered table-striped" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:blue">
		               <tr style="background-color:blue;color:white">
		                  <th style="text-align: center;color:#white">ID</th>
		                  <th style="text-align: center;color:#white">Account ID</th>
		                  <th style="text-align: center;color:#white">Company</th>
		                  <th style="text-align: center;color:#white">Dịch Vụ</th>
		                  <th style="text-align: center;color:#white">Mức giá 21-44 kg</th>
		                  <th style="text-align: center;color:#white">Mức giá 45-99 kg</th>
		                  <th style="text-align: center;color:#white">Mức giá >100 kg</th>
						  <th style="text-align: center;color:#white">Ngày bắt đầu</th>
		                  <th style="text-align: center;color:#white">Ngày kết thúc</th>
		                  <th style="text-align: center;color:#white">Chức năng</th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_discount order by uid DESC");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
						  
						  $laydulieucongty = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['uid']."'"));
						  $laydulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='".$item['id_dichvu']."'"));
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:black">'.$item['id'].'</td>
		                  <td style="text-align: center; color:black">'.$laydulieucongty['cus_code'].'</td>
		                  <td style="text-align: left; color:black">'.$laydulieucongty['congty'].'</td>
		                  <td style="text-align: center; color:black">'.($laydulieudichvu['dichvu']).'</td>
		                  <td style="text-align: center; color:green">'.number_format($item['d_m_21']).'đ</td>
		                  <td style="text-align: center; color:green">'.number_format($item['d_m_45']).'đ</td>
		                  <td style="text-align: center; color:green">'.number_format($item['d_m_100']).'đ</td>
		                  <td style="text-align: center; color:blue">'.($item['date_start']).'</td>
		                  <td style="text-align: center; color:blue">'.($item['date_end']).'</td>
		                  <td>
						  
						  <input type="hidden" value="'.$item['id'].'" name="delete">
						 <!-- <input type="hidden" value="services_country" name="m"><button type="submit" name="btn_delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Xóa khỏi danh sách khuyến mãi?\')"> 
						 
						  <i class="fas fa-trash-alt"></i> Delete</button> --> 
						  <a href="m_admin.php?m=edit_fwd&id='.$item['uid'].'" target="_blank">Edit</a>
						  </td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
			</div>
			
			

			<div class="col-md-3">
						<form action="" method="POST" >

			<div class="card card-primary">
			<div class="card-header">
			<h3 class="card-title"><i class="fas fa-user-tag"></i> DISCOUNT cho FWD</h3>
			</div>
			<div class="card-body">
			<?php
			
			echo'					<label for="inputPassword3" class="control-label">Chọn User Discount<font color=red> * </font></label>
<select multiple class="form-control select2bs4" id="nguoinhan_countries-dropdown" name="id_user[]" required>';
						
							$username = mysqli_query($conn,"SELECT * FROM ns_user where  roleid='2'");
							while ($item = mysqli_fetch_array($username,MYSQLI_ASSOC)) {
								echo '
								<option style="color:blue" value="'.$item['id'].'">'.$item['username'].' ['.$item['congty'].']</option>
								';
							}
					echo'</select>';
			
			
			echo'
			<div class="form-group">
					<label for="inputPassword3" class="control-label">Chọn Dịch Vụ Discount<font color=red> * </font></label>
					<select class="form-control" id="nguoinhan_countries-dropdown" name="id_dichvua" required>';
						
							$countries = mysqli_query($conn,"SELECT * FROM ksn_dichvu");
							echo '<option value="">Chọn Dịch Vụ</option>';
							while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'">'.$item['dichvu'].'</option>
								';
							}
					echo'</select>
				</div>';
			?>
			
			<div class="form-group" >
					<label for="">Mức > 21 kg</label>
					<input type="text"  name="d_m_21" value="" class="form-control" required placeholder="số tiền - mức > 21 kg">
			</div>
			
			<div class="form-group" >
					<label for="">Mức > 45kg</label>
					<input type="text"  name="d_m_45" value="" class="form-control" required placeholder="số tiền - mức > 45 kg">
			</div>
			
			<div class="form-group" >
					<label for="">Mức > 100 kg</label>
					<input type="text"  name="d_m_100" value="" class="form-control" required placeholder="số tiền - mức > 100 kg">
			</div>
			<div class="form-group" >
					<label for="">Ngày bắt đầu</label>
					<input type="date" id="aa" name="date_start" required >			
			</div>
			<div class="form-group" >
					<label for="">Ngày kết thúc</label>
					<input type="date" id="aa" name="date_end" required>			
			</div>
			
			</div>


<div class="card-footer">								<button type="submit" name="btn_add" class="btn btn-primary">Thêm Discount</button>
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