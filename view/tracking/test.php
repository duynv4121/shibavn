<?php

$id = $_GET['id'];
$url = 'https://api.tracktry.com/v1/carriers/detect';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$dataa = array(
    'tracking_number' => $id,
);
$payload = json_encode($dataa);





// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
'Tracktry-Api-Key: 85b48be2-80ea-4262-be38-5112c844715e'));

// Return response instead of outputting

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

print_r($result);





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