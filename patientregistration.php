<?php
require_once("connection.php");
// Establishing connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving the patient details from the form
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$id_number=$_POST['id_number'];
$sex=$_POST['sex'];
$email=$_POST['email'];
$phone_number=$_POST['phone_number'];

// Inserting the patient details into the database
$sql = "INSERT INTO patient_info(first_name,last_name,id_number,sex,email,phone_number) VALUES ('$first_name', '$last_name', '$id_number', '$sex', '$email', '$phone_number')";

if ($conn->query($sql) === TRUE) {
    echo "Patient details inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
