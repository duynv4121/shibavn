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
	  
	  <i>SHIBAVN CREATE BILL API Documentation<i><br>
	  Your API key
	  <code><?php echo $datauser['api_key']?></code>
	  
	  <div class="card card-primary">
<div class="card-header">
<h4 class="card-title w-100">
<a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
Account verification</a>
</h4>
</div>
<div id="collapseOne" class="collapse show" data-parent="#accordion">
<div class="card-body">HTTP request header format example
<div style="border:1px solid black;">
Content-Type: application/json<br>
SHIBAVN-api-key: <?php echo $datauser['api_key']?><br>
<br></b>
</div>
</div>
</div>	  <div id="collapseOne" class="collapse show" data-parent="#accordion">
<div class="card-body">Request address
<div style="border:1px solid black;">
http://SHIBAVN-post.com/api/createbill<br>
<br></b>
</div>
</div>
</div>	  

</div>

<div class="card card-primary">
<div class="card-header">
<h4 class="card-title w-100">
Dữ liệu request DATA 1 KIỆN CON [POST]

</h4>
</div>
<div id="collapseOne" class="collapse show" data-parent="#accordion">
<div class="card-body">

<blockquote>
<p><p>{</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;brand&quot;: &quot;HCM&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;serviceType&quot;: &quot;KSN-US&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;addressLine1&quot;: &quot;123 New York&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;addressLine2&quot;: &quot;&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;addressLine3&quot;: &quot;&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;receiverCompany&quot;: &quot;YunYun Tech&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;receiverName&quot;: &quot;Truc Tran&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;city&quot;: &quot;Acton&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;state&quot;: &quot;TEXAS&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;postcode&quot;: &quot;70000000&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;phone&quot;: &quot;+84123123123&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;country&quot;: &quot;United States&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;description&quot;: &quot;Cosmetics&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;invoiceValue&quot;: &quot;100&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;referenceNo&quot;: &quot;TP1000011&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;orderItems&quot;: [</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;weight&quot;: &quot;20.5&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;length&quot;: &quot;20&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;width&quot;: &quot;30&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;height&quot;: &quot;40&quot;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; }</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ], &nbsp; &nbsp;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;reason&quot;: &quot;Gift (no commercial value)&quot;,</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &quot;Package_type&quot;: &quot;Box&quot;</p>
<p> }</p>
</blockquote>
</div>
</div>
</div>



<div class="card card-primary">
<div class="card-header">
<h4 class="card-title w-100">
Dữ liệu request DATA CHO NHIỀU KIỆN CON [POST] 

</h4>
</div>
<div id="collapseOne" class="collapse show" data-parent="#accordion">
<div class="card-body">
Thay đổi tại "OrderItems"
<blockquote>
<p id="isPasted">{</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"brand": "HCM",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"serviceType": "KSN-US",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"addressLine1": "123 New York",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"addressLine2": "",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"addressLine3": "",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"receiverCompany": "YunYun Tech",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"receiverName": "Truc Tran",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"city": "Acton",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"state": "TEXAS",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"postcode": "70000000",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"phone": "+84123123123",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"country": "United States",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"description": "Cosmetics",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"invoiceValue": "100",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"referenceNo": "TP1000011",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #ff0000;">&nbsp;&nbsp;</span></span><span style="color: #ff0000;">"orderItems": [</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;{</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"weight": "20.5",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"length": "20",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"width": "30",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"height": "40"</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;},</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;{</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"weight": "21.5",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"length": "10",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"width": "20",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"height": "30"</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;},</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;{</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"weight": "15.5",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"length": "20",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"width": "10",</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;"height": "20"</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;}</span></p>
<p><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;],&nbsp; &nbsp;&nbsp;</span></p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"reason": "Gift (no commercial value)",</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>"Package_type": "Box"</p>
<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>}</p>
</blockquote>
</div>
</div>
</div>




