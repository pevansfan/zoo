<?php

use App\models\Enclosure;
use App\models\Animal;

// Instanciation des modèles Enclosure et Animal
$enclos = new Enclosure();
$animal = new Animal();

// Vérifie si un ID d'enclos est passé dans les paramètres GET
if (isset($_GET['id'])) {
    $enclos_id = $_GET['id']; // Récupère l'ID de l'enclos

    // Récupérer les détails de l'enclos par son ID
    $enclos->setId($enclos_id); // Définit l'ID de l'enclos dans le modèle
    $enclosById = $enclos->getAllEnclosuresById(); // Obtient les données de l'enclos spécifique

    // Récupérer les animaux associés à cet enclos
    $animal->setId($enclos_id); // Définit l'ID de l'enclos pour les animaux
    $animalsByEnclosure = $animal->getAnimalsByEnclosure(); // Récupère la liste des animaux

    // Appel à la fonction render pour passer les données à la vue
    render('enclosures/index', [
        'enclos' => $enclos->getAllEnclosures(), // Liste de tous les enclos
        'enclosById' => $enclosById, // Détails de l'enclos sélectionné
        'animals' => $animalsByEnclosure, // Animaux associés à cet enclos
    ]);
} else {
    // Message d'erreur si aucun enclos n'est spécifié dans l'URL
    echo "Aucun enclos spécifié";
}