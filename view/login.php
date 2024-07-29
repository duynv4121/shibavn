<?php

session_start();
include("../conn/db.php");
$laytiemnow = date("Y-m-d H:i:s");
$datenow = date("Y:m:d H:i:s");



if (isset($_POST['btn_registerfwd'])) {





	$username = $conn->real_escape_string(trim($_POST['username']));
	$password = $conn->real_escape_string($_POST['password']);
	$congty = $conn->real_escape_string($_POST['congty']);
	$tenlienhe = $conn->real_escape_string($_POST['tenlienhe']);
	$payment_price_type = '99';
	$mst = $_POST['mst'];
	$ctyghitat = strtoupper($congty);
	$count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ns_user WHERE username = '$username'"));
	if ($count != 0) {
		echo '<script> 
            alert("Username đã được sử dụng, xin hãy đổi và thử lại!");
           </script>';
	} else {



		$active = 1;



		$nguoigui_phone = $conn->real_escape_string($_POST['nguoigui_phone']);

		$nguoigui_add = $conn->real_escape_string($_POST['nguoigui_add']);
		@$website = $_POST['website'];
		$congno = '99';
		$accountant_key = $conn->real_escape_string($_POST['accountant_key']);

		mysqli_query($conn, "INSERT INTO `ns_user` (`username`, `password`,`ten`,`congty`,`roleid`,`ctyghitat`,`phone`,`diachi`,`website`,`payment_type`,`mst`,`payment_price_type`,`created_at`,`active`,`accountant_key`)
            VALUES ('$username','$password','$tenlienhe', '$congty', 2, '$ctyghitat','$nguoigui_phone','$nguoigui_add','$website','$congno','$mst','$payment_price_type','$datenow','$active','$accountant_key')") or die(mysqli_error());


		$laysoid = mysqli_fetch_assoc(mysqli_query($conn, "select * from ns_user where username='$username'"));
		mysqli_query($conn, "INSERT INTO `ns_maprole` (`roleid`, `userid`, `subroleid`) VALUES ('2', '" . $laysoid['id'] . "', '3')");

		$idusera = $laysoid['id'];

		$nguoigui_name = $conn->real_escape_string($_POST['congty']);
		$nguoigui_tp = $conn->real_escape_string($_POST['nguoigui_tp']);
		@$nguoigui_districtid = $conn->real_escape_string($_POST['nguoigui_districtid']);
		@$nguoigui_wardid = $conn->real_escape_string($_POST['nguoigui_wardid']);
		$check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * 
FROM ns_customer 
WHERE id=(
    SELECT max(id) FROM ns_customer
    )"));


		$nguoigui_code = 'KG' . ($check['id'] + 1);
		mysqli_query($conn, "INSERT INTO `ns_customer` (`name`,`cus_code`, `province_id`, `district_id`, `ward_id`,`address`,`phone`,`fwd`)
				VALUES ('$nguoigui_name','$nguoigui_code','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone','1')") or die(mysql_error());
		mysqli_query($conn, "UPDATE `ns_user` SET `cus_code`='$nguoigui_code' WHERE (`id`='$idusera')");



		### Upload hình



		$target_dir = "../inbill/inbilltw/";
		$target_file = $target_dir . $idusera . '-' . trim(basename($_FILES["imagecongty"]["name"]));
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		$check = getimagesize($_FILES["imagecongty"]["tmp_name"]);
		if ($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			//echo "File is not an image.";
			$uploadOk = 0;
		}


		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["imagecongty"]["size"] > 5000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if (
			$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif"
		) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["imagecongty"]["tmp_name"], $target_file)) {

				$target_fileb = $idusera . '-' . trim(basename($_FILES["imagecongty"]["name"]));

				//echo "The file ". htmlspecialchars( basename( $_FILES["imagecongty"]["name"])). " has been uploaded.";
				mysqli_query($conn, "UPDATE `ns_user` SET `logo`='" . $target_fileb . "' WHERE (`id`='$idusera')");
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}


		echo '<script> 
               alert("Đăng ký tài khoản thành công, xin hãy đợi duyệt để đăng nhập vào hệ thống!");

              </script>
			  
			  
			  
			  ';
	}
}



