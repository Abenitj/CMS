<?php
require '../../z_db.php'; // Ensure this file sets up the $con variable
include "../Config.php";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required POST parameters are set and ID is provided
    if (isset($_POST['blog_title'], $_POST['blog_detail'], $_POST['blog_desc']) && isset($_GET['id'])) {
        
        // Retrieve and sanitize inputs
        $id = intval($_GET['id']); // Ensure ID is an integer
        $blog_title = htmlspecialchars(trim($_POST['blog_title']));
        $blog_detail = htmlspecialchars(trim($_POST['blog_detail']));
        $blog_desc = htmlspecialchars(trim($_POST['blog_desc']));

        // Check if ID is valid
        if ($id <= 0) {
            echo json_encode(["status" => "error", "message" => "Invalid ID"]);
            exit();
        }

        // Handle file upload
        $upload_dir = '../../uploads/blog/'; // Directory where files will be uploaded
        $file_path_for_db = ''; // Default value if no file is uploaded

        if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['ufile']['tmp_name'];
            $file_name = basename($_FILES['ufile']['name']);
            $upload_file = $upload_dir . $file_name;

            // Validate and move the uploaded file
            if (move_uploaded_file($tmp_name, $upload_file)) {
                $file_path_for_db = 'blog/' . $file_name; // Relative path for database
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to upload image"]);
                exit();
            }
        }

        // Prepare and execute the SQL update query
        $stmt = $con->prepare("UPDATE blog SET blog_title = ?, blog_desc = ?, blog_detail = ?, ufile = ? WHERE id = ?");
        if ($stmt) {
            // Bind parameters, with the file path being optional (if no file was uploaded, it remains unchanged)
            $stmt->bind_param("ssssi", $blog_title, $blog_desc, $blog_detail, $file_path_for_db, $id);
            $result = $stmt->execute();

            if ($result) {
                echo json_encode(["status" => "success", "message" => "Blog post updated successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error updating blog post: " . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to prepare SQL statement"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required parameters"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

// Close the database connection
$con->close();
?>
