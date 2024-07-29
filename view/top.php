<?php  
header('Content-type: text/html; charset=utf-8');

date_default_timezone_set('Asia/Ho_Chi_Minh');
$datenow = date("Y:m:d H:i:s");
@session_start();
include("../conn/db.php");
include('../controller/role.php');
include('../controller/user.php');
//co bug here
if (!isset($_SESSION['username']) || !isset($_SESSION['uid']) || $_SESSION['uid'] == "" || $_SESSION['uid'] == NULL) {
    header('Location: login.php');
    exit();
}
$uid = $_SESSION['uid'];
$roleid = $_SESSION['roleid'];
if (isset($_POST['btn_search'])) {
    $txt_search = $_POST['txt_search'];
    echo'<script> 
            window.location.href="searchview.php?id='.$txt_search.'";
        </script>';
}
if($_SESSION['web_code'] != 9991)
			{
				header('Location: logout.php');
			}

$listrole = setrole1($uid,$roleid,$conn);

function cvtext($dataadd){
	  $dataadd = str_replace("'", "" ,$dataadd);
	  return $dataadd;
	
  }
$tracking_url = "https://tscpost.com/?id=";

?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <?php
  if(strpos($_SERVER['REQUEST_URI'], "chamcong.php") !== false){
    echo '<meta http-equiv="refresh" content="5" > 
';
}
  ?>
  
  <title>Hệ Thống SHIBA EXPRESS</title>
	<link rel="icon" type="image/x-icon" href="">

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="gd/plugins/fontawesome-free/css/all.min.css">
  <script type="text/javascript" src="inbill/qrcode.min.js"></script>

  <!-- Ionicons -->
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="gd/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <script src="signature.js"></script>

  <link rel="stylesheet" href="gd/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="gd/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="gd/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="gd/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="gd/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="gd/plugins/summernote/summernote-bs4.min.css">
  
    <link rel="stylesheet" href="gd/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="gd/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  
  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/responsive.dataTables.min.css">
  
  <style>
		.grecaptcha-badge { visibility: hidden; }


		#wrapper1 {
			width: 400px;
			padding: 1px;
			  border: 1px solid #ddd;
            border-radius: 4px;
            background-color:#EEE9E9;
		}
		canvas {
			position: relative;
			margin: 1px;
			margin-left: 0px;
			border: 1px solid black;
			width: 100%;


			-webkit-tap-highlight-color: transparent;
		}
	
		#controlPanel {
			margin: 2px;
		}
		#saveSignature {
			display: none;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed"  onload=onReady()>
<div class="wrapper">

  <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="gd/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
 -->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color:#999900;color:white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"  style="background-color:#999900;color:white"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" >
        <a href="list_package.php" class="nav-link" style="background-color:#999900;color:white">Trang chủ</a>
      </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="welcome.php" class="nav-link"  style="background-color:#999900;color:white"><i class="fas fa-bullhorn" ></i> Tin Tức</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>
		

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
        		<!--    <!-- Message Start 
            <div class="media">
              <img src="gd/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start 
            <div class="media">
              <img src="gd/dist/img/user8-128x128.H" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End 
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start 
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>-->
            <!-- Message End 
          </a>
          <div class="dropdown-divider"></div>-->
		  Chưa có tin nhắn mới
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Chưa có thông báo mới</span>
         <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
		  -->
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
	  <!--
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
	  -->
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar idebar-light-maroon elevation-4" style="background-color:white">
    <!-- Brand Logo -->
    <a href="list_package.php" class="brand-link">
  <!--<img src="gd/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" >-->
     <img src="https://shibaexpress.vn/wp-content/uploads/2022/09/737C39E8-FED6-4FD7-8902-E5A551DE2CEB-removebg-preview.png" width=230px height=80px>
    </a>
   <?php  
                                    $datauser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id = '".$_SESSION['uid']."'"));
                                ?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="gd/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info" style="color:black;font-weight:bold;font-size:12px;">
		
		
         <?php echo $_SESSION['username'];?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
	  <!--
      <div class="form-inline" >
        <div class="input-group" data-widget="sidebar-search">
			<form action="tracking/index.php" method="GET">
          <input class="form-control-sidebar" type="search" style="padding:3px;
  box-sizing: border-box;
  border: 2px solid red;
  border-radius: 4px;" placeholder="Number Tracking ID " name="b" aria-label="Search">
            <button type="submit" class="">
              <i class="fas fa-search fa-fw"></i>
            </button>
		  </form>
        </div>
      </div>-->
	  <form action="https://app.shibaexpress.vn">
	        <div class="form-inline" >

	  <div class="input-group">
