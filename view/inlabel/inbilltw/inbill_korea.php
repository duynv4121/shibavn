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
<script type="text/javascript" src="qrcode.min.js"></script>

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
	{margin:.75in .7in .75in .7in;
	mso-header-margin:.3in;
	mso-footer-margin:.3in;}
-->
</style>

</head>

<body link=blue vlink=purple onload=onReady()>
<?php
    @session_start();

	include("../../conn/db.php");
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
    $data = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_listhoadon WHERE id='$id'"));
    $package = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_package WHERE id='".$data['id_package']."'"));

    $nguoigui = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoigui WHERE id='".$package['id_nguoigui']."'"));
    $nguoinhan = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_nguoinhan WHERE id='".$package['id_nguoinhan']."'"));
    $dulieuuser = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_user where id='$uid'"));

    $countries = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_countries WHERE id = '".$nguoinhan['country_id']."'"));
    $count =mysql_num_rows(mysql_query("SELECT * FROM ns_listhoadon WHERE id_package = '".$package['id']."'"));
?>


<table border=0 cellpadding=0 cellspacing=0 width=474 style='border-collapse:
 collapse;table-layout:fixed;width:352pt'>
 <col width=51 style='mso-width-source:userset;mso-width-alt:1820;width:38pt'>
 <col width=47 style='mso-width-source:userset;mso-width-alt:1678;width:35pt'>
 <col width=66 span=5 style='mso-width-source:userset;mso-width-alt:2332;
 width:49pt'>
 <col width=46 style='mso-width-source:userset;mso-width-alt:1621;width:34pt'>
 <tr height=19 style='height:14.4pt'>
  <td height=19 width=51 style='height:14.4pt;width:38pt' align=left
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
   style='position:absolute;margin-left:9.6pt;margin-top:10.2pt;width:110.4pt;
   height:64.8pt;z-index:5;visibility:visible' o:gfxdata="">
   <v:imagedata src="image009.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:5;margin-top:14px;width:147px;
  height:86px'>
  
  
  <?php
		$laythongtinuser = mysql_query("select * from ns_user where id='".$uid."'");
		$thongtinuser = mysql_fetch_assoc($laythongtinuser);
  
  if($thongtinuser['logo'] != "")
  {
	
	  echo'<img width=167 height=86 src='.$thongtinuser['logo'].' v:shapes="Picture_x0020_2"></span><![endif]><span
  style="mso-ignore:vglayout2">
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=19 class=xl65 width=51 style="height:14.4pt;width:38pt"></td>
   </tr>
  </table>
  </span></td>
  <td class=xl65 width=47 style="width:35pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=46 style="width:34pt"></td>
 </tr>
 <tr height=21 style="height:15.6pt">
  <td height=21 class=xl65 style=""></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl97 colspan=3 style="mso-ignore:colspan;">'.$thongtinuser['congty'].'</td>
  <td class=xl65></td>
 </tr>

 
  <tr height=19 style="height:14.4pt">
  <td height=19 class=xl65 style="height:14.4pt"></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65 colspan=4 style="mso-ignore:colspan">Website:
  '.$thongtinuser['website'].'</td>
 </tr>
 <tr height=19 style="height:14.4pt">
  <td height=19 class=xl65 style="height:14.4pt"></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65 colspan=3 style="mso-ignore:colspan">Tel: '.$thongtinuser['sdt'].'</td>
  <td class=xl65></td>
 </tr>
 ';
  }
  else
  {
  echo'<img width=167 height=86 src=logo3.jpg v:shapes="Picture_x0020_2"></span><![endif]><span
  style="mso-ignore:vglayout2">
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=19 class=xl65 width=51 style="height:14.4pt;width:38pt"></td>
   </tr>
  </table>
  </span></td>
  <td class=xl65 width=47 style="width:35pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=66 style="width:49pt"></td>
  <td class=xl65 width=46 style="width:34pt"></td>
 </tr>
 <tr height=21 style="height:15.6pt">
  <td height=21 class=xl65 style="height:15.6pt"></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl97 colspan=3 style="mso-ignore:colspan;">GIA PHU INTERNATIONAL CO.,LTD</td>
  <td class=xl65></td>
 </tr>

 
  <tr height=19 style="height:14.4pt">
  <td height=19 class=xl65 style="height:14.4pt"></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65 colspan=4 style="mso-ignore:colspan">Website:
  http://giaphuexpress.vn</td>
 </tr>
 <tr height=19 style="height:14.4pt">
  <td height=19 class=xl65 style="height:14.4pt"></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65 colspan=3 style="mso-ignore:colspan">Tel: +84 927 507 777 | + 84 915 600 009</td>
  <td class=xl65></td>
 </tr>
 ';
  }
  ?>
  
  
 
 
 
 
 <tr height=19 style='height:14.4pt'>
  <td height=19 class=xl65 style='height:14.4pt'></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
 </tr>
 <tr height=19 style='height:14.4pt'>
  <td height=19 class=xl65 style='height:14.4pt'></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
 </tr>

 <tr height=90 style='mso-height-source:userset;height:67.5pt'>
  <td colspan=8 height=90 width=474 style='border-right:.5pt solid black;
  height:67.5pt;width:352pt' align=left valign=top><!--[if gte vml 1]><v:shape
   id="TextBox_x0020_9" o:spid="_x0000_s1180" type="#_x0000_t75" style='position:absolute;
   margin-left:294pt;margin-top:1.8pt;width:42.6pt;height:33pt;z-index:2;
   visibility:visible' o:gfxdata="
