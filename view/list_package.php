<?php
include('top.php');
include('modals.php');
include("../controller/bill.php");
loadModalScanPackage();


/*if($uid != 1)
	{
		echo'<script> 
               window.location.href="list_packfwd.php";
            </script>';
	}
	*/


?>

<div class="container-fluid">
	<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> -->

	<?php

	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'update_cuoc_goc':
				$id = $_POST['id'];
				$newValue = $_POST['newValue'];

				mysqli_query($conn, 'UPDATE `ns_package` SET `cuoc_goc`=' . $newValue . '  WHERE `id`=' . $id . '');

				break;

			case 'update_khach_phu_thu':
				$id = $_POST['id'];
				$newValue = $_POST['newValue'];

				mysqli_query($conn, 'UPDATE `ns_package` SET `khach_phuthu`=' . $newValue . '  WHERE `id`=' . $id . '');

				break;
		}

		return;
	}


	if (isset($_POST['btn_deletea'])) {
		$id_delete = $_POST['id_delete'];
		$dulieudelete = mysqli_fetch_assoc(mysqli_query($conn, "select * from ns_package where id='$id_delete'"));
		if ($dulieudelete['status'] != 0) {
			echo 'Kiện hàng ở trạng thái không thể xóa';
		} else {
			echo 'Kiện hàng đã xóa và tạm thời vẫn được lưu trữ trong kho dữ liệu';
			mysqli_query($conn, "UPDATE `ns_package` SET `delete`='1' WHERE (`id`='$id_delete')");
		}
	}
	?>
	<form action="" method="POST">


	</form>


	<?php
	if (isset($_GET['day_start'])) {
		$day_start = $_GET['day_start'];
		$day_end = $_GET['day_end'];
	} else {
		if ($roleid == 2 || $roleid == 6) {
			$day_start = date('Y-m-d', strtotime("-15 days"));;
		} else {
			$day_start = date('Y-m-d', strtotime("-3 days"));;
		}
		$day_end = date('Y-m-d');
	}


	?>


	<?php


	if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 6 || $roleid == 2) {
		echo '		<div class="row"style="background-color:#EEEEEE;padding-top:20px;border: 1px solid black;border-style: outset;" >
<div class="col-sm-7" >';
		if ($roleid == 1 || $roleid == 3 || $roleid == 4) {
			echo '
				<button name="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-file-excel"></i> Export Report</button>
				
				
				';
		}
		if ($roleid == 6) {
			echo '<button name="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-file-excel"></i> Export Report</button>';
		}
		echo '<br><br>
		 		 <form method="GET" action="">

			<div class="form-group">
			<label for="aa">Date</label>
			<input type="date" id="aa" name="day_start" value="' . @$day_start . '">
			<label for="aa">To Date:</label>
			<input type="date" id="aa" name="day_end"  value="' . @$day_end . '">
				<input type="hidden" id="aa" name="ac"  value="list_package_sale">
				<input hidden id="aa" name="id"  value="' . @$_GET['id'] . '">
										
										
			<label for="aa">Status:</label>';

	?>

		<select name="status">
			<option>All</option>
			<option value="1" <?php if (@$_GET['status'] == 1) {
									echo 'selected';
								} ?>>Imported</option>
			<option value="2" <?php if (@$_GET['status'] == 2) {
									echo 'selected';
								} ?>>Exported</option>
			<option value="0" <?php if (@$_GET['status'] == '0') {
									echo 'selected';
								} ?>>Create Bill</option>
			<option value="5" <?php if (@$_GET['status'] == 5) {
									echo 'selected';
								} ?>>Returned</option>
		</select>

	<?php

		if ($roleid == 1 || $roleid == 4 || $roleid == 3) {
			echo '<select required name="kg_dichvu" id="" width=100%>';
			echo '<option value="all">Services</option>';
			$dichvushipa = mysqli_query($conn, "SELECT * FROM ksn_dichvu where status='2' order by id asc");
			while ($dichvuship = mysqli_fetch_array($dichvushipa, MYSQLI_ASSOC)) {

				echo '
								<option value="' . $dichvuship['id'] . '" ';


				echo '>' . $dichvuship['dichvu'] . '</option>';
			}

			echo '</select>
					
					
										<select name="brand"> 
										<option value="all">Chi nhánh</option>
										<option value="HCM" ';
			if (@$_GET['brand'] == 'HCM') {
				echo 'selected';
			}
			echo '>HCM</option>
									
										
										</select>
					
					';
		}

		echo '
										<input type="submit" name="" class="btn btn-danger btn-sm" value="Fill List">	
										
										</div>							

			</form>
				
			</div>
			
			<div class="col-sm-2" style=""><div class="form-group"><form action="" method="GET">
			<select class="form-control" name="s_type">
			<option value="id" ';
		if (@$_GET['s_type'] == 'id') {
			echo 'selected';
		}
		echo '>Search by ID Bill</option>
			<option value="hawb" ';
		if (@$_GET['s_type'] == 'hawb') {
			echo 'selected';
		}
		echo '>Search by HAWb</option>
			<option value="tracking" ';
		if (@$_GET['s_type'] == 'tracking') {
			echo 'selected';
		}
		echo '>Search by Tracking Code</option>
			';

		if ($roleid != 2) {
			echo '<option value="company" ';
			if (@$_GET['s_type'] == 'company') {
				echo 'selected';
			}
			echo '>Search by Sender Company </option>';
		}
		echo '<option value="receiver" ';
		if (@$_GET['s_type'] == 'receiver') {
			echo 'selected';
		}
		echo '>Search by Receiver name</option>';
		echo '<option value="address" ';
		if (@$_GET['s_type'] == 'address') {
			echo 'selected';
		}
		echo '>Search by Receiver Address</option>';
		echo '
			</select></div></div>
			
			<div class="col-sm-2" style="">

			<div class="form-group">
			<input type="text" class="form-control" name="s_value" value="' . @$_GET['s_value'] . '" placeholder="Search..." required>
			</div>
			</div>
			<div class="col-sm-1" style="">
			<div class="form-group">
			<input type="submit" class="btn btn-danger" name="search" value="Search" >
			</div>
			</div>
			</form>				</div>';


		echo '			<hr>

	';
	}


	?>


	<?php
	if ($roleid == 2) {
		echo '<div class="row" style="margin-left:5px;">';
		echo '<a href="create_package.php" class="btn btn-danger"><i class="fas fa-file-alt"></i> Tạo Hoá Đơn</a> &nbsp;&nbsp; </div><br>';
	}
	?>
	<div class="row">



		<div class="col-md-12">


			<!--<a href="list_package_bulk.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-upload"></i> Bulk Upload</a>-->





			<table id="example" class="display nowrap cell-border" style="width:100%;">
				<thead style="color:3399FF;background-color:#999900">
					<tr>
						<th style="text-align: center;color:white"></th>
						<th style="text-align: center;color:white">ID BILL</th>
						<!--<th style="text-align: center;color:white">Chốt Bill</th>-->
						<th style="text-align: center;color:white">Ngày</th>
						<!--  <th style="text-align: center;color:white">Mã tham chiếu</th>-->
						<th style="text-align: center;color:white">Dịch vụ</th>
						<th style="text-align: center;color:white">Người nhận</th>
						<th style="text-align: center;color:white">Địa chỉ</th>
						<th style="text-align: center;color:white">Chi nhánh</th>
						<th style="text-align: center;color:white">Trạng thái</th>
						<th style="text-align: center;color:white">Tracking</th>
						<th width="16%" style="text-align: center;color:white">Cước gốc</th>
						<th width="16%" style="text-align: center;color:white">Phụ thu</th>
						<?php
						if ($roleid == 1 || $roleid == 3) {
							echo '                  <th style="text-align: center;color:white">Lợi nhuận</th>
';
						}
						?>
						<th style="text-align: center;color:white"></th>
					</tr>
				</thead>
				<tbody>

					<?php
					if ($roleid == 1 || $roleid == 3 || $roleid == 4) {

						if (isset($_GET['kg_dichvu'])) {
							if ($_GET['kg_dichvu'] == "all" || $_GET['kg_dichvu'] == "") {
								$filldichvu = '';
							} else {

								$filldichvu = "AND kg_dichvu='" . $_GET['kg_dichvu'] . "'";
							}
						}

						if (isset($_GET['brand'])) {
							if ($_GET['brand'] == "all" || $_GET['brand'] == "") {
								$fillchinhanh = '';
							} else {

								$fillchinhanh = "AND kg_chinhanh='" . $_GET['brand'] . "'";
							}
						}


						if (isset($_GET['status'])) {
							if ($_GET['status'] == '2') {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND status='2' AND sokien <> 0 AND date >= '$day_start' AND date <= '$day_end' " . @$filldichvu . " " . @$fillchinhanh . "  ");
							} else if ($_GET['status'] == '1') {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND status='1' AND sokien <> 0 AND date >= '$day_start' AND date <= '$day_end'  " . @$filldichvu . "  " . @$fillchinhanh . "  ");
							} else if ($_GET['status'] == '0') {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND status<>'2' AND sokien <> 0 AND status<>'1' AND status<>'5' AND date >= '$day_start' AND date <= '$day_end' " . @$filldichvu . "  " . @$fillchinhanh . "  ");
							} else if ($_GET['status'] == '5') {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND status='5' AND sokien <> 0  AND date >= '$day_start' AND date <= '$day_end' " . @$filldichvu . "  " . @$fillchinhanh . "  ");
							} else {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND date >= '$day_start' AND date <= '$day_end'  " . @$filldichvu . "  " . @$fillchinhanh . "  ");
							}
						} else {
							$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND sokien <> 0 AND date >= '$day_start' AND date <= '$day_end'");
						}


						if (isset($_GET['s_type'])) {
							if ($_GET['s_type'] == "id") {
								$data = mysqli_query($conn, "SELECT * FROM ns_package where `delete` IS NULL AND sokien <> 0  AND id_code like '%" . trim($_GET['s_value']) . "%' order by id DESC ");
							} else if ($_GET['s_type'] == "hawb") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_listhoadon ON ns_package.id = ns_listhoadon.id_package where ns_listhoadon.id_code like '%" . trim($_GET['s_value']) . "%' AND ns_package.delete IS NULL AND ns_package.sokien <> 0 ");
							} else if ($_GET['s_type'] == "company") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_nguoigui ON ns_package.id_nguoigui = ns_nguoigui.id where ns_nguoigui.company_name like '%" . trim($_GET['s_value']) . "%' AND ns_package.delete IS NULL AND ns_package.sokien <> 0 ");
							} else if ($_GET['s_type'] == "tracking") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_listhoadon ON ns_package.id = ns_listhoadon.id_package where ns_listhoadon.billketnoi like '%" . trim($_GET['s_value']) . "%' AND ns_package.delete IS NULL AND ns_package.sokien <> 0 ");
							} else if ($_GET['s_type'] == "receiver") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_nguoinhan ON ns_package.id_nguoinhan = ns_nguoinhan.id where ns_nguoinhan.name like '%" . trim($_GET['s_value']) . "%' AND ns_package.delete IS NULL AND ns_package.sokien <> 0 ");
							} else if ($_GET['s_type'] == "address") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_nguoinhan ON ns_package.id_nguoinhan = ns_nguoinhan.id where (ns_nguoinhan.address like '%" . trim($_GET['s_value']) . "%' OR ns_nguoinhan.address2 like '%" . trim($_GET['s_value']) . "%') AND ns_package.delete IS NULL AND ns_package.sokien <> 0 ");
							}
						}
					} else if ($roleid == 6 || $roleid == 2) {
						if (isset($_GET['status'])) {
							if ($_GET['status'] == '2') {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND status='2' AND uid = '$uid' AND sokien <> 0 AND date >= '$day_start' AND date <= '$day_end'");
							} else if ($_GET['status'] == '1') {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND status='1'  AND uid = '$uid'  AND sokien <> 0 AND date >= '$day_start' AND date <= '$day_end'");
							} else if ($_GET['status'] == '0') {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND status<>'2'  AND uid = '$uid'  AND sokien <> 0 AND status<>'1'  AND status<>'5' AND date >= '$day_start' AND date <= '$day_end'");
							} else if ($_GET['status'] == '5') {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND status='5'  AND uid = '$uid'  AND sokien <> 0  AND date >= '$day_start' AND date <= '$day_end'");
							} else {
								$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND sokien <> 0  AND uid = '$uid'  AND date >= '$day_start' AND date <= '$day_end'");
							}
						} else {
							$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package where `delete` IS NULL AND sokien <> 0  AND uid = '$uid'  AND date >= '$day_start' AND date <= '$day_end'");
						}
						if (isset($_GET['s_type'])) {
							if ($_GET['s_type'] == "id") {
								$data = mysqli_query($conn, "SELECT * FROM ns_package where `delete` IS NULL AND sokien <> 0  AND uid = '$uid'  AND id_code like '%" . trim($_GET['s_value']) . "%' order by id DESC ");
							} else if ($_GET['s_type'] == "hawb") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_listhoadon ON ns_package.id = ns_listhoadon.id_package where ns_listhoadon.id_code like '%" . trim($_GET['s_value']) . "%' AND ns_package.uid = '$uid'  AND ns_package.delete IS NULL AND ns_package.sokien <> 0 ");
							} else if ($_GET['s_type'] == "company") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_nguoigui ON ns_package.id_nguoigui = ns_nguoigui.id where ns_nguoigui.company_name like '%" . trim($_GET['s_value']) . "%'  AND ns_package.uid = '$uid' AND ns_package.delete IS NULL AND ns_package.sokien <> 0 ");
							} else if ($_GET['s_type'] == "tracking") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_listhoadon ON ns_package.id = ns_listhoadon.id_package where ns_listhoadon.billketnoi like '%" . trim($_GET['s_value']) . "%' AND ns_package.uid = '$uid'  AND ns_package.delete IS NULL AND ns_package.sokien <> 0 ");
							} else if ($_GET['s_type'] == "receiver") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_nguoinhan ON ns_package.id_nguoinhan = ns_nguoinhan.id where ns_nguoinhan.name like '%" . trim($_GET['s_value']) . "%' AND ns_package.delete IS NULL AND ns_package.sokien <> 0 AND ns_package.uid = '$uid'");
							} else if ($_GET['s_type'] == "address") {
								$data = mysqli_query($conn, "SELECT *,ns_package.id as id FROM ns_package INNER JOIN ns_nguoinhan ON ns_package.id_nguoinhan = ns_nguoinhan.id where (ns_nguoinhan.address like '%" . trim($_GET['s_value']) . "%' OR ns_nguoinhan.address2 like '%" . trim($_GET['s_value']) . "%') AND ns_package.delete IS NULL AND ns_package.sokien <> 0 AND ns_package.uid = '$uid'");
							}
						}


						if (isset($_POST['search'])) {
							$data = mysqli_query($conn, "SELECT * FROM ns_package where id_code='" . $_POST['id_bill'] . "' AND uid = '$uid'");
						}
					} else {
						$data = mysqli_query($conn, "SELECT id_nguoinhan,kg_dichvu,id,id_code,date,kg_ref,kg_chinhanh,status,status,sokien,label_link,check_label,cuoc_goc,khach_cuocbay,khach_phuthu,khach_cuocnoidia,khach_thuho,khach_phibaohiem,vat FROM ns_package WHERE uid = '$uid' AND `delete` IS NULL  AND sokien <> 0 order by id DESC  LIMIT 500") or die(mysqli_error());
					}

					$i = 0;
					while ($item = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
						$rName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name,address,country_id,city FROM ns_nguoinhan WHERE id ='" . $item['id_nguoinhan'] . "'"));
						@$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn, "select name from ns_countries where id='" . $rName['country_id'] . "'"));
						@$dulieuthanhpho = mysqli_fetch_assoc(mysqli_query($conn, "select name from cities where id='" . $rName['city'] . "'"));
						@$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn, "select dichvu from ksn_dichvu where id='" . $item['kg_dichvu'] . "'"));
						@$laydulieuchotbill = mysqli_fetch_assoc(mysqli_query($conn, "select * from ksn_package_chot where id_code='" . $item['id_code'] . "'"));





						$i++;
						echo '<tr>
				  <td style="text-align: center; color:black"></td>
				
			  <td style="text-align: center; color:black"> <a href="package_fn.php?id=' . $item['id'] . '" target="_blank">' . $item['id_code'] . '</a></td> 	<!-- <td style="text-align: center; color:black">';
						if (@$laydulieuchotbill['id_code'] != "") {
							@$myArray = explode(',', $laydulieuchotbill['img']);

							foreach (@$myArray as $a) {
								echo ' <a href="../upload/' . $a . '" target="_blank"><i class="fas fa-images"></i></a>';
							}
						}
						echo '</td>-->
                  <td style="text-align: center; color:black">' . $item['date'] . ' ';

						echo '</td>
				<!--  <td style="text-align: center; color:black">' . $item['kg_ref'] . '</td>-->
				  <td style="text-align: center; color:black">' . $dulieudichvu['dichvu'] . '
				  
				  ';
						echo '</td>
                  <td style="text-align: left; color:black">' . @$rName['name'] . '</td>
                  <td style="text-align: left; color:black">[ <a href="' . $tracking_url . '' . $item['id_code'] . '"><i class="fas fa-map-marker-alt"></i></a><b> ' . @$dulieuquocgia['name'] . '</b>] - ' . @$dulieuthanhpho['name'] . '</td>
                  <td style="text-align: center; color:black">' . $item['kg_chinhanh'] . '  </td>
                  <td style="text-align: center; color:black">';

						@$laytrangthaihold = mysqli_fetch_assoc(mysqli_query($conn, "select check_hold from ns_package where id='" . $item['id'] . "' order by id DESC "));
						if (@$laytrangthaihold['check_hold'] == 1) {
							echo '<small class="badge badge-danger"><i class="fas fa-minus-circle"></i> Hold</small>';
						} else {
							echo '
				  ' . @statusbill($item['status']) . ' ';
						}

						echo '
				  
				  
				  </td>
				  
				  
				  
				  
				  ';

						## lay tracking code 

						$laydulieutrack = mysqli_fetch_assoc(mysqli_query($conn, "select * from ns_listhoadon where id_package='" . $item['id'] . "' LIMIT 1"));
						echo '<td  style="text-align: left; color:blue"><a href="' . $tracking_url . '' . $item['id_code'] . '">' . @$laydulieutrack['id_code'] . '</a></td>';

						if ($item['cuoc_goc'] != null) {
							echo '<td data-cuoc_goc="' . $item['cuoc_goc'] . '" data-id="' . $item['id'] . '" style="text-align: left; color:green">' . number_format($item['cuoc_goc']) . 'đ';
							if (in_array($roleid, [1, 3])) { // Admin va ke toan
								echo ' <i style="float:right; cursor:pointer" class="fas fa-edit updateCuocGoc"></i>';
							}
							echo '</td>';
						} else {
							echo '<td data-cuoc_goc="' . $item['cuoc_goc'] . '" data-id="' . $item['id'] . '">
								<small class="badge badge-danger"><i class="fas fa-minus-circle"></i> 
									Chưa cập nhật
								</small>';
							if (in_array($roleid, [1, 3])) { // Admin va ke toan
								echo '<i style="float:right; cursor:pointer; color:green" class="fas fa-edit updateCuocGoc"></i>';
							}
							echo '</td>';
						}

						echo '<td data-khach_phu_thu="' . $item['khach_phuthu'] . '" data-id="' . $item['id'] . '" style="text-align: left; color:green">' . number_format($item['khach_phuthu']) . 'đ';
						if (in_array($roleid, [1, 3])) { // Admin va ke toan
							echo ' <i style="float:right; cursor:pointer" class="fas fa-edit updateKhachPhuThu"></i>';
						}
						echo '</td>';

						if ($roleid == 1 || $roleid == 3) {

							$laydulieuchiphia = mysqli_query($conn, "select * from kns_listhoadonchiphi where id_code='" . $item['id_code'] . "'");
							$sotienchiphi = 0;
							while ($laydulieuchiphi = mysqli_fetch_array($laydulieuchiphia)) {
								if ($laydulieuchiphi['var_string'] == "chiphi6") {
									$thaythongtinguisms = mysqli_fetch_assoc(mysqli_query($conn, "select * from ksn_sms_contact where id_code='" . $item['id_code'] . "'"));
								}
								$sotienchiphi += $laydulieuchiphi['price'] * $laydulieuchiphi['soluong'];
							}

							echo '<td>';


							if ($item['cuoc_goc'] !== null) {
								echo '<small class="badge badge-success"><i class="fas fa-dollar-sign"></i>' . number_format($item['khach_cuocbay'] - ($item['khach_cuocnoidia'] + $item['khach_phuthu'] + $item['khach_thuho'] + $item['khach_phibaohiem'] + ($item['vat'] * 8 / 100) + $item['cuoc_goc']) - $sotienchiphi) . 'đ</small>';
							} else {
								echo '<small class="badge badge-danger"><i class="fas fa-minus-circle"></i> Chưa cập nhật</small>';
							}

							echo '</td>';
						}

						echo '
                  <td style="white-space: nowrap;"><form action="" method="POST">
				  ';


						if ($item['sokien'] == 0) {
							echo ' <a href="create_sub_package.php?id=' . $item['id'] . '" class="btn btn-primary  btn-sm" target="_blank"><i class="fas fa-box"></i> Tạo Kiện Hàng</a>';
						} else {

							echo ' <a href="inbill/BILLHOANCHINH.php?id=' . $item['id'] . '&print=auto" class="btn btn-primary  btn-sm" target="_blank"><i class="fa fa-print"></i> B</a>
                     <a href="inlabel/LABELHOANCHINH.php?id=' . $item['id'] . '&print=auto"  class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print"></i> L</a>
                     <a href="ininvoice/INVOICE.php?id=' . $item['id'] . '&print=auto"  class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print"></i> INV</a>
					 ';
							if ($item['label_link'] != "") {
								echo ' <a href="' . $item['label_link'] . '"  class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-tags"></i> Label Hãng</a>';
							}
							if ($uid == 130 || $roleid == 1 || $roleid == 4) {
							}

							if ($roleid == 2 && $item['kg_dichvu'] == 32) {
							}


							echo '
                    
					 
					 
					 ';
						}


						echo ' <a href="edit_package.php?id=' . $item['id'] . '" type="button" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>';
						if ($roleid == 4 || $roleid == 1) {
							if ($item['check_label'] != "") {
								$layten = mysqli_fetch_assoc(mysqli_query($conn, "select ten from ns_user where id='" . $item['check_label'] . "'"));
								echo ' <a href=""  class="btn btn-info btn-sm"  onclick="return false;" title="Label created by ' . $layten['ten'] . '" target="_blank"><i class="fas fa-info"></i></a>';
							}
							if ($item['status'] == 0) {
								echo ' <input type="hidden" value="' . $item['id'] . '" name="id_delete"><button type="submit" class="btn btn-sm btn-danger"  onclick="return confirm(\'Chắc chắn muốn xóa kiện hàng: ' . $item['id_code'] . '  ?\')" name="btn_deletea"><i class="fas fa-trash-alt"></i></button>';
							}
						}
						echo '</form>
                  </td>
                  </tr>';
					}
					?>
					<!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
				</tbody>
			</table>
		</div>
	</div>
