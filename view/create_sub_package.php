<?php  
	include('top.php');
	include('../controller/bill.php');
	$id = $_GET['id'];
		$data = getPackageData($id,$conn);
		
		if($data['sokien'] >= 1)
		{
			echo'<script> window.location.href="list_package.php";</script>';

		}
if($roleid == 2 || $roleid == 6 || $roleid == 5)
	{
		if($data['uid'] != $uid)
		{
			exit();
		}
	}
	
	$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,thetich from ksn_dichvu where id='".$data['kg_dichvu']."'"));

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
	    
		
		
		
		
		
		
		
	
	if (isset($_POST['btn_submit'])) 
	{
		function roundUp($number, $nearest){
			return ceil($number/0.5)*0.5;;
		}
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
		for ($i=0; $i<sizeof($sokiennho);$i++) {
			
			
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
		
		$iv_tensanpham =  $_POST['iv_tensanpham'];
		$iv_price =  $_POST['iv_price'];
		$iv_soluong =  $_POST['iv_soluong'];
		$iv_unit =  $_POST['iv_unit'];
		$sum_value = 0;
		for ($i=0; $i<sizeof($iv_tensanpham);$i++) {
			mysqli_query($conn,"INSERT INTO `ns_mapcatalog2` (`id_bill`, `soluong`, `iv_price`, `iv_unit`, `iv_tensanpham`) VALUES ('$id', '".$iv_soluong[$i]."', '".$iv_price[$i]."', '".$iv_unit[$i]."', '".$conn->real_escape_string($iv_tensanpham[$i])."')");
			$sum_value += $iv_price[$i]*$iv_soluong[$i];
		}
		
		
		$package_tenhang = $conn->real_escape_string($_POST['package_tenhang']);
		$ks_reason = $conn->real_escape_string($_POST['ks_reason']);
		
		if($sum_charge_weight >= 21)
		{
			$sum_charge_weight = 0;
			$laydulieucannang = mysqli_query($conn,"select id,charge_weight,cannang,convert_weight from ns_listhoadon where id_package='$id'");
			while($checkdulieucannang = mysqli_fetch_array($laydulieucannang,MYSQLI_ASSOC))
			{
				$kien_charge_weight = ceil($checkdulieucannang['charge_weight']);
				$sum_charge_weight+= $kien_charge_weight;
				mysqli_query($conn,"UPDATE `ns_listhoadon` SET `charge_weight`='$kien_charge_weight' WHERE (`id`='".$checkdulieucannang['id']."')");
			}
		}
		
		
		mysqli_query($conn,"UPDATE `ns_package` SET `sokien`='$sokienaa',`kg_tenhang`='$package_tenhang', `kg_reason`='$ks_reason',`kg_valueinvoice`='$kg_valueinvoice',`gross_weight`='$gross_weight',`charge_weight`='$sum_charge_weight' WHERE (`id`='$id')");
		
		
		if($roleid == 6 || $roleid == 4)
		{
		echo'<script> window.location.href="edit_cpvhz.php?id='.$id.'";</script>';

		}
		else
		{
		echo'<script> window.location.href="package_fn.php?id='.$id.'&check=success";</script>';
		}
		
		exit();
		
		//mysql_query("UPDATE `SHIBA EXPRESS_listhoadonus` SET `billtong`='$string_sokiennho',`color`='$color' WHERE (`id`='$idtong')");
	}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	

	// if (isset($_POST['btn_exit'])) {
	// 	echo '
	// 		<script>
	// 			window.location = "scan_create_sub_package.php";
	// 		</script>
	// 	';
	// }
	
	
	$sender = getSender($data['id_nguoigui'],$conn);
	$receiver = getReceiver($data['id_nguoinhan'],$conn);
	$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$receiver['country_id']."'"));
	$dulieuthanhpho = mysqli_fetch_assoc(mysqli_query($conn,"select name from cities where id='".$receiver['city']."'"));
	
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
<p>- Dịch vụ: '.$dulieudichvu['dichvu'].'</p>
<p>- Brand: '.$data['kg_chinhanh'].'</p>
<p>- Dịch vụ chữ ký người nhận: '.$checksign.'</p>
</div>


</div>

<div class="col-md-12">

