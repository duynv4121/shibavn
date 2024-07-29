<?php
include("topfooter/top.php");




?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản Lý Hóa Đơn hàng Mỹ & Nước khác
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quản lý hóa đơn hàng Mỹ & Nước khác</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box">
                <div class="box-header">
						<a href="bookingus.php"><button type="button" class="btn btn-primary">Tạo Hóa Đơn</button></a>
						
						<?php
						if($_SESSION['type'] == "1" )
						{
							echo'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exportExcel">Xuất Excel</button>';
						}
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
																		//	echo "<b>&nbsp|&nbsp<font size=4>Tổng thiếu tháng  : <font color=red>".number_format($thieutienhang).' đ</b></font></font>';

						
						
						?>
						
                </div><!-- /.box-header --><hr>
                <div class="box-body">
                  <table id="example1" class="table table-hover table-bordered table-striped" data-page-length='100'  data-order='[[1, "desc"]]'>
                    <thead>
                      <tr>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">Người gửi</th>
                        <th style="text-align: center;">Người nhận</th>
                        <th style="text-align: center;">PCS</th>
                        <th style="text-align: center;">Ký</th>
                        <th style="text-align: center;">Quốc Gia</th>
                        <th style="text-align: center;">Giá</th>
						<th style="text-align: center;">Tên Sale</th>
						<th style="text-align: center;">Kết Nối</th>
                        <th style="text-align: center;">Chức Năng</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					
					if($_SESSION['type'] == "1")
					{
					$layhoadonadd= mysql_query("select * from gpe_listhoadonus ORDER BY id ASC");
					}
					else
					{
					$layhoadonadd= mysql_query("select * from gpe_listhoadonus where id_user='$id_user' ORDER BY id ASC");
					}
					
					while($layhoadon = mysql_fetch_array($layhoadonadd))
						{	
						$idhoadon = $layhoadon['id'];
						//echo $layhoadon['date'];
						//mysql_query("UPDATE `gpe_nguoiguius` SET `date`='".$layhoadon['date']."' WHERE (`id_hoadon`='$idhoadon')")or die("Loi");
						$nguoiguiadd = mysql_fetch_assoc(mysql_query("select g_tennguoigui from gpe_nguoiguius where id_hoadon='$idhoadon'"));
						$nguoinhanadd = mysql_fetch_assoc(mysql_query("select n_tennguoinhan,n_quocgia from gpe_nguoinhanus where id_hoadon='$idhoadon'"));
						$tensale = mysql_fetch_assoc(mysql_query("select ten from gpe_sale where id='".$layhoadon['id_user']."'"));
						
						$tensale = explode(' ', $tensale['ten']);
						$tensale = end($tensale);
						echo'<tr>
						
						<td style="text-align: center;">'.$layhoadon['date'].'</td>
                        <td style="text-align: center;">'.$layhoadon['id'].'</td>
                        <td style="text-align: center;">'.$nguoiguiadd['g_tennguoigui'].'</td>
                        <td style="text-align: center;">'.$nguoinhanadd['n_tennguoinhan'].'</td>
                        <td style="text-align: center;"><b>'.$layhoadon['sokien'].'</td>
                        <td style="text-align: center;"><b>'.$layhoadon['cannang'].'</td>
						<td style="text-align: center;"> '.$nguoinhanadd['n_quocgia'].'</td>

						<td style="text-align: right;">
						
						';
						if($layhoadon['checktien'] == 1){
							echo'<font color=green>';
						}else
						{							
							echo'<font color=red>';
						}
						echo''. number_format($layhoadon['gia']).' đ</td>
                        <td style="text-align: center;">'.$tensale.'</td>
                        <td style="text-align: center;">'.$layhoadon['doitac'].'</td>

                        <td style="text-align: center;"> 
						
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="'.$layhoadon['id'].'">In Bill</button>';
						
						
						echo'&nbsp;<a href="editus.php?id='.$layhoadon['id'].'"><button type="button" class="btn btn-info">Edit</button></a>';
						

						echo'&nbsp;<a target="_blank" href="trackingdhl.php?id='.$layhoadon['id'].'"><button type="button" class="btn btn-success">Tracking</button></a>
						';
												echo'&nbsp;<a href="checktien.php?id='.$layhoadon['id'].'"  onclick="return confirm(\'Chắc chắn đã nhận '.number_format($layhoadon['gia']).' từ '.$nguoiguiadd['g_tennguoigui'].' ?\')"><button type="button" class="btn btn-link">V</button></a>';

						
						
						echo'

</td>
						
                      </tr>';
					  	

					  
						}
					?>
					
                      
                      
                    </tbody>
                    </tfoot>
                  </table>
				  
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


<div class="modal fade" id="exportExcel" tabindex="-1" role="dialog" aria-labelledby="exportExcel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xuất File Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <iframe id="myFrame" name="frame" src="export.php" class="embed-responsive-item" src="" allowfullscreen width="550px" height="150px"></iframe>

      </div>
      <div class="modal-footer">		

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
	
	
      $(function () {
        $("#example1").dataTable()({
         
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
    </script>

  </body>
</html>
