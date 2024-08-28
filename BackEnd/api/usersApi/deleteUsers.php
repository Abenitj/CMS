<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $con->real_escape_string($_GET['id']);

    $sql = "DELETE FROM users WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        echo json_encode(['message' => 'User deleted successfully']);
    } else {
        echo json_encode(['error' => 'Error: ' . $sql . '<br>' . $con->error]);
    }
}
?>
