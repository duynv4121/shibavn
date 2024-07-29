<?php
include("../../conn/db.php");
include("../../controller/bill.php");
		
		
					
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 


if($isMob){ 
echo'<script> 
					window.location = "index1.php";

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

  
  
  
    <link rel="stylesheet" href="timelime.css">
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
		
		  <form action="index.php" method="GET">

          <!--<div class="us00000000031-Znq">US00000000031</div>-->
		  <input type="text" style="border: none;font-size:20px;color:red;margin-top:-8px" name="b" value="" placeholder="Nhập mã vận đơn">
          <img class="icons-search24px-BSq" src="./assets/icons-search24px.png"/>	    
	

        </div>    <button type="sbumit "class="frame-7152-GDP">Track</button></form>
	
	
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
            <div class="danh-sch-theo-di-ZE9" style="font-size:20px">Hệ thống check mã vận đơn KSN POST<br>Nhập mã vận đơn của bạn để tracking vận đơn trên hệ thống
			</div><br><br><br><br><br>
			<img src="aaa.jpg">
            <div class="bn-hin-khng-c-bt-c-l-hng-no-trong-danh-sch-theo-di-GuF">KSN Post ® Tracking</div>
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