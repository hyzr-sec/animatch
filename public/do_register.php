<?php
require_once 'db.php';
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$description = $_POST['description'];
$social_status = $_POST['social_status'];
$target = "assets/uploads/profiles/" . basename($_FILES['profile_pic']['name']);

$password_hash = md5($password);

move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
$profile_pic = $target;

$sql = "INSERT INTO users (name, email, password, phone, address, description, social_status, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $name, $email, $password_hash, $phone, $address, $description, $social_status, $profile_pic);

if ($stmt->execute()) {
    header("Location: login.php");
} else {
    echo "Register failed: " . $conn->error;
}
$stmt->close();
$conn->close();
?>