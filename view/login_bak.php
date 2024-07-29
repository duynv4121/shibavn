<?php  
	
    session_start();
    include("../conn/db.php");
	
	
    if (isset($_POST['btn_logincode'])) {
		$f2a_code = $_POST['f2a_code'];
		$hash_code = $_GET['code'];
		$sql = "select * from ns_user where hash_code = '$hash_code' and f2a_code = '$f2a_code' ";
        $query = $conn->query($sql);
        $num_rows = mysqli_num_rows($query);
        $checkdulieu = mysqli_fetch_assoc($query);
        if ($num_rows==0) {
            echo'<script> 
                alert("F2A code không đúng hoặc đã hết thời gian! Xin nhập lại");
            </script>';
        }else{
			
			
			$query = mysqli_query($conn,$sql);

			$layid = mysqli_fetch_assoc($query)or die(mysqli_error());

			
            $_SESSION['username'] = $layid['username'];
            $_SESSION['roleid'] = $layid['roleid'];
            $_SESSION['uid'] = $layid['id'];
            $_SESSION['cus_code'] = $layid['cus_code'];
            $_SESSION['web_code'] = $layid['web_code'];
			
            header('Location: welcome.php');
			exit();
            // if ($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2 || $_SESSION['roleid'] == 3) {
            //     header('Location: index_bill.php');
            // }
            // if ($_SESSION['roleid'] == 4) {
            //     header('Location: shipment.php');
            // }
		}
		
	}
	
	
    if (isset($_POST['btn_login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "select * from ns_user where username = '$username' and password = '$password' ";
        $query = $conn->query($sql);
        $num_rows = mysqli_num_rows($query);
        $checkdulieu = mysqli_fetch_assoc($query);
        if ($num_rows==0) {
            echo'<script> 
                alert("Sai tên tài khoản hoặc mật khẩu");
            </script>';
        }else{
			$query = mysqli_query($conn,$sql);

			$layid = mysqli_fetch_assoc($query)or die(mysqli_error());

			if($layid['roleid'] == 1)
			{
				$f2a_expired = date("Y:m:d H:i:s",strtotime("+15 minutes"));

				$hash_code =  hash('ripemd160', $username.$f2a_expired);
				$f2a_code = random_int(100000, 999999);

				mysqli_query($conn,"UPDATE `ns_user` SET `hash_code`='$hash_code',`f2a_code`='$f2a_code',`f2a_expired`='$f2a_expired' WHERE (`username`='$username')");
				
				echo '<br>'.$f2a_expired;
				
				$ip = $_SERVER['HTTP_CLIENT_IP'] 
   ? $_SERVER['HTTP_CLIENT_IP'] 
   : ($_SERVER['HTTP_X_FORWARDED_FOR'] 
        ? $_SERVER['HTTP_X_FORWARDED_FOR'] 
        : $_SERVER['REMOTE_ADDR']);
				//ini_set( 'display_errors', 1 );
				//error_reporting( E_ALL );
				$from = "admin@GPE.online";
				$to = "info@GPEexp.vn";
				$subject = "Received OPT F2A GPE System";
				$message = "<html><body>Received OPT F2A GPE System. <br>- F2A Code: <b>".$f2a_code.'</b><br>- IP:'.$ip.'<br>F2A Expired Time (15 minutes): '.$f2a_expired.'</body></html>';
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($to,$subject,$message, $headers);

				
				
				header('Location: login.php?code='.$hash_code);

			}
			else
			{
			
            $_SESSION['username'] = $username;
            $_SESSION['roleid'] = $layid['roleid'];
            $_SESSION['uid'] = $layid['id'];
            $_SESSION['cus_code'] = $layid['cus_code'];
            $_SESSION['web_code'] = $layid['web_code'];
			
            header('Location: welcome.php');
            // if ($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2 || $_SESSION['roleid'] == 3) {
            //     header('Location: index_bill.php');
            // }
            // if ($_SESSION['roleid'] == 4) {
            //     header('Location: shipment.php');
            // }
			}
        }
    }
	
	
?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>GPE Express - Hệ Thống Quản Lý Vận Đơn </title>
 <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Business Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
	
	<link href="css1/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css1/style.css" rel="stylesheet" type="text/css" media="all"/>
	<!-- //css files -->
	
	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- //google fonts -->
	<style>
	@media (max-width: 767px) {
    .omg {
        display:none;
    }
}
	</style>
</head>
<body>

<div class="signupform">
	<div class="container">
		<!-- main content -->
		<div class="agile_info">
			<div class="w3l_form">
				<div class="left_grid_info">
					<img class="omg" src="banner_login.jpg" alt="" />
				</div>
			</div>
			<div class="w3_info">
				<h2  style="font-family:Arial" style="color:blue">HỆ THỐNG THỬ NGHIỆM</h2>
				
				
				
				
				<?php
				
				
				if(isset($_GET['code']))
				{
					$laydulieu = mysqli_num_rows(mysqli_query($conn,"select * from ns_user where hash_code='".$_GET['code']."'"));
					if($laydulieu >= 1)
					{
					echo'<p  style="font-family:Times new roman">Nhập code được gửi vào email để đăng nhập vào hệ thống</p>

				<form action="" method="post">
					<div class="input-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<input type="text" placeholder="Enter 2FA Code" required  name="f2a_code"> 
					</div>
										
						<button class="btn btn-danger btn-block" style="background-color:blue" name="btn_logincode" type="submit">Đăng Nhập</button >                
				</form>';
					}
					else
					{
						header('Location: login.php');

					}
				}
				else
				{
				echo'
				<p  style="font-family:Times new roman">Nhập thông tin tài khoản để đăng nhập.</p>

				<form action="" method="post">
					<label>Tài khoản</label>
					<div class="input-group">
						<span class="fa fa-envelope" aria-hidden="true"></span>
						<input type="text" placeholder="Enter Username" required  name="username"> 
					</div>
					<label>Mật khẩu</label>
					<div class="input-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<input type="Password" placeholder="Enter Password" name="password"  required>
					</div> 
					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox"  checked="" required><i> </i>Tuân thủ <button  type="button"  style="  background: none!important;
  border: none;
  padding: 0!important;
  /*optional*/
  font-family: arial, sans-serif;
  /*input has OS specific font-family*/
  color: #069;
  text-decoration: underline;
  cursor: pointer;"  data-toggle="modal" data-target="#exampleModal">Điều Khoản Sử Dụng Dịch Vụ của GPE EXPRESS!</button></label>
					</div>						
						<button class="btn btn-danger btn-block" style="background-color:blue" name="btn_login" type="submit">Đăng Nhập</button >                
				</form>
				
				
				<p class="account"></p>
				<p class="account1">Nếu chưa có tài khoản ? <a href="">Đăng ký tại đây</a></p>
				';
				
				}
				
				
				?>
				
				
				
				
				
		
			</div>
		</div>
		<!-- //main content -->
	</div>
	

<!-- Modal -->
<div class="modal fade  bd-example-modal-l" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Điều Khoản Sử Dụng Dịch Vụ GPE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="Layout_wrap__3Y4cM"><main class="Layout_content__3nMgS"> <div><div class="row"></div><p><strong style="color: rgb(0, 71, 178);">1) GPE express không nhận vận chuyển các mặt hàng như sau:</strong></p><p>&nbsp;&nbsp;- Các loại hàng hóa và tài liệu vi phạm quy định nhà nước như Ma túy , thuốc phiện, vũ khí , các loại văn hóa phẩm đồi trụy hoặc các tài liệu mang tính chất đả kích, bôi nhọ danh dự quyền lợi của cá nhân , tập thể, đất nước liên quan.</p><p>&nbsp;&nbsp;- Những hàng hóa cấm lưu thông, cấm kinh doanh, và các vật phẩm hàng hóa nước nhận cấm nhập khẩu.</p><p>&nbsp;&nbsp;- Tuyệt đối không nhận vận chuyển tiền bạc, kim loại đá quý, bạch kim,…</p><p><strong style="color: rgb(0, 71, 178);">2) Những mặt hàng thường xuyên được phép vận chuyển:</strong></p><p>&nbsp;&nbsp;- Hàng quần áo, dụng cụ, máy móc, linh kiện, nội thất, thủ công mỹ nghệ… sản xuất tại việt nam. Những nguồn gốc khác phải có chứng từ hợp lệ kèm theo.</p><p>&nbsp;&nbsp;- Riêng Hàng hóa, bưu phẩm gửi có tính chất nhạy cảm đối với nước đến như thực phẩm, chất lỏng, liên quan đến an toàn vệ sinh của nước đến thì khách hàng phải khai báo rõ ràng chính xác để đội ngũ nhân viên GPE tư vấn đầy đủ mọi thủ tục giúp hàng hóa đến tay người nhận nhanh chóng và an toàn.</p><p>&nbsp;&nbsp;- Chất bột, chất lỏng phải được đóng gói an toàn, đảm bảo không gây hư hỏng ảnh hướng đến những bưu phẩm bưu kiện khác chung chuyến bay, thực hiện đúng quy định hàng không quốc tế.</p><p>&nbsp;&nbsp;- Thuốc tây, thuốc nam, mỹ phẩm thuộc hàng nhạy cảm, khách hàng phải có đầy đủ chứng từ liên quan, hoặc khai báo rõ để GPE tư vấn dịch vụ gửi an toàn và thủ tực đơn giản nhất cho quý khách.</p><p><strong style="color: rgb(0, 71, 178);">3) Trách nhiệm của người gửi:&nbsp;&nbsp;</strong></p><p>- Cần khai báo chính xác nội dung hàng hóa gửi lên bill của GPE. Cung cấp mọi chứng từ đính kèm với hàng gửi, đảm bảo rằng người nhận có chức năng nhập khẩu tại nước đến.</p><p>&nbsp;&nbsp;- Quy cách đóng gói đảm bảo an toàn cho hàng hóa trước khi giao cho GPE.</p><p>&nbsp;&nbsp;- Thực hiện đúng pháp luật khi xuất hàng và thanh toán mọi chi phí phát sinh trong quá trình vận chuyển. Chịu trách nhiệm trước pháp luật với nội dung hàng khi gửi.</p><p><strong style="color: rgb(0, 71, 178);">4) Trách nhiệm của GPE Express khi nhận hàng và giải quyết khiếu nại:</strong></p><p>&nbsp;&nbsp;- GPE được phép kiểm tra hàng hóa thực tế. Trong trường hợp phát hiện có dấu hiệu vi phạm pháp luật, GPE sẽ từ chối phục vụ.</p><p>&nbsp;&nbsp;- GPE có trách nhiệm đảm bảo an toàn bưu gửi kể từ khi nhận gửi đến khi phát hàng cho người nhận.</p><p>&nbsp;&nbsp;- Công ty sẽ bồi thường thiệt hại vật chất theo mức công ty công bố. Đối với các lô hàng không mua bảo hiểm:</p><p>&nbsp;&nbsp;&nbsp;&nbsp;+ GPE bồi thường tối đa đối với tài liệu chuyển phát nhanh trong nước Mức bồi thường bằng 04 lần mức cước đã thu khi chấp nhận, tối thiểu 200.000 đồng/ 1 vận đơn . Riêng đối với các bưu gửi có nội dung là tài liệu đặc biệt: (hồ sơ thầu, vé máy bay, hộ chiếu, sổ gốc hộ khẩu, bằng gốc đại học), bồi thường chi phí làm lại giấy tờ, tối đa 1.000.000 đồng.</p><p>&nbsp;&nbsp;&nbsp;&nbsp;+ GPE bồi thường tối đa đối với tài liệu chuyển phát nhanh quốc tế là 200.000 đồng / 1 vận đơn tùy theo giấy tờ và xem sét mức tối đa là 1.000.000 đồng/ 1 vận đơn.</p><p>&nbsp;&nbsp;&nbsp;&nbsp;+ GPE đền bù đối với hàng hóa quốc tế căn cứ theo dịch vụ chuyển phát nhanh quốc tế như UPS,DHL,FEDEX,TNT kết nối.</p><p>&nbsp;&nbsp;- GPE không hoàn lại cước và đền bù trong các trường hợp sau:</p><p>&nbsp;&nbsp;&nbsp;&nbsp;+ Hàng hóa bị cơ quan nhà nước có thẩm quyền thu giữ hoặc gửi ra nước ngoài bị tịch thu, tiêu hủy, hoàn về theo điều lệ của nước nhận.</p><p>&nbsp;&nbsp;&nbsp;&nbsp;+ Hàng hóa, vật phẩm bị hủy hại, hư hỏng do đặc tính của tự nhiên.</p><p>&nbsp;&nbsp;&nbsp;&nbsp;+ Các thiệt hại gián tiếp hoặc nguồn lợi không thực hiện do việc mất , chậm trễ, hư hỏng,…</p><p>&nbsp;&nbsp;&nbsp;&nbsp;+ Khiếu nại quá thời hiệu quy định.</p><p>&nbsp;&nbsp;&nbsp;&nbsp;+ Các trường hợp bất khả khán như: Động đất, chiến sự, cấm vận, rơi máy bay, bão lụt,…</p><p><strong style="color: rgb(0, 71, 178);">5) Một số lưu ý thêm.</strong></p><p>&nbsp;&nbsp;- Thời gian khiếu nại trong vòng 30 ngày kể từ ngày gửi, nếu quá thời hạn không nhận được khiếu nại xem như bill không có giá trị . Và hàng hóa xem như đã giao đến đúng nơi người nhận.</p><p>&nbsp;&nbsp;- Hàng hóa chuyển hàng theo yêu cầu của khách hàng, do lỗi của người gửi hoặc do địa chỉ người nhận không đúng, do không có người nhận ở nhà , do quá thời gian quy định của hãng kết nối mà người nhận không đủ điều kiện nhập khẩu tại nước đến sẽ thu thêm phí bằng cước chính đối với bưu gửi trong nước và theo cước thu về của hãng đối với bưu gửi quốc tế.</p><p>-Lưu ý đối với các dịch vụ Chuyên Tuyến Air / Sea do GPE khai thác, sẽ có chính sách đền bù khác nhau theo ghi chú lưu ý bảng giá. GPE sẽ áp dụng theo quy định đặt ra.</p><p><strong style="color: rgb(0, 102, 204);">6) Lưu ý thêm về chính sách đền bù đối với các lô hàng sử dụng dịch vụ Chuyên Tuyến do GPE khai thác.</strong></p><p><br></p><p>- GPE sẽ không chịu trách nhiệm đền bù đối với trường hợp hàng hóa bị bể vỡ, hư hỏng trong quá trình vận chuyển nếu có giá trị lô hàng vượt quá $100.    </p><p> - Đối với các mặt hàng dễ bể vỡ, hàng hóa có giá trị cao ( Vượt quá $100/1 lô hàng ) khách hàng có thể liên hệ với bộ phận kinh doanh GPE để được tư vấn mua bảo hiểm với mức bảo hiểm   &nbsp;là từ 10-20% tùy theo giá trị lô hàng mà do GPE thẩm định lại theo giá thị trường, với điều kiện lô hàng không được vượt quá 1 tỷ đồng.   </p><p>- Đối với trường hợp hải quan tịch thu hàng hóa :&nbsp;</p><p>&nbsp;+ Công ty đền cước : với những loại mặt hàng thông thường.</p><p>&nbsp;( khách hàng cần cung cấp hình ảnh + video ngay khi nhận được hàng hóa )</p><p>&nbsp;+ Công ty không đền cước: với những loại mặt hàng thịt, trứng, sữa,&nbsp;hàng hải sản khô, thuốc.</p><p>- Đối với trường hợp mất hàng Trong quá trình vận chuyễn : Công ty đền 100% cước + giá trị hàng theo invoice nhưng không quá 100 usd / lô hàng ( shipment ) ( theo quy định hợp đồng ) ,&nbsp;công ty chỉ đền bù trên kiện hàng , không đền bù cho nội dung hàng bên trong kiện hàng ( trường hợp mất 1 vài món hàng bên trong kiện )</p><p>- Đối với trường hợp hàng hỏng do đi lâu : Công ty giảm 10-20% cước tùy từng trường hợp ( không xử lý nếu thời gian đi lâu do hải quan giữ hàng ,</p><p>&nbsp;vấn đề khách quan như dịch bệnh , backlog hàng do cuối năm, trường hợp đã báo trước cho khách hàng về toàn trình có thể bị lâu hơn dự kiến )</p><p>&nbsp;( khách hàng cần cung cấp hình ảnh + video ngay khi nhận được hàng hóa )</p><p>- Miễn khiếu nại đền bù đối với các mặt hàng khó bị phụ thu Hải Quan như, hàng fake, thịt, trứng, sữa, gạo,...</p><p>- Đối với trường hợp giao hàng đã update trạng thái giao hàng nhưng vì một số lý do mất hàng hoặc người nhận vắng nhà, một số lý do khác mà không phải lỗi do GPE gây ra. GPE sẽ Claim và giải quyết khiếu nại với mức đền bù cao nhất là 50% cước ,&nbsp;và tiền hàng không quá $100 USD</p><p>-Đối với trường hợp các lô hàng Fake, hàng khó,hàng không nhập khẩu được vào nước đến , bị bất kì cơ quan tổ chức nào tại nước đến yêu cầu giữ hoặc bị mất hàng , mất ở đây không quan trọng là mất ở khâu nào, GPE không giải quyết bất kì khiếu nại nào liên quan.</p><p>- Đối với các lô hàng sử dụng dịch vụ chuyên tuyến do đóng gói hàng hóa không đảm bảo, các lô hàng bị bể vỡ, chảy nước, cho nên bị hãng vận chuyển cuối cùng như Fedex Ground, Ups Ground, Aupost, Aramex,... GPE sẽ đền bù theo chính sách tối đa 50% cước và hỗ trợ đền bù tiền hàng theo chính sách Fedex, Ups , hãng cuối cùng thông thường là tối đa 100 USD/1 lô hàng.</p><p><br></p><p><strong class="ql-size-large" style="color: rgb(230, 0, 0);"><em>Vui lòng lưu ý khi sử dụng dịch vụ đồng nghĩa với việc khách hàng đã đồng ý các điều khoản nêu trên.</em></strong></p></div> </main><footer class="Footer_root__2pPqB"></footer></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
	




	<!-- footer -->
	<div class="footer">
	</div>
	<!-- footer -->
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
</body>
</html>