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
  <title>Tableau de Bord Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/admin_dashboard.css">
</head>
<body>

  <header>
    <h1>Bienvenue, Admin <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
  </header>

  <nav>
    <a href="add_animal.php">Ajouter un Animal</a>
    <a href="view_animals.php">Voir les Animaux</a>
    <a href="view_requests.php">Demandes d'Adoption</a>
    <a href="manage_users.php">Gérer les Utilisateurs</a>
    <a href="logout.php">Se Déconnecter</a>
  </nav>

  <main class="dashboard">
    <div class="card">
      <h3>Ajouter un Nouvel Animal</h3>
      <p>Téléversez et listez les nouveaux animaux disponibles à l'adoption.</p>
      <a href="add_animal.php">Ajouter Maintenant →</a>
    </div>

    <div class="card">
      <h3>Voir Tous les Animaux</h3>
      <p>Consultez et gérez les animaux déjà enregistrés.</p>
      <a href="view_animals.php">Voir les Animaux →</a>
    </div>

    <div class="card">
      <h3>Revoir les Demandes</h3>
      <p>Approuvez ou rejetez les demandes d'adoption en attente.</p>
      <a href="view_requests.php">Voir les Demandes →</a>
    </div>

    <div class="card">
      <h3>Gérer les Utilisateurs</h3>
      <p>Consultez ou supprimez les utilisateurs enregistrés.</p>
      <a href="manage_users.php">Gérer →</a>
    </div>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> Tableau de Bord Admin - AniMatch
  </footer>

</body>
</html>