">
   <v:imagedata src="image002.png" o:title=""/>
   <o:lock v:ext="edit" aspectratio="f"/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><v:shape id="Picture_x0020_1" o:spid="_x0000_s1181" type="#_x0000_t75"
   style='position:absolute;margin-left:6.6pt;margin-top:3pt;width:163.2pt;
   height:58.8pt;z-index:3;visibility:visible' o:gfxdata="">
   <v:imagedata src="image003.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:2;margin-left:9px;margin-top:3px;width:440px;
  height:79px'>
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
    <td rowspan=2 align=left valign=top>
	<?php
	/*$nguoinhan = strtolower($nguoinhan['country_id']);
	if($nguoinhan == "208")
	{
		echo'<img width=57 height=44
    src=image004.gif v:shapes="TextBox_x0020_9"></td>';
	}*/
	?>
   </tr>
   <tr>
    <td height=43></td>
    <td rowspan=2 align=left valign=top>
	<!--<img width=218 height=78 src=image006.gif v:shapes="Picture_x0020_1">-->
	<svg id="barcode"></svg>

	</td>
   </tr>
   <tr>
    <td height=35></td>
   </tr>
  </table>
  </span><![endif]><span style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=8 height=90 class=xl68 width=474 style='border-right:.5pt solid black;
    height:67.5pt;width:352pt'>Main AWB : <?php echo $package['id']?> <br>
        <font class="font7">Child AWB: <?php echo $id?> </font></td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=130 style='mso-height-source:userset;height:97.5pt'>
  <td colspan=6 height=130 width=362 style='height:97.5pt;width:269pt'
  align=left valign=top><!--[if gte vml 1]><v:shape id="Picture_x0020_3"
   o:spid="_x0000_s1179" type="#_x0000_t75" style='position:absolute;
   margin-left:252pt;margin-top:3.6pt;width:90pt;height:90pt;z-index:1;
   visibility:visible' o:gfxdata="">
   <v:imagedata src="image007.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:336px;margin-top:6px;width:120px;
  height:120px'>
  
  <!--<img width=120 height=120 src=image008.gif v:shapes="Picture_x0020_3">-->
  		<div id="id_qrcode"></div>

  
  </span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=6 height=130 class=xl71 width=362 style='height:97.5pt;
    width:269pt'><font class="font6"><br>
        <b>To:</b><br>
        <?php 
		echo @$nguoinhan['n_congty'].'<br>';
		echo @$nguoinhan['name'].' ';
		echo'<br>
        '.@$nguoinhan['address'].'</font>';
		
		?> </td>
   </tr>
  </table>
  </span></td>
  <td class=xl66>&nbsp;</td>
  <td class=xl67>&nbsp;</td>
 </tr>
 <tr height=120 style='mso-height-source:userset;height:90.0pt'>
  <td colspan=4 height=120 class=xl73 width=230 style='border-right:.5pt solid black;
  height:90.0pt;width:171pt'><b>From:</b><br>
    <?php 
		echo @$nguoigui['g_congty'].'<br>';
		echo @$nguoigui['name'].' ';
		echo'<br>
        '.@$nguoigui['address'].'</font><br>';
		echo @$nguoigui['g_poscode'];
		
		?>
    </td>
  <td colspan=4 height=120 width=244 style='border-right:.5pt solid black;
  height:90.0pt;width:181pt' align=left valign=top><!--[if gte vml 1]><v:shape
   id="Picture_x0020_6" o:spid="_x0000_s1182" type="#_x0000_t75" style='position:absolute;
   margin-left:10.2pt;margin-top:3pt;width:163.2pt;height:58.2pt;z-index:4;
   visibility:visible' o:gfxdata="">
   <v:imagedata src="image003.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:4;margin-left:6px;margin-top:4px;width:218px;
  height:78px'>
  <!--
  <img width=218 height=78 src=image015.gif v:shapes="Picture_x0020_6">-->
  	<?php

		echo'<svg id="barcode"></svg>';
	
	?>
	
	

  
  </span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=4 height=120 class=xl96 width=244 style='border-right:.5pt solid black;
    height:90.0pt;border-left:none;width:181pt'></td>
   </tr>
  </table>
  </span></td>
 </tr>
 <tr height=44 style='mso-height-source:userset;height:33.0pt'>
  <td colspan=4 height=44 class=xl73 width=230 style='border-right:.5pt solid black;
  height:33.0pt;width:171pt'>Payment 지불 방법:<br>
    Receiver 수화기：</td>
    <td colspan=4 height=44 class=xl73 width=230 style='border-right:.5pt solid black;
  height:33.0pt;width:171pt'>Content 콘텐츠： <?php 
              $listcatalog = mysql_query("SELECT * FROM ns_mapcatalog WHERE id_bill = '".$data['id']."'");
              $arr = [];
              while ($item = mysql_fetch_array($listcatalog)) {
                $type = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_catalog WHERE id = '".$item['id_catalog']."'"));
                array_push($arr, $type['type_en']);
            }
            echo join(',',$arr);

            ?> </td>
 </tr>
 <tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td colspan=4 height=42 class=xl73 width=230 style='border-right:.5pt solid black;
  height:31.5pt;width:171pt'>Actual WT 실제 무게：<b><?php echo $data['cannang']; ?> kg</b><br>
    
