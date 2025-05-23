<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the adoption status to 'Rejected'
    $stmt = $conn->prepare("UPDATE adoptions SET status = 'Rejected' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    echo "Adoption request rejected!";
    // Redirect back to view requests page
    header("Location: view_requests.php");
}
?>
