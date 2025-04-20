<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Redirect to the login page if not authorized
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Ajouter un Animal</title>
  <link rel="stylesheet" href="assets/css/add_animal.css">
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
</head>
<body>
  <h1>Ajouter un Nouvel Animal</h1>
  <form action="add_animal_process.php" method="POST" enctype="multipart/form-data">
    <label for="name">Nom:</label>
    <input type="text" name="name" required><br>

    <label for="species">Espèce:</label>
    <input type="text" name="species" required><br>

    <label for="breed">Race:</label>
    <input type="text" name="breed"><br>

    <label for="age">Âge:</label>
    <input type="number" name="age" required><br>

    <label for="gender">Sexe:</label>
    <select name="gender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select><br>

    <label for="description">Description:</label>
    <textarea name="description"></textarea><br>

    <label for="image">Image:</label>
    <input type="file" name="image"><br>

    <label for="status">Statut:</label>
    <select name="status">
      <option value="Available">Disponible</option>
      <option value="Adopted">Adopté</option>
    </select><br>

    <button type="submit">Ajouter l'Animal</button>
  </form>
</body>
</html>