<input class="form-control form-control-sidebar" type="" name="b" placeholder="Number Tracking ID" aria-label="Search">
<div class="input-group-append" style="background-color:white">
<button type="submit"class="btn btn-sidebar" id="tracking_btn">
<i class="fas fa-search fa-fw"></i>
</button>
</div>
</div>  </div>
</form>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="color:white	">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			   
		  <?php
		  
		 if($roleid == 1 || $roleid == 4)
		 {
			 echo' <li class="nav-item">
            <a href="list_trackingbill.php" class="nav-link active" style="background-color:#999900">
<i class="nav-icon fas fa-map-marker-alt"></i>
              <p>Danh Sách Tracking</p>
            </a>
          </li>';
		 } if($roleid == 1 || $roleid == 2|| $roleid == 6)
		 {
				 echo' <li class="nav-item">
            <a href="m_document.php?m=dashboard" class="nav-link active" style="background-color:#999900">
<i class="nav-icon  fas fa-chart-line"></i>
              <p>Bảng Thống Kê</p>
            </a>
          </li>'; 
		
		 }
		if($roleid == 1)
		 {
				 echo' <li class="nav-item">
            <a href="m_document.php?m=dashboardsale" class="nav-link active" style="background-color:#999900">
<i class="nav-icon  fas fa-chart-line"></i>
              <p>Bảng Thống Kê Sale</p>
            </a>
          </li>';  echo' <li class="nav-item">
            <a href="m_document.php?m=dashboardfwd" class="nav-link active" style="background-color:#999900">
<i class="nav-icon  fas fa-chart-line"></i>
              <p>Bảng Thống Kê FWD</p>
            </a>
          </li>'; 
		 }
		
		
	
		  
		  
		  if($roleid == 1   || $roleid == 3 || $roleid == 4)
			{
				echo'<li class="nav-item">
            <a href="create_package.php" class="nav-link active" style="background-color:#999900">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Tạo Hóa Đơn
              </p>
            </a>
</li>

';
			}
		if($roleid == 1 || $roleid == 3 || $roleid == 4)
			{
			echo'

<li class="nav-item">
            <a href="list_package.php?status=0" class="nav-link active" style="background-color:#999900">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Danh Sách Hóa Đơn</p>
            </a>
</li>  ';  echo'
          <li class="nav-item">
            <a href="shipments.php" class="nav-link active" style="background-color:#999900">
              <i class="nav-icon fas fa-plane-departure"></i>
              <p>
                Quản Lý MAWB
              </p>
            </a>
        
          </li>'; 
		  
			}if($roleid == 2|| $roleid == 6)
			{
					echo'<li class="nav-item">
            <a href="create_package.php" class="nav-link active" style="background-color:#999900">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Tạo Hóa Đơn
              </p>
            </a>
</li>

';
			echo'

<li class="nav-item">
            <a href="list_package.php" class="nav-link active" style="background-color:#999900">
              <i class="nav-icon fas fa-cubes"></i>
              <p>Danh Sách Hóa Đơn</p>
            </a>
</li>  '; 
			}
		  ?>
			
		<?php
			 if($roleid == 2 || $roleid == 1)
			{
				echo'
				  <li class="nav-item">
					<a href="get_api_document.php" class="nav-link active" style="background-color:#999900">
<i class="nav-icon fas fa-link"></i>					  <p>
						API DOCUMENT
					  </p>
					</a>
				
				  </li>';
				
			}
			if($roleid == 2 || $roleid == 4 || $roleid == 1|| $roleid == 6)
			{
		echo'<li class="nav-item">
            <a href="list_package_bulk.php" class="nav-link active " style="background-color:#999900">
              <i class="nav-icon fas fa-upload"></i>
              <p>
                Bulk Upload
              </p>
            </a>
			</li>';
			}
			
			if($roleid ==  1 || $roleid == 5|| $roleid == 4|| $roleid == 3)
			{
		echo'
          <li class="nav-header" style="color:black">HỆ THỐNG SCAN</li>
          <!--<li class="nav-item">
            <a href="pages/calendar.html" class="nav-link" >
              <i class="fa fa-qrcode" aria-hidden="true"></i>

              <p  >
                Scan Kiện Nhỏ
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>-->
          <li class="nav-item">
            <a href="scan_nhap.php" class="nav-link" style="color:black">
                  <i class="fa fa-qrcode nav-icon"></i>
              <p  style="color:black">
                Scan nhập hàng
              </p>
            </a>
          </li> 
		  
          <li class="nav-item">
            <a href="scan_xuat_for_doc.php" class="nav-link"  style="color:black">
                  <i class="fa fa-qrcode nav-icon"></i>
              <p  style="color:black">
               Scan xuất hàng
              </p>
            </a>
          </li>
		  
		  
		  <li class="nav-item">
            <a href="scan_return.php" class="nav-link" style="color:black">
                  <i class="fa fa-qrcode nav-icon"></i>
              <p>
               Scan trả hàng 
              </p>
            </a>
          </li>
		
		  ';
			}
			
			if($roleid == 2){
			 echo'
          <li class="nav-item">
            <a href="list_debit.php" class="nav-link active" style="background-color:#999900">
            <i class="fas fa-credit-card nav-icon"></i>
              <p>
                DEBIT Manager
              </p>
            </a>
        
          </li>';
		 }
			 
		 if($roleid == 1 || $roleid== 3)
			{
          echo'<li class="nav-header" style="color:black">QUẢN LÝ KẾ TOÁN</li>
		  
		  

		  
		  <li class="nav-item" >
			<a href="#" class="nav-link" style="color:black">
              <i class="nav-icon  fas fa-money-check" style="color:black"></i>
			<p style="color:black">
			Quản lý Debit
			<i class="fas fa-angle-left right"></i>
			</p>
			</a>
<ul class="nav nav-treeview">
			<li class="nav-item">
			<a href="list_debit.php" class="nav-link">
<i class="nav-icon fas fa-clipboard-list"></i>			<p  style="color:black">Danh sách Debit</p>
			</a>
			</li>
			<li class="nav-item">
			<a href="list_scan_nhap.php" class="nav-link" >
<i class="nav-icon  fas fa-clipboard-list"></i>		<p   style="color:black">List Nhập Hàng</p>
			</a>
			</li>
			
			</ul>
			</li>
		  
		 
		
		  <li class="nav-item">
            <a href="m_admin.php?m=cash_manager" class="nav-link" style="color:black">
              <i class="nav-icon fas fa-money-check"></i>
              <p>Quản Lý Chi Tiêu</p>
            </a>
          </li>  
		  <li class="nav-item">
            <a href="m_accountant.php?ac=list_debit_sale" class="nav-link" style="color:black">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>Duyệt Thanh Toán Sale</p>
            </a>
          </li>  
		</li>
		  '; 
			}
			
			
			if($roleid == 2)
			{
				echo'
				  <li class="nav-item">
					<a href="change_password.php" class="nav-link active" style="background-color:#999900">
<i class="nav-icon fas fa-users-cog"></i>					  <p>
						Account Manager
					  </p>
					</a>
				
				  </li>';
			}if($roleid == 6)
			{
				echo'
				  <li class="nav-item">
					<a href="change_password3.php" class="nav-link active" style="background-color:#999900">
<i class="nav-icon fas fa-users-cog"></i>					  <p>
						Account Manager
					  </p>
					</a>
				
				  </li>';
			}
			if($roleid == 6)
			{
				echo' <li class="nav-item" style="background-color:#999900">
            <a href="list_saleleader.php" class="nav-link" style="color:white">
<i class="nav-icon fas fa-user-tie"></i>              <p>Thống Kê Sale</p>
            </a>
          </li>';
			}
			
			 if($roleid == 1 || $roleid== 3)
					 {
		  echo'<li class="nav-header" style="color:black">QUẢN LÝ CHO ADMIN</li>
          <li class="nav-item" >
            <a href="list_saleleader.php" class="nav-link" style="color:white" >
              <i class="nav-icon fas fa-users"style="color:black"></i>
              <p style="color:black">Quản Lý SALE</p>
            </a>
          </li>
		  <li class="nav-item" >
            <a href="m_admin.php" class="nav-link" style="color:white" >
              <i class="nav-icon fas fa-users-cog"style="color:black"></i>
              <p style="color:black">Quản Lý Hệ Thống</p>
            </a>
          </li>
		  
		  
		
		  
		  
		  
		 
		
		
		
		
		  ';
		  
		
			}
			echo'<li class="nav-item">
            <a href="logout.php" class="nav-link" style="color:black">
				<i class="fas fa-sign-out-alt "></i>
              <p>['.$datauser['ten'].'] Đăng Xuất</p>
            </a>
          </li>';
		  ?>
          
        </ul>
		
		<br><br><br>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper" style="background-color:#FFFFFF" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="list_package.php">Home</a></li>
              <li class="breadcrumb-item active">SHIBA EXPRESS SYSTEM</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content"  >
      <div class="container-fluid">
	          <div class="row">
