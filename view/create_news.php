<?php  
	include('top.php');
	
	
	if(isset($_POST['btn_submit']))
	{
		if($roleid == 1 || $roleid == 3|| $roleid == 4)
		{
		$tieude =  $_POST['tieude'];
		$noidung =  $_POST['noidung'];
		
		
		$name=basename($_FILES['file']['name']);
		$name1=explode('.',$name);
		$target_location ='';
		if($name1[count($name1)-1]=='csv'||$name1[count($name1)-1]=='xlsx')
		{
				  $target_path = "upload_news/";
				$target_location = $target_path .date("Y-m-d"). basename($_FILES['file']['name']);
				$_SESSION['target_location'] = $target_location;
				move_uploaded_file($_FILES["file"]["tmp_name"], $target_location);
				$uploadedStatus = 1;
		}
		
		
		mysqli_query($conn,"INSERT INTO `ksn_tintuc` (`tieude`, `noidung`, `uid`, `filedinhkem`, `datetime`) VALUES ('$tieude', '$noidung', '$uid','$target_location', NOW())");
		
		 echo'<script> 
               alert("Tạo THÔNG BÁO MỚI THÀNH CÔNG!");

              </script>
			  
			  
			  
			  ';
		}
	}
		
		
	
?>


<div class="container-fluid">
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-8">
			 <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                TẠO BÀI VIẾT MỚI TẠI HỆ THỐNG SHIBA EXPRESS
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
			
			<div class="form-group">
                      <!--<label for="">Tên hàng hóa</label>-->
                      <input type="text" name="tieude" class="form-control" id="" value="" required placeholder="Nhập Tiêu Đề Tin Tức Mới" >
                    </div>
              <textarea id="summernote" name="noidung" >
                
              </textarea>
			  
			  <label for="">File đính kèm (* Chỉ chấp nhận upload tệp file .csv và Excel)</label>
			  <input type="file" id="myFile" name="file">

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