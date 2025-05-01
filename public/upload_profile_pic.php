<?php
session_start();
require_once "db.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si un fichier a été uploadé
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['profile_pic'];
    
    // Vérifier le type de fichier
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        $_SESSION['error'] = "Format de fichier non supporté. Utilisez JPG, PNG ou GIF.";
        header("Location: dashboard.php");
        exit();
    }

    // Vérifier la taille du fichier (max 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        $_SESSION['error'] = "L'image est trop volumineuse. Maximum 5MB.";
        header("Location: dashboard.php");
        exit();
    }

    // Créer le dossier uploads s'il n'existe pas
    $upload_dir = "assets/uploads/profiles/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Générer un nom de fichier unique
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = uniqid() . '.' . $file_extension;
    $target_path = $upload_dir . $new_filename;

    // Déplacer le fichier
    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        // Mettre à jour la base de données
        $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        $stmt->bind_param("si", $target_path, $_SESSION['user_id']);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Photo de profil mise à jour avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la mise à jour de la photo de profil.";
            // Supprimer le fichier uploadé en cas d'erreur
            unlink($target_path);
        }
    } else {
        $_SESSION['error'] = "Erreur lors de l'upload de la photo.";
    }
} else {
    $_SESSION['error'] = "Aucun fichier n'a été uploadé ou une erreur est survenue.";
}

header("Location: dashboard.php");
exit();
?> 