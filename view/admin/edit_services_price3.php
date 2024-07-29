<?php  
	$id_dichvu = $_GET['id'];
	$note = $_GET['note'];
	$type = $_GET['type'];
	
	
		
	if($type == "f1-hcm")
	{
			$bang_gia = 'price_hcm_f1'; 
	}
	else if($type == "f1-hn")
	{
			$bang_gia = 'price_hn_f1'; 

	}
	else if($type == "f0-hn")
	{
		$bang_gia = 'price_hn_f0'; 

	}else if($type == "f1-dad")
	{
		$bang_gia = 'price_dn_f1'; 

	}
	else if($type == "f0-dad")
	{
		$bang_gia = 'price_dn_f0'; 

	}else if($type == "code-dad")
	{
		$bang_gia = 'price_dn_code'; 

	}else if($type == "code-hcm")
	{
		$bang_gia = 'price_hcm_code'; 

	}else if($type == "code-hn")
	{
		$bang_gia = 'price_hn_code'; 

	}
	else
	{
		$bang_gia = 'price';
	}
	
	$laythongtindichvu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='$id_dichvu' "));
?>
<div class="container-fluid"><a href="m_admin.php?m=services_price3" class="btn btn-primary btn-sm"><i class="fas fa-step-backward"></i> BẢNG GIÁ TỔNG </a><br><br>
	<form action="" method="POST">			

		<div class="row">
			<div class="col-md-4">
			
			
			
			<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Cập nhật giá cho Dịch Vụ: <?php echo $laythongtindichvu['dichvu'].'-Note:'.$note?></h3>
</div>
<div class="card-body">
			
	         
				<div class="form-group" >
					<label for="">Dán mã vào bên dưới </label>
					<hr>

					<textarea id="w3review" name="w3review" rows="4" cols="60"  class="form-control" ><?php 
					$laythongtingiadichvua = mysqli_query($conn,"select * from ksn_giadichvu3 where id_dichvu='$id_dichvu' AND note='$note' ");
					while($laythongtingiadichvu = mysqli_fetch_array($laythongtingiadichvua,MYSQLI_ASSOC))
					{
						echo nl2br($laythongtingiadichvu['m_price'].'	'.$laythongtingiadichvu[$bang_gia]);echo'
';
					}
					?></textarea>
<br>Cập nhật mã với định dạng : <br>[<b>Mức giá </b>]    [<b>Giá tiền</b>]<br>
				</div>
				
				
				</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-danger">Cập nhật giá</button>
</div>
</div>
			
			
			
			
			
			
			
				<h5></h5>
				
				
			</div><?php
				 	include('simple_html_dom.php');

				 if(isset($_POST['btn_submit']))
{
	echo'			<div class="col-md-3" style="color:green">Cập nhật mức giá <br><br><br>
';
	
	$text = trim($_POST['w3review']); // remove the last \n or whitespace character
$text = nl2br($text); // insert <br /> before \n 
	$pieces = explode("\n", $text);
	
	foreach ($pieces as $letter=>$value) {
	$value = str_replace("<br />","",$value);
	$value1 = trim($value); 
	$traiphai = explode("	", $value);
	
	
	// get DOM from URL or file
	$mabill = str_replace(',','',$traiphai[0]);

	$macj =  str_replace(',','',$traiphai[1]);

	mysqli_query($conn,"UPDATE `ksn_giadichvu3` SET `$bang_gia`='$macj' WHERE (`id_dichvu`='$id_dichvu') AND (`m_price`='$mabill') AND (`note`='$note')")or die(mysqli_error());

	echo 'Cập nhật Mức kg :<b> '.$mabill.'-';
	echo '</b>Giá: <b>'.@number_format($macj).'</b><br>';

	


}
echo'</div>';
}


				 ?>
			<div class="col-md-4">
			
			<table id="example2" class="display nowrap cell-border dataTable no-footer dtr-column collapsed" width=100% data-page-length='50'  style="font-size:12px" data-order='[[0, "desc"]]'>
		            <thead style="color:white;font-weight:bold">
		               <tr>
		                      <th colspan="3" style="background-color:#CC9900;text-align:center;"><?php echo $laythongtindichvu['dichvu'];?> </th>

		               </tr>
					   <tr  style="background-color:black;color:white;font-weight:bold;text-align:center;">
		                  <th style="text-align: center;color:white;">Mức kg</th>
		                  <th style="text-align: center;color:white">Mức giá </th>
		               </tr>
		            </thead>
		            <tbody>

		               <?php
		               
		               $data = mysqli_query($conn,"SELECT * FROM ksn_giadichvu3 where id_dichvu='$id_dichvu' AND note='$note'");
		               
		               
		               $i = 0;
		               while($item = mysqli_fetch_array($data,MYSQLI_ASSOC))
		               {  
				   
		                  $i++;
		                  echo '<tr>
		                  <td style="text-align: center; color:white;background-color:#CC9933">'.$item['m_price_string'].'</td>
		                  <td style="text-align: center; color:blue">'.number_format($item[$bang_gia]).'</td>
		                  </tr>';
		               }
		               ?>

		            </tbody>
		         </table>
				 
			</div>
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