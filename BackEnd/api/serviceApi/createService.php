<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_title = $_POST['service_title'];
    $service_desc = $_POST['service_desc'];
    $service_detail = $_POST['service_detail'];

    // Handle file upload
    $upload_dir = '../../uploads/services/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_name = basename($_FILES['ufile']['name']);
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target_file)) {
        $stmt = $con->prepare("INSERT INTO service (service_title, service_desc, service_detail, ufile) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $service_title, $service_desc, $service_detail, $target_file);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Service created successfully']);
        } else {
            echo json_encode(['error' => 'Error: ' . $stmt->error]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to upload file']);
    }
}
?>
