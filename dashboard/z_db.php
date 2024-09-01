<?php
$con = new mysqli("localhost", "root", "", "cms");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

//Your Website URL Goes Here
$url="http://localhost/sentic";


//Set Blog Activation Bonus Here (It must be only Number)
$blog_bonus ="10";
//Set Article Activation Bonus Here (It must be only Number)
$art_bonus="10";
//Set Daily Login Bonus Here (It must be only Number)
$login_bonus="10";
//Set Currency Symbol for daily login bonus Here
$money="$";
?>
