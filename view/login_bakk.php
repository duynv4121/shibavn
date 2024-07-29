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
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>SHIBAEXPRESS.VN</title>

    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google fonts
    <link href="//fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="css/style_login.css" type="text/css" media="all" />

</head>

<body>
    <div class="w3l-loginblock signinform">
        <div class="logo">
            <a class="brand-logo" href="index.html">SHIBAEXPRESS SYSTEM V1.0</a>
        </div>
        <!-- main content -->
            <div class="row map-content-9">
                <div class="info-grids">
                    <form action="#" method="post" class="">
                        <div class="form-grid">
                            <div class="input-field">
                                <label> Username or Email </label>
                                <input type="text" name="username"  id="email" placeholder="Username or Email" required="">
                            </div>
                            <div class="input-field">
                                <label> Password</label>
                                <input type="password" name="password"  id="Password" placeholder="Password" required="">
                            </div>
                        </div>
                        <label class="check-remaind">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            <p class="remember">Remember Me</p>

                        </label>
                        <button type="submit" class="btn btn-primary btn-style"  name="btn_login"  style="background-color:#999900">Login now</button>
                    </form>
                </div>
                <div class="info-grids social-login-details align-self">
                    <img src="https://shibaexpress.vn/wp-content/uploads/2022/09/737C39E8-FED6-4FD7-8902-E5A551DE2CEB-removebg-preview.png">
                </div>
            </div>
        <!-- //main content -->
        <!-- footer -->
        <div class="footer">
            <p>&copy; 2024 Hệ thống quản lý vận đơn và tracking ShibaExpress | Homepage <a href="https://shibaexpress.vn/"
                    target="">https://shibaexpress.vn/</a></p>
        </div>
        <!-- footer -->
    </div>

    <!-- fontawesome v5-->
    <script src="js/fontawesome_login.js"></script>

</body>

</html>