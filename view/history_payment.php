<?php  
	include('top.php');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			 <h3 style="text-align:center;">Lịch sử thanh toán</h3>

			 <table id="example2" class="table table-hover table-bordered table-striped" data-page-length='50'  data-order='[[0, "desc"]]'>
	            <thead style="color:blue">
	               <tr>
	                  <th style="text-align: center;color:#00a5e4">Date</th>
	                  <th style="text-align: center;color:#00a5e4">ID</th>
	                  <th style="text-align: center;color:#00a5e4">Người gửi</th>
	                  <th style="text-align: center;color:#00a5e4">Người nhận</th>
	                  <th style="text-align: center;color:#00a5e4">Kiện nhỏ</th>
	                  <th style="text-align: center;color:#00a5e4">Loại</th>
	                  <th style="text-align: center;color:#00a5e4">Trạng thái</th>
	               </tr>
	            </thead>
	            <tbody>

	               <?php
	               
	               $data = mysql_query("SELECT * FROM ns_package WHERE payment is NOT NULL") or die(mysql_error());
            
	               while($item = mysql_fetch_array($data))
	               {  
	                  // $package = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package WHERE id='".$item['id_package']."'"));
	                  $sName = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id ='".$item['id_nguoigui']."'"));
	                  $rName = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id ='".$item['id_nguoinhan']."'"));
	                  // $count = mysql_num_rows(mysql_query("SELECT id FROM ns_listhoadon WHERE id_package = '".$item['id']."'"));
	                  // <td style="text-align: center; color:black">'.$sName['name'].'</td>
	                  // <td style="text-align: center; color:black">'.$rName['name'].'</td>
	                  echo '<tr>
	                  <td style="text-align: center; color:black">'.$item['date'].'</td>
	                  <td style="text-align: center; color:black">'.$item['id'].'</td>
	                  
	                  <td style="text-align: center; color:black">'.$sName['name'].'</td>
	                  <td style="text-align: center; color:black">'.$rName['name'].'</td>
	                  <td style="text-align: center; color:black">';
	                  $sub = mysql_query("SELECT * FROM ns_listhoadon WHERE id_package = '".$item['id']."'"); 
	                  while ($s = mysql_fetch_array($sub)) {
	                     echo '- ID: '.$s['id'].' | Cân nặng: '.$s['cannang'].'<br>';
	                  }

	                  echo '</td>';
	                  echo '<td>AIR</td>';
	                  echo '<td>';
	                  
	                  echo '<font color="green">Đã thanh toán đủ</font>';
	                  
	                  echo '</td>
	                  </tr>';
	               }

	               //
	               $data1 = mysql_query("SELECT * FROM ns_package_sea WHERE payment is NOT NULL") or die(mysql_error());
	               
	               while($item = mysql_fetch_array($data1))
	               {  
	                  // $package = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package WHERE id='".$item['id_package']."'"));
	                  $sName = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id ='".$item['id_nguoigui']."'"));
	                  $rName = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id ='".$item['id_nguoinhan']."'"));
	                  // $count = mysql_num_rows(mysql_query("SELECT id FROM ns_listhoadon WHERE id_package = '".$item['id']."'"));
	                  // <td style="text-align: center; color:black">'.$sName['name'].'</td>
	                  // <td style="text-align: center; color:black">'.$rName['name'].'</td>
	                  echo '<tr>
	                  <td style="text-align: center; color:black">'.$item['date'].'</td>
	                  <td style="text-align: center; color:black">'.$item['id'].'</td>
	                  
	                  <td style="text-align: center; color:black">'.$sName['name'].'</td>
	                  <td style="text-align: center; color:black">'.$rName['name'].'</td>
	                  <td style="text-align: center; color:black">';
	                  $sub = mysql_query("SELECT * FROM ns_listhoadon_sea WHERE id_package = '".$item['id']."'"); 
	                  while ($s = mysql_fetch_array($sub)) {
	                     echo '- ID: '.$s['id'].' | Cân nặng: '.$s['cannang'].'<br>';
	                  }

	                  echo '</td>';
	                  echo '<td>SEA</td>';
	                  echo '<td>';
	                  
	                  echo '<font color="green">Đã thanh toán đủ</font>';
	                  
	                  echo '</td>
	                  </tr>';
	               }
	               ?>

	            </tbody>
	         </table>
		</div>
	</div>
	
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