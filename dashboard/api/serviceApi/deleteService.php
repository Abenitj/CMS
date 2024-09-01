<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];

    // Check if the service ID exists
    $stmt = $con->prepare("SELECT ufile FROM service WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['error' => 'ID does not exist']);
    } else {
        $row = $result->fetch_assoc();
        $file_name = $row['ufile'];
        $stmt->close();

        // Delete the service
        $stmt = $con->prepare("DELETE FROM service WHERE id=?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            // Delete the file from the server
            $upload_dir = '../../uploads/services/';
            $file_path = $upload_dir . $file_name;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            echo json_encode(['message' => 'Service deleted successfully']);
        } else {
            echo json_encode(['error' => 'Error: ' . $stmt->error]);
        }

        $stmt->close();
    }
}
?>