Pieces 선적 수량：</td>
  <td colspan=4 rowspan=2 class=xl82 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>Signature  징후:
  
  
  
  </td>
 </tr>
 <tr height=44 style='mso-height-source:userset;height:33.0pt'>
  <td colspan=4 height=44 class=xl73 width=230 style='border-right:.5pt solid black;
  height:33.0pt;width:171pt'>Freight 화물：<br>
    VAS 부가 서비스：</td>
 </tr>
 <tr height=19 style='height:14.4pt'>
  <td colspan=4 height=19 class=xl87 style='border-right:.5pt solid black;
  height:14.4pt'>Total Charge 총 요금:</td>
  <td colspan=4 class=xl79 style='border-right:.5pt solid black;border-left:
  none'>Declerid Value:</td>
 </tr>
 <tr height=19 style='height:14.4pt'>
  <td colspan=8 rowspan=2 height=29 class=xl90 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:21.9pt;'><?php echo '<font size=3>Note Code : <b>'.$data['notecode'].'</b></font></b>'?><?php //echo $hoadonadd['loaihang']; ?><span
  style='mso-spacerun:yes'>&nbsp;</span></td>
 </tr>
 <tr height=10 style='mso-height-source:userset;height:7.5pt'>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=51 style='width:38pt'></td>
  <td width=47 style='width:35pt'></td>
  <td width=66 style='width:49pt'></td>
  <td width=66 style='width:49pt'></td>
  <td width=66 style='width:49pt'></td>
  <td width=66 style='width:49pt'></td>
  <td width=66 style='width:49pt'></td>
  <td width=46 style='width:34pt'></td>
 </tr>
 <![endif]>
</table>

<p style="margin-left:5px;font-family: Calibri;font-size:13px">Date Printing: <span id="datetime"></span> </p> 

<script>
var dt = new Date();
document.getElementById("datetime").innerHTML = dt.toLocaleString();
</script>


	<input type=hidden id="abcId" name="abcName" 
                  value="<?php echo $id; ?>"/> 
	
	<input type=hidden id="abcId1" name="abcId1" 
                  value="<?php echo $id; ?>"/>
<script>
		function onReady()
		{
			var qrcode = new QRCode("id_qrcode", {
				text:"http://guihangquocte.online/view/trackingview.php?id="+document.getElementById('abcId').value,
				width:120,
				height:115,
				colorDark:"#000000",
				colorLight:"#ffffff",
				correctLevel:QRCode.CorrectLevel.H
			});
		}



JsBarcode("#barcode", document.getElementById('abcId').value, {
	
  format: "CODE128",
  lineColor: "",
  width: 2,
  height: 40,
  displayValue: true
});

JsBarcode("#barcode1", document.getElementById('abcId1').value, {

  format: "CODE128",
  lineColor: "",
  width: 2,
  height: 66,
  displayValue: true
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
	

</script>
</body>

</html>
