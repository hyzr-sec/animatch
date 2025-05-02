<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['error'] = "Aucun fichier n'a été uploadé ou une erreur est survenue.";
    header("Location: dashboard.php");
    exit();
}

$file = $_FILES['profile_pic'];

// Validate MIME type (stronger than $_FILES['type'])
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($mime, $allowed_types)) {
    $_SESSION['error'] = "Format de fichier non supporté. Utilisez JPG, PNG ou GIF.";
    header("Location: dashboard.php");
    exit();
}

if ($file['size'] > 5 * 1024 * 1024) {
    $_SESSION['error'] = "L'image est trop volumineuse. Maximum 5MB.";
    header("Location: dashboard.php");
    exit();
}

$upload_dir = "assets/uploads/profiles/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$ext = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $ext)); // sanitize ext
$new_filename = uniqid("img_", true) . '.' . $ext;
$target_path = $upload_dir . $new_filename;

if (move_uploaded_file($file['tmp_name'], $target_path)) {
    $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
    $stmt->bind_param("si", $target_path, $_SESSION['user_id']);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Photo de profil mise à jour avec succès.";
    } else {
        $_SESSION['error'] = "Erreur DB: " . $stmt->error;
        unlink($target_path); // delete bad file
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Erreur lors de l'upload de la photo.";
}

header("Location: dashboard.php");
exit();
?>
