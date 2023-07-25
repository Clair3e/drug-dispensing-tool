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

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Get the drug ID from the URL parameters
    if (isset($_GET["id"])) {
        $drugId = $_GET["id"];

        // Fetch the drug details from the database
        $sql = "SELECT * FROM drugs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $drugId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            // Drug found, display the edit form
            $drug = $result->fetch_assoc();
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Edit Drug</title>
                <!-- Add your CSS styling here if needed -->
            </head>
            <body>
                <h2>Edit Drug</h2>
                <form method="post" action="update_drug.php">
                    <input type="hidden" name="id" value="<?php echo $drug['id']; ?>">
                    <label for="drugName">Drug Name:</label>
                    <input type="text" id="drugName" name="drugName" value="<?php echo $drug['drug_name']; ?>" required>
                    <br>
                    <label for="strength">Strength:</label>
                    <input type="text" id="strength" name="strength" value="<?php echo $drug['strength']; ?>" required>
                    <br>
                    <button type="submit">Update Drug</button>
                </form>
            </body>
            </html>
            <?php
        } else {
            // Drug not found, display an error message or redirect back to the pharmacist page
            echo "Drug not found.";
        }
    } else {
        // Invalid URL parameters, display an error message or redirect back to the pharmacist page
        echo "Invalid parameters.";
    }
}

// Close the database connection
$conn->close();
?>
