<?php  
	include('top.php');
	include('../controller/bill.php');
	$code = $_SESSION['cus_code'];
	$sender = getCustomerByCode($code,$conn);
	
	/*
	if($roleid == 6)
		
	{
	echo'<script> 
                window.location.href="create_package_sale.php";
            </script>';
	exit();
			}
	*/
	function xulyprice($data){
	
	  return $data;
	}	
	
	
	if (isset($_POST['btn_submit'])) {
		if($roleid == 6 || $roleid == 4)		
		{
		$khach_cannang = $_POST['khach_cannang'];
		$khach_cuocbay = xulyprice($_POST['khach_cuocbay']);
		$khach_phuthu = xulyprice($_POST['khach_phuthu']);
		$khach_cuocnoidia = xulyprice($_POST['khach_cuocnoidia']);
		$khach_thuho = xulyprice($_POST['khach_thuho']);
		$khach_baohiem = xulyprice($_POST['khach_baohiem']);
		$khach_phibaohiem = xulyprice($_POST['khach_phibaohiem']);
		$vat = xulyprice($_POST['khach_cuocvat']);
		
		
		
		
		echo $khach_cuocbay.'<br>';
		echo $khach_phuthu.'<br>';
		echo $khach_cuocnoidia.'<br>';
		echo $khach_thuho.'<br>';
		$checkthanhtoan = '';
		$payment_type = $_POST['payment_type'];
			if($payment_type == 'debit')
			{
				if($khach_cuocbay> $datauser['hanmuc'])
				{
					
					echo'<script> 
										alert("Số tiền vượt quá hạn mức! Cần thanh toán bill thiếu để thực hiện tạo bill");
										window.location.href="create_package.php";
					</script>';
					exit();
				}
			}
			else
			{
				$checkthanhtoan = 1;
			}
			
		}
		
		
		$nguoigui_name = $conn->real_escape_string($_POST['nguoigui_name']);
		$nguoigui_company = $conn->real_escape_string($_POST['nguoigui_company']);
		$nguoigui_phone = $conn->real_escape_string($_POST['nguoigui_phone']);
		$nguoigui_tp = $conn->real_escape_string($_POST['nguoigui_tp']);
		$nguoigui_districtid = $conn->real_escape_string($_POST['nguoigui_districtid']);
		$nguoigui_wardid = $conn->real_escape_string($_POST['nguoigui_wardid']);
		$nguoigui_add = $conn->real_escape_string($_POST['nguoigui_add']);
		$nguoigui_npp = $conn->real_escape_string($_POST['npp']);
		$txt_sales = $conn->real_escape_string($_POST['txt_sales']);
		$nguoigui_code = $conn->real_escape_string($sender['cus_code']);

		$id_nguoigui = createSender($nguoigui_npp,$nguoigui_name,$nguoigui_tp, $nguoigui_districtid, $nguoigui_wardid, $nguoigui_add, $nguoigui_phone,$nguoigui_company,$nguoigui_code,$conn);

		$nguoinhan_name = $conn->real_escape_string($_POST['nguoinhan_name']);
		$nguoinhan_company = $conn->real_escape_string($_POST['nguoinhan_company']);
		$nguoinhan_phone = $conn->real_escape_string($_POST['nguoinhan_phone']);
		$nguoinhan_countries = $conn->real_escape_string($_POST['nguoinhan_countries']);
		$nguoinhan_city = $conn->real_escape_string($_POST['nguoinhan_city']);
		$nguoinhan_add = $conn->real_escape_string($_POST['nguoinhan_add']);
		$nguoinhan_add2 = $conn->real_escape_string($_POST['nguoinhan_add2']);
		$nguoinhan_add3 = $conn->real_escape_string($_POST['nguoinhan_add3']);
		$nguoinhan_state = $conn->real_escape_string($_POST['nguoinhan_state']);
		$nguoinhan_post_code = $conn->real_escape_string($_POST['nguoinhan_post_code']);
		$nguoigui_code = $conn->real_escape_string($sender['cus_code']);
		$id_no = $conn->real_escape_string($_POST['id_no']);
		$save = $_POST['save'];

		$id_nguoinhan = createReceiver($nguoinhan_name,$nguoinhan_company,$nguoinhan_phone,$nguoinhan_countries,$nguoinhan_city,$nguoinhan_add,$nguoigui_code,$id_no,$nguoinhan_add2,$nguoinhan_add3,$nguoinhan_state,$nguoinhan_post_code,$save,$conn);

		$date = date('Y-m-d');
		$sokien = $conn->real_escape_string($_POST['sokien_nhankhach']);
		$chiho = $conn->real_escape_string($_POST['chiho']);
		$kg_dichvu = $conn->real_escape_string($_POST['kg_dichvu']);
		$kg_chinhanh = $conn->real_escape_string($_POST['kg_chinhanh']);
		$kg_ref = $conn->real_escape_string($_POST['kg_ref']);
		$kg_reiceiversign = $conn->real_escape_string($_POST['kg_reiceiversign']);
		
		
		
		if($roleid == 6 || $roleid == 4)
		{
		if($_POST['sale_id'] != "")
			{
				$idadd = $_POST['sale_id'];
			}
			else
			{
				$idadd = $uid;
			}
		$test = createPackageforSale($id_nguoigui,$nguoigui_code,$id_nguoinhan,$idadd,$sokien,$date,$chiho,$kg_dichvu,$kg_chinhanh,$kg_ref,$kg_reiceiversign,'3',$conn,$idadd,$khach_cannang,$khach_cuocbay,$khach_phuthu,$khach_cuocnoidia,$khach_thuho,$khach_baohiem,$khach_phibaohiem,$checkthanhtoan,$payment_type,$vat);
			if($payment_type == 'debit')
			{
			mysqli_query($conn,"UPDATE `ns_user` SET `hanmuc`=(`hanmuc`-$khach_cuocbay) WHERE (`id`='$idadd')");
			}
		}
		else
		{
		$test = createPackage($id_nguoigui,$nguoigui_code,$id_nguoinhan,$uid,$sokien,$date,$chiho,$kg_dichvu,$kg_chinhanh,$kg_ref,$kg_reiceiversign,$datauser['payment_type'],$conn);
		}
		
		echo'<script> window.location.href="create_sub_package.php?id='.$test.'";</script>';

	}
	
	
	
	
	
	
	
	
	
