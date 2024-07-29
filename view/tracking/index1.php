<?php
include("conn/db.php");
include("controller/bill.php");

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
		
		if(strlen($id) == 10)
					{
						$laydulieupackage = mysqli_query($conn,"SELECT * FROM ns_package WHERE id_code='".$id."'");
						
						$package = mysqli_fetch_assoc($laydulieupackage)or die ("Lỗi không tìm thấy mã vận đơn");
						$laydulieuhoadona = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$package['id']."'  ORDER BY id DESC LIMIT 1");
						$laydulieuhoadonb = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$package['id']."'");
						$laydulieuhoadon = mysqli_fetch_assoc($laydulieuhoadona)or die("Lỗi không tìm thấy mã vận đơn 2");
						
						
						$url = 'http://app.shibaexpress.vn/view/tracking/gettrack.php?billketnoi='.trim($laydulieuhoadon['billketnoi']).'&hangketnoi='.$laydulieuhoadon['hangketnoi'];
						@$jsona =file_get_contents($url);
				
						$jsonb = trim($jsona,"1");
						
						
						$arr = json_decode($jsonb,true);
						$cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"))or die ("Lỗi sai mã tracking 2");
						$sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
						$rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
						@$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
						$laydichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,discount from ksn_dichvu where id='".$package['kg_dichvu']."'"))or die(mysql_error());
						$idhoadon = $laydulieuhoadon['id_code'];
						
						
					}
		
					else
					{
						$laydulieuhoadonaa = mysqli_query($conn,"select * from ns_listhoadon where id_code='$id'");
						
						
						$laydulieuhoadon = mysqli_fetch_assoc($laydulieuhoadonaa);
						
						
					
						$url = 'http://app.shibaexpress.vn/view/tracking/gettrack.php?billketnoi='.trim($laydulieuhoadon['billketnoi']).'&hangketnoi='.$laydulieuhoadon['hangketnoi'];
						@$jsona =file_get_contents($url);
				
						$jsonb = trim($jsona,"1");

						$arr = json_decode($jsonb,true);
						$package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id ='".$laydulieuhoadon['id_package']."'"))or die ("loi");
						$cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"))or die ("loi");
						$sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
						$rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
						@$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
						$laydichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,discount from ksn_dichvu where id='".$package['kg_dichvu']."'"))or die(mysql_error());
						$laydulieuhoadonb = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$package['id']."'");

						$idhoadon = $id;

						
					}
					
					if($laydulieuhoadon['hangketnoi'] == 'dubai-uae')
					{
					$billketnoi = 'DDU'.$laydulieuhoadon['billketnoi'];
							$in = array("AwbNumber" =>array($billketnoi));
							$post_data = json_encode($in);
							$curl = curl_init();
							curl_setopt_array($curl, array(
							  CURLOPT_URL => "https://portal.ddu-express.com/webservice/GetTracking",
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "POST",
							  CURLOPT_POSTFIELDS => $post_data,
							  CURLOPT_HTTPHEADER => array(
								"Content-Type: application/json",
								"API-KEY:5f9d302fa59bb41f68c438602d8a967d",
							  ),
							));
							$response = curl_exec($curl);
							$err = curl_error($curl);
							curl_close($curl);
							$arr = json_decode($response,true);
							$check_max = -1;
							foreach(@ array_reverse(@$arr['TrackResponse'][0]['Shipment']['Activity']) as $result) 
							{
								$check_max +=1;
							}
					}
					
					if(@$laydulieuhoadon['hangketnoi'] == 'kango')
						{
							$billketnoi = $laydulieuhoadon['billketnoi'];
							$hangketnoi = $laydulieuhoadon['hangketnoi'];
							$url = "http://ksnpost.com/get_tracking_api?idbill=".$billketnoi."&apikey=345d118c37e9ceaa1457";
							$json = file_get_contents($url);
							$arr = json_decode($json, true);
							$arr = array_reverse($arr);
						}
						
		
				}
		
			
		
		
