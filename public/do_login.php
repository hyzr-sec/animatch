<?php
session_start();
require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Check user
$stmt = $conn->prepare("SELECT id, name, email, phone, address, social_status, profile_pic, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['address'] = $user['address'];
        $_SESSION['social_status'] = $user['social_status'];
        $_SESSION['profile_pic'] = $user['profile_pic'];

        header("Location: dashboard.php");
        exit;
    } else {
        echo "Wrong password.";
    }
} else {
    echo "User not found.";
}
?>
