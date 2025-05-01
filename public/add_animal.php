<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Redirect to the login page if not authorized
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Animal - Animatch</title>
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
        .form-container {
            flex: 1;
            padding: 100px 5% 40px;
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
        }
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #006064;
            font-size: 1.8rem;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #006064;
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
            background-color: white;
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
            .form-container {
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
            <a href="admin.php"><i class="fas fa-arrow-left"></i> Retour</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </nav>
    </header>

    <main class="form-container">
        <div class="form-card">
            <h1 class="form-title">Ajouter un Nouvel Animal</h1>
            <form action="add_animal_process.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="species">Espèce</label>
                    <input type="text" name="species" id="species" required>
                </div>

                <div class="form-group">
                    <label for="breed">Race</label>
                    <input type="text" name="breed" id="breed">
                </div>

                <div class="form-group">
                    <label for="age">Âge</label>
                    <input type="number" name="age" id="age" required>
                </div>

                <div class="form-group">
                    <label for="gender">Sexe</label>
                    <select name="gender" id="gender">
                        <option value="Male">Mâle</option>
                        <option value="Female">Femelle</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="status">Statut</label>
                    <select name="status" id="status">
                        <option value="Available">Disponible</option>
                        <option value="Adopted">Adopté</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-plus-circle"></i> Ajouter l'Animal
                </button>
            </form>
        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Animatch. Tous droits réservés.
    </footer>
</body>
</html>
