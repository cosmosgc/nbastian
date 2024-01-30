<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize total sum variables
    $totalItemValor = 0;
    $totalItemFrete = 0;

    // Loop through each form field and print its name and value
    foreach ($_POST as $key => $value) {
        // Check if the field is an item_valor_{int} or item_frete_{int}
        if (preg_match('/^item_valor_(\d+)$/', $key, $matches)) {
            $totalItemValor += floatval($value);
        } elseif (preg_match('/^item_frete_(\d+)$/', $key, $matches)) {
            $totalItemFrete += floatval($value);
        }

        echo "$key: $value <br>";
    }

    // Print the total sums
    echo "Total Item Valor: $totalItemValor <br>";
    echo "Total Item Frete: $totalItemFrete <br>";
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Initialize total sum variables
    $totalItemValor = 0;
    $totalItemFrete = 0;

    // Loop through each form field and print its name and value
    foreach ($_GET as $key => $value) {
        // Check if the field is an item_valor_{int} or item_frete_{int}
        if (preg_match('/^item_valor_(\d+)$/', $key, $matches)) {
            $totalItemValor += floatval($value);
        } elseif (preg_match('/^item_frete_(\d+)$/', $key, $matches)) {
            $totalItemFrete += floatval($value);
        }

        echo "$key: $value <br>";
    }

    // Print the total sums
    echo "Total Item Valor: $totalItemValor <br>";
    echo "Total Item Frete: $totalItemFrete <br>";
}
?>
