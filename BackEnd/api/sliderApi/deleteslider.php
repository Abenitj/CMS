<?php
// delete.php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $stmt=$con->prepare('select ufile from slider where id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $fileName=$result->fetch_assoc();
      if(file_exists($fileName['ufile']))
      {
        unlink($fileName ['ufile']);
      }
    $stmt = $con->prepare("DELETE FROM slider WHERE id=?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Slide deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting slide: " . $stmt->error]);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
