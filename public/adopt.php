<?php
    session_start();
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    $target = $isAdmin ? 'admin.php' : 'dashboard.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopter un Animal - Animatch</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/adopt.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/images/logo.png" alt="Logo Animatch">
            <span><strong>Animatch</strong></span>
        </div>
        <div class="welcome-text">
            Bienvenue, <span><?php echo htmlspecialchars($_SESSION['user'] ?? 'Invité'); ?></span>
        </div>
        <nav>
            <a href="<?= $target ?>"><i class="fas fa-arrow-left"></i> Retour</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </header>

    <main class="main-content">
        <h1 class="page-title">Adopter un Animal</h1>

        <div class="animals-grid">
            <?php
            $conn = new mysqli("db", "admin", "adminadmin", "animatch");
            $res = $conn->query("SELECT * FROM animals");
            while ($row = $res->fetch_assoc()) {
                $img = $row['image_path'] ?? 'assets/images/animals/animatch.png';
                $statusClass = $row['status'] === 'Available' ? 'status-available' : 'status-adopted';
                $statusText = $row['status'] === 'Available' ? 'Disponible' : 'Adopté';
                ?>
                <div class="animal-card">
                    <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="animal-image">
                    <div class="animal-info">
                        <h3><?= htmlspecialchars($row['name']) ?></h3>
                        <span class="status <?= $statusClass ?>"><?= $statusText ?></span>
                        <div class="animal-details">
                            <p><i class="fas fa-paw"></i> <?= htmlspecialchars($row['species']) ?></p>
                            <p><i class="fas fa-birthday-cake"></i> <?= htmlspecialchars($row['age']) ?> ans</p>
                            <p><i class="fas fa-venus-mars"></i> <?= htmlspecialchars($row['gender']) ?></p>
                        </div>
                        <a href="animal.php?id=<?= $row['id'] ?>" class="btn-details">
                            <i class="fas fa-info-circle"></i> Voir les détails
                        </a>
                    </div>
                </div>
                <?php
            }
            $conn->close();
            ?>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>
</body>
</html>
