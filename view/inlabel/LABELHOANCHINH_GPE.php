<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=gb2312">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="File%20label%20GPE%20fn%2011_files/filelist.xml">
<script src="../inbill/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../inbill/qrcode.min.js"></script>

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
	
	
	$dulieudichvu = mysqli_fetch_assoc(mysqli_query($conn,"select dichvu from ksn_dichvu where id='".$package['kg_dichvu']."'"));
	
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
<style id="File label GPE_25953_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font525953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font625953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font725953
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font825953
	{color:black;
	font-size:7.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font925953
	{color:black;
	font-size:7.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.xl6525953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6625953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6725953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6825953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl6925953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7025953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7125953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7225953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7325953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7425953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7525953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7625953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7725953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7825953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7925953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:14.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:Fixed;
	text-align:center;
	vertical-align:middle;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl8025953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl8125953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl8225953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8325953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8425953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8525953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:7.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:1.0pt solid black;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8625953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:7.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:1.0pt solid black;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8725953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:7.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8825953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:7.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8925953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl9025953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl9125953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt dotted black;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl9225953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt dotted black;
	border-bottom:none;
	border-left:none;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl9325953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl9425953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt dashed windowtext;
	border-bottom:none;
	border-left:none;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl9525953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt dashed windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9625953
	{color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid black;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl9725953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid black;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl9825953
	{color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid black;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl9925953
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:1.0pt solid black;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10025953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt dotted windowtext;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10125953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border-top:.5pt dotted windowtext;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl10225953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt dotted windowtext;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:.5pt dotted black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10325953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt dotted windowtext;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10425953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10525953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10625953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10725953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl10825953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10925953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11025953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11125953
	{color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11225953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11325953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:14.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:Fixed;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl11425953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl11525953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border-top:.5pt dotted windowtext;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl11625953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:top;
	border-top:.5pt dotted windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:.5pt solid black;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl11725953
	{color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid black;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11825953
	{color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11925953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12025953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12125953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
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
.xl12225953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
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
.xl12325953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12425953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12525953
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12625953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:.5pt solid black;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12725953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid black;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12825953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid black;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12925953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13025953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:.5pt solid black;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13125953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid black;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13225953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13325953
	{color:black;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13425953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:7.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:1.0pt solid black;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl13525953
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13625953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:7.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl13725953
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13825953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt dotted windowtext;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13925953
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt dotted windowtext;
	border-right:.5pt dotted black;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl14025953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt dotted windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14125953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14225953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14325953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14425953
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
-->
</style>

<style>
@media print {

    body {
        margin-top: 5px;
        margin-left: 10px;
        transform: scale(var(--scale-factor));
        transform-origin: 0 0;
    }
  }
  
  	@page {
  size: 100mm 150mm;
  margin: 0;   
}
body {
  zoom:140%; /*or whatever percentage you need, play around with this number*/
}
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
	  $i++;
	 $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id_code,charge_weight	 FROM ns_listhoadon WHERE id='".$kienhang['id']."'"));

	  

echo'    		

<div id="File label GPE_25953" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=613 class=xl6525953
 style=\'border-collapse:collapse;table-layout:fixed;width:462pt\'>
 <col class=xl6525953 width=64 style=\'mso-width-source:userset;mso-width-alt:
 2340;width:48pt\'>
 <col class=xl6525953 width=61 span=8 style=\'width:46pt\'>
 <col class=xl6525953 width=61 style=\'width:46pt\'>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=2 rowspan=3 height=60 class=xl14125953 width=125
  style=\'height:45.0pt;width:94pt\'>
  <img src="../../inbill/inbilltw/';
  if(@$dulieuuser['logo'] == "")
  {
	  echo 'logo1.jpg';
  }	  
  else
  {
	  echo @$dulieuuser['logo'];
  }
  echo'" style="margin-left:20px;margin-top:2px;object-fit: contain;" width="120px" height="70px">
  </td>
  <td class=xl10425953 width=61 style=\'width:46pt\'>&nbsp;</td>
  <td class=xl10425953 width=61 style=\'width:46pt\'>&nbsp;</td>
  <td class=xl10425953 width=61 style=\'width:46pt\'>&nbsp;</td>
  <td class=xl10525953 width=61 style=\'width:46pt\'>&nbsp;</td>
  <td class=xl6525953 width=61 style=\'width:46pt\'></td>
  <td class=xl6525953 width=61 style=\'width:46pt\'></td>
  <td class=xl6525953 width=61 style=\'width:46pt\'></td>
  <td class=xl6525953 width=61 style=\'width:46pt\'></td>
 </tr>
 <tr height=20 style=\'mso-height-source:userset;height:15.0pt\'>
  <td height=20 class=xl6625953 style=\'height:15.0pt\'></td>
  <td colspan=3 class=xl8325953 width=183 style=\'border-right:1.0pt solid black;
  width:138pt\'>'.$nguoigui['company_name'].'<br>
    </td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl6725953 style=\'height:15.0pt\'></td>
  <td colspan=3 class=xl8425953 style=\'border-right:1.0pt solid black\'></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=26 style=\'mso-height-source:userset;height:20.1pt\'>
  <td height=26 class=xl10925953 style=\'height:20.1pt\'>&nbsp;</td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl11025953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl11125953 colspan=2 style=\'height:15.0pt\'>DELIVER TO</td>
  <td colspan=3 height=20 width=183 style=\'height:15.0pt;width:138pt\'
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
  </v:shapetype><v:shape id="Picture_x0020_2" o:spid="_x0000_s1077" type="#_x0000_t75"
   alt="QR code là gì? Kh&#7843; n&#259;ng &#7913;ng d&#7909;ng m&atilde; QR t&#7841;i Vi&#7879;t Nam" style=\'position:absolute;
   margin-left:92.25pt;margin-top:0;width:66.75pt;height:66.75pt;z-index:1;
   visibility:visible\' o:gfxdata="">
   <v:imagedata src="File%20label%20GPE%20fn%2011_files/File%20label%20GPE_25953_image001.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:123px;margin-top:0px;width:89px;
  height:89px\'><div id="id_qrcode'.$data['id_code'].'" style=""></div></span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=3 height=20 class=xl7825953 width=183 style=\'height:15.0pt;
    width:138pt\'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl11025953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'mso-height-source:userset;height:15.0pt\'>
  <td colspan=4 height=20 class=xl11225953 width=247 style=\'height:15.0pt;
  width:186pt\'>'.$nguoinhan['name'].'<br>
    </td>
  <td colspan=2 rowspan=3 class=xl7925953 style=\'border-right:1.0pt solid black\'>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'mso-height-source:userset;height:15.0pt\'>
  <td colspan=4 height=20 class=xl11225953 width=247 style=\'height:15.0pt;
  width:186pt\'>'.$nguoinhan['address'].'<br>
    <br>
    </td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=4 height=20 class=xl11225953 width=247 style=\'height:15.0pt;
  width:186pt\'>'.@$citynhan['name'].' '.@$nguoinhan['state'].' '.@$nguoinhan['post_code'].' , '.$countries['name'].'</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=18 style=\'mso-height-source:userset;height:14.1pt\'>
  <td colspan=3 height=18 class=xl11225953 width=186 style=\'height:14.1pt;
  width:140pt\'></td>
  <td class=xl7625953 width=61 style=\'width:46pt\'></td>
  <td colspan=2 class=xl8225953 width=122 style=\'border-right:1.0pt solid black;
  width:92pt\'></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=19 style=\'mso-height-source:userset;height:14.45pt\'>
  <td colspan=6 height=19 class=xl11525953 width=369 style=\'border-right:1.0pt solid black;
  height:14.45pt;width:278pt\'>SERVICE : '.$dulieudichvu['dichvu'].'</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 height=20 class=xl11725953 width=186 style=\'height:15.0pt;
  width:140pt\'>DELIVERY INSTRUCTIONS<br>
    </td>
  <td class=xl6825953></td>
  <td class=xl6825953></td>
  <td class=xl11825953>'.$data['charge_weight'].' KG</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 height=20 class=xl11925953 style=\'height:15.0pt\'>Content :
  '.$package['kg_tenhang'].'</td>
  <td class=xl6825953></td>
  <td class=xl6825953></td>
  <td class=xl12025953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=21 style=\'height:15.75pt\'>
  <td colspan=6 height=21 class=xl12125953 style=\'border-right:1.0pt solid black;
  height:15.75pt\'>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=3 height=20 class=xl12325953 style=\'height:15.0pt\'>Signature NOT
  required</td>
  <td class=xl6925953 colspan=2>MAWB :<font class="font625953"> '.$package['id_code'].'</font></td>
  <td class=xl12425953 style=\'border-top:none\'>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl12525953 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl7325953>&nbsp;</td>
  <td class=xl7325953>&nbsp;</td>
  <td class=xl7425953 colspan=2>PARCEL : '.$i.' of '.$sokienhang.'</td>
  <td class=xl12625953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td colspan=6 height=20 class=xl12725953 style=\'border-right:1.0pt solid black;
  height:15.0pt\'><font class="font725953">HAWB ID</font><font class="font525953">
  :<span
  style=\'mso-spacerun:yes\'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span>'.$data['id_code'].'</font></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl10925953 style=\'height:15.0pt\'>&nbsp;</td>
  <td align=left valign=top><!--[if gte vml 1]><v:shape id="Picture_x0020_4"
   o:spid="_x0000_s1078" type="#_x0000_t75" alt="SSCC Pallet Barcode - yemenbarcodes.com"
   style=\'position:absolute;margin-left:1.5pt;margin-top:3.75pt;width:180pt;
   height:50.25pt;z-index:2;visibility:visible\' o:gfxdata="">
   <v:imagedata src="File%20label%20GPE%20fn%2011_files/File%20label%20GPE_25953_image003.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:2px;margin-top:5px;width:240px;
  height:67px\'>  	<svg id="barcode'.$data['id_code'].'"></svg>
</span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=20 class=xl7225953 width=61 style=\'height:15.0pt;width:46pt\'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl11025953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl10925953 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl11025953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl10925953 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl7225953></td>
  <td class=xl7225953></td>
  <td class=xl6525953></td>
  <td class=xl7225953></td>
  <td class=xl11025953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=21 style=\'mso-height-source:userset;height:15.95pt\'>
  <td height=21 class=xl12925953 style=\'height:15.95pt\'>&nbsp;</td>
  <td class=xl7525953>&nbsp;</td>
  <td class=xl7525953>&nbsp;</td>
  <td class=xl7525953>&nbsp;</td>
  <td class=xl7525953>&nbsp;</td>
  <td class=xl13025953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=21 style=\'height:15.75pt\'>
  <td height=21 class=xl13125953 style=\'height:15.75pt;border-top:none\'>&nbsp;</td>
  <td colspan=4 class=xl8025953>&nbsp;</td>
  <td class=xl13225953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'mso-height-source:userset;height:15.0pt\'>
  <td colspan=2 height=20 class=xl13325953 style=\'border-right:1.0pt solid black;
  height:15.0pt\'>SENDER</td>
  <td colspan=4 rowspan=4 class=xl8525953 width=244 style=\'border-right:1.0pt solid black;
  width:184pt\'><font class="font925953">Aviation Security and Dangerous Goods
  Declaration</font><font class="font825953"><br>
    The sender acknowledges that this article may be carried by air and will be
  subject to aviation security and clearing procedures; and the sender declares
  that the article does not contain any dangerous or prohibited goods,
  explosive or incendiary devices. A false declaration is a criminal
  offence.<br>
    </font></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'mso-height-source:userset;height:15.0pt\'>
  <td colspan=2 height=20 class=xl13525953 width=125 style=\'border-right:1.0pt solid black;
  height:15.0pt;width:94pt\'>'.$nguoigui['company_name'].'<br>
    </td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'mso-height-source:userset;height:15.0pt\'>
  <td height=20 class=xl13725953 colspan=2 style=\'height:15.0pt\'>'.$nguoigui['phone'].'</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl10625953 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl6825953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=31 style=\'mso-height-source:userset;height:23.45pt;\'>
  <td height=31 class=xl13825953 style=\'height:23.45pt;font-size:10px;margin-top:-20px\'><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date printing<br>&nbsp;&nbsp;&nbsp;&nbsp;'.date("Y/m/d H:i:s").'</center></td>
  <td class=xl13925953></td>
  <td colspan=4 class=xl10225953 style=\'border-right:1.0pt solid black; font-size:10px;
  border-left:none\'> SHIPPER BY GIA PHU INT CO.,LTD</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=0 style=\'display:none;mso-height-source:userset;mso-height-alt:
  12\'>
  <td class=xl10025953>&nbsp;</td>
  <td class=xl9225953>&nbsp;</td>
  <td class=xl9125953 style=\'border-left:none\'>&nbsp;</td>
  <td class=xl9325953>&nbsp;</td>
  <td class=xl9325953>&nbsp;</td>
  <td class=xl9425953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <tr height=20 style=\'height:15.0pt\'>
  <td height=20 class=xl9525953 style=\'height:15.0pt\'>&nbsp;</td>
  <td class=xl9525953>&nbsp;</td>
  <td class=xl9525953>&nbsp;</td>
  <td class=xl9525953>&nbsp;</td>
  <td class=xl9525953>&nbsp;</td>
  <td class=xl9525953>&nbsp;</td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
  <td class=xl6525953></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style=\'display:none\'>
  <td width=64 style=\'width:48pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
  <td width=61 style=\'width:46pt\'></td>
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
  width: 2.4,
  height: 50,
  displayValue: false
});
</script>
'; }
  
  echo'
		<script>
			function onReady()
		{
			
		
';

	$laydulieukienaddz = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."'")or die("Loi");

		while($laydulieukienzz = mysqli_fetch_array($laydulieukienaddz,MYSQLI_ASSOC))
		{
	echo'	var qrcode = new QRCode("id_qrcode'.$laydulieukienzz['id_code'].'", {
				text:"https://giaphuexpress.com/view/tracking/index1.php?b="+document.getElementById(\'abcId'.$laydulieukienzz['id_code'].'\').value,
				width:90,
				height:90,
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
