<?php
require '../../z_db.php';
include "../Config.php";
if($_SERVER['REQUEST_METHOD']=='GET')
{
  $stmt=$con->prepare('SELECT * FROM faqs');
  $stmt->execute();
  $result=$stmt->get_result();
  $data=$result->fetch_all(MYSQLI_ASSOC);
  echo json_encode($data);
}
else
{
    echo "invalid method";
}
?>