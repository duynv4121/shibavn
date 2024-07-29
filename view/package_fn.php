<?php  
	include('top.php');
	include('../controller/bill.php');
	include('../controller/accountant.php');
	$id = $_GET['id'];
	// $data = getBillData($id);
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
	
	/*
	if (isset($_POST['btn_submit'])) {
		$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		$cannang = $_POST['cannang'];
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];
		//$checkboxes = explode(',', $_POST['catalog']);
	    $pcs = countSubByPackageId($id);
		$status = 1;
		$note = $_POST['note'];
		$sender_name = $_POST['sender'];
		$cuscode = $_POST['cuscode'];
		$excute = createBillForPacker($uid,$id,$date,$datenow2,$cannang,1,$status, $note,$pcs,$sender_name,$cuscode);
			
		$danhmuchang = $_POST['catalog'];
		$soluong = $_POST['soluong'];
		$unitprice = $_POST['unitprice'];

		$i = 0;
		while($i < sizeof($danhmuchang)) {
				if($danhmuchang[$i] != "")
				{
				mysql_query("INSERT INTO `ns_mapcatalog` (`id_bill`, `id_catalog`, `soluong`,`unitprice`) VALUES ('$excute', '".$danhmuchang[$i]."', '".$soluong[$i]."', '".$unitprice[$i]."')");
				}
				$i++;
			}
		
		
		/*
		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
	      	$ganthoigian = date("H_i_s");
			$newFileName = $excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

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
						mysql_query("UPDATE `ns_listhoadon` SET `img`='$newFileName' WHERE (`id`='$excute')") or die(mysql_error());
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
		
		
			
		
		$laynotecode = mysql_fetch_assoc(mysql_query("select * from ns_listhoadon where id=$excute"));
		$idnguoinhan =  mysql_fetch_assoc(mysql_query("select * from ns_package where id=$id"));
		$layquocgia = mysql_fetch_assoc(mysql_query("select * from ns_nguoinhan where id='".$idnguoinhan['id_nguoinhan']."'"));
		
		
		
		if($uid == 1)
		{
		echo '
			<script>
				alert("Tạo kiện hàng thành công ! ");
				window.location = "list_package.php";

			</script>
		';
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
	
		*/
		// deletecataloglist($data['id']);
	    if(isset($_POST['btn_update']))
	{
		$data = getPackageData($id,$conn);

		$payment_method = $_POST['payment_method'];
				$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];
		
		$excute = $data['id_code'];

		if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
	      	$ganthoigian = date("H_i_s");
			$newFileName = 'salepayment_'.$excute.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

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
					
					
							if($uid == 1 || $roleid == 6)
							{
							//$totalcuoc = $_POST['totalcuoc'];	
							//$user_id = $_POST['user_id'];	
							//mysqli_query($conn,"UPDATE `ns_package` SET `checkthanhtoan`='1' WHERE (`id_code`='".$_GET['id']."')");
							//mysqli_query($conn,"UPDATE `ns_user` SET `hanmuc`=`hanmuc`+$totalcuoc WHERE (`id`='$user_id')");
							mysqli_query($conn,"INSERT INTO `ksn_debit_sale` (`id_bill`, `timethanhtoan`, `bangchungthanhtoan`,`payment_method`) VALUES ('$excute', '".$datenow2."', '".$newFileName."', '".$payment_method."')") or die(mysqli_error());
							echo'<script> 
							alert("Cập nhật thành công thanh toán, xin hãy chờ kế toán duyệt!");
							window.location.href="package_fn.php?id='.$_GET['id'].'";
							</script>';
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
		
		
		
		if (isset($_POST['btn_upload'])) 
		{
			
			
			$name=basename($_FILES['file']['name']);
			$name1=explode('.',$name);
			$target_location ='';
			if($name1[count($name1)-1]=='pdf')
			{
					  $target_path = "upload_label/";
					$target_location = $target_path .date("Y-m-d"). basename($_FILES['file']['name']);
					$_SESSION['target_location'] = $target_location;
					move_uploaded_file($_FILES["file"]["tmp_name"], $target_location);
					$uploadedStatus = 1;
					
					mysqli_query($conn,"UPDATE `ns_package` SET `label_link`='$target_location' WHERE (`id`='$id')");
					echo'<script> 
				   alert("Upload label success!");

				  </script> ';	
			}
			else
			{
				echo'<script> 
				   alert("Just only accept PDF File!");

				  </script> ';	
			}
			
			
			 
			
		}	
	
	
	/*
	if (isset($_POST['btn_submit'])) 
	{

		$sokiennho =  cvtext($_POST['sokien']);
		$pack_type =  cvtext($_POST['pack_type']);
		$pack_length =  cvtext($_POST['pack_length']);
		$pack_width =  cvtext($_POST['pack_width']);
		$pack_height =  cvtext($_POST['pack_height']);
		$pack_weight =  cvtext($_POST['pack_weight']);
		$string_sokiennho = "";
		$date = date('Y-m-d');
		$datenow2 = date('Y-m-d H:i:s');
		// $sokien = $_POST['sokien'];
		// $giakhaibao = $_POST['giakhaibao'];
		// $unitprice = $_POST['giadongia'];
		// $giabaohiem = $_POST['giabaohiem'];
		// $total = $_POST['gia'];
		// $partner = $_POST['partner'];
		//$checkboxes = explode(',', $_POST['catalog']);
	    $pcs = countSubByPackageId($id);
		$status = 1;
		$note = "";
		$sender_name = $_POST['sender'];
		$cuscode = $_POST['cuscode'];
		for ($i=0; $i<$sokiennho;$i++) {
			
			echo $pack_type[$i].'-'.$pack_length[$i].'<br>';

			
			$excute = createBillForPacker($uid,$id,$date,$datenow2,$pack_weight[$i],1,$status, $note,$pcs,$cuscode,$pack_type[$i],$pack_length[$i],$pack_width[$i],$pack_height[$i]);

			
			
		}
		
		$iv_tensanpham =  cvtext($_POST['iv_tensanpham']);
		$iv_price =  cvtext($_POST['iv_price']);
		$iv_soluong =  cvtext($_POST['iv_soluong']);
		$iv_unit =  cvtext($_POST['iv_unit']);
		for ($i=0; $i<$sizeof($iv_tensanpham);$i++) {
			mysql_query("INSERT INTO `ns_mapcatalog` (`id_bill`, `soluong`, `iv_price`, `iv_unit`, `iv_tensanpham`) VALUES ('$id', '$iv_soluong', '$iv_price', '$iv_unit', '$iv_tensanpham')");
		}
		
		
		$package_tenhang = $_POST['package_tenhang'];
		$ks_reason = $_POST['ks_reason'];
		mysql_query("UPDATE `ns_package` SET `kg_tenhang`='$package_tenhang', `kg_reason`='$ks_reason' WHERE (`id`='$id')");
		
		
		echo'<script> 
				alert("Tạo bill thành công!");
                window.location.href="package_fn.php";
         </script>';
		
		
		//mysql_query("UPDATE `SHIBA_listhoadonus` SET `billtong`='$string_sokiennho',`color`='$color' WHERE (`id`='$idtong')");
	}
		
		
		
	*/
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	

	// if (isset($_POST['btn_exit'])) {
	// 	echo '
	// 		<script>
	// 			window.location = "scan_create_sub_package.php";
	// 		</script>
	// 	';
	// }
	$data = getPackageData($id,$conn);
	$sender = getSender($data['id_nguoigui'],$conn);
	$receiver = getReceiver($data['id_nguoinhan'],$conn);
	
		
	$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
	$dulieuthanhpho = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));
	$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,thetich,api_connect,api_dichvu from ksn_dichvu where id='".$data['kg_dichvu']."'"));
	
	
	if($data['hangketnoi'] != 'kango' AND $dulieudichvu['api_connect'] == 'kango')
	{
		
$url = 'https://kango-post.com/api/createbill.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$orderItem = '';
$laydulieukiencon = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$data['id']."'");
$i = 1;
while($laydulieukiencona = mysqli_fetch_array($laydulieukiencon))
{
	if($i <= $data['sokien'] AND $i != '1')
	{
	$orderItem .=',';	
	}
	$i++;
	$orderItem .='{
				"weight": "'.$laydulieukiencona['cannang'].'",
				"length": "'.$laydulieukiencona['length'].'",
				"width": "'.$laydulieukiencona['width'].'",
				"height": "'.$laydulieukiencona['height'].'"
				}';
}

