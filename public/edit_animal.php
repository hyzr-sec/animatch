<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require_once "db.php";
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM animals WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
// Check if the animal exists
if ($res->num_rows == 0) {
    echo "Animal not found!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Animal - Animatch</title>
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

        .form-container {
            padding: 40px 5%;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #00acc1;
            box-shadow: 0 0 0 3px rgba(0, 172, 193, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #00acc1 0%, #007c91 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 172, 193, 0.3);
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
            .form-container {
                padding: 20px;
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
            <a href="view_animals.php"><i class="fas fa-arrow-left"></i> Retour</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </header>

    <main class="form-container">
        <div class="form-card">
            <h1 class="form-title">Modifier l'Animal</h1>
            <form action="edit_animal_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">

                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($animal['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="species">Espèce</label>
                    <input type="text" name="species" id="species" value="<?php echo htmlspecialchars($animal['species']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="breed">Race</label>
                    <input type="text" name="breed" id="breed" value="<?php echo htmlspecialchars($animal['breed']); ?>">
                </div>

                <div class="form-group">
                    <label for="age">Âge</label>
                    <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($animal['age']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="gender">Sexe</label>
                    <select name="gender" id="gender">
                        <option value="Male" <?php echo ($animal['gender'] == 'Male') ? 'selected' : ''; ?>>Mâle</option>
                        <option value="Female" <?php echo ($animal['gender'] == 'Female') ? 'selected' : ''; ?>>Femelle</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"><?php echo htmlspecialchars($animal['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="status">Statut</label>
                    <select name="status" id="status">
                        <option value="Available" <?php echo ($animal['status'] == 'Available') ? 'selected' : ''; ?>>Disponible</option>
                        <option value="Adopted" <?php echo ($animal['status'] == 'Adopted') ? 'selected' : ''; ?>>Adopté</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
            </form>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>
</body>
</html>
