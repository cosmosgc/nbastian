<?php
$endpoint = 'https://sandbox.api.pagseguro.com/orders';
$token = '20E220E68E3C48EDA1D9812A36DE9451';

// Assuming $_GET is the array you provided
$items = [];
for ($i = 1; isset($_GET["item_id_$i"]); $i++) {
    $items[] = [
        "name" => $_GET["item_descr_$i"],
        "quantity" => $_GET["item_quant_$i"],
        "unit_amount" => $_GET["item_valor_$i"]
    ];
}

$body = [
    "reference_id" => $_GET["ref_transacao"],
    "customer" => [
        "name" => $_GET["cliente_nome"],
        "email" => 'cosmoskitsune@hotmail.com',//$_GET["cliente_email"],
        "tax_id" => '06148013975',//$_GET["cliente_cep"], // Assuming this is the tax ID (CPF or CNPJ)
        "phones" => [
            [
                "country" => "55",
                "area" => substr($_GET["cliente_ddd"], 0, 2),
                "number" => intval(substr($_GET["cliente_tel"], 0, 9)), // Adjust the length as needed
                "type" => "MOBILE"
            ]
        ]
    ],
    "items" => $items,
    "qr_codes" => [
        [
            "amount" => [
                "value" => array_sum(array_column($items, 'unit_amount'))
            ],
            "expiration_date" => "2024-04-29T20:15:59-03:00",
        ]
    ],
    "shipping" => [
        "address" => [
            "street" => $_GET["cliente_end"],
            "number" => $_GET["cliente_num"],
            "complement" => $_GET["cliente_compl"],
            "locality" => $_GET["cliente_bairro"],
            "city" => $_GET["cliente_cidade"],
            "region_code" => $_GET["cliente_uf"],
            "country" => $_GET["cliente_pais"],
            "postal_code" => $_GET["cliente_cep"]
        ]
    ],
    "notification_urls" => [
        "https://nbastian.com/checkout/webhook/"
    ]
];
// echo ($_GET["cliente_tel"]);
// echo (substr($_GET["cliente_tel"], 0, 9));

// print_r($_GET);
//print_r($body);
// return;

$cert_file = dirname(__FILE__)."\\cacert.pem";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $endpoint);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_CAINFO, $cert_file);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type:application/json',
  'Authorization: Bearer ' . $token
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
  var_dump($error);
  die();
}

$data = json_decode($response, true);

// var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QrCode Pix Pagseguro</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>

<body>
  <?php if ($data) : ?>
    <img src="<?php echo $data['qr_codes'][0]['links'][0]['href'] ?>" alt=""><br>
  <?php endif; ?>

  <pre>
<?php
    // Assuming $body is the array you want to display
    echo htmlspecialchars(print_r($data, true));
?>
</pre>
</body>

</html>