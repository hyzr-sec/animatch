<?php
session_start();
require_once "db.php";

if (isset($_GET['id'])) {
    $animal_id = $_GET['id'];
    $query = "SELECT * FROM animals WHERE id = $animal_id";
    $result = $conn->query($query);
    $animal = $result->fetch_assoc();
} else {
    header("Location: adopt.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($animal['name']) ?> - Animatch</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animal.css">
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
            <a href="adopt.php"><i class="fas fa-arrow-left"></i> Retour</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </header>

    <main class="main-content">
        <a href="adopt.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour aux animaux
        </a>

        <div class="animal-details">
            <img src="<?= htmlspecialchars($animal['image_path']) ?>" alt="<?= htmlspecialchars($animal['name']) ?>" class="animal-image">
            <div class="animal-info">
                <h1 class="animal-name"><?= htmlspecialchars($animal['name']) ?></h1>
                <span class="status <?= $animal['status'] === 'Available' ? 'status-available' : 'status-adopted' ?>">
                    <?= $animal['status'] === 'Available' ? 'Disponible' : 'Adopté' ?>
                </span>
                
                <div class="info-grid">
                    <div class="info-item">
                        <i class="fas fa-paw"></i>
                        <span>Espèce: <?= htmlspecialchars($animal['species']) ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-birthday-cake"></i>
                        <span>Âge: <?= htmlspecialchars($animal['age']) ?> ans</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-venus-mars"></i>
                        <span>Sexe: <?= htmlspecialchars($animal['gender']) ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar"></i>
                        <span>Ajouté le: <?= date('d/m/Y', strtotime($animal['created_at'])) ?></span>
                    </div>
                </div>

                <div class="description">
                    <h3>Description</h3>
                    <p><?= nl2br(htmlspecialchars($animal['description'])) ?></p>
                </div>

                <?php if ($animal['status'] === 'Available'): ?>
                    <form method="post" action="request_adoption.php" class="adoption-form">
                        <input type="hidden" name="animal_id" value="<?= $animal['id'] ?>">
                        <button type="submit" class="btn-adopt">
                            <i class="fas fa-heart"></i> Faire une demande d'adoption
                        </button>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>
</body>
</html>
