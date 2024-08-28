<?php
// service.php
require '../../z_db.php';

header('Content-Type: application/json');

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Function to get all blogs
    function getAllBlogs($con) {
        $stmt = $con->prepare('SELECT * FROM blog');
        $stmt->execute();
        $result = $stmt->get_result();
        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
        echo json_encode($blogs);
        $stmt->close();
    }

    // Function to get a specific blog by id
    function getBlogById($con, $id) {
        $stmt = $con->prepare('SELECT * FROM blogs WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $blog = $result->fetch_assoc();
        if ($blog) {
            echo json_encode($blog);
        } else {
            echo json_encode(['error' => 'Blog not found']);
        }
        $stmt->close();
    }

    // Check if an id is provided
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        getBlogById($con, $id);
    } else {
        getAllBlogs($con);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

$con->close();
?>
