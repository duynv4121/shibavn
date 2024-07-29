<?php  
	include('top.php');
	
	
	if(isset($_GET['updatelabel']))
	{
		include('labelau/update_label_auposte.php');

	}
	else
		
		{
	include('labelau/test.php');
		}
	
	
?>







<?php  
    include('footer.php');
?>

<script src="gd/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript">



	$('.select2bs4').select2({
      theme: 'bootstrap4'
    })
	$(document).ready(function() {
    $('#example3').DataTable( {
      "searching": trưe,  "ordering": true,    order: [0, 'desc'],
    } );
} );

</script>