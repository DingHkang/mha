<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // If not, redirect to login page
    header('Location: login.php');
    exit();  // Stop further script execution
}
header('Content-Type: application/json');
include('../db.php');  // Make sure the path is correct

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user_id'];  // Assuming the user is logged in and user_id is set in session

$date = $data['date'];
$rating = $data['rating'];

$query = "INSERT INTO moods (user_id, date, rating) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("isi", $user_id, $date, $rating);
$success = $stmt->execute();

echo json_encode(['success' => $success]);

$stmt->close();
$conn->close();
?>
