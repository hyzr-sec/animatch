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
  <title>Animatch - Gestion des Animaux</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/view_animals.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="assets/images/logo.png" alt="Logo Animatch">
      <span><strong>Animatch</strong></span>
    </div>
    <nav>
      <a href="dashboard.php">Tableau de bord</a>
      <a href="logout.php">Déconnexion</a>
      <a href="add_animal.php" class="add-animal-btn">
        <i class="fas fa-plus"></i> Ajouter un Animal
      </a>
    </nav>
  </header>

  <div class="main-content">
    <h1 class="page-title">Gestion des Animaux</h1>

    <div class="animals-grid">
    <?php
    require_once "db.php";
    $res = $conn->query("SELECT * FROM animals ORDER BY created_at DESC");
    while ($row = $res->fetch_assoc()) {
      $img = htmlspecialchars($row['image_path'] ?: 'assets/images/animals/animatch.png');
        $statusClass = $row['status'] === 'available' ? 'status-available' : 'status-adopted';
      echo "<div class='animal-card'>
              <img src='{$img}' alt='Image de {$row['name']}'>
                <div class='animal-card-content'>
              <h3>".htmlspecialchars($row['name'])."</h3>
              <p><strong>Espèce:</strong> ".htmlspecialchars($row['species'])."</p>
              <p><strong>Âge:</strong> ".htmlspecialchars($row['age'])." ans</p>
                  <span class='status {$statusClass}'>".ucfirst($row['status'])."</span>
              <div class='actions'>
                    <button class='edit-btn edit-animal' data-id='{$row['id']}'>
                      <i class='fas fa-edit'></i> Modifier
                    </button>
                    <button class='delete-btn delete-animal' data-id='{$row['id']}'>
                      <i class='fas fa-trash'></i> Supprimer
                    </button>
                  </div>
              </div>
            </div>";
    }
    $conn->close();
    ?>
  </div>

  <div id="deleteModal">
    <h3>Êtes-vous sûr de vouloir supprimer cet animal ?</h3>
      <div class="modal-buttons">
        <button id="cancelDelete">Annuler</button>
        <button id="confirmDelete">Confirmer</button>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2024 Animatch. Tous droits réservés.</p>
  </footer>

  <script>
    const deleteButtons = document.querySelectorAll(".delete-animal");
    const editButtons = document.querySelectorAll(".edit-animal");
    const deleteModal = document.getElementById("deleteModal");
    const confirmBtn = document.getElementById("confirmDelete");
    const cancelBtn = document.getElementById("cancelDelete");

    let currentAnimalId = null;

    deleteButtons.forEach(btn => {
      btn.addEventListener("click", () => {
        currentAnimalId = btn.getAttribute("data-id");
        deleteModal.style.display = "block";
      });
    });

    confirmBtn.addEventListener("click", () => {
      fetch("delete_animal.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + encodeURIComponent(currentAnimalId)
      })
      .then(res => res.text())
      .then(response => {
        alert(response);
        location.reload();
      });
    });

    cancelBtn.addEventListener("click", () => {
      deleteModal.style.display = "none";
      currentAnimalId = null;
    });

    editButtons.forEach(btn => {
      btn.addEventListener("click", () => {
        const animalId = btn.getAttribute("data-id");
        window.location.href = "edit_animal.php?id=" + animalId;
      });
    });
  </script>
</body>
</html>
