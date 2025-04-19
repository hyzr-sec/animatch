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
    <a href="dashboard.php">Dashboard</a>
  </header>
  <main class="animal-list">
    <?php
    $conn = new mysqli("db", "admin", "adminadmin", "animatch");
    $res = $conn->query("SELECT * FROM animals");
    while ($row = $res->fetch_assoc()) {
      $img = $row['image'] ?? 'assets/img/default.png';
      echo "<div class='animal-card'>
              <img src='$img' alt='Animal image'>
              <h3>{$row['name']}</h3>
              <p>{$row['type']}</p>
              <a href='animal.php?id={$row['id']}'>Details</a>
            </div>";
    }
    $conn->close();
    ?>
  </main>
</body>
</html>
