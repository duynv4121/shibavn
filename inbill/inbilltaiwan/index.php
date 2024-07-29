<?php
include("topfooter/top.php");

if($ss_type == '10')
{
		echo'<script>

			window.location.href = "indexvn.php";

		</script>';
}


?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Quản lý Hóa Đơn Hàng Mỹ về Việt Nam
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quản lý Hóa Đơn Hàng Mỹ về Việt Nam
</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box">
                <div class="box-header">
						
						<?php
						
													echo'<a href="scanbarcode.php"><button type="button" class="btn btn-primary"><i class="fa fa-barcode"></i> Scan In</button></a>&nbsp;';
																				echo' <a href="exportketoan.php" target="_blank"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="">Xuất Excel Kế Toán</button></a>';


				
							
						echo'<br>
						<form action="bookingus.php" method="GET">
						<div style="margin-top:5px;width:225px;height:100px;background-color:#FBF2EF;padding:20px;text-align:center;  border-style: dotted;
  border-color: green;">
						<input type="text" name="sdt" value=""  placeholder="Nhập số điện thoại khách" required> <input type="submit" value="Tạo Hóa Đơn" class="btn btn-success" style="margin-top:2px"></form>
						</div>
						
						
						';
						
						$date = date("m");
						$year = date("yy");
						$thutienthang = 0;
						$laydulieutongtiena = mysql_query("select * from gpe_listhoadonus where MONTH(date) = '$date' AND YEAR(date) = '$year' AND checktien='1'")or die("Loi");
						while($laydulieutongtien = mysql_fetch_array($laydulieutongtiena)){
							$thutienthang += $laydulieutongtien['gia'];
						}
													//echo "&nbsp;&nbsp;<b><center><font size=4>Tổng thu tháng  : <font color=green>".number_format($thutienthang).' đ</b></font></font>';

						$thieutienhang = 0;
						$laydulieutongtienthieua = mysql_query("select * from gpe_listhoadonus where MONTH(date) = '$date' AND YEAR(date) = '$year' AND checktien!='1'")or die("Loi");
						while($laydulieutongtienthieu = mysql_fetch_array($laydulieutongtienthieua)){
							$thieutienhang += $laydulieutongtienthieu['gia'];
						}
						
						?>
						
                </div><!-- /.box-header --><hr>
                <div class="box-body">
                  <table id="example1" class="table table-hover table-bordered table-striped" style="font-size:12px;" data-page-length='100'  data-order='[[0, "desc"], [ 1, "desc" ]]'>
                    <thead>
                      <tr>
                        <th style="text-align: center;">STT</th>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">Người gửi</th>
                        <th style="text-align: center;">Phone.Number</th>
                        <th style="text-align: center;">Người nhận</th>
                        <th style="text-align: center;">PCS</th>
                        <th style="text-align: center;">Ký</th>
                        <th style="text-align: center;">U.Price</th>
                        <th style="text-align: center;">Extra</th>
                        <th style="text-align: center;">Sale</th>
                        <th style="text-align: center;">Total</th>
                        <th style="text-align: center;">Trạng Thái</th>
                        <th style="text-align: center;">AWB</th>
					
						
						<th style="text-align: center;">Chức Năng</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					
					if($_SESSION['type'] == "1" || $_SESSION['username']=="ketoangiaphu" || $_SESSION['username']=="billhangmy")
					{
					$layhoadonadd= mysql_query("select * from gpe_listhoadonus ORDER BY id ASC");
					}
					else
					{
					$layhoadonadd= mysql_query("select * from gpe_listhoadonus where (id_usera='$id_user' or checkscan='$id_user') ORDER BY id ASC");
					}
					
					while($layhoadon = mysql_fetch_array($layhoadonadd))
						{	
						$idhoadon = $layhoadon['id'];
						//echo $layhoadon['date'];
						//mysql_query("UPDATE `gpe_nguoiguius` SET `date`='".$layhoadon['date']."' WHERE (`id_hoadon`='$idhoadon')")or die("Loi");
						$nguoiguiadd = mysql_fetch_assoc(mysql_query("select g_tennguoigui,g_dienthoai,g_diachi2 from gpe_nguoiguius where id_hoadon='$idhoadon'"));
						$nguoinhanadd = mysql_fetch_assoc(mysql_query("select n_tennguoinhan,n_quocgia,n_tennguoinhan2 from gpe_nguoinhanus where id_hoadon='$idhoadon'"));
						$tensale = mysql_fetch_assoc(mysql_query("select ten from gpe_sale where id='".$layhoadon['id_user']."'"));
						$id_user = $layhoadon['id_usera'];
						$dulieuuser = mysql_fetch_assoc(mysql_query("select * from gpe_user where id='$id_user'"));
			

						$idhoadonshow = $dulieuuser['congtyghitat'].$layhoadon['id'];

						
						
						
						$tensale = explode(' ', $tensale['ten']);
						$tensale = end($tensale);
						echo'<tr>
						
						<td style="text-align: center;">'.($layhoadon['id']-88880000).'</td>
						<td style="text-align: center;">'.$layhoadon['date'].'</td>
                        <td style="text-align: center;'; if($dulieuuser['congtyghitat'] != "IAH"){echo 'color:#770000;';} echo'"><b><a href="trackingsm.php?id='.$layhoadon['id'].'" style="text-align: center;'; if($dulieuuser['congtyghitat'] != "IAH"){echo 'color:#770000;';} echo'" target="_blank">'.$idhoadonshow.'</a></b></td>
                        <td style="text-align: center;">'.$nguoiguiadd['g_tennguoigui'].'</td>
                        <td style="text-align: center;"><a href="historykh.php?s='.$nguoiguiadd['g_dienthoai'].'">'.$nguoiguiadd['g_dienthoai'].'</a></td>
                        <td style="text-align: center;">'.$nguoinhanadd['n_tennguoinhan'].'</td>
                        <td style="text-align: center;"><b>'.$layhoadon['sokien'].'</b></td>
                       
                        <td style="text-align: center;"><b>'.$layhoadon['cannang'].'</b> lbs</td>
                        <td style="text-align: center;"><b>$'.$layhoadon['giadongia'].'</b></td>
                        <td style="text-align: center;"><b>$'.$layhoadon['giaphuthu'].'</b></td>
                        <td style="text-align: center;"><b>$'.$layhoadon['giasale'].'</b></td>
                        <td style="text-align: center;"><b>$'.round($layhoadon['gia']).'</b></td>
						<td style="text-align: center; "><b>';
						
						
						 if($layhoadon['vn_status'] != '')
						{
							if($layhoadon['vn_status'] == 0)
							{
								echo'<font color=orange>Pending</font>';
							}
							else if($layhoadon['vn_status'] == 1)
							{
								echo'<font color=blue>VN-Cargo</font>';
							}else if($layhoadon['vn_status'] == 2)
							{
								echo'<font color=blue>VN-Delivery</font>';
							}else if($layhoadon['vn_status'] == 3)
							{
								echo'<font color=blue>Successful</font>';
							}
						}
						else if($layhoadon['checkscanout'] != '')
						{
							echo'<font color=green>Exported</font>';
						}
						else if($layhoadon['checkscan'] == '')
						{
							echo'<font color=red>Checking</font>';
						}
						else
						{
							echo'<font color=orange>Received</font>';

						}
						echo'</td>
												<td style="text-align: center;"><b>'; 
												
												if($layhoadon['checkscanout'] != ''){echo $layhoadon['awb'];} 
												
												echo'</b></td>

						'
						
						;

					
						
						echo'
						<td style="text-align: right;white-space:nowrap;"> 
						
						';
						
						
						if($nguoinhanadd['n_tennguoinhan2'] != "" && $nguoiguiadd['g_diachi2'] != "")
						{
						echo'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalfake" data-whatever="'.$layhoadon['id'].'"><i class="fa fa-print"></i>
 L</button> ';
						}
						echo'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="'.$layhoadon['id'].'"><i class="fa fa-print"></i>
 L</button>';
 
 
 echo'
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalb" data-whatever="'.$layhoadon['id'].'"><i class="fa fa-print"></i>
 B</button>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalc" data-whatever="'.$layhoadon['id'].'"><i class="fa fa-print"></i>
 F</button>
						
						';
						
						
						echo'&nbsp;<a href="editus.php?id='.$layhoadon['id'].'" ><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> </button></a>';
						

						echo'&nbsp;<a target="_blank" href="inbillkhach/inbillkhachdl.php?id='.$layhoadon['id'].'"><button type="button" class="btn btn-success"><i class="fa fa-download"></i></button></a>
						';
						
						if($_SESSION['username'] == "tuyentong")
						{
						echo'&nbsp;<a href="checktien.php?id='.$layhoadon['id'].'"  onclick="return confirm(\'Chắc chắn đã nhận '.number_format($layhoadon['gia']).' từ '.$nguoiguiadd['g_tennguoigui'].' ?\')"><button type="button" class="btn btn-link">V</button></a>';
						}

						echo'

</td>
						
                      </tr>';
					  	

					  
						}
					?>
					
                      
                      
                    </tbody>
                    </tfoot>
                  </table>
				  <br><br><br><br>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		
		<!--Modal: Name-->
		

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">In hóa đơn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <iframe id="myFrame" name="frame" class="embed-responsive-item" src="" allowfullscreen width="550px" height="500px"></iframe>

      </div>
      <div class="modal-footer">		
        <button type="button" onclick="frames['frame'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalfake" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">In hóa đơn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <iframe id="myFramed" name="framed" class="embed-responsive-item" src="" allowfullscreen width="550px" height="500px"></iframe>

      </div>
      <div class="modal-footer">		
        <button type="button" onclick="frames['framed'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">In BILL Khách</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <iframe id="myFrameb" name="frameb" class="embed-responsive-item" src="" allowfullscreen width="550px" height="500px"></iframe>

      </div>
      <div class="modal-footer">		
        <button type="button" onclick="frames['frameb'].print()" class="btn btn-secondary" data-dismiss="modal">In Bill</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" width="100%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">In FORM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <iframe style="background-color: Snow;" id="myFramec" name="framec" class="embed-responsive-item" src="" allowfullscreen width="550px" height="500px"></iframe>

      </div>
      <div class="modal-footer">		
	          <button type="button" onclick="frames['framec'].print()" class="btn btn-secondary" data-dismiss="modal">In FORM</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exportExcel" tabindex="-1" role="dialog" aria-labelledby="exportExcel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xuất File Excel Kế Toán</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <iframe id="myFrame" name="frame" src="exportketoan.php" class="embed-responsive-item" src="" allowfullscreen width="550px" height="150px"></iframe>

      </div>
      <div class="modal-footer">		

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--
<div class="modal fade" id="exportExcel2" tabindex="-1" role="dialog" aria-labelledby="exportExcel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xuất File Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <iframe id="myFrame" name="frame" src="exportusm.php" class="embed-responsive-item" src="" allowfullscreen width="550px" height="150px"></iframe>

      </div>
      <div class="modal-footer">		

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
-->
<!--Modal: Name-->
		
      </div><!-- /.content-wrapper -->
      <?php
	  include("topfooter/footer.php");
	  ?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
	<!-- Latest compiled and minified CSS -->

    <!-- page script -->
    <script type="text/javascript">
	
	
		$(document).ready(function() {
       $('#example1').DataTable( {
        "dom": '<"top"fp>rt<"bottom"p><"clear">'
    });
 
		
      });
	  
	
	

	
	$('#exampleModal').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body input').val(recipient)
  $('#myFrame').attr('src', 'inbillus/inbill.php?id=' + recipient )

})
$('#exampleModalfake').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body input').val(recipient)
  $('#myFramed').attr('src', 'inbillusfake/inbill.php?id=' + recipient )

})
	$('#exampleModalb').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body input').val(recipient)
  $('#myFrameb').attr('src', 'inbillkhach/inbillkhach.php?id=' + recipient )

})
	$('#exampleModalc').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body input').val(recipient)
  $('#myFramec').attr('src', 'form/index.php?id=' + recipient )

})


    </script>

  </body>
</html>
