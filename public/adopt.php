<?php
    session_start();
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    $target = $isAdmin ? 'admin.php' : 'dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Adopt a Pet</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <header class="navbar">
    <h1>Adopt a Pet</h1>
    <a href="<?= $target ?>">Dashboard</a>
  </header>
  <main class="animal-list">
    <?php
    $conn = new mysqli("db", "admin", "adminadmin", "animatch");
    $res = $conn->query("SELECT * FROM animals");
    while ($row = $res->fetch_assoc()) {
      $img = $row['image_path'] ?? 'assets/images/animals/default.jpeg';
      echo "<div class='animal-card'>
              <img src='$img' alt='Animal image'>
              <h3>{$row['name']}</h3>
              <p>Espèce: {$row['species']}</p>
              <p>Âge: {$row['age']} ans</p>
              <p>Sexe: {$row['gender']}</p>
              <p>Statut: {$row['status']}</p>
              <a href='animal.php?id={$row['id']}'>Details</a>
            </div>";
    }
    $conn->close();
    ?>
  </main>
</body>
</html>
