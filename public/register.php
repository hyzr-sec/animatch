<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animatch - Inscription</title>
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
    nav a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      padding: 8px 15px;
      border-radius: 5px;
      transition: all 0.3s ease;
    }
    nav a:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .register-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      margin-top: 70px;
    }
    .register-form {
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transform: translateY(0);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .register-form:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }
    .register-form h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #006064;
      font-weight: 600;
      position: relative;
    }
    .register-form h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background: #00acc1;
      border-radius: 3px;
    }
    .form-group {
      margin-bottom: 25px;
      position: relative;
    }
    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #006064;
      font-weight: 500;
    }
    .form-group input {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    .form-group input:focus {
      outline: none;
      border-color: #00acc1;
      box-shadow: 0 0 0 3px rgba(0, 172, 193, 0.1);
    }
    .form-group i {
      position: absolute;
      right: 15px;
      top: 40px;
      color: #006064;
      opacity: 0.5;
    }
    .form-row {
      display: flex;
      gap: 20px;
    }
    .form-row .form-group {
      flex: 1;
    }
    .submit-btn {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #00acc1 0%, #007c91 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 172, 193, 0.3);
    }
    .submit-btn:active {
      transform: translateY(0);
    }
    .login-link {
      text-align: center;
      margin-top: 25px;
      color: #006064;
    }
    .login-link a {
      color: #00acc1;
      text-decoration: none;
      font-weight: 600;
      position: relative;
    }
    .login-link a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: #00acc1;
      transition: width 0.3s ease;
    }
    .login-link a:hover::after {
      width: 100%;
    }
    footer {
      background-color: rgba(0, 172, 193, 0.95);
      color: white;
      text-align: center;
      padding: 20px;
      backdrop-filter: blur(10px);
    }
    @media (max-width: 768px) {
      .register-form {
        padding: 30px 20px;
      }
      .form-row {
        flex-direction: column;
        gap: 0;
      }
      header {
        padding: 15px 20px;
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
      <a href="index.php">Accueil</a>
    </nav>
  </header>

  <div class="register-container">
    <form class="register-form" method="post" action="do_register.php">
      <h2>Inscription</h2>
      <div class="form-row">
        <div class="form-group">
          <label for="firstname">Prénom</label>
          <input type="text" id="firstname" name="firstname" required>
          <i class="fas fa-user"></i>
        </div>
        <div class="form-group">
          <label for="lastname">Nom</label>
          <input type="text" id="lastname" name="lastname" required>
          <i class="fas fa-user"></i>
        </div>
      </div>
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
      <div class="form-group">
        <label for="confirm_password">Confirmer le mot de passe</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <i class="fas fa-lock"></i>
      </div>
      <button type="submit" class="submit-btn">S'inscrire</button>
      <div class="login-link">
        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
      </div>
    </form>
  </div>

  <footer>
    &copy; 2025 Animatch. Tous droits réservés.
  </footer>
</body>
</html>
