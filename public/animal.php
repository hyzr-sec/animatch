<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Animal Details</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
        button {
      padding: 0.75rem;
      background: #00796b;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background: rgb(1, 72, 64);
    }
  </style>
</head>
<body>
  <main class="animal-detail">
    <?php
    $id = $_GET['id'] ?? 0;
    $conn = new mysqli("db", "admin", "adminadmin", "animatch");
    $stmt = $conn->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $animal = $result->fetch_assoc();
    $img = $animal['image_path'] ?? 'assets/images/animals/default.jpeg';

    echo "<img src='$img' alt='Animal'>
          <h2>{$animal['name']}</h2>
          <p><strong>Espèce:</strong> {$animal['species']}</p>
          <p><strong>Race:</strong> {$animal['breed']}</p>
          <p><strong>Âge:</strong> {$animal['age']} ans</p>
          <p><strong>Sexe:</strong> {$animal['gender']}</p>
          <p><strong>Description:</strong><br>{$animal['description']}</p>
          <p><strong>Statut:</strong> {$animal['status']}</p>";
    ?>
    <form method="post" action="request_adoption.php">
      <input type="hidden" name="animal_id" value="<?php echo $id; ?>">
      <button type="submit">Adopt Me</button>
    </form>
  </main>
</body>
</html>
