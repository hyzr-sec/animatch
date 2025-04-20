<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Animals</title>
  <link rel="stylesheet" href="assets/css/admin_dashboard.css">
  <style>
    .animal-card { border: 1px solid #ddd; padding: 10px; margin: 10px; width: 200px; display: inline-block; vertical-align: top; }
    .animal-card img { width: 100%; height: auto; }
    .actions { margin-top: 10px; display: flex; gap: 5px; }
    .actions form { display: inline; }
    #deleteModal { display: none; position: fixed; background: white; padding: 20px; border: 1px solid #aaa; top: 50%; left: 50%; transform: translate(-50%, -50%); }
  </style>
</head>
<body>
  <h1>Gestion des Animaux</h1>
  <a href="add_animal.php">➕ Ajouter un Animal</a>
  <div class="animal-list">
    <?php
    require_once "db.php";
    $res = $conn->query("SELECT * FROM animals ORDER BY created_at DESC");
    while ($row = $res->fetch_assoc()) {
      $img = htmlspecialchars($row['image_path'] ?: 'assets/images/animals/default.png');
      echo "<div class='animal-card'>
              <img src='{$img}' alt='Image de {$row['name']}'>
              <h3>".htmlspecialchars($row['name'])."</h3>
              <p><strong>Espèce:</strong> ".htmlspecialchars($row['species'])."</p>
              <p><strong>Âge:</strong> ".htmlspecialchars($row['age'])." ans</p>
              <p><strong>Statut:</strong> {$row['status']}</p>
              <div class='actions'>
                <button class='edit-animal' data-id='{$row['id']}'>✏️ Modifier</button>
                <button class='delete-animal' data-id='{$row['id']}'>🗑️ Supprimer</button>
              </div>
            </div>";
    }
    $conn->close();
    ?>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal">
    <h3>Êtes-vous sûr de vouloir supprimer cet animal ?</h3>
    <button id="confirmDelete">Oui</button>
    <button id="cancelDelete">Non</button>
  </div>

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
