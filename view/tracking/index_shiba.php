<?php
include("../../conn/db.php");
include("../../controller/bill.php");

if(isset($_GET['id']))
{
	$id = $_GET['id'];
}
else
{
$id = $_GET['b'];
}
		$datenow = date("Y-m-d H:i:sa");
		if(isset($id))
				{
					


					
						$laydulieuhoadonaa = mysqli_query($conn,"select * from ns_listhoadon where id_code='$id'");
						
						
						$laydulieuhoadon = mysqli_fetch_assoc($laydulieuhoadonaa);
						
						
						if(@$laydulieuhoadon['hangketnoi'] == 'SHIBA EXPRESS')
						{
							$billketnoi = $laydulieuhoadon['billketnoi'];
							$hangketnoi = $laydulieuhoadon['hangketnoi'];
							$url = "https://ksnpost.com/get_tracking_api?idbill=".$billketnoi."&apikey=345d118c37e9ceaa1457";
							$json = file_get_contents($url);
							$arr = json_decode($json, true);
							$arr = array_reverse($arr);
						}
						else if(@$laydulieuhoadon['hangketnoi'] == 'shibavn')
						{
							
						}
						else
						{
							$url = 'http://'.$_SERVER['HTTP_HOST'].'/shibavn/view/tracking/gettrack_cn.php?billketnoi='.trim($laydulieuhoadon['billketnoi']).'&hangketnoi='.$laydulieuhoadon['hangketnoi'];
							@$jsona =file_get_contents($url);
				
							$jsonb = trim($jsona,"int(1)");
							$output  = str_replace("int(1)", "", $jsonb);

							$arr2 = json_decode($output,true);
						
						}

						$idhoadon = $id;

						
					
		
				}
		
	
		

//Ket noi api lay thong tin


$check_danggiao = 0;
$check_dagiao = 0;
$check_nhapkho = 0;






function xulychuoi($data){
$data = str_replace("到達轉運站","Taiwan transit point",$data);
$data = str_replace("貨件已到發貨站所","Shipping destination",$data);
$data = str_replace("託運資料已登錄","Included shipping information",$data);
$data = str_replace("貨件已到配送站所","The package has arrived at the distribution station",$data);
$data = str_replace("配送中","Package in transit",$data);
$data = str_replace("配送完成","Delivery completed",$data);
$data = str_replace("順利送達","Delivery completed",$data);

return $data;
}


