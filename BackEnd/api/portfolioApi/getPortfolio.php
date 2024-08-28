<?php
// read.php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Prepare SQL statement to fetch all records
    $stmt = $con->prepare("SELECT * FROM portfolio");

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
}
$con->close();
?>
