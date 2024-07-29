<?php


$billketnoi = $_GET['billketnoi'];
$hangketnoi = $_GET['hangketnoi'];



$curl_handle = curl_init();

$url = "https://api.tracktry.com/v1/trackings/".$hangketnoi."/".$billketnoi;
//$url = "https://api.tracktry.com/v1/trackings/4px/300403513351";
curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Tracktry-Api-Key:85b48be2-80ea-4262-be38-5112c844715e'));
// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);


// Decode JSON into PHP array
$response_data = json_decode($curl_data);

print_r($response_data);


?>