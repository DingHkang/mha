<?php
session_start(); // Start the session
header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

include('../db.php'); // Adjust the path as necessary to reach your database connection script

// Prepare a statement to safely fetch logs for the logged-in user
$query = "SELECT date, duration, notes FROM sleep_logs WHERE user_id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(['error' => $conn->error]);
    exit;
}

$user_id = $_SESSION['user_id']; // Fetching the user id from session
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo json_encode(['message' => 'No data found']);
    exit;
}
$data = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);

$stmt->close();
$conn->close();
?>
