<?php  
@session_start();
include("../conn/db.php");
include('../controller/role.php');
include('../controller/user.php');
//co bug here
if (!isset($_SESSION['username']) || !isset($_SESSION['uid']) || $_SESSION['uid'] == "" || $_SESSION['uid'] == NULL) {
    header('Location: login.php');
    exit();
}
$uid = $_SESSION['uid'];
$roleid = $_SESSION['roleid'];
if (isset($_POST['btn_search'])) {
    $txt_search = $_POST['txt_search'];
    echo'<script> 
            window.location.href="searchview.php?id='.$txt_search.'";
        </script>';
}

$listrole = setrole1($uid,$roleid);


	include('../controller/bill.php');
	if (isset($_POST['btn_create'])) {
		
		if($_POST['barcode'] == "")
		{
			echo'
				<audio controls autoplay hidden>
	<source src="audio/notmabao.mp3" type="audio/mpeg">
				  Your browser does not support the audio element.
				</audio>
				';
			
		}
		else
		{
		
		$barcode = $_POST['barcode'];
		
				echo '
					<script>
						window.location = "scan_bag_detail.php?id='.$barcode.'";
					</script>
				';
		}	
			
		
	}
?>
<link rel="stylesheet" type="text/css" href="../scan_lib/example/css/styles.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
<style type="text/css">
	.nopadding {
	   padding: 0 !important;
	   margin: 0 !important;
	}

</style>
<div style="padding:20px">
	<center><h1 style="color:red;font-size:50px"><i class="fa fa-barcode"></i>
Scan Bag Code</h3>
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
	
	<div  style="  width: 100%;" id="interactive" class="viewport" ></div>
	<br>
		<form action="" method="POST">
		
					<input type="text" readonly name="barcode"  style="  width: 100%; font-size: 4.25em;" class="form-control" id="bc" placeholder=""><br>
					<!-- <a type="button" class="btn btn-success form-control" onclick="CreateByBarcode()" href="#">Tạo</a> -->
					<button type="submit"  style="  
    width:100%; font-size: 4.25em;" name="btn_create" class="btn btn-success form-control">Next</button>
				
		</form>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<!-- <script src="../vendor/chart.js/Chart.min.js"></script>

<script src="../js/demo/chart-area-demo.js"></script>
<script src="../js/demo/chart-pie-demo.js"></script> -->

<!-- Page level plugins -->
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/datatables-demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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