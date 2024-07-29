<?php  
	include('top.php');
	$idbaiviet = $_GET['id'];
	
	if(isset($_POST['btn_submit']))
	{
		if($roleid == 1 || $roleid == 3|| $roleid == 4)
		{
		$tieude =  $_POST['tieude'];
		$noidung =  $_POST['noidung'];
		
		
		
		mysqli_query($conn,"UPDATE `ksn_tintuc` SET `tieude`='$tieude', `noidung`='$noidung' WHERE (`id`='$idbaiviet')");
		
		 echo'<script> 
               alert("CHỈNH SỬA NỘI DUNG THÔNG BÁO THÀNH CÔNG!");

              </script>
			  
			  
			  
			  ';
		}
	}
		
	$dulieutintuc = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_tintuc where id='$idbaiviet'"));

	
?>


<div class="container-fluid">
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-8">
			 <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                CHỈNH SỬA BÀI VIẾT
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
			
			<div class="form-group">
                      <!--<label for="">Tên hàng hóa</label>-->
                      <input type="text" name="tieude" class="form-control" id="" value="<?php echo $dulieutintuc['tieude'];?>" required placeholder="Nhập Tiêu Đề Tin Tức Mới" >
                    </div>
              <textarea id="summernote" name="noidung" ><?php echo $dulieutintuc['noidung'];?>
                
              </textarea>
			  
			

            </div>
            <div class="card-footer" style="text-align:right">
			<button type="submit" name="btn_submit" class="btn btn-danger">Tạo Tin Tức Mới</button>
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
<?php  
    include('footer.php');
?>
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