$dataa = '{
				"brand": "'.$data['kg_chinhanh'].'",
				"serviceType": "'.$dulieudichvu['api_dichvu'].'",
				"addressLine1": "'.$receiver['address'].'",
				"addressLine2": "'.$receiver['address2'].'",
				"addressLine3": "'.$receiver['address3'].'",
				"receiverCompany": "'.$receiver['company_name'].'",
				"receiverName": "'.$receiver['name'].'",
				"city": "'.$dulieuthanhpho['name'].'",
				"state": "'.$receiver['state'].'",
				"postcode": "'.$receiver['post_code'].'",
				"phone": "'.$receiver['phone'].'",
				"country": "'.$dulieuquocgia['name'].'",
				"description": "'.$data['kg_tenhang'].'",
				"invoiceValue": "'.$data['kg_valueinvoice'].'",
				"referenceNo": "'.$data['id_code'].'",
				"orderItems": [
				'.$orderItem.'
				],	
				"reason": "Gift (no commercial value)",
				"Package_type": "Box"
				}
				';
				$payload = json_encode($dataa);




				// Attach encoded JSON string to the POST fields
				curl_setopt($ch, CURLOPT_POSTFIELDS, $dataa);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				// Set the content type to application/json
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
				'kango-api-key: 345d118c37e9ceaa1457'));

				// Return response instead of outputting

				// Execute the POST request
				$result = curl_exec($ch);
				$layketqua = json_decode($result,true);
				echo $result;
				// Close cURL resource
				curl_close($ch);
		
				if($layketqua['ID_Kango_BILL'] != "")
				{
				$catchuoi_hawb = explode(',', $layketqua['ID_HAWB']);

				$laydulieukiencon = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$data['id']."'");
				mysqli_query($conn,"UPDATE `ns_package` SET `hangketnoi`='kango',`id_code`='".$layketqua['ID_Kango_BILL']."', `billketnoi`='".$layketqua['ID_Kango_BILL']."' WHERE (`id`='$id')");
				mysqli_query($conn,"UPDATE `kns_listhoadonchiphi` SET `id_code`='".$layketqua['ID_Kango_BILL']."' WHERE (`id_code`='".$data['id_code']."')");
				$ii = 0;
				$string_status = 'Đã tạo nhãn cho kiện hàng';
				$string_detail = location_chinhanh($data['kg_chinhanh']);
				while($laydulieukiencona = mysqli_fetch_array($laydulieukiencon))
				{
					mysqli_query($conn,"DELETE FROM `ns_tracking_bill` WHERE (`id_hoadon`='".$laydulieukiencona['id_code']."' AND `status`='Đã tạo nhãn cho kiện hàng')");
					mysqli_query($conn,"UPDATE `ns_listhoadon` SET `id_code`='".$catchuoi_hawb[$ii]."',`billketnoi`='".$layketqua['ID_Kango_BILL']."', `hangketnoi`='kango' WHERE (`id`='".$laydulieukiencona['id']."')");
					
					add_trackingBill($catchuoi_hawb[$ii],$string_status,$string_detail,$conn);
					$ii++;
				}
				
			
					
				}
				$data = getPackageData($id,$conn);

	}

	if($roleid == 2 || $roleid == 6 || $roleid == 5)
	{
		if($data['uid'] != $uid)
		{
			exit();
		}
	}
	
	
	
	$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
	$dulieuthanhpho = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));
	$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,thetich from ksn_dichvu where id='".$data['kg_dichvu']."'"));
	$checkroletao = mysqli_fetch_assoc(mysqli_query($conn,"select roleid from ns_user where id='".$data['uid']."'"));
	if($data['kg_reiceiversign'] == 1)
	{
	$checksign = "Có";
	}
	else
	{
	$checksign = "Không";
	}
