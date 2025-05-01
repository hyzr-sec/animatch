<?php
$host = "db";
$user = "admin";
$password = "adminadmin";
$database = "animatch";

$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>