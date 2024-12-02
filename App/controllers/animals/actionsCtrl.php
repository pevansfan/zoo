<?php

use App\models\Animal;

// Instantiate the Animal model
$animalModel = new Animal();

// Check if a POST request has been made with a defined action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    // Get the requested action
    $action = $_POST['action'];

    // Array to store any potential errors
    $errors = [];

    // Validate and retrieve the animal's ID
    if (!empty($_POST['animal_id']) && ctype_digit($_POST['animal_id'])) {
        $animalId = filter_input(INPUT_POST, 'animal_id', FILTER_SANITIZE_NUMBER_INT);
        $animalModel->setId($animalId); // Set the ID in the model
    }

    // Validate and set the animal's name
    if (!empty($_POST['animal_name'])) {
        try {
            $animalModel->setName(htmlspecialchars($_POST['animal_name']));
        } catch (Exception $e) {
            // Add an error message if an exception is thrown
            $errors['animalName'] = $e->getMessage();
        }
    } else {
        // Add an error message if the name is empty
        $errors['animalName'] = 'Please enter a name.';
    }

    // Validate and set the animal's description
    if (!empty($_POST['animal_description'])) {
        try {
            $animalModel->setDescription(htmlspecialchars($_POST['animal_description']));
        } catch (Exception $e) {
            // Add an error message if an exception is thrown
            $errors['animalDescription'] = $e->getMessage();
        }
    } else {
        // Add an error message if the description is empty
        $errors['animalDescription'] = 'Please enter a description.';
    }

    // Handle the actions based on their type
    if ($action === 'update') {
        // Call the update method from the model
        $result = $animalModel->updateAnimal();
        header("Location: /");
        exit;
    } elseif ($action === 'delete') {
        // Call the delete method from the model
        $result = $animalModel->deleteAnimal();
        if ($result) {
            // Redirect on success
            header("Location: /");
            exit;
        } else {
            // Message in case of failure
            echo "Delete failed.";
        }
        exit;
    } else {
        // Stop execution if the action is unrecognized
        die('Unrecognized action.');
    }
} else {
    // Stop execution if the request is invalid
    die('Invalid request.');
}
