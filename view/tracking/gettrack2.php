<?php


$billketnoi = $_GET['billketnoi'];
$hangketnoi = $_GET['hangketnoi'];



$curl_handle = curl_init();

$url = "https://api.tracktry.com/v1/trackings/".$hangketnoi."/".$billketnoi;
//$url = "https://api.tracktry.com/v1/trackings/4px/300403513351";
curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Tracktry-Api-Key:942b2c55-40fe-4455-acb4-503d20f031c2'));
// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);


// Decode JSON into PHP array
$response_data = json_decode($curl_data);

print_r($response_data);


?>