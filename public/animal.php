<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Animal Details</title>
  <link rel="stylesheet" href="assets/css/style.css">
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
    $img = $animal['image'] ?? 'assets/img/default.png';

    echo "<img src='$img' alt='Animal'>
          <h2>{$animal['name']}</h2>
          <p>{$animal['description']}</p>";
    ?>
    <form method="post" action="request_adoption.php">
      <input type="hidden" name="animal_id" value="<?php echo $id; ?>">
      <button type="submit">Adopt Me</button>
    </form>
  </main>
</body>
</html>
