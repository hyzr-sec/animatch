<?php
require_once "db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Handle image upload
    $imagePath = 'assets/images/animals/default.jpeg';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imagePath = 'assets/images/animals/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $stmt = $conn->prepare("INSERT INTO animals (name, species, breed, age, gender, description, image_path, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissss", $name, $species, $breed, $age, $gender, $description, $imagePath, $status);
    $stmt->execute();
    header("Location: view_animals.php");
}
?>
