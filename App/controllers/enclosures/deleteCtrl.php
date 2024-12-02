<?php

use App\models\Enclosure;

// Instanciation du modèle Enclosure
$enclosure = new Enclosure();

// Vérifie si un ID d'enclos est fourni dans les paramètres GET et s'il est numérique
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $enclos_id = $_GET['id']; // Récupère l'ID de l'enclos

    // Tente de supprimer l'enclos avec l'ID fourni
    try {
        $enclosure->setId($enclos_id); // Définit l'ID de l'enclos dans le modèle
        $deleted = $enclosure->deleteEnclosure(); // Appelle la méthode de suppression

        // Redirige vers la page principale après suppression
        header('Location: /');
        exit();
    } catch (Exception $e) {
        // Affiche un message d'erreur en cas d'exception
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Message d'erreur si l'ID est invalide ou absent
    echo "ID de l'enclos invalide.";
}