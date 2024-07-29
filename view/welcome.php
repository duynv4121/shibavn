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

if(isset($_GET['delete']))
{
	mysqli_query($conn,"DELETE FROM `ksn_tintuc` WHERE (`id`='".$_GET['delete']."')");
}

if(isset($_POST['special_on']))
{
	mysqli_query($conn,"UPDATE `ksn_tintuc` SET `special`='1' WHERE (`id`='".$_POST['idtintuc']."')");
}
if(isset($_POST['special_off']))
{
	mysqli_query($conn,"UPDATE `ksn_tintuc` SET `special`='0' WHERE (`id`='".$_POST['idtintuc']."')");
}

?>

<div class="container-fluid">
   <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
   </div> -->
   <div class="row">

	 
<div class="col-md-12" style="margin-bot:5px">
<?php 
if($roleid == 1 || $roleid == 4|| $roleid == 3)
{
	echo'<a href="create_news.php" class="btn btn-primary">THÊM THÔNG BÁO</a><br><br>';
}
?>
</div>






<div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header" style="background-color:#999900">
              <h3 class="card-title" style="color:white"><i class="fas fa-bullhorn"></i>
THÔNG BÁO VÀ TIN TỨC MỚI</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Tìm kiếm">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
				  
				  <?php 
				  $dulieutintuca = mysqli_query($conn,"select * from ksn_tintuc order by id DESC");
				  $laydulieutintuc = mysqli_query($conn,"select * from ksn_tintuc order by id DESC");
				  while($dulieutintuc = mysqli_fetch_array($dulieutintuca,MYSQLI_ASSOC))
				  {
					  $thongtinuser = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='".$dulieutintuc['uid']."'"));

					  echo'<tr>
                  
                    <td class="mailbox-star"><i class="fas fa-newspaper"></i></td><td>';
					if($dulieutintuc['special'] == 1)
					{
						echo'<font color=red>Important</font>';
					}
					
					echo'</td>
                    <td class="mailbox-name"><i class="fas fa-user-edit"></i> '.$thongtinuser['ten'].'</td>
                    <td class="mailbox-subject"><a href="tintuc.php?id='.$dulieutintuc['id'].'"><b>'.$dulieutintuc['tieude'].'
</b>
                    </td>
                    <td class="mailbox-attachment">
					';
					if($dulieutintuc['filedinhkem'] != "")
					{
					echo'<a href="'.$dulieutintuc['filedinhkem'].'"><i class="fas fa-paperclip"></i> Tải File đính kèm</a>';
					}
					echo'</td>
                    <td class="mailbox-date">'.time_elapsed_string($dulieutintuc['datetime']).'</td>';
					
					
if($roleid == 1 || $roleid == 4)
					{
						if($dulieutintuc['special'] == 1){
						echo'<td><form action="" method="POST"><button type="submit" class="btn btn-danger btn-sm" name="special_off"><input type="hidden" value="'.$dulieutintuc['id'].'" name="idtintuc">Tắt Nổi Bật</button></a></form>';
						}
						else
						{
						echo'<td><form action="" method="POST"><button type="submit" class="btn btn-warning btn-sm" name="special_on"><input type="hidden" value="'.$dulieutintuc['id'].'" name="idtintuc">Nổi Bật</button></a></form>';
						}	
						echo'<td><a href="edit_news.php?id='.$dulieutintuc['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a> <a href="welcome.php?delete='.$dulieutintuc['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>';
					}
					echo'</td>
                  </tr>
				  
				  
				  ';
				  }
		
				  ?>
                  
                  
                  
               
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              
            </div>
          </div>
          <!-- /.card -->
        </div>











	 
   </div>
</div>


		<?php
		$hot_newa = mysqli_query($conn,"select * from ksn_tintuc where special='1' ORDER BY datetime DESC");
		$i = 1;
		while($how_new = mysqli_fetch_array($hot_newa))
		{
			echo' <div class="modal fade" id="modal-x'.$i.'">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header" style="background-color:blue;color:white">
              <h4 class="modal-title">'.$how_new['tieude'].'</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             '.$how_new['noidung'].'
            </div>
            <div class="modal-footer justify-content-between">
              '.$how_new['datetime'].'
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  ';
	  $i++;
		}
		?>
     
	  
	  
	  
	  
<?php  
    include('footer.php');
?>


<?php


if(!($_SESSION['check_new_red']))
{
echo"
<script type=\"text/javascript\">
    $(window).on('load', function() {
        $('#modal-x1').modal('show');
        $('#modal-x2').modal('show');
        $('#modal-x3').modal('show');
 
    });
</script>";
}

$_SESSION['check_new_red'] = 1;
?>
