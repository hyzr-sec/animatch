<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

  <header>
    <h1>Welcome, Admin <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
  </header>

  <nav>
    <a href="add_animal.php">Add Animal</a>
    <a href="view_animals.php">View Animals</a>
    <a href="view_requests.php">Adoption Requests</a>
    <a href="manage_users.php">Manage Users</a>
    <a href="logout.php">Logout</a>
  </nav>

  <main class="dashboard">
    <div class="card">
      <h3>Add a New Animal</h3>
      <p>Upload and list new animals available for adoption.</p>
      <a href="add_animal.php">Add Now →</a>
    </div>

    <div class="card">
      <h3>View All Animals</h3>
      <p>Check and manage existing animal entries.</p>
      <a href="view_animals.php">View Animals →</a>
    </div>

    <div class="card">
      <h3>Review Requests</h3>
      <p>Approve or reject pending adoption requests.</p>
      <a href="view_requests.php">See Requests →</a>
    </div>

    <div class="card">
      <h3>Manage Users</h3>
      <p>View or remove registered users in the system.</p>
      <a href="manage_users.php">Manage →</a>
    </div>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> AniMatch Admin Panel
  </footer>

</body>
</html>
