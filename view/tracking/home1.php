<?php
include("../../conn/db.php");
include("../../controller/bill.php");
		
		
					
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 




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
  
	<link rel="icon" type="image/x-icon" href="6.png">

  
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
  rel="stylesheet"
/>

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
></script>

  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  
  
    <link rel="stylesheet" href="timelime.css">
<style>
textarea:focus, input:focus{
    outline: none;
}

.text1{
	margin-auto;
	margin-top:200px;
}


h2{
  text-align:center;
  padding: 20px;
}
/* Slider */

.slick-slide {
    margin: 0px 20px;
}

.slick-slide img {
    width: 100%;
}

.slick-slider
{
    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
            user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
        touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.slick-list
{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-list:focus
{
    outline: none;
}
.slick-list.dragging
{
    cursor: pointer;
    cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list
{
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track
{
    position: relative;
    top: 0;
    left: 0;
    display: block;
}
.slick-track:before,
.slick-track:after
{
    display: table;
    content: '';
}
.slick-track:after
{
    clear: both;
}
.slick-loading .slick-track
{
    visibility: hidden;
}

.slick-slide
{
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}
[dir='rtl'] .slick-slide
{
    float: right;
}
.slick-slide img
{
    display: block;
}
.slick-slide.slick-loading img
{
    display: none;
}
.slick-slide.dragging img
{
    pointer-events: none;
}
.slick-initialized .slick-slide
{
    display: block;
}
.slick-loading .slick-slide
{
    visibility: hidden;
}
.slick-vertical .slick-slide
{
    display: block;
    height: auto;
    border: 1px solid transparent;
}
.slick-arrow.slick-hidden {
    display: none;
}
#aabbcc{
	margin-top:300px;
}
.search{ position: relative; box-shadow: 0 0 40px rgba(51, 51, 51, .1); } 
.search input{ height: 60px; text-indent: 25px; border: 2px solid #d6d4d4; } 
.search input:focus{ box-shadow: none; border: 2px solid blue; } 
.search .fa-search{ position: absolute; top: 20px; left: 16px; } 
.search button{ position: absolute; top: 5px; right: 5px; height: 50px; width: 110px; background: blue; }

@media only screen and (max-width: 768px) {
  body {
 background-image: none;
 background-color: #ffffff;


}
#aabbcc{
	margin-top:100px;
}
.text1{
	margin-auto;
	margin-top:100px;
}
}


div.fixed {
  position: fixed;
  bottom: 0;
  right: 0;
  width: 100%;
  text-align:center;
  background-color:blue;
  color:white;
  z-index:999;
}
div.fixed2 {
  position: fixed;
  top: 0;
  right: 0;
  width: 100%;
  text-align:left;
  background-color:#21235b;
  color:white;
  z-index:999;
  padding:10px;
}

</style>
</head>
<body>

<div class="fixed2">
<img src="https://ksnpost.com/assets/frame-bAh.png" width=120px height=40px style="margin-left:50px;">
</div>
<div class="tracking-szZ">

		
		
        <div class="auto-group-jbhj-qdb">
          <div class="sub-link-Lim">
            <!--<img class="download-1-SWu" src="./assets/download-1-4vM.png"/>
            <div class="back-to-top-xVF">Back to top</div>-->
          </div>
          <div class="rectangle-5316-t81">
          </div>
          <div class="frame-7176-2V7">
            <div class="danh-sch-theo-di-ZE9" style="font-size:20px">
			
			</div>
			
          </div>
          <div class="sub-link-ZNZ">
            <!--<img class="download-1-561" src="./assets/download-1-tsT.png"/>
            <div class="back-to-top-CgR">Back to top</div>-->
          </div>
          <div class="rectangle-5317-vsK">
          </div>
        </div>
		
		
		
      </div><div id="trackingsearch" class="text1">
		<center><img src="text_2.png" width="200px">
		</div><br>
				
			
		<div class="container"> <div class="row height d-flex justify-content-center align-items-center"> <div class="col-md-5"> <div class="search"> <i class="fa fa-search"></i> 		  <form action="index1.php" method="GET">
<input type="text" class="form-control"  name="b" value="" placeholder="Input Your Tracking Number"> <button type="submit" class="btn btn-primary">TRACK</button>
</form>
 </div> </div> </div> </div>		
				
		
   


<div class="container" style="" id="aabbcc">
  <h2><img src="text_3.png" width=""></h2>
   <section class="customer-logos slider">
      <div class="slide"><img src="partner/1.png"></div>
      <div class="slide"><img src="partner/2.png"></div>
      <div class="slide"><img src="partner/3.png"></div>
      <div class="slide"><img src="partner/4.png"></div>
      <div class="slide"><img src="partner/5.png"></div>
      <div class="slide"><img src="partner/6.png"></div>
      <div class="slide"><img src="partner/7.png"></div>
      <div class="slide"><img src="partner/8.png"></div>
      <div class="slide"><img src="partner/9.png"></div>
      <div class="slide"><img src="partner/10.png"></div>
      <div class="slide"><img src="partner/11.png"></div>
      <div class="slide"><img src="partner/12.png"></div>
      <div class="slide"><img src="partner/13.png"></div>
      <div class="slide"><img src="partner/14.png"></div>

     
   </section>
</div>
<div class="fixed">
Sự hài lòng của quý khách là thành công của chúng tôi !
</div>
<br><br><br>
      <script src="./logoslilder/js/script.js"></script>
	<script>
	$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
	</script>
</body>