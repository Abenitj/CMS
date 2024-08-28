<?php
require '../../z_db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_GET['id']);

    $stmt = $con->prepare("DELETE FROM faqs WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid request method.";
}
?>