?>

<link rel="stylesheet" href="selectbox/dist/virtual-select.min.css" />
<script src="selectbox/dist/virtual-select.min.js"></script>
<div class="container-fluid">
	<form action="" method="POST" enctype="multipart/form-data">
	<input type="text" hidden name="sender" value="<?php echo $sender['name'];?>">
	<input type="text" hidden name="cuscode" value="<?php echo $data['cus_code'];?>">
	
	<div class="row">
<div class="col-md-3">
<div class="card card-warning">

<?php echo'
<div class="card-header">

<h3 class="card-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin Lô Hàng : <b>'.$data['id_code'].'</b> <a href=""><i class="fas fa-edit"></i></a></h3>
</div>

<div class="card-body">

	<div class="row">
<div class="col-md-12">

<div class="callout callout-info">
<h5>Thông tin người gửi</h5>
<p>- Công ty: <b>'.$sender['company_name'].'</b></p>
<p>- Tên người gửi:  <b>'.$sender['name'].'</b></p>
<p>- Số Điện Thoại: '.$sender['phone'].'</p>

</div>

<div class="callout callout-info">
<h5>Thông tin dịch vụ</h5>
<p>- Dịch vụ: <b>'.$dulieudichvu['dichvu'].'</b></p>
<p>- Brand: '.$data['kg_chinhanh'].'</p>
</div>


