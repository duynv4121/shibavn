<?php
// jSON URL which should be requested
include("../conn/db.php");
  @session_start();
	if (!isset($_SESSION['username']) || $_SESSION['type'] !=1) {
		 header('Location: login.php');
	}

?>

					
					<?php
					
				if(isset($_GET['id']))
				{
									$id = $_GET['id'];
									$laydulieu = mysqli_fetch_assoc(mysqli_query($conn,"select * from ns_tracking_shipment where id='$id'"));
									
									$id_awb = $laydulieu['id_awb'];
									$address = $laydulieu['address'];
									$status = $laydulieu['status'];
									
									$laydulieukiena = mysqli_query($conn,"select * from ksn_shipment_details where awb='$id_awb'");
									while($laydulieukien = mysqli_fetch_array($laydulieukiena))
									{
										mysqli_query($conn,"DELETE FROM `ns_tracking_bill` WHERE (`status`='$status' AND `address`='$address' AND `id_hoadon`='".$laydulieukien['id_listhoadon']."')")or die("loiiii");
									}
									
									mysqli_query($conn,"DELETE FROM `ns_tracking_shipment` WHERE (`id`='$id')");
								
									header('Location: ' . $_SERVER['HTTP_REFERER']);


				}

					?>