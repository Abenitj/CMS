<?php
// create.php
require '../../z_db.php';
include "../Config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $about_title = trim($_POST['about_title']);
    $about_text = trim($_POST['about_text']);
    $why_title = trim($_POST['why_title']);
    $why_text = trim($_POST['why_text']);
    $service_title = trim($_POST['service_title']);
    $service_text = trim($_POST['service_text']);
    $port_title = trim($_POST['port_title']);
    $port_text = trim($_POST['port_text']);
    $test_title = trim($_POST['test_title']);
    $test_text = trim($_POST['test_text']);
    $contact_title = trim($_POST['contact_title']);
    $contact_text = trim($_POST['contact_text']);
    $enquiry_title = trim($_POST['enquiry_title']);
    $enquiry_text = trim($_POST['enquiry_text']);

    // Prepare SQL statement
    $stmt = $con->prepare("INSERT INTO section_title 
        (about_title, about_text, why_title, why_text, service_title, service_text, port_title, port_text, test_title, test_text, contact_title, contact_text, enquiry_title, enquiry_text) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssssssssssss", 
        $about_title, $about_text, $why_title, $why_text, 
        $service_title, $service_text, $port_title, $port_text, 
        $test_title, $test_text, $contact_title, $contact_text, 
        $enquiry_title, $enquiry_text
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

$con->close();
?>