</div>



<?php
if ($roleid == 6) {
	echo '<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Export Excel for Sales</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			
			
			
			
				
		 		 <form method="GET" action="mani_sale2.php">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="">
<label for="aa">To Date:</label>
<input type="date" id="aa" name="day_end"  value=""><br>
<label for="aa">Sales Name: ' . $datauser['ten'] . '</label>
<input type="hidden" value="' . $datauser['id'] . '" name="id"">
							
				
				
				
            </div>
            <div class="modal-footer justify-content-between">
              <input type="submit" name="" class="btn btn-danger btn-sm" value="Export">	
							</form>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
}
if ($roleid == 1 || $roleid == 4 || $roleid == 3) {
	echo '<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Export Package</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			
			
			
			
				
		 		 <form method="GET" action="mani_documents.php">

<div class="form-group">
<label for="aa">Select Date:</label>
<input type="date" id="aa" name="day_start" value="">
<label for="aa">To Date:</label>
<input type="date" id="aa" name="day_end"  value=""><br>
							
				
								
				';
	echo '<div class="form-group">

				<label for="" class="control-label">Dịch vụ vận chuyển (Services) *</label>
					<select multiple class="select2bs4" name="kg_dichvu[]" id="" width=100%>';

	$dichvushipa = mysqli_query($conn, "SELECT * FROM ksn_dichvu where status='2' order by id asc");
	while ($dichvuship = mysqli_fetch_array($dichvushipa, MYSQLI_ASSOC)) {
		echo '
								<option value="' . $dichvuship['id'] . '">' . $dichvuship['dichvu'] . '</option>';
	}

	echo '</select>
					</div>';
	echo '
				
				
            </div>
            <div class="modal-footer justify-content-between">
              <input type="submit" name="" class="btn btn-danger btn-sm" value="Export">	
							</form>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
}


