<?php  
    include('top.php');
	
	function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline" style="">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class=""
                       src="shiba.png"
                       alt="User profile picture" width=300px height=100px>
                </div>

                <h3 class="profile-username text-center">SHIBA EXPRESS</h3>

                <p class="text-muted text-center">ADMIN SHIBA</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Contact Phone</b> <a class="float-right"> +84 848 025 555</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">infoshibaexp@gmail.com</a>
                  </li>
                  <li class="list-group-item"><center>
                    <img src="https://shibaexpress.vn/wp-content/uploads/2023/11/z4837251448862_44204f0dd1700d134eba4018a76063af-313x400.jpg">
                  </li>
                </ul>

                <a href="welcome.php" class="btn btn-primary btn-block"><b><i class="fas fa-step-backward"></i> Xem Tin Khác</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
		  
			<?php 
			$laydulieutintuc = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_tintuc where id='".$_GET['id']."'"));
					echo'<div class="card card-danger" >
			<div class="card-header" style="background-color:#999900">
				<h3 class="card-title" style="font-weight:bold;color:white">'.$laydulieutintuc['tieude'].'</h3>
				<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
</button>
				</div>

			</div>

			<div class="card-body" style="background-color:#EEE9E9">
			'.$laydulieutintuc['noidung'].'<br>
			';
			if($laydulieutintuc['filedinhkem'] != "")
					{
					echo'<hr><a href="'.$laydulieutintuc['filedinhkem'].'"><i class="fas fa-paperclip"></i> Tải File đính kèm</a>';
					}
			
			echo'
			</div>
			<div class="card-footer" style="  text-align: right;
">
		<i>	Ngày đăng: '.$laydulieutintuc['datetime'].'</i>
			</div>

			</div>
			
			
			';
					?>
			
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

<?php  
    include('footer.php');
?>
