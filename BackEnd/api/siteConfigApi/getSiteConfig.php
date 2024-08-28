<?php
// read.php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM siteconfig";
    $result = $con->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
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
