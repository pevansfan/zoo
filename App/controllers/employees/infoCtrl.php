<?php

// Initialisation des variables
$errors = []; // Tableau pour stocker les éventuelles erreurs
$email = null; // Email de l'utilisateur (initialisé à null)
$password = null; // Mot de passe de l'utilisateur (initialisé à null)

try {
    // Vérifie si l'utilisateur est connecté en vérifiant la session
    if (!empty($_SESSION['user'])) {
        // Récupère l'email et le mot de passe depuis la session
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
    }
} catch (Exception $e) {
    // Ajoute un message d'erreur en cas d'exception lors de l'accès à la session
    $errors['infoAccount'] = $e->getMessage();
}

// Appel à la fonction render pour afficher la vue des informations de l'employé
render('employees/info', [
    'email' => $email, // Passe l'email à la vue
    'password' => $password, // Passe le mot de passe à la vue
    'errors' => $errors // Passe les éventuelles erreurs à la vue
]);