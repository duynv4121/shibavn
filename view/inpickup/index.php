<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">




<?php 

	@session_start();

	include("../../conn/db.php");
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
    $pickup = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_pickup WHERE id='".$id."'"));
    $dulieunhanvien = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id='".$pickup['uid_pickup']."'"));
    $dulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user WHERE id='".$pickup['uid']."'"));
	
	
?>

<head>
<title><?php echo 'Pickup KSN'.($pickup['id']+1000000);?></title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<style>
tr.success td {   background-color: #EEEEEE !important;     -webkit-print-color-adjust: exact; }  tr.success2 td {     background-color: #DDDDDD !important;     -webkit-print-color-adjust: exact; }
</style>
<link rel=File-List href="PICKUPBILL2_files/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="PICKUPBILL_20337_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font520337
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.xl1520337
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6320337
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6420337
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:16.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6520337
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:16.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6620337
	{color:red;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl6720337
	{color:red;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl6820337
	{color:red;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl6920337
	{color:red;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7020337
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7120337
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7220337
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7320337
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7420337
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7520337
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7620337
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7720337
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7820337
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7920337
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:163;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
-->
</style>
</head>

<body>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--The following information was generated by Microsoft Excel's Publish as Web
Page wizard.-->
<!--If the same item is republished from Excel, all information between the DIV
tags will be replaced.-->
<!----------------------------->
<!--START OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD -->
<!----------------------------->

<div id="PICKUPBILL_20337" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=993 style='border-collapse:
 collapse;table-layout:fixed;width:745pt; '>
 <col width=310 style='mso-width-source:userset;mso-width-alt:11337;width:233pt'>
 <col width=619 style='mso-width-source:userset;mso-width-alt:22637;width:464pt'>
 <col width=64 style='width:48pt'>
 <tr height=161 style='height:120.75pt;background-color:#EEEEEE;' class="success">
  <td height=161 width=310 style='height:120.75pt;width:233pt' align=left
  valign=top><!--[if gte vml 1]><v:shapetype id="_x0000_t75" coordsize="21600,21600"
   o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe" filled="f"
   stroked="f">
   <v:stroke joinstyle="miter"/>
   <v:formulas>
    <v:f eqn="if lineDrawn pixelLineWidth 0"/>
    <v:f eqn="sum @0 1 0"/>
    <v:f eqn="sum 0 0 @1"/>
    <v:f eqn="prod @2 1 2"/>
    <v:f eqn="prod @3 21600 pixelWidth"/>
    <v:f eqn="prod @3 21600 pixelHeight"/>
    <v:f eqn="sum @0 0 1"/>
    <v:f eqn="prod @6 1 2"/>
    <v:f eqn="prod @7 21600 pixelWidth"/>
    <v:f eqn="sum @8 21600 0"/>
    <v:f eqn="prod @7 21600 pixelHeight"/>
    <v:f eqn="sum @10 21600 0"/>
   </v:formulas>
   <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:shapetype><v:shape id="Picture_x0020_3" o:spid="_x0000_s1037" type="#_x0000_t75"
   style='position:absolute;margin-left:18pt;margin-top:27pt;width:190.5pt;
   height:60pt;z-index:2;visibility:visible' o:gfxdata="">
   <v:imagedata src="PICKUPBILL2_files/PICKUPBILL_20337_image001.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:24px;margin-top:36px;width:254px;
  height:80px'><img width=254 height=80
  src="PICKUPBILL2_files/PICKUPBILL_20337_image002.png" v:shapes="Picture_x0020_3"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=161 class=xl7820337 width=310 style='height:120.75pt;width:233pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td class=xl7920337 width=619 style='width:464pt'>GPE LOG TRANS CO., LTD /
  GPE COURIER<br>
    Trụ sở: 09 Đường Trần Văn Dư, Phường 13, Quận Tân Bình, Tp HCM.<br>
    CN Hà Nội: Số 5, Lô 5, Khu Báo Nhân Dân, Đường Trịnh Văn Bô, Phường Xuân
  Phương, Quận Nam Từ Liêm, Hà Nội.<br>
    CN Đà Nẵng: 90 Nguyễn Hữu Thọ, Phường Hòa Thuận Tây, Quận Hải Châu, Đà
  Nẵng.<br>
    Email: sales@GPEexp.com // Info@GPEexp.vn<br>
    Web: GPEexp.com<br>
    Hotline : 1900 9475 - 0921.44.1111</td>
 </tr>
 <tr height=41 style='mso-height-source:userset;height:30.75pt;background-color:#DDDDDD' class="success2">
  <td colspan=2 height=41 class=xl6420337 style='border-right:1.0pt solid black;
  height:30.75pt'>Delivery and Reception</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7220337 style='height:15.0pt;border-top:none'>Pickup
  Request Number</td>
  <td class=xl7320337 style='border-top:none'><?php echo 'KSN'.($pickup['id']+1000000);?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Account
  Number:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $dulieunhanvien['cus_code']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Awb
  Number:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $pickup['id_bill']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Pickup
  Address:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $pickup['pickup_address']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Phone
  Number:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $dulieuuser['phone']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Company
  Name:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $dulieuuser['congty']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Contact
  Name:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $dulieuuser['ten']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Pickup
  Type:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $pickup['pickup_type']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Pickup
  Datetime:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $pickup['pickup_fn_time']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Total
  number of Packages:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $pickup['sokien']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7420337 style='height:15.0pt;border-top:none'>Gross
  Weight:</td>
  <td class=xl7520337 style='border-top:none'><?php echo $pickup['pickup_weight']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl7620337 style='height:15.75pt'>Special Instructions:</td>
  <td class=xl7720337><?php echo $pickup['pickup_remark']?></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=2 rowspan=12 height=294 width=929 style='border-right:1.0pt solid black;
  height:220.5pt;width:697pt' align=left valign=top><!--[if gte vml 1]><v:shape
   id="Picture_x0020_2" o:spid="_x0000_s1036" type="#_x0000_t75" alt="Bỏ tiền vào kiện hàng gửi, mất ai đền!"
   style='position:absolute;margin-left:192pt;margin-top:7.5pt;width:301.5pt;
   height:206.25pt;z-index:1;visibility:visible' o:gfxdata="">
   <v:imagedata src="PICKUPBILL2_files/PICKUPBILL_20337_image003.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:256px;margin-top:10px;width:402px;
  height:275px'><img width=402 height=275
  src="../../upload/<?php echo $pickup['img'];?>"
  alt="Hình ảnh pickup từ KSN" v:shapes="Picture_x0020_2"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=2 rowspan=12 height=294 class=xl6620337 width=929
    style='border-right:1.0pt solid black;height:220.5pt;width:697pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td class=xl1520337></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1520337 style='height:15.0pt'></td>
 </tr>
 <tr height=74 style='mso-height-source:userset;height:55.5pt'>
  <td height=74 class=xl1520337 style='height:55.5pt'></td>
 </tr>
 <tr height=133 style='mso-height-source:userset;height:99.75pt'>
  <td height=133 class=xl7020337 width=310 style='height:99.75pt;border-top:
  none;width:233pt'>Customer ( Khách Hàng<span style='mso-spacerun:yes'> 
  </span>)<br>
   <?php echo 'Contact Name: '.$dulieuuser['ten'].'<br>Company: ['.$dulieuuser['congty'].' ]';?>
   
   </td>
  <td class=xl7120337 width=619 style='border-top:none;border-left:none;
  width:464pt'>Pickup Name<br>
    Ký, họ tên
	<br>
	
	<?php echo ' <center><img src="../'.$dulieunhanvien['img_sign'].'" width=200px height=110px></center><br>
';?>
	
	</td>
  <td class=xl6320337></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=310 style='width:233pt'></td>
  <td width=619 style='width:464pt'></td>
  <td width=64 style='width:48pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>
<script>
<?php
	if($_GET['print'] == "auto")
	{
		echo'window.addEventListener("load", window.print());
';
	}
	?>
</script>
</html>
