<?php

use App\models\Enclosure;
use App\models\Animal;

// Instantiate the Enclosure and Animal models
$enclos = new Enclosure();
$animal = new Animal();

// Check if an enclosure ID is passed in the GET parameters
if (isset($_GET['id'])) {
    $enclos_id = $_GET['id']; // Retrieve the enclosure ID

    // Get the details of the enclosure by its ID
    $enclos->setId($enclos_id); // Set the enclosure ID in the model
    $enclosById = $enclos->getAllEnclosuresById(); // Get the details of the specific enclosure

    // Get the animals associated with this enclosure
    $animal->setId($enclos_id); // Set the enclosure ID for the animals
    $animalsByEnclosure = $animal->getAnimalsByEnclosure(); // Retrieve the list of animals

    // Call the render function to pass the data to the view
    render('enclosures/index', [
        'enclos' => $enclos->getAllEnclosures(), // List of all enclosures
        'enclosById' => $enclosById, // Details of the selected enclosure
        'animals' => $animalsByEnclosure, // Animals associated with this enclosure
    ]);
} else {
    // Error message if no enclosure is specified in the URL
    echo "No enclosure specified.";
}