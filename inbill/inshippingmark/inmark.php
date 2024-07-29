<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=gb2312">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 14">
<link rel=File-List href=filelist.xml>
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

<body link=blue vlink=purple>
<?php
@session_start();
include("../wtf/wtf.php");
$idbill = $_GET['id'];
$hoadonadd = mysql_fetch_assoc(mysql_query("select * from gpe_listhoadonus where id='$idbill'"))or die("Loi");
$nguoiguiadd = mysql_fetch_assoc(mysql_query("select * from gpe_nguoiguius where id_hoadon='$idbill'"))or die("Loi 2");
$nguoinhanadd = mysql_fetch_assoc(mysql_query("select * from gpe_nguoinhanus where id_hoadon='$idbill'"))or die("Loi 3");
?>

<?php
for($i=1;$i<=$hoadonadd['sokien'];$i++)
{
	echo'
<table border=0 cellpadding=0 cellspacing=0 width=549 style="border-collapse:
 collapse;table-layout:fixed;width:412pt">
 <col width=276 style="mso-width-source:userset;mso-width-alt:10093;width:207pt">
 <col width=117 style="mso-width-source:userset;mso-width-alt:4278;width:88pt">
 <col width=156 style="mso-width-source:userset;mso-width-alt:5705;width:117pt">
 <tr height=119 style="mso-height-source:userset;height:89.25pt">
  <td height=119 width=276 style="height:89.25pt;width:207pt" align=left
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
  </v:shapetype><v:shape id="Picture_x0020_2" o:spid="_x0000_s1025" type="#_x0000_t75"
   style="position:absolute;margin-left:18.75pt;margin-top:9.75pt;width:122.25pt;
   height:71.25pt;z-index:1;visibility:visible" o:gfxdata="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
bUAAABUAAABkcnMvbWVkaWEvaW1hZ2UxLmpwZWf/2P/gABBKRklGAAEBAQDcANwAAP/bAEMAAgEB
AQEBAgEBAQICAgICBAMCAgICBQQEAwQGBQYGBgUGBgYHCQgGBwkHBgYICwgJCgoKCgoGCAsMCwoM
CQoKCv/bAEMBAgICAgICBQMDBQoHBgcKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoK
CgoKCgoKCgoKCgoKCgoKCv/AABEIANoBdAMBIgACEQEDEQH/xAAfAAABBQEBAQEBAQAAAAAAAAAA
AQIDBAUGBwgJCgv/xAC1EAACAQMDAgQDBQUEBAAAAX0BAgMABBEFEiExQQYTUWEHInEUMoGRoQgj
QrHBFVLR8CQzYnKCCQoWFxgZGiUmJygpKjQ1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpz
dHV2d3h5eoOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX
2Nna4eLj5OXm5+jp6vHy8/T19vf4+fr/xAAfAQADAQEBAQEBAQEBAAAAAAAAAQIDBAUGBwgJCgv/
xAC1EQACAQIEBAMEBwUEBAABAncAAQIDEQQFITEGEkFRB2FxEyIygQgUQpGhscEJIzNS8BVictEK
FiQ04SXxFxgZGiYnKCkqNTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqCg4SF
hoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2dri4+Tl5ufo
6ery8/T19vf4+fr/2gAMAwEAAhEDEQA/AP38ooooAKKKKACiiigAooooAKKKKACiiigAooooAKKK
KACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAoooo
AKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiuS+JHx++BPwbj874v8Axq8JeFU27t3iTxJa
2Ix6/vpF4oA62ivA7j/gqp/wTKtJngm/4KDfBjdH97b8StMb9RPz+FQ/8PYf+CYf/SQb4N/+HG07
/wCPUAfQVFfPv/D2H/gmH/0kG+Df/hxtO/8Aj1H/AA9h/wCCYf8A0kG+Df8A4cbTv/j1AH0FRXz7
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
ooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACi
iigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAP/2VBLAQItABQA
BgAIAAAAIQD0vmNdDgEAABoCAAATAAAAAAAAAAAAAAAAAAAAAABbQ29udGVudF9UeXBlc10ueG1s
UEsBAi0AFAAGAAgAAAAhAAjDGKTUAAAAkwEAAAsAAAAAAAAAAAAAAAAAPwEAAF9yZWxzLy5yZWxz
UEsBAi0AFAAGAAgAAAAhABo2FqRtAgAArQUAABIAAAAAAAAAAAAAAAAAPAIAAGRycy9waWN0dXJl
eG1sLnhtbFBLAQItABQABgAIAAAAIQBYYLMbugAAACIBAAAdAAAAAAAAAAAAAAAAANkEAABkcnMv
X3JlbHMvcGljdHVyZXhtbC54bWwucmVsc1BLAQItABQABgAIAAAAIQCPRQbTDwEAAIsBAAAPAAAA
AAAAAAAAAAAAAM4FAABkcnMvZG93bnJldi54bWxQSwECLQAKAAAAAAAAACEAAk2a921AAABtQAAA
FQAAAAAAAAAAAAAAAAAKBwAAZHJzL21lZGlhL2ltYWdlMS5qcGVnUEsFBgAAAAAGAAYAhQEAAKpH
AAAAAA==
">
   <v:imagedata src="image001.png" o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style="mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:25px;margin-top:13px;width:163px;
  height:95px">
  
  ';
  
  if($_SESSION['type'] == 2)
  {
	  $laythongtinuser = mysql_query("select * from gpe_user where id='".$hoadonadd['id_usera']."'");
	  $thongtinuser = mysql_fetch_assoc($laythongtinuser);
	  echo'
  <img width=163 height=95 src=../inbill/'.$thongtinuser['logo'].' v:shapes="Picture_x0020_2"></span><![endif]><span
  style="mso-ignore:vglayout2">
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=119 class=xl68 width=276 style="height:89.25pt;width:207pt">&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td colspan=2 class=xl69 width=273 style="border-right:1.0pt solid black;
  width:205pt">'.$thongtinuser['congty'].'<br>
    Website: '.$thongtinuser['website'].'<br>
    Tel: '.$thongtinuser['sdt'].'</td>
 </tr>';
  }
  else
  {
  echo'
  <img width=163 height=95 src=image002.png v:shapes="Picture_x0020_2"></span><![endif]><span
  style="mso-ignore:vglayout2">
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=119 class=xl68 width=276 style="height:89.25pt;width:207pt">&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td colspan=2 class=xl69 width=273 style="border-right:1.0pt solid black;
  width:205pt">GIA PHU INTERNATIONAL CO.,LTD<br>
    Website: http://giaphuexpress.com<br>
    Tel: +84 927 507 777|+84 911 510 779</td>
 </tr>';
  }
 
 
 echo'
 
 <tr height=59 style="mso-height-source:userset;height:44.25pt">
  <td colspan=3 height=59 class=xl71 style="border-right:1.0pt solid black;
  height:44.25pt">SHIPPING MARK</td>
 </tr>
 <tr height=42 style="mso-height-source:userset;height:31.5pt">
  <td height=42 class=xl65 style="height:31.5pt;border-top:none"><span
  style="font-variant-ligatures: normal;font-variant-caps: normal;orphans: 2;
  widows: 2;-webkit-text-stroke-width: 0px;text-decoration-thickness: initial;
  text-decoration-style: initial;text-decoration-color: initial">DESTINATION</span></td>
  <td colspan=2 class=xl66 style="border-right:1.0pt solid black;border-left:
  none"><span style="font-variant-ligatures: normal;font-variant-caps: normal;
  orphans: 2;widows: 2;-webkit-text-stroke-width: 0px;text-decoration-thickness: initial;
  text-decoration-style: initial;text-decoration-color: initial">AWB</span></td>
 </tr>
 <tr height=95 style="mso-height-source:userset;height:71.25pt">
  <td height=95 class=xl74 style="height:71.25pt">';
  
  
  if(strtoupper($nguoinhanadd['n_quocgia']) == "USA")
  {
	  echo'USA';
  }else if(strtoupper($nguoinhanadd['n_quocgia']) == "CANADA")
  {
	  echo'CA';
  }else if(strtoupper($nguoinhanadd['n_quocgia']) == "FRANCE")
  {
	  echo'FR';
  }else if(strtoupper($nguoinhanadd['n_quocgia']) == "FRANCE")
  {
	  echo'FR';
  }else if(strtoupper($nguoinhanadd['n_quocgia']) == "SINGAPORE")
  {
	  echo'SG';
  }else if(strtoupper($nguoinhanadd['n_quocgia']) == "UNITED KINGDOM")
  {
	  echo'UK';
  }else if(strtoupper($nguoinhanadd['n_quocgia']) == "MALAYSIA")
  {
	  echo'MY';
  }else if(strtoupper($nguoinhanadd['n_quocgia']) == "AUSTRALIA")
  {
	  echo'AU';
  }else if(strtoupper($nguoinhanadd['n_quocgia']) == "CYPRUS")
  {
	  echo'CY';
  }
  
  echo'
  </td>
  <td colspan=2 class=xl75 style="border-right:1.0pt solid black;border-left:
  none">'.@$hoadonadd['id'].'</td>
 </tr>
 <tr height=62 style="mso-height-source:userset;height:46.5pt">
  <td colspan=3 height=62 class=xl99 style="border-right:1.0pt solid black;
  height:46.5pt"><font class="font16"><span
  style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp; </span>Pcs no: </font><font
  class="font11">'.$i.'/'.@$hoadonadd['sokien'].'</font></td>
 </tr>
 <tr height=35 style="mso-height-source:userset;height:26.25pt">
  <td colspan=3 height=35 class=xl86 style="border-right:1.0pt solid black;
  height:26.25pt">Sender: </td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl84 style="border-right:1.0pt solid black;
  height:20.1pt">Company Name : '.@$nguoiguiadd['g_congty'].'</td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl90 style="border-right:1.0pt solid black;
  height:20.1pt"><font class="font13">Contact Name :</font><font class="font14">
  <?php echo '.@$nguoiguiadd['g_tennguoigui'].'</font></td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl93 style="border-right:1.0pt solid black;
  height:20.1pt">Telephone:<font class="font15"> </font><font class="font14">'.@$nguoiguiadd['g_dienthoai'].'</font></td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl96 style="border-right:1.0pt solid black;
  height:20.1pt">Country :VIETNAM</td>
 </tr>
 <tr class=xl89 height=34 style="mso-height-source:userset;height:25.5pt">
  <td colspan=3 height=34 class=xl86 style="border-right:1.0pt solid black;
  height:25.5pt">Consignee:</td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl100 style="border-right:1.0pt solid black;
  height:20.1pt">Company:<font class="font12"> '.@$nguoinhanadd['n_congty'].'</font></td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl81 style="border-right:1.0pt solid black;
  height:20.1pt">Address:<font class="font12">  '.@$nguoinhanadd['n_diachi1'].'</font></td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl103 style="border-right:1.0pt solid black;
  height:20.1pt">Postal Code: '.@$nguoinhanadd['n_poscode'].'</td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl103 style="border-right:1.0pt solid black;
  height:20.1pt">Country: '.@$nguoinhanadd['n_quocgia'].'</td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl103 style="border-right:1.0pt solid black;
  height:20.1pt">Telephone: <font class="font14"> '.@$nguoinhanadd['n_dienthoai'].'</font></td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:20.1pt">
  <td colspan=3 height=26 class=xl85 style="border-right:1.0pt solid black;
  height:20.1pt">Contact name: '.@$nguoinhanadd['n_tennguoinhan'].'</td>
 </tr>
 <tr height=26 style="mso-height-source:userset;height:19.5pt">
  <td height=26 class=xl108 style="height:19.5pt">Date printing:.'.date("Y/m/d h:i:s").'<span style="mso-spacerun:yes">&nbsp;</span></td>
  <td colspan=2 style="mso-ignore:colspan"></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style="display:none">
  <td width=276 style="width:207pt"></td>
  <td width=117 style="width:88pt"></td>
  <td width=156 style="width:117pt"></td>
 </tr>
 <![endif]>
</table>';
echo'<div style="page-break-after: always;"></div>';
}

?>
</body>

</html>
