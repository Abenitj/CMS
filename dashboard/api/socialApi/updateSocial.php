<?php
require '../../z_db.php';
include "../Config.php";
$id = $_GET['id'] ?? '';
$name = $_POST['name'] ?? '';
$fa = $_POST['fa'] ?? '';
$social_link = $_POST['social_link'] ?? '';
if ($id && $name && $fa && $social_link) {
    $stmt = $con->prepare("UPDATE social SET name = ?, fa = ?, social_link = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $fa, $social_link, $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Record updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update record"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$con->close();
?>
