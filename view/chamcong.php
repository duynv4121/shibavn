<?php  
	include('top.php');
	include('../controller/bill.php');
	
	

	if (isset($_POST['btn_scan'])) {
		
		@$barcode = $_POST['b'];


		
	if($roleid == 1 || $roleid == 5)
		{
		
		
		if(isset($_POST['b']))
		{	
			$laydulieukienb = mysqli_fetch_assoc(mysqli_query($conn,"select id_package,id_code,status from ns_listhoadon where id_code='".$barcode."'"));

			if(mysqli_num_rows(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$_POST['b']."'")) < 1)
			{
			echo '
					<script>
						alert("Mã kiện không có trong hệ thống");
						window.location = "scan_return.php";

					</script>
				';			
			}
			else if($laydulieukienb['status'] == 2)
			{
				echo '
					<script>
						alert("Kiện được quét xuất không thể trả hàng!");
						window.location = "scan_return.php";

					</script>
				';						
			}
		
			else
			{
				
			$laydulieukienb = mysqli_fetch_assoc(mysqli_query($conn,"select id_package,id_code from ns_listhoadon where id_code='".$barcode."'"));
		//aaaaaaaaaaaaaaaaaaaaaaaa
		
			mysqli_query($conn,"UPDATE `ns_listhoadon` SET `status`='5' WHERE (`id_code`='$barcode')");
			mysqli_query($conn,"UPDATE `ns_package` SET `status`='5' WHERE (`id`='".$laydulieukienb['id_package']."')");
			mysqli_query($conn,"INSERT INTO `ksn_scan_return` (`id_listhoadon`, `date`, `datetime`,`uid`) VALUES ($barcode, NOW(),NOW(),'$uid')");

			
			
			
			
			
			
			
			
			
			add_trackingBill($barcode,'Return To Sender',location_chinhanh($laydulieuchinhanh['kg_chinhanh']),$conn);

			echo '<script>alert("Scan trả hàng thành công");window.location = "scan_nhap.php";</script>';
			
			}
		}
		
	
		}
		
	}

?>

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
	
	<br>
	
		<?php
		
	
		echo'<center>
	<h1>	HỆ THỐNG CHẤM CÔNG GIA PHÚ EXPRESS
	
		</h1><br>Ngày 29/10/2023
		<br>
			<div id="id_qrcode" ></div>
		Quét mã QR để điểm danh
		
		
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">

			<div class="card card-info">
				<div class="card-header">
				<h3 class="card-title">LỊCH SỬ ĐIỂM DANH GẦN ĐÂY	</h3> 
				</div>
				<div class="card-body">
				

				<div class="row">
<table class="table table-hover text-nowrap">
		<tr><th>Nhân viên</th><th>Chức vụ</th><th>Thời gian điểm danh</th><th>Status</th></tr>
		';
		
		$laydulieudiemdanha = mysqli_query($conn,"select * from gpe_attendance LIMIT 10");
		while($laydulieudiemdanh = mysqli_fetch_array($laydulieudiemdanha))
		{
			$laydulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$laydulieudiemdanh['uid']."'"));
			echo'<tr><td>'.$laydulieuuser['ten'].'</td><td>'.chucvu($laydulieuuser['roleid']).'</td><td>'.$laydulieudiemdanh['datetime'].'</td><td style="color:green">On Time</td></tr>';
		}
		
		
		echo'
		
		
		</table>
			
				</div>
				</div>

			</div>
			
			</div>
			</div>
			
			<div class="row">
			
			</div>
		';
		
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

	<?php
	 
  echo'
		<script>
			function onReady()
		{
			
		
';


	
	echo'	var qrcode = new QRCode("id_qrcode", {
				text:"https://giaphuexpress.com/trackingview.php?id=",
				width:300,
				height:300,
				colorDark:"#000000",
				colorLight:"#ffffff",
				correctLevel:QRCode.CorrectLevel.H
			});
	
	';
		
		
		echo'} </script>';
	?>
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