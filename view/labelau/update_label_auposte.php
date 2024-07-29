<?php  
	
?>
<div class="container-fluid">
	<form action="" method="POST">			

		<div class="row">
			<div class="col-md-4">
			
			
			
			<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Cập nhật Label đã tạo AUPOSTE </h3>
</div>
<div class="card-body">
			
	         
				<div class="form-group" >
					<label for="">Dán mã vào bên dưới sau 5 phút cập nhật file CSV tạo label AUPOSTE</label>
					<hr>

					<textarea id="w3review" name="w3review" rows="4" cols="60"  class="form-control" ></textarea>
<br>Cập nhật mã(referenceNo) với định dạng Example:<br>
AU299990054173<br>
AU299990054174<br>
AU299990054175<br>
<br>
				</div>
				
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-danger">Cập nhật</button>
</div>
</div>
			
			
			
			
			
			
			
				<h5></h5>
				
				
			</div><?php
			
			if(isset($_POST['btn_submit']))
			{
				
				
				
			
	$text = trim($_POST['w3review']); // remove the last \n or whitespace character
$text = nl2br($text); // insert <br /> before \n 
	$pieces = explode("\n", $text);
	
	foreach ($pieces as $letter=>$value) {
	$value = str_replace("<br />","",$value);
	$laygiatri = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_labelau where referenceNo='".trim($value)."' AND id_name<>''  order by id DESC LIMIT 1"));
	
				$data3 = '{
		"orderIds": ["'.$laygiatri['id_name'].'"]
		}';
					$url = 'https://api.eplink.com.au/services/shipper/labels';

					$ch = curl_init($url);

					$date = gmdate('D, d M Y H:i:s').' GMT';
					$stringtosign = "POST\n".$date."\n".$url."";
					$privkey = "QEhvDlHIzl2qob9SAX7pN9DNeWyFveTpRLJPLO1i";
					$signature = base64_encode(hash_hmac('sha1', $stringtosign, $privkey,true));

			
	
		// Attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data3 );

		// Set the content type to application/json
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
					'Authorization: Auth 6FEBQqyqKKVbPNdePX1y:'.$signature,
					'X-Auth-Date:'.$date));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


		// Return response instead of outputting

		echo $data3;
		// Execute the POST request
		$resultc = curl_exec($ch);
		
		echo $resultc;
		$my_array = json_decode($resultc,true);
					$linkpdf1 = $my_array['data'][0]['orderId'];
					
					
					@$linkpdf2 = $my_array['data'][0]['labelContent'];

					
					if($linkpdf2 != "")
					{
					$link_decode = base64_decode($linkpdf2);
					file_put_contents('labelau/AU/'.$linkpdf1.'.pdf', $link_decode);		
					mysqli_query($conn,"UPDATE `ksn_labelau` SET `link`='labelau/AU/".$linkpdf1.".pdf' WHERE (`id_name`='$linkpdf1')");
					// Close cURL resource
					echo 'Cập nhật thành công '.$value.'<br>';
					}
					else
						
						{
							echo'Hiện vẫn chưa có Label Print cho '.$value.'. Xin hãy thử lại sau';
						}
					curl_close($ch);
	//echo ' :<b> '.$mabill.'-<br>';



}
			
				
			
				
				
			}	
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