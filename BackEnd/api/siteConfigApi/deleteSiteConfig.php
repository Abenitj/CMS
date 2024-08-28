<?php
// delete.php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];

    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        echo json_encode(["message" => "Invalid ID"]);
        exit();
    }

    $stmt = $con->prepare("DELETE FROM siteconfig WHERE id=?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Record deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting record: " . $stmt->error]);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
