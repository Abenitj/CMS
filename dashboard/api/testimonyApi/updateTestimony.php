<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and validate inputs
    $id = $_GET['id'];
    $name = $_POST['name'];
    $message = $_POST['message'];
    $position = $_POST['position'];

    if ($id === false) {
        echo json_encode(['error' => 'Invalid ID']);
        exit;
    }

    // Handle file upload
    $upload_dir = '../../uploads/testimony/';
    
    if (!is_dir($upload_dir)) {
        echo json_encode(['error' => 'Upload directory does not exist']);
        exit;
    }

    if ($_FILES['ufile']['error'] === UPLOAD_ERR_OK) {
        $file_name = basename($_FILES['ufile']['name']);
        $target_file = $upload_dir . $file_name;


        if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target_file)) {
            // Handle file deletion from server
            $file_path_for_db = 'testimony/'.basename($_FILES['ufile']['name']);
            $stmt = $con->prepare('SELECT ufile FROM testimony WHERE id = ?');
            if ($stmt === false) {
                error_log('Prepare failed: ' . $con->error);
                echo json_encode(['error' => 'Database prepare failed']);
                exit;
            }

            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($oldFilePath);
            $stmt->fetch();
            $stmt->close();

            // Delete the old file if it exists
            if (!empty($oldFilePath) && file_exists($oldFilePath)) {
                if (!unlink($oldFilePath)) {
                    error_log('Failed to delete old file: ' . $oldFilePath);
                }
            }

            // Update the testimony
            $stmt = $con->prepare("UPDATE testimony SET message = ?, name = ?, position = ?, ufile = ? WHERE id = ?");
            if ($stmt === false) {
                error_log('Prepare failed: ' . $con->error);
                echo json_encode(['error' => 'Database prepare failed']);
                exit;
            }

            $stmt->bind_param('ssssi', $message, $name, $position, $file_path_for_db, $id);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Testimony updated successfully']);
            } else {
                error_log('Execute failed: ' . $stmt->error);
                echo json_encode(['error' => 'Database execute failed']);
            }

            $stmt->close();
        } else {
            echo json_encode(['error' => 'Failed to upload file']);
        }
    } else {
        echo json_encode(['error' => 'File upload error: ' . $_FILES['ufile']['error']]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>