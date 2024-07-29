<?php  
    include('top.php');
    $id = $_GET['id'];
    
	
	
	if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
			
			function roundUp($number, $nearest){
			return $number + ($nearest - fmod($number, $nearest));
			}
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            $date = date('Y-m-d');
			$datenow2 = date('Y-m-d H:i:s');
			$status = 1;
			$note = 1;
			$pcs = 1;
			echo'Đang cập nhật vui lòng chờ ...<br>';
			$i = 0;
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
				
				
				$i++;
                // Get row data
                $id_code   = trim($line[0]);
                $billketnoi   = trim($line[1]);
           
				
				
				###
				
				$id_tracking = $billketnoi;
				$url = 'http://kango-post.com/view/tracking/test.php?id='.$id_tracking;
				$jsona =file_get_contents($url);
				
				$jsonb = trim($jsona,"1");
				
				$arr = json_decode($jsonb, true);
				
				foreach($arr['data'] as $result) {
			
				$tenhang = $result['name'];
				$tencode = $result['code'];
				if($result['code'] == 'yunda')
				{
					$tenhang = 'TOLL Global';
					$tencode = 'toll';
				}if($result['code'] == 'dpd')
				{
					$tenhang = 'DPD UK';
					$tencode = 'dpd-uk';
				}
				if($result['code'] == 'dhl-germany')
				{
					$tenhang = 'New Zealand Post';
					$tencode = 'new-zealand-post';
				}
				
				$status = 'On forward for delivery';
				$address = 'Connect with '.$tenhang;
				//mysqli_query($conn,"INSERT INTO `ns_tracking_bill` (`id_hoadon`, `date`, `address`,`status`)VALUES ('$id_code','$datenow2', '$address','$status')") or die(mysqli_error());
				mysqli_query($conn,"UPDATE `ns_listhoadon` SET `billketnoi`='$id_tracking', `hangketnoi`='$tencode' WHERE (`id_code`='$id_code')")or die(mysql_error());
				echo 'Cập nhật thành công'.$i.'.'.$id_code.'-'.$billketnoi.'<br>' ;

				
				
				
				$url = 'https://api.tracktry.com/v1/trackings/post';

				// Create a new cURL resource
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				// Setup request to send json via POST
				$dataa = array(
					"tracking_number" => $id_tracking,
					"carrier_code"=> $tencode
				);
				$payload = json_encode($dataa);





				// Attach encoded JSON string to the POST fields
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

				// Set the content type to application/json
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
				'Tracktry-Api-Key: 85b48be2-80ea-4262-be38-5112c844715e'));


				// Return response instead of outputting

				// Execute the POST request
				$resultc = curl_exec($ch);

				// Close cURL resource
				curl_close($ch);
				
				
				break;
				}
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
            }

            // Close opened CSV file
					fclose($csvFile);
						/*
						echo'<script> 
					   alert("Cập nhật tracking thành công !");
						window.location = "viewbillinshipment.php?id='.$_GET['id'].'";
					  </script>';*/
					  
					}else{
            echo'abc';;
        }
    }else{
            echo'abcd';;
    }
}




