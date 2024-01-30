<?php
// Include the database connection file (db.php)
include_once '../db.php';

// Get and search for users
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['search'])) {
        $searchTerm = htmlspecialchars($_GET['search']);

        // Perform SQL query to get users based on the search term
        $query = "SELECT * FROM user WHERE name LIKE '%$searchTerm%' OR cpf LIKE '%$searchTerm%'";
    } else {
        // If no search term provided, get all users
        $query = "SELECT * FROM user";
    }

    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch the results as an associative array
        $users = $result->fetch_all(MYSQLI_ASSOC);

        // Return the results as JSON
        echo json_encode(['status' => 'success', 'data' => $users]);
    } else {
        // Return an error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve users']);
    }
} else {
    // Return an error response for invalid request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
