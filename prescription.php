<?php
// Include your database connection code here (assuming you have a file named db_connection.php)
include 'connection.php';

// Function to prescribe a drug to a patient
function prescribeDrug($conn, $doctorId, $patientId, $drugName, $frequency) {
    $sql = "INSERT INTO prescriptions (doctor_id, patient_id, drug_name, frequency) VALUES (:doctorId, :patientId, :drugName, :frequency)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':doctorId', $doctorId);
    $stmt->bindValue(':patientId', $patientId);
    $stmt->bindValue(':drugName', $drugName);
    $stmt->bindValue(':frequency', $frequency);
    $stmt->execute();
}

// Process the prescription form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["patient_id"]) && isset($_POST["drug_name"]) && isset($_POST["frequency"])) {
        $patientId = $_POST["patient_id"];
        $drugName = $_POST["drug_name"];
        $frequency = $_POST["frequency"];
        $doctorId = $_SESSION["user_id"]; // Assuming you have a column 'user_id' in your 'users' table

        // Call the function to prescribe the drug
        prescribeDrug($conn, $doctorId, $patientId, $drugName, $frequency);
    }
}
?>
