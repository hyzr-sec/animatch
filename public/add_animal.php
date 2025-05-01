<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Animal - Animatch</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/add_animal.css">
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

    <main class="form-container">
        <div class="form-card">
            <h1 class="form-title">Ajouter un Nouvel Animal</h1>
            <form action="add_animal_process.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="species">Espèce</label>
                    <input type="text" name="species" id="species" required>
                </div>

                <div class="form-group">
                    <label for="breed">Race</label>
                    <input type="text" name="breed" id="breed">
                </div>

                <div class="form-group">
                    <label for="age">Âge</label>
                    <input type="number" name="age" id="age" required>
                </div>

                <div class="form-group">
                    <label for="gender">Sexe</label>
                    <select name="gender" id="gender">
                        <option value="Male">Mâle</option>
                        <option value="Female">Femelle</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="status">Statut</label>
                    <select name="status" id="status">
                        <option value="Available">Disponible</option>
                        <option value="Adopted">Adopté</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-plus-circle"></i> Ajouter l'Animal
                </button>
            </form>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>
</body>
</html>
