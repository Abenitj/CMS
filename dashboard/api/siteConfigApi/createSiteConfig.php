<?php
// create.php
require '../../z_db.php';
include "../Config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_keyword = htmlspecialchars(trim($_POST['site_keyword']));
    $site_desc = htmlspecialchars(trim($_POST['site_desc']));
    $site_title = htmlspecialchars(trim($_POST['site_title']));
    $site_about = htmlspecialchars(trim($_POST['site_about']));
    $site_footer = htmlspecialchars(trim($_POST['site_footer']));
    $follow_text = htmlspecialchars(trim($_POST['follow_text']));
    $site_url = filter_var($_POST['site_url'], FILTER_VALIDATE_URL);
    $stmt = $con->prepare("INSERT INTO siteconfig (site_keyword, site_desc, site_title, site_about, site_footer, follow_text, site_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssss', $site_keyword, $site_desc, $site_title, $site_about, $site_footer, $follow_text, $site_url);

    if ($stmt->execute()) {
        echo json_encode(["message" => "New record created successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
