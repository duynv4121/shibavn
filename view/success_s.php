<?php
@session_start();
// jSON URL which should be requested
include("../conn/db.php");

$iddanhan = $_GET['id'];
$date = date('Y-m-d H:i:s');;

mysql_query("UPDATE `ns_listhoadon` SET `status`=6 WHERE (`id`='$iddanhan')") or die(mysql_error());
mysql_query("INSERT INTO `ns_tracking_bill` (`id_hoadon`, `date`, `address`,`status`)
		VALUES ('$iddanhan','$date', '','Đã giao')") or die(mysql_error()); 


header("Location:".$_SERVER['HTTP_REFERER'].""); 
?>
