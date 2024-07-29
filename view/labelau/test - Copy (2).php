<?php
		
		
		if(isset($_POST['delete']))
		{
		mysqli_query($conn,"DELETE FROM `ksn_labelau` WHERE (`id`='".$_POST['id_delete']."')");
		}
		
		
		if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            $date = date('Y-m-d');
			$datenow2 = date('Y-m-d H:i:s');
			$status = 1;
			$note = 1;
			$pcs = 1;
			$demsokien=0;
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
				
				
				
				if($line[1] != "" && $line[2] != "")
				{
                $referenceNo   = $line[0];
                $serviceType   = $line[1];
                $recipientName   = $line[2];
                $phone   = $line[3];
                $email  = $line[4];
                $addressLine1  = $line[5];
                $addressLine2 = $line[6];
                $city = $line[7];
                $state = $line[8];
                $postcode = $line[9];
                $country = $line[10];
                $instruction = $line[11];
                $itemCount = $line[12];
                $description = $line[13];
                $unitValue = $line[14];
                $weight = $line[15];
                $height = $line[16];
                $length = $line[17];
                $width = $line[18];
                $dimensionUnit = $line[19];
                $weightUnit = $line[20];
                $shipperName = $line[21];
                $finalMileInjectionLocation = $line[22];
				
				
				$orderItems = '{"description": "'.$description.'",
				"itemCount": "'.$itemCount.'",
				"itemNo": "1",
				"unitValue": '.$unitValue.',
				"weight": '.$weight.',
				"height": '.$height.',
				"length": '.$length.',
				"width": '.$width.'}';
				}
				
				if($line[1] == "" && $line[2] == "")
				{
				$orderItems .=',{"description": "'.$description.'",
				"itemCount": "'.$itemCount.'",
				"itemNo": "1",
				"unitValue": '.$unitValue.',
				"weight": '.$line[15].',
				"height": '.$line[16].',
				"length": '.$line[17].',
				"width": '.$line[18].'}';
				
				}

					
				
				
				
				
				
				
				$data2 = '{
				"orders": [
				{
				"addressLine1": "'.$addressLine1.'",
				"addressLine2": null,
				"addressLine3": null,
				"city": "'.$city.'",
				"country": "AU",
				"description": "'.$description.'",
				"dimensionUnit": "'.$dimensionUnit.'",
				"email": "'.$email.'",
				"instruction": "'.$instruction.'",
				"orderItems": [
				
				'.$orderItems.'
				
				],
				"phone": "'.$phone.'",
				"postcode": "'.$postcode.'",
				"recipientName": "'.$recipientName.'",
				"shipperName": "GPE EXPRESS",
				"volume": "0.001",
				"referenceNo": "'.$referenceNo.'",
				"state": "'.$state.'",
				"insuranceRequired": false,
				"tailLiftService": false,
				"weightUnit": "'.$weightUnit.'",
				"serviceType": "'.$serviceType.'",
				"finalMileInjectionLocation": "'.$finalMileInjectionLocation.'"
				
				}
				]
				}';
				
				
				

				$demsokien++;
				if($demsokien == $itemCount)
				{
					

					$url = 'https://wisecomm.wiseway.com.au/services/shipper/orderLabels';

					$ch = curl_init($url);

					$date = gmdate('D, d M Y H:i:s').' GMT';
					$stringtosign = "POST\n".$date."\n".$url."";
					$privkey = "cxfk17xo7aKSS5722lDM_w";
					$signature = base64_encode(hash_hmac('sha1', $stringtosign, $privkey,true));

					
				
					// Attach encoded JSON string to the POST fields
					curl_setopt($ch, CURLOPT_POSTFIELDS,$data2 );

					// Set the content type to application/json
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
					'Authorization: Auth wiseway :'.$signature,
					'X-Auth-Date:'.$date));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


					// Return response instead of outputting
					
					// Execute the POST request
					$resultc = curl_exec($ch);
					
					$my_array = json_decode($resultc,true);
					$linkpdf1 = $my_array['data'][0]['orderId'];
					$linkpdf2 = $my_array['data'][0]['labelContent'];
					
					$link_decode = base64_decode($linkpdf2);
					file_put_contents('labelau/AU/'.$linkpdf1.'.pdf', $link_decode);		
					mysqli_query($conn,"INSERT INTO `ksn_labelau` (`id_name`, `link`, `datetime`, `referenceNo`, `state`, `postcode`) VALUES ('".$linkpdf1."', 'labelau/AU/".$linkpdf1.".pdf', '$datenow','$referenceNo','$state','$postcode')");
					// Close cURL resource
					curl_close($ch);
					$demsokien = 0;
				}
				
		
		
				
				
				
				
				
				
				
				
				
				
				
				
            }

            // Close opened CSV file
            fclose($csvFile);
            
            echo '<font color=green>Tạo Label AU thành công !</font><br>';
        }else{
            echo'abc';;
        }
    }else{
            echo'abcd';;
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
			
		

	
<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">
    <!-- Import & Export link -->
    <div class="col-md-12 head">
      
    </div>
    <!-- CSV file upload form -->
   <center> <div class="col-md-12" id="importFrm" style="background-color:#EEEEEE; padding:10px;border:1px solid gray" >
		<a href="./labelau/label-GPE-au.zip" >CSV IMPORT SAMPLE</a>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="Create Label AU">
        </form>
    </div> </center>
	
    <!-- Data list table --> 
  
</div><br>


<table id="example3" class="display nowrap " style="width:100%">
            <thead style="color:blue">
               <tr style="background-color:#33CCFF">
                  <th style="text-align: center;color:white">ID</th>
                  <th style="text-align: center;color:white">Date</th>
                  <th style="text-align: center;color:white">ID LABEL</th>
                  <th style="text-align: center;color:white">State</th>
                  <th style="text-align: center;color:white">Post Code</th>
                  <th style="text-align: center;color:white">Reference Code</th>
                  <th style="text-align: center;color:white">Link</th>
                  <th style="text-align: center;color:white"></th>
             
					

               </tr>
            </thead>
            <tbody>

               <?php
               if ($roleid == 1 || $roleid == 3 || $roleid == 4 || $roleid == 5) {
				   
				   if(isset($_POST['search']))
				   {                  
					$data = mysqli_query($conn,"SELECT * FROM ksn_labelau where referenceNo='1'");

				   }
				   else
				   {
					$data = mysqli_query($conn,"SELECT * FROM ksn_labelau");

				   }
			   
			   }else{
                  //$data = mysqli_query($conn,"SELECT * FROM ksn_scan_nhap");					

               }
               
               $i = 0;
               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
               {  
		   
				  //$laydulieukien = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$item['id_listhoadon']."'"))or die(mysql_error());
             
				  

                  echo '
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['id'].'</td>
				  <td style="text-align: left; color:black;font-size:14px;">'.$item['datetime'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;font-weight:bold">'.$item['id_name'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;font-weight:bold">'.$item['state'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;font-weight:bold">'.$item['postcode'].'</td>
				  <td style="text-align: center; color:black;font-size:14px;">'.$item['referenceNo'].'</td>
                  <td style="text-align: center; color:black;font-size:14px;"><a href="'.$item['link'].'" target="_blank" class="btn btn-sm btn-waning"><i class="fas fa-print"></i>Print Label</a></td>
               

                 <td  style="font-size:14px;">
				 <form action="" method=POST>
				 <input type="hidden" value="'.$item['id'].'" name="id_delete">
				 <input type="submit" value="Delete" class="btn btn-danger btn-sm" name="delete"></form>
				 </td>
				
                  </tr>';
               }
               ?>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
			
			
			
	
      </div>
   </div>
</div>