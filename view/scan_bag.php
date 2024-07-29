<?php  
	include('top.php');
	include('../controller/bill.php');
	
	if(isset($_GET['mawbid']))
	{
		$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment where id='".$_GET['mawbid']."'"));
	}

	if (isset($_POST['btn_scan'])) {
		
		@$b = $_POST['b'];
		@$mawbid = $_POST['mawbid'];

		
	if($roleid == 1 || $roleid == 5)
		{
		
			echo '<script>window.location = "scan_xuat_dt.php?mawbid='.@$mawbid.'&bag_save='.substr(@$b,3).'";</script>';
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
	
	<br>
	
		<?php
		
	
		echo'
		<form action="" method="POST">
			<div class="row" >
				<div class="col-md-12 ">
				
				<div class="card card-danger">
				  <div class="card-header">
					<h3 class="card-title">	<span class="edit2"style="color:#DCDCDC;cursor:pointer"> <i class="fas fa-edit"></i></span> Scan Mã BAG CODE</h3>
				  </div>
				  <div class="card-body" style=" background-color:#EEE9E9">
					<div id="interactive" class="viewport"></div>

					<input type="text" readonly name="b" class="form-control" id="bc" style="color:green;font-weight:bold" placeholder="" ><hr>
					<label> MAWB </label>
					<input type="text" readonly  class="form-control" style="color:green;font-weight:bold" value="'.$laydulieu['awb'].'" placeholder="" >
					<input type="hidden" readonly name="mawbid" class="form-control" id="bc" style="color:green;font-weight:bold" value="'.$laydulieu['id'].'" placeholder="" >
				
					<!-- <a type="button" class="btn btn-success form-control" onclick="CreateByBarcode()" href="#">Tạo</a> --><br>
					<center><button type="submit" name="btn_scan" class="btn btn-primary form-control">Scan Tiếp Tục Vào Bao</button></center>
				  </div>
				  <!-- /.card-body -->
				</div>
				
					
				</div>
			</div>
		</form>';
		
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