<?php
// read.php
require '../../z_db.php';
include "../Config.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM slider";
    $result = $con->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Sanitize output to prevent XSS attacks
            $row['slide_title'] = htmlspecialchars($row['slide_title'], ENT_QUOTES, 'UTF-8');
            $row['slide_text'] = htmlspecialchars($row['slide_text'], ENT_QUOTES, 'UTF-8');
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode([]);
    }

    $con->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
