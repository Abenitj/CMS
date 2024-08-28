<?php
// create.php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    if (isset($_POST['port_title'], $_POST['port_desc'], $_POST['port_detail'], $_POST['destination_id'])) {
        $port_title = htmlspecialchars(trim($_POST['port_title']), ENT_QUOTES, 'UTF-8');
        $port_desc = htmlspecialchars(trim($_POST['port_desc']), ENT_QUOTES, 'UTF-8');
        $port_detail = htmlspecialchars(trim($_POST['port_detail']), ENT_QUOTES, 'UTF-8');
        $destination_id = intval($_POST['destination_id']);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input data."]);
        exit;
    }

    // Handle file upload
    if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['ufile']['tmp_name'];
        $file_name = basename($_FILES['ufile']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

        // Validate file extension
        if (!in_array($file_ext, $allowed_ext)) {
            echo json_encode(["success" => false, "message" => "Invalid file type. Allowed types: jpg, jpeg, png, gif, pdf."]);
            exit;
        }

        $directory = '../../uploads/portfolio/';
        
        // Ensure the upload directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Ensure the file name is unique
        $file_path = $directory . uniqid() . '_' . $file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            // Prepare SQL statement
            $stmt = $con->prepare("INSERT INTO portfolio (port_title, port_desc, port_detail, ufile, destination_id) VALUES (?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssssi", $port_title, $port_desc, $port_detail, $file_path, $destination_id);

                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "Record added successfully."]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error executing query: " . $stmt->error]);
                }

                $stmt->close();
            } else {
                echo json_encode(["success" => false, "message" => "Error preparing statement: " . $con->error]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "File upload failed."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "No file uploaded or error occurred."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$con->close();
?>
