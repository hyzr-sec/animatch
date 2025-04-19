<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$description = $_POST['description'];
$social_status = $_POST['social_status'];

$target = "assets/uploads/profiles/" . basename($_FILES['profile_pic']['name']);
move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
$profile_pic = $target;

$conn = new mysqli("db", "admin", "adminadmin", "animatch");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "INSERT INTO users (name, email, password, phone, address, description, social_status, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $name, $email, $password, $phone, $address, $description, $social_status, $profile_pic);

if ($stmt->execute()) {
    header("Location: login.php");
} else {
    echo "Register failed: " . $conn->error;
}
$stmt->close();
$conn->close();
?>