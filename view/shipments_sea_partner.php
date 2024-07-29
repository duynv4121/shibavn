<?php  
    include('top.php');
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> -->
   <!-- <form action="" method="POST">
      <div class="row">
         <div class="col-xs-3">
            <div class="input-group date mr-2">
               <div class="form-group ">
                  <input placeholder="Tháng" name="datefrom" type="text" class="form-control" id="datepicker1">
               </div>
            </div>
         </div>
         <div class="col-xs-3">
            <button type="submit" name="btn_loc" class="btn btn-info"><i class="fas fa-filter"></i> Lọc</button>
         </div>
      </div>
      
   </form> -->

   
   <div class="row">
      <?php  
         echo '
            <div class="col-xs-3 mb-3 mr-2">
               <a href="scanin_partner_sea.php" class="btn btn-secondary ">
                  Scan in
               </a>
            </div>

            <div class="col-xs-3 mb-3">
               <a href="scangiao_partner_sea.php" class="btn btn-warning ">
                  Scan delivery
               </a>
            </div>
         ';
      ?>
      
      <div class="col-md-12">
         <table id="example2" class="table table-hover table-bordered table-striped" data-page-length='50'  data-order='[[0, "asc"]]'>
            <thead style="color:blue">
               <tr>
                  <th style="text-align: center;color:#00a5e4">NO</th>
                  <th style="text-align: center;color:#00a5e4">Date</th>
                  <th style="text-align: center;color:#00a5e4">AWB</th>
                  <th style="text-align: center;color:#00a5e4">Partner</th>
                  <th style="text-align: center;color:#00a5e4">Total weight</th>
                  <th style="text-align: center;color:#00a5e4"></th>
               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 or $roleid == 2) {
                   $data = mysql_query("SELECT * FROM ns_shipment_sea ");
               }else{
                  $data = mysql_query("SELECT * FROM ns_shipment_sea WHERE id_doitac='$uid'");
               }
               
               $i = 0;
               while($item = mysql_fetch_array($data))
               {  
                  $partner = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_user WHERE id = '".$item['id_doitac']."'"));
                  $totalcannang = mysql_fetch_assoc(mysql_query("SELECT SUM(cannang) as w FROM ns_listhoadon_sea WHERE awb ='".$item['awb']."'"));
                  $i++;
                  echo '<tr>
                  <td style="text-align: center; color:black">'.$i.'</td>
                  <td style="text-align: center; color:black">'.$item['date_time'].'</td>
                  <td style="text-align: center; color:black">'.$item['awb'].'</td>
                  <td style="text-align: center; color:black">'.$partner['ctyghitat'].'</td>
                  <td style="text-align: center; color:black">'.$totalcannang['w'].'</td>
                  <td>';
                    
                  echo'<a href="viewbillinshipment_sea.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="far fa-eye"></i></a>
                  </td>
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