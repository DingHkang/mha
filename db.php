<?php
// Establish MySQL connection (Replace these values with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mha";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>