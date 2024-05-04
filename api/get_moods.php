<?php
session_start();
header('Content-Type: application/json');
include('../db.php');  // Adjust path as needed

$user_id = $_SESSION['user_id'];

$query = "SELECT date, rating FROM moods WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$moods = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($moods);

$stmt->close();
$conn->close();
?>
