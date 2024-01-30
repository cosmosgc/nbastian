<?php
// Include the database connection file (db.php)
include_once '../db.php';

// Define your API endpoints


// Endpoint to schedule a visit
function createPayment($payment_id = null) {
    global $conn; // Make sure to use the global $conn variable

    // Determine if payment_id is provided and not null
    $paymentIdColumn = ($payment_id !== null && $payment_id !== 0 && $payment_id !== "") ? "payment_id," : "";

    // Add your logic to create a new payment item in the database
    $insertPaymentQuery = "INSERT INTO payment ($paymentIdColumn payment_code, payment_method, is_paid, info) 
                           VALUES ('$payment_id', 'your_payment_code', 'your_payment_method', false, 'your_payment_info')";
    $insertPaymentResult = $conn->query($insertPaymentQuery);

    return $insertPaymentResult;
}

// Endpoint to schedule a visit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule'])) {
    // Validate and sanitize input data
    $cpf = htmlspecialchars($_POST['cpf']);
    $time_start = htmlspecialchars($_POST['time_start']);
    $time_end = htmlspecialchars($_POST['time_end']);
    $payment_id = htmlspecialchars($_POST['payment_id']);
    $info = htmlspecialchars($_POST['info']);
    $cleaned_cpf = str_replace(['.', '-'], '', $cpf);

    // Check if the provided "cpf" exists in the "user" table
    $checkUserQuery = "SELECT cpf FROM user WHERE cpf = '$cleaned_cpf'";
    $userResult = $conn->query($checkUserQuery);

    // If the user with the provided "cpf" exists, proceed with the schedule insertion
    if ($userResult && $userResult->num_rows > 0) {
        // Check if the provided "payment_id" exists in the "payment" table
        $checkPaymentQuery = "SELECT payment_id FROM payment WHERE payment_id = '$payment_id'";
        $paymentResult = $conn->query($checkPaymentQuery);

        // If the payment with the provided "payment_id" exists, proceed with the schedule insertion
        if ($paymentResult && $paymentResult->num_rows > 0) {
            // Perform SQL insert into the "schedule" table
            $insertQuery = "INSERT INTO schedule (cpf, time_start, time_end, payment_id, info) 
                            VALUES ('$cleaned_cpf', '$time_start', '$time_end', '$payment_id', '$info')";
            $insertResult = $conn->query($insertQuery);

            // Check if the insertion was successful
            if ($insertResult) {
                // Return a success response
                echo json_encode(['status' => 'success', 'message' => 'Visit scheduled successfully']);
            } else {
                // Return an error response indicating an issue with the insertion
                echo json_encode(['status' => 'error', 'message' => 'Failed to schedule visit']);
            }
        } else {
            // Payment does not exist, so create a new payment item
            if (createPayment($payment_id)) {
                // If the payment item is created successfully, proceed with the schedule insertion
                $insertQuery = "INSERT INTO schedule (cpf, time_start, time_end, payment_id, info) 
                                VALUES ('$cleaned_cpf', '$time_start', '$time_end', '$payment_id', '$info')";
                $insertResult = $conn->query($insertQuery);

                // Check if the insertion was successful
                if ($insertResult) {
                    // Return a success response
                    echo json_encode(['status' => 'success', 'message' => 'Visit scheduled successfully']);
                } else {
                    // Return an error response indicating an issue with the insertion
                    echo json_encode(['status' => 'error', 'message' => 'Failed to schedule visit']);
                }
            } else {
                // Return an error response indicating a failure to create a new payment item
                echo json_encode(['status' => 'error', 'message' => 'Failed to create payment item']);
            }
        }
    } else {
        // Return an error response indicating that the user with the provided "cpf" does not exist
        echo json_encode(['status' => 'error', 'message' => 'User does not exist', 'user' => $cleaned_cpf]);
    }
}


// Endpoint to get user information
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_cpf'])) {
    // Validate and sanitize input data
    $cpf = htmlspecialchars($_GET['user_cpf']);

    // Perform SQL select to get user information
    $query = "SELECT * FROM user WHERE cpf = '$cpf'";
    // Execute the query

    // Return the user information as JSON

    // Add additional error handling and validation as needed
}

// Endpoint to mark a payment as paid
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_paid'])) {
    // Validate and sanitize input data
    $payment_id = htmlspecialchars($_POST['payment_id']);

    // Perform SQL update to mark payment as paid
    $query = "UPDATE payment SET is_paid = true WHERE payment_id = '$payment_id'";
    // Execute the query

    // Add additional error handling and validation as needed
}
?>
