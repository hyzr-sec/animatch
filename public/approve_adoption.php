<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the adoption status to 'Approved'
    $conn->query("UPDATE adoptions SET status = 'Approved' WHERE id = $id");

    // Optionally, update the animal status to 'Adopted' if necessary
    $conn->query("UPDATE animals SET status = 'Adopted' WHERE id = (SELECT animal_id FROM adoptions WHERE id = $id)");

    echo "Adoption request approved!";
    // Redirect back to view requests page
    header("Location: view_requests.php");
}
?>