?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRACKING SHIBAEXPRESS.VN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../gd/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../gd/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="timelime3.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
		  <!--
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Top Navigation</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
	  <div class="row">
	  			<div class="col-lg-12">
				<center><img src="https://shibaexpress.vn/wp-content/uploads/2022/09/737C39E8-FED6-4FD7-8902-E5A551DE2CEB-removebg-preview.png" width=350px height=150px></center>
				
				</div>
				
	  </div><br>
	  <div class="row">
	  			<div class="col-lg-4">
				<form action="" method="GET">
				</div><div class="col-lg-2">
				<input type="text" class="form-control" name="b" placeholder="Nhập mã tracking ">
				</div><div class="col-lg-2">
				<button type="submit" class="form-control btn-sm"  placeholder="">TRACKING</button>

				</div>
				<div class="col-lg-4">
				
				</div>
				
	  </div><br>
        <div class="row">
			
			<div class="col-lg-2">
					
			</div>	
		
		
		
		
		
		
		
          <div class="col-lg-8">
				<div class="card card-primary">
					  <div class="card-header"  style="background-color:#CC9900">
						<h3 class="card-title" >Lịch trình di chuyển</h3>
					  </div>
                                        <div class="card-body">
                                                <!--<div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-success"></i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Meeting with client</h4>
                                                            <p>Meeting with USA Client, today at <a href="javascript:void(0);" data-abc="true">12:00 PM</a></p>
                                                            <span class="vertical-timeline-element-date">2023-12-12 9:30 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
												
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p>Another meeting with UK client today, at <b class="text-danger">3:00 PM</b></p>
                                                            <p>Yet another one, at <span class="text-success">5:00 PM</span></p>
                                                            <span class="vertical-timeline-element-date">12:25 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Discussion with team about new product launch</h4>
                                                            <p>meeting with team mates about the launch of new product. and tell them about new features</p>
                                                            <span class="vertical-timeline-element-date">6:00 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-primary"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title text-success">Discussion with marketing team</h4>
                                                            <p>Discussion with marketing team about the popularity of last product</p>
                                                            <span class="vertical-timeline-element-date">9:00 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-success"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Purchase new hosting plan</h4>
                                                            <p>Purchase new hosting plan as discussed with development team, today at <a href="javascript:void(0);" data-abc="true">10:00 AM</a></p>
                                                            <span class="vertical-timeline-element-date">10:30 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p>Another conference call today, at <b class="text-danger">11:00 AM</b></p>
                                                            <p>Yet another one, at <span class="text-success">1:00 PM</span></p>
                                                            <span class="vertical-timeline-element-date">12:25 PM</span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p>Another meeting with UK client today, at <b class="text-danger">3:00 PM</b></p>
                                                            <p>Yet another one, at <span class="text-success">5:00 PM</span></p>
                                                            <span class="vertical-timeline-element-date">12:25 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Discussion with team about new product launch</h4>
                                                            <p>meeting with team mates about the launch of new product. and tell them about new features</p>
                                                            <span class="vertical-timeline-element-date">6:00 PM</span>
                                                        </div>
                                                    </div>
                                                </div>-->
												<?php
												//Ket noi API 
													
												
												
												
												
												
												?>
												
												
												<?php
												
												if(@$laydulieuhoadon['billketnoi'] != "")
												{
												echo'                                            <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
';	




														if($arr2 != "")
													{
														
													### tracking CN
													foreach(@$arr2['data'] as $result) 
													{
														
														
													if(strpos($result['status'], "created") == true){}
													else
													{
													echo'<div class="vertical-timeline-item vertical-timeline-element" style="font-size:20px;">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
														
															';
                                                            
															//check trang thai thanh cong
															
															if($result['status'] == "delivered001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}else if($result['status'] == "transit001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}else if($result['status'] == "pickup001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}
															else
															{
															echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}
                                                        
														
														echo'</span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.$result['context'].'</h4>
                                                            <p style="color:blue"></span></p>
                                                            <span class="vertical-timeline-element-date">'.$result['time'].'</span>
                                                        </div>
                                                    </div>
                                                </div>';
													}
												
													}

													
													}
												

												foreach(@$arr as $result) 
													{
														
														
													if(strpos($result['status'], "created") == true){}
													else
													{
													echo'<div class="vertical-timeline-item vertical-timeline-element" style="font-size:20px;">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
														
															';
                                                            
															//check trang thai thanh cong
															
															if($result['status'] == "delivered001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}else if($result['status'] == "transit001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}else if($result['status'] == "pickup001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}
															else
															{
															echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}
                                                        
														$output2  = str_replace('KSN', 'SHIBA TEAM', $result['status']);

														
														echo'</span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.$result['location'].'</h4>
                                                            <p style="color:blue">'.$output2.'</span></p>
                                                            <span class="vertical-timeline-element-date">'.$result['datetime'].'</span>
                                                        </div>
                                                    </div>
                                                </div>';
													}
												
													}
												
												
												
												
												$laydulieutracka = mysqli_query($conn,"select * from ns_tracking_bill where id_hoadon='$idhoadon' order by date desc");
												$test = 0;
												@$laydulieutrackb = mysqli_query($conn,"select id from ns_tracking_bill where id_hoadon='$idhoadon' AND `status`='DESTINATION CUSTOMS RELEASED' AND date < '$datenow' LIMIT 1");

											



												
												while($laydulieutrack = mysqli_fetch_array($laydulieutracka,MYSQLI_ASSOC))
												{
													/* theo thoi gian
													if($laydulieutrack['date'] <= $datenow)
													{
														if(strtoupper($laydulieutrack['status']) == 'ON FORWARD FOR DELIVERY')
														{
														}
														else
														{-->
													echo'<div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.xulychuoi($laydulieutrack['status']).'</h4>
                                                            <p style="color:blue">'.$laydulieutrack['address'].'</span></p>
                                                            <span class="vertical-timeline-element-date">'.$laydulieutrack['date'].'</span>
                                                        </div>
                                                    </div>
														</div>';
														}
													}
													*/
													
													echo'<div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.xulychuoi($laydulieutrack['status']).'</h4>
                                                            <p style="color:blue">'.$laydulieutrack['address'].'</span></p>
                                                            <span class="vertical-timeline-element-date">'.$laydulieutrack['date'].'</span>
                                                        </div>
                                                    </div>
														</div>';
												}
												
												echo'                                            </div>
';
												}
												else
												{
													echo'<font color=red>Mã vận đơn bạn nhập không có trên hệ thống, xin vui lòng thử lại !</font>';
												}
												?>
												
												<?php
												
												
												
												
												
												?>
                                                
                                              
                                                
                                                   
                                                
                                        </div>
                          
				
		</div>
          </div>
          <!-- /.col-md-6 -->
		  
		  
		  
		  
		  
      
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar 
  <aside class="control-sidebar control-sidebar-dark">
  </aside>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
  
  --->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../gd/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../gd/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../gd/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
</body>
</html>
