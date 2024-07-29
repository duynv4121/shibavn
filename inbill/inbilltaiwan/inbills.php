<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href=filelist.xml>
<script src="JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../css/qrcode.min.js"></script>

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

 @media print {
            @page {
                margin: 0;
 }
 
  #button-container{
      display: none;
   }
 }
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:.75in .7in .75in .7in;
	mso-header-margin:.3in;
	mso-footer-margin:.3in;}
-->
</style>

</head>

<body link=blue vlink=purple onload=onReady()>
<button id="button-container" onclick="window.print()">In Tất cả Label</button>

<?php
@session_start();
include("../wtf/wtf.php");


?>


<?php 
$checkbox1 = $_POST['chkl'] ;  
if(isset($_POST['btn_inlabel']))  
{
for ($i=0; $i<sizeof ($checkbox1);$i++) { 
$idbill = $checkbox1[$i];



							$idbilladd = 'IAH'.$idbill;
						
		
$hoadonadd = mysql_fetch_assoc(mysql_query("select * from gpe_listhoadonus where id='$idbill'"));
$nguoiguiadd = mysql_fetch_assoc(mysql_query("select * from gpe_nguoiguius where id_hoadon='$idbill'"));
$nguoinhanadd = mysql_fetch_assoc(mysql_query("select * from gpe_nguoinhanus where id_hoadon='$idbill'"));

				$idthanhpho = $nguoinhanadd['n_thanhpho'];
				$laythanhpho = mysql_fetch_assoc(mysql_query("select * from province where id='$idthanhpho'"));
				$idquan = $nguoinhanadd['n_quanhuyen'];
				$laytenquan = mysql_fetch_assoc(mysql_query("select * from district where id='$idquan'"));
				$idphuong = $nguoinhanadd['n_phuong'];
				$laytenphuong = mysql_fetch_assoc(mysql_query("select * from ward where id='$idphuong'"));
				
				
				$diachinguoinhan = $nguoinhanadd['n_diachi1']. ' '.$laytenphuong['_prefix'].' '.$laytenphuong['_name']. ' '.$laytenquan['_prefix'].' '.$laytenquan['_name'] . ' '.$laythanhpho['_name'];


$id_user = $hoadonadd['id_usera'];
$dulieuuser = mysql_fetch_assoc(mysql_query("select * from gpe_user where id='$id_user'"));

$idbilladd = $dulieuuser['congtyghitat'].$idbill;


echo'<table border=0 cellpadding=0 cellspacing=0 width=474 style=\'border-collapse:
 collapse;table-layout:fixed;width:399pt;margin-left:25px\'>
 <col width=51 style=\'mso-width-source:userset;mso-width-alt:1820;width:38pt\'>
 <col width=47 style=\'mso-width-source:userset;mso-width-alt:1678;width:35pt\'>
 <col width=66 span=5 style=\'mso-width-source:userset;mso-width-alt:2332;
 width:49pt\'>
 <col width=46 style=\'mso-width-source:userset;mso-width-alt:1621;width:34pt\'>
 <tr height=19 style=\'height:14.4pt\'>
  <td height=19 width=51 style=\'height:14.4pt;width:38pt\' align=left
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
  </v:shapetype><v:shape id="Picture_x0020_2" o:spid="_x0000_s1183" type="#_x0000_t75"
   style=\'position:absolute;margin-left:9.6pt;margin-top:10.2pt;width:110.4pt;
   height:64.8pt;z-index:5;visibility:visible\' o:gfxdata="
">
   <v:imagedata src="image009.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:5;margin-top:14px;width:147px;
  height:86px\'><img width=150 height=100 src='.$dulieuuser['logo'].' v:shapes="Picture_x0020_2"></span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=19 class=xl65 width=51 style=\'height:14.4pt;width:38pt\'></td>
   </tr>
  </table>';
  echo'</span></td>
  <td class=xl65 width=47 style=\'width:35pt\'></td>
  <td class=xl65 width=66 style=\'width:49pt\'></td>
  <td class=xl65 width=66 style=\'width:49pt\'></td>
  <td class=xl65 width=66 style=\'width:49pt\'></td>
  <td class=xl65 width=66 style=\'width:49pt\'></td>
  <td class=xl65 width=66 style=\'width:49pt\'></td>
  <td class=xl65 width=46 style=\'width:34pt\'></td>
 </tr>
 <tr height=21 style=\'height:15.6pt\'>
  <td height=21 class=xl65 style=\'height:15.6pt\'></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl97 colspan=3 style=\'mso-ignore:colspan\'>'.$dulieuuser['ctyghitat'].'</td>
  <td class=xl65></td>
 </tr>

 
  <tr height=19 style=\'height:14.4pt\'>
  <td height=19 class=xl65 style=\'height:14.4pt\'></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65 colspan=4 style=\'mso-ignore:colspan\'>Website:
  '.$dulieuuser['website'].'</td>
 </tr>
 <tr height=19 style=\'height:14.4pt\'>
  <td height=19 class=xl65 style=\'height:14.4pt\'></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65 colspan=3 style=\'mso-ignore:colspan\'>Tel: '.$dulieuuser['sdt'].'</td>
  <td class=xl65></td>
 </tr>
 <tr height=19 style=\'height:14.4pt\'>
  <td height=19 class=xl65 style=\'height:14.4pt\'></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65 colspan=3 style=\'mso-ignore:colspan\'>Email: '.$dulieuuser['mst'].' </td>

  <td class=xl65></td>
 </tr>
 <tr height=19 style=\'height:14.4pt\'>
  <td height=19 class=xl65 style=\'height:14.4pt\'></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
 </tr>
 <tr height=90 style=\'mso-height-source:userset;height:67.5pt\'>
  <td colspan=8 height=90 width=474 style=\'border-right:.5pt solid black;
  height:67.5pt;width:399pt\' align=left valign=top><!--[if gte vml 1]><v:shape
   id="TextBox_x0020_9" o:spid="_x0000_s1180" type="#_x0000_t75" style=\'position:absolute;
   margin-left:294pt;margin-top:1.8pt;width:42.6pt;height:33pt;z-index:2;
   visibility:visible\' o:gfxdata="
">
   <v:imagedata src="image002.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><v:shape id="Picture_x0020_1" o:spid="_x0000_s1181" type="#_x0000_t75"
   style=\'position:absolute;margin-left:6.6pt;margin-top:3pt;width:163.2pt;
   height:58.8pt;z-index:3;visibility:visible\' o:gfxdata="
">
   <v:imagedata src="image003.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:9px;margin-top:3px;width:440px;
  height:79px\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td width=0 height=0></td>
    <td width=218></td>
    <td width=165></td>
    <td width=57></td>
   </tr>
   <tr>
    <td height=1></td>
    <td colspan=2></td>
    <td rowspan=2 align=r valign=top>
	<font size=5><b>';

	$nguoinhanaddquocgia = strtolower($nguoinhanadd['n_quocgia']);
	if($nguoinhanaddquocgia == "usa")
	{
		echo'USA';
	}else if($nguoinhanaddquocgia == "singapore")
	{
		echo'SG';
	}else if($nguoinhanaddquocgia == "autralia")
	{
		echo'AU';
	}else if($nguoinhanaddquocgia == "canada")
	{
		echo'CA';
	}
	echo'
	<b></font>
   </tr>
   <tr>
    <td height=43></td>
    <td rowspan=2 align=left valign=top>
	<!--<img width=218 height=78 src=image006.gif v:shapes="Picture_x0020_1">-->
	<svg id="barcode'.$i.'"></svg>

	</td>
   </tr>
   <tr>
    <td height=35></td>
   </tr>
  </table>
  </span><![endif]><span style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=8 height=90 class=xl68 width=474 style=\'border-right:.5pt solid black;
    height:67.5pt;width:399pt\'>Child AWB :'.$idbilladd.'<br>
        <font class="font7">Main AWB: '.$idbilladd.' </font></td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=130 style=\'mso-height-source:userset;height:97.5pt\'>
  <td colspan=6 height=130 width=362 style=\'height:97.5pt;width:269pt\'
  align=left valign=top><!--[if gte vml 1]><v:shape id="Picture_x0020_3"
   o:spid="_x0000_s1179" type="#_x0000_t75" style=\'position:absolute;
   margin-left:252pt;margin-top:3.6pt;width:90pt;height:90pt;z-index:1;
   visibility:visible\' o:gfxdata="">
   <v:imagedata src="image007.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:336px;margin-top:6px;width:120px;
  height:120px\'>
  
  <!--<img width=120 height=120 src=image008.gif v:shapes="Picture_x0020_3">-->

  
  </span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=6 height=130 class=xl71 width=362 style=\'height:97.5pt;
    width:269pt\'>'; echo '<font size=5px>AWB-'.$idbilladd.'</font><font class="font6" style="font-size:27px"><br>
        <b>To:</b><br>';
		echo ' <b>'.@$nguoinhanadd['n_congty'].'</b><br>';
		echo '* <b>'.@$nguoinhanadd['n_tennguoinhan'].'</b> <br>* SĐT: <b>'.$nguoinhanadd['n_dienthoai'].'</b>';
		echo'<br>
        * '.mb_strtoupper($diachinguoinhan, 'UTF-8').'</font>';
		
		echo'</td>
   </tr>
  </table>
  </span></td>
  <td class=xl66>&nbsp;</td>
  <td class=xl67>&nbsp;</td>
 </tr>
 <tr height=120 style=\'mso-height-source:userset;height:90.0pt\'>
  <td colspan=6 height=120 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:90.0pt;width:171pt;font-size:20px\'><b>From:</b><br>';
		echo @$nguoiguiadd['g_congty'].'<br>';
		echo '* '.@$nguoiguiadd['g_tennguoigui'];
		echo'<br>
        '.@$nguoiguiadd['g_diachi1'].'</font><br>';
		echo @$nguoiguiadd['g_poscode'];
		
	echo'
    </td>
  <td colspan=2 height=120 width=244 style=\'border-right:.1pt solid black;
  height:90.0pt;width:181pt\' align=left valign=top><!--[if gte vml 1]><v:shape
   id="Picture_x0020_6" o:spid="_x0000_s1182" type="#_x0000_t75" style=\'position:absolute;
   margin-left:10.2pt;margin-top:3pt;width:163.2pt;height:58.2pt;z-index:4;
   visibility:visible\' o:gfxdata="">
   <v:imagedata src="image003.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:4;width:218px;
  height:78px;padding:5px;\'> <div style="height:200;width:218px;font-size:50px;">
  
	  		<div id="id_qrcode'.$i.'"></div>


  
  
  
  </div>
  <!--
  <img width=218 height=78 src=image015.gif v:shapes="Picture_x0020_6">-->
  	
	
	

  
  </span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=4 height=120 class=xl96 width=244 style=\'border-right:.5pt solid black;
    height:90.0pt;border-left:none;width:181pt\'></td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=44 style=\'mso-height-source:userset;height:33.0pt\'>
  <td colspan=4 height=44 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:33.0pt;width:171pt\'>Payment :<br>
    Receiver ：</td>
    <td colspan=4 height=44 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:33.0pt;width:171pt\'>Content ：</td>
 </tr>
 <tr height=42 style=\'mso-height-source:userset;height:31.5pt\'>
  <td colspan=4 height=42 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:31.5pt;width:171pt\'>Actual WT ：<b>'.$hoadonadd['cannang'].' lbs</b><br>
    
Pieces ：<b>'.$hoadonadd['sokien'].' pcs</b></td>
  <td colspan=4 rowspan=2 class=xl82 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black;text-align:center\'><svg id="barcode'.$i.'"></svg></td>
 </tr>
 <tr height=44 style=\'mso-height-source:userset;height:33.0pt\'>
  <td colspan=4 height=44 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:33.0pt;width:171pt\'>Freight ：<br>
    VAS ：</td>
 </tr>

 <tr height=19 style=\'height:14.4pt\'>
  <td colspan=8 rowspan=2 height=29 class=xl90 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:21.9pt;\'>Remark: '.$hoadonadd['loaihang'].'<span
  style=\'mso-spacerun:yes\'>&nbsp;</span></td>
 </tr>
 <tr height=10 style=\'mso-height-source:userset;height:7.5pt\'>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style=\'display:none\'>
  <td width=51 style=\'width:38pt\'></td>
  <td width=47 style=\'width:35pt\'></td>
  <td width=66 style=\'width:49pt\'></td>
  <td width=66 style=\'width:49pt\'></td>
  <td width=66 style=\'width:49pt\'></td>
  <td width=66 style=\'width:49pt\'></td>
  <td width=66 style=\'width:49pt\'></td>
  <td width=46 style=\'width:34pt\'></td>
 </tr>
 <![endif]>
</table>

<p style="margin-left:40px;font-family: Calibri;font-size:13px">Date Printing: <span id="datetime'.$i.'"></span> - SAO MAI SERVICES</p> 



	<input type=hidden id="abcId'.$i.'" name="abcName" 
                  value="'.$idbilladd.'"/> 
	

<script>
var dt = new Date();
document.getElementById("datetime'.$i.'").innerHTML = dt.toLocaleString();
</script>
<script>
		



JsBarcode("#barcode'.$i.'", document.getElementById(\'abcId'.$i.'\').value, {
	
  format: "CODE128",
  lineColor: "",
  width: 1.5,
  height: 50,
  displayValue: false
});




</script>
<script>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        w=window.open();
        w.document.write(printContents);
        w.print();
        w.close();
    }
	

</script>';



echo'<div style="page-break-after: always;"></div>';



}



}
echo'

<script>function onReady()
		{';
		
			for ($i=0; $i<sizeof ($checkbox1);$i++) { 
			echo'
			var qrcode = new QRCode("id_qrcode'.$i.'", {
				text:"http://ad2.saomaiservices.com/scanbarcodevn3.php?id="+document.getElementById(\'abcId'.$i.'\').value,
				width:111,
				height:111,
				colorDark:"#000000",
				colorLight:"#ffffff",
				correctLevel:QRCode.CorrectLevel.H
			})';
			}
			
		echo'}</script>';


?>
</body>

</html>
