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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the drug name and strength from the form submission
    $drugName = $_POST["drugName"];
    $strength = $_POST["strength"];

    // Prepare and execute the SQL statement to add the new drug
    $stmt = $conn->prepare("INSERT INTO drugs (drug_name, strength) VALUES (?, ?)");
    $stmt->bind_param("ss", $drugName, $strength);
    if ($stmt->execute()) {
        // Drug added successfully, redirect back to the pharmacist page
        header("Location: pharmacist.php");
        exit();
    } else {
        // Handle drug addition failure (you can display an error message or take appropriate action)
        echo "Failed to add the drug.";
    }
}

// Close the database connection
$conn->close();
?>
