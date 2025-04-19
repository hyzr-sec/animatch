<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <header class="navbar">
    <h1>Dashboard</h1>
    <nav>
      <a href="adopt.php">Adopt a Pet</a>
      <a href="logout.php">Logout</a>
    </nav>
  </header>

  <main class="dashboard">
    <p>Hello, <strong><?php echo $_SESSION['user'] ?? 'Guest'; ?></strong></p>
  </main>
</body>
</html>
