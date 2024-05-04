<?php
session_start();
include('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Check if username or email already exists
    $userCheck = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $userCheck->bind_param("ss", $username, $email);
    $userCheck->execute();
    $result = $userCheck->get_result();
    if ($result->num_rows > 0) {
        die("Username or email already exists.");
    }

    // Hash password and insert new user into database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        $_SESSION['username'] = $username; // Store username in session
        $_SESSION['user_id'] = $user_id;
        header("Location: login.php"); // Redirect to home page after successful registration
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
