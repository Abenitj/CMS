<?php
require '../../z_db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $ufile = $_FILES['ufile']['name'];
    $temp_name = $_FILES['ufile']['tmp_name'];
    $directory = "../../uploads/testimony/";

    $file_path = $directory . basename($ufile);
    
        if (move_uploaded_file($temp_name, $file_path)) {
            // Prepare the SQL statement
            $file_path_for_db = 'testimony/'.basename($_FILES['ufile']['name']);
            $stmt = $con->prepare("INSERT INTO testimony (name, message, position, ufile) VALUES (?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssss", $name, $message, $position, $file_path_for_db);
                if ($stmt->execute()) {
                    echo "Testimony successfully added!";
                } else {
                    echo "Error executing query: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $con->error;
            }
        } else {
            echo "File upload failed.";
        }
    }
 else {
    echo "Invalid request method.";
}
?>
