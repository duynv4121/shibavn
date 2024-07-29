<?php  
	include('top.php');
	include('../controller/bill.php');
	
	
		@$barcode = $_GET['id'];
	
	
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
	if (isset($_POST['btn_success'])) {
		
	
		
		$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];

		$excute = $_GET['id'];

		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
	      	$ganthoigian = date("H_i_s");
			$newFileName = 'pickup_'.$excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

	        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	        $filename = $_FILES["photo"]["name"];
	        $filetype = $_FILES["photo"]["type"];
	        $filesize = $_FILES["photo"]["size"];

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
	                $compressedImage = compressImage($_FILES["photo"]["tmp_name"],$location,60);

					if($compressedImage){ // có thể có lỗi
						mysqli_query($conn,"UPDATE `ksn_pickup` SET `img`='$newFileName' WHERE (`id`='$excute')") or die(mysqli_error());
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

		
	if($roleid == 1 or $roleid == 5)
		{
		
		$id_bill = $_POST['id_bill'];
		$sokien = $_POST['sokien'];
		$pickup_weight = $_POST['pickup_weight'];

		
		mysqli_query($conn,"UPDATE `ksn_pickup` SET `pickup_status`='3',`pickup_fn_time`='$datenow2',`id_bill`='$id_bill',`sokien`='$sokien',`pickup_weight`='$pickup_weight',`uid_pickup`='$uid'		WHERE (`id`='".$_GET['id']."')");
		echo'<script> 
							alert("Hoàn thành pickup đơn hàng");
							window.location.href="list_pickup.php";
		</script>';
		}
		else
		{
		
		}
		
	}
?>
<link rel="stylesheet" type="text/css" href="../scan_lib/example/css/styles.css" />
<style type="text/css">
	.nopadding {
	   padding: 0 !important;
	   margin: 0 !important;
	}

</style>
<div class="container-fluid">
	
	<br>
	
		<?php
		if(isset($_GET['id']))
		{
			$laydulieupickup = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_pickup where id='".$_GET['id']."'"));
			$laydulieucongty = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$laydulieupickup['uid']."'"));
			echo'							<form action="" method="POST" enctype="multipart/form-data">

			<div class="row" >
			
			
			
				<div class="col-md-4 ">	
				
				
				
				<div class="card card-danger">
				
				  <div class="card-header">
					<h3 class="card-title">Xác nhận pickup hoàn thành</h3>
				  </div>
				  <div class="card-body">
					<p>Mã Pickup: : <b>KSN'.($laydulieupickup['id']+1000000).'</b></p>
					<p>Company name: '.$laydulieucongty['congty'].'</p>
					<p>Address: '.$laydulieupickup['pickup_address'].'</p>
				<div class="form-group">

					<label for="">Mã KG BILL </label>
					<input type="text" name="id_bill" class="form-control" placeholder="Nhập mã KG BILL" value="'.$laydulieupickup['id_bill'].'">
				</div>
				
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Số kiện</label>
										<input type="text" name="sokien" class="form-control"value="'.$laydulieupickup['sokien'].'"  placeholder="Số kiện">

				</div>
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Cân nặng</label>
										<input type="text" name="pickup_weight" class="form-control" value="'.$laydulieupickup['pickup_weight'].'" placeholder="Cân nặng">

				</div>
				
				
				';	echo'<hr>
							<div class="form-group">
								<label  for="">Upload hình ảnh hàng pickup </label>';
								if($uid == 1)
								{
									echo'<input type="file" required class="form-control  custom-file-upload" name="photo" id = "fileSelect">';
								}
								else
								{
									echo'<input type="file" required class="form-control  custom-file-upload" name="photo" id = "fileSelect">';
								}
								
						echo'	</div>';
						
						echo'
					<button type="submit" name="btn_success" class="btn btn-success form-control">Hoàn Thành</button>
					
						
				  </div>
		
				
				
				
			</div></div>
							
							';
							/*
							echo'
							<div class="col-md-4 ">	
							<div id="wrapper1">
					<p>Ký tên bên dưới</p><hr>
			<div id="canvas">
				Trình duyệt không hỗ trợ
			</div>
		
			<script>
				zkSignature.capture();
			</script>
            <br>
			<button type="button"  class="btn btn-danger btn-sm" onclick="zkSignature.clear()">
				Ký Lại
			</button>
			
			<button type="button" class="btn btn-danger btn-sm" onclick="zkSignature.save()">
				Tạo Chữ Ký
			</button>
			
				<hr>			<center>
	<button type="submit" name="btn_submit" onclick="zkSignature.send()" class="btn btn-primary" >Tạo Tài Khoản </button></center>
<br>

<font color=red>Lưu ý *: Nhập Tên Liên Hệ trước sau đó ấn Tạo chữ ký để hoàn thành bước tạo chữ ký 
							</div>';*/
							
							echo'
			
		</form>';
			
		}
		else
		{
		
		}
		?>
</div>
<br>
<?php  
    include('footer.php');
?>
<script src="gd/plugins/select2/js/select2.full.min.js"></script>

<script src="//webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>
<script src="../scan_lib/dist/quagga.js" type="text/javascript"></script>
<script src="../scan_lib/example/live_w_locator.js" type="text/javascript"></script>
<!-- <script type="text/javascript">
	function CreateByBarcode(){
		let value = $('#bc').val();
		window.location.href = `create_sub_package.php?id=${value}`;
	}

</script> -->
<style type="text/css">
	.drawingBuffer{
		margin-top: -29rem;
	}
</style>

<script>
	
</script>

<script>
	
	


</script>