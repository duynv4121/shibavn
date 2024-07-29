<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="LABELHOANCHINH2_files/filelist.xml">
<script src="../inbill/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../inbill/qrcode.min.js"></script>
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->

<style>

@page {
  size: 100mm 150mm;
  margin: 0;
}
</style>

<?php 

	@session_start();

	include("../../conn/db.php");
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
    $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id='".$id."'"));

    $nguoigui = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id='".$package['id_nguoigui']."'"));
	$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$nguoigui['ward_id']."'"));
	$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$nguoigui['province_id']."'"));
	$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$nguoigui['district_id']."'"));
	
	
	
    $nguoinhan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id='".$package['id_nguoinhan']."'"));
    $dulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user where id='".$package['uid']."'"));

    $countries = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM ns_countries WHERE id = '".$nguoinhan['country_id']."'"));
    $citynhan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM cities WHERE id = '".$nguoinhan['city']."'"));
    $count =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id_package = '".$package['id']."'"));
	
	
	$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu,api_connect from ksn_dichvu where id='".$package['kg_dichvu']."'"));
	
	if($package['kg_reiceiversign'] == 1)
	{
	$checksign = "YES";
	}
	else
	{
	$checksign = "NO";
	}
	
	
	if($package['kg_chinhanh'] == "HCM")
	{
		$zipcodevn = "700000";
	}
	else
	{
		$zipcodevn = "100000";
	}
	
?>
<title>LABEL SHIBA <?php echo$package['id_code'];?></title>


<style id="Book1_9758_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl159758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl639758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl649758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl659758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl669758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl679758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl689758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl699758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl709758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl719758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl729758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl739758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl749758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl759758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl769758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl779758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl789758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl799758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl809758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl819758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl829758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl839758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl849758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl859758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl869758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl879758
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl889758
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl899758
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl909758
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl919758
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl929758
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl939758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"d\\-mmm";
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl949758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl959758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl969758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl979758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl989758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:18.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
-->
</style>
</head>

<body  onload=onReady()>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--The following information was generated by Microsoft Excel's Publish as Web
Page wizard.-->
<!--If the same item is republished from Excel, all information between the DIV
tags will be replaced.-->
<!----------------------------->
<!--START OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD -->
<!----------------------------->



