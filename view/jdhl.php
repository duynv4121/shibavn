
<?php
$url = "http://220.130.163.195:8060/pioneerapi/inqtrackbyno.ashx";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(['apikeyvalue' => 'Win7_0401', 'number' => '797900536']));

$resp = curl_exec($curl);
curl_close($curl);

echo $resp;
?>