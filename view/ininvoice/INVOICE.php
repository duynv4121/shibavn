<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">


<?php 

	@session_start();

	include("../../conn/db.php");
	include("../../controller/accountant.php");
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
	
	
    $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id='".$id."'"));

    $nguoigui = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id='".$package['id_nguoigui']."'"));
	$ward = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_ward WHERE id='".$nguoigui['ward_id']."'"));
	$province = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_province WHERE id='".$nguoigui['province_id']."'"));
	$district = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM yn_district WHERE id='".$nguoigui['district_id']."'"));
	
	
	
    $nguoinhan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id='".$package['id_nguoinhan']."'"));
    $dulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user where id='$uid'"));

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

<head><title>INVOICE GPE <?php echo$package['id_code'];?></title>

<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="Invoice_files/filelist.xml">
<style id="">







<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font516400
	{color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font616400
	{color:red;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.xl6316400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
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
.xl6416400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:24.0pt;
	font-weight:700;
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
.xl6516400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
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
.xl6616400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
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
.xl6716400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
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
.xl6816400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"\[ENG\]\[$-409\]mmmm\\ d\\\,\\ yyyy\;\@";
	text-align:left;
	vertical-align:121;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6916400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7016400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7116400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7216400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7316400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7416400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7516400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
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
.xl7616400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:yellow;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7716400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7816400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
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
.xl7916400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
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
.xl8016400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8116400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022KGS\0022";
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8216400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8316400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8416400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8516400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
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
.xl8616400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
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
.xl8716400
	{color:windowtext;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:24px;
	mso-char-indent-count:2;}
.xl8816400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8916400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9016400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9116400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9216400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
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
.xl9316400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9416400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9516400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:1.0pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9616400
	{color:windowtext;
	font-size:12.0pt;
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
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;
	padding-left:96px;
	mso-char-indent-count:8;}
.xl9716400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
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
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9816400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9916400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10016400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
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
	white-space:normal;}
.xl10116400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
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
.xl10216400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10316400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
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
.xl10416400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
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
.xl10516400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10616400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl10716400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10816400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl10916400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11016400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl11116400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl11216400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl11316400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11416400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:1.0pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11516400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:middle;
	border-top:1.0pt solid windowtext;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl11616400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:"0\.00\\ \0022USD\0022";
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:1.0pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11716400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
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
.xl11816400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
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
.xl11916400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
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
.xl12016400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
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
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12116400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
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
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12216400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12316400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
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
.xl12416400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
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
.xl12516400
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
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
	white-space:normal;}
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