<div class="callout callout-info">
<h5>Thông tin người nhận</h5>
<p>- Công ty: <b>'.@$receiver['company_name'].'</b></p>
<p>- Tên người nhận: <b>'.@$receiver['name'].'</b></p>
<p>- Số Điện Thoại: '.@$receiver['phone'].'</p>
<p>- Địa chỉ: '.@$receiver['address'].'</p>
<p>- Thành Phố <b>: '.@$dulieuthanhpho['name'].'</b></p>
<p>- Quốc Gia <b>: '.@$dulieuquocgia['name'].'</b></p>
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

<div class="card-body" style="background-color:#DDDDDD">


					<div class="row">
<!--<div class="col-md-4">

					<div class="form-group">
                      <label for="">Số kiện</label>
                      <input type="number" name="sokien" class="form-control" id="sokien" value="0" required placeholder="Nhập số kiện" >
                    </div>
</div>-->
<div class="col-md-8">
					<div class="form-group">
                      <label for="">Tên hàng hóa</label>
                      <input type="text" name="package_tenhang" class="form-control" id="" value="" required placeholder="Nhập tên hàng hóa" >
                    </div>
</div>
<div class="col-md-4">
					<div class="form-group">
                      <label for="">Invoice Value</label>
                      <input type="number" id ="totalinvoice" class="form-control" step="any" min="1" id="" name="kg_valueinvoice" required placeholder="Nhập giá trị kiện hàng" required >
                    </div>
</div>
			</div>
					<div class="card-body table-bordered p-0">
                <table class="table table-hover table-bordered  text-nowrap">
                  <thead>
                    <tr style="background-color:#880000;color:white;text-align:center">
                      <th>Số kiện</th>
                      <th>Type</th>
                      <th>Length(Cm)</th>
                      <th>Width(Cm)</th>
                      <th>Heigth(Cm)</th>
                      <th>Weight(Kg)</th>
                      <th></th>
                    </tr>
                  </thead>
				   <tbody id="kiennho" style="background-color:white">
				   <tr class="package"><td>                      <input type='number' name='sokien[]' value="1" id='sokien' min="1" max="99" required placeholder='' style='text-align:center;'></td><td><select name='pack_type[]'><option value='Carton'>Carton</option><option value='Pallet'>Pallet</option><option value='Túi(Phong bì)'>Túi(Phong bì)</option></select></td><td><input type='number' name='pack_length[]' min="1" required></td><td><input type='number' min="1" name='pack_width[]'  size=7 required></td><td><input type='number' name='pack_height[]' min="1" size=7 required></td> <td><input type='number' name='pack_weight[]'   step="any" min="0.5" max="999" required></td>                      <td></td></tr>
                   </tbody>
                </table>
<div class="block">
				<span class="btn-danger add2" style="padding:5px;  cursor:pointer;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm kiện hàng</span>
				</div>
					<div class="form-group"  style="margin-left:20px;white-space:nowrap;">
                     
                    </div>

</div>

</div>

</div>




<div class="card card-warning">
<div class="card-header">
<h3 class="card-title">
<i class="far fa-list-alt"></i> Thông tin khai Invoice 
</h3>
</div>

<div class="card-body" style="background-color:#DDDDDD">


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
          
                           <tr class='invoice' >
                      <td><textarea class='form-control'  rows='3' placeholder='Nhập tên sản phẩm ...' name='iv_tensanpham[]' required></textarea></td>
                      <td><input type='number'  class='form-control soluong_no' name='iv_soluong[]' id="soluong_no" size=7 required></td>
                      <td><select name='iv_unit[]' ><option value='Pcs'>Pcs</option><option value='Bag'>Bag</option><option value='Box'>Box</option><option value='Jar'>Jar</option><option value='Set'>Set</option>
						</select></td>
                      <td><input type='number' class='form-control price_no' name='iv_price[]' id="price_no"	step="any"	required			  size=7></td>
                      <td style="text-align:center;font-weight:bold"><input type='number' class="form-control sum" id="sum" style="border: none;outline: none;" size="4" disabled></td>
                      <td><span class='btn-danger remove' style="padding:5px;  cursor:pointer;"><i class='fas fa-trash-alt'></i></span></td>
				  </tr>
				  
				  
				  
				  
				  
                   </tbody>
                </table>
				<div class="block">
				<span class="btn-danger add" style="padding:5px;  cursor:pointer;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm sản phẩm</span>
				</div>
					

