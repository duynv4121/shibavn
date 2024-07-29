<?php  ini_set('memory_limit', '-1');
	include('top.php');
	include('../controller/bill.php');
	
	
		@$barcode = $_GET['b'];
	
	
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
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];

		$excute = $_GET['b'];

		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
	      	$ganthoigian = date("H_i_s");
			$newFileName = 'xuat_'.$excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

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
						
						
		
						if($roleid == 1 or $roleid == 5 or $roleid == 4 or $roleid == 3)
						{
						mysqli_query($conn,"UPDATE `ns_listhoadon` SET `img_xuat`='$newFileName' WHERE (`id_code`='$excute')") or die(mysqli_error());

							
						$layidmawb = $_GET['mawbid'];
						$layid_code = $_GET['b'];
						$box_no = $_POST['box_no'];
											/*
											$demso = '';
											if($_POST['box_no'] != '0')
											{
												$box_no =  substr($_POST['box_no'],3);
											}
										
											else
											{	
												
												$daucuoi = substr($layid_code, -4);
												$checkbao = mysqli_query($conn,"select id from ksn_shipment_details order by id DESC LIMIT 1");
												if(mysqli_num_rows($checkbao) == 0) {
													echo '<script>alert("Lỗi Hệ thống xin kiểm tra lại");window.location = "scan_xuat_dt_for_doc.php?mawbid='.$_GET['mawbid'].'";</script>';

													exit();
												}
												else
												{	
													$sobaoa = mysqli_fetch_assoc($checkbao)or die(mysqli_error());
													if($_POST['btn_submit'] == 'next')
													{
														$layidbagmoi = mysqli_fetch_assoc(mysqli_query($conn,"select MAX(box_no_bak) AS box_max from ksn_shipment_details where awb='$layidmawb'"));
														if($layidbagmoi['box_max'] == '')
														{
															$demso = 1;
														}
														else
														{
															$demso = $layidbagmoi['box_max']+1;
														}
														@$box_no = ($sobaoa['id']+666700);
														@$box_no = $box_no.$daucuoi.'B'.$demso;
													}
													else
													{
														
														@$box_no = ($sobaoa['id']+666700);
														@$box_no = $box_no.$daucuoi;
													}
													
												}	
											}
											*/
						
						$checktontai= mysqli_query($conn,"select * from ksn_shipment_details where id_listhoadon='$layid_code'");
						if(mysqli_num_rows($checktontai) >= 1)
						{
							echo'<script>
							window.location = "scan_xuat_dt.php?mawbid='.$_GET['mawbid'].'&bag_save='.$_GET['bag_save'].'";
							</script>';
							exit();
						}	
						mysqli_query($conn,"INSERT INTO `ksn_shipment_details` (`awb`, `id_listhoadon`, `date`,`box_no`,`box_no_bak`,`uid`) VALUES ('$layidmawb', '$layid_code','$datenow2','$box_no','$demso','$uid')");
						
						
						$id_insert = mysqli_insert_id($conn);
						$box_no_new = mysqli_fetch_assoc(mysqli_query($conn,"select box_no from ksn_shipment_details where id='$id_insert'"));
						
						mysqli_query($conn,"UPDATE `ns_listhoadon` SET `status`='2' WHERE (`id_code`='$layid_code')");
						
						$laydulieukienb = mysqli_fetch_assoc(mysqli_query($conn,"select id_package,id_code from ns_listhoadon where id_code='".$layid_code."'"))or die("Loi 11");
						$laydulieuchinhanh = mysqli_fetch_assoc(mysqli_query($conn,"select kg_chinhanh from ns_package where id ='".$laydulieukienb['id_package']."'"))or die("Loi 22");
						
						mysqli_query($conn,"UPDATE `ns_package` SET `status`='2' WHERE (`id`='".$laydulieukienb['id_package']."')");

						
						add_trackingBill($barcode,'Handling at the warehouse',location_chinhanh($laydulieuchinhanh['kg_chinhanh']),$conn);
						
						$laydulieutrackshipment = mysqli_query($conn,"select * from ns_tracking_shipment where id_awb='$layidmawb'");
						while($laydulieutrack = mysqli_fetch_array($laydulieutrackshipment))
						{
							add_trackingBill2($barcode,$laydulieutrack['status'],$laydulieutrack['address'],$laydulieutrack['date'],$conn);
						}
						

						if($_POST['btn_submit'] == 'next')
						{					
					
						}
						else
						{
						echo '<script>alert("Scan xuất hàng thành công. ");window.location = "scan_xuat_dt_for_doc.php?mawbid='.$_GET['mawbid'].'";</script>';
						}
						
						
						}
						
						
						else
						{
						
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
		if(isset($_GET['mawbid']))
		{
			$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment where id='".$_GET['mawbid']."'"));

			if(mysqli_num_rows(mysqli_query($conn,"select * from ksn_shipment where id='".$_GET['mawbid']."'")) < 1)
			{
			echo '
					<script>
						alert("Không có MAWB này trong hệ thống");
						window.location = "scan_xuat.php";

					</script>
				';			
			}
			if(isset($_GET['b']))
			{
				if(mysqli_num_rows(mysqli_query($conn,"select id_listhoadon from ksn_shipment_details where id_listhoadon='".$_GET['b']."'")) >= 1)
				{
					echo '
						<script>
							alert("Kiện này đã được quét xuất rồi !");
							window.location = "scan_xuat_dt_for_doc.php?mawbid='.$_GET['mawbid'].'&bag_save='.$_GET['bag_save'].'";

						</script>
					';
					
				}
				
				
		
			else
			{
					$laydulieukiena = mysqli_query($conn,"select * from ns_listhoadon where id_code='".$_GET['b']."'");
					
					
					
					$laydulieukien = mysqli_fetch_assoc($laydulieukiena);
					
					$laythongtinpackage =  mysqli_fetch_assoc(mysqli_query($conn,"select checkthanhtoan,congno,kg_dichvu,payment_type from ns_package where id='".$laydulieukien['id_package']."'"));
					if($laydulieukien['status'] == '0')
					{
						
							echo'<script>
							alert("Kiện hàng chưa được quét nhập không thể quét xuất");
							window.location = "scan_xuat_dt_for_doc.php?mawbid='.$_GET['mawbid'].'&bag_save='.$_GET['bag_save'].'";

						</script>';
						exit();
						
					}
					if(mysqli_num_rows($laydulieukiena) < 1)
					{
						
							echo'<script>
							alert("Không có mã kiện này trong hệ thống");
							window.location = "scan_xuat_dt.php?mawbid='.$_GET['mawbid'].'&bag_save='.$_GET['bag_save'].'";

						</script>';
						exit();
						
					}
					
					if($laythongtinpackage['congno'] == 1)
					{
						if($laythongtinpackage['checkthanhtoan']  == 2 || $laythongtinpackage['checkthanhtoan'] == 5)
						{
						}
						else
						{
							echo'<script>
							alert("Kiện hàng có công nợ 1 ngày chưa thanh toán không thể xuất hàng");
							window.location = "scan_xuat_dt_for_doc.php?mawbid='.$_GET['mawbid'].'&bag_save='.$_GET['bag_save'].'";

						</script>';
						exit();
						}
					}
					
					
					#### Sale
					if($laythongtinpackage['payment_type'] == 'after' && $laythongtinpackage['checkthanhtoan'] == '1')
					{
						
							echo'<script>
							alert("Kiện đang chờ sale thanh toán trước khi xuất hàng!");
							window.location = "scan_xuat_dt_for_doc.php?mawbid='.$_GET['mawbid'].'&bag_save='.$_GET['bag_save'].'";

						</script>';
						exit();
						
					}
					
					
						
					
						echo'
						
							<form action="" method="POST" enctype="multipart/form-data">

						
						<div class="row">
						
						</div>
						';	
						
							echo'
							<div class="row">
						<div class="col-md-5">
							<div class="card card-info">
							<div class="card-header">
							<h3 class="card-title">ID CODE: <font color=white><b>'.$_GET['b'].'  </b></font><span class="editbag"style="color:#DCDCDC;cursor:pointer"> <i class="fas fa-edit"></i></span></h3> 
							</div>
							<div class="card-body">';
							
							if(isset($_GET['bag_save']) && $_GET['bag_save'] != "")
							{
								echo'<div class="form-group">	
							<label  for="">BAG NO</label>
							<input type="text" class="form-control" readonly name="box_no" id="baga" value="KSN'.$_GET['bag_save'].'">
							</div>';
							}
							else
							{
								echo'<input type="hidden" class="form-control" readonly name="box_no" id="baga" value="0">';
							}
					
							
							echo'
						
							
							
							<label  for="">Thông tin kiện hàng xuất </label><br>
							- Kích Thước: '.$laydulieukien['length'].' x '.$laydulieukien['width'].' x '.$laydulieukien['height'].' CM<br>
							- Cân nặng: '.$laydulieukien['cannang'].' kg<br>
							- MAWB xuất hàng: <b>'.$laydulieu['awb'].'</b> <br>
							
						

											

						';
						
						echo'<hr>
							<div class="form-group">
								<label  for="">Upload hình ảnh kiện hàng </label>';
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
						
						
						</div>
						<div class="card-footer"><div class="form-check">
<!--<input class="form-check-input" type="checkbox" name="check_bag" value="1">
<label class="form-check-label">Check nếu scan tiếp tục ở bao này</label>-->
</div>
						<button  type="submit" name="btn_submit" class="btn btn-danger btn-sm" value="next">TIẾP TỤC SCAN VÀO BAG NÀY</button>
						<button  type="submit" name="btn_submit" class="float-right btn btn-success btn-sm">HOÀN THÀNH</button>
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
					<h3 class="card-title"><span class="edit2"style="color:#DCDCDC;cursor:pointer"> <i class="fas fa-edit"></i></span> MAWB: <a href="list_scan_nhap.php">'.$laydulieu['awb'].' </a> ['.dichvu($conn,$laydulieu['kg_dichvu']).' | '.$laydulieu['kg_chinhanh'].']</h3>
				  </div>
				  <div class="card-body">
					

					<div id="interactive" class="viewport"></div>

					<input type="text"  name="b" class="form-control" id="bc" style="color:green;font-weight:bold" placeholder="Scan hoặc nhập mã HAWB" value="" required>
					<input type="text" hidden name="mawbid" class="form-control" value="'.$_GET['mawbid'].'" id="bc" style="color:green;font-weight:bold" placeholder="">
					';
					if(isset($_GET['bag_save']) && $_GET['bag_save'] != '' )
					{
						echo'<input type="text" hidden name="bag_save" class="form-control" value="'.$_GET['bag_save'].'">
';
echo'Tiếp tục scan mã bao: KSN'.$_GET['bag_save'];
					}
					echo'
					<!-- <a type="button" class="btn btn-success form-control" onclick="CreateByBarcode()" href="#">Tạo</a> --><br>
					<button type="submit" name="btn_create" class="btn btn-primary form-control">Scan</button>
					
						
				  </div>
				  <!-- /.card-body -->
				</div>
				
							
				
				</div>
				
			</div>	';
								
								if(!isset($_GET['bag_save'])){
								echo'<center>	<a style="" href="scan_bag.php?mawbid='.$_GET['mawbid'].'" >SCAN BAG CŨ</a></center>';}
echo'
		</form>';
			}
			
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
	$('.edit2').click(function() {
		
		$("#bc").removeAttr('readonly');
	

	});
$('.editbag').click(function() {
		
		$("#baga").removeAttr('readonly');
	

	});


	$('.edit').click(function() {
		
		$("#thongtinkien1").removeAttr('readonly');
		$("#thongtinkien2").removeAttr('readonly');
		$("#thongtinkien3").removeAttr('readonly');
		$("#thongtinkien4").removeAttr('');

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