<?php
@session_start();
include("../conn/db.php");

$iddanhan = $_GET['id'];

mysql_query("DELETE FROM gpe_shipment_malay_details WHERE id_listhoadon='$iddanhan'") or die(mysql_error());
header("Location:".$_SERVER['HTTP_REFERER'].""); 
?>
