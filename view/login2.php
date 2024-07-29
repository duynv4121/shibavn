<?php  
    session_start();
    include("../conn/db.php");
    if (isset($_POST['btn_login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "select * from ns_user where username = '$username' and password = '$password' ";
        $query = mysql_query($sql);
        $num_rows = mysql_num_rows($query);
        $checkdulieu = mysql_fetch_assoc($query);
        if ($num_rows==0) {
            echo'<script> 
                alert("Sai tên tài khoản hoặc mật khẩu");
            </script>';
        }else{
            $query = mysql_query($sql);
            $layid = mysql_fetch_assoc($query);
            $_SESSION['username'] = $username;
            $_SESSION['roleid'] = $layid['roleid'];
            $_SESSION['uid'] = $layid['id'];
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
<title>Gia Phú Express - Hệ Thống Quản Lý Vận Đơn </title>
 <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Business Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
	
	<!-- css files -->
	<link href="css1/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css1/style.css" rel="stylesheet" type="text/css" media="all"/>
	<!-- //css files -->
	
	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- //google fonts -->
	
</head>
<body>

<div class="signupform">
	<div class="container">
		<!-- main content -->
		<div class="agile_info">
			<div class="w3l_form">
				<div class="left_grid_info">
					<img src="banner1.jpg" >
					<center><p style="font-family:Times new roman">Hệ thống quản lý vận đơn của Gia Phú Express</p>
					<img src="images/image.jpg" alt="" />
				</div>
			</div>
			<div class="w3_info">
				<h2  style="font-family:Arial">Đăng Nhập Hệ Thống</h2>
				<p  style="font-family:Times new roman">Nhập thông tin tài khoản để đăng nhập.</p>
				<form action="" method="post">
					<label>Tài khoản</label>
					<div class="input-group">
						<span class="fa fa-envelope" aria-hidden="true"></span>
						<input type="text" placeholder="Enter Username" required=""  name="username"> 
					</div>
					<label>Mật khẩu</label>
					<div class="input-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<input type="Password" placeholder="Enter Password" name="password"  required="">
					</div> 
					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox"  checked=""><i> </i> Lưu mật khẩu</label>
					</div>						
						<button class="btn btn-danger btn-block" name="btn_login" type="submit">Đăng Nhập</button >                
				</form>
				<p class="account">Tuân thủ <a href="#">Điều Khoản Sử Dụng Dịch Vụ của GIUAPHUEXPESSS!</a></p>
				<p class="account1">Nếu chưa có tài khoản ? <a href="#">Đăng ký tại đây</a></p>
		
			</div>
		</div>
		<!-- //main content -->
	</div>
	<!-- footer -->
	<div class="footer">
		<p>&copy; 2023 Hệ Thống Quản Lý Được Xây Dựng Bởi <a href="https://yunyunit.tech/" target="blank">YunYunIT.TECH</a></p>
	</div>
	<!-- footer -->
</div>
	
</body>
</html>