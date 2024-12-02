<?php

require 'App/utils/utils.php';

// Autoload des classes
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . "/$class.php";
    if (file_exists($file)) {
        require $file;
    } else {
        // Gérer les erreurs d'autoload plus proprement
        header("HTTP/1.0 404 Not Found");
        echo "Le fichier $file n'a pas pu être trouvé.";
        exit;
    }
});

session_start();

// Tableau des routes
$routes = [
    '/' => 'App/controllers/indexCtrl.php',
    '/login' => 'App/controllers/users/loginCtrl.php',
    '/logout' => 'App/controllers/users/logoutCtrl.php',
    '/enclos' => 'App/controllers/enclosures/indexCtrl.php',
    '/infoUser' => 'App/controllers/employees/infoCtrl.php',
    '/animalActions' => 'App/controllers/animals/actionsCtrl.php',
    '/infoTickets' => 'App/controllers/tickets/indexCtrl.php',
    '/addEnclosure' => 'App/controllers/enclosures/createCtrl.php',
    '/addAnimal' => 'App/controllers/animals/createCtrl.php',
    '/enclos/delete' => 'App/controllers/enclosures/deleteCtrl.php',
];

// Récupérer l'URL demandée
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Vérifier si l'URL correspond à une route définie
if (isset($routes[$url])) {
    require $routes[$url];
} else {
    // Si aucune route ne correspond, afficher une page 404
    require 'App/views/404.php';
}
