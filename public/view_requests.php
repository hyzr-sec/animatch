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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes d'Adoption - Animatch</title>
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
            padding-top: 80px;
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
        .welcome-text {
            font-size: 1.1rem;
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
        nav a:last-child {
            background-color: #007c91;
        }
        nav a:last-child:hover {
            background-color: #006064;
        }

        .main-content {
            padding: 40px 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            text-align: center;
            margin-bottom: 40px;
            color: #2c3e50;
            font-size: 2.5rem;
        }

        .requests-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }

        .request-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        .request-card:hover {
            transform: translateY(-5px);
        }

        .request-header {
            padding: 20px;
            background: #f5f5f5;
            border-bottom: 1px solid #e0e0e0;
        }

        .request-body {
            padding: 20px;
        }

        .animal-info {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .animal-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }

        .animal-details h3 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .animal-details p {
            color: #666;
            font-size: 0.9rem;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .user-info h4 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .user-info p {
            color: #666;
        }

        .request-date {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .request-actions {
            display: flex;
            gap: 10px;
        }

        .btn-approve, .btn-reject {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-approve {
            background-color: #4caf50;
            color: white;
        }

        .btn-approve:hover {
            background-color: #388e3c;
        }

        .btn-reject {
            background-color: #f44336;
            color: white;
        }

        .btn-reject:hover {
            background-color: #d32f2f;
        }

        .no-requests {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .no-requests p {
            color: #666;
            font-size: 1.1rem;
        }

        footer {
            background-color: #00acc1;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 60px;
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
            .requests-grid {
                grid-template-columns: 1fr;
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
            <a href="dashboard.php"><i class="fas fa-arrow-left"></i> Retour</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </header>

    <main class="main-content">
        <h1 class="page-title">Demandes d'Adoption</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="requests-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="request-card">
                        <div class="request-header">
                            <div class="animal-info">
                                <img src="<?= htmlspecialchars($row['image_path'] ?? 'assets/images/animals/animatch.png') ?>" 
                                     alt="<?= htmlspecialchars($row['animal_name']) ?>" 
                                     class="animal-image">
                                <div class="animal-details">
                                    <h3><?= htmlspecialchars($row['animal_name']) ?></h3>
                                    <p><?= htmlspecialchars($row['species']) ?>, 
                                       <?= htmlspecialchars($row['age']) ?> ans, 
                                       <?= htmlspecialchars($row['gender']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="request-body">
                            <div class="user-info">
                                <h4>Demandeur</h4>
                                <p><?= htmlspecialchars($row['user_name']) ?></p>
                                <p><?= htmlspecialchars($row['email']) ?></p>
                            </div>
                            <div class="request-date">
                                <i class="far fa-calendar-alt"></i> 
                                <?= date('d/m/Y', strtotime($row['adoption_date'])) ?>
                            </div>
                            <div class="request-actions">
                                <a href="approve_adoption.php?id=<?= $row['adoption_id'] ?>" class="btn-approve">
                                    <i class="fas fa-check"></i> Approuver
                                </a>
                                <a href="reject_adoption.php?id=<?= $row['adoption_id'] ?>" class="btn-reject">
                                    <i class="fas fa-times"></i> Rejeter
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-requests">
                <p>Aucune demande d'adoption en attente pour le moment.</p>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>
</body>
</html>

