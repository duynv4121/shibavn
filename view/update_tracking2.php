<?php  
	include('top.php');
	
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-4">
				<h5>Cập nhật giá 6 chi nhanh</h5>
				<hr>
			
	         
				
				<button type="submit" name="btn_submit" class="btn btn-success">Update</button>
			</div>
			<div class="col-md-8">
				 <?php
				 	include('simple_html_dom.php');

				 if(isset($_POST['btn_submit']))
{
	$laydichvua = mysqli_query($conn,"select * from ksn_giadichvu");
	$price1 = 100000;
	$price2 = 200000;
	$price3 = 300000;
	$price4 = 400000;
	$price5 = 500000;
	while($laydichvu = mysqli_fetch_array($laydichvua,MYSQLI_ASSOC))
	{
		$price1 += 1;
		$price2 += 1;
		$price3 += 1;
		$price4 += 1;
		$price5 += 1;
		echo $laydichvu['id'].'<br>';
		mysqli_query($conn,"UPDATE `ksn_giadichvu` SET `price_hcm_f1`='$price1', `price_hn_f0`='$price2', `price_hn_f1`='$price3', `price_dn_f0`='$price4', `price_dn_f1`='$price5' WHERE (`id`='".$laydichvu['id']."')");
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