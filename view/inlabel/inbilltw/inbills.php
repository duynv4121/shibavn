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
	
	$laydulieukienadd = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."'");
	while($laydulieukien = mysqli_fetch_array($laydulieukienadd,MYSQLI_ASSOC))
	{
    $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id='".$laydulieukien['id']."'"));
    $package = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_package WHERE id='".$data['id_package']."'"));

    $nguoigui = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoigui WHERE id='".$package['id_nguoigui']."'"));
    $nguoinhan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_nguoinhan WHERE id='".$package['id_nguoinhan']."'"));
    $dulieuuser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_user where id='$uid'"));

    $countries = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_countries WHERE id = '".$nguoinhan['country_id']."'"));
    $count =mysql_num_rows(mysqli_query($conn,"SELECT * FROM ns_listhoadon WHERE id_package = '".$package['id']."'"));

  echo'
<table border=0 cellpadding=0 cellspacing=0 width=474 style=\'border-collapse:
 collapse;table-layout:fixed;width:352pt\'>
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
   height:64.8pt;z-index:5;visibility:visible\' o:gfxdata="">
   <v:imagedata src="image009.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style=\'mso-ignore:vglayout;
  position:absolute;z-index:5;margin-top:14px;width:147px;
  height:86px\'>';
  
  

	$laythongtinuser = mysqli_query($conn,"select * from ns_user where id='".$uid."'");
	$thongtinuser = mysqli_fetch_assoc($laythongtinuser);
  
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
  <td class=xl97 colspan=3 style="mso-ignore:colspan;">'.$thongtinuser['ctyghitat'].'</td>
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
  <td class=xl65 colspan=3 style="mso-ignore:colspan">Tel: '.$thongtinuser['phone'].'</td>
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
 
  
  
 
 
 
 
 echo'<tr height=19 style=\'height:14.4pt\'>
  <td height=19 class=xl65 style=\'height:14.4pt\'></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
  <td class=xl65></td>
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
  height:67.5pt;width:352pt\' align=left valign=top><!--[if gte vml 1]><v:shape
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
   height:58.8pt;z-index:3;visibility:visible\' o:gfxdata="">
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
        <td rowspan=2  valign=top style="border-style: double;font-size:22px;font-weight:bold;padding:5px">';
	
	
	
	
	$quocgia = strtolower($nguoinhan['country_id']);
	$quocgia_name = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_countries where id='$quocgia'"));
	if($quocgia == 208)
	{
		$string1 = 'Payment 付款方式:';
		$string2 = 'Receiver 到付:';
		$string3 = 'Content 内容:';
		$string4 = 'Actual WT 实际重量:';
		$string5 = 'Pieces 货件数量:';
		$string6 = 'Signature  签名:';
		$string7 = 'Freight 运费:';
		$string8 = 'VAS 增值服务：';
		$string9 = 'Total Charge 运费合计:';
	}
	else
	{
		$string1 = 'Payment 지불 방법:';
		$string2 = 'Receiver 수화기:';
		$string3 = 'Content 콘텐츠：';
		$string4 = 'Actual WT 실제 무게：';
		$string5 = 'Pieces 선적 수량：';
		$string6 = 'Signature  징후:';
		$string7 = 'Freight 화물：';
		$string8 = 'VAS 부가 서비스：';
		$string9 = 'Total Charge 총 요금:';
	}
	
		echo'<center>'.$quocgia_name['iso'].'</td>';
	
	
	
	
echo'


   </tr>
   <tr>
    <td height=43></td>
    <td rowspan=2 align=left valign=top>
	<!--<img width=218 height=78 src=image006.gif v:shapes="Picture_x0020_1">-->
	<svg id="barcode'.$laydulieukien['id'].'"></svg>

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
    height:67.5pt;width:352pt\'>Main AWB : ';
	
	
	 echo $package['id'];

echo'<br>       <font class="font7">Child AWB: ';
	echo $laydulieukien['id'];
echo'	</font></td>
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
  		<div id="id_qrcode'.$laydulieukien['id'].'"></div>

  
  </span><![endif]><span
  style=\'mso-ignore:vglayout2\'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=6 height=130 class=xl71 width=362 style=\'height:97.5pt;
    width:269pt\'><font class="font6"><br>
        <b>To:</b><br>';
      
		echo @$nguoinhan['n_congty'].'<br>';
		echo @$nguoinhan['name'].' ';
		echo'<br>
        '.@$nguoinhan['address'].'</font>';
		
		echo' </td>
   </tr>
  </table>
  </span></td>
  <td class=xl66>&nbsp;</td>
  <td class=xl67>&nbsp;</td>
 </tr>
 <tr height=120 style=\'mso-height-source:userset;height:90.0pt\'>
  <td colspan=4 height=120 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:90.0pt;width:171pt\'><b>From:</b><br>';
   
		echo @$nguoigui['g_congty'].'<br>';
		echo @$nguoigui['name'].' ';
		echo'<br>
        '.@$nguoigui['address'].'</font><br>';
		echo @$nguoigui['g_poscode'];
		
	echo'
    </td>
  <td colspan=4 height=120 width=244 style=\'border-right:.5pt solid black;
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
  position:absolute;z-index:4;margin-left:6px;margin-top:4px;width:218px;
  height:78px\'>
  <!--
  <img width=218 height=78 src=image015.gif v:shapes="Picture_x0020_6">-->';
  	
		if($data['code_kerry'] != "")
		{
		echo'<svg id="barcode1'.$data['code_kerry'].'"></svg>';
		echo'<br><center>台灣 - Kerry Logistics</center>';
		}else if($data['code_tcat'] != "")
		{
		echo'<svg id="barcode2'.$data['code_tcat'].'"></svg>';
		echo'<br><center>黑貓宅急便 - T CAT</center>';
		}
		else
		{
			echo'	<svg id="barcode'.$laydulieukien['id'].'"></svg>
';
		}
	
	

  echo'
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
  height:33.0pt;width:171pt\'>'.$string1.'<br>
   '.$string2.'</td>
    <td colspan=4 height=44 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:33.0pt;width:171pt\'>'.$string3.' ';
 
              $listcatalog = mysqli_query($conn,"SELECT * FROM ns_mapcatalog WHERE id_bill = '".$data['id']."'");
              $arr = [];
              while ($item = mysqli_fetch_array($listcatalog,MYSQLI_ASSOC)) {
                $type = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ns_catalog WHERE id = '".$item['id_catalog']."'"));
                array_push($arr, $type['type_en']);
            }
            echo join(',',$arr);

           echo' </td>
 </tr>
 <tr height=42 style=\'mso-height-source:userset;height:31.5pt\'>
  <td colspan=4 height=42 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:31.5pt;width:171pt\'>'.$string4.'<b>';
   echo $data['cannang']; echo' kg</b><br>
    
'.$string5.'</td>
  <td colspan=4 rowspan=2 class=xl82 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black\'>'.$string6.'
  
  
  
  </td>
 </tr>
 <tr height=44 style=\'mso-height-source:userset;height:33.0pt\'>
  <td colspan=4 height=44 class=xl73 width=230 style=\'border-right:.5pt solid black;
  height:33.0pt;width:171pt\'>'.$string7.'<br>
    '.$string8.'</td>
 </tr>
 <tr height=19 style=\'height:14.4pt\'>
  <td colspan=4 height=19 class=xl87 style=\'border-right:.5pt solid black;
  height:14.4pt\'>'.$string9.'</td>
  <td colspan=4 class=xl79 style=\'border-right:.5pt solid black;border-left:
  none\'>Declerid Value:</td>
 </tr>
 <tr height=19 style=\'height:14.4pt\'>
  <td colspan=8 rowspan=2 height=29 class=xl90 style=\'border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:21.9pt;\'>';
   echo '<font size=3>Note Code : <b>'.$data['notecode'].'</b></font></b>';
   
   echo'<span
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

<p style="margin-left:5px;font-family: Calibri;font-size:13px">Date Printing: <span id="datetime'.$laydulieukien['id'].'"></span> </p> 

<script>
var dt = new Date();
document.getElementById("datetime'.$laydulieukien['id'].'").innerHTML = dt.toLocaleString();
</script>


	<input type=hidden id="abcId'.$laydulieukien['id'].'" name="abcName" 
                  value="';
				   echo $laydulieukien['id']; 
				  
				  echo'"/> 
	
	<input type=hidden id="abcId1'.$data['code_kerry'].'" name="abcId'.$data['code_kerry'].'" 
                  value="';
				   echo  $data['code_kerry'];
				   echo'"/>
				   
	<input type=hidden id="abcId2'.$data['code_tcat'].'" name="abcId2'.$data['code_tcat'].'" 
                  value="'.$data['code_tcat'].'"/>
<script>
	


JsBarcode("#barcode'.$laydulieukien['id'].'", document.getElementById(\'abcId'.$laydulieukien['id'].'\').value, {
	
  format: "CODE128",
  lineColor: "",
  width: 2,
  height: 40,
  displayValue: true
});';

		if($data['code_kerry'] != "")
				{
					
			echo'
			JsBarcode("#barcode1'.$data['code_kerry'].'", document.getElementById(\'abcId1'.$data['code_kerry'].'\').value, {

			  format: "CODE128",
			  lineColor: "",
			  width: 1.8,
			  height: 50,
			  displayValue: true
			});
			';
		}else if($data['code_tcat'] != "")
		{echo'
		JsBarcode("#barcode2'.$data['code_tcat'].'", document.getElementById(\'abcId2'.$data['code_tcat'].'\').value, {

		  format: "CODE128",
		  lineColor: "",
		  width: 1.7,
		  height: 50,
		  displayValue: true
		});
		';

		}
	


echo'

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

echo'<div style="break-after:page"></div>';
	}
	
	
		echo'
		<script>
			function onReady()
		{
			
		
';

	$laydulieukienaddz = mysqli_query($conn,"select * from ns_listhoadon where id_package='".$id."'");

		while($laydulieukienzz = mysqli_fetch_array($laydulieukienaddz,MYSQLI_ASSOC))
		{
	echo'
	var qrcode = new QRCode("id_qrcode'.$laydulieukienzz['id'].'", {
				text:"http://guihangquocte.online/view/trackingview.php?id="+document.getElementById(\'abcId'.$laydulieukienzz['id'].'\').value,
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



</body>

</html>
