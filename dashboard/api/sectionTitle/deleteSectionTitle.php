<?php
// delete.php
require '../../z_db.php';
include "../Config.php";
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Validate and sanitize input
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id) {
        $sql = "DELETE FROM section_title WHERE id=$id";

        if ($con->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "ID is required.";
    }
}

$con->close();
?>
