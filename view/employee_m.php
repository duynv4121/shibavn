<?php  
    include('top.php');
    include('common.php');

    if (isset($_POST['btn_submit'])) {
       $username = trim($_POST['username']);
       $password = $_POST['password'];
       $ten = $_POST['ten'];
       $congty = "NewSky Express";
       $congty = cvtext($congty);
       $add = "Kho 5, A77 Bạch Đằng, Phường 2, Quận Tân Bình, Tp. Hồ Chí Minh";
       $add = cvtext($add);
       $phone = "0377.88.9993";
       $phone = cvtext($phone);
       $web = "www.newskyexpress.com.vn";
       $web = cvtext($web);
       $ctyghitat = "NS";
       $email = "nicknguyen.newskyvn@gmail.com";
       $email = cvtext($email);

       $count = mysql_num_rows(mysql_query("SELECT * FROM ns_user WHERE username = '$username'"));
       if ($count != 0) {
          echo'<script> 
            alert("Đã có nhân viên này!");
           </script>';
       }else{
            mysql_query("INSERT INTO `ns_user` (`username`, `password`, `roleid`, `ten`,`congty`,`diachi`,`phone`,`website`,`ctyghitat`,`email`)
            VALUES ('$username','$password', '2', '$ten','$congty','$add','$phone','$web','$ctyghitat','$email')") or die(mysql_error()); 

          echo'<script> 
               alert("Tạo thành công!");
              </script>';
       }
    }
?>

<div class="container-fluid">
   <div class="row">
      <div class="col-md-3">
         <form action="" method="POST">
            <h5>Tạo nhân viên mới</h5>
            <hr>
            <div class="form-group" >
               <label for="">Username </label>
               <input type="text" required name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group" >
               <label for="">Password </label>
               <input type="text" required name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group" >
               <label for="">Tên </label>
               <input type="text" required name="ten" class="form-control" placeholder="Tên">
            </div>
            <button type="submit" name="btn_submit" class="btn btn-success">Tạo</button>
         </form>
      </div>
      <div class="col-md-9">
         <table id="example2" class="table table-hover table-bordered table-striped" data-page-length='50'  data-order='[[0, "asc"]]'>
            <thead style="color:blue">
               <tr>
                  <th style="text-align: center;color:#00a5e4">STT</th>
                  <th style="text-align: center;color:#00a5e4">Username</th>
                  <th style="text-align: center;color:#00a5e4">Password</th>
                  <th style="text-align: center;color:#00a5e4">Tên</th>
                  <th style="text-align: center;color:#00a5e4"></th>
               </tr>
            </thead>
            <tbody>

               <?php
               $data = mysql_query("SELECT * FROM ns_user WHERE roleid = 2 ");
               $i = 0;
               while($item = mysql_fetch_array($data))
               {  
                  $i++;
                  echo '<tr>
                     <td style="text-align: center; color:black">'.$i.'</td>
                     <td style="text-align: center; color:black">'.$item['username'].'</td>
                     <td style="text-align: center; color:black">'.$item['password'].'</td>
                     <td style="text-align: center; color:black">'.$item['ten'].'</td>
                     <td style="text-align: center; color:black">
                        <a href="edit_emp.php?id='.$item['id'].'" type="button" class="btn btn-warning"><i class="far fa-edit"></i></a>
                     </td>
                  </tr>';
               }
               ?>

            </tbody>
         </table>
      </div>
   </div>
</div>

<?php  
    include('footer.php');
?>

<script type="text/javascript">
   $('#example2').DataTable({
      scrollX: true,
      "aaSorting": []
   })
</script>