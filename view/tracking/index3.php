<?php
include("conn/db.php");
include("controller/bill.php");
$id = trim($_GET['b']);

$datenow = date("Y-m-d H:i:s");
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
if($isMob){ 
echo'<script> 
					window.location = "index1.php";

					</script>';
}				
		
				if(isset($_GET['b']))
				{
		
					if(strlen($_GET['b']) == 10)
					{
						$laydulieupackage = mysqli_query($conn,"SELECT * FROM ns_package WHERE id_code='".trim($_GET['b'])."'") or die("");;
						if(mysqli_num_rows($laydulieupackage) == 0)
						{
							echo'<script> 
							alert("Lỗi không tìm thấy mã bill này, xin hãy thử lại");
					window.location = "home.php";

					</script>';
						}
						$package = mysqli_fetch_assoc($laydulieupackage)or die ("loi");
						$laydulieuhoadona = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$package['id']."'  ORDER BY id DESC LIMIT 1");
						$laydulieuhoadonb = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$package['id']."'");
						$laydulieuhoadon = mysqli_fetch_assoc($laydulieuhoadona)or die("Loi 12");
						
						
						if($laydulieuhoadon['billketnoi'] != "")
						{
							$url = 'https://api.tracktry.com/v1/trackings/post';

							// Create a new cURL resource
							$ch = curl_init($url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

							// Setup request to send json via POST
							$dataa = array(
								"tracking_number" => $laydulieuhoadon['billketnoi'],
								"carrier_code"=> $laydulieuhoadon['hangketnoi']
							);
							$payload = json_encode($dataa);





							// Attach encoded JSON string to the POST fields
							curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

							// Set the content type to application/json
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
							'Tracktry-Api-Key: 942b2c55-40fe-4455-acb4-503d20f031c2'));


							// Return response instead of outputting

							// Execute the POST request
							$resultc = curl_exec($ch);

							// Close cURL resource
							curl_close($ch);
							
						}
						
						$url = 'http://ksnpost.com/gettrack.php?billketnoi='.trim($laydulieuhoadon['billketnoi']).'&hangketnoi='.$laydulieuhoadon['hangketnoi'];
						$jsona =file_get_contents($url);
				
						$jsonb = trim($jsona,"1");
						
						$arr = json_decode($jsonb,true);
						
						$cuscode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM ns_customer WHERE cus_code ='".$package['cus_code']."'"));
						$sName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id ='".$package['id_nguoigui']."'"));
						$rName = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id ='".$package['id_nguoinhan']."'"));
						@$dulieuquocgia = mysqli_fetch_assoc(mysqli_query($conn,"select name from ns_countries where id='".$rName['country_id']."'"));
						$laydichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,discount from ksn_dichvu where id='".$package['kg_dichvu']."'"))or die(mysql_error());
						$idhoadon = $laydulieuhoadon['id_code'];
						
					
					}
		
					else
					{
						$laydulieuhoadonaa = mysqli_query($conn,"select * from ns_listhoadon where `id_code`='$id'");
						if(mysqli_num_rows($laydulieuhoadonaa) == 0)
						{
							echo'<script> 
							alert("Lỗi không tìm thấy mã bill này, xin hãy thử lại.");
					window.location = "home.php";

					</script>';
						}
						$laydulieuhoadon = mysqli_fetch_assoc($laydulieuhoadonaa)or die("Lỗi không tìm thấy mã Code");
						
						
						######### thêm tracking nếu thiếu
						if($laydulieuhoadon['billketnoi'] != "")
						{
							$url = 'https://api.tracktry.com/v1/trackings/post';

							// Create a new cURL resource
							$ch = curl_init($url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
							// Setup request to send json via POST
							$dataa = array(
								"tracking_number" => $laydulieuhoadon['billketnoi'],
								"carrier_code"=> $laydulieuhoadon['hangketnoi']
							);
							$payload = json_encode($dataa);





							// Attach encoded JSON string to the POST fields
							curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

							// Set the content type to application/json
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
							'Tracktry-Api-Key: 942b2c55-40fe-4455-acb4-503d20f031c2'));


							// Return response instead of outputting

							// Execute the POST request
							$resultc = curl_exec($ch);

							// Close cURL resource
							curl_close($ch);
							
						}
						
						$url = 'http://ksnpost.com/gettrack.php?billketnoi='.trim($laydulieuhoadon['billketnoi']).'&hangketnoi='.$laydulieuhoadon['hangketnoi'];
						$jsona =file_get_contents($url);
				
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
					
				}
				else
				{
					echo'<script> 
				window.location = "home.php";

				</script>';
				}
					