</div>

<div class="col-md-12">

<div class="callout callout-info">
<h5>Thông tin người nhận</h5>
<p>- Công ty: <b>'.$receiver['company_name'].'</b></p>
<p>- Tên người nhận: <b>'.$receiver['name'].'</b></p>
<p>- Số Điện Thoại: '.$receiver['phone'].'</p>
<p>- Địa chỉ: '.$receiver['address'].', '.@$dulieuthanhpho['name'].'</p>
<p>- State: <b>'.$receiver['state'].'</b></p>
<p>- Post Code <b>: '.@$receiver['post_code'].'</b></p>
<p>- Quốc Gia <b>: '.$dulieuquocgia['name'].'</b></p>
</div>




</div>
</div>











</div>

';

?>

</div>

</div>

<div class="col-md-9">
<div class="card card-warning">
<div class="card-header">
<h3 class="card-title">
<i class="fas fa-box"></i> Thông tin kiện hàng 
</h3>
</div>

<div class="card-body">


					<div class="row">
<div class="col-md-6">
                      <p>Tên hàng: <?php echo $data['kg_tenhang']?></p>
                      <p>Export as: <?php echo $data['kg_reason']?></p>
					  
					
					</div>  
					  
					  <div class="col-md-6">
					 <div class="inbill">
					 
					 <?php
					 if($checkroletao['roleid'] == 7)
					 {
						 echo'<iframe src="inbill/BILLHOANCHINH-KIKI.php?id='.$id.'" style="display:none;" name="frame"></iframe>';
					 }
					 else
					 {
						 echo'<iframe src="inbill/BILLHOANCHINH.php?id='.$id.'" style="display:none;" name="frame"></iframe>';
					 }
					 ?>
					 <iframe src="inlabel/LABELHOANCHINH.php?id=<?php echo $id?>" style="display:none;" name="framelabel2"></iframe>
					 <iframe src="../inbill/inbilltw/inbills.php?id=<?php echo $id?>" style="display:none;" name="framelabel"></iframe>
					 <iframe src="ininvoice/INVOICE.php?id=<?php echo $id?>" style="display:none;" name="frameinvoice"></iframe>
					 </div>
					 
					 <?php 
					 if($data['label_link'] != "")
					 {
					 echo'<a href="'.$data['label_link'] .'" class="btn btn-primary " onclick=""><i class="fas fa-download"></i> Label </a>';

					 }
					 ?>
                     <button type="button" class="btn btn-primary " onclick="frames['frame'].print()"><i class="fa fa-print"></i>Print Bill</button>
					 <?php
					 if($data['kg_dichvu'] != 100)
					 {
					 echo'                     <button type="button" class="btn btn-primary " onclick="frames[\'framelabel2\'].print()"><i class="fa fa-print"></i>Print Label</button>';
					 }
					 else
					 {
					 echo'                     <button type="button" class="btn btn-primary " onclick="frames[\'framelabel\'].print()"><i class="fa fa-print"></i>Print Label</button>';
					 }
					 ?>
                     <button type="button" class="btn btn-primary"  onclick="frames['frameinvoice'].print()"><i class="fa fa-print"></i>Print Invoice</button>
