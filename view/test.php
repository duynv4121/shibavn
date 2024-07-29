<?php
include("top.php");

$aaa = substr("40455651329", 0,4);    // trả về "f"
echo $aaa;
/**aa
$i=1;
$laydulieutrackshipment = mysqli_query($conn,"select * from ns_tracking_shipment where status='Destination Customs Released'");
						while($laydulieutrack = mysqli_fetch_array($laydulieutrackshipment))
						{
							echo $laydulieutrack['id_awb'].'<br>';
							$laydulieukiencona = mysqli_query($conn,"select * from ksn_shipment_details where awb='".$laydulieutrack['id_awb']."' ");
							while($laydulieukiencon  = mysqli_fetch_array($laydulieukiencona))
							{
								$laykienhang = mysqli_query($conn,"select * from ns_tracking_bill where id_hoadon='".$laydulieukiencon['id_listhoadon']."' AND status='Destination Customs Released'");
								if(mysqli_num_rows($laykienhang) >= 1)
								{
									
								}
								else
								{
									echo $laydulieukiencon['id_listhoadon'].'<br>';
									echo $laydulieutrack['date'];
									mysqli_query($conn,"INSERT INTO `ns_tracking_bill` (`id_hoadon`, `address`, `status`, `date`) VALUES ('".$laydulieukiencon['id_listhoadon']."', '".$laydulieutrack['address']."', '".$laydulieutrack['status']."', '".$laydulieutrack['date']."')");
								}
							}

						}
						
						*/


/*
$aaa = mysqli_query($conn,"select * from ns_listhoadon where billketnoi is NOT NULL");

while($aa = mysqli_fetch_array($aaa,MYSQLI_ASSOC))
{
	echo $aa['billketnoi'].'<br>';
	
	
	
		$url = 'https://api.tracktry.com/v1/trackings/post';

		// Create a new cURL resource
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// Setup request to send json via POST
		$dataa = array(
			"tracking_number" => $aa['billketnoi'],
			"carrier_code"=> $aa['hangketnoi']
		);
		$payload = json_encode($dataa);





		// Attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

		// Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		'Tracktry-Api-Key: 942b2c55-40fe-4455-acb4-503d20f031c2'));


		// Return response instead of outputting

		// Execute the POST request
		$resultc = curl_exec($ch);

		// Close cURL resource
		curl_close($ch);
		
	
}

*/
/*
$laytrackingshipa = mysqli_query($conn,"select * from ns_tracking_shipment");
$i=0;
while($laytrackingship = mysqli_fetch_array($laytrackingshipa))
{
	$i++;
	$laydulieukiena = mysqli_query($conn,"select * from ksn_shipment_details where awb='".$laytrackingship['id_awb']."'");
	while($laydulieukien = mysqli_fetch_array($laydulieukiena))
	{
		echo $i.'-'.$laydulieukien['id_listhoadon'].'-'.$laytrackingship['address'].'<br>';
		mysqli_query($conn,"INSERT INTO `ns_tracking_bill` (`id_hoadon`, `address`, `status`, `date`)
		VALUES ('".$laydulieukien['id_listhoadon']."', '".$laytrackingship['address']."', '".$laytrackingship['status']."', '".$laytrackingship['date']."')")or die("loiiii");
	}

}

*/
/* Kerrry express
for ($x = 40455594800; $x <= 40455599800; $x++) {
   mysql_query("INSERT INTO `code_kerry` (`code`) VALUES ('$x')");
   echo $x;
}

*/


/* Code T cat
$lines = file('yamato.txt');
$count = 0;
foreach($lines as $line) {
    $count += 1;
    echo $count."-".$line.'<br>';
	$line2 = trim($line);
	mysql_query("INSERT INTO `code_tcat` (`code`) VALUES ('$line2')");

}

*/
	
?>
