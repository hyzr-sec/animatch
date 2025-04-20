<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
require_once "db.php";

$query = "SELECT adoptions.id AS adoption_id, adoptions.adoption_date, adoptions.status AS adoption_status, 
                 adoptions.notes, 
                 animals.name AS animal_name, animals.species, animals.age, animals.gender, animals.image_path, 
                 users.name AS user_name, users.email 
          FROM adoptions
          JOIN animals ON adoptions.animal_id = animals.id
          JOIN users ON adoptions.user_id = users.id
          WHERE adoptions.status = 'Pending'";

$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Adoption Requests</title>
    <link rel="stylesheet" href="assets/css/admin_dashboard.css">
</head>
<body>
    <header class="navbar">
        <h1>View Adoption Requests</h1>
        <a href="dashboard.php">Dashboard</a>
    </header>

    <main class="requests-container">
        <?php if ($result->num_rows > 0): ?>
            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Animal</th>
                        <th>Requester</th>
                        <th>Adoption Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <img src="<?= $row['image_path'] ?? 'assets/img/default.png' ?>" alt="<?= $row['animal_name'] ?>" class="animal-image">
                                <p><strong><?= $row['animal_name'] ?></strong><br>
                                <?= $row['species'] ?>, <?= $row['age'] ?> years, <?= $row['gender'] ?></p>
                            </td>
                            <td>
                                <p><strong><?= $row['user_name'] ?></strong><br>
                                <?= $row['email'] ?></p>
                            </td>
                            <td>
                                <p><?= $row['adoption_date'] ?></p>
                            </td>
                            <td>
                                <p><strong><?= ucfirst($row['adoption_status']) ?></strong></p>
                            </td>
                            <td>
                                <a href="approve_adoption.php?id=<?= $row['adoption_id'] ?>" class="btn-approve">Approve</a>
                                <a href="reject_adoption.php?id=<?= $row['adoption_id'] ?>" class="btn-reject">Reject</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending adoption requests at the moment.</p>
        <?php endif; ?>
    </main>
</body>
</html>

