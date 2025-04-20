<?php session_start(); ?>
<?php
if (!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
} 
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
  <link rel="stylesheet" href="assets/css/dashboard.css">
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
    <div class="user-info">
      <?php if (isset($_SESSION['profile_pic'])): ?>
        <img src="<?php echo $_SESSION['profile_pic']; ?>" alt="Profile Picture" />
      <?php endif; ?>
      <div class="details">
        <h2>Hello, <?php echo htmlspecialchars($_SESSION['user'] ?? 'Guest'); ?></h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? '-'); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($_SESSION['phone'] ?? '-'); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($_SESSION['address'] ?? '-'); ?></p>
        <p><strong>Social Status:</strong> <?php echo htmlspecialchars($_SESSION['social_status'] ?? '-'); ?></p>
      </div>
    </div>
  </main>
</body>
</html>