if(@$_GET['lang'] == 'VN')
{
$string1 = 'TRẠNG THÁI:';
$string2 = 'THỜI GIAN';
$string3 = 'MÃ KIỆN HÀNG';


$string4 = 'Thông Tin Lô Hàng';

$string5 = 'THÔNG TIN VẬN CHUYỂN';
$string6 = 'MÃ KIỆN HÀNG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string7 = 'TỪ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
$string8 = 'TO';
$string9 = 'NGÀY GỬI HÀNG';
$string10 = 'NGÀY NHẬN HÀNG';



$string11 = 'DỊCH VỤ';
$string12 = 'DỊCH VỤ';
$string13 = 'ĐIỀU KHOẢN&nbsp;';
$string13a = 'NGƯỜI GỬI';

$string14 = 'THÔNG TIN KIỆN HÀNG';
$string15 = 'ĐÓNG GÓI&nbsp;&nbsp;&nbsp;';
$string17 = 'TRỌNG LƯỢNG';
$string18 = 'TỔNG KIỆN HÀNG';
$string19 = 'THÔNG TIN CHI TIẾT KIỆN';

$string20 = 'LỊCH SỬ DI CHUYỂN';

$string21 = 'Danh Sách Theo Dõi';
$string22 = 'Bạn hiện không có bất cứ lô hàng nào trong Danh sách theo dõi.';

}
else if(@$_GET['lang'] == 'CN')
{
$string1 = '邮寄状态：';
$string2 = '时间';
$string3 = '跟踪号码';


$string4 = '发货信息';

$string5 = '发货概览';
$string6 = '追踪号码&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string7 = '从';
$string8 = '到';
$string9 = '交货日期&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string10 = '收到货物的日期';



$string11 = '服务';
$string12 = '服务&nbsp;';
$string13 = '规则&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string13a = '发件人';

$string14 = '套餐详情';
$string15 = '包装&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string17 = '重量&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string18 = '总包&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string19 = '子包详情';

$string20 = '运动历史';

$string21 = '关注列表';
$string22 = '您的追踪列表上目前没有任何货件。';
}
else
{
$string1 = 'DELIVERY STATUS:';
$string2 = 'DATE TIME';
$string3 = 'TRACKING ID';


$string4 = 'Shipment Information';

$string5 = 'SHIPMENT OVERVIEW';
$string6 = 'TRACKING NUMBER';
$string7 = 'FROM';
$string8 = 'TO';
$string9 = 'DATE SEND&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string10 = 'ESTIMATE RECEIVED DAY';



$string11 = 'SERVICES';
$string12 = 'SERVICES';
$string13 = 'TERMS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
$string13a = 'SENDER';

$string14 = 'PACKAGE DETAILS';
$string15 = 'PACKAGING;&nbsp;&nbsp';
$string17 = 'WEIGHT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
$string18 = 'TOTAL PACKAGE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$string19 = 'SUBPACKAGE DETAIL';

$string20 = 'TRAVEL HISTORY';

$string21 = 'Watchlist';
$string22 = 'You do not currently have any shipments on your Tracking List.';	
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
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>KSN POST TRACKING</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto%3A300%2C400%2C700"/>
   <link rel="stylesheet" href="../gd/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../gd/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./styles/tracking.css"/>
  
  
  
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
  rel="stylesheet"
/>

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
></script>

  
  
  
    <link rel="stylesheet" href="timelime2.css">
<style>
textarea:focus, input:focus{
    outline: none;
}
</style>
</head>
<body>
<div class="tracking-szZ">
  <div class="header-dD3">
    <div class="frame-7155-dkm">
     <img class="frame-yZj" src="./assets/frame-bAh.png"/ style="margin-right:70em;">
      <div class="frame-7154-hkd" >  
        <div class="frame-7151-eQy">
		
		  <form action="" method="GET">

          <!--<div class="us00000000031-Znq">US00000000031</div>-->
		  <input type="text" style="border: none;font-size:20px;color:red;margin-top:-8px" name="b" value="<?php echo $_GET['b'];?>">
          <img class="icons-search24px-BSq" src="./assets/icons-search24px.png"/>	    
	

        </div>    <button type="sbumit "class="frame-7152-GDP">Track</button></form>
		<font color=white style="font-size:15px"></font> &nbsp;
	  <?php
	  if(@$_GET['lang'] == 'VN')
	{
	echo'
	<a class="dropdown-toggle" href="#" id="Dropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false"  >
        <i class="flag-vietnam flag flag m-0 "></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="Dropdown">
        <li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang=VN"><i class="flag-vietnam flag"></i>Việt Nam <i class="fa fa-check text-success ms-2"></i></a>
        </li>
        <li><hr class="dropdown-divider" /></li>
       
        <li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang=CN"><i class="flag-china flag"></i>中文</a>
        </li>
		<li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang="><i class="flag-united-kingdom flag"></i>English</a>
        </li>
       
    </ul>
	';	
	}
	
	else if(@$_GET['lang'] == 'CN')
	{
			echo'
			
			<a class="dropdown-toggle" href="#" id="Dropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
        <i class="flag-china flag flag m-0"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="Dropdown">
        <li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang"><i class="flag-china flag"></i>中文 <i class="fa fa-check text-success ms-2"></i></a>
        </li>
        <li><hr class="dropdown-divider" /></li>
       
        <li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang=VN"><i class="flag-vietnam flag"></i>Việt Nam</a>
        </li>
		<li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang="><i class="flag-united-kingdom flag"></i>English</a>
        </li>
       
    </ul>
	';	
	}
	else
	{
	echo'<a class="dropdown-toggle" href="#" id="Dropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
        <i class="flag-united-kingdom flag flag m-0"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="Dropdown">
        <li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang"><i class="flag-united-kingdom flag"></i>English <!--i class="fa fa-check text-success ms-2"></i>--></a>
        </li>
        <li><hr class="dropdown-divider" /></li>
       
        <li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang=CN"><i class="flag-china flag"></i>中文</a>
        </li>
		<li>
            <a class="dropdown-item" href="index.php?b='.$id.'&lang=VN"><i class="flag-vietnam flag"></i>Việt Nam</a>
        </li>
       
    </ul>
	';
	}
	  
	  ?>
		
		
		
		
      </div>
	  
	
    </div>
  </div>
  <div class="auto-group-5s9f-v33">
    <div class="auto-group-ck61-THs">
      <div class="frame-7150-Me9">
        <div class="value-K5B">
          <div class="auto-group-vgqf-S9o">
            <div class="delivery-status--aG1"><?php echo $string1;?></div>
            <div class="delivery-status-5Tf">
              <div class="delivered-Pz9">
			  
			  <?php
			  
			  $last_address = location_chinhanh($package['kg_chinhanh']);
			  $last_status = 'Create Label';
			  $last_date = $package['date'];;
			  
			  $check_tree = 1;
			  if($laydulieuhoadon['status'] >= 1)
				{
					$laytime1 = mysqli_fetch_assoc(mysqli_query($conn,"select date,status,address from ns_tracking_bill where id_hoadon='$idhoadon' AND status='Kiện hàng đã được nhận bởi KSN'"));
					//status 1
					
					@$last_status	= $laytime1['status'];
					@$last_address	= $laytime1['address'];
					@$last_date	= $laytime1['date'];
					$check_tree = 1;
				}
				if($laydulieuhoadon['status'] >= 2 && $laydulieuhoadon['status'] < 5)
				{
					
					
					$laytime2 = mysqli_fetch_assoc(mysqli_query($conn,"select date,status,address from ns_tracking_bill where id_hoadon='$idhoadon' AND status='Origin customs processing'"));
					
					@$last_status	= $laytime2['status'];
					@$last_address	= $laytime2['address'];
					@$last_date	= $laytime2['date'];
					$check_tree = 2;

					//status 2
				
					$layawb = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment_details where id_listhoadon='$idhoadon'")) or die("Loi a");
					$laydulieutrackawba = mysqli_query($conn,"select * from ns_tracking_shipment where id_awb='".@$layawb['awb']."' AND date < '$datenow' ORDER BY id DESC");
					
					
					$laytime33 = mysqli_fetch_assoc(mysqli_query($conn,"select date,status,address from ns_tracking_bill where id_hoadon='$idhoadon' AND status<>'On forward for delivery' AND date < '$datenow' order by date DESC"));

					
					if(mysqli_num_rows($laydulieutrackawba) >= 1)
					{
					@$laytime3 = mysqli_fetch_assoc($laydulieutrackawba);
					
					@$last_status	= $laytime33['status'];
					@$last_address	= $laytime33['address'];
					@$last_date	= $laytime33['date'];

					}
					
					
					
					@$laydulieutrackbc = mysqli_query($conn,"select id from ns_tracking_bill where id_hoadon='$idhoadon' AND `status`='DESTINATION CUSTOMS RELEASED' AND `date` < '$datenow' LIMIT 1");

					if(mysqli_num_rows($laydulieutrackbc) >= 1)
					{
						$ketnoitrack = 1;
					}
					else
					{
						$ketnoitrack = 0;
					}
					//status 3

				}
			
			if( @$arr['data'][0]['origin_info']['trackinfo'][0]['StatusDescription'] != "" && $ketnoitrack == 1)
			{
				if(strpos(@$arr['data'][0]['origin_info']['trackinfo'][0]['StatusDescription'],'created a label') == false)
				{
				$last_address	= @$arr['data'][0]['origin_info']['trackinfo'][0]['Details'];
				$last_status	= @$arr['data'][0]['origin_info']['trackinfo'][0]['StatusDescription'];
				$last_date	= @$arr['data'][0]['origin_info']['trackinfo'][0]['Date'];
				$check_tree = 4;
				}
			}
			
			if($laydulieuhoadon['status'] == 5)
				{
					$laytime1 = mysqli_fetch_assoc(mysqli_query($conn,"select date,status,address from ns_tracking_bill where id_hoadon='$idhoadon' AND status='Kiện hàng đã được nhận bởi KSN'"));
					//status 1
					
					@$last_status	= 'Please contact sender to for more information ';
					@$last_address	= 'RETURNED TO SENDER';
				}
			  ?>
			  <?php echo $last_address;?>
			  
			  
			  </div>
              <!--<img class="home-1-hzq" src="./assets/home-1-dB7.png"/>-->
            </div>
          </div>
          <div class="sub-link-eQH">
            <div class="nhn-cp-nht-trng-thi-LH7"   style="     white-space: pre-wrap; width:400px"><?php echo $last_status.' ';?> <i class="fas fa-check-circle"></i></div>
          </div>
        </div>
        <div class="frame-7148-pCH">
          <div class="delivery-status--9kM"><?php echo $string2;?></div>
          <!--<div class="delivery-status-V3X">
            <div class="picked-up-RSy">Thứ Tư</div>
          </div>-->
          <div class="lc-13-50-xho"><?php echo $last_date;?><br>LOCAL TIME</div>
          <!--<div class="khng-yu-cu-k-nhn-ca-trc-GiV">Không yêu cầu ký nhận để ở cửa trước</div>
          <div class="sub-link-ZxV">
            <img class="download-1-VbF" src="./assets/download-1-KRb.png"/>
            <div class="nhn-ho-n-giao-hng-Rzh">Nhận Hoá đơn giao hàng</div>
          </div>-->
        </div>
        <div class="frame-7149-jkV">
          <div class="tracking-id-hSR"><?php echo $string3;?></div>
          <div class="delivery-status-DvZ">
            <div class="us00000000031-BcV"><?php echo $_GET['b'];?></div>
            <img class="vector-Wem" src="./assets/vector-z97.png"/>
          </div>
        </div>
      </div>
    </div>
    <div class="auto-group-rzhb-3Po">
      <div class="frame-7157-ZN9">
        <div class="frame-7156-t9X">
          <div class="value-c5X">
            <div class="delivery-status--jR3">FROM</div>
            <div class="inglewood-ca-us-s1T"><?php echo location_chinhanh($package['kg_chinhanh'])?></div>
            <div class="to-nhn-BH3">Label Created</div>
            <div class="monday-27-06-2022-03-42-5tD"><?php echo $laydulieuhoadon['datetime'];?></div>
          </div>
          <div class="auto-group-3ach-pL1">
		  
			<?php
			if($laydulieuhoadon['status'] >= 1)
			{
				//$laytime1 = mysqli_fetch_assoc(mysqli_query($conn,"select date,address from ns_tracking_bill where id_hoadon='$idhoadon' AND status='Kiện hàng đã được nhận bởi KSN'"));
				echo'<div class="value-xSD">
              <div class="auto-group-6drt-Jky">
                <div class="delivery-status--FgD">PACKAGE RECEIVED BY KSN</div>
                <div class="inglewood-ca-us-nRF">'.$laytime1['address'].'</div>
              </div>
              <div class="auto-group-ej8h-iph">'.$laytime1['date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </div>';
				$check_tree = 2;

			}if($laydulieuhoadon['status'] == 5)
			{
				//$laytime1 = mysqli_fetch_assoc(mysqli_query($conn,"select date,address from ns_tracking_bill where id_hoadon='$idhoadon' AND status='Kiện hàng đã được nhận bởi KSN'"));
				echo'<div class="value-xSD">
              <div class="auto-group-6drt-Jky">
                <div class="delivery-status--FgD">RETURNED TO SENDER</div>
                <div class="inglewood-ca-us-nRF">Please contact sender to for more information</div>
              </div>
              <div class="auto-group-ej8h-iph">'.$laytime1['date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </div>';
				$check_tree = 3;

			}
			else if($laydulieuhoadon['status'] >= 2 )
			{
			//$laytime2 = mysqli_fetch_assoc(mysqli_query($conn,"select date,address from ns_tracking_bill where id_hoadon='$idhoadon' AND status='Origin customs processing'"));

			echo'<div class="value-SEu">
              <div class="auto-group-7fn9-Pvq">
                <div class="delivery-status--9QD">in transit</div>
                <div class="inglewood-ca-us-erm">'.$laytime2['address'].'</div>
              </div>
              <div class="auto-group-iwk9-nTB">'.$laytime2['date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </div>';	
					  					$check_tree = 3;
			
			}
			
			
			?>
            
            
          </div>
		  
			<?php
			
			if($laydulieuhoadon['status'] >= 2  && $laydulieuhoadon['status'] < 5)
			{
				if($ketnoitrack == 0)
				{
					
				//@$layawb = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment_details where id_listhoadon='$idhoadon'")) or die("Loi");
				//@$laydulieutrackawba = mysqli_query($conn,"select * from ns_tracking_shipment where id_awb='".@$layawb['awb']."' ORDER BY id DESC")or die("Loi");	
				//$laytime3 = mysqli_fetch_assoc($laydulieutrackawba);
				
					if(mysqli_num_rows($laydulieutrackawba) >= 1)
					{
					echo'<div class="value-Huj">
						<div class="delivery-status--dTo">'.@$laytime33['status'].'</div>
						<div class="inglewood-ca-us-ATj">'.@$laytime33['address'].'</div>
						<div class="auto-group-fnfs-tuX">'.@$laytime33['date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
					  </div>';
					  					$check_tree = 4;

					}
				}
				else if($ketnoitrack == 1)
				{
					### check nếu là trạng thái tạo label
					if((strpos(@$arr['data'][0]['origin_info']['trackinfo'][0]['StatusDescription'],'created a label') == true) ||  @$arr['data'][0]['origin_info']['trackinfo'][0]['StatusDescription'] == "")
					{
							echo'<div class="value-Huj">
							<div class="delivery-status--dTo">'.@$laytime33['status'].'</div>
							<div class="inglewood-ca-us-ATj">'.@$laytime33['address'].'</div>
							<div class="auto-group-fnfs-tuX">'.@$laytime33['date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						  </div>';
											$check_tree = 4;
					}
					else
					{
						echo'<div class="value-Huj" >
							<div class="delivery-status--dTo" style="     white-space: pre-wrap;
  width:300px">'.@$arr['data'][0]['origin_info']['trackinfo'][0]['StatusDescription'].'</div>
							<div class="inglewood-ca-us-ATj">'.@$arr['data'][0]['origin_info']['trackinfo'][0]['Details'].'</div>
							<div class="auto-group-fnfs-tuX">'.@$arr['data'][0]['origin_info']['trackinfo'][0]['Date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						  </div>';
																$check_tree = 4;							

					}
					
				}
			
			}
			?>
          
        </div>
		
		
		<?php
		if($check_tree == 1 )
		{
			echo'  <div class="group-1-Kzq2-1">';
		}else if($check_tree == 2 )
		{
			echo'  <div class="group-1-Kzq3-1">';
		}else if($check_tree == 3 )
		{
			echo'  <div class="group-1-Kzq4-1">';
		}else if($check_tree == 4 )
		{
			echo'  <div class="group-1-Kzq">';
		}
			
		?>
        
		<?php 
		if($check_tree == 4)
		{
		if(@$arr['data'][0]['origin_info']['trackinfo'][0]['substatus'] == "delivered001")
		{
				echo'  <img class="vector-eGR" src="assets/vector-gRf.png"/>';

		}
		else
		{
				echo'  <img class="vector-eGR" src="assets/vector-truc.png"/>';
		}
		}
	
		?>
		

        </div>
		<?php
		
		if($check_tree >= 1 )
		{
		echo'
        <div class="ellipse-2-NiD">
        </div>';
		}
		
		if($check_tree >= 2 )
		{
        echo'<div class="ellipse-3-tgZ">
        </div>';
		}
		
		
		if($check_tree >= 3 )
		{
        echo'<div class="ellipse-4-RgV">
        </div>';
		}
		?>
		
		
      </div>
      <div class="frame-7174-xgR">
        <div class="frame-7169-VAZ">
          <div class="frame-7165-oh3">
            <div class="thng-tin-l-hng-ZAR"><?php echo $string4;?></div>
            <div class="frame-7166-5Pf">
              <div class="delivery-status-RyK">
                <img class="closed-cardboard-box-with-packing-tape-1-MMB" src="./assets/closed-cardboard-box-with-packing-tape-1.png"/>
                <div class="shipment-overview-sqK"><?php echo $string5;?></div>
              </div>
              <div class="frame-7164-c2D">
                <div class="frame-7162-YgZ">
                  <div class="frame-7161-tEd">
                    <div class="tracking-number-S1F"><?php echo $string6;?></div>
                    <div class="item-777496427531-m3X"><?php echo $_GET['b'];?></div>
                  </div>
                </div>
                <div class="frame-7161-scM">
                  <div class="tracking-number-CPj"><?php echo $string7;?></div>
                  <div class="item-777496427531-XB7"><?php echo location_chinhanh($package['kg_chinhanh'])?></div>
                </div>
                <div class="frame-7164-qhb">
                  <div class="frame-7161-zKb">
                    <div class="tracking-number-9TP"><?php echo $string8;?></div>
                    <div class="item-777496427531-V1T"><?php echo $dulieuquocgia['name'];?></div>
                  </div>
                </div>
                <div class="frame-7161-DCM">
                  <div class="tracking-number-Lnm"><?php echo $string9;?></div>
                  <div class="item-777496427531-gLq"><?php echo $package['date'];?></div>
                </div>
                <div class="frame-7166-D5s">
                  <div class="frame-7161-Mhs">
                    <div class="tracking-number-hWq"><?php echo $string10;?></div>
                    <div class="item-777496427531-dQV"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="frame-7167-LZo">
              <div class="delivery-status-tbK">
                <img class="fast-delivery-1-DNh" src="./assets/fast-delivery-1-LzD.png"/>
                <div class="services-jrq"><?php echo $string11;?></div>
              </div>
              <div class="frame-7164-gGH">
                <div class="frame-7162-3Mj">
                  <div class="frame-7161-z25">
                    <div class="tracking-number-Lrd"><?php echo $string12;?></div>
                    <div class="item-777496427531-UT3"><?php echo $laydichvu['dichvu'];?></div>
                  </div>
                </div>
                <div class="frame-7161-zAV">
                  <div class="tracking-number-81o"><?php echo $string13;?></div>
                  <div class="item-777496427531-ekq"><?php echo $string13a;?></div>
                </div>
              </div>
            </div>
            <div class="frame-7168-n6M">
              <div class="delivery-status-YLR">
                <img class="shopping-list-1-poj" src="./assets/shopping-list-1.png"/>
                <div class="package-details-ZFX"><?php echo $string14;?></div>
              </div>
              <div class="frame-7164-gb3">
                <div class="frame-7162-cUh">
                  <div class="frame-7161-9zR">
                    <div class="tracking-number-WKB"><?php echo $string15;?></div>
                    <div class="item-777496427531-34D">Package</div>
                  </div>
                </div>
                <div class="frame-7161-ZoF">
                  <div class="tracking-number-Vwo"><?php echo $string17;?></div>
                  <div class="item-777496427531-SMF"><?php echo $package['charge_weight'];?> KG</div>
                </div>
                <div class="frame-7164-yc5">
                  <div class="frame-7161-Xdb">
                    <div class="tracking-number-gmP"><?php echo $string18;?></div>
                    <div class="item-777496427531-DWR"><?php echo $package['sokien'];?></div>
                  </div>
                </div>
               
              </div>
            </div>
			

				
				<?php 
				
				
				  echo'<div style="margin-left:15px;margin-top:5px;width:100%;font-size:15px;font-weight:bold;  font-family: Roboto, \'Source Sans Pro\';">'.$string19.'<br>';
				$stt=1;
				while($laydulieupackagea = mysqli_fetch_array($laydulieuhoadonb,MYSQLI_ASSOC))
				{
					@$dulieutrack = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_tracking_bill where id_hoadon='".$laydulieupackagea['id_code']."' AND `check`='1' LIMIT 1"));
					echo '&nbsp;&nbsp;'.$stt.'. ID: <a href="index.php?b='.$laydulieupackagea['id_code'].'">'.$laydulieupackagea['id_code'].' </a>'; 
					if($laydulieupackagea['billketnoi'] != "" && $laydichvu['discount'] != 1)
					{
						echo'- '.$laydulieupackagea['billketnoi'].'';
					}
					echo' </font><br>';
					$stt++;
				}
				
				
				echo'</div>';
				
				?>
            
          </div>
          <div class="divider-9Hb">
            <div class="rectangle-5316-KC5">
            </div>
          </div>
        </div>
        <div class="frame-7175-fFw">
          
		  
		  <!--//hinh lich trinh di chuyen
          <div class="image-4-kc9">
          </div>-->
		  <div class="card card-primary" style="width:100%">
<div class="card-header" style="background-color:#21235b">
<h3 class="card-title" style="font-size:20px"><?php echo $string20;?></h3>
</div>
<div class="card-body" style="background-color:#EEEEEE;width:100%;">
                                            <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column"  >
                                                
												<?php
												//Ket noi API 
												
												
												
												
												
												
												?>
												<?php
											
												
												
												
												
												?>
												
												<?php
												/** hien awb tracking
												@$layawb = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment_details where id_listhoadon='$idhoadon'"));
												@$laydulieutrackawba = mysqli_query($conn,"select * from ns_tracking_shipment where id_awb='".@$layawb['awb']."' order by date DESC");
												while($laydulieutrackawb = mysqli_fetch_array($laydulieutrackawba,MYSQLI_ASSOC))
												{
													
													if($laydulieutrackawb['date'] <= $datenow)
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
												}**/
												?>
												
												<?php
												$laydulieutracka = mysqli_query($conn,"select * from ns_tracking_bill where id_hoadon='$idhoadon' order by date desc");
												$test = 0;
												@$laydulieutrackb = mysqli_query($conn,"select id from ns_tracking_bill where id_hoadon='$idhoadon' AND `status`='DESTINATION CUSTOMS RELEASED'  AND `date` < '$datenow'  LIMIT 1");

												if(mysqli_num_rows($laydulieutrackb) >= 1)
												{
													
													
														if($arr != "")
													{
													foreach(@$arr['data'][0]['origin_info']['trackinfo'] as $result) 
													{
														
														
													if(strpos($result['StatusDescription'], "created") == true){}
													else
													{
													echo'<div class="vertical-timeline-item vertical-timeline-element" style="font-size:20px;">
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
												
													
													
													
													
													
													
													$dulieuups = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_tracking_bill where id_hoadon='$idhoadon' AND `status`='ON FORWARD FOR DELIVERY' "));
													if($dulieuups['address'] != "")
													{
													echo'<div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">'.xulychuoi($dulieuups['status']).'</h4>
                                                            <p style="color:blue">'.$dulieuups['address'].'</span></p>
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
												?>
                                                
                                              
                                                
                                                   
                                                
                                            </div>
                                        </div>
<div class="card-footer">
KSN POST 2023
</div>
</div>
								
		  
		  
		  
		  
        </div>
        <div class="auto-group-jbhj-qdb">
          <div class="sub-link-Lim">
            <!--<img class="download-1-SWu" src="./assets/download-1-4vM.png"/>
            <div class="back-to-top-xVF">Back to top</div>-->
          </div>
          <div class="rectangle-5316-t81">
          </div>
          <div class="frame-7176-2V7">
            <div class="danh-sch-theo-di-ZE9"><?php echo $string21;?></div>
            <div class="bn-hin-khng-c-bt-c-l-hng-no-trong-danh-sch-theo-di-GuF"><?php echo $string22;?></div>
          </div>
          <div class="sub-link-ZNZ">
            <!--<img class="download-1-561" src="./assets/download-1-tsT.png"/>
            <div class="back-to-top-CgR">Back to top</div>-->
          </div>
          <div class="rectangle-5317-vsK">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>