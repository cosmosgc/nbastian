<?php
// Include the database connection file (db.php)
include_once '../db.php';

// Get and search for schedules
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['search'])) {
        $searchTerm = htmlspecialchars($_GET['search']);

        // Perform SQL query to get schedules based on the search term
        $query = "SELECT * FROM schedule WHERE cpf LIKE '%$searchTerm%' OR info LIKE '%$searchTerm%'";
    } else {
        // If no search term provided, get all schedules
        $query = "SELECT * FROM schedule";
    }

    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch the results as an associative array
        $schedules = $result->fetch_all(MYSQLI_ASSOC);

        // Return the results as JSON
        echo json_encode(['status' => 'success', 'data' => $schedules]);
    } else {
        // Return an error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve schedules']);
    }
} else {
    // Return an error response for invalid request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
