<?php
$host = "db";
$user = "admin";
$password = "adminadmin";
$database = "animatch";

$conn = new mysqli($host, $user, $password, $database);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