?>
<link rel="stylesheet" href="selectbox/dist/virtual-select.min.css" />
<script src="selectbox/dist/virtual-select.min.js"></script>
<div class="container-fluid" >
	<form action="" method="POST">
		<?php
		if($roleid == 6 || $roleid == 4)
		{
			echo'
		<div class="row">
			<div class="col-md-3">
			
			<div class="alert alert-info alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-info"></i>Infomation</h5>
Remaining limit: <b>'.number_format($datauser['hanmuc']).'đ</b></div>
			

			</div>

		</div>';
		
		$tencongty = 'SHIBA EXPRESS';
		$diachicongty = '201 Nguyễn Văn Công';
		}
		else
		{
		$tencongty =  $datauser['congty'];	
		$diachicongty =  $sender['address'];	
		}
		
		
		
		
		?>
		<div class="row">
			<div class="col-md-3" style="font-size:13px">
				
				
				
			<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Thông tin Người gửi (Sender)</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body" style="background-color:#DDDDDD">
            
					<input type="text" readonly name="nguoigui_name" class="form-control" value="<?php  echo $sender['cus_code'];?>" placeholder="Mã khách hàng" hidden>
		
				<div class="form-group" >
					<label for="">Công ty (Company Name) * </label>
					<input type="text" name="nguoigui_company" class="form-control" value="<?php  echo $tencongty;?>" readonly placeholder="Tên người gửi">
				</div>
				<?php 
				
				
				if($roleid == 4)
				{
				echo'<div class="form-group">
					<label for="inputPassword3" class="control-label">Sale name</label>
					<select class="form-control" id="saleid" name="sale_id" required>';
							echo'<optiop>Select Sale Name</option>';
							$salea = mysqli_query($conn,"SELECT * FROM ns_user where roleid='6'");
							while ($salez = mysqli_fetch_array($salea,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$salez['id'].'"';
								if ($salez['id'] == '5') {
									echo ' selected';
								}
								echo '>'.$salez['ten'].' ('.$salez['username'].')</option>
								';
							}
						
					echo'	
					</select>
				</div>';
				}
				?>
				
				<div class="form-group" >
					<label for="">Người LH (Contact Name) * </label>
					<input type="text" name="nguoigui_name" class="form-control" value="<?php  echo $datauser['ten'];?>" placeholder="Tên người gửi">
				</div>
				
				<div class="form-group">
					<label for="">Số Điện thoại (Telephone) *</label>
					<input type="text" name="nguoigui_phone" class="form-control" value="<?php  echo $sender['phone'];?>" placeholder="Nhập SĐT" required>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<select class="form-control" id="nguoigui_tp-dropdown" name="nguoigui_tp">
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
							if($roleid == 6 || $roleid == 4 || $roleid == 3){
							echo'<option value="79" selected="">Thành phố Hồ Chí Minh</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Quận/Huyện</label>
					<select required class="form-control" name="nguoigui_districtid" id="nguoigui_district-dropdown">
						<?php 
							$districts = mysqli_query($conn,"SELECT * FROM yn_district where province_id='".$sender['province_id']."' order by id asc");
							echo '<option value="">Chọn quận/huyện</option>';
							while ($item = mysqli_fetch_array($districts,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'"';
								if ($sender['district_id'] == $item['id']) {
									echo ' selected';
								}
								echo '>'.$item['name'].'</option>
								';
							}if($roleid == 6 || $roleid == 4 || $roleid == 3){
							echo'<option value="764" selected="">Quận Gò Vấp</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Phường/Xã</label>
					<select required class="form-control" name="nguoigui_wardid" id="nguoigui_ward-dropdown">
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
							}if($roleid == 6 || $roleid == 4 || $roleid == 3){
							echo'<option value="26902" selected="">Phường 03</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="form-control" value="<?php  echo $diachicongty;?>" placeholder="Nhập địa chỉ" required>
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
							
				
				
				
				
				
				
				
				
				
				<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Thông tin Người nhận (Receiver)</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
				
                <div class="card-body" style="background-color:#DDDDDD">
				
				
				<div id="notification"></div>
				 <div class="form-group">
					<!-- here -->
					<label for="inputPassword3" class="control-label">Chọn người nhận cũ</label><br>
					<select class="form-control select2bs4" class=""  id="oldReceiver">
						<?php 
							$query = mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE cus_code='".$sender['cus_code']."' AND save='1' GROUP BY name,address");
							
							echo '<option value="">Chọn người nhận cũ</option>';
							while ($item = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
								$countries = getCountryById($item['country_id'],$conn);
								echo '
								<option value="'.$item['id'].'">'.$item['name'].' - '.$countries['name'].' - '.$item['city'].' - '.$item['address'].' - '.$item['phone'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="row">
				<div class="col-md-6" style="">

                 
				<div class="form-group" >
					<label for="">Công ty (Company Name)</label>
					<input type="text" name="nguoinhan_company" id="id_company" class="form-control" placeholder="Tên công ty">
				</div>
				
				<div class="form-group" >
					<label for="">Người Liên hệ (Contact Name) <font color=red> * </font> </label>
					<input type="text" name="nguoinhan_name" id="id_tennguoinhan" class="form-control" placeholder="Tên người nhận" required> 
				</div>
				
				<div class="form-group">
					<label for="">Số Điện thoại (Telephone) <font color=red> * </font></label>
					<input type="text" name="nguoinhan_phone" id="id_phonenguoinhan" class="form-control"  placeholder="Số diện thoại người nhận" required>
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
					<select class="form-control abcd" id="nguoinhan_countries-dropdown" name="nguoinhan_countries" required>
						<?php 
							$countries = mysqli_query($conn,"SELECT * FROM ns_countries order by id asc");
							echo '<option value="">Chọn quốc gia</option>';
							while ($item = mysqli_fetch_array($countries,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'">'.$item['name'].' - '.$item['iso2'].'</option>
								';
							}
						?>
					</select>
				</div>
									<input type="hidden" value="" id="quocgiaan">

				
				<div class="form-group">
                  <label>Thành Phố</label>
                  <select class="form-control select2bs4"   style="width: 100%;"  id="nguoinhan_cities-dropdown" name="nguoinhan_city" required>
                  
                  </select>
                </div>
				</div>
				
				<div class="col-md-6" style="">
				
				
				
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh (State/Province)</label>
				<input type="text" name="nguoinhan_state" id="id_state" class="form-control"  placeholder="" required>

				</div>	
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Mã Bưu chính (Postal code) *</label>
				<input type="text" name="nguoinhan_post_code" id="id_postcode" class="form-control"  placeholder="" required>

				</div>	
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Địa chỉ 1(<font color=red>Không nhập POST CODE, STATE,CITY</font>) </label>
					<input type="text" name="nguoinhan_add" id="id_addnguoinhan" class="form-control"  placeholder="Nhập địa chỉ người nhận" required>
				
				</div>
				
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Địa chỉ 2(<font color=red>Không nhập POST CODE, STATE,CITY</font>) </label>
					<input type="text" name="nguoinhan_add2" id="id_addnguoinhan" class="form-control"  placeholder="" >
								
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Địa chỉ 3(<font color=red>Không nhập POST CODE, STATE,CITY</font>) </label>
					<input type="text" name="nguoinhan_add3" id="id_addnguoinhan" class="form-control"  placeholder="" >
					
				</div>
				
				 <div class="form-group">
                    
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary3" name="save" value="1">
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
            <div class="card  card-warning">
              <div class="card-header">
                <h5 class="card-title m-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin Đơn hàng (Shipment Info)</h5>
              </div>
              <div class="card-body" style="background-color:#DDDDDD">
			  				<div id="notification2"></div>

				<?php 
				echo'
				<div class="form-group">

				<label for="" class="control-label">Dịch vụ vận chuyển (Services) *</label>
					<select required class="form-control" name="kg_dichvu" id="dichvu-dropdown">';
					
						
			
					echo'</select>
					</div>
					
					 <div class="form-group">
                    
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary4" name="kg_reiceiversign" value="1">
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
					
							echo '<option value="HCM" selected>HCM</option>';
							echo '<option value="HN">HN</option>';
							echo '<option value="DAD">DAD</option>';
			
					echo'</select>
				</div>';
				
				?>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Mã tham chiếu</label>
					<input type="text" name="kg_ref" id="id_addnguoinhan" class="form-control"  placeholder="" >
					
				</div>
				
				<?php
				if($roleid == 6|| $roleid == 4)
				{
					echo'
				<div class="form-group">
					<label for="" class="control-label">Trọng lượng tính khách</label>
					<input type="text" name="khach_cannang" id="khach_cannang" class="form-control"  placeholder="" >
					
				</div>
					
				<div class="form-group">			<!--	<input type="checkbox" id="vehicle1" name="vat" value="1"> Gồm VAT (8%) -->
				';
				
				if($roleid == 6)
				{
				echo'

<div class="form-check">
<input class="form-check-input" type="radio" name="payment_type" value="debit" >
<label class="form-check-label">THANH TOÁN NỢ ( Dùng hạn mức )</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="payment_type"  value="after" checked>
<label class="form-check-label">THANH TOÁN SAU</label>
</div>
				';
				}
				else
				{
					echo'<div class="form-check">
<input class="form-check-input" type="radio" name="payment_type"  value="after" checked>
<label class="form-check-label">THANH TOÁN SAU</label>
</div>';
				}


echo'</div>
				
				<div id="dulieusale">
				
				<div class="input-group">					

				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
				<input type="text" name="khach_cuocbay" class="form-control" id="khach_cuocbay" class=""  placeholder="Tổng Cước Thu Khách" title="Tổng Cước Thu Khách"  required>
				</div>
				<hr>
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_phuthu" id="khach_phuthu" class="form-control"  placeholder="Cước phụ thu" title="Cước phụ thu">
					
				</div>
				
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_cuocnoidia" id="khach_cuocnoidia" class="form-control"  placeholder="Cước nội địa" title="Cước nội địa" >
					
				</div>
				
				
				
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_thuho" id="khach_thuho" class="form-control"  placeholder="Cước thu hộ" title="Cước thu hộ" >	
				</div>
				
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_baohiem" id="khach_baohiem" class="form-control"  placeholder="Giá trị khai báo bảo hiểm" title="Giá trị khai báo bảo hiểm" >	
				</div>
				
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_phibaohiem" id="khach_phibaohiem" class="form-control"  placeholder="Phí mua bảo hiểm" title="Phí mua bảo hiểm">	
				</div>	
				
				<div class="input-group">					
				<div class="input-group-prepend">
				<span class="input-group-text">
				<i class="fas fa-dollar-sign"></i>
				</span>
				</div>
					<input type="text" name="khach_phibaohiem" id="khach_cuocvat" class="form-control"  placeholder="Cước xuất VAT" title="Cước xuất VAT">	
				</div>
			

				
				
				</div>';
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
  cursor: pointer;" data-toggle="modal" data-target="#exampleModal">Điều Khoản Sử Dụng Dịch Vụ của SHIBA EXPRESS EXPRESS!</span>
                        </label>
                      </div>
                    </div>
				<button style="float:right;" type="submit" name="btn_submit" class="btn btn-primary">Tạo thông tin lô hàng</button>
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
					<input type="number" step=".01" style= "color:red" name="gia" class="form-control " id="giatong" class="form-control" placeholder="" readonly>
				</div>

				<div class="form-group">
					<label  for="">Ghi chú </label>
					<input type="text" name="note" class="form-control" id="" placeholder="Nhập ghi chú">
				</div>
				<button type="submit" name="btn_submit" class="btn btn-success">Tạo</button>
			</div> -->
		</div>
	</form>
	
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
?>

      </div>
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
				$("#quocgiaan").val(countries_id);
				$("#quocgiaan").trigger("change");
			}
		});
	});
	
	
	$('#quocgiaan').on('change', function(){
		var countries_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				countries_id: countries_id,				
				ds: <?php echo'"'.$datauser['discount'].'"'; ?>,
				action: "filterDichVu"
			},
			cache: false,
			success: function(result){
				$("#dichvu-dropdown").html(result);
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
				action: "filterNotifi"
			},
			cache: false,
			success: function(result){
				$("#notification").html(result);
			}
		});
	});
	
	
	$('#dichvu-dropdown').on('change', function(){
		var id_dichvu=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				id_dichvu: id_dichvu,
				action: "filterNotifi2"
			},
			cache: false,
			success: function(result){
				$("#notification2").html(result);
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
				$("#quocgiaan").val(result.country_id);
				$("#quocgiaan").trigger("change");
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
		
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				id: id,
				action: 'filterCityOld'
			},
			cache: false,
			async: false,
			success: function(result){
				$("#nguoinhan_cities-dropdown").html(result);
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




$('input.Currency').on('blur', function() {
  let value = this.value.replace(/\D/g,'');
  value = parseFloat(value);
  if (isNaN(value))
    this.value = '';
  else
    this.value = value.toLocaleString();
});
</script>