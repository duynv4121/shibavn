<?php  
	include('top.php');
	include('../controller/bill.php');
		include('../controller/accountant.php');

	
		@$barcode = $_GET['b'];
	
		function roundUp($number, $nearest){
			return ceil($number/0.5)*0.5;;
		}
		
		
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
	if (isset($_POST['btn_submit'])) {
		
	
		
		$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		$cannang = $_POST['cannang'];
		$length = $_POST['length'];
		$width = $_POST['width'];
		$height = $_POST['height'];
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];

		$excute = $_GET['b'];

		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
	      	$ganthoigian = date("H_i_s");
			$newFileName = 'nhap_'.$excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

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
						mysqli_query($conn,"UPDATE `ns_listhoadon` SET `img`='$newFileName' WHERE (`id_code`='$excute')") or die(mysqli_error());
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

		
	if($roleid == 1 || $roleid == 5)
		{
		
						$checktontai= mysqli_query($conn,"select * from ns_listhoadon where id_code='$barcode' AND status='1'");
						if(mysqli_num_rows($checktontai) >= 1)
						{
							echo'<script>
							window.location = "scan_nhap.php";
							</script>';
							exit();
						}
		
		$id_phuthu =  cvtext($_POST['id_phuthu']);
		$soluong =  cvtext($_POST['soluong']);
		$old_cannang =  cvtext($_POST['old_cannang']);
		$old_convert =  cvtext($_POST['old_convert']);

		for ($i=0; $i<sizeof($id_phuthu);$i++) {
			if($id_phuthu[$i] != "")
			{
			$layphuthua = mysqli_query($conn,"select * from ksn_listphuthu where id='".$id_phuthu[$i]."'");
			$layphuthu  = mysqli_fetch_assoc($layphuthua);
			mysqli_query($conn,"INSERT INTO `kns_listhoadonphuthu` (`id_code`, `tenphuthu`, `price`, `soluong`) VALUES ('$barcode', '".$layphuthu['tenmathang']."', '".$layphuthu['price']."', '".$soluong[$i]."')");
			}
		}
		
		$laydulieukienb = mysqli_fetch_assoc(mysqli_query($conn,"select id_package,id_code from ns_listhoadon where id_code='".$barcode."'"));

		///// doi thong tin can nang
		$laydulieuchinhanh = mysqli_fetch_assoc(mysqli_query($conn,"select kg_chinhanh,kg_dichvu,gross_weight,charge_weight from ns_package where id ='".$laydulieukienb['id_package']."'"));

		$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,thetich from ksn_dichvu where id='".$laydulieuchinhanh['kg_dichvu']."'"));
		
		
		$convert_weight = roundup((($length*$width*$height)/$dulieudichvu['thetich']),0.5);
				
				
				if($convert_weight > $cannang)
				{
					$charge_weight = $convert_weight;
					
				}
				else
				{
					$charge_weight = roundup($cannang,0.5);
					
				}
				if($charge_weight > 20.5)
				{
						$charge_weight = ceil($charge_weight);
				}
		mysqli_query($conn,"UPDATE `ns_listhoadon` SET `status`='1', `length`='$length', `width`='$width', `height`='$height',`cannang`='$cannang',`convert_weight`='$convert_weight',`charge_weight`='$charge_weight' WHERE (`id_code`='$barcode')");
		
		
		$dulieucannang = mysqli_query($conn,"select cannang,charge_weight from ns_listhoadon where id_package='".$laydulieukienb['id_package']."'");
		$sum_cross = 0;
		$sum_charge = 0;
		while($dulieucannanga = mysqli_fetch_array($dulieucannang,MYSQLI_ASSOC))
		{
			$sum_cross+= $dulieucannanga['cannang'];
			$sum_charge+= $dulieucannanga['charge_weight'];
		}
		
		echo $sum_cross.'-'.$sum_charge;
		
		if($sum_charge >= 21)
		{
			$sum_charge = 0;
			$laydulieucannang = mysqli_query($conn,"select id,charge_weight,cannang,convert_weight from ns_listhoadon where id_package='".$laydulieukienb['id_package']."'");
			while($checkdulieucannang = mysqli_fetch_array($laydulieucannang,MYSQLI_ASSOC))
			{
				$kien_charge_weight = ceil($checkdulieucannang['charge_weight']);
				$sum_charge+= $kien_charge_weight;
				mysqli_query($conn,"UPDATE `ns_listhoadon` SET `charge_weight`='$kien_charge_weight' WHERE (`id`='".$checkdulieucannang['id']."')");
			}
		}
		
		### gui tin nhan sms
		$laythongtinkienlon = mysqli_fetch_assoc(mysqli_query($conn,"select id_code,khach_cuocbay from ns_package where id='".$laydulieukienb['id_package']."'"));
		$thaythongtinguisms = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_sms_contact where id_code='".$laythongtinkienlon['id_code']."'"));
		
		if($thaythongtinguisms['check'] == "0")
		{
			
		}
		
		
		
		
		
		//aaaaaaaaaaaaaaaaaaaaaaaa
		
		mysqli_query($conn,"UPDATE `ns_package` SET `gross_weight`='$sum_cross', `charge_weight`='$sum_charge',`status`='1'		WHERE (`id`='".$laydulieukienb['id_package']."')");
		mysqli_query($conn,"INSERT INTO `ksn_scan_nhap` (`id_listhoadon`, `date`, `datetime`,`uid`) VALUES ($barcode, '$datenow2' , '$datenow2' ,'$uid')");
		
			/// Add tính giá cost gốc
			$laydulieuchinhanh = mysqli_fetch_assoc(mysqli_query($conn,"select kg_chinhanh,kg_dichvu,charge_weight,id_code,id_nguoinhan from ns_package where id ='".$laydulieukienb['id_package']."'"))or die("Loi 22");
			$rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$laydulieuchinhanh['id_nguoinhan']."'"));

			$sotiengoc= sum_package_code($laydulieuchinhanh['kg_dichvu'],$laydulieuchinhanh['charge_weight'],$rName['city'],$rName['country_id'],$laydulieuchinhanh['kg_chinhanh'],$conn,$rName['post_code'],$rName['state'],$laydulieuchinhanh['id_code']);

			mysqli_query($conn,"UPDATE `ns_package` SET `cuoc_goc`='$sotiengoc' WHERE (`id`='".$laydulieukienb['id_package']."')");

			##########
		
		
		
		
		
		
		
		add_trackingBill($barcode,'Kiện hàng đã được nhận bởi TSC TEAM',location_chinhanh($laydulieuchinhanh['kg_chinhanh']),$conn);

		echo '<script>alert("Scan kiện hàng thành công");window.location = "scan_nhap.php";</script>';
		
		
		}
		else
		{
				echo '
			<script>
				alert("Update sub package complete !");
				window.location = "list_packfwd.php";
			</script>
		';
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
	<div>
		<!--<fieldset class="reader-config-group">
            <label>
                <span>Barcode-Type</span>
                <select name="decoder_readers">
                    <option value="code_128" selected="selected">Code 128</option>
                </select>
            </label>
            <label>
                <span>Resolution (width)</span>
                <select name="input-stream_constraints">
                    <option selected="selected" value="1280x720">1280px</option>
                </select>
            </label>
            <label>
                <span>Patch-Size</span>
                <select name="locator_patch-size">
                    <option selected="selected" value="medium">medium</option>
                </select>
            </label>
            <label>
                <span>Workers</span>
                <select name="numOfWorkers">
                    <option selected="selected" value="4">4</option>
                </select>
            </label>
            <label>
                <span>Camera</span>
                <select name="input-stream_constraints" id="deviceSelection">
                </select>
            </label>
        </fieldset>-->
	</div>
	
	<br>
	
		<?php
		if(isset($_GET['b']))
		{
			if(mysqli_num_rows(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$_GET['b']."'")) < 1)
			{
			echo '
					<script>
						alert("Mã kiện không có trong hệ thống");
						window.location = "scan_nhap.php";

					</script>
				';			
			}
			else if(mysqli_num_rows(mysqli_query($conn,"select id_listhoadon from ksn_scan_nhap where id_listhoadon='".$_GET['b']."'")) >= 1)
			{
				echo '
					<script>
						alert("Kiện này đã được quét rồi !");
						window.location = "scan_nhap.php";

					</script>
				';	
			}
		
			else
			{
			$laydulieukiena = mysqli_query($conn,"select * from ns_listhoadon where id_code='".$_GET['b']."'");
			$laydulieukien = mysqli_fetch_assoc($laydulieukiena);
			$laytongsokienscan = mysqli_num_rows(mysqli_query($conn,"select * from ns_listhoadon where id_package='".$laydulieukien['id_package']."' AND status='1'"));
			$laytongsokien = mysqli_num_rows(mysqli_query($conn,"select * from ns_listhoadon where id_package='".$laydulieukien['id_package']."'"));
			$layidkientong = mysqli_fetch_assoc(mysqli_query($conn,"select id_code from ns_package where id='".$laydulieukien['id_package']."'"));
			echo'
				<form action="" method="POST" enctype="multipart/form-data">

			<div class="row">
			<div class="col-md-5">
			
			<div class="card card-info">
				<div class="card-header">
				<h3 class="card-title">ID CODE: <font color=white><b>'.$_GET['b'].'  </b></font><span class="edit"style="color:#DCDCDC;cursor:pointer"> <i class="fas fa-edit"></i></span></h3> 
				</div>
				<div class="card-body">
				
							Main Package: '.$layidkientong['id_code'].'<br>
							<font color=red>Scanning '.($laytongsokienscan+1).'/'.$laytongsokien.'</font>

				<div class="row">
				<div class="col-3">
				<label>Lenght</label>
				<input type="text" class="form-control" id="thongtinkien1" name="length" value="'.$laydulieukien['length'].'" placeholder="" readonly>
				<input type="hidden" class="form-control" id="thongtinkien1" name="old_cannang" value="'.$laydulieukien['cannang'].'" placeholder="" readonly>
				<input type="hidden" class="form-control" id="thongtinkien1" name="old_convert" value="'.$laydulieukien['convert_weight'].'" placeholder="" readonly>
				</div>
				<div class="col-3">
				<label>Width</label>

				<input type="text" class="form-control" id="thongtinkien2" name="width" placeholder="" value="'.$laydulieukien['width'].'" readonly>
				</div>
				
				<div class="col-3">
				<label>Height</label>

				<input type="text" class="form-control" id="thongtinkien3" name="height" value="'.$laydulieukien['height'].'" placeholder="" readonly>
				</div>
				
				<div class="col-3">
				<label> Weight</label>

				<input type="text" class="form-control"id="thongtinkien4" name="cannang" value="'.$laydulieukien['cannang'].'" placeholder="" readonly>
				</div>
				</div>
				</div>

			</div>
			
			</div>
			</div>
			
			<div class="row">
			
			</div>
			';	
			
				echo'
				<div class="row">
			<div class="col-md-5">
				<div class="card card-info">
				<div class="card-header">
				<h3 class="card-title">OPS Khai báo hàng</h3>
				</div>
				<div class="card-body">
				
				
			<div class="form-groupa" id="khaihanga">
					<label for="">Khai hàng</label>
					<div class="aaa" id="z1"><div class="abcd">
								<div class="row">
					                  <div class="col-8">

					';
							$catalogs = mysqli_query($conn,"SELECT * FROM ksn_listphuthu ORDER BY id DESC ") or die("Loi");

							echo'
								<select class="form-control select2" name="id_phuthu[]" style="width: 100%;" ><option value="">Chọn mặt hàng phụ thu</option>';
								while ($item = mysqli_fetch_array($catalogs,MYSQLI_ASSOC)) {
			                  echo '  <option value="'.$item['id'].'">'.$item['id'].'-'.$item['tenmathang'].' ['.number_format($item['price']).'đ/'.$item['type'].'] </option>';
			                }
  
							echo'</select></div>					                  <div class="col-3">
	';
			                
						echo'
						<input type="number" value="" name="soluong[]" class="form-control" placeholder="Số lượng"  style=""></div> 
						<div class="col-1"><span class="btn-danger  remove btn-sm" style="cursor:pointer;"><i class="fas fa-trash-alt"></i></span>
						</div></div>
						</div>
				</div><br>
									<span class="btn-danger add" style="padding:5px; cursor:pointer;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</span>

								

			';
			/*
			echo'<hr>
				<div class="form-group">
					<label  for="">Upload hình ảnh  </label>';
					if($uid == 1)
					{
						echo'<input type="file" required class="form-control  custom-file-upload" name="photo" id = "fileSelect">';
					}
					else
					{
						echo'<input type="file" required class="form-control  custom-file-upload" name="photo" id = "fileSelect">';
					}
					
			echo'	</div>';
			*/
			echo'
			</div>
			
			
			</div>
			<div class="card-footer">
			<button style="float:right;" type="submit" name="btn_submit" class="btn btn-primary">Xác Nhận</button>
			</div>
			
			</div></div></form>

';
			}
		}
		else
		{
		echo'
		<form action="" method="GET">
			<div class="row" >
				<div class="col-md-12 ">
				
				<div class="card card-danger">
				  <div class="card-header">
					<h3 class="card-title">	<span class="edit2"style="color:#DCDCDC;cursor:pointer"> <i class="fas fa-edit"></i></span> Scan Nhập Hàng [<a href="list_scan_nhap.php">List Scan Nhập</a>]</h3>
				  </div>
				  <div class="card-body" style=" background-color:#EEE9E9">
					<div id="interactive" class="viewport"></div>

					<input type="text" readonly name="b" class="form-control" id="bc" style="color:green;font-weight:bold" placeholder="" >
				
					<!-- <a type="button" class="btn btn-success form-control" onclick="CreateByBarcode()" href="#">Tạo</a> --><br>
					<button type="submit" name="btn_create" class="btn btn-primary form-control">Scan</button>
				  </div>
				  <!-- /.card-body -->
				</div>
				
					
				</div>
			</div>
		</form>';
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


	$('.edit').click(function() {
		
		$("#thongtinkien1").removeAttr('readonly');
		$("#thongtinkien2").removeAttr('readonly');
		$("#thongtinkien3").removeAttr('readonly');
		$("#thongtinkien4").removeAttr('readonly');

	});	
	$('.edit2').click(function() {
		
		$("#bc").removeAttr('readonly');
	

	});



	$(document).ready(function() {

	$('.add').click(function() {
	<?php echo'$("#z1").append(\'<div class="abcd"style="margin-top:5px;margin-bot:5px"><div class="row"><div class="col-8">';$catalogs = mysqli_query($conn,"SELECT * FROM ksn_listphuthu ORDER BY id DESC ") or die("Loi"); echo'<select class="form-control select2" name="id_phuthu[]" style="width: 100%;" required>'; while ($item = mysqli_fetch_array($catalogs,MYSQLI_ASSOC)) {echo '  <option value="'.$item['id'].'">'.$item['id'].'-'.$item['tenmathang'].' ['.number_format($item['price']).'đ/'.$item['type'].'] </option>'; }echo'</select></div>					                  <div class="col-3">';echo'<input type="number" value="" name="soluong[]" class="form-control" placeholder="Số lượng"  style=""></div> <div class="col-1"><span class="btn-danger  remove btn-sm" style="cursor:pointer;"><i class="fas fa-trash-alt"></i></span></div></div></div>\');';
	
	?>
	
	$('.select2').select2({
      theme: 'bootstrap4'
    })
	});
	
    $('body').on('click', '.remove', function () {
      $(this).parents('div.abcd').remove()
	  });
	});
	

      $('.select2').select2({
      theme: 'bootstrap4'
    })
    
</script>

<script>
	
	


</script>