<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the adoption status to 'Approved'
    $stmt = $conn->prepare("UPDATE adoptions SET status = 'Approved' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $stmt = $conn->prepare("UPDATE animals SET status = 'Adopted' WHERE id = (SELECT animal_id FROM adoptions WHERE id = ?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "Adoption request approved!";
    // Redirect back to view requests page
    header("Location: view_requests.php");
}
?>
