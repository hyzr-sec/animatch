<?php
require_once "db.php";
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM animals WHERE id = $id");
$animal = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Modifier Animal</title>
  <link rel="stylesheet" href="assets/css/add_animal.css">
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
</head>
<body>
  <h1>Modifier l'Animal</h1>
  <form action="edit_animal_process.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">

    <label for="name">Nom:</label>
    <input type="text" name="name" value="<?php echo $animal['name']; ?>" required><br>

    <label for="species">Espèce:</label>
    <input type="text" name="species" value="<?php echo $animal['species']; ?>" required><br>

    <label for="breed">Race:</label>
    <input type="text" name="breed" value="<?php echo $animal['breed']; ?>"><br>

    <label for="age">Âge:</label>
    <input type="number" name="age" value="<?php echo $animal['age']; ?>" required><br>

    <label for="gender">Sexe:</label>
    <select name="gender">
      <option value="Male" <?php echo ($animal['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
      <option value="Female" <?php echo ($animal['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
    </select><br>

    <label for="description">Description:</label>
    <textarea name="description"><?php echo $animal['description']; ?></textarea><br>

    <label for="image">Image:</label>
    <input type="file" name="image"><br>

    <label for="status">Statut:</label>
    <select name="status">
      <option value="Available" <?php echo ($animal['status'] == 'Available') ? 'selected' : ''; ?>>Disponible</option>
      <option value="Adopted" <?php echo ($animal['status'] == 'Adopted') ? 'selected' : ''; ?>>Adopté</option>
    </select><br>

    <button type="submit">Modifier l'Animal</button>
  </form>
</body>
</html>
