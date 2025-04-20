<?php
session_start();
require_once "db.php";
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
require_once "db.php";

// Fetch all users from the database
$query = "SELECT id, name, email, role, social_status, created_at FROM users";
$result = $conn->query($query);

// Handle delete user request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $conn->query("DELETE FROM users WHERE id = $delete_id");
    header("Location: manage_users.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <link rel="stylesheet" href="assets/css/admin_dashboard.css">
</head>
<body>
    <header class="navbar">
        <h1>Manage Users</h1>
        <a href="dashboard.php">Dashboard</a>
    </header>

    <main class="users-container">
        <form method="get" action="manage_users.php" class="search-form">
            <input type="text" name="search" placeholder="Search by name or email..." />
            <button type="submit" class="btn-search">Search</button>
        </form>

        <table class="users-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= ucfirst($row['role']) ?></td>
                            <td><?= ucfirst($row['social_status']) ?></td>
                            <td><?= $row['created_at'] ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                                <a href="manage_users.php?delete_id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