include('footer.php');
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('table').on('click', '.updateCuocGoc', function() {
			var $td = $(this).closest('td');
			var id = $td.data('id');
			var oldValueCuocGoc = $td.data('cuoc_goc');

			if (!$td.hasClass('edit-mode')) {
				$td.addClass('edit-mode');
				$td.html('<input type="text" value="' + oldValueCuocGoc + '"><i style="cursor:pointer; color:green" class="fas fa-save btn-update-cuoc-goc" data-id="' + id + '"></i>');
			}
		});

		$('table').on('click', '.updateKhachPhuThu', function() {
			var $td = $(this).closest('td');
			var id = $td.data('id');
			var oldValueKhachPhuThu = $td.data('khach_phu_thu');

			if (!$td.hasClass('edit-mode')) {
				$td.addClass('edit-mode');
				$td.html('<input type="text" value="' + oldValueKhachPhuThu + '"><i style="cursor:pointer; color:green" class="fas fa-save btn-update-khach-phu-thu" data-id="' + id + '"></i>');
			}
		});

		$('table').on('click', '.btn-update-cuoc-goc', function() {
			var $td = $(this).closest('td');
			var newValue = $td.find('input').val();
			var id = $(this).data('id');

			$.ajax({
				url: 'list_package.php',
				type: 'POST',
				data: {
					action: 'update_cuoc_goc',
					id: id,
					newValue: newValue
				},
				success: function(response) {
					location.reload();
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		});

		$('table').on('click', '.btn-update-khach-phu-thu', function() {
			var $td = $(this).closest('td');
			var newValue = $td.find('input').val();
			var id = $(this).data('id');

			$.ajax({
				url: 'list_package.php',
				type: 'POST',
				data: {
					action: 'update_khach_phu_thu',
					id: id,
					newValue: newValue
				},
				success: function(response) {
					location.reload();
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		});
	});


	$('#modalInScanPackage').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget);
		var recipient = button.data('whatever');
		var modal = $(this);
		$('#exampleModalLabelFake').val(recipient);
		modal.find('.modal-body input').val(recipient)
		$('#myFramed').attr('src', '../inbill/inscanpackage/inscanpakage.php?id=' + recipient);

	})
	$(function() {
		// customercode-dropdown
		$.ajax({
			url: '../controller/ajax.php',
			type: 'POST',
			data: {
				action: 'getCustomerName'
			},
			cache: false,
			success: function(result) {
				$("#customercode-dropdown").html(result);
			}
		})
	});



	$(document).ready(function() {
		$('#example').DataTable({
			"pageLength": 100,
			"scrollX": true,
			responsive: {
				details: {
					type: 'column'
				}
			},
			columnDefs: [{
				className: 'dtr-control',
				orderable: false,
				targets: 2,
				"visible": false,
			}],
			order: [3, 'desc']
		});
	});
</script>