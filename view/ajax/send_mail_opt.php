<?php 			
				include("../../conn/db.php");
				$to = $_POST['name'];
				$f2a_expired = date("Y/m/d H:i:s",strtotime("+15 minutes"));

				$hash_code =  hash('ripemd160', $to.$f2a_expired);
				$f2a_code = random_int(1000000, 9999999);

				mysqli_query($conn,"UPDATE `ns_user` SET `hash_code`='$hash_code',`f2a_code`='$f2a_code',`f2a_expired`='$f2a_expired' WHERE (`username`='$to')");
				
				
				$subject = "Received 2FA SHIBA System For Change Password - Expired ".$f2a_expired ;
				//$message = "<html><body><center><table>Received OPT F2A SHIBA System. <br>- F2A Code: <b>".$f2a_code.'</b><br>- IP:'.$ip.'<br>F2A Expired Time (15 minutes): '.$f2a_expired.'</table></body></html>';
				$message = "<html><body style='background-color:gray'><center><table width='100%' height='100%' cellpadding='0' cellspacing='0' border='0'> <tbody><tr> <td> <table width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='background-color:#DDDDDD'> <tbody><tr> <td align='center' valign='middle' style='padding:33px 0'><a href=''><img src='https://shibaexpress.vn/wp-content/uploads/2022/09/737C39E8-FED6-4FD7-8902-E5A551DE2CEB-removebg-preview.png' width='232' height='60' style='border:0' ></a></td> </tr> <tr style='background-color:gray'> <td> <div style='padding:0 30px;background:#fff'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tbody><tr> <td style='border-bottom:1px solid #e6e6e6;font-size:18px;padding:20px 0'> <table border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody><tr> <td>Received OPT from SHIBA SYSTEM,<br>				Hello,				
				Your verification code for Change Password:<font color=orange> <b>".$f2a_code."</b></font><br>  <br> <br> The verification code will be valid for 15 minutes. Please do not share this code with anyone.<br>
				<br>Your IP:".$ip."<br>2FA Expired Time (15 minutes): ".$f2a_expired."
				</td></tr>
				<tr>
				<td style='padding:30px 0 15px 0;font-size:12px;color:#999;line-height:20px'>
				SHIBA System<br>Automated message. Please do not reply.
				</td>
				</tr>
				 <tr>
                <td align='center' style='font-size:12px;color:#999;padding:20px 0'>© 2023 SHIBA.online All Rights Reserved<br>URL：<a style='color:#999;text-decoration:none' href='https://shibaexpress.vn/' target='_blank' >https://shibaexpress.vn/</a>&nbsp;&nbsp;E-mail：<a href='mailto:info@shibaexpress.vn' style='color:#999;text-decoration:none' target='_blank'>info@shibaexpress.vn</a></td>
				</tr>
				<td> </tbody></table></body></html>";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				mail('tructran13101996@gmail.com',$subject,$message, $headers);
				mail($to,$subject,$message, $headers);
				

				//Load composer's autoloader
				require '../PHPMailer-master/src/PHPMailer.php';
				require '../PHPMailer-master/src/SMTP.php';
				require '../PHPMailer-master/src/Exception.php';
			
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
				$mail->Password = "tjago123";
				//Set who the message is to be sent from
				$mail->setFrom('tructran13101996@gmail.com', 'SHIBA EXPRESS');
				//Set an alternative reply-to address
				//Set who the message is to be sent to
				$mail->addAddress($to, 'SHIBA User');
				//Set the subject line
				  $mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body    = $message;
				//Replace the plain text body with one created manually
				$mail->AltBody = 'This is a plain-text message body';
				//Attach an image file
				//send the message, check for errors
				$mail->send();
				
?>