</div>

</div>
<div class="row">

<div class="col-md-12">

				<?php
			
				
				?>

<?php
					if($roleid==6 || $roleid==3|| $roleid==1 )
					{
						$layrolecreate = mysqli_fetch_assoc(mysqli_query($conn,"select roleid from ns_user where id='".$data['uid']."'"));
						if($layrolecreate['roleid'] == '6')
						{
							
						$totalcuoc = sum_package_sale($data['khach_cuocbay'],$data['khach_phuthu'],$data['khach_cuocnoidia'],$data['khach_thuho'],$data['khach_phibaohiem'],$data['vat']);
						if($data['cuoc_goc'] == 0)
						{
						$cuocgoc = sum_package_code($data['kg_dichvu'],$data['charge_weight'],$receiver['city'],$receiver['country_id'],$data['kg_chinhanh'],$conn,$receiver['post_code'],$receiver['state'],$data['id_code']);
						}
						else
						{
						$cuocgoc = $data['cuoc_goc'];	
						}
						echo'<label  for="">Thông tin thanh toán [Phương thức: <font color=red>';
						if($data['payment_type'] == 'after')
						{echo'Thanh Toán Sau';}
						else
						{echo'Thanh Toán Nợ';}
					echo'</font>]</label><br>							- Tổng Cước thu khách:<b> '.number_format($data['khach_cuocbay']).'đ</b><hr>
							
							
							<div class="row">
							<div class="col-md-6">
							Chi phí phụ thu khách
								<table width=100% class="table table-hover text-nowrap" style="background-color:#DDDDDD">
									<tr style="background-color:blue;color:white">
									<td>Nội dung</td>
									<td>Số tiền</td>
									</tr>
									<tr>
									<td>Cước nội địa</td>
									<td>'.number_format($data['khach_cuocnoidia']).'đ</td>
									</tr>
									<tr>
									<td>Cước phụ thu</td>
									<td>'.number_format($data['khach_phuthu']).'đ</td>
									</tr>
									<tr>
									<td>Cước thu hộ</td>
									<td>'.number_format($data['khach_thuho']).'đ</td>
									</tr>
									<tr>
									<td>Cước phí bảo hiểm</td>
									<td>'.number_format($data['khach_phibaohiem']).'đ</td>
									</tr>
									<tr>
									<td>Giá cước VAT</td>
									<td>'.number_format($data['vat']*8/100).'đ</td>
									</tr>
									<tr>
									<td>Cước gốc</td>
									<td>'.number_format($cuocgoc).'đ</td>
									</tr>
								</table>
							</div>
							
							
							<div class="col-md-6">
								Chi phí vận hành công ty 
								<table width=100% class="table table-hover text-nowrap" style="background-color:#DDDDDD">
								
								
									<tr style="background-color:blue;color:white">
									<td>Nội dung</td>
									<td>Số tiền</td>
									<td>Số lượng</td>
									</tr>
									';
									
									$laydulieuchiphia = mysqli_query($conn,"select * from kns_listhoadonchiphi where id_code='".$data['id_code']."'");
									$sotienchiphi = 0;
									while($laydulieuchiphi = mysqli_fetch_array($laydulieuchiphia))
									{
										echo'<tr>
									<td>'.$laydulieuchiphi['tenphuthu'].' '; if($laydulieuchiphi['var_string'] == "chiphi6"){
									$thaythongtinguisms = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_sms_contact where id_code='".$data['id_code']."'"));
									echo '['.$thaythongtinguisms['sms_tennguoigui'].'-'.$thaythongtinguisms['sms_phone'].']';

									}										echo'</td>
									<td>'.$laydulieuchiphi['price'].'</td>
									<td>'.$laydulieuchiphi['soluong'].'</td>
									</tr>';
									$sotienchiphi+=$laydulieuchiphi['price']*$laydulieuchiphi['soluong'];
									}
									$loinhuanthucte = $data['khach_cuocbay']-($data['khach_cuocnoidia']+$data['khach_phuthu']+$data['khach_thuho']+$data['khach_phibaohiem']+($data['vat']*8/100)+$cuocgoc)-$sotienchiphi;
									echo'
									
								</table>'
								;
								
								
								if($roleid == 1 || $roleid == 3|| $roleid == 6)
								{
									echo'  <p style="color:red;font-weight:bold">';
					if( $data['chiho'] == '0')
					{
						echo'<i class="fas fa-file-invoice"></i> Đơn hàng từ công ty';
					}
					else
					{
						echo'<i class="fas fa-file-invoice"></i> Đơn hàng tự tìm kiếm';
					}
					
					echo'</p>';
									
									if($data['checkthanhtoan'] != 2)
									{
								echo'<a href="edit_cpvhz.php?id='.$_GET['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-edit"></i> Sửa chi phí </a>';
								
								}
									
									if($roleid == 1 && $data['checkthanhtoan'] == 2)
									{
									echo'<a href="edit_cpvhz.php?id='.$_GET['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-edit"></i> Sửa chi phí </a>';

									}
								}
								echo'
							</div>
							</div>
							
							
							<font color="green">
							- <font color=gray>Giá trị bảo hiểm:<b> '.number_format($data['khach_thuho']).'đ</b></font><br>
							-  <b>Lợi nhuận thực tế:</b> '.number_format($loinhuanthucte).' đ </font>
							<hr>
					
							';
							
								
						
						}
					}
					
					if($roleid == 6)
				{
					if($data['checkthanhtoan'] == 2)
							{
							
								
								$laydulieuthanhtoan = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit_sale where id_bill='".$data['id_code']."' LIMIT 1"));
								echo'<div class="alert alert-success alert-dismissible">
                  <h5><i class="icon fas fa-check"></i> Đã thanh toán!</h5>
                  Thời gian thanh toán: '.$laydulieuthanhtoan['timethanhtoan'].' <a href="../upload/'.$laydulieuthanhtoan['bangchungthanhtoan'].'" target="_blank"> <i class="fas fa-images"></i></a>
                </div>';
							}
							else
							{
								
							@$checkuploaddebit = mysqli_num_rows(mysqli_query($conn,"select * from ksn_debit_sale where id_bill='".$data['id_code']."' LIMIT 1"));
							if(@$checkuploaddebit >=1)
							{
								
								$laydulieuthanhtoan = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_debit_sale where id_bill='".$data['id_code']."' LIMIT 1"));
								echo'<div class="alert alert-warning alert-dismissible">
								  <h5><i class="icon fas fa-check"></i> Đã upload debit, xin hãy chờ duyệt!</h5>
								  Thời gian upload: '.$laydulieuthanhtoan['timethanhtoan'].' <a href="../upload/'.$laydulieuthanhtoan['bangchungthanhtoan'].'" target="_blank"> <i class="fas fa-images"></i></a>
								</div>';
							}
							else
							{
							
								echo'
								<div  style="border:1px solid black;padding:5px;background-color:#EEEEEE;width:50%	">
							   <form action="" method="POST" enctype="multipart/form-data">
							   
								
								<div class="form-group">
										<label  for="">Tải lên bằng chứng thanh toán </label>';
										if($uid == 1 || $roleid == 6 )
										{
											echo'<input type="file" required class="form-control  custom-file-upload" name="photo" id = "fileSelect">';
										}
										else
										{
										}
										
								echo'	</div>
								<div class="form-group">
								<label  for="">Phương thức thanh toán </label>

								<div class="form-check">
								<input class="form-check-input" type="radio" value="cash" name="payment_method">
								<label class="form-check-label">Tiền mặt</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio"  value="banking"  name="payment_method" checked="">
								<label class="form-check-label">Ngân Hàng</label>
								</div>
								</div>
								
								<button type="submit" name="btn_update" class="btn btn-primary form-control">Cập nhật thanh toán</button>

								
								
								
							   </form></div>
							
									';		
							}
							}
				}
					
					
					?><hr>
					<?php
					
					if($roleid == 1 || $roleid == 3 || $roleid == 4 )
					{
						echo'<a href="edit_package.php?id='.$id.'" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Package Info & Invoice</a><br><br>';
					}
					?>
                <table id="example4" class="table table-hover table-bordered  text-nowrap" width=100%>
                  <thead>
                    <tr style="background-color:#999900 ;color:white;text-align:center">
                      <th></th>
                      <th>Mã HAWB</th>
                      <th>Type</th>
                   
                      <th>Weight(Kg)</th>
                      <th>CONVERTED WEIGHT</th>
                      <th>CHARGED WEIGHT</th>
                      <th>STATUS</th>                      
					  <th>TRACKING CODE</th>
					  <th>Nhân Viên Xử Lý</th>

                    </tr>
                  </thead>
				   <tbody id="kiennho">
					
                   <?php
				   $laydulieukienhanga = mysqli_query($conn,"select * from ns_listhoadon where id_package='$id'");
				   $i=0;
				   while($laydulieukienhang = mysqli_fetch_array($laydulieukienhanga,MYSQLI_ASSOC))
				   {
					   $i++;
					   echo"<tr style='background-color:#EEE9E9'>
					   <td></td>
					   <td><a href='".$tracking_url."".$laydulieukienhang['id_code']."' target='_blank'><b>".$laydulieukienhang['id_code']."</b> <i class='fas fa-map-marker-alt'></i></a></td>
					   <td>".$laydulieukienhang['type']." </td>
			
					   <td style='font-weight:bold'>".$laydulieukienhang['cannang']." kg</td>
					   <td style='color:black'>".($laydulieukienhang['length'].'(<b>L</b>)x'.$laydulieukienhang['width'].'(<b>W</b>)x'.$laydulieukienhang['height']).'(<b>H</b>)/'.$dulieudichvu['thetich'].'='.$laydulieukienhang['convert_weight']."</td>
					   <td style='font-weight:bold;color:black'>".$laydulieukienhang['charge_weight']." kg</td>
					   <td style='font-weight:bold'>".statusbill($laydulieukienhang['status'])."
					   ";
					   if($laydulieukienhang['status'] == 1)
					   {
						   echo'<a href="../upload/'.$laydulieukienhang['img'].'" target="_blank"><i class="fas fa-images">';
					   }else if($laydulieukienhang['status'] == 2)
					   {
						    	$myArray = explode(',', $laydulieukienhang['img_xuat']);

							foreach ( $myArray as $a){
							  echo'<a href="../upload/'.$a.'" target="_blank"><i class="fas fa-image"></i></a> ';
							}
						  
						   
					   }
					  
					   echo"
					   </td>					   <td style='font-weight:bold;color:black'>
					   
					   ".$laydulieukienhang['billketnoi']."";
					   
					   if($laydulieukienhang['code_kerry'] != "")
					   {
						   echo '台灣 - Kerry : '.$laydulieukienhang['code_kerry'];
					   }
					   
					   echo"
					   
					   </td>
					   </td>					   <td style='font-weight:bold;color:black'>
					   ";
					   if($laydulieukienhang['status'] >= 1)
					   {
						    @$dulieunhanviena = mysqli_fetch_assoc(mysqli_query($conn,"select uid from ksn_scan_nhap where id_listhoadon='".$laydulieukienhang['id_code']."'"));
							@$dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"select ten from ns_user where id='".$dulieunhanviena['uid']."'"));

						   echo 'Scan Import: '.$dulieunhanvien['ten'];
					   }						   
					   echo"
					   </td>

					   </tr>";
				   }
				   
				   
				   ?>
                  </tbody>
                </table>
					
					
					
					<div class="form-group"  style="margin-left:20px;white-space:nowrap;">
                     
                    </div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					

