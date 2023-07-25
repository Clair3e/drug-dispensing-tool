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

// Retrieve user details
$sql = "SELECT * FROM patient_info WHERE id_number = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Update user information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $id_number = $_POST['id_number'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql_update = "UPDATE patient_info SET first_name = '$first_name', last_name = '$last_name', id_number = '$id_number', sex = '$sex' , email='$email',phone_number='$phone_number' WHERE id_number = '$id'";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient Details</title>
</head>
<body>
    <h1>Edit Patient Details</h1>
    <form method="post">
        <label for="first_name">first_name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required><br><br>
        
        <label for="last_name">last_name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required><br><br>

        <label for="id_number">last_name:</label>
        <input type="text" id="id_number" name="id_number" value="<?php echo $row['id_number']; ?>" required><br><br>
        

        
        <label for="sex">sex:</label>
        <select id="sex" name="sex" required>
            <option value="male" <?php if ($row['sex'] === 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($row['sex'] === 'female') echo 'selected'; ?>>Female</option>
            <option value="other" <?php if ($row['sex'] === 'other') echo 'selected'; ?>>Other</option>
        </select><br><br>
        
        <label for="email">email:</label>
        <textarea id="email" name="email" required><?php echo $row['email']; ?></textarea><br><br>

        <label for="phone_number">last_name:</label>
        <input type="number" id="phone_number" name="phone_number" value="<?php echo $row['phone_number']; ?>" required><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
$conn->close();
?>
