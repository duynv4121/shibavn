<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="LABELHOANCHINH1_files/filelist.xml">

<?php 

	@session_start();

	include("../../conn/db.php");
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
    $package = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package WHERE id='".$id."'"));

    $nguoigui = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id='".$package['id_nguoigui']."'"));
	$ward = mysql_fetch_assoc(mysql_query("SELECT * FROM yn_ward WHERE id='".$nguoigui['ward_id']."'"));
	$province = mysql_fetch_assoc(mysql_query("SELECT * FROM yn_province WHERE id='".$nguoigui['province_id']."'"));
	$district = mysql_fetch_assoc(mysql_query("SELECT * FROM yn_district WHERE id='".$nguoigui['district_id']."'"));
	
	
	
    $nguoinhan = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id='".$package['id_nguoinhan']."'"));
    $dulieuuser = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_user where id='$uid'"));

    $countries = mysql_fetch_assoc(mysql_query("SELECT name FROM ns_countries WHERE id = '".$nguoinhan['country_id']."'"));
    $citynhan = mysql_fetch_assoc(mysql_query("SELECT name FROM cities WHERE id = '".$nguoinhan['city']."'"));
    $count =mysql_num_rows(mysql_query("SELECT * FROM ns_listhoadon WHERE id_package = '".$package['id']."'"));
	
	
	$dulieudichvu = mysql_fetch_assoc(mysql_query("select dichvu from ksn_dichvu where id='".$package['kg_dichvu']."'"));
	
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
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:20.0pt;
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
.xl899758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:20.0pt;
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
.xl909758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:20.0pt;
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
.xl919758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:20.0pt;
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
.xl929758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:20.0pt;
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
.xl939758
	{padding:0px;
	mso-ignore:padding;
	color:#002060;
	font-size:20.0pt;
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
.xl949758
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
.xl959758
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
.xl969758
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
.xl979758
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
.xl989758
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
-->
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
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


<?php
$kienhanga = mysql_query("select * from ns_listhoadon where id_package='".$id."' ");
$sokienhang = mysql_num_rows($kienhanga);
$i = 0;
  while($kienhang = mysql_fetch_array($kienhanga)){
	$i++;
echo'
<div id="Book1_9758" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=407 style=\'border-collapse:
 collapse;table-layout:fixed;width:306pt\'>
 <col width=90 style=\'mso-width-source:userset;mso-width-alt:3291;width:68pt\'>
 <col width=64 span=4 style=\'width:48pt\'>
 <col width=61 style=\'mso-width-source:userset;mso-width-alt:2230;width:46pt\'>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 rowspan=3 height=60 width=218 style=\'height:45.0pt;width:164pt\'
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
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_s1028" type="#_x0000_t75"
   style=\'position:absolute;margin-left:6.75pt;margin-top:1.5pt;width:132.75pt;
   height:42pt;z-index:1;visibility:visible\' o:gfxdata="">
   <v:imagedata src="LABELHOANCHINH1_files/Book1_9758_image001.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:9px;margin-top:2px;width:177px;
  height:56px\'><img width=177 height=56
  src="LABELHOANCHINH1_files/Book1_9758_image002.png" v:shapes="Picture_x0020_1"></span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=3 rowspan=3 height=60 class=xl639758 width=218
    style=\'height:45.0pt;width:164pt\'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td colspan=3 rowspan=3 class=xl649758 width=189 style=\'width:142pt\'><br>
    KSN POST VN<br>
    DATE: 01/06/2023<br>
    </td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl979758 style=\'height:15.0pt;border-top:none\'>From:</td>
  <td class=xl669758 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl669758 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl669758 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl669758 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl679758 style=\'border-top:none\'>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 style=\'height:15.0pt\'>Mr Sang</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 colspan=3 style=\'height:15.0pt\'>KANGO LOG TRANS
  CO.,LTD</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 height=20 class=xl949758 style=\'height:15.0pt\'>84921441111</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 colspan=5 style=\'height:15.0pt\'>09 Tran Van Du
  Street, Ward 13, Tan Binh District,<span style=\'mso-spacerun:yes\'> </span></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 colspan=2 style=\'height:15.0pt\'>Ho Chi Minh City
  70000</td>
  <td class=xl159758></td>
  <td align=left valign=top><!--[if gte vml 1]><v:shape id="Picture_x0020_2"
   o:spid="_x0000_s1029" type="#_x0000_t75" style=\'position:absolute;
   margin-left:25.5pt;margin-top:6pt;width:94.5pt;height:96pt;z-index:2;
   visibility:visible\' o:gfxdata="">
   <v:imagedata src="LABELHOANCHINH1_files/Book1_9758_image003.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:34px;margin-top:8px;width:126px;
  height:128px\'><img width=126 height=128
  src="LABELHOANCHINH1_files/Book1_9758_image004.png" v:shapes="Picture_x0020_2"></span><![endif]><span
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
  <td height=20 class=xl949758 style=\'height:15.0pt\'>Viet Nam</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl989758 style=\'height:15.0pt\'>Ship To:</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 colspan=2 style=\'height:15.0pt\'>CHAU HUYEN</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 height=20 class=xl949758 style=\'height:15.0pt\'>14086446666</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 colspan=3 style=\'height:15.0pt\'>3854 Castellina
  Way Manteca</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 colspan=2 style=\'height:15.0pt\'>CALIFONIA 95337</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl949758 colspan=2 style=\'height:15.0pt\'>UNITED STATES -
  US</td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl159758></td>
  <td class=xl689758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl959758 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl699758>&nbsp;</td>
  <td class=xl699758>&nbsp;</td>
  <td class=xl699758>&nbsp;</td>
  <td class=xl699758>&nbsp;</td>
  <td class=xl709758>&nbsp;</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=2 height=20 class=xl719758 style=\'border-right:.5pt solid black;
  height:15.0pt\'>SERVICE:<span style=\'mso-spacerun:yes\'> </span></td>
  <td colspan=4 class=xl739758 style=\'border-right:.5pt solid black;border-left:
  none\'>KSN-US</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=2 height=20 class=xl719758 style=\'border-right:.5pt solid black;
  height:15.0pt\'>AWB / TRACKING#</td>
  <td colspan=4 class=xl769758 style=\'border-right:.5pt solid black;border-left:
  none\'>2999900000</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=2 height=20 class=xl719758 style=\'border-right:.5pt solid black;
  height:15.0pt\'>HAWB#</td>
  <td colspan=4 class=xl769758 style=\'border-right:.5pt solid black;border-left:
  none\'>394279000000</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=6 rowspan=4 height=80 width=407 style=\'height:60.0pt;width:306pt\'
  align=left valign=top><!--[if gte vml 1]><v:shape id="Picture_x0020_3"
   o:spid="_x0000_s1030" type="#_x0000_t75" style=\'position:absolute;
   margin-left:48.75pt;margin-top:2.25pt;width:214.5pt;height:57.75pt;
   z-index:3;visibility:visible\' o:gfxdata="">
   <v:imagedata src="LABELHOANCHINH1_files/Book1_9758_image005.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:3;margin-left:65px;margin-top:3px;width:286px;
  height:77px\'>
  aaaaaaaaaaaaaaaa
  
  </span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=6 rowspan=4 height=80 class=xl639758 width=407
    style=\'height:60.0pt;width:306pt\'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=6 height=20 class=xl799758 style=\'border-right:.5pt solid black;
  height:15.0pt\'>Reference No:</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 rowspan=2 height=40 class=xl829758 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:30.0pt\'>Total Pcs: 3</td>
  <td colspan=3 rowspan=2 class=xl829758 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black\'>SPX</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=6 rowspan=2 height=40 class=xl889758 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:30.0pt\'>'.$i.'/'.$sokienhang.'</td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style=\'display:none\'>
  <td width=90 style=\'width:68pt\'></td>
  <td width=64 style=\'width:48pt\'></td>
  <td width=64 style=\'width:48pt\'></td>
  <td width=64 style=\'width:48pt\'></td>
  <td width=64 style=\'width:48pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
 </tr>
 <![endif]>
</table>

</div>
<div style="break-after:page"></div>
';
  }
?>

<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