<div id="KSN2904205717 Thi Thuy Mai Tran USA 24APR_16400" align=center
x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=882 class=xl6516400
 style='border-collapse:collapse;table-layout:fixed;width:664pt'>
 <col class=xl6516400 width=10 style='mso-width-source:userset;mso-width-alt:
 320;width:8pt'>
 <col class=xl6516400 width=146 style='mso-width-source:userset;mso-width-alt:
 4672;width:110pt'>
 <col class=xl6516400 width=112 style='mso-width-source:userset;mso-width-alt:
 3584;width:84pt'>
 <col class=xl6516400 width=142 style='mso-width-source:userset;mso-width-alt:
 4544;width:107pt'>
 <col class=xl6916400 width=61 style='mso-width-source:userset;mso-width-alt:
 1952;width:46pt'>
 <col class=xl6916400 width=94 style='mso-width-source:userset;mso-width-alt:
 3008;width:71pt'>
 <col class=xl6516400 width=50 style='mso-width-source:userset;mso-width-alt:
 1600;width:38pt'>
 <col class=xl7016400 width=112 style='mso-width-source:userset;mso-width-alt:
 3584;width:84pt'>
 <col class=xl7016400 width=155 style='mso-width-source:userset;mso-width-alt:
 4960;width:116pt'>
 <tr height=50 style='mso-height-source:userset;height:37.5pt'>
  <td height=50 class=xl6516400 width=10 style='height:37.5pt;width:8pt'></td>
  <td class=xl6316400 width=146 style='width:110pt'></td>
  <td class=xl6316400 width=112 style='width:84pt'></td>
  <td class=xl6416400 colspan=5 width=459 style='width:346pt'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  INVOICE</td>
  <td class=xl6316400 width=155 style='width:116pt'></td>
 </tr>
 <tr height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl6516400 style='height:18.0pt'></td>
  <td class=xl6616400></td>
  <td class=xl6616400></td>
  <td class=xl6616400></td>
  <td class=xl6616400></td>
  <td class=xl6616400></td>
  <td class=xl6616400></td>
  <td class=xl6716400>Date:</td>
  <td class=xl6816400><?php echo Date("Y/m/d");?></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6516400 style='height:12.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7116400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl7216400>SHIPPER</td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7316400>Air waybill No.</td>
  <td class=xl7416400><?php echo $package['id_code']?>	</td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Company Name</td>
  <td colspan=3 class=xl12016400 style='white-space: pre-wrap;'><?php echo $nguoigui['company_name']?></td>
  <td class=xl7516400></td>
  <td class=xl7516400></td>
  <td class=xl7316400>Service</td>
  <td class=xl7616400><?php echo $dulieudichvu['dichvu']?></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Address</td>
  <td class=xl7716400 colspan=2><?php echo $nguoigui['address']?></td>
  <td class=xl7716400 style='border-top:none'>&nbsp;</td>
  <td class=xl7816400></td>
  <td class=xl7816400></td>
  <td class=xl7316400></td>
  <td class=xl7116400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Town/ Area Code</td>
  <td colspan=3 class=xl12116400><?php echo $ward['name']?> <?php echo $district['name']?> <?php echo $province['name']?></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7316400>No. of pkgs<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8016400><?php echo $package['sokien']?></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>State/ Country</td>
  <td colspan=3 class=xl12016400>Viet Nam</td>
  <td class=xl7516400></td>
  <td class=xl7516400></td>
  <td class=xl7316400></td>
  <td class=xl7116400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Contact Name</td>
  <td colspan=3 class=xl12216400><?php echo $nguoigui['name']?></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7316400>Weight<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8116400><?php echo $package['charge_weight']?></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Phone/Fax No.<span style='mso-spacerun:yes'> </span></td>
  <td colspan=3 class=xl12316400><?php echo $nguoigui['phone']?></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7316400></td>
  <td class=xl8216400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7316400>Dimensions<span style='mso-spacerun:yes'> </span></td>
  <?php  
  //Lay dim
  @$dim1 = '';
  @$dim2 = '';
  @$dim3 = '';
  $i = 0;
  $laydulieudima = mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id_package = '".$package['id']."' LIMIT 3");
  while($laydulieudim = mysqli_fetch_array($laydulieudima,MYSQLI_ASSOC))
  {
	  $i++;
	  if($i == 1)
	  {
	  $dim1 = $laydulieudim['length'].' x '.$laydulieudim['width'].' x '.$laydulieudim['height'];
	  }if($i == 2)
	  {
	  $dim2 = $laydulieudim['length'].' x '.$laydulieudim['width'].' x '.$laydulieudim['height'];
	  }if($i == 3)
	  {
	  $dim3 = $laydulieudim['length'].' x '.$laydulieudim['width'].' x '.$laydulieudim['height'];
	  }
	  
  }
  
  ?>
  <td class=xl8316400><?php echo $dim1;?></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl7216400>CONSIGNEE</td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7316400></td>
  <td class=xl8416400 style='border-top:none'><?php echo $dim2;?></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Company Name</td>
  <td colspan=6 class=xl6716400><?php echo $nguoinhan['name'];?><span
  style='mso-spacerun:yes'> </span></td>
  <td class=xl8416400 style='border-top:none'><?php echo $dim3;?></td>
 </tr>
 <tr height=52 style='mso-height-source:userset;height:39.0pt'>
  <td height=52 class=xl6516400 style='height:39.0pt'></td>
  <td class=xl6516400>Address</td>
  <td colspan=3 class=xl12516400 width=315 style='width:237pt'><br><?php echo @$nguoinhan['address'];?> <?php echo @$citynhan['name'];?><br> <?php echo @$nguoinhan['state'];?></td>
  <td class=xl7816400></td>
  <td class=xl7816400></td>
  <td class=xl7816400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Postal code</td>
  <td colspan=3 class=xl12416400><?php echo @$nguoinhan['post_code'];?></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7116400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>State/ Country<span style='mso-spacerun:yes'> </span></td>
  <td colspan=3 class=xl12416400> <?php echo $countries['name'];?></td>
  <td class=xl7516400></td>
  <td class=xl7516400></td>
  <td class=xl7116400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Contact Name</td>
  <td colspan=3 class=xl12416400><?php echo $nguoinhan['name'];?></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7116400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400>Phone/Fax No.<span style='mso-spacerun:yes'> </span></td>
  <td colspan=3 class=xl12416400><?php echo $nguoinhan['phone'];?></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7116400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.95pt'>
  <td height=21 class=xl6516400 style='height:15.95pt'></td>
  <td class=xl6516400></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7916400></td>
  <td class=xl7116400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=12 style='mso-height-source:userset;height:9.0pt'>
  <td height=12 class=xl6516400 style='height:9.0pt'></td>
  <td class=xl6516400></td>
  <td class=xl6316400></td>
  <td class=xl6316400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6516400 style='height:15.0pt'></td>
  <td colspan=3 rowspan=2 class=xl10016400 width=400 style='border-right:1.0pt solid black;
  width:301pt'>Full Description of<span style='mso-spacerun:yes'> 
  </span>Goods<br>
    (Name of goods, composition of material, marks, etc)</td>
  <td rowspan=2 class=xl10616400 width=61 style='width:46pt'>No.of Items</td>
  <td rowspan=2 class=xl11116400 width=94 style='width:71pt'>Origin</td>
  <td rowspan=2 class=xl11316400>Unit</td>
  <td rowspan=2 class=xl11516400 width=112 style='width:84pt'>Unit Price<br>
    (in <?php echo  donvitiente($package['kg_dichvu']);?>)</td>
  <td rowspan=2 class=xl9816400 width=155 style='width:116pt'>Subtotal<br>
    (in <?php echo donvitiente($package['kg_dichvu']);?>)</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
 </tr>
 
 <?php
  $laydulieuitema = mysqli_query($conn,"select * from ns_mapcatalog2 where id_bill='$id'");
				   $i=0;
				   $total = 0;
				   while($laydulieuitem = mysqli_fetch_array($laydulieuitema,MYSQLI_ASSOC))
				   {
 echo"
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl10916400 style='white-space: pre-wrap;'>".$laydulieuitem['iv_tensanpham']."</td>
  <td class=xl8916400 style='border-left:none'>".$laydulieuitem['soluong']."</td>
  <td class=xl9016400 width=94 style='border-left:none;width:71pt'>VIETNAM<span
  style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-left:none'>".$laydulieuitem['iv_unit']."</td>
  <td class=xl9116400 style='border-left:none'>".$laydulieuitem['iv_price']." ".donvitiente($package['kg_dichvu'])."</td>
  <td class=xl9116400 style='border-left:none'>".$laydulieuitem['iv_price']*$laydulieuitem['soluong']." ".donvitiente($package['kg_dichvu'])."</td>
 </tr>";
 
 $total += $laydulieuitem['iv_price']*$laydulieuitem['soluong'];
				   }
