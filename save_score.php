<?php
session_start();
include('db.php'); // Ensure the database connection is correctly set up

// Check if the request method is POST and the user is logged in
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $total_score = isset($_POST['total_score']) ? (int)$_POST['total_score'] : 0;
    $display_score = ($total_score / 40) * 100;
    $user_id = $_SESSION['user_id'];

    // Prepare to insert the score into the database
    $stmt = $conn->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $total_score);
    if ($stmt->execute()) {
        // If the score is saved successfully, log an achievement
        $achievement_name = "Record Health Scores Complete";
        $date_achieved = date('Y-m-d H:i:s'); // Current date and time
        $stmt_achievement = $conn->prepare("INSERT INTO achievements (user_id, achievement_name, date_achieved) VALUES (?, ?, ?)");
        $stmt_achievement->bind_param("iss", $user_id, $achievement_name, $date_achieved);
        if ($stmt_achievement->execute()) {
            echo "Score and achievement saved successfully.";
        } else {
            echo "Error saving achievement: " . $stmt_achievement->error;
        }
        $stmt_achievement->close();
    } else {
        echo "Error saving score: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Unauthorized access. Please log in.";
}

// Redirect user or provide a link to go back
header("Refresh: 5; url=score.php"); // Redirect after 5 seconds to score.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Score Saved</title>
</head>
<body>
    <p>Thank you for your submission. You will be redirected shortly, or <a href="score.php">click here</a> to return immediately.</p>
</body>
</html>
