<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = md5($password);

$conn = new mysqli("db", "admin", "adminadmin", "animatch");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT * FROM users WHERE email=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password_hash);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['user'] = $email;
    header("Location: dashboard.php");
} else {
    echo "Login failed";
}
$stmt->close();
$conn->close();
?>