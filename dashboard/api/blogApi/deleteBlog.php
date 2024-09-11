<?php
require '../../z_db.php'; // Ensure this file sets up the $con variable
include "../Config.php";
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Check if the ID is set in the URL
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Ensure ID is an integer
        // Check if ID is valid
        if ($id <= 0) {
            echo json_encode(["status" => "error", "message" => "Invalid ID"]);
            exit();
        }
        // Retrieve the current image path from the database
        $stmt = $con->prepare("SELECT ufile FROM blog WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($current_image_path);
            $stmt->fetch();
            $stmt->close();

            // If the file exists, delete it from the server
            if ($current_image_path && file_exists($current_image_path)) {
                if (unlink($current_image_path)) {
                    // Proceed with deleting the record from the database
                    $stmt = $con->prepare("DELETE FROM blog WHERE id = ?");
                    if ($stmt) {
                        $stmt->bind_param("i", $id);
                        $result = $stmt->execute();

                        if ($result) {
                            echo json_encode(["status" => "success", "message" => "Blog post and image deleted successfully"]);
                        } else {
                            echo json_encode(["status" => "error", "message" => "Error deleting blog post: " . $stmt->error]);
                        }

                        $stmt->close();
                    } else {
                        echo json_encode(["status" => "error", "message" => "Failed to prepare SQL statement"]);
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to delete image file"]);
                }
            } else {
                // Proceed with deleting the record if no file was found
                $stmt = $con->prepare("DELETE FROM blog WHERE id = ?");
                if ($stmt) {
                    $stmt->bind_param("i", $id);
                    $result = $stmt->execute();

                    if ($result) {
                        echo json_encode(["status" => "success", "message" => "Blog post deleted successfully"]);
                    } else {
                        echo json_encode(["status" => "error", "message" => "Error deleting blog post: " . $stmt->error]);
                    }

                    $stmt->close();
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to prepare SQL statement"]);
                }
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to prepare SQL statement"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "ID parameter missing from URL"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

// Close the database connection
$con->close();
?>
