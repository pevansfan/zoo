<?php

use App\models\Animal;
use App\models\Enclosure;

// Instantiate the Enclosure model
$enclosure = new Enclosure();
$animal = new Animal();

// Check if an enclosure ID is provided in the GET parameters and if it's numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $enclos_id = $_GET['id']; // Retrieve the enclosure ID

    // Attempt to delete the enclosure with the provided ID
    try {
        $enclosure->setId($enclos_id); // Set the enclosure ID in the model
        $animal->setEnclosId($enclos_id);
        $animal->deleteAnimalsByEnclosure();
        $deleted = $enclosure->deleteEnclosure(); // Call the delete method

        // Redirect to the main page after deletion
        redirectTo('/');
    } catch (Exception $e) {
        // Display an error message in case of an exception
        echo "Error: " . $e->getMessage();
    }
} else {
    // Error message if the ID is invalid or missing
    echo "Invalid enclosure ID.";
}