if(isset($_POST['importSubmit2'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
			
			function roundUp($number, $nearest){
			return $number + ($nearest - fmod($number, $nearest));
			}
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            $date = date('Y-m-d');
			$datenow2 = date('Y-m-d H:i:s');
			$status = 1;
			$note = 1;
			$pcs = 1;
			echo'Đang cập nhật vui lòng chờ ...<br>';
			$i = 0;
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
				
				
				$i++;
                // Get row data
                $id_code   = trim($line[0]);
                $billketnoi   = trim($line[1]);
           
				mysqli_query($conn,"UPDATE `ns_listhoadon` SET `billketnoi`='$billketnoi', `hangketnoi`='dubai-uae' WHERE (`id_code`='$id_code')")or die(mysql_error());
				echo 'Cập nhật thành công'.$i.'.'.$id_code.'-'.$billketnoi.'<br>' ;

				

				
				
				
				
				
				
				
				
				
				
				
            }

            // Close opened CSV file
					fclose($csvFile);
						/*
						echo'<script> 
					   alert("Cập nhật tracking thành công !");
						window.location = "viewbillinshipment.php?id='.$_GET['id'].'";
					  </script>';*/
					  
					}else{
            echo'abc';;
        }
    }else{
            echo'abcd';;
    }
}
	
	
	$shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_shipment WHERE id = '$id' "));
    $dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_dichvu WHERE id = '".$shipment['kg_dichvu']."' "));
	
	
	
	
	
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> -->
      
   <div class="row">
      <div class="col-md-12">
	   <div class="col-md-12" id="importFrm" style="background-color:#EEEEEE;padding:10px">
		<a href="./labelau/csv-tracking.zip">CSV IMPORT SAMPLE</a>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-danger" name="importSubmit" value="Cập nhật mã tracking">
        </form>
	
		<hr>
		
		  <h4 style="text-align:center;">Shipment #<?php echo $shipment['awb'] ?></h4><center>Dịch Vụ: <?php echo $dulieudichvu['dichvu'];?><br>
		
		</div>
	  
       

         <table id="example2" class="table table-bordered" data-page-length='50' style="font-size:13px" data-order='[[0, "DESC"]]' width=100%>
            <thead style="background-color:blue;color:white">
               <tr>
                  <th style="text-align: center;color:#FFFFFF">NO</th>
                  <th style="text-align: center;color:#FFFFFF">Date</th>
                  <th style="text-align: center;color:#FFFFFF">ID</th>
                  <th style="text-align: center;color:#FFFFFF">Box No</th>
                  <th style="text-align: center;color:#FFFFFF">Nhân viên scan</th>
                  <th style="text-align: center;color:#FFFFFF">Tracking</th>
                  <th style="text-align: center;color:#FFFFFF">Carriers</th>
                  <th style="text-align: center;color:#FFFFFF">Company Name</th>
                  <th style="text-align: center;color:#FFFFFF">Receiver</th>
                  <th style="text-align: center;color:#FFFFFF">Weight</th>
                  <!-- <th style="text-align: center;color:#FFFFFF">Đơn giá</th>
                  <th style="text-align: center;color:#FFFFFF">Total</th> -->
                  <th style="text-align: center;color:#FFFFFF"></th>
                  
               </tr>
            </thead>
            <tbody>

               <?php

              
               $bill = mysqli_query($conn,"SELECT * FROM ksn_shipment_details WHERE awb='".$id."' order by id DESC");
               $i = 0;
			   $cannang = 0;
               while($item = mysqli_fetch_array($bill,MYSQLI_ASSOC))
               {  
				  $laythongtinkien = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_listhoadon where id_code='".$item['id_listhoadon']."'"));
				  $nhanvienscan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user where id='".$item['uid']."'"));
                  $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id='".$laythongtinkien['id_package']."'"));
                  $sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));

                  $i++;
                  echo '<tr>
                  <td style="text-align: center; color:black">'.$i.'</td>
                  <td style="text-align: center; color:black">'.$item['date'].'</td>
                  <td style="text-align: center; color:black">';
				  if($roleid == 5)
				  {
					  echo $laythongtinkien['id_code'].'			
';
				  }
				  else
				  {
				  echo'
				  <a href="tracking_bill.php?id='.$laythongtinkien['id_code'].'">'.$laythongtinkien['id_code'].'</a> 
				  ';
				  }
				  echo'</td>
                  <td style="text-align: center; color:black">'.$item['box_no'].'   <a href="inlabel/BAGCODE_KANGO_DT.php?id='.$laythongtinkien['id_code'].'&print=auto" class="btn btn-warning btn-sm" target="_blank"><i class="fas fa-print"></i> </a></td>
                  <td style="text-align: center; color:black">'.$nhanvienscan['ten'].'</td>
                  <td style="text-align: center; color:black">'.$laythongtinkien['billketnoi'].'</td>
                  <td style="text-align: center; color:black">'.$laythongtinkien['hangketnoi'].'</td>
                  <td style="text-align: left; color:black">'.$sName['company_name'].'</td>
                  <td style="text-align: left; color:black">'.$rName['name'].'</td>
                  <td style="text-align: center; color:black">'.$laythongtinkien['cannang'].'</td>
                  '; 
                 $cannang+=$laythongtinkien['cannang'];
                 
                  /*if ($roleid == 4) {
                     echo '
                        <td>
                           <a href="success.php?id='.$item['id'].'" onclick="return confirm(\'Has this order been delivered successfully?\')" type="button" class="btn btn-success"><i class="fas fa-check"></i> Delivery successful?</a>
                           <a href="tracking_bill.php?id='.$item['id'].'" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add tracking</a>
                           <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a>
                        </td>
                     ';
                  }
					*/
                  if ($roleid == 1 || $roleid == 4) {
					  
                     echo '
                        <td>
                           <a href="undozz.php?id='.$item['id'].'" onclick="return confirm(\'Remove from shipment ?\')" type="button" class="btn btn-success btn-sm"><i class="fas fa-undo "></i></a>
                        </td>
                     ';
                  }
				  else
				  {
					  echo'<td></td>';
				  }
                  
                  echo '</tr>';
               }
               ?>

            </tbody>
         </table>
		 
		 Tông số kg: <?php echo $cannang?>
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