<?php
@session_start();
include("../conn/db.php");

$iddanhan = $_GET['id'];


$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ksn_shipment_details where id='$iddanhan'"));
$laydulieu2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_listhoadon where id_code='".$laydulieu['id_listhoadon']."'"));
mysqli_query($conn,"DELETE FROM `ksn_shipment_details` WHERE (`id`='$iddanhan')");
mysqli_query($conn,"UPDATE `ns_listhoadon` SET `status`='1' WHERE (`id_code`='".$laydulieu['id_listhoadon']."')");
mysqli_query($conn,"UPDATE `ns_package` SET `status`='1' WHERE (`id`='".$laydulieu2['id_package']."')");
mysqli_query($conn,"DELETE FROM `ns_tracking_bill` WHERE (`id_hoadon`='".$laydulieu['id_listhoadon']."') AND status='Origin customs processing' LIMIT 1");
mysqli_query($conn,"DELETE FROM `ns_tracking_bill` WHERE (`id_hoadon`='".$laydulieu['id_listhoadon']."') AND status='Transit' LIMIT 1");


header("Location:".$_SERVER['HTTP_REFERER'].""); 
?>
