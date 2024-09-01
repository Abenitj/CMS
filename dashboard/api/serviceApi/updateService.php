<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $service_title = $_POST['service_title'];
    $service_desc = $_POST['service_desc'];
    $service_detail = $_POST['service_detail'];

    // Handle file upload
    $upload_dir = '../../uploads/services/';
    $file_name = basename($_FILES['ufile']['name']);
    $target_file = $upload_dir . $file_name;

    $stmt=$con->prepare("SELECT ufile from service where id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data=$result->fetch_assoc();
    if(file_exists($data['ufile']))
   {
    unlink($data['ufile']);
   }

    if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target_file)) {
        $ufile = $file_name;
        $stmt = $con->prepare("UPDATE service SET service_title=?, service_desc=?, service_detail=?, ufile=? WHERE id=?");
        $stmt->bind_param('ssssi', $service_title, $service_desc, $service_detail, $target_file, $id);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Service updated successfully']);
        } else {
            echo json_encode(['error' => 'Error: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to upload file']);
    }
}
?>
