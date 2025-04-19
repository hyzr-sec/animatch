<!-- hoooooon2 -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Animatch - Accueil</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f7f9fc;
      color: #333;
    }
    header, footer {
      text-align: center;
      background: #3498db;
      color: white;
      padding: 20px 0;
    }
    .main-section {
      text-align: center;
      margin: 40px 20px;
    }
    .main-section img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      animation: float 3s ease-in-out infinite;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .links {
      margin-top: 20px;
    }
    .links a {
      display: inline-block;
      margin: 10px;
      padding: 12px 24px;
      background-color: #3498db;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }
    .links a:hover {
      background-color: #2980b9;
    }
    h2 {
      color: #2c3e50;
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
    <p>Chez Animatch, nous croyons que chaque animal mérite une seconde chance. Nous aidons les refuges à trouver des foyers aimants pour leurs pensionnaires. Grâce à notre plateforme, nous simplifions le processus d’adoption pour les familles et offrons plus de visibilité aux animaux qui attendent d’être adoptés.</p>
    <p>En adoptant, vous sauvez une vie, réduisez la surpopulation des refuges et recevez en retour un amour inconditionnel. Ensemble, nous pouvons faire une vraie différence.</p>
  </section>

  <section class="main-section">
    <h2>Contactez-nous</h2>
    <p>Email : <a href="mailto:contact@animatch.tn">contact@animatch.tn</a></p>
    <p>Téléphone : +216 00 000 000</p>
    <p>Adresse : 123 Rue des Animaux, Ariana, Tunisie</p>
  </section>

  <footer>
    <p>&copy; 2025 Animatch. Tous droits réservés.</p>
  </footer>
</body>
</html>
