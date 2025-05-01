<?php
session_start();
require_once "db.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $description = trim($_POST['description']);
    $social_status = trim($_POST['social_status']);

    // Validation des données
    $errors = [];

    // Vérifier le nom
    if (empty($name)) {
        $errors[] = "Le nom est requis.";
    } elseif (strlen($name) < 2) {
        $errors[] = "Le nom doit contenir au moins 2 caractères.";
    }

    // Vérifier l'email
    if (empty($email)) {
        $errors[] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    } else {
        // Vérifier si l'email existe déjà
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "Cet email est déjà utilisé.";
        }
    }

    // Vérifier le mot de passe
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // Vérifier le téléphone
    if (empty($phone)) {
        $errors[] = "Le numéro de téléphone est requis.";
    }

    // Vérifier l'adresse
    if (empty($address)) {
        $errors[] = "L'adresse est requise.";
    }

    // Vérifier la description
    if (empty($description)) {
        $errors[] = "La description est requise.";
    }

    // Vérifier le statut social
    if (empty($social_status)) {
        $errors[] = "Le statut social est requis.";
    }

    // Si pas d'erreurs, procéder à l'inscription
    if (empty($errors)) {
        // Hasher le mot de passe avec MD5
        $hashed_password = md5($password);

        // Insérer l'utilisateur dans la base de données
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, address, description, social_status, role, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, 'user', 'active', NOW())");
        $stmt->bind_param("sssssss", $name, $email, $hashed_password, $phone, $address, $description, $social_status);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Une erreur est survenue lors de l'inscription.";
            header("Location: register.php");
            exit();
        }
    } else {
        // Stocker les erreurs et les données du formulaire
        $_SESSION['error'] = implode("<br>", $errors);
        $_SESSION['form_data'] = $_POST;
        header("Location: register.php");
        exit();
    }
} else {
    // Si la méthode n'est pas POST, rediriger vers la page d'inscription
    header("Location: register.php");
    exit();
}
?>