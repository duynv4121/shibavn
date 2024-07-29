<?php  
	
?>
<div class="container-fluid">
	<form action="" method="POST">			

		<div class="row">
			<div class="col-md-4">
			
			
			
			<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Cập nhật Label đã tạo </h3>
</div>
<div class="card-body">
			
	         
				<div class="form-group" >
					<label for="">Dán mã vào bên dưới </label>
					<hr>

					<textarea id="w3review" name="w3review" rows="4" cols="60"  class="form-control" ></textarea>
<br>Cập nhật mã với định dạng Example:<br>
299990054173<br>
299990054174<br>
299990054175<br>
<br>
				</div>
				
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-danger">Cập nhật</button>
</div>
</div>
			
			
			
			
			
			
			
				<h5></h5>
				
				
			</div><?php
				$data3 = '{
		"orderIds": ["D0000028"]
		}';
		$url = 'https://wisecomm.wiseway.com.au/services/shipper/labels';

		$ch = curl_init($url);

		$date = gmdate('D, d M Y H:i:s').' GMT';
		$stringtosign = "POST\n".$date."\n".$url."";
		$privkey = "cxfk17xo7aKSS5722lDM_w";
		$signature = base64_encode(hash_hmac('sha1', $stringtosign, $privkey,true));

		
	
		// Attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data3 );

		// Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		'Authorization: Auth wiseway:'.$signature,
		'X-Auth-Date:'.$date));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


		// Return response instead of outputting

		// Execute the POST request
		$resultc = curl_exec($ch);
		echo $resultc;
		$my_array = json_decode($resultc,true);
					$linkpdf1 = $my_array['data'][0]['orderId'];
					$linkpdf2 = $my_array['data'][0]['labelContent'];
					
					$link_decode = base64_decode($linkpdf2);
					file_put_contents('labelau/AU/'.$linkpdf1.'.pdf', $link_decode);		
					mysqli_query($conn,"UPDATE `ksn_labelau` SET `link`='labelau/AU/".$linkpdf1.".pdf' WHERE (`id_name`='$linkpdf1')");
					// Close cURL resource
					curl_close($ch);

				 ?>
		
		</div>
		
		
	</form>
	
</div>

<?php  
?>
<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>