<?php  
    include('top.php');
    include('modals.php');
    include('../controller/bill.php');
    loadModalScanPackage();
	
	if($roleid != 2)
	{
		echo'
		<script> 
							window.location = "welcome.php";

              </script>';
	}
	
	include 'thanhtoan/config.php';
	include 'thanhtoan/lib/nganluong.class.php';
$flag = true;


if (isset($_POST['btn_updatelogo'])) {
		
			### Upload hình
			
			$idusera = $datauser['id'];
			
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
			mysqli_query($conn,"UPDATE `ns_user` SET `logo`='".$target_fileb."' WHERE (`id`='$idusera')");
			echo'<script> 
               alert("Thay đổi logo thành công!");
							window.location = "change_password.php";

              </script>
			  
			  
			  
			  ';			
		  } else {
			echo "Sorry, there was an error uploading your file.";
		  }
		}
			
	
      
		
		
		
		
	}

if(isset($_POST['btn_submit'])) {
	$newpass = $conn->real_escape_string($_POST['newpass']);
	$oldpass = $conn->real_escape_string($_POST['oldpass']);
	$renewpass = $conn->real_escape_string($_POST['renewpass']);
	$accountant_key = $conn->real_escape_string($_POST['accountant_key']);
	$opt_key = $conn->real_escape_string($_POST['opt_key']);
	
		$sql = "select * from ns_user where username = '".$datauser['username']."' and f2a_code = '$opt_key' " ;
		$sql2 = mysqli_query($conn,"select * from ns_user where username = '".$datauser['username']."' and password = '$oldpass' ");
        $query = $conn->query($sql);
        $num_rows = mysqli_num_rows($query);
        $num_rows_old = mysqli_num_rows($query2);
        $checkdulieu = mysqli_fetch_assoc($query);
        if ($num_rows==0 || strlen($opt_key)!= 7) {
            echo'<script> 
                alert("F2A code không đúng hoặc đã hết thời gian! Xin nhập lại");
            </script>';
        }else if(mysqli_num_rows($sql2) == 0)
		{
			  echo'<script> 
                alert("Mật khẩu cũ nhập lại không chính xác");
            </script>';
		}else if ($laytiemnow > $checkdulieu['f2a_expired'])
		{
			echo'<script> 
                alert("Mã đã quá hạn, xin hãy lấy mã khác");
            </script>';
		}
		else
		{
			
			if($newpass != $renewpass)
			{
			echo'<script> 
                alert("Mật khẩu 2 lần nhập không trùng khớp xin hãy thử lại");
            </script>';
			}
			else
				{
				mysqli_query($conn,"UPDATE `ns_user` SET `password`='$newpass', `accountant_key`='$accountant_key' WHERE (`id`='$uid')");
				echo'<script> 
					alert("Cập nhật mật khẩu mới thành công ! Hệ thống tự động thoát để đăng nhập lại");
												window.location = "logout.php";

				</script>';
			}
		}

}
	/*if($uid != 1)
	{
		echo'<script> 
               window.location.href="list_packfwd.php";
            </script>';
	}
	*/
?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> --> 

      
   
   
   
   <div class="row">
		<!--
      <div class="col-md-4">
			
		
				<div class="card card-danger">
<div class="card-header">
<h3 class="card-title">				Thay đổi thông tin dữ liệu mật khẩu 
</h3>
</div>
<div class="card-body">   <form action="" method="POST">

				<div class="form-group" >
					<label for="">Nhập mật khẩu cũ</label>
					<input type="password" name="oldpass" class="form-control" placeholder="" required>
				</div>
				<div class="form-group" >
					<label for="">Mật khẩu mới</label>
					<input type="password" name="newpass" class="form-control" placeholder="" required>
				</div>
				
				
				<div class="form-group">
					<label for="" class="control-label">Nhập lại mật khẩu mới</label>
										<input type="password" name="renewpass" class="form-control" placeholder="" required>

				</div>
				
				<div class="form-group">
					<label for="" class="control-label">Nhập Key for Accountant(mật khẩu xem debit)</label>
										<input type="text" name="accountant_key" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}"
  title="Key cần ít nhất 10 ký tự, bao gồm chữ thường , chữ viết hoa và số Vd:SangGPE2023" required placeholder="Ít nhất 10 ký tự gồm chữ thường, chữ hoa và số">

				</div>
				
				<div class="form-group">
					<label for="" class="control-label" >Nhập mã OPT</label>
					<input type="text" name="opt_key" class="form-control" placeholder="" required><button id="get_opt" required>Nhận OPT</button>


				</div>
					
					</div>
<div class="card-footer">
				<button type="submit" name="btn_submit" class="btn btn-danger"><i class="fas fa-user-edit"></i>  UPDATE PASSWORD</button>   </form>

</div>
</div>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a>
            </tbody>
         </table>
      </div> 
	  -->
	  
	  
	  
	  <div class="col-md-4">
			
		
				<div class="card card-info">
<div class="card-header">
<h3 class="card-title">				Thay đổi Logo công ty 
</h3>
</div>
<div class="card-body">	<form action="" method="POST" enctype="multipart/form-data">
Logo hiện tại<br>

<div >
<?php echo '<img src="../inbill/inbilltw/'.$datauser['logo'].'" style="width:280px;height:90px; border:1px solid black; object-fit: contain;
">';?>
</div>
<hr>
				<div class="form-group">
					<label  for="">Upload Logo Công ty( Kích thước tiêu chuẩn: (280x90 pixcels) </label>
					<?php
					if($uid == 1)
					{
						echo'<input type="file" required class="form-control  custom-file-upload" name="imagecongty" id = "imagecongty">';
					}
					else
					{
						echo'<input type="file" class="form-control  custom-file-upload" name="imagecongty" id = "imagecongty">';
					}
					?>
					
				</div>
				
					
					</div>
<div class="card-footer">
				<button type="submit" name="btn_updatelogo" class="btn btn-info"><i class="fas fa-user-edit"></i> UPDATE LOGO</button>   </form>

</div>
</div>
               <!-- <a href="trackingview.php?id='.$item['id'].'" type="button" class="btn btn-info"><i class="fas fa-search-location"></i></a> -->
            </tbody>
         </table>
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