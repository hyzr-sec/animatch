<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the adoption status to 'Rejected'
    $conn->query("UPDATE adoptions SET status = 'Rejected' WHERE id = $id");

    echo "Adoption request rejected!";
    // Redirect back to view requests page
    header("Location: view_requests.php");
}
?>
