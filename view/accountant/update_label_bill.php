<?php  
	
?>
<div class="container-fluid">
	<form action="" method="POST">			

		<div class="row">
			<div class="col-md-4">
			
			
			
			<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Cập nhật Label đã tạo </h3>
</div>
<div class="card-body">
			
	         
				<div class="form-group" >
					<label for="">Dán mã vào bên dưới </label>
					<hr>

					<textarea id="w3review" name="w3review" rows="4" cols="60"  class="form-control" ></textarea>
<br>Cập nhật mã với định dạng Example:<br>
299990054173<br>
299990054174<br>
299990054175<br>
<br>
				</div>
				
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-danger">Cập nhật</button>
</div>
</div>
			
			
			
			
			
			
			
				<h5></h5>
				
				
			</div><?php
				 	include('simple_html_dom.php');

				 if(isset($_POST['btn_submit']))
{
	echo'			<div class="col-md-3" style="color:green">Cập nhật Label đã tạo thành công<br><br><br>
';
	
	$text = trim($_POST['w3review']); // remove the last \n or whitespace character
$text = nl2br($text); // insert <br /> before \n 
	$pieces = explode("\n", $text);
	
	foreach ($pieces as $letter=>$value) {
	$value = str_replace("<br />","",$value);
	echo $value.'<br>';

	mysqli_query($conn,"UPDATE `ns_package` SET `check_label`='1' WHERE (`id_code`='".trim($value)."')")or die(mysqli_error());

	//echo ' :<b> '.$mabill.'-<br>';

	


}
echo'</div>';
}


				 ?>
		
		</div>
		
		
	</form>
	
</div>

<?php  
?>
<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>