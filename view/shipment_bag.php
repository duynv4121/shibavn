<?php  

    include('top.php');

    $id_awb = $_GET['id'];
    $shipment = mysql_query("SELECT * FROM gpe_bagcode");
	
		if(isset($_POST['btn_submit']))  
		{
		@$checkbox1 = $_POST['chkl'] ;  

		for ($i=0; $i<sizeof ($checkbox1);$i++) { 
		$id_baga = $checkbox1[$i];
		mysql_query("UPDATE `gpe_bagcode` SET `awb`='$id_awb' WHERE (`id_bag`='$id_baga') ")or die("Loi");
		echo $id_baga.'<br>';
						
		}
		}
	
	
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> -->
      
   <div class="row">
      <div class="col-md-12">
         <h4 style="text-align:center;">Package already Scan in Bag | AWB : <?php echo $id_awb ?></h4>
		 <form method="POST" id="form1">
		 
		 
		 <button type="submit" name="btn_submit" class="btn btn-success">Transfer to Shipment</button>
		 <button type="submit" name="btn_submit" class="btn btn-success">Transfer to Shipment</button>

         <table id="example2" class="table " data-page-length='50'  data-order='[[0, "DESC"]]'>
            <thead style="color:blue">
               <tr>
                  <th style="text-align: center;color:#00a5e4"><input type="checkbox" onclick="selectAll()" /> All<br/>
</th>
                  <th style="text-align: center;color:#00a5e4">Date</th>
                  <th style="text-align: center;color:#00a5e4">ID_bag</th>
                  <th style="text-align: center;color:#00a5e4">ID Package</th>
        
               </tr>
            </thead>
            <tbody>

               <?php

               $getbagcode_shipment = mysql_query("SELECT * FROM gpe_bagcode WHERE (awb is NULl)");

               $bill = mysql_query("SELECT * FROM ns_listhoadon WHERE awb='".$shipment['awb']."'");
               $i = 0;
               while($item = mysql_fetch_array($getbagcode_shipment))
               {  
					
                  //$package = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package WHERE id='".$item['id_package']."'"));
                  //$sName = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  //$rName = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));

                  $i++;
                  echo '<tr>
                  <td style="text-align: center; color:black"><input type="checkbox" name="chkl[ ]" id="form1" value="'.$item['id_bag'].'" "></td>
                  <td style="text-align: center; color:black">'.$item['date'].'</td>
                  <td style="text-align: center; color:black">'.$item['id_bag'].'</td>
                  <td style="text-align: center; color:black">'.$item['id_listhoadon'].'</td>';
                
               

                  if ($roleid == 2 or $roleid == 1) {
                     echo '
                       
                     ';
                  }
                  
                  echo '</tr>';
               }
               ?>

            </tbody>
         </table>
		 </form>
      </div>
   </div>
</div>

<?php  
    include('footer.php');
?>
<script language="JavaScript">
function selectAll() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
     for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type == 'checkbox')
        checkboxes[i].checked = true;
     }
 }
</script>