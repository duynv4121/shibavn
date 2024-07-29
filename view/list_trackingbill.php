<?php  
    include('top.php');
    include('modals.php');
    loadModalScanPackage();
    if (isset($_POST['btn_create'])) {
		
		$id_code = $_POST['id_code'];
		$billketnoi = $_POST['billketnoi'];
		$hangketnoi = $_POST['hangketnoi'];
				$checktontai = mysqli_fetch_array(mysqli_query($conn,"select * from ns_listhoadon where id_code='$id_code'"));
			

		mysqli_query($conn,"UPDATE `ns_listhoadon` SET `billketnoi`='$billketnoi', `hangketnoi`='$hangketnoi' WHERE (`id_code`='$id_code')");
		
		   echo'<script> 
            window.location.href="list_trackingbill.php";
        </script>';
				
    }
	
	
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 
   <form action="" method="POST">

      
   </form>
   
   
   <div class="row">
		
		
		<div class="col-md-12">

 <?php
		 if(isset($_GET['day_start']))
		 {
			 $day_start = $_GET['day_start'];
			 $day_end = $_GET['day_end'];
		 }
		 else
		 {
			
			 $day_start = date('Y-m-d', strtotime("-7 days"));;
			 
			 $day_end = date('Y-m-d', strtotime("+7 days"));
		 }
		 

		 ?>
		 
		
		<?php
         
			?>

   
   <?php 
		
			?>

</div>	

		
		
		
		
		
         <div class="col-md-9"></div>
		 <div class="col-md-3">
      <?php
		if($roleid != 5 )
		{
			echo'	  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default"><i class="fas fa-map-pin"></i>  UPDATE TRACKING         </button>
     ';           

		}
		?>
	  
		
		</div>
   
   </div>
   <div class="row">
		
		
		
      <div class="col-md-6">
			
		


			
			
			
		<table id="example" class="border display nowrap" style="width:100%">
            <thead style="color:blue">
               <tr>
                  <th style="text-align: center;color:#9f7d48">ID</th>                  
                  <th style="text-align: center;color:#9f7d48">ID</th>                  
                  <th style="text-align: center;color:#9f7d48">Mã bill nội bộ</th>                  
				  <th style="text-align: center;color:#9f7d48">Mã bill kết nối</th>
				  <th style="text-align: center;color:#9f7d48">Mã hãng kết nối</th>
				  <th style="text-align: center;color:#9f7d48">Tính năng</th>
			
               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 5|| $roleid == 4) {
                  $data = mysqli_query($conn,"SELECT * FROM ns_listhoadon ORDER by id DESC ");
               }else{
               }
               
			   
			
			   
			   
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
                 

                  $i++;
                  echo '<tr>
				  <td style="text-align: center; color:black"></td>
			
				  <td style="text-align: center; color:black">'.($item['id']).'</td>
				  <td style="text-align: center; color:black"><a href="'.$tracking_url.''.($item['id_code']).'">'.($item['id_code']).'<a></td>
				  <td style="text-align: center; color:black">'.($item['billketnoi']).'</td>
				  <td style="text-align: center; color:black">'.($item['hangketnoi']).'</td>
				  <td style="text-align: center; color:black"><a href="tracking_bill.php?id='.$item['id_code'].'">Thêm Tracking</a></td>
				
				  ';
				  
				 
				 
				  
				  echo'

                  </tr>';
               }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
      </div>
   </div>
   <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Thêm Tracking hệ thống SHIBAEXPRESS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			
			
			<form action="" method="POST">
			
    
			 <div class="form-group">
                  <label>Mã bill nội bộ</label>
                        <input type="text" name="id_code" required class="form-control " placeholder="Example: SHIB20302323"/>
                        
             </div>
			 <div class="form-group">
                  <label>Mã bill đối tác</label>
                        <input type="text" name="billketnoi" required class="form-control " />
                        
             </div>
			 <div class="form-group">
                  <label>Mã hãng đối tác (Xem tại doccument hướng dẫn)</label>
                        <input type="text" name="hangketnoi" required class="form-control " />
                        
             </div>
			 
		
				
				
				
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="btn_create" class="btn btn-danger" >Thêm Tracking</button></form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</div>

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
		  "pageLength": 100
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
        order: [ 1, 'desc' ],    stateSave: true,
    "bDestroy": true

    } );
} );



</script>
