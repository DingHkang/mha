<?php
session_start();
include('db.php'); // Ensure the database connection file is correctly included

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit;  // Make sure that code doesn't keep running after redirect
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $notes = $_POST['notes'];

    // Prepare a statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO sleep_logs (user_id, date, duration, notes) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $user_id, $date, $duration, $notes);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // If the sleep log is saved successfully
        $_SESSION['message'] = "Sleep log saved successfully.";
    } else {
        // If saving failed
        $_SESSION['error'] = "Failed to save the sleep log.";
    }
    $stmt->close();
    $conn->close();

    // Redirect back to the sleep_improvement page with a message or error
    header("Location: sleep_improvement.php");
    exit;
}
?>
