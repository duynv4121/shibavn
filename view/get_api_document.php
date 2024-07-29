<?php  
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
	



?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
 
   
      <h2>SHIBAVN API DOCUMENT</h2><HR>

   <div class="row">
<div class="col-md-3 col-sm-6 col-12"><a href="get_api.php">

						<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fas fa-link"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">1.TRACKING TSC API</span>
						</div>

						</div>
						</a>

						</div><div class="col-md-3 col-sm-6 col-12"><a href="get_api_create_bill.php">

						<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fas fa-link"></i></span>
						<div class="info-box-content">
						<span class="info-box-text">2.CREATE BILL API</span>
						</div>

						</div>
						</a>
			
						</div>
</div>	
     
   </div>
</div>



<?php
if($roleid == 1 || $roleid == 4 || $roleid == 3|| $roleid == 5)
	{
		echo'<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create New </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form action="" method="POST">
			';
			
			
		
			echo'
			
			<div class="form-group">
					<label for="inputPassword3" class="control-label">Final DEST</label>
										<input type="text" name="dest" class="form-control" placeholder="Final DEST">

			</div>
			
			';
					echo'<div class="form-group">

				<label for="" class="control-label">Brand</label>
					<select required class="form-control" name="kg_chinhanh" id="">';
					
							echo '<option value="SGN" selected>SGN</option>';
							echo '<option value="HAN">HAN</option>';
							echo '<option value="DAD">DAD</option>';
			
					echo'</select>
				</div>';
			echo'<br><div class="form-group">
			
			<label for="inputPassword3" class="control-label">Number of Bag</label>
										<input type="number" name="count" class="form-control" placeholder="" value="1">
			<br><br>
			<br><button type="submit" name="btn_create" class="btn btn-danger">Create New</button>
			</form>
           <hr>
		   
		   
		   
          </div>
		  
		 
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  </div>';
	}
?>



<?php  
    include('footer.php');
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
   $('#modalInScanPackage').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget); 
       var recipient = button.data('whatever');
       var modal = $(this);
       $('#exampleModalLabelFake').val(recipient);
       modal.find('.modal-body input').val(recipient)
       $('#myFramed').attr('src', '../inbill/inscanpackage/inscanpakage.php?id=' + recipient );

   })
   $(function() {
      // customercode-dropdown
      $.ajax({
        url: '../controller/ajax.php',
        type: 'POST',
        data: {
          action: 'getCustomerName'
        },
        cache: false,
        success: function(result){
          $("#customercode-dropdown").html(result);
        }
      })
   });

  
   
	$(document).ready(function() {
    $('#example').DataTable( {
		  "pageLength": 50
,
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
            targets:   0
        } ],
  "ordering": false
    } );
} );



</script>


<script>	$('#wrongpass').ready(function() {

      $(document).Toasts('create', {
		class: 'bg-success',
        title: 'SHIBAVN Express',
        autohide: true,
        delay: 5000,
        body: 'Create bill successful! Thank you for supporting our service'
      })} );
</script>