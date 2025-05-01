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
  <link rel="stylesheet" href="assets/css/admin.css">
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
