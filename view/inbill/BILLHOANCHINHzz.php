<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="bill%20gia%20phu_files/filelist.xml">
<script src="JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../inbill/qrcode.min.js"></script>

<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<?php
    @session_start();

	include("../../conn/db.php");
	include("../../controller/bill.php");
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
	
	@$laydulieukienadd = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."'");
	
   // $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id='".$laydulieukien['id']."'"));
    $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id='".$id."'"));
	@$laydulieukienaddz = mysqli_fetch_assoc($laydulieukienadd);

    $nguoigui = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id='".$package['id_nguoigui']."'"));
    $nguoinhan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id='".$package['id_nguoinhan']."'"));
    $dulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user where id='$uid'"));

    $countries = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_countries WHERE id = '".$nguoinhan['country_id']."'"));
    $count =mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id_package = '".$package['id']."'"));

	//$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$nguoigui['ward_id']."'"));
	//$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$nguoigui['province_id']."'"));
	//$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$nguoigui['district_id']."'"));
?>

<style>
body{
  -webkit-print-color-adjust:exact !important;
  print-color-adjust:exact !important;
}
</style>
<style id="bill gia phu_10479_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl1510479
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
.xl6310479
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
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6410479
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
.xl6510479
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
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6610479
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
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6710479
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:"\@";
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6810479
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
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl6910479
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
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7010479
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
	background:#595959;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7110479
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
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7210479
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
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7310479
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
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7410479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7510479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7610479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7710479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7810479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl7910479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl8010479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl8110479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl8210479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl8310479
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
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8410479
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
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8510479
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
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8610479
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
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8710479
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
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8810479
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
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8910479
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
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9010479
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
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9110479
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
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9210479
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:"\@";
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9310479
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
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9410479
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
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9510479
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
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9610479
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
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9710479
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
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9810479
	{padding:0px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	background:#595959;
	mso-pattern:black none;
	white-space:nowrap;}
.xl9910479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10010479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10110479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10210479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10310479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10410479
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
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10510479
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
.xl10610479
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
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#595959;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10710479
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
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#595959;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10810479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10910479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11010479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11110479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11210479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11310479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11410479
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:134;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
-->
</style>
</head>

<body onload=onReady()>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--The following information was generated by Microsoft Excel's Publish as Web
Page wizard.-->
<!--If the same item is republished from Excel, all information between the DIV
tags will be replaced.-->
<!----------------------------->
<!--START OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD -->
<!----------------------------->

<div id="bill gia phu_10479" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=842 style='border-collapse:
 collapse;table-layout:fixed;width:632pt'>
 <col width=200 style='mso-width-source:userset;mso-width-alt:7314;width:150pt'>
 <col width=204 style='mso-width-source:userset;mso-width-alt:7460;width:153pt'>
 <col width=13 style='mso-width-source:userset;mso-width-alt:475;width:10pt'>
 <col width=64 span=5 style='width:48pt'>
 <col width=105 style='mso-width-source:userset;mso-width-alt:3840;width:79pt'>
 <tr height=20 style='height:15.0pt'>
  <td rowspan=5 height=100 width=200 style='height:75.0pt;width:150pt'
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
  </v:shapetype><v:shape id="Picture_x0020_3" o:spid="_x0000_s1027" type="#_x0000_t75"
   style='position:absolute;margin-left:12.75pt;margin-top:3pt;width:126.75pt;
   height:68.25pt;z-index:3;visibility:visible' o:gfxdata="">
   <v:imagedata src="bill%20gia%20phu_files/bill%20gia%20phu_10479_image001.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:3;margin-left:17px;margin-top:4px;width:169px;
  height:91px'><img width=169 height=91
  src="shiba.jpg" v:shapes="Picture_x0020_3"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td rowspan=5 height=100 class=xl7310479 width=200 style='height:75.0pt;
    width:150pt'></td>
   </tr>
  </table>
  </span></td>
  <td colspan=5 class=xl6610479 width=409 style='width:307pt;font-weight:bold;'>SHIBA EXPRESS TRADING AND SERVICES COMPANY LIMITED</td>
  <td colspan=3 height=20 width=233 style='height:15.0pt;width:175pt'
  align=left valign=top><!--[if gte vml 1]><v:shape id="AutoShape_x0020_3"
   o:spid="_x0000_s1025" type="#_x0000_t75" alt="Barcode Types - A List of Popular Barcodes"
   style='position:absolute;margin-left:48pt;margin-top:0;width:24pt;height:24pt;
   z-index:1;visibility:visible;mso-wrap-style:square;v-text-anchor:top'
   o:gfxdata="" o:insetmode="auto">
   <v:imagedata src="bill%20gia%20phu_files/bill%20gia%20phu_10479_image003.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><v:shape id="Picture_x0020_8" o:spid="_x0000_s1026" type="#_x0000_t75"
   alt="√ Pengertian Barcode, Sejarah, Fungsi, Jenis, Cara Kerja dan Manfaatnya"
   style='position:absolute;margin-left:16.5pt;margin-top:17.25pt;width:135.75pt;
   height:47.25pt;z-index:2;visibility:visible' o:gfxdata="">
   <v:imagedata src="bill%20gia%20phu_files/bill%20gia%20phu_10479_image004.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:22px;margin-top:0px;width:181px;
  height:86px'>	<br><svg id="barcode"></svg>
