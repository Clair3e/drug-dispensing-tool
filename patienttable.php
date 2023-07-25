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

// Pagination variables
$limit = 10; // Number of records to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit; // Starting index for records

// Retrieve total number of records
$sql_count = "SELECT COUNT(*) as total FROM patient_info";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_records = $row_count['total'];

// Calculate total number of pages
$total_pages = ceil($total_records / $limit);

// Retrieve records for the current page
$sql = "SELECT * FROM patient_info LIMIT $start, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Patient Details</h1>
    
    <!-- Display table -->
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Id Number</th>
            <th>sex</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name']  . "</td>";
                echo  "<td>" . $row['id_number']  . "</td>";
                echo "<td>" . $row['sex'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone_number'] . "</td>";
                echo "<td>";
                echo "<a href='edit.php?id=" . $row['id_number'] . "'>Edit</a> | ";
                echo "<a href='delete.php?id=" . $row['id_number'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
    </table>

    <!-- Pagination -->
    <ul class="pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li><a href='?page=$i'>$i</a></li>";
        }
        ?>
    </ul>

</body>
</html>

<?php
$conn->close();
?>
