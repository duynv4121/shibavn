<?php  
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
if($_SESSION['web_code'] != 7979)
			{
				header('Location: logout.php');

			}
$listrole = setrole1($uid,$roleid);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GPExpress</title>
	<link rel="icon" type="image/x-icon" href="./banner.png">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        table.dataTable thead tr th {
            word-wrap: break-word;
            /*word-break: break-all; */
        }

        table.dataTable tbody tr td {
            word-wrap: break-word;
            /*word-break: break-all;*/
        }
        .dataTables_scrollHead{
          overflow: auto!important;
        }
        table {
            width: 100%!important;
        }
        iframe {
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          height: 100%;
          width: 100%;
        }

        div.modal-body-in{
          height: 25rem;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:black">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="welcome.php">
                <div class="sidebar-brand-text mx-3">GPExpress</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
               CATEGORY
            </div>
            <?php 
              
              for ($i=0; $i < sizeof($listrole); $i++) {
                  $geturl = geturlsubrole($listrole[$i]); 
                  include('modules/'.$geturl.'');
              }
            ?>
			
			<?php
			
			if($uid == 1)
			{
				
			echo'<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseb"
							aria-expanded="true" aria-controls="collapseb">
				<i class="fa fa-plane" aria-hidden="true"></i>


				<span>Shipments ALL </span>
			</a>
			<div id="collapseb" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="shipments.php"><i class="fa fa-list-ol" aria-hidden="true"></i> Shipments TAIWAN </a>
					<a class="collapse-item" href="shipments_kr.php"><i class="fa fa-list-ol" aria-hidden="true"></i> Shipments KOREA </a>
					<a class="collapse-item" href="shipments_malay.php"><i class="fa fa-list-ol" aria-hidden="true"></i> Shipments MALAY </a>
					
				</div>
			</div>
		</li>
			';	
				
			echo'
			<li class="nav-item">
				<a class="nav-link" href="scan_bag.php">
			<i class="fa fa-barcode" aria-hidden="true"></i>
					<span>Scan Bag Code</span></a>
			</li>';
		
			
			echo'
		
			
			
			<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsea"
							aria-expanded="true" aria-controls="collapsea">
				<i class="fa fa-get-pocket" aria-hidden="true"></i>

				<span>Admin Manager </span>
			</a>
			<div id="collapsea" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="list_fwduser.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create FWD </a>
					<a class="collapse-item" href="list_item.php"><i class="fa fa-sitemap" aria-hidden="true"></i> Item Manager </a>
					<!-- <a class="collapse-item" href="edit_history.php">Lịch sử chỉnh sửa</a> -->
					<a class="collapse-item" href="list_customer.php"><i class="fa fa-table" aria-hidden="true"></i> Cus Manager (Khách lẻ)</a>
					<a class="collapse-item" href="list_customerfwd.php"><i class="fa fa-table" aria-hidden="true"></i> Cus manager (FWD)</a>
				</div>
			</div>
		</li>	
			
			
			';
			}
			
			if($roleid == 999)
			{
				echo'<li class="nav-item">
				<a class="nav-link" href="viewbill_tw.php">
<i class="fa fa-list" aria-hidden="true"></i>
					<span>貨物清單</span></a>
			</li>';
			}
			?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Divider -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: white;">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form action="" method="POST" 
                        class="d-none d-sm-inline-block form-inline mr-2 ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" style="background-color: #d6dae6!important;" class="form-control bg-light border-0 small" name="txt_search" placeholder="Tìm kiếm"
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append mr-2">
                                <button name="btn_search" class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <?php  
                        // if ($_SESSION['type'] == 2 || $_SESSION['type'] == 1){
                        //     echo ' <a href="create.php" class="btn btn-success mr-2">
                        //             <i class="fas fa-plus"></i> Tạo đơn
                        //         </a>';
                        // }

                    ?>
                        <!-- <div style="margin-bottom: 0px!important;" class="form-group mr-2">
                            <div class="input-group date">
                              <input placeholder="Tháng" name="datefrom" type="text" class="form-control" id="datepicker1">
                            </div>
                        </div>
                        <button type="submit" name="btn_loc" class="btn btn-info"><i class="fas fa-filter"></i> Lọc</button> -->
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php  
                                    $datauser = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_user WHERE id = '".$_SESSION['uid']."'"));
                                ?>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $datauser['username'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>