</span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=3 height=20 class=xl7210479 width=233 style='height:15.0pt;
    width:175pt'>AIR WAYBILL NUMBER</td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=5 height=20 class=xl6610479 style='height:15.0pt'>Website:
  <u>https://shibaexpress.vn/</u></td>
  <td colspan=3 rowspan=3 class=xl7310479></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6610479 colspan=3 style='height:15.0pt'>Hotline: 0848 02 5555</td>
  <td class=xl6610479></td>
  <td class=xl6610479></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6610479 colspan=4 style='height:15.0pt'>Địa chỉ: 201 Nguyễn Văn Công, P.3, Quận Gò Vấp, TP.HCM</td>
  <td class=xl6610479></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6610479 style='height:15.0pt'>Chi Nhánh: HCM, VIETNAM</td>
  <td class=xl6610479></td>
  <td class=xl6610479></td>
  <td class=xl6610479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1510479 style='height:15.0pt'></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=2 height=20 class=xl9810479 style='height:15.0pt'>SHIPPER NAME
  AND ADDRESS</td>
  <td class=xl6810479>&nbsp;</td>
  <td colspan=6 class=xl9810479>CONSIGNEE AND ADDRESS</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6910479 colspan=2 style='height:15.0pt'><?php 
  echo $dulieuuser['congty'];
  ?></td>
  <td class=xl1510479></td>
  <td colspan=6 class=xl9410479><?php  echo @$nguoinhan['company_name']; ?></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6910479 style='height:15.0pt'><?php  echo @$nguoigui['name']; ?></td>
  <td class=xl6710479><?php  echo @$nguoigui['phone']; ?></td>
  <td class=xl1510479></td>
  <td colspan=3 class=xl9310479><?php  echo @$nguoinhan['name']; ?></td>
  <td colspan=3 class=xl9210479><?php  echo @$nguoinhan['phone']; ?></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1510479 style='height:15.0pt'><?php 
  echo $dulieuuser['diachi'];
  ?></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td colspan=6 class=xl6610479><?php  echo @$nguoinhan['address']; ?></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1510479 style='height:15.0pt'>VIET NAM</td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479 colspan=2>
  <?php
  $quocgia = strtolower($nguoinhan['country_id']);
	$quocgia_name = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_countries where id='$quocgia'"));
	echo $quocgia_name['name'];
  ?></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1510479 style='height:15.0pt'></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
 </tr>
 <tr height=24 style='mso-height-source:userset;height:18.0pt'>
  <td colspan=2 rowspan=3 height=64 class=xl10810479 width=404
  style='border-right:.5pt solid black;border-bottom:.5pt solid black;
  height:48.0pt;width:303pt'>Description of Good : <?php echo $package['kg_tenhang'];?><br>
    <?php 
	
	  $listcatalog = mysqli_query($conn,"SELECT * FROM ns_mapcatalog WHERE id_bill = '".$laydulieukienaddz['id']."'");
              $arr = [];
              while ($item = mysqli_fetch_array($listcatalog)) {
                $type = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_catalog WHERE id = '".$item['id_catalog']."'"));
                array_push($arr, $type['type_en']);
            }
    echo join(',',$arr);
	
	$laykien = mysqli_query($conn,"select * from ns_listhoadon where id_package='$id'");
	
	$count = 0;
	$tongcannang = 0;
	while($dulieukien = mysqli_fetch_array($laykien))
	{
		$tongcannang += $dulieukien['cannang'];
		$datetime1 = $dulieukien['datetime'];
		$count++;
		if($count == 1)
		{
			@$lenght_kien1 = $dulieukien['width'];
			@$width_kien1 = $dulieukien['width'];
			@$height_kien1 = $dulieukien['width'];
			$weight_kien1 = $dulieukien['cannang'];
			$id_kien1 = $dulieukien['id_code'];
		}
		if($count == 2)
		{
			@$lenght_kien1 = $dulieukien['width'];
			@$width_kien1 = $dulieukien['width'];
			@$height_kien1 = $dulieukien['width'];
			@$weight_kien2 = $dulieukien['cannang'];
			@$id_kien2 = $dulieukien['id_code'];
		}
		if($count == 3)
		{
			@$lenght_kien1 = $dulieukien['width'];
			@$width_kien1 = $dulieukien['width'];
			@$height_kien1 = $dulieukien['width'];
			@$weight_kien3 = $dulieukien['cannang'];
			@$id_kien3 = $dulieukien['id_code'];
		}
	}
	?></td>
  <td rowspan=10 class=xl7310479></td>
  <td class=xl6510479>Order</td>
  <td class=xl6510479 style='border-left:none'>Weight</td>
  <td colspan=3 class=xl10410479 style='border-right:.5pt solid black'>Dimention(cm)</td>
  <td class=xl6510479 style='border-left:none'>HAWB Number</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=2 height=20 class=xl10610479 style='border-right:.5pt solid black;
  height:15.0pt'>&nbsp;</td>
  <td class=xl6410479 style='border-top:none;border-left:none'>Length</td>
  <td class=xl6410479 style='border-top:none;border-left:none'>Width</td>
  <td class=xl6410479 style='border-top:none;border-left:none'>Height</td>
  <td class=xl7010479 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7110479 style='height:15.0pt;border-top:none'><?php if($count>= 1) {echo '1';}?></td>
  <td class=xl6510479 style='border-top:none;border-left:none'><?php echo $weight_kien1;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo $lenght_kien1;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo $width_kien1;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo $height_kien1;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo $id_kien1;?></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=2 rowspan=3 height=60 class=xl11410479 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:45.0pt'>Remark:</td>
  <td class=xl7110479 style='border-top:none'><?php if($count>= 2) {echo '2';}?></td>
  <td class=xl6510479 style='border-top:none;border-left:none'><?php echo @$weight_kien2;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$lenght_kien2;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$width_kien2;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$height_kien2;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$id_kien2;?></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7110479 style='height:15.0pt;border-top:none'><?php if($count>= 3) {echo '3';}?></td>
  <td class=xl6510479 style='border-top:none;border-left:none'><?php echo @$weight_kien3;?></td>
    <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$lenght_kien3;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$width_kien3;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$height_kien3;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$id_kien3;?></td>
 </tr><tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7110479 style='height:15.0pt;border-top:none'><?php if($count>= 3) {echo '3';}?></td>
  <td class=xl6510479 style='border-top:none;border-left:none'><?php echo @$weight_kien3;?></td>
    <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$lenght_kien3;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$width_kien3;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$height_kien3;?></td>
  <td class=xl6310479 style='border-top:none;border-left:none;text-align:center'><?php echo @$id_kien3;?></td>
 </tr>
 <!--
 <tr height=20 style='height:15.0pt'>
  <td colspan=3 height=20 class=xl9510479 style='border-right:.5pt solid black;
  height:15.0pt'>Total Weight: <?php echo $tongcannang;?> KG</td>
  <td colspan=3 class=xl9510479 style='border-right:.5pt solid black;
  border-left:none'>Chargeable Weight:</td>
 </tr>-->
 <tr height=20 style='height:15.0pt'>
  <td rowspan=3 height=60 class=xl9910479 width=200 style='border-bottom:.5pt solid black;
  height:45.0pt;border-top:none;width:150pt'>QRCODE (Scan QR để Tracking)<br>
    <br>
    <span style='mso-spacerun:yes'>    <center>  <?php echo'    		<div id="id_qrcode" style="margin-top:-50px"></div>