if (isset($_POST['btn_register'])) {




	$username = $conn->real_escape_string(trim($_POST['username']));
	$password = $conn->real_escape_string($_POST['password']);
	@$congty = $conn->real_escape_string($_POST['congty']);
	$kg_chinhanh = $conn->real_escape_string($_POST['kg_chinhanh']);
	$tenlienhe = $conn->real_escape_string($_POST['tenlienhe']);
	$payment_price_type = '3';
	@$mst = $_POST['mst'];
	$ctyghitat = strtoupper($congty);
	$count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ns_user WHERE username = '$username'"));
	if ($count != 0) {
		echo '<script> 
            alert("Username đã được sử dụng, xin hãy đổi và thử lại!");
           </script>';
	} else {



		$active = 1;



		$nguoigui_phone = $conn->real_escape_string($_POST['nguoigui_phone']);

		$nguoigui_add = $conn->real_escape_string($_POST['nguoigui_add']);
		@$website = $_POST['website'];
		$congno = $_POST['congno'];
		$roleid = $_POST['roleid'];
		@$img_sign = $_POST['img_sign'];

		mysqli_query($conn, "INSERT INTO `ns_user` (`username`, `password`,`ten`,`congty`,`roleid`,`ctyghitat`,`phone`,`diachi`,`img_sign`,`created_at`,`kg_chinhanh`,`active`)
            VALUES ('$username','$password','$tenlienhe', 'SHIBAVN EXPRESS', $roleid, 'SHIBAVN EXPRESS','$nguoigui_phone','$nguoigui_add','$img_sign','$datenow','$kg_chinhanh','$active')") or die(mysqli_error());




		$laysoid = mysqli_fetch_assoc(mysqli_query($conn, "select * from ns_user where username='$username'"));

		if ($laysoid['roleid'] == 6) {
			mysqli_query($conn, "UPDATE `ns_user` SET `hanmuc`='20000000' WHERE (`username`='$username')");
		}


		$idusera = $laysoid['id'];

		$nguoigui_name = $_POST['congty'];
		$nguoigui_tp = $_POST['nguoigui_tp'];
		@$nguoigui_districtid = $_POST['nguoigui_districtid'];
		@$nguoigui_wardid = $_POST['nguoigui_wardid'];
		$check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * 
FROM ns_customer 
WHERE id=(
    SELECT max(id) FROM ns_customer
    )"));


		$nguoigui_code = 'KG' . ($check['id'] + 1);
		mysqli_query($conn, "INSERT INTO `ns_customer` (`name`,`cus_code`, `province_id`, `district_id`, `ward_id`,`address`,`phone`,`fwd`)
				VALUES ('$nguoigui_name','$nguoigui_code','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone','0')") or die(mysqli_error());
		mysqli_query($conn, "UPDATE `ns_user` SET `cus_code`='$nguoigui_code' WHERE (`id`='$idusera')");



		### Upload hình




		echo '<script> 
               alert("Đăng ký tài khoản nhân viên thành công, xin hãy đợi duyệt để đăng nhập vào hệ thống!");
							window.location = "m_admin.php?m=user";

              </script>
			  
			  
			  
			  ';
	}
}






if (isset($_POST['btn_logincode'])) {
	$f2a_code = $_POST['f2a_code'];
	$hash_code = $_GET['code'];
	$sql = "select * from ns_user where hash_code = '$hash_code' and f2a_code = '$f2a_code' ";
	$query = $conn->query($sql);
	$num_rows = mysqli_num_rows($query);
	$checkdulieu = mysqli_fetch_assoc($query);
	if ($num_rows == 0) {
		echo '<script> 
                alert("F2A code không đúng hoặc đã hết thời gian! Xin nhập lại");
            </script>';
	} else if ($laytiemnow > $checkdulieu['f2a_expired']) {
		echo '<script> 
                alert("Mã đã quá hạn, xin đăng nhập lại để lấy lại mã");
            </script>';
	} else {


		$query = mysqli_query($conn, $sql);

		$layid = mysqli_fetch_assoc($query) or die(mysqli_error());


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

	$laydulieucheck = mysqli_fetch_assoc(mysqli_query($conn, "select * from ksn_system where string_code='f2a_code'"));

	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);
	$sql = "select * from ns_user where username = '$username' and password = '$password' ";
	$query = $conn->query($sql);
	$num_rows = mysqli_num_rows($query);
	$checkdulieu = mysqli_fetch_assoc($query);
	if ($num_rows == 0) {
		echo '<script> 
                alert("Sai tên tài khoản hoặc mật khẩu");
            </script>';
	} else {
		$query = mysqli_query($conn, $sql);

		$layid = mysqli_fetch_assoc($query) or die(mysqli_error());
		if ($layid['active'] == 1) {
			echo '<script> 
                alert("Account đang chờ duyệt mới có thể sử dụng");
				window.location = "login.php";

				</script>';

			exit();
		}
		if ($layid['active'] == 2) {
			echo '<script> 
                alert("Account hiện đang tạm khóa, liên hệ hỗ trợ SHIBAVN để được xử lý");
				window.location = "login.php";

				</script>';

			exit();
		}
		if ($layid['roleid'] == 100 || $laydulieucheck['status'] == 2) {
			$f2a_expired = date("Y:m:d H:i:s", strtotime("+15 minutes"));

			$hash_code =  hash('ripemd160', $username . $f2a_expired);
			$f2a_code = random_int(100000, 999999);

			mysqli_query($conn, "UPDATE `ns_user` SET `hash_code`='$hash_code',`f2a_code`='$f2a_code',`f2a_expired`='$f2a_expired' WHERE (`username`='$username')");

			echo '<br>' . $f2a_expired;

			$ip = $_SERVER['HTTP_CLIENT_IP']
				? $_SERVER['HTTP_CLIENT_IP']
				: ($_SERVER['HTTP_X_FORWARDED_FOR']
					? $_SERVER['HTTP_X_FORWARDED_FOR']
					: $_SERVER['REMOTE_ADDR']);
			//ini_set( 'display_errors', 1 );
			//error_reporting( E_ALL );
			if ($layid['roleid'] == 1) {
				$to = "info@SHIBAVNexp.vn";
			} else {
				$to = $layid['username'];
			}
			$subject = "Received OPT 2FA SHIBAVN System - Expired " . $f2a_expired;
			//$message = "<html><body><center><table>Received OPT F2A SHIBAVN System. <br>- F2A Code: <b>".$f2a_code.'</b><br>- IP:'.$ip.'<br>F2A Expired Time (15 minutes): '.$f2a_expired.'</table></body></html>';
			$message = "<html><body style='background-color:gray'><center><table width='100%' height='100%' cellpadding='0' cellspacing='0' border='0'> <tbody><tr> <td> <table width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='background-color:#DDDDDD'> <tbody><tr> <td align='center' valign='middle' style='padding:33px 0'><a href=''><img src='https://SHIBAVNexp.com/wp-content/uploads/2022/06/logo-SHIBAVN.b9d26e5f.png' width='232' height='60' style='border:0' ></a></td> </tr> <tr style='background-color:gray'> <td> <div style='padding:0 30px;background:#fff'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tbody><tr> <td style='border-bottom:1px solid #e6e6e6;font-size:18px;padding:20px 0'> <table border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody><tr> <td>Received OPT from SHIBAVN SYSTEM,<br>				Hello,				
				Your verification code:<font color=orange> <b>" . $f2a_code . "</b></font><br>  <br> <br> The verification code will be valid for 15 minutes. Please do not share this code with anyone.<br>
				<br>Your IP:" . $ip . "<br>2FA Expired Time (15 minutes): " . $f2a_expired . "
				</td></tr>
				<tr>
				<td style='padding:30px 0 15px 0;font-size:12px;color:#999;line-height:20px'>
				SHIBAVN System<br>Automated message. Please do not reply.
				</td>
				</tr>
				 <tr>
                <td align='center' style='font-size:12px;color:#999;padding:20px 0'>© 2023 SHIBAVN.online All Rights Reserved<br>URL：<a style='color:#999;text-decoration:none' href='http://SHIBAVNexp.com' target='_blank' >www.SHIBAVNexp.com</a>&nbsp;&nbsp;E-mail：<a href='mailto:info@SHIBAVNexp.vn' style='color:#999;text-decoration:none' target='_blank'>info@SHIBAVNexp.vn</a></td>
				</tr>
				<td> </tbody></table></body></html>";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			mail('tructran13101996@gmail.com', $subject, $message, $headers);


			//Load composer's autoloader
			require 'PHPMailer-master/src/PHPMailer.php';
			require 'PHPMailer-master/src/SMTP.php';
			require 'PHPMailer-master/src/Exception.php';

			//Create a new PHPMailer instance
			$mail = new PHPMailer\PHPMailer\PHPMailer();
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			// use
			// $mail->Host = gethostbyname('smtp.gmail.com');
			// if your network does not support SMTP over IPv6
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "noreply@SHIBAVNexp.vn";
			//Password to use for SMTP authentication
			$mail->Password = "SHIBAVN#123456";
			//Set who the message is to be sent from
			$mail->setFrom('noreply@SHIBAVNexp.vn', 'SHIBAVN Express');
			//Set an alternative reply-to address
			//Set who the message is to be sent to
			$mail->addAddress($to, 'SHIBAVN User');
			//Set the subject line
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $message;
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			//Attach an image file
			//send the message, check for errors
			$mail->send();













			header('Location: login.php?code=' . $hash_code);
			exit();
		} else {

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
	<title>SHIBAVN Express - Hệ Thống Quản Lý Vận Đơn </title>
	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Business Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script>
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta-Tags -->
	<link rel="stylesheet" href="gd/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<link rel="stylesheet" href="gd/plugins/icheck-bootstrap/icheck-bootstrap.min.css">


	<link href="css1/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css1/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- //css files -->

	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<!-- //google fonts -->
	<style>
		@media (max-width: 800px) {
			.omg {
				display: none;

			}

			.leftHalf {
				display: none;

			}



			.input-padding {
				// remove border completely
				border: none;

				// don't forget to use the browser prefixes
				box-shadow: 0 0 0 1px silver;

				// Use PERCENTAGES for at least the horizontal padding
				padding: 5%;

				// 100% - (2 * 5%)
				width: 90%;


			}


		}

		#togglePassword {
			margin-left: 400px;
			margin-top: -35px;
			cursor: pointer;
		}

		.leftHalf {
			background: url('logo123.jpg');
			background-repeat: no-repeat;
			background-size: 100% 100%;
			width: 50%;
			position: absolute;
			left: 0px;
			top: 0px;
			height: 100%;

		}
	</style>
</head>

<body>

	<div class="signupform">
		<div class="container" style="width:100%" style="">
			<!-- main content -->
			<div class="agile_info" style="b-color:red">
				<div class="left_grid_info" style="width:60%">
					<div class="leftHalf"></div>
				</div>
				<div class="w3_info" style="">
					<center>
						<h2 style="font-family:Arial" style="color:blue"><img src="https://shibaexpress.vn/wp-content/uploads/2022/09/737C39E8-FED6-4FD7-8902-E5A551DE2CEB-removebg-preview.png" width=150px height=70px></h2>




						<?php


						if (isset($_GET['code'])) {
							$laydulieu = mysqli_num_rows(mysqli_query($conn, "select * from ns_user where hash_code='" . $_GET['code'] . "'"));
							if ($laydulieu >= 1) {
								echo '<p  style="font-family:Times new roman">Nhập code được gửi vào email để đăng nhập vào hệ thống</p>

				<form action="" method="post">
					<div class="input-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<input type="text" placeholder="Enter 2FA Code" required  name="f2a_code"> 
					</div>
										
						<button class="btn btn-danger btn-block" style="background-color:blue" name="btn_logincode" type="submit">Đăng Nhập</button >                
				</form>';
							} else {
								header('Location: login.php');
							}
						} else {
							echo '
				<p  style="font-family:Times new roman;color:#FFCC00">						<span class="fa fa-user" aria-hidden="true"></span>
Vui lòng nhập thông tin tài khoản để đăng nhập.</p>

				<form action="" method="post">
					<label style="font-weight:bold;color:blue">Tài khoản (USER NAME)</label>
					<div class="input-group">
						<span class="fa fa-envelope" aria-hidden="true"></span>
						<input type="text" placeholder="Enter Username" required  name="username"> 
					</div>
					<label style="font-weight:bold;color:blue">Mật khẩu (PASSWORD)</label>
					<div class="input-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<input type="Password" placeholder="Enter Password" name="password"  id="password"  required>
						                <i class="fa fa-eye" id="togglePassword" style=""></i>

					</div></p> </center>
					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox"  checked="" required><i> </i>Tuân thủ <button  type="button"  style="  background: none!important;
  border: none;
  padding: 0!important;
  /*optional*/
  font-family: arial, sans-serif;
  /*input has OS specific font-family*/
  color: #069;
  text-decoration: underline;
  cursor: pointer;"  data-toggle="modal" data-target="#exampleModal">Điều Khoản Sử Dụng Dịch Vụ của SHIBAVN EXPRESS!</button></label>
					</div>						
						<button class="btn btn-danger btn-block" style="background-color:#FFCC00" name="btn_login" type="submit">Đăng Nhập</button >                
				</form>
				
				
				<p class="account"></p>
				<p class="account1">Nếu chưa có tài khoản ? <a href="" <button  type="button"  style="  background: none!important;
  border: none;
  padding: 0!important;
  /*optional*/
  font-family: arial, sans-serif;
  /*input has OS specific font-family*/
  color: #069;
  text-decoration: underline;
  cursor: pointer;"  data-toggle="modal" data-target="#exampleModalreg">Đăng ký tại đây</a></p>
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
						<h5 class="modal-title" id="exampleModalLabel">Điều Khoản Sử Dụng Dịch Vụ SHIBAVN</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					</div>
				</div>
			</div>
		</div>








		<div class="modal fade  bd-example-modal-l" id="exampleModalreg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel" style="color:blue;text-align:center">REGISTER USER FOR SHIBAVN SYSTEM</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<!-- /.card-header -->
						<!-- form start -->


						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" style="background-color:#EEEEEE;color:blue;">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Customers</a>
							</li>
							<li class="nav-item" style="background-color:#EEEEEE;color:blue;">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">SHIBAVN Staff</a>
							</li>

						</ul>
						<div class="tab-content" id="myTabContent">

							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<form action="" method="POST" enctype="multipart/form-data" class="w3-container">

									<!-- /.Register FWD -->





									<div class="form-group">
										<label for="">Username(Your Email ID)</label>
										<input type="email" name="username" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Xin vui lòng nhập chính xác Email">
									</div>
									<div class="form-group">
										<label for="">Password</label>
										<input type="text" name="password" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Password">
									</div>
									<div class="form-group">
										<label for="">Key for Accountant(* Key dành cho kế toán)</label>
										<input type="text" name="accountant_key" value="" class="w3-input w3-border-bottom input-padding" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" title="Key cần ít nhất 10 ký tự, bao gồm chữ thường , chữ viết hoa và số Vd:SangSHIBAVN2023" required placeholder="Ít nhất 10 ký tự gồm chữ thường, chữ hoa, số">
									</div>








									<!-- /.Register FWD -->






									<div class="form-group">
										<label for="">Tên Công Ty (Company Name)</label>
										<input type="text" name="congty" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Tên công ty">
									</div>
									<div class="form-group">
										<label for="">Tên Liên Hệ (Contact Name)</label>
										<input type="text" name="tenlienhe" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Tên liên hệ">
									</div>
									<div class="form-group">
										<label for="">Mã Số Thuế</label>
										<input type="text" name="mst" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Nhập Mã số thuế">
									</div>
									<div class="form-group">
										<label for="">Điện thoại</label>
										<input type="text" name="nguoigui_phone" class="w3-input w3-border-bottom input-padding" placeholder="Nhập SĐT" required>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
										<select class="w3-input w3-border-bottom input-padding" id="nguoigui_tp-dropdown" name="nguoigui_tp">
											<?php
											$provinces = mysqli_query($conn, "SELECT * FROM yn_province order by id asc");
											echo '<option value="">Chọn tỉnh/thành phố</option>';
											while ($item = mysqli_fetch_array($provinces, MYSQLI_ASSOC)) {
												echo '
								<option value="' . $item['id'] . '">' . $item['name'] . '</option>
								';
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="control-label">Quận/Huyện</label>
										<select class="w3-input w3-border-bottom input-padding" name="nguoigui_districtid" id="nguoigui_district-dropdown">

										</select>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="control-label">Phường/Xã</label>
										<select class="w3-input w3-border-bottom input-padding" name="nguoigui_wardid" id="nguoigui_ward-dropdown">

										</select>
									</div>
									<div class="form-group">
										<label for="">Địa chỉ</label>
										<input type="text" name="nguoigui_add" class="w3-input w3-border-bottom input-padding" placeholder="Nhập địa chỉ">
									</div>


									<div class="form-group">
										<label for="">Upload Logo Công ty </label>
										<?php
										echo '<input type="file" required class="form-control  custom-file-upload" name="imagecongty" id = "imagecongty">';
										?>

									</div>
									<center> <button type="submit" name="btn_registerfwd" class="btn btn-danger">ĐĂNG KÝ</button></center>
								</form>
							</div>


							</form>


							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<form action="" method="POST" class="w3-container">

									<div class="form-group">
										<label for="">Username (Your Email)</label>
										<input type="email" name="username" value="" class="w3-input w3-border-bottom input-padding" required placeholder="">
									</div>
									<div class="form-group">
										<label for="">Password</label>
										<input type="text" name="password" value="" class="w3-input w3-border-bottom input-padding" required placeholder="">
									</div>

									<div class="form-group">
										<label for="">CHỨC VỤ</label>
										<select class="w3-input" name="roleid" required>
											<option value="">Chọn chức vụ nhân viên</option>
											<option value="3">Accountant</option>
											<option value="4">Document Staff</option>
											<option value="5">OPS & PICKUP</option>
											<option value="6">Salesman</option>
										</select>
									</div>
									<?php
									echo '
				<div class="form-group">

				<label for="" class="control-label">Chọn chi nhánh</label>
					<select required class="w3-input"name="kg_chinhanh" id="">';

									echo '<option value="HCM" selected>HCM</option>';
									echo '<option value="HN">HN</option>';
									echo '<option value="DAD">DAD</option>';

									echo '</select>
				</div>';
									?>
									<div class="form-group">
										<label for="">Tên Liên Hệ (Contact Name)</label>
										<input type="text" name="tenlienhe" id="tenlienhe" value="" class="w3-input w3-border-bottom" required placeholder="">
									</div>

									<div class="form-group">
										<label for="">Điện thoại</label>
										<input type="text" name="nguoigui_phone" class="w3-input w3-border-bottom" placeholder="" required>
									</div>

									<div class="form-group">
										<label for="">Địa chỉ</label>
										<input type="text" name="nguoigui_add" class="w3-input w3-border-bottom" placeholder="">
									</div>
									<center>
										<button type="submit" name="btn_register" class="btn btn-danger">ĐĂNG KÝ</button>
									</center>
								</form>


							</div>
						</div>






						<div class="modal-footer">
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
		<script src="gd/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</body>
<script>
	const togglePassword = document
		.querySelector('#togglePassword');


	const password = document.querySelector('#password');
	togglePassword.addEventListener('click', () => {
		// Toggle the type attribute using
		// getAttribure() method
		const type = password
			.getAttribute('type') === 'password' ?
			'text' : 'password';
		password.setAttribute('type', type);
		// Toggle the eye and bi-eye icon
		this.classList.toggle('fa fa-eye-slash');
	});
</script>
<script type="text/javascript">
	$('#nguoigui_tp-dropdown').on('change', function() {
		var province_id = this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				province_id: province_id,
				action: "filterDistrict"
			},
			cache: false,
			success: function(result) {
				$("#nguoigui_district-dropdown").html(result);
				$("#nguoigui_ward-dropdown").html('<option value=""></option>');
			}
		});
	});

	$('#nguoigui_district-dropdown').on('change', function() {
		var district_id = this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				district_id: district_id,
				action: "filterWard"
			},
			cache: false,
			success: function(result) {
				$("#nguoigui_ward-dropdown").html(result);
			},
			error: function(xhr, textStatus, error) {
				console.log(xhr.statusText);
				console.log(textStatus);
				console.log(error);
			}
		});
	});
</script>


</html>