?> 
 
 
<!-- <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl10916400>Cọ nail<span style='mso-spacerun:yes'> 
  </span>- Nail Brush</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>11</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>pcs</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>1.80 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>19.80 USD</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl10916400>Kiềm nail - Nipper<span
  style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>8</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>pcs</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>2.20 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>17.60 USD</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl11716400 style='border-right:.5pt solid black'>Dũa móng
  - Nail file</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>10</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>pcs</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>1.20 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>12.00 USD</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl10916400>Cắt móng - nail clipper</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>5</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>pcs</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>1.00 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>5.00 USD</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl10916400>Hộp dao lam - Knife box</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>1</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>set</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>8.00 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>8.00 USD</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl10916400>Mài gót chân - heel grinder</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>5</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>pcs</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>2.50 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>12.50 USD</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl11716400 style='border-right:.5pt solid black'>Máy mài
  móng tay bằng điện - Electric nail grinder</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>1</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>box</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>15.00 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>15.00 USD</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl11716400 style='border-right:.5pt solid black'>Đèn led
  bằng điện<span style='mso-spacerun:yes'>  </span>- Electric led lights</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>2</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>box</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>18.00 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>36.00 USD</td>
 </tr>
 <tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td height=42 class=xl6516400 style='height:31.5pt'></td>
  <td colspan=3 class=xl11016400 width=400 style='width:301pt'>Cọ phủi - Brush</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>8</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>pcs</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>2.00 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>16.00 USD</td>
 </tr>
 <tr height=41 style='mso-height-source:userset;height:31.15pt'>
  <td height=41 class=xl6516400 style='height:31.15pt'></td>
  <td colspan=3 class=xl10816400 width=400 style='width:301pt'>Bàn chải - nail
  brush</td>
  <td class=xl8916400 style='border-top:none;border-left:none'>2</td>
  <td class=xl9016400 width=94 style='border-top:none;border-left:none;
  width:71pt'>VIETNAM<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8916400 style='border-top:none;border-left:none'>pcs</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>5.00 USD</td>
  <td class=xl9116400 style='border-top:none;border-left:none'>10.00 USD</td>
 </tr>-->
 <tr height=35 style='mso-height-source:userset;
  height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=3 class=xl8516400 style='border-right:1.0pt solid black'></td>
  <td colspan=4 class=xl9316400 style='border-right:1.0pt solid black;
  border-left:none'>Total Value (in <?php echo donvitiente($package['kg_dichvu']);?>)</td>
  <td class=xl8816400 style='border-left:none'><?php echo $total.' '.donvitiente($package['kg_dichvu']);?> </td>
 </tr>
 
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td class=xl6516400>Reason for Export<span style='mso-spacerun:yes'> </span></td>
  <td colspan=7 class=xl9616400><?php echo $package['kg_reason']?></td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td colspan=8 class=xl8616400>I declare that the information is true and
  correct to the best of my knowledge</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td class=xl6516400 colspan=3>and that the goods are of<span
  style='mso-spacerun:yes'>  </span><font class="font616400">Viet Nam</font><font
  class="font516400"> origin.</font></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td class=xl6516400>I (name)<span style='mso-spacerun:yes'> </span></td>
  <td colspan=3 class=xl9716400><?php echo $nguoigui['name']?></td>
  <td class=xl8516400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td class=xl8616400 colspan=5>quantity of goods specified in this document
  are goods which are submitted for<span style='mso-spacerun:yes'> </span></td>
  <td class=xl8616400></td>
  <td class=xl8616400></td>
  <td class=xl8616400></td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td class=xl8616400 colspan=3>clearance for export out of <font
  class="font616400">VIET NAM</font><font class="font516400">.</font></td>
  <td class=xl8616400></td>
  <td class=xl8616400></td>
  <td class=xl8616400></td>
  <td class=xl8616400></td>
  <td class=xl8616400></td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td colspan=3 class=xl8516400></td>
 </tr>
 <tr height=37 style='mso-height-source:userset;height:27.75pt'>
  <td height=37 class=xl6516400 style='height:27.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl8716400 colspan=2>Signature/Title/Stamp</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6516400 style='height:26.25pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=29 style='mso-height-source:userset;height:21.75pt'>
  <td height=29 class=xl6516400 style='height:21.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=9 style='mso-height-source:userset;height:6.75pt'>
  <td height=9 class=xl6516400 style='height:6.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td colspan=3 class=xl6616400></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl6516400 style='height:15.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl6516400 style='height:12.75pt'></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=0 style='display:none'>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=0 style='display:none;mso-height-source:userset;mso-height-alt:
  270'>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=0 style='display:none'>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <tr height=0 style='display:none;mso-height-source:userset;mso-height-alt:
  300'>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6516400></td>
  <td class=xl6916400></td>
  <td class=xl6916400></td>
  <td class=xl6516400></td>
  <td class=xl7016400></td>
  <td class=xl7016400></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=10 style='width:8pt'></td>
  <td width=146 style='width:110pt'></td>
  <td width=112 style='width:84pt'></td>
  <td width=142 style='width:107pt'></td>
  <td width=61 style='width:46pt'></td>
  <td width=94 style='width:71pt'></td>
  <td width=50 style='width:38pt'></td>
  <td width=112 style='width:84pt'></td>
  <td width=155 style='width:116pt'></td>
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
		echo'window.addEventListener("load", window.print());';
	}
	?>
</script>
</html>
