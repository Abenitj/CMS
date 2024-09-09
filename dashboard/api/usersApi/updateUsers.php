<?php
require '../../z_db.php';
include "../Config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $con->real_escape_string($_GET['id']);
    $name = $con->real_escape_string($_POST['firstName']);
    $phone = $con->real_escape_string($_POST['phone']);
    $country = $con->real_escape_string($_POST['country']);
    $city = $con->real_escape_string($_POST['city']);
    $email = $con->real_escape_string($_POST['email']);
    $password = password_hash($con->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    $sql = "UPDATE users SET name='$name', phone='$phone', country='$country', city='$city', email='$email', password='$password' WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        echo json_encode(['message' => 'User updated successfully']);
    } else {
        echo json_encode(['error' => 'Error: ' . $sql . '<br>' . $con->error]);
    }
}
?>
