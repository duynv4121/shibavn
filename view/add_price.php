<?php  
	include('top.php');
	
?>
<div class="container-fluid">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-4">
			<?php
					$dichvu = $_GET['id_dichvu'];
					$loaibanggia = $_GET['type'];
					
					$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='".$dichvu."'"));
					
					?>
			
				<h5>Cập Nhật Bảng giá cho dịch vụ</h5>
				<hr>
			
	         
				<div class="form-group" >
					<br>
					
					<?php
				
					echo'Bạn đang tạo<b> bảng giá loại '.$loaibanggia.'</b><br> cho dịch vụ <font color=red>'.$laydulieu['dichvu'].'</font>';
					?>
					
									<br>	<label for="">Mặc định bảng giá theo bên dưới</label>

					<?php
					if($loaibanggia == '1')
					{
						echo'<textarea id="w3review" name="w3review"  class="form-control" style="  height: 500px;
">0.5	10000
1.0	10000
1.5	10000
2.0	10000
2.5	10000
3.0	10000
3.5	10000
4.0	10000
4.5	10000
5.0	10000
5.5	10000
6.0	10000
6.5	10000
7.0	10000
7.5	10000
8.0	10000
8.5	10000
9.0	10000
9.5	10000
10.0	10000
10.5	10000
11.0	10000
11.5	10000
12.0	10000
12.5	10000
13.0	10000
13.5	10000
14.0	10000
14.5	10000
15.0	10000
15.5	10000
16.0	10000
16.5	10000
17.0	10000
17.5	10000
18.0	10000
18.5	10000
19.0	10000
19.5	10000
20.0	10000
20.5	10000
21.0	10000
45.0	10000
71.0	10000
100.0	10000
300.0	10000
</textarea>';
					}else if($loaibanggia == '2')
					{
						echo'<textarea id="w3review" name="w3review"  class="form-control" style="  height: 700px;
">0.5	10000
1.0	10000
1.5	10000
2.0	10000
2.5	10000
3.0	10000
3.5	10000
4.0	10000
4.5	10000
5.0	10000
5.5	10000
6.0	10000
6.5	10000
7.0	10000
7.5	10000
8.0	10000
8.5	10000
9.0	10000
9.5	10000
10.0	10000
10.5	10000
11.0	10000
11.5	10000
12.0	10000
12.5	10000
13.0	10000
13.5	10000
14.0	10000
14.5	10000
15.0	10000
15.5	10000
16.0	10000
16.5	10000
17.0	10000
17.5	10000
18.0	10000
18.5	10000
19.0	10000
19.5	10000
20.0	10000
20.5	10000
21.0	10000
21.5	10000
22.0	10000
22.5	10000
23.0	10000
23.5	10000
24.0	10000
24.5	10000
25.0	10000
25.5	10000
26.0	10000
26.5	10000
27.0	10000
27.5	10000
28.0	10000
28.5	10000
29.0	10000
29.5	10000
30.0	10000
30.5	10000
31.0	10000
45.0	10000
71.0	10000
100.0	10000
300.0	10000
</textarea>';
					}else if($loaibanggia == '3')
					{
						echo'<textarea id="w3review" name="w3review"  class="form-control" style="  height: 700px;
">
21.0	10000
45.0	10000
71.0	10000
100.0	10000
300.0	10000
</textarea>';
					}else if($loaibanggia == '4')
					{
						echo'<textarea id="w3review" name="w3review"  class="form-control" style="  height: 700px;
">
31.0	10000
45.0	10000
71.0	10000
100.0	10000
300.0	10000
</textarea>';
					}
					?>
<br>Đang theo giá theo định dạng: <br>[<b>Số kg(Mức kg) </b>]    [<b>Số tiền</b>]<br>
Mặc định số tiền 10,000đ. Có thể update lại sau khi tạo bảng giá
				</div>
				
				
				<button type="submit" name="btn_submit" class="btn btn-success">Thêm bảng giá</button>
			</div>
			<div class="col-md-8">
				 <?php
				 	include('simple_html_dom.php');
				 
				 
				 
				 if(isset($_POST['btn_submit']))
{
	
	 $checktontai = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_giadichvu where id_dichvu='".$item['id']."'"));
	 if(@$checktontai['id_dichvu'] == "")
	 {

		mysqli_query($conn,"UPDATE `ksn_dichvu` SET `type`='$loaibanggia' WHERE (`id`='$dichvu')");
		$text = trim($_POST['w3review']); // remove the last \n or whitespace character
		$text = nl2br($text); // insert <br /> before \n 
		$pieces = explode("\n", $text);
		
		foreach ($pieces as $letter=>$value) {
		$value = str_replace("<br />","",$value);
		$value1 = trim($value); 
		$traiphai = explode("	", $value);
		
		
		// get DOM from URL or file
		$macj =  str_replace(',','',$traiphai[1]);
		$mabill = str_replace(',','',$traiphai[0]);



		
		$string = 'Giá '.$mabill.' kg'; 
		mysqli_query($conn,"INSERT INTO `ksn_giadichvu` (`id_dichvu`, `m_price`, `price`,`m_price_string`,`note`) VALUES ('$dichvu', '$mabill','$macj','$string','".$laydulieu['dichvu']."')")or die(mysqli_error());
		mysqli_query($conn,"INSERT INTO `ksn_giadichvu2` (`id_dichvu`, `m_price`, `price`,`m_price_string`,`note`) VALUES ('$dichvu', '$mabill','$macj','$string','".$laydulieu['dichvu']."')")or die(mysqli_error());
		mysqli_query($conn,"INSERT INTO `ksn_giadichvu3` (`id_dichvu`, `m_price`, `price`,`m_price_string`,`note`) VALUES ('$dichvu', '$mabill','$macj','$string','".$laydulieu['dichvu']."')")or die(mysqli_error());
		mysqli_query($conn,"INSERT INTO `ksn_giadichvu4` (`id_dichvu`, `m_price`, `price`,`m_price_string`,`note`) VALUES ('$dichvu', '$mabill','$macj','$string','".$laydulieu['dichvu']."')")or die(mysqli_error());	
		



		echo 'Mức giá :<b> '.$mabill.'-'.$string.'-';
		echo '</b>Giá: <b>'.$macj.'<br>';

		
		}
	 }
	 echo'<script> 
				   alert("Thêm bảng giá thành công!");

				  </script> ';	
	 	echo'	<script> location.href="m_admin.php?m=services"</script>';

}


				 ?>
			</div>
		</div>
	</form>
	
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