function xulychuoi($data){
	  $data = str_replace("Đã tạo nhãn cho kiện hàng","Label Created",$data);
	  $data = str_replace("Kiện hàng đã được nhận bởi KSN","Package received by KSN",$data);
	  $data = str_replace("託運資料已登錄","Thông tin vận chuyển đã được nhập liệu",$data);
	  $data = str_replace("貨件已到配送站所","Kiện hàng đã về đến trạm phân phối",$data);
	  $data = str_replace("配送中","Kiện hàng đang vận chuyển cho khách",$data);
	  $data = str_replace("配送完成","Giao hàng hoàn thành",$data);
	  $data = str_replace("順利送達","Đã giao hàng thành công",$data);
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
  <title>TSC POST TRACKING</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../gd/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../gd/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="timelime3.css">
</head>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
</style>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background-color:#FFFFFF">
    <div class="container">
      <a href="" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="https://shibaexpress.vn/wp-content/uploads/2022/09/737C39E8-FED6-4FD7-8902-E5A551DE2CEB-removebg-preview.png" width=150px height=60px></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse" >
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="" class="nav-link"  style="color:black">Home</a>
          </li>
  
        </ul>

        <!-- SEARCH FORM -->
       
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        
        <!-- Notifications Dropdown Menu -->
      
        <li class="nav-item">
           <form class="form-inline ml-0 ml-md-3" action="" method="GET">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="trackingcode" name="b" placeholder="Nhập mã Tracking" aria-label="Search" height="48" size="50" style="color:red;background-color:#FFFFCC;border:2px solid black">
            <div class="input-group-append">
              <button class="btn btn-warning" type="submit">
                <i class="fas fa-search"></i> TRACK
              </button>
            </div>
          </div>
        </form>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Tracking ID: <?php echo $id;?></small></h1>
          </div><!-- /.col -->
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
			
			    <div class="col-lg-4">
					<div class="card card-primary">
					  <div class="card-header" style="background-color:#CCCC66">
						<h3 class="card-title">Thông tin kiện hàng</h3>
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body">
					  
					  <?php
					  
				  $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id ='".$laydulieuhoadon['id_package']."'"))or die ("Nhập số kiện hàng của bạn để kiểm tra tracking");
                  $cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"))or die ("loi 3");
                  $sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
                  $rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
				  @$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
				  $laydichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,discount from ksn_dichvu where id='".$package['kg_dichvu']."'"))or die(mysql_error());

				  
					  echo'
						<strong style="color:#000000"><i class="fas fa-box"></i> Thông tin Lô Hàng</strong>
				
						<p class="text-muted" style="font-weight:bold">
						  <span class="tag tag-success">FROM: '.location_chinhanh($package['kg_chinhanh']).' </span><br>
						 
						  <span class="tag tag-info">TO: <b>'.$dulieuquocgia['name'].' </b></span><br>
						   <span class="tag tag-success">TÊN NGƯỜI NHẬN: '.($rName['name']).' </span><br>
						  <span class="tag tag-success">ĐỊA CHỈ: '.($rName['address']).' </span><br>
						  <span class="tag tag-warning">NGÀY GỬI: '.$package['date'].'</span><br>
						  <span class="tag tag-primary">DỰ KIẾN NGÀY NHẬN: </span>
						</p>

						<hr>

						<strong style="color:#000000"><i class="fas fa-truck"></i> Dịch Vụ</strong>

						<p class="text-muted" style="font-weight:bold">
						
						<span class="tag tag-danger">DỊCH VỤ: '.$laydichvu['dichvu'].'</span><br>
						<span class="tag tag-danger">ĐIỀU KHOẢN:</span><br>

						
						</p>

						<hr>

						<strong style="color:#000000"><i class="fas fa-clipboard-list"></i> Chi Tiết Gói Hàng</strong>

						
						<p class="text-muted" style="font-weight:bold">
						
						<span class="tag tag-danger">BAO BÌ: '.$laydulieuhoadon['type'].'</span><br>

						
						</p>
			';
			
			
				
				  echo'<div style=font-size:15px;font-weight:bold;  font-family: Roboto, \'Source Sans Pro\';">TỔNG SỐ KIỆN: '.$package['sokien'].'<br>';
				$stt=1;
				while($laydulieupackagea = mysqli_fetch_array($laydulieuhoadonb,MYSQLI_ASSOC))
				{
					@$dulieutrack = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_tracking_bill where id_hoadon='".$laydulieupackagea['id_code']."' AND `check`='1' LIMIT 1"));
					echo '&nbsp;&nbsp;'.$stt.'. ID: <a href="index.php?b='.$laydulieupackagea['id_code'].'">'.$laydulieupackagea['id_code'].' </a>'; 
					if($laydulieupackagea['billketnoi'] != "" )
					{echo'- '.$laydulieupackagea['billketnoi'].'';}echo' </font><br>';
					$stt++;
				}
				
				
				echo'</div>';
						?>
					
					  </div>
					  <!-- /.card-body -->
					</div>
          </div>	
		
		
		
		
		
		
		
          <div class="col-lg-8">
				<div class="card card-primary">
					  <div class="card-header" style="background-color:#CCCC66">
						<h3 class="card-title">Lịch trình di chuyển</h3>
					  </div>
                                        <div class="card-body">
                                            <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
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
												/*
												@$layawb = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment_details where id_listhoadon='$idhoadon'"));
												@$laydulieutrackawba = mysqli_query($conn,"select * from ns_tracking_shipment where id_awb='".@$layawb['awb']."' order by date DESC");
												while($laydulieutrackawb = mysqli_fetch_array($laydulieutrackawba,MYSQLI_ASSOC))
												{if($laydulieutrackawb['date'] <= $datenow)
													{
													echo'<div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-secondary"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.$laydulieutrackawb['status'].'</h4>
                                                            <p style="color:blue">'.$laydulieutrackawb['address'].'</span></p>
                                                            <span class="vertical-timeline-element-date">'.$laydulieutrackawb['date'].'</span>
                                                        </div>
                                                    </div>
                                                </div>';
													}
												}*/
												?>
												
												<?php
												$laydulieutracka = mysqli_query($conn,"select * from ns_tracking_bill where id_hoadon='$idhoadon' order by date desc");
												$test = 0;
												@$laydulieutrackb = mysqli_query($conn,"select id from ns_tracking_bill where id_hoadon='$idhoadon' AND `status`='DESTINATION CUSTOMS RELEASED' AND date < '$datenow' LIMIT 1");

											



												if(mysqli_num_rows($laydulieutrackb) >= 1)
												{
													
													if($arr != "")
													{
													### tracking dubai
													foreach(@ array_reverse(@$arr['TrackResponse'][0]['Shipment']['Activity']) as $result) 
													{
														
												
													echo'<div class="vertical-timeline-item vertical-timeline-element" style="font-size:20px;">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
														
															';
                                                            
															//check trang thai thanh cong
															
															if(@$result['substatus'] == "delivered001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}else if(@$result['substatus'] == "transit001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}else if(@$result['substatus'] == "pickup001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}
															else
															{
															echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}
                                                        
														
														echo'</span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.$result['details'].'</h4>
                                                            <p style="color:blue">'.$result['location'].'</span></p>
                                                            <span class="vertical-timeline-element-date">'.$result['datetime'].'</span>
                                                        </div>
                                                    </div>
                                                </div>';
													
												
													}		
														
														
														
														
													
														
														
													foreach(array_unique(@$arr['data'][0]['origin_info']['trackinfo'],SORT_REGULAR) as $result) 
													{
														
														
													if(strpos($result['StatusDescription'], "created") == true){}
													else
													{
													echo'<div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
														
															';
                                                            
															//check trang thai thanh cong
															
															if($result['substatus'] == "delivered001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}else if($result['substatus'] == "transit001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}else if($result['substatus'] == "pickup001")
															{
																echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}
															else
															{
															echo'<i class="badge badge-dot badge-dot-xl"> </i>';
															}
                                                        
														
														echo'</span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.$result['StatusDescription'].'</h4>
                                                            <p style="color:blue">'.$result['Details'].'</span></p>
                                                            <span class="vertical-timeline-element-date">'.$result['Date'].'</span>
                                                        </div>
                                                    </div>
                                                </div>';
													}
												
												
												}
													}
													$dulieuups = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_tracking_bill where `status`='ON FORWARD FOR DELIVERY' AND id_hoadon='$idhoadon' "));
													echo'<div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-x"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.xulychuoi($dulieuups['status']).'</h4>
                                                            <p style="color:blue">'.$dulieuups['address'].'</span></p>
                                                            <span class="vertical-timeline-element-date"></span>
                                                        </div>
                                                    </div>
														</div>';
												}
												
												if($hangketnoi == 'kango')
												{
												
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
													
													while($laydulieutrack = mysqli_fetch_array($laydulieutracka,MYSQLI_ASSOC))
												{
													if($laydulieutrack['date'] <= $datenow)
													{
														if(strtoupper($laydulieutrack['status']) == 'ON FORWARD FOR DELIVERY')
														{
														}
														else
														{
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
												}
												}
												else
												{
												
												while($laydulieutrack = mysqli_fetch_array($laydulieutracka,MYSQLI_ASSOC))
												{
													if($laydulieutrack['date'] <= $datenow)
													{
														if(strtoupper($laydulieutrack['status']) == 'ON FORWARD FOR DELIVERY')
														{
														}
														else
														{
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
												}
												}
												?>
                                                
                                              
                                                
                                                   
                                                
                                            </div>
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
