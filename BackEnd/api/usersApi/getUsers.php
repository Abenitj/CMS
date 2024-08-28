<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   
$stmt=$con->prepare("SELECT *FROM users");
//geting the result 
$stmt->execute();
$result=$stmt->get_result();
//convert it to assiciative array
$userData=$result->fetch_all(MYSQLI_ASSOC);
if($userData)
{
    echo json_encode($userData);
}
else
{
    echo json_encode(["error"=>"no user found"]);
}
}
?>
