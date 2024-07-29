<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link id=Main-File rel=Main-File href="../ns.htm">
<link rel=File-List href=filelist.xml>
<script src="../JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../qrcode.min.js"></script>
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<link rel=Stylesheet href=stylesheet.css>
<style>
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:.75in .25in .75in .25in;
	mso-header-margin:.3in;
	mso-footer-margin:.3in;}
-->
</style>

</head>

<body link="#0563C1" vlink="#954F72" onload="onReady()">
<?php
  @session_start();
  include("../../conn/db.php");
  $id = $_GET['id'];
  $uid = $_SESSION['uid'];
  $data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package WHERE id='$id'"));
  $nguoigui = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id='".$data['id_nguoigui']."'"));
  $nguoinhan = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id='".$data['id_nguoinhan']."'"));
  $tp = mysql_fetch_assoc(mysql_query("SELECT * FROM yn_province WHERE id='".$nguoigui['province_id']."'"));
  $quan = mysql_fetch_assoc(mysql_query("SELECT * FROM yn_district WHERE id='".$nguoigui['district_id']."'"));
  $phuong = mysql_fetch_assoc(mysql_query("SELECT * FROM yn_ward WHERE id='".$nguoigui['ward_id']."'"));
  $dulieuuser = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_user where id='$uid'"));

  $countries = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_countries WHERE id = '".$nguoinhan['country_id']."'"));
  $address_nguoinhan = $nguoinhan['address'].' '.$nguoinhan['city'].' '.$countries['name'];

  $address_nguoigui = $nguoigui['address'].' '.$phuong['name'].' '.$quan['name'].' '.$tp['name'];

 ?>
<table border=0 cellpadding=0 cellspacing=0 width=563 style='border-collapse:
 collapse;table-layout:fixed;width:423pt'>
 <col width=297 style='mso-width-source:userset;mso-width-alt:10861;width:223pt'>
 <col width=266 style='mso-width-source:userset;mso-width-alt:9728;width:200pt'>
 <tr height=88 style='mso-height-source:userset;height:66.0pt'>
  <td height=88 width=297 style='height:66.0pt;width:223pt' align=left
  valign=top><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:0px;margin-top:5px;width:285px;
  height:60px'><img width=285 height=60 src="../logo.jpg"
  alt=""
  v:shapes="Picture_x0020_1"></span><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=88 width=297 style='height:66.0pt;width:223pt'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl65 width=266 style='width:200pt'><?php echo $dulieuuser['congty'];?><br>
    Website: <?php echo $dulieuuser['website'];?><br>
    Tel: <?php echo $dulieuuser['phone'];?><br>
    Email : <?php echo $dulieuuser['email'];?></td>
 </tr>
 <tr height=97 style='mso-height-source:userset;height:72.75pt'>
  <td colspan=2 height=97 width=563 style='border-right:1.0pt solid black;
  height:72.75pt;width:423pt' align=left valign=top><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:11px;margin-top:9px;width:539px;
  height:78px'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td width=0 height=0></td>
    <td width=274></td>
    <td width=186></td>
    <td width=79></td>
   </tr>
   <tr>
    <td height=3></td>
    <td colspan=2></td>
    <td style="vertical-align: top;" rowspan=3 align=left valign=top>
        <div id="id_qrcode"></div>
    </td>
   </tr>
   <tr>
    <td height=62></td>
    <td align=left valign=top>
        &nbsp;&nbsp;&nbsp;&nbsp;<svg id="barcode"></svg>
    </td>
   </tr>
   <tr>
    <td height=13></td>
   </tr>
  </table>
  </span><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=2 height=97 class=xl66 width=563 style='border-right:1.0pt solid black;
    height:72.75pt;width:423pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=112 style='mso-height-source:userset;height:84.0pt'>
  <td colspan=2 height=112 class=xl69 width=563 style='border-right:1.0pt solid black;
  height:84.0pt;width:423pt'>&nbsp;&nbsp;&nbsp;&nbsp;Tracking number: <?php echo $data['id']; ?> (Parcels received : <?php echo $data['sokien']; ?>)<br>
    &nbsp;&nbsp;&nbsp;&nbsp;TO：<br>
    &nbsp;&nbsp;&nbsp;&nbsp;* <?php echo $nguoinhan['name']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;* <?php echo $nguoinhan['phone']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;* <?php echo mb_strtoupper($address_nguoinhan, 'UTF-8'); ?><br>
    </td>
 </tr>
 <tr height=85 style='mso-height-source:userset;height:63.75pt'>
  <td colspan=2 height=85 class=xl69 width=563 style='border-right:1.0pt solid black;
  height:63.75pt;width:423pt'>&nbsp;&nbsp;&nbsp;&nbsp;FROM：<br>
    &nbsp;&nbsp;&nbsp;&nbsp;* <?php echo $nguoigui['name']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;* <?php echo $nguoigui['phone']; ?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;* <?php echo mb_strtoupper($address_nguoigui, 'UTF-8'); ?><br>
    </td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=297 style='width:223pt'></td>
  <td width=266 style='width:200pt'></td>
 </tr>
 <![endif]>
</table>
<p style="font-family: Calibri;font-size:13px">Time: <span id="datetime"></span> - GIAPHU EXPRESS</p> 

<input type=hidden id="abcId" name="abcName" 
value="<?php echo $data['id']; ?>"/> 

<script>
  var dt = new Date();
  document.getElementById("datetime").innerHTML = dt.toLocaleString();

  function onReady()
  {
   var qrcode = new QRCode("id_qrcode", {
    text:"https://newskyexpress.online/view/trackingview.php?id="+document.getElementById('abcId').value,
    width:80,
    height:80,
    colorDark:"#000000",
    colorLight:"#ffffff",
    correctLevel:QRCode.CorrectLevel.H
  });
 }

 JsBarcode("#barcode", document.getElementById('abcId').value, {
  format: "CODE128",
  lineColor: "",
  width: 2.5,
  height: 40,
  displayValue: true
});


</script>

</body>

</html>
