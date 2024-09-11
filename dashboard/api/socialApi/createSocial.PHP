<?php
require '../../z_db.php';
include "../Config.php";
$name = $_POST['name'];
$fa = $_POST['fa'];
$social_link = $_POST['social_link'];

if ($name && $fa && $social_link) {
    $stmt = $con->prepare("INSERT INTO social (name, fa, social_link) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $fa, $social_link);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Record created successfully"]);
    } else {
        echo json_encode(["error" => "Failed to create record"]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$con->close();
?>
