<?php  
	include('top.php');
	include('../controller/bill.php');
	$id = $_GET['id'];
	function xulyprice($data){
	  $data = str_replace(",","",$data);
	  $data = str_replace("NaN","0",$data);
	  return $data;
	}	
	
	
	function roundUp($number, $nearest){
			return ceil($number/0.5)*0.5;;
		}
	
	if (isset($_POST['btn_submit'])) {
		
		$hiddenSId = $_POST['hiddenSId'];
		$hiddenRId = $_POST['hiddenRId'];

		$nguoigui_name = $conn->real_escape_string($_POST['nguoigui_name']);
		$nguoigui_company = $conn->real_escape_string($_POST['nguoigui_company']);
		$nguoigui_phone = $conn->real_escape_string($_POST['nguoigui_phone']);
		$nguoigui_tp = $_POST['nguoigui_tp'];
		$nguoigui_districtid = $_POST['nguoigui_districtid'];
		$nguoigui_wardid = $_POST['nguoigui_wardid'];
		$nguoigui_add = $_POST['nguoigui_add'];
		@$nguoigui_npp = $_POST['npp'];
		@$txt_sales = $_POST['txt_sales'];

		//$id_nguoigui = createSender($nguoigui_npp,$nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone,$nguoigui_company,$nguoigui_code,$conn);
		updateSender($nguoigui_npp,$hiddenSId,$nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone,$nguoigui_company,$conn);
		
		
		$nguoinhan_name = $conn->real_escape_string($_POST['nguoinhan_name']);
		$nguoinhan_company = $conn->real_escape_string($_POST['nguoinhan_company']);
		$nguoinhan_phone = $conn->real_escape_string($_POST['nguoinhan_phone']);
		$nguoinhan_countries = $conn->real_escape_string($_POST['nguoinhan_countries']);
		$nguoinhan_city = $conn->real_escape_string($_POST['nguoinhan_city']);
		$nguoinhan_add = $conn->real_escape_string($_POST['nguoinhan_add']);
		$nguoinhan_add2 =  $conn->real_escape_string($_POST['nguoinhan_add2']);
		$nguoinhan_add3 =  $conn->real_escape_string($_POST['nguoinhan_add3']);
		$nguoinhan_state =  $conn->real_escape_string($_POST['nguoinhan_state']);
		$nguoinhan_post_code = $conn->real_escape_string($_POST['nguoinhan_post_code']);
		$id_no = $_POST['id_no'];
		$save = $_POST['save'];

		//$id_nguoinhan = createReceiver($nguoinhan_name,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add,$nguoigui_code,$id_no,$nguoinhan_add2,$nguoinhan_add3,$nguoinhan_state,$nguoinhan_post_code,$save,$conn);
		updateReceiver($hiddenRId,$nguoinhan_name,$nguoinhan_company,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add,$nguoinhan_add2,$nguoinhan_add3,$nguoinhan_state,$nguoinhan_post_code,$save,$id_no,$conn);
		$date = date('Y-m-d');
		$sokien = $_POST['sokien_nhankhach'];
		$chiho = $_POST['chiho'];
		$kg_dichvu = $_POST['kg_dichvu'];
		$kg_chinhanh = $_POST['kg_chinhanh'];
		$kg_ref = $_POST['kg_ref'];
		$kg_reiceiversign = $_POST['kg_reiceiversign'];
		
		$khach_cannang = $_POST['khach_cannang'];
		$khach_cuocbay = xulyprice($_POST['khach_cuocbay']);
		$khach_phuthu = xulyprice($_POST['khach_phuthu']);
		$khach_cuocnoidia = xulyprice($_POST['khach_cuocnoidia']);
		$khach_thuho = xulyprice($_POST['khach_thuho']);
		$khach_baohiem = xulyprice($_POST['khach_baohiem']);
		$khach_phibaohiem = xulyprice($_POST['khach_phibaohiem']);
		
		
		
		
		//$test = createPackage($id_nguoigui,$nguoigui_code,$id_nguoinhan,$uid,$sokien,$date,$chiho,$kg_dichvu,$kg_chinhanh,$kg_ref,$kg_reiceiversign,$datauser['payment_type'],$conn);
		if($roleid == 6 || $roleid == 3 || $roleid == 1){
					updatePackageForSale($id, $kg_dichvu, $kg_chinhanh,$kg_ref,$kg_reiceiversign,$khach_cannang,$khach_cuocbay,$khach_phuthu,$khach_cuocnoidia,$khach_thuho,$khach_baohiem,$khach_phibaohiem,$conn);

		}
		else
		{
					updatePackage($id, $kg_dichvu, $kg_chinhanh,$kg_ref,$kg_reiceiversign,$conn);

		}
		echo'<script> 
								alert("Chỉnh sửa thông tin thành công");

            </script>';

	}
	
	
	
	$data = getPackageData($id,$conn);
	
	if($roleid == 2 || $roleid == 6 || $roleid == 5)
	{
		if($data['uid'] != $uid)
		{
			exit();
		}
	}
	
	
	$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,thetich from ksn_dichvu where id='".$data['kg_dichvu']."'"));

	// $data = getBillData($id);

		
		
	
	if(isset($_POST['btn_updatekien']))
	{
		$cannang = $_POST['pack_weight'];
		$length = $_POST['pack_length'];
		$width = $_POST['pack_width'];
		$height = $_POST['pack_height'];
		$barcode = $_POST['b'];
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
		mysqli_query($conn,"UPDATE `ns_listhoadon` SET `length`='$length', `width`='$width', `height`='$height',`cannang`='$cannang',`convert_weight`='$convert_weight',`charge_weight`='$charge_weight' WHERE (`id_code`='$barcode')");
		
		
		$dulieucannang = mysqli_query($conn,"select cannang,charge_weight from ns_listhoadon where id_package='".$laydulieukienb['id_package']."'");
		
		$sum_cross = 0;
		$sum_charge = 0;
		$sokien = 0;
		while($dulieucannanga = mysqli_fetch_array($dulieucannang,MYSQLI_ASSOC))
		{
			$sokien++;
			$sum_cross+= $dulieucannanga['cannang'];
			$sum_charge+= $dulieucannanga['charge_weight'];
		}
		
		
		
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
		
		//aaaaaaaaaaaaaaaaaaaaaaaa
		
		mysqli_query($conn,"UPDATE `ns_package` SET `gross_weight`='$sum_cross', `charge_weight`='$sum_charge'		WHERE (`id`='".$laydulieukienb['id_package']."')");
		$data = getPackageData($id,$conn);

	}
	
	
	
	if(isset($_POST['btn_addpackage']))
	{
		
		
		
		$sokiennho =  $_POST['sokien'];
		$pack_type =  $_POST['pack_type'];
		$pack_length =  $_POST['pack_length'];
		$pack_width =  $_POST['pack_width'];
		$pack_height = $_POST['pack_height'];
		$pack_weight = $_POST['pack_weight'];
		$kg_valueinvoice = $_POST['kg_valueinvoice'];
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
	    $pcs = '1';
		$status = 1;
		$note = "";
		$sender_name = $_POST['sender'];
		$cuscode = $_POST['cuscode'];
		$string_status = 'Đã tạo nhãn cho kiện hàng';
		$string_detail = location_chinhanh($data['kg_chinhanh']);
		$gross_weight = 0;
		$sum_charge_weight = 0;
		$sokienaa = 0;
		// Tính số dòng
	
		
					echo'123123s';
echo $sokiennho;
		for ($i=0; $i<sizeof($sokiennho);$i++) {
			
			
			echo'123123s';
			
			##Lặp số kiện
			for ($z=0; $z<$sokiennho[$i];$z++) {
				$sokienaa ++;
				echo $pack_type[$i].'-'.$pack_length[$i].'<br>';
				$convert_weight = roundup((($pack_length[$i]*$pack_width[$i]*$pack_height[$i])/$dulieudichvu['thetich']),0.5);
				
				
				
				if($convert_weight > $pack_weight[$i])
				{
					$charge_weight = $convert_weight;
					
					
				}
				else
				{
					$charge_weight = roundup($pack_weight[$i],0.5);
					
				}
				if($charge_weight > 20.5)
				{
						$charge_weight = ceil($charge_weight);
				}
				$excutea = createBillForPacker($uid,$id,$date,$datenow2,roundup($pack_weight[$i],0.5),1,$status, $note,$pcs,$cuscode,$pack_type[$i],$pack_length[$i],$pack_width[$i],$pack_height[$i],$convert_weight,$charge_weight,$conn);
				$layid_code = mysqli_fetch_assoc(mysqli_query($conn,"select id,id_code from ns_listhoadon where id='$excutea'"));
				add_trackingBill($layid_code['id_code'],$string_status,$string_detail,$conn);
				
				echo $convert_weight - $pack_weight[$i];
				$gross_weight+= $pack_weight[$i];
				$sum_charge_weight+= $charge_weight;
			
			}
			
		}
		
		
		
		$dulieucannang = mysqli_query($conn,"select cannang,charge_weight from ns_listhoadon where id_package='$id'");
		
		$sum_cross = 0;
		$sum_charge = 0;
		$sokien = 0;
		
		while($dulieucannanga = mysqli_fetch_array($dulieucannang,MYSQLI_ASSOC))
		{
			$sokien++;
			$sum_cross+= $dulieucannanga['cannang'];
			$sum_charge+= $dulieucannanga['charge_weight'];
		}
		
		
		
		
		
		//aaaaaaaaaaaaaaaaaaaaaaaa
		
		mysqli_query($conn,"UPDATE `ns_package` SET `gross_weight`='$sum_cross', `charge_weight`='$sum_charge',`sokien`='$sokien'		WHERE (`id`='$id')");
		
		echo'<script> 
								alert("Cập nhật thêm kiện hàng thành công");

        </script>';
	}
		
		
		
	if(isset($_POST['btn_updateinvoice']))
	{
		$package_tenhang = $conn->real_escape_string($_POST['package_tenhang']);
		$ks_reason = $conn->real_escape_string($_POST['ks_reason']);
		$kg_valueinvoice = $_POST['kg_valueinvoice'];
		$iv_tensanpham =  $_POST['iv_tensanpham'];
		$iv_price =  $_POST['iv_price'];
		$iv_soluong =  $_POST['iv_soluong'];
		$iv_unit =  $_POST['iv_unit'];
		mysqli_query($conn,"DELETE FROM `ns_mapcatalog2` WHERE (`id_bill`='$id')")or die("Lỗi");;
		$sum_value = 0;
		for ($i=0; $i<sizeof($iv_tensanpham);$i++) {
			mysqli_query($conn,"INSERT INTO `ns_mapcatalog2` (`id_bill`, `soluong`, `iv_price`, `iv_unit`, `iv_tensanpham`) VALUES ('$id', '".$iv_soluong[$i]."', '".$iv_price[$i]."', '".$iv_unit[$i]."', '".$conn->real_escape_string($iv_tensanpham[$i])."')");
			$sum_value += $iv_price[$i]*$iv_soluong[$i];
		}
		mysqli_query($conn,"UPDATE `ns_package` SET `kg_tenhang`='$package_tenhang', `kg_reason`='$ks_reason',`kg_valueinvoice`='$kg_valueinvoice' WHERE (`id`='$id')");
		echo '
			<script>
				alert("Cập nhật thông tin invoice thành công");
	
			</script>
		';
	}
			
	if(isset($_POST['btn_delete']))
	{
		$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$_POST['b']."'"));
		if($laydulieu['status'] == 0)
		{
		mysqli_query($conn,"DELETE FROM `ns_tracking_bill` WHERE (`id_hoadon`='".$_POST['b']."')");
		mysqli_query($conn,"DELETE FROM `ns_listhoadon` WHERE (`id_code`='".$_POST['b']."')");
		
		
		$dulieucannang = mysqli_query($conn,"select cannang,charge_weight from ns_listhoadon where id_package='$id'");
		
		$sum_cross = 0;
		$sum_charge = 0;
		$sokien = 0;
		while($dulieucannanga = mysqli_fetch_array($dulieucannang,MYSQLI_ASSOC))
		{
			$sokien++;
			$sum_cross+= $dulieucannanga['cannang'];
			$sum_charge+= $dulieucannanga['charge_weight'];
		}
		
		mysqli_query($conn,"UPDATE `ns_package` SET `gross_weight`='$sum_cross', `charge_weight`='$sum_charge',`sokien`='$sokien'		WHERE (`id`='$id')");

		echo '
			<script>
				alert("Xóa kiện hàng thành công");
	
			</script>
		';
		}
		else
		{
		echo '
			<script>
				alert("Kiện hàng không phải trạng thái mới Tạo Bill không thể xóa");
	
			</script>
		';
		}
		
		
		
	}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	

	// if (isset($_POST['btn_exit'])) {
	// 	echo '
	// 		<script>
	// 			window.location = "scan_create_sub_package.php";
	// 		</script>
	// 	';
	// }
	if($roleid == 2 || $roleid == 6)
	{
	$laydulieukien = mysqli_fetch_assoc(mysqli_query($conn,"select date_add(datetime,interval 10 minute) as newdate  from ns_listhoadon where id_package='".$data['id']."'"));
		
	$date1 = strtotime($datenow);	
	$date2 = strtotime($laydulieukien['newdate']);	
	if($date1 >= $date2)
	{
		echo'<script> 
					alert("Đã Quá Thời Gian Chỉnh Sữa 10 phút ,Vui lòng  Liên Hệ Bộ Phận Chứng Từ SHIBA EXPRESS Để Được Hỗ Trợ Chỉnh Sữa !");
					window.location = "list_package.php";

            </script>';
			
			exit();
	}
	}
	
	$sender = getSender($data['id_nguoigui'],$conn);
	$receiver = getReceiver($data['id_nguoinhan'],$conn);
	
	$data = getPackageData($id,$conn);

	
	
	
	
