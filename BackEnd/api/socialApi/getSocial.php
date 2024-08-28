<?php
require '../../z_db.php';


$id = $_GET['id'] ?? '';

if ($id) {
    $stmt = $con->prepare("SELECT * FROM social WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    echo json_encode($data);

    $stmt->close();
} else {
    $result = $con->query("SELECT * FROM social");
    $data = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);
}

$con->close();
?>
