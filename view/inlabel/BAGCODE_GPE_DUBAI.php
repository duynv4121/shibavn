<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="LABELHOANCHINH2_files/filelist.xml">
<script src="../inbill/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../inbill/qrcode.min.js"></script>
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->

<style>
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}

@page {
  size: 100mm 150mm;
  margin: 0;
}

.rotate {

}
</style>

<?php 

	@session_start();

	include("../../conn/db.php");
    @$id = $_GET['id'];
    @$uid = $_SESSION['uid'];
    

?>
<title>BAG CODE <?php echo$package['id_code'];?></title>

<style>
table, th, td {
  border: 1px solid;
}
.icon{

}
</style>
</head>

<body  onload=onReady()>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--The following information was generated by Microsoft Excel's Publish as Web
Page wizard.-->
<!--If the same item is republished from Excel, all information between the DIV
tags will be replaced.-->
<!----------------------------->
<!--START OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD -->
<!----------------------------->



<?php

$i = 0;
		$giatri = 1001;

  for($i=0;$i<=150;$i++){
	  $idcode = 'DUBAI-'.$giatri;
	$giatri+=1;
echo'
<div>

<div class="icon">
<center>BAG-DUBAI<br>
<svg id="barcode'.$idcode.'">
  <path d="M8.578 16.359l4.594-4.594-4.594-4.594 1.406-1.406 6 6-6 6z"></path>
 </svg>
 </div>
</div>
  
	  <input type=hidden id="abcId'.$idcode.'" name="abcName" 
                  value="'.$idcode.'"/> 
	  

	</div>
	
	
	<div style="break-after:page"></div>

				  
<script>
JsBarcode("#barcode'.$idcode.'", document.getElementById(\'abcId'.$idcode.'\').value, {
	
  format: "CODE128",
  lineColor: "",
  width: 1.8,
  height: 100,
  displayValue: true
});
</script>
';
  }
  
  echo'
		<script>
			function onReady()
		{
			
		
';

		
		echo'} </script>';
  
  
?>
<script>
<?php
	if($_GET['print'] == "auto")
	{
		echo'window.addEventListener("load", window.print());
';
	}
	?>
</script>
<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
