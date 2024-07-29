<?php  
  
    loadModalScanPackage();
    
	if(isset($_POST['btn_submit']))
	{
		mysqli_query($conn,"UPDATE `ksn_string_mod` SET `string_ksn`='".$_POST['noidung']."' where `string_mod`='ksn_dieukhoan'");
		
		
		echo'<script> 
								alert("Chỉnh sửa điều khoản thành công !");

            </script>';

	}

?>


<?php
$stringmod = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_string_mod where string_mod='ksn_dieukhoan'"));
?>
<div class="container-fluid">
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-8">
			 <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                SỬA THÔNG TIN ĐIỀU KHOẢN
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
			
			<div class="form-group">
                      <!--<label for="">Tên hàng hóa</label>-->
                    </div>
              <textarea id="summernote" name="noidung" ><?php echo $stringmod['string_ksn']?>
                
              </textarea>
			  
			
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
