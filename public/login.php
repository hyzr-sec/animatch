<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animatch - Connexion</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="assets/images/logo.png" alt="Logo Animatch">
      <span><strong>Animatch</strong></span>
    </div>
    <nav>
      <a href="index.php">Accueil</a>
    </nav>
  </header>

  <div class="login-container">
    <form class="login-form" method="post" action="do_login.php">
      <h2>Connexion</h2>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <i class="fas fa-envelope"></i>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        <i class="fas fa-lock"></i>
      </div>
      <button type="submit" class="submit-btn">Se connecter</button>
      <div class="register-link">
        <p>Pas encore de compte ? <a href="register.php">S'inscrire</a></p>
      </div>
    </form>
  </div>

  <footer>
    &copy; 2025 Animatch. Tous droits réservés.
  </footer>
</body>
</html>
