<?php  
	include('top.php');
	include('../controller/bill.php');
	
	
	function roundUp($number, $nearest){
			return ceil($number/0.5)*0.5;;
	}
	
	$id_kiencon = $_GET['id'];
	
	
	$data = getPackageData($id_kiencon,$conn);
	
	$sender = getSender($data['id_nguoigui'],$conn);
	$receiver = getReceiver($data['id_nguoinhan'],$conn);
	
	if($roleid == 2|| $roleid == 5)
	{
		
			exit();
		
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
	
	
	
	if(isset($_POST['btn_submit']))
	{
		
		
		
		mysqli_query($conn,"UPDATE `ns_package` SET `chiho`='".$_POST['chiho_check']."' WHERE (`id`='$id_kiencon')");
		
		if(@$_POST['chiphi1'] == "" &&   @$_POST['chiphi2'] == ""  && @$_POST['chiphi3'] == ""  && @$_POST['chiphi4'] == ""  && @$_POST['chiphi5'] == ""  && @$_POST['chiphi6'] == "" )
		{
					         echo'<script> 
               alert("Cần chọn ít nhất 1 giá trị nguyên vật liệu công ty để hoàn thành đơn!");
            </script>';
		}
		else
		{
			
			mysqli_query($conn,"DELETE FROM `kns_listhoadonchiphi` WHERE (`id_code`='".$data['id_code']."')");
		
		if(@$_POST['phipickup'] != 0)
		{
			if(@$_POST['phipickup'] == 1)
			{
				$m_string = 'Phí pick up nội thành';
				$var_string = 'phipickup1';
				$price_pickup = $_POST['price_pickup1'];
			}else if(@$_POST['phipickup'] == 2)
			{
				$m_string = 'Phí pick up ngoại thành';
				$var_string = 'phipickup2';
				$price_pickup =  $_POST['price_pickup2'];
			}
			mysqli_query($conn,"INSERT INTO `kns_listhoadonchiphi` (`id_code`, `tenphuthu`, `price`, `soluong`, `var_string`) VALUES ('".$data['id_code']."', '$m_string', '$price_pickup', '1', '$var_string')");
		}
		
		if(@$_POST['chiphi1'] == 1)
		{
		$m_string = $_POST['m_string_chiphi1'];
		$var_string = 'chiphi1';
		$price_chiphi = $_POST['price_chiphi1'];
		$soluong_chiphi = $_POST['soluong_chiphi1'];
		mysqli_query($conn,"INSERT INTO `kns_listhoadonchiphi` (`id_code`, `tenphuthu`, `price`, `soluong`, `var_string`) VALUES ('".$data['id_code']."', '$m_string', '$price_chiphi', '$soluong_chiphi', '$var_string')");

		}
		if(@$_POST['chiphi2'] == 1)
		{
		$m_string = $_POST['m_string_chiphi2'];
		$var_string = 'chiphi2';
		$price_chiphi = $_POST['price_chiphi2'];
		$soluong_chiphi = $_POST['soluong_chiphi2'];
		mysqli_query($conn,"INSERT INTO `kns_listhoadonchiphi` (`id_code`, `tenphuthu`, `price`, `soluong`, `var_string`) VALUES ('".$data['id_code']."', '$m_string', '$price_chiphi', '$soluong_chiphi', '$var_string')");

		}if(@$_POST['chiphi3'] == 1)
		{
		$m_string = $_POST['m_string_chiphi3'];
		$var_string = 'chiphi3';
		$price_chiphi = $_POST['price_chiphi3'];
		$soluong_chiphi = $_POST['soluong_chiphi3'];
		mysqli_query($conn,"INSERT INTO `kns_listhoadonchiphi` (`id_code`, `tenphuthu`, `price`, `soluong`, `var_string`) VALUES ('".$data['id_code']."', '$m_string', '$price_chiphi', '$soluong_chiphi', '$var_string')");

		}
		if(@$_POST['chiphi4'] == 1)
		{
		$m_string = $_POST['m_string_chiphi4'];
		$var_string = 'chiphi4';
		$price_chiphi = $_POST['price_chiphi4'];
		$soluong_chiphi = $_POST['soluong_chiphi4'];
		mysqli_query($conn,"INSERT INTO `kns_listhoadonchiphi` (`id_code`, `tenphuthu`, `price`, `soluong`, `var_string`) VALUES ('".$data['id_code']."', '$m_string', '$price_chiphi', '$soluong_chiphi', '$var_string')");

		}if(@$_POST['chiphi5'] == 1)
		{
		$m_string = $_POST['m_string_chiphi5'];
		$var_string = 'chiphi5';
		$price_chiphi = $_POST['price_chiphi5'];
		$soluong_chiphi = $_POST['soluong_chiphi5'];
		mysqli_query($conn,"INSERT INTO `kns_listhoadonchiphi` (`id_code`, `tenphuthu`, `price`, `soluong`, `var_string`) VALUES ('".$data['id_code']."', '$m_string', '$price_chiphi', '$soluong_chiphi', '$var_string')");

		}if(@$_POST['chiphi6'] == 1)
		{
		$m_string = $_POST['m_string_chiphi6'];
		$var_string = 'chiphi6';
		$price_chiphi = $_POST['price_chiphi6'];
		$soluong_chiphi = $_POST['soluong_chiphi6'];
		mysqli_query($conn,"INSERT INTO `kns_listhoadonchiphi` (`id_code`, `tenphuthu`, `price`, `soluong`, `var_string`) VALUES ('".$data['id_code']."', '$m_string', '$price_chiphi', '$soluong_chiphi', '$var_string')");

		}if(@$_POST['chiphi7'] == 1)
		{
		$m_string = $_POST['m_string_chiphi7'];
		$var_string = 'chiphi7';
		$price_chiphi = $_POST['price_chiphi7'];
		$soluong_chiphi = $_POST['soluong_chiphi7'];
		mysqli_query($conn,"INSERT INTO `kns_listhoadonchiphi` (`id_code`, `tenphuthu`, `price`, `soluong`, `var_string`) VALUES ('".$data['id_code']."', '$m_string', '$price_chiphi', '$soluong_chiphi', '$var_string')");

		}
		
		echo'<script> window.location.href="package_fn.php?id='.$id_kiencon.'&check=success";</script>';
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
	
	<div class="row">
<div class="col-md-3">
<div class="card card-warning">

<?php echo'
<div class="card-header">

<h3 class="card-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin Lô Hàng</h3>
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
<p>- Dịch vụ chữ ký người nhận: '.$checksign.'</p>
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
<i class="fas fa-box"></i> Cập nhật chi phí vận hành
</h3>
</div>

<div class="card-body">


					<div class="row">

					

</div>
<div class="row">

<div class="col-md-12">

				

<?php
					
				
					
					
					?>
					
                
				
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					

</div>
</div>
							<form action="" method="POST">	

<div class="row">

<div class="col-md-8">
              <!-- /.card-header -->
			
                
				<?php
				
				
				if($data['charge_weight']>=0.5 && $data['charge_weight'] <= 50)
				{
					$dulieupickup = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_listchiphipickup where id='1'"));
					$giatien_noithanh = $dulieupickup['noithanh'];
					$giatien_ngoaithanh = $dulieupickup['ngoaithanh'];
				}
				else if($data['charge_weight'] >= 51 && $data['charge_weight'] <= 100)
				{
					$dulieupickup = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_listchiphipickup where id='2'"));
					$giatien_noithanh = $dulieupickup['noithanh'];
					$giatien_ngoaithanh = $dulieupickup['ngoaithanh'];
				}
				else if($data['charge_weight'] >= 101 && $data['charge_weight'] <= 300)
				{
					$dulieupickup = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_listchiphipickup where id='3'"));
					$giatien_noithanh = $dulieupickup['noithanh'];
					$giatien_ngoaithanh = $dulieupickup['ngoaithanh'];
				}
				else if($data['charge_weight'] > 300)
				{
					$dulieupickup = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_listchiphipickup where id='4'"));
					$giatien_noithanh = $dulieupickup['noithanh'];
					$giatien_ngoaithanh = $dulieupickup['ngoaithanh'];
				}

				$check_pickup = 1;

				$laydulieuchiphi_pickup1 = mysqli_fetch_assoc(mysqli_query($conn,"select * from kns_listhoadonchiphi where var_string='phipickup1'  AND id_code='".$data['id_code']."'"));
				
				if(@$laydulieuchiphi_pickup1['tenphuthu'] != "")
				{
					$giatien_noithanh = $laydulieuchiphi_pickup1['price'];
					$check_pickup = 1;
				}
				@$laydulieuchiphi_pickup2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from kns_listhoadonchiphi where var_string='phipickup2' AND id_code='".$data['id_code']."'"));
				if(@$laydulieuchiphi_pickup2['tenphuthu'] != "")
				{
					$giatien_ngoaithanh = $laydulieuchiphi_pickup2['price'];
					$check_pickup = 2;
				}
				echo'		

		<div class="card card-danger">
<div class="card-header">
<h3 class="card-title">1/ THÔNG TIN BỔ SUNG</h3>
</div>


<div class="card-body">

Đơn hàng này đến từ đâu ?</b>

<div class="form-group row">
<label for="" class="col-sm-3 col-form-label">
 <input type="radio" name="chiho_check" value="0" ';  if($data['chiho'] == '0'){echo'checked';}echo'> 1. Đơn hàng công ty</label>
<label for="inputPassword3" class="col-sm-3 col-form-label"><input type="radio"  name="chiho_check" value="2" ';  if($data['chiho'] == '2'){echo'checked';}echo'> 2. Đơn hàng tự tìm kiếm</label>



</div>


<div class="form-group row">



</div>

</div>



</div>
			
		
				
				
			<div class="form-groupa" id="khaihanga">
			
					
					</label>
					<div class="aaa" id="z1">
						';
							
							
							
							
							
							echo'
						</div>
					</div><br>
									';
				?>
				
              <!-- /.card-body -->
          
				
				<?php
				if(@$_GET['check'] == 'success')
				{
					echo'<a href="create_package.php" class="btn btn-danger"><i class="fas fa-file-alt"></i> Tạo đơn hàng mới</a>';
				}
				?>
			<br>	
				

</div>

<div class="col-md-8">




<?php
	
	
	

				echo'		

		<div class="card card-danger">
<div class="card-header">
<h3 class="card-title">2/ CHI PHÍ NGUYÊN VẬT LIỆU CỦA CÔNG TY</h3>
</div>


<div class="card-body">

Tổng kiện hàng nhỏ: <b>'.$data['sokien'].' kiện</b>
';

$laydulieuchiphia = mysqli_query($conn,"select * from ksn_listchiphivanhanh");
while($laydulieuchiphi = mysqli_fetch_array($laydulieuchiphia,MYSQLI_ASSOC))
{
	$check_test = 0;
	@$laydulieuchiphi_test = mysqli_fetch_assoc(mysqli_query($conn,"select * from kns_listhoadonchiphi where var_string='".$laydulieuchiphi['var_string']."' AND id_code='".$data['id_code']."'"));
				
				if(@$laydulieuchiphi_test['var_string'] == $laydulieuchiphi['var_string'])
				{
					$giatien_old = $laydulieuchiphi_test['price'];
					$soluong_old = $laydulieuchiphi_test['soluong'];
				}
				else
				{
					$giatien_old = $laydulieuchiphi['price'];
					$soluong_old = 1;
				}
				
	
	echo'<div class="form-group row">
<label for="inputEmail3" class="col-sm-4 col-form-label">
<input type="checkbox"  name="'.$laydulieuchiphi['var_string'].'" value="1" '; 

if(@$laydulieuchiphi_test['var_string'] == $laydulieuchiphi['var_string'])
				{
						echo'checked ';

				}
echo'>
<input type="hidden"  name="m_string_'.$laydulieuchiphi['var_string'].'" value="'.$laydulieuchiphi['tenmathang'].'">
 '.$laydulieuchiphi['tenmathang'].'

</label>
<div class="col-sm-4">
	<div class="input-group mb-3">
	<input type="text" class="form-control" value="'.$giatien_old.'" name="price_'.$laydulieuchiphi['var_string'].'" ';
	if($laydulieuchiphi['var_string'] != 'chiphi6')
	{
		echo'readonly ';
	}
	echo ''.$laydulieuchiphi['var_string'].'>
	<div class="input-group-append">
	<span class="input-group-text">Giá tiền</span>
	</div>
	</div>

</div>
<div class="col-sm-4">
	<div class="input-group mb-3">
	<input type="number" class="form-control"  value="'.$soluong_old.'" name="soluong_'.$laydulieuchiphi['var_string'].'">
	<div class="input-group-append">
	<span class="input-group-text">S.lượng</span>
	</div>
	</div>
</div>



</div>';
}


echo'

';

echo'

</div>



</div>
			
		
				
				
			<div class="form-groupa" id="khaihanga">
			
					
					</label>
					<div class="aaa" id="z1">
						';
							
							
							
							
							$danhsachphuthua = mysqli_query($conn,"select * from kns_listhoadonphuthu where id_code='".$_GET['id']."'");
							
							while($danhsachphuthu = mysqli_fetch_array($danhsachphuthua,MYSQLI_ASSOC))
							{
							echo'						<div class="abcd">
<div class="row">
										  <div class="col-8">

						';
								$catalogs = mysqli_query($conn,"SELECT * FROM ksn_listphuthu ORDER BY id DESC ") or die("Loi");

								echo'
									<select class="form-control select2" name="id_phuthu[]" style="width: 100%;" ><option value="">Chọn mặt hàng phụ thu</option>';
									while ($item = mysqli_fetch_array($catalogs,MYSQLI_ASSOC)) {
								  echo '  <option value="'.$item['id'].'" '; 
								  if($danhsachphuthu['tenphuthu'] == $item['tenmathang'])
								  {
									  echo'selected';
								  }
								  echo'>'.$item['id'].'-'.$item['tenmathang'].' ['.number_format($item['price']).'đ/'.$item['type'].'] </option>';
								}
	  
								echo'</select>
										</div>					                  
										
										<div class="col-1"><span class="btn-danger  remove btn-sm" style="cursor:pointer;"><i class="fas fa-trash-alt"></i></span>
										</div>
								</div></div>';
								
							}
							
							echo'
						</div>
					</div><br>
									';
				?>
				
              <!-- /.card-body -->
          
				
				<?php
				
				?>
			<br>	




</div>

</div>

<center>

			<button  type="submit" name="btn_submit" class="btn btn-danger"><i class="fas fa-check-circle"></i> CẬP NHẬT CHI PHÍ </button>


</form>




</div>
	
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