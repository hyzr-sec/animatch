<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animatch - Accueil</title>
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
    }
    header {
      background-color: #00acc1;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 5%;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
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
    nav {
      display: flex;
      gap: 25px;
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
    nav a:last-child {
      background-color: #007c91;
    }
    nav a:last-child:hover {
      background-color: #006064;
    }

    .banner {
      background-image: url('assets/images/animals_banner.jpg');
      background-size: cover;
      background-position: center;
      height: 70vh;
      min-height: 500px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
      padding: 0 20px;
      position: relative;
    }
    .banner::after {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }
    .banner h1, .banner p, .banner a {
      position: relative;
      z-index: 2;
      max-width: 800px;
      margin: 0 auto;
    }
    .banner h1 {
      font-size: 3rem;
      margin-bottom: 20px;
      font-weight: 600;
      line-height: 1.2;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    .banner p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      line-height: 1.5;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
    .banner a {
      padding: 12px 30px;
      background-color: #007c91;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    .banner a:hover {
      background-color: #006064;
      transform: translateY(-2px);
    }

    .features {
      padding: 80px 5%;
      background-color: #f8f9fa;
    }
    .features h2 {
      text-align: center;
      color: #2c3e50;
      font-size: 2.5rem;
      margin-bottom: 50px;
    }
    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .feature-card {
      background: white;
      border-radius: 10px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }
    .feature-card:hover {
      transform: translateY(-10px);
    }
    .feature-icon {
      width: 80px;
      height: 80px;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #e3f2fd;
      border-radius: 50%;
      transition: all 0.3s ease;
    }
    .feature-icon:hover {
      background-color: #00acc1;
      transform: rotate(360deg);
    }
    .feature-icon i {
      font-size: 2rem;
      color: #00acc1;
      transition: all 0.3s ease;
    }
    .feature-icon:hover i {
      color: white;
    }
    .feature-card h3 {
      color: #2c3e50;
      margin-bottom: 15px;
      font-size: 1.3rem;
    }
    .feature-card p {
      color: #666;
      line-height: 1.6;
    }

    .contact {
      background-color: #b2ebf2;
      text-align: center;
      padding: 40px 20px;
    }
    .contact h2 {
      margin-bottom: 20px;
    }
    .contact p {
      margin: 8px 0;
    }

    footer {
      background-color: #00acc1;
      color: white;
      text-align: center;
      padding: 20px;
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
      }
      nav {
        margin-top: 10px;
      }
      .features {
        flex-direction: column;
        align-items: center;
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
      <a href="login.php">Connexion</a>
      <a href="register.php">Inscription</a>
    </nav>
  </header>

  <section class="banner">
    <h1>Bienvenue sur Animatch</h1>
    <p>Trouvez votre compagnon idéal à adopter</p>
    <a href="adopt.php">Voir les animaux</a>
  </section>

  <section class="features">
    <h2>Pourquoi choisir Animatch ?</h2>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-paw"></i>
        </div>
        <h3>Adoption Responsable</h3>
        <p>Nous nous assurons que chaque adoption se fait dans les meilleures conditions pour l'animal et sa nouvelle famille.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-shield-virus"></i>
        </div>
        <h3>Sécurité Garantie</h3>
        <p>Tous nos animaux sont vaccinés, stérilisés et suivis par des vétérinaires professionnels.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">
          <i class="fas fa-hand-holding-heart"></i>
        </div>
        <h3>Support Continu</h3>
        <p>Notre équipe reste à votre disposition pour vous accompagner tout au long du processus d'adoption.</p>
      </div>
    </div>
  </section>

  <section class="contact">
    <h2>Contactez-nous</h2>
    <p>Email : <a href="mailto:contact@animatch.tn">contact@animatch.tn</a></p>
    <p>Téléphone : +216 00 000 000</p>
    <p>Adresse : 123 Rue des Animaux, Ariana, Tunisie</p>
  </section>

  <footer>
    &copy; 2025 Animatch. Tous droits réservés.
  </footer>

</body>
</html>
