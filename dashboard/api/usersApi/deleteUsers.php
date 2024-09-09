<?php
require '../../z_db.php'; // Ensure this file sets up $con for database connection
include "../Config.php"; // Ensure this file is correctly included and used

// Set the content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Ensure 'id' is present in the query string
    if (isset($_GET['id'])) {
        $id = $con->real_escape_string($_GET['id']);

        // Prepare the DELETE SQL statement
        $sql = "DELETE FROM users WHERE id='$id'";

        // Execute the query
        if ($con->query($sql) === TRUE) {
            echo json_encode(['message' => 'User deleted successfully']);
        } else {
            echo json_encode(['error' => 'Error: ' . $con->error]);
        }
    } else {
        echo json_encode(['error' => 'ID not provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
