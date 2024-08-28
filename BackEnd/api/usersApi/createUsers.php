<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $con->real_escape_string($_POST['name']);
    $phone = $con->real_escape_string($_POST['phone']);
    $country = $con->real_escape_string($_POST['country']);
    $city = $con->real_escape_string($_POST['city']);
    $email = $con->real_escape_string($_POST['email']);
    $password = password_hash($con->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, phone, country, city, email, password) VALUES ('$name', '$phone', '$country', '$city', '$email', '$password')";

    if ($con->query($sql) === TRUE) {
        echo json_encode(['message' => 'User created successfully']);
    } else {
        echo json_encode(['error' => 'Error: ' . $sql . '<br>' . $con->error]);
    }
}
?>
