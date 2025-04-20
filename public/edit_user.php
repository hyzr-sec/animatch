<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user data to populate the edit form
    $query = "SELECT id, name, email, role, status FROM users WHERE id = $user_id";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    // Handle form submission to update user info
    if (isset($_POST['update'])) {
        $role = $_POST['role'];
        $status = $_POST['status'];

        $conn->query("UPDATE users SET role = '$role', status = '$status' WHERE id = $user_id");
        header("Location: manage_users.php");
    }
} else {
    echo "User not found!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="assets/css/add_animal.css">
</head>
<body>
    <header class="navbar">
        <h1>Edit User: <?= htmlspecialchars($user['name']) ?></h1>
        <a href="manage_users.php">Back to Manage Users</a>
    </header>

    <main class="edit-user-container">
        <form method="post">
            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
            </select>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="active" <?= $user['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= $user['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>

            <button type="submit" name="update">Update User</button>
        </form>
    </main>
</body>
</html>
