<?php
// Include the database connection file (db.php)
include_once '../db.php';

// Get and search for payments
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['search'])) {
        $searchTerm = htmlspecialchars($_GET['search']);

        // Perform SQL query to get payments based on the search term
        $query = "SELECT * FROM payment WHERE payment_code LIKE '%$searchTerm%' OR payment_method LIKE '%$searchTerm%'";
    } else {
        // If no search term provided, get all payments
        $query = "SELECT * FROM payment";
    }

    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch the results as an associative array
        $payments = $result->fetch_all(MYSQLI_ASSOC);

        // Return the results as JSON
        echo json_encode(['status' => 'success', 'data' => $payments]);
    } else {
        // Return an error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve payments']);
    }
} else {
    // Return an error response for invalid request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
