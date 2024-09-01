<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $con->real_escape_string($_GET['id']);
    $stmt=$con->prepare('select ufile from testimony where id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $fileName=$result->fetch_assoc();
      if(file_exists($fileName['ufile']))
      {
        unlink($fileName ['ufile']);
      }
    
    $sql = "DELETE FROM testimony WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        echo json_encode(['message' => 'Testimony deleted successfully']);
    } else {
        echo json_encode(['error' => 'Error: ' . $sql . '<br>' . $con->error]);
    }
}
?>
