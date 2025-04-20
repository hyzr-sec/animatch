<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Animals</title>
  <link rel="stylesheet" href="assets/css/admin_dashboard.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .animal-card { border: 1px solid #ddd; padding: 10px; margin: 10px; width: 200px; display: inline-block; vertical-align: top; }
    .animal-card img { width: 100%; height: auto; }
    .actions { margin-top: 10px; display: flex; gap: 5px; }
    .actions form { display: inline; }
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
  <div id="deleteModal" style="display:none;">
    <h3>Êtes-vous sûr de vouloir supprimer cet animal ?</h3>
    <button id="confirmDelete">Oui</button>
    <button id="cancelDelete">Non</button>
  </div>

  <script>
    $(document).ready(function() {
      $(".delete-animal").click(function() {
        var animalId = $(this).data("id");
        $("#deleteModal").show();
        $("#confirmDelete").click(function() {
          $.post("delete_animal.php", { id: animalId }, function(response) {
            alert(response);
            location.reload();
          });
        });
        $("#cancelDelete").click(function() {
          $("#deleteModal").hide();
        });
      });

      $(".edit-animal").click(function() {
        var animalId = $(this).data("id");
        window.location.href = "edit_animal.php?id=" + animalId;
      });
    });
  </script>
</body>
</html>
