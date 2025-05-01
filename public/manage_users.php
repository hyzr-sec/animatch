<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$target = $isAdmin ? 'admin.php' : 'dashboard.php';

// Récupérer le terme de recherche s'il existe
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Construire la requête SQL en fonction de la recherche
$query = "SELECT id, name, email, role, social_status, created_at FROM users WHERE role != 'admin'";
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $query .= " AND (name LIKE '%$search%' OR email LIKE '%$search%')";
}
$query .= " ORDER BY created_at DESC";

$result = $conn->query($query);

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM users WHERE id = $delete_id");
    header("Location: manage_users.php" . (!empty($search) ? "?search=" . urlencode($search) : ""));
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Utilisateurs - Animatch</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
            color: #006064;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: rgba(0, 172, 193, 0.95);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        header .logo img {
            height: 40px;
            transition: transform 0.3s ease;
        }
        header .logo:hover img {
            transform: scale(1.1);
        }
        header .logo span {
            font-size: 1.4rem;
            font-weight: 600;
        }
        .welcome-text {
            font-size: 1.2rem;
            font-weight: 500;
        }
        .welcome-text span {
            color: #ffeb3b;
            font-weight: 600;
        }
        nav {
            display: flex;
            gap: 15px;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        nav a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        nav a i {
            font-size: 1.1rem;
        }
        .users-container {
            flex: 1;
            padding: 100px 5% 40px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }
        .search-form {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
        }
        .search-form input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .search-form input:focus {
            outline: none;
            border-color: #00acc1;
            box-shadow: 0 0 0 3px rgba(0, 172, 193, 0.1);
        }
        .btn-search {
            padding: 12px 25px;
            background: linear-gradient(135deg, #00acc1 0%, #007c91 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 172, 193, 0.3);
        }
        .users-table {
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
        }
        .users-table th {
            background: linear-gradient(135deg, #00acc1 0%, #007c91 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        .users-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        .users-table tr:last-child td {
            border-bottom: none;
        }
        .users-table tr:hover {
            background-color: rgba(0, 172, 193, 0.05);
        }
        .btn-edit, .btn-delete {
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .btn-edit {
            background: linear-gradient(135deg, #00acc1 0%, #007c91 100%);
            color: white;
        }
        .btn-delete {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }
        .btn-edit:hover, .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .no-users {
            text-align: center;
            padding: 30px;
            color: #006064;
            font-size: 1.1rem;
        }
        footer {
            background-color: rgba(0, 172, 193, 0.95);
            color: white;
            text-align: center;
            padding: 20px;
            backdrop-filter: blur(10px);
        }
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            nav {
                width: 100%;
                flex-wrap: wrap;
            }
            nav a {
                flex: 1;
                justify-content: center;
            }
            .users-container {
                padding: 150px 20px 40px;
            }
            .search-form {
                flex-direction: column;
            }
            .users-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/images/logo.png" alt="Logo Animatch">
            <span><strong>Animatch</strong></span>
        </div>
        <div class="welcome-text">
            Bienvenue, <span><?php echo htmlspecialchars($_SESSION['user']); ?></span>
        </div>
        <nav>
            <a href="admin.php"><i class="fas fa-arrow-left"></i> Retour</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </header>

    <main class="users-container">
        <form method="get" action="manage_users.php" class="search-form">
            <input type="text" name="search" placeholder="Rechercher par nom ou email..." />
            <button type="submit" class="btn-search">
                <i class="fas fa-search"></i> Rechercher
            </button>
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
                                <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn-edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <a href="manage_users.php?delete_id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-users">
                            <i class="fas fa-users-slash"></i> Aucun utilisateur trouvé
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>
</body>
</html>
