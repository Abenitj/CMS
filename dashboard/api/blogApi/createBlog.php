<?php
require '../../z_db.php'; // Make sure this file sets up the $conn variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['blog_title'], $_POST['blog_detail'], $_POST['blog_desc'], $_FILES['ufile'])) {
        
        $blog_title = htmlspecialchars(trim($_POST['blog_title']));
        $blog_detail = htmlspecialchars(trim($_POST['blog_detail']));
        $blog_desc = htmlspecialchars(trim($_POST['blog_desc']));
        $file_name = $_FILES['ufile']['name'];
        // File upload directory
        $directory = "../../uploads/blog/";
        $target_file = $directory . basename($file_name);

        // Check if file is an actual image or fake image
        $check = getimagesize($_FILES['ufile']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }

        // Check file size (example: limit to 2MB)
        if ($_FILES['ufile']['size'] > 2000000) {
            echo "Sorry, your file is too large.";
            exit;
        }

        // Allow certain file formats
        $allowed_types = ['jpg', 'png', 'jpeg', 'gif'];
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($image_file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit;
        }
        // Try to upload file
        if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target_file)) {
            
            // Insert blog post into database
            $stmt = $con->prepare("INSERT INTO blog (blog_title, blog_detail, blog_desc, ufile) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $blog_title, $blog_detail, $blog_desc, $target_file);
            
            if ($stmt->execute()) {
                echo "Blog post successfully saved.";
            } else {
                echo "Error saving blog post.";
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

$con->close();
?>