</div>
</div>
				
<div class="row">

<div class="col-md-12">
				
              <!-- /.card-header -->
			  
				
                <table class="table table-bordered" style="text-align:center" width=100%>
                  <thead>
                    <tr  style="background-color:#999900 ;color:white;text-align:center">
                      <th style="width: 10px">#</th>
                      <th>Tên mặt hàng</th>
                      <th  style="width:10%">Unit Type</th>
                      <th  style="width:10%">Unit</th>
                      <th  style="width:10%">Unit Price</th>
                      <th  style="width:10%">Total</th>
                    </tr>
                  </thead>
                  <tbody>
				  
				  
				   <?php
				   $laydulieuitema = mysqli_query($conn,"select * from ns_mapcatalog2 where id_bill='$id'");
				   $i=0;
				   while($laydulieuitem = mysqli_fetch_array($laydulieuitema,MYSQLI_ASSOC))
				   {
					   $i++;
					   echo'<tr style="background-color:#EEE9E9">
                      <td>'.$i.'</td>
                      <td>'.$laydulieuitem['iv_tensanpham'].'</td>
                      <td>'.$laydulieuitem['iv_unit'].'</td>
                      <td>'.$laydulieuitem['soluong'].'</td>
                      <td>'.$laydulieuitem['iv_price'].'</td>
                      <td>'.$laydulieuitem['iv_price']*$laydulieuitem['soluong'].'</td>
                    </tr>';
				   }
				   ?>
                    
                 
                  </tbody>
                </table>
              <!-- /.card-body -->
          
				
				<?php
				if(@$_GET['check'] == 'success')
				{
					//echo'<a href="create_package.php" class="btn btn-danger"><i class="fas fa-file-alt"></i> Tạo đơn hàng mới</a>';
				}
				?>
				
				<?php
				/*
			if($roleid == 1 && $data['hangketnoi'] != "kango"){
				echo'<form action="" method="POST"> Kết nối API tạo BILL KANGO
				   <input type="input" name="madichvu" placeholder="Nhập tên Mã Tên Dịch Vụ tại Kango">&nbsp;
				    <input type="submit" name="btn_ketnoikango" placeholder="Kết nối" value="Kết nối API tạo BILL" class="btn btn-primary btn-sm">
				   
				   </form>';
			}*/
			?>
				   

