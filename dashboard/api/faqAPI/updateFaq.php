<?php
require '../../z_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize the ID
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);
    } else {
        echo "Invalid ID.";
        exit;
    }

    // Validate and sanitize inputs
    if (isset($_POST['question']) && isset($_POST['answer'])) {
        $question = trim($_POST['question']);
        $answer = trim($_POST['answer']);

        // Further sanitize the inputs
        $question = htmlspecialchars($question, ENT_QUOTES, 'UTF-8');
        $answer = htmlspecialchars($answer, ENT_QUOTES, 'UTF-8');

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $con->prepare("UPDATE faqs SET question=?, answer=? WHERE id=?");
        if ($stmt) {
            $stmt->bind_param("ssi", $question, $answer, $id);

            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $con->error;
        }
        
        $con->close();
    } else {
        echo "Invalid input: Both question and answer are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
