<?php  
	include('top.php');
	
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-4">
				<h5>Update Kerry</h5>
				<hr>
			
	         
				 <?php
					for($i=40455649801;$i<=40455654800;$i++)
					{
						echo $i.'<br>';
						mysqli_query($conn,"INSERT INTO `code_kerry` (`code`) VALUES ('".$i."')");
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