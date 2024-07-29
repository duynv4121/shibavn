<script src="../vendor/jquery/jquery.min.js"></script>

<?php

include("../conn/db.php");
function compressImage($source, $destination, $quality) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}


$idbill = $_GET['id'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
     
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
      $ganthoigian = date("H_i_s");
		$newFileName = $idbill.'_'.$ganthoigian.'.'. pathinfo($_FILES["photo"]["name"] ,PATHINFO_EXTENSION); 

        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        // Xác minh phần mở rộng tệp
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");

        // Xác minh kích thước tệp - tối đa 5MB
        $maxsize = 20 * 1024 * 1024;
        if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
        
        // Xác minh loại MIME của tệp
        if(in_array($filetype, $allowed)){
            // Kiểm tra xem tệp có tồn tại hay không trước khi tải lên
            if(file_exists("../upload/" . $filename)){
                echo $filename . " đã tồn tại.";
            } else{
                $location = "../upload/" . $newFileName;
                $compressedImage = compressImage($_FILES["photo"]["tmp_name"],$location,60);

				if($compressedImage){ // có thể có lỗi
					mysql_query("UPDATE `ns_listhoadon` SET `img`='$newFileName' WHERE (`id`='$idbill')") or die(mysql_error());
				}else{
					echo "Lỗi: không thể di chuyển tệp đến upload/";
				}
            } 
        } else{
            echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
      .custom-file-upload {
        border: 1px dotted #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        background-color:#4797c7;
        color:white;
    }
    .button {
      display: inline-block;
      border-radius: 4px;
      background-color: green;
      border: none;
      color: #FFFFFF;
      text-align: center;
      font-size: 15px;
      padding: 5px;
      width: 110px;
      transition: all 0.5s;
      cursor: pointer;
  }

  .button span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
  }

  .button span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
  }

  .button:hover  {
      padding-right: 25px;
  }

  .button:hover :after {
      opacity: 1;
      right: 0;
      content: '\00bb';
      position: absolute;
      top: 0;
      right: -20px;
      transition: 0.5s;
  }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div style="text-align: center;" >
            <h3> Hình ảnh kiện hàng: #<?php echo $idbill;?> </h3>
        </div>
        <div class="container-fluid" style="text-align: center;">

            <input type="file" class="form-control custom-file-upload" name="photo" id = "fileSelect">
            <br>
            <input type="submit" style="float:right;" class="button btn btn-success " name="submit" value ="Cập Nhật">

            
        </div>
        <br><br>
        <div style="text-align:center;" class="container-fluid">
            <?php 
                $laythongtinbill = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_listhoadon WHERE `id`='$idbill'"));
                if($laythongtinbill['img'] == "")
                {
                  echo'<p>Kiện hàng vẫn chưa có hình ảnh</p>';
                }
                else
                {
                  echo'<p>Hình ảnh kiện hàng đã tải lên</p>';
                  echo'<br><img src="../upload/'.$laythongtinbill['img'].'" width=100% height=auto>';
                }
            ?>
        </div>

        
        
    </form>

</body>
</html>