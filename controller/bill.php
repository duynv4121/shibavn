<?php  

	function statusbill($idbill)
	{
		if($idbill == 0)
		{
			$status_string = '<small class="badge badge-secondary"><i class="far fa-clock"></i> Create Bill</small>';
		}else if($idbill == 1)
		{
			$status_string =  '<small class="badge badge-primary"><i class="fas fa-check-circle"></i> Import</small>';
		}else if($idbill == 2)
		{
			$status_string =  '<small class="badge badge-warning"><i class="fas fa-plane-departure"></i> Exported</small>';
		}else if($idbill == 5)
		{
			$status_string =  '<small class="badge badge-danger"><i class="fas fa-undo-alt"></i> Returned</small>';
		}else
		{
			$status_string = '<small class="badge badge-secondary"><i class="far fa-clock"></i> Create Bill</small>';
		}
		return  $status_string;

	}
	
	function checkthanhtoan($checkthanhtoan)
	{
		if($checkthanhtoan == 2)
		{
			$status_string = '<small class="badge badge-success"><i class="fas fa-check-circle"></i> Đã thanh toán</small>';
		}else if($checkthanhtoan == 1)
		{
			$status_string =  '<small class="badge badge-warning"><i class="far fa-clock"></i> Chờ thanh toán</small>';
		}else if($checkthanhtoan == 3)
		{
			$status_string =  '<small class="badge badge-warning"><i class="far fa-clock"></i> Chờ duyệt lệnh</small>';
		}else if($checkthanhtoan == 5)
		{
			$status_string =  '<small class="badge badge-warning"><i class="far fa-clock"></i> Duyệt Tạm Ứng</small>';
		}else if($checkthanhtoan == 6)
		{
			$status_string =  '<small class="badge badge-danger"><i class="far fa-clock"></i> ĐÃ GỬI DEBIT</small>';
		}
		else
		{
			$status_string =  '<small class="badge badge-secondary"><i class="far fa-clock"></i> Chưa thanh toán</small>';

		}
		return  $status_string;

	}
	  function string_mod($string_mod,$conn)
{
$string_moda = mysqli_fetch_assoc(mysqli_query($conn,"SELECT string_ksn FROM ksn_string_mod where string_mod='$string_mod'"))or die("Loi 2");
return $string_moda['string_ksn'];
}
	function chucvu($id_role)
	{
		if($id_role == 3)
		{
			$string = 'Accountant';
		}if($id_role == 2)
		{
			$string = '<font color=red>FWD</font>';
		}else if($id_role == 4)
		{
			$string = 'Document Staff';
		}else if($id_role == 5)
		{
			$string = 'OPS & Pickup';
		}else if($id_role == 6)
		{
			$string = 'Salesman';
		}
		return $string;
	}
	function check_active($active)
	{
		if($active == 2)
		{
			$string = '<span class="float-right badge bg-danger">Disabled</span>';
		}else if($active == 1)
		{
			$string = '<span class="float-right badge bg-warning">Wait Active</span>';
		}else 
		{
			$string = '<span class="float-right badge bg-info">Active</span>';
		}
		return $string;
	}
	function congno($idbill)
	{
		if($idbill == 1)
		{
			$status_string = '<font color=red style="">Công nợ 1 ngày</font color>';
		}else if($idbill == 2)
		{
			$status_string = '<font color=blue>Công nợ 1 tuần</font color>';
		}else if($idbill == 3)
		{
			$status_string = '<font color=green>Công nợ 1 tháng</font color>';
		}else if($idbill == 4)
		{
			$status_string = '<font color=blue>Công nợ 2 tuần</font color>';
		}
		else
		{
			$status_string = '<font color=red>Công nợ 1 ngày</font color>';

		}
		return  $status_string;

	}
	function congnoa($idbill)
	{
		if($idbill == 1)
		{
			$status_string = 'DAY';
		}else if($idbill == 2)
		{
			$status_string = 'WEEK';
		}else if($idbill == 3)
		{
			$status_string = 'MONTH';
		}else if($idbill == 4)
		{
			$status_string = '2 WEEK';
		}
		return  $status_string;

	}
	function get_price_type($idbill)
	{
		if($idbill == 1)
		{
			$status_string = '<font color=#CC0033>BẢNG GIÁ F1</font color>';
		}else if($idbill == 0)
		{
			$status_string = '<font color=#CC0033>BẢNG GIÁ F0</font color>';
		}else
		{
			$status_string = '<font color=red>CHƯA CẬP NHẬT</font color>';
		}
		return  $status_string;

	}
	
	function location_chinhanh($chinhanh)
	{
		if($chinhanh == "HCM")
		{
			$status_string = 'HO CHI MINH, VN';
		}else if($chinhanh == "HN")
		{
			$status_string = 'HA NOI, VN';
		}else if($chinhanh == "DAD")
		{
			$status_string = 'DA NANG, VN';
		}
		return  $status_string;

	}function vn_portalcode($chinhanh)
	{
		if($chinhanh == "HCM")
		{
			$status_string = '700000';
		}else if($chinhanh == "HN")
		{
			$status_string = '100000';
		}else if($chinhanh == "DAD")
		{
			$status_string = '550000';
		}
		return  $status_string;

	}
	
	function airport_chinhanh($chinhanh)
	{
		if($chinhanh == "HCM")
		{
			$status_string = 'SGN';
		}else if($chinhanh == "HN")
		{
			$status_string = 'HAN';
		}else if($chinhanh == "DAD")
		{
			$status_string = 'DAD';
		}
		return  $status_string;

	}
	
	
	
	function add_debit($uid,$idkhachhang,$vat_fee,$conn)
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$datenow = date("Y:m:d H:i:s");

		$ma_debit = ''.$idkhachhang.'_'.	date("Ymdhi");
		mysqli_query($conn,"INSERT INTO `ksn_debit` (`datetime`, `uid`, `idkhachhang`, `debitno`,`vat`) VALUES ('$datenow', '$uid', '$idkhachhang', '$ma_debit','$vat_fee')");
		return mysqli_insert_id($conn);

	}
	function add_trackingBill($id_code,$status,$detail,$conn)
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$datenow = date("Y:m:d H:i:s");
		mysqli_query($conn,"INSERT INTO `ns_tracking_bill` (`id_hoadon`,`status`, `address`,`date` ) VALUES ('$id_code', '$status', '$detail','$datenow')") or die(mysqli_error());
	}
	function add_trackingBill2($id_code,$status,$detail,$date,$conn)
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$datenow = date("Y:m:d H:i:s");
		mysqli_query($conn,"INSERT INTO `ns_tracking_bill` (`id_hoadon`,`status`, `address`,`date` ) VALUES ('$id_code', '$status', '$detail','$date')") or die(mysqli_error());
	}
	
	function getNamebyUser($uid,$conn)
	{
		
		$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id = '$uid'"))or die(mysqli_error());
		return $data['ten'];

	}
	
	function dichvu($conn,$idbilltong)
	{
		$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_dichvu WHERE id = '$idbilltong'"));
		return  $data['dichvu'];

	}
	function createSender($nguoigui_npp,$nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone,$nguoigui_company,$nguoigui_code,$conn){
		mysqli_query($conn,"INSERT INTO `ns_nguoigui` (`npp`,`name`, `province_id`, `district_id`, `ward_id`,`address`,`phone`,`company_name`,`cus_code`)
			VALUES ('$nguoigui_npp','$nguoigui_name','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone','$nguoigui_company','$nguoigui_code')") or die(mysql_error()); 
		return mysqli_insert_id($conn);
	}

	function updateSender($nguoigui_npp,$id_nguoigui,$nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone,$nguoigui_company,$conn){
		// $query = mysql_query("UPDATE `yn_product` SET `inventory` = (`inventory`+".$quantity.") WHERE `id` = '$productid'");
		mysqli_query($conn,"UPDATE `ns_nguoigui` SET `npp`='',`name`='$nguoigui_name', `province_id`='$nguoigui_tp', `district_id`='$nguoigui_districtid', `ward_id`='$nguoigui_wardid',`address`='$nguoigui_add',`phone`='$nguoigui_phone',`company_name`='$nguoigui_company' WHERE id = '$id_nguoigui'") or die(mysqli_error()); 
		// return mysql_insert_id();
	}

	function createReceiver($nguoinhan_name,$nguoinhan_company,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add,$cus_code,$id_no,$nguoinhan_add2,$nguoinhan_add3,$nguoinhan_state,$nguoinhan_post_code,$save,$conn){
		mysqli_query($conn,"INSERT INTO `ns_nguoinhan` (`name`, `company_name`,`phone`, `country_id`, `city`,`address`,`cus_code`,`id_no`,`address2`,`address3`,`state`,`post_code`,`save`)
			VALUES ('$nguoinhan_name','$nguoinhan_company','$nguoinhan_phone', '$nguoinhan_countries', '$nguoinhan_city', '$nguoinhan_add','$cus_code','$id_no','$nguoinhan_add2','$nguoinhan_add3','$nguoinhan_state','$nguoinhan_post_code','$save')") or die(mysql_error()); 
		return mysqli_insert_id($conn);
	}

	function updateReceiver($id_nguoinhan,$nguoinhan_name,$nguoinhan_company,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add,$nguoinhan_add2,$nguoinhan_add3,$nguoinhan_state,$nguoinhan_post_code,$save,$id_no,$conn){
		mysqli_query($conn,"UPDATE `ns_nguoinhan` SET `name`='$nguoinhan_name',`company_name`='$nguoinhan_company', `phone`='$nguoinhan_phone', `country_id`='$nguoinhan_countries', `city`='$nguoinhan_city'
		,`address`='$nguoinhan_add',`address2`='$nguoinhan_add2',`address3`='$nguoinhan_add3',`state`='$nguoinhan_state',`post_code`='$nguoinhan_post_code',`save`='$save',`id_no`='$id_no' WHERE id = '$id_nguoinhan'") or die(mysql_error());
	}

	function createBill($id_nguoigui,$id_nguoinhan,$uid,$date,$datenow2,$tenhang,$cannang,$sokien,$giakhaibao,$unitprice,$giabaohiem,$total,$partner,$status, $note){
		mysql_query("INSERT INTO `ns_listhoadon` (`id_nguoigui`, `id_nguoinhan`, `uid`, `date`,`datetime`, `tenhang`, `cannang`,`sokien`, `giakhaibao`, `unitprice`,`giabaohiem`, `total`, `id_partner`,`status`,`note`)
			VALUES ('$id_nguoigui','$id_nguoinhan', '$uid', '$date', '$datenow2','$tenhang', '$cannang', '$sokien', '$giakhaibao','$unitprice', '$giabaohiem', '$total', '$partner', '$status', '$note')") or die(mysql_error()); 
	}

	function countSubByPackageId($packageid,$conn){
		$count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id_package = '$packageid'"));
		$i = $count + 1;
		return $i;
	}

	function countSubByPackageSeaId($packageid){
		$count = mysql_num_rows(mysql_query("SELECT * FROM ns_listhoadon_sea WHERE id_package = '$packageid'"));
		$i = $count + 1;
		return $i;
	}

	function createBillForPacker($uid,$id,$date,$datenow2,$cannang,$sokien,$status, $note, $pcs,$cuscode,$pack_type,$pack_length,$pack_width,$pack_height,$convert_weight,$charge_weight,$conn){
		$layid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_listhoadon ORDER BY id DESC ")) or die("Loi");
		
		$a=array("2","4","6","8");
		$random_keys=array_rand($a);
		$id_code = ($layid['id']+202411221955);
		mysqli_query($conn,"INSERT INTO `ns_listhoadon` (`uid`, `id_package`,`date`,`datetime`, `cannang`,`sokien`, `status`,`note`,`pcs`,`cus_code`,`type`,`length`,`width`,`height`,`convert_weight`,`charge_weight`,`id_code`)
			VALUES ('$uid', '$id', '$date', '$datenow2','$cannang', '$sokien','0', '$note', '$pcs','$cuscode','$pack_type','$pack_length','$pack_width','$pack_height','$convert_weight','$charge_weight','$id_code')") or die(mysqli_error()); 
		return mysqli_insert_id($conn);
	}

	function createBillForPackerSea($uid,$id,$date,$datenow2,$cannang,$sokien,$status, $note, $pcs){
		mysql_query("INSERT INTO `ns_listhoadon_sea` (`uid`, `id_package`,`date`,`datetime`, `cannang`,`sokien`, `status`,`note`,`pcs`)
			VALUES ('$uid', '$id', '$date', '$datenow2','$cannang', '$sokien','$status', '$note', '$pcs')") or die(mysql_error()); 
		return mysql_insert_id();
	}


	function createPackageforSale($id_nguoigui,$cus_code,$id_nguoinhan,$uid,$sokien,$date,$chiho,$kg_dichvu,$kg_chinhanh,$kg_ref,$kg_reiceiversign,$congno,$conn,$id_sale,$khach_cannang,$khach_cuocbay,$khach_phuthu,$khach_cuocnoidia,$khach_thuho,$khach_baohiem,$khach_phibaohiem,$checkthanhtoan,$payment_type,$vat){
		$layid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package  ORDER BY id DESC ")) or die("Loi");
		$layid_new = (3298992000+$layid['id']);
		mysqli_query($conn,"INSERT INTO `ns_package` (`id_code`,`cus_code`,`id_nguoigui`, `id_nguoinhan`, `uid`, `sokien`,`date`,`chiho`,`kg_dichvu`,`kg_chinhanh`,`kg_ref`,`kg_reiceiversign`,`congno`,`id_sale`,`khach_cannang`,`khach_cuocbay`,`khach_phuthu`,`khach_cuocnoidia`,`khach_thuho`,`khach_baohiem`,`khach_phibaohiem`,`checkthanhtoan`,`payment_type`,`vat`)
			VALUES ('$layid_new','$cus_code','$id_nguoigui','$id_nguoinhan', '$uid', '$sokien', '$date','$chiho','$kg_dichvu','$kg_chinhanh','$kg_ref','$kg_reiceiversign','$congno','$id_sale','$khach_cannang','$khach_cuocbay','$khach_phuthu','$khach_cuocnoidia','$khach_thuho','$khach_baohiem','$khach_phibaohiem','$checkthanhtoan','$payment_type','$vat')") or die(mysql_error()); 
					return mysqli_insert_id($conn);

	}function createPackage($id_nguoigui,$cus_code,$id_nguoinhan,$uid,$sokien,$date,$chiho,$kg_dichvu,$kg_chinhanh,$kg_ref,$kg_reiceiversign,$congno,$conn){
		$layid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package  ORDER BY id DESC ")) or die("Loi");
		$layid_new = (3298992000+$layid['id']);
		mysqli_query($conn,"INSERT INTO `ns_package` (`id_code`,`cus_code`,`id_nguoigui`, `id_nguoinhan`, `uid`, `sokien`,`date`,`chiho`,`kg_dichvu`,`kg_chinhanh`,`kg_ref`,`kg_reiceiversign`,`congno`)
			VALUES ('$layid_new','$cus_code','$id_nguoigui','$id_nguoinhan', '$uid', '$sokien', '$date','$chiho','$kg_dichvu','$kg_chinhanh','$kg_ref','$kg_reiceiversign','$congno')") or die(mysql_error()); 
					return mysqli_insert_id($conn);

	}

	function createPackageSea($id_nguoigui,$cus_code,$id_nguoinhan,$uid,$sokien,$date,$chiho){
		mysql_query("INSERT INTO `ns_package_sea` (`cus_code`,`id_nguoigui`, `id_nguoinhan`, `uid`, `sokien`,`date`,`chiho`)
			VALUES ('$cus_code','$id_nguoigui','$id_nguoinhan', '$uid', '$sokien', '$date','$chiho')") or die(mysql_error()); 
	}



	function updatePackageSeaForSale($id_package, $id_nguoigui, $id_nguoinhan, $sokien, $chiho){
		mysql_query("UPDATE `ns_package_sea` SET `id_nguoigui`='$id_nguoigui', `id_nguoinhan`='$id_nguoinhan', `sokien`='$sokien'`chiho`='$chiho' WHERE id = '$id_package'") or die(mysql_error());
	}

	function updatePackage($id, $kg_dichvu, $kg_chinhanh,$kg_ref,$kg_reiceiversign,$conn){
		mysqli_query($conn,"UPDATE `ns_package` SET `kg_dichvu`='$kg_dichvu', `kg_chinhanh`='$kg_chinhanh' , `kg_ref`='$kg_ref' , `kg_reiceiversign`='$kg_reiceiversign' WHERE id = '$id'") or die(mysql_error());
	}
	
	function updatePackageForSale($id, $kg_dichvu, $kg_chinhanh,$kg_ref,$kg_reiceiversign,$khach_cannang,$khach_cuocbay,$khach_phuthu,$khach_cuocnoidia,$khach_thuho,$khach_baohiem,$khach_phibaohiem,$conn){
		mysqli_query($conn,"UPDATE `ns_package` SET `kg_dichvu`='$kg_dichvu', `kg_chinhanh`='$kg_chinhanh' , `kg_ref`='$kg_ref' , `kg_reiceiversign`='$kg_reiceiversign', `khach_cannang`='$khach_cannang', `khach_cuocbay`='$khach_cuocbay', `khach_phuthu`='$khach_phuthu', `khach_cuocnoidia`='$khach_cuocnoidia', `khach_thuho`='$khach_thuho', `khach_baohiem`='$khach_baohiem', `khach_phibaohiem`='$khach_phibaohiem' WHERE id = '$id'") or die(mysql_error());
	}

	function updatePackageSea($id_package, $id_nguoigui, $id_nguoinhan, $sokien, $unitprice, $unitprice_mp, $unitprice_tp, $cannang_thuong, $cannang_mp, $cannang_tp, $giamgia,$giaphuthu,$giabaohiem,$total,$note,$chiho){
		mysql_query("UPDATE `ns_package_sea` SET `id_nguoigui`='$id_nguoigui', `id_nguoinhan`='$id_nguoinhan', `sokien`='$sokien', `unitprice`='$unitprice', `unitprice_mp`='$unitprice_mp', `unitprice_tp`='$unitprice_tp', `cannang_thuong`='$cannang_thuong', `cannang_mp`='$cannang_mp', `cannang_tp`='$cannang_tp', `giamgia`='$giamgia', `giaphuthu`='$giaphuthu', `giabaohiem`='$giabaohiem', `total`='$total', `note`='$note',`chiho`='$chiho' WHERE id = '$id_package'") or die(mysql_error());
	}


	function updateBill($id,$cannang, $note){
		mysql_query("UPDATE `ns_listhoadon` SET `cannang`='$cannang', `note`='$note' WHERE id = '$id'") or die(mysql_error());
	}

	function updateBillSea($id,$cannang, $note){
		mysql_query("UPDATE `ns_listhoadon_sea` SET `cannang`='$cannang', `note`='$note' WHERE id = '$id'") or die(mysql_error());
	}


	function getBillData($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_listhoadon WHERE id = '$id'"));
		return $data;
	}

	function getBillDataSea($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_listhoadon_sea WHERE id = '$id'"));
		return $data;
	}

	function getPackageData($id,$conn){
		$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id = '$id'"));
		return $data;
	}

	function getPackageDataSea($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package_sea WHERE id = '$id'"));
		return $data;
	}

	function getSender($id,$conn){
		$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id='$id'"));
		return $data;
	}

	function getCustomerByCode($code,$conn){
		$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_customer WHERE cus_code='$code' LIMIT 1"));
		return $data;
	}
	function getCustomerByName($code){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_customer WHERE name='$code'"));
		return $data;
	}

	function getReceiver($id,$conn){
		$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id='$id'"));
		return $data;
	}

	function getCountryById($id,$conn){
		$countries = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_countries WHERE id = '$id'"));
		return $countries;
	}

	function deletecataloglist($id_bill){
		$delete_query = mysqli_query("DELETE FROM ns_mapcatalog WHERE id_bill = '$id_bill'");
	}

	function updatecataloglist($id_bill,$catalogid,$conn){
		$insert_query = mysqli_query($conn,"INSERT INTO ns_mapcatalog (`id_bill`,`id_catalog`) VALUES ('$id_bill', '$catalogid')");
	}

	function deletecataloglist_sea($id_bill){
		$delete_query = mysql_query("DELETE FROM ns_mapcatalog_sea WHERE id_bill = '$id_bill'");
	}

	function updatecataloglist_sea($id_bill,$catalogid){
		$insert_query = mysql_query("INSERT INTO ns_mapcatalog_sea (`id_bill`,`id_catalog`) VALUES ('$id_bill', '$catalogid')");
	}
?>