?>
<link rel="stylesheet" href="selectbox/dist/virtual-select.min.css" />
<script src="selectbox/dist/virtual-select.min.js"></script>
<div class="container-fluid" >
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-12">
				<!--<h5 style="text-align:center;">Tạo Hóa Đơn Mới</h5>-->
			</div>

		</div>
		<div class="row">
			<div class="col-md-3" style="font-size:13px">
				
				
				
			<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Thông tin Người gửi (Sender)</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#EEE9E9">
            
					<input type="text" readonly name="nguoigui_name" class="form-control" value="<?php  echo $sender['cus_code'];?>" placeholder="Mã khách hàng" readonly hidden>
				<input type="hidden" name="hiddenSId" value="<?php  echo $sender['id'];?>" >
				<input type="hidden" name="hiddenRId" value="<?php  echo $receiver['id'];?>" >

				<div class="form-group" >
					<label for="">Công ty (Company Name) * </label>
					<input type="text" name="nguoigui_company" class="form-control" value="<?php  echo $sender['company_name'];?>" readonly  placeholder="Tên người gửi">
				</div>
				<div class="form-group" >
					<label for="">Người LH (Contact Name) * </label>
					<input type="text" name="nguoigui_name" class="form-control" value="<?php  echo $sender['name']; if($roleid !=1 ){ echo'readonly';}?>"   placeholder="Tên người gửi">
				</div>
				
				<div class="form-group">
					<label for="">Số Điện thoại (Telephone) *</label>
					<input type="text" name="nguoigui_phone" class="form-control" value="<?php  echo $sender['phone'];?>" readonly placeholder="Nhập SĐT" required>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<select class="form-control" id="nguoigui_tp-dropdown" name="nguoigui_tp"  >
						<option value="">Chọn Tỉnh</option>
						<?php 
							$provinces = mysqli_query($conn,"SELECT * FROM yn_province order by id asc");
							echo '<option value="">Chọn tỉnh/thành phố</option>';
							while ($item = mysqli_fetch_array($provinces,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'"';
								if ($sender['province_id'] == $item['id']) {
									echo ' selected';
								}
								echo '>'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Quận/Huyện</label>
					<select required class="form-control" name="nguoigui_districtid" id="nguoigui_district-dropdown"  >
						<?php 
							$districts = mysqli_query($conn,"SELECT * FROM yn_district where province_id='".$sender['province_id']."'  order by id asc");
							echo '<option value="">Chọn quận/huyện</option>';
							while ($item = mysqli_fetch_array($districts,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'"';
								if ($sender['district_id'] == $item['id']) {
									echo ' selected';
								}
								echo '>'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Phường/Xã</label>
					<select required class="form-control" name="nguoigui_wardid" id="nguoigui_ward-dropdown"  >
						<?php 
							$wards = mysqli_query($conn,"SELECT * FROM yn_ward where district_id='".$sender['district_id']."' order by id asc");
							echo '<option value="">Chọn phường/xã</option>';
							while ($item = mysqli_fetch_array($wards,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'"';
								if ($sender['ward_id'] == $item['id']) {
									echo ' selected';
								}
								echo '>'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="form-control" value="<?php  echo $sender['address'];?>" placeholder="Nhập địa chỉ" required  >
				</div>
				
				
				
				
				<!-- <div class="form-group">
					<label for="inputPassword3" class="control-label">Đối tác</label>
					<select required class="form-control" name="partner" id="partner-dropdown">
						<option value="">Chọn đối tác</option>
						<?php 
							$partners = mysqli_query($conn,"SELECT * FROM ns_user WHERE type=10 order by id asc");
							while ($item = mysqli_fetch_array($partners,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'">'.$item['ctyghitat'].'</option>
								';
							}
						?>
					</select>
				</div> -->
                </div>
                <!-- /.card-body -->

           
            </div>
				
				
				
				
				
				
				
	
			
			
			
			</div>
			<div class="col-md-6" style="font-size:13px">
							
				
				
				
				
				
				
				
				
				
				<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Thông tin Người nhận (Receiver)</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
				
                <div class="card-body" style="background-color:#EEE9E9">
				
				<div class="row">
				<div class="col-md-6" style="">

                 
				<div class="form-group" >
					<label for="">Công ty (Company Name)</label>
					<input type="text" name="nguoinhan_company" id="id_company" value="<?php  echo $receiver['company_name'];?>" class="form-control" placeholder="Tên công ty">
				</div>
				
				<div class="form-group" >
					<label for="">Người Liên hệ (Contact Name) <font color=red> * </font> </label>
					<input type="text" name="nguoinhan_name" id="id_tennguoinhan" value="<?php  echo $receiver['name'];?>" class="form-control" placeholder="Tên người nhận">
				</div>
				
				<div class="form-group">
					<label for="">Số Điện thoại (Telephone) <font color=red> * </font></label>
					<input type="text" name="nguoinhan_phone" id="id_phonenguoinhan" value="<?php  echo $receiver['phone'];?>"  class="form-control"  placeholder="Số diện thoại người nhận" required>
				</div>
				
				<!--<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<input type="text" name="nguoinhan_city" class="form-control"  placeholder="Nhập thành phố" id="id_tpnguoinhan" required>
					 <select required class="form-control" name="nguoinhan_city" id="nguoinhan_city-dropdown"> 
					</select>
				</div>-->
			
				<div class="form-group">
					<input type="number" hidden name="sokien_nhankhach" id="" class="form-control"  placeholder="Nhập số kiện nhận khách" >
					<input type="text" hidden name="id_no" id="id_socmnd" class="form-control"  placeholder="Nhập số CMND nếu có" >
				</div>
	
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Quốc gia (Country) <font color=red> * </font></label>
					<select class="form-control" id="nguoinhan_countries-dropdown" name="nguoinhan_countries" required>
						<?php 
						$countries = mysqli_query($conn,"SELECT * FROM ns_countries order by id asc");
						echo '<option value="">Chọn quốc gia</option>';
						while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
							echo '
							<option value="'.$item['id'].'"';
							if ($receiver['country_id'] == $item['id']) {
								echo ' selected';
							}
							echo '>'.$item['name'].'</option>
							';
						}
					?>
					</select>
				</div>
				
				
				<div class="form-group">
                  <label>Thành Phố</label>

                  <select class="form-control select2bs4" style="width: 100%;"  id="nguoinhan_cities-dropdown" value=""  name="nguoinhan_city" >
                  <?php 
						$countries = mysqli_query($conn,"SELECT name,id FROM cities where country_id='".$receiver['country_id']."'  GROUP BY name order by id asc");
						echo '<option value="">Chọn thành phố</option>';
						while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
							echo '
							<option value="'.$item['id'].'"';
							if ($receiver['city'] == $item['id']) {
								echo ' selected';
							}
							echo '>'.$item['name'].'</option>
							';
						}
					?>
                  </select>
                </div>
				</div>
				
				<div class="col-md-6" style="">
				
				
				
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh (State/Province)</label>
				<input type="text" name="nguoinhan_state" id="id_state" class="form-control" value="<?php  echo $receiver['state'];?>"  placeholder="" >

				</div>	
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Mã Bưu chính (Postal code) *</label>
				<input type="text" name="nguoinhan_post_code" id="id_postcode" class="form-control"  value="<?php  echo $receiver['post_code'];?>"  placeholder="" >

				</div>	
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Địa chỉ (address) 1 *</label>
					<input type="text" name="nguoinhan_add" id="id_addnguoinhan" class="form-control" value="<?php  echo $receiver['address'];?>"   placeholder="Nhập địa chỉ người nhận" required>
				
				</div>
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Địa chỉ (address) 2 </label>
					<input type="text" name="nguoinhan_add2" id="id_addnguoinhan" value="<?php  echo $receiver['address2'];?>"   class="form-control"  placeholder="" >
								
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Địa chỉ (address) 3 </label>
					<input type="text" name="nguoinhan_add3" id="id_addnguoinhan"  value="<?php  echo $receiver['address3'];?>"   class="form-control"  placeholder="" >
					
				</div>
				
				 <div class="form-group">
                    
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary3" name="save" value="0">
                        <label for="checkboxPrimary3">
                          Lưu thông tin người nhận
                        </label>
                      </div>
                    </div>
				
				
				</div>
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
                </div>
                <!-- /.card-body -->

               
            </div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				

			</div>
			
			
			
		<div class="col-lg-3">
            <div class="card  card-primary">
              <div class="card-header">
                <h5 class="card-title m-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin Đơn hàng (Shipment Info)</h5>
              </div>
              <div class="card-body" style="background-color:#EEE9E9">
				<?php 
				echo'
				<div class="form-group">

				<label for="" class="control-label">Dịch vụ vận chuyển (Services) *</label>
					<select required class="form-control" name="kg_dichvu" id="dichvu-dropdown">';
					
						echo '<option value="">Chọn Dịch Vụ</option>';
						
			$query = mysqli_query($conn,"SELECT * FROM ksn_quocgia_dichvu  WHERE id_quocgia='".$receiver['country_id']."'");
			
			if(mysqli_num_rows($query) >= 1)
			{
				$datauser_create = mysqli_fetch_assoc(mysqli_query($conn,"select discount from ns_user where id='".$data['uid']."'"));
				$discount_check = $datauser_create['discount'];
				if($discount_check == '1')
				{
						while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
						$laythongtindichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where status='2' AND id='".$result['id_dichvu']."'"));
						if($laythongtindichvu['id'] != "")
						{
						echo '<option value="'.$laythongtindichvu['id'].'"';
									if($data['kg_dichvu'] == $result['id_dichvu']) {
										echo'selected';
									}
									echo ' >'.$laythongtindichvu['dichvu'].'</option>';
						}
					}

				}
				else
				{
					while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
						$laythongtindichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu  where status='2' AND id='".$result['id_dichvu']."' AND discount='0'"));
						
						if($laythongtindichvu['id'] != "")
						{
						echo '<option value="'.$laythongtindichvu['id'].'"';
									if($data['kg_dichvu'] == $result['id_dichvu']) {
										echo'selected';
									}
									echo ' >'.$laythongtindichvu['dichvu'].'</option>';
						}
					}
				}
			}
			else
			{	
			$laythongtindichvu = mysqli_query($conn,"select * from ksn_dichvu where status='2' AND discount='0'");
				while ($result = mysqli_fetch_array($laythongtindichvu,MYSQLI_ASSOC)) {
				if($result['id'] != "")
					{
							echo '<option value="'.$result['id'].'"';
							if($data['kg_dichvu'] == $result['id']) {
								echo'selected';
							}
							echo ' >'.$result['dichvu'].'</option>';
						}
				}
			}
			
					echo'</select>
					</div>
					
					 <div class="form-group">
                    
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary4" name="kg_reiceiversign" value="1" ';
						if($data['kg_reiceiversign'] == 1){echo'checked';}
						echo'>
                        <label for="checkboxPrimary4">
                          Dịch vụ chữ ký người nhận
                        </label>
                      </div>
                    </div>
					
					';
					
				echo'
				<div class="form-group">

				<label for="" class="control-label">Chọn chi nhánh</label>
					<select required class="form-control" name="kg_chinhanh" id="">';
					
							echo '<option value="HCM" '; if($data['kg_chinhanh'] == "HCM"){echo'selected';}echo'>HCM</option>';
							echo '<option value="HN"'; if($data['kg_chinhanh'] == "HN"){echo'selected';}echo'>HN</option>';
							echo '<option value="DAD" '; if($data['kg_chinhanh'] == "DAD"){echo'selected';}echo'>DAD</option>';
			
					echo'</select>
				</div>';
				
				?>
				
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Reference Code</label>
					<input type="text" name="kg_ref" id="id_addnguoinhan" class="form-control" value="<?php  echo $data['kg_ref'];?>" placeholder="" >
					
				</div>
<?php
				if($roleid == 6 ||$roleid == 3 ||$roleid == 1)
				{
					
					if($data['checkthanhtoan'] != 2 || $roleid == 1)
					{
					echo'
				<div class="form-group">
					<label for="" class="control-label">Trọng lượng tính khách</label>
					<input type="text" name="khach_cannang" id="khach_cannang" value='.$data['khach_cannang'].' class="form-control"  placeholder="" >
					
				</div>
					<!--
				<div class="form-group">				<input type="checkbox" id="vehicle1" name="vat" value="1"> Gồm VAT (10%) 
				-->

				
				<div id="dulieusale">
				
				<div class="input-group">					

				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
				<input type="text" name="khach_cuocbay" class="form-control Currency" id="khach_cuocbay" class=""  value='.$data['khach_cuocbay'].'  placeholder="Cước bay thu khách" title="Cước bay tính khách" >
				</div>
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_phuthu" id="khach_phuthu" class="form-control Currency" value='.$data['khach_phuthu'].'  placeholder="Cước phụ thu" title="Cước phụ thu">
					
				</div>
				
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_cuocnoidia" id="khach_cuocnoidia" class="form-control Currency"  value='.$data['khach_cuocnoidia'].'  placeholder="Cước nội địa" title="Cước nội địa" >
					
				</div>
				
				
				
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_thuho" id="khach_thuho" class="form-control Currency"  value='.$data['khach_thuho'].'  placeholder="Cước thu hộ" title="Cước thu hộ" >	
				</div>
				
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_baohiem" id="khach_baohiem" class="form-control Currency"  value='.$data['khach_baohiem'].'  placeholder="Giá trị khai báo bảo hiểm" title="Giá trị khai báo bảo hiểm" >	
				</div>
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_phibaohiem" id="khach_phibaohiem" class="form-control Currency"  value='.$data['khach_phibaohiem'].'  placeholder="Phí mua bảo hiểm" title="Phí mua bảo hiểm">	
				</div>
			

				
				
				</div>';
					}
					else
					{
						echo'<font color=red>Bill đã  thanh toán không thể sửa chi phí !</font>';
					}
				}
				?>
			</div>
			
			
			 <div class="card-footer"><div class="form-group">
                    
                      <div class="icheck-primary d-inlinea">
                        <input type="checkbox" id="checkboxPrimary4A" name="kg_reiceiversignA" value="1" required>
                        <label for="checkboxPrimary4A">
                         <CENTER> Đồng Ý <span style="  background: none!important;
  border: none;
  padding: 0!important;
  /*optional*/
  font-family: arial, sans-serif;
  /*input has OS specific font-family*/
  color: #069;
  text-decoration: underline;
  cursor: pointer;" data-toggle="modal" data-target="#exampleModal">Điều Khoản Sử Dụng Dịch Vụ của SHIBA EXPRESS!</span>
                        </label>
                      </div>
                    </div>
				<button style="float:right;" type="submit" name="btn_submit" class="btn btn-danger">UPDATE</button>
                </div>
			
			
            </div>

            
          </div>
			<!-- <div class="col-md-6">
				<h5>Thông tin kiện hàng</h5>
				<hr>
				<div class="form-group">
					<label for="">Khai hàng</label>
					<textarea name="tenhang" class="form-control"  rows="3" ></textarea>
				</div>
				<table>
					<td width="50%">
						<div class="form-group" id="kiennho" style="margin-left:20px;white-space:nowrap;">

						</div>
					</td>
				</table>
				<table>
					<tr>
						<td width="33%">
							<div class="form-group">
								<label for="" >Cân nặng</label>
								<input type="number" name="cannang" step="0.01" class="form-control myclass" id="cannang" placeholder="Nhập cân nặng" required>
							</div>
						</td>
						<td width="33%">
							<div class="form-group">
								<label for="">Số kiện</label>
								<input type="text" name="sokien" class="form-control" id="sokien" value="1" placeholder="Nhập số kiện">
							</div>
						</td>
						<td width="33%">
							<div class="form-group">
								<label for="" >Giá trị hàng</label>
								<input type="number" name="giakhaibao" step="0.01" class="form-control myclass" id="giakhaibao" value="0" placeholder="" required>
							</div>
						</td>
					</tr>
				</table>
				<table >
					<tr>
						<td width="50%">
							<div class="form-group">
								<label for="" >Đơn giá </label>
								<input type="number" step="0.01" name="giadongia" class="form-control myclass" id="giadongia" value="0" placeholder="" >
							</div>
						</td>
						<td width=50%>
							<div class="form-group">
								<label for="" >Phí bảo hiểm</label>
								<input type="number" step="0.01"  name="giabaohiem" class="form-control myclass" id="giabaohiem" value="0" placeholder="" >
							</div>
						</td>
					</tr>
				</table>
				<div class="form-group">
					<label for="">Tổng</label>
					<input type="number" step=".01" style= "color:red" name="gia" class="form-control " id="giatong" class="form-control currency" placeholder="" readonly>
				</div>

				<div class="form-group">
					<label  for="">Ghi chú </label>
					<input type="text" name="note" class="form-control" id="" placeholder="Nhập ghi chú">
				</div>
				<button type="submit" name="btn_submit" class="btn btn-success">Tạo</button>
			</div> -->
		</div>
	</form>
	
					<!--<h5 style="text-align:center;">Tạo Hóa Đơn Mới</h5>-->
	<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">
<i class="fas fa-box"></i> Thông tin kiện hàng 
</h3>

 <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
</div>

<div class="card-body" style="background-color:#EEE9E9">
<p>Gross Weight: <?php echo $data['gross_weight']?> KG | Charge Weight: <?php echo $data['charge_weight']?>KG</p>

					<div class="row">
<!--<div class="col-md-4">

					<div class="form-group">
                      <label for="">Số kiện</label>
                      <input type="number" name="sokien" class="form-control" id="sokien" value="0" required placeholder="Nhập số kiện" >
                    </div>
</div>-->



			</div>
					<div class="card-body table-bordered p-0">
                <table class="table table-hover table-bordered  text-nowrap">
                  <thead>
                    <tr style="background-color:#880000;color:white;text-align:center">
                      <th>Mã Kiện HAWB</th>
                      <th>Type</th>
                      <th>Length(Cm)</th>
                      <th>Width(Cm)</th>
                      <th>Heigth(Cm)</th>
                      <th>Weight(Kg)</th>
                      <th></th>
                    </tr>
                  </thead>
				   <tbody id="" style="background-color:white">
				   
				   
				   
				   <?php 
				   $laydulieukiena = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$data['id']."'");
				   while($laydulieukien = mysqli_fetch_array($laydulieukiena,MYSQLI_ASSOC))
				   {
					  echo"  <tr class='package'><form action='' method='POST'>
					  <td>                      
					  ".$laydulieukien['id_code']."</td>
					  <input type='hidden' name='b' value='".$laydulieukien['id_code']."'>
					 
					  <td>".$laydulieukien['type']."</td>
					  <td><input type='number' name='pack_length' value='".$laydulieukien['length']."' min='1'></td><td><input type='number' name='pack_width'  size=7 value='".$laydulieukien['width']."'  min='1'></td>
					  <td><input type='number' name='pack_height' value='".$laydulieukien['height']."' size=7  min='1'></td> 
					  <td><input type='number' name='pack_weight'  value='".$laydulieukien['cannang']."' step='any' min='0.5' max='999' ></td>           
					  <td>
					  
					  <button type='submit' name='btn_updatekien' class='btn btn-warning btn-sm'>Cập Nhật</button>
					  <button type='' name='btn_delete' class='btn btn-danger btn-sm' onclick='return confirm(\"Chắc chắn muốn xóa kiện hàng: ".$laydulieukien['id_code']."  ?\")'><i class='fas fa-trash-alt'></i></button>
					  </td>
					  </form>
					  </tr>"; 
				   }
				   ?>
				   

                   </tbody>				
					<tbody id="kiennho" style="background-color:white">				   				

				   </tbody>
                </table>	


			
				<span class="btn-danger add2" style="padding:5px;  cursor:pointer;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm kiện hàng</span>

<div class="block">
				</div>					 <form action='' method="POST" id="forma">

					<div class="form-group"  style="margin-left:20px;white-space:nowrap;" id="buttonadd">

                    </div></form>

</div>

</div>

</div>
	
	
	
	
	
	<!---  Invoice--->
		<form action="" method="POST" enctype="multipart/form-data">
	<div class="card card-primary">

<div class="card-header">
<h3 class="card-title">
<i class="far fa-list-alt"></i> Thông tin khai Invoice 
</h3>


 <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
    </div>
</div>

<div class="card-body " style="background-color:#EEE9E9">


					<div class="form-group">
                      <label for="">Tên hàng hóa</label>
                      <input type="text" name="package_tenhang" class="" id="" value="<?php echo $data['kg_tenhang']?>" required placeholder="Nhập tên hàng hóa" >
                    </div>
					<div class="form-group">
                      <label for="">Invoice Value</label>
                      <input type="number" id ="totalinvoice" class="" step="any" min="1" id="" value="<?php echo $data['kg_valueinvoice']?>" name="kg_valueinvoice" required placeholder="Nhập giá trị kiện hàng" required >
                    </div>


					<div class="row">
<div class="col-md-4">
					<div class="form-group">
                      <label for="">Export as</label>
                      <select name="ks_reason">
					  <option name="Gift (no commercial value)">Gift (no commercial value)</option>
					  <option name="Sample">Sample</option>
					  </select>
                    </div>
</div>
<div class="col-md-3">
<!--
					<div class="form-group">
					                      <label for="">Value of Invoice</label><br>

                      <input type="text" name="valueinvoice" class="form-control" id="valueinvoicea"  placeholder="Nhập Invoice Value" >
                    </div>-->
</div>

			</div>
				
					

					<div class="card-body table-bordered p-0">
                <table class="table table-hover table-bordered  text-nowrap">
                  <thead>
                    <tr style="background-color:#880000;color:white;text-align:center">
                      <th>GOODS DETAILS (PRODUCT NAMES, MATERIALS, STAMPS, ...)</th>
                      <th>QUANTITY</th>
                      <th>UNIT</th>
                      <th>&nbsp;&nbsp;&nbsp;PRICE&nbsp;&nbsp;&nbsp;</th>
                      <th>Total Value</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
				   <tbody id="invoiceadd" >
          
					<?php
					
									   $laydulieuinvoicea = mysqli_query($conn,"select * from ns_mapcatalog2 where id_bill='$id'");

				   while($laydulieuinvoice = mysqli_fetch_array($laydulieuinvoicea,MYSQLI_ASSOC))
				   {
					   echo"
                           <tr class='invoice'><div class='ccc'> <td><textarea class='form-control'  rows='3' placeholder='Nhập tên sản phẩm ...' name='iv_tensanpham[]'>".$laydulieuinvoice['iv_tensanpham']."</textarea></td> 
						   <td><input type='number' id='soluong_no' class='form-control soluong_no' value='".$laydulieuinvoice['soluong']."' name='iv_soluong[]'  size=7></td> 
						   <td><select name='iv_unit[]'><option value='Pcs'>Pcs</option><option value='Bag'>Bag</option><option value='Box'>Box</option><option value='Jar'>Jar</option><option value='Set'>Set</option></select></td>
						   <td><input type='number' value='".$laydulieuinvoice['iv_price']."'  class='form-control price_no' name='iv_price[]' id='price_no' step='any' size=7></td> 
						   <td style='text-align:center;font-weight:bold'>
						   <input type='number' class='form-control sum' id='sum' value='".$laydulieuinvoice['iv_price']*$laydulieuinvoice['soluong']."' style='border: none;outline: none;' size='4' disabled></td>  
						   <td><span class='btn-danger remove' style='padding:5px;  cursor:pointer;'><i class='fas fa-trash-alt'></i></span></td>  </div> </tr>
					";
				   }
						?>
				  
				  
				  
				  
				  
				  
                   </tbody>
                </table>
				<div class="block">
				<span class="btn-danger add" style="padding:5px;  cursor:pointer;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm sản phẩm</span>
				</div>
					<br><br><br>
				<button style="float:right;" type="submit" name="btn_updateinvoice" class="btn btn-danger">Cập nhật Invoice</button>

</div>

</div>
<!--
<div class="card-footer">
				<button style="float:right;" type="submit" name="btn_updateinvoice" class="btn btn-danger">Cập nhật Invoice</button>
                </div>-->
				
</div>

	</form>
	
	
	
	
	
	
	
	
</div>


<div class="row">






</div>
<div class="modal fade  bd-example-modal-l" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Điều Khoản Sử Dụng Dịch Vụ SHIBA EXPRESS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<?php
$stringmod = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_string_mod where string_mod='ksn_dieukhoan'"));
echo $stringmod['string_ksn'];
?>      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>








<?php  
    include('footer.php');
?>


<script>
	VirtualSelect.init({ 
search: true,
  dropboxWidth: '500px',
  ele: '.sample-select', 
});
</script>
<script src="gd/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript">


	    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

	
	$('#nguoigui_tp-dropdown').on('change', function(){
		var province_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				province_id: province_id,
				action: "filterDistrict"
			},
			cache: false,
			success: function(result){
				$("#nguoigui_district-dropdown").html(result);
				$("#nguoigui_ward-dropdown").html('<option value=""></option>');
			}
		});
	});

	$('#nguoigui_district-dropdown').on('change', function(){
		var district_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				district_id: district_id,
				action: "filterWard"
			},
			cache: false,
			success: function(result){
				$("#nguoigui_ward-dropdown").html(result);
			}
		});
	});
	
	
	$('#nguoinhan_countries-dropdown').on('change', function(){
		var countries_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				countries_id: countries_id,
				action: "filterCity"
			},
			cache: false,
			success: function(result){
				$("#nguoinhan_cities-dropdown").html(result);
			}
		});
	});
	
	
	$('#nguoinhan_countries-dropdown').on('change', function(){
		var countries_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				countries_id: countries_id,
				action: "filterDichVu"
			},
			cache: false,
			success: function(result){
				$("#dichvu-dropdown").html(result);
			}
		});
	});

	$('#oldReceiver').on('change', function() {
		var id = this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				id: id,
				action: 'getReceiver'
			},
			cache: false,
			async: false,
			success: function(result){
				$("#id_tennguoinhan").val(result.name);
				$("#id_phonenguoinhan").val(result.phone);
				$("#id_addnguoinhan").val(result.address);
				$("#id_tpnguoinhan").val(result.city);
				$("#id_socmnd").val(result.id_no);
				$("#id_company").val(result.company_name);
				$("#id_state").val(result.state);
				$("#id_postcode").val(result.post_code);
			},
			dataType:"json"
		});


		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				id: id,
				action: 'filterCountryOld'
			},
			cache: false,
			async: false,
			success: function(result){
				$("#nguoinhan_countries-dropdown").html(result);
			}
		});

	});

	$(".myclass").on("change", function(){
		var value1 = document.getElementById('cannang').value;
		var value2 = document.getElementById('giadongia').value;
		var value4 = document.getElementById('giabaohiem').value;
		// var sum = (parseFloat(value1) * parseFloat(value2)) + parseFloat(value3)  + parseFloat(value4) + parseFloat(value6) -  parseFloat(value5) ;
		var sum = (parseFloat(value1) * parseFloat(value2)) +  parseFloat(value4);
		// $('#giatong').val(parseFloat(sum).toLocaleString('vi', {style : 'currency', currency : 'VND'}));
		$('#giatong').val(parseFloat(sum));


	});

