<?php  
	include('top.php');
	
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-4">
				<h5>Cập Nhật Mã Tracking Cho Tcat</h5>
				<hr>
			
	         
				<div class="form-group" >
					<label for="">Dán mã vào bên dưới </label>
					
					<textarea id="w3review" name="w3review" rows="4" cols="60"  class="form-control" >79790001	903922009006</textarea>
<br>Cập nhật mã với định dạng : <br>[<b>Mã kiện </b>]    [<b>Mã Tcat</b>]<br>
				</div>
				
				
				<button type="submit" name="btn_submit" class="btn btn-success">Update</button>
			</div>
			<div class="col-md-8">
				 <?php
				 	include('simple_html_dom.php');

				 if(isset($_POST['btn_submit']))
{
	$text = trim($_POST['w3review']); // remove the last \n or whitespace character
$text = nl2br($text); // insert <br /> before \n 
	$pieces = explode("\n", $text);
	
	foreach ($pieces as $letter=>$value) {
	$value = str_replace("<br />","",$value);
	$value1 = trim($value); 
	$traiphai = explode("	", $value);
	
	
	// get DOM from URL or file
	$macj =  str_replace(',','',$traiphai[1]);
	$mabill = str_replace(',','',$traiphai[0]);



	
	$string = 'Giá '.$mabill.' kg'; 
	mysqli_query($conn,"INSERT INTO `zone_ph` (`name`, `note`) VALUES ('$mabill','$macj')")or die(mysqli_error());

	echo 'name :<b> '.$mabill.'-'.$string.'-';
	echo '</b>note: <b>'.$macj.'<br>';

	
}

}


				 ?>
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