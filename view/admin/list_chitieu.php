<?php  
	
	
	
	 ini_set('memory_limit', '-1');
	
	
	function compressImage($source, $destination, $quality) {
	    $info = getimagesize($source);

	    if ($info['mime'] == 'image/jpeg') 
	        $image = imagecreatefromjpeg($source);

	    elseif ($info['mime'] == 'image/gif') 
	        $image = imagecreatefromgif($source);

	    elseif ($info['mime'] == 'image/png') 
	        $image = imagecreatefrompng($source);

	    imagejpeg($image, $destination, $quality);

	    return $destination;
	}
	
	
	
	
	
	
	
	
	########### updateeeeeeeeeeeeeee
	
	if(isset($_POST['btn_delete']))
	{
		mysqli_query($conn,"DELETE FROM `ksn_ketoanchi` WHERE (`id`='".$_POST['id_delete']."')");
	}
	
	
	if (isset($_POST['btn_update'])) {
		
		
		$kg_chinhanh = $_POST['kg_chinhanh'];
		$payment_price = $_POST['payment_price'];
		$payment_method = $_POST['payment_method'];
		$doitac = $_POST['doitac'];
		$noidung = $_POST['noidung'];
		$check_thu = $_POST['check_thu'];
		$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		if($roleid == 1 || $roleid == 3)
		{
		mysqli_query($conn,"UPDATE `ksn_ketoanchi` SET `uid`='$uid', `kg_chinhanh`='$kg_chinhanh', `payment_price`='$payment_price',
		`payment_method`='$payment_method', `doitac`='$doitac', `noidung`='$noidung', `check_thu`='$check_thu' WHERE (`id`='".$_GET['edit']."')");
		}
		
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];
		$doihinh =0;		
		$excute = $_GET['edit'];

		$numberOfFilesUploaded = count($_FILES['photo']['name']);

		$string_urlimg = "";
		for ($i = 0; $i <= $numberOfFilesUploaded; $i++) 
		{
		
		
		if(isset($_FILES["photo"]['name'][$i]) AND $_FILES["photo"]['name'][$i] != ""){
	      	$ganthoigian = date("H_i_s");
			$newFileName = 'ketoanchi_'.$excute.'_'.$i.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"][$i] ,PATHINFO_EXTENSION); 

	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	        $filename = $_FILES["photo"]["name"][$i];
	        $filetype = $_FILES["photo"]["type"][$i];
	        $filesize = $_FILES["photo"]["size"][$i];

	        // Xác minh phần mở rộng tệp
	        $ext = pathinfo($filename, PATHINFO_EXTENSION);
	        if(!array_key_exists($ext, $allowed)) die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");

	        // Xác minh kích thước tệp - tối đa 5MB
	        $maxsize = 20 * 1024 * 1024;
	        if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
	        
	        // Xác minh loại MIME của tệp
	        if(in_array($filetype, $allowed)){
	            if(file_exists("../upload/" . $filename)){
	                echo $filename . " đã tồn tại.";
	            } else{
	                $location = "../upload/" . $newFileName;
	                $compressedImage = compressImage($_FILES["photo"]["tmp_name"][$i],$location,60);

					if($compressedImage){ // có thể có lỗi
					
						
						
					
						$doihinh = 1;
						$string_urlimg .= $newFileName;

						if(($i+1) < $numberOfFilesUploaded)
						{
						$string_urlimg .= ',';
						}
					
					}else{
						echo "Lỗi: không thể di chuyển tệp đến upload/";
					}
					
	            } 
	        } else{
	            echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
	        }
	    } else{
	        //echo "Error: " . $_FILES["photo"]["error"];
	    }
		
		
		}
		if($doihinh == 1)
		{
		mysqli_query($conn,"UPDATE `ksn_ketoanchi` SET `img`='$string_urlimg' WHERE (`id`='".$_GET['edit']."')") or die(mysqli_error());
		}
		
		
		
	echo '
			<script>
				alert("Cập nhật thành công");

			</script>
		';
		
		
		
	}
	
	
	
	
	
	
	
	if (isset($_POST['btn_submit'])) {
		
		
		$kg_chinhanh = $_POST['kg_chinhanh'];
		$payment_price = $_POST['payment_price'];
		$payment_method = $_POST['payment_method'];
		$check_thu = $_POST['check_thu'];
		$doitac = $_POST['doitac'];
		$noidung = $_POST['noidung'];
		$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
			if($_POST['check_luong'] == '1')
			{
				$check_luong = 1;
			}
			else
			{
				$check_luong = 0;
			}
		
		
		
		if($roleid == 1 || $roleid == 3)
		{
		
		mysqli_query($conn,"INSERT INTO `ksn_ketoanchi` (`uid`, `datetime`, `kg_chinhanh`, `payment_price`, `payment_method`, `doitac`, `noidung`, `check_thu`, `check_luong`) VALUES ('$uid', '$datenow2', '$kg_chinhanh', '$payment_price', '$payment_method', '$doitac', '$noidung', '$check_thu', '$check_luong')");
		$excute = mysqli_insert_id($conn);
		}
		
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];
		$numberOfFilesUploaded = count($_FILES['photo']['name']);
		
		$string_urlimg = "";
		for ($i = 0; $i <= $numberOfFilesUploaded; $i++) 
		{
		

		if(isset($_FILES["photo"]['name'][$i]) AND $_FILES["photo"]['name'][$i] != ""){
	      	$ganthoigian = date("H_i_s");
			$newFileName = 'ketoanchi_'.$excute.'_'.$i.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"][$i] ,PATHINFO_EXTENSION); 

	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	        $filename = $_FILES["photo"]["name"][$i];
	        $filetype = $_FILES["photo"]["type"][$i];
	        $filesize = $_FILES["photo"]["size"][$i];

	        // Xác minh phần mở rộng tệp
	        $ext = pathinfo($filename, PATHINFO_EXTENSION);
	        if(!array_key_exists($ext, $allowed)) die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");

	        // Xác minh kích thước tệp - tối đa 5MB
	        $maxsize = 20 * 1024 * 1024;
	        if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
	        
	        // Xác minh loại MIME của tệp
	        if(in_array($filetype, $allowed)){
	            if(file_exists("../upload/" . $filename)){
	                echo $filename . " đã tồn tại.";
	            } else{
	                $location = "../upload/" . $newFileName;
	                $compressedImage = compressImage($_FILES["photo"]["tmp_name"][$i],$location,60);

					if($compressedImage){ // có thể có lỗi
						$string_urlimg .= $newFileName;

						if(($i+1) < $numberOfFilesUploaded)
						{
						$string_urlimg .= ',';
						}
						
					}else{
						echo "Lỗi: không thể di chuyển tệp đến upload/";
					}
	            } 
	        } else{
	            echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
	        }
	    } else{
	        //echo "Error: " . $_FILES["photo"]["error"];
	    }

		}
		
		mysqli_query($conn,"UPDATE `ksn_ketoanchi` SET `img`='$string_urlimg' WHERE (`id`='$excute')") or die(mysqli_error());

	echo '
			<script>
				alert("Thêm chi tiêu thành công");

			</script>
		';
		
		
		
	}
	
	
	
	
	
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
			
				<div class="card card-danger">

			
			
			<?php
			
			
			if(isset($_GET['edit']))
			{
				$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_ketoanchi where id='".$_GET['edit']."'"));

				echo'	<form action="" method="POST"  enctype="multipart/form-data">
<div class="card-header"  style="background-color:blue;color:white">
<h3 class="card-title">Chỉnh sửa Chi Tiêu Hằng Ngày</h3>
</div>
	         <div class="card-body">
				<div class="form-group" >
					<select required="" class="form-control" name="check_thu" id="">
					<option value="0" '; if($laydulieu['check_thu'] == '0') {echo'selected'; }echo'>Chi tiền</option>
					<option value="1" '; if($laydulieu['check_thu'] == '1') {echo'selected'; }echo'>Nhận tiền</option>
					</select>
				</div>
				<div class="form-group" >
					<select required="" class="form-control" name="kg_chinhanh" id="">
					<option value="HCM" '; if($laydulieu['kg_chinhanh'] == 'HCM') {echo'selected'; }echo'>HCM</option>
					<option value="HN" '; if($laydulieu['kg_chinhanh'] == 'HN') {echo'selected'; }echo'>HN</option>
					<option value="DAD" '; if($laydulieu['kg_chinhanh'] == 'DAD') {echo'selected'; }echo'>DAD</option>
					</select>
				</div>
				<div class="form-group" >
					<label for="">Sô Tiền</label>
					<input  required type="number" name="payment_price" class="form-control" value="'.$laydulieu['payment_price'].'" required placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Hình Thức</label>
					
					
				
				
				<div class="form-check">
				<input class="form-check-input" type="radio" value="cash" name="payment_method" '; if($laydulieu['payment_method'] == 'cash'){echo'checked';}echo'>
				<label class="form-check-label"><i class="fas fa-dollar-sign"></i> Cash</label>
				</div>
				
				<div class="form-check">
				<input class="form-check-input" type="radio" value="banking" name="payment_method"  '; if($laydulieu['payment_method'] == 'banking'){echo'checked';}echo'>
				<label class="form-check-label"><i class="fas fa-dollar-sign"></i> Banking</label>
				</div>
				
				</div>
				
				<div class="form-group" >
					<label for="">Đối Tác</label>
					<input  required type="text" name="doitac"  value="'.$laydulieu['doitac'].'" class="form-control" required placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Nội Dung </label>
					<input  required type="text" name="noidung" class="form-control" value="'.$laydulieu['noidung'].'" required placeholder="">
				</div>';
			
			
			
			echo'<hr>
				<div class="form-group" id="uphinh">
					<label  for="">Upload hình ảnh khác </label>';
					if($uid == 1)
					{
						echo'<input type="file"  class="form-control  custom-file-upload" name="photo[]" id = "fileSelect" multiple>';
					}
					else
					{
						echo'<input type="file"  class="form-control  custom-file-upload" name="photo[]" id = "fileSelect" multiple>';
					}
					
			echo'	
			<div id="themhinhanh"></div><br>	<span class="btn-danger add2" style="padding:5px;  cursor:pointer;"><i class="fa fa-plus" aria-hidden="true" ></i> Thêm hình ảnh</span>
			
			</div>';
				
				
				echo'
				</div>
<div class="card-footer">
				<button type="submit" name="btn_update" class="btn btn-danger">Cập nhật chỉnh sửa</button>
</div>
</div>		</form>	';

			}
			else
				
			{
			echo'	<form action="" method="POST"  enctype="multipart/form-data">
<div class="card-header"  style="background-color:blue;color:white">
<h3 class="card-title">Thêm Chi Tiêu Hằng Ngày</h3>
</div>
	         <div class="card-body">
				<div class="form-group" >
					<select required="" class="form-control" name="check_thu" id="">
					<option value="0" >Chi tiền</option>
					<option value="1" >Nhận tiền</option>
					</select>
				</div>
				<div class="form-group" >
					<select required="" class="form-control" name="kg_chinhanh" id=""><option value="HCM" selected="">HCM</option><option value="HN">HN</option><option value="DAD">DAD</option></select>
				</div>
				<div class="form-group" >
					<label for="">Sô Tiền</label>
					<input  required type="number" name="payment_price" class="form-control" required placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Hình Thức</label>
					
					
				
				
				<div class="form-check">
				<input class="form-check-input" type="radio" value="cash" name="payment_method">
				<label class="form-check-label"><i class="fas fa-dollar-sign"></i> Cash</label>
				</div>
				
				<div class="form-check">
				<input class="form-check-input" type="radio" value="banking" name="payment_method" checked="">
				<label class="form-check-label"><i class="fas fa-dollar-sign"></i> Banking</label>
				</div>
				
				</div>
				
				<div class="form-group" >
					<label for="">Đối Tác</label>
					<input  required type="text" name="doitac" class="form-control" required placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Nội Dung </label>
					<input  required type="text" name="noidung" class="form-control" required placeholder="">
					
				</div>
				<div class="form-check">
<input class="form-check-input" type="checkbox" value="1" name="check_luong">
<label class="form-check-label">Chi lương(Nhập tên nhân viên tại Nội dung)</label>
</div>
				
				';
			
			echo'<hr>
				<div class="form-group" id="uphinh">
					<label  for="">Upload hình ảnh  </label><span class="btn-danger add2" style="padding:5px;  cursor:pointer;"><i class="fa fa-plus" aria-hidden="true" ></i> Thêm hình ảnh</span>';
					if($uid == 1)
					{
						echo'<input type="file"  class="form-control  custom-file-upload" name="photo[]" id = "fileSelect" multiple>';
					}
					else
					{
						echo'<input type="file"  class="form-control  custom-file-upload" name="photo[]" id = "fileSelect" multiple>';
					}
					
echo'	
			<div id="themhinhanh"></div><br>	
			
			</div>';
								
				
				echo'
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-primary">THÊM CHI TIÊU</button>
</div>
</div>			</form>';

			}
			
			?>
			

			
					
				
				
				
				
			</div>
			<div class="col-md-9">
			
					<div class="col-md-12">

 <?php
		 if(isset($_GET['day_start']))
		 {
			 $day_start = $_GET['day_start'];
			 $day_end = $_GET['day_end'];
		 }
		 else
		 {
			
			 $day_start = date('Y-m-d', strtotime("-30 days"));;
			 
			 $day_end = date('Y-m-d');
		 }
		 

		 ?>
		 
		
		<?php
         if ($roleid == 1 || $roleid == 3) {
		 echo'		<div class="row"style="background-color:#EEEEEE;padding-top:20px;border: 1px solid black;border-style: outset;" >
<div class="col-sm-7" >
		 		 <form method="GET" action="">

			<div class="form-group">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start" value="'.@$day_start.'">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end"  value="'.@$day_end.'">
				<input type="hidden" id="aa" name="m"  value="cash_manager">
										<input hidden id="aa" name="id"  value="'.@$_GET['id'].'">
										
										
			';
			
			?>

									
										
										<?php
										echo'
										<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	<a href="mani_ketoanchi.php?day_start='.$day_start.'&day_end='.$day_end.'"><i class="fas fa-download"></i> Export Excel</a>
										
										</div>							

			</form>
				
			</div>
			
			
			';
			
			if($roleid == 1 || $roleid == 3 || $roleid == 4)
			{
			 @$data = mysqli_query($conn,"SELECT * FROM ksn_ketoanchi where DATE(datetime) >= '$day_start' AND  DATE(datetime) <= '$day_end' ");$banking = 0;
							$cash = 0;
							$quytienmat = 0;
							$bankingthu = 0;
						
							
			
						while(@$item = mysqli_fetch_array($data,MYSQLI_ASSOC))
						{
							
							$datesql = $item['datetime'];
							
							$date_for_database = date('Y-m-d', strtotime($datesql));


							if($item['check_thu'] == 0 AND $item['payment_method'] == 'banking')
							{  
								$banking+=$item['payment_price'];
							}if($item['check_thu'] == 1 AND $item['payment_method'] == 'banking')
							{  
								$bankingthu+=$item['payment_price'];
							}
							
							
							{
								
							}
							if($item['check_thu'] == 0 AND $item['payment_method'] == 'cash') 
							{  
								$cash+=$item['payment_price'];
							}
							if($item['check_thu'] == 1 AND $item['payment_method'] == 'cash') 
							{  
								$quytienmat+=$item['payment_price'];
							}
							
						}
			echo'
			<div class="col-sm-5" style="">
			<table width=100% class="table table-bordered table-hover" style="background-color:white">
			<tr><td style="color:red;font-weight:bold">Tiền chi(Bank): '.number_format($banking).'</td><td style="color:green;font-weight:bold">Tiền nhận(Bank): '.number_format($bankingthu).'</td></tr>
			<tr><td style="color:red;font-weight:bold">Tiền chi(Cash): '.number_format($cash).'</td><td style="color:green;font-weight:bold">Tiền nhận(Cash): '.number_format($quytienmat).'</td></tr>
			<tr>
			<td style="color:blue;font-weight:bold">Quỹ tiền bank còn lại: '.number_format($bankingthu-$banking).' VNĐ</td>
			<td style="color:blue;font-weight:bold">Quỹ tiền mặt còn  lại: '.number_format($quytienmat-$cash).'  VNĐ</td>
			
			</tr>
			</table>
			</div>';
			}
			echo'
			
				</div>   
			
			';
			
			
			echo'<hr>

	';
			}
			
			
			?>

   
   <?php 
		
			?>

