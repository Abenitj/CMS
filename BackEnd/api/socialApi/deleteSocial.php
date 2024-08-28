<?php
require '../../z_db.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $stmt = $con->prepare("DELETE FROM social WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Record deleted successfully"]);
    } else {
        echo json_encode(["error" => "Failed to delete record"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid input"]);
}

$con->close();
?>