<?php
$kienhanga = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."' ");
$sokienhang = mysqli_num_rows($kienhanga);
$i = 0;
  while($kienhang = mysqli_fetch_array($kienhanga,MYSQLI_ASSOC)){
	 $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id_code FROM ns_listhoadon WHERE id='".$kienhang['id']."'"));

	  
	$i++;
echo'
<div id="Book1_9758" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=404 style=\'border-collapse:
 collapse;table-layout:fixed;width:304pt\'>
 <col width=90 style=\'mso-width-source:userset;mso-width-alt:3291;width:68pt\'>
 <col width=64 span=4 style=\'width:48pt\'>
 <col width=58 style=\'mso-width-source:userset;mso-width-alt:2121;width:44pt\'>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 rowspan=3 height=60 width=218 style=\'height:45.0pt;width:164pt;border:0.05em black solid;\'
  align=left valign=top><!--[if gte vml 1]><v:shapetype id="_x0000_t75"
   coordsize="21600,21600" o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe"
   filled="f" stroked="f">
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
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_s1031" type="#_x0000_t75"
   style=\'position:absolute;margin-left:6.75pt;margin-top:1.5pt;width:132.75pt;
   height:42pt;z-index:1;visibility:visible\' o:gfxdata="">
   <v:imagedata src="LABELHOANCHINH2_files/Book1_9758_image001.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:20px;margin-top:2px;width:177px;
  height:56px\'><img width=177 height=56
  src="../../inbill/inbilltw/';
  if($dulieuuser['logo'] == "")
  {
	  echo 'shiba.png';
  }else if($dulieuuser['roleid'] == 2 AND $dulieudichvu['api_connect'] == 'kango')
 {	
	  echo 'logotscpost.png';

 }
  else
  {
	  echo $dulieuuser['logo'];
  }
  echo'" v:shapes="Picture_x0020_1" style="object-fit: contain;"></span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=3 rowspan=3 height=60 class=xl639758 width=218
    style=\'height:45.0pt;width:164pt\'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td colspan=3 rowspan=3 class=xl649758 width=186 style=\'width:140pt\'><br>
    TSCPOST.COM<br>
    DATE: '.(date("d/m/Y")).'<br>
    </td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl919758 style=\'height:15.0pt;border-top:none\'>From:</td>
  <td class=xl669758 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl669758 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl669758 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl669758 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl679758 style=\'border-top:none\'>&nbsp;</td>
 </tr>';
 
 if($dulieuuser['roleid'] == 2 AND $dulieudichvu['api_connect'] == 'kango')
 {
	  echo'
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 style=\'height:15.0pt\'></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=3 style=\'height:15.0pt\'>TSC POST</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 height=20 class=xl889758 style=\'height:15.0pt\'> Nguyễn Văn Công, Phường 03 , Q.Gò Vấp, T.p HCM</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=5 style=\'height:15.0pt\'  style=\'white-space: pre-wrap;\'>
  <span style=\'mso-spacerun:yes\'> </span></td>
  <td class=xl689758>&nbsp;</td>
 </tr>';
 }
 else
 {
 echo'
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 style=\'height:15.0pt\'>'.$nguoigui['name'].'</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=3 style=\'height:15.0pt\'>'.$nguoigui['company_name'].'</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 height=20 class=xl889758 style=\'height:15.0pt\'>'.$nguoigui['phone'].'</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=5 style=\'height:15.0pt\'  style=\'white-space: pre-wrap;\'>'.$nguoigui['address'].', <br>'.$ward['name'].', '.$district['name'].'<span style=\'mso-spacerun:yes\'> </span></td>
  <td class=xl689758>&nbsp;</td>
 </tr>';
 }
 echo'
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=2 style=\'height:15.0pt\'>'.$province['name'].' 
  '.$zipcodevn.'</td>
  <td class=xl159758></td>
  <td align=left valign=top><!--[if gte vml 1]><v:shape id="Picture_x0020_2"
   o:spid="_x0000_s1032" type="#_x0000_t75" style=\'position:absolute;
   margin-left:25.5pt;margin-top:6pt;width:94.5pt;height:96pt;z-index:2;
   visibility:visible\' o:gfxdata="">
   <v:imagedata src="LABELHOANCHINH2_files/Book1_9758_image003.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:34px;margin-top:8px;width:126px;
  height:128px\'>
  <!--
  <img width=126 height=128
  src="LABELHOANCHINH2_files/Book1_9758_image004.png" v:shapes="Picture_x0020_2">-->
    		<div id="id_qrcode'.$data['id_code'].'" style="border:1px solid black "></div>

  </span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=20 class=xl159758 width=64 style=\'height:15.0pt;width:48pt\'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 style=\'height:15.0pt\'>VIET NAM</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl929758 style=\'height:15.0pt\'>Ship To:</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=2 style=\'height:15.0pt\'>'.$nguoinhan['name'].'</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 height=20 class=xl889758 style=\'height:15.0pt\'>'.$nguoinhan['address'].'</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=3 style=\'height:15.0pt\'>'.$citynhan['name'].' '.$nguoinhan['state'].' '.$nguoinhan['post_code'].'</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=2 style=\'height:15.0pt\'>'.$countries['name'].'</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl889758 colspan=2 style=\'height:15.0pt\'></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=2 height=20 class=xl719758 style=\'border-right:.5pt solid black;
  height:15.0pt\'>SERVICE:<span style=\'mso-spacerun:yes\'> </span></td>
  <td colspan=4 class=xl739758 style=\'border-right:.5pt solid black;border-left:
  none\'>'.$dulieudichvu['dichvu'].'</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=2 height=20 class=xl719758 style=\'border-right:.5pt solid black;
  height:15.0pt\'>AWB / TRACKING#</td>
  <td colspan=4 class=xl769758 style=\'border-right:.5pt solid black;border-left:
  none\'>'.$package['id_code'].'</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=2 height=20 class=xl719758 style=\'border-right:.5pt solid black;
  height:15.0pt\'>HAWB#</td>
  <td colspan=4 class=xl769758 style=\'border-right:.5pt solid black;border-left:
  none\'>'.$data['id_code'].'</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=6 rowspan=4 height=73 width=404 style=\'height:54.75pt;width:304pt;border:0.5px solid black;\'
  align=left valign=top><!--[if gte vml 1]><v:shape id="Picture_x0020_3"
   o:spid="_x0000_s1033" type="#_x0000_t75" o:gfxdata="">
   <v:imagedata src="LABELHOANCHINH2_files/Book1_9758_image005.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:3;margin-left:83px;margin-top:8px;width:252px;
  height:59px\'>
  
  
  <!--<img width=252 height=59
  src="LABELHOANCHINH2_files/Book1_9758_image006.png" v:shapes="Picture_x0020_3">-->
  	<svg id="barcode'.$data['id_code'].'"></svg>

  
  
  </span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=6 rowspan=4 height=73 class=xl639758 width=404
    style=\'height:54.75pt;width:304pt\'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=13 style=\'mso-height-source:userset;height:9.75pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=6 height=20 class=xl799758 style=\'border-right:.5pt solid black;
  height:15.0pt\'> &nbsp;Reference No:'.$package['kg_ref'].'</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 rowspan=2 height=40 class=xl829758 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:30.0pt\'>Total Pcs: '.$sokienhang.'</td>
  <td colspan=3 rowspan=2 class=xl829758 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black\'>SPX</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=6 rowspan=2 height=36 class=xl939758 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:27.0pt\'>'.$i.'/'.$sokienhang.'</td>
 </tr>
 <tr height=16 style=\'mso-height-source:userset;height:12.0pt\'>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style=\'display:none\'>
  <td width=90 style=\'width:68pt\'></td>
  <td width=64 style=\'width:48pt\'></td>
  <td width=64 style=\'width:48pt\'></td>
  <td width=64 style=\'width:48pt\'></td>
  <td width=64 style=\'width:48pt\'></td>
  <td width=58 style=\'width:44pt\'></td>
 </tr>
 <![endif]>
</table>

</div><div style="break-after:page"></div>
	<input type=hidden id="abcId'.$data['id_code'].'" name="abcName" 
                  value="';
				   echo $data['id_code']; 
				  
				  echo'"/> 
				  
				  
				  
				  
<script>
JsBarcode("#barcode'.$data['id_code'].'", document.getElementById(\'abcId'.$data['id_code'].'\').value, {
	
  format: "CODE128",
  lineColor: "",
  width: 2,
  height: 40,
  displayValue: false
});
</script>
';
  }
  
  echo'
		<script>
			function onReady()
		{
			
		
';

	$laydulieukienaddz = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."'")or die("Loi");

		while($laydulieukienzz = mysqli_fetch_array($laydulieukienaddz,MYSQLI_ASSOC))
		{
	echo'	var qrcode = new QRCode("id_qrcode'.$laydulieukienzz['id_code'].'", {
				text:"https://tscpost.com/?id="+document.getElementById(\'abcId'.$laydulieukienzz['id_code'].'\').value,
				width:120,
				height:115,
				colorDark:"#000000",
				colorLight:"#ffffff",
				correctLevel:QRCode.CorrectLevel.H
			});
	
	';
		}
		
		echo'} </script>';
  
  
?>
<script>
<?php
	if($_GET['print'] == "auto")
	{
		echo'window.addEventListener("load", window.print());';
	}
	?>
</script>
<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
