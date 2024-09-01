<?php
require '../../z_db.php';
include('../Config.php');

header('Content-Type: application/json'); // Ensure JSON content type is set
header('Access-Control-Allow-Origin: *'); // For CORS

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $name = $con->real_escape_string($data['name']);
        $phone = $con->real_escape_string($data['phone']);
        $country = $con->real_escape_string($data['country']);
        $city = $con->real_escape_string($data['city']);
        $email = $con->real_escape_string($data['email']);
        $password = password_hash($con->real_escape_string($data['password']), PASSWORD_BCRYPT);

        $stmt = $con->prepare("INSERT INTO users (name, phone, country, city, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $phone, $country, $city, $email, $password);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'User created successfully']);
        } else {
            echo json_encode(['error' => 'Error: ' . $stmt->error]);
        }

        $stmt->close();
        $con->close();
    } else {
        echo json_encode(['error' => 'Invalid JSON']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
