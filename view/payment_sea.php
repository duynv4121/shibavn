<?php  
	include('top.php');
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

	$id_package = $_GET['id_package'];
	$tong_thanhtoan = 0;

	$payment = mysql_query("SELECT * FROM ns_payment WHERE id_package = '$id_package'") or die(mysql_error());
	$count = mysql_num_rows($payment);
	if ($count == 0) {
		$tong_thanhtoan = 0;
	}else{
		while ($item = mysql_fetch_array($payment)) {
			$tong_thanhtoan += ($item['tienmat'] + $item['chuyenkhoan']);
		}
	}


	$total = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package_sea WHERE id = '$id_package'"));

	if (isset($_POST['btn_submit'])) {
		
		$datenow = date('Y-m-d H:i:s');;
		$tienmat = $_POST['tienmat'];
		$chuyenkhoan = $_POST['chuyenkhoan'];

		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
	      	$ganthoigian = date("H_i_s");
			$newFileName = 'receipt_sea_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

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
						// mysql_query("UPDATE `ns_listhoadon` SET `img`='$newFileName' WHERE (`id`='$excute')") or die(mysql_error());

						mysql_query("INSERT INTO `ns_payment` (`id_package`, `tienmat`, `chuyenkhoan`, `date`,`img`)
						VALUES ('$id_package','$tienmat', '$chuyenkhoan', '$datenow','$newFileName')") or die(mysql_error()); 
					}else{
						echo "Lỗi: không thể di chuyển tệp đến upload/";
					}
	            } 
	        } else{
	            echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
	        }
	    } else{
	        echo "Error: " . $_FILES["photo"]["error"];
	    }


		$conlai = round($total['total']) - round($tong_thanhtoan);
		if (round($tong_thanhtoan) != 0  AND ((round($tienmat) + round($chuyenkhoan)) == $conlai)) {
			mysql_query("UPDATE `ns_package_sea` SET `payment` = 1 WHERE id ='$id_package'") or die(mysql_error());
		}elseif (round($tong_thanhtoan) == 0  AND ((round($tienmat) + round($chuyenkhoan)) == $conlai)) {
			mysql_query("UPDATE `ns_package_sea` SET `payment` = 1 WHERE id ='$id_package'") or die(mysql_error());
		}

		echo'<script> 
			alert("Cập nhật thanh toán thành công!");
			window.location.href="accountant_thu.php";
        </script>';
		
	}
?>
<div class="container-fluid">
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-3">
				<h5>Cập nhật thanh toán (<?php echo 'ID lô: '.$id_package. '- Total: '.round($total['total']).' - Còn lại: '.(round($total['total']) - round($tong_thanhtoan)); ?>)</h5>
				<hr>
				<div class="form-group" >
					<label for="">Tiền mặt </label>
					<input type="text" name="tienmat" class="form-control" placeholder="Tiền mặt">
				</div>
				<div class="form-group" >
					<label for="">Chuyển khoán </label>
					<input type="text" name="chuyenkhoan" class="form-control" placeholder="Chuyển khoản">
				</div>
				<div class="form-group">
					<label  for="">Upload hình ảnh  </label>
					<input type="file" required class="form-control  custom-file-upload" name="photo" id = "fileSelect">
				</div>
				<button type="submit" name="btn_submit" class="btn btn-success">Cập nhật</button>
			</div>
		</div>
	</form>
	
</div>

<?php  
    include('footer.php');
?>
<script type="text/javascript">
	

</script>