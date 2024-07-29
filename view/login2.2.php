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
		$count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ns_user WHERE username = '$username'"));
		if ($count != 0) {
          echo'<script> 
            alert("Username đã được sử dụng, xin hãy đổi và thử lại!");
           </script>';
		}else{
			
			
			
			$active = 1;
			
			
			
			$nguoigui_phone = $conn->real_escape_string($_POST['nguoigui_phone']);

			$nguoigui_add = $conn->real_escape_string($_POST['nguoigui_add']);
			@$website = $_POST['website'];
			$congno = '99';
			$accountant_key = $conn->real_escape_string($_POST['accountant_key']);
			
            mysqli_query($conn,"INSERT INTO `ns_user` (`username`, `password`,`ten`,`congty`,`roleid`,`ctyghitat`,`phone`,`diachi`,`website`,`payment_type`,`mst`,`payment_price_type`,`created_at`,`active`,`accountant_key`)
            VALUES ('$username','$password','$tenlienhe', '$congty', 2, '$ctyghitat','$nguoigui_phone','$nguoigui_add','$website','$congno','$mst','$payment_price_type','$datenow','$active','$accountant_key')") or die(mysqli_error()); 
		
			
			$laysoid = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where username='$username'"));
			mysqli_query($conn,"INSERT INTO `ns_maprole` (`roleid`, `userid`, `subroleid`) VALUES ('2', '".$laysoid['id']."', '3')");
			
			$idusera = $laysoid['id'];
			
			$nguoigui_name = $conn->real_escape_string($_POST['congty']);
			$nguoigui_tp = $conn->real_escape_string($_POST['nguoigui_tp']);
			@$nguoigui_districtid = $conn->real_escape_string($_POST['nguoigui_districtid']);
			@$nguoigui_wardid = $conn->real_escape_string($_POST['nguoigui_wardid']);
			$check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * 
FROM ns_customer 
WHERE id=(
    SELECT max(id) FROM ns_customer
    )"));
			
			
				$nguoigui_code = 'KG'.($check['id']+1);
				mysqli_query($conn,"INSERT INTO `ns_customer` (`name`,`cus_code`, `province_id`, `district_id`, `ward_id`,`address`,`phone`,`fwd`)
				VALUES ('$nguoigui_name','$nguoigui_code','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone','1')") or die(mysql_error()); 
				mysqli_query($conn,"UPDATE `ns_user` SET `cus_code`='$nguoigui_code' WHERE (`id`='$idusera')");
			
			
			
			### Upload hình
			
			
			
			$target_dir = "../inbill/inbilltw/";
			$target_file = $target_dir .$idusera.'-'. trim(basename($_FILES["imagecongty"]["name"]));
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						
			  $check = getimagesize($_FILES["imagecongty"]["tmp_name"]);
			  if($check !== false) {
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
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["imagecongty"]["tmp_name"], $target_file)) {
			  
			  			$target_fileb = $idusera.'-'. trim(basename($_FILES["imagecongty"]["name"]));

			//echo "The file ". htmlspecialchars( basename( $_FILES["imagecongty"]["name"])). " has been uploaded.";
			mysqli_query($conn,"UPDATE `ns_user` SET `logo`='".$target_fileb."' WHERE (`id`='$idusera')");
		  } else {
			echo "Sorry, there was an error uploading your file.";
		  }
		}
			
	
          echo'<script> 
               alert("Đăng ký tài khoản thành công, xin hãy đợi duyệt để đăng nhập vào hệ thống!");

              </script>
			  
			  
			  
			  ';
		}
		
		
		
		
	}
	
	
	
	if(isset($_POST['btn_register'])) {
		
		
		
		
		$username = $conn->real_escape_string(trim($_POST['username']));
		$password = $conn->real_escape_string($_POST['password']);
		@$congty = $conn->real_escape_string($_POST['congty']);
		$kg_chinhanh = $conn->real_escape_string($_POST['kg_chinhanh']);
		$tenlienhe = $conn->real_escape_string($_POST['tenlienhe']);
		$payment_price_type = '3';
		@$mst = $_POST['mst'];
		$ctyghitat = strtoupper($congty);
		$count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ns_user WHERE username = '$username'"));
		if ($count != 0) {
          echo'<script> 
            alert("Username đã được sử dụng, xin hãy đổi và thử lại!");
           </script>';
		}else{
			
			
		
				$active = 1;
			
			
			
			$nguoigui_phone = $conn->real_escape_string($_POST['nguoigui_phone']);

			$nguoigui_add = $conn->real_escape_string($_POST['nguoigui_add']);
			@$website = $_POST['website'];
			$congno = $_POST['congno'];
			$roleid = $_POST['roleid'];
			@$img_sign = $_POST['img_sign'];

            mysqli_query($conn,"INSERT INTO `ns_user` (`username`, `password`,`ten`,`congty`,`roleid`,`ctyghitat`,`phone`,`diachi`,`img_sign`,`created_at`,`kg_chinhanh`,`active`)
            VALUES ('$username','$password','$tenlienhe', 'GPE EXPRESS', $roleid, 'GPE EXPRESS','$nguoigui_phone','$nguoigui_add','$img_sign','$datenow','$kg_chinhanh','$active')") or die(mysqli_error()); 
			
			
			
			
			$laysoid = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where username='$username'"));
			
			if($laysoid['roleid'] == 6)
			{
				mysqli_query($conn,"UPDATE `ns_user` SET `hanmuc`='20000000' WHERE (`username`='$username')");
			}

			
			$idusera = $laysoid['id'];
			
			$nguoigui_name = $_POST['congty'];
			$nguoigui_tp = $_POST['nguoigui_tp'];
			@$nguoigui_districtid = $_POST['nguoigui_districtid'];
			@$nguoigui_wardid = $_POST['nguoigui_wardid'];
			$check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * 
FROM ns_customer 
WHERE id=(
    SELECT max(id) FROM ns_customer
    )"));
			
			
				$nguoigui_code = 'KG'.($check['id']+1);
				mysqli_query($conn,"INSERT INTO `ns_customer` (`name`,`cus_code`, `province_id`, `district_id`, `ward_id`,`address`,`phone`,`fwd`)
				VALUES ('$nguoigui_name','$nguoigui_code','$nguoigui_tp', '$nguoigui_districtid', '$nguoigui_wardid', '$nguoigui_add', '$nguoigui_phone','0')") or die(mysqli_error()); 
				mysqli_query($conn,"UPDATE `ns_user` SET `cus_code`='$nguoigui_code' WHERE (`id`='$idusera')");
			
			
			
			### Upload hình
			
			
			
	
          echo'<script> 
               alert("Đăng ký tài khoản nhân viên thành công, xin hãy đợi duyệt để đăng nhập vào hệ thống!");
							window.location = "m_admin.php?m=user";

              </script>
			  
			  
			  
			  ';
		}
		
		
		
		
	}
	
	
	
	
	
	
    if (isset($_POST['btn_logincode'])) {
		$f2a_code = $_POST['f2a_code'];
		$hash_code = $_GET['code'];
		$sql = "select * from ns_user where hash_code = '$hash_code' and f2a_code = '$f2a_code' " ;
        $query = $conn->query($sql);
        $num_rows = mysqli_num_rows($query);
        $checkdulieu = mysqli_fetch_assoc($query);
        if ($num_rows==0) {
            echo'<script> 
                alert("F2A code không đúng hoặc đã hết thời gian! Xin nhập lại");
            </script>';
        }  else if ($laytiemnow > $checkdulieu['f2a_expired'])
		{
			echo'<script> 
                alert("Mã đã quá hạn, xin đăng nhập lại để lấy lại mã");
            </script>';
		}
		else{
			
			
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
		
		$laydulieucheck = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_system where string_code='f2a_code'"));

        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
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
			if($layid['active'] == 1)
			{
				 echo'<script> 
                alert("Account đang chờ duyệt mới có thể sử dụng");
				window.location = "login.php";

				</script>';

				exit();
			}
			if($layid['active'] == 2)
			{
				 echo'<script> 
                alert("Account hiện đang tạm khóa, liên hệ hỗ trợ GPE để được xử lý");
				window.location = "login.php";

				</script>';

				exit();
			}
			if($layid['roleid'] == 10 || $laydulieucheck['status'] == 2)
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
				if($layid['roleid'] == 1)
				{
					
				$to = "tuyen.giaphuexpress@gmail.com";
				
				}
				else
				{
					$to = $layid['username'];
				}
				$subject = "Received OPT 2FA GPE System - Expired ".$f2a_expired ;
				//$message = "<html><body><center><table>Received OPT F2A GPE System. <br>- F2A Code: <b>".$f2a_code.'</b><br>- IP:'.$ip.'<br>F2A Expired Time (15 minutes): '.$f2a_expired.'</table></body></html>';
				$message = "<html><body style='background-color:gray'><center><table width='100%' height='100%' cellpadding='0' cellspacing='0' border='0'> <tbody><tr> <td> <table width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='background-color:#DDDDDD'> <tbody><tr> <td align='center' valign='middle' style='padding:33px 0'><a href=''><img src='https://giaphuexpress.com.vn/wp-content/uploads/2023/07/logo-gp.png.webp' width='200' height='120' style='border:0' ></a></td> </tr> <tr style='background-color:gray'> <td> <div style='padding:0 30px;background:#fff'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tbody><tr> <td style='border-bottom:1px solid #e6e6e6;font-size:18px;padding:20px 0'> <table border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody><tr> <td>Received OPT from GPE SYSTEM,<br>				Hello,				
				Your verification code:<font color=orange> <b>".$f2a_code."</b></font><br>  <br> <br> The verification code will be valid for 15 minutes. Please do not share this code with anyone.<br>
				<br>Your IP:".$ip."<br>2FA Expired Time (15 minutes): ".$f2a_expired."
				</td></tr>
				<tr>
				<td style='padding:30px 0 15px 0;font-size:12px;color:#999;line-height:20px'>
				GPE System<br>Automated message. Please do not reply.
				</td>
				</tr>
				 <tr>
                <td align='center' style='font-size:12px;color:#999;padding:20px 0'>© 2023 giaphuexpress.com All Rights Reserved<br>URL：<a style='color:#999;text-decoration:none' href='http://www.giaphuexpress.com.vn' target='_blank' >www.giaphuexpress.com.vn</a>&nbsp;&nbsp;E-mail：<a href='mailto:admin.giaphu@giaphuexpress.com' style='color:#999;text-decoration:none' target='_blank'>admin.giaphu@giaphuexpress.com</a></td>
				</tr>
				<td> </tbody></table></body></html>";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				mail('tructran13101996@gmail.com',$subject,$message, $headers);
				mail('hoangdungkt7@gmail.com',$subject,$message, $headers);
				mail('chuyenphatnhanh139@gmail.com',$subject,$message, $headers);
				mail('tuyen.giaphuexpress@gmail.com',$subject,$message, $headers);
				

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
				$mail->Username = "tructran13101996@gmail.com";
				//Password to use for SMTP authentication
				$mail->Password = "xlav kekw onhf nxgk";
				//Set who the message is to be sent from
				$mail->setFrom('tructran13101996@gmail.com', 'GPE Express');
				//Set an alternative reply-to address
				//Set who the message is to be sent to
				$mail->addAddress($to, 'GPE User');
				//Set the subject line
				  $mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body    = $message;
				//Replace the plain text body with one created manually
				$mail->AltBody = 'This is a plain-text message body';
				//Attach an image file
				//send the message, check for errors
				$mail->send();
				










				
				
			header('Location: login.php?code='.$hash_code);
			exit();
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
	  <link rel="stylesheet" href="gd/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	    <link rel="stylesheet" href="gd/plugins/icheck-bootstrap/icheck-bootstrap.min.css">


	<link href="css1/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css1/style.css" rel="stylesheet" type="text/css" media="all"/>
	<!-- //css files -->
	
	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<!-- //google fonts -->
	<style>
	@media (max-width: 767px) {
    .omg {
        display:none;
    }
}



.input-padding{
	// remove border completely
  border: none;

  // don't forget to use the browser prefixes
  box-shadow: 0 0 0 1px silver;

  // Use PERCENTAGES for at least the horizontal padding
  padding: 5%; 

  // 100% - (2 * 5%)
  width: 90%; 
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
				
					<img class="omg" src="banner1.jpg" alt="" />
				</div>
			</div>
			<div class="w3_info">
				<center><h2  style="font-family:Arial" style="color:blue">     <img src="logo.svg" width=230px height=120px>
</h2>
				
				
				
				
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
					<label style="font-weight:bold">Tài khoản (USER NAME)</label>
					<div class="input-group">
						<span class="fa fa-envelope" aria-hidden="true"></span>
						<input type="text" placeholder="Enter Username" required  name="username"> 
					</div>
					<label style="font-weight:bold">Mật khẩu (PASSWORD)</label>
					<div class="input-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<input type="Password" placeholder="Enter Password" name="password"  required>
					</div> </center>
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
						<button class="btn btn-danger btn-block" style="background-color:orange" name="btn_login" type="submit">Đăng Nhập</button >                
				</form>
				
				
				<p class="account"></p><!--
				<p class="account1">Nếu chưa có tài khoản ? <a href="" <button  type="button"  style="  background: none!important;
  border: none;
  padding: 0!important;
  /*optional*/
  font-family: arial, sans-serif;
  /*input has OS specific font-family*/
  color: #069;
  text-decoration: underline;
  cursor: pointer;"  data-toggle="modal" data-target="#exampleModalreg">Đăng ký tại đây</a></p>-->
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
	







<div class="modal fade  bd-example-modal-l" id="exampleModalreg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:blue;text-align:center">REGISTER USER FOR GPE SYSTEM</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
      </div>
      <div class="modal-body">

              <!-- /.card-header -->
              <!-- form start -->
		
				
					<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item"  style="background-color:#EEEEEE;color:blue;">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Customers</a>
  </li>
  <li class="nav-item"  style="background-color:#EEEEEE;color:blue;">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">GPE Staff</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <form action="" method="POST" enctype="multipart/form-data" class="w3-container">
		
			 <!-- /.Register FWD -->

				
					
				
				
				<div class="form-group" >
					<label for="">Username(Your Email ID)</label>
					<input type="email"  name="username" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Xin vui lòng nhập chính xác Email">
				</div>
				<div class="form-group" >
					<label for="">Password</label>
					<input type="text"  name="password" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Password">
				</div>
				<div class="form-group" >
					<label for="">Key for Accountant(* Key dành cho kế toán)</label>
					<input type="text"  name="accountant_key" value="" class="w3-input w3-border-bottom input-padding" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}"
  title="Key cần ít nhất 10 ký tự, bao gồm chữ thường , chữ viết hoa và số Vd:SangGPE2023" required placeholder="Ít nhất 10 ký tự gồm chữ thường, chữ hoa, số">
				</div>
				
				
				
			
			
			
				
				
							 <!-- /.Register FWD -->

					
				
				
				
				
				<div class="form-group" >
					<label for="">Tên Công Ty (Company Name)</label>
					<input type="text"  name="congty" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Tên công ty">
				</div>
				<div class="form-group" >
					<label for="">Tên Liên Hệ (Contact Name)</label>
					<input type="text"  name="tenlienhe" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Tên liên hệ">
				</div>
				<div class="form-group" >
					<label for="">Mã Số Thuế</label>
					<input type="text"  name="mst" value="" class="w3-input w3-border-bottom input-padding" required placeholder="Nhập Mã số thuế">
				</div>
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoigui_phone" class="w3-input w3-border-bottom input-padding" placeholder="Nhập SĐT" required >
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Tỉnh/Thành phố</label>
					<select class="w3-input w3-border-bottom input-padding" id="nguoigui_tp-dropdown" name="nguoigui_tp">
						<?php 
							$provinces = mysqli_query($conn,"SELECT * FROM yn_province order by id asc");
							echo '<option value="">Chọn tỉnh/thành phố</option>';
							while ($item = mysqli_fetch_array($provinces,MYSQLI_ASSOC)) {
								echo '
								<option value="'.$item['id'].'">'.$item['name'].'</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Quận/Huyện</label>
					<select  class="w3-input w3-border-bottom input-padding" name="nguoigui_districtid" id="nguoigui_district-dropdown">
						
					</select>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Phường/Xã</label>
					<select  class="w3-input w3-border-bottom input-padding" name="nguoigui_wardid" id="nguoigui_ward-dropdown">
						
					</select>
				</div>
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="w3-input w3-border-bottom input-padding"  placeholder="Nhập địa chỉ" >
				</div>
				
				
				<div class="form-group">
					<label  for="">Upload Logo Công ty </label>
					<?php
						echo'<input type="file" required class="form-control  custom-file-upload" name="imagecongty" id = "imagecongty">';
					?>
					
				</div>
				       				<center> <button type="submit" name="btn_registerfwd"class="btn btn-danger">ĐĂNG KÝ</button></center></form>
				</div>
				
			
	</form>
  
  
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><form action="" method="POST" class="w3-container">

				<div class="form-group" >
					<label for="">Username (Your Email)</label>
					<input type="email"  name="username" value="" class="w3-input w3-border-bottom input-padding"required placeholder="">
				</div>
				<div class="form-group" >
					<label for="">Password</label>
					<input type="text"  name="password" value="" class="w3-input w3-border-bottom input-padding"required placeholder="">
				</div>
				
				<div class="form-group" >
					<label for="">CHỨC VỤ</label>
					<select class="w3-input"name="roleid" required>
					<option value="">Chọn chức vụ nhân viên</option>
					<option value="3">Accountant</option>
					<option value="4">Document Staff</option>
					<option value="5">OPS & PICKUP</option>
					<option value="6">Salesman</option>
					</select>
				</div>
				<?php
				echo'
				<div class="form-group">

				<label for="" class="control-label">Chọn chi nhánh</label>
					<select required class="w3-input"name="kg_chinhanh" id="">';
					
							echo '<option value="HCM" selected>HCM</option>';
							echo '<option value="HN">HN</option>';
							echo '<option value="DAD">DAD</option>';
			
					echo'</select>
				</div>';
				?>
				<div class="form-group" >
					<label for="">Tên Liên Hệ (Contact Name)</label>
					<input type="text"  name="tenlienhe" id="tenlienhe" value="" class="w3-input w3-border-bottom"required placeholder="">
				</div>
				
				<div class="form-group">
					<label for="">Điện thoại</label>
					<input type="text" name="nguoigui_phone" class="w3-input w3-border-bottom"placeholder="" required >
				</div>
				
				<div class="form-group">
					<label for="">Địa chỉ</label>
					<input type="text" name="nguoigui_add" class="w3-input w3-border-bottom" placeholder="" >
				</div>
				<center>
				        <button type="submit" name="btn_register"class="btn btn-danger">ĐĂNG KÝ</button></center></form>

				
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

<script type="text/javascript">
	$('#nguoigui_tp-dropdown').on('change', function(){
		var province_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				province_id: province_id,
				action: "filterDistrict"
			},
			cache: false,
			success: function(result){
				$("#nguoigui_district-dropdown").html(result);
				$("#nguoigui_ward-dropdown").html('<option value=""></option>');
			}
		});
	});

	$('#nguoigui_district-dropdown').on('change', function(){
		var district_id=this.value;
		$.ajax({
			url: "../controller/ajax.php",
			type: "POST",
			data: {
				district_id: district_id,
				action: "filterWard"
			},
			cache: false,
			success: function(result){
				$("#nguoigui_ward-dropdown").html(result);
			},
		error: function(xhr, textStatus, error){
      console.log(xhr.statusText);
      console.log(textStatus);
      console.log(error);
  }
		});
	});

</script>


</html>