</div>

</div>
<div class="card-footer">
				<button style="float:right;" type="submit" name="btn_submit" class="btn btn-danger">Tạo thông tin lô hàng</button>
                </div>
</div>

</div>
	
<div id="appended"></div>

<a href="#" onClick="AddRow()">Add Row</a>
	
	
			
		
	</form>
	
</div>

<?php  
    include('footer.php');
?>




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
		$("#kiennho").append("				   <tr class='package'><td>                      <input type='number' name='sokien[]'  style='text-align:center;' value='1' id='sokien' min='1' max='99' required placeholder='' ></td><td><select name='pack_type[]'><option value='Carton'>Carton</option><option value='Pallet'>Pallet</option><option value='Túi(Phong bì)'>Túi(Phong bì)</option></select></td><td><input type='number' name='pack_length[]' min='1' ></td><td><input type='number' name='pack_width[]' min='1'  size=7></td><td><input type='number' name='pack_height[]' min='1'  size=7></td> <td><input type='number' name='pack_weight[]'   step='any' min='0.5' max='999' ></td>                      <td><span class='btn-danger removea' style='padding:5px;  cursor:pointer;'><i class='fas fa-trash-alt'></i></span></td></tr>");
	});
		
		
		
		
		
    $('body').on('click', '.remove', function () {
		$(this).closest('.invoice').remove();
	  });
	});
			
		

		
		$(document).on("change", '#soluong_no1', function () {
		$("#sum_1").html("");
		$("#sum_1").append(($('#soluong_no1').val()*$('#price_no1').val())+ " USD");

		});
		
		$(document).on("change", '#price_no1', function () {
		$("#sum_1").html("");
		$("#sum_1").append(($('#soluong_no1').val()*$('#price_no1').val())+ " USD");
});
		
		
		$(document).on("change", '#soluong_no2', function () {
         $("#sum_2").html("");
		$("#sum_2").append(($('#soluong_no2').val()*$('#price_no2').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		
		$(document).on("change", '#price_no2', function () {
         $("#sum_2").html("");
		$("#sum_2").append(($('#soluong_no2').val()*$('#price_no2').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		

		$(document).on("change", '#soluong_no3', function () {
         $("#sum_3").html("");
		$("#sum_3").append(($('#soluong_no3').val()*$('#price_no3').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		
		$(document).on("change", '#price_no3', function () {
         $("#sum_3").html("");
		$("#sum_3").append(($('#soluong_no3').val()*$('#price_no3').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		
	
		$(document).on("change", '#soluong_no4', function () {
         $("#sum_4").html("");
		$("#sum_4").append(($('#soluong_no4').val()*$('#price_no4').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		
		$(document).on("change", '#price_no4', function () {
         $("#sum_4").html("");
		$("#sum_4").append(($('#soluong_no4').val()*$('#price_no4').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		
	
		
		$(document).on("change", '#soluong_no5', function () {
         $("#sum_5").html("");
		$("#sum_5").append(($('#soluong_no5').val()*$('#price_no5').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		
		$(document).on("change", '#price_no5', function () {
         $("#sum_5").html("");
		$("#sum_5").append(($('#soluong_no5').val()*$('#price_no5').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		
	
	
		
		$(document).on("change", '#soluong_no6', function () {
         $("#sum_6").html("");
		$("#sum_6").append(($('#soluong_no6').val()*$('#price_no6').val())+ " USD");
		
		
				$('#valueinvoicea').val($totalsum);

        });
		
		<?php
		
		for($i=6;$i<= 30;$i++)
		{
		echo'
		$(document).on("change", \'#price_no'.$i.'\', function () {
         $("#sum_'.$i.'").html("");
		$("#sum_'.$i.'").append(($(\'#soluong_no'.$i.'\').val()*$(\'#price_no'.$i.'\').val())+ " USD");
		
		
				$(\'#valueinvoicea\').val($totalsum);

        });
		
		
		$(document).on("change", \'#soluong_no'.$i.'\', function () {
         $("#sum_'.$i.'").html("");
		$("#sum_'.$i.'").append(($(\'#soluong_no'.$i.'\').val()*$(\'#price_no'.$i.'\').val())+ " USD");
		
		
				$(\'#valueinvoicea\').val($totalsum);

        });';
		}
		?>
		
		
		

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

