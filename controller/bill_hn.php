<?php  
	function createSender($nguoigui_npp,$nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone){
		mysql_query("INSERT INTO `ns_nguoigui` (`npp`,`name`, `province_id`, `district_id`, `ward_id`,`address`,`phone`)
			VALUES ('$nguoigui_npp','$nguoigui_name','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone')") or die(mysql_error()); 
		return mysql_insert_id();
	}

	function updateSender($nguoigui_npp,$id_nguoigui,$nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone){
		// $query = mysql_query("UPDATE `yn_product` SET `inventory` = (`inventory`+".$quantity.") WHERE `id` = '$productid'");
		mysql_query("UPDATE `ns_nguoigui` SET `npp`='$nguoigui_npp',`name`='$nguoigui_name', `province_id`='$nguoigui_tp', `district_id`='$nguoigui_districtid', `ward_id`='$nguoigui_wardid',`address`='$nguoigui_add',`phone`='$nguoigui_phone' WHERE id = '$id_nguoigui'") or die(mysql_error()); 
		// return mysql_insert_id();
	}

	function createReceiver($nguoinhan_name,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add,$cus_code,$id_no){
		mysql_query("INSERT INTO `ns_nguoinhan` (`name`, `phone`, `country_id`, `city`,`address`,`cus_code`,`id_no`)
			VALUES ('$nguoinhan_name','$nguoinhan_phone', '$nguoinhan_countries', '$nguoinhan_city', '$nguoinhan_add','$cus_code','$id_no')") or die(mysql_error()); 
		return mysql_insert_id();
	}

	function updateReceiver($id_nguoinhan,$nguoinhan_name,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add,$id_no){
		mysql_query("UPDATE `ns_nguoinhan` SET `name`='$nguoinhan_name', `phone`='$nguoinhan_phone', `country_id`='$nguoinhan_countries', `city`='$nguoinhan_city',`address`='$nguoinhan_add',`id_no`='$id_no' WHERE id = '$id_nguoinhan'") or die(mysql_error());
	}

	function createBill($id_nguoigui,$id_nguoinhan,$uid,$date,$datenow2,$tenhang,$cannang,$sokien,$giakhaibao,$unitprice,$giabaohiem,$total,$partner,$status, $note){
		mysql_query("INSERT INTO `gpehn_listhoadon` (`id_nguoigui`, `id_nguoinhan`, `uid`, `date`,`datetime`, `tenhang`, `cannang`,`sokien`, `giakhaibao`, `unitprice`,`giabaohiem`, `total`, `id_partner`,`status`,`note`)
			VALUES ('$id_nguoigui','$id_nguoinhan', '$uid', '$date', '$datenow2','$tenhang', '$cannang', '$sokien', '$giakhaibao','$unitprice', '$giabaohiem', '$total', '$partner', '$status', '$note')") or die(mysql_error()); 
	}

	function countSubByPackageId($packageid){
		$count = mysql_num_rows(mysql_query("SELECT * FROM gpehn_listhoadon WHERE id_package = '$packageid'"));
		$i = $count + 1;
		return $i;
	}

	function countSubByPackageSeaId($packageid){
		$count = mysql_num_rows(mysql_query("SELECT * FROM ns_listhoadon_sea WHERE id_package = '$packageid'"));
		$i = $count + 1;
		return $i;
	}

	function createBillForPacker($uid,$id,$date,$datenow2,$cannang,$sokien,$status, $note, $pcs){
		$checkdatenow = mysql_query("select * from gpehn_listhoadon where  DATE(date) = CURDATE()")or die("Loi");
		$getdatenow = date("dm");
		$notecode = $getdatenow.'-'.(mysql_num_rows($checkdatenow)+1);
		mysql_query("INSERT INTO `gpehn_listhoadon` (`uid`, `id_package`,`date`,`datetime`, `cannang`,`sokien`, `status`,`note`,`pcs`,`notecode`)
			VALUES ('$uid', '$id', '$date', '$datenow2','$cannang', '$sokien','$status', '$note', '$pcs','$notecode')") or die(mysql_error()); 
		return mysql_insert_id();
	}

	function createBillForPackerSea($uid,$id,$date,$datenow2,$cannang,$sokien,$status, $note, $pcs){
		mysql_query("INSERT INTO `ns_listhoadon_sea` (`uid`, `id_package`,`date`,`datetime`, `cannang`,`sokien`, `status`,`note`,`pcs`)
			VALUES ('$uid', '$id', '$date', '$datenow2','$cannang', '$sokien','$status', '$note', '$pcs')") or die(mysql_error()); 
		return mysql_insert_id();
	}


	function createPackage($id_nguoigui,$cus_code,$id_nguoinhan,$uid,$sokien,$date,$chiho){
		mysql_query("INSERT INTO `gpehn_package` (`cus_code`,`id_nguoigui`, `id_nguoinhan`, `uid`, `sokien`,`date`,`chiho`)
			VALUES ('$cus_code','$id_nguoigui','$id_nguoinhan', '$uid', '$sokien', '$date','$chiho')") or die(mysql_error()); 
	}

	function createPackageSea($id_nguoigui,$cus_code,$id_nguoinhan,$uid,$sokien,$date,$chiho){
		mysql_query("INSERT INTO `ns_package_sea` (`cus_code`,`id_nguoigui`, `id_nguoinhan`, `uid`, `sokien`,`date`,`chiho`)
			VALUES ('$cus_code','$id_nguoigui','$id_nguoinhan', '$uid', '$sokien', '$date','$chiho')") or die(mysql_error()); 
	}

	function updatePackageForSale($id_package, $id_nguoigui, $id_nguoinhan, $sokien, $chiho){
		mysql_query("UPDATE `gpehn_package` SET `id_nguoigui`='$id_nguoigui', `id_nguoinhan`='$id_nguoinhan', `sokien`='$sokien', `chiho`='$chiho' WHERE id = '$id_package'") or die(mysql_error());
	}

	function updatePackageSeaForSale($id_package, $id_nguoigui, $id_nguoinhan, $sokien, $chiho){
		mysql_query("UPDATE `gpehn_package` SET `id_nguoigui`='$id_nguoigui', `id_nguoinhan`='$id_nguoinhan', `sokien`='$sokien'`chiho`='$chiho' WHERE id = '$id_package'") or die(mysql_error());
	}

	function updatePackage($id_package, $id_nguoigui, $id_nguoinhan, $sokien, $unitprice, $unitprice_mp, $unitprice_tp, $cannang_thuong, $cannang_mp, $cannang_tp, $giamgia,$giaphuthu,$giabaohiem,$total,$note,$chiho){
		mysql_query("UPDATE `gpehn_package` SET `id_nguoigui`='$id_nguoigui', `id_nguoinhan`='$id_nguoinhan', `sokien`='$sokien', `unitprice`='$unitprice', `unitprice_mp`='$unitprice_mp', `unitprice_tp`='$unitprice_tp', `cannang_thuong`='$cannang_thuong', `cannang_mp`='$cannang_mp', `cannang_tp`='$cannang_tp',`giamgia`='$giamgia', `giaphuthu`='$giaphuthu', `giabaohiem`='$giabaohiem', `total`='$total', `note`='$note', `chiho`='$chiho' WHERE id = '$id_package'") or die(mysql_error());
	}

	function updatePackageSea($id_package, $id_nguoigui, $id_nguoinhan, $sokien, $unitprice, $unitprice_mp, $unitprice_tp, $cannang_thuong, $cannang_mp, $cannang_tp, $giamgia,$giaphuthu,$giabaohiem,$total,$note,$chiho){
		mysql_query("UPDATE `ns_package_sea` SET `id_nguoigui`='$id_nguoigui', `id_nguoinhan`='$id_nguoinhan', `sokien`='$sokien', `unitprice`='$unitprice', `unitprice_mp`='$unitprice_mp', `unitprice_tp`='$unitprice_tp', `cannang_thuong`='$cannang_thuong', `cannang_mp`='$cannang_mp', `cannang_tp`='$cannang_tp', `giamgia`='$giamgia', `giaphuthu`='$giaphuthu', `giabaohiem`='$giabaohiem', `total`='$total', `note`='$note',`chiho`='$chiho' WHERE id = '$id_package'") or die(mysql_error());
	}


	function updateBill($id,$cannang, $note){
		mysql_query("UPDATE `gpehn_listhoadon` SET `cannang`='$cannang', `note`='$note' WHERE id = '$id'") or die(mysql_error());
	}

	function updateBillSea($id,$cannang, $note){
		mysql_query("UPDATE `gpehn_listhoadon_sea` SET `cannang`='$cannang', `note`='$note' WHERE id = '$id'") or die(mysql_error());
	}


	function getBillData($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM gpehn_listhoadon WHERE id = '$id'"));
		return $data;
	}

	function getBillDataSea($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM gpehn_listhoadon_sea WHERE id = '$id'"));
		return $data;
	}

	function getPackageData($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM gpehn_package WHERE id = '$id'"));
		return $data;
	}

	function getPackageDataSea($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package_sea WHERE id = '$id'"));
		return $data;
	}

	function getSender($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id='$id'"));
		return $data;
	}

	function getCustomerByCode($code){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM gpehn_customer WHERE cus_code='$code'"));
		return $data;
	}
	function getCustomerByName($code){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM gpehn_customer WHERE name='$code'"));
		return $data;
	}

	function getReceiver($id){
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id='$id'"));
		return $data;
	}

	function getCountryById($id){
		$countries = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_countries WHERE id = '$id'"));
		return $countries;
	}

	function deletecataloglist($id_bill){
		$delete_query = mysql_query("DELETE FROM gpehn_mapcatalog WHERE id_bill = '$id_bill'");
	}

	function updatecataloglist($id_bill,$catalogid){
		$insert_query = mysql_query("INSERT INTO gpehn_mapcatalog (`id_bill`,`id_catalog`) VALUES ('$id_bill', '$catalogid')");
	}

	function deletecataloglist_sea($id_bill){
		$delete_query = mysql_query("DELETE FROM gpehn_mapcatalog_sea WHERE id_bill = '$id_bill'");
	}

	function updatecataloglist_sea($id_bill,$catalogid){
		$insert_query = mysql_query("INSERT INTO ns_mapcatalog_sea (`id_bill`,`id_catalog`) VALUES ('$id_bill', '$catalogid')");
	}
?>