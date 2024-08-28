<?php
// update.php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];

    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        echo json_encode(["message" => "Invalid ID"]);
        exit();
    }

    $site_keyword = htmlspecialchars(trim($_POST['site_keyword']));
    $site_desc = htmlspecialchars(trim($_POST['site_desc']));
    $site_title = htmlspecialchars(trim($_POST['site_title']));
    $site_about = htmlspecialchars(trim($_POST['site_about']));
    $site_footer = htmlspecialchars(trim($_POST['site_footer']));
    $follow_text = htmlspecialchars(trim($_POST['follow_text']));
    $site_url = filter_var($_POST['site_url'], FILTER_VALIDATE_URL);
    $updated_at = htmlspecialchars(trim($_POST['updated_at']));

    $stmt = $con->prepare("UPDATE siteconfig 
                           SET site_keyword=?, site_desc=?, site_title=?, site_about=?, site_footer=?, follow_text=?, site_url=?, updated_at=? 
                           WHERE id=?");
                           
    $stmt->bind_param('ssssssssi', $site_keyword, $site_desc, $site_title, $site_about, $site_footer, $follow_text, $site_url, $updated_at, $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Record updated successfully"]);
    } else {
        echo json_encode(["message" => "Error updating record: " . $stmt->error]);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