</div>	

			
			
				 <table id="example3" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[1, "desc"]]'>
		            <thead style="color:white;background-color:#6699FF">
		               <tr>
		                  <th style="text-align: center;color:#FFFFFF"></th>
		                  <th style="text-align: center;color:#FFFFFF">Date</th>
		                  <th style="text-align: center;color:#FFFFFF">Kế Toán</th>
		                  <th style="text-align: center;color:#FFFFFF">Chi Nhánh</th>
		                  <th style="text-align: center;color:#FFFFFF">Số Tiền</th>
		                  <th style="text-align: center;color:#FFFFFF">Hình thức</th>
		                  <th style="text-align: center;color:#FFFFFF">Đối Tác</th>
		                  <th style="text-align: center;color:#FFFFFF">Nội Dung </th>
		                  <th style="text-align: center;color:#FFFFFF">Phiếu Chi</th>
		                  <th style="text-align: center;color:#FFFFFF"></th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               
		               			 @$data = mysqli_query($conn,"SELECT * FROM ksn_ketoanchi where DATE(datetime) >= '$day_start' AND  DATE(datetime) <= '$day_end' ");$banking = 0;

		               $i = 0;
		               while(@$item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
						  $dulieuketoan = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$item['uid']."' LIMIT 1"));
		                  $i++;
		                  echo '<tr ';
						  if($item['check_thu'] == '1')
						  {
							  echo'style="background-color:green;color:white"';
							  $string = 'Nhận';
						  }
						  else if($item['check_thu'] == '0')
						  {
							  $string = 'Chi';

						  }
						  echo'>
		                  <td style="text-align: center; "></td>
		                  <td style="text-align: center; ">'.$item['datetime'].'</td>
		                  <td style="text-align: center; ">'.$dulieuketoan['ten'].'</td>
		                  <td style="text-align: center;">'.$item['kg_chinhanh'].'</td>
		                  <td style="text-align: center;">'.number_format($item['payment_price']).' đ</td>
		                  <td style="text-align: center;">'.$string.'('.$item['payment_method'].')</td>
		                  <td style="text-align: center;">'.$item['doitac'].'</td>
		                  <td style="text-align: center;">';
						  if($item['check_luong'] == 1)
						  {
							echo 'Chi lương: '.$item['noidung'];

						  }
						  else
						  {
						  echo $item['noidung'];
						  }
						  echo'</td>
		                  <td style="text-align: center;">';
						  
						  
						  	$myArray = explode(',', $item['img']);

							foreach ( $myArray as $a){
								if($a != "")
								{
							  echo'<a href="../upload/'.$a.'" target="_blank"><i class="fas fa-image"></i></a> ';
								}
							}
						  
						  
						  echo'</td>
		                  <td style="text-align: center; color:black"><form action="" method="POST"><a href="m_admin.php?m=cash_manager&edit='.$item['id'].'" class="btn btn-warning btn-sm" ><i class="fas fa-edit"></i> Edit </a>
						  <input type="hidden" name="id_delete" value="'.$item['id'].'">
						  <button type="submit" name="btn_delete" class="btn btn-danger btn-sm" style="text-align:right"  onclick="return confirm(\'Chắc chắn muốn xóa chi tiêu số tiền: '.number_format($item['payment_price']).'  ?\')" />Delete</button>
						  </form>
						  </a>
						  
						  						 
						  
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
</body>
</html>
<script>
$(document).ready(function() {

	$('.add2').click(function() {
		$("#themhinhanh").append("<input type='file'  class='form-control  custom-file-upload' name='photo[]' id = 'fileSelect' required multiple></div>");
	});
		

		
		
	});
	

</script>