</div>
			
</div>






</div>
	
	
	
	
			
		
	</form>
	
</div>

<?php  
    include('footer.php');
?>

<script type="text/javascript">

	

	// $(".myclass").on("change", function(){
	// 	var value1 = document.getElementById('cannang').value;
	// 	var value2 = document.getElementById('giadongia').value;
	// 	var value4 = document.getElementById('giabaohiem').value;
		// var sum = (parseFloat(value1) * parseFloat(value2)) + parseFloat(value3)  + parseFloat(value4) + parseFloat(value6) -  parseFloat(value5) ;
		// var sum = (parseFloat(value1) * parseFloat(value2)) +  parseFloat(value4);
		// $('#giatong').val(parseFloat(sum).toLocaleString('vi', {style : 'currency', currency : 'VND'}));
	// 	$('#giatong').val(parseFloat(sum));


	// });

</script>
<script>
VirtualSelect.init({ 
  maxValues: 1,  
  showValueAsTags: true,
  ele: 'select' 
});
</script>

<script type="text/javascript">

$(document).ready(function () {  
	<?php 
		if(@$_GET['check'] == 'success')
		{
		echo"
      $(document).Toasts('create', {
		class: 'bg-success',
        title: 'SHIBA Express',
        autohide: true,
        delay: 5000,
        body: 'Create bill successful! Thank you for supporting our service'
      })";
		}
	  ?>
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
    $('#example4').DataTable( {
		  "pageLength": 100
,  "searching": false
,
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'desc' ]
    } );
} );

</script>