<?php

use App\models\Enclosure;

$enclosure = new Enclosure();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        // Récupérer et sécuriser les données du formulaire
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);

        // Vérification si l'utilisateur est connecté
        if (!isset($_SESSION['role']) || !$_SESSION['role']) {
            throw new Exception("Utilisateur non connecté.");
        }

        // Passer les données à l'enclos
        $enclosure->setName($name);
        $enclosure->setDescription($description);

        // Appeler la méthode pour créer un enclos dans la base de données
        if ($enclosure->createEnclosure()) {
            // Message de succès
            $message = "Enclos créé avec succès!";
        } else {
            throw new Exception("Échec de la création de l'enclos.");
        }

    } catch (Exception $e) {
        // Message d'erreur
        $message = "Erreur : " . $e->getMessage();
    }
}

// Récupérer tous les enclos pour la vue (si nécessaire)
$allEnclosures = $enclosure->getAllEnclosures();

// Afficher la vue en passant les données nécessaires
render('enclosures/create', [
    'enclos' => $allEnclosures,
    'message' => isset($message) ? $message : null
]);

