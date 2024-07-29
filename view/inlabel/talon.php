<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="talon_files/filelist.xml">

<script src="../inbill/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../inbill/qrcode.min.js"></script>

<?php 

	@session_start();

	include("../../conn/db.php");
    $id = $_GET['id'];
    $uid = $_SESSION['uid'];
    $shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ksn_shipment WHERE id='".$id."'"));
	$laytongsobag = mysqli_num_rows(mysqli_query($conn,"select distinct(box_no) from  ksn_shipment_details where awb='".$shipment['id']."'"));

   
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
  size: 100mm 130mm;
  margin: 0;
}
</style>


<style id="MẪU TALON - LAX_12542_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font512542
	{color:black;
	font-size:33.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font612542
	{color:black;
	font-size:16.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font712542
	{color:red;
	font-size:16.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.font812542
	{color:red;
	font-size:20.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;}
.xl1512542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6312542
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
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6412542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:18.0pt;
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
.xl6512542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6612542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:20.0pt;
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
.xl6712542
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
	text-align:left;
	vertical-align:top;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6812542
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
	text-align:left;
	vertical-align:top;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6912542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:33.0pt;
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
.xl7012542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:36.0pt;
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
.xl7112542
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
	text-align:left;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:normal;}
.xl7212542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:28.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:white;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7312542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:28.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7412542
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:24.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Times New Roman", serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
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

<div id="MẪU TALON - LAX_12542" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=948 style='border-collapse:
 collapse;table-layout:fixed;width:711pt'>
 <col width=72 style='width:54pt'>
 <col width=67 style='mso-width-source:userset;mso-width-alt:2144;width:50pt'>
 <col width=127 style='mso-width-source:userset;mso-width-alt:4064;width:95pt'>
 <col width=250 style='mso-width-source:userset;mso-width-alt:8000;width:188pt'>
 <col width=72 span=6 style='width:54pt'>
 <tr height=108 style='mso-height-source:userset;height:81.0pt'>
  <td colspan=4 height=108 width=516 style='height:81.0pt;width:387pt'
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
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_s1026" type="#_x0000_t75"
   alt="Barcode PNG transparent image download, size: 960x528px" style='position:absolute;
   margin-left:80.25pt;margin-top:11.25pt;width:222.75pt;height:44.25pt;
   z-index:1;visibility:visible' o:gfxdata="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
1dpI5gCahlSGjWAuOxJ43iORTCjY0LKeP7e8/C5+JCwp8v0LefergxBD8Zptv/ZC+JTe303ZE0aO
T+7y+V/9VlEc4LkK1MAp5Ju6TJWtNqjOuRW/EP7E10ZLZPRIMZQtdTfzM97VteUOUBTEq+VxdKZC
eECR2dbpa3F4JV55Ubw8+Z7FfuhHEXCgJpdUR3A5YfoHAAD//wMAUEsDBAoAAAAAAAAAIQAfY/O9
QQwAAEEMAAAUAAAAZHJzL21lZGlhL2ltYWdlMS5wbmeJUE5HDQoaCgAAAA1JSERSAAACqQAAAIcI
AwAAAXXGAAwAAAABc1JHQgCuzhzpAAAABGdBTUEAALGPC/xhBQAAAhBQTFRFAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAA6uMa1AAAALB0Uk5TANZBgi5vG/FcCEk2d7gj+RDmUZLTPsArrRjuWQVGh3S1IKIN4zt8vSj+
aaoV61YC2EOEMHHzXp8K4EuMebol+2anElPVgW6v8JwHSInKNSJjD+VQ0j1+v2sX7QTaRYYyc7Qf
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
">
   <v:imagedata src="talon_files/MẪU%20TALON%20-%20LAX_12542_image001.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:107px;margin-top:20px;width:297px;
  height:59px'>  	<?php echo'<svg id="barcode'.$shipment['awb'].'">'; ?></svg>
</span><![endif]><span
  style='mso-ignore:vglayout2'><br>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=4 height=108 class=xl7412542 width=516 style='height:81.0pt;
    width:387pt'><a name="RANGE!A1:D13"><?php echo  $shipment['hangbay']?></a></td>
   </tr>
  </table>
  </span></td>
  <td class=xl1512542 width=72 style='width:54pt'></td>
  <td class=xl1512542 width=72 style='width:54pt'></td>
  <td class=xl1512542 width=72 style='width:54pt'></td>
  <td class=xl1512542 width=72 style='width:54pt'></td>
  <td class=xl1512542 width=72 style='width:54pt'></td>
  <td class=xl1512542 width=72 style='width:54pt'></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=4 rowspan=3 height=69 class=xl7112542 width=516 style='height:
  51.75pt;width:387pt'>MAWB NO:<br>
    <span style='mso-spacerun:yes'>     </span><font class="font512542"><span
  style='mso-spacerun:yes'>           </span><?php echo  $shipment['awb'];?></font></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl1512542 style='height:15.75pt'></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=27 style='mso-height-source:userset;height:20.25pt'>
  <td height=27 class=xl1512542 style='height:20.25pt'></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=3 height=21 class=xl6312542 style='height:15.75pt'>DEST MAWB</td>
  <td class=xl6312542 style='border-top:none;border-left:none'>TOTAL PCS</td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl6512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=3 rowspan=2 height=41 class=xl6912542 style='height:30.75pt'><?php echo  $shipment['dest'];?></td>
  <td rowspan=2 class=xl7012542 style='border-top:none'><?php echo  $laytongsobag;?></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl1512542 style='height:15.0pt'></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=68 style='mso-height-source:userset;height:51.0pt'>
  <td colspan=4 height=68 class=xl6712542 width=516 style='height:51.0pt;
  width:387pt'>HAWB NO:<font class="font612542"><br>
    <span style='mso-spacerun:yes'>              </span></font><font
  class="font712542"><span
  style='mso-spacerun:yes'>                         </span></font><font
  class="font812542"><span style='mso-spacerun:yes'> </span><?php echo  $shipment['hawb_no'];?></font></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542><span style='mso-spacerun:yes'> </span></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td colspan=3 height=21 class=xl6312542 style='height:15.75pt'>DEST HAWB</td>
  <td class=xl6312542 style='border-top:none;border-left:none'>PCS</td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542><span style='mso-spacerun:yes'>    </span></td>
 </tr>
 <tr height=32 style='mso-height-source:userset;height:24.0pt'>
  <td colspan=3 rowspan=2 height=48 class=xl6912542 style='height:36.0pt'><?php echo  $shipment['dest'];?></td>
  <td rowspan=2 class=xl7012542 style='border-top:none'><?php echo  $laytongsobag;?></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=16 style='mso-height-source:userset;height:12.0pt'>
  <td height=16 class=xl1512542 style='height:12.0pt'></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=46 style='mso-height-source:userset;height:34.5pt'>
  <td colspan=3 height=46 class=xl6412542 style='height:34.5pt'>ORIGIN</td>
  <td class=xl6412542 style='border-top:none;border-left:none'><?php echo  $shipment['kg_chinhanh'];?></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=48 style='mso-height-source:userset;height:36.0pt'>
  <td colspan=4 height=48 class=xl6612542 width=516 style='height:36.0pt;
  width:387pt'>SHIBA EXPRESS TRANS CO., LTD</td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl1512542 style='height:15.75pt'></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
  <td class=xl1512542><span style='mso-spacerun:yes'>   </span></td>
  <td class=xl1512542></td>
  <td class=xl1512542></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=72 style='width:54pt'></td>
  <td width=67 style='width:50pt'></td>
  <td width=127 style='width:95pt'></td>
  <td width=250 style='width:188pt'></td>
  <td width=72 style='width:54pt'></td>
  <td width=72 style='width:54pt'></td>
  <td width=72 style='width:54pt'></td>
  <td width=72 style='width:54pt'></td>
  <td width=72 style='width:54pt'></td>
  <td width=72 style='width:54pt'></td>
 </tr>
 <![endif]>
</table>

</div><?php 

echo'
<input type=hidden id="abcId'.$shipment['awb'].'" name="abcName" 
                  value="';
				   echo $shipment['awb']; 
				  
				  echo'"/> 
				  
				  
				  
				  
<script>
JsBarcode("#barcode'.$shipment['awb'].'", document.getElementById(\'abcId'.$shipment['awb'].'\').value, {
	
  format: "CODE128",
  lineColor: "",
  width: 2.2,
  height: 45,
  displayValue: false
});
</script>
';
  ?>

<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
<script>
<?php
	if($_GET['print'] == "auto")
	{
		echo'window.addEventListener("load", window.print());';
	}
	?>
</script>