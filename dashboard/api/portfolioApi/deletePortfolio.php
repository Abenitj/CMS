<?php

require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_GET['id']);

    // Fetch the file path before deleting the record
    $stmt = $con->prepare("SELECT ufile FROM portfolio WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $file_path = $data['ufile'];
    $stmt->close();

    // Check if the file exists and delete it
    if (file_exists($file_path)) {
        if (unlink($file_path)) {
            // File deleted successfully
        } else {
            echo json_encode(["success" => false, "message" => "Error: Could not delete file from server."]);
            $con->close();
            exit;
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error: File does not exist."]);
        $con->close();
        exit;
    }

    // Delete the record from the database
    $stmt = $con->prepare("DELETE FROM portfolio WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Record and file deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
}

$con->close();
?>
