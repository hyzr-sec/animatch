<?php session_start(); ?>
<?php
if (!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
} 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Animatch</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
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
            <a href="adopt.php"><i class="fas fa-paw"></i> Adopter un Animal</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </header>

    <main class="main-content">
        <div class="dashboard-card">
            <div class="user-profile">
                <?php if (isset($_SESSION['profile_pic'])): ?>
                    <div class="profile-image">
                        <img src="<?php echo htmlspecialchars($_SESSION['profile_pic']); ?>" alt="Photo de profil">
                        <form action="upload_profile_pic.php" method="post" enctype="multipart/form-data" class="upload-form">
                            <input type="file" name="profile_pic" id="profile_pic" accept="image/*" style="display: none;">
                            <label for="profile_pic" class="upload-btn">
                                <i class="fas fa-camera"></i> Changer la photo
                            </label>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="profile-image">
                        <div class="no-image">
                            <i class="fas fa-user"></i>
                        </div>
                        <form action="upload_profile_pic.php" method="post" enctype="multipart/form-data" class="upload-form">
                            <input type="file" name="profile_pic" id="profile_pic" accept="image/*" style="display: none;">
                            <label for="profile_pic" class="upload-btn">
                                <i class="fas fa-camera"></i> Ajouter une photo
                            </label>
                        </form>
                    </div>
                <?php endif; ?>
                <div class="user-details">
                    <h2>Bonjour, <?php echo htmlspecialchars($_SESSION['user'] ?? 'Invité'); ?></h2>
                    <div class="detail-item">
                        <i class="fas fa-envelope"></i>
                        <strong>Email :</strong>
                        <p><?php echo htmlspecialchars($_SESSION['email'] ?? '-'); ?></p>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-phone"></i>
                        <strong>Téléphone :</strong>
                        <p><?php echo htmlspecialchars($_SESSION['phone'] ?? '-'); ?></p>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Adresse :</strong>
                        <p><?php echo htmlspecialchars($_SESSION['address'] ?? '-'); ?></p>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-user-tie"></i>
                        <strong>Statut Social :</strong>
                        <p><?php echo htmlspecialchars($_SESSION['social_status'] ?? '-'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-paw stat-icon"></i>
                <div class="stat-number">0</div>
                <div class="stat-label">Animaux Adoptés</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-heart stat-icon"></i>
                <div class="stat-number">0</div>
                <div class="stat-label">Favoris</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-comments stat-icon"></i>
                <div class="stat-number">0</div>
                <div class="stat-label">Messages</div>
            </div>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>

    <script>
    document.getElementById('profile_pic').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            this.form.submit();
        }
    });
    </script>
</body>
</html>
