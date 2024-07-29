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
$hoadonadd = mysql_fetch_assoc(mysql_query("select * from gpe_listhoadon_kr where id='$idbill'"))or die("Loi");
$nguoiguiadd = mysql_fetch_assoc(mysql_query("select * from gpe_nguoigui_kr where id_hoadon='$idbill'"))or die("Loi 2");
$nguoinhanadd = mysql_fetch_assoc(mysql_query("select * from gpe_nguoinhan_kr where id_hoadon='$idbill'"))or die("Loi 3");
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
   height:71.25pt;z-index:1;visibility:visible" o:gfxdata="">
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
