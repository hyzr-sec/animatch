<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Animatch</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa;
            color: #006064;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: #00acc1;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        header .logo img {
            height: 40px;
        }
        header .logo span {
            font-size: 1.4rem;
            font-weight: 600;
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

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 5%;
        }

        .register-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .register-title {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #00acc1;
            box-shadow: 0 0 0 3px rgba(0, 172, 193, 0.1);
        }

        .error-message {
            color: #c62828;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #00acc1 0%, #007c91 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 172, 193, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #2c3e50;
        }

        .login-link a {
            color: #00acc1;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #00acc1;
            color: white;
            text-align: center;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .register-container {
                padding: 30px 20px;
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
        <nav>
            <a href="login.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>
        </nav>
    </header>

    <main class="main-content">
        <div class="register-container">
            <h1 class="register-title">Créer un compte</h1>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message" style="margin-bottom: 20px;">
                    <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="do_register.php">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" name="name" required 
                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required 
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input type="tel" id="phone" name="phone" required 
                           value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="address">Adresse</label>
                    <input type="text" id="address" name="address" required 
                           value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="social_status">Statut social</label>
                    <select id="social_status" name="social_status" required>
                        <option value="">Sélectionnez votre statut</option>
                        <option value="Single" <?= isset($_POST['social_status']) && $_POST['social_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                        <option value="Married" <?= isset($_POST['social_status']) && $_POST['social_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                        <option value="Divorced" <?= isset($_POST['social_status']) && $_POST['social_status'] == 'Married' ? 'selected' : '' ?>>Divorced</option>
                        <option value="autre" <?= isset($_POST['social_status']) && $_POST['social_status'] == 'autre' ? 'selected' : '' ?>>Autre</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-user-plus"></i> S'inscrire
                </button>
            </form>

            <div class="login-link">
                Déjà un compte ? <a href="login.php">Connectez-vous</a>
            </div>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>
</body>
</html>
