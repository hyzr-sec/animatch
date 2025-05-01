<?php
session_start();
require_once "db.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si l'ID de l'animal est fourni
if (!isset($_POST['animal_id'])) {
    header("Location: adopt.php");
    exit();
}

$animal_id = $_POST['animal_id'];
$user_id = $_SESSION['user_id'];

// Vérifier si l'animal existe et est disponible
$query = "SELECT * FROM animals WHERE id = $animal_id AND status = 'Available'";
$result = $conn->query($query);

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Cet animal n'est plus disponible pour l'adoption.";
    header("Location: adopt.php");
    exit();
}

// Vérifier si l'utilisateur a déjà une demande en attente pour cet animal
$check_query = "SELECT * FROM adoptions WHERE user_id = $user_id AND animal_id = $animal_id AND status = 'pending'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    $_SESSION['error'] = "Vous avez déjà une demande d'adoption en attente pour cet animal.";
    header("Location: animal.php?id=$animal_id");
    exit();
}

// Créer la demande d'adoption
$insert_query = "INSERT INTO adoptions (user_id, animal_id, adoption_date) 
                 VALUES ($user_id, $animal_id, NOW())";

if ($conn->query($insert_query)) {
    $_SESSION['success'] = "Votre demande d'adoption a été envoyée avec succès.";
} else {
    $_SESSION['error'] = "Une erreur est survenue lors de l'envoi de votre demande.";
}

header("Location: animal.php?id=$animal_id");
exit();
?>