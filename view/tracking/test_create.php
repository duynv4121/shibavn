<?php

$billketnoi = '1Z2F768E0315876402';
$hangketnoi = 'ups';
$url = 'https://api.tracktry.com/v1/trackings/post';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$dataa = array(
    "tracking_number" => $billketnoi,
	"carrier_code"=> $hangketnoi
);
$payload = json_encode($dataa);





// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
'Tracktry-Api-Key: c6cada19-8d7a-4704-8b12-8d03d8d6b71d'));

// Return response instead of outputting

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);






/* Get mã
$curl_handle = curl_init();

$url = "https://api.tracktry.com/v1/trackings/UPS/1ZY063316712696959";

curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Tracktry-Api-Key: c6cada19-8d7a-4704-8b12-8d03d8d6b71d'));
// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);

curl_close($curl_handle);

// Decode JSON into PHP array
$response_data = json_decode($curl_data);

var_dump($response_data);

*/
?>