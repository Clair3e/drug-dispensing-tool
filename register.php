<?php
// Database connection configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "pharmacydb";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check for any connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the submitted username, password, user type, and user ID
$username = $_POST["username"];
$password = $_POST["password"];
$type = $_POST["type"];
$id = $_POST["id"];

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement to insert user details into the database
$stmt = $conn->prepare("INSERT INTO users (username, password, type, id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $hashedPassword, $type, $id);

// Execute the statement and check for any errors
if ($stmt->execute() === TRUE) {
    echo "User registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
