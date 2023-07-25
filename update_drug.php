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
    // Get the drug ID and updated details from the form submission
    $drugId = $_POST["id"];
    $drugName = $_POST["drugName"];
    $strength = $_POST["strength"];

    // Prepare and execute the SQL statement to update the drug details
    $stmt = $conn->prepare("UPDATE drugs SET drug_name = ?, strength = ? WHERE id = ?");
    $stmt->bind_param("ssi", $drugName, $strength, $drugId);
    if ($stmt->execute()) {
        // Drug updated successfully, redirect back to the pharmacist page
        header("Location: pharmacist.php");
        exit();
    } else {
        // Handle drug update failure (you can display an error message or take appropriate action)
        echo "Failed to update the drug.";
    }
}

// Close the database connection
$conn->close();
?>
