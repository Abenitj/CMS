<?php
// update.php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $about_title = $con->real_escape_string(trim($_POST['about_title']));
    $about_text = $con->real_escape_string(trim($_POST['about_text']));
    $why_title = $con->real_escape_string(trim($_POST['why_title']));
    $why_text = $con->real_escape_string(trim($_POST['why_text']));
    $service_title = $con->real_escape_string(trim($_POST['service_title']));
    $service_text = $con->real_escape_string(trim($_POST['service_text']));
    $port_title = $con->real_escape_string(trim($_POST['port_title']));
    $port_text = $con->real_escape_string(trim($_POST['port_text']));
    $test_title = $con->real_escape_string(trim($_POST['test_title']));
    $test_text = $con->real_escape_string(trim($_POST['test_text']));
    $contact_title = $con->real_escape_string(trim($_POST['contact_title']));
    $contact_text = $con->real_escape_string(trim($_POST['contact_text']));
    $enquiry_title = $con->real_escape_string(trim($_POST['enquiry_title']));
    $enquiry_text = $con->real_escape_string(trim($_POST['enquiry_text']));

    if ($id && $about_title && $about_text && $why_title && $why_text && $service_title && $service_text && $port_title && $port_text && $test_title && $test_text && $contact_title && $contact_text && $enquiry_title && $enquiry_text) {
        $sql = "UPDATE section_title SET 
                about_title='$about_title', 
                about_text='$about_text', 
                why_title='$why_title', 
                why_text='$why_text', 
                service_title='$service_title', 
                service_text='$service_text', 
                port_title='$port_title', 
                port_text='$port_text', 
                test_title='$test_title', 
                test_text='$test_text', 
                contact_title='$contact_title', 
                contact_text='$contact_text', 
                enquiry_title='$enquiry_title', 
                enquiry_text='$enquiry_text' 
                WHERE id=$id";

        if ($con->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "All fields are required.";
    }
}

$con->close();
?>
