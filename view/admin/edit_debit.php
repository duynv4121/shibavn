<?php  
  
    loadModalScanPackage();
    
	if(isset($_POST['btn_submit']))
	{
		$debit_string_1 = $_POST['debit_string_1'];
		$debit_string_2 = $_POST['debit_string_2'];
		$debit_string_3 = $_POST['debit_string_3'];
		$debit_string_4 = $_POST['debit_string_4'];
		$debit_string_5 = $_POST['debit_string_5'];
		$debit_string_6 = $_POST['debit_string_6'];
		$debit_string_7 = $_POST['debit_string_7'];
		$debit_string_7a = $_POST['debit_string_7a'];
		$debit_string_8 = $_POST['debit_string_8'];
		$debit_string_9 = $_POST['debit_string_9'];
		$debit_string_10 = $_POST['debit_string_10'];
		$debit_string_11 = $_POST['debit_string_11'];
		$debit_string_12 = $_POST['debit_string_12'];
		$debit_string_13 = $_POST['debit_string_13'];
		
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_1' WHERE (`string_mod`='debit_string_1')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_2' WHERE (`string_mod`='debit_string_2')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_3' WHERE (`string_mod`='debit_string_3')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_4' WHERE (`string_mod`='debit_string_4')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_5' WHERE (`string_mod`='debit_string_5')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_6' WHERE (`string_mod`='debit_string_6')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_7' WHERE (`string_mod`='debit_string_7')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_7a' WHERE (`string_mod`='debit_string_7a')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_8' WHERE (`string_mod`='debit_string_8')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_9' WHERE (`string_mod`='debit_string_9')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_10' WHERE (`string_mod`='debit_string_10')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_11' WHERE (`string_mod`='debit_string_11')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_12' WHERE (`string_mod`='debit_string_12')LIMIT 1");
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='$debit_string_13' WHERE (`string_mod`='debit_string_13')LIMIT 1");
		
		echo'<script> 
								alert("Chỉnh sửa xuất debit thành công thành công !");

            </script>';

	}

?>


<?php


function string_mod($string_mod,$conn)
{
$string_moda = mysqli_fetch_assoc(mysqli_query($conn,"SELECT string_ksn FROM ksn_string_mod where string_mod='$string_mod'"))or die("Loi");
return $string_moda['string_ksn'];
}

?>
<div class="container-fluid">
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-8">
			 <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                SỬA THÔNG TIN XUẤT EXCEL DEBIT
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
			
			<div class="form-group">
                      <!--<label for="">Tên hàng hóa</label>-->
                    </div>
                header
				<div class="form-group" >
					<input type="text"  name="debit_string_1" class="form-control" value="<?php echo string_mod('debit_string_1',$conn);?>" placeholder="địa chỉ">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_2" class="form-control" value="<?php echo string_mod('debit_string_2',$conn);?>" placeholder="Tel">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_3" class="form-control" value="<?php echo string_mod('debit_string_3',$conn);?>" placeholder="Email">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_4" class="form-control" value="<?php echo string_mod('debit_string_4',$conn);?>" placeholder="Web">
				</div>
				
				<hr>
				Footer
				<div class="form-group" >
					<input type="text"  name="debit_string_5" class="form-control" value="<?php echo string_mod('debit_string_5',$conn);?>" placeholder="thanh toán cá nhân">
				</div><div class="form-group" >
					<input type="text"  name="debit_string_6" class="form-control" value="<?php echo string_mod('debit_string_6',$conn);?>" placeholder="thanh toán cá nhân">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_7" class="form-control" value="<?php echo string_mod('debit_string_7',$conn);?>" placeholder="thanh toán cá nhân">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_7a" class="form-control" value="<?php echo string_mod('debit_string_7a',$conn);?>" placeholder="thanh toán cá nhân">
				</div>
				<hr>
				<div class="form-group" >
					<input type="text"  name="debit_string_8" class="form-control" value="<?php echo string_mod('debit_string_8',$conn);?>" placeholder="thanh toán công ty">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_9" class="form-control" value="<?php echo string_mod('debit_string_9',$conn);?>" placeholder="thanh toán công ty">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_10" class="form-control" value="<?php echo string_mod('debit_string_10',$conn);?>" placeholder="thanh toán công ty">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_11" class="form-control" value="<?php echo string_mod('debit_string_11',$conn);?>" placeholder="thanh toán công ty">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_12" class="form-control" value="<?php echo string_mod('debit_string_12',$conn);?>" placeholder="thanh toán công ty">
				</div>
				<div class="form-group" >
					<input type="text"  name="debit_string_13" class="form-control" value="<?php echo string_mod('debit_string_13',$conn);?>" placeholder="thanh toán công ty">
				</div>
			  
			
            </div>
            <div class="card-footer" style="text-align:right">
			<button type="submit" name="btn_submit" class="btn btn-danger"><i class="fas fa-check-circle"></i> Edit </button>
            </div>
          </div>
			</div>
				
		</div>
	</form>
	
</div>
<script src="gd/plugins/summernote/summernote-bs4.min.js"></script>
<script src="gd/plugins/codemirror/codemirror.js"></script>
<script src="gd/plugins/codemirror/mode/css/css.js"></script>
<script src="gd/plugins/codemirror/mode/xml/xml.js"></script>
<script src="gd/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

<!-- CodeMirror -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>