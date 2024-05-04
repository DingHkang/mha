<?php
session_start();
include('db.php');  // Make sure this path is correct

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $stmt = $conn->prepare("SELECT user_id, password, is_active FROM users WHERE email = ?");
        if (false === $stmt) {
            throw new Exception('Prepare error: ' . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            if ($user['is_active'] != 1) {
                echo "Your account is not active. Please contact support.";
                exit();
            }

            if (password_verify($pass, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No user found with that email.";
        }
        $stmt->close();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
