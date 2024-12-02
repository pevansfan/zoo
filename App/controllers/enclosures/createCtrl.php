<?php

use App\models\Enclosure;

$enclosure = new Enclosure();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        // Retrieve and sanitize the form data
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);

        // Check if the user is logged in
        if (!isset($_SESSION['role']) || !$_SESSION['role']) {
            throw new Exception("User not logged in.");
        }

        // Pass the data to the enclosure
        $enclosure->setName($name);
        $enclosure->setDescription($description);

        // Call the method to create an enclosure in the database
        if ($enclosure->createEnclosure()) {
            // Success message
            $message = "Enclosure created successfully!";
        } else {
            throw new Exception("Failed to create the enclosure.");
        }

    } catch (Exception $e) {
        // Error message
        $message = "Error: " . $e->getMessage();
    }
}

// Retrieve all enclosures for the view (if necessary)
$allEnclosures = $enclosure->getAllEnclosures();

// Render the view, passing the necessary data
render('enclosures/create', [
    'enclos' => $allEnclosures,
    'message' => isset($message) ? $message : null
]);