<?php
@session_start();
include("../conn/db.php");

$iddanhan = $_GET['id'];

mysql_query("UPDATE `ns_listhoadon_sea` SET `awb`='', `datescanout`='', `status`='1' WHERE (`id`='$iddanhan')") or die(mysql_error());
header("Location:".$_SERVER['HTTP_REFERER'].""); 
?>
