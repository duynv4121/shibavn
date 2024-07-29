<?php  
	include('top.php');
	if (isset($_POST['btn_submit'])) {
		$awb = $_POST['awb'];
		$datenow = date('Y-m-d H:i:s');;
		$partner1 = $_POST['partner1'];
		$kg_dichvu = $_POST['kg_dichvu'];
		$kg_chinhanh = $_POST['kg_chinhanh'];
		
		$check = mysqli_num_rows(mysqli_query($conn,"SELECT awb FROM ksn_shipment WHERE awb ='$awb'"));
		if ($check != 0) {
			echo 'Đã có MAWB này rồi!';
		}else{
			mysqli_query($conn,"INSERT INTO `ksn_shipment` (`awb`, `date_time`, `id_doitac`,`doitac`,`kg_dichvu`,`kg_chinhanh`)
			VALUES ('$awb','$datenow', '','$partner1','$kg_dichvu','$kg_chinhanh')") or die(mysql_error()); 
			
			echo'<script> 
				alert("Tạo MAWB thành công!");
                window.location.href="shipments.php";
            </script>';
		}
	}
?>
<div class="container-fluid">
	 <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-2">            <h2 class="text-center display-4">Scan Export MAWB</h2>
				
							<form action="scan_xuat_dt_for_doc.php" method="GET">

                        <div class="input-group">

                            <select class="select2bs4 form-control form-control-lg" name="mawbid" placeholder="Nhập mã MAWB có trong hệ thống">
							<?php
							
							$laymaawba = mysqli_query($conn,"SELECT id,awb,kg_dichvu FROM ksn_shipment order by id desc");
							while ($laymaawb = mysqli_fetch_array($laymaawba,MYSQLI_ASSOC)) {
								
								foreach ( $myArray as $a){
								 $layten =  mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='$a'"));
								 if($layten['dichvu'] != "")
								 {
									echo  $layten['dichvu'].' ';
								 }
								}
								$tendichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu from ksn_dichvu where id='".$laymaawb['kg_dichvu']."'"));
								echo '
								<option value="'.$laymaawb['id'].'">'.$laymaawb['awb'].' [';
				  
				  $myArray = explode(',', $laymaawb['kg_dichvu']);

				  foreach ( $myArray as $a){
					 @$layten =  mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_dichvu where id='$a'"));
					 if(@$layten['dichvu'] != "")
					 {
						echo  @$layten['dichvu'].' ';
					 }
					}
			
				  
				  echo']</option>';
							}
							?>
							</select>
                            <div class="input-group-append">
							
                                <button type="submit" class="btn  btn-default">
                                    <i class="fas fa-qrcode"></i>
                                </button>	
								</form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php  
    include('footer.php');
?>

<script src="gd/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript">



	$('.select2bs4').select2({
      theme: 'bootstrap4'
    })


</script>