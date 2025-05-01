<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord Admin - Animatch</title>
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
    .welcome-text {
      font-size: 1.2rem;
      font-weight: 500;
    }
    .welcome-text span {
      color: #ffeb3b;
      font-weight: 600;
    }
    nav {
      display: flex;
      gap: 15px;
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
    nav a i {
      font-size: 1.1rem;
    }
    .dashboard {
      flex: 1;
      padding: 100px 5% 40px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1400px;
      margin: 0 auto;
    }
    .card {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }
    .card-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #00acc1 0%, #007c91 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 10px;
    }
    .card-icon i {
      font-size: 1.8rem;
      color: white;
    }
    .card h3 {
      color: #006064;
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 5px;
    }
    .card p {
      color: #006064;
      opacity: 0.8;
      line-height: 1.5;
      margin-bottom: 15px;
    }
    .card a {
      color: #00acc1;
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
      margin-top: auto;
    }
    .card a:hover {
      color: #007c91;
      transform: translateX(5px);
    }
    .card a i {
      transition: transform 0.3s ease;
    }
    .card a:hover i {
      transform: translateX(5px);
    }
    footer {
      background-color: rgba(0, 172, 193, 0.95);
      color: white;
      text-align: center;
      padding: 20px;
      backdrop-filter: blur(10px);
    }
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
      nav {
        width: 100%;
        flex-wrap: wrap;
      }
      nav a {
        flex: 1;
        justify-content: center;
      }
      .dashboard {
        padding: 150px 20px 40px;
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
    <div class="welcome-text">
      Bienvenue, <span><?php echo htmlspecialchars($_SESSION['user']); ?></span>
    </div>
    <nav>
      <a href="add_animal.php"><i class="fas fa-plus"></i> Ajouter</a>
      <a href="view_animals.php"><i class="fas fa-paw"></i> Animaux</a>
      <a href="view_requests.php"><i class="fas fa-clipboard-list"></i> Demandes</a>
      <a href="manage_users.php"><i class="fas fa-users"></i> Utilisateurs</a>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
    </nav>
  </header>

  <main class="dashboard">
    <div class="card">
      <div class="card-icon">
        <i class="fas fa-plus"></i>
      </div>
      <h3>Ajouter un Nouvel Animal</h3>
      <p>Téléversez et listez les nouveaux animaux disponibles à l'adoption.</p>
      <a href="add_animal.php">Ajouter Maintenant <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="card">
      <div class="card-icon">
        <i class="fas fa-paw"></i>
      </div>
      <h3>Voir Tous les Animaux</h3>
      <p>Consultez et gérez les animaux déjà enregistrés.</p>
      <a href="view_animals.php">Voir les Animaux <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="card">
      <div class="card-icon">
        <i class="fas fa-clipboard-list"></i>
      </div>
      <h3>Revoir les Demandes</h3>
      <p>Approuvez ou rejetez les demandes d'adoption en attente.</p>
      <a href="view_requests.php">Voir les Demandes <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="card">
      <div class="card-icon">
        <i class="fas fa-users"></i>
      </div>
      <h3>Gérer les Utilisateurs</h3>
      <p>Consultez ou supprimez les utilisateurs enregistrés.</p>
      <a href="manage_users.php">Gérer <i class="fas fa-arrow-right"></i></a>
    </div>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
  </footer>
</body>
</html>