</script>





<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>


  <script type="text/javascript">
  
  		
	

  
  
  
  	$('.add').click(function() {
		$ii++;
		$("#invoiceadd").append("<tr class='invoice'><div class='ccc'> <td><textarea class='form-control'  rows='3' placeholder='Nhập tên sản phẩm ...' name='iv_tensanpham[]'></textarea></td> <td><input type='number' id='soluong_no' class='form-control soluong_no' name='iv_soluong[]'  size=7></td> <td><select name='iv_unit[]'><option value='Pcs'>Pcs</option><option value='Bag'>Bag</option><option value='Box'>Box</option><option value='Jar'>Jar</option><option value='Set'>Set</option></select></td><td><input type='number' class='form-control price_no' name='iv_price[]' id='price_no' step='any' size=7></td> <td style='text-align:center;font-weight:bold'><input type='number' class='form-control sum' id='sum' style='border: none;outline: none;' size='4' disabled></td>  <td><span class='btn-danger remove' style='padding:5px;  cursor:pointer;'><i class='fas fa-trash-alt'></i></span></td>  </div> </tr>");
	});
  
   $('#invoiceadd').on('input', '.soluong_no, .price_no', function() {
  var $container = $(this).closest('tr');
  var number = $container.find('.price_no').val() || 0;
  var multi = $container.find('.soluong_no').val() || 0;
  $container.find('.sum').val(number * multi);
  updateTotal();
});

