<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$query = "SELECT id, name, email, role, social_status, created_at FROM users WHERE role != 'admin'";
$result = $conn->query($query);

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM users WHERE id = $delete_id");
    header("Location: manage_users.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gérer les utilisateurs</title>
    <link rel="stylesheet" href="assets/css/admin_dashboard.css">
    <style>
        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th, .users-table td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: left;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        .users-container {
            padding: 2rem;
        }

        .btn-edit, .btn-delete {
            margin-right: 0.5rem;
            padding: 0.5rem 0.75rem;
            text-decoration: none;
            color: white;
            background-color: #00796b;
            border-radius: 4px;
        }

        .btn-delete {
            background-color: #c0392b;
        }

        .search-form {
            margin-bottom: 1rem;
            display: flex;
            gap: 0.5rem;
        }

        .search-form input {
            padding: 0.5rem;
            width: 250px;
        }

        .btn-search {
            padding: 0.5rem 1rem;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #f5f5f5;
        }

        .navbar h1 {
            margin: 0;
        }

        .navbar a {
            text-decoration: none;
            color: #00796b;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <h1>Gérer les utilisateurs</h1>
        <a href="dashboard.php">Tableau de bord</a>
    </header>

    <main class="users-container">
        <form method="get" action="manage_users.php" class="search-form">
            <input type="text" name="search" placeholder="Rechercher par nom ou email..." />
            <button type="submit" class="btn-search">Rechercher</button>
        </form>

        <table class="users-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars(ucfirst($row['role'])) ?></td>
                            <td><?= htmlspecialchars($row['social_status'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn-edit">Modifier</a>
                                <a href="manage_users.php?delete_id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
