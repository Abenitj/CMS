<?php
// update.php
require '../../z_db.php';
include "../Config.php";

// Define the upload directory
$uploadDir = '../../uploads/slider/';

// Allowed image MIME types
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];

    // Sanitize input
    $slide_title = htmlspecialchars($_POST['slide_title'], ENT_QUOTES, 'UTF-8');
    $slide_text = htmlspecialchars($_POST['slide_text'], ENT_QUOTES, 'UTF-8');
    
    // Retrieve the current file name from the database
    $stmt = $con->prepare("SELECT ufile FROM slider WHERE id=?");
    if (!$stmt) {
        echo json_encode(["message" => "Error preparing statement: " . $con->error]);
        exit();
    }
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        echo json_encode(["message" => "Error executing statement: " . $stmt->error]);
        exit();
    }
    $stmt->bind_result($currentFile);
    $stmt->fetch();
    $stmt->close();

    // Debugging: Check the current file
    error_log("Current file: " . $currentFile);

    // Check if a new file was uploaded
    if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['ufile']['tmp_name'];
        $fileName = $_FILES['ufile']['name'];
        $fileType = $_FILES['ufile']['type'];

        // Validate the file type
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(["message" => "Invalid file type. Allowed types are: " . implode(', ', $allowedTypes)]);
            exit();
        }

        // Generate a new file name and move the file to the upload directory
        $destPath = $uploadDir . basename($fileName);
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $file_path_for_db = "slider/" . basename($fileName);

            // Debugging: Check if the new file was moved
            error_log("New file moved to: " . $destPath);

            // Delete the old file from the server
            $oldFilePath = $uploadDir . $currentFile;
            if ($currentFile && file_exists($oldFilePath)) {
                if (unlink($oldFilePath)) {
                    error_log("Old file deleted: " . $oldFilePath);
                } else {
                    error_log("Error deleting old file: " . $oldFilePath);
                }
            } else {
                error_log("Old file does not exist: " . $oldFilePath);
            }
        } else {
            echo json_encode(["message" => "Error moving the uploaded file"]);
            exit();
        }
    } else {
        // If no new file is uploaded, keep the existing file name
        $file_path_for_db = htmlspecialchars($_POST['existing_ufile'], ENT_QUOTES, 'UTF-8');
    }

    // Update the slide in the database
    $stmt = $con->prepare("UPDATE slider SET slide_title=?, slide_text=?, ufile=?, updated_at=NOW() WHERE id=?");
    if (!$stmt) {
        echo json_encode(["message" => "Error preparing statement: " . $con->error]);
        exit();
    }
    $stmt->bind_param('sssi', $slide_title, $slide_text, $file_path_for_db, $id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Slide updated successfully"]);
    } else {
        echo json_encode(["message" => "Error updating slide: " . $stmt->error]);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
