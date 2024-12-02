<?php

use App\models\Animal;
use App\models\Enclosure;

// Instantiate the Animal and Enclosure models
$animal = new Animal();
$enclosures = new Enclosure();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve the form data
        $name = htmlspecialchars($_POST['name']); // Animal's name
        $description = htmlspecialchars($_POST['description']); // Animal's description
        $species_id = (int) $_POST['species_id']; // Species ID (converted to integer)
        $image = htmlspecialchars($_POST['image']); // Image URL or path

        // Set the properties of the animal
        $animal->setName($name); // Set the name
        $animal->setDescription($description); // Set the description
        $animal->setSpeciesId($species_id); // Set the species ID
        $animal->setEnclosId($species_id); // Set the enclosure ID (this is based on species_id; check business logic if necessary)
        $animal->setImage($image); // Set the image

        // Create the animal in the database
        $animal->createAnimal();

        // Redirect after success
        header("Location: /"); // Redirects to the main page after creation
        exit;
    } catch (Exception $e) {
        // Error message in case of exception
        $message = "Failed to add animal: " . $e->getMessage();
    }
}

// Pass necessary data to the view
render('animals/create', [
    'enclos' => $enclosures->getAllEnclosures(), // Retrieve all enclosures
    'message' => isset($message) ? $message : null, // Pass the error message if it exists, otherwise null
]);