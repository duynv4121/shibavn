<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>

<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="BILLHOANCHINH_files/filelist.xml">
<script src="JsBarcode.all.min.js"></script>

<?php 

	@session_start();

	include("../../conn/db.php");
	include("../../controller/bill.php");
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
    $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id='".$id."'"));

    $nguoigui = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id='".$package['id_nguoigui']."'"));
	$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$nguoigui['ward_id']."'"));
	$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$nguoigui['province_id']."'"));
	$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$nguoigui['district_id']."'"));
	
	
	
    $nguoinhan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id='".$package['id_nguoinhan']."'"));
    $dulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user where id='".$package['uid']."'"));
	if($dulieuuser['roleid'] == 6)
	{
		echo'<script> 
							window.location = "BILLHOANCHINH-KIKI.php?id='.$id.'&print=auto";

              </script>';
	}
    $countries = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name,iso2 FROM ns_countries WHERE id = '".$nguoinhan['country_id']."'"));
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
<title>BILL GPE <?php echo$package['id_code'];?></title>
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="GPE_BILL_RENEW (3)_23493_Styles">
body{
  -webkit-print-color-adjust:exact !important;
  print-color-adjust:exact !important;
}
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font523493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.font623493
	{color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;}
.font723493
	{color:#212529;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;}
.font823493
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.font923493
	{color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.font1023493
	{color:#212529;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;}
.font1123493
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.font1223493
	{color:windowtext;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.font1323493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.xl1523493
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
.xl6423493
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
.xl6523493
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
	white-space:normal;}
.xl6623493
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
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6723493
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
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6823493
	{padding:0px;
	mso-ignore:padding;
	color:red;
	font-size:14.0pt;
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
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6923493
	{padding:0px;
	mso-ignore:padding;
	color:red;
	font-size:14.0pt;
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
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7023493
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
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7123493
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
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7223493
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
.xl7323493
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
.xl7423493
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
.xl7523493
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
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7623493
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
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7723493
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
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7823493
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
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7923493
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
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8023493
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
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8123493
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
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8223493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8323493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8423493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl8523493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8623493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8723493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8823493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8923493
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
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9023493
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
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9123493
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
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9223493
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
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9323493
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
	white-space:normal;}
.xl9423493
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
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9523493
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
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9623493
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
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9723493
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
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9823493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
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
.xl9923493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10023493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10123493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10223493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10323493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10423493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10523493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10623493
	{color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10723493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	background:#F8CBAD;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10823493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	background:#F8CBAD;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl10923493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#F8CBAD;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11023493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#F8CBAD;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11123493
	{color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
.xl11223493
	{color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11323493
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11423493
	{color:#212529;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11523493
	{color:#212529;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11623493
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11723493
	{color:#212529;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11823493
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl11923493
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12023493
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12123493
	{color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12223493
	{color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12323493
	{color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12423493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#F8CBAD;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12523493
	{color:#212529;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
.xl12623493
	{color:#212529;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12723493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#F8CBAD;
	mso-pattern:black none;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12823493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#F8CBAD;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl12923493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#F8CBAD;
	mso-pattern:black none;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13023493
	{color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13123493
	{color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13223493
	{color:#212529;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13323493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
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
.xl13423493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13523493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13623493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13723493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:top;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13823493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl13923493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl14023493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl14123493
	{color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
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
	white-space:normal;
	padding-left:9px;
	mso-char-indent-count:1;}
.xl14223493
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
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
.xl14323493
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:8.0pt;
	font-weight:400;
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
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl14423493
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
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
.xl14523493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:underline;
	text-underline-style:single;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl14623493
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:italic;
	text-decoration:underline;
	text-underline-style:single;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
-->
</style>
<style>

@page {
  size: A4;
  margin: 0;
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

<div id="GPE_BILL_RENEW (3)_23493" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=912 style='border-collapse:
 collapse;table-layout:fixed;width:686pt'>
 <col width=164 style='mso-width-source:userset;mso-width-alt:5997;width:123pt'>
 <col width=101 style='mso-width-source:userset;mso-width-alt:3693;width:76pt'>
 <col width=212 style='mso-width-source:userset;mso-width-alt:7753;width:159pt'>
 <col width=90 style='mso-width-source:userset;mso-width-alt:3291;width:68pt'>
 <col width=122 style='mso-width-source:userset;mso-width-alt:4461;width:92pt'>
 <col width=109 style='mso-width-source:userset;mso-width-alt:3986;width:82pt'>
 <col width=114 style='mso-width-source:userset;mso-width-alt:4169;width:86pt'>
 <tr height=57 style='mso-height-source:userset;height:42.75pt'>
  <td colspan=2 rowspan=2 height=127 width=265 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:95.25pt;width:199pt' align=left
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
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_s1027" type="#_x0000_t75"
   style='position:absolute;margin-left:5.25pt;margin-top:21pt;width:183pt;
   height:45.75pt;z-index:1;visibility:visible' o:gfxdata="">
   <v:imagedata src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image001.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:7px;margin-top:28px;width:244px;
  height:61px'><img width=244 height=61
  src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image002.png" v:shapes="Picture_x0020_1"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=2 rowspan=2 height=127 class=xl7823493 width=265
    style='border-right:.5pt solid black;border-bottom:.5pt solid black;
    height:95.25pt;width:199pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td colspan=2 class=xl6823493 width=302 style='border-right:.5pt solid black;
  border-left:none;width:227pt'>GPE EXPRESS</td>
  <td colspan=3 height=57 width=345 style='border-right:.5pt solid black;
  height:42.75pt;width:260pt' align=left valign=top><!--[if gte vml 1]><v:shape
   id="Picture_x0020_2" o:spid="_x0000_s1028" type="#_x0000_t75" style='position:absolute;
   margin-left:69.75pt;margin-top:3.75pt;width:132.75pt;height:31.5pt;
   z-index:2;visibility:visible' o:gfxdata="">
   <v:imagedata src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image003.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]>	<span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:50px;margin-top:3px;width:244px;
  height:61px'><center><svg id="barcode"></svg> </center></span>

<![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=3 height=57 class=xl7223493 width=345 style='border-right:.5pt solid black;
    height:42.75pt;border-left:none;width:260pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=70 style='mso-height-source:userset;height:52.5pt'>
  <td colspan=2 height=70 class=xl7023493 style='border-right:.5pt solid black;
  height:52.5pt;border-left:none'>Telephone: +84 1900 9475</td>
  <td colspan=3 class=xl7523493 width=345 style='border-right:.5pt solid black;
  border-left:none;width:260pt'>Air waybill :<br>
    <font class="font523493" style="font-size:20px"><?php echo $package['id_code']?></font></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td colspan=2 height=29 class=xl14523493 style='border-right:.5pt solid black;font-size:20px;
  height:21.75pt'>Website: http://GPEexp.com</td>
  <td colspan=2 class=xl8223493 style='border-right:.5pt solid black;
  border-left:none;font-size:20px'>Branch: <?php echo $package['kg_chinhanh']?><span style='mso-spacerun:yes'> </span></td>
  <td colspan=3 class=xl8423493 width=345 style='border-right:.5pt solid black;
  border-left:none;width:260pt;font-size:16px'>Service: <?php echo $dulieudichvu['dichvu']?></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td colspan=7 height=29 class=xl8623493 style='border-right:.5pt solid black;
  height:21.75pt'>Address: 09 Tran Van Du Street, Ward 13, Tan Binh District,
  Ho Chi Minh City 700000, Vietnam</td>
 </tr>
 <tr height=28 style='mso-height-source:userset;height:21.0pt'>
  <td colspan=7 height=28 class=xl10723493 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:21.0pt'>1. From (Senders) :</td>
 </tr>
 <tr height=39 style='mso-height-source:userset;height:29.25pt'>
  <td colspan=2 height=39 class=xl11123493 width=265 style='height:29.25pt;
  width:199pt'><font class="font1023493">Account Number</font><font
  class="font623493"><br>
    <span style='mso-spacerun:yes'></span><?php echo $package['cus_code']?></font></td>
  <td class=xl11323493 width=212 style='border-top:none;width:159pt'><font
  class="font1123493">Internal Reference</font><font class="font823493"><br>
    <?php echo $package['kg_ref']?></font></td>
  <td colspan=2 rowspan=2 class=xl6523493 width=212 style='width:160pt'>Total
  number of Packages</td>
  <td rowspan=2 class=xl6623493 width=109 style='border-bottom:.5pt solid black;
  border-top:none;width:82pt'>Gross Weight</td>
  <td rowspan=2 class=xl6623493 width=114 style='border-bottom:.5pt solid black;
  border-top:none;width:86pt'>Chargeable Weight</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td colspan=2 height=35 class=xl11423493 width=265 style='height:26.25pt;
  width:199pt'>Contact Name:<br>
    <font class="font623493"><?php echo $nguoigui['name']?></font></td>
  <td class=xl11623493 width=212 style='width:159pt'><font class="font1123493">Phone#<br>
    </font><font class="font823493"><?php echo $nguoigui['phone']?></font></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=3 height=36 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:27.0pt;width:358pt'>Company Name:<br>
    <font class="font623493"><?php echo $nguoigui['company_name']?></font></td>
  <td colspan=2 rowspan=3 class=xl6423493 style='font-size:20px'><?php echo $package['sokien']?></td>
  <td rowspan=3 class=xl6423493 style='border-top:none;font-size:20px'><?php echo $package['gross_weight']?></td>
  <td rowspan=3 class=xl6423493 style='border-top:none;font-size:20px'><?php echo $package['charge_weight']?></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=3 height=36 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:27.0pt;width:358pt'>Street Address:<br>
    <font class="font823493"><?php echo $nguoigui['address']?></font></td>
 </tr>
 <tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td colspan=3 height=42 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:31.5pt;width:358pt'>Ward/District:<br>
    <font class="font623493"><?php echo $ward['name']?></font><font class="font1023493">, </font><font
  class="font623493"><?php echo $district['name']?></font></td>
 </tr>
 <tr height=40 style='mso-height-source:userset;height:30.0pt'>
  <td colspan=2 height=40 class=xl11423493 width=265 style='height:30.0pt;
  width:199pt'>City/Town:<br>
    <font class="font623493"><?php echo $province['name']?></font></td>
  <td class=xl11923493 width=212 style='width:159pt'>Country/State<br>
    <font class="font823493"><?php echo $package['kg_chinhanh']?></font></td>
  <td rowspan=2 class=xl14223493 width=90 style='border-top:none;width:68pt'>Receiver's
  Signature<br>
    <br>
    <font class="font923493"><?php echo $checksign;?></font></td>
  <td rowspan=2 class=xl14323493 width=122 style='width:92pt'>Package
  Type<br>
    <font class="font923493">SPX</font></td>
  <td rowspan=2 class=xl14423493 width=109 style='border-top:none;width:82pt'><font
  class="font1223493">Payment Type</font><font class="font923493"><br>
    <?php echo congno($dulieuuser['payment_type']);?></font></td>
  <td rowspan=2 class=xl14223493 width=114 style='border-top:none;width:86pt'>Reason
  For Export<br>
    <font class="font923493"><?php echo $package['kg_reason'];?></font></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=2 height=36 class=xl12123493 width=265 style='height:27.0pt;
  width:199pt'><font class="font1023493">Country:</font><font class="font623493"><br>
    VIETNAM</font></td>
  <td class=xl12323493 width=212 style='width:159pt'>Zip/Post Code<br>
    <font class="font823493"><?php echo $zipcodevn;?></font></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl12423493 style='border-right:.5pt solid black;
  height:15.0pt'>2. To (Receiver):</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td colspan=2 height=35 class=xl12523493 width=265 style='height:26.25pt;
  width:199pt'>Contact Name:<br>
    <font class="font623493"><?php echo $nguoinhan['name'];?></font></td>
  <td class=xl11623493 width=212 style='width:159pt'><font class="font1123493">Phone#<br>
    </font><font class="font823493"><?php echo $nguoinhan['phone'];?></font></td>
  <td colspan=4 rowspan=6 class=xl8923493 width=435 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:328pt'>
  
  <table width=100% height=100% >
  <tr style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px;height:45px;background-color:#FFCC99">
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px;">Pieces</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">L (cm)</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">W (cm)</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">H (cm)</td>
  </tr>
  <?php
  $i=0;
  $check_uid_scan = 0;
  $kienhanga = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."' LIMIT 5") or die("die");
  while($kienhang = mysqli_fetch_array($kienhanga,MYSQLI_ASSOC)){
	  if($check_uid_scan == 0)
	  {
		  @$get_uid_scan = mysqli_fetch_assoc(mysqli_query($conn,"select uid,datetime from ksn_scan_nhap where id_listhoadon='".$kienhang['id_code']."'"));
		  @$uid_scan = $get_uid_scan['uid'];
		  if(@$uid_scan != "")
		  {
			  $check_uid_scan = 1;
		  }
	  }
	  
	  $i++;
	  echo' <tr style="text-align:center;font-weight:;border:1px solid black;height:40px;">
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$i.'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['length'].'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['width'].'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['height'].'</td>
  </tr>';
  }
  
  for($z=5;$z>$i;$z--)
  {
	  echo '
  <tr style="text-align:center;font-weight:;border:1px solid black;height:40px;">
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
 
  </tr>';
  }
  
  ?> 
  
  </table>
  
  
  </td>
 </tr>
 <!--
 <tr height=33 style='mso-height-source:userset;height:49.5pt'>
  <td colspan=3 height=33 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:49.5pt;width:358pt'>Company Name:<br>
   </td>
 </tr>-->
 <tr height=43 style='mso-height-source:userset;height:32.25pt'>
  <td colspan=3 height=43 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:32.25pt;width:358pt'>Company Name:<br>
    <font class="font823493"><?php echo $nguoinhan['company_name'];?></font></td>
 </tr><tr height=43 style='mso-height-source:userset;height:32.25pt'>
  <td colspan=3 height=43 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:32.25pt;width:358pt'>Street Address:<br>
    <font class="font823493"><?php echo $nguoinhan['address'];?></font></td>
 </tr>
 <tr height=30 style='mso-height-source:userset;height:22.5pt'>
  <td colspan=3 height=30 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:22.5pt;width:358pt'>Street Address:<br>
    <?php echo $nguoinhan['address2'];?></td>
 </tr>
 <tr height=54 style='mso-height-source:userset;height:40.5pt'>
  <td colspan=2 height=54 class=xl11423493 width=265 style='height:40.5pt;
  width:199pt'>City/Town:<br>
    <font class="font623493"><?php echo $citynhan['name'];?></font></td>
  <td class=xl11923493 width=212 style='width:159pt'>Country/State<br>
    <font class="font823493"><?php echo $nguoinhan['state'];?></font></td>
 </tr>
 <tr height=54 style='mso-height-source:userset;height:40.5pt'>
  <td colspan=2 height=54 class=xl12123493 width=265 style='height:40.5pt;
  width:199pt'><font class="font1023493">Country:</font><font class="font623493"><br>
    <?php echo $countries['name'].'-'.$countries['iso2'];?></font></td>
  <td class=xl12323493 width=212 style='width:159pt'>Zip/Post Code<br>
    <font class="font823493"><?php echo $nguoinhan['post_code'];?></font></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl12723493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>3. Thông tin Đơn hàng (Shipment Information)</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl13023493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>Description of goods : <?php echo $package['kg_tenhang'];?><br>
    </td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl13023493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>Value invoice: <font class="font723493"><?php echo $package['kg_valueinvoice']?> </font><font
  class="font623493">$USD<br>
    <br>
    </font></td>
 </tr>
 <tr height=45 style='mso-height-source:userset;height:33.75pt'>
  <td colspan=3 rowspan=3 height=163 class=xl9823493 width=477
  style='border-right:.5pt solid black;border-bottom:.5pt solid black;
  height:122.25pt;width:358pt'><font class="font523493">Đồng Ý Điều Khoản /
  Shippers Signature </font><font class="font1323493"><br>
    Tôi/Chúng tôi đồng ý sử dụng điều khoản của GPE trên vận đơn đường hàng
  không này áp dụng cho lô hàng này và giới hạn tổn thất hoặc thiệt hại cao
  nhất là $100,00 USD /1 lô hàng.<br>
    Tôi/Chúng tôi hiểu rằng GPE không VẬN CHUYỂN TIỀN MẶT và xác nhận rằng
  tất cả lô hàng không chứa bất kỳ chất nổ trái phép, thiết bị phá hoại nào
  hoặc vật liệu nguy hiểm theo IATA và điều khoản sử dụng dịch vụ của GPE
  Express. Tôi biết rằng sự xác nhận và chữ ký gốc, cùng với các tài liệu khác,
  sẽ được được lưu giữ trong hồ sơ cho đến khi lô hàng được giao.<br>
    <br>
    <br>
    Signature: X--------------------------------------------------------<span
  style='mso-spacerun:yes'>    </span>Date Created: <?php echo date("Y/m/d");?><span style='mso-spacerun:yes'> 
  </span></font></td>
  <td colspan=4 rowspan=3 class=xl13323493 width=435 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:328pt'>Xác Nhận Nhận Hàng Của GPE /
  Collected for GPE Express<br>
  
  <?php if($uid_scan != "")
  {
	  $get_uid_scan_info = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='$uid_scan'"));
	  echo'
    Tên Nhân Viên / Name: '.$get_uid_scan_info['ten'].'  <br>
  <br>
 <center><img src="../'.$get_uid_scan_info['img_sign'].'" width=200px height=110px><br>['.@$get_uid_scan['datetime'].']</center>
 </td>
	  ';
  }
  else
  {
	  echo'  <br>
    Tên Nhân Viên / Name:
  ----------------------------------------------------------<br>
    
    Signature / Chữ Kí :
 
 </td>';
  }
  
  ?>
 
 
 </td>
 </tr>
 <tr height=20 style='height:15.0pt'>
 </tr>
 <tr height=98 style='mso-height-source:userset;height:73.5pt'>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=164 style='width:123pt'></td>
  <td width=101 style='width:76pt'></td>
  <td width=212 style='width:159pt'></td>
  <td width=90 style='width:68pt'></td>
  <td width=122 style='width:92pt'></td>
  <td width=109 style='width:82pt'></td>
  <td width=114 style='width:86pt'></td>
 </tr>
 <![endif]>
</table>


<div class="pagebreak"> </div>


<br>

<!-- Page 2 -->



<table border=0 cellpadding=0 cellspacing=0 width=912 style='border-collapse:
 collapse;table-layout:fixed;width:686pt'>
 <col width=164 style='mso-width-source:userset;mso-width-alt:5997;width:123pt'>
 <col width=101 style='mso-width-source:userset;mso-width-alt:3693;width:76pt'>
 <col width=212 style='mso-width-source:userset;mso-width-alt:7753;width:159pt'>
 <col width=90 style='mso-width-source:userset;mso-width-alt:3291;width:68pt'>
 <col width=122 style='mso-width-source:userset;mso-width-alt:4461;width:92pt'>
 <col width=109 style='mso-width-source:userset;mso-width-alt:3986;width:82pt'>
 <col width=114 style='mso-width-source:userset;mso-width-alt:4169;width:86pt'>
 <tr height=57 style='mso-height-source:userset;height:42.75pt'>
  <td colspan=2 rowspan=2 height=127 width=265 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:95.25pt;width:199pt' align=left
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
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_s1027" type="#_x0000_t75"
   style='position:absolute;margin-left:5.25pt;margin-top:21pt;width:183pt;
   height:45.75pt;z-index:1;visibility:visible' o:gfxdata="">
   <v:imagedata src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image001.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:7px;margin-top:28px;width:244px;
  height:61px'><img width=244 height=61
  src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image002.png" v:shapes="Picture_x0020_1"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=2 rowspan=2 height=127 class=xl7823493 width=265
    style='border-right:.5pt solid black;border-bottom:.5pt solid black;
    height:95.25pt;width:199pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td colspan=2 class=xl6823493 width=302 style='border-right:.5pt solid black;
  border-left:none;width:227pt'>GPE EXPRESS</td>
  <td colspan=3 height=57 width=345 style='border-right:.5pt solid black;
  height:42.75pt;width:260pt' align=left valign=top><!--[if gte vml 1]><v:shape
   id="Picture_x0020_2" o:spid="_x0000_s1028" type="#_x0000_t75" style='position:absolute;
   margin-left:69.75pt;margin-top:3.75pt;width:132.75pt;height:31.5pt;
   z-index:2;visibility:visible' o:gfxdata="">
   <v:imagedata src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image003.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]>	<span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:50px;margin-top:3px;width:244px;
  height:61px'><center><svg id="barcode"></svg> </center></span>

<![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=3 height=57 class=xl7223493 width=345 style='border-right:.5pt solid black;
    height:42.75pt;border-left:none;width:260pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=70 style='mso-height-source:userset;height:52.5pt'>
  <td colspan=2 height=70 class=xl7023493 style='border-right:.5pt solid black;
  height:52.5pt;border-left:none'>Telephone: +84 1900 9475</td>
  <td colspan=3 class=xl7523493 width=345 style='border-right:.5pt solid black;
  border-left:none;width:260pt'>Air waybill :<br>
    <font class="font523493" style="font-size:20px"><?php echo $package['id_code']?></font></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td colspan=2 height=29 class=xl14523493 style='border-right:.5pt solid black;font-size:20px;
  height:21.75pt'>Website: http://GPEexp.com</td>
  <td colspan=2 class=xl8223493 style='border-right:.5pt solid black;
  border-left:none;font-size:20px'>Branch: <?php echo $package['kg_chinhanh']?><span style='mso-spacerun:yes'> </span></td>
  <td colspan=3 class=xl8423493 width=345 style='border-right:.5pt solid black;
  border-left:none;width:260pt;font-size:16px'>Service: <?php echo $dulieudichvu['dichvu']?></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td colspan=7 height=29 class=xl8623493 style='border-right:.5pt solid black;
  height:21.75pt'>Address: 09 Tran Van Du Street, Ward 13, Tan Binh District,
  Ho Chi Minh City 700000, Vietnam</td>
 </tr>
 <tr height=28 style='mso-height-source:userset;height:21.0pt'>
  <td colspan=7 height=28 class=xl10723493 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:21.0pt'>1. From (Senders) :</td>
 </tr>
 <tr height=39 style='mso-height-source:userset;height:29.25pt'>
  <td colspan=2 height=39 class=xl11123493 width=265 style='height:29.25pt;
  width:199pt'><font class="font1023493">Account Number</font><font
  class="font623493"><br>
    <span style='mso-spacerun:yes'></span><?php echo $package['cus_code']?></font></td>
  <td class=xl11323493 width=212 style='border-top:none;width:159pt'><font
  class="font1123493">Internal Reference</font><font class="font823493"><br>
    <?php echo $package['kg_ref']?></font></td>
  <td colspan=2 rowspan=2 class=xl6523493 width=212 style='width:160pt'>Total
  number of Packages</td>
  <td rowspan=2 class=xl6623493 width=109 style='border-bottom:.5pt solid black;
  border-top:none;width:82pt'>Gross Weight</td>
  <td rowspan=2 class=xl6623493 width=114 style='border-bottom:.5pt solid black;
  border-top:none;width:86pt'>Chargeable Weight</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td colspan=2 height=35 class=xl11423493 width=265 style='height:26.25pt;
  width:199pt'>Contact Name:<br>
    <font class="font623493"><?php echo $nguoigui['name']?></font></td>
  <td class=xl11623493 width=212 style='width:159pt'><font class="font1123493">Phone#<br>
    </font><font class="font823493"><?php echo $nguoigui['phone']?></font></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=3 height=36 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:27.0pt;width:358pt'>Company Name:<br>
    <font class="font623493"><?php echo $nguoigui['company_name']?></font></td>
  <td colspan=2 rowspan=3 class=xl6423493 style='font-size:20px'><?php echo $package['sokien']?></td>
  <td rowspan=3 class=xl6423493 style='border-top:none;font-size:20px'><?php echo $package['gross_weight']?></td>
  <td rowspan=3 class=xl6423493 style='border-top:none;font-size:20px'><?php echo $package['charge_weight']?></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=3 height=36 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:27.0pt;width:358pt'>Street Address:<br>
    <font class="font823493"><?php echo $nguoigui['address']?></font></td>
 </tr>
 <tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td colspan=3 height=42 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:31.5pt;width:358pt'>Ward/District:<br>
    <font class="font623493"><?php echo $ward['name']?></font><font class="font1023493">, </font><font
  class="font623493"><?php echo $district['name']?></font></td>
 </tr>
 <tr height=40 style='mso-height-source:userset;height:30.0pt'>
  <td colspan=2 height=40 class=xl11423493 width=265 style='height:30.0pt;
  width:199pt'>City/Town:<br>
    <font class="font623493"><?php echo $province['name']?></font></td>
  <td class=xl11923493 width=212 style='width:159pt'>Country/State<br>
    <font class="font823493"><?php echo $package['kg_chinhanh']?></font></td>
  <td rowspan=2 class=xl14223493 width=90 style='border-top:none;width:68pt'>Receiver's
  Signature<br>
    <br>
    <font class="font923493"><?php echo $checksign;?></font></td>
  <td rowspan=2 class=xl14323493 width=122 style='width:92pt'>Package
  Type<br>
    <font class="font923493">SPX</font></td>
  <td rowspan=2 class=xl14423493 width=109 style='border-top:none;width:82pt'><font
  class="font1223493">Payment Type</font><font class="font923493"><br>
    <?php echo congno($dulieuuser['payment_type']);?></font></td>
  <td rowspan=2 class=xl14223493 width=114 style='border-top:none;width:86pt'>Reason
  For Export<br>
    <font class="font923493"><?php echo $package['kg_reason'];?></font></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=2 height=36 class=xl12123493 width=265 style='height:27.0pt;
  width:199pt'><font class="font1023493">Country:</font><font class="font623493"><br>
    VIETNAM</font></td>
  <td class=xl12323493 width=212 style='width:159pt'>Zip/Post Code<br>
    <font class="font823493"><?php echo $zipcodevn;?></font></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl12423493 style='border-right:.5pt solid black;
  height:15.0pt'>2. To (Receiver):</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td colspan=2 height=35 class=xl12523493 width=265 style='height:26.25pt;
  width:199pt'>Contact Name:<br>
    <font class="font623493"><?php echo $nguoinhan['name'];?></font></td>
  <td class=xl11623493 width=212 style='width:159pt'><font class="font1123493">Phone#<br>
    </font><font class="font823493"><?php echo $nguoinhan['phone'];?></font></td>
  <td colspan=4 rowspan=6 class=xl8923493 width=435 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:328pt'>
  
  <table width=100% height=100% >
  <tr style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px;height:45px;background-color:#FFCC99">
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px;">Pieces</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">L (cm)</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">W (cm)</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">H (cm)</td>
  </tr>
  <?php
  $i=0;
  $check_uid_scan = 0;
  $kienhanga = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."' LIMIT 5") or die("die");
  while($kienhang = mysqli_fetch_array($kienhanga,MYSQLI_ASSOC)){
	  if($check_uid_scan == 0)
	  {
		  @$get_uid_scan = mysqli_fetch_assoc(mysqli_query($conn,"select uid,datetime from ksn_scan_nhap where id_listhoadon='".$kienhang['id_code']."'"));
		  @$uid_scan = $get_uid_scan['uid'];
		  if(@$uid_scan != "")
		  {
			  $check_uid_scan = 1;
		  }
	  }
	  
	  $i++;
	  echo' <tr style="text-align:center;font-weight:;border:1px solid black;height:40px;">
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$i.'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['length'].'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['width'].'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['height'].'</td>
  </tr>';
  }
  
  for($z=5;$z>$i;$z--)
  {
	  echo '
  <tr style="text-align:center;font-weight:;border:1px solid black;height:40px;">
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
 
  </tr>';
  }
  
  ?> 
  
  </table>
  
  
  </td>
 </tr>
 <!--
 <tr height=33 style='mso-height-source:userset;height:49.5pt'>
  <td colspan=3 height=33 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:49.5pt;width:358pt'>Company Name:<br>
   </td>
 </tr>-->
 <tr height=43 style='mso-height-source:userset;height:32.25pt'>
  <td colspan=3 height=43 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:32.25pt;width:358pt'>Company Name:<br>
    <font class="font823493"><?php echo $nguoinhan['company_name'];?></font></td>
 </tr><tr height=43 style='mso-height-source:userset;height:32.25pt'>
  <td colspan=3 height=43 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:32.25pt;width:358pt'>Street Address:<br>
    <font class="font823493"><?php echo $nguoinhan['address'];?></font></td>
 </tr>
 <tr height=30 style='mso-height-source:userset;height:22.5pt'>
  <td colspan=3 height=30 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:22.5pt;width:358pt'>Street Address:<br>
    <?php echo $nguoinhan['address2'];?></td>
 </tr>
 <tr height=54 style='mso-height-source:userset;height:40.5pt'>
  <td colspan=2 height=54 class=xl11423493 width=265 style='height:40.5pt;
  width:199pt'>City/Town:<br>
    <font class="font623493"><?php echo $citynhan['name'];?></font></td>
  <td class=xl11923493 width=212 style='width:159pt'>Country/State<br>
    <font class="font823493"><?php echo $nguoinhan['state'];?></font></td>
 </tr>
 <tr height=54 style='mso-height-source:userset;height:40.5pt'>
  <td colspan=2 height=54 class=xl12123493 width=265 style='height:40.5pt;
  width:199pt'><font class="font1023493">Country:</font><font class="font623493"><br>
    <?php echo $countries['name'].'-'.$countries['iso2'];?></font></td>
  <td class=xl12323493 width=212 style='width:159pt'>Zip/Post Code<br>
    <font class="font823493"><?php echo $nguoinhan['post_code'];?></font></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl12723493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>3. Thông tin Đơn hàng (Shipment Information)</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl13023493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>Description of goods : <?php echo $package['kg_tenhang'];?><br>
    </td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl13023493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>Value invoice: <font class="font723493"><?php echo $package['kg_valueinvoice']?> </font><font
  class="font623493">$USD<br>
    <br>
    </font></td>
 </tr>
 <tr height=45 style='mso-height-source:userset;height:33.75pt'>
  <td colspan=3 rowspan=3 height=163 class=xl9823493 width=477
  style='border-right:.5pt solid black;border-bottom:.5pt solid black;
  height:122.25pt;width:358pt'><font class="font523493">Đồng Ý Điều Khoản /
  Shippers Signature </font><font class="font1323493"><br>
    Tôi/Chúng tôi đồng ý sử dụng điều khoản của GPE trên vận đơn đường hàng
  không này áp dụng cho lô hàng này và giới hạn tổn thất hoặc thiệt hại cao
  nhất là $100,00 USD /1 lô hàng.<br>
    Tôi/Chúng tôi hiểu rằng GPE không VẬN CHUYỂN TIỀN MẶT và xác nhận rằng
  tất cả lô hàng không chứa bất kỳ chất nổ trái phép, thiết bị phá hoại nào
  hoặc vật liệu nguy hiểm theo IATA và điều khoản sử dụng dịch vụ của GPE
  Express. Tôi biết rằng sự xác nhận và chữ ký gốc, cùng với các tài liệu khác,
  sẽ được được lưu giữ trong hồ sơ cho đến khi lô hàng được giao.<br>
    <br>
    <br>
    Signature: X--------------------------------------------------------<span
  style='mso-spacerun:yes'>    </span>Date Created: <?php echo date("Y/m/d");?><span style='mso-spacerun:yes'> 
  </span></font></td>
  <td colspan=4 rowspan=3 class=xl13323493 width=435 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:328pt'>Xác Nhận Nhận Hàng Của GPE /
  Collected for GPE Express<br>
  
  <?php if($uid_scan != "")
  {
	  $get_uid_scan_info = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='$uid_scan'"));
	  echo'
    Tên Nhân Viên / Name: '.$get_uid_scan_info['ten'].'<br>
  <br>
 <center><img src="../'.$get_uid_scan_info['img_sign'].'" width=200px height=110px><br>['.@$get_uid_scan['datetime'].']</center>
 </td>
	  ';
  }
  else
  {
	  echo'  <br>
    Tên Nhân Viên / Name:
  ----------------------------------------------------------<br>
    
    Signature / Chữ Kí :
 
 </td>';
  }
  
  ?>
 
 
 </td>
 </tr>
 <tr height=20 style='height:15.0pt'>
 </tr>
 <tr height=98 style='mso-height-source:userset;height:73.5pt'>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=164 style='width:123pt'></td>
  <td width=101 style='width:76pt'></td>
  <td width=212 style='width:159pt'></td>
  <td width=90 style='width:68pt'></td>
  <td width=122 style='width:92pt'></td>
  <td width=109 style='width:82pt'></td>
  <td width=114 style='width:86pt'></td>
 </tr>
 <![endif]>
</table>







<div class="pagebreak"> </div>


<br>

<!-- Page 2 -->



<table border=0 cellpadding=0 cellspacing=0 width=912 style='border-collapse:
 collapse;table-layout:fixed;width:686pt'>
 <col width=164 style='mso-width-source:userset;mso-width-alt:5997;width:123pt'>
 <col width=101 style='mso-width-source:userset;mso-width-alt:3693;width:76pt'>
 <col width=212 style='mso-width-source:userset;mso-width-alt:7753;width:159pt'>
 <col width=90 style='mso-width-source:userset;mso-width-alt:3291;width:68pt'>
 <col width=122 style='mso-width-source:userset;mso-width-alt:4461;width:92pt'>
 <col width=109 style='mso-width-source:userset;mso-width-alt:3986;width:82pt'>
 <col width=114 style='mso-width-source:userset;mso-width-alt:4169;width:86pt'>
 <tr height=57 style='mso-height-source:userset;height:42.75pt'>
  <td colspan=2 rowspan=2 height=127 width=265 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:95.25pt;width:199pt' align=left
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
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_s1027" type="#_x0000_t75"
   style='position:absolute;margin-left:5.25pt;margin-top:21pt;width:183pt;
   height:45.75pt;z-index:1;visibility:visible' o:gfxdata="">
   <v:imagedata src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image001.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:7px;margin-top:28px;width:244px;
  height:61px'><img width=244 height=61
  src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image002.png" v:shapes="Picture_x0020_1"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=2 rowspan=2 height=127 class=xl7823493 width=265
    style='border-right:.5pt solid black;border-bottom:.5pt solid black;
    height:95.25pt;width:199pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td colspan=2 class=xl6823493 width=302 style='border-right:.5pt solid black;
  border-left:none;width:227pt'>GPE EXPRESS</td>
  <td colspan=3 height=57 width=345 style='border-right:.5pt solid black;
  height:42.75pt;width:260pt' align=left valign=top><!--[if gte vml 1]><v:shape
   id="Picture_x0020_2" o:spid="_x0000_s1028" type="#_x0000_t75" style='position:absolute;
   margin-left:69.75pt;margin-top:3.75pt;width:132.75pt;height:31.5pt;
   z-index:2;visibility:visible' o:gfxdata="">
   <v:imagedata src="BILLHOANCHINH_files/GPE_BILL_RENEW%20(3)_23493_image003.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]>	<span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:50px;margin-top:3px;width:244px;
  height:61px'><center><svg id="barcode"></svg> </center></span>

<![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=3 height=57 class=xl7223493 width=345 style='border-right:.5pt solid black;
    height:42.75pt;border-left:none;width:260pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=70 style='mso-height-source:userset;height:52.5pt'>
  <td colspan=2 height=70 class=xl7023493 style='border-right:.5pt solid black;
  height:52.5pt;border-left:none'>Telephone: +84 1900 9475</td>
  <td colspan=3 class=xl7523493 width=345 style='border-right:.5pt solid black;
  border-left:none;width:260pt'>Air waybill :<br>
    <font class="font523493" style="font-size:20px"><?php echo $package['id_code']?></font></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td colspan=2 height=29 class=xl14523493 style='border-right:.5pt solid black;font-size:20px;
  height:21.75pt'>Website: http://GPEexp.com</td>
  <td colspan=2 class=xl8223493 style='border-right:.5pt solid black;
  border-left:none;font-size:20px'>Branch: <?php echo $package['kg_chinhanh']?><span style='mso-spacerun:yes'> </span></td>
  <td colspan=3 class=xl8423493 width=345 style='border-right:.5pt solid black;
  border-left:none;width:260pt;font-size:16px'>Service: <?php echo $dulieudichvu['dichvu']?></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td colspan=7 height=29 class=xl8623493 style='border-right:.5pt solid black;
  height:21.75pt'>Address: 09 Tran Van Du Street, Ward 13, Tan Binh District,
  Ho Chi Minh City 700000, Vietnam</td>
 </tr>
 <tr height=28 style='mso-height-source:userset;height:21.0pt'>
  <td colspan=7 height=28 class=xl10723493 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:21.0pt'>1. From (Senders) :</td>
 </tr>
 <tr height=39 style='mso-height-source:userset;height:29.25pt'>
  <td colspan=2 height=39 class=xl11123493 width=265 style='height:29.25pt;
  width:199pt'><font class="font1023493">Account Number</font><font
  class="font623493"><br>
    <span style='mso-spacerun:yes'></span><?php echo $package['cus_code']?></font></td>
  <td class=xl11323493 width=212 style='border-top:none;width:159pt'><font
  class="font1123493">Internal Reference</font><font class="font823493"><br>
    <?php echo $package['kg_ref']?></font></td>
  <td colspan=2 rowspan=2 class=xl6523493 width=212 style='width:160pt'>Total
  number of Packages</td>
  <td rowspan=2 class=xl6623493 width=109 style='border-bottom:.5pt solid black;
  border-top:none;width:82pt'>Gross Weight</td>
  <td rowspan=2 class=xl6623493 width=114 style='border-bottom:.5pt solid black;
  border-top:none;width:86pt'>Chargeable Weight</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td colspan=2 height=35 class=xl11423493 width=265 style='height:26.25pt;
  width:199pt'>Contact Name:<br>
    <font class="font623493"><?php echo $nguoigui['name']?></font></td>
  <td class=xl11623493 width=212 style='width:159pt'><font class="font1123493">Phone#<br>
    </font><font class="font823493"><?php echo $nguoigui['phone']?></font></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=3 height=36 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:27.0pt;width:358pt'>Company Name:<br>
    <font class="font623493"><?php echo $nguoigui['company_name']?></font></td>
  <td colspan=2 rowspan=3 class=xl6423493 style='font-size:20px'><?php echo $package['sokien']?></td>
  <td rowspan=3 class=xl6423493 style='border-top:none;font-size:20px'><?php echo $package['gross_weight']?></td>
  <td rowspan=3 class=xl6423493 style='border-top:none;font-size:20px'><?php echo $package['charge_weight']?></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=3 height=36 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:27.0pt;width:358pt'>Street Address:<br>
    <font class="font823493"><?php echo $nguoigui['address']?></font></td>
 </tr>
 <tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td colspan=3 height=42 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:31.5pt;width:358pt'>Ward/District:<br>
    <font class="font623493"><?php echo $ward['name']?></font><font class="font1023493">, </font><font
  class="font623493"><?php echo $district['name']?></font></td>
 </tr>
 <tr height=40 style='mso-height-source:userset;height:30.0pt'>
  <td colspan=2 height=40 class=xl11423493 width=265 style='height:30.0pt;
  width:199pt'>City/Town:<br>
    <font class="font623493"><?php echo $province['name']?></font></td>
  <td class=xl11923493 width=212 style='width:159pt'>Country/State<br>
    <font class="font823493"><?php echo $package['kg_chinhanh']?></font></td>
  <td rowspan=2 class=xl14223493 width=90 style='border-top:none;width:68pt'>Receiver's
  Signature<br>
    <br>
    <font class="font923493"><?php echo $checksign;?></font></td>
  <td rowspan=2 class=xl14323493 width=122 style='width:92pt'>Package
  Type<br>
    <font class="font923493">SPX</font></td>
  <td rowspan=2 class=xl14423493 width=109 style='border-top:none;width:82pt'><font
  class="font1223493">Payment Type</font><font class="font923493"><br>
    <?php echo congno($dulieuuser['payment_type']);?></font></td>
  <td rowspan=2 class=xl14223493 width=114 style='border-top:none;width:86pt'>Reason
  For Export<br>
    <font class="font923493"><?php echo $package['kg_reason'];?></font></td>
 </tr>
 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td colspan=2 height=36 class=xl12123493 width=265 style='height:27.0pt;
  width:199pt'><font class="font1023493">Country:</font><font class="font623493"><br>
    VIETNAM</font></td>
  <td class=xl12323493 width=212 style='width:159pt'>Zip/Post Code<br>
    <font class="font823493"><?php echo $zipcodevn;?></font></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl12423493 style='border-right:.5pt solid black;
  height:15.0pt'>2. To (Receiver):</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td colspan=2 height=35 class=xl12523493 width=265 style='height:26.25pt;
  width:199pt'>Contact Name:<br>
    <font class="font623493"><?php echo $nguoinhan['name'];?></font></td>
  <td class=xl11623493 width=212 style='width:159pt'><font class="font1123493">Phone#<br>
    </font><font class="font823493"><?php echo $nguoinhan['phone'];?></font></td>
  <td colspan=4 rowspan=6 class=xl8923493 width=435 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:328pt'>
  
  <table width=100% height=100% >
  <tr style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px;height:45px;background-color:#FFCC99">
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px;">Pieces</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">L (cm)</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">W (cm)</td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px">H (cm)</td>
  </tr>
  <?php
  $i=0;
  $check_uid_scan = 0;
  $kienhanga = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."' LIMIT 5") or die("die");
  while($kienhang = mysqli_fetch_array($kienhanga,MYSQLI_ASSOC)){
	  if($check_uid_scan == 0)
	  {
		  @$get_uid_scan = mysqli_fetch_assoc(mysqli_query($conn,"select uid,datetime from ksn_scan_nhap where id_listhoadon='".$kienhang['id_code']."'"));
		  @$uid_scan = $get_uid_scan['uid'];
		  if(@$uid_scan != "")
		  {
			  $check_uid_scan = 1;
		  }
	  }
	  
	  $i++;
	  echo' <tr style="text-align:center;font-weight:;border:1px solid black;height:40px;">
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$i.'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['length'].'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['width'].'</td>
  <td style="text-align:center;border:1px solid black;font-size:20px">'.$kienhang['height'].'</td>
  </tr>';
  }
  
  for($z=5;$z>$i;$z--)
  {
	  echo '
  <tr style="text-align:center;font-weight:;border:1px solid black;height:40px;">
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
  <td style="text-align:center;font-weight:bold;border:1px solid black;font-size:20px"></td>
 
  </tr>';
  }
  
  ?> 
  
  </table>
  
  
  </td>
 </tr>
 <!--
 <tr height=33 style='mso-height-source:userset;height:49.5pt'>
  <td colspan=3 height=33 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:49.5pt;width:358pt'>Company Name:<br>
   </td>
 </tr>-->
 <tr height=43 style='mso-height-source:userset;height:32.25pt'>
  <td colspan=3 height=43 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:32.25pt;width:358pt'>Company Name:<br>
    <font class="font823493"><?php echo $nguoinhan['company_name'];?></font></td>
 </tr><tr height=43 style='mso-height-source:userset;height:32.25pt'>
  <td colspan=3 height=43 class=xl11823493 width=477 style='border-right:.5pt solid black;
  height:32.25pt;width:358pt'>Street Address:<br>
    <font class="font823493"><?php echo $nguoinhan['address'];?></font></td>
 </tr>
 <tr height=30 style='mso-height-source:userset;height:22.5pt'>
  <td colspan=3 height=30 class=xl11423493 width=477 style='border-right:.5pt solid black;
  height:22.5pt;width:358pt'>Street Address:<br>
    <?php echo $nguoinhan['address2'];?></td>
 </tr>
 <tr height=54 style='mso-height-source:userset;height:40.5pt'>
  <td colspan=2 height=54 class=xl11423493 width=265 style='height:40.5pt;
  width:199pt'>City/Town:<br>
    <font class="font623493"><?php echo $citynhan['name'];?></font></td>
  <td class=xl11923493 width=212 style='width:159pt'>Country/State<br>
    <font class="font823493"><?php echo $nguoinhan['state'];?></font></td>
 </tr>
 <tr height=54 style='mso-height-source:userset;height:40.5pt'>
  <td colspan=2 height=54 class=xl12123493 width=265 style='height:40.5pt;
  width:199pt'><font class="font1023493">Country:</font><font class="font623493"><br>
    <?php echo $countries['name'].'-'.$countries['iso2'];?></font></td>
  <td class=xl12323493 width=212 style='width:159pt'>Zip/Post Code<br>
    <font class="font823493"><?php echo $nguoinhan['post_code'];?></font></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl12723493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>3. Thông tin Đơn hàng (Shipment Information)</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl13023493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>Description of goods : <?php echo $package['kg_tenhang'];?><br>
    </td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=7 height=20 class=xl13023493 width=912 style='border-right:.5pt solid black;
  height:15.0pt;width:686pt'>Value invoice: <font class="font723493"><?php echo $package['kg_valueinvoice']?> </font><font
  class="font623493">$USD<br>
    <br>
    </font></td>
 </tr>
 <tr height=45 style='mso-height-source:userset;height:33.75pt'>
  <td colspan=3 rowspan=3 height=163 class=xl9823493 width=477
  style='border-right:.5pt solid black;border-bottom:.5pt solid black;
  height:122.25pt;width:358pt'><font class="font523493">Đồng Ý Điều Khoản /
  Shippers Signature </font><font class="font1323493"><br>
    Tôi/Chúng tôi đồng ý sử dụng điều khoản của GPE trên vận đơn đường hàng
  không này áp dụng cho lô hàng này và giới hạn tổn thất hoặc thiệt hại cao
  nhất là $100,00 USD /1 lô hàng.<br>
    Tôi/Chúng tôi hiểu rằng GPE không VẬN CHUYỂN TIỀN MẶT và xác nhận rằng
  tất cả lô hàng không chứa bất kỳ chất nổ trái phép, thiết bị phá hoại nào
  hoặc vật liệu nguy hiểm theo IATA và điều khoản sử dụng dịch vụ của GPE
  Express. Tôi biết rằng sự xác nhận và chữ ký gốc, cùng với các tài liệu khác,
  sẽ được được lưu giữ trong hồ sơ cho đến khi lô hàng được giao.<br>
    <br>
    <br>
    Signature: X--------------------------------------------------------<span
  style='mso-spacerun:yes'>    </span>Date Created: <?php echo date("Y/m/d");?><span style='mso-spacerun:yes'> 
  </span></font></td>
  <td colspan=4 rowspan=3 class=xl13323493 width=435 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:328pt'>Xác Nhận Nhận Hàng Của GPE /
  Collected for GPE Express<br>
  
  <?php if($uid_scan != "")
  {
	  $get_uid_scan_info = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_user where id='$uid_scan'"));
	  echo'
    Tên Nhân Viên / Name: '.$get_uid_scan_info['ten'].'<br>
  <br>
 <center><img src="../'.$get_uid_scan_info['img_sign'].'" width=200px height=110px><br>['.@$get_uid_scan['datetime'].']</center>
 </td>
	  ';
  }
  else
  {
	  echo'  <br>
    Tên Nhân Viên / Name:
  ----------------------------------------------------------<br>
    
    Signature / Chữ Kí :
 
 </td>';
  }
  
  ?>
 
 
 </td>
 </tr>
 <tr height=20 style='height:15.0pt'>
 </tr>
 <tr height=98 style='mso-height-source:userset;height:73.5pt'>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl1523493 style='height:15.0pt'></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
  <td class=xl1523493></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=164 style='width:123pt'></td>
  <td width=101 style='width:76pt'></td>
  <td width=212 style='width:159pt'></td>
  <td width=90 style='width:68pt'></td>
  <td width=122 style='width:92pt'></td>
  <td width=109 style='width:82pt'></td>
  <td width=114 style='width:86pt'></td>
 </tr>
 <![endif]>
</table>




<div class="pagebreak"> </div>





<div class=WordSection1>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:20.0pt;font-family:"Arial",sans-serif'><span
style='mso-spacerun:yes'>   </span>CÔNG VĂN CAM KẾT NỘI DUNG HÀNG XUẤT<o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><i><span
style='font-size:20.0pt;mso-bidi-font-family:"VNI-Times\,BoldItalic"'>LETTER OF
GUARANTEE</span></i></b><b style='mso-bidi-font-weight:normal'><span
style='font-size:20.0pt;font-family:"Arial",sans-serif'><o:p></o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:13.0pt;font-family:"Arial",sans-serif'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:13.0pt;font-family:"Arial",sans-serif'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='line-height:120%;tab-stops:70.9pt'><span
class=SpellE><b style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:
normal'><u><span style='font-size:11.0pt;line-height:120%;font-family:"Arial",sans-serif'>Kính</span></u></i></b></span><b
style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:normal'><u><span
style='font-size:11.0pt;line-height:120%;font-family:"Arial",sans-serif'> <span
class=SpellE>gửi</span></span></u></i></b><b style='mso-bidi-font-weight:normal'><i
style='mso-bidi-font-style:normal'><span style='font-size:11.0pt;line-height:
120%;font-family:"Arial",sans-serif'>:</span></i></b><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;line-height:120%;font-family:"Arial",sans-serif'><span
style='mso-tab-count:1'>       </span>- CHI CỤC HẢI QUAN CHUYỂN PHÁT NHANH <i
style='mso-bidi-font-style:normal'>(Express Customs Offices)</i><o:p></o:p></span></b></p>

<p class=MsoNormal style='line-height:120%;tab-stops:70.9pt'><b
style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:normal'><u><span
style='font-size:11.0pt;line-height:120%;font-family:"Arial",sans-serif'>Dear:</span></u></i></b><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;line-height:
120%;font-family:"Arial",sans-serif'><span style='mso-tab-count:1'>              </span>-
ĐỘI SOI CHIẾU AN NINH HÀNG KHÔNG (<i style='mso-bidi-font-style:normal'>Airline
Security Screening) </i><o:p></o:p></span></b></p>

<p class=MsoNormal style='line-height:120%;tab-stops:70.9pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;line-height:
120%;font-family:"Arial",sans-serif'><span style='mso-tab-count:1'>                       </span>-
CÔNG TY SCSC, TCS &amp; TECS <i style='mso-bidi-font-style:normal'>(SCSC, TCS
&amp; TECS)</i><o:p></o:p></span></b></p>

<p class=MsoNormal style='line-height:120%;tab-stops:70.9pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;line-height:
120%;font-family:"Arial",sans-serif'><span style='mso-tab-count:1'>                       </span>-
CÔNG TY TNHH GIAO NHẬN VẬN CHUYỂN GPE / GPE LOGISTICS<o:p></o:p></span></b></p>

<p class=MsoNormal style='line-height:120%'><span style='font-family:"Arial",sans-serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify;line-height:150%;tab-stops:127.9pt'><span
class=SpellE><span style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'>Chúng</span></span><span
style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'> <span
class=SpellE>tôi</span>/<i style='mso-bidi-font-style:normal'> We are:</i></span>
<span style='mso-tab-count:1'> <?php echo $dulieuuser['congty'];?></span></p>

<p class=MsoNormal style='text-align:justify;line-height:150%;tab-stops:dotted 489.05pt'><span
style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'>Mã <span
class=SpellE>sô</span>́ <span class=SpellE>thuê</span>́ (<span class=SpellE>Chứng</span>
minh <span class=SpellE>nhân</span> <span class=SpellE>dân</span>)/ <i
style='mso-bidi-font-style:normal'>Tax code or ID:</i> <span class=SpellE><?php echo $dulieuuser['mst'];?></span>
</span></p>

<p class=MsoNormal style='text-align:justify;line-height:150%;tab-stops:dotted 489.05pt'><span
class=SpellE><span style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'>Địa</span></span><span
style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'> chỉ/
<i style='mso-bidi-font-style:normal'>Address:</i></span> <span class=SpellE><?php echo $nguoigui['address'].' '.$ward['name'].' '.$district['name'].' '.$province['name'];  ?></span>
</p>

<p class=MsoNormal style='text-align:justify;line-height:150%;tab-stops:dotted 489.05pt'><span
class=SpellE><span style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'>Chúng</span></span><span
style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'> <span
class=SpellE>tôi</span> có <span class=SpellE>một</span> <span class=SpellE>lô</span>
<span class=SpellE>hàng</span> <span class=SpellE>với</span> <span
class=SpellE>sô</span>́ <span class=SpellE>vận</span> <span class=SpellE>đơn</span>
/ <span class=GramE><i style='mso-bidi-font-style:normal'>We</i></span><i
style='mso-bidi-font-style:normal'> have shipment with AWB no: <span
class=SpellE><?php echo $package['id_code'];?></span> </span></p>

<p class=MsoNormal style='text-align:justify;line-height:150%;tab-stops:dotted 489.05pt'><span
class=SpellE><span style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'>Sô</span></span><span
style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'>́ <span
class=SpellE>kiện</span>: <span class=SpellE><?php echo $package['sokien'];?></span> </span></p>

<p class=MsoNormal style='text-align:justify;line-height:150%;tab-stops:dotted 489.05pt'><span
class=SpellE><span style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'>Trọng</span></span><span
style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'> <span
class=SpellE>lượng</span>: <span class=SpellE><?php echo $package['gross_weight'];?></span></span></p>

<p class=MsoNormal style='text-align:justify;line-height:150%;tab-stops:dotted 489.05pt'><span
class=SpellE><span style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'>Tên</span></span><span
style='font-size:11.0pt;line-height:150%;font-family:"Arial",sans-serif'> <span
class=SpellE>hàng</span> <span class=SpellE>va</span>̀ chi <span class=SpellE>tiết</span>
<span class=SpellE>hàng</span> <span class=SpellE>hóa</span>/ <i
style='mso-bidi-font-style:normal'>Commodity and description of goods:</i> <span
style='mso-spacerun:yes'> </span></span></p>



<p class=MsoNormal style='margin-bottom:6.0pt;text-align:justify;line-height:
120%'>


 <table class="" style="text-align:center;border:1px solid black;width:100%">
                  <thead>
                    <tr  style="border:1px solid black;">
                      <th style="width: 10px">#</th>
                      <th >Full Description of Goods</th>
                      <th  style="width:15%">Unit Type</th>
                      <th  style="width:15%">Unit</th>
                      <th  style="width:15%">Unit Price</th>
                      <th  style="width:15%">Total</th>
                    </tr>
                  </thead>
                  <tbody>
				  
				  
				   <?php
				   $laydulieuitema = mysqli_query($conn,"select * from ns_mapcatalog where id_bill='$id'");
				   $i=0;
				   while($laydulieuitem = mysqli_fetch_array($laydulieuitema,MYSQLI_ASSOC))
				   {
					   $i++;
					   echo'<tr style="background-color:#EEE9E9;border:1px solid black;">
                      <td>'.$i.'</td>
                      <td>'.$laydulieuitem['iv_tensanpham'].'</td>
                      <td>'.$laydulieuitem['iv_unit'].'</td>
                      <td>'.$laydulieuitem['soluong'].'</td>
                      <td>'.$laydulieuitem['iv_price'].'</td>
                      <td>'.$laydulieuitem['iv_price']*$laydulieuitem['soluong'].'</td>
                    </tr>';
				   }
				   ?>
                    
                 
                  </tbody>
</table>



</p>

<p class=MsoNormal style='margin-bottom:6.0pt;text-align:justify;line-height:
120%'><i style='mso-bidi-font-style:normal'><span style='font-size:11.0pt;
line-height:120%;font-family:"Arial",sans-serif'><o:p>&nbsp;</o:p></span></i></p>

<p class=MsoNormal style='margin-bottom:6.0pt;text-align:justify;line-height:
120%'><span class=SpellE><span style='font-size:11.0pt;line-height:120%;
font-family:"Arial",sans-serif'>Chúng</span></span><span style='font-size:11.0pt;
line-height:120%;font-family:"Arial",sans-serif'> <span class=SpellE>tôi</span>
<span class=SpellE>xin</span> cam <span class=SpellE>kết</span> <span
class=SpellE>lô</span> <span class=SpellE>hàng</span> <span class=SpellE>trên</span>
<span class=SpellE>của</span> <span class=SpellE>chúng</span> <span
class=SpellE>tôi</span> <span class=SpellE>gửi</span> <span class=SpellE>đi</span>
<span class=SpellE>là</span> <span class=SpellE>hàng</span> <span class=SpellE>không</span>
<span class=SpellE>độc</span> <span class=SpellE>hại</span>, <span
class=SpellE>không</span> <span class=SpellE>phải</span> <span class=SpellE>là</span>
<span class=SpellE>hàng</span> <span class=SpellE>quốc</span> <span
class=SpellE>cấm</span>, <span class=SpellE>không</span> <span class=SpellE>có</span>
<span class=SpellE>chất</span> <span class=SpellE>ăn</span> <span class=SpellE>mòn</span>,
<span class=SpellE>không</span> <span class=SpellE>phải</span> <span
class=SpellE>là</span> <span class=SpellE>hàng</span> Pin <span class=SpellE>bị</span>
<span class=SpellE>hư</span> <span class=SpellE>hại</span>, <span class=SpellE>không</span>
<span class=SpellE>có</span> <span class=SpellE>nguy</span> <span class=SpellE>cơ</span>
<span class=SpellE>gây</span> <span class=SpellE>cháy</span> <span
class=SpellE>nổ</span>, <span class=SpellE>không</span> <span class=SpellE>chứa</span>
<span class=SpellE>khí</span>, Gas <span class=SpellE>và</span> <span
class=SpellE>không</span> <span class=SpellE>có</span> <span class=SpellE>bất</span>
<span class=SpellE>kỳ</span> <span class=SpellE>thành</span> <span
class=SpellE>phần</span> <span class=SpellE>nào</span> <span class=SpellE>cấm</span>
<span class=SpellE>vận</span> <span class=SpellE>chuyển</span> <span
class=SpellE>bằng</span> <span class=SpellE>đường</span> <span class=SpellE>hàng</span>
<span class=SpellE>không.hàng</span> <span class=SpellE>hóa</span> <span
class=SpellE>cấm</span> <span class=SpellE>xuất</span> <span class=SpellE>nhập</span>
<span class=SpellE>khẩu</span> <span class=SpellE>tại</span> <span
class=SpellE>cửa</span> <span class=SpellE>khẩu</span> <span class=SpellE>đi</span>
<span class=SpellE>và</span> <span class=SpellE>đến.Tất</span> cả <span
class=SpellE>thông</span> tin <span class=SpellE>cung</span> <span
class=SpellE>cấp</span> <span class=SpellE>trên</span> <span class=SpellE>vận</span>
<span class=SpellE>đơn</span> <span class=SpellE>va</span>̀ <span class=SpellE>hóa</span>
<span class=SpellE>đơn</span> <span class=SpellE>đính</span> <span
class=SpellE>kèm</span> <span class=SpellE>hàng</span> là <span
class=SpellE>chính</span> <span class=SpellE>xác</span>. <span class=SpellE>Nếu</span>
<span class=SpellE>có</span> <span class=SpellE>bất</span> <span class=SpellE>kì</span>
<span class=SpellE>vấn</span> <span class=SpellE>đề</span> <span class=SpellE>sự</span>
<span class=SpellE>cố</span> <span class=SpellE>nào</span> <span class=SpellE>xảy</span>
<span class=SpellE>ra</span>, <span class=SpellE>Chúng</span> <span
class=SpellE>tôi</span> <span class=SpellE>xin</span> <span class=SpellE>chịu</span>
<span class=SpellE>hoàn</span> <span class=SpellE>toàn</span> <span
class=SpellE>mọi</span> <span class=SpellE>trách</span> <span class=SpellE>nhiệm</span>
<span class=SpellE>với</span> <span class=SpellE>nội</span> dung <span
class=SpellE>khai</span> <span class=SpellE>báo</span> <span class=SpellE>trên</span>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify;line-height:120%'><i
style='mso-bidi-font-style:normal'><span style='font-size:11.0pt;line-height:
120%;font-family:"Arial",sans-serif'>We commit that the above shipment non-banned
from export. It is non-dangerous goods according to IATA Regulations and poses
no risk to environment &amp; community and is not included in the non-restriction
goods in origin and destination regulated by the local authorities. We declare
all the information contained in this letter to be true and correct.</span></i>
<i style='mso-bidi-font-style:normal'><span style='font-size:11.0pt;line-height:
120%;font-family:"Arial",sans-serif'>If any problem occurs, <span class=GramE>We</span>
would like to take full responsibility before the law for the content of the
above declaration.<o:p></o:p></span></i></p>

<p class=MsoNormal style='line-height:120%'><i style='mso-bidi-font-style:normal'><span
style='font-size:11.0pt;line-height:120%;font-family:"Arial",sans-serif;
color:red'><span
style='mso-spacerun:yes'>                                                     
</span><span style='mso-spacerun:yes'>                                </span><span
style='mso-spacerun:yes'>      </span><?php echo $package['kg_chinhanh'];?> , <span class=SpellE>Ngày <?php
 $date = DateTime::createFromFormat("Y-m-d", $package['date']);;

 echo $date->format("d").' Tháng '.$date->format("m").' Năm '.$date->format("Y");
 ?></span></span></i></p>

<p class=MsoNormal align=center style='margin-left:216.0pt;text-align:center;
text-indent:36.0pt;line-height:120%'><span class=SpellE><span style='font-size:
11.0pt;line-height:120%;font-family:"Arial",sans-serif'>Ký</span></span><span
style='font-size:11.0pt;line-height:120%;font-family:"Arial",sans-serif'> <span
class=SpellE>tên</span>, <span class=SpellE>đóng</span> <span class=SpellE>dấu</span>
<o:p></o:p></span></p>

<p class=MsoNormal align=center style='margin-left:216.0pt;text-align:center;
text-indent:36.0pt;line-height:120%'><span style='font-size:11.0pt;line-height:
120%;font-family:"Arial",sans-serif'>(<span class=SpellE>Ghi</span> <span
class=SpellE>rõ</span> <span class=SpellE>họ</span> <span class=SpellE>tên</span>,
<span class=SpellE>chức</span> <span class=SpellE>vụ</span>)<o:p></o:p></span></p>

<p class=MsoNormal align=center style='margin-left:216.0pt;text-align:center;
text-indent:36.0pt;line-height:120%'><span style='font-size:11.0pt;line-height:
120%;font-family:"Arial",sans-serif'>Name/ Title &amp; Sign<o:p></o:p></span></p>

<p class=MsoNormal style='line-height:120%'><span style='font-family:"Arial",sans-serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='line-height:120%'><span style='font-family:"Arial",sans-serif'><o:p>&nbsp;</o:p></span></p>

</div>





























	<input type=hidden id="abcId" name="abcName" 
                  value="<?php echo $package['id_code']; ?>"/> 
</div>

<script>
<?php
	if($_GET['print'] == "auto")
	{
		echo'window.addEventListener("load", window.print());';
	}
	?>
</script>

<script>


JsBarcode("#barcode", document.getElementById('abcId').value, {
	
  format: "CODE128",
  lineColor: "",
  width: 2,
  height: 30,
  displayValue: false
});
</script>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
