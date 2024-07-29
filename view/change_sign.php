<?php  
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
	
	
	include 'thanhtoan/config.php';
	include 'thanhtoan/lib/nganluong.class.php';
$flag = true;



if(isset($_POST['btn_submit'])) {
	@$img_sign = $_POST['img_sign'];
	mysqli_query($conn,"UPDATE `ns_user` SET `img_sign`='$img_sign' WHERE (`id`='$uid')");

}
	/*if($uid != 1)
	{
		echo'<script> 
               window.location.href="list_packfwd.php";
            </script>';
	}
	*/
	
	$laydulieuchukymoi = mysqli_fetch_assoc(mysqli_query($conn,"select img_sign from ns_user where id='$uid'"));
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 

      
   
   
   
   <div class="row">
		
  
<h3 class="card-title">Cập nhật thay đổi chữ ký
</h3>
   <form action="" method="POST">
					<font color=red>Lưu ý *: Ấn [Tạo chữ ký] trước khi ấn [Cập Nhật] để hoàn thành bước cập nhật chữ ký
<hr>
			<div id="canvas">
				Trình duyệt không hỗ trợ
			</div>
		
			<script>
				zkSignature.capture();
			</script>
            <br>
			<button type="button"  class="btn btn-danger btn-sm" onclick="zkSignature.clear()">
				Ký Lại
			</button>
			<input type="hidden" name="tenlienhe"  id="tenlienhe"  value="<?php echo $datauser['ten'];?>">
			<button type="button" class="btn btn-danger btn-sm" onclick="zkSignature.save()">
				Tạo Chữ Ký
			</button>
			
				<hr>			<center>
				
				
				
						<div id="aaaa" style="">
			</div>	
	<button type="submit" name="btn_submit" onclick="zkSignature.send()" class="btn btn-primary" >Cập nhật chữ ký </button></center>
					
					
					
					
			
	
	  
	  
	  
	 
   </div>	
		
			<div class="col-md-12">
				Mẫu chữ ký hiện tại <br>
				<img src="<?php echo $laydulieuchukymoi['img_sign'];?>">
			</div>
</div>
</div>

<?php  
    include('footer.php');
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function(){
	
  $("#get_opt").click(function(){
	  	  $("#get_opt").attr("disabled", true);

    $.post("ajax/send_mail_opt.php",
    {
      name: <?php echo'"'.$datauser['username'].'"'?>,
      city: "Duckburg"
    },
    function(data,status){
      alert("Đã gửi OPT vào mail của bạn, hãy kiểm tra Email và nhập OPT để thay đổi mật khẩu");
    });
  });
});
</script>