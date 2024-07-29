<?php  
include("../conn/db.php");


function getReceiver(){

}


function filterDistrict(){
	
}

function filterWard(){
	
}

function filterCity(){
	
}

function filteruserrole(){
	
}

function filterusersubrole(){
	
}

function getCustomerCode(){
	
}
function getCustomerName(){
	
}
function getCustomerNameHN(){
	$query = mysqli_query($conn,"SELECT * FROM gpehn_customer ORDER BY id DESC");
	while ($item = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '
		<option value="'.$item['name'].'"';
		echo '></option>';
	}
}

function filterCountryOld(){

}




if(isset($_POST['action'])){
	if ($_POST['action'] == "filterDistrict") { 
	$province_id = $_POST['province_id'];
	$query = mysqli_query($conn,"SELECT * FROM yn_district WHERE province_id='$province_id'") or die(mysql_error());
	echo '<option value="">Chọn quận/huyện</option>';
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$result['id'].'">'.$result['name'].'</option>';
	} 
	}
	
	else if ($_POST['action'] == "filterWard") { 
	$district_id = $_POST['district_id'];
	$query = mysqli_query($conn,"SELECT * FROM yn_ward WHERE district_id='$district_id'") or die(mysql_error());
	echo '<option value="">Chọn phường/xã</option>';
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$result['id'].'">'.$result['name'].'</option>';
	} 
	}
	
	else if ($_POST['action'] == "filterCity") { 
	$countries_id = $_POST['countries_id'];
	$query = mysqli_query($conn,"SELECT name,id FROM cities WHERE country_id='$countries_id' GROUP BY name order by name ASC") or die(mysql_error());
	echo '<option value="">Chọn Thành Phố</option>';
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$result['id'].'">'.$result['name'].'</option>';
	}
	}
	
	else if ($_POST['action'] == "filterNotifi") { 
	$countries_id = $_POST['countries_id'];
		if($countries_id == 174)
		{
			echo'<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-info"></i> Lưu ý!</h5>
Đối với dịch vụ KSN-PH cần nhập đúng State tại cột Tỉnh (State/Province)
</div>';
		}
	}
	else if ($_POST['action'] == "filterNotifi2") {
/*		
	$id_dichvu = $_POST['id_dichvu'];
		if($id_dichvu == 12)
		{
			echo'<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-info"></i> Lưu ý!</h5>
Dịch vụ KSN-EU chỉ nhận đơn hàng dưới 50kg
</div>';
		}else if($id_dichvu == 8)
		{
			echo'<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-info"></i> Lưu ý!</h5>
Dịch vụ KSN-US2 chỉ nhận đơn hàng hơn 21kg
</div>';
		}-->*/
	}
	
	
	
	else if ($_POST['action'] == "filterDichVu") { 
	$countries_id = $_POST['countries_id'];
	$query = mysqli_query($conn,"SELECT * FROM ksn_quocgia_dichvu WHERE id_quocgia='$countries_id' ") or die(mysql_error());
		
		
		
		if(mysqli_num_rows($query) >= 1)
		{
		$discount_check = $_POST['ds'];
		
		echo '<option value="">Chọn Dịch Vụ</option>';
		while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
			if($discount_check == '1')
			{
				$laythongtindichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where status='2' AND id='".$result['id_dichvu']."'"));
				if($laythongtindichvu['id'] != "")
				{
				echo '<option value="'.$laythongtindichvu['id'].'">'.$laythongtindichvu['dichvu'].'</option>';
				}
			}
			else
			{
				$laythongtindichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where status='2' AND `discount`='0' AND id='".$result['id_dichvu']."'"));
				if($laythongtindichvu['id'] != "")
				{
				echo '<option value="'.$laythongtindichvu['id'].'">'.$laythongtindichvu['dichvu'].'</option>';
				}
			}

		}
		}
		else
		{
			$dichvushipa = mysqli_query($conn,"SELECT * FROM ksn_dichvu where status='2' AND `discount`='0' order by id asc");
			echo '<option value="">Chọn dịch vụ</option>';
			while ($dichvuship = mysqli_fetch_array($dichvushipa,MYSQLI_ASSOC)){
					echo '
								<option value="'.$dichvuship['id'].'">'.$dichvuship['dichvu'].'</option>';
			}
		}
		
		
	}
	
	else if ($_POST['action'] == "filteruserrole") { 
	$uid = $_POST['userid'];
	$rid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT roleid FROM ns_user WHERE id = '$uid'"));
	$role = mysqli_query($conn,"SELECT * FROM ns_role WHERE id = '".$rid['roleid']."'") or die('error');
	while ($item = mysqli_fetch_array($role,MYSQLI_ASSOC)) {
		echo '
		<option value="'.$item['id'].'"';
		if ($item['id'] == $rid['roleid']) {
			echo 'selected';
		}
		echo '>'.$item['rolename'].'</option>';
	}
	}
	
	
	else if ($_POST['action'] == "filterusersubrole") { 
	$rid = $_POST['roleid'];
	$uid = $_POST['userid'];
	$role = mysqli_query($conn,"SELECT * FROM ns_maprole WHERE userid = '$uid' AND roleid = '$rid'");
	$arr = [];
	while ($item = mysqli_fetch_array($role,MYSQLI_ASSOC)) {
		array_push($arr, $item['subroleid']);
	}
	echo json_encode($arr);

	}
	
	
	else if ($_POST['action'] == "getCustomerCode") { 
	$query = mysqli_query($conn,"SELECT * FROM ns_customer ORDER BY id DESC");
	while ($item = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '
		<option value="'.$item['cus_code'].'"';
		echo '></option>';
	}
	}
	
	else if ($_POST['action'] == "getCustomerName") { 
	$query = mysqli_query($conn,"SELECT * FROM ns_customer ORDER BY id DESC");
	while ($item = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '
		<option value="'.$item['name'].'"';
		echo '></option>';
	}
	}
	
	else if ($_POST['action'] == "filterCountryOld") { 
	$id = $_POST['id'];
	$rs = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id='$id'"));
	$countries = mysqli_query($conn,"SELECT * FROM ns_countries  order by id asc");
	echo '<option value="">Chọn quốc gia</option>';
	while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
		echo '
		<option value="'.$item['id'].'"';
		if ($rs['country_id'] == $item['id']) {
			echo ' selected';
		}

		echo '>'.$item['name'].'</option>
		';
	}
	}
	
	else if ($_POST['action'] == "filterCityOld") { 
	$id = $_POST['id'];
	$rs = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id='$id'"));
	$countries = mysqli_query($conn,"SELECT * FROM cities where country_id='".$rs['country_id']."'  order by id asc");
	echo '<option value="">Chọn thành phố</option>';
	while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
		echo '
		<option value="'.$item['id'].'"';
		if ($rs['city'] == $item['id']) {
			echo ' selected';
		}

		echo '>'.$item['name'].'</option>
		';
	}
	}
	
	else if ($_POST['action'] == "getReceiver") {	
	$ida = $_POST['id'];
	$resulta = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id = $ida"))or die(mysql_error());
    echo json_encode($resulta); 
	}
	
	
	
	else if ($_POST['action'] == "getCalender") { getCalender(); }
	else if ($_POST['action'] == "addNote") { addNote(); }

}


/*
function getCalender(){
	$arr = [];
    $query = mysql_query("SELECT * FROM ns_calendar ORDER BY id ASC") or die(mysql_error());
    while ($item = mysql_fetch_array($query)) {
        array_push($arr,$item);
    }
    echo json_encode($arr);
}

function addNote(){
	$title = $_POST['title'];
	$start = $_POST['start'];
	$from_date = trim(preg_replace('/\s*\([^)]*\)/', '', $start)); // Sun Nov 01 2020 00:00:00 GMT+0530

	$dt = DateTime::createFromFormat('D M d Y H:i:s O',$from_date);

	//test output
	var_dump($dt);
	//object(DateTime)#1 (3) { ["date"]=> string(26) "2020-11-01 00:00:00.000000" ["timezone_type"]=> int(1) ["timezone"]=> string(6) "+05:30" }

	$newDate = $dt->format('Y-m-d h:i:s');
	mysql_query("INSERT INTO `ns_calendar` (`content`, `date`)
         VALUES ('$title','$newDate')") or die(mysql_error()); 
	echo $newDate;
}*/
?>