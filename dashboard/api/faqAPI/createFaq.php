<?php
require '../../z_db.php';
include "../Config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    if (isset($_POST['question']) && isset($_POST['answer'])) {
        $question = trim($_POST['question']);
        $answer = trim($_POST['answer']);

        // Further sanitize the input
        $question = htmlspecialchars($question, ENT_QUOTES, 'UTF-8');
        $answer = htmlspecialchars($answer, ENT_QUOTES, 'UTF-8');

        $created_at = date('Y-m-d H:i:s');

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO faqs (question, answer, created_at) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $question, $answer, $created_at);

            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error executing query: " . $stmt->error;
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
