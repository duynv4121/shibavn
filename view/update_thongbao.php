<?php  
	include('top.php');
	if(isset($_POST['btn_submit']))
		{
			$tieude = $_POST['tieude'];
			$noidung = $_POST['noidung'];
			mysql_query("UPDATE `gpe_thongbao` SET `tieude`='$tieude', `noidung`='$noidung' WHERE (`id`='1')");
		}
	$laynoidungthongbao = mysql_fetch_assoc(mysql_query("select * from gpe_thongbao where id='1'"));
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-8">
			
				<form action="" method="POST">
				<h5>Chỉnh sửa thông báo</h5>
				<hr>
			
	         
				
					<br>
					
				<div class="card card-outline card-info">
<div class="card-header">
					<label for="">Tiêu đề</label>
				<input type="text" value="<?php echo $laynoidungthongbao['tieude'];?>" name="tieude" placeholder="Nhập tiêu đề thông báo" class="form-group">
</div>

<div class="card-body">
	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
	<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
            <textarea name="noidung" id="editor1" rows="10" cols="80"><?php echo $laynoidungthongbao['noidung'];?></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>

</div>

</div>	
					
				<button type="submit" name="btn_submit" class="btn btn-success">Cập nhật thông báo</button>
			</div>
			
		</div>
	</form>
	
</div>

<?php  
    include('footer.php');
?>
<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>