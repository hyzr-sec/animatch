<!DOCTYPE html>
<html lang="fr">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Animatch - Accueil</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    header, footer {
      text-align: center;
      background: #3498db;
      color: white;
      padding: 20px 0;
    }
    .main-section {
      text-align: center;
      margin: 40px 0;
    }
    .main-section img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      animation: float 3s ease-in-out infinite;
    }
    .links a {
      margin: 10px;
    }
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }
  </style>
</head>
<body>
  <header>
    <h1>Bienvenue sur Animatch</h1>
    <p>Trouvez votre compagnon idéal à adopter</p>
  </header>

  <div class="main-section">
    <img src="assets/images/animals_banner.jpg" alt="Animaux mignons">
    <div class="links">
      <a href="adopt.php">Voir les animaux</a>
      <a href="login.php">Se connecter</a>
      <a href="register.php">S'inscrire</a>
    </div>
  </div>

  <section class="main-section">
    <h2>À propos de nous</h2>
    <p>Animatch est une plateforme dédiée à connecter les animaux sans abri avec des personnes aimantes. Notre mission est de donner à chaque animal une maison chaleureuse.</p>
    <img src="assets/images/about_us.jpg" alt="Notre équipe">
  </section>

  <section class="main-section">
    <h2>Contactez-nous</h2>
    <p>Email : contact@animatch.tn</p>
    <p>Téléphone : +216 00 000 000</p>
    <p>Adresse : 123 Rue des Animaux, Ariana, Tunisie</p>
  </section>

  <footer>
    <p>&copy; 2025 Animatch. Tous droits réservés.</p>
  </footer>
</body>
</html>