<div class="card card-primary">
<div class="card-header">
<h4 class="card-title w-100">
Return Success Message:

</h4>
</div>
<div id="collapseOne" class="collapse show" data-parent="#accordion">
<div class="card-body">
Bản mẫu trả về kết quả thành công và ID BILL nếu bạn gửi request data chính xác
<blockquote style="font-size:20px">
{<br>
   "company":"GREEN GLOBAL GROUP., JSC - 0109671091",<br>
   "country":"United States",<br>
   "serviceType":"KSN-US",<br>
   "status":"Create bill SHIBAVN Successful !",<br>
   "ID_SHIBAVN_BILL":"2999928060"<br>
}<br>
</blockquote>
</div>
</div>
</div>



<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>




<table class="table table-bordered">
<thead>
<tr>
<th style="width: 10px">Field</th>
<th>Is it required ?</th>
<th>Describe</th>
</tr>
</thead>
<tbody>
<tr>
<td>brand</td>
<td>YES</td>
<td>
Chi nhánh (HCM,HN,DAD)
</td>
<td><span class="badge bg-danger">string</span></td>
</tr>
<tr>
<td>serviceType</td>
<td>YES</td>
<td>
Tên Dịch vụ (KSN-US,KSN-EU,...)
</td>
<td><span class="badge bg-danger">string</span></td>
</tr>
<tr>
<td>addressLine1</td>
<td>YES</td>
<td>
Địa chỉ người nhận
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>addressLine2</td>
<td>NO</td>
<td>
Địa chỉ người nhận
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>addressLine3</td>
<td>NO</td>
<td>
Địa chỉ người nhận
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>receiverCompany</td>
<td>NO</td>
<td>
Công ty người nhận
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>receiverName</td>
<td>YES</td>
<td>
Tên người nhận
</td>
<td><span class="badge bg-danger">string</span></td>
</tr>
<tr>
<td>city</td>
<td>YES</td>
<td>
Tên thành phố chính xác
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>state</td>
<td>YES</td>
<td>
Tên tỉnh
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>postcode</td>
<td>YES</td>
<td>
Mã POST CODE của địa chỉ bạn gửi
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>phone</td>
<td>YES</td>
<td>
Số điện thoại người nhận
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>country</td>
<td>YES</td>
<td>
Tên quốc gia người nhận
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>description</td>
<td>YES</td>
<td>
Tên hàng hóa gửi
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>invoiceValue</td>
<td>YES</td>
<td>
Giá trị invoice value
</td>
<td><span class="badge bg-danger">string</span></td>
</tr>
<tr>
<td>referenceNo</td>
<td>NO</td>
<td>
Mã Ref bill từ FWD nhập nếu cần
</td>
<td><span class="badge bg-danger">string</span></td>
</tr>
<tr>
<td>weight</td>
<td>NO</td>
<td>
Cân nặng kiện hàng
</td>
<td><span class="badge bg-primary">float</span></td>
</tr>

<tr>
<td>length</td>
<td>YES</td>
<td>
Chiều dài kiện hàng
</td>
<td><span class="badge bg-primary">int</span></td>
</tr>
<tr>
<td>width</td>
<td>YES</td>
<td>
Chiều rộng kiện hàng
</td>
<td><span class="badge bg-primary">int</span></td>
</tr><tr>
<td>height</td>
<td>YES</td>
<td>
Chiều cao kiện hàng
</td>
<td><span class="badge bg-primary">int</span></td>
</tr>
<tr>
<td>reason</td>
<td>YES</td>
<td>
Lý do gửi hàng hóa [Mặc định Gift (no commercial value)]
</td>
<td><span class="badge bg-danger">string</span></td>
</tr><tr>
<td>Package_type</td>
<td>YES</td>
<td>
Phương thức đóng gói kiện hàng (BOX,Pcs,Carton,...)
</td>
<td><span class="badge bg-danger">string</span></td>
</tr>


</tbody>
</table>






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