<?php
// Establishing connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from the URL parameter
$id = $_GET['id'];

// Delete user information
$sql_delete = "DELETE FROM patient_info WHERE id_number = $id";
if ($conn->query($sql_delete) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $sql_delete . "<br>" . $conn->error;
}

$conn->close();
?>
