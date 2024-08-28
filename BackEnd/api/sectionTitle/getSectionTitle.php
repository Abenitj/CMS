<?php
// read.php
require '../../z_db.php';

$sql = "SELECT * FROM section_title";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo "No records found";
}

$con->close();
?>
