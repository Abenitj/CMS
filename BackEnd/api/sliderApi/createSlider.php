<?php
// create.php
require '../../z_db.php';
// Define the upload directory
$uploadDir = '../../uploads/slider/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded
    if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['ufile']['tmp_name'];
        $fileName = $_FILES['ufile']['name'];
        // Generate a new file name and move the file to the upload directory   
        $destPath = $uploadDir . $fileName;
        if (move_uploaded_file($fileTmpPath, $destPath)) {
             
        } else {
            echo json_encode(["message" => "Error moving the uploaded file"]);
            exit();
        }
    } else {
        echo json_encode(["message" => "No file uploaded or error uploading file"]);
        exit();
    }

    $slide_title = htmlspecialchars($_POST['slide_title'], ENT_QUOTES, 'UTF-8');
    $slide_text = htmlspecialchars($_POST['slide_text'], ENT_QUOTES, 'UTF-8');

    $stmt = $con->prepare("INSERT INTO slider (slide_title, slide_text, ufile) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $slide_title, $slide_text, $destPath);

    if ($stmt->execute()) {
        echo json_encode(["message" => "New slide created successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
