<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv=Content-Type content="text/html; charset=gb2312">
    <meta name=ProgId content=Excel.Sheet>
    <meta name=Generator content="Microsoft Excel 14">
    <link rel=File-List href=filelist.xml>
    <script src="../JsBarcode.all.min.js"></script>
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
    // echo $count;


    ?>
    <table border=0 cellpadding=0 cellspacing=0 width=549 style='border-collapse:
    collapse;table-layout:fixed;width:412pt'>
    <col width=276 style='mso-width-source:userset;mso-width-alt:10093;width:207pt'>
    <col width=117 style='mso-width-source:userset;mso-width-alt:4278;width:88pt'>
    <col width=156 style='mso-width-source:userset;mso-width-alt:5705;width:117pt'>
    <tr height=119 style='mso-height-source:userset;height:89.25pt'>
      <td height=119 width=276 style='height:89.25pt;width:207pt' align=left
      valign=top><span style='mso-ignore:vglayout;
      position:absolute;z-index:1;margin-left:25px;margin-top:13px;width:163px;
      height:95px'><img width=175 height=85 src="../logo.jpg" v:shapes="Picture_x0020_2"></span><![endif]><span
          style='mso-ignore:vglayout2'>
          <table cellpadding=0 cellspacing=0>
             <tr>
                <td height=119 class=xl68 width=276 style='height:89.25pt;width:207pt'>&nbsp;</td>
            </tr>
        </table>
    </span></td>
    <td colspan=2 class=xl69 width=273 style='border-right:1.0pt solid black;
    width:205pt'>GIA PHU EXPRESS<br>
    Website: https://gpexpress.vn/<?php //echo $dulieuuser['website'];?><br>
    Tel: 098 536 1139<?php echo $dulieuuser['phone'];?><br>
   
</td>
</tr>
<tr height=59 style='mso-height-source:userset;height:44.25pt'>
  <td colspan=3 height=59 class=xl71 style='border-right:1.0pt solid black;
  height:44.25pt'>SHIPPING MARK</td>
</tr>
<tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td height=42 class=xl65 style='height:31.5pt;border-top:none'><span
      style='font-variant-ligatures: normal;font-variant-caps: normal;orphans: 2;
      widows: 2;-webkit-text-stroke-width: 0px;text-decoration-thickness: initial;
      text-decoration-style: initial;text-decoration-color: initial'>From</span></td>
      <td colspan=2 class=xl66 style='border-right:1.0pt solid black;border-left:
      none'><span style='font-variant-ligatures: normal;font-variant-caps: normal;
      orphans: 2;widows: 2;-webkit-text-stroke-width: 0px;text-decoration-thickness: initial;
      text-decoration-style: initial;text-decoration-color: initial'>To</span></td>
  </tr>
  <tr height=95 style='mso-height-source:userset;height:71.25pt'>
      <td height=95 class=xl74 style='height:71.25pt;margin:left'>
	  
	  <?php 
	  echo '<font size=4px>'.$nguoigui['name'].'<br>'.$nguoigui['phone'].'<br>'.$nguoigui['address'];

	  ?>
	  
	  
	  </td>
      <td colspan=2 class=xl75 style='border-right:1.0pt solid black;border-left:
      none'> <?php 
	  echo '<font size=4px>'.$nguoinhan['name'].'<br>'.$nguoinhan['phone'].'<br>'.$nguoinhan['address'];

	  ?></td>
  </tr>
  <tr height=62 style='mso-height-source:userset;height:46.5pt'>
      <td colspan=3 height=62 class=xl99 style='border-right:1.0pt solid black;
      height:46.5pt'><font class="font16"><span
          style='mso-spacerun:yes'>&nbsp;&nbsp;&nbsp; </span>Pcs no: </font><font
          class="font11">
          <?php 
          $i = $data['pcs'];
          echo $i.'/'.$count;

      ?></font></td>
  </tr>
  <tr height=35 style='mso-height-source:userset;height:26.25pt'>
      <td colspan=3 height=35 class=xl86 style='border-right:1.0pt solid black;
      height:26.25pt'>Detail:</td>
  </tr>
  <tr height=26 style='mso-height-source:userset;height:20.1pt'>
      <td colspan=3 height=26 class=xl84 style='border-right:1.0pt solid black;
      height:20.1pt'>Master ID : <?php echo $package['id'] ?></td>
  </tr>
  <tr height=26 style='mso-height-source:userset;height:20.1pt'>
      <td colspan=3 height=26 class=xl90 style='border-right:1.0pt solid black;
      height:20.1pt'><font class="font13">Actual WT :</font><font class="font14">
          <?php echo $data['cannang'].' kg' ?></font></td>
      </tr>
      <tr height=26 style='mso-height-source:userset;height:20.1pt'>
          <td colspan=3 height=26 class=xl93 style='border-right:1.0pt solid black;
          height:20.1pt'>Description:<font class="font15"> </font><font class="font14">
            <?php 
              $listcatalog = mysql_query("SELECT * FROM ns_mapcatalog WHERE id_bill = '".$data['id']."'");
              $arr = [];
              while ($item = mysql_fetch_array($listcatalog)) {
                $type = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_catalog WHERE id = '".$item['id_catalog']."'"));
                array_push($arr, $type['type']);
            }
            echo join(',',$arr);

            ?>
        </font></td>
    </tr>
    <tr height=26 style='mso-height-source:userset;height:20.1pt'>
      <td colspan=3 height=26 class=xl96 style='border-right:1.0pt solid black;
      height:20.1pt'></td>
  </tr>
  
  <tr height=130 style='mso-height-source:userset;height:94.6pt'>
      <td  colspan=3 height=26 class=xl85 style='border-right:1.0pt solid black;
      height:20.1pt;padding-left: 0px;text-align: center;'>
          <svg id="barcode"></svg>

      </td>
  </tr>
  <!-- <tr height=26 style='mso-height-source:userset;height:20.1pt'>
      <td colspan=3 height=26 class=xl81 style='border-right:1.0pt solid black;
      height:20.1pt'>Address:<font class="font12"> 1969 W Harriet Ln Anaheim</font></td>
  </tr>
  <tr height=26 style='mso-height-source:userset;height:20.1pt'>
      <td colspan=3 height=26 class=xl103 style='border-right:1.0pt solid black;
      height:20.1pt'>Postal Code: 12433</td>
  </tr>
  <tr height=26 style='mso-height-source:userset;height:20.1pt'>
      <td colspan=3 height=26 class=xl103 style='border-right:1.0pt solid black;
      height:20.1pt'>Country: USA</td>
  </tr>
  <tr height=26 style='mso-height-source:userset;height:20.1pt'>
      <td colspan=3 height=26 class=xl103 style='border-right:1.0pt solid black;
      height:20.1pt'>Telephone: <font class="font14">0948857150</font></td>
  </tr>-->
  <tr height=26 style='mso-height-source:userset;height:19.5pt'>
      <td height=26 class=xl108 style='height:19.5pt'>Date printing: <?php echo date("Y/m/d h:i:s"); ?><span style='mso-spacerun:yes'>&nbsp;</span></td>
      <td colspan=2 style='mso-ignore:colspan'></td>
  </tr> 
  <![if supportMisalignedColumns]>
   <tr height=0 style='display:none'>
      <td width=276 style='width:207pt'></td>
      <td width=117 style='width:88pt'></td>
      <td width=156 style='width:117pt'></td>
  </tr>
  <![endif]>
  </table>
  <input type=hidden id="abcId" name="abcName" 
value="<?php echo $data['id']; ?>"/> 
  <script type="text/javascript">
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
