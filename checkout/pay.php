<?php

// QRCO_5FFBB21D-46A3-494D-9F1D-5DAE72A10DD9

$curl = curl_init();
$token = '20E220E68E3C48EDA1D9812A36DE9451';
$qrCode = 'ORDE_21B4B08E-FBE4-477F-B022-A6D90CDA91B6';
$cert_file = dirname(__FILE__)."\\cacert.pem";
//https://sandbox.api.pagseguro.com/orders/ORDE_111197D6-E1B5-4D00-BF9C-B599CF892A37/pay
curl_setopt_array($curl, [
  CURLOPT_URL => "https://sandbox.api.pagseguro.com/orders/$qrCode/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYPEER => true,
  CURLOPT_CAINFO => $cert_file,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => [
    "Authorization: ". $token,
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
// print_r("https://sandbox.api.pagseguro.com/pix/pay/$qrCode");
// print_r("Authorization: ". $token);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
  echo 'ok';
}
