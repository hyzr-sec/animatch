<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Fetch current image path
    $res = $conn->query("SELECT image_path FROM animals WHERE id = $id");
    $current = $res->fetch_assoc();
    $imagePath = $current['image_path'];

    // If new image uploaded, replace it
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imagePath = 'assets/images/animals/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $stmt = $conn->prepare("UPDATE animals SET name=?, species=?, breed=?, age=?, gender=?, description=?, image_path=?, status=? WHERE id=?");
    $stmt->bind_param("sssissssi", $name, $species, $breed, $age, $gender, $description, $imagePath, $status, $id);
    $stmt->execute();

    header("Location: voir_animaux.php");
    exit;
}
?>
