<?php
include("topfooter/top.php");
?>
<!--main content start-->
<section id="main-content" style="background-color:white">
	<section class="wrapper">
		<!-- //market-->
		
			<!-- tasks -->
		
		<!-- //tasks -->
		<div class="agileits-w3layouts-stats"  style="min-height:800px">
					<div class="col-md-12 stats-info widget">
						<div class="box">
                <div class="box-header">
						
						<?php
						echo'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exportExcel">Xuất Excel</button> ';

						
						
						if($_SESSION['type'] == "4" )
						{
							echo'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exportExcel">Xuất Excel</button>';
						
						$date = date("m");
						$year = date("Y");
						$thutienthang = 0;
						$laydulieutongtiena = mysql_query("select * from gpe_listhoadonus where MONTH(date) = '$date' AND YEAR(date) = '$year' AND checktien='1'")or die("Loi");
						while($laydulieutongtien = mysql_fetch_array($laydulieutongtiena)){
							$thutienthang += $laydulieutongtien['gia'];
						}
													echo "&nbsp;&nbsp;<b><center><font size=4>Tổng thu tháng  : <font color=green>".number_format($thutienthang).' đ</b></font></font>';

						$thieutienhang = 0;
						$laydulieutongtienthieua = mysql_query("select * from gpe_listhoadonus where MONTH(date) = '$date' AND YEAR(date) = '$year' AND checktien!='1'")or die("Loi");
						while($laydulieutongtienthieu = mysql_fetch_array($laydulieutongtienthieua)){
							$thieutienhang += $laydulieutongtienthieu['gia'];
						}
												
												echo "<b>&nbsp|&nbsp<font size=4>Tổng thiếu tháng  : <font color=red>".number_format($thieutienhang).' đ</b></font></font>';
						}				
									
						
						?>
						
                </div><!-- /.box-header --><hr>
                <div class="box-body">
                  <table id="example1" class="table table-hover table-bordered table-striped" style="font-size:12px" data-page-length='100'  data-order='[[1, "desc"]]'>
                    <thead style="color:#FF8000">
                      <tr>
                        <th style="text-align: center;color:#000000;width:100px">Date</th>
                        <th style="text-align: center;color:#000000">ID Online</th>
                        <th style="text-align: center;color:#000000">ID Giấy</th>
                        <th style="text-align: center;color:#000000">ID Hãng</th>
                        <th style="text-align: center;color:#000000">Người tiếp nhận</th>
                        <th style="text-align: center;color:#000000">Sales</th>
                        <th style="text-align: center;color:#000000">Tên khách hàng</th>
                        <th style="text-align: center;color:#000000">Nước đến</th>
                        <th style="text-align: center;color:#000000">Dịch Vụ</th>
						<th style="text-align: center;color:#000000">Số kiện</th>
                        <th style="text-align: center;color:#000000">Weight KH</th>
                        <th style="text-align: center;color:#000000">Weight</th>
                        <th style="text-align: center;color:#000000">Reweight</th>
                        <th style="text-align: center;color:#000000">Giá bán</th>
                        <?php
                        if(strtolower($_SESSION['username']) == "ketoan2" )
						{
						}
						else
						{
							echo'<th style="text-align: center;color:#000000">Giá mua</th>';
						}
                        ?>
                        <th style="text-align: center;color:#000000">Đã thanh toán</th>
                        <th style="text-align: center;color:#000000">Nợ</th>
                     
                        <th style="text-align: center;"></th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php
					
					if($_SESSION['type'] == "1" || $_SESSION['type'] == "3")
					{
					$layhoadonadd= mysql_query("select * from gpe_listhoadonus ORDER BY id DESC LIMIT 2000");
					}
					else
					{

					}
					
					while($layhoadon = mysql_fetch_array($layhoadonadd))
						{	
						$idhoadon = $layhoadon['id'];
						//echo $layhoadon['date'];
						//mysql_query("UPDATE `gpe_nguoiguius` SET `date`='".$layhoadon['date']."' WHERE (`id_hoadon`='$idhoadon')")or die("Loi");
						$nguoiguiadd = mysql_fetch_assoc(mysql_query("select g_tennguoigui from gpe_nguoiguius where id_hoadon='$idhoadon'"));
						$nguoinhanadd = mysql_fetch_assoc(mysql_query("select n_tennguoinhan,n_quocgia from gpe_nguoinhanus where id_hoadon='$idhoadon'"));
						$tensale = mysql_fetch_assoc(mysql_query("select ten from gpe_sale where id='".$layhoadon['tensale']."'"));
						$tenuser = mysql_fetch_assoc(mysql_query("select ten from gpe_user where id='".$layhoadon['id_user']."'"));

						$tensale = explode(' ', $tensale['ten']);
						$tensale = end($tensale);
							echo'<tr style="';
						if($layhoadon['status'] == "Đã phát")
						{
							echo'background-color:#A9F5A9;color:green';
						}
						else if($layhoadon['status'] == "Hải quan giữ kiểm"){
							echo'background-color:#F5A9F2;color:red';

						}else if($layhoadon['status'] == "Phát không thành công"){
							echo'background-color:#F3F781;color:red';

						}
						echo'">
						
						<td style="text-align: center; color:black">'.$layhoadon['date'].'</td>
                        <td style="text-align: center; color:black"><a target="_blank" href="trackingdhl.php?id='.$layhoadon['id'].'">AV'.$layhoadon['id'].'</a>';
						
						if($_SESSION['type'] == "3" )
						{
						echo'&nbsp;<a href="checktien.php?id='.$layhoadon['id'].'"  onclick="return confirm(\'Chắc chắn đã nhận '.number_format($layhoadon['gia']).' từ '.$nguoiguiadd['g_tennguoigui'].' ?\')"><span>&#10003;</span>
</a>';
						}
						
						echo'</td>
                        <td style="text-align: center; color:black">'.$layhoadon['billketnoi'].'</td>
                        <td style="text-align: center; color:black">'.$layhoadon['billdhl'].'</td>
                        <td style="text-align: center; color:black">'.$tenuser['ten'].'</td>
                        <td style="text-align: center; color:black">'.$tensale.'</td>
                        <td style="text-align: center; color:black">';
						if($layhoadon['tenkhachhang'] == "")
						{
							echo $nguoiguiadd['g_tennguoigui'];
						}
						else
						{
							echo $layhoadon['tenkhachhang'];
						}
						echo'</td>
						<td style="text-align: center; color:black"> '.$nguoinhanadd['n_quocgia'].'</td>
						<td style="text-align: center; color:black">'.$layhoadon['doitac'].'</td>
						<td style="text-align: center; color:black"><b>'.$layhoadon['sokien'].'</td>
                        <td style="text-align: center; color:black"><b>'.$layhoadon['khcannang'].'</td>
                        <td style="text-align: center; color:black"><b>'.$layhoadon['cannang'].'</td>
                        <td style="text-align: center; color:black"><b>'.$layhoadon['reweight'].'</td>
                        <td style="text-align: center; color:#FA5858"><b>'.number_format($layhoadon['gia']).'</td>';
						
						
                        if(strtolower($_SESSION['username']) == "ketoan2" )
						{
						}
						else
						{
							echo' <td style="text-align: center; color:#FA5858"><b>'.number_format($layhoadon['giamua']).'</td>';
						}
                        echo'<td style="text-align: center; color:green"><b>'.number_format($layhoadon['dathanhtoan']).'</td>
                        <td style="text-align: center; color:red"><b>'.number_format(($layhoadon['gia'] - $layhoadon['dathanhtoan'])).'</td>
                        <td style="text-align: center;"> 
						
					
						';
						
						
						echo'&nbsp;<a href="updateketoan.php?id='.$layhoadon['id'].'" target="_blank"><button type="button" class="btn btn-info">UPDATE</button></a>';
						

						echo'
						';
						
						
						
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
			  
			  
			  
					</div>
					<div class="clearfix"> </div>
				</div>
				
				

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


<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">In hóa đơn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body2">
          <iframe id="myFrame2" name="frame2" class="embed-responsive-item" src="" allowfullscreen width="550px" height="500px"></iframe>

      </div>
      <div class="modal-footer">		
        <button type="button" onclick="frames['frame2'].print()" class="btn btn-secondary" data-dismiss="modala">In Bill</button>
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
          <iframe id="myFrame" name="frame" src="exportlisttong.php" class="embed-responsive-item" src="" allowfullscreen width="550px" height="150px"></iframe>

      </div>
      <div class="modal-footer">		

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        </section><!-- /.content -->

<?php
include("topfooter/footer.php");
?>
<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
	<!-- //calendar -->
<script>
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
  $('#myFrame').attr('src', 'in/inbill.php?id=' + recipient )

})  

	$('#exampleModal2').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modala = $(this)
  modala.find('.modal-body2 input').val(recipient)
  $('#myFrame2').attr('src', 'in/iniv.php?id=' + recipient )

})
</script>
</body>
</html>
