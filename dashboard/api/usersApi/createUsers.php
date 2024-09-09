<?php
require "../../z_db.php";
include "../Config.php";
// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from POST request
    $name = $_POST['firstName'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $password = $_POST['password']; // You may want to hash this password

    // Simple input validation
    if (empty($name) || empty($phone) || empty($country) || empty($city) || empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO users (name, phone, country, city, email, password) 
            VALUES ('$name', '$phone', '$country', '$city', '$email', '$password')";

    if ($con->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "User created successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $cnn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}

// Close the database connection
$con->close();

?>