';?>  </center> </span></td>
  <td rowspan=3 class=xl9910479 width=204 style='border-bottom:.5pt solid black;
  border-top:none;width:153pt'>Pick up by:<br>
    <br><br><br><br><br><br>
    <span style='mso-spacerun:yes'></span>Datetime: <?php echo $datetime1;?> </td>
  <td colspan=3 class=xl9510479 style='border-right:.5pt solid black;  vertical-align: middle; font-size:15px
'>Pieces:  <?php echo $count;?> 
  PCS</td>
  <td colspan=3 class=xl9510479 style='border-right:.5pt solid black;vertical-align: middle; font-size:15px
  border-left:none'>C.O.D Amount:</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=3 height=20 class=xl9510479 style='border-right:.5pt solid black;vertical-align: middle; font-size:15px
  height:15.0pt'>Service : <b><?php echo dichvu($conn,$package['kg_dichvu']);?></b> </td>
  <td colspan=3 class=xl9510479 style='border-right:.5pt solid black;vertical-align: middle; font-size:15px
  border-left:none'>Invoice Value : 120</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=3 height=20 class=xl9510479 style='border-right:.5pt solid black;vertical-align: middle; font-size:15px
  height:15.0pt'>Type of Package: SPX<span style='mso-spacerun:yes'> </span></td>
  <td colspan=3 class=xl9510479 style='border-right:.5pt solid black;vertical-align: middle; font-size:15px
  border-left:none'>Currency: USD</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1510479 style='height:15.0pt'></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
  <td class=xl1510479></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=6 rowspan=4 height=151 class=xl7410479 width=609
  style='border-right:.5pt solid black;border-bottom:.5pt solid black;
  height:113.25pt;width:457pt'>
    Tôi/Chúng tôi đồng ý sử dụng điều khoản của SHIBA EXPRESS trên vận đơn đường hàng
  không này áp dụng cho lô hàng này và giới hạn tổn thất hoặc thiệt hại cao
  nhất là $100,00 USD /1 lô hàng.<br>
    Tôi/Chúng tôi hiểu rằng SHIBA EXPRESS không VẬN CHUYỂN TIỀN MẶT và xác nhận rằng tất
  cả lô hàng không chứa bất kỳ chất nổ trái phép, thiết bị phá hoại nào hoặc
  vật liệu nguy hiểm theo IATA và điều khoản sử dụng dịch vụ của SHIBA EXPRESS Express.
  Tôi biết rằng sự xác nhận và chữ ký gốc, cùng với các tài liệu khác, sẽ được
  được lưu giữ trong hồ sơ cho đến khi lô hàng được giao.
  <br><p style="float:right"><i><u>Shippers Signature</u></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><br>
  <br>  <br>  <br>  <br>  <br>
  </td>
  <td colspan=3 rowspan=4 class=xl8310479 width=233 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:175pt'>Xác Nhận Của SHIBA EXPRESS <br>
    Signature / Chữ Kí<br>
    <br>
    <br>
    <br>
    <br>
    </td>
 </tr>
 <tr height=20 style='height:15.0pt'>
 </tr>
 <tr height=20 style='height:15.0pt'>
 </tr>
 <tr height=91 style='mso-height-source:userset;height:68.25pt'>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=200 style='width:150pt'></td>
  <td width=204 style='width:153pt'></td>
  <td width=13 style='width:10pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=105 style='width:79pt'></td>
 </tr>
 <![endif]>
</table>

</div>
<?php
echo'<input type=hidden id="abcId" name="abcName" 
                  value="';
				   echo $package['id_code']; 
				  
				  echo'"/> ';
				  
				  ?>
<script>
JsBarcode("#barcode", document.getElementById('abcId').value, {
	
  format: "CODE128",
  lineColor: "",
  width: 2.2,
  height: 40,
  displayValue: true
});
</script>

<?php
echo'<script>
			function onReady()
		{
			
		
';

	$laydulieukienaddz = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."' LIMIT 1")or die("Loi");

		while($laydulieukienzz = mysqli_fetch_array($laydulieukienaddz,MYSQLI_ASSOC))
		{
	echo'	var qrcode = new QRCode("id_qrcode", {
				text:"https://tscpost.com/?id='.$package['id_code'].'",
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
<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->

<script>
<?php
	if($_GET['print'] == "auto")
	{
		echo'window.addEventListener("load", window.print());';
	}
	?>
</script>
</body>

</html>
