<?php

use LDAP\Result;

require '../../z_db.php';
include('../Config.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $con->prepare("SELECT * FROM service");
    $stmt->execute();
    $result =$stmt->get_result();
    $data=$result->fetch_all(MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No service found']);
    }

    $stmt->close();
}
?>
