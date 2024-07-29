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
 
   
   
   <div class="row">
   

</div>	
      <div class="col-md-8">
	  
	  <i>Kết nối API lấy dữ liệu tracking trực tiếp từ TSCPOST.COM<i><br>
	  Your API key
	  <code><?php echo $datauser['api_key']?></code>
	  
	  <div class="card card-primary">
<div class="card-header">
<h4 class="card-title w-100">
<a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
Ví dụ kết nối mẫu lấy JSON
</a>
</h4>
</div>
<div id="collapseOne" class="collapse show" data-parent="#accordion">
<div class="card-body">Đường dẫn liên kết:
<div style="border:1px solid black;">
https://TSCPOST.com/get_tracking_api?idbill=<font color=red>2999912098</font>&apikey=<font color=red><?php echo $datauser['api_key'];?></font></div><br>
Thay đổi 2 biến GET theo<br>
<b>[apikey] = Mã API Key của bạn<br>
[idbill] = Mã BILL của bạn trên hệ thống SHIBAVN<br></b>
</div>
</div>
</div>	  



<div class="card card-primary">
<div class="card-header">
<h4 class="card-title w-100">
Dữ liệu JSON mẫu trả về

</h4>
</div>
<div id="collapseOne" class="collapse show" data-parent="#accordion">
<div class="card-body">

<blockquote>
<p>[<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-23 13:44:59&quot;,<br>
&quot;location&quot;:&quot;HO CHI MINH, VN&quot;,<br>
&quot;status&quot;:&quot;&#272;&atilde; t&#7841;o nh&atilde;n cho ki&#7879;n h&agrave;ng&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-23 17:52:37&quot;,<br>
&quot;location&quot;:&quot;HO CHI MINH, VN&quot;,<br>
&quot;status&quot;:&quot;Ki&#7879;n h&agrave;ng &#273;&atilde; &#273;&#432;&#7907;c nh&#7853;n b&#7903;i KSN&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-24 08:37:29&quot;,<br>
&quot;location&quot;:&quot;HO CHI MINH, VN&quot;,<br>
&quot;status&quot;:&quot;Origin customs processing&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-24 08:37:29&quot;,<br>
&quot;location&quot;:&quot;HO CHI MINH, VN&quot;,<br>
&quot;status&quot;:&quot;Transit&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-24 14:16:58&quot;,<br>
&quot;location&quot;:&quot;Connect with UPS&quot;,<br>
&quot;status&quot;:&quot;On forward for delivery&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-24 12:50:00&quot;,<br>
&quot;location&quot;:&quot;HOCHIMINH, VN&quot;,<br>
&quot;status&quot;:&quot;DEPARTED&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-24 17:15:00&quot;,<br>
&quot;location&quot;:&quot;TAOYUAN, CN&quot;,<br>
&quot;status&quot;:&quot;ARRIVED TRANSIT AIRPORT&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-25 09:00:00&quot;,<br>
&quot;location&quot;:&quot;TAOYUAN, CN&quot;,<br>
&quot;status&quot;:&quot;DEPARTED&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-25 18:41:00&quot;,<br>
&quot;location&quot;:&quot;LOS ANGELES, US&quot;,<br>
&quot;status&quot;:&quot;ARRIVED DESTINATION AIRPORT&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-25 19:42:00&quot;,<br>
&quot;location&quot;:&quot;LOS ANGELES, US&quot;,<br>
&quot;status&quot;:&quot;DESTINATION CUSTOMS PROCESSING &quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-27 11:36:00&quot;,<br>
&quot;location&quot;:&quot;LOS ANGELES, US&quot;,<br>
&quot;status&quot;:&quot;Destination Customs Released&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-23 00:08:23&quot;,<br>
&quot;location&quot;:&quot;US&quot;,<br>
&quot;status&quot;:&quot;Shipper created a label, UPS has not received the package yet.&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-29 17:13:20&quot;,<br>
&quot;location&quot;:&quot;Ontario,CA,US&quot;,<br>
&quot;status&quot;:&quot;Origin Scan&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-30 02:30:00&quot;,<br>
&quot;location&quot;:&quot;Ontario,CA,US&quot;,<br>
&quot;status&quot;:&quot;Departed from Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-30 06:38:00&quot;,<br>
&quot;location&quot;:&quot;Visalia,CA,US&quot;,<br>
&quot;status&quot;:&quot;Arrived at Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-30 09:17:00&quot;,<br>
&quot;location&quot;:&quot;Visalia,CA,US&quot;,<br>
&quot;status&quot;:&quot;Departed from Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-30 14:28:00&quot;,<br>
&quot;location&quot;:&quot;Lathrop,CA,US&quot;,<br>
&quot;status&quot;:&quot;Arrived at Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-30 22:54:00&quot;,<br>
&quot;location&quot;:&quot;Lathrop,CA,US&quot;,<br>
&quot;status&quot;:&quot;Departed from Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-10-30 23:55:00&quot;,<br>
&quot;location&quot;:&quot;Oakland,CA,US&quot;,<br>
&quot;status&quot;:&quot;Arrived at Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-11-01 00:57:00&quot;,<br>
&quot;location&quot;:&quot;Oakland,CA,US&quot;,<br>
&quot;status&quot;:&quot;Departed from Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-11-01 01:43:00&quot;,<br>
&quot;location&quot;:&quot;Concord,CA,US&quot;,<br>
&quot;status&quot;:&quot;Arrived at Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-11-01 06:20:53&quot;,<br>
&quot;location&quot;:&quot;Concord,CA,US&quot;,<br>
&quot;status&quot;:&quot;Processing at UPS Facility&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-11-01 07:12:05&quot;,<br>
&quot;location&quot;:&quot;Concord,CA,US&quot;,<br>
&quot;status&quot;:&quot;Loaded on Delivery Vehicle&quot;<br>
},<br>
{<br>
&quot;datetime&quot;:&quot;2023-11-01 12:41:13&quot;,<br>
&quot;location&quot;:&quot;BENICIA,CA,94510,US&quot;,<br>
&quot;status&quot;:&quot;Delivered&quot;<br>
}<br>
]</p>
</blockquote>
</div>
</div>
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