function updateTotal() {
  var total = 0;
  $('.sum').each(function() {
    total += parseFloat($(this).val(), 10);
  });
  $('#totalinvoice').val(total);
}
    </script>
<script type="text/javascript">








	$ii = 1;
$totalsum = 0;
	$(document).ready(function() {
		
		


		
		
			
    $('#kiennho').on('click', '.removea', function () {
		$(this).closest('.package').remove();
	  });
		
	
		
		
		
	
	$('.add2').click(function() {
		$ii++;
		$("#kiennho").append("<tr class='package'><td>                      <input type='number' name='sokien[]'  form='forma' style='text-align:center;' value='1' id='sokien' min='1' max='99' required placeholder='' readonly></td><td><select name='pack_type[]'  form='forma' ><option value='Carton'>Carton</option><option value='Pallet'>Pallet</option><option value='Túi(Phong bì)'>Túi(Phong bì)</option></select></td><td><input type='number'  form='forma'  name='pack_length[]' required min='1'></td><td><input type='number' name='pack_width[]'  form='forma'  min='1' size=7 required></td><td><input type='number'  min='1' name='pack_height[]' required form='forma'   size=7></td> <td><input type='number' name='pack_weight[]'  required form='forma'  step='any' min='0.5' max='999' ></td>                      <td><span class='btn-danger removea' style='padding:5px;  cursor:pointer;'><i class='fas fa-trash-alt'></i></span></td></tr>");
		$("#buttonadd").html("                     <center><button type='submit' name='btn_addpackage' class='btn btn-danger'  form='forma' >XÁC NHẬN THÊM KIỆN HÀNG</button></center>");
	});
		
		
		
		
		
    $('body').on('click', '.remove', function () {
		$(this).closest('.invoice').remove();
	  });
	});
			
		

		
		
		

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
