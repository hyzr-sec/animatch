<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");
$id = $_POST['animal_id'];

$conn = new mysqli("db", "admin", "adminadmin", "animatch");
$stmt = $conn->prepare("INSERT INTO adoptions (user_email, animal_id, ) VALUES (?, ?)");
$stmt->bind_param("si", $_SESSION['user'], $id);
$stmt->execute();
$stmt->close();
$conn->close();
header("Location: dashboard.php");
exit;
?>