<?php
require_once("connection.php");

$sql="SELECT * FROM Patients";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
print_r($row);
?>