<?php
require_once "db.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Step 1: Fetch the image path from the database
    $stmt = $conn->prepare("SELECT image_path FROM animals WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    // Check if the animal exists
    if ($result->num_rows > 0) {
        $animal = $result->fetch_assoc();
        $imagePath = $animal['image_path'];

        // Step 2: Delete the image file if it exists
        if (!empty($imagePath) && file_exists($imagePath)) {
            unlink($imagePath); // Deletes the file
        }
    }

    // Step 3: Delete any pending adoption record associated with this animal
    $conn->query("DELETE FROM adoptions WHERE animal_id = $id AND status = 'Pending'");

    // Step 4: Delete the animal record from the animals table
    $conn->query("DELETE FROM animals WHERE id = $id");

    echo "L'animal a été supprimé avec succès!";
}
?>
