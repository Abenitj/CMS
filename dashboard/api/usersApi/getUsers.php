<?php
require '../../z_db.php';
include "../Config.php";
// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

// Include database connection file
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Prepare and execute SQL statement
    $stmt = $con->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all results as an associative array
    $userData = $result->fetch_all(MYSQLI_ASSOC);

    // Send JSON response
    if ($userData) {
        echo json_encode($userData);
    } else {
        echo json_encode(["error" => "No users found"]);
    }
}
?>
